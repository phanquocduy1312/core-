# UI/UX Builder: hợp đồng nháp và công khai

Cập nhật 08/09/2026.

- Nghiệp vụ lưu nháp không được sửa `published_html`/`published_css`, kể cả Header/Footer dùng chung. Dự án GrapesJS lưu theo locale; phần `_draft` trong dự án chứa HTML/CSS nháp đã lọc. Chỉ xuất bản mới thay snapshot công khai và bỏ `_draft` khỏi dự án đã xuất bản.
- Chuẩn hóa dữ liệu legacy `{version, locales: {...}}` ở service. Không coi danh sách component rỗng là thiếu dự án, vì người dùng có thể cố ý xóa hết nội dung.
- Lưu metadata của trang đã có không được nhận/ghi đè dữ liệu thiết kế ẩn từ editor cũ. Ngôn ngữ không hợp lệ phải bị từ chối thay vì âm thầm ghi tiếng Việt.
- Header/Footer theo lựa chọn none/custom/site default. Shortcut editor và public phải thống nhất phần được chọn; CSS của phần dùng chung là một phần kết quả render.
- Các URL website chính đọc snapshot CMS khi có trang và tính năng bật. Nội dung động được render mới; không giữ cache toàn bộ HTML khiến dữ liệu nguồn và phần dùng chung bị cũ.
- Builder tải không lỗi chưa chứng minh runtime công khai của theme nhập hoạt động. Tài nguyên WordPress/Elementor, menu, slider và form cần kiểm thử riêng. Xem [báo cáo ngày 08/09/2026](../uiux-builder/BAO-CAO-KIEM-THU.md) về các lỗi runtime còn mở.
- Các phép thử sửa/xuất bản phải dùng DB tạm; giả lập Media không thay thế kiểm tra Cloudinary thật.

Hướng dẫn biên tập có ảnh: [UI/UX Builder](../uiux-builder/HUONG-DAN-SU-DUNG.md).
