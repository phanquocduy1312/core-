@extends('admin.layouts.app')

@section('title', __('admin.projects.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.projects.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.projects.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.projects.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('admin.projects.create') }}
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Success Notification -->
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

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
            <div class="col-span-12 md:col-span-5">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.actions.search') }}</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="{{ __('admin.projects.search_placeholder') }}">
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.projects.fields.category') }}</label>
                <select name="category" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    @foreach($categories as $catKey => $catInfo)
                        <option value="{{ $catKey }}" @selected(request('category') === $catKey)>
                            {{ $catInfo[app()->getLocale()] ?? $catInfo['vi'] ?? ucfirst($catKey) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.projects.fields.status') }}</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="1" @selected(request('status') === '1')>{{ __('admin.projects.fields.active') }}</option>
                    <option value="0" @selected(request('status') === '0')>{{ __('admin.projects.fields.inactive') }}</option>
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
                'bulkFormId' => 'bulk-projects-form',
                'bulkActionUrl' => route('admin.projects.bulk'),
                'bulkItemLabel' => 'dự án',
            ])

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3" style="width: 44px;">
                                <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" data-bulk-select-all="bulk-projects-form" aria-label="Chọn tất cả dự án">
                            </th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.projects.fields.project') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.projects.fields.category') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.projects.fields.location') }}</th>
                            <th class="px-6 py-3 font-bold text-center">{{ __('admin.projects.fields.status') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($projects as $project)
                            @php
                                $locale = app()->getLocale();
                                $title = $project->getTranslation('title', $locale, false) ?: $project->getTranslation('title', 'en', false);
                                $location = $project->getTranslation('location', $locale, false) ?: $project->getTranslation('location', 'en', false);
                                $img = $project->image_url ?: '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg';
                            @endphp
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" name="ids[]" value="{{ $project->id }}" form="bulk-projects-form" data-bulk-select="bulk-projects-form" aria-label="Chọn {{ $title }}">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg border border-gray-200 p-0.5 bg-white flex items-center justify-center overflow-hidden shrink-0">
                                            <img src="{{ $img }}" alt="{{ $title }}" class="w-full h-full object-cover rounded-md">
                                        </div>
                                        <div>
                                            <h6 class="font-bold text-gray-900 hover:text-primary transition-colors">
                                                <a href="{{ route('admin.projects.edit', $project) }}">{{ $title }}</a>
                                            </h6>
                                            <div class="text-xs text-gray-400 font-mono mt-0.5">/projects/{{ $project->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-200">
                                        {{ $project->categoryLabel($locale) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $location ?: '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($project->is_active)
                                        <x-admin.badge variant="success">{{ __('admin.projects.fields.active') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="warning">{{ __('admin.projects.fields.inactive') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ url('/projects/' . ($project->slug ?: $project->id)) }}" target="_blank" class="p-1.5 text-gray-500 hover:text-primary transition-colors inline-block" title="Xem trên web">
                                            <iconify-icon icon="solar:eye-linear" class="text-lg"></iconify-icon>
                                        </a>
                                        <x-admin.button variant="outline" size="xs" href="{{ route('admin.projects.edit', $project) }}" title="{{ __('catalog.actions.edit') }}">
                                            <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                        </x-admin.button>
                                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-admin.button type="submit" variant="danger" size="xs" onclick="return confirm('{{ __('admin.projects.confirm_delete') }}')" title="{{ __('catalog.actions.delete') }}">
                                                <iconify-icon icon="solar:trash-bin-trash-linear"></iconify-icon>
                                            </x-admin.button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:city-line-duotone" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.projects.no_projects') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination & Results Bar -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-gray-600">
                    {{ __('admin.projects.showing', [
                        'from' => $projects->firstItem() ?? 0,
                        'to' => $projects->lastItem() ?? 0,
                        'total' => $projects->total()
                    ]) }}
                </span>

                <!-- Per Page Selector Form -->
                <form method="GET" class="inline-flex items-center gap-1.5 ml-2">
                    @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request()->has('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                    <select name="per_page" onchange="this.form.submit()" class="text-xs font-medium py-1 px-2 border border-gray-300 rounded bg-white text-gray-700 focus:ring-primary focus:border-primary">
                        <option value="10" @selected(request('per_page', 10) == 10)>10 {{ __('admin.projects.per_page') }}</option>
                        <option value="20" @selected(request('per_page') == 20)>20 {{ __('admin.projects.per_page') }}</option>
                        <option value="50" @selected(request('per_page') == 50)>50 {{ __('admin.projects.per_page') }}</option>
                        <option value="100" @selected(request('per_page') == 100)>100 {{ __('admin.projects.per_page') }}</option>
                    </select>
                </form>
            </div>

            <div>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
@endsection
