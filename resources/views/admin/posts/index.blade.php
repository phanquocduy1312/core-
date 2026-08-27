@extends('admin.layouts.app')

@section('title', __('admin.posts.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.posts.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.posts.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.posts.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('admin.posts.create') }}
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
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.actions.search') }}</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="{{ __('admin.posts.search_placeholder') }}">
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.posts.fields.category') }}</label>
                <select name="category_id" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }} {{ mb_strtolower(__('admin.posts.fields.category')) }}</option>
                    @foreach($categories as $category)
                        @php
                            $fallbackLocale = app(\App\Services\LanguageRegistry::class)->fallbackLocale();
                            $catName = $category->getTranslation('name', app()->getLocale(), false) ?: $category->getTranslation('name', $fallbackLocale, false);
                        @endphp
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {!! str_repeat('&nbsp;&nbsp;', $category->depth ?? 0) !!}{{ $category->depth ? '↳ ' : '' }}{{ $catName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.posts.fields.status') }}</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="1" @selected(request('status') === '1')>{{ __('admin.posts.fields.active') }}</option>
                    <option value="0" @selected(request('status') === '0')>{{ __('admin.posts.fields.inactive') }}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-1">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center gap-1" title="{{ __('catalog.actions.search') }}">
                    <iconify-icon icon="solar:magnifer-linear" class="text-base"></iconify-icon>
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            @include('admin.shared.bulk-actions', [
                'bulkFormId' => 'bulk-posts-form',
                'bulkActionUrl' => route('admin.posts.bulk'),
                'bulkItemLabel' => 'bài viết',
            ])
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3" style="width: 44px;">
                                <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" data-bulk-select-all="bulk-posts-form" aria-label="Chọn tất cả bài viết">
                            </th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.posts.fields.title') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.posts.fields.category') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.posts.fields.published_at') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.posts.placeholders.seo_score') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.posts.fields.status') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($posts as $post)
                            @php
                                $fallbackLocale = app(\App\Services\LanguageRegistry::class)->fallbackLocale();
                                $title = $post->getTranslation('title', app()->getLocale(), false) ?: $post->getTranslation('title', $fallbackLocale, false);
                                $catName = $post->category ? ($post->category->getTranslation('name', app()->getLocale(), false) ?: $post->category->getTranslation('name', $fallbackLocale, false)) : __('admin.posts.uncategorized');
                                $seoScore = $post->seo_score;
                                $seoVariant = $seoScore === null
                                    ? 'secondary'
                                    : ($seoScore >= 80 ? 'success' : ($seoScore >= 50 ? 'warning' : 'danger'));
                            @endphp
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" name="ids[]" value="{{ $post->id }}" form="bulk-posts-form" data-bulk-select="bulk-posts-form" aria-label="Chọn {{ $title }}">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg border border-gray-200 p-0.5 bg-white flex items-center justify-center overflow-hidden shrink-0">
                                            <img src="{{ $post->image_url ?: asset('admin-assets/js/icons/empty.png') }}" 
                                                 onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/empty.png') }}';"
                                                 alt="{{ $title }}" 
                                                 class="w-full h-full object-cover rounded-md">
                                        </div>
                                        <h6 class="font-bold text-gray-900 hover:text-primary transition-colors max-w-xs truncate">
                                            <a href="{{ route('admin.posts.edit', $post) }}">{{ $title }}</a>
                                        </h6>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.badge variant="info">{{ $catName }}</x-admin.badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    {{ $post->published_at ? $post->published_at->format('d-m-Y H:i') : __('admin.posts.fields.inactive') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.badge :variant="$seoVariant">
                                        {{ $seoScore === null ? 'Chưa phân tích' : $seoScore.'/100' }}
                                    </x-admin.badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($post->is_active)
                                        <x-admin.badge variant="success">{{ __('admin.posts.fields.active') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="warning">{{ __('admin.posts.fields.inactive') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <x-admin.button variant="outline" size="xs" href="{{ route('admin.posts.edit', $post) }}" title="{{ __('catalog.actions.edit') }}">
                                            <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                        </x-admin.button>
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-admin.button type="submit" variant="danger" size="xs" onclick="return confirm('{{ __('admin.posts.confirm_delete') }}')" title="{{ __('catalog.actions.delete') }}">
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
                                        <iconify-icon icon="solar:document-bold-duotone" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.posts.not_found') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($posts->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
