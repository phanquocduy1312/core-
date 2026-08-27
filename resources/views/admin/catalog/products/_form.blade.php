@php
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
    $cancelUrl = $product->exists ? route('admin.products.show', $product) : route('admin.products.index');
@endphp

<div class="grid grid-cols-12 gap-6">
    <!-- Left Column: Product Details, Media, Pricing, Variants -->
    <div class="col-span-12 lg:col-span-8 space-y-6">
        <!-- General Information Card -->
        <div x-data="{ activeLanguage: '{{ $defaultContentLocale }}' }" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50 flex items-center justify-between">
                <h4 class="font-bold text-gray-900">{{ __('catalog.products.sections.general') }}</h4>
            </div>

            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 bg-gray-50/20 px-6 pt-3">
                <nav class="-mb-px flex space-x-6 overflow-x-auto" aria-label="Languages">
                    @foreach($contentLanguages as $language)
                        <button type="button" @click="activeLanguage = '{{ $language->code }}'" 
                                :class="activeLanguage === '{{ $language->code }}' ? 'border-primary text-primary font-bold' : 'border-transparent text-gray-550 hover:text-gray-700 hover:border-gray-300'" 
                                class="whitespace-nowrap pb-3 px-1 border-b-2 font-semibold text-sm flex items-center gap-2 focus:outline-none transition-colors">
                            <iconify-icon icon="solar:global-linear" class="text-lg"></iconify-icon>
                            <span>{{ $language->native_name }}</span>
                        </button>
                    @endforeach
                </nav>
            </div>

            <div class="p-6">
                @foreach($contentLanguages as $language)
                    @php
                        $code = $language->code;
                        $name = old("name.$code", $product->getTranslation('name', $code, false));
                        $slug = old("slug.$code", $product->localizedSlug($code) ?: ($code === $defaultContentLocale ? $product->slug : ''));
                        $shortDescription = old("short_description.$code", $product->getTranslation('short_description', $code, false));
                        $description = old("description.$code", $product->getTranslation('description', $code, false));
                        $metaTitle = old("meta_title.$code", $product->getTranslation('meta_title', $code, false));
                        $metaDescription = old("meta_description.$code", $product->getTranslation('meta_description', $code, false));
                    @endphp
                    <div x-show="activeLanguage === '{{ $code }}'" class="space-y-6">
                        @if($code !== $defaultContentLocale)
                            <div class="flex justify-end">
                                <button type="button" class="inline-flex items-center gap-1.5 py-1.5 px-3 text-xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors focus:outline-none js-translate-locale" data-source-locale="{{ $defaultContentLocale }}" data-target-locale="{{ $code }}">
                                    <iconify-icon icon="solar:global-linear" class="text-sm"></iconify-icon>
                                    Dịch {{ strtoupper($defaultContentLocale) }} → {{ strtoupper($code) }}
                                </button>
                            </div>
                        @endif

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900" for="name_{{ $code }}">
                                    {{ __('catalog.fields.name') }} @if($code === $defaultContentLocale)<span class="text-red-500">*</span>@endif
                                </label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="name_{{ $code }}" name="name[{{ $code }}]" value="{{ $name }}" data-i18n-locale="{{ $code }}" data-i18n-field="name" @required($code === $defaultContentLocale)>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-900" for="slug_{{ $code }}">{{ __('catalog.fields.slug') }}</label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="slug_{{ $code }}" name="slug[{{ $code }}]" value="{{ $slug }}" data-i18n-locale="{{ $code }}" data-i18n-field="slug">
                                <p class="text-xs text-gray-400 mt-1">Để trống để tự tạo từ tên {{ strtoupper($code) }}.</p>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900" for="short_description_{{ $code }}">{{ __('catalog.fields.short_description') }}</label>
                                <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="short_description_{{ $code }}" name="short_description[{{ $code }}]" rows="3" data-i18n-locale="{{ $code }}" data-i18n-field="short_description">{{ $shortDescription }}</textarea>
                            </div>
                            <div class="relative" @if($code === $defaultContentLocale) id="editor_wrapper" @endif>
                                <label class="block mb-2 text-sm font-semibold text-gray-900" for="description_{{ $code }}">{{ __('catalog.fields.description') }}</label>
                                <textarea class="hidden" id="description_{{ $code }}" name="description[{{ $code }}]" data-i18n-locale="{{ $code }}" data-i18n-field="description" data-translation-format="html">{{ $description }}</textarea>
                                <div class="rounded-lg border border-gray-300 overflow-hidden">
                                    <div id="description_editor_{{ $code }}" class="catalog-quill min-h-[320px]" data-target="description_{{ $code }}">{!! app(\App\Support\HtmlSanitizer::class)->clean($description) !!}</div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Sub-Card -->
                        <div class="border border-gray-200 rounded-xl p-4 bg-gray-50/50">
                            <h5 class="font-bold text-gray-900 mb-3">{{ __('catalog.fields.seo') }}</h5>
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="meta_title_{{ $code }}">{{ __('catalog.fields.meta_title') }}</label>
                                    <input type="text" maxlength="255" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="meta_title_{{ $code }}" name="meta_title[{{ $code }}]" value="{{ $metaTitle }}" data-i18n-locale="{{ $code }}" data-i18n-field="meta_title">
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="meta_description_{{ $code }}">{{ __('catalog.fields.meta_description') }}</label>
                                    <textarea maxlength="500" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="meta_description_{{ $code }}" name="meta_description[{{ $code }}]" rows="3" data-i18n-locale="{{ $code }}" data-i18n-field="meta_description">{{ $metaDescription }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Media Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h4 class="font-bold text-gray-900 mb-4">{{ __('catalog.products.sections.media') }}</h4>
            <div class="dropzone dz-clickable mb-4 catalog-dropzone border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors">
                <div class="dz-default dz-message text-center">
                    <button class="dz-button font-semibold text-gray-550" type="button">{{ __('catalog.products.dropzone.media') }}</button>
                </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="image_url_input">{{ __('catalog.fields.image_url') }}</label>
                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="image_url_input" name="image_url" value="{{ old('image_url', $product->image_url) }}" placeholder="{{ __('catalog.placeholders.product_image_url') }}">
            </div>
        </div>

        @php
            $variantGroups = old('variant_groups');
            if ($variantGroups === null && $product->exists) {
                $variantGroups = $product->optionGroups->map(fn ($group) => [
                    'id' => $group->id,
                    'name' => $group->name,
                    'display_type' => $group->display_type,
                    'values' => $group->values->map(fn ($value) => [
                        'id' => $value->id,
                        'label' => $value->label,
                        'color_hex' => $value->color_hex,
                        'image_url' => $value->image_url,
                        'is_active' => $value->is_active,
                    ])->all(),
                ])->all();
            }
            $variantGroups ??= [];
            $hasVariants = (bool) old('has_variants', ! empty($variantGroups));
        @endphp

        <!-- Variants Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h4 class="font-bold text-gray-900">Biến thể & SKU</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Khai báo hoặc chỉnh sửa nhóm như Màu sắc, Kích thước. Khi lưu, core tạo ngay các tổ hợp SKU còn thiếu.</p>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="has_variants" value="0">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="has_variants" value="1" id="has_variants" class="sr-only peer" @checked($hasVariants)>
                        <div class="w-11 h-6 bg-gray-205 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        <span class="ml-2 text-sm font-semibold text-gray-900">Có biến thể</span>
                    </label>
                </div>
            </div>

            <div id="create-variant-setup" class="space-y-4 @if(!$hasVariants) hidden @endif">
                <div id="create-variant-groups" class="space-y-4">
                    @foreach($variantGroups as $groupIndex => $group)
                        <div class="border border-gray-200 rounded-xl p-4 bg-white space-y-4 create-variant-group" data-group-index="{{ $groupIndex }}">
                            @if(data_get($group, 'id'))
                                <input type="hidden" name="variant_groups[{{ $groupIndex }}][id]" value="{{ data_get($group, 'id') }}">
                            @endif
                            <div class="grid grid-cols-12 gap-4 items-end">
                                <div class="col-span-12 md:col-span-6">
                                    <label class="block mb-1.5 text-xs font-semibold text-gray-700">Tên nhóm</label>
                                    <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" name="variant_groups[{{ $groupIndex }}][name]" value="{{ data_get($group, 'name') }}" required>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="block mb-1.5 text-xs font-semibold text-gray-705">Kiểu hiển thị</label>
                                    <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" name="variant_groups[{{ $groupIndex }}][display_type]">
                                        <option value="select" @selected(data_get($group, 'display_type', 'select') === 'select')>Danh sách</option>
                                        <option value="color" @selected(data_get($group, 'display_type') === 'color')>Màu sắc</option>
                                        <option value="image" @selected(data_get($group, 'display_type') === 'image')>Ảnh</option>
                                    </select>
                                </div>
                                <div class="col-span-12 md:col-span-2">
                                    <button type="button" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-2.5 text-sm remove-create-group">Xóa nhóm</button>
                                </div>
                            </div>
                            <div class="create-variant-values space-y-3">
                                @foreach(data_get($group, 'values', []) as $valueIndex => $value)
                                    <div class="grid grid-cols-12 gap-3 items-end p-3 bg-gray-50 rounded-lg create-variant-value">
                                        @if(data_get($value, 'id'))
                                            <input type="hidden" name="variant_groups[{{ $groupIndex }}][values][{{ $valueIndex }}][id]" value="{{ data_get($value, 'id') }}">
                                        @endif
                                        <div class="col-span-12 md:col-span-4">
                                            <label class="block mb-1 text-xs font-semibold text-gray-700">Giá trị</label>
                                            <input class="block w-full p-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" name="variant_groups[{{ $groupIndex }}][values][{{ $valueIndex }}][label]" value="{{ data_get($value, 'label') }}" required>
                                        </div>
                                        <div class="col-span-12 md:col-span-2">
                                            <label class="block mb-1 text-xs font-semibold text-gray-700">Mã màu</label>
                                            <input class="block w-full p-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" name="variant_groups[{{ $groupIndex }}][values][{{ $valueIndex }}][color_hex]" value="{{ data_get($value, 'color_hex') }}" placeholder="#FFFFFF">
                                        </div>
                                        <div class="col-span-12 md:col-span-4">
                                            <label class="block mb-1 text-xs font-semibold text-gray-700">Ảnh URL</label>
                                            <input type="url" class="block w-full p-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" name="variant_groups[{{ $groupIndex }}][values][{{ $valueIndex }}][image_url]" value="{{ data_get($value, 'image_url') }}">
                                        </div>
                                        <div class="col-span-6 md:col-span-1 flex items-center justify-center pb-2">
                                            <input type="hidden" name="variant_groups[{{ $groupIndex }}][values][{{ $valueIndex }}][is_active]" value="0">
                                            <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="variant_groups[{{ $groupIndex }}][values][{{ $valueIndex }}][is_active]" value="1" @checked(data_get($value, 'is_active', true))>
                                            <span class="ml-1 text-xs font-semibold text-gray-700">Bật</span>
                                        </div>
                                        <div class="col-span-6 md:col-span-1">
                                            <button type="button" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-2 text-sm remove-create-value">&times;</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="inline-flex items-center gap-1 py-1.5 px-3 text-xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors focus:outline-none add-create-value">+ Thêm giá trị</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-create-group" class="inline-flex items-center gap-2 py-2 px-4 text-sm font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors focus:outline-none">+ Thêm nhóm thuộc tính</button>
            </div>
        </div>

        <!-- Pricing Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h4 class="font-bold text-gray-900 mb-4">{{ __('catalog.products.sections.pricing') }}</h4>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="price">{{ __('catalog.fields.price') }} <span class="text-red-505">*</span></label>
                <input type="number" min="0" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="price" name="price" value="{{ old('price', $product->price ?? 0) }}" placeholder="{{ __('catalog.placeholders.product_price') }}" required>
                <p class="text-xs text-gray-400 mt-1">{{ __('catalog.products.help.price') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="compare_at_price">{{ __('catalog.fields.compare_at_price') }}</label>
                    <input type="number" min="0" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="compare_at_price" name="compare_at_price" value="{{ old('compare_at_price', $product->compare_at_price) }}" placeholder="{{ __('catalog.placeholders.product_compare_at_price') }}">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900" for="cost_price">{{ __('catalog.fields.cost_price') }}</label>
                    <input type="number" min="0" step="0.01" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="cost_price" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" placeholder="{{ __('catalog.placeholders.product_cost_price') }}">
                </div>
            </div>
        </div>

        @include('admin.shared.form-actions', ['cancelUrl' => $cancelUrl])
    </div>

    <!-- Right Column: Thumbnail, Status, Product Details -->
    <div class="col-span-12 lg:col-span-4 space-y-6">
        <!-- Thumbnail Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h4 class="font-bold text-gray-900 mb-4">{{ __('catalog.products.sections.thumbnail') }}</h4>
            
            <input type="file" name="image_file" id="product_image_file" class="hidden" accept="image/*" data-media-folder="products">
            
            <!-- Styled image preview area -->
            <div id="product_image_preview_container" class="relative text-center border-2 border-dashed border-gray-300 rounded-xl p-4 mb-4 cursor-pointer flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors" 
                 style="min-height: 180px;" 
                 onclick="document.getElementById('product_image_file').click()">
                
                <img id="product_image_preview" src="{{ old('image_url', $product->image_url) }}" 
                     class="max-w-full rounded-lg max-h-[150px] object-contain {{ old('image_url', $product->image_url) ? '' : 'hidden' }}">
                
                <div id="product_image_placeholder" class="text-center py-3 {{ old('image_url', $product->image_url) ? 'hidden' : '' }}">
                    <iconify-icon icon="solar:camera-add-bold-duotone" class="text-5xl text-gray-400 mb-2"></iconify-icon>
                    <div class="text-xs text-gray-500">Kéo thả ảnh hoặc nhấp để chọn ảnh</div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="image_url">{{ __('catalog.fields.image_url') }}</label>
                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="image_url" name="image_url" value="{{ old('image_url', $product->image_url) }}" placeholder="{{ __('catalog.placeholders.product_image_url') }}">
            </div>
            <p class="text-2xs text-gray-400 text-center">{{ __('catalog.products.help.thumbnail') }}</p>
        </div>

        <!-- Status Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-gray-900">{{ __('catalog.products.sections.status') }}</h4>
                <div class="w-2.5 h-2.5 {{ old('is_active', $product->is_active) ? 'bg-emerald-500' : 'bg-red-500' }} rounded-full"></div>
            </div>
            <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none mb-3" name="is_active">
                <option value="1" @selected((string) old('is_active', $product->is_active) === '1')>{{ __('catalog.status.active') }}</option>
                <option value="0" @selected((string) old('is_active', $product->is_active) === '0')>{{ __('catalog.status.inactive') }}</option>
            </select>
            <p class="text-2xs text-gray-400">{{ __('catalog.products.help.status') }}</p>
        </div>

        <!-- Product Classification Details Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-4">
            <h4 class="font-bold text-gray-900 border-b border-gray-100 pb-2">{{ __('catalog.products.sections.product_details') }}</h4>
            
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="category_id">{{ __('catalog.fields.category') }}</label>
                <select class="catalog-select2 block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="category_id" name="category_id">
                    <option value="">{{ __('catalog.common.none') }}</option>
                    @foreach($categoryOptions as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id) === (string) $category->id)>
                            {!! str_repeat('&nbsp;&nbsp;', $category->depth ?? 0) !!}{{ $category->depth ? '↳ ' : '' }}{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-2xs text-gray-400 mt-1">{{ __('catalog.products.help.category') }}</p>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="brand_id">{{ __('catalog.fields.brand') }}</label>
                <select class="catalog-select2 block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="brand_id" name="brand_id">
                    <option value="">{{ __('catalog.common.none') }}</option>
                    @foreach($brandOptions as $brandOption)
                        @php
                            $brandName = $brandOption->getTranslation('name', app()->getLocale(), false) ?: $brandOption->name;
                        @endphp
                        <option value="{{ $brandOption->id }}" @selected((string) old('brand_id', $product->brand_id) === (string) $brandOption->id)>
                            {{ $brandName }}
                        </option>
                    @endforeach
                </select>
                <p class="text-2xs text-gray-400 mt-1">{{ __('catalog.products.help.brand') }}</p>
            </div>

            <div class="grid grid-cols-2 gap-3 pt-2">
                <x-admin.button variant="outline" size="sm" href="{{ route('admin.categories.create') }}" class="w-full text-center">
                    + Category
                </x-admin.button>
                <x-admin.button variant="outline" size="sm" href="{{ route('admin.brands.create') }}" class="w-full text-center">
                    + Brand
                </x-admin.button>
            </div>

            <hr class="border-gray-100 my-4">

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="sku">{{ __('catalog.fields.sku') }}</label>
                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" placeholder="{{ __('catalog.placeholders.product_sku') }}">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="stock_quantity">{{ __('catalog.fields.stock_quantity') }}</label>
                <input type="number" min="0" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" placeholder="{{ __('catalog.placeholders.product_stock_quantity') }}">
            </div>

            <div class="space-y-3 pt-2">
                <div class="flex items-center">
                    <input type="hidden" name="manage_stock" value="0">
                    <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="manage_stock" value="1" id="manage_stock" @checked(old('manage_stock', $product->manage_stock))>
                    <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer flex items-center" for="manage_stock">
                        {{ __('catalog.fields.manage_stock') }}
                        <iconify-icon icon="solar:question-circle-linear" class="ml-1 text-gray-400 text-base" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('catalog.products.help.manage_stock') }}" style="cursor: pointer;"></iconify-icon>
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_featured" value="0">
                    <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured', $product->is_featured))>
                    <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_featured">{{ __('catalog.fields.is_featured') }}</label>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.shared.translation-assets')

<!-- Unsaved Changes Modal -->
<div class="modal fade" id="unsavedChangesModal" tabindex="-1" aria-labelledby="unsavedChangesModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content overflow-hidden rounded-xl border border-gray-200 shadow-xl">
            <div class="px-6 py-4 border-b border-warning bg-warning-subtle flex items-center gap-2">
                <iconify-icon icon="solar:danger-triangle-bold" class="text-xl text-amber-500"></iconify-icon>
                <h5 class="modal-title font-bold text-gray-900" id="unsavedChangesModalLabel">
                    {{ __('catalog.unsaved.title') }}
                </h5>
            </div>
            <div class="p-6 text-sm text-gray-600 leading-relaxed">
                {{ __('catalog.unsaved.body') }}
            </div>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-between">
                <button type="button" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-4 py-2 text-sm" data-bs-dismiss="modal">{{ __('catalog.actions.cancel') }}</button>
                <div class="flex gap-2">
                    <button type="button" id="btn-discard-changes" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm">{{ __('catalog.unsaved.discard') }}</button>
                    <button type="button" id="btn-save-draft" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 text-sm">{{ __('catalog.unsaved.save_draft') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
