# Sổ tay PDF UI/UX Builder Implementation Plan

**Goal:** Tạo PDF tiếng Việt có ảnh giao diện thật, hướng dẫn người không biết code sử dụng toàn bộ nhóm chức năng Builder hiện tại.
**Architecture:** Đối chiếu Blade/JavaScript và tài liệu nghiệp vụ, chụp Chromium trên localhost dùng SQLite kiểm thử riêng, biên soạn HTML chia trang rồi in PDF. Chỉ thay tài liệu.
**Tech Stack:** Python, Playwright Chromium, HTML/CSS print, Poppler.
**Spec:** Yêu cầu người dùng ngày 09/09/2026: lập kế hoạch rồi thực hiện ngay; tự chụp giao diện; giải thích chi tiết cho người mới.

## Ràng buộc
- Không sửa dữ liệu production, không triển khai, không đưa phiên đăng nhập vào tài liệu.
- Ảnh mới dùng cùng mã nguồn hiện tại và dữ liệu CMS kiểm thử; ghi rõ nguồn và giới hạn.
- Không khẳng định upload/mail hay mọi tương tác công khai đã được kiểm thử.
- Giữ bản HTML để cập nhật/in lại; mục lục, số trang, ảnh và hướng dẫn tiếng Việt rõ ràng.

## Công việc
- [x] 1. Kiểm kê thanh công cụ, thông tin trang, các khối, thuộc tính và quy trình nháp/xuất bản từ mã nguồn hiện tại.
- [x] 2. Chụp danh sách, tạo trang, Builder, chữ, ảnh, lớp, khối, thiết bị, Header/Footer, khối động và hộp xuất bản bằng Chromium trên localhost.
- [x] 3. Viết sổ tay: bắt đầu nhanh; thao tác từng bước; tra cứu toàn bộ khối; ví dụ thực hành; lỗi thường gặp; checklist bàn giao. Lưu `docs/uiux-builder/handbook/index.html`.
- [x] 4. In `docs/uiux-builder/handbook/HUONG-DAN-UIUX-BUILDER.pdf`, kiểm tra font tiếng Việt, số trang, ảnh tải đủ, bố cục không tràn và render các trang mẫu bằng Poppler.
- [x] 5. Cập nhật index tài liệu và bằng chứng, commit local riêng các file của công việc này.

## Ghi nhận khảo sát
- Không có công cụ/lệnh codegraph_context trong phiên; chỉ đọc các file đã xác định từ tài liệu và IDE, không sửa symbol ứng dụng.
- Có môi trường SQLite kiểm thử riêng ở `/tmp/uiux-audit`; chỉ dùng môi trường này cho ảnh.

## Kết quả xác minh
- PDF: 40 trang A4, 25 ảnh nhúng khác nhau, 37 liên kết mục lục, font tiếng Việt được nhúng.
- Có 35 file ảnh chụp mới (bao gồm ảnh toàn màn hình và ảnh vùng điều khiển); chọn 25 ảnh đưa vào PDF.
- Playwright: mọi ảnh tải đủ, không có phần nội dung tràn chân trang.
- So sánh từ trong HTML với text trích từ từng trang PDF: không mất từ.
- Đã xem bản raster các trang 1, 3, 6, 11, 12, 15, 20, 25, 39; sửa ảnh tab thuộc tính và bố cục checklist trước khi xuất bản cuối.
- Không sửa code ứng dụng, không chạy lại Feature test vì chỉ thay tài liệu.
