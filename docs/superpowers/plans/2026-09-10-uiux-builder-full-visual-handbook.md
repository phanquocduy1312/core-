# UI/UX Builder Full Visual Handbook Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Produce a Vietnamese PDF handbook that shows every UI/UX Builder control and every runtime Builder block with a clear, unoccluded screenshot.

**Architecture:** A Playwright capture script uses the isolated Laravel/SQLite Builder session to make a runtime inventory and screenshots without saving or publishing. A Python composer writes labels into an external rail, then uses the manifest to make a focused A4 page for every function and block. The existing renderer validates images and page overflow.

**Tech Stack:** Python 3, Playwright/Chromium, Pillow, HTML/CSS, Playwright PDF renderer, local Laravel audit instance.

**Spec:** `docs/uiux-builder/handbook/README.md`; approved direction from the editor: cover all features, use a separate image for each instruction, place labels outside the UI, and keep each image to one to three targets.

## Global Constraints

- Capture only at `127.0.0.1:8765` with `/tmp/uiux-audit/database.sqlite`; never save, publish, upload, or change production data.
- Leave source UI pixels unobscured; use an external callout rail and thin leaders.
- Cover all runtime blocks and user-facing toolbar, panel, responsive, content, media, reusable-area, save, preview, and publish operations.
- Write for Vietnamese editors who do not write code; do not include credentials, cookies, keys, or production data.

---

### Task 1: Capture the complete runtime inventory

**Files:**
- Create: `docs/uiux-builder/handbook/capture_full_handbook.py`
- Create: `docs/uiux-builder/handbook/images/full/manifest.json`
- Create: `docs/uiux-builder/handbook/test_full_visual_handbook.py`

**Interfaces:** The capture script reads `/tmp/uiux-audit/auth.json`, visits `/vi/admin/pages/2/builder`, and writes a manifest with `features` and `blocks`. Blocks have `id`, `label`, `category`, and `image`; features have `id`, `title`, and `image`.

- [ ] Write the failing test that loads `images/full/manifest.json`, asserts exactly 38 blocks, and asserts the five categories `Cơ bản`, `Bố cục`, `Nội dung`, `Tiện ích`, and `Dữ liệu động`.
- [ ] Run `python3 docs/uiux-builder/handbook/test_full_visual_handbook.py`; confirm it fails because the manifest does not exist.
- [ ] Implement the capture script. Use `editor.BlockManager.getAll()` as the source of IDs and labels. Reset only the browser canvas between samples, select the sample component, open its relevant panel, and take a separate image for each block. Capture each toolbar/panel function as its own state.
- [ ] Start `php -S 127.0.0.1:8765 -t public /tmp/uiux-audit/router.php`, then run `python3 docs/uiux-builder/handbook/capture_full_handbook.py`.
- [ ] Re-run the test and require the 38-block inventory to pass.
- [ ] Commit the capture script, manifest, images, and test with `git commit -m "docs: chụp đủ tính năng UIUX Builder"`.

### Task 2: Compose unoccluded visual instructions

**Files:**
- Create: `docs/uiux-builder/handbook/build_full_visual_handbook.py`
- Modify: `docs/uiux-builder/handbook/test_full_visual_handbook.py`
- Generate: `docs/uiux-builder/handbook/index.html`
- Generate: `docs/uiux-builder/handbook/images/annotated/full-*.png`

**Interfaces:** The composer reads `images/full/manifest.json` and writes an external-rail annotated image and one A4 HTML page for every feature and block. `index.html` stores each coverage ID in a `data-*` attribute.

- [ ] Extend the test to assert that each block ID from the manifest occurs once in `index.html`; run it and confirm the previous compact handbook fails.
- [ ] Implement `annotate(source, output, callouts)` so it copies the original image unchanged, draws target rings inside it, and keeps every text label in the right rail. Limit pages to one through three callouts.
- [ ] Implement `feature_page(feature)` and `block_page(block)` with a title, image caption, plain-language purpose, and short numbered steps. Include separate pages for every toolbar control; settings, style, layers, and blocks panels; responsive modes; text/image/button/video; Header/Footer/reusable/dynamic data; save/preview/publish; and all runtime block IDs.
- [ ] Run `python3 docs/uiux-builder/handbook/build_full_visual_handbook.py` then `python3 docs/uiux-builder/handbook/test_full_visual_handbook.py`; require full manifest coverage and more pages than the prior 24-page edition.
- [ ] Commit the composer, test, HTML, and annotations with `git commit -m "docs: soạn sổ tay Builder đầy đủ bằng ảnh"`.

### Task 3: Render and document the handbook

**Files:**
- Modify: `docs/uiux-builder/handbook/README.md`
- Modify: `docs/uiux-builder/HUONG-DAN-SU-DUNG.md`
- Modify: `docs/README.md`
- Generate: `docs/uiux-builder/handbook/HUONG-DAN-UIUX-BUILDER.pdf`
- Generate: `docs/uiux-builder/handbook/verification.json`

**Interfaces:** `render_pdf.py` consumes the generated HTML and produces the linked A4 PDF plus a report with empty `missing_images` and `overflow` lists.

- [ ] Run `python3 docs/uiux-builder/handbook/render_pdf.py` and inspect the report.
- [ ] Render representative pages with `pdftoppm`: the overview, a toolbar page, a style page, a media page, a dynamic block page, and the last block page. Confirm labels do not cover the Builder UI.
- [ ] Update all handbook entry points with the real page total, full coverage, external-callout convention, isolated capture source, and commands: `capture_full_handbook.py`, `build_full_visual_handbook.py`, and `render_pdf.py`.
- [ ] Run `python3 docs/uiux-builder/handbook/test_visual_handbook.py && python3 docs/uiux-builder/handbook/test_full_visual_handbook.py && python3 docs/uiux-builder/handbook/render_pdf.py && pdfinfo docs/uiux-builder/handbook/HUONG-DAN-UIUX-BUILDER.pdf`.
- [ ] Commit all documentation and the PDF locally with `git commit -m "docs: hoàn thiện PDF hướng dẫn UIUX Builder"`.

## Self-review

- Coverage maps every requested user-facing Builder area to Task 1 or Task 2.
- The plan has no deferred work, placeholder steps, or undefined output interface.
- The manifest fields used in capture, composition, and tests use the same names.
