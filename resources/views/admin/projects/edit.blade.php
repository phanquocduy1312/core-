@extends('admin.layouts.app')

@section('title', __('admin.projects.edit_title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.projects.edit_title') }}: {{ $project->getTranslation('title', app()->getLocale()) ?: $project->getTranslation('title', 'en') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <a href="{{ route('admin.projects.index') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.projects.title') }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('admin.edit') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ url('/projects/' . $project->slug) }}" target="_blank" class="px-3 py-2 text-xs font-semibold text-slate-200 hover:text-white bg-slate-800 hover:bg-slate-700 border border-slate-600 rounded-lg transition-colors inline-flex items-center gap-1.5">
                    <iconify-icon icon="solar:eye-linear" class="text-base"></iconify-icon>
                    <span>Xem trang</span>
                </a>
                <x-admin.button variant="secondary" size="sm" href="{{ route('admin.projects.index') }}">
                    <iconify-icon icon="solar:arrow-left-linear" class="mr-1"></iconify-icon> {{ __('admin.back') }}
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Error Summary -->
    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
            <div class="flex items-center gap-2 mb-2 font-bold">
                <iconify-icon icon="solar:danger-triangle-bold" class="text-lg"></iconify-icon>
                <span>Vui lòng kiểm tra lại thông tin:</span>
            </div>
            <ul class="list-disc list-inside space-y-1 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.projects._form')
    </form>
@endsection
