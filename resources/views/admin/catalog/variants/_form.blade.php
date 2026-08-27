@php
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
    $selectedOptionIds = collect(old('option_value_ids', $variant->relationLoaded('optionValues') ? $variant->optionValues->modelKeys() : []))->map(fn ($id) => (int) $id)->all();
@endphp

@if($product->optionGroups->isEmpty())
    <div class="p-4 mb-6 text-sm text-amber-800 rounded-lg bg-amber-50 border border-amber-205 flex items-center justify-between" role="alert">
        <div class="flex items-center gap-2">
            <iconify-icon icon="solar:danger-triangle-bold" class="text-lg"></iconify-icon>
            <span>Sản phẩm chưa có thuộc tính. Hãy tạo Màu sắc, Kích thước, Dung lượng… trước khi tạo SKU.</span>
        </div>
        <x-admin.button variant="warning" size="xs" href="{{ route('admin.products.options.edit', $product) }}">
            Cấu hình thuộc tính
        </x-admin.button>
    </div>
@else
    <!-- Option Combinations Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
        <div class="mb-4">
            <h5 class="font-bold text-gray-900">Tổ hợp thuộc tính</h5>
            <p class="text-xs text-gray-500 mt-0.5">Chọn chính xác một giá trị cho mỗi nhóm. Hệ thống không cho phép tạo SKU trùng tổ hợp.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($product->optionGroups as $group)
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="option_group_{{ $group->id }}">{{ $group->name }}</label>
                    <select id="option_group_{{ $group->id }}" name="option_value_ids[]" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" required>
                        <option value="">Chọn {{ $group->name }}</option>
                        @foreach($group->values->where('is_active', true) as $value)
                            <option value="{{ $value->id }}" @selected(in_array($value->id, $selectedOptionIds, true))>
                                {{ $value->label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Variant Info Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
        <!-- Variant Name Localized Tabs -->
        <div x-data="{ activeLanguage: '{{ $defaultContentLocale }}' }" class="border border-gray-200 rounded-xl overflow-hidden bg-gray-50/20">
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
                            <label class="block mb-1.5 text-xs font-semibold text-gray-705">Tên hiển thị (tùy chọn)</label>
                            <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="variant_name_{{ $code }}" name="name[{{ $code }}]" value="{{ old("name.$code", $variant->getTranslation('name', $code, false)) }}" data-i18n-locale="{{ $code }}" data-i18n-field="name" placeholder="Để trống để tự lấy từ tổ hợp">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-6">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="sku">SKU <span class="text-red-500">*</span></label>
                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="sku" name="sku" value="{{ old('sku', $variant->sku) }}" required>
            </div>
            <div class="md:col-span-6">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="barcode">Mã vạch</label>
                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="barcode" name="barcode" value="{{ old('barcode', $variant->barcode) }}">
            </div>
            <div class="md:col-span-4">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="price">Giá bán (để trống dùng giá sản phẩm)</label>
                <input type="number" min="0" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="price" name="price" value="{{ old('price', $variant->price) }}">
            </div>
            <div class="md:col-span-4">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="compare_at_price">Giá niêm yết</label>
                <input type="number" min="0" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="compare_at_price" name="compare_at_price" value="{{ old('compare_at_price', $variant->compare_at_price) }}">
            </div>
            <div class="md:col-span-4">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="cost_price">Giá vốn</label>
                <input type="number" min="0" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="cost_price" name="cost_price" value="{{ old('cost_price', $variant->cost_price) }}">
            </div>
            <div class="md:col-span-4">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="stock_quantity">Tồn kho SKU <span class="text-red-500">*</span></label>
                <input type="number" min="0" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $variant->stock_quantity ?? 0) }}" required>
            </div>
            <div class="md:col-span-4">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="weight_grams">Khối lượng (gram)</label>
                <input type="number" min="0" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="weight_grams" name="weight_grams" value="{{ old('weight_grams', $variant->weight_grams) }}">
            </div>
            <div class="md:col-span-4">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="sort_order">Thứ tự</label>
                <input type="number" min="0" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="sort_order" name="sort_order" value="{{ old('sort_order', $variant->sort_order ?? 0) }}">
            </div>
            <div class="md:col-span-12">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="image_url">Ảnh riêng của SKU (URL)</label>
                <input type="url" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="image_url" name="image_url" value="{{ old('image_url', $variant->image_url) }}">
            </div>
            <div class="md:col-span-12 flex gap-6 pt-2">
                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $variant->is_active))>
                    <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_active">Đang kinh doanh</label>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="is_default" value="0">
                    <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_default" value="1" id="is_default" @checked(old('is_default', $variant->is_default))>
                    <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_default">SKU mặc định</label>
                </div>
            </div>
        </div>
    </div>

    @include('admin.shared.form-actions', ['cancelUrl' => route('admin.products.show', $product)])
    @include('admin.shared.translation-assets')
@endif
