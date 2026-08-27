@extends('admin.layouts.app')

@section('title', __('admin.posts.edit'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/select2/dist/css/select2.min.css') }}">
    <style>
        .seo-checker-card {
            border: 1px solid rgba(22, 163, 74, 0.15);
            background-color: rgba(22, 163, 74, 0.02);
            border-radius: 8px;
        }
        .seo-rule-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.85rem;
            margin-bottom: 8px;
        }
        .seo-status-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
            margin-top: 3px;
        }
        .seo-status-red {
            background-color: #ef4444;
        }
        .seo-status-orange {
            background-color: #f97316;
        }
        .seo-status-green {
            background-color: #22c55e;
        }
        .seo-status-red + span {
            color: #ef4444;
        }
        .seo-status-orange + span {
            color: #f97316;
        }
        .seo-status-green + span {
            color: #22c55e;
        }
        .seo-progress-ring-circle {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>
@endpush

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.posts.edit') }}</h4>
            <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <a href="{{ route('admin.posts.index') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.menu.blog') }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.posts.edit') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Form Section -->
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="admin-form-with-sticky-actions space-y-6">
        @csrf
        @method('PUT')
        @include('admin.posts._form')
    </form>
@endsection

@include('admin.posts._form-assets')
