@php
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
    $cancelUrl = route('admin.vouchers.index');
@endphp

<!-- Voucher Main Info Card -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
        <div class="md:col-span-12">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="code">{{ __('admin.vouchers.fields.code') }} <span class="text-red-500">*</span></label>
            <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors uppercase" id="code" name="code" value="{{ old('code', $voucher->code) }}" placeholder="{{ __('admin.vouchers.placeholders.code') }}" required>
        </div>
        
        <!-- Localized Tabs -->
        <div x-data="{ activeLanguage: '{{ $defaultContentLocale }}' }" class="md:col-span-12 border border-gray-200 rounded-xl overflow-hidden bg-gray-50/20">
            <!-- Language tab buttons -->
            <div class="border-b border-gray-200 bg-gray-50/50 px-4 pt-3 flex items-center justify-between">
                <nav class="-mb-px flex space-x-4 overflow-x-auto" aria-label="Languages">
                    @foreach($contentLanguages as $language)
                        <button type="button" @click="activeLanguage = '{{ $language->code }}'" 
                                :class="activeLanguage === '{{ $language->code }}' ? 'border-primary text-primary font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" 
                                class="whitespace-nowrap pb-3 px-1 border-b-2 font-semibold text-xs flex items-center gap-1 focus:outline-none transition-colors">
                            <iconify-icon icon="solar:global-linear" class="text-base"></iconify-icon>
                            <span>{{ $language->native_name }}</span>
                        </button>
                    @endforeach
                </nav>
            </div>
            <div class="p-4 bg-white">
                @foreach($contentLanguages as $language)
                    @php($code = $language->code)
                    <div x-show="activeLanguage === '{{ $code }}'" class="space-y-4">
                        @if($code !== $defaultContentLocale)
                            <div class="flex justify-end">
                                <button type="button" class="inline-flex items-center gap-1 py-1 px-2.5 text-2xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-md transition-colors focus:outline-none js-translate-locale" data-source-locale="{{ $defaultContentLocale }}" data-target-locale="{{ $code }}">
                                    Dịch {{ strtoupper($defaultContentLocale) }} → {{ strtoupper($code) }}
                                </button>
                            </div>
                        @endif
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.vouchers.fields.name') }} @if($code === $defaultContentLocale)<span class="text-red-500">*</span>@endif</label>
                            <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="voucher_name_{{ $code }}" name="name[{{ $code }}]" value="{{ old("name.$code", $voucher->getTranslation('name', $code, false)) }}" data-i18n-locale="{{ $code }}" data-i18n-field="name" @required($code === $defaultContentLocale)>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.vouchers.fields.description') }}</label>
                            <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="voucher_description_{{ $code }}" name="description[{{ $code }}]" rows="3" data-i18n-locale="{{ $code }}" data-i18n-field="description">{{ old("description.$code", $voucher->getTranslation('description', $code, false)) }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="md:col-span-6">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="type">{{ __('admin.vouchers.fields.type') }} <span class="text-red-500">*</span></label>
            <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="type" name="type" required>
                <option value="percentage" @selected(old('type', $voucher->type) === 'percentage')>{{ __('admin.vouchers.fields.percentage') }}</option>
                <option value="fixed" @selected(old('type', $voucher->type) === 'fixed')>{{ __('admin.vouchers.fields.fixed') }}</option>
            </select>
        </div>

        <div class="md:col-span-6">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="value">{{ __('admin.vouchers.fields.value') }} <span class="text-red-500">*</span></label>
            <input type="number" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="value" name="value" value="{{ old('value', $voucher->value) }}" placeholder="{{ __('admin.vouchers.placeholders.value') }}" required min="0">
        </div>

        <div class="md:col-span-6">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="min_order_amount">{{ __('admin.vouchers.fields.min_order_amount') }}</label>
            <input type="number" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="min_order_amount" name="min_order_amount" value="{{ old('min_order_amount', $voucher->min_order_amount ?? 0) }}" placeholder="0" min="0">
        </div>

        <div class="md:col-span-6">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="max_discount_amount">{{ __('admin.vouchers.fields.max_discount_amount') }}</label>
            <input type="number" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="max_discount_amount" name="max_discount_amount" value="{{ old('max_discount_amount', $voucher->max_discount_amount) }}" placeholder="{{ __('admin.vouchers.placeholders.max_discount') }}" min="0">
        </div>

        <div class="md:col-span-6">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="quantity">{{ __('admin.vouchers.fields.quantity') }}</label>
            <input type="number" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="quantity" name="quantity" value="{{ old('quantity', $voucher->quantity) }}" placeholder="{{ __('admin.vouchers.placeholders.quantity') }}" min="0">
        </div>

        <div class="md:col-span-6">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="per_user_limit">{{ __('admin.vouchers.fields.per_user_limit') }}</label>
            <input type="number" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="per_user_limit" name="per_user_limit" value="{{ old('per_user_limit', $voucher->per_user_limit) }}" placeholder="{{ __('admin.vouchers.placeholders.per_user_limit') }}" min="1">
        </div>

        <div class="md:col-span-6">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="start_date">{{ __('admin.vouchers.fields.start_date') }}</label>
            <input type="datetime-local" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="start_date" name="start_date" value="{{ old('start_date', $voucher->start_date ? $voucher->start_date->format('Y-m-d\TH:i') : '') }}">
        </div>

        <div class="md:col-span-6">
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="end_date">{{ __('admin.vouchers.fields.end_date') }}</label>
            <input type="datetime-local" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="end_date" name="end_date" value="{{ old('end_date', $voucher->end_date ? $voucher->end_date->format('Y-m-d\TH:i') : '') }}">
        </div>

        <div class="md:col-span-12 flex items-center pt-2">
            <input type="hidden" name="is_active" value="0">
            <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="1" id="is_active" @checked((bool) old('is_active', $voucher->is_active))>
            <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_active">Kích hoạt mã giảm giá</label>
        </div>
    </div>
</div>

@include('admin.shared.form-actions', ['cancelUrl' => $cancelUrl])
@include('admin.shared.translation-assets')
