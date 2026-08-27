---
name: deploy_laravel_ftp
description: Quy trình triển khai (deploy) dự án Laravel lên hosting qua FTP/FTPS bằng công cụ deploy.py, đồng bộ gia tăng và kích hoạt remote có token bảo mật.
---

# Quy Trình Triển Khai Laravel Qua FTP/FTPS (dùng `deploy.py`)

> Công cụ chính là script **`deploy.py`** ở gốc dự án. Nó đã được harden bảo mật
> (xem [docs/SECURITY_AUDIT.md](../../../docs/SECURITY_AUDIT.md) mục 2). Ưu tiên chạy tool
> này thay vì tự thao tác FTP thủ công. KHÔNG khởi tạo migration bằng route công khai.

---

## ⚠️ Nguyên tắc bảo mật bắt buộc

1. **KHÔNG bao giờ** thêm route kiểu `/run-migrations-remote` không xác thực vào `routes/web.php`.
   Migration remote chạy qua script PHP tạm có **token bí mật** (`deploy.py` tự sinh và tự huỷ file).
2. Mọi script kích hoạt remote (`unzip.php`, `artisan_trigger.php`) **phải** yêu cầu `?token=<secret>`
   và tự `@unlink` sau khi chạy. `deploy.py` đã làm sẵn — đừng gỡ cơ chế này.
3. Ưu tiên **FTPS** (kênh mã hoá). Chỉ fallback FTP trần khi hosting không hỗ trợ TLS và người dùng xác nhận.
4. Credential FTP/DB nằm trong `.env` (đã gitignore). Không hardcode, không commit.

---

## 📋 BƯỚC 1: Thu thập thông tin & kiểm tra kết nối

1. Yêu cầu người dùng cung cấp (ghi vào `.env`, KHÔNG commit):
   - `FTP_HOST`, `FTP_USER`, `FTP_PASS`, `FTP_REMOTE_DIR` (mặc định `httpdocs/backend`).
   - `APP_URL` (domain chạy thật).
   - Thông tin DB của host: `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
2. `deploy.py` sẽ tự thử **FTPS trước, FTP sau**. Nếu đăng nhập lỗi → dừng, báo người dùng kiểm tra
   credential; **không** thực hiện tiếp các bước sau.
3. Nếu mật khẩu DB chứa `#` hoặc khoảng trắng → bọc trong nháy kép: `DB_PASSWORD="pass#123"`.

---

## 🛠️ BƯỚC 2: Chuẩn bị môi trường host

1. Nâng PHP của tên miền lên **>= 8.2** (Laravel 11) trên Plesk/cPanel/DirectAdmin.
   **Dừng chờ xác nhận** trước khi migrate/seed.
2. Bật extension cần thiết: `ZipArchive` (để giải nén), `pdo_mysql`, `mbstring`, `openssl`.

---

## 📦 BƯỚC 3: Chạy deploy

Chạy: `python deploy.py` và chọn chế độ:

### Chế độ 1 — Full Deploy (ZIP)
- Nén dự án thành `deploy.zip`. **Loại trừ:** `.git`, `.github`, `.idea`, `.vscode`,
  `node_modules`, `tests`, `storage/logs/*`, `storage/framework/{cache,sessions,views}/*`, `bootstrap/cache/*`.
- **Bao gồm:** `resources/views` và `vendor` (host shared thường không chạy được `composer install`).
- Upload `deploy.zip` + `unzip.php` (đã gắn token) → trigger qua URL kèm `?token=...` → giải nén → tạo
  symlink `public/storage` → (tuỳ chọn) migrate/seed → script tự huỷ.

### Chế độ 2 — Incremental Deploy (đồng bộ gia tăng)
- Trạng thái lần deploy trước lưu ở **`.deploy_timestamp`** (local, đã gitignore).
- `deploy.py` so sánh `mtime` từng file với timestamp đó, chỉ upload file mới/đổi (bỏ qua `vendor`).
- Nếu cần migrate/seed → upload `artisan_trigger.php` (có token) → trigger → tự huỷ.

> Lưu ý: state file là `.deploy_timestamp` (mtime-based), KHÔNG phải `.datachange.json`.

---

## 🗄️ BƯỚC 4: Migration & Seed (an toàn)

- Khi được hỏi trong `deploy.py`, chọn chạy `migrate --force` và/hoặc seed.
- Cơ chế: script `artisan_trigger.php` chạy `php artisan migrate --force` qua `shell_exec`, **chỉ khi**
  request kèm đúng token, rồi tự xoá file. Không có endpoint migration nào tồn tại lâu dài.
- Seed lần đầu để tạo Superadmin: chọn "Seed toàn bộ" (`DatabaseSeeder`).

---

## 🌐 BƯỚC 5: Trỏ Document Root & kiểm tra

1. Trỏ **Website at / Document Root** vào thư mục con `public/` (vd `httpdocs/backend/public`),
   KHÔNG trỏ vào thư mục gốc.
2. Kiểm tra: trang tải OK, không lỗi 500, tiếng Việt hiển thị đúng, `/up` (health) trả 200.

---

## 🔒 BƯỚC 6: Dọn dẹp & xác nhận bảo mật

`deploy.py` tự dọn phần lớn, nhưng Agent phải xác nhận:
1. `deploy.zip`, `unzip.php`, `artisan_trigger.php` **đã bị xoá** khỏi host (script tự `@unlink`; kiểm tra lại qua FTP).
2. `routes/web.php` **không** còn route tạm nào (nếu ai đó lỡ thêm — gỡ ngay, đây là lỗ hổng).
3. `APP_DEBUG=false` và `APP_ENV=production` trên host.
4. File `.env` trên host không lộ (Document Root trỏ vào `public/` nên `.env` nằm ngoài web root — đúng).

---

## ✅ Checklist nhanh trước khi báo hoàn tất
- [ ] Kết nối dùng FTPS (hoặc user đã chấp nhận FTP trần).
- [ ] Không có route/endpoint migration công khai nào còn sống.
- [ ] Script trigger đã tự huỷ, không còn file cài đặt tạm trên host.
- [ ] `APP_DEBUG=false`, Document Root trỏ `public/`.
- [ ] Trang chủ + health check hoạt động.
