@extends('admin.layouts.app')

@section('title', __('admin.blog_categories.title'))

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
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.blog_categories.title') }}</h4>
                <div class="text-slate-350 text-sm">{{ __('admin.blog_categories.drag_subtitle') }}</div>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.post-categories.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('admin.blog_categories.create') }}
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Success/Error Notifications -->
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-250 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:check-circle-bold" class="text-lg"></iconify-icon>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="text-emerald-500 hover:text-emerald-700" onclick="this.parentElement.remove()">
                <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:info-circle-bold" class="text-lg"></iconify-icon>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
            </button>
        </div>
    @endif

    <!-- Search Form Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-10">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.actions.search') }}</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="{{ __('admin.blog_categories.search_placeholder') }}">
            </div>
            <div class="col-span-12 md:col-span-2">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center gap-1">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon>
                    <span>{{ __('catalog.actions.search') }}</span>
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500" id="category-table-sortable" data-start-order="{{ max(0, ($categories->firstItem() ?? 1) - 1) }}">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.blog_categories.title') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.parent_category') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.blog_categories.fields.status') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    @php $isFirstTbody = true; @endphp
                    @forelse($categories as $category)
                        @php
                            $fallbackLocale = app(\App\Services\LanguageRegistry::class)->fallbackLocale();
                            $categoryName = $category->getTranslation('name', app()->getLocale(), false) ?: $category->getTranslation('name', $fallbackLocale, false);
                            $categoryDescription = $category->getTranslation('description', app()->getLocale(), false) ?: $category->getTranslation('description', $fallbackLocale, false) ?: '';
                        @endphp
                        @if(($category->depth ?? 0) === 0)
                            @if(!$isFirstTbody)
                                </tbody>
                            @endif
                            @php $isFirstTbody = false; @endphp
                            <tbody class="category-group-sortable" data-category-id="{{ $category->id }}">
                        @endif
                        <tr class="hover:bg-gray-55/50 border-b border-gray-200 transition-colors" data-category-id="{{ $category->id }}" data-depth="{{ $category->depth ?? 0 }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center" style="padding-left: {{ ($category->depth ?? 0) * 32 }}px;">
                                    <span class="catalog-drag-handle mr-2 text-gray-400 cursor-grab hover:text-gray-650 flex shrink-0" title="{{ __('catalog.actions.drag_sort') }}">
                                        <iconify-icon icon="solar:list-arrow-down-linear" class="text-lg"></iconify-icon>
                                    </span>
                                    <div>
                                        <h6 class="font-bold text-gray-900 leading-tight">{{ $categoryName }}</h6>
                                        <span class="text-2xs text-gray-400 mt-0.5 block">{{ $category->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($category->parent)
                                    <x-admin.badge variant="info">
                                        {{ $category->parent->getTranslation('name', app()->getLocale(), false) ?: $category->parent->getTranslation('name', $fallbackLocale, false) }}
                                    </x-admin.badge>
                                @else
                                    <x-admin.badge variant="secondary">{{ __('catalog.common.none') }}</x-admin.badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($category->is_active)
                                    <x-admin.badge variant="success">{{ __('admin.blog_categories.fields.active') }}</x-admin.badge>
                                @else
                                    <x-admin.badge variant="warning">{{ __('admin.blog_categories.fields.inactive') }}</x-admin.badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <x-admin.dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="text-gray-450 hover:text-gray-650 transition-colors p-1" type="button" aria-label="Thao tác">
                                            <iconify-icon icon="solar:menu-dots-bold" class="text-lg"></iconify-icon>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <button type="button"
                                                class="w-full text-left px-4 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50 flex items-center gap-2 js-category-quick-edit"
                                                data-id="{{ $category->id }}"
                                                data-name="{{ $categoryName }}"
                                                data-slug="{{ $category->slug }}"
                                                data-parent-id="{{ $category->parent_id }}"
                                                data-description="{{ $categoryDescription }}"
                                                data-is-active="{{ $category->is_active ? 1 : 0 }}">
                                            <iconify-icon icon="solar:bolt-linear" class="text-sm"></iconify-icon>
                                            <span>{{ __('catalog.actions.quick_edit') }}</span>
                                        </button>
                                        <a class="block px-4 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50 flex items-center gap-2" href="{{ route('admin.post-categories.edit', $category) }}">
                                            <iconify-icon icon="solar:pen-linear" class="text-sm"></iconify-icon>
                                            <span>{{ __('admin.blog_categories.edit_details') }}</span>
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <form method="POST" action="{{ route('admin.post-categories.destroy', $category) }}" class="js-delete-form block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-xs font-semibold text-red-650 hover:bg-red-50 flex items-center gap-2" onclick="return confirm('{{ __('admin.blog_categories.confirm_delete') }}')">
                                                <iconify-icon icon="solar:trash-bin-trash-linear" class="text-sm"></iconify-icon>
                                                <span>{{ __('admin.blog_categories.delete_category') }}</span>
                                            </button>
                                        </form>
                                    </x-slot>
                                </x-admin.dropdown>
                            </td>
                        </tr>
                    @empty
                        <tbody id="category-empty-body">
                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:widget-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.blog_categories.not_found') }}</p>
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
            @if(!$categories->isEmpty() && $categories->hasPages())
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
                            {{ __('catalog.actions.quick_edit') }}
                        </h3>
                        <button type="button" @click="open = false" class="text-gray-450 hover:text-gray-600 focus:outline-none">
                            <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_name">{{ __('admin.blog_categories.fields.name') }} <span class="text-red-500">*</span></label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="quick_name" name="name" required>
                            </div>
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_slug">{{ __('admin.blog_categories.fields.slug') }}</label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="quick_slug" name="slug">
                            </div>
                            <div class="md:col-span-3">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_parent_id">{{ __('catalog.fields.parent_category') }}</label>
                                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="quick_parent_id" name="parent_id">
                                    <option value="">{{ __('catalog.common.none') }}</option>
                                    @foreach($parentOptions as $parent)
                                        @php
                                            $parentName = $parent->getTranslation('name', app()->getLocale(), false) ?: $parent->getTranslation('name', $fallbackLocale, false);
                                        @endphp
                                        <option value="{{ $parent->id }}">
                                            {!! str_repeat('&nbsp;&nbsp;', $parent->depth ?? 0) !!}{{ $parent->depth ? '↳ ' : '' }}{{ $parentName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-3">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="quick_description">{{ __('admin.blog_categories.fields.description') }}</label>
                                <textarea class="hidden" id="quick_description" name="description"></textarea>
                                <div id="quick_description_editor" class="catalog-quill bg-white rounded-lg border border-gray-300" data-target="quick_description" style="height: 150px;"></div>
                            </div>
                            <div class="md:col-span-3 flex items-center pt-2">
                                <input type="hidden" name="is_active" value="1">
                                <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="0" id="quick_is_active">
                                <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="quick_is_active">{{ __('admin.blog_categories.save_draft_help') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-end gap-2 bg-gray-50/50">
                        <button type="button" @click="open = false" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-4 py-2 text-xs">
                            {{ __('catalog.actions.cancel') }}
                        </button>
                        <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white px-4 py-2 text-xs">
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
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const sortUrl = "{{ route('admin.post-categories.sort') }}";
            const quickUpdateUrlTemplate = "{{ route('admin.post-categories.quick-update', ['post_category' => '__CATEGORY_ID__']) }}";
            const sortable = document.getElementById('category-table-sortable');

            // Quick Editor initialization
            const quickEditorElement = document.getElementById('quick_description_editor');
            if (quickEditorElement && window.Quill) {
                const target = document.getElementById(quickEditorElement.dataset.target);
                const quill = new Quill(quickEditorElement, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['clean']
                        ]
                    }
                });

                quill.on('text-change', function () {
                    target.value = quill.root.innerHTML;
                });

                quickEditorElement.__quill = quill;

                const form = quickEditorElement.closest('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        target.value = quill.root.innerHTML;
                    });
                }
            }

            // Dragula initialization for reordering root categories (tbody elements)
            if (sortable && sortable.querySelector('tbody.category-group-sortable') && window.dragula) {
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
                        toast('success', payload.message || "{{ __('admin.blog_categories.sorted_success') }}");
                    })
                    .catch(function () {
                        toast('error', "{{ __('admin.blog_categories.sorted_failed') }}");
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
                            toast('success', payload.message || "{{ __('admin.blog_categories.sorted_sub_success') }}");
                        })
                        .catch(function () {
                            toast('error', "{{ __('admin.blog_categories.sorted_sub_failed') }}");
                        });
                    });
                }
            }

            // Bind values to quick edit modal
            document.querySelectorAll('.js-category-quick-edit').forEach(function (button) {
                button.addEventListener('click', function () {
                    const modalEl = document.getElementById('quickEditCategoryModal');
                    if (modalEl && modalEl.__x) {
                        // Open Alpine.js modal
                        modalEl.__x.$data.open = true;
                    }

                    const form = document.getElementById('quickEditCategoryForm');
                    const parentSelect = document.getElementById('quick_parent_id');

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

                    Array.from(parentSelect.options).forEach(function (option) {
                        option.disabled = option.value === button.dataset.id;
                    });
                    parentSelect.value = button.dataset.parentId || '';
                });
            });
        });
    </script>
@endpush
