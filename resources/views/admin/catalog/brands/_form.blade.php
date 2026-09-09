@php
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
@endphp

<div x-data="{ activeLanguage: '{{ $defaultContentLocale }}' }" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-6">
    <!-- Languages Tab Bar -->
    <div class="border-b border-gray-200 bg-gray-50/50 px-6 pt-4">
        <nav class="-mb-px flex space-x-6 overflow-x-auto" aria-label="Languages">
            @foreach($contentLanguages as $language)
                <button type="button" @click="activeLanguage = '{{ $language->code }}'" 
                        :class="activeLanguage === '{{ $language->code }}' ? 'border-primary text-primary' : 'border-transparent text-gray-550 hover:text-gray-700 hover:border-gray-300'" 
                        class="whitespace-nowrap pb-4 px-1 border-b-2 font-bold text-sm flex items-center gap-2 focus:outline-none transition-colors">
                    <iconify-icon icon="solar:global-linear" class="text-lg"></iconify-icon>
                    <span>{{ $language->native_name }}</span>
                </button>
            @endforeach
        </nav>
    </div>

    <div class="p-6">
        <!-- Multilingual Fields -->
        <div class="mb-6">
            @foreach($contentLanguages as $language)
                @php
                    $code = $language->code;
                    $name = old("name.$code", $brand->getTranslation('name', $code, false));
                    $slug = old("slug.$code", $brand->localizedSlug($code) ?: ($code === $defaultContentLocale ? $brand->slug : ''));
                    $description = old("description.$code", $brand->getTranslation('description', $code, false));
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

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                        <div class="md:col-span-8">
                            <label class="block mb-2 text-sm font-semibold text-gray-900" for="name_{{ $code }}">
                                {{ __('catalog.fields.name') }} @if($code === $defaultContentLocale)<span class="text-red-500">*</span>@endif
                            </label>
                            <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="name_{{ $code }}" name="name[{{ $code }}]" value="{{ $name }}" data-i18n-locale="{{ $code }}" data-i18n-field="name" @required($code === $defaultContentLocale)>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block mb-2 text-sm font-semibold text-gray-900" for="slug_{{ $code }}">{{ __('catalog.fields.slug') }}</label>
                            <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="slug_{{ $code }}" name="slug[{{ $code }}]" value="{{ $slug }}" data-i18n-locale="{{ $code }}" data-i18n-field="slug" placeholder="Tự tạo từ tên">
                        </div>
                        <div class="md:col-span-12">
                            <label class="block mb-2 text-sm font-semibold text-gray-900" for="description_{{ $code }}">{{ __('catalog.fields.description') }}</label>
                            <textarea class="hidden" id="description_{{ $code }}" name="description[{{ $code }}]" data-i18n-locale="{{ $code }}" data-i18n-field="description" data-translation-format="html">{{ $description }}</textarea>
                            <div class="rounded-lg border border-gray-300 overflow-hidden">
                                <div id="description_editor_{{ $code }}" class="catalog-quill min-h-[160px]" data-target="description_{{ $code }}">{!! app(\App\Support\HtmlSanitizer::class)->clean($description) !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr class="border-gray-200 my-6">

        <!-- General & LuxLight Brand Fields -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Country & Website -->
            <div class="md:col-span-6">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="country">
                    Quốc gia / Xuất xứ
                </label>
                <input type="text"
                       class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                       id="country"
                       name="country"
                       value="{{ old('country', $brand->country) }}"
                       placeholder="Ví dụ: America, Italy, China, Germany, Japan...">
                <p class="text-xs text-gray-500 mt-1">Hiển thị làm nhãn tag ở góc dưới ảnh thương hiệu.</p>
            </div>

            <div class="md:col-span-6">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="website_url">
                    Website thương hiệu (Visit Website)
                </label>
                <input type="url"
                       class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                       id="website_url"
                       name="website_url"
                       value="{{ old('website_url', $brand->website_url) }}"
                       placeholder="https://en.aldabra.it/">
                <p class="text-xs text-gray-500 mt-1">Đường dẫn khi khách bấm nút "Visit Website" ở mặt sau flipbox.</p>
            </div>

            <!-- Showcase Image (Front of Flip-box) -->
            <div class="md:col-span-6 bg-gray-50/70 p-4 rounded-xl border border-gray-200">
                <label class="block mb-2 text-sm font-bold text-gray-900" for="showcase_image_file">
                    Ảnh công trình đại diện (Mặt trước Flip-box)
                </label>
                @if($brand->showcase_image)
                    <div class="mb-3">
                        <img src="{{ $brand->showcase_image }}" alt="Showcase" class="h-44 w-32 object-cover rounded-lg border border-gray-300 shadow-sm" onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/404.png') }}';">
                    </div>
                @endif
                <input type="file"
                       class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white file:mr-3 file:py-2 file:px-3 file:border-0 file:text-xs file:bg-gray-100 file:text-gray-700"
                       id="showcase_image_file"
                       name="showcase_image_file"
                       accept="image/*">
                <input type="text"
                       name="showcase_image"
                       id="showcase_image"
                       value="{{ old('showcase_image', $brand->showcase_image) }}"
                       placeholder="Hoặc dán URL ảnh công trình..."
                       class="mt-2 block w-full p-2 text-xs border border-gray-300 rounded-lg bg-white">
                <p class="text-xs text-gray-500 mt-1">Khổ đứng tỷ lệ ~ 3:4 (800x1072). Hiển thị mặt trước thẻ.</p>
            </div>

            <!-- Brand Logo -->
            <div class="md:col-span-6 bg-gray-50/70 p-4 rounded-xl border border-gray-200">
                <label class="block mb-2 text-sm font-bold text-gray-900" for="image_file">
                    Logo thương hiệu
                </label>
                @if($brand->image_url)
                    <div class="mb-3 bg-white p-2 rounded-lg border border-gray-300 inline-block">
                        <img src="{{ $brand->image_url }}" alt="Logo" class="max-h-16 max-w-xs object-contain" onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/404.png') }}';">
                    </div>
                @endif
                <input type="file"
                       class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white file:mr-3 file:py-2 file:px-3 file:border-0 file:text-xs file:bg-gray-100 file:text-gray-700"
                       id="image_file"
                       name="image_file"
                       accept="image/*">
                <input type="text"
                       name="image_url"
                       id="image_url"
                       value="{{ old('image_url', $brand->image_url) }}"
                       placeholder="Hoặc dán URL logo thương hiệu..."
                       class="mt-2 block w-full p-2 text-xs border border-gray-300 rounded-lg bg-white">
                <p class="text-xs text-gray-500 mt-1">Logo hiển thị ngay dưới thẻ công trình.</p>
            </div>

            <!-- Sort Order & Settings -->
            <div class="md:col-span-6">
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="sort_order">
                    Thứ tự hiển thị
                </label>
                <input type="number"
                       class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                       id="sort_order"
                       name="sort_order"
                       value="{{ old('sort_order', $brand->sort_order ?? 0) }}"
                       min="0">
            </div>

            <div class="md:col-span-6 flex items-center gap-6 pt-7">
                <input type="hidden" name="is_active" value="0">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer"
                           type="checkbox"
                           name="is_active"
                           value="1"
                           id="is_active"
                           @checked((bool) old('is_active', $brand->is_active ?? true))>
                    <span class="text-sm font-semibold text-gray-900">Hiển thị</span>
                </label>

                <input type="hidden" name="is_featured" value="0">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer"
                           type="checkbox"
                           name="is_featured"
                           value="1"
                           id="is_featured"
                           @checked((bool) old('is_featured', $brand->is_featured ?? false))>
                    <span class="text-sm font-semibold text-gray-900">Nổi bật</span>
                </label>
            </div>
        </div>
    </div>
</div>

@include('admin.shared.form-actions', ['cancelUrl' => route('admin.brands.index')])
@include('admin.shared.translation-assets')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/quill/dist/quill.snow.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin-assets/libs/quill/dist/quill.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.catalog-quill').forEach(function (editorElement) {
                if (editorElement.id === 'quick_description_editor') return;
                const target = document.getElementById(editorElement.dataset.target);
                if (!target) return;

                const quill = new Quill(editorElement, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['link', 'clean']
                        ]
                    }
                });
                editorElement.__quill = quill;

                const form = editorElement.closest('form');
                if (form) {
                    form.addEventListener('submit', function () {
                        target.value = quill.root.innerHTML;
                    });
                }
            });
        });
    </script>
@endpush
