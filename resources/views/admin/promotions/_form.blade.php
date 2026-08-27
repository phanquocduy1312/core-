@php
    $selectedProductIds = collect(old('target_product_ids', $promotion->relationLoaded('targets') ? $promotion->targets->whereNull('product_variant_id')->pluck('product_id')->all() : []))->map(fn ($id) => (int) $id)->all();
    $selectedVariantIds = collect(old('target_variant_ids', $promotion->relationLoaded('targets') ? $promotion->targets->whereNotNull('product_variant_id')->pluck('product_variant_id')->all() : []))->map(fn ($id) => (int) $id)->all();
    $savedTargetLimits = $promotion->relationLoaded('targets')
        ? $promotion->targets->pluck('quantity_limit')->filter()->unique()->values()
        : collect();
    $targetQuantityLimit = old('target_quantity_limit', $savedTargetLimits->count() === 1 ? $savedTargetLimits->first() : null);
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
@endphp

<!-- Promotion Main Card -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
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
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                            <div class="md:col-span-12">
                                <label class="block mb-2 text-sm font-semibold text-gray-900">Tên chương trình @if($code === $defaultContentLocale)<span class="text-red-500">*</span>@endif</label>
                                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="promotion_name_{{ $code }}" name="name[{{ $code }}]" value="{{ old("name.$code", $promotion->getTranslation('name', $code, false)) }}" data-i18n-locale="{{ $code }}" data-i18n-field="name" @required($code === $defaultContentLocale)>
                            </div>
                            <div class="md:col-span-12">
                                <label class="block mb-2 text-sm font-semibold text-gray-900">Mô tả</label>
                                <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="promotion_description_{{ $code }}" name="description[{{ $code }}]" rows="2" data-i18n-locale="{{ $code }}" data-i18n-field="description">{{ old("description.$code", $promotion->getTranslation('description', $code, false)) }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Loại *</label>
            <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="kind">
                <option value="automatic" @selected(old('kind', $promotion->kind) === 'automatic')>Khuyến mãi tự động</option>
                <option value="flash_sale" @selected(old('kind', $promotion->kind) === 'flash_sale')>Flash Sale</option>
            </select>
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Cách giảm *</label>
            <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="discount_type">
                <option value="percentage" @selected(old('discount_type', $promotion->discount_type) === 'percentage')>Phần trăm</option>
                <option value="fixed_amount" @selected(old('discount_type', $promotion->discount_type) === 'fixed_amount')>Trừ tiền/SKU</option>
                <option value="fixed_price" @selected(old('discount_type', $promotion->discount_type) === 'fixed_price')>Giá chốt/SKU</option>
            </select>
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Giá trị *</label>
            <input type="number" step="0.01" min="0" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="value" value="{{ old('value', $promotion->value) }}" required>
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Ưu tiên (số lớn ưu tiên trước)</label>
            <input type="number" min="0" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="priority" value="{{ old('priority', $promotion->priority) }}">
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Mua tối thiểu</label>
            <input type="number" min="1" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="min_quantity" value="{{ old('min_quantity', $promotion->min_quantity ?? 1) }}">
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Tổng suất campaign (trống = không giới hạn)</label>
            <input type="number" min="1" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="quantity_limit" value="{{ old('quantity_limit', $promotion->quantity_limit) }}">
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Suất cho mỗi mục tiêu</label>
            <input type="number" min="1" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="target_quantity_limit" value="{{ $targetQuantityLimit }}" placeholder="Dùng cho Flash Sale SKU">
            <p class="text-2xs text-gray-400 mt-1">Lưu sẽ áp dụng cùng quota cho các mục tiêu đã chọn.</p>
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Bắt đầu</label>
            <input type="datetime-local" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="start_at" value="{{ old('start_at', $promotion->start_at?->format('Y-m-d\TH:i')) }}">
        </div>

        <div class="md:col-span-4">
            <label class="block mb-2 text-sm font-semibold text-gray-900">Kết thúc</label>
            <input type="datetime-local" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="end_at" value="{{ old('end_at', $promotion->end_at?->format('Y-m-d\TH:i')) }}">
        </div>

        <!-- Scope -->
        <div class="md:col-span-12 border-t border-gray-150 pt-4 mt-2">
            <h5 class="font-bold text-gray-900 mb-3">Phạm vi áp dụng</h5>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-4">
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="applies_to_select">Áp dụng cho</label>
                    <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" id="applies_to_select" name="applies_to">
                        <option value="selected" @selected(old('applies_to', $promotion->applies_to) === 'selected')>Sản phẩm / SKU được chọn</option>
                        <option value="all_products" @selected(old('applies_to', $promotion->applies_to) === 'all_products')>Toàn bộ sản phẩm</option>
                    </select>
                </div>
                <div class="md:col-span-4" id="target_products_col">
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="target_product_ids">Sản phẩm</label>
                    <select class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:outline-none select2-multiple" id="target_product_ids" name="target_product_ids[]" multiple="multiple" data-placeholder="Tìm & chọn sản phẩm...">
                        @foreach($products as $productOption)
                            <option value="{{ $productOption->id }}" @selected(in_array($productOption->id, $selectedProductIds, true))>{{ $productOption->name }}{{ $productOption->sku ? ' — '.$productOption->sku : '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-4" id="target_variants_col">
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="target_variant_ids">SKU biến thể cụ thể</label>
                    <select class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:outline-none select2-multiple" id="target_variant_ids" name="target_variant_ids[]" multiple="multiple" data-placeholder="Tìm & chọn SKU biến thể...">
                        @foreach($variants as $variantOption)
                            <option value="{{ $variantOption->id }}" @selected(in_array($variantOption->id, $selectedVariantIds, true))>{{ $variantOption->product?->name ? $variantOption->product->name . ' — ' : '' }}{{ $variantOption->name }}{{ $variantOption->sku ? ' ('.$variantOption->sku.')' : '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <p class="text-2xs text-gray-400 mt-2">Nếu chọn sản phẩm thì áp dụng cho toàn bộ SKU của sản phẩm. Chọn SKU khi muốn chạy flash sale riêng từng biến thể.</p>
        </div>

        <div class="md:col-span-12 flex items-start gap-4 pt-2">
            <div class="flex items-center shrink-0">
                <input type="hidden" name="is_active" value="0">
                <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $promotion->is_active))>
                <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_active">Kích hoạt</label>
            </div>
            <span class="text-2xs text-gray-400 mt-0.5 leading-normal">
                Mỗi SKU nhận campaign có ưu tiên cao nhất; nếu bằng nhau sẽ lấy giá sau giảm thấp nhất. Mã giảm giá được tính tiếp trên giá đã khuyến mãi.
            </span>
        </div>
    </div>
</div>

@include('admin.shared.form-actions', ['cancelUrl' => route('admin.promotions.index')])
@include('admin.shared.translation-assets')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin-assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        (function() {
            function initPromotionsForm() {
                if (window.jQuery && jQuery().select2) {
                    $('.select2-multiple').select2({
                        placeholder: function() {
                            return $(this).data('placeholder') || 'Chọn...';
                        },
                        allowClear: true,
                        width: '100%'
                    });
                }

                const appliesToSelect = document.getElementById('applies_to_select');
                const targetProductsCol = document.getElementById('target_products_col');
                const targetVariantsCol = document.getElementById('target_variants_col');

                function toggleScopeFields() {
                    if (!appliesToSelect) return;
                    const isSelected = appliesToSelect.value === 'selected';
                    if (targetProductsCol) targetProductsCol.style.display = isSelected ? 'block' : 'none';
                    if (targetVariantsCol) targetVariantsCol.style.display = isSelected ? 'block' : 'none';
                }

                if (appliesToSelect) {
                    appliesToSelect.removeEventListener('change', toggleScopeFields);
                    appliesToSelect.addEventListener('change', toggleScopeFields);
                    toggleScopeFields();
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initPromotionsForm);
            } else {
                initPromotionsForm();
            }
        })();
    </script>
@endpush
