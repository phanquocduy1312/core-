# Quy ước code & dữ liệu (Conventions)

## Tiền tệ
- Cột DB luôn `decimal(15,2)`, cast `decimal:2`. KHÔNG dùng float trong migration.
- Tính toán trong PHP hiện dùng float — chấp nhận được, nhưng khi cộng dồn nhiều KM/voucher cân nhắc bcmath (xem [decisions.md](decisions.md)).
- Số tiền so khớp thanh toán: ép int, không tin client.

## Đa ngôn ngữ (i18n)
- Chuỗi UI đặt trong `lang/{vi,en,ko}/*.php`, gọi `__('namespace.key')`. Thêm key phải đủ **cả 3 ngôn ngữ**.
- Trường nội dung đa ngữ trên model (name/description...) dùng **Spatie Translatable** (`$translatable`), lưu JSON theo locale.
- Route web admin luôn có prefix `{locale}` (`vi`/`en`/`ko`); locale mặc định `vi`. API public không prefix locale.

## API response
- Luôn trả qua `ApiResponse::success($data, $message, $meta)` / `ApiResponse::error($message, $status, $errors)`.
- Cấu trúc: `{ success, message, data, meta }` hoặc `{ success, message, errors }`.

## Validation & Request
- Dùng Form Request (`app/Http/Requests/**`) cho admin; `Validator::make` cho một số API public.
- `$fillable` khai báo tường minh trên model (KHÔNG `$guarded=[]`). Không đưa cột nhạy cảm vào fillable nếu client không được set.
- Upload ảnh: `['nullable','file','mimes:jpg,jpeg,png,webp,gif','max:<kb>']` — KHÔNG dùng rule `image` (cho phép SVG).

## Bảo mật dữ liệu
- Settings nhạy cảm (khoá VNPAY, SMTP...) cast **`EncryptedJson`** (mã hoá at-rest).
- `.env` gitignore; đọc secret qua `config()`/`env()`. Không hardcode, không commit.
- SQL thô: nháy đơn cho chuỗi (`'completed'`), bind tham số. Ưu tiên query builder.

## Cấu trúc & routing
- Bootstrap kiểu Laravel 11 ở `bootstrap/app.php` (không có `Http/Kernel.php`). Alias middleware khai báo ở đó: `admin`, `superadmin`, `feature`, `setLocale`...
- Controller mỏng → gọi Service (`app/Services/**`). Nghiệp vụ đơn/kho/thanh toán/KM nằm ở Service.
- Rate limiter đặt tên trong `AppServiceProvider` (`public-checkout`, `public-auth`, `webhook`, `admin-login`...).

## Migration
- Không sửa migration đã chạy — tạo migration mới. Thêm index cho cột lọc/sort/FK.

## Test
- Feature test trong `tests/Feature/**` (dùng `RefreshDatabase`). Chạy: `php artisan test` (PHP tại `d:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe`).
- Mỗi tính năng/sửa lỗi kèm test; lỗi bảo mật đã vá kèm test hồi quy.
