@extends('admin.layouts.app')

@section('title', __('admin.customers.profile_title'))

@section('content')
@php
    $initials = collect(preg_split('/\s+/', trim($customerName)))
        ->filter()
        ->take(2)
        ->map(fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)))
        ->join('');
    $completionRate = (int) $metrics->total_orders > 0
        ? round(((int) $metrics->completed_orders / (int) $metrics->total_orders) * 100)
        : 0;
    $averageCompletedOrder = (int) $metrics->completed_orders > 0
        ? (float) $metrics->total_spent / (int) $metrics->completed_orders
        : 0;
    $firstOrderAt = $metrics->first_order_at ? \Carbon\Carbon::parse($metrics->first_order_at) : null;
    $lastOrderAt = $metrics->last_order_at ? \Carbon\Carbon::parse($metrics->last_order_at) : null;
@endphp

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-primary-hover transition-colors">
            <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
            {{ __('admin.customers.back_to_list') }}
        </a>
    </div>

    <!-- Profile Hero Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 text-white rounded-xl shadow-lg border border-slate-750 p-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl border-2 border-white/20 bg-white/10 flex items-center justify-center text-white font-extrabold text-xl tracking-wider select-none shrink-0 shadow-inner">
                    {{ $initials ?: '?' }}
                </div>
                <div>
                    <span class="text-2xs font-bold uppercase tracking-wider text-slate-400">Hồ sơ khách hàng</span>
                    <h1 class="text-2xl font-black text-white mt-0.5">{{ $customerName }}</h1>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-slate-300 mt-1">
                        <span class="flex items-center gap-1"><iconify-icon icon="solar:letter-linear" class="text-base"></iconify-icon>{{ $customerEmail }}</span>
                        @if($customerPhone)
                            <span class="flex items-center gap-1"><iconify-icon icon="solar:phone-linear" class="text-base"></iconify-icon>{{ $customerPhone }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="shrink-0 bg-black/20 border border-white/10 rounded-xl p-3 flex items-center justify-between gap-4">
                <div>
                    <span class="text-2xs font-bold text-slate-400 block">Loại khách hàng</span>
                    <span class="text-sm font-extrabold text-white mt-0.5 block">{{ $registeredCustomer ? __('admin.customers.registered') : __('admin.customers.guest') }}</span>
                </div>
                <x-admin.badge :variant="$registeredCustomer ? 'success' : 'secondary'">
                    {{ $registeredCustomer ? 'Tài khoản' : 'Mua không tài khoản' }}
                </x-admin.badge>
            </div>
        </div>
    </div>

    <!-- Details and Stats Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 mb-6">
        <!-- Contact Info Card -->
        <div class="xl:col-span-4 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="px-5 py-4 border-b border-gray-200 bg-gray-50/50">
                    <h5 class="font-bold text-gray-900">Thông tin liên hệ</h5>
                    <p class="text-2xs text-gray-400 mt-0.5">Dữ liệu từ đơn hàng gần nhất</p>
                </div>
                <div class="p-5 divide-y divide-gray-150 space-y-4">
                    <div class="flex items-start gap-3 pt-0 first:pt-0">
                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 text-lg">
                            <iconify-icon icon="solar:letter-linear"></iconify-icon>
                        </span>
                        <div>
                            <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider block">Email</span>
                            <span class="text-sm font-bold text-gray-900 mt-0.5 block break-all">{{ $customerEmail }}</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pt-4">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 text-lg">
                            <iconify-icon icon="solar:phone-linear"></iconify-icon>
                        </span>
                        <div>
                            <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider block">Điện thoại</span>
                            <span class="text-sm font-bold text-gray-900 mt-0.5 block">{{ $customerPhone ?: 'Chưa có thông tin' }}</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pt-4">
                        <span class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-lg">
                            <iconify-icon icon="solar:calendar-linear"></iconify-icon>
                        </span>
                        <div>
                            <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider block">Lần mua đầu</span>
                            <span class="text-sm font-bold text-gray-900 mt-0.5 block">{{ $firstOrderAt?->format('d/m/Y H:i') ?? 'Chưa xác định' }}</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pt-4 pb-0 last:pb-0">
                        <span class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0 text-lg">
                            <iconify-icon icon="solar:clock-circle-linear"></iconify-icon>
                        </span>
                        <div>
                            <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider block">Đơn gần nhất</span>
                            <span class="text-sm font-bold text-gray-900 mt-0.5 block">{{ $lastOrderAt?->format('d/m/Y H:i') ?? 'Chưa có đơn' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if($registeredCustomer)
                <div class="p-4 bg-gray-50 border-t border-gray-150 text-xs font-semibold text-gray-600 flex items-center gap-1.5">
                    <iconify-icon icon="solar:verified-check-bold" class="text-emerald-500 text-base"></iconify-icon>
                    Khách đã đăng ký tài khoản từ {{ $registeredCustomer->created_at?->format('d/m/Y') }}.
                </div>
            @endif
        </div>

        <!-- Spend Stats Card -->
        <div class="xl:col-span-8 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between">
            <div class="px-5 py-4 border-b border-gray-200 bg-gray-50/50">
                <h5 class="font-bold text-gray-900">Tổng quan chi tiêu</h5>
                <p class="text-2xs text-gray-400 mt-0.5">Chỉ số tính từ tất cả các đơn hàng của khách hàng này</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-200 h-full">
                <!-- Total Orders -->
                <div class="p-5 flex flex-col justify-between min-h-[110px]">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider">Tổng đơn</span>
                        <span class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-base">
                            <iconify-icon icon="solar:bag-4-linear"></iconify-icon>
                        </span>
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl font-black text-gray-900 leading-none">{{ number_format($metrics->total_orders) }}</div>
                        <span class="text-3xs font-semibold text-gray-400 mt-1 block">Tất cả đơn đã đặt</span>
                    </div>
                </div>

                <!-- Completion Rate -->
                <div class="p-5 flex flex-col justify-between min-h-[110px]">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider">Tỷ lệ hoàn tất</span>
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                            <iconify-icon icon="solar:check-circle-linear"></iconify-icon>
                        </span>
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl font-black text-gray-900 leading-none">{{ number_format($completionRate) }}%</div>
                        <span class="text-3xs font-semibold text-gray-400 mt-1 block">{{ number_format($metrics->completed_orders) }}/{{ number_format($metrics->total_orders) }} đơn thành công</span>
                    </div>
                </div>

                <!-- Spent -->
                <div class="p-5 flex flex-col justify-between min-h-[110px]">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider">Đã chi tiêu</span>
                        <span class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-base">
                            <iconify-icon icon="solar:wallet-money-linear"></iconify-icon>
                        </span>
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl font-black text-gray-900 leading-none">{{ number_format($metrics->total_spent, 0, ',', '.') }}₫</div>
                        <span class="text-3xs font-semibold text-gray-400 mt-1 block">Chỉ tính đơn hoàn tất</span>
                    </div>
                </div>

                <!-- Average Spent -->
                <div class="p-5 flex flex-col justify-between min-h-[110px]">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-2xs font-bold text-gray-400 uppercase tracking-wider">Giá trị TB</span>
                        <span class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-base">
                            <iconify-icon icon="solar:chart-2-linear"></iconify-icon>
                        </span>
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl font-black text-gray-900 leading-none">{{ number_format($averageCompletedOrder, 0, ',', '.') }}₫</div>
                        <span class="text-3xs font-semibold text-gray-400 mt-1 block">Mỗi đơn hoàn tất</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order History Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div class="px-5 py-4 border-b border-gray-200 bg-gray-50/50 flex flex-wrap items-center justify-between gap-2">
            <div>
                <h5 class="font-bold text-gray-900">{{ __('admin.customers.order_history') }}</h5>
                <p class="text-2xs text-gray-400 mt-0.5">{{ number_format($metrics->total_orders) }} đơn hàng của khách</p>
            </div>
            <span class="text-3xs font-extrabold uppercase tracking-wider text-gray-400">Mới nhất trước</span>
        </div>
        <div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.customers.order_number') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.customers.status') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.customers.payment_status') }}</th>
                            <th class="px-6 py-3 font-bold text-right">Tổng thanh toán</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.customers.last_order') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($orders as $order)
                            @php
                                $statusVariant = match($order->status) {
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                                $paymentVariant = match($order->payment_status) {
                                    'pending' => 'warning',
                                    'paid' => 'success',
                                    'failed' => 'danger',
                                    'partially_refunded' => 'info',
                                    'refunded' => 'secondary',
                                    default => 'secondary'
                                };
                            @endphp
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-bold text-gray-900">{{ $order->order_number }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">{{ $order->customer_phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.badge :variant="$statusVariant">{{ __('admin.orders.statuses.'.$order->status) }}</x-admin.badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.badge :variant="$paymentVariant">{{ __('admin.orders.payment_statuses.'.$order->payment_status) }}</x-admin.badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-gray-900">
                                    {{ number_format($order->grand_total, 0, ',', '.') }} ₫
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-650 text-xs">
                                    {{ $order->created_at->format('d/m/Y') }} <span class="text-gray-400 ml-1">{{ $order->created_at->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <x-admin.button variant="outline" size="xs" href="{{ route('admin.orders.show', $order) }}">
                                        {{ __('admin.customers.details') }}
                                    </x-admin.button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:bill-list-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.customers.empty') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
