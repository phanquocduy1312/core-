"""Chụp inventory đầy đủ của UI/UX Builder trong môi trường SQLite kiểm thử.

Không gọi Lưu nháp, Xuất bản hoặc Upload. Thành phần mẫu chỉ tồn tại trong
canvas của trình duyệt và được reset trước ảnh tiếp theo.
"""
from __future__ import annotations

import asyncio
import json
import re
from pathlib import Path

from playwright.async_api import Page, async_playwright


ROOT = Path(__file__).resolve().parent
FULL = ROOT / "images" / "full"
BASE = "http://127.0.0.1:8765"
AUTH = Path("/tmp/uiux-audit/auth.json")


def slug(value: str) -> str:
    return re.sub(r"[^a-z0-9]+", "-", value.lower()).strip("-")


async def snap(page: Page, filename: str) -> str:
    await page.wait_for_timeout(250)
    await page.screenshot(path=str(FULL / filename))
    return f"full/{filename}"


async def show(page: Page, command: str, filename: str, title: str) -> dict[str, str]:
    await page.evaluate("command => editor.runCommand(command)", command)
    return {"id": filename.removeprefix("feature-").removesuffix(".png"), "title": title,
            "image": await snap(page, filename)}


async def main() -> None:
    FULL.mkdir(parents=True, exist_ok=True)
    async with async_playwright() as playwright:
        browser = await playwright.chromium.launch(args=["--no-sandbox", "--renderer-process-limit=2"])
        context = await browser.new_context(storage_state=str(AUTH), viewport={"width": 1600, "height": 1000})
        page = await context.new_page()
        await page.goto(f"{BASE}/vi/admin/pages/2/builder", wait_until="domcontentloaded")
        await page.wait_for_function("window.editor && editor.getModel().get('ready')")

        features = []
        features.append({"id": "tong-quan", "title": "Nhìn toàn bộ màn hình Builder", "image": await snap(page, "feature-tong-quan.png")})
        for command, filename, title in [
            ("open-sm", "feature-kieu-dang.png", "Mở Kiểu dáng"),
            ("open-tm", "feature-thuoc-tinh.png", "Mở Thuộc tính"),
            ("open-layers", "feature-cay-lop.png", "Mở Cây lớp"),
            ("open-blocks", "feature-thu-vien-khoi.png", "Mở thư viện Khối"),
            ("core:preview", "feature-xem-truoc.png", "Xem trước trang"),
        ]:
            features.append(await show(page, command, filename, title))
            if command == "core:preview":
                await page.evaluate("editor.stopCommand('core:preview')")

        await page.evaluate("() => { editor.setDevice('Tablet'); }")
        features.append({"id": "tablet", "title": "Kiểm tra máy tính bảng", "image": await snap(page, "feature-tablet.png")})
        await page.evaluate("() => { editor.setDevice('Mobile'); }")
        features.append({"id": "mobile", "title": "Kiểm tra điện thoại", "image": await snap(page, "feature-mobile.png")})
        await page.evaluate("() => { editor.setDevice('Desktop'); }")

        await page.evaluate("editor.runCommand('open-tm')")
        inventory = await page.evaluate("""() => editor.BlockManager.getAll().map(block => ({
            id: block.getId(), label: block.getLabel(), category: block.getCategoryLabel() || block.get('category') || 'Khác'
        }))""")
        blocks = []
        for number, block in enumerate(inventory, 1):
            filename = f"block-{number:02d}-{slug(block['id'])}.png"
            await page.evaluate("""id => {
                editor.setComponents([]);
                const block = editor.BlockManager.get(id);
                const raw = block.get('content');
                const component = editor.addComponents(typeof raw === 'function' ? raw() : raw)[0];
                editor.select(component);
                editor.runCommand('open-tm');
                component.getEl().scrollIntoView({block: 'center'});
            }""", block["id"])
            block["image"] = await snap(page, filename)
            blocks.append(block)

        manifest = {"features": features, "blocks": blocks}
        (FULL / "manifest.json").write_text(json.dumps(manifest, ensure_ascii=False, indent=2))
        print(f"Captured {len(features)} features and {len(blocks)} blocks.")
        await browser.close()


if __name__ == "__main__":
    asyncio.run(main())
