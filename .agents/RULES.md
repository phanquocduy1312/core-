# RULES — Quy tắc bắt buộc cho AI Agent trên `ecommere-core`

Đọc file này TRƯỚC mỗi phiên làm việc. Kèm theo: [../AGENTS.md](../AGENTS.md),
[../docs/ARCHITECTURE.md](../docs/ARCHITECTURE.md), [../docs/SECURITY_AUDIT.md](../docs/SECURITY_AUDIT.md).

---

## 🔴 R1 — Commit sau mỗi phiên (chỉ local, KHÔNG push)

Kết thúc mỗi phiên làm việc có thay đổi file, Agent **bắt buộc** tạo một git commit gói lại
công việc của phiên đó. **Chỉ commit trên máy local — TUYỆT ĐỐI không `git push` lên GitHub/remote.**

```bash
git add -A
git commit -m "<mô tả ngắn việc đã làm trong phiên>"
# KHÔNG chạy: git push
```

- Commit message viết tiếng Việt, ngắn gọn, mô tả đúng việc đã làm.
- Nếu đang ở nhánh mặc định `main` thì vẫn commit tại chỗ (không tự tạo nhánh trừ khi user yêu cầu).
- Không commit `.env`, secret, hay artifact deploy (`deploy.zip`, `.deploy_timestamp`, `__pycache__`).
- Nếu không có thay đổi nào → không cần commit.

> Việc push lên remote chỉ thực hiện khi người dùng yêu cầu rõ ràng.

---

## 📚 R6 — Đọc & bồi đắp kho tri thức

- **Trước** khi làm việc nghiệp vụ: đọc kho tri thức [../docs/README.md](../docs/README.md) (đặc biệt `docs/knowledge/`).
- **Sau** mỗi phiên, nếu phát hiện tri thức mới chưa được ghi (luật nghiệp vụ, quyết định thiết kế, cạm bẫy) →
  bổ sung vào file `docs/knowledge/` phù hợp; quyết định có đánh đổi thì thêm mục vào `docs/knowledge/decisions.md`.
- Kho tri thức ghi *tại sao* và *luật* — thứ không đọc thẳng được từ code. Cấu trúc code thuần thì hỏi codegraph.

## ⚡ R2 — Dùng codegraph trước khi code (làm nhanh & đúng)

- Gọi `codegraph_context "<task>"` đầu tiên để tìm pattern/điểm vào — đừng grep mù.
- `codegraph_impact <symbol>` trước khi sửa symbol dùng chung.
- Copy pattern của resource tương tự đang có (Brand, Voucher, Post) thay vì tự nghĩ cấu trúc mới.

## ⚡ R3 — Bất biến bảo mật (không được vi phạm)

- Callback ngoài (VNPAY IPN, GHTK webhook): verify chữ ký/token `hash_equals`, khớp số tiền, idempotent.
- Đổi trạng thái đơn: luôn qua `OrderStateTransitionService`. Kho: qua `OrderStockService`. Trong `DB::transaction` + `lockForUpdate`.
- Endpoint mock/test: bọc `if (! app()->isProduction())` + guard trong controller.
- Upload: whitelist `mimes:jpg,jpeg,png,webp,gif` (KHÔNG dùng rule `image` — cho phép SVG/XSS).
- SQL thô: nháy đơn cho chuỗi (`'completed'`), bind tham số.
- Không bao giờ tạo route migration/artisan công khai không xác thực.

## ⚡ R4 — Chất lượng trước khi kết thúc

- Lint file PHP đã sửa: `php -l <file>` (PHP tại `d:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe`).
- Thêm/không phá Feature test trong `tests/Feature/`.
- Chuỗi hiển thị mới: thêm đủ 3 ngôn ngữ `lang/{vi,en,ko}`.
- API trả qua `ApiResponse::success()/error()`.

## ⚡ R5 — Việc KHÔNG tự làm (hỏi người dùng)

- Chạy `deploy.py` / deploy production.
- `git push`, tạo PR, đẩy lên GitHub.
- Xoá dữ liệu/bảng, `migrate:fresh` trên môi trường có dữ liệu thật.
- Đổi khoá/secret, cấu hình cổng thanh toán thật.

---

## (Tuỳ chọn) Tự động hoá R1 bằng hook

Nếu muốn ép commit tự động mỗi khi phiên dừng, có thể thêm Stop hook trong `.claude/settings.json`.
Mặc định dự án để R1 là quy tắc thủ công (an toàn hơn, tránh commit nửa vời). Yêu cầu nếu muốn bật hook.
