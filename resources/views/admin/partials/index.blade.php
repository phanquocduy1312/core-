@extends('admin.layouts.app')

@section('title', 'Khối dùng chung')

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">Khối dùng chung</h4>
                <div class="text-slate-350 text-sm">Header, footer và các khối lặp lại ở nhiều trang (CTA, banner...).</div>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.partials.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> Thêm khối dùng chung
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-10">
                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="q" value="{{ request('q') }}" placeholder="Tìm theo tên">
            </div>
            <div class="col-span-12 md:col-span-2">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center gap-1">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon>
                    <span>Lọc</span>
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
                            <th class="px-6 py-3 font-bold">Tên</th>
                            <th class="px-6 py-3 font-bold">Vai trò</th>
                            <th class="px-6 py-3 font-bold">Trạng thái</th>
                            <th class="px-6 py-3 font-bold">Cập nhật</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($partials as $partial)
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    {{ $partial->getTranslation('title', app()->getLocale(), false) ?: $partial->getTranslation('title', app(\App\Services\LanguageRegistry::class)->fallbackLocale(), false) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($partial->partial_role)
                                        @case('header')
                                            <x-admin.badge variant="primary">Header</x-admin.badge>
                                            @break
                                        @case('footer')
                                            <x-admin.badge variant="info">Footer</x-admin.badge>
                                            @break
                                        @default
                                            <x-admin.badge variant="secondary">Khối dùng chung</x-admin.badge>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($partial->is_active)
                                        <x-admin.badge variant="success">Đang bật</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="secondary">Đã tắt</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    {{ $partial->updated_at?->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <x-admin.button variant="primary" size="xs" href="{{ route('admin.pages.builder', $partial) }}" class="flex items-center gap-1">
                                            <iconify-icon icon="solar:palette-bold"></iconify-icon>
                                            <span>Thiết kế (Builder)</span>
                                        </x-admin.button>
                                        <x-admin.button variant="outline" size="xs" href="{{ route('admin.partials.edit', $partial) }}">
                                            Chỉnh sửa
                                        </x-admin.button>
                                        <form method="POST" action="{{ route('admin.partials.destroy', $partial) }}" class="inline js-delete-form" data-confirm-text="Các trang đang dùng khối này sẽ mất phần nội dung tương ứng.">
                                            @csrf
                                            @method('DELETE')
                                            <x-admin.button type="submit" variant="danger" size="xs">
                                                Xóa
                                            </x-admin.button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:document-bold-duotone" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">Chưa có khối dùng chung nào.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($partials->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $partials->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
