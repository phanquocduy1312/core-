# Kiến trúc dự án — `ecommere-core`

Backend thương mại điện tử đa ngôn ngữ, xây trên **Laravel 11** (cấu trúc `bootstrap/app.php` mới, không dùng `Kernel.php`). Cung cấp: (1) **API JSON công khai** cho storefront, (2) **panel quản trị** render bằng Blade, (3) tích hợp thanh toán VNPAY và vận chuyển GHTK.

## Tầng & thư mục

| Tầng | Vị trí | Vai trò |
|------|--------|---------|
| Routing | `routes/api.php`, `routes/web.php`, `routes/admin.php` | API public dưới `/public/*` và `/admin/*`; web admin dưới `/{locale}/admin/*` |
| Controllers | `app/Http/Controllers/{Api,Admin,Auth}` | Mỏng — validate + gọi Service |
| Form Requests | `app/Http/Requests/**` | Validation + authorize tập trung |
| Services | `app/Services/**` | Nghiệp vụ: order lifecycle, tồn kho, thanh toán, khuyến mãi, shipping, upload |
| Support | `app/Support/**` | Tiện ích: `ApiResponse`, `FeatureGate`, `NotificationHelper` |
| Models | `app/Models/**` | Eloquent, 35+ bảng |
| Jobs / Mail | `app/Jobs`, `app/Mail` | Gửi email hoá đơn/trạng thái đơn qua queue |
| Casts | `app/Casts/EncryptedJson.php` | Mã hoá field JSON nhạy cảm khi lưu DB |
| Migrations | `database/migrations` | Nguồn sự thật cho schema |
| i18n | `lang/{en,vi,ko}`, `config/laravellocalization.php` | Đa ngôn ngữ, locale trong URL |

## Các luồng nghiệp vụ cốt lõi

### Checkout (`POST /public/orders/checkout`)
[PublicController::checkout](../app/Http/Controllers/Api/PublicController.php#L256) → toàn bộ bọc trong `DB::transaction` + `lockForUpdate`:
1. Validate item, resolve variant qua `ProductVariantResolver`.
2. Tính giá gốc → áp `PromotionService::quote` (khuyến mãi cấp sản phẩm/variant) → áp voucher.
3. Tạo `Order` + `OrderItem` (snapshot giá/tên tại thời điểm mua), trừ kho qua `OrderStockService::deduct`.
4. `PaymentTransactionService::createPending`, ghi `OrderStatusHistory`.
5. Nếu VNPAY → `VNPAYService::createPayment` trả URL redirect; nếu fail thì rollback + hoàn kho + hoàn lượt voucher.
6. Email & thông báo gửi async qua queue (`afterCommit`).

### Thanh toán VNPAY
- `VNPAYService::createPayment` ký HMAC-SHA512, trả URL. Chế độ `tmn_code === 'mock'` trả URL mock nội bộ.
- IPN `GET /public/payment/vnpay/ipn` → [vnpayIpn](../app/Http/Controllers/Api/PublicController.php#L611): verify chữ ký (`hash_equals`) → kiểm tra khớp số tiền → cập nhật `payment_status` **idempotent** (dựa `wasRecentlyCreated` của transaction) trong lock.
- ⚠ Route mock (`/payment/vnpay/mock/*`) hiện **không được bảo vệ** — xem [SECURITY_AUDIT.md](SECURITY_AUDIT.md) mục 1.

### Vòng đời đơn hàng
[OrderStateTransitionService](../app/Services/OrderStateTransitionService.php) là **máy trạng thái** khai báo tường minh, chặn chuyển trạng thái không hợp lệ (cho cả `status` và `payment_status`). Mọi nơi đổi trạng thái đơn (admin, webhook GHTK, IPN) **phải** đi qua service này. Lịch sử ghi vào `order_status_histories`.

### Webhook GHTK (`POST /api/webhooks/ghtk`)
[WebhookController::handleGHTK](../app/Http/Controllers/Api/WebhookController.php#L28): verify `webhook_token` bằng `hash_equals`, map `status_id` → trạng thái nội bộ, cập nhật trong transaction + lock, tôn trọng máy trạng thái, hoàn kho khi huỷ.

## Phân quyền (2 lớp)

1. **Feature gate** — [FeatureGate](../app/Support/FeatureGate.php) + middleware `feature:<code>`: bật/tắt tính năng theo `feature_settings` (vd `multi_admin`, `review`, `cms_page`). Superadmin bypass.
2. **Permission/Role** — middleware `admin`, `superadmin`, và `can:<permission>` (Gate). Xem [routes/admin.php](../routes/admin.php). Ví dụ: quản lý user cần đồng thời `feature:multi_admin` + `can:manage_users`.

> Bất biến quan trọng: `EnsureUserIsAdmin` chỉ chặn `role_id === null`. Mọi route admin nhạy cảm **phải** thêm `can:*` hoặc `superadmin` riêng — không dựa vào mỗi `admin`.

## Quy ước dữ liệu

- **Tiền tệ:** luôn `decimal(15,2)`. Không dùng float trong migration.
- **Settings nhạy cảm** (SMTP, khoá VNPAY...): cast `EncryptedJson` để mã hoá tại rest.
- **API response:** luôn qua [ApiResponse::success/error](../app/Support/ApiResponse.php) để đồng nhất `{success, message, data, meta|errors}`.
- **i18n:** chuỗi hiển thị đặt trong `lang/*`, dùng `__('namespace.key')`. Route web admin luôn có prefix `{locale}`.

## Hạ tầng ngoài

- **Cloudinary** (`CloudinaryService`) cho ảnh, có fallback lưu disk `public` khi chưa cấu hình.
- **Queue** cho email (`SendOrderStatusEmail`, `SendInvoiceEmail`, `SendStoreOrderNotification`).
- **Sanctum** cho token API (admin + khách).
- **Deploy:** `deploy.py` (FTP + script PHP remote) — xem cảnh báo bảo mật trong audit.

## Test
`tests/Feature/**` — 37 feature test bao trùm catalog, order lifecycle, payment, webhook, phân quyền, security hardening. Chạy: `php artisan test`.
