@extends('admin.layouts.app')

@section('title', __('admin.menu.orders'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.menu.orders') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.menu.orders') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.orders.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> Tạo đơn hàng
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-4">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.actions.search') }}</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="{{ __('admin.orders.search_placeholder') }}">
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.orders.fields.status') }}</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="pending" @selected(request('status') === 'pending')>{{ __('admin.orders.statuses.pending') }}</option>
                    <option value="processing" @selected(request('status') === 'processing')>{{ __('admin.orders.statuses.processing') }}</option>
                    <option value="completed" @selected(request('status') === 'completed')>{{ __('admin.orders.statuses.completed') }}</option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>{{ __('admin.orders.statuses.cancelled') }}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.orders.fields.payment_status') }}</label>
                <select name="payment_status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="pending" @selected(request('payment_status') === 'pending')>{{ __('admin.orders.payment_statuses.pending') }}</option>
                    <option value="paid" @selected(request('payment_status') === 'paid')>{{ __('admin.orders.payment_statuses.paid') }}</option>
                    <option value="failed" @selected(request('payment_status') === 'failed')>{{ __('admin.orders.payment_statuses.failed') }}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.orders.fields.shipping_status') }}</label>
                <select name="shipping_status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    @foreach($shippingStatuses as $shippingStatus)
                        <option value="{{ $shippingStatus }}" @selected(request('shipping_status') === $shippingStatus)>
                            {{ __('admin.orders.shipping_statuses.'.$shippingStatus) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-1">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center">
                    <iconify-icon icon="solar:magnifer-linear" class="text-lg"></iconify-icon>
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
                            <th class="px-6 py-3 font-bold">{{ __('admin.orders.fields.order_number') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.orders.fields.customer') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.orders.fields.order_date') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.orders.fields.total') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.orders.fields.payment') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.orders.fields.shipping_status') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.orders.fields.status') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-bold text-primary">{{ $order->order_number }}</span>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-900">{{ $order->customer_name }}</span>
                                        <span class="text-xs text-gray-400 mt-0.5">{{ $order->customer_phone }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-650">
                                    {{ $order->created_at->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">
                                    {{ number_format($order->grand_total, 0, ',', '.') }} ₫
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($order->payment_status === 'paid')
                                        <x-admin.badge variant="success">{{ __('admin.orders.payment_statuses.paid') }}</x-admin.badge>
                                    @elseif($order->payment_status === 'pending')
                                        <x-admin.badge variant="warning">{{ __('admin.orders.payment_statuses.pending') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="danger">{{ __('admin.orders.payment_statuses.failed') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $shipClass = 'info';
                                        if ($order->shipping_status === 'delivered') $shipClass = 'success';
                                        if ($order->shipping_status === 'failed') $shipClass = 'danger';
                                        if ($order->shipping_status === 'cancelled') $shipClass = 'danger';
                                    @endphp
                                    <x-admin.badge :variant="$shipClass">{{ $order->shippingStatusLabel() }}</x-admin.badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($order->status === 'completed')
                                        <x-admin.badge variant="success">{{ __('admin.orders.statuses.completed') }}</x-admin.badge>
                                    @elseif($order->status === 'processing')
                                        <x-admin.badge variant="info">{{ __('admin.orders.statuses.processing') }}</x-admin.badge>
                                    @elseif($order->status === 'cancelled')
                                        <x-admin.badge variant="danger">{{ __('admin.orders.statuses.cancelled') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="warning">{{ __('admin.orders.statuses.pending') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <x-admin.button variant="outline" size="xs" href="{{ route('admin.orders.show', $order) }}">
                                        <iconify-icon icon="solar:eye-linear" class="mr-1"></iconify-icon> {{ __('admin.orders.details') }}
                                    </x-admin.button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:bill-list-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.orders.not_found') }}</p>
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
