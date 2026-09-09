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

    <!-- Card 1: Thông tin định danh & Giới thiệu (Đa ngôn ngữ) -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <!-- Header & Language Tabs -->
        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-200 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                    <iconify-icon icon="solar:document-text-bold-duotone" class="text-xl"></iconify-icon>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-base">Thông tin thương hiệu & Giới thiệu</h3>
                    <p class="text-xs text-slate-500">Tên, đường dẫn và nội dung mô tả chi tiết ở mặt sau thẻ flip-box</p>
                </div>
            </div>

            <!-- Language Pills -->
            <div class="flex items-center gap-1.5 bg-slate-200/70 p-1 rounded-xl">
                @foreach($contentLanguages as $language)
                    <button type="button" 
                            @click="activeLanguage = '{{ $language->code }}'; $nextTick(() => window.refreshBrandQuillEditors && window.refreshBrandQuillEditors())" 
                            :class="activeLanguage === '{{ $language->code }}' ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900 font-medium'" 
                            class="px-3.5 py-1.5 rounded-lg text-xs flex items-center gap-1.5 transition-all focus:outline-none">
                        @if($language->code === 'vi')
                            <span class="text-sm">🇻🇳</span>
                        @elseif($language->code === 'en')
                            <span class="text-sm">🇬🇧</span>
                        @elseif($language->code === 'ko')
                            <span class="text-sm">🇰🇷</span>
                        @else
                            <iconify-icon icon="solar:global-linear" class="text-sm"></iconify-icon>
                        @endif
                        <span>{{ $language->native_name }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="p-6">
            @foreach($contentLanguages as $language)
                @php
                    $code = $language->code;
                    $name = old("name.$code", $brand->getTranslation('name', $code, false));
                    $slug = old("slug.$code", $brand->localizedSlug($code) ?: ($code === $defaultContentLocale ? $brand->slug : ''));
                    $description = old("description.$code", $brand->getTranslation('description', $code, false));
                @endphp
                <div x-show="activeLanguage === '{{ $code }}'" x-cloak class="space-y-6">
                    @if($code !== $defaultContentLocale)
                        <div class="flex items-center justify-between p-3 bg-amber-50/70 border border-amber-200/80 rounded-xl">
                            <div class="flex items-center gap-2 text-xs text-amber-800">
                                <iconify-icon icon="solar:info-circle-bold" class="text-base text-amber-600"></iconify-icon>
                                <span>Đang nhập nội dung cho ngôn ngữ <strong>{{ $language->native_name }}</strong>. Bạn có thể dùng tính năng dịch tự động.</span>
                            </div>
                            <button type="button" class="inline-flex items-center gap-1.5 py-1.5 px-3 text-xs font-semibold text-primary bg-white hover:bg-primary hover:text-white border border-primary/30 rounded-lg shadow-sm transition-all focus:outline-none js-translate-locale" data-source-locale="{{ $defaultContentLocale }}" data-target-locale="{{ $code }}">
                                <iconify-icon icon="solar:global-linear" class="text-sm"></iconify-icon>
                                Dịch từ {{ strtoupper($defaultContentLocale) }}
                            </button>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                        <!-- Tên thương hiệu -->
                        <div class="md:col-span-7">
                            <label class="block mb-2 text-sm font-bold text-slate-800" for="name_{{ $code }}">
                                Tên thương hiệu @if($code === $defaultContentLocale)<span class="text-rose-500">*</span>@endif
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       class="block w-full pl-3.5 pr-10 py-2.5 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all" 
                                       id="name_{{ $code }}" 
                                       name="name[{{ $code }}]" 
                                       value="{{ $name }}" 
                                       placeholder="Ví dụ: Acolyte, Aldabra, Flos..."
                                       data-i18n-locale="{{ $code }}" 
                                       data-i18n-field="name" 
                                       oninput="window.handleBrandNameInput && window.handleBrandNameInput(this, '{{ $code }}')"
                                       @required($code === $defaultContentLocale)>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                    <iconify-icon icon="solar:tag-linear" class="text-lg"></iconify-icon>
                                </div>
                            </div>
                        </div>

                        <!-- Slug -->
                        <div class="md:col-span-5">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-sm font-bold text-slate-800" for="slug_{{ $code }}">Đường dẫn (Slug)</label>
                                <button type="button" 
                                        onclick="window.regenerateBrandSlug && window.regenerateBrandSlug('{{ $code }}')"
                                        class="text-xs text-primary hover:underline font-semibold flex items-center gap-1">
                                    <iconify-icon icon="solar:restart-linear" class="text-xs"></iconify-icon> Tự tạo từ tên
                                </button>
                            </div>
                            <div class="relative">
                                <input type="text" 
                                       class="block w-full pl-3.5 pr-10 py-2.5 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all font-mono text-xs" 
                                       id="slug_{{ $code }}" 
                                       name="slug[{{ $code }}]" 
                                       value="{{ $slug }}" 
                                       data-i18n-locale="{{ $code }}" 
                                       data-i18n-field="slug" 
                                       placeholder="acolyte-lighting">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                    <iconify-icon icon="solar:link-linear" class="text-lg"></iconify-icon>
                                </div>
                            </div>
                        </div>

                        <!-- Rich text Mô tả -->
                        <div class="md:col-span-12">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-sm font-bold text-slate-800" for="description_{{ $code }}">
                                    Mô tả giới thiệu (Hiển thị mặt sau Flip-box)
                                </label>
                                <span class="text-xs text-slate-500 font-normal">Hỗ trợ định dạng in đậm, in nghiêng, danh sách và liên kết</span>
                            </div>

                            <!-- Hidden Textarea for Actual Form POST -->
                            <textarea class="hidden" 
                                      id="description_{{ $code }}" 
                                      name="description[{{ $code }}]" 
                                      data-i18n-locale="{{ $code }}" 
                                      data-i18n-field="description" 
                                      data-translation-format="html">{{ $description }}</textarea>

                            <!-- Quill Editor Container -->
                            <div class="brand-quill-wrapper rounded-xl border border-slate-300 overflow-hidden shadow-sm transition-all focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary">
                                <div id="description_editor_{{ $code }}" 
                                     class="catalog-quill bg-white min-h-[180px]" 
                                     data-target="description_{{ $code }}">{!! $description ? (str_contains($description, '<p>') ? app(\App\Support\HtmlSanitizer::class)->clean($description) : nl2br(e($description))) : '' !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Card 2: Xuất xứ & Liên kết ngoài -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-5">
        <div class="flex items-center gap-2.5 pb-4 border-b border-slate-100">
            <div class="w-9 h-9 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold">
                <iconify-icon icon="solar:global-bold-duotone" class="text-xl"></iconify-icon>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Xuất xứ & Liên kết ngoài</h3>
                <p class="text-xs text-slate-500">Quốc gia hiển thị làm nhãn tag góc dưới thẻ & liên kết trang chủ hãng</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Country Field -->
            <div class="md:col-span-6 space-y-2">
                <label class="block text-sm font-bold text-slate-800" for="country">
                    Quốc gia / Xuất xứ
                </label>
                <div class="relative">
                    <input type="text"
                           class="block w-full pl-10 pr-3.5 py-2.5 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all"
                           id="country"
                           name="country"
                           x-model="country"
                           placeholder="Ví dụ: America, Italy, China, Germany, Japan...">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <iconify-icon icon="solar:flag-2-linear" class="text-lg"></iconify-icon>
                    </div>
                </div>

                <!-- Quick Tags -->
                <div class="pt-1">
                    <span class="text-xs text-slate-500 mr-1.5 font-medium">Gợi ý nhanh:</span>
                    <div class="inline-flex flex-wrap gap-1.5 mt-1">
                        @foreach(['America', 'Italy', 'China', 'Germany', 'Spain', 'Japan', 'Croatia', 'Belgium', 'Australia', 'United Kingdom', 'Switzerland'] as $c)
                            <button type="button" 
                                    @click="setCountry('{{ $c }}')"
                                    :class="country === '{{ $c }}' ? 'bg-amber-100 text-amber-800 border-amber-300 font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 border-slate-200'"
                                    class="px-2.5 py-0.5 text-xs rounded-full border transition-colors focus:outline-none">
                                {{ $c }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Website URL Field -->
            <div class="md:col-span-6 space-y-2">
                <label class="block text-sm font-bold text-slate-800" for="website_url">
                    Website thương hiệu (Nút "Visit Website")
                </label>
                <div class="flex gap-2">
                    <div class="relative flex-1">
                        <input type="text"
                               class="block w-full pl-10 pr-3.5 py-2.5 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all font-mono text-xs"
                               id="website_url"
                               name="website_url"
                               x-model="websiteUrl"
                               placeholder="https://genledbrands.com/acolyte/">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <iconify-icon icon="solar:link-circle-linear" class="text-lg"></iconify-icon>
                        </div>
                    </div>
                    <button type="button" 
                            @click="if(websiteUrl) { window.open(websiteUrl.startsWith('http') ? websiteUrl : 'https://' + websiteUrl, '_blank') }"
                            :disabled="!websiteUrl"
                            title="Mở thử liên kết trong tab mới"
                            class="px-3.5 py-2.5 text-xs font-semibold rounded-xl border border-slate-300 bg-slate-50 hover:bg-slate-100 text-slate-700 disabled:opacity-40 disabled:pointer-events-none flex items-center gap-1.5 transition-colors focus:outline-none">
                        <iconify-icon icon="solar:arrow-right-up-linear" class="text-base"></iconify-icon>
                        <span>Mở thử</span>
                    </button>
                </div>
                <p class="text-xs text-slate-500">Đường dẫn khi khách bấm nút "Visit Website" ở mặt sau flipbox (tự động thêm https:// nếu thiếu).</p>
            </div>
        </div>
    </div>

    <!-- Card 3: Hình ảnh & Nhận diện (Showcase Image & Logo) -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-6">
        <div class="flex items-center gap-2.5 pb-4 border-b border-slate-100">
            <div class="w-9 h-9 rounded-xl bg-purple-500/10 text-purple-600 flex items-center justify-center font-bold">
                <iconify-icon icon="solar:gallery-bold-duotone" class="text-xl"></iconify-icon>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Hình ảnh & Nhận diện thương hiệu</h3>
                <p class="text-xs text-slate-500">Ảnh đại diện công trình mặt trước thẻ flip-box và Logo hãng hiển thị bên dưới</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Showcase Image (Mặt trước Flip-box) -->
            <div class="bg-slate-50/70 p-5 rounded-2xl border border-slate-200 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm flex items-center gap-1.5">
                            <span>Ảnh công trình đại diện (Mặt trước Flip-box)</span>
                        </h4>
                        <span class="text-xs text-slate-500">Khổ đứng tỷ lệ ~ 3:4 (800x1072 px)</span>
                    </div>

                    <!-- Mode Toggle -->
                    <div class="flex items-center bg-white border border-slate-200 rounded-lg p-0.5 text-xs font-semibold">
                        <button type="button" @click="showcaseTab = 'file'" :class="showcaseTab === 'file' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-2.5 py-1 rounded-md transition-colors">Tải file</button>
                        <button type="button" @click="showcaseTab = 'url'" :class="showcaseTab === 'url' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-2.5 py-1 rounded-md transition-colors">Dán URL</button>
                    </div>
                </div>

                <!-- Preview Area -->
                <div class="flex gap-4 items-start">
                    <!-- 3:4 Aspect Ratio Frame -->
                    <div class="relative w-36 h-48 rounded-xl border-2 border-dashed border-slate-300 bg-white overflow-hidden shadow-xs shrink-0 flex items-center justify-center group" id="showcase_preview_box">
                        <img id="showcase_preview_img" 
                             src="{{ $brand->showcase_image ?: asset('admin-assets/js/icons/empty.png') }}" 
                             alt="Showcase" 
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                             onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/empty.png') }}';">
                        <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold px-2 py-0.5 rounded">
                            Tỷ lệ 3:4
                        </div>
                    </div>

                    <div class="flex-1 space-y-3">
                        <!-- Tab 1: File Upload Dropzone -->
                        <div x-show="showcaseTab === 'file'">
                            <label for="showcase_image_file" class="block w-full border border-slate-300 hover:border-primary border-dashed rounded-xl p-3 text-center cursor-pointer bg-white hover:bg-slate-50 transition-all">
                                <iconify-icon icon="solar:cloud-upload-linear" class="text-2xl text-slate-400 block mx-auto mb-1"></iconify-icon>
                                <span class="text-xs font-semibold text-primary block">Chọn file từ máy tính</span>
                                <span class="text-[11px] text-slate-500 block">PNG, JPG, WEBP tối đa 5MB</span>
                                <input type="file" 
                                       id="showcase_image_file" 
                                       name="showcase_image_file" 
                                       accept="image/*" 
                                       class="hidden" 
                                       onchange="window.previewSelectedImage && window.previewSelectedImage(this, 'showcase_preview_img')">
                            </label>
                            <div id="showcase_file_name" class="text-[11px] text-slate-600 mt-1 font-medium truncate hidden"></div>
                        </div>

                        <!-- Tab 2: URL Input -->
                        <div x-show="showcaseTab === 'url'">
                            <input type="text"
                                   id="showcase_image"
                                   name="showcase_image"
                                   value="{{ old('showcase_image', $brand->showcase_image) }}"
                                   placeholder="https://domain.com/image.jpg hoặc /wp-content/..."
                                   class="block w-full px-3 py-2 text-xs border border-slate-300 rounded-xl bg-white focus:ring-1 focus:ring-primary focus:outline-none"
                                   oninput="document.getElementById('showcase_preview_img').src = this.value || '{{ asset('admin-assets/js/icons/empty.png') }}'">
                            <span class="text-[11px] text-slate-500 block mt-1">Dán link ảnh trực tiếp từ website hoặc thư viện</span>
                        </div>

                        @if($brand->showcase_image)
                            <div class="pt-1">
                                <input type="hidden" name="remove_showcase_image" :value="removeShowcase ? 1 : 0">
                                <button type="button" 
                                        @click="removeShowcase = !removeShowcase; if(removeShowcase) document.getElementById('showcase_preview_img').src = '{{ asset('admin-assets/js/icons/empty.png') }}'; else document.getElementById('showcase_preview_img').src = '{{ $brand->showcase_image }}';"
                                        class="text-xs font-semibold text-rose-600 hover:text-rose-700 inline-flex items-center gap-1">
                                    <iconify-icon icon="solar:trash-bin-minimalistic-linear" class="text-sm"></iconify-icon>
                                    <span x-text="removeShowcase ? 'Hủy xóa ảnh' : 'Xóa ảnh công trình hiện tại'"></span>
                                </button>
                                <div x-show="removeShowcase" class="text-[11px] text-rose-600 italic">Đã đánh dấu xóa ảnh khi lưu.</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Brand Logo -->
            <div class="bg-slate-50/70 p-5 rounded-2xl border border-slate-200 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm flex items-center gap-1.5">
                            <span>Logo thương hiệu</span>
                        </h4>
                        <span class="text-xs text-slate-500">Hiển thị ngay dưới thẻ công trình</span>
                    </div>

                    <!-- Mode Toggle -->
                    <div class="flex items-center bg-white border border-slate-200 rounded-lg p-0.5 text-xs font-semibold">
                        <button type="button" @click="logoTab = 'file'" :class="logoTab === 'file' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-2.5 py-1 rounded-md transition-colors">Tải file</button>
                        <button type="button" @click="logoTab = 'url'" :class="logoTab === 'url' ? 'bg-primary text-white shadow-xs' : 'text-slate-600 hover:text-slate-900'" class="px-2.5 py-1 rounded-md transition-colors">Dán URL</button>
                    </div>
                </div>

                <!-- Preview Area -->
                <div class="flex gap-4 items-start">
                    <!-- Logo Box with Checkered/White background -->
                    <div class="relative w-36 h-48 rounded-xl border-2 border-dashed border-slate-300 bg-white overflow-hidden shadow-xs shrink-0 flex items-center justify-center p-3 group" id="logo_preview_box" style="background-image: radial-gradient(#e2e8f0 1px, transparent 1px); background-size: 10px 10px;">
                        <img id="logo_preview_img" 
                             src="{{ $brand->image_url ?: asset('admin-assets/js/icons/empty.png') }}" 
                             alt="Logo" 
                             class="max-h-24 max-w-full object-contain transition-transform duration-300 group-hover:scale-105"
                             onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/empty.png') }}';">
                        <div class="absolute bottom-2 left-2 bg-slate-900/60 backdrop-blur-xs text-white text-[10px] font-semibold px-2 py-0.5 rounded">
                            Logo
                        </div>
                    </div>

                    <div class="flex-1 space-y-3">
                        <!-- Tab 1: File Upload Dropzone -->
                        <div x-show="logoTab === 'file'">
                            <label for="image_file" class="block w-full border border-slate-300 hover:border-primary border-dashed rounded-xl p-3 text-center cursor-pointer bg-white hover:bg-slate-50 transition-all">
                                <iconify-icon icon="solar:cloud-upload-linear" class="text-2xl text-slate-400 block mx-auto mb-1"></iconify-icon>
                                <span class="text-xs font-semibold text-primary block">Chọn file logo từ máy</span>
                                <span class="text-[11px] text-slate-500 block">Khuyên dùng PNG nền trong suốt</span>
                                <input type="file" 
                                       id="image_file" 
                                       name="image_file" 
                                       accept="image/*" 
                                       class="hidden" 
                                       onchange="window.previewSelectedImage && window.previewSelectedImage(this, 'logo_preview_img')">
                            </label>
                            <div id="logo_file_name" class="text-[11px] text-slate-600 mt-1 font-medium truncate hidden"></div>
                        </div>

                        <!-- Tab 2: URL Input -->
                        <div x-show="logoTab === 'url'">
                            <input type="text"
                                   id="image_url"
                                   name="image_url"
                                   value="{{ old('image_url', $brand->image_url) }}"
                                   placeholder="https://domain.com/logo.png hoặc /wp-content/..."
                                   class="block w-full px-3 py-2 text-xs border border-slate-300 rounded-xl bg-white focus:ring-1 focus:ring-primary focus:outline-none"
                                   oninput="document.getElementById('logo_preview_img').src = this.value || '{{ asset('admin-assets/js/icons/empty.png') }}'">
                            <span class="text-[11px] text-slate-500 block mt-1">Dán URL logo thương hiệu</span>
                        </div>

                        @if($brand->image_url)
                            <div class="pt-1">
                                <input type="hidden" name="remove_image" :value="removeLogo ? 1 : 0">
                                <button type="button" 
                                        @click="removeLogo = !removeLogo; if(removeLogo) document.getElementById('logo_preview_img').src = '{{ asset('admin-assets/js/icons/empty.png') }}'; else document.getElementById('logo_preview_img').src = '{{ $brand->image_url }}';"
                                        class="text-xs font-semibold text-rose-600 hover:text-rose-700 inline-flex items-center gap-1">
                                    <iconify-icon icon="solar:trash-bin-minimalistic-linear" class="text-sm"></iconify-icon>
                                    <span x-text="removeLogo ? 'Hủy xóa logo' : 'Xóa logo hiện tại'"></span>
                                </button>
                                <div x-show="removeLogo" class="text-[11px] text-rose-600 italic">Đã đánh dấu xóa logo khi lưu.</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Cài đặt hiển thị & Trạng thái -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-6">
        <div class="flex items-center gap-2.5 pb-4 border-b border-slate-100">
            <div class="w-9 h-9 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center font-bold">
                <iconify-icon icon="solar:settings-bold-duotone" class="text-xl"></iconify-icon>
            </div>
            <div>
                <h3 class="font-bold text-slate-800 text-base">Cài đặt hiển thị & Sắp xếp</h3>
                <p class="text-xs text-slate-500">Thứ tự xuất hiện trên website và trạng thái hoạt động của thương hiệu</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
            <!-- Thứ tự hiển thị -->
            <div class="md:col-span-4">
                <label class="block mb-2 text-sm font-bold text-slate-800" for="sort_order">
                    Thứ tự sắp xếp
                </label>
                <div class="relative">
                    <input type="number"
                           class="block w-full pl-3.5 pr-10 py-2.5 text-sm text-slate-900 bg-white rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary/20 focus:border-primary focus:outline-none transition-all font-mono"
                           id="sort_order"
                           name="sort_order"
                           value="{{ old('sort_order', $brand->sort_order ?? 0) }}"
                           min="0">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <iconify-icon icon="solar:sort-vertical-linear" class="text-lg"></iconify-icon>
                    </div>
                </div>
                <p class="text-xs text-slate-500 mt-1">Số nhỏ hơn sẽ được ưu tiên hiển thị trước (0, 1, 2...)</p>
            </div>

            <!-- Switch: Hiển thị -->
            <div class="md:col-span-4">
                <input type="hidden" name="is_active" value="0">
                <label class="flex items-center justify-between p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 cursor-pointer transition-colors" for="is_active_toggle">
                    <div>
                        <span class="block text-sm font-bold text-slate-800">Hiển thị công khai</span>
                        <span class="block text-xs text-slate-500">Khách có thể xem thương hiệu này</span>
                    </div>
                    <div class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               id="is_active_toggle" 
                               name="is_active" 
                               value="1" 
                               class="sr-only peer"
                               @checked((bool) old('is_active', $brand->is_active ?? true))>
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </div>
                </label>
            </div>

            <!-- Switch: Nổi bật -->
            <div class="md:col-span-4">
                <input type="hidden" name="is_featured" value="0">
                <label class="flex items-center justify-between p-3.5 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 cursor-pointer transition-colors" for="is_featured_toggle">
                    <div>
                        <span class="block text-sm font-bold text-slate-800">Thương hiệu nổi bật</span>
                        <span class="block text-xs text-slate-500">Gắn nhãn Featured & ưu tiên trang chủ</span>
                    </div>
                    <div class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               id="is_featured_toggle" 
                               name="is_featured" 
                               value="1" 
                               class="sr-only peer"
                               @checked((bool) old('is_featured', $brand->is_featured ?? false))>
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                    </div>
                </label>
            </div>
        </div>
    </div>

    <!-- Action Bar -->
    <div class="flex items-center justify-between pt-4 pb-12">
        <a href="{{ route('admin.brands.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 bg-white hover:bg-slate-50 font-semibold text-sm transition-colors shadow-xs">
            <iconify-icon icon="solar:arrow-left-linear" class="text-base"></iconify-icon>
            <span>Quay lại danh sách</span>
        </a>
        <button type="submit" id="btn_save_brand" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white font-bold text-sm transition-all shadow-md shadow-primary/25 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary/50">
            <iconify-icon icon="solar:diskette-bold" class="text-lg"></iconify-icon>
            <span>{{ $brand->exists ? 'Lưu thay đổi thương hiệu' : 'Tạo mới thương hiệu' }}</span>
        </button>
    </div>
</div>

@include('admin.shared.translation-assets')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/quill/dist/quill.snow.css') }}">
    <style>
        /* Modern Quill Snow Theme Overrides */
        .brand-quill-wrapper .ql-toolbar.ql-snow {
            border: none !important;
            border-bottom: 1px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
            padding: 8px 12px !important;
        }
        .brand-quill-wrapper .ql-container.ql-snow {
            border: none !important;
            font-family: inherit !important;
        }
        .brand-quill-wrapper .ql-editor {
            min-height: 180px !important;
            font-size: 14.5px !important;
            line-height: 1.65 !important;
            color: #0f172a !important;
            padding: 14px 16px !important;
        }
        .brand-quill-wrapper .ql-editor.ql-blank::before {
            color: #94a3b8 !important;
            font-style: normal !important;
        }
        .brand-quill-wrapper .ql-snow .ql-stroke {
            stroke: #475569 !important;
        }
        .brand-quill-wrapper .ql-snow .ql-fill {
            fill: #475569 !important;
        }
        .brand-quill-wrapper .ql-snow .ql-picker {
            color: #475569 !important;
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
        window.previewSelectedImage = function(fileInput, previewImgId) {
            if (fileInput.files && fileInput.files[0]) {
                const file = fileInput.files[0];
                const previewImg = document.getElementById(previewImgId);
                if (previewImg) {
                    previewImg.src = URL.createObjectURL(file);
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
                            [{ 'header': [1, 2, 3, 4, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['link', 'clean']
                        ]
                    }
                });
                editorElement.__quill = quill;

                // Sync immediately on every keystroke/formatting change
                quill.on('text-change', function () {
                    const html = quill.root.innerHTML;
                    target.value = (html === '<p><br></p>' || html === '<p></p>') ? '' : html;
                    target.dispatchEvent(new Event('input', { bubbles: true }));
                });

                // Extra safety on form submission
                const form = editorElement.closest('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        const html = quill.root.innerHTML;
                        target.value = (html === '<p><br></p>' || html === '<p></p>') ? '' : html;
                    });
                }
            });

            // Expose function to refresh Quill instances when tab changes
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
