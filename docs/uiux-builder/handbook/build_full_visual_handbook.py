"""Soạn bản PDF trực quan đầy đủ từ ảnh Builder đã chụp trong môi trường test."""
from __future__ import annotations

import json
import re
from html import escape
from pathlib import Path
from textwrap import wrap

from PIL import Image, ImageDraw, ImageFont


ROOT = Path(__file__).resolve().parent
IMAGES = ROOT / "images"
FULL = IMAGES / "full"
ANNOTATED = IMAGES / "annotated"
FONT = "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf"
FONT_BOLD = "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf"


def text_font(size: int, bold: bool = False) -> ImageFont.FreeTypeFont:
    return ImageFont.truetype(FONT_BOLD if bold else FONT, size)


def annotate(source: str, output: str, label: str, target: tuple[float, float]) -> None:
    """Đặt một nhãn ở rail bên ngoài, bảo toàn toàn bộ pixel giao diện gốc."""
    source_path = IMAGES / source
    if not source_path.exists():
        source_path = FULL / source
    image = Image.open(source_path).convert("RGBA")
    rail = max(360, int(image.width * 0.27))
    canvas = Image.new("RGBA", (image.width + rail, image.height), "white")
    canvas.paste(image, (0, 0))
    draw = ImageDraw.Draw(canvas, "RGBA")
    draw.rectangle((image.width, 0, canvas.width, canvas.height), fill=(241, 247, 249, 255))
    draw.line((image.width, 0, image.width, image.height), fill=(166, 193, 204, 255), width=2)
    scale_x, scale_y = image.width / 1600, image.height / 1000
    x, y = int(target[0] * scale_x), int(target[1] * scale_y)
    radius = max(16, int(22 * min(scale_x, scale_y)))
    draw.ellipse((x - radius, y - radius, x + radius, y + radius), fill=(226, 53, 53), outline="white", width=3)
    number_font = text_font(max(14, int(21 * min(scale_x, scale_y))), True)
    bounds = draw.textbbox((0, 0), "1", font=number_font)
    draw.text((x - (bounds[2] - bounds[0]) / 2, y - (bounds[3] - bounds[1]) / 2 - 2), "1", fill="white", font=number_font)
    body_font = text_font(max(16, int(19 * min(scale_x, scale_y))))
    lines = wrap(label, width=max(18, rail // max(10, body_font.size // 2)))
    line_height = body_font.getbbox("Ag")[3] + 7
    height = len(lines) * line_height + 38
    box_x, box_y = image.width + 18, max(74, min(y - height // 2, image.height - height - 18))
    draw.line((x + radius, y, image.width + 10, box_y + height // 2), fill=(226, 53, 53, 220), width=max(2, int(3 * scale_x)))
    draw.text((image.width + 18, 18), "BẤM / XEM Ở ĐÂY", fill=(23, 80, 100), font=text_font(max(14, int(17 * min(scale_x, scale_y))), True))
    draw.rounded_rectangle((box_x, box_y, canvas.width - 18, box_y + height), radius=9, fill="white", outline=(177, 200, 209), width=2)
    draw.ellipse((box_x + 14, box_y + 14, box_x + 46, box_y + 46), fill=(226, 53, 53))
    draw.text((box_x + 25, box_y + 18), "1", fill="white", font=text_font(16, True))
    for index, line in enumerate(lines):
        draw.text((box_x + 58, box_y + 15 + index * line_height), line, fill=(20, 47, 65), font=body_font)
    canvas.convert("RGB").save(ANNOTATED / output, quality=94)


FEATURES = [
    ("feature-tong-quan.png", "Tên trang đang sửa", (145, 20), "Tên trang và vị trí đang sửa", "Xem tên trang ở góc trên trái trước khi bắt đầu để không sửa nhầm."),
    ("feature-tong-quan.png", "Quay về danh sách trang", (22, 20), "Quay lại danh sách trang", "Bấm mũi tên quay lại khi cần chọn một trang khác để sửa."),
    ("feature-tong-quan.png", "Lưu nháp", (585, 20), "Lưu nháp", "Bấm Lưu nháp sau mỗi nhóm thay đổi; khách chưa nhìn thấy bản nháp."),
    ("feature-tong-quan.png", "Xuất bản", (665, 20), "Xuất bản", "Chỉ bấm Xuất bản sau khi đã kiểm tra trên máy tính, tablet và điện thoại."),
    ("feature-tong-quan.png", "Hoàn tác thao tác vừa làm", (505, 20), "Hoàn tác", "Bấm mũi tên cong sang trái để bỏ thao tác vừa làm; kiểm tra nội dung trước khi lưu."),
    ("feature-tong-quan.png", "Làm lại thao tác đã hoàn tác", (535, 20), "Làm lại", "Bấm mũi tên cong sang phải khi cần khôi phục thao tác vừa hoàn tác."),
    ("feature-tong-quan.png", "Chế độ máy tính", (365, 20), "Kiểm tra Desktop", "Đây là khung máy tính. Luôn quay lại kiểm tra sau khi chỉnh tablet hoặc điện thoại."),
    ("feature-tablet.png", "Chế độ máy tính bảng", (400, 20), "Kiểm tra Tablet", "Bấm biểu tượng tablet, kiểm tra cột, chữ và nút trước khi lưu nháp."),
    ("feature-mobile.png", "Chế độ điện thoại", (425, 20), "Kiểm tra Mobile", "Bấm biểu tượng điện thoại rồi cuộn hết trang để tìm chữ tràn và nút khó bấm."),
    ("feature-kieu-dang.png", "Mở Kiểu dáng", (1370, 20), "Kiểu dáng", "Chọn phần tử trước, sau đó mở Kiểu dáng để đổi màu, cỡ, khoảng cách và nền."),
    ("feature-thuoc-tinh.png", "Mở Thuộc tính", (1420, 20), "Thuộc tính", "Mở Thuộc tính để điền nội dung riêng của phần đã chọn, như link, ảnh hoặc video."),
    ("feature-cay-lop.png", "Mở Cây lớp", (1475, 20), "Cây lớp", "Dùng Cây lớp khi bấm trực tiếp chưa chọn đúng chữ, ảnh, nút hoặc vùng chứa."),
    ("feature-thu-vien-khoi.png", "Mở thư viện Khối", (1575, 20), "Thư viện Khối", "Mở Khối, chọn loại cần dùng, rồi kéo thả khối vào vị trí trên trang."),
    ("feature-xem-truoc.png", "Xem trước trang", (1295, 20), "Xem trước", "Dùng Xem trước để xem trang không có đường viền chọn; thoát xem trước để sửa tiếp."),
    ("02-tong-quan-builder.png", "Hiện/ẩn viền chọn", (1315, 20), "Hiện viền các phần tử", "Bật biểu tượng con mắt khi cần nhìn ranh giới các vùng trên trang; tắt đi để quan sát bố cục sạch hơn."),
    ("02-tong-quan-builder.png", "Mở toàn màn hình", (1340, 20), "Toàn màn hình", "Dùng toàn màn hình khi cần thêm không gian để kiểm tra bố cục; bấm lại để thoát."),
    ("25-ma-nguon.png", "Chỉ dành cho người được giao sửa mã", (800, 520), "Mã nguồn (dành cho kỹ thuật)", "Không dùng mục này khi chỉ thay chữ, ảnh, nút hoặc khối. Nếu cần sửa mã, nhờ người phụ trách kỹ thuật."),
    ("02-tong-quan-builder.png", "Hiện bối cảnh Header và Footer", (1410, 20), "Hiện Header và Footer khi sửa", "Bật biểu tượng khung trang để xem Header/Footer bao quanh nội dung; phần này chỉ để đối chiếu khi sửa trang chính."),
    ("02-tong-quan-builder.png", "Thu gọn hoặc mở panel bên phải", (1515, 20), "Thu gọn bảng bên phải", "Thu gọn bảng bên phải khi cần xem canvas rộng hơn; mở lại trước khi chỉnh Thuộc tính hoặc Kiểu dáng."),
    ("02-tong-quan-builder.png", "Bật/tắt kéo tự do", (1545, 20), "Kéo tự do", "Chỉ bật kéo tự do khi đã hiểu bố cục. Với đa số nội dung, kéo thả khối trong bố cục cột sẽ an toàn hơn."),
    ("02-tong-quan-builder.png", "Sửa Header dùng chung", (760, 20), "Sửa Header", "Header thường xuất hiện ở nhiều trang. Kiểm tra logo, menu và nút kỹ trước khi xuất bản."),
    ("02-tong-quan-builder.png", "Sửa Footer dùng chung", (870, 20), "Sửa Footer", "Footer thường xuất hiện ở nhiều trang. Kiểm tra địa chỉ, số điện thoại, email và các link."),
    ("19-sua-tieu-de.png", "Bấm đúp để sửa chữ", (220, 548), "Sửa tiêu đề và đoạn chữ", "Chọn đúng dòng chữ, bấm đúp để gõ lại, rồi bấm ra ngoài để kiểm tra."),
    ("20-thuoc-tinh-anh.png", "Chọn ảnh và điền Alt", (1400, 114), "Thay ảnh", "Chọn ảnh trên trang, bấm Chọn trong Thuộc tính, sau đó điền Alt mô tả ngắn về ảnh."),
    ("21-thuoc-tinh-nut.png", "Nhập đường dẫn của nút", (1415, 110), "Sửa nút và link", "Chọn nút, điền đường dẫn, chọn cách mở liên kết, rồi bấm thử sau khi xuất bản."),
    ("22-thuoc-tinh-video.png", "Dán link video", (1415, 110), "Chèn video", "Chọn khung video, dán link YouTube hoặc Vimeo và kiểm tra tỷ lệ khung."),
    ("23-du-lieu-dong.png", "Chọn nguồn và số lượng hiển thị", (1415, 108), "Dùng dữ liệu động", "Chọn nguồn, danh mục, số lượng hoặc số cột. Sửa nội dung gốc trong phần quản lý dữ liệu."),
    ("12-sua-header.png", "Nút mở phần Header", (760, 20), "Mở Header để sửa", "Bấm Sửa Header để vào phần dùng chung. Lưu nháp và kiểm tra nhiều trang trước khi xuất bản."),
    ("13-sua-footer.png", "Nút mở phần Footer", (870, 20), "Mở Footer để sửa", "Bấm Sửa Footer để vào phần dùng chung. Lưu nháp và kiểm tra nhiều trang trước khi xuất bản."),
    ("11-xac-nhan-xuat-ban.png", "Xác nhận xuất bản khi đã duyệt", (875, 650), "Xác nhận xuất bản", "Đọc lại hộp xác nhận. Nếu chưa chắc, bấm Hủy và tiếp tục sửa bản nháp."),
]


def block_steps(label: str, category: str) -> list[str]:
    if category == "DỮ LIỆU ĐỘNG":
        return [f"Kéo khối {label} vào trang.", "Chọn khối, mở Thuộc tính ở bên phải và chọn dữ liệu/số lượng phù hợp.", "Không sửa từng mục mẫu trên canvas; chỉnh dữ liệu nguồn trong khu vực quản lý tương ứng."]
    if category == "BỐ CỤC":
        return [f"Kéo {label} vào vị trí cần chia bố cục.", "Thả chữ, ảnh, nút hoặc khối khác vào bên trong vùng mới.", "Kiểm tra lại tablet và điện thoại vì số cột có thể cần thu gọn."]
    return [f"Kéo khối {label} vào trang.", "Bấm vào khối vừa thêm để thay nội dung mẫu trong vùng chỉnh sửa bên phải.", "Kiểm tra hiển thị và lưu nháp trước khi thêm khối tiếp theo."]


def plain_label(value: str) -> str:
    """BlockManager trả nhãn dạng HTML; PDF chỉ hiển thị phần chữ cho biên tập viên."""
    text = re.sub(r"<[^>]+>", "", value)
    return re.sub(r"\s+", " ", text).strip()


def page(title: str, image_name: str, caption: str, steps: list[str], attribute: str = "") -> str:
    return f'''<section class="page" {attribute}><header><span>SỔ TAY UI/UX BUILDER</span><span>HƯỚNG DẪN BẰNG ẢNH</span></header><main><h1>{escape(title)}</h1><figure><img src="images/annotated/{escape(image_name)}"><figcaption>{escape(caption)}</figcaption></figure><ol>{''.join(f'<li>{escape(step)}</li>' for step in steps)}</ol></main><footer><span>Biên tập trực tiếp trên giao diện Builder</span><span class="page-no"></span></footer></section>'''


def main() -> None:
    ANNOTATED.mkdir(parents=True, exist_ok=True)
    manifest = json.loads((FULL / "manifest.json").read_text())
    pages = []
    for index, (source, label, target, title, instruction) in enumerate(FEATURES, 1):
        output = f"full-feature-{index:02d}.png"
        annotate(source, output, label, target)
        pages.append(page(title, output, "Một điểm trên ảnh, một việc cần làm. Nhãn đặt ngoài giao diện để ảnh vẫn đọc rõ.", [instruction, "Thực hiện xong, quan sát thay đổi trên canvas trước khi chuyển sang việc khác."]))
    for index, block in enumerate(manifest["blocks"], 1):
        output = f"full-block-{index:02d}.png"
        annotate(block["image"], output, "Thuộc tính của khối đang chọn", (1410, 140))
        label = plain_label(block["label"])
        title = f"Khối {index}: {label}"
        pages.append(page(title, output, f"Nhóm {block['category']}. Ảnh mở đúng bảng chỉnh sửa của khối.", block_steps(label, block["category"]), f'data-block-id="{escape(block["id"])}"'))
    document = f'''<!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Hướng dẫn UI/UX Builder</title><style>@page{{size:A4;margin:0}}*{{box-sizing:border-box}}body{{margin:0;background:#e8edf0;font-family:Arial,sans-serif;color:#16354c}}.page{{width:210mm;height:297mm;background:#fff;page-break-after:always;padding:13mm 13mm 15mm;display:flex;flex-direction:column}}header,footer{{font-size:8.5pt;letter-spacing:.08em;color:#637b8b;display:flex;justify-content:space-between}}header{{border-bottom:1px solid #bed1da;padding-bottom:3mm}}main{{flex:1;min-height:0}}h1{{font-size:23pt;line-height:1.12;margin:6mm 0 4mm;color:#153a55}}figure{{margin:0}}figure img{{display:block;max-width:100%;max-height:138mm;margin:auto;border:1px solid #c8d8df}}figcaption{{font-size:10pt;color:#5b7180;margin-top:2.5mm}}ol{{margin:4mm 0 0;padding-left:6mm;font-size:10.8pt;line-height:1.45}}li{{margin:1.6mm 0}}footer{{border-top:1px solid #bed1da;padding-top:3mm}}.page-no:before{{counter-increment:page;content:counter(page)}}body{{counter-reset:page}}</style></head><body>{''.join(pages)}</body></html>'''
    (ROOT / "index.html").write_text(document)
    print(f"Built {len(pages)} pages: {len(FEATURES)} features and {len(manifest['blocks'])} blocks.")


if __name__ == "__main__":
    main()
