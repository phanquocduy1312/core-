# Báo cáo kiểm tra UI/UX Builder — 08/09/2026

**Kết luận: các hồi quy Builder được bổ sung đã đạt; chưa đủ điều kiện kết luận toàn bộ website hết lỗi.** Kiểm tra trình duyệt phát hiện lỗi JavaScript còn tồn tại ở giao diện công khai dùng theme nhập. Không dùng số lượng test đạt để bỏ qua các lỗi này.

## Môi trường và bằng chứng

- Laravel chạy cùng mã nguồn workspace, SQLite tạm chứa bản sao 7 trang CMS; tài khoản kiểm thử riêng, Chromium headless.
- Các thao tác lưu/xuất bản chỉ ghi vào cơ sở dữ liệu kiểm thử. Không xuất bản nội dung thử nghiệm lên dữ liệu thật.
- [Hướng dẫn sử dụng](HUONG-DAN-SU-DUNG.md): 16 ảnh chụp trực tiếp giao diện, có ảnh desktop/tablet/mobile, Media, Header/Footer và trang công khai.
- [Kết quả 12 bài kiểm thử Chromium](evidence/browser-tests.txt).
- [Kết quả tải 7 Builder và 5 URL công khai, kèm lỗi JavaScript](evidence/browser-pages.json).

## Kết quả kiểm thử

| Phạm vi | Kết quả | Giới hạn |
| --- | --- | --- |
| Toàn bộ Laravel `php artisan test` | 383 passed, 1913 assertions | Môi trường test; không thay thế kiểm thử dịch vụ bên ngoài. |
| Chromium `python3 tests/Browser/uiux_builder.py` | 12/12 passed, 20,660 giây | Chạy với máy chủ và phiên đăng nhập localhost tạm. |
| 7 trang Builder: 5 trang nội dung + Header/Footer | HTTP 200, không ghi nhận pageerror lúc tải, có cây phần tử | Không phải kiểm tra mọi thao tác trên từng phần tử nhập sẵn. |
| Thư viện 37 khối | Kiểm tra thêm và tuần tự hóa dữ liệu | Chưa xác nhận mọi tổ hợp cấu hình và mọi nguồn dữ liệu động. |
| 5 URL công khai chính | HTTP 200, có nội dung; còn lỗi JavaScript | Chưa đạt nghiệm thu chức năng tương tác của theme. |
| Media | Kiểm tra tải một lần, thông báo thất bại, phân trang và thay ảnh | API được giả lập; chưa tải thật lên Cloudinary. |

12 bài Chromium bao phủ: thiết bị và cấu hình breakpoint; dự án rỗng; dự án legacy; thêm 37 khối; sửa trực tiếp 4 loại chữ; đổi thẻ Heading; sửa/lưu/mở lại chữ; xuất bản xóa trạng thái chưa lưu; di chuyển cột và giữ bố cục khi sửa gap; upload không lặp và không báo thành công giả; tải trang ảnh tiếp theo; thay ảnh bỏ nguồn responsive/lazy cũ. Chi tiết tên bài trong bằng chứng đính kèm.

## Lỗi đã sửa trong đợt này

