@extends('admin.layouts.app')

@section('title', __('catalog.brands.title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/dragula/dist/dragula.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/quill/dist/quill.snow.css') }}">
    <style>
        .brand-quick-quill .ql-toolbar.ql-snow {
            border: 1px solid #e2e8f0 !important;
            border-bottom: none !important;
            border-top-left-radius: 0.75rem !important;
            border-top-right-radius: 0.75rem !important;
            background-color: #f8fafc !important;
            padding: 6px 10px !important;
        }
        .brand-quick-quill .ql-container.ql-snow {
            border: 1px solid #e2e8f0 !important;
            border-bottom-left-radius: 0.75rem !important;
            border-bottom-right-radius: 0.75rem !important;
            font-family: inherit !important;
        }
        .brand-quick-quill .ql-editor {
            min-height: 140px !important;
            font-size: 14px !important;
            line-height: 1.6 !important;
            color: #0f172a !important;
        }
    </style>
@endpush

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-2xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-5 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-amber-400/15 border border-amber-400/30 text-amber-400 flex items-center justify-center font-bold shadow-inner">
                    <iconify-icon icon="solar:medal-ribbons-star-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-0.5 text-white tracking-tight">Quản lý thương hiệu (Our Brands)</h4>
                    <p class="text-xs text-slate-300">Quản lý danh mục thương hiệu đèn chiếu sáng kiến trúc quốc tế hiển thị trên website</p>
                </div>
            </div>
            <a href="{{ route('admin.brands.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white font-bold text-sm transition-all shadow-md shadow-primary/20 hover:shadow-lg focus:outline-none">
                <iconify-icon icon="solar:add-circle-bold" class="text-lg"></iconify-icon>
                <span>{{ __('catalog.brands.create') }}</span>
            </a>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-4 mb-6">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <!-- Keyword input -->
            <div class="sm:col-span-5 relative">
                <input type="search" 
                       name="q" 
                       class="block w-full pl-10 pr-3.5 py-2.5 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all" 
                       value="{{ request('q') }}" 
                       placeholder="Tìm theo tên, quốc gia, slug...">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                    <iconify-icon icon="solar:magnifer-linear" class="text-lg"></iconify-icon>
                </div>
            </div>

            <!-- Country filter -->
            <div class="sm:col-span-3">
                <select name="country" class="block w-full px-3 py-2.5 text-sm text-slate-700 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all">
                    <option value="">-- Tất cả quốc gia --</option>
                    @foreach($countries as $c)
                        <option value="{{ $c }}" @selected(request('country') === $c)>{{ $c }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status filter -->
            <div class="sm:col-span-2">
                <select name="status" class="block w-full px-3 py-2.5 text-sm text-slate-700 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all">
                    <option value="">-- Trạng thái --</option>
                    <option value="active" @selected(request('status') === 'active')>Đang hiển thị</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Đang ẩn</option>
                    <option value="featured" @selected(request('status') === 'featured')>Thương hiệu nổi bật</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center gap-1.5 py-2.5 px-4 text-sm font-bold text-white bg-primary hover:bg-primary-hover rounded-xl shadow-xs transition-colors focus:outline-none">
                    <iconify-icon icon="solar:filter-linear" class="text-base"></iconify-icon>
                    <span>Lọc</span>
                </button>
                @if(request()->hasAny(['q', 'country', 'status']))
                    <a href="{{ route('admin.brands.index') }}" class="p-2.5 text-slate-500 hover:text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors" title="Xóa bộ lọc">
                        <iconify-icon icon="solar:restart-linear" class="text-lg"></iconify-icon>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Brands Table Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            @include('admin.shared.bulk-actions', [
                'bulkFormId' => 'bulk-brands-form',
                'bulkActionUrl' => route('admin.brands.bulk'),
                'bulkItemLabel' => 'thương hiệu',
            ])

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50/80 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3.5 w-12 text-center">
                                <input type="checkbox" class="w-4 h-4 text-primary bg-white border-slate-300 rounded focus:ring-primary cursor-pointer" data-bulk-select-all="bulk-brands-form" aria-label="Chọn tất cả">
                            </th>
                            <th class="px-5 py-3.5 font-bold text-slate-700">{{ __('catalog.fields.name') }}</th>
                            <th class="px-5 py-3.5 font-bold text-slate-700">Quốc gia</th>
                            <th class="px-5 py-3.5 font-bold text-slate-700">Ảnh công trình (3:4)</th>
                            <th class="px-5 py-3.5 font-bold text-slate-700">{{ __('catalog.fields.status') }}</th>
                            <th class="px-5 py-3.5 font-bold text-slate-700 text-center">Website</th>
                            <th class="px-5 py-3.5 text-right font-bold text-slate-700 w-28">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="brand-table-sortable" class="divide-y divide-slate-150" data-start-order="{{ max(0, ($brands->firstItem() ?? 1) - 1) }}">
                        @forelse($brands as $brand)
                            @php
                                $brandName = $brand->getTranslation('name', app()->getLocale(), false) ?: $brand->name;
                                $brandDescription = $brand->getTranslation('description', app()->getLocale(), false) ?: '';
                            @endphp
                            <tr class="hover:bg-slate-50/60 transition-colors group" data-brand-id="{{ $brand->id }}">
                                <!-- Checkbox -->
                                <td class="px-5 py-4 whitespace-nowrap text-center">
                                    <input type="checkbox" class="w-4 h-4 text-primary bg-white border-slate-300 rounded focus:ring-primary cursor-pointer" name="ids[]" value="{{ $brand->id }}" form="bulk-brands-form" data-bulk-select="bulk-brands-form" aria-label="Chọn {{ $brandName }}">
                                </td>

                                <!-- Tên & Logo -->
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="catalog-drag-handle mr-2.5 text-slate-300 hover:text-slate-600 cursor-grab flex items-center" title="{{ __('catalog.actions.drag_sort') }}">
                                            <iconify-icon icon="solar:double-alt-arrow-up-down-linear" class="text-base"></iconify-icon>
                                        </span>
                                        <div class="w-12 h-12 rounded-xl border border-slate-200 bg-white p-1 flex items-center justify-center overflow-hidden mr-3 shadow-2xs shrink-0">
                                            @if($brand->image_url)
                                                <img src="{{ $brand->image_url }}" alt="{{ $brandName }}" class="max-h-10 max-w-full object-contain" onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/empty.png') }}';">
                                            @else
                                                <img src="{{ asset('admin-assets/js/icons/empty.png') }}" alt="empty" class="w-full h-full object-cover opacity-50">
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.brands.edit', $brand) }}" class="font-bold text-slate-900 hover:text-primary transition-colors text-sm block">
                                                {{ $brandName }}
                                            </a>
                                            <span class="text-xs text-slate-400 font-mono">{{ $brand->slug }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Quốc gia -->
                                <td class="px-5 py-4 whitespace-nowrap">
                                    @if($brand->country)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 shadow-2xs">
                                            <iconify-icon icon="solar:flag-2-linear" class="text-xs text-amber-600"></iconify-icon>
                                            <span>{{ $brand->country }}</span>
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Chưa có</span>
                                    @endif
                                </td>

                                <!-- Ảnh công trình 3:4 -->
                                <td class="px-5 py-4 whitespace-nowrap">
                                    @if($brand->showcase_image)
                                        <div class="w-11 h-15 rounded-lg border border-slate-200 overflow-hidden bg-slate-100 shadow-2xs hover:scale-110 transition-transform duration-200 cursor-pointer" onclick="window.open('{{ $brand->showcase_image }}', '_blank')" title="Bấm để xem ảnh gốc">
                                            <img src="{{ $brand->showcase_image }}" alt="Showcase" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/empty.png') }}';">
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Chưa có</span>
                                    @endif
                                </td>

                                <!-- Trạng thái -->
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        @if($brand->is_active)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                <span>{{ __('catalog.status.active') }}</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                <span>{{ __('catalog.status.inactive') }}</span>
                                            </span>
                                        @endif
                                        @if($brand->is_featured)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[11px] font-bold bg-purple-50 text-purple-700 border border-purple-200">
                                                <iconify-icon icon="solar:star-bold" class="text-xs text-purple-500"></iconify-icon>
                                                <span>Nổi bật</span>
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Website -->
                                <td class="px-5 py-4 whitespace-nowrap text-center">
                                    @if($brand->website_url)
                                        <a href="{{ $brand->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold text-primary bg-primary/5 hover:bg-primary hover:text-white border border-primary/20 transition-colors shadow-2xs" title="{{ $brand->website_url }}">
                                            <iconify-icon icon="solar:link-circle-linear" class="text-sm"></iconify-icon>
                                            <span>Website</span>
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-400">—</span>
                                    @endif
                                </td>

                                <!-- Thao tác -->
                                <td class="px-5 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button type="button" 
                                                class="p-2 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors js-brand-quick-edit"
                                                title="Sửa nhanh"
                                                data-id="{{ $brand->id }}"
                                                data-name="{{ $brandName }}"
                                                data-slug="{{ $brand->slug }}"
                                                data-country="{{ $brand->country }}"
                                                data-website-url="{{ $brand->website_url }}"
                                                data-description="{{ $brandDescription }}"
                                                data-is-active="{{ $brand->is_active ? 1 : 0 }}"
                                                data-is-featured="{{ $brand->is_featured ? 1 : 0 }}"
                                                data-image-url="{{ $brand->image_url }}"
                                                data-showcase-image="{{ $brand->showcase_image }}">
                                            <iconify-icon icon="solar:bolt-linear" class="text-base"></iconify-icon>
                                        </button>
                                        <a href="{{ route('admin.brands.edit', $brand) }}" 
                                           class="p-2 text-slate-500 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                           title="Sửa chi tiết">
                                            <iconify-icon icon="solar:pen-linear" class="text-base"></iconify-icon>
                                        </a>
                                        <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}" class="js-delete-form inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Xóa thương hiệu">
                                                <iconify-icon icon="solar:trash-bin-trash-linear" class="text-base"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-12 text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:box-minimalistic-linear" class="text-5xl text-slate-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold text-slate-600">{{ __('catalog.common.no_data') }}</p>
                                        <p class="text-xs text-slate-400 mt-1">Không tìm thấy thương hiệu nào phù hợp với bộ lọc.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(!$brands->isEmpty())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $brands->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Edit Brand Modal -->
    <div x-data="{ open: false }" 
         @keydown.escape.window="open = false" 
         class="relative z-50" 
         id="quickEditBrandModal"
         style="display: none;"
         x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <form method="POST" action="" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-slate-200" enctype="multipart/form-data" id="quickEditBrandForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                        <div class="flex items-center gap-2">
                            <iconify-icon icon="solar:bolt-bold" class="text-amber-500 text-xl"></iconify-icon>
                            <h3 class="text-base font-bold text-slate-900">
                                Sửa nhanh thương hiệu
                            </h3>
                        </div>
                        <button type="button" @click="open = false" class="text-slate-400 hover:text-slate-600 focus:outline-none">
                            <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                            <!-- Name -->
                            <div class="sm:col-span-7">
                                <label class="block mb-1.5 text-xs font-bold text-slate-700" for="quick_name">Tên thương hiệu <span class="text-rose-500">*</span></label>
                                <input type="text" class="block w-full px-3 py-2 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none" id="quick_name" name="name" required>
                            </div>
                            <!-- Slug -->
                            <div class="sm:col-span-5">
                                <label class="block mb-1.5 text-xs font-bold text-slate-700" for="quick_slug">Đường dẫn (Slug)</label>
                                <input type="text" class="block w-full px-3 py-2 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none font-mono text-xs" id="quick_slug" name="slug">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                            <!-- Country -->
                            <div class="sm:col-span-6">
                                <label class="block mb-1.5 text-xs font-bold text-slate-700" for="quick_country">Quốc gia / Xuất xứ</label>
                                <input type="text" class="block w-full px-3 py-2 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none" id="quick_country" name="country" placeholder="America, Italy, Germany...">
                            </div>
                            <!-- Website -->
                            <div class="sm:col-span-6">
                                <label class="block mb-1.5 text-xs font-bold text-slate-700" for="quick_website_url">Website hãng</label>
                                <input type="text" class="block w-full px-3 py-2 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none font-mono text-xs" id="quick_website_url" name="website_url" placeholder="https://...">
                            </div>
                        </div>

                        <!-- Description Quill Editor -->
                        <div>
                            <label class="block mb-1.5 text-xs font-bold text-slate-700" for="quick_description">Mô tả tóm tắt (Mặt sau Flip-box)</label>
                            <textarea class="hidden" id="quick_description" name="description"></textarea>
                            <div class="brand-quick-quill overflow-hidden">
                                <div id="quick_description_editor" class="bg-white min-h-[140px]" data-target="quick_description"></div>
                            </div>
                        </div>

                        <!-- Toggles -->
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" id="quick_is_active" name="is_active" value="1" class="w-4 h-4 text-primary rounded border-slate-300 focus:ring-primary">
                                <span class="text-xs font-bold text-slate-800">Hiển thị công khai</span>
                            </label>
                            <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" id="quick_is_featured" name="is_featured" value="1" class="w-4 h-4 text-purple-600 rounded border-slate-300 focus:ring-purple-500">
                                <span class="text-xs font-bold text-slate-800">Thương hiệu nổi bật</span>
                            </label>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-200 flex justify-end gap-3">
                        <button type="button" @click="open = false" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:text-slate-800 bg-white border border-slate-300 rounded-xl transition-colors">
                            Hủy
                        </button>
                        <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-primary hover:bg-primary-hover rounded-xl shadow-xs transition-colors">
                            Cập nhật nhanh
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/libs/dragula/dist/dragula.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/quill/dist/quill.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Drag-and-drop sortable rows
            const sortableTable = document.getElementById('brand-table-sortable');
            if (sortableTable && window.dragula) {
                const drake = dragula([sortableTable], {
                    moves: function (el, container, handle) {
                        return handle.closest('.catalog-drag-handle') !== null;
                    }
                });

                drake.on('drop', function () {
                    const ids = Array.from(sortableTable.querySelectorAll('tr[data-brand-id]'))
                        .map(row => row.dataset.brandId);
                    const startOrder = parseInt(sortableTable.dataset.startOrder || '0', 10);

                    fetch(@json(route('admin.brands.sort')), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify({ ids, start_order: startOrder })
                    });
                });
            }

            // Quick Edit Quill editor
            const quickEditorElement = document.getElementById('quick_description_editor');
            let quickQuill = null;
            if (quickEditorElement && window.Quill) {
                quickQuill = new Quill(quickEditorElement, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['link', 'clean']
                        ]
                    }
                });
                quickEditorElement.__quill = quickQuill;

                quickQuill.on('text-change', function () {
                    const target = document.getElementById('quick_description');
                    if (target) {
                        const html = quickQuill.root.innerHTML;
                        target.value = (html === '<p><br></p>' || html === '<p></p>') ? '' : html;
                    }
                });
            }

            // Quick Edit button click handler
            const modalEl = document.getElementById('quickEditBrandModal');
            const quickForm = document.getElementById('quickEditBrandForm');

            document.querySelectorAll('.js-brand-quick-edit').forEach(function (button) {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const name = this.dataset.name || '';
                    const slug = this.dataset.slug || '';
                    const country = this.dataset.country || '';
                    const websiteUrl = this.dataset.websiteUrl || '';
                    const description = this.dataset.description || '';
                    const isActive = this.dataset.isActive === '1';
                    const isFeatured = this.dataset.isFeatured === '1';

                    if (quickForm) {
                        quickForm.action = `/{{ app()->getLocale() }}/admin/brands/${id}/quick-update`;
                    }

                    const nameInput = document.getElementById('quick_name');
                    if (nameInput) nameInput.value = name;

                    const slugInput = document.getElementById('quick_slug');
                    if (slugInput) slugInput.value = slug;

                    const countryInput = document.getElementById('quick_country');
                    if (countryInput) countryInput.value = country;

                    const websiteInput = document.getElementById('quick_website_url');
                    if (websiteInput) websiteInput.value = websiteUrl;

                    const activeInput = document.getElementById('quick_is_active');
                    if (activeInput) activeInput.checked = isActive;

                    const featuredInput = document.getElementById('quick_is_featured');
                    if (featuredInput) featuredInput.checked = isFeatured;

                    const targetDesc = document.getElementById('quick_description');
                    if (targetDesc) targetDesc.value = description;

                    if (quickQuill) {
                        quickQuill.root.innerHTML = description;
                    }

                    // Open Alpine modal
                    if (modalEl && modalEl.__x) {
                        modalEl.__x.$data.open = true;
                    } else {
                        modalEl.style.display = 'block';
                    }
                });
            });

            // On quickForm submit, sync quill
            if (quickForm) {
                quickForm.addEventListener('submit', function () {
                    const target = document.getElementById('quick_description');
                    if (target && quickQuill) {
                        const html = quickQuill.root.innerHTML;
                        target.value = (html === '<p><br></p>' || html === '<p></p>') ? '' : html;
                    }
                });
            }
        });
    </script>
@endpush
