@extends('admin.layouts.app')

@section('title', __('admin.features.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1">{{ __('admin.features.title') }}</h4>
            <nav class="flex text-sm text-slate-300" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.features.title') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @php
        $groupMeta = [
            'ecommerce' => [
                'title' => __('admin.features.website_ecommerce'),
                'description' => __('admin.features.website_ecommerce_description'),
                'icon' => 'solar:cart-linear',
            ],
            'non_ecommerce' => [
                'title' => __('admin.features.website_non_ecommerce'),
                'description' => __('admin.features.website_non_ecommerce_description'),
                'icon' => 'solar:widget-2-linear',
            ],
        ];
    @endphp

    <div x-data="{ activeTab: 'ecommerce' }" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            <!-- Tabs Navigation -->
            <div class="border-b border-gray-200 px-6 pt-4 bg-gray-50/50">
                <nav class="-mb-px flex space-x-6 overflow-x-auto" aria-label="Tabs">
                    @foreach($groupMeta as $groupKey => $meta)
                        <button type="button" @click="activeTab = '{{ $groupKey }}'" 
                                :class="activeTab === '{{ $groupKey }}' ? 'border-primary text-primary' : 'border-transparent text-gray-550 hover:text-gray-700 hover:border-gray-300'" 
                                class="whitespace-nowrap pb-4 px-1 border-b-2 font-bold text-sm flex items-center gap-2 transition-colors focus:outline-none">
                            <iconify-icon icon="{{ $meta['icon'] }}" class="text-lg"></iconify-icon>
                            <span>{{ $meta['title'] }}</span>
                            <span class="inline-flex items-center justify-center px-2 py-0.5 ml-1 text-xs font-semibold text-gray-800 bg-gray-150 rounded-full">
                                {{ $featureGroups->get($groupKey, collect())->count() }}
                            </span>
                        </button>
                    @endforeach
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                @foreach($groupMeta as $groupKey => $meta)
                    @php
                        $groupFeatures = $featureGroups->get($groupKey, collect());
                        $enabledCount = $groupFeatures->where('is_enabled', true)->count();
                        $allEnabled = $groupFeatures->isNotEmpty() && $enabledCount === $groupFeatures->count();
                        $partiallyEnabled = $enabledCount > 0 && !$allEnabled;
                    @endphp
                    <div x-show="activeTab === '{{ $groupKey }}'" class="space-y-6">
                        <!-- Toolbar -->
                        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 p-4 bg-slate-50 border border-slate-100 rounded-xl">
                            <div>
                                <h5 class="text-sm font-bold text-gray-900 mb-0.5">{{ $meta['title'] }}</h5>
                                <p class="text-xs text-gray-550">{{ $meta['description'] }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ $allEnabled ? 'bg-emerald-100 text-emerald-800' : ($partiallyEnabled ? 'bg-amber-100 text-amber-800' : 'bg-gray-150 text-gray-650') }}"
                                      id="group-status-{{ $groupKey }}"
                                      data-group-status>
                                    {{ $allEnabled ? __('admin.features.group_all_enabled') : ($partiallyEnabled ? __('admin.features.group_partially_enabled') : __('admin.features.group_all_disabled')) }}
                                </span>
                                <div class="flex items-center">
                                    <input class="sr-only peer"
                                           type="checkbox"
                                           role="switch"
                                           id="group-switch-{{ $groupKey }}"
                                           data-feature-group-switch="{{ $groupKey }}"
                                           onchange="toggleFeatureGroup('{{ $groupKey }}', this.checked)"
                                           @checked($allEnabled)>
                                    <label for="group-switch-{{ $groupKey }}" class="relative w-9 h-5 bg-gray-200 rounded-full peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></label>
                                    <span class="ml-2 text-xs font-semibold text-gray-700 cursor-pointer" id="group-action-{{ $groupKey }}">
                                        {{ $allEnabled ? __('admin.features.disable_group') : __('admin.features.enable_group') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Features Grid -->
                        <div class="grid grid-cols-12 gap-6">
                            @forelse($groupFeatures as $feature)
                                @include('admin.features._feature_card', ['feature' => $feature, 'groupKey' => $groupKey])
                            @empty
                                <div class="col-span-12">
                                    <x-admin.alert variant="warning">Chưa có tính năng trong nhóm này.</x-admin.alert>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const featureToggleUrl = @json(route('admin.features.toggle'));
    const featureGroupToggleUrl = @json(route('admin.features.group-toggle'));
    const featureCsrfToken = @json(csrf_token());
    const featureMessages = {
        enabled: @json(__('admin.features.group_all_enabled')),
        partial: @json(__('admin.features.group_partially_enabled')),
        disabled: @json(__('admin.features.group_all_disabled')),
        enableGroup: @json(__('admin.features.enable_group')),
        disableGroup: @json(__('admin.features.disable_group')),
        groupError: @json(__('admin.features.group_update_error')),
    };

    function setFeatureUi(code, checked) {
        const badge = document.getElementById('badge-' + code);
        const badgeIcon = document.getElementById('badge-icon-' + code);
        const badgeText = document.getElementById('badge-text-' + code);
        const statusText = document.getElementById('status-text-' + code);
        if (!badge || !badgeIcon || !badgeText || !statusText) return;

        if (checked) {
            badge.className = 'absolute top-0 right-0 bg-emerald-500 text-white px-3 py-1 text-xs font-bold flex items-center gap-1 rounded-bl-xl';
            badgeIcon.className = 'ti ti-circle-check';
            badgeText.innerText = 'Đã kích hoạt';
            statusText.innerText = 'Hoạt động';
            statusText.className = 'text-xs font-bold text-emerald-600';
        } else {
            badge.className = 'absolute top-0 right-0 bg-gray-100 text-gray-400 px-3 py-1 text-xs font-bold flex items-center gap-1 rounded-bl-xl border-l border-b border-gray-200';
            badgeIcon.className = 'ti ti-circle-x';
            badgeText.innerText = 'Đang tắt';
            statusText.innerText = 'Tạm dừng';
            statusText.className = 'text-xs font-bold text-red-500';
        }
    }

    function refreshGroupState(group) {
        const switches = Array.from(document.querySelectorAll('[data-feature-switch][data-feature-group="' + group + '"]'));
        const groupSwitch = document.querySelector('[data-feature-group-switch="' + group + '"]');
        const status = document.getElementById('group-status-' + group);
        const action = document.getElementById('group-action-' + group);
        if (!groupSwitch || !status || !action) return;

        const enabledCount = switches.filter(input => input.checked).length;
        const allEnabled = switches.length > 0 && enabledCount === switches.length;
        const partiallyEnabled = enabledCount > 0 && !allEnabled;

        groupSwitch.checked = allEnabled;
        groupSwitch.indeterminate = partiallyEnabled;
        action.innerText = allEnabled ? featureMessages.disableGroup : featureMessages.enableGroup;
        status.innerText = allEnabled ? featureMessages.enabled : (partiallyEnabled ? featureMessages.partial : featureMessages.disabled);
        
        status.className = 'px-2.5 py-1 text-xs font-bold rounded-full ' + (allEnabled
            ? 'bg-emerald-100 text-emerald-805'
            : (partiallyEnabled ? 'bg-amber-100 text-amber-805' : 'bg-gray-150 text-gray-650'));
    }

    async function postFeatureState(url, payload) {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': featureCsrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });
        const data = await response.json().catch(() => ({}));
        if (!response.ok || !data.success) {
            throw new Error(data.message || 'Lỗi cập nhật tính năng.');
        }
        return data;
    }

    function toggleFeatureState(code, checked) {
        const input = document.getElementById('switch-' + code);
        const group = input?.dataset.featureGroup;
        const originalChecked = !checked;
        if (!input) return;

        input.disabled = true;
        setFeatureUi(code, checked);
        if (group) refreshGroupState(group);

        postFeatureState(featureToggleUrl, {
            feature_code: code,
            is_enabled: checked
        })
        .catch(err => {
            console.error(err);
            window.alert(err.message);
            input.checked = originalChecked;
            setFeatureUi(code, originalChecked);
            if (group) refreshGroupState(group);
        })
        .finally(() => {
            input.disabled = false;
        });
    }

    function toggleFeatureGroup(group, checked) {
        const groupSwitch = document.querySelector('[data-feature-group-switch="' + group + '"]');
        const switches = Array.from(document.querySelectorAll('[data-feature-switch][data-feature-group="' + group + '"]'));
        const originalStates = switches.map(input => ({ input, checked: input.checked }));

        groupSwitch.disabled = true;
        groupSwitch.indeterminate = false;
        switches.forEach(input => {
            input.disabled = true;
            input.checked = checked;
            setFeatureUi(input.id.replace('switch-', ''), checked);
        });
        refreshGroupState(group);

        postFeatureState(featureGroupToggleUrl, {
            group: group,
            is_enabled: checked
        })
        .catch(err => {
            console.error(err);
            window.alert(err.message || featureMessages.groupError);
            originalStates.forEach(item => {
                item.input.checked = item.checked;
                setFeatureUi(item.input.id.replace('switch-', ''), item.checked);
            });
            refreshGroupState(group);
        })
        .finally(() => {
            groupSwitch.disabled = false;
            switches.forEach(input => {
                input.disabled = false;
            });
        });
    }

    document.querySelectorAll('[data-feature-group-switch]').forEach(input => {
        refreshGroupState(input.dataset.featureGroupSwitch);
    });
</script>
@endpush
