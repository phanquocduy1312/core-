@extends('admin.layouts.app')

@section('title', __('admin.roles.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.roles.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.roles.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.roles.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('admin.roles.create') }}
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Alert Message -->
    @if(session('error'))
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-250 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:info-circle-bold" class="text-lg"></iconify-icon>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
            </button>
        </div>
    @endif

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.roles.fields.name') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.roles.fields.users_count') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.roles.fields.permissions') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($roles as $role)
                            @php
                                $isSystemRole = $role->is_system;
                            @endphp
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    {{ $role->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.badge variant="secondary">
                                        {{ __('admin.roles.fields.accounts', ['count' => $role->users_count]) }}
                                    </x-admin.badge>
                                </td>
                                <td class="px-6 py-4 text-wrap" style="max-width: 400px;">
                                    @if(in_array('*', $role->permissions ?? []))
                                        <x-admin.badge variant="danger">
                                            {{ __('admin.roles.fields.all_permissions') }}
                                        </x-admin.badge>
                                    @elseif(empty($role->permissions))
                                        <x-admin.badge variant="secondary">
                                            {{ __('admin.roles.fields.no_permissions') }}
                                        </x-admin.badge>
                                    @else
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($role->permissions as $p)
                                                <x-admin.badge variant="primary">
                                                    {{ __('admin.roles.permissions.' . $p) }}
                                                </x-admin.badge>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    @if(!$isSystemRole)
                                        <div class="flex justify-end gap-2">
                                            <x-admin.button variant="outline" size="xs" href="{{ route('admin.roles.edit', $role) }}" title="{{ __('catalog.actions.edit') }}">
                                                <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                            </x-admin.button>
                                            <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="inline js-delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <x-admin.button type="submit" variant="danger" size="xs" title="{{ __('catalog.actions.delete') }}">
                                                    <iconify-icon icon="solar:trash-bin-trash-linear"></iconify-icon>
                                                </x-admin.button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-xs font-semibold text-gray-400">{{ __('admin.roles.fields.default_system') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:shield-warning-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.roles.not_found') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($roles->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
