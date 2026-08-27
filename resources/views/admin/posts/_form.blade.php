@php
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
    $fallbackLocale = app(\App\Services\LanguageRegistry::class)->fallbackLocale();
    $cancelUrl = route('admin.posts.index');
@endphp

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Left column: Main Content and SEO -->
    <div class="lg:col-span-8 space-y-6">
        <!-- General Info Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-bold text-gray-900">{{ __('admin.posts.sections.general') }}</h4>
            </div>
            
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
                            $title = old("title.$code", $post->getTranslation('title', $code, false));
                            $slug = old("slug.$code", $post->localizedSlug($code) ?: ($code === $defaultContentLocale ? $post->slug : ''));
                            $summary = old("summary.$code", $post->getTranslation('summary', $code, false));
                            $content = old("content.$code", $post->getTranslation('content', $code, false));
                            $seoTitle = old("seo_title.$code", $post->getTranslation('seo_title', $code, false));
                            $seoDesc = old("seo_description.$code", $post->getTranslation('seo_description', $code, false));
                            $defaultTab = $code === $defaultContentLocale;
                        @endphp
                        <div x-show="activeLanguage === '{{ $code }}'" class="space-y-4">
                            @if(!$defaultTab)
                                <div class="flex justify-end">
                                    <button type="button" class="inline-flex items-center gap-1 py-1 px-2.5 text-2xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-md transition-colors focus:outline-none js-translate-locale" data-source-locale="{{ $defaultContentLocale }}" data-target-locale="{{ $code }}">
                                        <iconify-icon icon="solar:global-linear" class="text-base"></iconify-icon>
                                        <span>Dịch {{ strtoupper($defaultContentLocale) }} → {{ strtoupper($code) }}</span>
                                    </button>
                                </div>
                            @endif
                            
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-905" for="{{ $defaultTab ? 'title' : 'title_'.$code }}">{{ __('admin.posts.fields.title') }} @if($defaultTab)<span class="text-red-500">*</span>@endif</label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="{{ $defaultTab ? 'title' : 'title_'.$code }}" name="title[{{ $code }}]" value="{{ $title }}" data-i18n-locale="{{ $code }}" data-i18n-field="title" @required($defaultTab)>
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-905" for="{{ $defaultTab ? 'slug' : 'slug_'.$code }}">{{ __('admin.posts.fields.slug') }}</label>
                                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="{{ $defaultTab ? 'slug' : 'slug_'.$code }}" name="slug[{{ $code }}]" value="{{ $slug }}" data-i18n-locale="{{ $code }}" data-i18n-field="slug" placeholder="Tự tạo từ tiêu đề">
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-905" for="summary_{{ $code }}">{{ __('admin.posts.fields.summary') }}</label>
                                <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="summary_{{ $code }}" name="summary[{{ $code }}]" rows="3" data-i18n-locale="{{ $code }}" data-i18n-field="summary">{{ $summary }}</textarea>
                            </div>
                            
                            <div class="position-relative" @if($defaultTab) id="editor_wrapper" @endif>
                                <label class="block mb-2 text-sm font-semibold text-gray-905" for="{{ $defaultTab ? 'content_input' : 'content_input_'.$code }}">{{ __('admin.posts.fields.content') }} @if($defaultTab)<span class="text-red-500">*</span>@endif</label>
                                <textarea class="hidden" id="{{ $defaultTab ? 'content_input' : 'content_input_'.$code }}" name="content[{{ $code }}]" data-i18n-locale="{{ $code }}" data-i18n-field="content" data-translation-format="html" @required($defaultTab)>{{ $content }}</textarea>
                                <div id="{{ $defaultTab ? 'content_editor' : 'content_editor_'.$code }}" class="catalog-quill bg-white rounded-lg border border-gray-300" data-target="{{ $defaultTab ? 'content_input' : 'content_input_'.$code }}" style="height:350px">{!! app(\App\Support\HtmlSanitizer::class)->clean($content) !!}</div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-xl p-4 bg-gray-50/50 space-y-4">
                                <div>
                                    <div class="flex justify-between items-center mb-1.5">
                                        <label class="block text-sm font-semibold text-gray-905" for="{{ $defaultTab ? 'seo_title' : 'seo_title_'.$code }}">{{ __('admin.posts.fields.seo_title') }}</label>
                                        <span class="text-2xs text-gray-400"><span data-seo-title-count="{{ $code }}">{{ mb_strlen($seoTitle) }}</span>/60</span>
                                    </div>
                                    <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                                           id="{{ $defaultTab ? 'seo_title' : 'seo_title_'.$code }}"
                                           name="seo_title[{{ $code }}]"
                                           value="{{ $seoTitle }}"
                                           maxlength="255"
                                           data-seo-title-input="{{ $code }}"
                                           data-i18n-locale="{{ $code }}"
                                           data-i18n-field="seo_title">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-1.5">
                                        <label class="block text-sm font-semibold text-gray-905" for="{{ $defaultTab ? 'seo_description' : 'seo_description_'.$code }}">{{ __('admin.posts.fields.seo_description') }}</label>
                                        <span class="text-2xs text-gray-400"><span data-seo-description-count="{{ $code }}">{{ mb_strlen($seoDesc) }}</span>/160</span>
                                    </div>
                                    <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                                              id="{{ $defaultTab ? 'seo_description' : 'seo_description_'.$code }}"
                                              name="seo_description[{{ $code }}]"
                                              rows="3"
                                              maxlength="500"
                                              data-seo-description-input="{{ $code }}"
                                              data-i18n-locale="{{ $code }}"
                                              data-i18n-field="seo_description">{{ $seoDesc }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- SEO Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
            <h4 class="font-bold text-gray-900">{{ __('admin.posts.sections.seo') }}</h4>
            
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-905" for="seo_keys">{{ __('admin.posts.fields.seo_keys') }}</label>
                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="seo_keys" name="seo_keys" value="{{ old('seo_keys', $post->seo_keys) }}" placeholder="{{ __('admin.posts.placeholders.focus_keyword') }}">
                <p class="text-2xs text-gray-405 mt-1">{{ __('admin.posts.placeholders.focus_keyword_help') }}</p>
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-905" for="canonical_url">{{ __('admin.posts.fields.canonical_url') }}</label>
                <input type="url"
                       class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                       id="canonical_url"
                       name="canonical_url"
                       value="{{ old('canonical_url', $post->canonical_url) }}"
                       placeholder="https://example.com/bai-viet">
                <p class="text-2xs text-gray-405 mt-1">{{ __('admin.posts.placeholders.canonical_url_help') }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <input type="hidden" name="robots_index" value="0">
                    <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer"
                           type="checkbox"
                           id="robots_index"
                           name="robots_index"
                           value="1"
                           @checked((bool) old('robots_index', $post->exists ? $post->robots_index : true))>
                    <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="robots_index">Index (Cho công cụ tìm kiếm index)</label>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="robots_follow" value="0">
                    <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer"
                           type="checkbox"
                           id="robots_follow"
                           name="robots_follow"
                           value="1"
                           @checked((bool) old('robots_follow', $post->exists ? $post->robots_follow : true))>
                    <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="robots_follow">Follow links (Theo dõi liên kết)</label>
                </div>
            </div>

            <div class="border border-gray-200 rounded-xl p-4 bg-gray-50/50 space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <h5 class="font-bold text-gray-900 text-sm">{{ __('admin.posts.sections.google_preview') }}</h5>
                    <div class="inline-flex rounded-lg shadow-sm" role="group">
                        <button type="button" class="px-3 py-1.5 text-2xs font-bold text-gray-700 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-50 focus:z-10 focus:ring-1 focus:ring-primary active:bg-gray-100" data-seo-preview-device="desktop">
                            Desktop
                        </button>
                        <button type="button" class="px-3 py-1.5 text-2xs font-bold text-gray-700 bg-white border-t border-b border-r border-gray-200 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:ring-1 focus:ring-primary active:bg-gray-100" data-seo-preview-device="mobile">
                            Mobile
                        </button>
                    </div>
                </div>
                <div id="seo_google_preview_result" class="p-3 bg-white border border-gray-200 rounded-lg space-y-1">
                    <div class="text-2xs text-gray-400 select-none">{{ parse_url(config('app.url'), PHP_URL_HOST) ?: 'example.com' }}</div>
                    <div class="text-xs text-blue-650 font-semibold select-none truncate" id="seo_preview_url">{{ url('/') }}/...</div>
                    <div class="text-sm font-bold text-blue-800 truncate" id="seo_preview_title">{{ __('admin.posts.placeholders.seo_title') }}</div>
                    <div class="text-xs text-gray-505 leading-normal" id="seo_preview_description">{{ __('admin.posts.placeholders.seo_description') }}</div>
                </div>
            </div>
        </div>

        @include('admin.shared.form-actions', ['cancelUrl' => $cancelUrl])
    </div>

    <!-- Right column: Sidebar settings & SEO Analyzer Widget -->
    <div class="lg:col-span-4 space-y-6">
        <!-- Thumbnail Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-4">
            <h4 class="font-bold text-gray-900">{{ __('admin.posts.sections.thumbnail') }}</h4>
            
            <!-- Hidden file input for image select -->
            <input type="file" name="image_file" id="post_image_file" class="hidden" accept="image/*" data-media-folder="posts">
            
            <!-- Styled image preview area -->
            <div id="post_image_preview_container" class="relative text-center border-2 border-dashed border-gray-300 rounded-xl p-4 cursor-pointer flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100/50 transition-colors" 
                 style="min-height: 180px;" 
                 onclick="document.getElementById('post_image_file').click()">
                 
                <img id="post_image_preview" src="{{ $post->image_url ?: '#' }}" 
                     class="max-h-40 rounded-lg shadow-sm border border-gray-200 object-contain {{ $post->image_url ? '' : 'hidden' }}">
                 
                <div id="post_image_placeholder" class="text-center py-4 {{ $post->image_url ? 'hidden' : '' }}">
                    <iconify-icon icon="solar:camera-add-linear" class="text-4xl text-gray-400 mb-2"></iconify-icon>
                    <div class="text-gray-450 text-xs font-semibold">{{ __('admin.posts.placeholders.image_help') }}</div>
                </div>
            </div>
            <p class="text-3xs text-gray-450 text-center mb-0">{{ __('admin.posts.placeholders.image_types') }}</p>
        </div>

        <!-- Status Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-4">
            <div class="flex align-items-center justify-between gap-3">
                <h4 class="font-bold text-gray-900">{{ __('admin.posts.sections.publish') }}</h4>
                <div class="w-3.5 h-3.5 {{ old('is_active', $post->is_active) ? 'bg-emerald-500' : 'bg-red-500' }} rounded-full shrink-0"></div>
            </div>
            <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="is_active">
                <option value="1" @selected((string) old('is_active', $post->is_active) === '1')>{{ __('admin.posts.fields.active') }}</option>
                <option value="0" @selected((string) old('is_active', $post->is_active) === '0')>{{ __('admin.posts.fields.inactive') }}</option>
            </select>
            <p class="text-2xs text-gray-450">{{ __('admin.posts.placeholders.status_help') }}</p>
        </div>

        <!-- Category Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-4">
            <h4 class="font-bold text-gray-900">{{ __('admin.posts.sections.category') }}</h4>
            <div>
                <select name="category_id" id="category_id" class="catalog-select2 block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:outline-none select2-select">
                    <option value="">{{ __('admin.posts.uncategorized') }}</option>
                    @foreach($categories as $category)
                        @php
                            $catName = $category->getTranslation('name', app()->getLocale(), false) ?: $category->getTranslation('name', $fallbackLocale, false);
                        @endphp
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                            {!! str_repeat('&nbsp;&nbsp;', $category->depth ?? 0) !!}{{ $category->depth ? '↳ ' : '' }}{{ $catName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <p class="text-2xs text-gray-450">{{ __('admin.posts.placeholders.category_help') }}</p>
        </div>

        <!-- Live SEO Analyzer Widget (Yoast Style) -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-gray-150 pb-2">
                <h4 class="font-bold text-emerald-650 flex items-center gap-1.5">
                    <iconify-icon icon="solar:ranking-bold-duotone" class="text-xl"></iconify-icon>
                    <span>{{ __('admin.posts.sections.seo_analysis') }}</span>
                </h4>
                <span class="inline-block bg-gray-500 text-white text-3xs font-bold px-2 py-0.5 rounded-full" id="seo_overall_badge">{{ __('admin.posts.seo_widget.status_need_optimize') }}</span>
            </div>

            <!-- Circular Progress Score -->
            <div class="text-center py-2 flex flex-col items-center justify-center">
                <div class="relative inline-flex">
                    <svg class="seo-progress-ring" width="100" height="100">
                        <circle class="text-gray-100" stroke="#f3f4f6" stroke-width="8" fill="transparent" r="40" cx="50" cy="50"/>
                        <circle class="seo-progress-ring-circle" id="seo_progress_circle" stroke="#ef4444" stroke-width="8" stroke-dasharray="251.2" stroke-dashoffset="251.2" fill="transparent" r="40" cx="50" cy="50"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-xl font-bold text-gray-900" id="seo_score_txt">{{ (int) ($post->seo_score ?? 0) }}</span>
                        <span class="text-xs text-gray-400">/100</span>
                    </div>
                </div>
                <div class="mt-2.5">
                    <span class="text-xs font-bold" id="seo_rating_label" style="color: #ef4444;">{{ __('admin.posts.seo_widget.rating_too_short') }}</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 text-center">
                <div class="border border-gray-200 rounded-lg p-2 bg-gray-50/20">
                    <div class="font-bold text-gray-900 text-sm" id="seo_word_count">0</div>
                    <div class="text-3xs text-gray-400 uppercase tracking-wider mt-0.5">{{ __('admin.posts.seo_widget.word_count') }}</div>
                </div>
                <div class="border border-gray-200 rounded-lg p-2 bg-gray-50/20">
                    <div class="font-bold text-gray-900 text-sm" id="seo_keyword_density">0%</div>
                    <div class="text-3xs text-gray-400 uppercase tracking-wider mt-0.5">{{ __('admin.posts.seo_widget.keyword_density') }}</div>
                </div>
            </div>

            <!-- Analysis Checklist -->
            <div class="seo-checklist space-y-2.5 border-t border-gray-150 pt-4">
                <h6 class="text-3xs font-extrabold text-gray-400 uppercase tracking-wider">{{ __('admin.posts.sections.seo_results') }}</h6>
                
                <div class="seo-rule-item" id="rule_keyword_exists">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.keyword_exists') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_title_length">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.title_length') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_title_keyword">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.title_keyword') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_slug_keyword">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.slug_keyword') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_desc_length">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.desc_length') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_desc_keyword">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.desc_keyword') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_content_length">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.content_length') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_keyword_density">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.keyword_density') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_first_paragraph">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.first_paragraph') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_headings">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.headings') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_image_alts">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.image_alts') }}</span>
                </div>
                <div class="seo-rule-item" id="rule_internal_links">
                    <span class="seo-status-dot seo-status-red"></span>
                    <span>{{ __('admin.posts.seo_widget.rules.internal_links') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.shared.translation-assets')
