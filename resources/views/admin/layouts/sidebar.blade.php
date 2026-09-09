@php
    $sidebarUser = auth()->user();
    $sidebarFeatures = app(\App\Support\FeatureGate::class);
@endphp

<aside
    id="sidebar-menu"
    class="left-sidebar fixed top-0 left-0 z-38 w-64 h-screen pt-16 bg-white border-r border-gray-200 transition-transform sm:translate-x-0 overflow-y-auto"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <div id="sidebarnav" class="px-4 py-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
            <iconify-icon icon="solar:chart-line-duotone" class="text-xl"></iconify-icon>
            <span>{{ __('admin.sidebar.dashboard') }}</span>
        </a>

        <!-- Orders -->
        @if($sidebarFeatures->availableTo($sidebarUser, 'catalog'))
            @can('manage_orders')
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-red-50 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                <iconify-icon icon="solar:bill-list-line-duotone" class="text-xl"></iconify-icon>
                <span>{{ __('admin.sidebar.orders') }}</span>
            </a>
            @endcan
        @endif

        <!-- Customers -->
        @can('view_customers')
        <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.customers.*') ? 'bg-red-50 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
            <iconify-icon icon="solar:users-group-two-rounded-line-duotone" class="text-xl"></iconify-icon>
            <span>{{ __('admin.sidebar.customers') }}</span>
        </a>
        @endcan

        <!-- Products Submenu -->
        @if($sidebarFeatures->availableTo($sidebarUser, 'catalog'))
            @can('manage_products')
            <div x-data="{ open: {{ (request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.brands.*')) ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center w-full gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors text-gray-700 hover:bg-gray-50">
                    <iconify-icon icon="solar:cart-3-line-duotone" class="text-xl"></iconify-icon>
                    <span>{{ __('admin.sidebar.products') }}</span>
                    <iconify-icon icon="solar:alt-arrow-down-linear" class="ml-auto text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></iconify-icon>
                </button>
                <div x-show="open" x-transition class="mt-1 space-y-1 pl-9" style="display: none;">
                    <a href="{{ route('admin.products.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.products.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.product_list') }}
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.categories.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.product_categories') }}
                    </a>
                    <a href="{{ route('admin.brands.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.brands.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.brands') }}
                    </a>
                </div>
            </div>
            @endcan
        @endif

        <!-- Reviews -->
        @if($sidebarFeatures->availableTo($sidebarUser, 'review'))
            @can('manage_reviews')
            <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.reviews.*') ? 'bg-red-50 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                <iconify-icon icon="solar:chat-round-line-line-duotone" class="text-xl"></iconify-icon>
                <span>{{ __('admin.sidebar.reviews') }}</span>
            </a>
            @endcan
        @endif

        <!-- Promotions Submenu -->
        @if($sidebarFeatures->availableTo($sidebarUser, 'voucher') || $sidebarFeatures->availableTo($sidebarUser, 'catalog'))
            @can('manage_vouchers')
            <div x-data="{ open: {{ (request()->routeIs('admin.vouchers.*') || request()->routeIs('admin.promotions.*')) ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center w-full gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors text-gray-700 hover:bg-gray-50">
                    <iconify-icon icon="solar:ticket-sale-line-duotone" class="text-xl"></iconify-icon>
                    <span>{{ __('admin.sidebar.promotions') }}</span>
                    <iconify-icon icon="solar:alt-arrow-down-linear" class="ml-auto text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></iconify-icon>
                </button>
                <div x-show="open" x-transition class="mt-1 space-y-1 pl-9" style="display: none;">
                    @if($sidebarFeatures->availableTo($sidebarUser, 'voucher'))
                        <a href="{{ route('admin.vouchers.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.vouchers.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                            {{ __('admin.sidebar.vouchers') }}
                        </a>
                    @endif
                    @if($sidebarFeatures->availableTo($sidebarUser, 'catalog'))
                        <a href="{{ route('admin.promotions.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.promotions.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                            {{ __('admin.sidebar.promotions_flash_sale') }}
                        </a>
                    @endif
                </div>
            </div>
            @endcan
        @endif

        <!-- Banners -->
        @if($sidebarFeatures->availableTo($sidebarUser, 'banner'))
            @can('manage_banners')
            <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.banners.*') ? 'bg-red-50 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                <iconify-icon icon="solar:gallery-bold-duotone" class="text-xl"></iconify-icon>
                <span>{{ __('admin.sidebar.banners') }}</span>
            </a>
            @endcan
        @endif

        <!-- Blog Submenu -->
        @if($sidebarFeatures->availableTo($sidebarUser, 'cms_page'))
            @can('manage_posts')
            <div x-data="{ open: {{ (request()->routeIs('admin.posts.*') || request()->routeIs('admin.post-categories.*')) ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center w-full gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors text-gray-700 hover:bg-gray-50">
                    <iconify-icon icon="solar:widget-4-line-duotone" class="text-xl"></iconify-icon>
                    <span>{{ __('admin.sidebar.blog') }}</span>
                    <iconify-icon icon="solar:alt-arrow-down-linear" class="ml-auto text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></iconify-icon>
                </button>
                <div x-show="open" x-transition class="mt-1 space-y-1 pl-9" style="display: none;">
                    <a href="{{ route('admin.posts.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.posts.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.post_list') }}
                    </a>
                    <a href="{{ route('admin.post-categories.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.post-categories.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.post_categories') }}
                    </a>
                </div>
            </div>
            @endcan
        @endif

        <!-- Page Management Submenu -->
        @if($sidebarFeatures->availableTo($sidebarUser, 'cms_page'))
            @can('manage_pages')
            <div x-data="{ open: {{ (request()->routeIs('admin.pages.*') || request()->routeIs('admin.partials.*')) ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center w-full gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors text-gray-700 hover:bg-gray-50">
                    <i class="ti ti-file-text text-xl" aria-hidden="true"></i>
                    <span>{{ __('admin.sidebar.page_management') }}</span>
                    <iconify-icon icon="solar:alt-arrow-down-linear" class="ml-auto text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></iconify-icon>
                </button>
                <div x-show="open" x-transition class="mt-1 space-y-1 pl-9" style="display: none;">
                    <a href="{{ route('admin.pages.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.pages.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.pages') }}
                    </a>
                    <a href="{{ route('admin.partials.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.partials.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.page_partials') }}
                    </a>
                </div>
            </div>

            <!-- Projects Standalone Tab -->
            <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-primary/10 text-primary font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                <iconify-icon icon="solar:city-line-duotone" class="text-xl"></iconify-icon>
                <span>{{ __('admin.sidebar.projects') }}</span>
            </a>

            <!-- Brands Standalone Tab -->
            <a href="{{ route('admin.brands.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.brands.*') ? 'bg-primary/10 text-primary font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                <iconify-icon icon="solar:stars-line-duotone" class="text-xl"></iconify-icon>
                <span>{{ __('admin.sidebar.brands') }}</span>
            </a>
            @endcan
        @endif

        <!-- User Management Submenu -->
        @if($sidebarFeatures->availableTo($sidebarUser, 'multi_admin'))
            @if(auth()->user()->can('manage_users') || auth()->user()->isSuperAdmin())
            <div x-data="{ open: {{ (request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*')) ? 'true' : 'false' }} }">
                <button @click="open = !open" class="flex items-center w-full gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors text-gray-700 hover:bg-gray-50">
                    <iconify-icon icon="solar:shield-user-line-duotone" class="text-xl"></iconify-icon>
                    <span>{{ __('admin.sidebar.user_management') }}</span>
                    <iconify-icon icon="solar:alt-arrow-down-linear" class="ml-auto text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></iconify-icon>
                </button>
                <div x-show="open" x-transition class="mt-1 space-y-1 pl-9" style="display: none;">
                    @can('manage_users')
                        <a href="{{ route('admin.users.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.users.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                            {{ __('admin.sidebar.user_list') }}
                        </a>
                    @endcan
                    @if(auth()->user()->isSuperAdmin())
                        <a href="{{ route('admin.roles.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.roles.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                            {{ __('admin.sidebar.roles_permissions') }}
                        </a>
                    @endif
                </div>
            </div>
            @endif
        @endif

        <!-- Settings Submenu -->
        @if($sidebarUser?->can('manage_settings') || $sidebarUser?->isSuperAdmin())
        <div x-data="{ open: {{ (request()->routeIs('admin.settings.*') || request()->routeIs('admin.shipping-partners.*') || request()->routeIs('admin.payment-methods.*') || request()->routeIs('admin.notification-settings.*') || request()->routeIs('admin.languages.*') || request()->routeIs('admin.features.*')) ? 'true' : 'false' }} }" data-sidebar-settings-menu>
            <button @click="open = !open" class="flex items-center w-full gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors text-gray-700 hover:bg-gray-50">
                <iconify-icon icon="solar:settings-line-duotone" class="text-xl"></iconify-icon>
                <span>{{ __('admin.sidebar.settings') }}</span>
                <iconify-icon icon="solar:alt-arrow-down-linear" class="ml-auto text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></iconify-icon>
            </button>
            <div x-show="open" x-transition class="mt-1 space-y-1 pl-9" style="display: none;">
                @can('manage_settings')
                    <a href="{{ route('admin.settings.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.general_settings') }}
                    </a>
                    <a href="{{ route('admin.shipping-partners.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.shipping-partners.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.shipping_settings') }}
                    </a>
                    <a href="{{ route('admin.payment-methods.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.payment-methods.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.payment_settings') }}
                    </a>
                    <a href="{{ route('admin.notification-settings.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.notification-settings.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.notification_settings') }}
                    </a>
                @endcan
                @if($sidebarUser?->isSuperAdmin())
                    <a href="{{ route('admin.languages.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.languages.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.content_languages') }}
                    </a>
                    <a href="{{ route('admin.features.index') }}" class="block py-2 text-sm font-medium transition-colors {{ request()->routeIs('admin.features.*') ? 'text-primary font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('admin.sidebar.feature_settings') }}
                    </a>
                @endif
            </div>
        </div>
        @endif

        <!-- Audit & System Logs -->
        @can('view_audit_log')
        <a href="{{ route('admin.activity-logs.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.activity-logs.*') ? 'bg-red-50 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
            <iconify-icon icon="solar:history-line-duotone" class="text-xl"></iconify-icon>
            <span>{{ __('admin.sidebar.activity_logs') }}</span>
        </a>
        <a href="{{ route('admin.logs.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.logs.*') ? 'bg-red-50 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
            <iconify-icon icon="solar:document-text-line-duotone" class="text-xl"></iconify-icon>
            <span>{{ __('admin.sidebar.system_logs') }}</span>
        </a>
        @endcan

        <!-- Media Library -->
        @can('manage_media')
        <a href="{{ route('admin.media.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('admin.media.*') ? 'bg-red-50 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
            <iconify-icon icon="solar:gallery-line-duotone" class="text-xl"></iconify-icon>
            <span>{{ __('admin.sidebar.media_library') }}</span>
        </a>
        @endcan
    </div>
</aside>
