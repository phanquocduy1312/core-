# AGENTS.md — Hướng dẫn cho AI agent làm việc trên `ecommere-core`

Tài liệu này giúp agent (Claude Code hoặc tương tự) hiểu nhanh dự án và mở rộng tính năng **an toàn, nhất quán**.

📚 **Đọc kho tri thức trước tiên:** [docs/README.md](docs/README.md) — index toàn bộ tri thức dự án
(nghiệp vụ, mô hình dữ liệu, phân quyền, tích hợp, quyết định thiết kế). Kèm [docs/ARCHITECTURE.md](docs/ARCHITECTURE.md)
và [docs/SECURITY_AUDIT.md](docs/SECURITY_AUDIT.md). Quy tắc bắt buộc: [.agents/RULES.md](.agents/RULES.md)
(gồm R1 commit-local-sau-phiên và R6 bồi đắp kho tri thức).

## Nền tảng
- **Laravel 11 + PHP 8.2+**, MySQL (dev có thể SQLite). Auth API dùng **Sanctum**.
- Cấu hình bootstrap ở `bootstrap/app.php` (không có `app/Http/Kernel.php`).
- Đa ngôn ngữ: route web admin có prefix `{locale}` (`vi`/`en`/`ko`).

## Dùng codegraph TRƯỚC khi code
Dự án đã index codegraph. Trước khi sửa/viết code, hỏi index thay vì grep mù:
- `codegraph_context "<mô tả task>"` — điểm vào + symbol liên quan (gọi ĐẦU TIÊN).
- `codegraph_impact <symbol>` — xem đổi symbol sẽ ảnh hưởng gì trước khi sửa.
- `codegraph_callers <symbol>` / `codegraph_trace from→to` — lần theo luồng gọi.

## Quy tắc bất di bất dịch (bảo mật & tính đúng đắn)

1. **Tiền tệ:** cột DB luôn `decimal(15,2)`. So sánh/khớp số tiền thanh toán phải chính xác (int/HMAC), không tin dữ liệu client.
2. **Thanh toán/webhook:** mọi callback bên ngoài (VNPAY IPN, GHTK) **phải** verify chữ ký/token bằng `hash_equals`, kiểm tra khớp số tiền, và **idempotent** (chống replay). Cập nhật đơn trong `DB::transaction` + `lockForUpdate`.
3. **Chuyển trạng thái đơn:** luôn đi qua [OrderStateTransitionService](app/Services/OrderStateTransitionService.php). Không tự `update(['status' => ...])` bỏ qua máy trạng thái.
4. **Tồn kho:** trừ/hoàn kho qua `OrderStockService`, trong transaction có khoá.
5. **Phân quyền:** route admin nhạy cảm cần `can:<permission>` hoặc `superadmin`, KHÔNG chỉ dựa `admin` (middleware này chỉ chặn khách). Tính năng bật/tắt qua `feature:<code>`.
6. **Secrets:** cấu hình nhạy cảm lưu qua cast `EncryptedJson`; đọc config qua `config()`/`env()` — không hardcode.
7. **Upload:** validate bằng whitelist `mimes:jpg,jpeg,png,webp,gif` (KHÔNG dùng rule `image` chung vì cho phép SVG → XSS). Upload qua `CloudinaryService`.
8. **SQL thô:** dùng nháy đơn cho chuỗi (`'completed'`), không nháy kép. Ưu tiên query builder; nếu `DB::raw` thì bind tham số.
9. **Không sửa migration cũ đã chạy** — tạo migration mới.

## Response & i18n
- API luôn trả qua `ApiResponse::success()/error()`.
- Chuỗi hiển thị đặt trong `lang/{vi,en,ko}/*.php`, gọi `__('ns.key')`. Thêm key cho ĐỦ 3 ngôn ngữ.

## Kiểm thử
- Mỗi tính năng/sửa lỗi phải kèm **Feature test** trong `tests/Feature/`.
- Chạy: `php artisan test` (hoặc `php artisan test --filter=<Tên>`).
- Với lỗi bảo mật đã biết trong audit, thêm test hồi quy khẳng định đã chặn.

## Thêm tính năng mới — dùng skill
Có skill `.claude/skills/add-feature` mô tả checklist đầy đủ (migration → model → request → service → controller → route → i18n → test). Gọi khi được yêu cầu "thêm tính năng / thêm resource CRUD / thêm endpoint".

## Lệnh hay dùng
```bash
php artisan test                     # chạy test
php artisan migrate                  # chạy migration (dev)
php artisan route:list               # liệt kê route
php artisan make:migration ...       # tạo migration mới
```

## Việc KHÔNG tự làm (cần hỏi người dùng)
- Chạy `deploy.py` hoặc bất kỳ deploy production nào.
- Xoá dữ liệu/bảng, `migrate:fresh` trên môi trường có dữ liệu thật.
- Thay đổi khoá/secret, cấu hình cổng thanh toán thật.
