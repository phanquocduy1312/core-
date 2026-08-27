@php
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
    $fallbackLocale = app(\App\Services\LanguageRegistry::class)->fallbackLocale();
    $cancelUrl = route('admin.post-categories.index');
@endphp

<!-- Category Form Card -->
<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
    <div x-data="{ activeLanguage: '{{ $defaultContentLocale }}' }" class="space-y-4">
        <!-- Language tabs bar -->
        <div class="border-b border-gray-200">
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
        
        <div class="pt-2">
            @foreach($contentLanguages as $language)
                @php
                    $code = $language->code;
                    $name = old("name.$code", $category->getTranslation('name', $code, false));
                    $slug = old("slug.$code", $category->localizedSlug($code) ?: ($code === $defaultContentLocale ? $category->slug : ''));
                    $description = old("description.$code", $category->getTranslation('description', $code, false));
                @endphp
                <div x-show="activeLanguage === '{{ $code }}'" class="space-y-4">
                    @if($code !== $defaultContentLocale)
                        <div class="flex justify-end">
                            <button type="button" class="inline-flex items-center gap-1 py-1 px-2.5 text-2xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-md transition-colors focus:outline-none js-translate-locale" data-source-locale="{{ $defaultContentLocale }}" data-target-locale="{{ $code }}">
                                <iconify-icon icon="solar:global-linear" class="text-base"></iconify-icon>
                                <span>Dịch {{ strtoupper($defaultContentLocale) }} → {{ strtoupper($code) }}</span>
                            </button>
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-semibold text-gray-900" for="name_{{ $code }}">{{ __('admin.blog_categories.fields.name') }} @if($code === $defaultContentLocale)<span class="text-red-500">*</span>@endif</label>
                            <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="name_{{ $code }}" name="name[{{ $code }}]" value="{{ $name }}" data-i18n-locale="{{ $code }}" data-i18n-field="name" @required($code === $defaultContentLocale)>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-900" for="slug_{{ $code }}">{{ __('admin.blog_categories.fields.slug') }}</label>
                            <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="slug_{{ $code }}" name="slug[{{ $code }}]" value="{{ $slug }}" data-i18n-locale="{{ $code }}" data-i18n-field="slug" placeholder="Tự tạo từ tên">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block mb-2 text-sm font-semibold text-gray-900" for="description_{{ $code }}">{{ __('admin.blog_categories.fields.description') }}</label>
                            <textarea class="hidden" id="description_{{ $code }}" name="description[{{ $code }}]" data-i18n-locale="{{ $code }}" data-i18n-field="description" data-translation-format="html">{{ $description }}</textarea>
                            <div id="description_editor_{{ $code }}" class="catalog-quill bg-white rounded-lg border border-gray-300" data-target="description_{{ $code }}">{!! app(\App\Support\HtmlSanitizer::class)->clean($description) !!}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4 border-t border-gray-150">
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-900" for="parent_id">{{ __('catalog.fields.parent_category') }}</label>
            <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="parent_id" name="parent_id">
                <option value="">{{ __('catalog.common.none') }}</option>
                @foreach($parentOptions as $parent)
                    @php
                        $parentName = $parent->getTranslation('name', app()->getLocale(), false) ?: $parent->getTranslation('name', $fallbackLocale, false);
                    @endphp
                    <option value="{{ $parent->id }}" @selected((string) old('parent_id', $category->parent_id) === (string) $parent->id) @disabled($parent->id === $category->id)>
                        {!! str_repeat('&nbsp;&nbsp;', $parent->depth ?? 0) !!}{{ $parent->depth ? '↳ ' : '' }}{{ $parentName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center pt-7">
            <input type="hidden" name="is_active" value="1">
            <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="0" id="is_active" @checked(! (bool) old('is_active', $category->is_active))>
            <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_active">{{ __('admin.blog_categories.save_draft_help') }}</label>
        </div>
    </div>
</div>

@include('admin.shared.form-actions', ['cancelUrl' => $cancelUrl])
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
