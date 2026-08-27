# Nhật ký quyết định (Decision Log / ADR)

Ghi lại các quyết định thiết kế quan trọng + lý do + đánh đổi. Thêm mục mới khi có quyết định mới
(mới nhất lên đầu). Mỗi mục: bối cảnh → quyết định → lý do → đánh đổi.

---

## ADR-005 — Chặn endpoint mock VNPAY ở production (2026-07)
- **Bối cảnh:** `/payment/vnpay/mock/submit` công khai, tự ký chữ ký bằng `hash_secret` thật → có thể đánh dấu đơn "đã thanh toán" mà không trả tiền.
- **Quyết định:** guard `assertVnpayMockEnabled()` (chỉ chạy ngoài production + `tmn_code='mock'`) và bọc route trong `if (! app()->isProduction())`.
- **Lý do:** vá lỗ hổng bypass thanh toán CRITICAL; giữ tiện ích mock cho dev/test.
- **Đánh đổi:** nếu ai đó cấu hình `tmn_code='mock'` trên production thì route mock 404 (đúng ý đồ, coi như cấu hình sai).

## ADR-004 — Voucher tính sau Promotion, không cộng dồn (stacking) (2026-07)
- **Quyết định:** Promotion (tự động, cấp SKU) chọn 1 tốt nhất theo `priority`; Voucher (mã tay) tính trên subtotal *đã trừ promotion*.
- **Lý do:** tránh giảm giá chồng nhau gây âm biên lợi nhuận; ưu tiên rõ ràng.
- **Đánh đổi:** không hỗ trợ khuyến mãi cộng dồn — nếu cần chương trình stack phải thiết kế lại `PromotionService::quote`.

## ADR-003 — Product Variant v2 dựa trên option_signature (2026-07)
- **Quyết định:** SKU (ProductVariant) resolve từ `option_value_ids` client gửi, khớp `option_signature`. API checkout KHÔNG nhận `variant_id` trực tiếp.
- **Lý do:** tránh client gửi SKU sai/không thuộc sản phẩm; ràng buộc chọn đúng 1 giá trị cho mỗi nhóm thuộc tính.
- **Đánh đổi:** frontend phải gửi đủ option value; thêm một bước resolve.

## ADR-002 — Idempotent VNPAY IPN qua PaymentTransaction (2026-07)
- **Quyết định:** mỗi IPN tạo một `PaymentTransaction`; nếu đã tồn tại (`wasRecentlyCreated=false`) hoặc đơn đã `paid`/`cancelled` → trả `02`, không xử lý lại.
- **Lý do:** VNPAY có thể gửi IPN nhiều lần; chống replay/double-processing.
- **Đánh đổi:** cần khoá hàng (`lockForUpdate`) trong transaction.

## ADR-001 — Tiền tệ dùng decimal(15,2), settings nhạy cảm mã hoá (khởi tạo)
- **Quyết định:** mọi cột tiền `decimal(15,2)`; settings nhạy cảm cast `EncryptedJson`.
- **Lý do:** tránh sai số float; bảo vệ secret at-rest.
- **Đánh đổi:** tính toán PHP vẫn dùng float (chấp nhận); đọc/ghi settings tốn thêm mã hoá.

---

## ADR-000 — Máy trạng thái đơn tập trung (khởi tạo)
- **Quyết định:** mọi thay đổi `status`/`payment_status` đi qua `OrderStateTransitionService`.
- **Lý do:** đảm bảo transition hợp lệ nhất quán giữa admin/IPN/webhook; dễ audit.
- **Đánh đổi:** thêm một lớp gọi; cần nhớ dùng service thay vì update trực tiếp.
