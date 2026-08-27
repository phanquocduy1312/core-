@extends('admin.layouts.app')

@section('title', 'Nhật ký hoạt động')

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">Nhật ký hoạt động</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">Nhật ký hoạt động</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-3 items-end">
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Người thực hiện</label>
                <select name="user_id" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">Tất cả người thực hiện</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>{{ $user->name }} — {{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Thao tác</label>
                <select name="action" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">Tất cả thao tác</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}" @selected(request('action') === $action)>{{ \App\Models\AdminActivityLog::actionLabelFor($action) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Đối tượng</label>
                <select name="subject_type" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">Tất cả đối tượng</option>
                    @foreach($subjectTypes as $type)
                        <option value="{{ $type }}" @selected(request('subject_type') === $type)>{{ \App\Models\AdminActivityLog::subjectLabelFor($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Từ ngày</label>
                <input type="date" name="from" value="{{ request('from') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Đến ngày</label>
                <input type="date" name="to" value="{{ request('to') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
            </div>
            <div class="col-span-12 md:col-span-1">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center">
                    <span>Lọc</span>
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 min-w-[1100px]">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">Thời gian</th>
                            <th class="px-6 py-3 font-bold">Người thực hiện</th>
                            <th class="px-6 py-3 font-bold">Thao tác</th>
                            <th class="px-6 py-3 font-bold">Đối tượng</th>
                            <th class="px-6 py-3 font-bold" style="min-width: 280px;">Mô tả</th>
                            <th class="px-6 py-3 font-bold" style="min-width: 250px;">Thay đổi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    {{ $log->created_at?->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">
                                    {{ $log->user?->name ?? 'Hệ thống' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.badge variant="primary">{{ $log->displayActionLabel() }}</x-admin.badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-750">
                                    {{ $log->displaySubjectLabel() }}@if($log->subject_id) <span class="text-gray-400">#{{ $log->subject_id }}</span>@endif
                                </td>
                                <td class="px-6 py-4 text-gray-705">
                                    {{ $log->displayDescription() }}
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    @forelse($log->displayChanges() as $label => $value)
                                        <div class="mb-1"><span class="font-semibold text-gray-450">{{ $label }}:</span> <span class="text-gray-900">{{ $value }}</span></div>
                                    @empty
                                        <span class="text-gray-400">{{ __('catalog.common.none') }}</span>
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:history-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">Chưa có hoạt động nào.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($logs->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
