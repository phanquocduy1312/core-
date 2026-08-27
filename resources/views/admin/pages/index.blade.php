@extends('admin.layouts.app')

@section('title', 'Trang nội dung')

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">Trang nội dung</h4>
                <div class="text-slate-350 text-sm">Tạo landing page và chỉnh sửa giao diện bằng kéo thả.</div>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.pages.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> Thêm trang
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-6">
                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="q" value="{{ request('q') }}" placeholder="Tìm theo tiêu đề hoặc slug">
            </div>
            <div class="col-span-12 md:col-span-4">
                <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="status">
                    <option value="">Tất cả trạng thái</option>
                    <option value="1" @selected(request('status') === '1')>Đã xuất bản</option>
                    <option value="0" @selected(request('status') === '0')>Bản nháp</option>
                </select>
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
                            <th class="px-6 py-3 font-bold">Tiêu đề</th>
                            <th class="px-6 py-3 font-bold">Slug</th>
                            <th class="px-6 py-3 font-bold">Trạng thái</th>
                            <th class="px-6 py-3 font-bold">Cập nhật</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($pages as $page)
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    {{ $page->getTranslation('title', app()->getLocale(), false) ?: $page->getTranslation('title', app(\App\Services\LanguageRegistry::class)->fallbackLocale(), false) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-gray-650">
                                    {{ $page->slug }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($page->is_active)
                                        <x-admin.badge variant="success">Đã xuất bản</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="secondary">Bản nháp</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    {{ $page->updated_at?->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        @if($page->is_active && $page->published_at && !$page->published_at->isFuture())
                                            <x-admin.button variant="outline" size="xs" href="{{ route('client.pages.show', ['locale' => app()->getLocale(), 'slug' => $page->canonicalSlug(app()->getLocale())]) }}" target="_blank" rel="noopener">
                                                Xem trang
                                            </x-admin.button>
                                        @endif
                                        <x-admin.button variant="primary" size="xs" href="{{ route('admin.pages.builder', $page) }}" class="flex items-center gap-1">
                                            <iconify-icon icon="solar:palette-bold"></iconify-icon>
                                            <span>Thiết kế (Builder)</span>
                                        </x-admin.button>
                                        <x-admin.button variant="outline" size="xs" href="{{ route('admin.pages.edit', $page) }}">
                                            Chỉnh sửa
                                        </x-admin.button>
                                        <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" class="inline js-delete-form" data-confirm-text="Trang sẽ được chuyển vào thùng rác.">
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
                                        <p class="text-sm font-semibold">Chưa có trang nào.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pages->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $pages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
