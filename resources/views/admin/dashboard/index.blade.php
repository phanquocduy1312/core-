@extends('admin.layouts.app')

@section('title', __('admin.dashboard'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1">{{ __('admin.dashboard') }}</h4>
            <nav class="flex text-sm text-slate-300" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">{{ __('admin.dashboard') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.dashboard') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @if(!$canViewOrders)
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden p-6 mb-6">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-primary/10 text-primary rounded-xl flex-shrink-0">
                    <iconify-icon icon="solar:shield-user-bold-duotone" class="text-2xl"></iconify-icon>
                </div>
                <div>
                    <h5 class="text-lg font-bold text-gray-900 mb-1">{{ __('admin.dashboard_page.limited_title') }}</h5>
                    <p class="text-sm text-gray-500">{{ __('admin.dashboard_page.limited_description') }}</p>
                </div>
            </div>
        </div>
    @else
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Revenue Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-semibold text-gray-500">{{ __('admin.dashboard_page.monthly_revenue') }}</span>
                <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl">
                    <iconify-icon icon="solar:dollar-minimalistic-bold-duotone" class="text-xl"></iconify-icon>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 mb-2">{{ number_format($metrics['monthly_revenue'], 0, ',', '.') }} ₫</h3>
            <div class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                <iconify-icon icon="solar:round-arrow-right-up-bold-duotone" class="text-base"></iconify-icon>
                <span>{{ __('admin.dashboard_page.today_revenue', ['amount' => number_format($metrics['today_revenue'], 0, ',', '.')]) }}</span>
            </div>
        </div>

        <!-- Pending Orders Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-semibold text-gray-500">{{ __('admin.dashboard_page.pending_orders') }}</span>
                <div class="p-2.5 bg-amber-50 text-amber-600 rounded-xl">
                    <iconify-icon icon="solar:clock-circle-bold-duotone" class="text-xl"></iconify-icon>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 mb-2">{{ number_format($metrics['pending_orders']) }}</h3>
            <div class="text-xs font-semibold text-amber-600 flex items-center gap-1">
                <iconify-icon icon="solar:bell-bing-bold-duotone" class="text-base"></iconify-icon>
                <span>{{ __('admin.dashboard_page.today_pending', ['count' => number_format($metrics['today_pending_orders'])]) }}</span>
            </div>
        </div>

        <!-- Processing Orders Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-semibold text-gray-500">{{ __('admin.dashboard_page.processing_orders') }}</span>
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl">
                    <iconify-icon icon="solar:play-circle-bold-duotone" class="text-xl"></iconify-icon>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 mb-2">{{ number_format($metrics['processing_orders_count']) }}</h3>
            <div class="text-xs font-semibold text-primary flex items-center gap-1">
                <iconify-icon icon="solar:refresh-bold-duotone" class="text-base"></iconify-icon>
                <span>{{ __('admin.dashboard_page.today_processing', ['count' => number_format($metrics['today_processing_orders'])]) }}</span>
            </div>
        </div>

        <!-- Completed Orders Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-semibold text-gray-500">{{ __('admin.dashboard_page.completed_orders') }}</span>
                <div class="p-2.5 bg-blue-55 text-blue-600 rounded-xl">
                    <iconify-icon icon="solar:clipboard-check-bold-duotone" class="text-xl"></iconify-icon>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-gray-900 mb-2">{{ number_format($metrics['completed_orders_count']) }}</h3>
            <div class="text-xs font-semibold text-blue-600 flex items-center gap-1">
                <iconify-icon icon="solar:pie-chart-bold-duotone" class="text-base"></iconify-icon>
                <span>{{ __('admin.dashboard_page.completed_rate', ['rate' => $metrics['completed_rate']]) }}</span>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Revenue Trend Chart -->
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm p-6 flex flex-col justify-between">
            <div class="mb-4">
                <h5 class="text-base font-bold text-gray-900 mb-0.5">{{ __('admin.dashboard_page.revenue_orders_chart') }}</h5>
                <p class="text-xs text-gray-500">{{ __('admin.dashboard_page.weekly_data') }}</p>
            </div>
            <div id="revenueChart" class="w-full min-h-[350px]"></div>
        </div>

        <!-- Status Breakdown Chart -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 flex flex-col justify-between">
            <div class="mb-4">
                <h5 class="text-base font-bold text-gray-900 mb-0.5">{{ __('admin.dashboard_page.order_status') }}</h5>
                <p class="text-xs text-gray-500">{{ __('admin.dashboard_page.percentage_distribution') }}</p>
            </div>
            <div id="statusChart" class="w-full min-h-[320px] flex items-center justify-center"></div>
        </div>
    </div>

    <!-- Annual & Activity Reports Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Annual Revenue Report -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h5 class="text-base font-bold text-gray-900">{{ __('admin.dashboard_page.annual_revenue_report', ['year' => $annualChart['year']]) }}</h5>
                <x-admin.badge variant="success">{{ __('admin.dashboard_page.full_year') }}</x-admin.badge>
            </div>
            <div class="p-6">
                <div id="annualRevenueChart" class="w-full min-h-[320px]"></div>
            </div>
        </div>

        <!-- Weekly Admin Activity Report -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h5 class="text-base font-bold text-gray-900">{{ __('admin.dashboard_page.weekly_activity_report') }}</h5>
                <x-admin.badge variant="info">{{ __('admin.dashboard_page.total_activities', ['total' => number_format($activityChart['total'])]) }}</x-admin.badge>
            </div>
            <div class="p-6">
                <div id="weeklyTrafficChart" class="w-full min-h-[320px]"></div>
            </div>
        </div>
    </div>

    <!-- Recent Orders and VIP Customers Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
        <!-- Recent Orders Table -->
        <div class="lg:col-span-7 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h5 class="text-base font-bold text-gray-900">{{ __('admin.dashboard_page.recent_orders') }}</h5>
                    <x-admin.button variant="secondary" size="sm" href="{{ route('admin.orders.index') }}">
                        {{ __('admin.dashboard_page.view_all') }}
                    </x-admin.button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 font-bold">{{ __('admin.dashboard_page.order_number') }}</th>
                                <th class="px-6 py-3 font-bold">{{ __('admin.dashboard_page.customer') }}</th>
                                <th class="px-6 py-3 font-bold text-right">{{ __('admin.dashboard_page.grand_total') }}</th>
                                <th class="px-6 py-3 font-bold text-center">{{ __('admin.dashboard_page.payment') }}</th>
                                <th class="px-6 py-3 font-bold text-center">{{ __('admin.dashboard_page.status') }}</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-150">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-primary">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-900">{{ $order->customer_name }}</span>
                                            <span class="text-xs text-gray-500">{{ $order->customer_phone }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-extrabold text-gray-900">
                                        {{ number_format($order->grand_total, 0, ',', '.') }} ₫
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($order->payment_status === 'paid')
                                            <x-admin.badge variant="success">{{ __('admin.orders.payment_statuses.paid') }}</x-admin.badge>
                                        @elseif($order->payment_status === 'pending')
                                            <x-admin.badge variant="warning">{{ __('admin.orders.payment_statuses.pending') }}</x-admin.badge>
                                        @else
                                            <x-admin.badge variant="danger">{{ __('admin.orders.payment_statuses.failed') }}</x-admin.badge>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($order->status === 'completed')
                                            <span class="px-2.5 py-1 text-xs font-semibold text-white bg-emerald-500 rounded-full">{{ __('admin.orders.statuses.completed') }}</span>
                                        @elseif($order->status === 'processing')
                                            <span class="px-2.5 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full">{{ __('admin.orders.statuses.processing') }}</span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="px-2.5 py-1 text-xs font-semibold text-white bg-red-500 rounded-full">{{ __('admin.orders.statuses.cancelled') }}</span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs font-semibold text-white bg-amber-500 rounded-full">{{ __('admin.orders.statuses.pending') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <x-admin.button variant="outline" size="sm" href="{{ route('admin.orders.show', $order) }}">
                                            {{ __('admin.dashboard_page.details') }}
                                        </x-admin.button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10 text-gray-400">
                                        <iconify-icon icon="solar:bill-list-broken" class="text-4xl mb-2 inline-block"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.dashboard_page.no_orders') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top VIP Customers -->
        <div class="lg:col-span-5 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h5 class="text-base font-bold text-gray-900">{{ __('admin.dashboard_page.vip_customers') }}</h5>
                    <x-admin.badge variant="warning">{{ __('admin.dashboard_page.vip_badge') }}</x-admin.badge>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 font-bold">{{ __('admin.dashboard_page.customer') }}</th>
                                <th class="px-6 py-3 font-bold text-right">{{ __('admin.dashboard_page.order_count') }}</th>
                                <th class="px-6 py-3 font-bold text-right">{{ __('admin.dashboard_page.total_spent') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-150">
                            @forelse($topCustomers as $customer)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-sm">
                                                {{ strtoupper(substr($customer->customer_name, 0, 1)) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-gray-900">{{ $customer->customer_name }}</span>
                                                <span class="text-xs text-gray-500">{{ $customer->customer_phone ?: $customer->customer_email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-gray-900">
                                        {{ number_format($customer->total_orders) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-emerald-600">
                                        {{ number_format($customer->total_spent, 0, ',', '.') }} ₫
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-10 text-gray-400">
                                        <iconify-icon icon="solar:users-group-two-rounded-broken" class="text-4xl mb-2 inline-block"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.dashboard_page.no_vip_data') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('scripts')
@if($canViewOrders)
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Revenue & Orders Trend Chart
        const revenueChartOptions = {
            chart: {
                height: 350,
                width: '100%',
                type: 'line',
                toolbar: { show: false },
                fontFamily: 'Quicksand, sans-serif',
                zoom: { enabled: false }
            },
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: [3, 3]
            },
            series: [{
                name: '{{ __('admin.dashboard_page.revenue') }}',
                type: 'area',
                data: {!! json_encode($chart['revenue']) !!}
            }, {
                name: '{{ __('admin.dashboard_page.orders') }}',
                type: 'line',
                data: {!! json_encode($chart['orders']) !!}
            }],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: [0.35, 1],
                    opacityTo: [0.05, 1],
                    stops: [0, 90, 100]
                }
            },
            colors: ['#0d6efd', '#fd7e14'],
            xaxis: {
                categories: {!! json_encode($chart['dates']) !!},
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#6c757d', fontSize: '13px', fontWeight: 600 },
                    rotate: -45,
                    rotateAlways: false,
                    hideOverlappingLabels: true
                }
            },
            yaxis: [
                {
                    seriesName: '{{ __('admin.dashboard_page.revenue') }}',
                    labels: {
                        formatter: function (value) {
                            return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
                        },
                        style: { colors: '#6c757d', fontSize: '12px', fontWeight: 600 }
                    }
                },
                {
                    seriesName: '{{ __('admin.dashboard_page.orders') }}',
                    opposite: true,
                    labels: {
                        formatter: function (value) {
                            if (value % 1 === 0) {
                                return value;
                            }
                            return '';
                        },
                        style: { colors: '#6c757d', fontSize: '12px', fontWeight: 600 }
                    }
                }
            ],
            tooltip: {
                shared: true,
                intersect: false,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Quicksand, sans-serif'
                },
                y: {
                    formatter: function (value, { seriesIndex }) {
                        if (seriesIndex === 0) {
                            return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
                        }
                        return value + ' {{ __('admin.dashboard_page.units.orders') }}';
                    }
                }
            },
            grid: {
                borderColor: 'rgba(0,0,0,0.05)',
                strokeDashArray: 4,
                yaxis: {
                    lines: { show: true }
                },
                padding: {
                    left: 20,
                    right: 20
                }
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                offsetY: 10,
                fontSize: '13px',
                fontFamily: 'Quicksand, sans-serif',
                fontWeight: 600,
                markers: {
                    radius: 12
                }
            }
        };

        const revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueChartOptions);
        revenueChart.render();

        // 2. Status Pie Chart
        const statusChartOptions = {
            chart: {
                type: 'donut',
                height: 320,
                width: '100%',
                fontFamily: 'Quicksand, sans-serif'
            },
            series: {!! json_encode($statusChart['series']) !!},
            labels: {!! json_encode($statusChart['labels']) !!},
            colors: ['#ffc107', '#0dcaf0', '#198754', '#dc3545'], // pending, processing, completed, cancelled
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: '{{ __('admin.dashboard_page.total_orders') }}',
                                fontSize: '15px',
                                fontFamily: 'Quicksand, sans-serif',
                                fontWeight: 600,
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                }
                            },
                            value: {
                                show: true,
                                fontSize: '20px',
                                fontFamily: 'Quicksand, sans-serif',
                                fontWeight: 700
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                offsetY: 0,
                fontSize: '13px',
                fontFamily: 'Quicksand, sans-serif',
                fontWeight: 600
            },
            tooltip: {
                style: {
                    fontSize: '13px',
                    fontFamily: 'Quicksand, sans-serif'
                },
                y: {
                    formatter: function (value) {
                        return value + ' {{ __('admin.dashboard_page.units.orders') }}';
                    }
                }
            }
        };

        const statusChart = new ApexCharts(document.querySelector("#statusChart"), statusChartOptions);
        statusChart.render();

        // 3. Annual Revenue Chart
        const annualRevenueChartOptions = {
            chart: {
                height: 320,
                width: '100%',
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Quicksand, sans-serif',
                zoom: { enabled: false }
            },
            colors: ['#13deb9'],
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            markers: {
                size: 5,
                colors: ['#13deb9'],
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: { size: 7 }
            },
            series: [{
                name: '{{ __('admin.dashboard_page.total_revenue') }}',
                data: {!! json_encode($annualChart['data']) !!}
            }],
            xaxis: {
                categories: [
                    '{{ __('admin.dashboard_page.months.Jan') }}',
                    '{{ __('admin.dashboard_page.months.Feb') }}',
                    '{{ __('admin.dashboard_page.months.Mar') }}',
                    '{{ __('admin.dashboard_page.months.Apr') }}',
                    '{{ __('admin.dashboard_page.months.May') }}',
                    '{{ __('admin.dashboard_page.months.Jun') }}',
                    '{{ __('admin.dashboard_page.months.Jul') }}',
                    '{{ __('admin.dashboard_page.months.Aug') }}',
                    '{{ __('admin.dashboard_page.months.Sep') }}',
                    '{{ __('admin.dashboard_page.months.Oct') }}',
                    '{{ __('admin.dashboard_page.months.Nov') }}',
                    '{{ __('admin.dashboard_page.months.Dec') }}'
                ],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#6c757d', fontSize: '13px', fontWeight: 600 }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
                    },
                    style: { colors: '#6c757d', fontSize: '12px', fontWeight: 600 }
                }
            },
            tooltip: {
                theme: 'light',
                x: { show: true },
                style: { fontSize: '13px', fontFamily: 'Quicksand, sans-serif' },
                y: {
                    formatter: function (value) {
                        return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
                    }
                }
            },
            grid: {
                borderColor: 'rgba(0,0,0,0.05)',
                strokeDashArray: 4
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'center',
                fontSize: '13px',
                fontFamily: 'Quicksand, sans-serif',
                fontWeight: 600
            }
        };

        const annualRevenueChart = new ApexCharts(document.querySelector("#annualRevenueChart"), annualRevenueChartOptions);
        annualRevenueChart.render();

        // 4. Weekly Admin Activity Chart
        const weeklyActivityChartOptions = {
            chart: {
                height: 320,
                width: '100%',
                type: 'area',
                toolbar: { show: false },
                fontFamily: 'Quicksand, sans-serif',
                zoom: { enabled: false }
            },
            colors: ['#539bff'],
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            markers: {
                size: 5,
                colors: ['#539bff'],
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: { size: 7 }
            },
            series: [{
                name: '{{ __('admin.dashboard_page.total_activities_label') }}',
                data: {!! json_encode($activityChart['data']) !!}
            }],
            xaxis: {
                categories: {!! json_encode($activityChart['dates']) !!},
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#6c757d', fontSize: '13px', fontWeight: 600 }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value;
                    },
                    style: { colors: '#6c757d', fontSize: '12px', fontWeight: 600 }
                }
            },
            tooltip: {
                theme: 'light',
                style: { fontSize: '13px', fontFamily: 'Quicksand, sans-serif' },
                y: {
                    formatter: function (value) {
                        return value + ' {{ __('admin.dashboard_page.units.activities') }}';
                    }
                }
            },
            grid: {
                borderColor: 'rgba(0,0,0,0.05)',
                strokeDashArray: 4
            }
        };

        const weeklyActivityChart = new ApexCharts(document.querySelector("#weeklyTrafficChart"), weeklyActivityChartOptions);
        weeklyActivityChart.render();
    });
</script>
@endif
@endpush
