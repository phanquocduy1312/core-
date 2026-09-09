# Sổ tay PDF UI/UX Builder

- [Mở PDF hướng dẫn](HUONG-DAN-UIUX-BUILDER.pdf): 24 trang A4, tập trung hoàn toàn vào thao tác trực tiếp trên Builder.
- [Bản HTML để đọc và cập nhật](index.html): đi kèm thư mục `images/`, có thể mở trực tiếp bằng trình duyệt.
- [Ảnh có khoanh số](images/annotated/): 22 ảnh chụp giao diện được chú thích trực tiếp, không có hộp chữ che giao diện.

PDF chỉ giữ các việc biên tập viên cần dùng: chọn phần tử, sửa chữ/ảnh/nút/video, thêm khối, dữ liệu động, kiểm tra thiết bị, lưu nháp, xuất bản và Header/Footer. Hướng dẫn tạo trang mới, SEO và HTML/CSS đã được bỏ khỏi bản này theo yêu cầu.

## In lại

Máy cần Python, Playwright và Chromium tương thích. Sau khi sửa `index.html`:

```bash
python3 docs/uiux-builder/handbook/build_visual_handbook.py
python3 docs/uiux-builder/handbook/render_pdf.py
pdfinfo docs/uiux-builder/handbook/HUONG-DAN-UIUX-BUILDER.pdf
```

`build_visual_handbook.py` thêm vòng tròn đánh số nhỏ lên bản sao của ảnh chụp trong `images/annotated/`; phần diễn giải số nằm dưới ảnh. Script in PDF kiểm tra ảnh tải đủ và nội dung không đụng chân trang trước khi tạo PDF. `verification.json` ghi kết quả theo từng trang.

## Nguồn ảnh và giới hạn

Ảnh mới chụp ngày 09/09/2026 bằng Chromium từ Laravel localhost `127.0.0.1:8765`, dùng mã nguồn workspace hiện tại và SQLite kiểm thử riêng tại `/tmp/uiux-audit/database.sqlite`. Bản sao CMS dùng cho minh họa có từ 08/09/2026, không phải danh sách dữ liệu production hiện thời. Các khối bổ sung chỉ thêm trong bộ nhớ trình duyệt để minh họa thuộc tính; không lưu/xuất bản chúng. Hộp xuất bản được mở rồi hủy.

Các ảnh trong `images/annotated/` là ảnh chụp vùng giao diện để đọc rõ hơn, không phải giao diện dựng lại. Không đưa tài khoản/mật khẩu/cookie vào tài liệu. Thư viện Media kiểm thử trống; không thực hiện upload Cloudinary hoặc gửi mail thật. Trang công khai kiểm thử còn lỗi runtime theme nhập; xem [báo cáo hiện có](../BAO-CAO-KIEM-THU.md).

Tài liệu chỉ thay đổi file trong `docs/`, không sửa ứng dụng. Các kiểm tra của phiên này là chất lượng PDF và đối chiếu chức năng hiện có, không phải chạy lại toàn bộ kiểm thử sản phẩm.
