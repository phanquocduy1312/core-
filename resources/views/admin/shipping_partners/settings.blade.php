@extends('admin.layouts.app')

@section('title', __('admin.shipping_partners.config_shipping_integration'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1">{{ __('admin.shipping_partners.setup_connection') }}</h4>
            <nav class="flex text-sm text-slate-300" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <a href="{{ route('admin.shipping-partners.index') }}" class="hover:text-white transition-colors">{{ __('admin.shipping_partners.title') }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.shipping_partners.setup_connection') }}: {{ $partner->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Settings Card -->
    <x-admin.card>
        <x-slot name="header">
            <div class="flex items-center gap-3">
                <div class="bg-gray-105 p-2 rounded-lg">
                    <iconify-icon icon="solar:delivery-line-duotone" class="text-2xl text-primary"></iconify-icon>
                </div>
                <div>
                    <h5 class="text-base font-bold text-gray-900">{{ __('admin.shipping_partners.setup_partner_config', ['name' => $partner->name]) }}</h5>
                    <p class="text-xs text-gray-500 mt-0.5">{{ __('admin.shipping_partners.connection_code') }}: {{ $partner->partner_code }} | {{ __('admin.shipping_partners.type') }}: {{ $partner->type === 'connected' ? __('admin.shipping_partners.api_connected') : __('admin.shipping_partners.self_delivery') }}</p>
                </div>
            </div>
        </x-slot>

        <form action="{{ route('admin.shipping-partners.update-settings', $partner) }}" method="POST">
            @csrf
            
            @if($partner->partner_code === 'DTGH000012') {{-- GHTK --}}
                @php
                    $apiToken = data_get($partner->settings, 'api_token', '');
                    $apiUrl = data_get($partner->settings, 'api_url', 'https://services.giaohangtietkiem.vn');
                    $webhookToken = data_get($partner->settings, 'webhook_token', '');
                    $realtimeTrackingEnabled = (bool) old('realtime_tracking_enabled', data_get($partner->settings, 'realtime_tracking_enabled', filled($webhookToken)));
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_token">API Token <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="api_token" name="api_token" 
                            value="{{ old('api_token', $apiToken) }}" placeholder="{{ __('admin.shipping_partners.api_token_ghtk_placeholder') }}" required>
                        <div class="mt-1.5 text-xs text-gray-550">{{ __('admin.shipping_partners.api_token_ghtk_hint') }}</div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_url">{{ __('admin.shipping_partners.api_url_label') }} <span class="text-red-500">*</span></label>
                        <select name="api_url" id="api_url" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" required>
                            <option value="https://services.giaohangtietkiem.vn" @selected($apiUrl === 'https://services.giaohangtietkiem.vn')>Production (services.giaohangtietkiem.vn)</option>
                            <option value="https://services.ghtk.vn" @selected($apiUrl === 'https://services.ghtk.vn')>Sandbox / Mock Environment (services.ghtk.vn)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900">Cập nhật trạng thái realtime</label>
                        <input type="hidden" name="realtime_tracking_enabled" value="0">
                        <div class="flex items-center pt-2">
                            <input class="w-9 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary cursor-pointer form-checkbox sr-only" type="checkbox" role="switch" id="ghtk_realtime_tracking" name="realtime_tracking_enabled" value="1" @checked($realtimeTrackingEnabled)>
                            <label for="ghtk_realtime_tracking" class="relative w-9 h-5 bg-gray-200 rounded-full peer-checked:bg-primary cursor-pointer after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full"></label>
                            <span class="ml-2 text-xs font-semibold text-gray-700">Nhận webhook trạng thái đơn từ GHTK</span>
                        </div>
                        <div class="mt-1.5 text-xs text-gray-550">Không cần bật để kết nối tài khoản và đẩy đơn sang GHTK.</div>
                    </div>
                    <div id="ghtk-webhook-settings" class="md:col-span-2 space-y-2" style="{{ ! $realtimeTrackingEnabled ? 'display: none;' : '' }}">
                        <label class="block text-sm font-semibold text-gray-900" for="ghtk_webhook_token">{{ __('admin.shipping_partners.webhook_token_label') }}</label>
                        <div class="flex">
                            <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-l-lg border border-r-0 border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="ghtk_webhook_token" name="webhook_token" 
                                value="{{ old('webhook_token', $webhookToken) }}" placeholder="Nhập token tự định nghĩa...">
                            <button class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-750 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-r-lg focus:outline-none transition-colors" type="button" onclick="generateWebhookToken()">
                                <iconify-icon icon="solar:refresh-linear" class="mr-1 text-base"></iconify-icon> {{ __('admin.shipping_partners.generate_random') }}
                            </button>
                        </div>
                    </div>
                    @php
                        $pickup = data_get($partner->settings, 'pickup', []);
                    @endphp
                    <div class="md:col-span-2 border-t border-gray-150 pt-4 mt-2">
                        <h6 class="text-sm font-bold text-gray-900 mb-4">Thông tin lấy hàng</h6>
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                            <div class="md:col-span-3">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="pickup_name">Tên người gửi <span class="text-red-500">*</span></label>
                                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="pickup_name" name="pickup_name" value="{{ old('pickup_name', data_get($pickup, 'name')) }}" required>
                            </div>
                            <div class="md:col-span-3">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="pickup_tel">Số điện thoại lấy hàng <span class="text-red-500">*</span></label>
                                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="pickup_tel" name="pickup_tel" value="{{ old('pickup_tel', data_get($pickup, 'tel')) }}" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="pickup_province">Tỉnh/Thành <span class="text-red-500">*</span></label>
                                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="pickup_province" name="pickup_province" value="{{ old('pickup_province', data_get($pickup, 'province')) }}" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="pickup_district">Quận/Huyện <span class="text-red-500">*</span></label>
                                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="pickup_district" name="pickup_district" value="{{ old('pickup_district', data_get($pickup, 'district')) }}" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="pickup_ward">Phường/Xã <span class="text-red-500">*</span></label>
                                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="pickup_ward" name="pickup_ward" value="{{ old('pickup_ward', data_get($pickup, 'ward')) }}" required>
                            </div>
                            <div class="md:col-span-6">
                                <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="pickup_address">Địa chỉ lấy hàng <span class="text-red-500">*</span></label>
                                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="pickup_address" name="pickup_address" value="{{ old('pickup_address', data_get($pickup, 'address')) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2" id="ghtk-webhook-url" style="{{ ! $realtimeTrackingEnabled ? 'display: none;' : '' }}">
                        <label class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.shipping_partners.webhook_url_label') }}</label>
                        <div class="flex">
                            <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-l-lg border border-r-0 border-gray-300 focus:outline-none font-mono text-dark" id="ghtk_webhook_url" 
                                value="{{ url('/api/webhooks/ghtk') }}" readonly>
                            <button class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-hover border border-primary rounded-r-lg focus:outline-none transition-colors" type="button" onclick="copyWebhookUrl()">
                                <iconify-icon icon="solar:copy-linear" class="mr-1 text-base"></iconify-icon> {{ __('admin.shipping_partners.copy') }}
                            </button>
                        </div>
                        <div class="mt-1.5 text-xs text-gray-550">{{ __('admin.shipping_partners.webhook_url_hint') }}</div>
                    </div>
                </div>
            @elseif($partner->partner_code === 'DTGH000013') {{-- GHN --}}
                @php
                    $apiToken = data_get($partner->settings, 'api_token', '');
                    $apiUrl = data_get($partner->settings, 'api_url', 'https://dev-online-gateway.ghn.vn');
                    $clientId = data_get($partner->settings, 'client_id', '');
                    $shopId = data_get($partner->settings, 'shop_id', '');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_token">API Token <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="api_token" name="api_token" 
                            value="{{ old('api_token', $apiToken) }}" placeholder="{{ __('admin.shipping_partners.api_token_ghn_placeholder') }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_url">{{ __('admin.shipping_partners.api_url_label') }} <span class="text-red-500">*</span></label>
                        <select name="api_url" id="api_url" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" required>
                            <option value="https://online-gateway.ghn.vn" @selected($apiUrl === 'https://online-gateway.ghn.vn')>Production (online-gateway.ghn.vn)</option>
                            <option value="https://dev-online-gateway.ghn.vn" @selected($apiUrl === 'https://dev-online-gateway.ghn.vn')>Sandbox / Dev Testing (dev-online-gateway.ghn.vn)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="shop_id">{{ __('admin.shipping_partners.shop_id_label') }} <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="shop_id" name="shop_id" 
                            value="{{ old('shop_id', $shopId) }}" placeholder="Nhập Shop ID...">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="client_id">{{ __('admin.shipping_partners.client_id_label') }}</label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="client_id" name="client_id" 
                            value="{{ old('client_id', $clientId) }}" placeholder="Nhập Client ID (nếu có)...">
                    </div>
                </div>
            @elseif($partner->partner_code === 'DTGH000014') {{-- J&T --}}
                @php
                    $customerid = data_get($partner->settings, 'customerid', '');
                    $key = data_get($partner->settings, 'key', '');
                    $eccompanyid = data_get($partner->settings, 'eccompanyid', '');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="customerid">{{ __('admin.shipping_partners.customer_id_jt_label') }} <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="customerid" name="customerid" 
                            value="{{ old('customerid', $customerid) }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="key">{{ __('admin.shipping_partners.secret_key_jt_label') }} <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="key" name="key" 
                            value="{{ old('key', $key) }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="eccompanyid">{{ __('admin.shipping_partners.ec_company_id_label') }} <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="eccompanyid" name="eccompanyid" 
                            value="{{ old('eccompanyid', $eccompanyid) }}" required>
                    </div>
                </div>
            @elseif($partner->partner_code === 'DTGH000015') {{-- SPX Express --}}
                @php
                    $apiToken = data_get($partner->settings, 'api_token', '');
                    $apiUrl = data_get($partner->settings, 'api_url', 'https://api.spx.vn');
                    $partnerId = data_get($partner->settings, 'partner_id', '');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_token">API Token / Partner Key <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="api_token" name="api_token" 
                            value="{{ old('api_token', $apiToken) }}" placeholder="{{ __('admin.shipping_partners.api_token_spx_placeholder') }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_url">{{ __('admin.shipping_partners.api_url_label') }} <span class="text-red-500">*</span></label>
                        <input type="url" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="api_url" name="api_url" 
                            value="{{ old('api_url', $apiUrl) }}" placeholder="Nhập API URL..." required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="partner_id">{{ __('admin.shipping_partners.partner_id_label') }}</label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="partner_id" name="partner_id" 
                            value="{{ old('partner_id', $partnerId) }}" placeholder="Nhập Partner ID...">
                    </div>
                </div>
            @elseif($partner->partner_code === 'DTGH000016') {{-- Viettel Post --}}
                @php
                    $apiToken = data_get($partner->settings, 'api_token', '');
                    $apiUrl = data_get($partner->settings, 'api_url', 'https://partner.viettelpost.vn');
                    $username = data_get($partner->settings, 'username', '');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_token">API Token / App Key <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="api_token" name="api_token" 
                            value="{{ old('api_token', $apiToken) }}" placeholder="{{ __('admin.shipping_partners.api_token_viettel_placeholder') }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_url">{{ __('admin.shipping_partners.api_url_label') }} <span class="text-red-500">*</span></label>
                        <input type="url" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="api_url" name="api_url" 
                            value="{{ old('api_url', $apiUrl) }}" placeholder="Nhập API URL..." required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="username">{{ __('admin.shipping_partners.username_label') }}</label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="username" name="username" 
                            value="{{ old('username', $username) }}" placeholder="Nhập số điện thoại hoặc email đăng ký...">
                    </div>
                </div>
            @elseif($partner->partner_code === 'DTGHTUGIAO') {{-- Flat Rate --}}
                @php
                    $fee = data_get($partner->settings, 'fee', 30000);
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="fee">{{ __('admin.shipping_partners.fee') }} <span class="text-red-500">*</span></label>
                        <input type="number" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="fee" name="fee" 
                            value="{{ old('fee', $fee) }}" min="0" required>
                    </div>
                </div>
            @endif

            <div class="mt-8 pt-4 border-t border-gray-150 flex gap-3">
                <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-primary hover:bg-primary-hover active:bg-primary-active focus:ring-primary px-5 py-2.5 text-sm">
                    <iconify-icon icon="solar:diskette-bold-duotone" class="mr-1.5 text-lg"></iconify-icon> {{ __('admin.shipping_partners.save_config') }}
                </button>
                <x-admin.button variant="outline" size="md" href="{{ route('admin.shipping-partners.index') }}">
                    {{ __('admin.shipping_partners.back') }}
                </x-admin.button>
            </div>
        </form>
    </x-admin.card>
@endsection

@push('scripts')
<script>
    function generateWebhookToken() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let token = '';
        for (let i = 0; i < 32; i++) {
            token += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('ghtk_webhook_token').value = token;
    }

    function toggleGhtkWebhookSettings() {
        const enabled = document.getElementById('ghtk_realtime_tracking').checked;
        const settingsEl = document.getElementById('ghtk-webhook-settings');
        const urlEl = document.getElementById('ghtk-webhook-url');
        if (settingsEl) settingsEl.style.display = enabled ? '' : 'none';
        if (urlEl) urlEl.style.display = enabled ? '' : 'none';
    }

    function copyWebhookUrl() {
        const copyText = document.getElementById("ghtk_webhook_url");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            icon: 'success',
            title: '{{ __('admin.shipping_partners.copied_notification') }}'
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const realtimeToggle = document.getElementById('ghtk_realtime_tracking');
        const webhookToken = document.getElementById('ghtk_webhook_token');
        if (!realtimeToggle || !webhookToken) return;

        realtimeToggle.addEventListener('change', toggleGhtkWebhookSettings);
        toggleGhtkWebhookSettings();
    });
</script>
@endpush
