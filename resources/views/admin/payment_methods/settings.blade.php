@extends('admin.layouts.app')

@section('title', __('admin.payment_methods.config_shipping_integration'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1">{{ __('admin.payment_methods.setup_connection') }}</h4>
            <nav class="flex text-sm text-slate-300" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <a href="{{ route('admin.payment-methods.index') }}" class="hover:text-white transition-colors">{{ __('admin.payment_methods.title') }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.payment_methods.setup_connection') }}: {{ $method->name }}</span>
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
                    <iconify-icon icon="solar:card-recive-line-duotone" class="text-2xl text-primary"></iconify-icon>
                </div>
                <div>
                    <h5 class="text-base font-bold text-gray-900">{{ __('admin.payment_methods.setup_partner_config', ['name' => $method->name]) }}</h5>
                    <p class="text-xs text-gray-500 mt-0.5">{{ __('admin.payment_methods.connection_code') }}: {{ $method->method_code }} | {{ __('admin.payment_methods.type') }}: {{ $method->type === 'connected' ? __('admin.payment_methods.api_connected') : __('admin.payment_methods.self_delivery') }}</p>
                </div>
            </div>
        </x-slot>

        <form action="{{ route('admin.payment-methods.update-settings', $method) }}" method="POST">
            @csrf
            
            @if($method->method_code === 'stripe')
                @php
                    $publishableKey = data_get($method->settings, 'publishable_key', '');
                    $secretKey = data_get($method->settings, 'secret_key', '');
                    $webhookSecret = data_get($method->settings, 'webhook_secret', '');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="publishable_key">Publishable Key <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="publishable_key" name="publishable_key" 
                            value="{{ old('publishable_key', $publishableKey) }}" placeholder="pk_live_... / pk_test_..." required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="secret_key">Secret Key <span class="text-red-500">*</span></label>
                        <input type="password" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="secret_key" name="secret_key" 
                            value="{{ old('secret_key', $secretKey) }}" placeholder="sk_live_... / sk_test_..." required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="webhook_secret">Webhook Signing Secret</label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="webhook_secret" name="webhook_secret" 
                            value="{{ old('webhook_secret', $webhookSecret) }}" placeholder="whsec_...">
                    </div>
                </div>
            @elseif($method->method_code === 'sepay')
                @php
                    $apiKey = data_get($method->settings, 'api_key', '');
                @endphp
                <div class="space-y-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="api_key">API Key <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="api_key" name="api_key" 
                            value="{{ old('api_key', $apiKey) }}" placeholder="Nhập Sepay API Key" required>
                    </div>
                    <x-admin.alert variant="warning">{{ __('admin.payment_methods.integration_unavailable') }}</x-admin.alert>
                </div>
            @elseif($method->method_code === 'bank_transfer')
                @php
                    $bankName = data_get($method->settings, 'bank_name', '');
                    $accountNumber = data_get($method->settings, 'account_number', '');
                    $accountHolder = data_get($method->settings, 'account_holder', '');
                    $instructions = data_get($method->settings, 'instructions', '');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="bank_name">Tên ngân hàng <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="bank_name" name="bank_name" 
                            value="{{ old('bank_name', $bankName) }}" placeholder="Ví dụ: Vietcombank, MB Bank..." required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="account_number">Số tài khoản <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="account_number" name="account_number" 
                            value="{{ old('account_number', $accountNumber) }}" placeholder="Nhập số tài khoản" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="account_holder">Tên chủ tài khoản <span class="text-red-500">*</span></label>
                        <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="account_holder" name="account_holder" 
                            value="{{ old('account_holder', $accountHolder) }}" placeholder="Ví dụ: NGUYEN VAN A" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="instructions">Hướng dẫn chuyển khoản</label>
                        <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="instructions" name="instructions" rows="4" 
                            placeholder="Ghi chú các bước chuyển khoản hoặc thông tin lưu ý cho khách hàng...">{{ old('instructions', $instructions) }}</textarea>
                    </div>
                </div>
            @elseif($method->method_code === 'cod' || $method->type === 'custom')
                @php
                    $description = data_get($method->settings, 'description', '');
                @endphp
                <div class="space-y-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-900" for="description">{{ __('admin.payment_methods.fee') }} <span class="text-red-500">*</span></label>
                        <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors text-dark" id="description" name="description" rows="4" 
                            placeholder="Hướng dẫn hoặc mô tả cho khách hàng..." required>{{ old('description', $description) }}</textarea>
                    </div>
                </div>
            @endif

            <div class="mt-8 pt-4 border-t border-gray-150 flex gap-3">
                <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-primary hover:bg-primary-hover active:bg-primary-active focus:ring-primary px-5 py-2.5 text-sm">
                    <iconify-icon icon="solar:diskette-bold-duotone" class="mr-1.5 text-lg"></iconify-icon> {{ __('admin.payment_methods.save_config') }}
                </button>
                <x-admin.button variant="outline" size="md" href="{{ route('admin.payment-methods.index') }}">
                    {{ __('admin.payment_methods.back') }}
                </x-admin.button>
            </div>
        </form>
    </x-admin.card>
@endsection
