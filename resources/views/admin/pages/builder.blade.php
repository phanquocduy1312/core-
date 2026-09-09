<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full w-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trình thiết kế trực quan — {{ $page->getTranslation('title', $contentLocale, false) ?: $page->slug }}</title>

    {{--
        This page uses GrapesJS's native editor layout (its top panels, right-hand
        views container, and canvas).

        Font Awesome 4.7 is required: GrapesJS's default panel buttons are
        declared with `fa fa-*` class names.
    --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/grapesjs/grapes.min.css') }}">
    {{-- Tailwind utilities for the media-library modal, which is built from
         them. builder.css only, never admin.css: that one carries Tailwind's
         preflight, which would reset GrapesJS's own panel styling. --}}
    @vite(['resources/css/builder.css'])
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <style>
        :root {
            --gjs-left-width: 350px;
            --gjs-primary-color: #22272e;
            --gjs-secondary-color: #adbac7;
            --gjs-tertiary-color: #00a0d2;
            --gjs-quaternary-color: #38bdf8;
            --gjs-color-highlight: #00a0d2;
            --gjs-font-color: #cdd9e5;
            --gjs-main-dark-color: #1c2128;
        }

        html, body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: #1c2128;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        #gjs-container {
            height: 100%;
            width: 100%;
        }

        /* Topbar and Panel Sizing */
        .gjs-pn-commands {
            background: #181b1f !important;
            border-bottom: 1px solid #2d333b !important;
            height: 44px !important;
            z-index: 50 !important;
        }
        .gjs-pn-commands .gjs-pn-buttons {
            justify-content: flex-start;
            height: 100%;
            align-items: center;
        }

        .gjs-pn-options {
            background: #181b1f !important;
            border-bottom: 1px solid #2d333b !important;
            height: 44px !important;
            z-index: 51 !important;
        }
        .gjs-pn-options .gjs-pn-buttons {
            height: 100%;
            align-items: center;
        }

        .gjs-pn-views {
            background: #181b1f !important;
            border-bottom: 1px solid #2d333b !important;
            height: 44px !important;
            z-index: 52 !important;
        }
        .gjs-pn-views .gjs-pn-buttons {
            height: 100%;
            align-items: center;
        }

        .gjs-pn-views-container {
            background: #1c2128 !important;
            border-left: 1px solid #2d333b !important;
            top: 44px !important;
            height: calc(100% - 44px) !important;
            padding: 10px !important;
            box-sizing: border-box !important;
            color: #cdd9e5 !important;
            overflow-y: auto !important;
        }

        .gjs-cv-canvas {
            top: 44px !important;
            height: calc(100% - 44px) !important;
            box-sizing: border-box !important;
        }

        /* Topbar items that are labels rather than buttons */
        .gjs-pn-btn.builder-meta {
            color: #e2e8f0;
            cursor: default;
            font-size: 13px;
            font-weight: 700;
            max-width: 260px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 8px;
        }
        .gjs-pn-btn.builder-badge {
            border-radius: 10px;
            cursor: default;
            font-size: 10px;
            font-weight: 700;
            min-width: 0;
            padding: 3px 8px;
            margin: 0 4px;
        }
        .gjs-pn-btn.builder-badge--live { background: #17603a; color: #b7f0cf; }
        .gjs-pn-btn.builder-badge--draft { background: #6b4a10; color: #ffe0a3; }
        .gjs-pn-btn.builder-badge--partial { background: #312e81; color: #c7d2fe; }

        /* Save / publish / action buttons */
        .gjs-pn-btn.builder-action {
            border-radius: 4px;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            margin: 0 3px;
            cursor: pointer;
        }
        .gjs-pn-btn.builder-action--draft { background: #2d333b; color: #e2e8f0; border: 1px solid #444c56; }
        .gjs-pn-btn.builder-action--draft:hover { background: #373e47; color: #ffffff; }
        .gjs-pn-btn.builder-action--publish { background: #00a0d2; color: #ffffff; }
        .gjs-pn-btn.builder-action--publish:hover { background: #00b4ec; }
        .gjs-pn-btn.builder-action--header { background: #1e293b; color: #38bdf8; border: 1px solid #334155; }
        .gjs-pn-btn.builder-action--header:hover { background: #0f172a; color: #7dd3fc; }
        .gjs-pn-btn.builder-action--footer { background: #1e293b; color: #a78bfa; border: 1px solid #334155; }
        .gjs-pn-btn.builder-action--footer:hover { background: #0f172a; color: #c4b5fd; }
        .gjs-pn-btn.builder-action.gjs-pn-btn--busy { opacity: .5; cursor: progress; }

        .gjs-pn-btn.builder-locale.gjs-pn-active { background: #00a0d2; color: #ffffff; }

        /* Collapse Right Panel Toggle */
        html.builder-panel-collapsed {
            --gjs-left-width: 0px !important;
        }
        html.builder-panel-collapsed .gjs-pn-views,
        html.builder-panel-collapsed .gjs-pn-views-container {
            display: none !important;
        }

        /* Source-code modal */
        .builder-code-field {
            background: #1e1e1e;
            border: 1px solid #444;
            border-radius: 4px;
            color: #eee;
            font-family: ui-monospace, Menlo, Consolas, monospace;
            font-size: 12px;
            line-height: 1.5;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .builder-code-label {
            color: #ddd;
            display: block;
            font-size: 11px;
            font-weight: 700;
            margin: 10px 0 4px;
            text-transform: uppercase;
        }

        /* 2-Column Block Cards */
        .gjs-blocks-c {
            padding: 4px 0 !important;
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 8px !important;
        }
        .gjs-block {
            width: 100% !important;
            min-height: 80px !important;
            margin: 0 !important;
            padding: 12px 6px !important;
            background: #22272e !important;
            border: 1px solid #333940 !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2) !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            cursor: grab !important;
            transition: all 0.15s ease !important;
            user-select: none !important;
            box-sizing: border-box !important;
        }
        .gjs-block:hover {
            background: #2d333b !important;
            border-color: #00a0d2 !important;
            color: #ffffff !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(0, 160, 210, 0.25) !important;
        }
        .gjs-block .block-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            gap: 6px;
        }
        .gjs-block svg, .gjs-block iconify-icon, .gjs-block i {
            font-size: 24px !important;
            width: 24px !important;
            height: 24px !important;
            line-height: 24px !important;
            display: block !important;
            margin: 0 auto 2px !important;
            transition: transform 0.15s ease !important;
        }
        .gjs-block:hover svg, .gjs-block:hover iconify-icon, .gjs-block:hover i {
            transform: scale(1.1) !important;
        }
        .gjs-block .block-title {
            font-size: 11px !important;
            font-weight: 600 !important;
            color: #cbd5e1 !important;
            line-height: 1.25 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            max-width: 100% !important;
            display: block !important;
        }
        .gjs-block:hover .block-title {
            color: #ffffff !important;
        }
        .gjs-block-category .gjs-title {
            background: #181b1f !important;
            font-weight: 700 !important;
            font-size: 11.5px !important;
            letter-spacing: 0.5px !important;
            padding: 10px 14px !important;
            border-bottom: 1px solid #282f37 !important;
            color: #94a3b8 !important;
            text-transform: uppercase !important;
            cursor: pointer !important;
            transition: background 0.15s, color 0.15s !important;
        }
        .gjs-block-category .gjs-title:hover {
            background: #22272e !important;
            color: #e2e8f0 !important;
        }
        .gjs-block-category.gjs-open .gjs-title {
            color: #38bdf8 !important;
            border-bottom: 1px solid rgba(56, 189, 248, 0.25) !important;
        }

        /* Selection & Highlight */
        .gjs-cv-canvas .gjs-highlighter-sel {
            outline: 2px solid #00a0d2 !important;
            outline-offset: -1px !important;
        }
        .gjs-badge {
            background-color: #00a0d2 !important;
            color: #ffffff !important;
            border-radius: 4px 4px 0 0 !important;
            padding: 3px 8px !important;
            font-size: 11px !important;
            font-weight: 700 !important;
        }
        .gjs-toolbar {
            background-color: #00a0d2 !important;
            border-radius: 4px 4px 0 0 !important;
        }

        /* Style Manager Polishing */
        .gjs-sm-sector .gjs-sm-title {
            background: #181b1f !important;
            color: #94a3b8 !important;
            font-size: 11.5px !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px !important;
            padding: 10px 14px !important;
            border-bottom: 1px solid #282f37 !important;
            text-transform: uppercase !important;
            cursor: pointer !important;
        }
        .gjs-sm-sector.gjs-open .gjs-sm-title {
            color: #38bdf8 !important;
            border-bottom: 1px solid rgba(56, 189, 248, 0.25) !important;
        }
        .gjs-sm-property {
            padding: 6px 8px !important;
            box-sizing: border-box !important;
        }
        .gjs-sm-property .gjs-sm-label {
            font-size: 11px !important;
            font-weight: 600 !important;
            color: #cbd5e1 !important;
            white-space: normal !important;
            line-height: 1.3 !important;
            word-break: break-word !important;
            margin-bottom: 4px !important;
        }
        .gjs-sm-property.gjs-sm-composite .gjs-sm-properties {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 6px !important;
            padding: 4px 0 !important;
        }
        .gjs-sm-property.gjs-sm-composite .gjs-sm-properties .gjs-sm-property {
            padding: 3px !important;
            width: 100% !important;
        }
        .gjs-sm-property select,
        .gjs-sm-property input {
            background: #181b1f !important;
            border: 1px solid #333940 !important;
            border-radius: 6px !important;
            color: #f1f5f9 !important;
            font-size: 12px !important;
            min-height: 30px !important;
            padding: 4px 8px !important;
            box-sizing: border-box !important;
            width: 100% !important;
        }
        .gjs-sm-property select:focus,
        .gjs-sm-property input:focus {
            border-color: #00a0d2 !important;
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(0, 160, 210, 0.2) !important;
        }
        .gjs-sm-property .gjs-sm-preview {
            max-height: 50px !important;
            border-radius: 4px !important;
            border: 1px solid #333940 !important;
        }
    </style>
</head>
<body>

<div id="gjs-container"></div>

<!-- Scripts -->
<script src="{{ asset('admin-assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('admin-assets/libs/grapesjs/grapes.min.js') }}"></script>

<!-- GrapesJS Modular Architecture -->
<script src="{{ asset('admin-assets/js/grapes-builder/adapters/laravel-storage.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/adapters/media.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/traits/common.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/heading.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/paragraph.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/link.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/button.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/image.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/divider.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/spacer.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/icon.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/video.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/custom-html.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/section.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/container.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/column.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/columns.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/grid.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/components/stack.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/basic.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/layout.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/content-widgets.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/utils/id-manager.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/helpers.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/registry.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/hero.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/about.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/services.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/projects.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/gallery.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/cta.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/sections/contact.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/sections.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/registry.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/base.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/product-grid.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/product-tabs.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/category-grid.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/post-list.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/project-grid.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/latest-reviews.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/contact-form.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/dynamic/partial.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/blocks/dynamic.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/style-sectors.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/canvas-context.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/rte.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/imported-markup.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/commands.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/panels.js').'?v='.$builderVersion }}"></script>
<script src="{{ asset('admin-assets/js/grapes-builder/core/editor.js').'?v='.$builderVersion }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    window.BUILDER_CONFIG = {
        locale: @json($contentLocale),
        labels: { loadMore: @json(__('pages.load_more')), uploadFailed: @json(__('pages.upload_failed')) },
        builderData: @json($builderData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        initialHtml: @json($editorContent['html'], JSON_UNESCAPED_UNICODE),
        initialCss: @json($editorContent['css'], JSON_UNESCAPED_UNICODE),

        // Frontend parity — see config/theme.php. The canvas loads the exact
        // stylesheet list and body classes the public site uses, so the design
        // surface and the live page cannot drift apart.
        canvasStyles: @json($canvasStyles, JSON_UNESCAPED_SLASHES),
        canvasBodyClass: @json($canvasBodyClass),
        canvasContentClass: @json($canvasContentClass),
        canvasHeaderHtml: @json($canvasHeaderHtml, JSON_UNESCAPED_UNICODE),
        canvasFooterHtml: @json($canvasFooterHtml, JSON_UNESCAPED_UNICODE),

        // Topbar metadata, rendered as GrapesJS panel buttons.
        pageTitle: @json($page->getTranslation('title', $contentLocale, false) ?: $page->slug),
        isPublished: @json((bool) $page->is_active),
        isPartial: @json($page->isPartial()),
        partialRole: @json($page->partial_role),
        backUrl: @json($backUrl ?? route('admin.pages.index', ['locale' => app()->getLocale()]), JSON_UNESCAPED_SLASHES),
        headerBuilderUrl: @json($headerBuilderUrl ?? null, JSON_UNESCAPED_SLASHES),
        footerBuilderUrl: @json($footerBuilderUrl ?? null, JSON_UNESCAPED_SLASHES),
        contentLanguages: @json($contentLanguageLinks, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),

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
