"""Tạo sổ tay UI/UX Builder tập trung vào thao tác trên giao diện.

Chạy: python3 docs/uiux-builder/handbook/build_visual_handbook.py
Sau đó chạy render_pdf.py để xuất PDF. Ảnh nguồn là ảnh chụp Builder hiện có;
script chỉ thêm vòng tròn đánh số nhỏ lên bản sao trong images/annotated.
"""
from __future__ import annotations

from html import escape
from pathlib import Path

from PIL import Image, ImageDraw, ImageFont


ROOT = Path(__file__).resolve().parent
IMAGES = ROOT / "images"
ANNOTATED = IMAGES / "annotated"
FONT = "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf"
FONT_BOLD = "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf"


def font(size: int, bold: bool = False):
    return ImageFont.truetype(FONT_BOLD if bold else FONT, size)


def annotate(source: str, output: str, callouts: list[tuple[int, tuple[int, int], str, tuple[int, int]]]):
    """Thêm số nhỏ vào đúng vị trí. Diễn giải luôn được in bên dưới ảnh."""
    image = Image.open(IMAGES / source).convert("RGBA")
    draw = ImageDraw.Draw(image, "RGBA")
    scale_x, scale_y = image.width / 1600, image.height / 1000

    def point(pair):
        return int(pair[0] * scale_x), int(pair[1] * scale_y)

    for number, target, _label, _box in callouts:
        tx, ty = point(target)
        # The old large, dark labels hid the exact controls users needed to see.
        # A small number is enough to bind the control to its explanation below.
        radius = max(16, int(24 * min(scale_x, scale_y)))
        draw.ellipse((tx - radius, ty - radius, tx + radius, ty + radius), fill=(226, 53, 53, 255), outline=(255, 255, 255, 255), width=3)
        number_font = font(max(15, int(24 * min(scale_x, scale_y))), True)
        number_box = draw.textbbox((0, 0), str(number), font=number_font)
        draw.text((tx - (number_box[2] - number_box[0]) / 2, ty - (number_box[3] - number_box[1]) / 2 - 2), str(number), fill="white", font=number_font)
    image.convert("RGB").save(ANNOTATED / output, quality=93)


def image(name: str, caption: str, steps: list[str]) -> str:
    return (
        f'<figure><img src="images/annotated/{name}"><figcaption>{caption}</figcaption></figure>'
        + '<ol>' + ''.join(f'<li>{item}</li>' for item in steps) + '</ol>'
    )


def page(title: str, content: str):
    PAGES.append((title, content))


PAGES: list[tuple[str, str]] = []


