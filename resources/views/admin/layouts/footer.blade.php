<!-- Global Search Modal (Tailwind + Alpine.js) -->
<div
    x-show="searchOpen"
    x-on:keydown.escape.window="searchOpen = false"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    x-init="$watch('searchOpen', value => { 
        if (value) {
            setTimeout(() => {
                const searchInput = document.getElementById('search');
                if (searchInput) searchInput.focus();
            }, 100);
        } else {
            const searchInput = document.getElementById('search');
            const quickLinksContainer = document.getElementById('quickLinksContainer');
            const searchResultsContainer = document.getElementById('searchResultsContainer');
            if (searchInput) searchInput.value = '';
            if (quickLinksContainer) quickLinksContainer.style.display = 'block';
            if (searchResultsContainer) {
                searchResultsContainer.style.display = 'none';
                searchResultsContainer.innerHTML = '';
            }
        }
    })"
>
    <!-- Overlay -->
    <div
        x-show="searchOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        @click="searchOpen = false"
    ></div>

    <!-- Modal Content -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
            x-show="searchOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
        >
            <!-- Header/Search input -->
            <div class="flex items-center px-4 py-3 border-b border-gray-150">
                <iconify-icon icon="solar:magnifer-linear" class="text-xl text-gray-400 mr-3"></iconify-icon>
                <input
                    type="search"
                    id="search"
                    class="block w-full text-base font-semibold text-gray-900 placeholder-gray-400 bg-transparent border-0 focus:outline-none focus:ring-0"
                    placeholder="{{ __('admin.dashboard_page.global_search_placeholder') }}"
                >
                <button @click="searchOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                    <iconify-icon icon="solar:close-square-line-duotone" class="text-2xl"></iconify-icon>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 max-h-[70vh] overflow-y-auto">
                <!-- Quick links -->
                <div id="quickLinksContainer">
                    <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">{{ __('admin.dashboard_page.quick_links') }}</h5>
                    <ul class="space-y-1.5">
                        <li class="rounded-lg hover:bg-gray-50 transition-colors">
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5">
                                <span class="block text-sm font-semibold text-gray-800">{{ __('admin.dashboard') }}</span>
                                <span class="block text-xs text-gray-500">/admin/dashboard</span>
                            </a>
                        </li>
                        <li class="rounded-lg hover:bg-gray-50 transition-colors">
                            <a href="{{ route('admin.products.index') }}" class="block px-4 py-2.5">
                                <span class="block text-sm font-semibold text-gray-800">{{ __('admin.menu.products') }}</span>
                                <span class="block text-xs text-gray-500">/admin/catalog/products</span>
                            </a>
                        </li>
                        <li class="rounded-lg hover:bg-gray-50 transition-colors">
                            <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2.5">
                                <span class="block text-sm font-semibold text-gray-800">{{ __('admin.menu.orders') }}</span>
                                <span class="block text-xs text-gray-500">/admin/orders</span>
                            </a>
                        </li>
                        <li class="rounded-lg hover:bg-gray-50 transition-colors">
                            <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2.5">
                                <span class="block text-sm font-semibold text-gray-800">{{ __('admin.menu.categories') }}</span>
                                <span class="block text-xs text-gray-500">/admin/catalog/categories</span>
                            </a>
                        </li>
                        <li class="rounded-lg hover:bg-gray-50 transition-colors">
                            <a href="{{ route('admin.brands.index') }}" class="block px-4 py-2.5">
                                <span class="block text-sm font-semibold text-gray-800">{{ __('admin.menu.brands') }}</span>
                                <span class="block text-xs text-gray-500">/admin/catalog/brands</span>
                            </a>
                        </li>
                        <li class="rounded-lg hover:bg-gray-50 transition-colors">
                            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2.5">
                                <span class="block text-sm font-semibold text-gray-800">{{ __('admin.menu.users') }}</span>
                                <span class="block text-xs text-gray-500">/admin/users</span>
                            </a>
                        </li>
                        <li class="rounded-lg hover:bg-gray-50 transition-colors">
                            <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2.5">
                                <span class="block text-sm font-semibold text-gray-800">{{ __('admin.menu.settings') }}</span>
                                <span class="block text-xs text-gray-500">/admin/settings</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Search Results container -->
                <div id="searchResultsContainer" style="display: none;" class="space-y-4"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const quickLinksContainer = document.getElementById('quickLinksContainer');
    const searchResultsContainer = document.getElementById('searchResultsContainer');
    let debounceTimer;

    const escapeHtml = (value) => String(value ?? '').replace(/[&<>'"]/g, (char) => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;'
    }[char]));

    const safeAdminLink = (value, locale) => {
        try {
            const parsed = new URL(String(value ?? ''), window.location.origin);
            return parsed.origin === window.location.origin && parsed.pathname.startsWith(`/${locale}/admin/`)
                ? parsed.href
                : '#';
        } catch (_) {
            return '#';
        }
    };

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = searchInput.value.trim();

            clearTimeout(debounceTimer);
            
            if (query.length < 2) {
                quickLinksContainer.style.display = 'block';
                searchResultsContainer.style.display = 'none';
                searchResultsContainer.innerHTML = '';
                return;
            }

            debounceTimer = setTimeout(() => {
                searchResultsContainer.innerHTML = `
                    <div class="text-center py-6 text-gray-450">
                        <iconify-icon icon="solar:refresh-bold-duotone" class="text-3xl rotate-spinner inline-block mb-2"></iconify-icon>
                        <p class="text-sm font-semibold">{{ __('admin.dashboard_page.searching') }}</p>
                    </div>
                `;
                quickLinksContainer.style.display = 'none';
                searchResultsContainer.style.display = 'block';

                const locale = document.documentElement.lang || 'vi';
                fetch(`/${locale}/admin/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.results || data.results.length === 0) {
                            searchResultsContainer.innerHTML = `
                                <div class="text-center py-8 text-gray-450">
                                    <iconify-icon icon="solar:info-circle-broken" class="text-4xl mb-2 inline-block"></iconify-icon>
                                    <p class="text-sm font-bold text-gray-800">${"{{ __('admin.dashboard_page.no_results') }}".replace(':query', query)}</p>
                                </div>
                            `;
                            return;
                        }

                        let html = '';
                        data.results.forEach(group => {
                            html += `
                                <div class="mb-4">
                                    <h5 class="text-xs font-bold text-primary uppercase tracking-wider mb-2 pb-1.5 border-b border-gray-100 flex items-center gap-2">
                                        <iconify-icon icon="${escapeHtml(group.icon || 'solar:link-bold-duotone')}" class="text-base"></iconify-icon>
                                        <span>${escapeHtml(group.category)}</span>
                                    </h5>
                                    <ul class="space-y-1">
                            `;
                            group.items.forEach(item => {
                                html += `
                                        <li class="rounded-lg hover:bg-gray-50 transition-colors">
                                            <a href="${safeAdminLink(item.link, locale)}" class="flex items-center justify-between px-3 py-2">
                                                <div>
                                                    <span class="block text-sm font-semibold text-gray-800">${escapeHtml(item.title)}</span>
                                                    <span class="block text-xs text-gray-500">${escapeHtml(item.subtitle)}</span>
                                                </div>
                                                <iconify-icon icon="solar:alt-arrow-right-linear" class="text-lg text-gray-400"></iconify-icon>
                                            </a>
                                        </li>
                                `;
                            });
                            html += `
                                    </ul>
                                </div>
                            `;
                        });

                        searchResultsContainer.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error during global search:', error);
                        searchResultsContainer.innerHTML = `
                            <div class="text-center py-6 text-red-500">
                                <iconify-icon icon="solar:danger-broken" class="text-3xl mb-2 inline-block"></iconify-icon>
                                <p class="text-sm font-semibold">{{ __('admin.connection_error') }}</p>
                            </div>
                        `;
                    });
            }, 300);
        });
    }
});
</script>

<style>
.rotate-spinner {
    animation: spinner-rotation 1.3s linear infinite;
}
@keyframes spinner-rotation {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
