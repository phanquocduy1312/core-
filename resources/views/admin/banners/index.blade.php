@extends('admin.layouts.app')

@section('title', __('admin.banners.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.banners.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.banners.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.banners.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> Thêm banner
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Success Notification -->
    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-250 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:check-circle-bold" class="text-lg"></iconify-icon>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="text-emerald-500 hover:text-emerald-700" onclick="this.parentElement.remove()">
                <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
            </button>
        </div>
    @endif

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-5">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.banners.fields.position') }}</label>
                <select name="position" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="home_main" @selected(request('position') === 'home_main')>{{ __('admin.banners.positions.home_main') }}</option>
                    <option value="home_sidebar" @selected(request('position') === 'home_sidebar')>{{ __('admin.banners.positions.home_sidebar') }}</option>
                    <option value="promotional" @selected(request('position') === 'promotional')>{{ __('admin.banners.positions.promotional') }}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-5">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.banners.fields.status') }}</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="1" @selected(request('status') === '1')>{{ __('admin.banners.fields.active') }}</option>
                    <option value="0" @selected(request('status') === '0')>{{ __('admin.banners.fields.inactive') }}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center gap-1">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon>
                    <span>{{ __('catalog.actions.search') }}</span>
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            @include('admin.shared.bulk-actions', [
                'bulkFormId' => 'bulk-banners-form',
                'bulkActionUrl' => route('admin.banners.bulk'),
                'bulkItemLabel' => 'banner',
            ])
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3" style="width: 44px;">
                                <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" data-bulk-select-all="bulk-banners-form" aria-label="Chọn tất cả banner">
                            </th>
                            <th class="px-6 py-3 font-bold" style="width: 180px;">{{ __('admin.banners.fields.image') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.banners.fields.title') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.banners.fields.position') }}</th>
                            <th class="px-6 py-3 font-bold" style="width: 120px;">{{ __('admin.banners.fields.sort_order') }}</th>
                            <th class="px-6 py-3 font-bold" style="width: 150px;">{{ __('admin.banners.fields.status') }}</th>
                            <th class="px-6 py-3 text-right" style="width: 120px;"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($banners as $banner)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" name="ids[]" value="{{ $banner->id }}" form="bulk-banners-form" data-bulk-select="bulk-banners-form" aria-label="Chọn {{ $banner->title ?: 'banner' }}">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="rounded-lg border border-gray-200 p-0.5 bg-white flex items-center justify-center overflow-hidden w-32 h-16 shrink-0">
                                        <img src="{{ $banner->image_url }}" 
                                             alt="{{ $banner->title }}" 
                                             class="w-full h-full object-cover rounded-md">
                                    </div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <h6 class="font-bold text-gray-900 truncate hover:text-primary transition-colors">
                                        <a href="{{ route('admin.banners.edit', $banner) }}">
                                            {{ $banner->title ?: __('admin.not_configured') }}
                                        </a>
                                    </h6>
                                    @if($banner->link_url)
                                        <a href="{{ $banner->link_url }}" target="_blank" class="text-xs text-gray-400 flex items-center gap-1 mt-1 hover:text-primary transition-colors truncate max-w-[260px]">
                                            <iconify-icon icon="solar:link-linear" class="text-base shrink-0"></iconify-icon>
                                            <span>{{ $banner->link_url }}</span>
                                        </a>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.badge variant="info">
                                        {{ __('admin.banners.positions.' . $banner->position) }}
                                    </x-admin.badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">
                                    {{ $banner->sort_order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($banner->is_active)
                                        <x-admin.badge variant="success">{{ __('admin.banners.fields.active') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="warning">{{ __('admin.banners.fields.inactive') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <x-admin.button variant="outline" size="xs" href="{{ route('admin.banners.edit', $banner) }}" title="{{ __('catalog.actions.edit') }}">
                                            <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                        </x-admin.button>
                                        <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="inline js-delete-form" data-confirm-title="{{ __('admin.banners.confirm_delete') }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-admin.button type="submit" variant="danger" size="xs" title="{{ __('catalog.actions.delete') }}">
                                                <iconify-icon icon="solar:trash-bin-trash-linear"></iconify-icon>
                                            </x-admin.button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:photo-off-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">Không tìm thấy banner nào.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($banners->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $banners->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