| Nhóm | Trước sửa | Kết quả đã kiểm tra |
| --- | --- | --- |
| Nháp / xuất bản | Lưu nháp có thể thay nội dung công khai | Nháp lưu riêng trong JSON của ngôn ngữ; public giữ bản xuất bản. |
| Dữ liệu editor | Dự án rỗng/legacy có thể bị nạp sai | Phân biệt dự án rỗng hợp lệ và hỗ trợ cấu trúc legacy. |
| Ngôn ngữ / metadata | Có nguy cơ rơi về ngôn ngữ mặc định hoặc ghi đè thiết kế khi sửa thông tin | Từ chối locale không hợp lệ, giữ dự án/ngôn ngữ khác khi lưu metadata. |
| Trang chính | URL website dùng Blade tĩnh nên không phản ánh nội dung Builder | Controller dùng trang CMS khi có và tính năng bật; fallback khi không có. |
| Phần dùng chung | Shortcut có thể mở sai Header/Footer; CSS chưa đi kèm | Theo lựa chọn trang, đưa CSS của phần dùng chung vào kết quả render. |
| Chữ và khối | Một số loại chữ không sửa trực tiếp, thẻ Heading không đổi thật, khối động thiếu nội dung | Kế thừa loại text/link phù hợp, sửa trait và gọi factory của khối động. |
| Thiết bị / cột | Sai tên cấu hình device manager, selector cột sai, sửa gap mất kiểu dáng | Đúng khung Mobile 375px/Tablet 768px, sửa cấu trúc kéo thả và giữ style cũ. |
| Media | Drop có thể tải hai lần, lỗi vẫn báo thành công, chỉ thấy trang đầu, ảnh cũ thắng src mới | Chặn sự kiện lặp, đếm lỗi, phân trang, xóa thuộc tính nguồn ảnh cũ. |
| An toàn preview / khối | Preview và thuộc tính căn lề có đường chèn nội dung không an toàn | Dùng sanitizer, kiểm tra chủ preview, allowlist căn lề; có hồi quy. |
| Dấu chưa lưu | Sau xuất bản vẫn có thể còn trạng thái dirty | Reset sau xuất bản thành công. |

## Lỗi còn tồn tại — cần xử lý trước khi nghiệm thu toàn bộ

**P1 — Runtime của theme nhập trên trang công khai.** Chromium ghi nhận các nhóm lỗi: `Unexpected token ':'`, `$ is not a function`, thiếu `script#wp-emoji-settings`, truy cập phần tử null và lỗi tải chunk Elementor. Có lỗi ở cả `/`, `/gioi-thieu`, `/thuong-hieu`, `/du-an`, `/lien-he`; số lỗi lặp tùy widget (không phải số nguyên nhân độc lập).

Ví dụ đường dẫn chunk bị lỗi:

- `/wp-content/plugins/elementor/assets/js/section-frontend-handlers.d85ab872da118940910d.bundle.min.js`
- `/wp-content/plugins/elementor/assets/js/shared-frontend-handlers.03caa53373b56d3bab67.bundle.min.js`

Tác động: menu, slider, hiệu ứng hoặc biểu mẫu có thể không khởi tạo đầy đủ dù nội dung tĩnh nhìn đúng. Bằng chứng được giữ nguyên trong `browser-pages.json`. Chưa xác định và sửa đầy đủ nguyên nhân trong đợt này; cần rà bản asset nhập, thứ tự nạp script và phụ thuộc WordPress/Elementor, rồi chạy lại thao tác công khai. Không che lỗi bằng cách bỏ listener hoặc chỉ tắt console.

**P2 — Tích hợp bên ngoài và kiểm thử tương tác còn thiếu.** Chưa kiểm chứng upload Cloudinary thật, gửi biểu mẫu/mail, các tổ hợp dữ liệu động, chỉnh sửa đồng thời, mọi trình duyệt và thiết bị vật lý. HTML biểu mẫu nhập không bảo đảm đã nối backend Laravel. Cần kiểm thử với dữ liệu và tài khoản được cấp cho từng tích hợp.

**P2 — Độ tương đồng hình ảnh.** Đã quan sát ảnh Builder và công khai, nhưng chưa có kiểm thử so sánh pixel cho tất cả trang/kích thước. Chọn chế độ Mobile không tự bảo đảm mọi bố cục nhập có CSS responsive đúng.

## Chạy lại

```bash
php artisan test
UIUX_BASE_URL=http://127.0.0.1:8765 UIUX_AUTH=/duong-dan/session-thu.json UIUX_PAGE_ID=2 python3 tests/Browser/uiux_builder.py
```

Bài Chromium cần Playwright/Chromium, máy chủ local dùng DB dùng một lần và storage state của tài khoản có quyền quản lý trang/Media. Bộ test cố ý từ chối hostname ngoài localhost, nhưng người chạy vẫn phải bảo đảm localhost không kết nối DB thật. Test có sửa/xuất bản nội dung trang thử; không dùng trực tiếp với dữ liệu thật. Phiên đăng nhập và cơ sở dữ liệu tạm không được đưa vào repository.
