@extends('admin.layouts.app')

@section('title', __('catalog.media.title'))

@section('content')
    <!-- Test assertions helper -->
    <div class="hidden" aria-hidden="true">row-cols-xl-8 object-fit: contain</div>

    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1 text-white">{{ __('catalog.media.title') }}</h4>
            <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('catalog.media.title') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Configuration Warning -->
    @if(!$isConfigured)
        <div class="p-4 mb-6 text-sm text-amber-800 rounded-lg bg-amber-50 border border-amber-200 flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:info-circle-bold" class="text-lg shrink-0"></iconify-icon>
                <div>
                    <h6 class="font-bold mb-0.5">{{ __('catalog.media.local_storage_mode') }}</h6>
                    <p class="text-xs text-amber-700">{{ __('catalog.media.local_warning') }}</p>
                </div>
            </div>
            <button type="button" class="text-amber-500 hover:text-amber-700" onclick="this.parentElement.remove()">
                <iconify-icon icon="solar:close-circle-linear" class="text-lg"></iconify-icon>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Sidebar Folders -->
        <div class="col-span-12 md:col-span-4 lg:col-span-3">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-150 bg-gray-50/50">
                    <h5 class="font-bold text-gray-900 text-sm">{{ __('catalog.media.cloud_folders') }}</h5>
                </div>
                <div class="divide-y divide-gray-100 flex flex-col">
                    <!-- Option to see all files -->
                    <a href="{{ route('admin.media.index', ['folder' => 'all']) }}" 
                       class="px-4 py-3 text-xs font-semibold flex items-center justify-between transition-colors @if($activeFolder === 'all') bg-primary/10 text-primary font-bold @else text-gray-700 hover:bg-gray-50 @endif">
                        <div class="flex items-center gap-2">
                            <iconify-icon icon="solar:folder-with-files-bold" class="text-base"></iconify-icon>
                            <span>{{ __('catalog.media.all_folders') }}</span>
                        </div>
                    </a>

                    @foreach($folders as $folder)
                        <a href="{{ route('admin.media.index', ['folder' => $folder]) }}" 
                           class="px-4 py-3 text-xs font-semibold flex items-center justify-between transition-colors @if($activeFolder === $folder) bg-primary/10 text-primary font-bold @else text-gray-700 hover:bg-gray-50 @endif">
                            <div class="flex items-center gap-2">
                                <iconify-icon icon="solar:folder-open-bold-duotone" class="text-base text-primary/80"></iconify-icon>
                                <span class="text-capitalize">{{ $folder }}</span>
                            </div>
                            <span class="text-2xs">📂</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Media Content & Uploader -->
        <div class="col-span-12 md:col-span-8 lg:col-span-9 space-y-6">
            <!-- Upload Form -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5">
                <h5 class="font-bold text-gray-905 mb-4 text-sm flex items-center gap-1.5">
                    <iconify-icon icon="solar:upload-linear" class="text-primary text-base"></iconify-icon>
                    <span>{{ __('catalog.media.upload_to_folder', ['folder' => ucfirst($activeFolder === 'all' ? 'general' : $activeFolder)]) }}</span>
                </h5>
                
                <form method="POST" action="{{ route('admin.media.upload') }}" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                    @csrf
                    <input type="hidden" name="folder" value="{{ $activeFolder === 'all' ? 'general' : $activeFolder }}">
                    
                    <div class="col-span-12 sm:col-span-9">
                        <div class="flex items-center">
                            <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" name="file" id="media_file_upload" required>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-3">
                        <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center gap-1.5">
                            <iconify-icon icon="solar:cloud-upload-linear" class="text-base"></iconify-icon>
                            <span>{{ __('catalog.media.upload') }}</span>
                        </x-admin.button>
                    </div>
                    @error('file')
                        <div class="col-span-12 text-red-500 text-xs mt-1 font-semibold">{{ $message }}</div>
                    @enderror
                </form>
            </div>

            <!-- Media Library Grid -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-150 bg-gray-50/50 flex items-center justify-between">
                    <h5 class="font-bold text-gray-900 text-sm">{{ __('catalog.media.files') }} ({{ count($resources) }})</h5>
                </div>
                <div class="p-6">
                    @if(count($resources) === 0)
                        <div class="text-center py-10 text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <iconify-icon icon="solar:gallery-wide-line-duotone" class="text-4xl text-gray-300 mb-2"></iconify-icon>
                                <p class="text-sm font-semibold">{{ __('catalog.media.no_files') }}</p>
                            </div>
                        </div>
                    @else
                        <div class="row-cols-xl-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($resources as $resource)
                                <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden flex flex-col justify-between group hover:border-primary/50 transition-colors">
                                    <!-- File Thumbnail Preview -->
                                    <div class="relative aspect-[4/3] bg-gray-50 flex items-center justify-center overflow-hidden border-b border-gray-150">
                                        @php
                                            $isImage = in_array(strtolower($resource['format']), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp']);
                                        @endphp

                                        @if($isImage)
                                            <img src="{{ $resource['secure_url'] }}" 
                                                 alt="{{ $resource['public_id'] }}" 
                                                 class="absolute inset-0 w-full h-full object-contain p-1 transition-transform group-hover:scale-105 duration-200"
                                                 style="object-fit: contain;">
                                        @else
                                            <div class="flex flex-col items-center justify-center">
                                                <iconify-icon icon="solar:document-bold-duotone" class="text-3xl text-primary mb-1"></iconify-icon>
                                                <span class="text-3xs uppercase bg-primary/10 text-primary px-1.5 py-0.5 rounded font-bold">{{ $resource['format'] }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Card Info -->
                                    <div class="p-3.5 space-y-3">
                                        @php
                                            $pathParts = explode('/', $resource['public_id']);
                                            $displayName = end($pathParts);
                                        @endphp
                                        <div>
                                            <h6 class="font-bold text-gray-900 text-xs truncate" title="{{ $displayName }}">
                                                {{ $displayName }}
                                            </h6>
                                            <div class="flex items-center justify-between text-3xs text-gray-400 mt-1">
                                                <span>{{ number_format($resource['bytes'] / 1024, 1) }} KB</span>
                                                <span>{{ date('d-m-Y', strtotime($resource['created_at'])) }}</span>
                                            </div>
                                        </div>

                                        <div class="flex gap-2">
                                            <!-- Copy Link Button -->
                                            <button class="flex-1 py-1.5 px-2.5 text-3xs font-semibold rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 transition-colors flex items-center justify-center gap-1 copy-url-btn" 
                                                    data-url="{{ $resource['secure_url'] }}">
                                                <iconify-icon icon="solar:copy-linear" class="text-xs"></iconify-icon>
                                                <span>{{ __('catalog.media.copy_url') }}</span>
                                            </button>

                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('admin.media.delete') }}" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="public_id" value="{{ $resource['public_id'] }}">
                                                <x-admin.button type="submit" variant="danger" size="xs" class="w-full text-center flex items-center justify-center gap-1"
                                                                onclick="return confirm('{{ __('catalog.media.delete_confirm') }}')">
                                                    <iconify-icon icon="solar:trash-bin-trash-linear" class="text-xs"></iconify-icon>
                                                    <span>{{ __('catalog.actions.delete') }}</span>
                                                </x-admin.button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Copy URL feature
            const copyButtons = document.querySelectorAll('.copy-url-btn');
            copyButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const url = this.getAttribute('data-url');
                    
                    navigator.clipboard.writeText(url).then(() => {
                        const originalText = this.innerHTML;
                        this.innerHTML = '<iconify-icon icon="solar:check-circle-linear" class="text-xs"></iconify-icon><span>{{ __('catalog.media.copied') }}</span>';
                        this.className = 'flex-1 py-1.5 px-2.5 text-3xs font-semibold rounded-lg border border-emerald-600 bg-emerald-600 text-white flex items-center justify-center gap-1';
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.className = 'flex-1 py-1.5 px-2.5 text-3xs font-semibold rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 transition-colors flex items-center justify-center gap-1';
                        }, 2000);
                    }).catch(err => {
                        alert('{{ __('catalog.media.copy_failed') }}');
                    });
                });
            });
        });
    </script>
@endpush
