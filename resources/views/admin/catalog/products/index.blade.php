@extends('admin.layouts.app')

@section('title', __('catalog.products.title'))

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1">{{ __('catalog.products.title') }}</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a class="hover:text-white transition-colors" href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">{{ __('catalog.products.title') }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="flex flex-wrap gap-2">
                <button type="button" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none text-info bg-info/10 border border-info/20 hover:bg-info/20 px-4 py-2 text-sm" data-bs-toggle="modal" data-bs-target="#importProductsModal">
                    <iconify-icon icon="solar:upload-linear" class="mr-1 text-base"></iconify-icon> {{ __('catalog.products.import') }}
                </button>
                <a href="{{ route('admin.products.export', request()->query()) }}" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none text-emerald-650 bg-emerald-50 border border-emerald-100 hover:bg-emerald-100 px-4 py-2 text-sm">
                    <iconify-icon icon="solar:download-linear" class="mr-1 text-base"></iconify-icon> {{ __('catalog.products.export') }}
                </a>
                <x-admin.button variant="primary" size="sm" href="{{ route('admin.products.create') }}">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('catalog.products.create') }}
                </x-admin.button>
            </div>
        </div>
    </div>

    @if(session('import_errors'))
        <div class="p-4 mb-6 text-sm text-amber-800 rounded-lg bg-amber-50 border border-amber-200" role="alert">
            <div class="flex items-center gap-2 mb-2 font-bold">
                <iconify-icon icon="solar:danger-triangle-bold" class="text-lg"></iconify-icon>
                <span>Chi tiết lỗi nhập dữ liệu:</span>
            </div>
            <ul class="list-disc list-inside space-y-1 max-h-48 overflow-y-auto pl-2">
                @foreach(session('import_errors') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Filter Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="col-span-12 md:col-span-4">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.actions.search') }}</label>
                <input type="search" name="q" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" value="{{ request('q') }}" placeholder="{{ __('catalog.products.search_placeholder') }}">
            </div>
            <div class="col-span-12 md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.fields.category') }}</label>
                <select name="category_id" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">Tất cả</option>
                    @foreach($categoryOptions as $category)
                        <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>
                            {!! str_repeat('&nbsp;&nbsp;', $category->depth ?? 0) !!}{{ $category->depth ? '↳ ' : '' }}{{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.fields.brand') }}</label>
                <select name="brand_id" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">Tất cả</option>
                    @foreach($brandOptions as $brandOption)
                        @php
                            $brandName = $brandOption->getTranslation('name', app()->getLocale(), false) ?: $brandOption->name;
                        @endphp
                        <option value="{{ $brandOption->id }}" @selected((string) request('brand_id') === (string) $brandOption->id)>
                            {{ $brandName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('catalog.fields.status') }}</label>
                <select name="status" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none">
                    <option value="">Tất cả</option>
                    <option value="1" @selected((string) request('status') === '1')>{{ __('catalog.status.active') }}</option>
                    <option value="0" @selected((string) request('status') === '0')>{{ __('catalog.status.inactive') }}</option>
                </select>
            </div>
            <div class="col-span-12 md:col-span-1">
                <x-admin.button type="submit" variant="primary" size="md" class="w-full text-center flex items-center justify-center">
                    <iconify-icon icon="solar:magnifer-linear" class="text-lg"></iconify-icon>
                </x-admin.button>
            </div>
        </form>
    </div>

    <!-- Table List Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col justify-between mb-8">
        <div>
            @include('admin.shared.bulk-actions', [
                'bulkFormId' => 'bulk-products-form',
                'bulkActionUrl' => route('admin.products.bulk'),
                'bulkItemLabel' => 'sản phẩm',
            ])
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3" style="width: 44px;">
                                <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" data-bulk-select-all="bulk-products-form" aria-label="Chọn tất cả sản phẩm">
                            </th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.name') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.category') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.brand') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.price') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.stock_quantity') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.variants') }}</th>
                            <th class="px-6 py-3 font-bold">{{ __('catalog.fields.status') }}</th>
                            <th class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" name="ids[]" value="{{ $product->id }}" form="bulk-products-form" data-bulk-select="bulk-products-form" aria-label="Chọn {{ $product->name }}">
                                </td>
                                <td class="px-6 py-4 max-w-sm">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-lg border border-gray-200 bg-white p-0.5 flex items-center justify-center overflow-hidden flex-shrink-0">
                                            <img src="{{ $product->image_url ?: asset('images/icons/default-product.png') }}"
                                                 onerror="this.src='{{ asset('images/icons/default-product.png') }}'"
                                                 alt="{{ $product->name }}"
                                                 class="w-full h-full object-contain rounded-md">
                                        </div>
                                        <div class="min-w-0">
                                            <h6 class="font-bold text-gray-900 truncate hover:text-primary transition-colors">
                                                <a href="{{ route('admin.products.show', $product) }}">{{ $product->name }}</a>
                                            </h6>
                                            <div class="text-2xs text-gray-400 flex items-center gap-1.5 mt-0.5">
                                                <span>SKU: <strong class="text-gray-700">{{ $product->sku ?: '-' }}</strong></span>
                                                @if($product->slug)
                                                    <span>|</span>
                                                    <span class="truncate max-w-[120px]">{{ $product->slug }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->category)
                                        <x-admin.badge variant="primary">{{ $product->category->name }}</x-admin.badge>
                                    @else
                                        <span class="text-gray-405 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->brand)
                                        <x-admin.badge variant="warning">{{ $product->brand->name }}</x-admin.badge>
                                    @else
                                        <span class="text-gray-405 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">
                                    {{ number_format((float) $product->price) }} đ
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-semibold">
                                    {{ number_format((int) $product->stock_quantity) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->variants_count > 0)
                                        <x-admin.badge variant="info">{{ $product->variants_count }} {{ __('catalog.fields.variants') }}</x-admin.badge>
                                    @else
                                        <span class="text-gray-400 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->is_active)
                                        <x-admin.badge variant="success">{{ __('catalog.status.active') }}</x-admin.badge>
                                    @else
                                        <x-admin.badge variant="danger">{{ __('catalog.status.inactive') }}</x-admin.badge>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <x-admin.dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                                <iconify-icon icon="solar:menu-dots-bold" class="text-xl"></iconify-icon>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <a class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('admin.products.show', $product) }}">
                                                <iconify-icon icon="solar:eye-linear" class="text-base text-gray-550"></iconify-icon>
                                                <span>{{ __('catalog.actions.view') }}</span>
                                            </a>
                                            <a class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('admin.products.edit', $product) }}">
                                                <iconify-icon icon="solar:pen-linear" class="text-base text-gray-550"></iconify-icon>
                                                <span>{{ __('catalog.actions.edit') }}</span>
                                            </a>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="js-delete-form block border-t border-gray-100">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center w-full gap-2 px-4 py-2.5 text-sm text-red-650 hover:bg-red-50 transition-colors text-left font-semibold">
                                                    <iconify-icon icon="solar:trash-bin-trash-linear" class="text-base"></iconify-icon>
                                                    <span>{{ __('catalog.actions.delete') }}</span>
                                                </button>
                                            </form>
                                        </x-slot>
                                    </x-admin.dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-10 text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <img src="{{ asset('admin-assets/images/icons/emptydata.png') }}" alt="No data" class="h-14 w-auto mb-2 opacity-60">
                                        <p class="text-sm font-semibold">{{ __('catalog.common.no_data') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(!$products->isEmpty())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importProductsModal" tabindex="-1" aria-labelledby="importProductsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('admin.products.import') }}" class="modal-content overflow-hidden rounded-xl border border-gray-200 shadow-xl" enctype="multipart/form-data">
                @csrf
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gray-50/50">
                    <h5 class="modal-title font-bold text-gray-900" id="importProductsModalLabel">
                        {{ __('catalog.products.import_title') }}
                    </h5>
                    <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none" data-bs-dismiss="modal">
                        <iconify-icon icon="solar:close-circle-linear" class="text-2xl"></iconify-icon>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="import_type">{{ __('catalog.products.import_type') }}</label>
                        <select name="import_type" id="import_type" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" required>
                            <option value="standard" selected>{{ __('catalog.products.import_type_standard') }}</option>
                            <option value="wordpress">{{ __('catalog.products.import_type_wordpress') }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1.5 text-xs font-semibold text-gray-700" for="import_file">{{ __('catalog.products.import_file') }} <span class="text-red-500">*</span></label>
                        <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none" name="import_file" id="import_file" accept=".csv,text/csv" required>
                        <p class="text-2xs text-gray-400 mt-1">Hỗ trợ tệp CSV tối đa 5MB.</p>
                    </div>
                    <div class="p-4 bg-gray-50 border border-gray-150 rounded-xl space-y-3">
                        <h6 class="text-xs font-bold text-gray-900 flex items-center gap-1">
                            <iconify-icon icon="solar:download-linear" class="text-primary text-base"></iconify-icon>
                            Tải xuống tệp mẫu:
                        </h6>
                        <div class="flex gap-2.5">
                            <a href="{{ route('admin.products.template', ['type' => 'standard']) }}" class="flex-1 inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 py-2 text-xs">
                                Standard CSV
                            </a>
                            <a href="{{ route('admin.products.template', ['type' => 'wordpress']) }}" class="flex-1 inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-350 bg-white text-gray-700 hover:bg-gray-55 py-2 text-xs">
                                WordPress CSV
                            </a>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50/50 flex justify-end gap-3">
                    <button type="button" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-4 py-2 text-sm" data-bs-dismiss="modal">
                        {{ __('catalog.actions.cancel') }}
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white px-4 py-2 text-sm">
                        {{ __('catalog.products.import') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
