"""Kiểm tra sổ tay đầy đủ bám sát inventory Builder thực tế."""
from __future__ import annotations

import json
from pathlib import Path


ROOT = Path(__file__).resolve().parent
MANIFEST = ROOT / "images" / "full" / "manifest.json"
EXPECTED_CATEGORIES = {"CƠ BẢN", "BỐ CỤC", "THẺ & NỘI DUNG", "TƯƠNG TÁC & TIỆN ÍCH", "DỮ LIỆU ĐỘNG"}


def load_manifest() -> dict:
    return json.loads(MANIFEST.read_text())


def test_runtime_manifest_contains_all_builder_categories():
    manifest = load_manifest()
    assert len(manifest["blocks"]) == 38
    assert {block["category"] for block in manifest["blocks"]} == EXPECTED_CATEGORIES


def test_html_lists_every_runtime_block_once():
    html = (ROOT / "index.html").read_text()
    for block in load_manifest()["blocks"]:
        assert html.count(f'data-block-id="{block["id"]}"') == 1


if __name__ == "__main__":
    test_runtime_manifest_contains_all_builder_categories()
    test_html_lists_every_runtime_block_once()
    print("PASS: manifest contains all 38 runtime Builder blocks.")
