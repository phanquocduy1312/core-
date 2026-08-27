# Ecommerce Admin Core (Nhân Quản Trị E-commerce)

Nhân quản trị (Admin Core) xây dựng trên Laravel 12 cho danh mục sản phẩm, đơn hàng, kho hàng, thanh toán, cấu hình vận chuyển, CMS và các tích hợp tùy chỉnh. Giao diện storefront cho khách hàng cố tình không đi kèm ở đây; các dự án khác có thể tiêu thụ API công khai (Public API) hoặc tự phát triển giao diện frontend riêng.

---

## 🤖 Hướng Dẫn Bắt Buộc Dành Cho AI Agent

Nếu bạn là một AI Agent mới nhận nhiệm vụ trong repository này, hãy tuân thủ nghiêm ngặt các quy tắc dưới đây để tránh làm hỏng hệ thống hoặc vi phạm chính sách bảo mật:

### 1. Tài liệu hướng dẫn cốt lõi
*   **ĐỌC ĐẦU TIÊN**: Đọc file [AGENTS.md](AGENTS.md) và [.agents/RULES.md](.agents/RULES.md) để nắm rõ luồng làm việc, tài khoản hệ thống và các quy tắc đặc thù.
*   **Kho tri thức nghiệp vụ**: Xem [docs/README.md](docs/README.md) để tra cứu tài liệu chi tiết về mô hình dữ liệu, tích hợp và quy ước.

### 2. Quy tắc Git local (Bắt buộc)
*   **Chỉ commit local**: Sau mỗi phiên làm việc có thay đổi code, hãy tạo commit local để ghi nhận công việc.
*   **KHÔNG PUSH**: Tuyệt đối **không** được tự động chạy `git push` lên remote (GitHub/GitLab) trừ khi được người dùng yêu cầu rõ ràng.

### 3. Bất biến kiến trúc & nghiệp vụ
*   **Tiền tệ**: Mọi trường lưu trữ tiền tệ trong cơ sở dữ liệu phải dùng kiểu dữ liệu `decimal(15,2)`.
*   **Trạng thái đơn hàng**: Mọi hành động chuyển đổi trạng thái đơn hàng phải thông qua máy trạng thái [OrderStateTransitionService](app/Services/OrderStateTransitionService.php).
*   **Tồn kho**: Mọi hoạt động trừ hoặc hoàn kho phải thông qua [OrderStockService](app/Services/OrderStockService.php).
*   **Validate Upload**: Khi xử lý tải tệp tin lên (upload), bắt buộc phải validate MIME loại trừ các tệp độc hại như SVG (tránh stored XSS). Sử dụng whitelist: `mimes:jpg,jpeg,png,webp,gif`. Không sử dụng rule `image` chung chung.
*   **Bảo mật Route Admin**: Các route admin nhạy cảm phải được bảo vệ bằng phân quyền chi tiết (middleware `can:<permission>` hoặc `superadmin`), không chỉ dựa vào middleware `admin` (vì middleware này chỉ kiểm tra xem người dùng có phải là admin chung hay không).
*   **Đồng bộ phản hồi API**: Luôn trả về dữ liệu qua lớp helper [ApiResponse](app/Support/ApiResponse.php).

### 4. Quy trình kiểm thử & kiểm tra code
*   **Lint**: Chạy lint file PHP trước khi kết thúc bằng lệnh `php -l <đường_dẫn_file>`.
*   **Kiểm thử**: Viết Feature test trong `tests/Feature/` cho các tính năng mới hoặc sửa lỗi. Chạy kiểm thử tự động bằng lệnh `php artisan test`.

### 5. Bộ Skill dành cho AI Agent (Agent Skills)
Dự án được cấu hình sẵn một bộ các kỹ năng (skills) và phương pháp phát triển phần mềm trong thư mục [.agents/skills/](.agents/skills/) giúp bạn thực hiện các tác vụ chuẩn xác nhất:

*   **Skill riêng của dự án**:
    *   [add_feature](.agents/skills/add_feature/): Quy trình thêm tính năng/CRUD/API/model mới đúng kiến trúc + bảo mật + i18n.
    *   [security_review](.agents/skills/security_review/): Quy trình rà soát bảo mật trước khi bàn giao, merge hoặc deploy.
    *   [connect-ecommerce-frontend](.agents/skills/connect-ecommerce-frontend/): Hướng dẫn kết nối giao diện storefront tĩnh với hệ thống API Public.
    *   [deploy_laravel_ftp](.agents/skills/deploy_laravel_ftp/): Quy trình deploy an toàn lên máy chủ qua FTP/FTPS bằng `deploy.py`.
    *   [maintain-ecommerce-core](.agents/skills/maintain-ecommerce-core/): Quy trình bảo trì hệ thống và khắc phục lỗi lõi.
*   **Bộ kỹ năng quy trình phần mềm (Superpowers)**:
    *   Hệ thống quy trình tự động và thủ công hỗ trợ các giai đoạn phát triển như: [using-superpowers](.agents/skills/using-superpowers/), [brainstorming](.agents/skills/brainstorming/), [writing-plans](.agents/skills/writing-plans/), [executing-plans](.agents/skills/executing-plans/), [test-driven-development](.agents/skills/test-driven-development/), [systematic-debugging](.agents/skills/systematic-debugging/), [verification-before-completion](.agents/skills/verification-before-completion/).
    *   Các tài liệu/kế hoạch phát sinh từ quy trình này được lưu trữ tập trung tại thư mục [docs/superpowers/](docs/superpowers/).


