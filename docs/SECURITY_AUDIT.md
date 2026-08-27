# Báo cáo Audit Bảo mật & Chất lượng Code

> Phạm vi: toàn bộ backend Laravel `ecommere-core` (app, routes, database, deploy).
> Ngày: 2026-07-26. Phương pháp: đọc call-graph (codegraph) + review thủ công các luồng nhạy cảm.
> Ưu tiên xử lý theo thứ tự CRITICAL → HIGH → MEDIUM → LOW.

---

## Tóm tắt điều hành

| # | Mức độ | Vấn đề | File |
|---|--------|--------|------|
| 1 | 🔴 CRITICAL | Bypass thanh toán qua endpoint mock VNPAY công khai | [routes/web.php:11](../routes/web.php#L11), [PublicController.php:771](../app/Http/Controllers/Api/PublicController.php#L771) |
| 2 | 🟠 HIGH | `deploy.py`: FTP plaintext + PHP self-exec kích hoạt qua URL public không xác thực | [deploy.py](../deploy.py) |
| 3 | 🟡 MEDIUM | Rule `image` cho phép SVG → stored XSS khi lưu local | [UserRequest.php:29](../app/Http/Requests/Admin/UserRequest.php#L29) và các *Request khác |
| 4 | 🟡 MEDIUM | Lộ tồn tại tài khoản (user enumeration) ở forgot-password & admin login | [PublicAuthController.php:108](../app/Http/Controllers/Api/PublicAuthController.php#L108), [AuthController.php:21](../app/Http/Controllers/Api/AuthController.php#L21) |
| 5 | 🟡 MEDIUM | `EnsureUserIsAdmin` coi mọi `role_id != null` là admin | [EnsureUserIsAdmin.php:19](../app/Http/Middleware/EnsureUserIsAdmin.php#L19) |
| 6 | 🔵 LOW | SQL dùng nháy kép `"completed"` → vỡ dưới ANSI_QUOTES | [DashboardController.php:115](../app/Http/Controllers/Admin/DashboardController.php#L115) |
| 7 | 🔵 LOW | `JwtService` là dead code (dự án dùng Sanctum) | [JwtService.php](../app/Support/JwtService.php) |
| 8 | 🔵 LOW | Guest review chỉ cần biết email người đã mua | [PublicController.php:581](../app/Http/Controllers/Api/PublicController.php#L581) |
| 9 | 🔵 LOW | Commit nhầm artifact deploy (`.deploy_timestamp`, `.pyc`) | git tree |

**Điểm tốt đã ghi nhận** (không cần sửa): tiền lưu `decimal(15,2)` nhất quán; checkout bọc `DB::transaction` + `lockForUpdate` chống race/oversell; IPN VNPAY verify chữ ký HMAC-SHA512 + `hash_equals` + kiểm tra khớp số tiền + idempotent (`wasRecentlyCreated`); webhook GHTK verify token bằng `hash_equals`; mật khẩu hash bằng bcrypt; settings nhạy cảm mã hoá qua cast `EncryptedJson`; rate limiter đầy đủ cho các route public; `.env` đã nằm trong `.gitignore`.

---

## 1. 🔴 CRITICAL — Bypass thanh toán qua mock VNPAY

**File:** [routes/web.php:10-11](../routes/web.php#L10-L11), [PublicController.php:771-837](../app/Http/Controllers/Api/PublicController.php#L771-L837)

Hai route mock được đăng ký **vô điều kiện** và **không có auth**:

```php
Route::post('/payment/vnpay/mock/submit', [PublicController::class, 'vnpayMockSubmit'])->name('vnpay.mock.submit');
```

Trong `vnpayMockSubmit()`, server **tự đọc `hash_secret` thật** của cấu hình VNPAY rồi **tự ký** một chữ ký HMAC hợp lệ, sau đó gọi thẳng `vnpayIpn()`:

```php
$hashSecret = $settings['hash_secret'] ?? 'mock';
...
$ipnParams['vnp_SecureHash'] = hash_hmac('sha512', $hashData, $hashSecret);
$ipnRequest = Request::create(route('api.payment.vnpay.ipn'), 'GET', $ipnParams);
$this->vnpayIpn($ipnRequest); // → đánh dấu đơn 'paid'
```

**Kịch bản khai thác:** khách đặt đơn VNPAY (biết `order_number` và `grand_total` từ response checkout) → gửi `POST /payment/vnpay/mock/submit` với `status=success`, `amount=grand_total` → server sinh chữ ký hợp lệ → IPN đánh dấu đơn **đã thanh toán mà không hề trả tiền**. Việc kiểm tra khớp số tiền trong IPN **không chặn được** vì attacker tự đặt đúng `amount`. Lỗ hổng tồn tại **ngay cả khi đang chạy VNPAY thật** (không phải mock), vì endpoint dùng bất kỳ `hash_secret` nào đang cấu hình.

**Cách khắc phục (chọn 1, khuyến nghị cả 2):**
1. Chỉ đăng ký/route cho phép khi không phải production **và** khi `tmn_code === 'mock'`:
   ```php
   public function vnpayMockSubmit(Request $request) {
       $pm = PaymentMethod::where('method_code','vnpay')->firstOrFail();
       abort_unless(($pm->settings['tmn_code'] ?? null) === 'mock' && ! app()->isProduction(), 404);
       ...
   }
   ```
2. Bọc cả 2 route trong `if (! app()->isProduction())` ở `web.php`.

---

## 2. 🟠 HIGH — Rủi ro trong quy trình deploy (`deploy.py`)

**File:** [deploy.py](../deploy.py)

- **FTP plaintext** (`ftplib.FTP`, cổng 21, không TLS) — credential và toàn bộ source truyền không mã hoá. Nên chuyển sang **SFTP** (paramiko) hoặc **FTPS** (`ftplib.FTP_TLS`).
- **Remote code execution có chủ đích, không xác thực:** script upload file PHP (`unzip.php`, `artisan_trigger.php`) vào web root, chạy `shell_exec("... artisan migrate/db:seed ...")`, và **kích hoạt bằng một URL HTTP public** (`trigger_http_url`). Trong khoảng thời gian file tồn tại, **bất kỳ ai** truy cập URL đó đều chạy được migrate/seed. Dù có `@unlink(__FILE__)` tự huỷ, vẫn có cửa sổ chạy đua (và fail giữa chừng để lại file). Nên: thêm token bí mật bắt buộc trong query trước khi thực thi; hoặc dùng SSH chạy artisan trực tiếp thay vì đặt script trong webroot.
- `ssl._create_unverified_context()` tắt xác thực chứng chỉ — dễ bị MITM. Chỉ dùng khi thực sự cần, nêu rõ lý do.
- Artifact deploy bị commit: `.deploy_timestamp`, `__pycache__/deploy.cpython-314.pyc`. Thêm vào `.gitignore`.

---

## 3. 🟡 MEDIUM — Rule `image` cho phép SVG (stored XSS)

**File:** [UserRequest.php:29](../app/Http/Requests/Admin/UserRequest.php#L29), [CategoryRequest.php:40](../app/Http/Requests/Admin/Catalog/CategoryRequest.php#L40), [BrandRequest.php:24](../app/Http/Requests/Admin/Catalog/BrandRequest.php#L24), [ProductRequest.php:31](../app/Http/Requests/Admin/Catalog/ProductRequest.php#L31)

Rule Laravel `image` chấp nhận cả **SVG**. Khi Cloudinary chưa cấu hình, [CloudinaryService::uploadFile](../app/Services/CloudinaryService.php#L43) fallback lưu file vào disk `public` và trả URL trực tiếp. Một SVG chứa `<script>` khi mở trực tiếp trên cùng domain có thể chạy JS (stored XSS). Khắc phục: thay `image` bằng whitelist rõ ràng:
```php
'avatar_file' => ['nullable','file','mimes:jpg,jpeg,png,webp,gif','max:2048'],
```

---

## 4. 🟡 MEDIUM — Lộ tồn tại tài khoản (user enumeration)

- [PublicAuthController::forgotPassword](../app/Http/Controllers/Api/PublicAuthController.php#L108) dùng `exists:users,email` → phản hồi khác nhau cho email tồn tại/không tồn tại. Nên **luôn trả về thông báo thành công** bất kể email có tồn tại hay không.
- [AuthController::login](../app/Http/Controllers/Api/AuthController.php#L21-L44) (admin) trả về message riêng cho "email không tồn tại" vs "sai mật khẩu". Nên gộp thành một thông báo chung. (Login khách ở PublicAuthController đã làm đúng — thông báo chung.)

Rủi ro thấp nhưng giúp kẻ tấn công dò danh sách tài khoản để brute-force có mục tiêu.

---

## 5. 🟡 MEDIUM — Kiểm tra quyền admin quá thô

**File:** [EnsureUserIsAdmin.php:19](../app/Http/Middleware/EnsureUserIsAdmin.php#L19)

`role_id === null` là ranh giới duy nhất giữa khách và admin — **mọi** user có `role_id` khác null đều vào được panel. Phân quyền thật dựa vào middleware `feature:*` / permission ở từng route. Đây là bất biến cần được ghi rõ và bảo đảm: **mọi route admin nhạy cảm phải có lớp phân quyền riêng**, không chỉ dựa vào `admin`. Rà soát `routes/admin.php` để chắc chắn không có route nào chỉ được bảo vệ bởi mỗi middleware `admin`.

---

## 6. 🔵 LOW — SQL nháy kép không chuẩn (portability/correctness)

**File:** [DashboardController.php:115](../app/Http/Controllers/Admin/DashboardController.php#L115)

```php
DB::raw('SUM(CASE WHEN status = "completed" THEN grand_total ELSE 0 END) as revenue')
```

Nháy kép `"completed"` trong SQL chuẩn (và MySQL chế độ `ANSI_QUOTES`, PostgreSQL) là **định danh cột**, không phải chuỗi → truy vấn sẽ lỗi/sai khi đổi DB hoặc bật ANSI_QUOTES. [CustomerController.php:22-23](../app/Http/Controllers/Admin/CustomerController.php#L22-L23) đã dùng nháy đơn đúng chuẩn. Sửa DashboardController dùng nháy đơn `'completed'` cho đồng nhất và an toàn.

---

## 7. 🔵 LOW — `JwtService` là code chết

**File:** [JwtService.php](../app/Support/JwtService.php)

Codegraph xác nhận không nơi nào trong app gọi `JwtService` (auth dùng Laravel Sanctum). Class tự ký JWT HS256 bằng `app.key` và `catch (\Exception)` nuốt mọi lỗi. Nên **xoá** để tránh bị dùng nhầm về sau. Nếu muốn giữ, cần test và tài liệu rõ mục đích.

---

## 8. 🔵 LOW — Guest review dựa trên email người mua

**File:** [PublicController::storeReview:581-589](../app/Http/Controllers/Api/PublicController.php#L581-L589)

Khách chưa đăng nhập chỉ cần cung cấp email trùng với email đã từng đặt đơn sản phẩm đó là gửi được review dưới danh nghĩa người khác. Cân nhắc yêu cầu đăng nhập cho review, hoặc xác thực email trước khi cho đăng.

---

## Phụ lục — Nợ kỹ thuật & khuyến nghị dài hạn

- **Số học tiền tệ:** cột `decimal(15,2)` là đúng, nhưng tính toán trong PHP dùng `float` (`$price * $quantity`). Với volume lớn nên cân nhắc `bcmath` hoặc lưu theo đơn vị nhỏ nhất (integer) để tránh sai số làm tròn khi cộng dồn khuyến mãi/voucher.
- **Aggregate theo `LOWER(email)`** trong CustomerController/DashboardController (`whereRaw`, `groupBy(DB::raw('LOWER(...)'))`) sẽ không dùng được index → chậm khi bảng orders lớn. Cân nhắc chuẩn hoá email về lowercase khi ghi, hoặc thêm functional index.
- **Test coverage** hiện khá tốt (37 feature test gồm cả `SecurityHardeningTest`, `WebhookTest`, `OrderLifecycleTest`). Khi sửa các mục trên, bổ sung test hồi quy — đặc biệt một test khẳng định endpoint mock VNPAY bị chặn ở production.
