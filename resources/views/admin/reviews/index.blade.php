@extends('admin.layouts.app')

@section('title', __('admin.reviews.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.reviews.title') }}</h4>
            <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.reviews.title') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.actions.search') }}</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="{{ __('admin.reviews.search_placeholder') }}">
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.reviews.fields.product') }}</label>
                <select name="product_id" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.reviews.all_products') }}</option>
                    @foreach($products as $p)
                        @php
                            $pName = $p->getTranslation('name', app()->getLocale(), false) ?: $p->getTranslation('name', app(\App\Services\LanguageRegistry::class)->fallbackLocale(), false);
                        @endphp
                        <option value="{{ $p->id }}" @selected((string) request('product_id') === (string) $p->id)>{{ $pName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.reviews.fields.rating') }}</label>
                <select name="rating" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected((string) request('rating') === (string) $i)>{{ $i }} {{ __('admin.reviews.fields.star') }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.reviews.fields.status') }}</label>
                <select name="is_visible" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="1" @selected((string) request('is_visible') === '1')>{{ __('admin.reviews.fields.visible') }}</option>
                    <option value="0" @selected((string) request('is_visible') === '0')>{{ __('admin.reviews.fields.hidden') }}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center gap-1">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon>
                    <span>Lọc</span>
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.reviews.fields.product') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.reviews.fields.reviewer') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.reviews.fields.rating') }}</th>
                            <th class="px-6 py-3 font-bold" style="min-width: 300px;">{{ __('admin.reviews.fields.comment') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.reviews.fields.created_at') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.reviews.fields.status') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($reviews as $review)
                            @php
                                $productName = $review->product->getTranslation('name', app()->getLocale(), false) 
                                    ?: $review->product->getTranslation('name', app(\App\Services\LanguageRegistry::class)->fallbackLocale(), false);
                            @endphp
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4" style="max-width: 250px;">
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-10 rounded border border-gray-200 p-0.5 bg-white flex items-center justify-center overflow-hidden shrink-0">
                                            @if($review->product->image_url)
                                                <img src="{{ $review->product->image_url }}" alt="{{ $productName }}" class="w-full h-full object-cover">
                                            @else
                                                <iconify-icon icon="solar:box-linear" class="text-xl text-gray-400"></iconify-icon>
                                            @endif
                                        </div>
                                        <div class="text-truncate">
                                            <a href="{{ route('admin.products.edit', $review->product) }}" class="font-bold text-gray-900 hover:text-primary transition-colors block truncate">
                                                {{ $productName }}
                                            </a>
                                            <div class="text-2xs text-gray-400">SKU: {{ $review->product->sku }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900">{{ $review->customer_name }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">{{ $review->customer_email }}</div>
                                    <div class="mt-1">
                                        @if($review->user)
                                            <x-admin.badge variant="primary">{{ __('admin.reviews.fields.member') }}</x-admin.badge>
                                        @else
                                            <x-admin.badge variant="secondary">{{ __('admin.reviews.fields.guest') }}</x-admin.badge>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-amber-500">
                                    <div class="flex gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <iconify-icon icon="solar:star-bold" class="text-base"></iconify-icon>
                                            @else
                                                <iconify-icon icon="solar:star-linear" class="text-base text-gray-300"></iconify-icon>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700 text-wrap" style="max-width: 450px;">
                                    {{ $review->comment }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    {{ $review->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input class="sr-only peer js-visibility-toggle" type="checkbox"
                                               data-url="{{ route('admin.reviews.toggle-visibility', $review) }}"
                                               @checked($review->is_visible)>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    </label>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <x-admin.button type="button" variant="outline" size="xs" class="js-edit-review-btn" 
                                            data-url="{{ route('admin.reviews.update', $review) }}"
                                            data-comment="{{ $review->comment }}"
                                            data-visible="{{ $review->is_visible ? 1 : 0 }}"
                                            title="{{ __('catalog.actions.edit') }}">
                                            <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                        </x-admin.button>
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline js-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <x-admin.button type="submit" variant="danger" size="xs" title="{{ __('catalog.actions.delete') }}">
                                                <iconify-icon icon="solar:trash-bin-trash-linear"></iconify-icon>
                                            </x-admin.button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:chat-square-like-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.reviews.not_found') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($reviews->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Edit Review Modal (Alpine.js Modal Replacement) -->
    <div x-data="{ open: false }" 
          @keydown.escape.window="open = false" 
          class="relative z-50" 
          id="editReviewModal"
          style="display: none;"
          x-show="open" 
          x-transition>
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-150">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50/50">
                        <h5 class="text-base font-bold text-gray-900" id="editReviewModalLabel">{{ __('admin.reviews.edit') }}</h5>
                        <button type="button" @click="open = false" class="text-gray-450 hover:text-gray-600 focus:outline-none">
                            <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
                        </button>
                    </div>
                    <form id="editReviewForm" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="p-6 space-y-4">
                            <div>
                                <label for="modal_comment" class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.reviews.fields.comment') }} <span class="text-red-500">*</span></label>
                                <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="modal_comment" name="comment" rows="5" required></textarea>
                            </div>
                            <div class="flex items-center">
                                <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer font-bold" type="checkbox" name="is_visible" value="1" id="modal_is_visible">
                                <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="modal_is_visible">{{ __('admin.reviews.show_on_website') }}</label>
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
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Edit modal handling using Alpine.js properties
            const editModalEl = document.getElementById('editReviewModal');
            const editForm = document.getElementById('editReviewForm');
            const modalComment = document.getElementById('modal_comment');
            const modalIsVisible = document.getElementById('modal_is_visible');

            document.querySelectorAll('.js-edit-review-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const actionUrl = this.getAttribute('data-url');
                    const comment = this.getAttribute('data-comment');
                    const isVisible = this.getAttribute('data-visible') === '1';

                    editForm.action = actionUrl;
                    modalComment.value = comment;
                    modalIsVisible.checked = isVisible;

                    if (editModalEl && editModalEl.__x) {
                        editModalEl.__x.$data.open = true;
                    }
                });
            });

            // Edit Form submit via AJAX
            if (editForm) {
                editForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: "{{ __('admin.reviews.saving') }}",
                        text: "{{ __('admin.reviews.please_wait') }}",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Prepare form data including checkbox logic
                    const formData = new FormData(editForm);
                    if (!formData.has('is_visible')) {
                        formData.append('is_visible', '0');
                    }

                    fetch(editForm.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: "{{ __('admin.settings.success') }}",
                                text: data.message || "{{ __('admin.reviews.updated') }}",
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                if (editModalEl && editModalEl.__x) {
                                    editModalEl.__x.$data.open = false;
                                }
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "{{ __('admin.settings.error') }}",
                                text: data.message || "{{ __('admin.reviews.update_failed') }}"
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        let errMsg = 'Không thể kết nối đến máy chủ.';
                        if (error.errors) {
                            errMsg = Object.values(error.errors).flat().join('\n');
                        } else if (error.message) {
                            errMsg = error.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: "{{ __('admin.settings.error') }}",
                            text: errMsg
                        });
                    });
                });
            }

            // Quick Visibility Toggle via AJAX
            document.querySelectorAll('.js-visibility-toggle').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const url = this.getAttribute('data-url');
                    const isChecked = this.checked;

                    fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                            Toast.fire({
                                icon: 'success',
                                title: "{{ __('admin.reviews.status_updated') }}"
                            });
                        } else {
                            this.checked = !isChecked; // revert
                            Swal.fire({
                                icon: 'error',
                                title: "{{ __('admin.settings.error') }}",
                                text: data.message || 'Có lỗi xảy ra.'
                            });
                        }
                    })
                    .catch(error => {
                        this.checked = !isChecked; // revert
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: "{{ __('admin.settings.error') }}",
                            text: "{{ __('admin.reviews.status_update_failed') }}"
                        });
                    });
                });
            });
        });
    </script>
@endpush