---

## 📦 Các tính năng đi kèm

*   Phân quyền (Roles & Permissions) dựa trên dữ liệu cấu hình, ghi nhật ký hoạt động (activity logs), và mã hóa các cài đặt nhạy cảm.
*   Sổ cái tồn kho sản phẩm và biến thể với cơ chế trừ/hoàn kho idempotent.
*   Quản lý trạng thái/lịch sử đơn hàng, hoàn tiền một phần, audit giao dịch thanh toán, xử lý VNPAY IPN, và cấu hình tích hợp vận chuyển.
*   Cấu hình tính năng (Feature flags/settings) do bộ phận hỗ trợ (support) kiểm soát. Ứng dụng không áp đặt luồng thanh toán mua gói tính năng hay addon.
*   Giao diện quản trị Blade (dành riêng cho Admin) tại đường dẫn `/{locale}/admin` (mặc định locale: `/vi/admin`).

---

## 🛠 Cài đặt môi trường local

### Yêu cầu hệ thống
*   PHP 8.2+
*   Composer
*   MySQL/MariaDB hoặc SQLite

### Các bước cài đặt nhanh

1.  Cài đặt các gói phụ thuộc qua Composer:
    ```bash
    composer install
    ```
2.  Tạo file cấu hình môi trường từ file ví dụ và thiết lập cơ sở dữ liệu trong `.env`:
    ```bash
    cp .env.example .env
    ```
3.  Tạo khóa ứng dụng (Application Key):
    ```bash
    php artisan key:generate
    ```
4.  Chạy trình cài đặt lõi hệ thống:
    ```bash
    php artisan core:install
    ```
5.  Khởi động server phát triển:
    ```bash
    php artisan serve
    ```

> [!NOTE]
> Lệnh `core:install` sẽ yêu cầu bạn cung cấp tên superadmin ban đầu, email và mật khẩu (tối thiểu 12 ký tự).
> Đối với môi trường CI hoặc cài đặt tự động không cần tương tác (non-interactive), hãy truyền các tham số một cách tường minh:
> ```bash
> php artisan core:install --no-interaction \
>   --admin-name="Operations Admin" \
>   --admin-email="admin@example.com" \
>   --admin-password="use-a-strong-secret"
> ```
> Lệnh này chỉ chạy các tệp `migrate` và lớp seeder idempotent `FoundationSeeder`. Nó **không bao giờ** chạy lệnh `migrate:fresh` và **không tự động** chèn dữ liệu mẫu (catalog/order).

---

## 📊 Dữ liệu mẫu (Demo data)

Dữ liệu mẫu được tách biệt hoàn toàn để tránh rủi ro phá hủy dữ liệu (truncate bảng) do các seeder cũ gây ra. Chỉ chạy lệnh này trên môi trường phát triển local với cơ sở dữ liệu dùng xong bỏ:

```bash
php artisan db:seed --class=Database\\Seeders\\DemoSeeder
```

> [!CAUTION]
> Tuyệt đối không chạy lệnh chèn dữ liệu mẫu đối với cơ sở dữ liệu đang hoạt động thực tế (production database).

---

## 🚀 Triển khai trên môi trường Production

Thiết lập các biến môi trường: `APP_ENV=production`, `APP_DEBUG=false`, tạo một khóa `APP_KEY` ngẫu nhiên và bảo mật, cấu hình kết nối DB chính xác và điền các secret liên quan đến Email/Thanh toán. Sau đó chạy các lệnh sau:

```bash
php artisan core:install --force --no-interaction \
  --admin-name="Operations Admin" \
  --admin-email="admin@example.com" \
  --admin-password="use-a-strong-secret"
php artisan core:check
php artisan optimize
```

*   `core:check` sẽ kiểm tra khóa ứng dụng, kết nối database, schema lõi bắt buộc, tài khoản admin đang hoạt động và cấu hình nền tảng đã được seed. Lệnh này chỉ đọc cấu hình và không thực hiện bất kỳ hành động ghi nào.
*   **Queue**: Các thông báo về đơn hàng, hóa đơn và thông báo cửa hàng được đưa vào hàng đợi. Hãy chạy worker được giám sát trên production (ví dụ: `php artisan queue:work --tries=3`) và duy trì cấu hình `QUEUE_AFTER_COMMIT=true`.
*   **Scheduler**: Thiết lập cron job chạy `php artisan schedule:run` mỗi phút. Hệ thống sẽ quét và vô hiệu hóa các voucher hết hạn hàng ngày vào lúc `00:10`.
*   Cấu hình Document Root của Web Server trỏ thẳng vào thư mục `public/`.

---

## 🧪 Xác minh & Kiểm thử

Chạy bộ kiểm thử tự động và kiểm tra tính hợp lệ của composer:

```bash
php artisan test
php composer.phar validate --no-check-publish
```

*Dự án vẫn giữ các bảng gói/đăng ký cũ (package/subscription tables) nhằm mục đích tương thích ngược dữ liệu cũ, nhưng chúng hoàn toàn không kiểm soát hay chặn các tính năng lõi hoặc addon hiện tại.*
