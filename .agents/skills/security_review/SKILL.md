---
name: security_review
description: Checklist rà soát bảo mật nhanh cho backend Laravel ecommere-core trước khi merge/deploy. Dùng khi user yêu cầu "kiểm tra bảo mật", "review lỗ hổng", "audit", hoặc trước khi deploy.
---

# Skill: Rà soát bảo mật nhanh `ecommere-core`

Tham chiếu đầy đủ: [../../../docs/SECURITY_AUDIT.md](../../../docs/SECURITY_AUDIT.md).
Dùng codegraph để soi luồng: `codegraph_context`, `codegraph_callers`, `codegraph_trace`.

## 1. Thanh toán & webhook (ưu tiên cao nhất)
- [ ] Mọi IPN/webhook verify chữ ký/token bằng `hash_equals` (không `==`).
- [ ] Khớp số tiền server-side; không tin `amount` từ client.
- [ ] Idempotent (chống replay) — kiểm tra transaction đã tồn tại chưa.
- [ ] Cập nhật trong `DB::transaction` + `lockForUpdate`.
- [ ] Endpoint mock/test bị chặn ở production (`app()->isProduction()` + guard controller).

## 2. Auth & phân quyền
- [ ] Route admin nhạy cảm có `can:<permission>`/`superadmin`, không chỉ dựa `admin`.
- [ ] Login trả thông báo chung (chống user enumeration). Forgot-password luôn trả success.
- [ ] Mật khẩu hash bcrypt; token qua Sanctum.
- [ ] Không rò `exists:users,email` ở forgot-password.

## 3. Input & upload
- [ ] Validate whitelist. Upload: `mimes:jpg,jpeg,png,webp,gif` (KHÔNG rule `image` → chặn SVG).
- [ ] `folder`/path người dùng nhập được whitelist (chống path traversal).
- [ ] Mass assignment: `$fillable` tường minh, không lộ cột nhạy cảm.

## 4. Database & SQL
- [ ] Tiền `decimal(15,2)`. SQL thô dùng nháy đơn + bind tham số.
- [ ] Không `DB::raw` với dữ liệu client chưa bind.

## 5. Secrets & deploy
- [ ] `.env` gitignore; không hardcode key. Settings nhạy cảm cast `EncryptedJson`.
- [ ] Không route migration/artisan công khai. Script deploy remote có token + tự huỷ.
- [ ] `APP_DEBUG=false`, `APP_ENV=production` trên host; Document Root trỏ `public/`.

## Cách chạy
1. `codegraph_context` cho từng luồng nhạy cảm ở trên.
2. Đọc code thật ở điểm vào, đối chiếu checklist.
3. Báo cáo theo mức độ CRITICAL → LOW, kèm `file:line` và cách khắc phục.
4. Nếu vá lỗi: `php -l` + thêm test hồi quy khẳng định đã chặn.
