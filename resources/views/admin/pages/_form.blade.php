@php
    $storedBuilderData = old('builder_data', $page->builder_data ?: ['version' => 1, 'locales' => []]);
    if (is_string($storedBuilderData)) $storedBuilderData = json_decode($storedBuilderData, true) ?: ['version' => 1, 'locales' => []];
    $storedHtml = old('published_html', $page->exists ? $page->getTranslations('published_html') : []);
    $storedCss = old('published_css', $page->exists ? $page->getTranslations('published_css') : []);
    $editorState = [
        'version' => 1,
        'locales' => data_get($storedBuilderData, 'locales', []),
        'html' => is_array($storedHtml) ? $storedHtml : [],
        'css' => is_array($storedCss) ? $storedCss : [],
    ];
    $allPartialsJson = ($allPartials ?? collect())->map(function ($partial) {
        return ['id' => $partial->id, 'title' => $partial->getTranslation('title', app()->getLocale(), false)];
    })->values();
@endphp

@include('admin.pages.partials.onboarding')

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <h4 class="text-xl font-bold text-gray-900">{{ $page->exists ? ($page->type === 'partial' ? 'Chỉnh sửa khối dùng chung' : 'Chỉnh sửa trang') : ($page->type === 'partial' ? 'Thêm khối dùng chung' : 'Thêm trang') }}</h4>
        <p class="text-xs text-gray-400">Kéo block vào canvas, chọn block để chỉnh nội dung và kiểu hiển thị.</p>
    </div>
    <div class="flex items-center gap-2">
        <x-admin.button type="button" variant="outline" size="sm" id="page-builder-preview-button" class="flex items-center gap-1">
            <iconify-icon icon="solar:eye-linear" class="text-base"></iconify-icon>
            <span>Xem trước</span>
        </x-admin.button>
        <x-admin.button variant="outline" size="sm" href="{{ $backRoute ?? route('admin.pages.index') }}">
            Quay lại
        </x-admin.button>
        <x-admin.button type="submit" variant="primary" size="sm">
            Lưu trang
        </x-admin.button>
    </div>
</div>

@if($page->type === 'partial')
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">
        <label class="block mb-2 text-sm font-semibold text-gray-905">Vai trò khối</label>
        <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none max-w-xs" name="partial_role">
            <option value="header" @selected(old('partial_role', $page->partial_role) === 'header')>Header</option>
            <option value="footer" @selected(old('partial_role', $page->partial_role) === 'footer')>Footer</option>
            <option value="generic" @selected(old('partial_role', $page->partial_role) === 'generic')>Khối dùng chung khác (CTA, banner...)</option>
        </select>
        <p class="text-2xs text-gray-400 mt-2">Header/Footer có thể đặt làm mặc định cho toàn site tại Cấu hình chung.</p>
    </div>
