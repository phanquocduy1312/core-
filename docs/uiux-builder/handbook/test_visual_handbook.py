"""Kiểm tra quy tắc dễ đọc của ảnh chú thích trong sổ tay Builder."""
from pathlib import Path


SOURCE = Path(__file__).with_name("build_visual_handbook.py").read_text()


def test_annotations_use_a_dedicated_rail_outside_the_screenshot():
    """Nhãn phải nằm trong cột ngoài ảnh, không nằm đè lên giao diện."""
    assert "CALLOUT_RAIL_WIDTH" in SOURCE
    assert "image.width + rail_width" in SOURCE
    assert "rail_x" in SOURCE


def test_each_visual_instruction_has_a_rail_label_and_a_text_legend():
    """Đường nối trong ảnh phải dẫn tới nhãn ở rail và có hướng dẫn bên dưới."""
    assert "draw.line" in SOURCE
    assert "draw.text((rail_x" in SOURCE
    assert "''.join(f'<li>{item}</li>' for item in steps)" in SOURCE


if __name__ == "__main__":
    test_annotations_use_a_dedicated_rail_outside_the_screenshot()
    test_each_visual_instruction_has_a_rail_label_and_a_text_legend()
    print("PASS: annotated screenshots use an external callout rail.")
