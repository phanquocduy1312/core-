# Luật nghiệp vụ (Business Rules)

Nguồn: đọc trực tiếp từ service/controller. Khi sửa nghiệp vụ, cập nhật cả file này.

## Vòng đời đơn hàng (state machine)
Định nghĩa tại `OrderStateTransitionService`. **Mọi luồng đổi trạng thái phải đi qua service này** (admin, VNPAY IPN, webhook GHTK).

**Order status:**
- `pending` → `processing`, `cancelled`
- `processing` → `completed`, `cancelled`
- `completed` → `cancelled`
- `cancelled` → (không đi đâu — trạng thái cuối)

**Payment status:**
- `pending` → `paid`, `failed`
- `paid` → `partially_refunded`, `refunded`
- `failed` → `pending`, `paid`
- `partially_refunded` → `refunded`
- `refunded` → (cuối)

Chuyển sang chính nó luôn hợp lệ (no-op). Chuyển không hợp lệ → `DomainException` (hoặc bị bỏ qua ở webhook, có log).

## Checkout (`POST /api/public/orders/checkout`)
Toàn bộ trong `DB::transaction` + `lockForUpdate` (chống oversell/race). Trình tự mỗi item:
1. Lock product; chặn nếu không tồn tại/`is_active=false`.
2. Nếu `usesVariantInventory()` → **bắt buộc** `option_value_ids`, resolve SKU qua `ProductVariantResolver`; giá lấy từ variant (fallback product). **Không nhận `variant_id` trực tiếp.**
3. Nếu không dùng variant nhưng `manage_stock` → kiểm tra đủ `stock_quantity`.
4. Áp **Promotion** qua `PromotionService::quote` (giá sau KM cấp SKU).
5. Cộng `subtotal` (giá gốc) và `promotion_discount`.

Sau vòng lặp:
6. Áp **Voucher** trên `discountableSubtotal = subtotal − promotion_discount` (voucher tính *sau* promotion).
7. Tạo Order + OrderItem (snapshot), `reserve` quota promotion, trừ kho (`OrderStockService::deduct`), tạo PaymentTransaction pending, ghi OrderStatusHistory, `increment` used_count voucher.
8. `grand_total = max(0, subtotal − promotion_discount − voucher_discount) + shipping_fee`.
9. Nếu `payment_method = vnpay` → tạo `payment_url`; nếu tạo URL thất bại → **rollback**: huỷ đơn, hoàn kho, hoàn lượt voucher.
10. Email + thông báo gửi async (`afterCommit`), không chặn checkout.

## Khuyến mãi vs Voucher
- **Promotion** (tự động, cấp sản phẩm/SKU): `PromotionService::quote` chọn **1 promotion tốt nhất, KHÔNG cộng dồn**. Ưu tiên `priority` cao hơn; cùng priority thì đơn giá thấp hơn thắng. Kiểm tra `min_quantity`, quota campaign (`isAvailableFor`) và suất theo SKU (`PromotionTarget::canReserve`).
  - `discountedUnitPrice`: `percentage` = giá×(1−value/100); `fixed_amount` = giá−value; `fixed_price` = min(giá, value). Luôn `max(0, ...)`.
  - Quota được **reserve** (khoá + increment `used_count`) *sau khi* tạo order, có thể ném lỗi nếu vừa hết suất.
- **Voucher** (khách nhập mã, cấp đơn): `Voucher::calculateDiscount(subtotal)`.
  - `percentage` = subtotal×value/100, chặn trần `max_discount_amount` nếu có; `fixed` = value.
  - Không vượt quá subtotal. Điều kiện `isValidForOrder`: active, trong hạn, còn lượt (`used_count < quantity`), đạt `min_order_amount`.
  - Ở checkout, voucher tính trên **subtotal đã trừ promotion** (không stack chồng lên KM tự động).

## Tồn kho
- Chỉ trừ/hoàn qua `OrderStockService` (`deduct`/`restore`), trong transaction có khoá. Mọi biến động ghi `InventoryMovement`.
- Sản phẩm dùng variant → tồn kho ở cấp SKU; sản phẩm thường → `stock_quantity` (khi `manage_stock=true`).
- Huỷ đơn (`cancelled`) từ trạng thái khác → tự hoàn kho.

## Thanh toán VNPAY (IPN)
`GET /api/public/payment/vnpay/ipn`:
1. Verify chữ ký HMAC-SHA512 (`hash_equals`). Sai → RspCode `97`.
2. Tìm đơn theo `vnp_TxnRef`. Không có → `01`.
3. **Khớp số tiền**: `vnp_Amount` phải = `grand_total × 100`. Lệch → `04`.
4. Trong transaction + lock: ghi PaymentTransaction; nếu **đã tồn tại** (không `wasRecentlyCreated`) hoặc đơn đã `paid`/`cancelled` → `02` (idempotent, chống replay).
5. Thành công (`vnp_ResponseCode=00` & `vnp_TransactionStatus=00`) → `payment_status=paid`, nếu đang `pending` thì `status=processing`. Thất bại → `payment_status=failed`. Ghi history, gửi email nếu đổi trạng thái.

## Webhook GHTK (`POST /api/webhooks/ghtk`)
- Verify `webhook_token` (`hash_equals`) + phải bật `realtime_tracking_enabled`. Sai → 401.
- Map `status_id` GHTK → order status (bảng map trong `WebhookController`). Cập nhật trong transaction + lock, tôn trọng state machine (bỏ qua chuyển không hợp lệ, có log).
- COD + `completed` → `payment_status=paid`. Huỷ/trả hàng → hoàn kho.

## Đánh giá sản phẩm
- Chỉ cho gửi review nếu **đã mua** sản phẩm (đơn không `cancelled`). Khách đăng nhập: xét theo `user_id` hoặc email. Khách vãng lai: xét theo email nhập vào.
- Rate-limit các endpoint public: checkout 10/phút, tracking 30/phút, contact 5/phút, auth 5/phút, webhook 120/phút (xem `AppServiceProvider`).
