@extends('admin.layouts.app')

@section('title', __('admin.banners.edit'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.banners.edit') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <a href="{{ route('admin.banners.index') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.banners.title') }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.banners.edit') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="outline" size="sm" href="{{ route('admin.banners.index') }}">
                    Quay lại
                </x-admin.button>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="font-bold">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 max-w-4xl">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Banner Image Preview & Upload -->
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.banners.fields.image') }}</label>
                
                <!-- Current Image Preview -->
                <div class="mb-4 text-center p-4 bg-gray-50 border border-gray-200 rounded-xl max-w-sm mx-auto">
                    <span class="block text-xs text-gray-400 mb-2">Hình ảnh hiện tại:</span>
                    <img src="{{ $banner->image_url }}" alt="Current Banner" class="mx-auto rounded-lg shadow-sm border border-gray-200 max-h-40 object-contain">
                </div>

                <div class="p-6 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100/50 transition-colors text-center relative cursor-pointer">
                    <iconify-icon icon="solar:camera-add-linear" class="text-4xl text-gray-400 mb-2"></iconify-icon>
                    <h6 class="text-sm font-bold text-gray-900 mb-0.5">Thay đổi tập tin ảnh banner (nếu muốn)</h6>
                    <p class="text-2xs text-gray-400">Chấp nhận JPG, PNG, WEBP tối đa 2MB. Bỏ trống nếu muốn giữ ảnh cũ.</p>
                    <input type="file" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" id="image_file" name="image_file" accept="image/*" data-media-folder="banners">
                    
                    <div id="imagePreviewContainer" class="mt-4 hidden flex flex-col items-center">
                        <span class="block text-xs text-emerald-650 font-bold mb-2">Hình ảnh mới thay thế:</span>
                        <img id="imagePreview" src="" alt="New Preview" class="max-h-40 rounded-lg shadow-sm border border-emerald-100 object-contain">
                    </div>
                </div>
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.banners.fields.title') }}</label>
                <input type="text" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="title" name="title" value="{{ old('title', $banner->title) }}" placeholder="Nhập tiêu đề hoặc mô tả ngắn">
            </div>

            <!-- Destination URL Link -->
            <div>
                <label for="link_url" class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.banners.fields.link') }}</label>
                <input type="url" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="link_url" name="link_url" value="{{ old('link_url', $banner->link_url) }}" placeholder="https://example.com/san-pham">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Position -->
                <div>
                    <label for="position" class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.banners.fields.position') }} <span class="text-red-500">*</span></label>
                    <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" id="position" name="position" required>
                        <option value="home_main" @selected(old('position', $banner->position) === 'home_main')>{{ __('admin.banners.positions.home_main') }}</option>
                        <option value="home_sidebar" @selected(old('position', $banner->position) === 'home_sidebar')>{{ __('admin.banners.positions.home_sidebar') }}</option>
                        <option value="promotional" @selected(old('position', $banner->position) === 'promotional')>{{ __('admin.banners.positions.promotional') }}</option>
                    </select>
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block mb-2 text-sm font-semibold text-gray-900">{{ __('admin.banners.fields.sort_order') }} <span class="text-red-500">*</span></label>
                    <input type="number" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" id="sort_order" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" min="0" required>
                </div>
            </div>

            <!-- Active status Switch/Checkbox -->
            <div class="flex items-center pt-2">
                <input type="hidden" name="is_active" value="0">
                <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $banner->is_active ? '1' : '0') == '1' ? 'checked' : '' }}>
                <label class="ml-2 text-sm font-semibold text-gray-900 cursor-pointer" for="is_active">{{ __('admin.banners.fields.status') }}: {{ __('admin.banners.fields.active') }}</label>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-150">
                <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white px-5 py-2.5 text-sm">
                    <iconify-icon icon="solar:ssd-round-linear" class="mr-1"></iconify-icon>
                    Lưu thay đổi
                </button>
                <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-5 py-2.5 text-sm">
                    {{ __('catalog.actions.cancel') }}
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('image_file');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImg = document.getElementById('imagePreview');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function () {
                    previewImg.setAttribute('src', this.result);
                    previewContainer.classList.remove('hidden');
                });
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
                previewImg.setAttribute('src', '');
            }
        });
    });
</script>
@endpush
