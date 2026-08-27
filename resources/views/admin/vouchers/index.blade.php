@extends('admin.layouts.app')

@section('title', __('admin.vouchers.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.vouchers.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.vouchers.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.vouchers.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('admin.vouchers.create') }}
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-6">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.actions.search') }}</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="{{ __('admin.vouchers.search_placeholder') }}">
            </div>
            <div class="col-span-12 md:col-span-4">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.users.fields.status') }}</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="1" @selected((string) request('status') === '1')>{{ __('admin.vouchers.statuses.active') }}</option>
                    <option value="0" @selected((string) request('status') === '0')>{{ __('admin.vouchers.statuses.inactive') }}</option>
                </select>
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
            @include('admin.shared.bulk-actions', [
                'bulkFormId' => 'bulk-vouchers-form',
                'bulkActionUrl' => route('admin.vouchers.bulk'),
                'bulkItemLabel' => 'mã giảm giá',
            ])
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3" style="width: 44px;">
                                <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" data-bulk-select-all="bulk-vouchers-form" aria-label="Chọn tất cả mã giảm giá">
                            </th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.vouchers.fields.code') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.vouchers.fields.name') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.vouchers.fields.type') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.vouchers.fields.value') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.vouchers.fields.min_order_amount') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.vouchers.fields.used_count') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.vouchers.fields.end_date') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.vouchers.fields.is_active') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($vouchers as $voucher)
                            @php
                                $fallbackLocale = app(\App\Services\LanguageRegistry::class)->fallbackLocale();
                                $name = $voucher->getTranslation('name', app()->getLocale(), false) ?: $voucher->getTranslation('name', $fallbackLocale, false);
                                $description = $voucher->getTranslation('description', app()->getLocale(), false) ?: $voucher->getTranslation('description', $fallbackLocale, false);
                                
                                $isExpired = $voucher->end_date && $voucher->end_date->isPast();
                                $isNotStarted = $voucher->start_date && $voucher->start_date->isFuture();
                                $isLimitReached = $voucher->quantity !== null && $voucher->used_count >= $voucher->quantity;
                            @endphp
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" name="ids[]" value="{{ $voucher->id }}" form="bulk-vouchers-form" data-bulk-select="bulk-vouchers-form" aria-label="Chọn {{ $voucher->code }}">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono">
                                    <span class="inline-block bg-primary/10 text-primary border border-primary/20 text-xs font-bold px-2.5 py-1.5 rounded-lg">
                                        {{ $voucher->code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="font-bold text-gray-900">{{ $name }}</div>
                                    @if($description)
                                        <div class="text-xs text-gray-400 mt-1 truncate" title="{{ $description }}">{{ $description }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($voucher->type === 'percentage')
                                        <x-admin.badge variant="info">{{ __('admin.vouchers.fields.percentage') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="success">{{ __('admin.vouchers.fields.fixed') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-red-650">
                                    @if($voucher->type === 'percentage')
                                        {{ number_format($voucher->value, 0) }}%
                                    @else
                                        {{ number_format($voucher->value, 0) }} đ
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    <div>Tối thiểu: <strong class="text-gray-950">{{ number_format($voucher->min_order_amount, 0) }} đ</strong></div>
                                    @if($voucher->type === 'percentage')
                                        <div class="mt-0.5 text-gray-400">Tối đa: {{ $voucher->max_discount_amount ? number_format($voucher->max_discount_amount, 0) . ' đ' : __('admin.vouchers.no_limit') }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    @php
                                        $percent = 0;
                                        if ($voucher->quantity > 0) {
                                            $percent = min(100, ($voucher->used_count / $voucher->quantity) * 100);
                                        }
                                    @endphp
                                    <div class="w-24 bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="mt-1 block font-semibold text-gray-900">
                                        {{ $voucher->used_count }} / {{ $voucher->quantity ?? '∞' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-2xs text-gray-500 space-y-0.5">
                                    @if($voucher->start_date || $voucher->end_date)
                                        <div>Từ: <span class="font-semibold text-gray-700">{{ $voucher->start_date ? $voucher->start_date->format('d/m/Y H:i') : '...' }}</span></div>
                                        <div>Đến: <span class="font-semibold text-gray-700">{{ $voucher->end_date ? $voucher->end_date->format('d/m/Y H:i') : '...' }}</span></div>
                                    @else
                                        <span class="text-gray-400">{{ __('admin.vouchers.no_limit') }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(!$voucher->is_active)
                                        <x-admin.badge variant="danger">{{ __('admin.vouchers.statuses.inactive') }}</x-admin.badge>
                                    @elseif($isExpired)
                                        <x-admin.badge variant="secondary">{{ __('admin.vouchers.statuses.expired') }}</x-admin.badge>
                                    @elseif($isNotStarted)
                                        <x-admin.badge variant="warning">{{ __('admin.vouchers.statuses.upcoming') }}</x-admin.badge>
                                    @elseif($isLimitReached)
                                        <x-admin.badge variant="secondary">{{ __('admin.vouchers.statuses.out_of_stock') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="success">{{ __('admin.vouchers.statuses.running') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <x-admin.button variant="outline" size="xs" href="{{ route('admin.vouchers.edit', $voucher) }}" title="{{ __('catalog.actions.edit') }}">
                                            <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                        </x-admin.button>
                                        <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" onsubmit="return confirm('{{ __('admin.vouchers.confirm_delete') }}');" class="inline">
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
                                <td colspan="10" class="text-center py-10 text-gray-450">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:ticket-sale-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.vouchers.not_found') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($vouchers->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $vouchers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
