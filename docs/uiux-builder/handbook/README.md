# Sổ tay PDF UI/UX Builder cho người mới

- [Mở PDF hướng dẫn](HUONG-DAN-UIUX-BUILDER.pdf): 40 trang A4, mục lục bấm được, giải thích thao tác và đủ 38 khối của giao diện được khảo sát ngày 09/09/2026.
- [Bản HTML để đọc và cập nhật](index.html): đi kèm thư mục `images/`, có thể mở trực tiếp bằng trình duyệt.
- [Danh sách các trang](contents.json).
- [Kết quả kiểm tra PDF](pdf-checks.json): 40 trang, 25 ảnh nhúng, 37 liên kết mục lục, đối chiếu không mất chữ.
- [Kế hoạch thực hiện](../../superpowers/plans/2026-09-09-uiux-builder-pdf.md).

## In lại

Máy cần Python, Playwright và Chromium tương thích. Sau khi sửa `index.html`:

```bash
python3 docs/uiux-builder/handbook/render_pdf.py
pdfinfo docs/uiux-builder/handbook/HUONG-DAN-UIUX-BUILDER.pdf
```

Script kiểm tra ảnh tải đủ và nội dung không đụng chân trang trước khi tạo PDF. `verification.json` ghi kết quả theo từng trang. Kiểm tra hình ảnh bản PDF sau khi đổi bố cục; không chỉ dựa vào phép đo HTML.

## Nguồn ảnh và giới hạn

Ảnh mới chụp ngày 09/09/2026 bằng Chromium từ Laravel localhost `127.0.0.1:8765`, dùng mã nguồn workspace hiện tại và SQLite kiểm thử riêng tại `/tmp/uiux-audit/database.sqlite`. Bản sao CMS dùng cho minh họa có từ 08/09/2026, không phải danh sách dữ liệu production hiện thời. Các khối bổ sung chỉ thêm trong bộ nhớ trình duyệt để minh họa thuộc tính; không lưu/xuất bản chúng. Hộp xuất bản được mở rồi hủy.

Các ảnh `*-bang.png` và ảnh nhóm khối là ảnh chụp vùng giao diện để đọc rõ hơn, không phải giao diện dựng lại. Không đưa tài khoản/mật khẩu/cookie vào tài liệu. Thư viện Media kiểm thử trống; không thực hiện upload Cloudinary hoặc gửi mail thật. Trang công khai kiểm thử còn lỗi runtime theme nhập; xem [báo cáo hiện có](../BAO-CAO-KIEM-THU.md).

Tài liệu chỉ thay đổi file trong `docs/`, không sửa ứng dụng. Các kiểm tra của phiên này là chất lượng PDF và đối chiếu chức năng hiện có, không phải chạy lại toàn bộ kiểm thử sản phẩm.
