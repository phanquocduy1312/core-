@extends('admin.layouts.app')

@section('title', __('admin.vouchers.create'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4">
            <h4 class="text-xl font-bold mb-1 text-white">{{ __('admin.vouchers.create') }}</h4>
            <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <a href="{{ route('admin.vouchers.index') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.vouchers.title') }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                            <span class="text-slate-400">{{ __('admin.vouchers.create') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.vouchers.store') }}" class="admin-form-with-sticky-actions space-y-6">
        @csrf
        @include('admin.vouchers._form')
    </form>
@endsection
