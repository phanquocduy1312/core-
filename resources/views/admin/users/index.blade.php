@extends('admin.layouts.app')

@section('title', __('admin.users.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.users.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.users.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.users.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('admin.users.create') }}
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-5">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.actions.search') }}</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="{{ __('admin.users.search_placeholder') }}">
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.users.fields.role') }}</label>
                <select name="role_id" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" @selected((string) request('role_id') === (string) $role->id)>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('admin.users.fields.status') }}</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">{{ __('admin.all') }}</option>
                    <option value="1" @selected((string) request('status') === '1')>{{ __('admin.users.fields.active') }}</option>
                    <option value="0" @selected((string) request('status') === '0')>{{ __('admin.users.fields.suspended') }}</option>
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
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold">{{ __('admin.users.fields.name') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.users.fields.role') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.users.fields.status') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('admin.users.fields.last_login') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($users as $userItem)
                            <tr class="hover:bg-gray-55/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $userItem->avatar_url ?: asset('admin-assets/images/profile/user-1.jpg') }}" 
                                             alt="{{ $userItem->name }}" 
                                             class="rounded-full border border-gray-200 w-11 h-11 object-cover shrink-0">
                                        <div>
                                            <h6 class="font-bold text-gray-900 leading-none">{{ $userItem->name }}</h6>
                                            <span class="text-xs text-gray-400 mt-1 block">{{ $userItem->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($userItem->role?->name === 'Admin')
                                        <x-admin.badge variant="primary">Admin</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="secondary">{{ $userItem->role?->name ?? 'User' }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($userItem->is_active)
                                        <x-admin.badge variant="success">{{ __('admin.users.fields.active') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="danger">{{ __('admin.users.fields.suspended') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-650">
                                    {{ $userItem->last_login_at ? $userItem->last_login_at->format('d-m-Y H:i:s') : __('admin.users.fields.never_logged_in') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end gap-2">
                                        <!-- Lock/Unlock Link -->
                                        @if($userItem->id !== auth()->id() && !$userItem->isSuperAdmin())
                                            <form method="POST" action="{{ route('admin.users.toggle-status', $userItem) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                @if($userItem->is_active)
                                                    <x-admin.button type="submit" variant="warning" size="xs" title="Khóa tài khoản" onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?')">
                                                        <iconify-icon icon="solar:lock-keyhole-linear"></iconify-icon>
                                                    </x-admin.button>
                                                @else
                                                    <x-admin.button type="submit" variant="success" size="xs" title="Mở khóa tài khoản" onclick="return confirm('Bạn có chắc chắn muốn mở khóa tài khoản này?')">
                                                        <iconify-icon icon="solar:lock-keyhole-unlocked-linear"></iconify-icon>
                                                    </x-admin.button>
                                                @endif
                                            </form>
                                        @endif

                                        <!-- Quick Login (Impersonate) Button -->
                                        @if($userItem->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.impersonate', $userItem) }}" class="inline">
                                                @csrf
                                                <x-admin.button type="submit" variant="info" size="xs" title="Đăng nhập nhanh" onclick="return confirm('Bạn có muốn đăng nhập nhanh vào tài khoản này?')">
                                                    <iconify-icon icon="solar:login-2-linear"></iconify-icon>
                                                </x-admin.button>
                                            </form>
                                        @endif

                                        <!-- Edit Link -->
                                        <x-admin.button variant="outline" size="xs" href="{{ route('admin.users.edit', $userItem) }}" title="{{ __('catalog.actions.edit') }}">
                                            <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                        </x-admin.button>

                                        <!-- Delete Link -->
                                        @if($userItem->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.destroy', $userItem) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <x-admin.button type="submit" variant="danger" size="xs" onclick="return confirm('{{ __('admin.users.confirm_delete') }}')" title="{{ __('catalog.actions.delete') }}">
                                                    <iconify-icon icon="solar:trash-bin-trash-linear"></iconify-icon>
                                                </x-admin.button>
                                            </form>
                                        @else
                                            <button class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-100 bg-gray-50 text-gray-300 px-2 py-1 text-xs cursor-not-allowed" disabled title="{{ __('admin.users.fields.current_user') }}">
                                                <iconify-icon icon="solar:trash-bin-trash-linear"></iconify-icon>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <iconify-icon icon="solar:shield-user-broken" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                        <p class="text-sm font-semibold">{{ __('admin.users.not_found') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