def build_annotations():
    ANNOTATED.mkdir(parents=True, exist_ok=True)
    specs = [
        ("02-tong-quan-builder.png", "01-tong-quan.png", [
            (1, (146, 18), "Tên trang đang sửa", (25, 52)),
            (2, (585, 20), "Lưu nháp", (500, 60)),
            (3, (662, 20), "Xuất bản", (710, 60)),
            (4, (1370, 20), "Kiểu dáng", (1260, 55)),
            (5, (1475, 20), "Lớp", (1380, 55)),
            (6, (1575, 20), "Khối để thêm nội dung", (1335, 112)),
            (7, (820, 420), "Bấm phần đang muốn sửa", (930, 355)),
        ]),
        ("19-sua-tieu-de.png", "02-chon-va-sua-chu.png", [
            (1, (220, 548), "Chọn đúng tiêu đề", (310, 480)),
            (2, (1320, 115), "Mở Thuộc tính", (1090, 75)),
            (3, (1435, 112), "Chọn H1, H2, cỡ chữ", (1120, 175)),
        ]),
        ("03-kieu-dang.png", "03-kieu-dang.png", [
            (1, (1370, 20), "Kiểu dáng", (1200, 60)),
            (2, (1430, 320), "Màu, cỡ chữ, khoảng cách", (1050, 375)),
            (3, (810, 410), "Phần đang được chọn", (900, 470)),
        ]),
        ("05-cay-lop.png", "04-cay-lop.png", [
            (1, (1475, 20), "Mở Cây lớp", (1300, 60)),
            (2, (1420, 205), "Chọn phần con đúng cần sửa", (1090, 255)),
            (3, (810, 410), "Phần được chọn sẽ có viền", (900, 470)),
        ]),
        ("06-thu-vien-khoi.png", "05-them-khoi.png", [
            (1, (1575, 20), "Mở thư viện Khối", (1320, 60)),
            (2, (1410, 210), "Chọn loại khối", (1130, 250)),
            (3, (810, 410), "Kéo khối thả vào vị trí này", (900, 470)),
        ]),
        ("07-thu-vien-anh.png", "06-chon-anh.png", [
            (1, (760, 365), "Bấm chọn ảnh", (900, 310)),
            (2, (1110, 835), "Xác nhận dùng ảnh này", (890, 770)),
            (3, (1030, 190), "Tìm ảnh theo tên", (1130, 130)),
        ]),
        ("08-tai-anh.png", "07-tai-anh.png", [
            (1, (850, 275), "Chuyển sang Tải tệp lên", (980, 205)),
            (2, (800, 520), "Bấm hoặc kéo ảnh vào đây", (940, 590)),
            (3, (930, 780), "Chờ thông báo thành công", (1040, 830)),
        ]),
        ("20-thuoc-tinh-anh.png", "08-thuoc-tinh-anh.png", [
            (1, (1400, 114), "Bấm Chọn để thay ảnh", (1080, 65)),
            (2, (1415, 183), "Điền Alt mô tả ảnh", (1100, 195)),
            (3, (1405, 316), "Chọn cách cắt ảnh", (1100, 350)),
            (4, (800, 450), "Ảnh đang được chọn", (900, 510)),
        ]),
        ("21-thuoc-tinh-nut.png", "09-nut-va-link.png", [
            (1, (1415, 110), "Nhập đường dẫn nút", (1080, 60)),
            (2, (1415, 157), "Chọn mở cùng trang hoặc tab mới", (1030, 200)),
            (3, (1415, 245), "Chọn kiểu và cỡ nút", (1080, 300)),
            (4, (800, 450), "Bấm nút để chọn", (900, 510)),
        ]),
        ("22-thuoc-tinh-video.png", "10-video.png", [
            (1, (1415, 110), "Dán link YouTube hoặc Vimeo", (1050, 55)),
            (2, (1415, 180), "Chọn tỷ lệ khung video", (1080, 230)),
            (3, (800, 450), "Khung video đang chọn", (900, 510)),
        ]),
        ("23-du-lieu-dong.png", "11-du-lieu-dong.png", [
            (1, (1415, 108), "Chọn danh mục hoặc chuyên mục", (1000, 50)),
            (2, (1415, 170), "Chọn số lượng và số cột", (1030, 225)),
            (3, (800, 450), "Khối này lấy dữ liệu từ hệ thống", (880, 520)),
        ]),
        ("09-dien-thoai.png", "12-dien-thoai.png", [
            (1, (426, 20), "Chế độ điện thoại 375px", (300, 60)),
            (2, (805, 410), "Cuộn hết trang để kiểm tra", (900, 470)),
            (3, (585, 20), "Lưu sau khi chỉnh", (520, 60)),
        ]),
        ("10-may-tinh-bang.png", "13-may-tinh-bang.png", [
            (1, (400, 20), "Chế độ máy tính bảng 768px", (240, 60)),
            (2, (805, 410), "Kiểm tra cột, chữ và nút", (910, 470)),
        ]),
        ("11-xac-nhan-xuat-ban.png", "14-xuat-ban.png", [
            (1, (665, 20), "Bấm Xuất bản", (730, 60)),
            (2, (800, 525), "Đọc lại trước khi xác nhận", (910, 480)),
            (3, (875, 650), "Bấm Xuất bản ngay khi đã duyệt", (970, 690)),
        ]),
        ("12-sua-header.png", "15-header.png", [
            (1, (760, 20), "Sửa Header", (820, 60)),
            (2, (800, 112), "Header dùng chung nhiều trang", (920, 155)),
            (3, (585, 20), "Lưu nháp trước", (495, 60)),
        ]),
        ("13-sua-footer.png", "16-footer.png", [
            (1, (870, 20), "Sửa Footer", (950, 60)),
            (2, (800, 750), "Footer dùng chung nhiều trang", (905, 675)),
            (3, (585, 20), "Lưu nháp trước", (495, 60)),
        ]),
        ("15-khoi-dung-chung.png", "17-khoi-dung-chung.png", [
            (1, (790, 170), "Danh sách Header, Footer và khối dùng chung", (930, 115)),
            (2, (1450, 170), "Mở đúng khối để sửa", (1120, 225)),
        ]),
        ("24-nhom-khoi-1.png", "18-khoi-co-ban.png", [(1, (120, 20), "10 khối cơ bản: chữ, ảnh, nút, video…", (250, 70))]),
        ("24-nhom-khoi-2.png", "19-khoi-bo-cuc.png", [(1, (120, 20), "7 khối bố cục: Section, cột, lưới…", (250, 70))]),
        ("24-nhom-khoi-3.png", "20-khoi-noi-dung.png", [(1, (120, 20), "8 khối thẻ và nội dung", (250, 70))]),
        ("24-nhom-khoi-4.png", "21-khoi-tien-ich.png", [(1, (120, 20), "5 khối tiện ích: FAQ, mạng xã hội, bản đồ…", (250, 70))]),
        ("24-nhom-khoi-5.png", "22-khoi-du-lieu-dong.png", [(1, (120, 20), "8 khối dữ liệu động", (250, 70))]),
    ]
    for source, output, callouts in specs:
        annotate(source, output, callouts)


