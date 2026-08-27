<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full w-full overflow-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trình thiết kế trực quan (GrapesJS) — {{ $page->getTranslation('title', $contentLocale, false) ?: $page->slug }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Admin Styles -->
    <link rel="stylesheet" href="{{ asset('build/assets/builder.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/admin.css') }}">

    <!-- GrapesJS Pinned CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/grapesjs/grapes.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">

    <!-- Icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <style>
        :root {
            --builder-topbar-height: 56px;
            --builder-left-width: 280px;
            --builder-right-width: 300px;
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }
        html, body, #builder-app {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Quicksand', sans-serif;
            background-color: #f8fafc;
        }
        .builder-topbar {
            height: var(--builder-topbar-height);
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            z-index: 50;
            position: relative;
        }
        .builder-workspace {
            display: flex;
            width: 100%;
            height: calc(100vh - var(--builder-topbar-height));
            overflow: hidden;
            position: relative;
            background: #f1f5f9;
        }
        .builder-sidebar-left {
            width: var(--builder-left-width);
            min-width: var(--builder-left-width);
            max-width: var(--builder-left-width);
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            z-index: 30;
            height: 100%;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        .builder-sidebar-right {
            width: var(--builder-right-width);
            min-width: var(--builder-right-width);
            max-width: var(--builder-right-width);
            background: #ffffff;
            border-left: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            z-index: 30;
            height: 100%;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        .builder-center-canvas {
            flex: 1 1 auto;
            min-width: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            background: #f1f5f9;
        }
        #gjs-container {
            width: 100%;
            height: 100%;
            position: relative;
        }

        /* GrapesJS Canvas Overrides */
        .gjs-cv-canvas {
            background-color: #f1f5f9;
            box-sizing: border-box;
            width: 100%;
            height: 100%;
            top: 0;
        }
        .gjs-frame-wrapper {
            margin: 0 auto;
            transition: width 0.25s ease, margin 0.25s ease, box-shadow 0.25s ease;
            background: #ffffff;
        }
        [data-current-device="Desktop"] .gjs-frame-wrapper {
            width: 100% !important;
            height: 100% !important;
            margin: 0 !important;
            border-radius: 0 !important;
            box-shadow: none !important;
        }
        [data-current-device="Tablet"] .gjs-frame-wrapper {
            width: 768px !important;
            height: calc(100% - 32px) !important;
            margin: 16px auto !important;
            border-radius: 12px !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.08) !important;
        }
        [data-current-device="Mobile"] .gjs-frame-wrapper {
            width: 375px !important;
            height: calc(100% - 32px) !important;
            margin: 16px auto !important;
            border-radius: 16px !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.08) !important;
        }

        /* GrapesJS Block styling */
        .gjs-block {
            user-select: none;
            cursor: grab;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 10px 12px;
            margin: 4px;
            background: #ffffff;
            color: #1e293b;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
            transition: all 0.15s ease;
            font-family: 'Quicksand', sans-serif;
            font-size: 11px;
            font-weight: 700;
            text-align: left;
        }
        .gjs-block:hover {
            border-color: #e32326;
            color: #e32326;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(227, 35, 38, 0.08);
        }
        .gjs-block:active {
            cursor: grabbing;
        }
        .gjs-block-category {
            border-top: 1px solid #f1f5f9;
        }
        .gjs-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            padding: 8px 12px;
            background: #f8fafc;
        }

        /* Sidebar Tabs */
        .sidebar-tab-btn.active {
            background: #ffffff;
            color: #e32326;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .sidebar-tab-btn:not(.active) {
            color: #64748b;
            background: transparent;
            border: 1px solid transparent;
        }
        .sidebar-tab-btn:not(.active):hover {
            color: #1e293b;
        }

        /* Device Buttons */
        .device-btn.active {
            background: #ffffff;
            color: #e32326;
            box-shadow: 0 1px 2px rgba(0,0,0,0.06);
            border-color: #fecaca;
        }
        .device-btn:not(.active) {
            color: #64748b;
            border-color: transparent;
        }
        .device-btn:not(.active):hover {
            color: #1e293b;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="antialiased select-none" data-current-device="Desktop">

<div id="builder-app">
    <!-- Topbar -->
    <header class="builder-topbar shadow-2xs">
        <!-- Left Section -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition-all" title="Quay lại danh sách trang">
                <iconify-icon icon="solar:arrow-left-linear" class="text-sm"></iconify-icon>
                <span>Quay lại</span>
            </a>

            <div class="h-4 w-px bg-slate-200"></div>

            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-900 text-xs sm:text-sm max-w-[140px] sm:max-w-[200px] truncate" title="{{ $page->getTranslation('title', $contentLocale, false) ?: $page->slug }}">
                    {{ $page->getTranslation('title', $contentLocale, false) ?: $page->slug }}
                </span>
                <span class="px-2 py-0.5 rounded-md text-2xs font-bold {{ $page->is_active ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                    {{ $page->is_active ? 'Đã xuất bản' : 'Bản nháp' }}
                </span>
            </div>

            <!-- Multilingual selector -->
            @if(count($contentLanguages) > 1)
                <div class="flex items-center bg-slate-100 p-0.5 rounded-lg border border-slate-200 ml-1">
                    @foreach($contentLanguages as $langCode => $langName)
                        <a href="{{ route('admin.pages.builder', ['locale' => app()->getLocale(), 'page' => $page->id, 'content_locale' => $langCode]) }}" 
                           class="px-2 py-0.5 text-2xs font-bold rounded-md transition-all {{ $contentLocale === $langCode ? 'bg-white text-primary shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                            {{ strtoupper($langCode) }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Center: Device Switcher -->
        <div class="flex items-center bg-slate-100 p-1 rounded-xl border border-slate-200">
            <button type="button" class="device-btn active px-3 py-1 rounded-lg text-xs font-bold flex items-center gap-1.5 border transition-all" data-device="Desktop" title="Máy tính (Desktop 100%)">
                <iconify-icon icon="solar:laptop-minimalistic-linear" class="text-sm"></iconify-icon>
                <span class="hidden md:inline">Desktop</span>
            </button>
            <button type="button" class="device-btn px-3 py-1 rounded-lg text-xs font-bold flex items-center gap-1.5 border transition-all" data-device="Tablet" title="Máy tính bảng (Tablet 768px)">
                <iconify-icon icon="solar:tablet-linear" class="text-sm"></iconify-icon>
                <span class="hidden md:inline">Tablet</span>
            </button>
            <button type="button" class="device-btn px-3 py-1 rounded-lg text-xs font-bold flex items-center gap-1.5 border transition-all" data-device="Mobile" title="Điện thoại (Mobile 375px)">
                <iconify-icon icon="solar:smartphone-linear" class="text-sm"></iconify-icon>
                <span class="hidden md:inline">Mobile</span>
            </button>
        </div>

        <!-- Right: Actions & Tools -->
        <div class="flex items-center gap-1.5">
            <!-- Undo / Redo -->
            <button type="button" id="btn-undo" class="p-1.5 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors" title="Hoàn tác (Ctrl+Z)">
                <iconify-icon icon="solar:undo-left-round-linear" class="text-base"></iconify-icon>
            </button>
            <button type="button" id="btn-redo" class="p-1.5 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors" title="Làm lại (Ctrl+Y)">
                <iconify-icon icon="solar:undo-right-round-linear" class="text-base"></iconify-icon>
            </button>

            <div class="h-4 w-px bg-slate-200 mx-0.5"></div>

            <!-- Focus Mode -->
            <button type="button" id="btn-focus-mode" class="px-2.5 py-1.5 text-slate-700 hover:text-primary hover:bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold flex items-center gap-1 transition-all" title="Chế độ tập trung (Focus Mode - Ctrl+Shift+F)">
                <iconify-icon icon="solar:maximize-square-3-linear" class="text-base"></iconify-icon>
                <span class="hidden xl:inline text-2xs">Tập trung</span>
            </button>

            <!-- Preview Mode -->
            <button type="button" id="btn-preview" class="px-2.5 py-1.5 text-slate-700 hover:text-primary hover:bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold flex items-center gap-1 transition-all" title="Xem trước không có viền công cụ (Preview)">
                <iconify-icon icon="solar:eye-linear" class="text-base"></iconify-icon>
                <span class="hidden xl:inline text-2xs">Xem trước</span>
            </button>

            <!-- Fullscreen -->
            <button type="button" id="btn-fullscreen" class="p-1.5 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors" title="Toàn màn hình (Fullscreen)">
                <iconify-icon icon="solar:full-screen-linear" class="text-base"></iconify-icon>
            </button>

            <div class="h-4 w-px bg-slate-200 mx-0.5"></div>

            <!-- Save Draft -->
            <button type="button" id="btn-save-draft" class="px-3.5 py-1.5 bg-slate-900 hover:bg-black text-white text-xs font-bold rounded-xl shadow-xs flex items-center gap-1.5 transition-all">
                <iconify-icon icon="solar:diskette-bold" class="text-sm"></iconify-icon>
                <span class="btn-text">Lưu nháp</span>
            </button>

            <!-- Publish -->
            <button type="button" id="btn-publish" class="px-3.5 py-1.5 bg-primary hover:bg-primary/90 text-white text-xs font-bold rounded-xl shadow-md shadow-primary/20 flex items-center gap-1.5 transition-all">
                <iconify-icon icon="solar:upload-track-2-bold" class="text-sm"></iconify-icon>
                <span class="btn-text">Xuất bản</span>
            </button>
        </div>
    </header>

    <!-- Workspace -->
    <div class="builder-workspace">
        
        <!-- Left Sidebar: width 280px (collapsible) -->
        <aside id="builder-left-sidebar" class="builder-sidebar-left shadow-xs">
            <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50/75 p-2 shrink-0">
                <div class="flex items-center gap-1 bg-slate-100/80 p-0.5 rounded-lg border border-slate-200/60">
                    <button type="button" class="sidebar-tab-btn active px-3 py-1 text-2xs font-bold rounded-md transition-all" data-tab-group="left" data-tab-target="#tab-blocks">
                        Khối (Blocks)
                    </button>
                    <button type="button" class="sidebar-tab-btn px-3 py-1 text-2xs font-bold rounded-md transition-all" data-tab-group="left" data-tab-target="#tab-layers">
                        Lớp (Layers)
                    </button>
                </div>
                <button type="button" id="btn-collapse-left" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-200/60 transition-colors" title="Thu gọn bảng trái">
                    <iconify-icon icon="solar:alt-arrow-left-linear" class="text-base"></iconify-icon>
                </button>
            </div>

            <div id="tab-blocks" class="tab-pane flex-1 overflow-y-auto p-2" data-tab-group="left">
                <div id="gjs-blocks"></div>
            </div>

            <div id="tab-layers" class="tab-pane flex-1 overflow-y-auto p-2 hidden" data-tab-group="left">
                <div id="gjs-layers" class="p-2 text-xs"></div>
            </div>
        </aside>

        <!-- Floating Left Expand Button -->
        <button type="button" id="btn-expand-left" class="hidden absolute top-3 left-3 z-40 p-2 bg-white text-slate-700 rounded-xl shadow-md border border-slate-200 hover:bg-slate-50 hover:text-primary transition-all" title="Mở bảng Khối & Lớp">
            <iconify-icon icon="solar:sidebar-minimalistic-bold-duotone" class="text-lg"></iconify-icon>
        </button>

        <!-- Center: GrapesJS Canvas (flex: 1 1 auto, expands completely) -->
        <main class="builder-center-canvas">
            <div id="gjs-container"></div>
        </main>

        <!-- Floating Right Expand Button -->
        <button type="button" id="btn-expand-right" class="hidden absolute top-3 right-3 z-40 p-2 bg-white text-slate-700 rounded-xl shadow-md border border-slate-200 hover:bg-slate-50 hover:text-primary transition-all" title="Mở bảng Thuộc tính & Kiểu dáng">
            <iconify-icon icon="solar:tuning-bold-duotone" class="text-lg"></iconify-icon>
        </button>

        <!-- Right Sidebar: width 300px (collapsible) -->
        <aside id="builder-right-sidebar" class="builder-sidebar-right shadow-xs">
            <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50/75 p-2 shrink-0">
                <button type="button" id="btn-collapse-right" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-200/60 transition-colors" title="Thu gọn bảng phải">
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="text-base"></iconify-icon>
                </button>
                <div class="flex items-center gap-1 bg-slate-100/80 p-0.5 rounded-lg border border-slate-200/60">
                    <button type="button" class="sidebar-tab-btn active px-3 py-1 text-2xs font-bold rounded-md transition-all" data-tab-group="right" data-tab-target="#tab-traits">
                        Thuộc tính
                    </button>
                    <button type="button" class="sidebar-tab-btn px-3 py-1 text-2xs font-bold rounded-md transition-all" data-tab-group="right" data-tab-target="#tab-styles">
                        Kiểu dáng
                    </button>
                </div>
            </div>

            <div id="tab-traits" class="tab-pane flex-1 overflow-y-auto p-3" data-tab-group="right">
                <div id="gjs-traits" class="text-xs"></div>
            </div>

            <div id="tab-styles" class="tab-pane flex-1 overflow-y-auto p-3 hidden" data-tab-group="right">
                <div id="gjs-styles" class="text-xs"></div>
            </div>
        </aside>

    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('admin-assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('admin-assets/libs/grapesjs/grapes.min.js') }}"></script>

<!-- GrapesJS Modular Architecture -->
<script src="{{ asset('admin-assets/js/grapes-builder/adapters/laravel-storage.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/adapters/media.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/traits/common.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/heading.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/paragraph.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/button.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/image.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/divider.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/spacer.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/icon.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/video.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/section.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/container.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/column.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/columns.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/grid.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/stack.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/basic.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/layout.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/utils/id-manager.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/helpers.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/registry.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/hero.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/about.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/services.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/projects.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/gallery.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/cta.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/contact.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/sections.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/registry.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/base.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/product-grid.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/product-tabs.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/category-grid.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/post-list.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/latest-reviews.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/contact-form.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/partial.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/dynamic.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/commands.js') }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/editor.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    window.BUILDER_CONFIG = {
        locale: @json($contentLocale),
        builderData: @json($builderData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        initialHtml: @json($page->getTranslation('published_html', $contentLocale, false) ?: '', JSON_UNESCAPED_UNICODE),
        saveUrl: @json($saveUrl, JSON_UNESCAPED_SLASHES),
        publishUrl: @json($publishUrl, JSON_UNESCAPED_SLASHES),
        mediaResourcesUrl: @json($mediaResourcesUrl, JSON_UNESCAPED_SLASHES),
        mediaUploadUrl: @json($mediaUploadUrl, JSON_UNESCAPED_SLASHES),
        csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    window.editor = GrapesEditor.init(window.BUILDER_CONFIG);
});
</script>
</body>
</html>
