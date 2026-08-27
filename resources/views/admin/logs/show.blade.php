@extends('admin.layouts.app')

@section('title', 'Nhật ký hệ thống — '.$file)

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">
                    <code class="text-white bg-slate-800/80 px-2 py-0.5 rounded text-sm">{{ $file }}</code>
                </h4>
            </div>
            <div>
                <x-admin.button variant="secondary" size="sm" href="{{ route('admin.logs.index', ['locale' => app()->getLocale()]) }}" class="flex items-center gap-1">
                    <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
                    <span>Danh sách tệp</span>
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-3 items-end">
            <div class="col-span-12 md:col-span-3">
                <input type="text" name="q" value="{{ $filters['keyword'] }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" placeholder="Từ khoá...">
            </div>
            <div class="col-span-12 md:col-span-3">
                <input type="text" name="request_id" value="{{ $filters['requestId'] }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" placeholder="Request ID">
            </div>
            <div class="col-span-12 md:col-span-2">
                <input type="text" name="status" value="{{ $filters['status'] }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" placeholder="Status (vd: 500)">
            </div>
            <div class="col-span-12 md:col-span-2">
                <input type="text" name="user_id" value="{{ $filters['userId'] }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" placeholder="User ID">
            </div>
            <div class="col-span-12 md:col-span-2">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center">
                    <span>Lọc</span>
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Log Console Card -->
    <div class="bg-slate-950 text-slate-100 rounded-xl shadow-lg border border-slate-800 overflow-hidden flex flex-col justify-between mb-8">
        <div class="px-5 py-3 border-b border-slate-900 bg-slate-900/50 flex items-center gap-1.5 text-xs text-slate-400">
            <span class="w-3 h-3 rounded-full bg-red-500"></span>
            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
            <span class="w-3 h-3 rounded-full bg-green-500"></span>
            <span class="ml-2 font-mono">log_viewer.sh</span>
        </div>
        <div class="p-6 font-mono text-xs overflow-auto max-h-[70vh] divide-y divide-slate-900/40 whitespace-pre-wrap break-all leading-relaxed">
            @forelse($lines as $line)
                <div class="py-1 border-b border-slate-900/30">{{ $line }}</div>
            @empty
                <div class="text-slate-500 italic">Không có dòng log nào khớp bộ lọc.</div>
            @endforelse
        </div>
    </div>
@endsection