def build_pages():
    page("Hướng dẫn sửa trang bằng UI/UX Builder", """
        <p class="lead">Tài liệu này chỉ hướng dẫn những việc bạn cần làm trực tiếp trong Builder. Mỗi ảnh có số đỏ nhỏ tại vị trí cần bấm; phần giải thích số nằm ngay dưới ảnh để không che giao diện.</p>
        <div class="rule"><b>Quy trình dùng hằng ngày:</b> chọn đúng phần → sửa → kiểm tra máy tính/điện thoại → Lưu nháp → Xuất bản.</div>
        """ + image("01-tong-quan.png", "Màn hình Builder hiện tại. Các số chỉ những vùng cần dùng thường xuyên.", [
            "Số 1 là tên trang đang sửa. Số 2 là Lưu nháp; số 3 là Xuất bản.",
            "Số 4 mở Kiểu dáng; số 5 mở Cây lớp; số 6 mở Khối để thêm nội dung.",
            "Số 7 là vùng nội dung: bấm vào đây để chọn chữ, ảnh hoặc nút cần sửa.",
        ]))
    page("1. Chọn đúng phần trước khi sửa", image("04-cay-lop.png", "Dùng Cây lớp khi bấm trực tiếp chưa chọn đúng chữ, ảnh hoặc nút.", [
        "Bấm phần trên trang cần sửa. Nếu đã chọn đúng, phần đó có viền.", "Nếu chọn nhầm vùng lớn, bấm số 1 rồi tìm phần con ở số 2.", "Chỉ xóa khi bạn nhìn thấy đúng phần đang có viền.",
    ]))
    page("2. Sửa tiêu đề và đoạn chữ", image("02-chon-va-sua-chu.png", "Ảnh chỉ đúng vị trí chọn tiêu đề và bảng thuộc tính của tiêu đề.", [
        "Bấm số 1, sau đó nhấp đúp lên chữ trong trang để gõ nội dung mới.", "Ở số 2 mở Thuộc tính. Số 3 chọn cấp H1/H2 và cỡ chữ nếu cần.", "Sửa xong bấm ra ngoài chữ, nhìn lại trước khi lưu nháp.",
    ]))
    page("3. Đổi màu, cỡ chữ và khoảng cách", image("03-kieu-dang.png", "Mở Kiểu dáng sau khi đã chọn phần tử.", [
        "Bấm số 1 để mở Kiểu dáng.", "Số 2 là nơi đổi màu, cỡ chữ, khoảng đệm và khoảng cách.", "Mỗi lần chỉ đổi một vài giá trị rồi quan sát phần được chọn ở số 3.",
    ]))
    page("4. Thêm khối mới vào trang", image("05-them-khoi.png", "Thư viện Khối để thêm nội dung vào trang đang sửa.", [
        "Bấm số 1, chọn nhóm khối ở số 2.", "Kéo khối muốn dùng và thả tại vị trí số 3.", "Khối mới luôn có nội dung mẫu: thay chữ, ảnh và link trước khi xuất bản.",
    ]))
    page("5. Chọn ảnh từ thư viện", image("06-chon-anh.png", "Chọn một ảnh trong thư viện rồi xác nhận.", [
        "Dùng ô số 3 để tìm tên ảnh nếu thư viện có nhiều ảnh.", "Bấm ảnh ở số 1. Sau đó bấm nút số 2 để dùng ảnh đó.", "Quay lại trang và kiểm tra ảnh đã thay đúng chưa.",
    ]))
    page("6. Tải ảnh mới lên", image("07-tai-anh.png", "Tải ảnh từ máy tính vào thư viện Media.", [
        "Bấm số 1 để chuyển sang phần tải tệp.", "Bấm/kéo ảnh vào vùng số 2. Dùng JPG, JPEG, PNG, WebP hoặc GIF.", "Chỉ chọn ảnh khi có thông báo thành công ở số 3. Sau đó chọn ảnh đó cho trang.",
    ]))
    page("7. Kiểm tra mô tả và cách cắt ảnh", image("08-thuoc-tinh-anh.png", "Thuộc tính cần kiểm tra sau khi chọn ảnh.", [
        "Bấm số 1 nếu cần thay ảnh khác.", "Điền số 2: Alt mô tả đúng ảnh, ví dụ “Không gian showroom”.", "Số 3 chọn cách hiển thị ảnh; nhìn ảnh ở số 4 để chắc không bị cắt chủ thể.",
    ]))
    page("8. Sửa nút và đường link", image("09-nut-va-link.png", "Chọn nút rồi mở Thuộc tính để sửa link.", [
        "Số 1: nhập link, ví dụ /lien-he cho trang liên hệ trong website.", "Số 2: chỉ chọn tab mới khi cần giữ trang hiện tại.", "Số 3: chọn kiểu/cỡ nút. Sau khi xuất bản, bấm thử nút ngoài website.",
    ]))
    page("9. Chèn video", image("10-video.png", "Khối Video chỉ cần link và tỷ lệ khung.", [
        "Số 1: dán link YouTube hoặc Vimeo.", "Số 2: chọn 16:9 cho video ngang, 9:16 cho video dọc.", "Sau xuất bản phải mở website và bấm phát video để kiểm tra.",
    ]))
    page("10. Dùng khối dữ liệu động", image("11-du-lieu-dong.png", "Khối dữ liệu động lấy nội dung từ sản phẩm, bài viết, dự án hoặc đánh giá của hệ thống.", [
        "Số 1: chọn danh mục/chuyên mục nếu khối có trường này.", "Số 2: chọn số lượng và số cột cần hiển thị.", "Không gõ sửa tên hoặc ảnh của từng mục tại đây; sửa ở phần quản lý dữ liệu nguồn.",
    ]))
    page("11. Kiểm tra điện thoại", image("12-dien-thoai.png", "Chế độ Điện thoại là khung 375px trong Builder.", [
        "Bấm số 1 để chuyển sang điện thoại.", "Cuộn hết trang ở số 2: kiểm tra chữ tràn, ảnh cắt và nút có dễ bấm.", "Sửa xong bấm số 3 để lưu nháp.",
    ]))
    page("12. Kiểm tra máy tính bảng", image("13-may-tinh-bang.png", "Kiểm tra thêm khung Tablet 768px.", [
        "Bấm số 1 để chuyển sang Tablet.", "Ở số 2 kiểm tra cột, chữ và nút. Nếu sai, chỉnh rồi quay lại Desktop kiểm tra lại.",
    ]))
    page("13. Lưu nháp", image("01-tong-quan.png", "Lưu nháp giữ công việc đang sửa, khách chưa thấy thay đổi đó.", [
        "Bấm số 2 Lưu nháp sau mỗi nhóm sửa nhỏ.", "Chờ thông báo lưu thành công rồi mới chuyển sang phần khác hoặc đóng trang.", "Mở lại Builder để kiểm tra nội dung vẫn còn trước khi xuất bản.",
    ]))
    page("14. Xuất bản trang", image("14-xuat-ban.png", "Xuất bản chỉ thực hiện khi nội dung đã được duyệt.", [
        "Bấm số 1 để mở hộp xác nhận.", "Đọc lại ở số 2. Nếu chưa đúng, đóng hộp và tiếp tục sửa/lưu nháp.", "Khi chắc chắn, bấm số 3. Sau đó mở URL thật của trang để kiểm tra.",
    ]))
    page("15. Sửa Header", image("15-header.png", "Header thường có logo, menu và nút; một lần xuất bản có thể ảnh hưởng nhiều trang.", [
        "Bấm số 1 để mở Header đang dùng cho trang.", "Sửa phần trong số 2 như sửa trang thường.", "Lưu nháp ở số 3, kiểm tra Desktop và Điện thoại, sau đó mới xuất bản Header.",
    ]))
    page("16. Sửa Footer", image("16-footer.png", "Footer là phần chân trang dùng chung.", [
        "Bấm số 1 để mở Footer đang dùng.", "Kiểm tra kỹ số điện thoại, email, địa chỉ và link trong vùng số 2.", "Lưu nháp ở số 3 rồi kiểm tra nhiều trang trước khi xuất bản.",
    ]))
    page("17. Khối dùng chung", image("17-khoi-dung-chung.png", "Đây là nơi quản lý Header, Footer và các khối dùng lại ở nhiều trang.", [
        "Số 1 là danh sách các phần dùng chung.", "Bấm số 2 để mở đúng phần cần sửa.", "Sau khi xuất bản một khối dùng chung, kiểm tra các trang đang sử dụng nó.",
    ]))
    for number, name, title, text in [
        (18, "18-khoi-co-ban.png", "18. Nhóm khối Cơ bản", "Các tên khối đã hiển thị trực tiếp trên ảnh. Kéo một khối vào trang rồi thay nội dung mẫu."),
        (19, "19-khoi-bo-cuc.png", "19. Nhóm khối Bố cục", "Dùng Section, Khung chứa, Cột và Lưới để sắp xếp nội dung. Chọn khung cha để chỉnh khoảng cách chung."),
        (20, "20-khoi-noi-dung.png", "20. Nhóm khối Thẻ và nội dung", "Dùng cho các thẻ dịch vụ, giá, đánh giá, danh sách lợi ích hoặc thông báo. Thay toàn bộ nội dung mẫu."),
        (21, "21-khoi-tien-ich.png", "21. Nhóm khối Tiện ích", "FAQ, mạng xã hội, bản đồ và thư viện ảnh. Kiểm tra từng link ngoài website sau xuất bản."),
        (22, "22-khoi-du-lieu-dong.png", "22. Nhóm khối Dữ liệu động", "Các khối này lấy dữ liệu hệ thống. Sau khi kéo vào, chọn khối và thiết lập thuộc tính như ở trang dữ liệu động."),
    ]:
        page(title, image(name, text, [
            "Bấm số 1 để mở đúng nhóm trong thư viện Khối.",
            "Đọc tên trên từng thẻ khối rồi kéo thả khối cần dùng vào trang.",
            "Lưu nháp và kiểm tra trên điện thoại sau khi thêm khối.",
        ]))
    page("23. Kiểm tra trước khi xuất bản", """
        <table><tr><th>Kiểm tra</th><th>Đã làm</th></tr>
        <tr><td>Đúng chữ, ảnh, link và thông tin liên hệ</td><td>□</td></tr>
        <tr><td>Đã kiểm tra Desktop, Tablet và Điện thoại</td><td>□</td></tr>
        <tr><td>Đã Lưu nháp, mở lại và nội dung vẫn còn</td><td>□</td></tr>
        <tr><td>Đã kiểm tra Header/Footer nếu có sửa</td><td>□</td></tr>
        <tr><td>Đã xuất bản và tải lại URL thật của trang</td><td>□</td></tr>
        <tr><td>Đã bấm thử nút, link, video, form hoặc FAQ có dùng</td><td>□</td></tr></table>
        <div class="rule"><b>Nếu website chưa đổi:</b> kiểm tra đúng URL, đúng ngôn ngữ, đã bấm Xuất bản và có thông báo thành công. Nếu vẫn lỗi, gửi tên trang + URL + ảnh chụp lỗi cho người phụ trách.</div>
    """)


