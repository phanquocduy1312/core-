@extends('admin.layouts.app')

@section('title', __('admin.customers.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.customers.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.customers.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-semibold bg-primary/10 text-primary border border-primary/20">
                    {{ trans_choice('admin.customers.total', $customers->total(), ['count' => number_format($customers->total())]) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="flex flex-wrap items-center gap-3">
            <div class="flex-1 min-w-[280px]">
                <input type="search" name="q" value="{{ request('q') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" placeholder="{{ __('admin.customers.search_placeholder') }}">
            </div>
            <div class="flex items-center gap-2">
                <x-admin.button type="submit" variant="primary" size="md" class="flex items-center gap-1.5">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon>
                    <span>{{ __('admin.customers.search') }}</span>
                </x-admin.button>
                @if(request()->filled('q'))
                    <x-admin.button variant="outline" size="md" href="{{ route('admin.customers.index') }}">
                        {{ __('admin.customers.clear') }}
                    </x-admin.button>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.customers.customer') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.customers.account') }}</th>
                            <th class="px-6 py-3 font-bold text-right">{{ __('admin.customers.orders') }}</th>
                            <th class="px-6 py-3 font-bold text-right">{{ __('admin.customers.completed_orders') }}</th>
                            <th class="px-6 py-3 font-bold text-right">{{ __('admin.customers.total_spent') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.customers.last_order') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($customers as $customer)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $customer->customer_name }}</div>
                                    <div class="text-xs text-gray-405 mt-0.5">{{ $customer->customer_email }} · {{ $customer->customer_phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($customer->registered_user_id)
                                        <x-admin.badge variant="success">{{ __('admin.customers.registered') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="secondary">{{ __('admin.customers.guest') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-semibold text-gray-800">
                                    {{ number_format($customer->total_orders) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-gray-700">
                                    {{ number_format($customer->completed_orders) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-emerald-650">
                                    {{ number_format($customer->total_spent, 0, ',', '.') }} ₫
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-650 text-xs">
                                    {{ \Carbon\Carbon::parse($customer->last_order_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <x-admin.button variant="outline" size="xs" href="{{ route('admin.customers.show', ['email' => $customer->customer_email]) }}">
                                        {{ __('admin.customers.details') }}
                                    </x-admin.button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:users-group-two-rounded-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.customers.empty') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($customers->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
