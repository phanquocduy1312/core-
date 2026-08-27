<header class="app-header fixed top-0 left-0 z-40 w-full h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 shadow-sm">
    <!-- Left Section -->
    <div class="flex items-center gap-3">
        <!-- Mobile Sidebar Toggle -->
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="sm:hidden p-2 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none"
            aria-label="Toggle Sidebar"
        >
            <iconify-icon icon="solar:hamburger-menu-line-duotone" class="text-2xl"></iconify-icon>
        </button>

        <!-- Brand Logo & Storefront Link -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-nowrap">
            <img src="{{ $siteBranding['admin_logo_url'] }}" class="h-8 w-auto object-contain" alt="{{ $siteBranding['name'] }}">
        </a>

        <!-- Store Link -->
        <a href="{{ url('/') }}" target="_blank" class="hidden md:flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-600 hover:text-primary bg-gray-50 hover:bg-red-50 rounded-lg transition-colors border border-gray-100">
            <iconify-icon icon="solar:home-2-linear" class="text-sm"></iconify-icon>
            <span>{{ $siteBranding['name'] }}</span>
        </a>
    </div>

    <!-- Right Section -->
    <div class="flex items-center gap-4">
        <!-- Search Trigger Button -->
        <button @click="searchOpen = true" class="flex items-center justify-center p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none" title="Tìm kiếm">
            <iconify-icon icon="solar:magnifer-linear" class="text-xl"></iconify-icon>
        </button>

        <!-- Technical Support Dropdown -->
        <x-admin.dropdown align="right" width="64">
            <x-slot name="trigger">
                <button class="flex items-center justify-center p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none" title="Hỗ trợ kỹ thuật">
                    <iconify-icon icon="solar:widget-3-linear" class="text-xl"></iconify-icon>
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="px-4 py-2 border-b border-gray-100 font-semibold text-gray-800 text-sm">Hỗ trợ kỹ thuật</div>
                <a href="https://support.matbao.ws" target="_blank" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <iconify-icon icon="solar:question-square-linear" class="text-lg text-purple-600"></iconify-icon>
                    <div>
                        <div class="font-semibold text-gray-900">Hướng dẫn sử dụng</div>
                        <div class="text-xs text-gray-500">Tài liệu hướng dẫn sử dụng</div>
                    </div>
                </a>
                <a href="mailto:support@matbao.ws" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <iconify-icon icon="solar:letter-bold-duotone" class="text-lg text-amber-500"></iconify-icon>
                    <div>
                        <div class="font-semibold text-gray-900">support@matbao.ws</div>
                        <div class="text-xs text-gray-500">Email hỗ trợ kỹ thuật</div>
                    </div>
                </a>
                <a href="tel:02877777999" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <iconify-icon icon="solar:phone-calling-rounded-bold-duotone" class="text-lg text-blue-500"></iconify-icon>
                    <div>
                        <div class="font-semibold text-gray-900">(028) 7777 7999</div>
                        <div class="text-xs text-gray-500">Hotline hỗ trợ 24/7/365</div>
                    </div>
                </a>
                <div class="p-3 border-t border-gray-100 bg-gray-50 flex flex-col gap-2">
                    <p class="text-xs text-gray-600 font-medium">Cần gặp nhân viên hỗ trợ?</p>
                    <a href="https://support.matbao.ws/submitticket.php" target="_blank" class="block w-full text-center py-2 text-xs font-bold text-white bg-primary hover:bg-primary-hover active:bg-primary-active rounded-lg transition-colors shadow-sm">
                        GỬI YÊU CẦU NGAY
                    </a>
                </div>
            </x-slot>
        </x-admin.dropdown>

        <!-- Notifications Dropdown -->
        <x-admin.dropdown align="right" width="64">
            <x-slot name="trigger">
                <button class="relative flex items-center justify-center p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none" title="{{ __('admin.notifications') }}">
                    <iconify-icon icon="solar:bell-bing-line-duotone" class="text-xl"></iconify-icon>
                    @if($headerNotifications->count() > 0)
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-primary rounded-full"></span>
                    @endif
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="px-4 py-2 border-b border-gray-100 flex items-center justify-between">
                    <span class="font-semibold text-gray-800 text-sm">{{ __('admin.notifications') }}</span>
                    <span class="text-xs text-primary font-bold">{{ $headerNotifications->count() }} mới</span>
                </div>
                <div class="max-h-60 overflow-y-auto divide-y divide-gray-50">
                    @forelse($headerNotifications as $notification)
                        <a href="{{ $notification['link'] }}" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-sm {{ $notification['bg_color'] }} text-white">
                                <iconify-icon icon="{{ $notification['icon'] }}"></iconify-icon>
                            </span>
                            <div class="flex-grow min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $notification['title'] }}</p>
                                    <span class="text-xxs text-gray-400">{{ $notification['time'] }}</span>
                                </div>
                                <p class="text-xs text-gray-500 truncate mt-0.5">{{ $notification['message'] }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="py-6 text-center text-gray-400 text-xs">
                            <iconify-icon icon="solar:bell-bing-line-duotone" class="text-3xl mb-1"></iconify-icon>
                            <div>Không có thông báo mới</div>
                        </div>
                    @endforelse
                </div>
                <div class="p-2 border-t border-gray-100 bg-gray-50">
                    <a href="{{ route('admin.notifications.index') }}" class="block w-full text-center py-2 text-xs font-semibold text-primary hover:bg-red-50 rounded-lg transition-colors border border-gray-150">
                        {{ __('admin.see_all_notifications') }}
                    </a>
                </div>
            </x-slot>
        </x-admin.dropdown>

        <!-- Language Switcher -->
        @include('admin.layouts.language-switcher')

        <!-- User Profile Dropdown -->
        <x-admin.dropdown align="right" width="56">
            <x-slot name="trigger">
                <button class="flex items-center gap-1.5 focus:outline-none hover:opacity-90">
                    <img src="{{ asset('admin-assets/images/profile/user-1.jpg') }}" class="w-8 h-8 rounded-full border border-gray-250 object-cover" alt="Profile">
                    <iconify-icon icon="solar:alt-arrow-down-bold" class="text-gray-500 text-xs"></iconify-icon>
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                    <div class="font-bold text-sm text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email ?? 'admin@example.com' }}</div>
                </div>
                <div class="py-1">
                    <a href="{{ route('admin.users.edit', auth()->id()) }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        <iconify-icon icon="solar:user-bold-duotone" class="text-lg text-gray-400"></iconify-icon>
                        <span>{{ __('admin.profile.my_profile') }}</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        <iconify-icon icon="solar:settings-bold-duotone" class="text-lg text-gray-400"></iconify-icon>
                        <span>{{ __('admin.profile.account_settings') }}</span>
                    </a>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" class="border-t border-gray-100">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 text-left font-semibold transition-colors">
                        <iconify-icon icon="solar:logout-bold-duotone" class="text-lg text-red-400"></iconify-icon>
                        <span>{{ __('admin.profile.sign_out') }}</span>
                    </button>
                </form>
            </x-slot>
        </x-admin.dropdown>
    </div>
</header>
