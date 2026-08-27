# Tích hợp ngoài (Integrations)

## VNPAY (cổng thanh toán)
- Cấu hình lưu trong `PaymentMethod` (`method_code='vnpay'`), field `settings` **mã hoá** (`EncryptedJson`): `tmn_code`, `hash_secret`, `api_url`.
- `VNPAYService::createPayment(order)` → ký HMAC-SHA512, trả URL redirect. Amount gửi VNPAY = `grand_total × 100`.
- **Chế độ mock**: khi `tmn_code === 'mock'`, `createPayment` trả URL mock nội bộ `/payment/vnpay/mock`.
- **IPN**: verify chữ ký + khớp số tiền + idempotent (xem [business-rules.md](business-rules.md#thanh-toán-vnpay-ipn)).
- ⚠️ **Bảo mật**: endpoint mock (`/payment/vnpay/mock*`) chỉ hoạt động ngoài production và khi `tmn_code=mock` (guard `assertVnpayMockEnabled` + `if (! app()->isProduction())` ở route). KHÔNG gỡ guard — xem [../SECURITY_AUDIT.md](../SECURITY_AUDIT.md) mục 1.

## GHTK — Giao Hàng Tiết Kiệm (vận chuyển)
- Cấu hình trong `ShippingPartner` (`partner_code='DTGH000012'`), `settings`: `webhook_token`, `realtime_tracking_enabled`.
- Webhook `POST /api/webhooks/ghtk` (rate-limit 120/phút): verify `webhook_token` bằng `hash_equals`, map `status_id` → order status. Xem [business-rules.md](business-rules.md#webhook-ghtk).
- `ShippingService` cấp phí ship (flat rate) cho checkout.

## Cloudinary (media)
- `CloudinaryService` upload ảnh. Cấu hình qua `config('services.cloudinary.*')` (env `CLOUDINARY_*`).
- **Fallback**: nếu chưa cấu hình hoặc lỗi API → lưu vào disk `public` local và trả URL. Vì vậy validate upload phải whitelist mime (`jpg,jpeg,png,webp,gif`) — KHÔNG cho SVG/HTML/PHP (stored-XSS/RCE). Xem [../SECURITY_AUDIT.md](../SECURITY_AUDIT.md) mục 3.

## Email & Queue
- Email gửi async qua queue: `SendOrderStatusEmail`, `SendInvoiceEmail`, `SendStoreOrderNotification`. Dùng `->afterCommit()` để không gửi khi transaction rollback.
- SMTP cấu hình động (một số lưu mã hoá trong `ProjectSetting`). Email người bán: `config('mail.seller')`.
- `NotificationHelper` gửi thông báo đơn mới (vd Zalo/Slack tuỳ cấu hình).

## Auth token
- **Sanctum** cho cả admin API và khách API. Không dùng JWT (đã gỡ `JwtService`).

## Deploy
- Script `deploy.py` (FTPS ưu tiên, token bảo vệ script remote). Xem skill [../../.agents/skills/deploy_laravel_ftp/SKILL.md](../../.agents/skills/deploy_laravel_ftp/SKILL.md).
