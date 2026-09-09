@php
    $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
    $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
    $cancelUrl = route('admin.projects.index');
@endphp

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Left column: Main Content and Multilingual fields -->
    <div class="lg:col-span-8 space-y-6">
        <!-- Multilingual Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-bold text-gray-900">{{ __('admin.projects.sections.general') }}</h4>
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
                            $title = old("title.$code", $project->getTranslation('title', $code, false));
                            $location = old("location.$code", $project->getTranslation('location', $code, false));
                            $summary = old("summary.$code", $project->getTranslation('summary', $code, false));
                            $content = old("content.$code", $project->getTranslation('content', $code, false));
                            $defaultTab = $code === $defaultContentLocale;
                        @endphp
                        <div x-show="activeLanguage === '{{ $code }}'" class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900" for="title_{{ $code }}">
                                    {{ __('admin.projects.fields.title') }} @if($defaultTab)<span class="text-red-500">*</span>@endif
                                </label>
                                <input type="text"
                                       class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                                       id="title_{{ $code }}"
                                       name="title[{{ $code }}]"
                                       value="{{ $title }}"
                                       @if($defaultTab) required @endif>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900" for="location_{{ $code }}">
                                    {{ __('admin.projects.fields.location') }} ({{ strtoupper($code) }})
                                </label>
                                <input type="text"
                                       class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                                       id="location_{{ $code }}"
                                       name="location[{{ $code }}]"
                                       value="{{ $location }}"
                                       placeholder="Ví dụ: Seychelles / Singapore / Đà Nẵng">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900" for="summary_{{ $code }}">
                                    {{ __('admin.projects.fields.summary') }} ({{ strtoupper($code) }})
                                </label>
                                <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                                          id="summary_{{ $code }}"
                                          name="summary[{{ $code }}]"
                                          rows="3"
                                          placeholder="Giới thiệu tổng quan về dự án">{{ $summary }}</textarea>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-900" for="content_{{ $code }}">
                                    {{ __('admin.projects.fields.scope_of_work') }} ({{ strtoupper($code) }})
                                </label>
                                <textarea class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors"
                                          id="content_{{ $code }}"
                                          name="content[{{ $code }}]"
                                          rows="5"
                                          placeholder="What LuxLight provides: Chi tiết phạm vi cung cấp thiết bị và giải pháp">{{ $content }}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Gallery Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6" x-data="{
            galleryList: {{ json_encode(old('gallery', $project->gallery ?: [])) }},
            removeGallery(index) {
                this.galleryList.splice(index, 1);
            }
        }">
            <h4 class="font-bold text-gray-900 mb-4">{{ __('admin.projects.sections.gallery') }}</h4>

            <div class="space-y-4">
                <template x-for="(img, idx) in galleryList" :key="idx">
                    <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg border border-gray-200">
                        <img :src="img" alt="Gallery" class="w-16 h-12 object-cover rounded">
                        <input type="text" name="gallery[]" x-model="galleryList[idx]" class="flex-1 p-2 text-xs border rounded bg-white font-mono">
                        <button type="button" @click="removeGallery(idx)" class="p-2 text-red-500 hover:text-red-700">
                            <iconify-icon icon="solar:trash-bin-trash-linear" class="text-lg"></iconify-icon>
                        </button>
                    </div>
                </template>

                <div>
                    <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        {{ __('admin.projects.fields.upload_gallery') }}
                    </label>
                    <input type="file" name="gallery_images[]" multiple accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    <p class="text-xs text-gray-400 mt-1">Định dạng hỗ trợ: JPG, PNG, WEBP, GIF (Tối đa 5MB/ảnh).</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right column: Taxonomy, Media and Status -->
    <div class="lg:col-span-4 space-y-6">
        <!-- Settings Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-4">
            <h4 class="font-bold text-gray-900 pb-2 border-b border-gray-100">{{ __('admin.projects.sections.settings') }}</h4>

            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider" for="category">
                    {{ __('admin.projects.fields.category') }} <span class="text-red-500">*</span>
                </label>
                <select name="category" id="category" required class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    @foreach($categories as $catKey => $catInfo)
                        <option value="{{ $catKey }}" @selected(old('category', $project->category) === $catKey)>
                            {{ $catInfo[app()->getLocale()] ?? $catInfo['vi'] ?? ucfirst($catKey) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider" for="client">
                    {{ __('admin.projects.fields.client') }}
                </label>
                <input type="text" name="client" id="client" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" value="{{ old('client', $project->client) }}" placeholder="Ví dụ: Constance Hotels">
            </div>

            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider" for="completion_year">
                    {{ __('admin.projects.fields.completion_year') }}
                </label>
                <input type="text" name="completion_year" id="completion_year" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" value="{{ old('completion_year', $project->completion_year) }}" placeholder="Ví dụ: Project Completion in 2016">
            </div>

            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider" for="sort_order">
                    {{ __('admin.projects.fields.sort_order') }}
                </label>
                <input type="number" name="sort_order" id="sort_order" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0">
            </div>

            <div class="pt-2 space-y-3">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $project->is_active ?? true)) class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary">
                    <span class="text-sm font-semibold text-gray-800">{{ __('admin.projects.fields.active') }}</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $project->is_featured ?? false)) class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary">
                    <span class="text-sm font-semibold text-gray-800">{{ __('admin.projects.fields.featured') }}</span>
                </label>
            </div>
        </div>

        <!-- Featured & Banner Image Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-4">
            <h4 class="font-bold text-gray-900 pb-2 border-b border-gray-100">{{ __('admin.projects.sections.media') }}</h4>

            <!-- Thumbnail -->
            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    {{ __('admin.projects.fields.thumbnail') }}
                </label>
                @if($project->image_url)
                    <div class="mb-2">
                        <img src="{{ $project->image_url }}" alt="Thumbnail" class="w-full h-36 object-cover rounded-lg border">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-gray-100 file:text-gray-700">
                <input type="text" name="image_url" value="{{ old('image_url', $project->image_url) }}" placeholder="Hoặc dán URL ảnh..." class="mt-2 block w-full p-2 text-xs border rounded bg-white">
            </div>

            <!-- Banner -->
            <div>
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    {{ __('admin.projects.fields.banner') }}
                </label>
                @if($project->banner_url)
                    <div class="mb-2">
                        <img src="{{ $project->banner_url }}" alt="Banner" class="w-full h-28 object-cover rounded-lg border">
                    </div>
                @endif
                <input type="file" name="banner" accept="image/*" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:bg-gray-100 file:text-gray-700">
                <input type="text" name="banner_url" value="{{ old('banner_url', $project->banner_url) }}" placeholder="Hoặc dán URL ảnh banner..." class="mt-2 block w-full p-2 text-xs border rounded bg-white">
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center gap-3">
            <button type="submit" class="flex-1 py-2.5 px-4 text-sm font-bold text-white bg-primary hover:bg-primary/90 rounded-lg shadow-sm transition-all text-center">
                <iconify-icon icon="solar:diskette-linear" class="mr-1 text-base inline-block"></iconify-icon>
                {{ __('admin.save') }}
            </button>
            <a href="{{ $cancelUrl }}" class="py-2.5 px-4 text-sm font-semibold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg transition-colors text-center">
                {{ __('admin.cancel') }}
            </a>
        </div>
    </div>
</div>