@else
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">
        <label class="block text-sm font-bold text-gray-905 mb-4 border-b border-gray-150 pb-2">Header / Footer cho trang này</label>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Header</label>
                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none page-partial-mode" name="header_mode" data-target="#header-partial-picker">
                    <option value="inherit" @selected(old('header_mode', $page->header_mode ?? 'inherit') === 'inherit')>Theo mặc định site</option>
                    <option value="custom" @selected(old('header_mode', $page->header_mode ?? 'inherit') === 'custom')>Chỉ định riêng</option>
                    <option value="none" @selected(old('header_mode', $page->header_mode ?? 'inherit') === 'none')>Không dùng header</option>
                </select>
                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none mt-2" name="header_partial_id" id="header-partial-picker" style="{{ old('header_mode', $page->header_mode ?? 'inherit') === 'custom' ? '' : 'display:none' }}">
                    <option value="">— Chọn khối header —</option>
                    @foreach($headerPartials ?? [] as $partial)
                        <option value="{{ $partial->id }}" @selected(old('header_partial_id', $page->header_partial_id) == $partial->id)>{{ $partial->getTranslation('title', app()->getLocale(), false) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Footer</label>
                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none page-partial-mode" name="footer_mode" data-target="#footer-partial-picker">
                    <option value="inherit" @selected(old('footer_mode', $page->footer_mode ?? 'inherit') === 'inherit')>Theo mặc định site</option>
                    <option value="custom" @selected(old('footer_mode', $page->footer_mode ?? 'inherit') === 'custom')>Chỉ định riêng</option>
                    <option value="none" @selected(old('footer_mode', $page->footer_mode ?? 'inherit') === 'none')>Không dùng footer</option>
                </select>
                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none mt-2" name="footer_partial_id" id="footer-partial-picker" style="{{ old('footer_mode', $page->footer_mode ?? 'inherit') === 'custom' ? '' : 'display:none' }}">
                    <option value="">— Chọn khối footer —</option>
                    @foreach($footerPartials ?? [] as $partial)
                        <option value="{{ $partial->id }}" @selected(old('footer_partial_id', $page->footer_partial_id) == $partial->id)>{{ $partial->getTranslation('title', app()->getLocale(), false) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.page-partial-mode').forEach(function (select) {
            const target = document.querySelector(select.dataset.target);
            if (!target) return;
            select.addEventListener('change', function () {
                target.style.display = select.value === 'custom' ? '' : 'none';
            });
        });
    </script>
@endif

@if($errors->any())
    <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li class="font-bold">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Localized SEO Card -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">
    <div x-data="{ activeLanguage: '{{ $defaultContentLocale }}' }" class="space-y-4">
        <!-- Language tabs bar -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-4 overflow-x-auto" aria-label="Languages">
                @foreach($contentLanguages as $language)
                    <button type="button" @click="activeLanguage = '{{ $language->code }}'" 
                            :class="activeLanguage === '{{ $language->code }}' ? 'border-primary text-primary font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" 
                            class="whitespace-nowrap pb-3 px-1 border-b-2 font-semibold text-xs flex items-center gap-1 focus:outline-none transition-colors">
                        <iconify-icon icon="solar:global-linear" class="text-base"></iconify-icon>
                        <span>{{ $language->native_name }}</span>
                    </button>
                @endforeach
            </nav>
        </div>
        
        <div class="pt-2">
            @foreach($contentLanguages as $language)
                @php $code = $language->code; @endphp
                <div x-show="activeLanguage === '{{ $code }}'" class="grid grid-cols-1 md:grid-cols-12 gap-5">
                    <div class="md:col-span-8">
                        <label class="block mb-2 text-sm font-semibold text-gray-900">Tiêu đề @if($code === $defaultContentLocale)<span class="text-red-500">*</span>@endif</label>
                        <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="title[{{ $code }}]" value="{{ old("title.$code", $page->getTranslation('title', $code, false)) }}" @required($code === $defaultContentLocale)>
                    </div>
                    <div class="md:col-span-4">
                        <label class="block mb-2 text-sm font-semibold text-gray-900">Slug</label>
                        <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="slug[{{ $code }}]" value="{{ old("slug.$code", $page->localizedSlug($code) ?: ($code === $defaultContentLocale ? $page->slug : '')) }}" placeholder="Tự tạo từ tiêu đề">
                    </div>
                    <div class="md:col-span-6">
                        <label class="block mb-2 text-sm font-semibold text-gray-900">SEO title</label>
                        <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="meta_title[{{ $code }}]" value="{{ old("meta_title.$code", $page->getTranslation('meta_title', $code, false)) }}">
                    </div>
                    <div class="md:col-span-6">
                        <label class="block mb-2 text-sm font-semibold text-gray-900">SEO description</label>
                        <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="meta_description[{{ $code }}]" value="{{ old("meta_description.$code", $page->getTranslation('meta_description', $code, false)) }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- GrapesJS Page Builder Card -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">
    <div id="page-builder-status" class="p-3 bg-blue-50 text-blue-800 text-xs font-semibold flex items-center gap-2 border-b border-gray-150">
        <iconify-icon icon="solar:spinner-linear" class="animate-spin text-base"></iconify-icon>
        <span>Đang tải trình dựng trang…</span>
    </div>

    <div class="pb-wrapper">
        <!-- Left Panel -->
        <div class="pb-left-panel">
            <div class="pb-panel-header">
                <h3 class="pb-panel-title">Cấu trúc trang</h3>
                <button type="button" class="pb-toolbar-btn" id="pb-panel-settings-toggle" title="Cài đặt khối">
                    <iconify-icon icon="solar:settings-linear"></iconify-icon>
                </button>
            </div>
            
            <div class="p-3 border-b border-gray-200 bg-gray-50/50 flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <label for="page-builder-locale" class="text-xs font-bold text-gray-900">Ngôn ngữ:</label>
                    <select id="page-builder-locale" class="p-1.5 text-xs text-gray-900 bg-white rounded-lg border border-gray-350 focus:outline-none" disabled>
                        @foreach($contentLanguages as $language)
                            <option value="{{ $language->code }}" @selected($language->code === $defaultContentLocale)>{{ $language->native_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-wrap gap-1.5">
                    <button type="button" class="flex-grow flex items-center justify-center gap-1 py-1.5 px-2 text-2xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none" id="page-builder-blocklist-button" title="Danh sách khối">
                        <iconify-icon icon="solar:widget-3-linear" class="text-xs"></iconify-icon>
                        <span>Khối</span>
                    </button>
                    <button type="button" class="flex-grow flex items-center justify-center gap-1 py-1.5 px-2 text-2xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none" id="page-builder-html-button" title="Dán HTML/CSS">
                        <iconify-icon icon="solar:code-linear" class="text-xs"></iconify-icon>
                        <span>Nhập HTML</span>
                    </button>
                    @can('manage_media')
                        <input type="file" id="page-builder-media" class="hidden" accept="image/*" data-media-folder="general">
                        <button type="button" class="w-full flex items-center justify-center gap-1 py-1.5 px-2 text-2xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none" id="page-builder-media-button" title="Chọn ảnh cho block">
                            <iconify-icon icon="solar:gallery-add-linear" class="text-xs"></iconify-icon>
                            <span>Chọn ảnh block</span>
                        </button>
                    @endcan
                </div>
            </div>

            <div class="pb-panel-body">
                <div class="pb-tree" id="pb-element-tree"></div>
            </div>
            
            <div class="pb-panel-footer">
                <button type="button" id="pb-submit-proxy" class="w-full py-2.5 px-4 text-sm font-bold text-white bg-primary hover:bg-primary-hover active:bg-primary-active rounded-lg transition-colors focus:outline-none flex items-center justify-center gap-2">
                    <iconify-icon icon="solar:diskette-linear" class="text-base"></iconify-icon>
                    <span>Cập nhật</span>
                </button>
            </div>
        </div>

        <!-- Center Canvas -->
        <div class="pb-canvas-container">
            <div id="page-builder-canvas-wrapper" style="height: 100%;">
                <div id="page-builder-canvas" class="bg-gray-100 min-h-[500px]"></div>
            </div>
        </div>

        <!-- Right Vertical Toolbar -->
        <div class="pb-right-toolbar">
            <button type="button" class="pb-toolbar-btn" id="page-builder-undo-button" title="Hoàn tác (Ctrl+Z)">
                <iconify-icon icon="solar:undo-left-linear"></iconify-icon>
            </button>
            <button type="button" class="pb-toolbar-btn" id="page-builder-redo-button" title="Làm lại (Ctrl+Shift+Z)">
                <iconify-icon icon="solar:undo-right-linear"></iconify-icon>
            </button>
            <div class="border-t border-gray-200 w-6 my-1"></div>
            <button type="button" class="pb-toolbar-btn is-active" id="pb-device-desktop" title="Máy tính">
                <iconify-icon icon="solar:monitor-linear"></iconify-icon>
            </button>
            <button type="button" class="pb-toolbar-btn" id="pb-device-tablet" title="Máy tính bảng">
                <iconify-icon icon="solar:tablet-linear"></iconify-icon>
            </button>
            <button type="button" class="pb-toolbar-btn" id="pb-device-mobile" title="Điện thoại">
                <iconify-icon icon="solar:smartphone-linear"></iconify-icon>
            </button>
            <div class="border-t border-gray-200 w-6 my-1"></div>
            <button type="button" class="pb-toolbar-btn" id="pb-preview-btn" title="Xem trên trang web">
                <iconify-icon icon="solar:play-circle-linear"></iconify-icon>
            </button>
        </div>

        <!-- Settings Drawer -->
        <div class="pb-settings-drawer is-hidden" id="pb-settings-drawer">
            <div class="pb-settings-header">
                <h4 class="pb-settings-title">Cài đặt khối</h4>
                <button type="button" class="pb-toolbar-btn" id="pb-settings-close" title="Đóng">
                    <iconify-icon icon="solar:close-circle-linear"></iconify-icon>
                </button>
            </div>
            <div class="pb-settings-body" id="pb-settings-body"></div>
        </div>
    </div>
</div>

<!-- Dán HTML/CSS Modal -->
<div x-data="{ open: false }" 
     @keydown.escape.window="open = false" 
     class="relative z-50" 
     id="pageBuilderHtmlModal"
     style="display: none;"
     x-show="open" 
     x-transition>
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-gray-150">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50/50">
                    <div>
                        <h3 class="text-base font-bold text-gray-900" id="pageBuilderHtmlModalLabel">Dán HTML/CSS</h3>
                        <p class="text-3xs text-gray-400 mt-0.5">Áp dụng cho ngôn ngữ đang chọn. Script, form và event handler sẽ bị loại bỏ.</p>
                    </div>
                    <button type="button" @click="open = false" class="text-gray-450 hover:text-gray-600 focus:outline-none">
                        <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                        <div class="lg:col-span-7">
                            <label for="page-builder-html-source" class="block mb-2 text-sm font-semibold text-gray-900">HTML</label>
                            <textarea id="page-builder-html-source" class="block w-full p-2.5 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none font-mono" rows="18" spellcheck="false" placeholder="<section>...</section>"></textarea>
                        </div>
                        <div class="lg:col-span-5">
                            <label for="page-builder-css-source" class="block mb-2 text-sm font-semibold text-gray-900">CSS</label>
                            <textarea id="page-builder-css-source" class="block w-full p-2.5 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none font-mono" rows="18" spellcheck="false" placeholder=".hero { ... }"></textarea>
                        </div>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-800 text-2xs font-semibold rounded-lg border border-amber-200">
                        Nếu HTML có thẻ <code>&lt;style&gt;</code>, CSS bên trong sẽ tự động được đưa sang ô CSS.
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-end gap-2 bg-gray-50/50">
                    <button type="button" @click="open = false" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-4 py-2 text-xs">
                        Đóng
                    </button>
                    <button type="button" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-primary text-primary hover:bg-red-50/20 px-4 py-2 text-xs" id="page-builder-html-append">
                        Chèn thêm
                    </button>
                    <button type="button" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white px-4 py-2 text-xs" id="page-builder-html-replace">
                        Thay toàn bộ canvas
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@unless($page->exists)
<!-- Chọn mẫu khởi tạo Modal -->
<div x-data="{ open: false }" 
     @keydown.escape.window="open = false" 
     class="relative z-50" 
     id="pageTemplateModal"
     style="display: none;"
     x-show="open" 
     x-transition>
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-150">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50/50">
                    <h3 class="text-base font-bold text-gray-900" id="pageTemplateModalLabel">Chọn mẫu khởi tạo</h3>
                </div>

                <div class="p-6 space-y-4">
                    <p class="text-xs text-gray-450">Bắt đầu nhanh với một mẫu có sẵn, hoặc bắt đầu từ trang trắng.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(['home' => 'Trang chủ', 'about' => 'Giới thiệu', 'contact' => 'Liên hệ', 'promo' => 'Landing khuyến mãi'] as $key => $label)
                            <button type="button" class="inline-flex items-center justify-center font-bold rounded-lg border border-primary text-primary hover:bg-red-50/20 py-3 text-xs page-template-choice" data-template="{{ $key }}">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                    <button type="button" class="w-full inline-flex items-center justify-center font-semibold rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 py-2.5 text-xs mt-2" data-bs-dismiss="modal" id="page-template-blank">
                        Bắt đầu từ trang trắng
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endunless

<!-- Bottom Actions Card -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 flex flex-wrap items-center justify-between gap-4 mt-6">
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-900">Trạng thái trang</label>
        <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="is_active">
            <option value="0" @selected(!old('is_active', $page->is_active))>Bản nháp</option>
            <option value="1" @selected(old('is_active', $page->is_active))>Xuất bản</option>
        </select>
    </div>
    <div class="align-self-end">
        <x-admin.button type="submit" variant="primary" size="md">
            Lưu trang
        </x-admin.button>
    </div>
</div>

<input type="hidden" name="builder_data" id="page-builder-data">
<input type="hidden" name="published_html" id="page-builder-html">
<input type="hidden" name="published_css" id="page-builder-css">

@push('styles')
<link rel="stylesheet" href="{{ asset('admin-assets/libs/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/libs/grapesjs/grapes.min.css') }}">
<style>
    #page-builder-canvas {
        height: 600px !important;
    }
    #page-builder-canvas .fa { font-family: FontAwesome !important; }
    #page-builder-canvas iframe.gjs-frame {
        min-height: 580px;
    }
    #page-builder-canvas,
    #page-builder-canvas * {
        box-sizing: border-box;
    }
    .page-builder-card {
        border: 1px solid #dfe5ef;
        border-radius: 7px;
    }
    .gjs-cv-canvas {
        background-color: #fafbfc !important;
        width: 100% !important;
        height: 100% !important;
    }
    .gjs-blocks-c {
        background-color: #ffffff !important;
    }
    .gjs-block {
        width: 100% !important;
        min-height: auto !important;
        padding: 12px !important;
        background-color: #ffffff !important;
        border: 1px solid #dfe5ef !important;
        border-radius: 6px !important;
        margin-bottom: 8px !important;
        color: #2a3547 !important;
        font-family: inherit !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        transition: all 0.2s ease;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        cursor: grab !important;
        box-shadow: none !important;
    }
    .gjs-block:hover {
        border-color: #5d87ff !important;
        color: #5d87ff !important;
        background-color: #ecf2ff !important;
    }
    .gjs-block-label {
        display: block !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
    }
    .gjs-block svg {
        width: 18px !important;
        height: 18px !important;
        fill: currentColor !important;
        flex-shrink: 0 !important;
    }
    .gjs-commands-pn, .gjs-devices-c {
        display: none !important;
    }
    .gjs-pn-views-container {
        border-left: 1px solid #dfe5ef !important;
        width: 280px !important;
        background-color: #ffffff !important;
        box-shadow: none !important;
        margin-top: 42px !important;
        height: calc(100% - 42px) !important;
    }
    .gjs-pn-views {
        border-bottom: 1px solid #dfe5ef !important;
        background-color: #f8f9fa !important;
        display: flex !important;
        justify-content: space-around !important;
    }
    .gjs-pn-btn {
        padding: 12px !important;
        color: #7c8fac !important;
        font-size: 16px !important;
        border-bottom: 2px solid transparent !important;
        transition: all 0.2s ease !important;
    }
    .gjs-pn-btn.gjs-pn-active {
        color: #5d87ff !important;
        border-bottom-color: #5d87ff !important;
        background-color: transparent !important;
        box-shadow: none !important;
    }
    /* GrapesJS Light Theme Overrides */
    .gjs-one-bg {
        background-color: #ffffff !important;
    }
    .gjs-two-bg {
        background-color: #f8f9fa !important;
    }
    .gjs-three-bg {
        background-color: #f1f3f6 !important;
    }
    .gjs-four-color, .gjs-two-color, .gjs-clm-tags, .gjs-clm-header {
        color: #2a3547 !important;
    }
    .gjs-clm-tags {
        background-color: #f8f9fa !important;
        border-bottom: 1px solid #dfe5ef !important;
    }
    .gjs-clm-header-label, .gjs-sm-title, .gjs-label {
        color: #2a3547 !important;
        font-weight: 600 !important;
    }
    
    /* GrapesJS style fields, inputs and selects */
    .gjs-field, .gjs-clm-tags-field {
        background-color: #ffffff !important;
        border: 1px solid #dfe5ef !important;
        border-radius: 6px !important;
        color: #2a3547 !important;
    }
    .gjs-field input, .gjs-field select, .gjs-field textarea,
    .gjs-clm-tags-field input, .gjs-clm-tags-field select {
        background-color: #ffffff !important;
        color: #2a3547 !important;
        font-size: 13px !important;
        font-family: inherit !important;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
    }
    .gjs-field input:focus, .gjs-field select:focus {
        outline: none !important;
        border: none !important;
    }
    
    /* GrapesJS Unit selector */
    .gjs-input-unit, select.gjs-input-unit, .gjs-field-units {
        background-color: #f8f9fa !important;
        color: #7c8fac !important;
        font-size: 11px !important;
        border-left: 1px solid #dfe5ef !important;
        cursor: pointer !important;
    }
    .gjs-input-unit:hover {
        color: #5d87ff !important;
    }
    
    /* GrapesJS Radio Position Button Groups */
    .gjs-radio-item-label {
        background-color: #ffffff !important;
        border: 1px solid #dfe5ef !important;
        color: #2a3547 !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        padding: 5px 10px !important;
        border-radius: 4px !important;
        cursor: pointer !important;
        transition: all 0.15s ease !important;
        display: inline-block !important;
        text-align: center !important;
    }
    .gjs-radio-item-label:hover {
        background-color: #f8f9fa !important;
        border-color: #cbd5e1 !important;
    }
    .gjs-radio-item input:checked + .gjs-radio-item-label {
        background-color: #5d87ff !important;
        color: #ffffff !important;
        border-color: #5d87ff !important;
    }
    .gjs-radio-items {
        padding: 4px 0 !important;
        display: flex !important;
        gap: 4px !important;
    }

    .gjs-sm-sector-title {
        background-color: #f8f9fa !important;
        border-bottom: 1px solid #dfe5ef !important;
        color: #2a3547 !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        padding: 10px 14px !important;
    }
    .gjs-sm-sector-title .gjs-caret {
        color: #7c8fac !important;
    }
    .gjs-sm-properties {
        background-color: #ffffff !important;
        padding: 14px !important;
    }
    .gjs-sm-property {
        margin-bottom: 12px !important;
    }
    .gjs-sm-label {
        color: #7c8fac !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        margin-bottom: 6px !important;
    }
    .gjs-sm-btn {
        background-color: #f8f9fa !important;
        border: 1px solid #dfe5ef !important;
        border-radius: 6px !important;
        color: #2a3547 !important;
        padding: 6px 12px !important;
    }
    .gjs-sm-btn:hover {
        background-color: #e9edf0 !important;
    }
    
    .gjs-layer-name, .gjs-layer-title {
        color: #2a3547 !important;
    }
    .gjs-layer.gjs-active {
        background-color: #ecf2ff !important;
        color: #5d87ff !important;
    }
    .gjs-layer-icon {
        color: #7c8fac !important;
    }
    .gjs-cv-canvas-outer {
        height: 100% !important;
    }
    .page-builder-card.fullscreen-canvas {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        z-index: 99 !important; /* Low enough to let modals and popups render on top, high enough to cover layout */
    }
</style>
@endpush

@push('scripts')
<script>
    // Mock bootstrap Modal integration for GrapesJS modal triggering compatibility without bootstrap dependency
    window.bootstrap = window.bootstrap || {
        Modal: {
            getOrCreateInstance: function(el) {
                return {
                    show: function() {
                        if (el && el.__x) {
                            el.__x.$data.open = true;
                        } else if (el) {
                            el.style.display = 'block';
                            let backdrop = document.querySelector('.page-builder-modal-backdrop');
                            if (!backdrop) {
                                backdrop = document.createElement('div');
                                backdrop.className = 'fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 page-builder-modal-backdrop';
                                document.body.appendChild(backdrop);
                            }
                            el.classList.add('z-50');
                        }
                    },
                    hide: function() {
                        if (el && el.__x) {
                            el.__x.$data.open = false;
                        } else if (el) {
                            el.style.display = 'none';
                            const backdrop = document.querySelector('.page-builder-modal-backdrop');
                            if (backdrop) backdrop.remove();
                        }
                    }
                };
            },
            getInstance: function(el) {
                return this.getOrCreateInstance(el);
            }
        }
    };
</script>
<script src="{{ asset('admin-assets/libs/grapesjs/grapes.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/page-builder-blocks.js') }}?v={{ time() }}"></script>
<script src="{{ asset('admin-assets/js/page-builder-shell.js') }}?v={{ time() }}"></script>
<script src="{{ asset('admin-assets/js/page-builder-editor.js') }}?v={{ time() }}"></script>
<script>
window.pageBuilderPartials = @json($allPartialsJson);
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('page-builder-form');
    const builderStatus = document.getElementById('page-builder-status');
    if (!form) return;
    function showBuilderError(message) {
        builderStatus.className = 'p-3 bg-red-50 text-red-800 text-xs font-semibold flex items-center gap-2 border-b border-red-200';
        builderStatus.innerHTML = '<iconify-icon icon="solar:danger-circle-linear" class="text-base"></iconify-icon>' + message;
    }
    if (typeof grapesjs === 'undefined') {
        showBuilderError('Không tải được thư viện Page Builder. Hãy tải lại trang bằng Ctrl + Shift + R.');
        return;
    }

    try {
    const state = @json($editorState);
    const localeSelect = document.getElementById('page-builder-locale');
    let activeLocale = localeSelect.value;
    let editorReady = false;

    const editor = grapesjs.init({
        container: '#page-builder-canvas',
        height: '100%',
        storageManager: false,
        noticeOnUnload: false,
        fromElement: false,
        panels: { defaults: [] },
        styleManager: {
            appendTo: '#pb-settings-body',
            sectors: [
                { name: 'Bố cục', open: true, buildProps: ['display', 'position', 'width', 'max-width', 'min-height', 'margin', 'padding', 'gap', 'justify-content', 'align-items'] },
                { name: 'Chữ', open: false, buildProps: ['font-family', 'font-size', 'font-weight', 'line-height', 'text-align', 'color'] },
                { name: 'Nền & viền', open: false, buildProps: ['background-color', 'background-image', 'border', 'border-radius', 'box-shadow', 'opacity'] },
            ]
        },
        traitManager: {
            appendTo: '#pb-settings-body',
        },
        selectorManager: {
            appendTo: '#pb-settings-body',
            componentFirst: true
        },
        deviceManager: {
            devices: [
                { id: 'desktop', name: 'Desktop', width: '' },
                { id: 'tablet', name: 'Tablet', width: '768px', widthMedia: '992px' },
                { id: 'mobile', name: 'Mobile', width: '375px', widthMedia: '576px' },
            ]
        },
        cssIcons: @json(asset('admin-assets/libs/font-awesome/css/font-awesome.min.css')),
        i18n: {
            locale: document.documentElement.lang || 'vi',
            detectLocale: false,
            localeFallback: 'vi',
            messages: {
                vi: {
                    panels: {
                        buttons: {
                            titles: {
                                preview: 'Chế độ xem trước (Preview)',
                                fullscreen: 'Toàn màn hình (Fullscreen)',
                                'sw-visibility': 'Hiện/Ẩn viền khung (Grid outline)',
                                'export-template': 'Xem mã nguồn (Code view)',
                                'open-sm': 'Chỉnh sửa kiểu dáng (Style Manager)',
                                'open-tm': 'Cấu hình thuộc tính (Trait Manager)',
                                'open-layers': 'Quản lý các lớp (Layers)',
                                'open-blocks': 'Quản lý các khối (Blocks)'
                            }
                        }
                    }
                }
            }
        },
    });
    editor.on('load', initializeBuilderContent);

    registerPageBuilderBlocks(editor);
    registerPageBuilderEditorEnhancements(editor, {
        csrfToken: @json(csrf_token()),
        saveAsPartialUrl: @json(route('admin.partials.from-selection')),
    });

    mountPageBuilderShell(editor, { mode: 'admin', container: '#page-builder-canvas' });

    document.getElementById('page-builder-blocklist-button').addEventListener('click', function () {
        openPageBuilderBlockList();
    });

    document.getElementById('page-builder-undo-button').addEventListener('click', function () {
        editor.runCommand('core:undo');
    });
    document.getElementById('page-builder-redo-button').addEventListener('click', function () {
        editor.runCommand('core:redo');
    });

    window.addEventListener('beforeunload', function (event) {
        if (editorReady && editor.getDirtyCount() > 0) {
            event.preventDefault();
            event.returnValue = '';
        }
    });

    const draftPageId = @json($page->exists ? $page->id : 'new');
    function currentDraftKey() {
        return 'pageBuilderDraft:' + draftPageId + ':' + activeLocale;
    }
    let draftTimer = null;

    function saveDraft() {
        if (!editorReady) return;
        saveLocale();
        try {
            window.localStorage.setItem(currentDraftKey(), JSON.stringify({
                savedAt: Date.now(),
                html: state.html[activeLocale] || '',
                css: state.css[activeLocale] || '',
                builderData: state.locales[activeLocale] || null,
            }));
        } catch (error) {
            // Storage may be full or disabled; autosave is a convenience, not critical.
        }
    }

    function maybeOfferDraftRestore() {
        let draft = null;
        try {
            draft = JSON.parse(window.localStorage.getItem(currentDraftKey()) || 'null');
        } catch (error) {
            draft = null;
        }
        if (!draft || !draft.html) return false;

        const savedAt = draft.savedAt ? new Date(draft.savedAt).toLocaleString('vi-VN') : '';
        const shouldRestore = window.confirm(
            'Phát hiện bản nháp chưa lưu' + (savedAt ? ' lúc ' + savedAt : '') + '. Khôi phục bản nháp này?'
        );
        if (!shouldRestore) {
            window.localStorage.removeItem(currentDraftKey());
            return false;
        }

        if (draft.builderData) {
            editor.loadProjectData(draft.builderData);
        } else {
            editor.setComponents(draft.html);
            editor.setStyle(draft.css || '');
        }
        state.html[activeLocale] = draft.html;
        state.css[activeLocale] = draft.css || '';
        if (draft.builderData) state.locales[activeLocale] = draft.builderData;
        return true;
    }

    function saveLocale() {
        if (!editorReady) return;
        state.locales[activeLocale] = editor.getProjectData();
        state.html[activeLocale] = editor.getHtml();
        state.css[activeLocale] = editor.getCss();
    }

    function loadLocale(locale) {
        const project = state.locales[locale];
        if (project) {
            editor.loadProjectData(project);
        } else {
            editor.setComponents(state.html[locale] || '');
            editor.setStyle(state.css[locale] || '');
        }
        activeLocale = locale;
        editor.refresh();
    }

    function initializeBuilderContent() {
        if (editorReady) return;

        loadLocale(activeLocale);
        editorReady = true;
        localeSelect.disabled = false;
        builderStatus.classList.add('hidden');

        window.requestAnimationFrame(function () {
            const storedHtml = state.html[activeLocale] || '';
            if (storedHtml && editor.getComponents().length === 0) {
                editor.setComponents(storedHtml);
                editor.setStyle(state.css[activeLocale] || '');
            }
            editor.refresh();
            editor.clearDirtyCount();

            const restoredDraft = maybeOfferDraftRestore();
            if (!restoredDraft && editor.getComponents().length === 0) {
                const templateModalElement = document.getElementById('pageTemplateModal');
                if (templateModalElement) {
                    bootstrap.Modal.getOrCreateInstance(templateModalElement).show();
                }
            }

            draftTimer = window.setInterval(saveDraft, 20000);
        });
    }

    localeSelect.addEventListener('change', function () {
        if (!editorReady) return;
        saveLocale();
        loadLocale(this.value);
    });

    const htmlModalElement = document.getElementById('pageBuilderHtmlModal');
    const htmlButton = document.getElementById('page-builder-html-button');
    const htmlSource = document.getElementById('page-builder-html-source');
    const cssSource = document.getElementById('page-builder-css-source');
    let htmlModal = null;

    function containsDangerousCss(css) {
        return /@import|expression\s*\(|javascript\s*:|behavior\s*:|-moz-binding|<\s*\/?\s*(script|style)/i.test(css);
    }

    function cleanImportedHtml(source) {
        const documentNode = new DOMParser().parseFromString(source, 'text/html');
        const extractedCss = [];

        documentNode.querySelectorAll('style').forEach(function (style) {
            extractedCss.push(style.textContent || '');
            style.remove();
        });
        documentNode.querySelectorAll('script, iframe, object, embed, form, input, textarea, select, meta, link, base').forEach(function (node) {
            node.remove();
        });
        documentNode.body.querySelectorAll('*').forEach(function (node) {
            Array.from(node.attributes).forEach(function (attribute) {
                const name = attribute.name.toLowerCase();
                const value = attribute.value.trim();
                if (name.startsWith('on') || name === 'srcdoc') {
                    node.removeAttribute(attribute.name);
                } else if (['focus', 'src', 'xlink:focus'].includes(name) && /^javascript\s*:/i.test(value)) {
                    node.removeAttribute(attribute.name);
                } else if (name === 'style' && containsDangerousCss(value)) {
                    node.removeAttribute(attribute.name);
                }
            });
        });

        return { html: documentNode.body.innerHTML, css: extractedCss.join('\n') };
    }

    function openHtmlImporter() {
        saveLocale();
        htmlSource.value = editor.getHtml();
        cssSource.value = editor.getCss();
        htmlModal = bootstrap.Modal.getOrCreateInstance(htmlModalElement);
        htmlModal.show();
    }

    function applyImportedHtml(mode) {
        const imported = cleanImportedHtml(htmlSource.value);
        const css = [imported.css, cssSource.value].filter(Boolean).join('\n');
        if (containsDangerousCss(css)) {
            window.alert('CSS chứa nội dung không được phép.');
            return;
        }

        if (mode === 'replace') {
            editor.setComponents(imported.html);
            editor.setStyle(css);
        } else {
            editor.addComponents(imported.html);
            if (css.trim()) editor.addStyle(css);
        }
        saveLocale();
        htmlModal.hide();
    }

    htmlButton.addEventListener('click', openHtmlImporter);
    document.getElementById('page-builder-html-append').addEventListener('click', function () {
        applyImportedHtml('append');
    });
    document.getElementById('page-builder-html-replace').addEventListener('click', function () {
        applyImportedHtml('replace');
    });

    document.getElementById('page-builder-preview-button').addEventListener('click', function () {
        saveLocale();
        const previewHtml = cleanImportedHtml(editor.getHtml()).html;
        const previewCss = editor.getCss();
        if (containsDangerousCss(previewCss)) {
            window.alert('Không thể xem trước vì CSS chứa nội dung không được phép.');
            return;
        }

        const titleInput = document.querySelector('[name="title[' + activeLocale + ']"]');
        const metaTitleInput = document.querySelector('[name="meta_title[' + activeLocale + ']"]');
        const metaDescriptionInput = document.querySelector('[name="meta_description[' + activeLocale + ']"]');
        
        const headerMode = document.querySelector('[name="header_mode"]');
        const headerPartial = document.querySelector('[name="header_partial_id"]');
        const footerMode = document.querySelector('[name="footer_mode"]');
        const footerPartial = document.querySelector('[name="footer_partial_id"]');

        const payload = {
            page_id: @json($page->exists ? $page->id : 'new'),
            html: previewHtml,
            css: previewCss,
            locale: activeLocale,
            title: titleInput?.value || 'Xem trước trang',
            meta_title: metaTitleInput?.value || '',
            meta_description: metaDescriptionInput?.value || '',
            header_mode: headerMode?.value || 'inherit',
            header_partial_id: headerPartial?.value ? parseInt(headerPartial.value) : null,
            footer_mode: footerMode?.value || 'inherit',
            footer_partial_id: footerPartial?.value ? parseInt(footerPartial.value) : null,
        };

        const previewBtn = document.getElementById('page-builder-preview-button');
        const originalContent = previewBtn.innerHTML;
        previewBtn.disabled = true;
        previewBtn.innerHTML = '<iconify-icon icon="solar:spinner-linear" class="animate-spin text-base mr-1"></iconify-icon><span>Đang tải...</span>';

        fetch(@json(route('admin.pages.preview.store')), {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': @json(csrf_token()),
            },
            body: JSON.stringify(payload),
        })
        .then(function (response) {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(function (data) {
            previewBtn.disabled = false;
            previewBtn.innerHTML = originalContent;

            if (data.success && data.preview_url) {
                const previewWindow = window.open(data.preview_url, '_blank');
                if (!previewWindow) {
                    window.alert('Trình duyệt đang chặn cửa sổ xem trước. Vui lòng cho phép popup cho trang quản trị.');
                }
            } else {
                window.alert(data.message || 'Không thể khởi tạo link xem trước.');
            }
        })
        .catch(function (error) {
            previewBtn.disabled = false;
            previewBtn.innerHTML = originalContent;
            window.alert('Gửi yêu cầu xem trước thất bại. Vui lòng thử lại.');
        });
    });

    const mediaInput = document.getElementById('page-builder-media');
    const mediaButton = document.getElementById('page-builder-media-button');
    if (mediaInput && mediaButton) {
        mediaButton.addEventListener('click', function () {
            mediaInput.click();
        });
        mediaInput.addEventListener('media:selected', function (event) {
            const selected = editor.getSelected();
            if (selected && selected.is('image')) {
                selected.addAttributes({ src: event.detail.url });
            } else {
                editor.addComponents({ type: 'image', attributes: { src: event.detail.url, alt: '', 'data-page-block': 'image' } });
            }
        });
    }

    form.addEventListener('submit', function () {
        saveLocale();
        document.getElementById('page-builder-data').value = JSON.stringify({ version: 1, locales: state.locales });
        document.getElementById('page-builder-html').value = JSON.stringify(state.html);
        document.getElementById('page-builder-css').value = JSON.stringify(state.css);
        Object.keys(state.html).forEach(function (locale) {
            window.localStorage.removeItem('pageBuilderDraft:' + draftPageId + ':' + locale);
        });
        if (draftTimer) window.clearInterval(draftTimer);
    });

    const PAGE_TEMPLATES = {
        home: '<section data-page-block="hero" style="padding:80px 24px;text-align:center;background:#eef3ff"><h1>Chào mừng đến với chúng tôi</h1><p>Thêm thông điệp chính cho trang chủ.</p><a href="#" style="display:inline-block;padding:12px 24px;background:#5d87ff;color:#fff;text-decoration:none;border-radius:6px">Khám phá ngay</a></section>' +
            '<section data-page-block="features-3" style="display:flex;flex-wrap:wrap;gap:24px;max-width:1100px;margin:auto;padding:48px 24px;text-align:center">' +
            '<div style="flex:1 1 220px"><h3>Tính năng 1</h3><p>Mô tả ngắn gọn.</p></div>' +
            '<div style="flex:1 1 220px"><h3>Tính năng 2</h3><p>Mô tả ngắn gọn.</p></div>' +
            '<div style="flex:1 1 220px"><h3>Tính năng 3</h3><p>Mô tả ngắn gọn.</p></div></section>' +
            '<section data-page-block="product-grid" data-category="" data-limit="8" style="padding:48px 24px"><h2 style="text-align:center">Sản phẩm nổi bật</h2><div style="padding:32px;text-align:center;border:1px dashed #bbb">Storefront sẽ render danh sách sản phẩm tại đây</div></section>' +
            '<section data-page-block="cta" style="padding:48px 24px;text-align:center;background:#263445;color:#fff"><h2>Bắt đầu ngay hôm nay</h2><p>Thêm lời kêu gọi hành động.</p><a href="#" style="color:#fff">Liên hệ ngay</a></section>',
        about: '<section data-page-block="hero" style="padding:80px 24px;text-align:center;background:#eef3ff"><h1>Về chúng tôi</h1><p>Câu chuyện và giá trị cốt lõi.</p></section>' +
            '<section data-page-block="image-text" style="display:flex;gap:32px;align-items:center;max-width:1100px;margin:auto;padding:48px 24px"><img src="https://placehold.co/600x400" alt="" style="width:50%"><div><h2>Câu chuyện của chúng tôi</h2><p>Nội dung giới thiệu.</p></div></section>' +
            '<section data-page-block="timeline" style="max-width:900px;margin:32px auto;padding:0 24px"><div style="border-left:2px solid #5d87ff;padding-left:20px;margin-bottom:20px"><strong>Thành lập</strong><p>Mô tả cột mốc.</p></div><div style="border-left:2px solid #5d87ff;padding-left:20px"><strong>Phát triển</strong><p>Mô tả cột mốc.</p></div></section>' +
            '<section data-page-block="testimonial" style="max-width:700px;margin:32px auto;padding:32px;text-align:center;background:#f7f9fc;border-radius:12px"><p style="font-style:italic">“Sản phẩm và dịch vụ rất tốt.”</p><strong>Tên khách hàng</strong></section>',
        contact: '<section data-page-block="hero" style="padding:60px 24px;text-align:center;background:#eef3ff"><h1>Liên hệ với chúng tôi</h1><p>Chúng tôi luôn sẵn sàng hỗ trợ bạn.</p></section>' +
            '<section data-page-block="contact-form" style="padding:48px 24px;max-width:600px;margin:auto"><h2 style="text-align:center">Gửi yêu cầu</h2><div style="padding:32px;text-align:center;border:1px dashed #bbb">Form liên hệ sẽ hiển thị tại đây trên trang thật</div></section>',
        promo: '<section data-page-block="hero" style="padding:100px 24px;text-align:center;background:#263445;color:#fff"><h1>Ưu đãi có hạn</h1><p>Giảm giá đặc biệt cho khách hàng mới.</p><a href="#" style="display:inline-block;padding:12px 24px;background:#5d87ff;color:#fff;text-decoration:none;border-radius:6px">Nhận ưu đãi</a></section>' +
            '<section data-page-block="counter" style="display:flex;flex-wrap:wrap;gap:24px;justify-content:center;text-align:center;max-width:900px;margin:32px auto;padding:0 24px"><div><div style="font-size:32px;font-weight:700;color:#5d87ff">500+</div><div>Khách hàng</div></div><div><div style="font-size:32px;font-weight:700;color:#5d87ff">1.200+</div><div>Đơn hàng</div></div></section>' +
            '<section data-page-block="cta" style="padding:48px 24px;text-align:center;background:#eef3ff"><h2>Số lượng có hạn</h2><p>Đặt hàng ngay hôm nay.</p><a href="#">Mua ngay</a></section>',
    };

    document.querySelectorAll('.page-template-choice').forEach(function (button) {
        button.addEventListener('click', function () {
            const templateHtml = PAGE_TEMPLATES[button.dataset.template];
            if (templateHtml) {
                editor.setComponents(templateHtml);
                editor.refresh();
                saveDraft();
            }
            bootstrap.Modal.getInstance(document.getElementById('pageTemplateModal'))?.hide();
        });
    });

    const blankTemplateBtn = document.getElementById('page-template-blank');
    if (blankTemplateBtn) {
        blankTemplateBtn.addEventListener('click', function () {
            bootstrap.Modal.getInstance(document.getElementById('pageTemplateModal'))?.hide();
        });
    }

    } catch (error) {
        console.error('Page Builder initialization failed', error);
        showBuilderError('Page Builder khởi tạo thất bại: ' + (error?.message || 'Lỗi không xác định.'));
    }
});
</script>
@endpush
