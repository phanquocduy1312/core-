@extends('admin.layouts.app')

@section('title', __('Quản lý Đăng ký nhận Bản tin (eNewsletter)'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white flex items-center gap-2">
                    <iconify-icon icon="solar:mailbox-bold-duotone" class="text-2xl text-blue-400"></iconify-icon>
                    <span>{{ __('Quản lý Đăng ký nhận Bản tin (eNewsletter)') }}</span>
                </h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('Đăng ký bản tin') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.newsletter-subscribers.export', request()->query()) }}" class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors shadow-xs">
                    <iconify-icon icon="solar:export-bold" class="text-base text-emerald-600"></iconify-icon>
                    <span>Xuất file CSV</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Success / Error Alert -->
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:check-circle-bold" class="text-lg"></iconify-icon>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="text-emerald-500 hover:text-emerald-700" onclick="this.parentElement.remove()">
                <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
            </button>
        </div>
    @endif

    <!-- Marketing Metrics KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <iconify-icon icon="solar:users-group-two-rounded-bold" class="text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tổng người đăng ký</div>
                <div class="text-2xl font-bold text-gray-900 mt-0.5">{{ number_format($metrics['total']) }}</div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <iconify-icon icon="solar:user-check-bold" class="text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Đang theo dõi</div>
                <div class="text-2xl font-bold text-emerald-600 mt-0.5">{{ number_format($metrics['active']) }}</div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <iconify-icon icon="solar:calendar-date-bold" class="text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Mới tháng này</div>
                <div class="text-2xl font-bold text-indigo-600 mt-0.5">{{ number_format($metrics['new_this_month']) }}</div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-gray-100 text-gray-500 flex items-center justify-center shrink-0">
                <iconify-icon icon="solar:user-cross-bold" class="text-2xl"></iconify-icon>
            </div>
            <div>
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Đã hủy theo dõi</div>
                <div class="text-2xl font-bold text-gray-600 mt-0.5">{{ number_format($metrics['unsubscribed']) }}</div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <input type="hidden" name="per_page" value="{{ $perPage }}">
            <div class="col-span-12 md:col-span-5">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tìm kiếm</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="Email, họ tên người đăng ký, công ty...">
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Trạng thái theo dõi</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">-- Tất cả trạng thái --</option>
                    <option value="1" @selected(request('status') === '1')>Đang theo dõi (Active)</option>
                    <option value="0" @selected(request('status') === '0')>Đã hủy theo dõi (Unsubscribed)</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kênh tiếp cận (Where do you know us?)</label>
                <select name="referral" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">-- Tất cả kênh --</option>
                    @foreach($referrals as $ref)
                        <option value="{{ $ref }}" @selected(request('referral') === $ref)>{{ $ref }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-1 flex gap-2">
                <button type="submit" class="w-full h-[42px] px-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 flex items-center justify-center transition-colors shadow-xs" title="Tìm kiếm">
                    <iconify-icon icon="solar:magnifer-linear" class="text-lg"></iconify-icon>
                </button>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <!-- Bulk Actions Bar -->
            <form id="bulk-subscribers-form" action="{{ route('admin.newsletter-subscribers.bulk') }}" method="POST" class="p-3.5 bg-gray-50 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3 text-sm">
                @csrf
                @method('PATCH')
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold text-gray-500 uppercase">Thao tác chọn (<span id="selected-sub-count">0</span>):</span>
                    <select name="action" class="text-xs bg-white border border-gray-300 rounded-lg p-1.5 focus:ring-primary focus:border-primary" required>
                        <option value="">-- Chọn thao tác --</option>
                        <option value="activate">Kích hoạt theo dõi</option>
                        <option value="deactivate">Hủy theo dõi</option>
                        <option value="delete">Xóa người đăng ký đã chọn</option>
                    </select>
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn thực hiện thao tác này?')" class="px-3 py-1.5 text-xs font-semibold bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-colors">
                        Áp dụng
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-5 py-3 w-10 text-center">
                                <input type="checkbox" id="check-all-sub" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer">
                            </th>
                            <th class="px-5 py-3 font-bold text-gray-700">Email</th>
                            <th class="px-5 py-3 font-bold text-gray-700">Người đăng ký / Công ty</th>
                            <th class="px-5 py-3 font-bold text-gray-700">Kênh tiếp cận</th>
                            <th class="px-5 py-3 font-bold text-gray-700 text-center">Trạng thái</th>
                            <th class="px-5 py-3 font-bold text-gray-700 text-center">Ngày đăng ký</th>
                            <th class="px-5 py-3 font-bold text-gray-700 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($subscribers as $sub)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-5 py-4 text-center">
                                    <input type="checkbox" name="ids[]" form="bulk-subscribers-form" value="{{ $sub->id }}" class="item-sub-checkbox w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer">
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-mono font-bold text-gray-900 text-sm flex items-center gap-1.5">
                                        <a href="mailto:{{ $sub->email }}" class="hover:text-primary transition-colors">
                                            {{ $sub->email }}
                                        </a>
                                    </div>
                                    @if($sub->ip_address)
                                        <div class="text-[11px] text-gray-400 mt-0.5 font-mono">IP: {{ $sub->ip_address }}</div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-gray-900 text-sm">
                                        {{ $sub->full_name }}
                                    </div>
                                    @if($sub->company)
                                        <div class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                            <iconify-icon icon="solar:buildings-line-duotone" class="text-xs"></iconify-icon>
                                            <span>{{ $sub->company }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if($sub->referral)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                                            {{ $sub->referral }}
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Chưa xác định</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <form action="{{ route('admin.newsletter-subscribers.toggle-status', $sub) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="Click để thay đổi trạng thái" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold border transition-transform hover:scale-105 {{ $sub->is_active ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-gray-100 text-gray-600 border-gray-200' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $sub->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                            <span>{{ $sub->is_active ? 'Đang theo dõi' : 'Đã hủy theo dõi' }}</span>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-5 py-4 text-center text-xs text-gray-500 whitespace-nowrap">
                                    <div>{{ $sub->subscribed_at ? $sub->subscribed_at->format('d/m/Y') : $sub->created_at?->format('d/m/Y') }}</div>
                                    <div class="text-[11px] text-gray-400">{{ $sub->subscribed_at ? $sub->subscribed_at->format('H:i') : $sub->created_at?->format('H:i') }}</div>
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <form action="{{ route('admin.newsletter-subscribers.destroy', $sub) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa email đăng ký này?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Xóa">
                                                <iconify-icon icon="solar:trash-bin-trash-linear" class="text-lg"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                    <iconify-icon icon="solar:mailbox-linear" class="text-4xl mb-2 text-gray-300"></iconify-icon>
                                    <p class="text-sm">Chưa có người đăng ký nhận bản tin nào phù hợp với bộ lọc.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($subscribers->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $subscribers->links() }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkAll = document.getElementById('check-all-sub');
            const checkboxes = document.querySelectorAll('.item-sub-checkbox');
            const countDisplay = document.getElementById('selected-sub-count');

            function updateCount() {
                const checkedCount = document.querySelectorAll('.item-sub-checkbox:checked').length;
                if (countDisplay) countDisplay.textContent = checkedCount;
            }

            if (checkAll) {
                checkAll.addEventListener('change', function () {
                    checkboxes.forEach(cb => cb.checked = checkAll.checked);
                    updateCount();
                });
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', function () {
                    updateCount();
                    if (!this.checked && checkAll) checkAll.checked = false;
                });
            });
        });
    </script>
@endsection
