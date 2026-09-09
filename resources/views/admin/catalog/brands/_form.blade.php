@php
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
@endphp

<div x-data="{ 
    activeLanguage: '{{ $defaultContentLocale }}',
    country: '{{ addslashes(old('country', $brand->country ?? '')) }}',
    websiteUrl: '{{ addslashes(old('website_url', $brand->website_url ?? '')) }}',
    showcaseTab: '{{ old('showcase_image') ? 'url' : 'file' }}',
    logoTab: '{{ old('image_url') ? 'url' : 'file' }}',
    removeShowcase: false,
    removeLogo: false,
    setCountry(val) {
        this.country = val;
        const el = document.getElementById('country');
        if (el) { el.value = val; el.dispatchEvent(new Event('input')); }
    }
}" class="space-y-6">

    <!-- Card 1: Thông tin thương hiệu & Giới thiệu -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden">
        <!-- Card Header -->
        <div class="px-6 py-4 bg-gray-50/70 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-gray-900 text-base flex items-center gap-2">
                    <iconify-icon icon="solar:document-text-bold" class="text-primary text-lg"></iconify-icon>
                    <span>Thông tin thương hiệu & Giới thiệu</span>
                </h3>
                <p class="text-xs text-gray-500 mt-0.5">Tên thương hiệu, đường dẫn và phần mô tả tóm tắt ở mặt sau thẻ flip-box</p>
            </div>

            <!-- Language Switcher -->
            @if(count($contentLanguages) > 1)
                <div class="flex items-center gap-1 bg-gray-200/80 p-1 rounded-lg">
                    @foreach($contentLanguages as $language)
                        <button type="button" 
                                @click="activeLanguage = '{{ $language->code }}'; $nextTick(() => window.refreshBrandQuillEditors && window.refreshBrandQuillEditors())" 
                                :class="activeLanguage === '{{ $language->code }}' ? 'bg-white text-gray-900 shadow-xs font-bold' : 'text-gray-600 hover:text-gray-900 font-medium'" 
                                class="px-3 py-1 rounded-md text-xs transition-all focus:outline-none">
                            @if($language->code === 'vi')
                                🇻🇳 Tiếng Việt
                            @elseif($language->code === 'en')
                                🇬🇧 English
                            @elseif($language->code === 'ko')
                                🇰🇷 한국어
                            @else
                                {{ $language->native_name }}
                            @endif
                        </button>
                    @endforeach
                </div>
            @else
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                    🇻🇳 Tiếng Việt
                </span>
            @endif
        </div>

        <div class="p-6">
            @foreach($contentLanguages as $language)
                @php
                    $code = $language->code;
                    $name = old("name.$code", $brand->getTranslation('name', $code, false));
                    $slug = old("slug.$code", $brand->localizedSlug($code) ?: ($code === $defaultContentLocale ? $brand->slug : ''));
                    $description = old("description.$code", $brand->getTranslation('description', $code, false));
                @endphp
                <div x-show="activeLanguage === '{{ $code }}'" x-cloak class="space-y-5">
                    @if($code !== $defaultContentLocale)
                        <div class="flex items-center justify-between p-3 bg-amber-50 border border-amber-200 rounded-lg">
                            <div class="flex items-center gap-2 text-xs text-amber-800">
                                <iconify-icon icon="solar:info-circle-bold" class="text-base text-amber-600"></iconify-icon>
                                <span>Đang chỉnh sửa nội dung ngôn ngữ: <strong>{{ $language->native_name }}</strong></span>
                            </div>
                            <button type="button" class="inline-flex items-center gap-1.5 py-1 px-3 text-xs font-semibold text-primary bg-white hover:bg-primary hover:text-white border border-primary/30 rounded-md transition-colors focus:outline-none js-translate-locale" data-source-locale="{{ $defaultContentLocale }}" data-target-locale="{{ $code }}">
                                <iconify-icon icon="solar:global-linear" class="text-sm"></iconify-icon>
                                Dịch từ {{ strtoupper($defaultContentLocale) }}
                            </button>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                        <!-- Tên thương hiệu -->
                        <div class="md:col-span-7">
                            <label class="block mb-1.5 text-sm font-semibold text-gray-800" for="name_{{ $code }}">
                                Tên thương hiệu @if($code === $defaultContentLocale)<span class="text-red-500">*</span>@endif
                            </label>
                            <input type="text" 
                                   class="form-input block w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-600 focus:outline-none transition-colors" 
                                   id="name_{{ $code }}" 
                                   name="name[{{ $code }}]" 
                                   value="{{ $name }}" 
                                   placeholder="Ví dụ: Acolyte, Aldabra, Flos..."
                                   data-i18n-locale="{{ $code }}" 
                                   data-i18n-field="name" 
                                   oninput="window.handleBrandNameInput && window.handleBrandNameInput(this, '{{ $code }}')"
                                   @required($code === $defaultContentLocale)>
                        </div>

                        <!-- Slug -->
                        <div class="md:col-span-5">
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-sm font-semibold text-gray-800" for="slug_{{ $code }}">Đường dẫn (Slug)</label>
                                <button type="button" 
                                        onclick="window.regenerateBrandSlug && window.regenerateBrandSlug('{{ $code }}')"
                                        class="text-xs text-primary hover:underline font-medium flex items-center gap-1">
                                    <iconify-icon icon="solar:restart-linear" class="text-xs"></iconify-icon> Tự tạo từ tên
                                </button>
                            </div>
                            <input type="text" 
                                   class="form-input block w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-600 focus:outline-none font-mono text-xs transition-colors" 
                                   id="slug_{{ $code }}" 
                                   name="slug[{{ $code }}]" 
                                   value="{{ $slug }}" 
                                   data-i18n-locale="{{ $code }}" 
                                   data-i18n-field="slug" 
                                   placeholder="acolyte-lighting">
                        </div>

                        <!-- Rich text Mô tả -->
                        <div class="md:col-span-12">
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="text-sm font-semibold text-gray-800" for="description_{{ $code }}">
                                    Mô tả giới thiệu (Hiển thị mặt sau Flip-box)
                                </label>
                                <span class="text-xs text-gray-400">Hỗ trợ in đậm, in nghiêng, danh sách, đổi màu và liên kết</span>
                            </div>

                            <!-- Hidden Textarea for Form POST -->
                            <textarea class="hidden" 
                                      id="description_{{ $code }}" 
                                      name="description[{{ $code }}]" 
                                      data-i18n-locale="{{ $code }}" 
                                      data-i18n-field="description" 
                                      data-translation-format="html">{{ $description }}</textarea>

                            <!-- Quill Editor Container -->
                            <div class="brand-editor-container">
                                <div id="description_editor_{{ $code }}" 
                                     class="catalog-quill" 
                                     data-target="description_{{ $code }}">{!! $description ? (str_contains($description, '<p>') ? app(\App\Support\HtmlSanitizer::class)->clean($description) : nl2br(e($description))) : '' !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Card 2: Xuất xứ & Website thương hiệu -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-6 space-y-5">
        <div class="pb-3 border-b border-gray-100">
            <h3 class="font-bold text-gray-900 text-base flex items-center gap-2">
                <iconify-icon icon="solar:global-bold" class="text-amber-500 text-lg"></iconify-icon>
                <span>Xuất xứ & Liên kết ngoài</span>
            </h3>
            <p class="text-xs text-gray-500 mt-0.5">Quốc gia hiển thị làm nhãn tag ở góc dưới ảnh và liên kết mở website của hãng</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
            <!-- Quốc gia -->
            <div class="md:col-span-6 space-y-2">
                <label class="block text-sm font-semibold text-gray-800" for="country">
                    Quốc gia / Xuất xứ
                </label>
                <input type="text"
                       class="form-input block w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-600 focus:outline-none transition-colors"
                       id="country"
                       name="country"
                       x-model="country"
                       placeholder="Ví dụ: America, Italy, China, Germany, Japan...">

                <!-- Gợi ý nhanh pills -->
                <div class="pt-1">
                    <span class="text-xs text-gray-500 font-medium">Gợi ý nhanh:</span>
                    <div class="inline-flex flex-wrap gap-1.5 mt-1">
                        @foreach(['America', 'Italy', 'China', 'Germany', 'Spain', 'Japan', 'Croatia', 'Belgium', 'Australia', 'United Kingdom', 'Switzerland'] as $c)
                            <button type="button" 
                                    @click="setCountry('{{ $c }}')"
                                    :class="country === '{{ $c }}' ? 'bg-amber-100 text-amber-800 border-amber-300 font-semibold' : 'bg-gray-100 hover:bg-gray-200 text-gray-700 border-gray-200'"
                                    class="px-2.5 py-0.5 text-xs rounded-md border transition-colors focus:outline-none">
                                {{ $c }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Website thương hiệu -->
            <div class="md:col-span-6 space-y-2">
                <label class="block text-sm font-semibold text-gray-800" for="website_url">
                    Website thương hiệu (Nút "Visit Website")
                </label>
                <div class="flex rounded-lg shadow-xs">
                    <input type="text"
                           class="form-input block w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white rounded-l-lg border border-r-0 border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-600 focus:outline-none font-mono text-xs transition-colors"
                           id="website_url"
                           name="website_url"
                           x-model="websiteUrl"
                           placeholder="https://genledbrands.com/acolyte/">
                    <button type="button" 
                            @click="if(websiteUrl) { window.open(websiteUrl.startsWith('http') ? websiteUrl : 'https://' + websiteUrl, '_blank') }"
                            :disabled="!websiteUrl"
                            class="inline-flex items-center px-4 rounded-r-lg border border-gray-300 bg-gray-50 text-gray-700 text-sm font-medium hover:bg-gray-100 disabled:opacity-40 disabled:pointer-events-none transition-colors focus:outline-none">
                        <iconify-icon icon="solar:arrow-right-up-linear" class="mr-1.5 text-base"></iconify-icon>
                        <span>Mở thử</span>
                    </button>
                </div>
                <p class="text-xs text-gray-500">Đường dẫn khi khách bấm nút "Visit Website" ở mặt sau flipbox (tự động thêm https:// nếu thiếu).</p>
            </div>
        </div>
    </div>

    <!-- Card 3: Hình ảnh & Nhận diện thương hiệu -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-6 space-y-5">
        <div class="pb-3 border-b border-gray-100">
            <h3 class="font-bold text-gray-900 text-base flex items-center gap-2">
                <iconify-icon icon="solar:gallery-bold" class="text-purple-600 text-lg"></iconify-icon>
                <span>Hình ảnh & Nhận diện thương hiệu</span>
            </h3>
            <p class="text-xs text-gray-500 mt-0.5">Ảnh công trình đại diện hiển thị ở mặt trước thẻ flip-box và Logo hãng hiển thị ngay bên dưới</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- 1. Ảnh công trình đại diện (Mặt trước Flip-box) -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Ảnh công trình đại diện (Mặt trước Flip-box)</h4>
                        <span class="text-xs text-gray-500">Khổ đứng tỷ lệ ~ 3:4 (800x1072 px)</span>
                    </div>

                    <!-- Mode Toggle -->
                    <div class="flex items-center bg-white border border-gray-200 rounded-lg p-0.5 text-xs font-medium">
                        <button type="button" @click="showcaseTab = 'file'" :class="showcaseTab === 'file' ? 'bg-gray-800 text-white font-semibold' : 'text-gray-600 hover:text-gray-900'" class="px-2.5 py-1 rounded-md transition-colors">Tải file</button>
                        <button type="button" @click="showcaseTab = 'url'" :class="showcaseTab === 'url' ? 'bg-gray-800 text-white font-semibold' : 'text-gray-600 hover:text-gray-900'" class="px-2.5 py-1 rounded-md transition-colors">Dán URL</button>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <!-- Preview Box (Portrait 3:4) -->
                    <div class="relative w-32 h-44 rounded-lg border border-gray-200 bg-white overflow-hidden shadow-xs shrink-0 flex items-center justify-center">
                        <div id="showcase_placeholder" class="{{ $brand->showcase_image ? 'hidden' : 'flex' }} flex-col items-center justify-center p-2 text-center text-gray-400">
                            <iconify-icon icon="solar:gallery-wide-linear" class="text-3xl mb-1"></iconify-icon>
                            <span class="text-[11px]">Chưa có ảnh</span>
                        </div>
                        <img id="showcase_preview_img" 
                             src="{{ $brand->showcase_image ?: '' }}" 
                             alt="Showcase" 
                             class="{{ $brand->showcase_image ? 'block' : 'hidden' }} w-full h-full object-cover">
                        <div class="absolute bottom-1.5 left-1.5 bg-black/60 text-white text-[10px] font-medium px-1.5 py-0.5 rounded">
                            3:4
                        </div>
                    </div>

                    <!-- Input Controls -->
                    <div class="flex-1 space-y-3">
                        <!-- Mode File -->
                        <div x-show="showcaseTab === 'file'">
                            <label for="showcase_image_file" class="block w-full border-2 border-dashed border-gray-300 hover:border-gray-400 rounded-lg p-4 text-center cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                                <iconify-icon icon="solar:cloud-upload-linear" class="text-2xl text-gray-400 block mx-auto mb-1"></iconify-icon>
                                <span class="text-xs font-semibold text-gray-700 block">Chọn file ảnh từ máy</span>
                                <span class="text-[11px] text-gray-400 block mt-0.5">PNG, JPG, WEBP tối đa 5MB</span>
                                <input type="file" 
                                       id="showcase_image_file" 
                                       name="showcase_image_file" 
                                       accept="image/*" 
                                       class="hidden" 
                                       onchange="window.previewBrandImage && window.previewBrandImage(this, 'showcase_preview_img', 'showcase_placeholder', 'showcase_file_name')">
                            </label>
                            <div id="showcase_file_name" class="text-xs text-gray-600 font-medium mt-1 truncate hidden"></div>
                        </div>

                        <!-- Mode URL -->
                        <div x-show="showcaseTab === 'url'">
                            <input type="text"
                                   id="showcase_image"
                                   name="showcase_image"
                                   value="{{ old('showcase_image', $brand->showcase_image) }}"
                                   placeholder="https://... hoặc /wp-content/..."
                                   class="form-input block w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-100"
                                   oninput="window.previewUrlImage && window.previewUrlImage(this.value, 'showcase_preview_img', 'showcase_placeholder')">
                            <span class="text-[11px] text-gray-500 block mt-1">Dán link ảnh từ thư viện hoặc website</span>
                        </div>

                        @if($brand->showcase_image)
                            <div class="pt-1">
                                <input type="hidden" name="remove_showcase_image" :value="removeShowcase ? 1 : 0">
                                <button type="button" 
                                        @click="removeShowcase = !removeShowcase; if(removeShowcase) { document.getElementById('showcase_preview_img').classList.add('hidden'); document.getElementById('showcase_placeholder').classList.remove('hidden'); } else { document.getElementById('showcase_preview_img').src = '{{ $brand->showcase_image }}'; document.getElementById('showcase_preview_img').classList.remove('hidden'); document.getElementById('showcase_placeholder').classList.add('hidden'); }"
                                        class="text-xs font-medium text-red-600 hover:text-red-700 inline-flex items-center gap-1">
                                    <iconify-icon icon="solar:trash-bin-minimalistic-linear" class="text-sm"></iconify-icon>
                                    <span x-text="removeShowcase ? 'Hủy đánh dấu xóa' : 'Gỡ bỏ ảnh công trình này'"></span>
                                </button>
                                <div x-show="removeShowcase" class="text-[11px] text-red-600 italic mt-0.5">Sẽ xóa ảnh khi bấm Lưu.</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 2. Logo thương hiệu -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm">Logo thương hiệu</h4>
                        <span class="text-xs text-gray-500">Hiển thị ngay dưới thẻ công trình</span>
                    </div>

                    <!-- Mode Toggle -->
                    <div class="flex items-center bg-white border border-gray-200 rounded-lg p-0.5 text-xs font-medium">
                        <button type="button" @click="logoTab = 'file'" :class="logoTab === 'file' ? 'bg-gray-800 text-white font-semibold' : 'text-gray-600 hover:text-gray-900'" class="px-2.5 py-1 rounded-md transition-colors">Tải file</button>
                        <button type="button" @click="logoTab = 'url'" :class="logoTab === 'url' ? 'bg-gray-800 text-white font-semibold' : 'text-gray-600 hover:text-gray-900'" class="px-2.5 py-1 rounded-md transition-colors">Dán URL</button>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <!-- Preview Box (Checkerboard white) -->
                    <div class="relative w-32 h-44 rounded-lg border border-gray-200 bg-white overflow-hidden shadow-xs shrink-0 flex items-center justify-center p-2" style="background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 8px 8px;">
                        <div id="logo_placeholder" class="{{ $brand->image_url ? 'hidden' : 'flex' }} flex-col items-center justify-center p-2 text-center text-gray-400">
                            <iconify-icon icon="solar:tag-linear" class="text-3xl mb-1"></iconify-icon>
                            <span class="text-[11px]">Chưa có logo</span>
                        </div>
                        <img id="logo_preview_img" 
                             src="{{ $brand->image_url ?: '' }}" 
                             alt="Logo" 
                             class="{{ $brand->image_url ? 'block' : 'hidden' }} max-h-24 max-w-full object-contain">
                        <div class="absolute bottom-1.5 left-1.5 bg-gray-900/60 text-white text-[10px] font-medium px-1.5 py-0.5 rounded">
                            Logo
                        </div>
                    </div>

                    <!-- Input Controls -->
                    <div class="flex-1 space-y-3">
                        <!-- Mode File -->
                        <div x-show="logoTab === 'file'">
                            <label for="image_file" class="block w-full border-2 border-dashed border-gray-300 hover:border-gray-400 rounded-lg p-4 text-center cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                                <iconify-icon icon="solar:cloud-upload-linear" class="text-2xl text-gray-400 block mx-auto mb-1"></iconify-icon>
                                <span class="text-xs font-semibold text-gray-700 block">Chọn file logo từ máy</span>
                                <span class="text-[11px] text-gray-400 block mt-0.5">Khuyên dùng PNG nền trong suốt</span>
                                <input type="file" 
                                       id="image_file" 
                                       name="image_file" 
                                       accept="image/*" 
                                       class="hidden" 
                                       onchange="window.previewBrandImage && window.previewBrandImage(this, 'logo_preview_img', 'logo_placeholder', 'logo_file_name')">
                            </label>
                            <div id="logo_file_name" class="text-xs text-gray-600 font-medium mt-1 truncate hidden"></div>
                        </div>

                        <!-- Mode URL -->
                        <div x-show="logoTab === 'url'">
                            <input type="text"
                                   id="image_url"
                                   name="image_url"
                                   value="{{ old('image_url', $brand->image_url) }}"
                                   placeholder="https://... hoặc /wp-content/..."
                                   class="form-input block w-full px-3 py-2 text-xs border border-gray-300 rounded-lg bg-white focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-100"
                                   oninput="window.previewUrlImage && window.previewUrlImage(this.value, 'logo_preview_img', 'logo_placeholder')">
                            <span class="text-[11px] text-gray-500 block mt-1">Dán link logo từ thư viện</span>
                        </div>

                        @if($brand->image_url)
                            <div class="pt-1">
                                <input type="hidden" name="remove_image" :value="removeLogo ? 1 : 0">
                                <button type="button" 
                                        @click="removeLogo = !removeLogo; if(removeLogo) { document.getElementById('logo_preview_img').classList.add('hidden'); document.getElementById('logo_placeholder').classList.remove('hidden'); } else { document.getElementById('logo_preview_img').src = '{{ $brand->image_url }}'; document.getElementById('logo_preview_img').classList.remove('hidden'); document.getElementById('logo_placeholder').classList.add('hidden'); }"
                                        class="text-xs font-medium text-red-600 hover:text-red-700 inline-flex items-center gap-1">
                                    <iconify-icon icon="solar:trash-bin-minimalistic-linear" class="text-sm"></iconify-icon>
                                    <span x-text="removeLogo ? 'Hủy đánh dấu xóa' : 'Gỡ bỏ logo này'"></span>
                                </button>
                                <div x-show="removeLogo" class="text-[11px] text-red-600 italic mt-0.5">Sẽ xóa logo khi bấm Lưu.</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Cài đặt hiển thị & Sắp xếp -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-6 space-y-5">
        <div class="pb-3 border-b border-gray-100">
            <h3 class="font-bold text-gray-900 text-base flex items-center gap-2">
                <iconify-icon icon="solar:settings-bold" class="text-blue-600 text-lg"></iconify-icon>
                <span>Cài đặt hiển thị & Sắp xếp</span>
            </h3>
            <p class="text-xs text-gray-500 mt-0.5">Thứ tự hiển thị trên danh sách và trạng thái hoạt động của thương hiệu</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
            <!-- Thứ tự hiển thị -->
            <div class="md:col-span-4">
                <label class="block mb-1.5 text-sm font-semibold text-gray-800" for="sort_order">
                    Thứ tự sắp xếp
                </label>
                <input type="number"
                       class="form-input block w-full px-3.5 py-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-600 focus:outline-none font-mono"
                       id="sort_order"
                       name="sort_order"
                       value="{{ old('sort_order', $brand->sort_order ?? 0) }}"
                       min="0">
                <p class="text-xs text-gray-400 mt-1">Số nhỏ hơn sẽ hiển thị trước (0, 1, 2...)</p>
            </div>

            <!-- Switch: Hiển thị công khai -->
            <div class="md:col-span-4">
                <div class="flex items-center justify-between p-4 rounded-lg border border-gray-200 bg-gray-50">
                    <div>
                        <label for="is_active" class="text-sm font-semibold text-gray-900 block cursor-pointer">Hiển thị công khai</label>
                        <span class="text-xs text-gray-500 block">Hiển thị trên website</span>
                    </div>
                    <label class="custom-switch cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active" name="is_active" value="1" @checked((bool) old('is_active', $brand->is_active ?? true))>
                        <span class="custom-switch-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Switch: Thương hiệu nổi bật -->
            <div class="md:col-span-4">
                <div class="flex items-center justify-between p-4 rounded-lg border border-gray-200 bg-gray-50">
                    <div>
                        <label for="is_featured" class="text-sm font-semibold text-gray-900 block cursor-pointer">Thương hiệu nổi bật</label>
                        <span class="text-xs text-gray-500 block">Ưu tiên vị trí đầu</span>
                    </div>
                    <label class="custom-switch cursor-pointer">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" @checked((bool) old('is_featured', $brand->is_featured ?? false))>
                        <span class="custom-switch-slider custom-switch-purple"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Bar -->
    <div class="flex items-center justify-between pt-2 pb-10">
        <a href="{{ route('admin.brands.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 font-semibold text-sm transition-colors shadow-xs">
            <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
            <span>Quay lại danh sách</span>
        </a>
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-primary hover:bg-primary-hover text-white font-bold text-sm transition-colors shadow-sm focus:outline-none">
            <iconify-icon icon="solar:diskette-bold" class="text-lg"></iconify-icon>
            <span>{{ $brand->exists ? 'Lưu thay đổi thương hiệu' : 'Tạo mới thương hiệu' }}</span>
        </button>
    </div>
</div>

@include('admin.shared.translation-assets')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/quill/dist/quill.snow.css') }}">
    <style>
        /* Bulletproof Pure CSS Custom Switch Toggle */
        .custom-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
            margin: 0;
            flex-shrink: 0;
        }
        .custom-switch input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }
        .custom-switch-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #d1d5db;
            transition: .25s ease-in-out;
            border-radius: 24px;
        }
        .custom-switch-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .25s ease-in-out;
            border-radius: 50%;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .custom-switch input:checked + .custom-switch-slider {
            background-color: #10b981;
        }
        .custom-switch input:checked + .custom-switch-slider.custom-switch-purple {
            background-color: #8b5cf6;
        }
        .custom-switch input:checked + .custom-switch-slider:before {
            transform: translateX(20px);
        }

        /* Seamless Quill Snow Theme Styling */
        .brand-editor-container .ql-toolbar.ql-snow {
            border: 1px solid #d1d5db !important;
            border-bottom: 1px solid #e5e7eb !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
            background-color: #f9fafb !important;
            padding: 8px 10px !important;
        }
        .brand-editor-container .ql-container.ql-snow {
            border: 1px solid #d1d5db !important;
            border-top: none !important;
            border-bottom-left-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            background-color: #ffffff !important;
            font-family: inherit !important;
        }
        .brand-editor-container .ql-editor {
            min-height: 180px !important;
            font-size: 14px !important;
            line-height: 1.6 !important;
            color: #111827 !important;
            padding: 12px 14px !important;
        }
        .brand-editor-container .ql-editor.ql-blank::before {
            color: #9ca3af !important;
            font-style: normal !important;
        }
        .brand-editor-container .ql-snow .ql-stroke {
            stroke: #4b5563 !important;
        }
        .brand-editor-container .ql-snow .ql-fill {
            fill: #4b5563 !important;
        }
        .brand-editor-container .ql-snow .ql-picker {
            color: #4b5563 !important;
        }
        .brand-editor-container:focus-within .ql-toolbar.ql-snow,
        .brand-editor-container:focus-within .ql-container.ql-snow {
            border-color: #2563eb !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('admin-assets/libs/quill/dist/quill.min.js') }}"></script>
    <script>
        // Slug generation helper
        function stringToSlug(str) {
            str = str.replace(/^\s+|\s+$/g, '');
            str = str.toLowerCase();
            const from = "àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ·/_,:;";
            const to   = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyd------";
            for (let i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }
            str = str.replace(/[^a-z0-9 -]/g, '')
                     .replace(/\s+/g, '-')
                     .replace(/-+/g, '-');
            return str;
        }

        window.handleBrandNameInput = function(nameInput, locale) {
            const slugInput = document.getElementById('slug_' + locale);
            if (slugInput && !slugInput.dataset.manuallyEdited) {
                slugInput.value = stringToSlug(nameInput.value);
            }
        };

        window.regenerateBrandSlug = function(locale) {
            const nameInput = document.getElementById('name_' + locale);
            const slugInput = document.getElementById('slug_' + locale);
            if (nameInput && slugInput) {
                slugInput.value = stringToSlug(nameInput.value);
                slugInput.dataset.manuallyEdited = 'true';
            }
        };

        // File image preview helper
        window.previewBrandImage = function(fileInput, imgId, placeholderId, nameId) {
            if (fileInput.files && fileInput.files[0]) {
                const file = fileInput.files[0];
                const img = document.getElementById(imgId);
                const placeholder = document.getElementById(placeholderId);
                const nameEl = document.getElementById(nameId);

                if (img) {
                    img.src = URL.createObjectURL(file);
                    img.classList.remove('hidden');
                    img.classList.add('block');
                }
                if (placeholder) {
                    placeholder.classList.add('hidden');
                    placeholder.classList.remove('flex');
                }
                if (nameEl) {
                    nameEl.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
                    nameEl.classList.remove('hidden');
                }
            }
        };

        // URL image preview helper
        window.previewUrlImage = function(url, imgId, placeholderId) {
            const img = document.getElementById(imgId);
            const placeholder = document.getElementById(placeholderId);
            if (url && url.trim() !== '') {
                if (img) {
                    img.src = url.trim();
                    img.classList.remove('hidden');
                    img.classList.add('block');
                }
                if (placeholder) {
                    placeholder.classList.add('hidden');
                    placeholder.classList.remove('flex');
                }
            } else {
                if (img) {
                    img.classList.add('hidden');
                    img.classList.remove('block');
                }
                if (placeholder) {
                    placeholder.classList.remove('hidden');
                    placeholder.classList.add('flex');
                }
            }
        };

        // Quill Rich Text Initialization & Synchronization
        document.addEventListener('DOMContentLoaded', function () {
            // Track manual slug edits
            document.querySelectorAll('[data-i18n-field="slug"]').forEach(function(input) {
                input.addEventListener('input', function() {
                    this.dataset.manuallyEdited = 'true';
                });
            });

            // Initialize Quill on all brand description editors
            document.querySelectorAll('.catalog-quill').forEach(function (editorElement) {
                if (editorElement.id === 'quick_description_editor') return;
                const target = document.getElementById(editorElement.dataset.target);
                if (!target) return;

                const quill = new Quill(editorElement, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['link', 'clean']
                        ]
                    }
                });
                editorElement.__quill = quill;

                // Sync immediately on every keystroke
                quill.on('text-change', function () {
                    const html = quill.root.innerHTML;
                    target.value = (html === '<p><br></p>' || html === '<p></p>') ? '' : html;
                    target.dispatchEvent(new Event('input', { bubbles: true }));
                });

                // Safety on form submit
                const form = editorElement.closest('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        const html = quill.root.innerHTML;
                        target.value = (html === '<p><br></p>' || html === '<p></p>') ? '' : html;
                    });
                }
            });

            // Refresh Quill on language tab switch
            window.refreshBrandQuillEditors = function() {
                document.querySelectorAll('.catalog-quill').forEach(function(el) {
                    if (el.__quill) {
                        el.__quill.update();
                    }
                });
            };
        });
    </script>
@endpush
