@extends('admin.layouts.app')

@section('title', __('catalog.products.edit'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/dropzone/dist/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1 text-white">{{ __('catalog.products.edit') }}</h4>
            <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <a href="{{ route('admin.products.index') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.menu.products') }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('catalog.products.edit') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" class="admin-form-with-sticky-actions space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.catalog.products._form')
    </form>
@endsection

@include('admin.catalog.products._form-assets')
