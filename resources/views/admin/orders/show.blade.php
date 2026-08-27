@extends('admin.layouts.app')

@section('title', __('admin.orders.order_details') . ' ' . $order->order_number)

@push('styles')
<style>
    @media print {
        /* Hide everything except the order sheet */
        header, .sidebar-link, .preloader, #main-wrapper > aside, .page-wrapper > header,
        .print-btn-header, footer, .dark-transparent, .status-card {
            display: none !important;
        }
        
        body, #main-wrapper, .page-wrapper, .body-wrapper, .container-fluid {
            margin: 0 !important;
            padding: 0 !important;
            min-height: auto !important;
            background: #ffffff !important;
        }
        
        .card {
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        
        .order-print-area {
            border: none !important;
            padding: 0 !important;
            box-shadow: none !important;
            margin: 0 !important;
        }
    }
</style>
@endpush

@section('content')
    <!-- Print & Navigation Header (hidden when printing) -->
    <div class="flex items-center justify-between mb-6 print-btn-header">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-4 py-2 text-sm gap-2">
            <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
            {{ __('catalog.actions.back') }}
        </a>
        <div class="flex gap-2">
            <button onclick="window.print();" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white px-4 py-2 text-sm gap-2">
                <iconify-icon icon="solar:printer-linear" class="text-base"></iconify-icon>
                {{ __('admin.invoices.print') }}
            </button>
        </div>
    </div>

    <!-- Success Notification -->
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-250 flex items-center justify-between print-btn-header" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:check-circle-bold" class="text-lg"></iconify-icon>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="text-emerald-500 hover:text-emerald-700" onclick="this.parentElement.remove()">
                <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
            </button>
        </div>
    @endif

    <!-- Update Status Card (hidden when printing) -->
    <div class="bg-white border border-red-100 rounded-xl shadow-sm p-6 mb-6 status-card">
        <h5 class="font-bold text-primary flex items-center gap-2 mb-4">
            <iconify-icon icon="solar:pen-linear" class="text-lg"></iconify-icon>
            {{ __('admin.orders.update_status') }}
        </h5>
        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            @csrf
            @method('PATCH')
            <div class="col-span-12 md:col-span-4">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.orders.fields.status') }}</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="pending" @selected($order->status === 'pending')>{{ __('admin.orders.statuses.pending') }}</option>
                    <option value="processing" @selected($order->status === 'processing')>{{ __('admin.orders.statuses.processing') }}</option>
                    <option value="completed" @selected($order->status === 'completed')>{{ __('admin.orders.statuses.completed') }}</option>
                    <option value="cancelled" @selected($order->status === 'cancelled')>{{ __('admin.orders.statuses.cancelled') }}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.orders.fields.payment_status') }}</label>
                <select name="payment_status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="pending" @selected($order->payment_status === 'pending')>{{ __('admin.orders.payment_statuses.pending') }}</option>
                    <option value="paid" @selected($order->payment_status === 'paid')>{{ __('admin.orders.payment_statuses.paid') }}</option>
                    <option value="failed" @selected($order->payment_status === 'failed')>{{ __('admin.orders.payment_statuses.failed') }}</option>
                    <option value="partially_refunded" @selected($order->payment_status === 'partially_refunded')>Hoàn tiền một phần</option>
                    <option value="refunded" @selected($order->payment_status === 'refunded')>Đã hoàn tiền</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ghi chú nội bộ</label>
                <input name="note" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" maxlength="1000" placeholder="Lý do đổi trạng thái...">
            </div>
            <div class="col-span-12 md:col-span-2">
                <button type="submit" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white py-2.5 text-sm">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>

    <!-- Refund and History Grid (hidden when printing) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6 status-card">
        <!-- Refund Card -->
        <div class="lg:col-span-7 bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h5 class="font-bold text-gray-900 mb-4 flex items-center gap-1.5">
                <iconify-icon icon="solar:card-recive-linear" class="text-xl text-gray-400"></iconify-icon>
                Hoàn tiền đơn hàng
            </h5>
            <div class="space-y-4">
                <div class="divide-y divide-gray-150">
                    @forelse($order->refunds as $refund)
                        <div class="py-2.5 first:pt-0 last:pb-0 text-sm">
                            <div class="flex items-center justify-between font-bold text-gray-900">
                                <span>{{ number_format($refund->amount, 0, ',', '.') }} ₫</span>
                                <span class="text-xs font-normal text-gray-400">{{ $refund->created_at?->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                Loại: <span class="font-semibold text-gray-700">{{ $refund->type === 'full' ? 'Toàn phần' : 'Một phần' }}</span>
                                @if($refund->reason)
                                    | Lý do: <span class="italic text-gray-650">{{ $refund->reason }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400">Chưa có khoản hoàn tiền.</p>
                    @endforelse
                </div>

                @if($order->payment_status !== 'refunded')
                    <form action="{{ route('admin.orders.refund', $order) }}" method="POST" id="refund-form" class="border-t border-gray-200 pt-4 space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                            <div class="md:col-span-4">
                                <select class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:outline-none" name="type" id="refund-type">
                                    <option value="partial">Hoàn một phần</option>
                                    <option value="full">Hoàn toàn phần</option>
                                </select>
                            </div>
                            <div class="md:col-span-8">
                                <input class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:outline-none" name="reason" maxlength="1000" placeholder="Lý do hoàn tiền...">
                            </div>
                        </div>
                        
                        <div id="refund-items" class="space-y-2 border border-gray-150 rounded-xl p-3 bg-gray-50/50">
                            @foreach($order->items as $item)
                                <div class="flex items-center justify-between gap-3 text-xs">
                                    <div class="flex items-center gap-2">
                                        <input class="w-4 h-4 text-primary bg-white border-gray-300 rounded focus:ring-primary cursor-pointer refund-check" type="checkbox">
                                        <span class="font-semibold text-gray-800">{{ $item->product_name }}{{ $item->variant_name ? ' — '.$item->variant_name : '' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input type="hidden" disabled name="items[{{ $item->id }}][order_item_id]" value="{{ $item->id }}">
                                        <input type="number" disabled class="block w-16 p-1 text-center text-xs text-gray-900 bg-white border border-gray-300 rounded focus:outline-none refund-qty" min="1" max="{{ $item->quantity }}" name="items[{{ $item->id }}][quantity]" value="1">
                                        <span class="text-gray-400">/ {{ $item->quantity }} cái</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-red-200 text-red-650 hover:bg-red-50 py-1.5 px-3 text-xs">
                            Ghi nhận hoàn tiền
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- History Card -->
        <div class="lg:col-span-5 bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h5 class="font-bold text-gray-900 mb-4 flex items-center gap-1.5">
                <iconify-icon icon="solar:history-linear" class="text-xl text-gray-400"></iconify-icon>
                Lịch sử đơn hàng
            </h5>
            <div class="relative border-l border-gray-200 pl-4 space-y-4 max-h-[320px] overflow-y-auto pr-2">
                @forelse($order->historyEntries as $entry)
                    <div class="relative">
                        <span class="absolute -left-[21px] top-1.5 flex h-2 w-2 items-center justify-center rounded-full bg-primary ring-4 ring-white"></span>
                        <div class="text-xs font-bold text-gray-900">{{ $entry->to_status }} / {{ $entry->to_payment_status }}</div>
                        <div class="text-2xs text-gray-400 mt-0.5">{{ $entry->created_at?->format('d/m/Y H:i') }} · {{ $entry->changedBy?->name ?? 'Hệ thống' }}</div>
                        @if($entry->note)
                            <div class="text-xs text-gray-600 mt-1 bg-gray-50 p-2 rounded-lg border border-gray-150">{{ $entry->note }}</div>
                        @endif
                    </div>
                @empty
                    <p class="text-xs text-gray-400">Chưa có lịch sử thay đổi.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Order Sheet (Invoice layout) -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden order-print-area mb-8">
        <div class="p-6 md:p-10">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between gap-6 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <img src="{{ $siteBranding['admin_logo_url'] }}" alt="MatBaoWS" class="h-9 w-auto max-w-[160px] object-contain">
                    </div>
                    @if(filled(data_get($siteBranding, 'contact.address')))
                        <p class="text-sm text-gray-500">Địa chỉ: {{ data_get($siteBranding, 'contact.address') }}</p>
                    @endif
                    @if(filled(data_get($siteBranding, 'contact.email')))
                        <p class="text-sm text-gray-500 mt-0.5">Email liên hệ: {{ data_get($siteBranding, 'contact.email') }}</p>
                    @endif
                </div>
                <div class="md:text-right">
                    <h1 class="text-2xl font-black text-primary mb-3">{{ __('admin.orders.order_details') }}</h1>
                    <p class="text-sm text-gray-800"><strong class="font-semibold text-gray-900">{{ __('admin.orders.fields.order_number') }}:</strong> {{ $order->order_number }}</p>
                    <p class="text-sm text-gray-800 mt-1"><strong class="font-semibold text-gray-900">{{ __('admin.orders.fields.order_date') }}:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
                    <p class="text-sm text-gray-800 mt-1"><strong class="font-semibold text-gray-900">{{ __('admin.orders.payment_method') }}:</strong> 
                        @if($order->payment_method === 'cod')
                            {{ __('admin.orders.cod') }}
                        @elseif($order->payment_method === 'bank_transfer')
                            {{ __('admin.invoices.bank_transfer') }}
                        @else
                            {{ __('admin.orders.online_payment') }}
                        @endif
                    </p>
                </div>
            </div>

            <hr class="border-gray-200 my-6">

            <!-- Customer & Stamp Section -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-8">
                <div class="md:col-span-7">
                    <h6 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2.5">{{ __('admin.orders.customer_info') }}</h6>
                    <h5 class="text-base font-bold text-primary mb-2">{{ $order->customer_name }}</h5>
                    <p class="text-sm text-gray-600"><strong>{{ __('admin.orders.fields.phone') }}:</strong> {{ $order->customer_phone }}</p>
                    <p class="text-sm text-gray-600 mt-0.5"><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p class="text-sm text-gray-600 mt-0.5"><strong>{{ __('admin.orders.fields.shipping_address') }}:</strong> {{ $order->shipping_address }}</p>

                    <h6 class="text-xs font-bold text-gray-400 uppercase tracking-wider mt-5 mb-2.5">{{ __('admin.orders.carrier_info') }}</h6>
                    @php
                        $shipVariant = match ($order->shipping_status ?: 'not_shipped') {
                            'shipping_pending', 'shipping_created', 'waiting_pickup', 'picked_up', 'in_transit' => 'info',
                            'delivered' => 'success',
                            'delayed' => 'warning',
                            'pickup_failed', 'delivery_failed', 'cancelled' => 'danger',
                            default => 'secondary',
                        };
                    @endphp
                    <p class="text-sm text-gray-800 flex items-center gap-2">
                        <strong>{{ __('admin.orders.fields.shipping_status') }}:</strong>
                        <x-admin.badge :variant="$shipVariant">{{ $order->shippingStatusLabel() }}</x-admin.badge>
                    </p>
                    
                    @if($order->tracking_number)
                        <div class="mt-2 space-y-1 text-sm text-gray-800">
                            <p><strong>{{ __('admin.orders.carrier') }}:</strong> <x-admin.badge variant="secondary">{{ strtoupper($order->shipping_carrier) }}</x-admin.badge></p>
                            <p><strong>{{ __('admin.orders.tracking_number') }}:</strong> <span class="font-mono text-primary font-bold">{{ $order->tracking_number }}</span></p>
                            <p><strong>{{ __('admin.orders.fields.actual_shipping_fee') }}:</strong> <span class="text-red-650 font-bold">{{ number_format($order->shipping_fee, 0, ',', '.') }} ₫</span></p>
                        </div>
                    @else
                        <p class="text-sm text-gray-400 mt-2">{{ __('admin.orders.not_shipped') }}</p>
                        @if($order->status !== 'cancelled' && $isGhtkEnabled)
                            <button type="button" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white px-3 py-1.5 text-xs gap-1.5 mt-2.5 print-btn-header" data-bs-toggle="modal" data-bs-target="#pushShippingModal">
                                <iconify-icon icon="solar:delivery-linear" class="text-base"></iconify-icon>
                                {{ __('admin.orders.create_ghtk') }}
                            </button>
                        @endif
                    @endif
                </div>
                <div class="md:col-span-5 flex justify-start md:justify-end items-center">
                    <div>
                        <h6 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 text-left md:text-right">{{ __('admin.orders.fields.status') }}</h6>
                        <div class="mt-1">
                            @if($order->status === 'completed')
                                <div class="inline-block border-[3px] px-5 py-2 font-extrabold uppercase text-lg rounded-md opacity-85 -rotate-6 transform border-emerald-500 text-emerald-500">
                                    {{ __('admin.orders.statuses.completed') }}
                                </div>
                            @elseif($order->status === 'processing')
                                <div class="inline-block border-[3px] px-5 py-2 font-extrabold uppercase text-lg rounded-md opacity-85 -rotate-6 transform border-cyan-500 text-cyan-500">
                                    {{ __('admin.orders.statuses.processing') }}
                                </div>
                            @elseif($order->status === 'cancelled')
                                <div class="inline-block border-[3px] px-5 py-2 font-extrabold uppercase text-lg rounded-md opacity-85 -rotate-6 transform border-red-500 text-red-500">
                                    {{ __('admin.orders.statuses.cancelled') }}
                                </div>
                            @else
                                <div class="inline-block border-[3px] px-5 py-2 font-extrabold uppercase text-lg rounded-md opacity-85 -rotate-6 transform border-amber-500 text-amber-500">
                                    {{ __('admin.orders.statuses.pending') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="border border-gray-200 rounded-xl overflow-hidden mb-6">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.orders.item') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.sku') }}</th>
                            <th class="px-6 py-3 font-bold text-right">{{ __('admin.orders.price') }}</th>
                            <th class="px-6 py-3 font-bold text-center">{{ __('admin.orders.quantity') }}</th>
                            <th class="px-6 py-3 font-bold text-right">{{ __('admin.orders.subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @foreach($order->items as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $item->product_name }}</div>
                                    @if($item->variant_name)
                                        <div class="mt-1"><x-admin.badge variant="secondary">{{ $item->variant_name }}</x-admin.badge></div>
                                    @endif
                                    @if($item->promotion_name)
                                        <div class="mt-1"><x-admin.badge variant="danger">{{ $item->promotion_name }}</x-admin.badge></div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-650">
                                    {{ $item->sku ?: '-' }}
                                </td>
                                <td class="px-6 py-4 text-right font-semibold text-gray-900">
                                    @if($item->original_price !== null && (float) $item->original_price > (float) $item->price)
                                        <div class="text-xs text-gray-400 line-through mb-0.5">{{ number_format($item->original_price, 0, ',', '.') }} ₫</div>
                                    @endif
                                    {{ number_format($item->price, 0, ',', '.') }} ₫
                                </td>
                                <td class="px-6 py-4 text-center font-semibold text-gray-900">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-primary">
                                    {{ number_format($item->total, 0, ',', '.') }} ₫
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Grand Total Block -->
            <div class="flex justify-end mb-6">
                <div class="w-full md:w-80 space-y-2.5 text-sm">
                    <div class="flex justify-between pb-2 border-b border-gray-150">
                        <span class="text-gray-500">{{ __('admin.orders.subtotal') }}:</span>
                        <span class="font-semibold text-gray-900">{{ number_format($order->subtotal, 0, ',', '.') }} ₫</span>
                    </div>
                    @if((float) $order->promotion_discount > 0)
                        <div class="flex justify-between pb-2 border-b border-gray-150">
                            <span class="text-gray-500">Khuyến mãi / Flash Sale:</span>
                            <span class="font-semibold text-red-650">-{{ number_format($order->promotion_discount, 0, ',', '.') }} ₫</span>
                        </div>
                    @endif
                    @if((float) $order->discount - (float) $order->promotion_discount > 0)
                        <div class="flex justify-between pb-2 border-b border-gray-150">
                            <span class="text-gray-500">Mã giảm giá / giảm thêm:</span>
                            <span class="font-semibold text-red-650">-{{ number_format((float) $order->discount - (float) $order->promotion_discount, 0, ',', '.') }} ₫</span>
                        </div>
                    @endif
                    <div class="flex justify-between pb-2 border-b border-gray-150">
                        <span class="text-gray-500">Phí giao hàng:</span>
                        <span class="font-semibold text-gray-900">{{ number_format($order->shipping_fee, 0, ',', '.') }} ₫</span>
                    </div>
                    <div class="flex justify-between pt-1">
                        <span class="font-bold text-gray-900 text-base">{{ __('admin.orders.grand_total') }}:</span>
                        <span class="font-black text-primary text-lg">{{ number_format($order->grand_total, 0, ',', '.') }} ₫</span>
                    </div>
                </div>
            </div>

            <!-- Note section -->
            @if($order->notes)
                <div class="p-4 bg-gray-50 border border-gray-150 rounded-xl mb-6">
                    <p class="text-sm text-gray-700"><strong>{{ __('admin.orders.customer_notes') }}:</strong> {{ $order->notes }}</p>
                </div>
            @endif

            <hr class="border-gray-200 my-6">

            <!-- Footer Details -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-400">
                <div>
                    {{ __('admin.orders.current_payment_status') }} <strong>
                        @if($order->payment_status === 'paid')
                            {{ __('admin.orders.payment_statuses.paid') }}
                        @elseif($order->payment_status === 'pending')
                            {{ __('admin.orders.payment_statuses.pending') }}
                        @elseif($order->payment_status === 'partially_refunded')
                            Hoàn tiền một phần
                        @elseif($order->payment_status === 'refunded')
                            Đã hoàn tiền
                        @else
                            {{ __('admin.orders.payment_statuses.failed') }}
                        @endif
                    </strong>
                </div>
                <div>
                    {{ __('admin.orders.thank_you') }}
                </div>
            </div>
        </div>
    </div>

    @if($isGhtkEnabled && !$order->tracking_number)
    <!-- Push Shipping Modal -->
    <div class="modal fade" id="pushShippingModal" tabindex="-1" aria-labelledby="pushShippingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content overflow-hidden rounded-xl border border-gray-200 shadow-xl">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50/50">
                    <h5 class="modal-title font-bold text-gray-900" id="pushShippingModalLabel">
                        {{ __('admin.orders.create_ghtk') }}
                    </h5>
                    <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none" data-bs-dismiss="modal">
                        <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
                    </button>
                </div>
                <form id="pushShippingForm" action="{{ route('admin.orders.push-shipping', $order) }}" method="POST">
                    @csrf
                    <input type="hidden" name="carrier" value="ghtk">
                    <div class="p-6 space-y-4 text-left">
                        <div>
                            <label class="block mb-1.5 text-xs font-semibold text-gray-700">{{ __('admin.orders.fields.shipping_address') }}</label>
                            <input type="text" class="block w-full p-2.5 text-sm text-gray-600 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none" value="{{ $order->shipping_address }}" readonly>
                        </div>
                        
                        <!-- Address details for shipping parsing -->
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-750" for="shipping_province">{{ __('admin.orders.fields.province') }} <span class="text-red-500">*</span></label>
                                <input type="text" class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" id="shipping_province" name="province" value="Hồ Chí Minh" required>
                            </div>
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-750" for="shipping_district">{{ __('admin.orders.fields.district') }} <span class="text-red-500">*</span></label>
                                <input type="text" class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" id="shipping_district" name="district" value="Quận 1" required>
                            </div>
                            <div>
                                <label class="block mb-1.5 text-xs font-semibold text-gray-750" for="shipping_ward">{{ __('admin.orders.fields.ward') }} <span class="text-red-500">*</span></label>
                                <input type="text" class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" id="shipping_ward" name="ward" value="Phường Bến Nghé" required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1.5 text-xs font-semibold text-gray-750" for="shipping_weight">{{ __('admin.orders.fields.weight') }} <span class="text-red-500">*</span></label>
                            <input type="number" class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" id="shipping_weight" name="weight" value="500" min="1" required>
                            <p class="text-2xs text-gray-400 mt-1">{{ __('admin.orders.weight_help') }}</p>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50 flex justify-end gap-3">
                        <button type="button" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-4 py-2 text-sm" data-bs-dismiss="modal">
                            {{ __('catalog.actions.cancel') }}
                        </button>
                        <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white px-4 py-2 text-sm">
                            {{ __('admin.orders.confirm_push') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Push Shipping Form AJAX handling
            const pushShippingForm = document.getElementById('pushShippingForm');
            if (pushShippingForm) {
                pushShippingForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    
                    if (typeof Swal === 'undefined') {
                        this.submit();
                        return;
                    }

                    Swal.fire({
                        title: "{{ __('admin.orders.ghtk_connecting') }}",
                        text: "{{ __('admin.orders.please_wait') }}",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const formData = new FormData(pushShippingForm);

                    fetch(pushShippingForm.action, {
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
                                title: "{{ __('admin.orders.ghtk_success') }}",
                                text: data.message || 'Đơn hàng đã được đẩy sang GHTK.',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "{{ __('admin.orders.ghtk_failed') }}",
                                text: data.message || 'Có lỗi xảy ra.'
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

            const refundType = document.getElementById('refund-type');
            const refundItems = document.getElementById('refund-items');
            const syncRefundInputs = () => {
                const isPartial = refundType && refundType.value === 'partial';
                if (refundItems) {
                    refundItems.classList.toggle('hidden', !isPartial);
                    refundItems.querySelectorAll('.refund-check').forEach(check => {
                        const row = check.closest('div');
                        const enabled = isPartial && check.checked;
                        row.querySelectorAll('input[type="hidden"], .refund-qty').forEach(input => input.disabled = !enabled);
                    });
                }
            };
            if (refundType) {
                refundType.addEventListener('change', syncRefundInputs);
                refundItems.querySelectorAll('.refund-check').forEach(check => check.addEventListener('change', syncRefundInputs));
                syncRefundInputs();
            }
        });
    </script>
@endpush
