@extends('admin.layouts.app')

@section('title', __('catalog.categories.title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/dragula/dist/dragula.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/quill/dist/quill.snow.css') }}">
    <style>
        /* Dynamic table borders for drag-and-drop */
        #category-table-sortable tbody.category-group-sortable tr td {
            border-bottom-width: 0px !important;
        }
        #category-table-sortable tbody.category-group-sortable tr:last-child td {
            border-bottom-width: 1px !important;
            border-bottom-style: solid !important;
            border-bottom-color: #e5e7eb !important;
        }
    </style>
@endpush

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1">{{ __('catalog.categories.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('catalog.categories.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <x-admin.button variant="primary" size="sm" href="{{ route('admin.categories.create') }}">
                <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('catalog.categories.create') }}
            </x-admin.button>
        </div>
    </div>

    <!-- Category list Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            @include('admin.shared.bulk-actions', [
                'bulkFormId' => 'bulk-categories-form',
                'bulkActionUrl' => route('admin.categories.bulk'),
                'bulkItemLabel' => 'danh mục',
            ])
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500" id="category-table-sortable" data-start-order="{{ max(0, ($categories->firstItem() ?? 1) - 1) }}">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3" style="width: 44px;">
                                <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" data-bulk-select-all="bulk-categories-form" aria-label="Chọn tất cả danh mục">
                            </th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.category') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.parent_category') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.status') }}</th>
                            <th class="px-6 py-3 font-bold text-center">{{ __('catalog.fields.products_count') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    @php $isFirstTbody = true; @endphp
                    @forelse($categories as $category)
                        @php
                            $categoryName = $category->getTranslation('name', app()->getLocale(), false) ?: $category->name;
                            $categoryDescription = $category->getTranslation('description', app()->getLocale(), false) ?: '';
                        @endphp
                        @if(($category->depth ?? 0) === 0)
                            @if(!$isFirstTbody)
                                </tbody>
                            @endif
                            @php $isFirstTbody = false; @endphp
                            <tbody class="category-group-sortable divide-y divide-gray-150" data-category-id="{{ $category->id }}">
                        @endif
                        <tr class="hover:bg-gray-50/50 transition-colors" data-category-id="{{ $category->id }}" data-depth="{{ $category->depth ?? 0 }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" name="ids[]" value="{{ $category->id }}" form="bulk-categories-form" data-bulk-select="bulk-categories-form" aria-label="Chọn {{ $categoryName }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center" style="padding-left: {{ ($category->depth ?? 0) * 32 }}px;">
                                    <span class="catalog-drag-handle mr-3 text-gray-400 hover:text-gray-600 cursor-grab flex items-center" title="{{ __('catalog.actions.drag_sort') }}">
                                        <iconify-icon icon="solar:double-alt-arrow-up-down-linear" class="text-lg"></iconify-icon>
                                    </span>
                                    @if(($category->depth ?? 0) > 0)
                                        <span class="text-gray-400 mr-2 font-mono font-bold">↳</span>
                                    @endif
                                    
                                    <div class="w-11 h-11 rounded-lg border border-gray-200 bg-white p-0.5 flex items-center justify-center overflow-hidden mr-3">
                                        @if($category->image_url)
                                            <img src="{{ $category->image_url }}" alt="{{ $categoryName }}" class="w-full h-full object-cover rounded-md" onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/404.png') }}';">
                                        @else
                                            <img src="{{ asset('admin-assets/js/icons/empty.png') }}" alt="empty" class="w-full h-full object-cover rounded-md">
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="font-bold text-gray-900">{{ $categoryName }}</h6>
                                        <span class="text-xs text-gray-500">{{ $category->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700">
                                @if($category->parent)
                                    <x-admin.badge variant="info">
                                        {{ $category->parent->name }}
                                    </x-admin.badge>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($category->is_active)
                                    <x-admin.badge variant="success">{{ __('catalog.status.active') }}</x-admin.badge>
                                @else
                                    <x-admin.badge variant="danger">{{ __('catalog.status.inactive') }}</x-admin.badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-primary">
                                {{ $category->total_products_count ?? $category->products_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <x-admin.dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <iconify-icon icon="solar:menu-dots-bold" class="text-xl"></iconify-icon>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <button type="button"
                                                class="flex items-center w-full gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors text-left js-category-quick-edit"
                                                data-id="{{ $category->id }}"
                                                data-name="{{ $categoryName }}"
                                                data-slug="{{ $category->slug }}"
                                                data-parent-id="{{ $category->parent_id }}"
                                                data-description="{{ $categoryDescription }}"
                                                data-is-active="{{ $category->is_active ? 1 : 0 }}"
                                                data-image-url="{{ $category->image_url }}">
                                            <iconify-icon icon="solar:bolt-linear" class="text-base text-gray-500"></iconify-icon>
                                            <span>{{ __('catalog.actions.quick_edit') }}</span>
                                        </button>
                                        <a class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('admin.categories.edit', $category) }}">
                                            <iconify-icon icon="solar:pen-linear" class="text-base text-gray-500"></iconify-icon>
                                            <span>{{ __('catalog.actions.edit') }}</span>
                                        </a>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="js-delete-form block border-t border-gray-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center w-full gap-2 px-4 py-2.5 text-sm text-red-650 hover:bg-red-50 transition-colors text-left font-semibold">
                                                <iconify-icon icon="solar:trash-bin-trash-linear" class="text-base"></iconify-icon>
                                                <span>{{ __('catalog.actions.delete') }}</span>
                                            </button>
                                        </form>
                                    </x-slot>
                                </x-admin.dropdown>
                            </td>
                        </tr>
                    @empty
                        <tbody id="category-empty-body">
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <img src="{{ asset('admin-assets/images/icons/emptydata.png') }}" alt="No data" class="h-14 w-auto mb-2 opacity-60">
                                        <p class="text-sm font-semibold">{{ __('catalog.common.no_data') }}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @endforelse
                    @if(!$categories->isEmpty())
                        </tbody>
                    @endif
                </table>
            </div>
            @if(!$categories->isEmpty())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Edit Category Modal (Alpine.js Modal Replacement) -->
    <div x-data="{ open: false }" 
         @keydown.escape.window="open = false" 
         class="relative z-50" 
         id="quickEditCategoryModal"
         style="display: none;"
         x-show="open" 
         x-transition>
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <form method="POST" action="" class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-150" enctype="multipart/form-data" id="quickEditCategoryForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50/50">
                        <h3 class="text-base font-bold text-gray-900" id="quickEditCategoryModalLabel">
                            {{ __('catalog.categories.quick_edit') }}
                        </h3>
                        <button type="button" @click="open = false" class="text-gray-450 hover:text-gray-600 focus:outline-none">
                            <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_name">{{ __('catalog.fields.name') }} <span class="text-red-500">*</span></label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="quick_name" name="name" required>
                            </div>
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_slug">{{ __('catalog.fields.slug') }}</label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="quick_slug" name="slug">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_parent_id">{{ __('catalog.fields.parent_category') }}</label>
                                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="quick_parent_id" name="parent_id">
                                    <option value="">{{ __('catalog.common.none') }}</option>
                                    @foreach($parentOptions as $parent)
                                        <option value="{{ $parent->id }}">
                                            {!! str_repeat('&nbsp;&nbsp;', $parent->depth ?? 0) !!}{{ $parent->depth ? '↳ ' : '' }}{{ $parent->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_image_file">{{ __('catalog.fields.image') }}</label>
                                <input type="file" class="block w-full text-sm text-gray-900 border border-gray-350 rounded-lg cursor-pointer bg-white focus:outline-none" id="quick_image_file" name="image_file" accept="image/*" data-media-folder="categories">
                            </div>
                        </div>

                        <div class="hidden" id="quickImagePreviewWrap">
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700">Xem trước ảnh</label>
                            <img src="" alt="" id="quickImagePreview" class="rounded-lg border border-gray-250 p-0.5 object-cover h-16 w-16" onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/404.png') }}';">
                        </div>

                        <div>
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_description">{{ __('catalog.fields.description') }}</label>
                            <textarea class="hidden" id="quick_description" name="description"></textarea>
                            <div class="rounded-lg border border-gray-300 overflow-hidden">
                                <div id="quick_description_editor" class="catalog-quill min-h-[120px]" data-target="quick_description"></div>
                            </div>
                        </div>

                        <div>
                            <input type="hidden" name="is_active" value="1">
                            <div class="flex items-center">
                                <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="0" id="quick_is_active">
                                <label class="ml-2 text-xs font-semibold text-gray-900 cursor-pointer" for="quick_is_active">{{ __('catalog.fields.save_draft') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50 flex justify-end gap-3">
                        <button type="button" @click="open = false" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 active:bg-gray-105 px-4 py-2 text-sm">
                            {{ __('catalog.actions.cancel') }}
                        </button>
                        <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-primary hover:bg-primary-hover active:bg-primary-active px-4 py-2 text-sm">
                            {{ __('catalog.actions.save') }}
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
            const sortable = document.getElementById('category-table-sortable');
            const csrfToken = @json(csrf_token());
            const sortUrl = @json(route('admin.categories.sort'));
            const quickUpdateUrlTemplate = @json(route('admin.categories.quick-update', ['category' => '__CATEGORY_ID__']));

            const toast = function (icon, message) {
                if (!window.Swal) {
                    return;
                }

                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true
                }).fire({ icon, title: message });
            };

            // Initialize Quick Edit Quill editor
            const quickEditorElement = document.getElementById('quick_description_editor');
            if (quickEditorElement && window.Quill) {
                const target = document.getElementById(quickEditorElement.dataset.target);
                const quill = new Quill(quickEditorElement, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['link', 'clean']
                        ]
                    }
                });
                quickEditorElement.__quill = quill;

                const form = quickEditorElement.closest('form');
                if (form && target) {
                    form.addEventListener('submit', function () {
                        target.value = quill.root.innerHTML;
                    });
                }
            }

            if (sortable && sortable.querySelector('tbody.category-group-sortable') && window.dragula) {
                // Dragula initialization for reordering root categories (tbody elements)
                dragula([sortable], {
                    moves: function (el, container, handle) {
                        const tr = handle.closest('tr');
                        return el.classList.contains('category-group-sortable') && tr !== null && tr.dataset.depth === '0';
                    },
                    accepts: function (el, target, source, sibling) {
                        return sibling === null || sibling.tagName === 'TBODY';
                    }
                }).on('drop', function () {
                    const ids = Array.from(sortable.querySelectorAll('tbody.category-group-sortable')).map(function (tbody) {
                        return tbody.dataset.categoryId;
                    });

                    fetch(sortUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            ids: ids,
                            start_order: Number(sortable.dataset.startOrder || 0)
                        })
                    })
                        .then(function (response) {
                            if (!response.ok) {
                                throw new Error('Sort failed');
                            }

                            return response.json();
                        })
                        .then(function (payload) {
                            toast('success', payload.message || @json(__('catalog.categories.sorted')));
                        })
                        .catch(function () {
                            toast('error', @json(__('catalog.categories.sort_failed')));
                        });
                });

                // Dragula initialization for subcategories (tr elements inside each tbody container)
                const tbodyContainers = Array.from(sortable.querySelectorAll('tbody.category-group-sortable'));
                if (tbodyContainers.length > 0) {
                    dragula(tbodyContainers, {
                        moves: function (el, container, handle) {
                            return el.tagName === 'TR' && el.dataset.depth !== '0' && handle.closest('.catalog-drag-handle') !== null;
                        },
                        accepts: function (el, target, source, sibling) {
                            if (target !== source) return false;
                            if (sibling && sibling.dataset.depth === '0') return false;
                            return true;
                        }
                    }).on('drop', function (el, target, source, sibling) {
                        const childIds = Array.from(target.querySelectorAll('tr'))
                            .filter(function (row) {
                                return row.dataset.depth !== '0';
                            })
                            .map(function (row) {
                                return row.dataset.categoryId;
                            });

                        fetch(sortUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                ids: childIds,
                                start_order: 0
                            })
                        })
                        .then(function (response) {
                            if (!response.ok) {
                                throw new Error('Sort failed');
                            }
                            return response.json();
                        })
                        .then(function (payload) {
                            toast('success', payload.message || @json(__('catalog.categories.sorted')));
                        })
                        .catch(function () {
                            toast('error', @json(__('catalog.categories.sort_failed')));
                        });
                    });
                }
            }

            // Quick edit button click handler
            document.querySelectorAll('.js-category-quick-edit').forEach(function (button) {
                button.addEventListener('click', function () {
                    const modalEl = document.getElementById('quickEditCategoryModal');
                    if (modalEl && modalEl.__x) {
                        // Open the Alpine.js modal
                        modalEl.__x.$data.open = true;
                    }

                    const form = document.getElementById('quickEditCategoryForm');
                    const parentSelect = document.getElementById('quick_parent_id');
                    const imageUrl = button.dataset.imageUrl || '';
                    const previewWrap = document.getElementById('quickImagePreviewWrap');
                    const preview = document.getElementById('quickImagePreview');

                    form.action = quickUpdateUrlTemplate.replace('__CATEGORY_ID__', button.dataset.id);
                    document.getElementById('quick_name').value = button.dataset.name || '';
                    document.getElementById('quick_slug').value = button.dataset.slug || '';
                    
                    const descriptionVal = button.dataset.description || '';
                    document.getElementById('quick_description').value = descriptionVal;
                    const quickEditor = document.getElementById('quick_description_editor');
                    if (quickEditor && quickEditor.__quill) {
                        quickEditor.__quill.root.innerHTML = descriptionVal;
                    }

                    document.getElementById('quick_is_active').checked = button.dataset.isActive !== '1';
                    document.getElementById('quick_image_file').value = '';

                    Array.from(parentSelect.options).forEach(function (option) {
                        option.disabled = option.value === button.dataset.id;
                    });
                    parentSelect.value = button.dataset.parentId || '';

                    if (imageUrl) {
                        preview.src = imageUrl;
                        preview.alt = button.dataset.name || '';
                        if (previewWrap) {
                            previewWrap.classList.remove('hidden');
                            previewWrap.classList.remove('d-none');
                        }
                    } else {
                        preview.src = '';
                        preview.alt = '';
                        if (previewWrap) {
                            previewWrap.classList.add('hidden');
                        }
                    }
                });
            });
        });
    </script>
@endpush
