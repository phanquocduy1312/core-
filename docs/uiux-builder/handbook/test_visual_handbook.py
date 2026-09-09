"""Kiểm tra quy tắc dễ đọc của ảnh chú thích trong sổ tay Builder."""
from pathlib import Path


SOURCE = Path(__file__).with_name("build_visual_handbook.py").read_text()


def test_annotations_never_draw_text_panels_on_top_of_the_ui():
    """Chú thích trong ảnh chỉ được là số/mũi tên; diễn giải nằm dưới ảnh."""
    assert "draw.rounded_rectangle" not in SOURCE
    assert "draw.text((bx + 13" not in SOURCE


def test_each_visual_instruction_has_an_outside_image_legend():
    """Hàm tạo ảnh phải xuất danh sách hướng dẫn sau ảnh, không trên ảnh."""
    assert "<ol>" in SOURCE
    assert "''.join(f'<li>{item}</li>' for item in steps)" in SOURCE


if __name__ == "__main__":
    test_annotations_never_draw_text_panels_on_top_of_the_ui()
    test_each_visual_instruction_has_an_outside_image_legend()
    print("PASS: annotated screenshots keep explanatory text outside the UI.")
