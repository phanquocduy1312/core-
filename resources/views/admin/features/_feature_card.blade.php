@php
    $translationKey = "admin.features.{$feature->feature_code}";
    $displayName = Lang::has($translationKey) ? __($translationKey) : Str::headline($feature->feature_code);
    
    $iconMap = [
        'catalog' => 'solar:box-linear',
        'cart' => 'solar:cart-linear',
        'cod_order' => 'solar:dollar-linear',
        'online_payment' => 'solar:card-2-linear',
        'voucher' => 'solar:ticket-linear',
        'review' => 'solar:chat-round-line-linear',
        'banner' => 'solar:gallery-linear',
        'menu' => 'solar:menu-hamburger-linear',
        'zalo_oa' => 'solar:bell-ringing-linear',
        'multi_admin' => 'solar:users-group-two-rounded-linear',
        'inventory_log' => 'solar:clipboard-list-linear',
        'cms_page' => 'solar:document-linear',
    ];
    $icon = $iconMap[$feature->feature_code] ?? 'solar:widget-linear';
    
    $colorMap = [
        'catalog' => 'bg-blue-50 text-blue-600 border-blue-100',
        'cart' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
        'cod_order' => 'bg-amber-50 text-amber-605 border-amber-100',
        'online_payment' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
        'voucher' => 'bg-rose-50 text-rose-600 border-rose-100',
        'review' => 'bg-slate-50 text-slate-600 border-slate-100',
        'banner' => 'bg-blue-50 text-blue-600 border-blue-100',
        'menu' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
        'zalo_oa' => 'bg-amber-50 text-amber-605 border-amber-100',
        'multi_admin' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
        'inventory_log' => 'bg-rose-50 text-rose-600 border-rose-100',
        'cms_page' => 'bg-slate-50 text-slate-600 border-slate-100',
    ];
    $colorClass = $colorMap[$feature->feature_code] ?? 'bg-gray-50 text-gray-600 border-gray-100';
@endphp

<div class="col-span-12 md:col-span-6 lg:col-span-4" data-feature-card data-feature-group="{{ $groupKey }}">
    <div class="h-full bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow relative overflow-hidden flex flex-col justify-between p-5 pt-7">
        <!-- Top Status Badge -->
        <span class="absolute top-0 right-0 {{ $feature->is_enabled ? 'bg-emerald-500 text-white' : 'bg-gray-100 text-gray-400 border-l border-b border-gray-200' }} px-3 py-1 text-xs font-bold flex items-center gap-1 rounded-bl-xl" 
              id="badge-{{ $feature->feature_code }}">
            <i class="{{ $feature->is_enabled ? 'ti ti-circle-check' : 'ti ti-circle-x' }}" id="badge-icon-{{ $feature->feature_code }}"></i>
            <span id="badge-text-{{ $feature->feature_code }}">{{ $feature->is_enabled ? 'Đã kích hoạt' : 'Đang tắt' }}</span>
        </span>

        <div>
            <!-- Icon -->
            <div class="mb-4">
                <div class="{{ $colorClass }} w-12 h-12 rounded-lg border flex items-center justify-center">
                    <iconify-icon icon="{{ $icon }}" class="text-2xl"></iconify-icon>
                </div>
            </div>

            <h5 class="text-sm font-bold text-gray-950 mb-1.5">{{ $displayName }}</h5>
            <p class="text-xs text-gray-500 mb-6 min-h-[32px]">
                {{ Lang::has("admin.features.subtitle_for_{$feature->feature_code}") ? __("admin.features.subtitle_for_{$feature->feature_code}") : '' }}
            </p>
        </div>

        <div>
            <div class="flex items-center justify-between border-t border-gray-150 pt-4">
                <div>
                    <span class="text-gray-400 text-[10px] uppercase font-bold tracking-wider block mb-0.5">Trạng thái</span>
                    <span class="text-xs font-bold {{ $feature->is_enabled ? 'text-emerald-600' : 'text-red-500' }}" id="status-text-{{ $feature->feature_code }}">
                        {{ $feature->is_enabled ? 'Hoạt động' : 'Tạm dừng' }}
                    </span>
                </div>
                
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="features[{{ $feature->feature_code }}]" value="0">
                    <input class="sr-only peer" type="checkbox" role="switch"
                           name="features[{{ $feature->feature_code }}]" value="1"
                           id="switch-{{ $feature->feature_code }}"
                           data-feature-switch
                           data-feature-group="{{ $groupKey }}"
                           onchange="toggleFeatureState('{{ $feature->feature_code }}', this.checked)"
                           @checked($feature->is_enabled)>
                    <div class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></div>
                </label>
            </div>
        </div>
    </div>
</div>
