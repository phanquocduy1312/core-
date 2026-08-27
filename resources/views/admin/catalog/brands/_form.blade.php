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

        <!-- General Form Fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-900" for="image_file">{{ __('catalog.fields.image') }}</label>
                <input type="file" class="block w-full text-sm text-gray-900 border border-gray-350 rounded-lg cursor-pointer bg-white focus:outline-none" id="image_file" name="image_file" accept="image/*" data-media-folder="brands">
                <div class="mt-4 {{ $brand->image_url ? '' : 'd-none' }}" data-media-preview>
                    <img src="{{ $brand->image_url ?: '' }}" alt="{{ $name }}" class="rounded-lg border border-gray-250 p-1 max-h-24 object-contain" style="max-height: 96px;" data-media-preview-image onerror="this.onerror=null;this.src='{{ asset('admin-assets/js/icons/404.png') }}';">
                </div>
            </div>
            <div class="md:col-span-2 flex items-center">
                <input type="hidden" name="is_active" value="1">
                <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="0" id="is_active" @checked(! (bool) old('is_active', $brand->is_active))>
                <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_active">{{ __('catalog.fields.save_draft') }}</label>
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
