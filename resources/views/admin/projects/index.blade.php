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

    <!-- Table Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <form id="bulk-form" action="{{ route('admin.projects.bulk') }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Bulk Actions Bar -->
            <div class="p-4 bg-gray-50/75 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <select name="action" class="text-xs font-semibold p-2 border border-gray-300 rounded-lg bg-white focus:ring-primary focus:border-primary focus:outline-none">
                        <option value="">{{ __('admin.bulk_action') }}</option>
                        <option value="activate">{{ __('admin.activate') }}</option>
                        <option value="deactivate">{{ __('admin.deactivate') }}</option>
                        <option value="delete">{{ __('admin.delete') }}</option>
                    </select>
                    <button type="submit" class="px-3 py-2 text-xs font-bold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                        {{ __('admin.apply') }}
                    </button>
                </div>
                <div class="text-xs text-gray-500 font-medium">
                    {{ __('admin.showing_results', ['first' => $projects->firstItem() ?? 0, 'last' => $projects->lastItem() ?? 0, 'total' => $projects->total()]) }}
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="p-4 w-4">
                                <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary">
                            </th>
                            <th scope="col" class="px-6 py-3">{{ __('admin.projects.fields.project') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('admin.projects.fields.category') }}</th>
                            <th scope="col" class="px-6 py-3">{{ __('admin.projects.fields.location') }}</th>
                            <th scope="col" class="px-6 py-3 text-center">{{ __('admin.projects.fields.status') }}</th>
                            <th scope="col" class="px-6 py-3 text-right">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($projects as $project)
                            @php
                                $locale = app()->getLocale();
                                $title = $project->getTranslation('title', $locale) ?: $project->getTranslation('title', 'en');
                                $location = $project->getTranslation('location', $locale) ?: $project->getTranslation('location', 'en');
                                $img = $project->image_url ?: '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg';
                            @endphp
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="w-4 p-4">
                                    <input type="checkbox" name="ids[]" value="{{ $project->id }}" class="row-checkbox w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $img }}" alt="{{ $title }}" class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                                        <div>
                                            <div class="font-bold text-gray-900 hover:text-primary transition-colors">
                                                <a href="{{ route('admin.projects.edit', $project) }}">{{ $title }}</a>
                                            </div>
                                            <div class="text-xs text-gray-400 font-mono mt-0.5">/projects/{{ $project->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-800 border border-blue-200">
                                        {{ $project->categoryLabel($locale) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $location ?: '—' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($project->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            {{ __('admin.projects.fields.active') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ __('admin.projects.fields.inactive') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ url('/projects/' . $project->slug) }}" target="_blank" class="p-1.5 text-gray-500 hover:text-primary transition-colors inline-block" title="Xem trên web">
                                        <iconify-icon icon="solar:eye-linear" class="text-lg"></iconify-icon>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="p-1.5 text-gray-500 hover:text-primary transition-colors inline-block" title="{{ __('admin.edit') }}">
                                        <iconify-icon icon="solar:pen-2-linear" class="text-lg"></iconify-icon>
                                    </a>
                                    <button type="button" onclick="confirmDelete('{{ $project->id }}')" class="p-1.5 text-gray-500 hover:text-red-600 transition-colors inline-block" title="{{ __('admin.delete') }}">
                                        <iconify-icon icon="solar:trash-bin-trash-linear" class="text-lg"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <iconify-icon icon="solar:box-minimalistic-linear" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                    <p class="font-medium">{{ __('admin.projects.no_projects') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($projects->hasPages())
                <div class="p-4 border-t border-gray-200">
                    {{ $projects->links() }}
                </div>
            @endif
        </form>
    </div>

    <!-- Hidden Delete Form -->
    <form id="delete-form" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.getElementById('checkbox-all')?.addEventListener('change', function() {
            document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this.checked);
        });

        function confirmDelete(id) {
            if (confirm('{{ __('admin.projects.confirm_delete') }}')) {
                const form = document.getElementById('delete-form');
                form.action = `/vi/admin/projects/${id}`;
                form.submit();
            }
        }
    </script>
@endsection
