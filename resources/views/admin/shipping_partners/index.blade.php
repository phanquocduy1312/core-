@extends('admin.layouts.app')

@section('title', __('admin.shipping_partners.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1">{{ __('admin.shipping_partners.title') }}</h4>
            <nav class="flex text-sm text-slate-300" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <a href="{{ route('admin.settings.index') }}" class="hover:text-white transition-colors">{{ __('admin.sidebar.settings') }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.shipping_partners.title') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Partner Showcase Card -->
    <x-admin.card class="mb-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
            <div>
                <h5 class="text-base font-bold text-gray-900 mb-0.5">{{ __('admin.shipping_partners.title') }}</h5>
                <p class="text-xs text-gray-500">{{ __('admin.shipping_partners.partner_subtitle') }}</p>
            </div>
            <x-admin.button variant="primary" size="sm" href="{{ route('admin.shipping-partners.create') }}">
                <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('admin.shipping_partners.add_partner') }}
            </x-admin.button>
        </div>

        <!-- Partner logo list -->
        <div class="flex items-center gap-6 flex-wrap mt-4">
            <img src="{{ asset('admin-assets/images/logo-vanchuyen/Logo-GHTK.webp') }}" alt="GHTK" class="h-12 max-w-[140px] object-contain grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
            <img src="{{ asset('admin-assets/images/logo-vanchuyen/J&TExpress.png') }}" alt="J&T Express" class="h-9 max-w-[140px] object-contain grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
            <img src="{{ asset('admin-assets/images/logo-vanchuyen/logo-giao-hang-nhanh.jpg') }}" alt="Giao Hàng Nhanh" class="h-9 max-w-[160px] object-contain grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
            <img src="{{ asset('admin-assets/images/logo-vanchuyen/SPXEXPRESS.png') }}" alt="SPX Express" class="h-10 max-w-[150px] object-contain grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
            <img src="{{ asset('admin-assets/images/logo-vanchuyen/Viettel_Post_logo.svg') }}" alt="Viettel Post" class="h-11 max-w-[140px] object-contain grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
        </div>
    </x-admin.card>

    <!-- Partners List Card/Table -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between">
        <div>
            <div class="px-6 py-4 border-b border-gray-200">
                <h5 class="text-base font-bold text-gray-900">{{ __('admin.shipping_partners.list_title') }}</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.shipping_partners.partner_code') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.shipping_partners.partner_name') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.shipping_partners.account_or_phone') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.shipping_partners.type') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.shipping_partners.status') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($partners as $partner)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-mono text-gray-900 font-bold text-xs">{{ $partner->partner_code }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg border border-gray-200 bg-white p-1 flex items-center justify-center overflow-hidden">
                                            @if($partner->logo_url && file_exists(public_path('admin-assets/images/logo-vanchuyen/' . $partner->logo_url)))
                                                <img src="{{ asset('admin-assets/images/logo-vanchuyen/' . $partner->logo_url) }}" alt="{{ $partner->name }}" class="w-full h-full object-contain">
                                            @else
                                                <iconify-icon icon="solar:delivery-line-duotone" class="text-2xl text-primary"></iconify-icon>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-900 block">{{ $partner->name }}</span>
                                            @if($partner->type === 'custom')
                                                <span class="text-xs text-gray-500">{{ __('admin.shipping_partners.fee') }}: {{ number_format($partner->settings['fee'] ?? 0, 0, ',', '.') }} ₫</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700">
                                    {{ $partner->account_name ?: ($partner->phone ?: __('admin.shipping_partners.not_configured')) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($partner->type === 'connected')
                                        <x-admin.badge variant="success">{{ __('admin.shipping_partners.api_connected') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="info">{{ __('admin.shipping_partners.self_delivery') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input class="sr-only peer js-status-toggle" type="checkbox" role="switch"
                                            data-url="{{ route('admin.shipping-partners.toggle-status', $partner) }}"
                                            @checked($partner->status === 'active')>
                                        <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                                    </label>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <x-admin.dropdown align="right" width="56">
                                        <x-slot name="trigger">
                                            <button class="inline-flex items-center gap-1.5 py-1.5 px-3 text-xs font-semibold text-gray-700 bg-gray-150 rounded-lg hover:bg-gray-200 focus:outline-none transition-colors">
                                                {{ __('admin.shipping_partners.edit_title') }}
                                                <iconify-icon icon="solar:alt-arrow-down-linear" class="text-[11px]"></iconify-icon>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            @if($partner->type === 'connected' || $partner->partner_code === 'DTGHTUGIAO')
                                                <a class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('admin.shipping-partners.settings', $partner) }}">
                                                    <iconify-icon icon="solar:settings-linear" class="text-base text-gray-500"></iconify-icon>
                                                    <span>{{ __('admin.shipping_partners.setup_connection') }}</span>
                                                </a>
                                            @endif
                                            @if($partner->type === 'custom')
                                                <a class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('admin.shipping-partners.edit', $partner) }}">
                                                    <iconify-icon icon="solar:pen-linear" class="text-base text-gray-500"></iconify-icon>
                                                    <span>{{ __('admin.shipping_partners.edit') }}</span>
                                                </a>
                                                <form action="{{ route('admin.shipping-partners.destroy', $partner) }}" method="POST" class="js-delete-form block border-t border-gray-100">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex items-center w-full gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left font-semibold">
                                                        <iconify-icon icon="solar:trash-bin-trash-linear" class="text-base"></iconify-icon>
                                                        <span>{{ __('admin.shipping_partners.delete') }}</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </x-slot>
                                    </x-admin.dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-400">
                                    <iconify-icon icon="solar:delivery-broken" class="text-4xl mb-2 inline-block"></iconify-icon>
                                    <p class="text-sm font-semibold">{{ __('admin.shipping_partners.unconfigured_warning') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle Status Toggle Switch via AJAX
        document.querySelectorAll('.js-status-toggle').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const url = this.getAttribute('data-url');
                const isChecked = this.checked;

                fetch(url, {
                    method: 'POST',
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
                            title: data.message || '{{ __('admin.shipping_partners.updated') }}'
                        });
                    } else {
                        this.checked = !isChecked; // revert
                        Swal.fire({
                            icon: 'error',
                            title: '{{ __('admin.shipping_partners.notification') }}',
                            text: data.message || '{{ __('admin.error') }}'
                        });
                    }
                })
                .catch(error => {
                    this.checked = !isChecked; // revert
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __('admin.shipping_partners.error_title') }}',
                        text: '{{ __('admin.shipping_partners.error_text') }}'
                    });
                });
            });
        });
    });
</script>
@endpush
