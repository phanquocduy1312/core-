@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa trang')

@section('content')
    <form method="POST" action="{{ route('admin.pages.update', $page) }}" id="page-builder-form" class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin.pages._form')
    </form>

    @if($revisions->isNotEmpty())
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mt-6 max-w-4xl">
            <h5 class="font-bold text-gray-900 mb-4 flex items-center gap-1.5">
                <iconify-icon icon="solar:history-linear" class="text-xl text-gray-500"></iconify-icon>
                <span>Phiên bản gần đây</span>
            </h5>
            <div class="divide-y divide-gray-150 border border-gray-200 rounded-lg overflow-hidden">
                @foreach($revisions as $revision)
                    <div class="px-4 py-3 bg-white flex flex-wrap items-center justify-between gap-3 text-sm hover:bg-gray-50/50 transition-colors">
                        <span class="text-gray-700 font-semibold">
                            {{ $revision->created_at?->format('d/m/Y H:i:s') }} · <span class="text-gray-400 text-xs">{{ $revision->creator?->name ?: 'Hệ thống' }}</span>
                        </span>
                        <form method="POST" action="{{ route('admin.pages.revisions.restore', [$page, $revision]) }}">
                            @csrf
                            <x-admin.button type="submit" variant="outline" size="xs" onclick="return confirm('Khôi phục phiên bản này?')">
                                Khôi phục
                            </x-admin.button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