def write_html():
    css = """
    @page{size:A4;margin:0}*{box-sizing:border-box}body{margin:0;background:#e5e9ef;color:#18324a;font:11.5pt/1.48 Arial,'DejaVu Sans',sans-serif}.page{width:210mm;height:297mm;padding:14mm 16mm 16mm;background:#fff;position:relative;overflow:hidden;break-after:page;margin:8mm auto;border-top:6mm solid #147b8e}.eyebrow{font-size:8pt;letter-spacing:1.4px;font-weight:bold;color:#147b8e;border-bottom:1px solid #d6e3e8;padding-bottom:2.5mm}h1{font-size:26pt;line-height:1.12;margin:6mm 0 4mm;color:#112f47}p{margin:3mm 0}.lead{font-size:13pt}figure{margin:3mm 0}figure img{display:block;width:100%;max-height:147mm;object-fit:contain;object-position:top;border:1px solid #cbdce3}figcaption{font-size:9pt;color:#5a6e7d;margin-top:1.3mm}ol{margin:3mm 0;padding-left:7mm}li{margin:2.2mm 0}.rule{background:#fff2d9;border-left:3px solid #d9901a;padding:3mm 4mm;margin:4mm 0}table{width:100%;border-collapse:collapse;margin-top:7mm}th,td{border-bottom:1px solid #d2e0e6;padding:3mm;text-align:left}th{background:#e5f1f4}td:last-child,th:last-child{width:25%;text-align:center}footer{position:absolute;bottom:7mm;left:16mm;right:16mm;display:flex;justify-content:space-between;border-top:1px solid #d6e3e8;padding-top:2mm;color:#617784;font-size:8pt}@media print{body{background:#fff}.page{margin:0}}
    """
    sections = []
    for index, (title, content) in enumerate(PAGES, 1):
        sections.append(f'<section class="page"><div class="eyebrow">UI/UX BUILDER · HƯỚNG DẪN DÙNG TRỰC TIẾP</div><h1>{title}</h1><main>{content}</main><footer><span>REVOLUX ASIA · Hướng dẫn UI/UX Builder</span><span>{index:02d} / {len(PAGES)}</span></footer></section>')
    (ROOT / "index.html").write_text('<!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Hướng dẫn UI/UX Builder</title><style>' + css + '</style></head><body>' + ''.join(sections) + '</body></html>')


if __name__ == "__main__":
    build_annotations()
    build_pages()
    write_html()
    print(f"Đã tạo {len(PAGES)} trang và ảnh minh họa tại {ANNOTATED}")
