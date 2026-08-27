@extends('admin.layouts.app')

@section('title', $product->name)

@section('content')
    @php
        $productImage = $product->image_url ?: asset('images/icons/default-product.png');
        $fallbackImage = asset('images/icons/default-product.png');
        $totalStock = $product->usesVariantInventory()
            ? $product->variants->sum('stock_quantity')
            : $product->stock_quantity;
    @endphp

    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div class="min-w-0">
                <nav aria-label="breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 mb-2 text-sm text-slate-300">
                        <li class="inline-flex items-center">
                            <a class="hover:text-white transition-colors" href="{{ route('admin.dashboard') }}">
                                {{ __('admin.home') }}
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <a class="hover:text-white transition-colors" href="{{ route('admin.products.index') }}">
                                    {{ __('catalog.products.title') }}
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400 truncate max-w-[200px]">{{ $product->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h4 class="text-xl font-bold mb-1 truncate max-w-[600px]">{{ $product->name }}</h4>
                <div class="flex flex-wrap items-center gap-2 text-xs text-slate-405">
                    <span>SKU: <strong class="text-white">{{ $product->sku ?: '-' }}</strong></span>
                    @if($product->slug)
                        <span aria-hidden="true">•</span>
                        <span>{{ $product->slug }}</span>
                    @endif
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <x-admin.button variant="secondary" size="sm" href="{{ route('admin.products.index') }}">
                    <iconify-icon icon="solar:arrow-left-linear" class="mr-1"></iconify-icon> {{ __('catalog.actions.back') }}
                </x-admin.button>
                <x-admin.button variant="light" size="sm" href="{{ route('admin.products.edit', $product) }}">
                    <iconify-icon icon="solar:pen-linear" class="mr-1"></iconify-icon> {{ __('catalog.actions.edit') }}
                </x-admin.button>
            </div>
        </div>
    </div>

    <!-- Product Grid Info -->
    <div class="grid grid-cols-12 gap-6">
        <!-- Left Side: Image & Simple Stats -->
        <div class="col-span-12 xl:col-span-4 space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <!-- Image Wrapper -->
                <div class="flex items-center justify-center w-full min-h-[280px] aspect-square p-4 overflow-hidden border border-gray-200 rounded-xl bg-slate-50">
                    <img src="{{ $productImage }}"
                         onerror="this.onerror=null;this.src='{{ $fallbackImage }}'"
                         alt="{{ $product->name }}"
                         class="product-show-image max-w-full max-h-[360px] object-contain rounded-lg"
                         style="object-fit: contain;">
                </div>

                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-lg @if($product->is_active) text-emerald-700 bg-emerald-55 @else text-red-700 bg-red-55 @endif">
                        <iconify-icon icon="@if($product->is_active) solar:check-circle-bold @else solar:eye-closed-bold @endif" class="text-sm"></iconify-icon>
                        {{ $product->is_active ? __('catalog.status.active') : __('catalog.status.inactive') }}
                    </span>
                    @if($product->is_featured)
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold text-amber-705 bg-amber-50 rounded-lg">
                            <iconify-icon icon="solar:star-bold" class="text-sm"></iconify-icon>
                            {{ __('catalog.fields.is_featured') }}
                        </span>
                    @endif
                </div>

                @if($product->short_description)
                    <div class="mt-4 pt-4 border-t border-gray-100 text-sm text-gray-500 leading-relaxed">
                        {!! $product->short_description !!}
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Side: Details & Detailed Stats -->
        <div class="col-span-12 xl:col-span-8 space-y-6">
            <!-- Stat Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-red-50 text-primary rounded-xl flex items-center justify-center">
                        <iconify-icon icon="solar:double-alt-arrow-right-bold" class="text-2xl"></iconify-icon>
                    </div>
                    <div>
                        <div class="text-xs font-semibold text-gray-500 mb-0.5">{{ __('catalog.fields.price') }}</div>
                        <div class="text-lg font-bold text-gray-900">{{ number_format((float) $product->price) }} đ</div>
                        @if($product->compare_at_price)
                            <div class="text-xs text-gray-400 line-through">
                                {{ number_format((float) $product->compare_at_price) }} đ
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                        <iconify-icon icon="solar:box-bold" class="text-2xl"></iconify-icon>
                    </div>
                    <div>
                        <div class="text-xs font-semibold text-gray-500 mb-0.5">{{ __('catalog.fields.stock_quantity') }}</div>
                        <div class="text-lg font-bold text-gray-900">{{ number_format((int) $totalStock) }}</div>
                        <div class="text-2xs text-gray-400 mt-0.5">
                            {{ $product->usesVariantInventory() ? 'Tính theo SKU biến thể' : ($product->manage_stock ? 'Đang quản lý tồn kho' : 'Không theo dõi tồn kho') }}
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center">
                        <iconify-icon icon="solar:layers-bold" class="text-2xl"></iconify-icon>
                    </div>
                    <div>
                        <div class="text-xs font-semibold text-gray-500 mb-0.5">{{ __('catalog.fields.variants') }}</div>
                        <div class="text-lg font-bold text-gray-900">{{ $product->variants->count() }}</div>
                        <div class="text-2xs text-gray-400 mt-0.5">{{ $product->optionGroups->count() }} nhóm thuộc tính</div>
                    </div>
                </div>
            </div>

            <!-- Details Card -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50">
                    <h5 class="font-bold text-gray-900">{{ __('catalog.products.details') }}</h5>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-center gap-3.5">
                            <div class="p-2.5 bg-gray-50 text-gray-500 border border-gray-100 rounded-lg flex items-center justify-center">
                                <iconify-icon icon="solar:widget-3-linear" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 mb-0.5">{{ __('catalog.fields.category') }}</div>
                                <div class="font-bold text-gray-900">{{ $product->category?->name ?? __('catalog.common.none') }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3.5">
                            <div class="p-2.5 bg-gray-50 text-gray-500 border border-gray-100 rounded-lg flex items-center justify-center">
                                <iconify-icon icon="solar:sticker-linear" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 mb-0.5">{{ __('catalog.fields.brand') }}</div>
                                <div class="font-bold text-gray-900">{{ $product->brand?->name ?? __('catalog.common.none') }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3.5">
                            <div class="p-2.5 bg-gray-50 text-gray-500 border border-gray-100 rounded-lg flex items-center justify-center">
                                <iconify-icon icon="solar:barcode-linear" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 mb-0.5">{{ __('catalog.fields.sku') }}</div>
                                <div class="font-bold text-gray-900 font-mono">{{ $product->sku ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3.5">
                            <div class="p-2.5 bg-gray-50 text-gray-500 border border-gray-100 rounded-lg flex items-center justify-center">
                                <iconify-icon icon="solar:calendar-date-linear" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <div class="text-xs text-gray-400 mb-0.5">Ngày đăng</div>
                                <div class="font-bold text-gray-900">
                                    {{ ($product->published_at ?? $product->created_at)?->format('d/m/Y H:i') ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Long Description -->
    @if($product->description)
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mt-6">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50">
                <h5 class="font-bold text-gray-900">{{ __('catalog.fields.description') }}</h5>
            </div>
            <div class="p-6 prose prose-slate max-w-none text-sm text-gray-655 leading-relaxed">
                {!! $product->description !!}
            </div>
        </div>
    @endif

    <!-- Variants Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mt-6">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h5 class="font-bold text-gray-900">{{ __('catalog.variants.title') }}</h5>
                <div class="text-xs text-gray-505 mt-0.5">
                    {{ $product->variants->count() }} SKU · {{ $product->optionGroups->count() }} nhóm thuộc tính
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <x-admin.button variant="outline" size="sm" href="{{ route('admin.products.options.edit', $product) }}">
                    <iconify-icon icon="solar:tuning-square-linear" class="mr-1"></iconify-icon> Thuộc tính
                </x-admin.button>
                @if($product->optionGroups->isNotEmpty())
                    <form method="POST" action="{{ route('admin.products.variants.generate', $product) }}" class="inline">
                        @csrf
                        <x-admin.button variant="success" size="sm" type="submit">
                            <iconify-icon icon="solar:magic-stick-linear" class="mr-1"></iconify-icon> Tạo tổ hợp
                        </x-admin.button>
                    </form>
                    <x-admin.button variant="primary" size="sm" href="{{ route('admin.products.variants.create', $product) }}">
                        <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> {{ __('catalog.variants.create') }}
                    </x-admin.button>
                @endif
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 font-bold">{{ __('catalog.fields.name') }}</th>
                        <th class="px-6 py-3 font-bold">{{ __('catalog.fields.sku') }}</th>
                        <th class="px-6 py-3 font-bold">{{ __('catalog.fields.options') }}</th>
                        <th class="px-6 py-3 font-bold">{{ __('catalog.fields.price') }}</th>
                        <th class="px-6 py-3 font-bold">{{ __('catalog.fields.stock_quantity') }}</th>
                        <th class="px-6 py-3 font-bold">{{ __('catalog.fields.status') }}</th>
                        <th class="px-6 py-3 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-150">
                    @forelse($product->variants as $variant)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-gray-900">{{ $variant->name ?: '-' }}</div>
                                @if($variant->is_default)
                                    <span class="inline-flex items-center px-2 py-0.5 mt-1 text-2xs font-semibold text-blue-800 bg-blue-50 border border-blue-100 rounded-md">Mặc định</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-mono text-gray-700">{{ $variant->sku }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($variant->optionValues as $value)
                                        <x-admin.badge variant="primary">
                                            {{ $value->optionGroup?->name }}: {{ $value->label }}
                                        </x-admin.badge>
                                    @empty
                                        <span class="text-gray-400">-</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">
                                {{ number_format((float) ($variant->price ?? $product->price)) }} đ
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ number_format((int) $variant->stock_quantity) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($variant->is_active)
                                    <x-admin.badge variant="success">{{ __('catalog.status.active') }}</x-admin.badge>
                                @else
                                    <x-admin.badge variant="danger">{{ __('catalog.status.inactive') }}</x-admin.badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex justify-end gap-1.5">
                                    <x-admin.button variant="outline" size="2xs" href="{{ route('admin.products.variants.edit', [$product, $variant]) }}" title="{{ __('catalog.actions.edit') }}">
                                        <iconify-icon icon="solar:pen-linear"></iconify-icon>
                                    </x-admin.button>
                                    <form method="POST" action="{{ route('admin.products.variants.destroy', [$product, $variant]) }}" class="inline js-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <x-admin.button variant="danger-outline" size="2xs" type="submit" title="{{ __('catalog.actions.delete') }}">
                                            <iconify-icon icon="solar:trash-bin-trash-linear"></iconify-icon>
                                        </x-admin.button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <img src="{{ asset('admin-assets/images/icons/emptydata.png') }}" alt="" class="h-14 w-auto mb-2 opacity-60">
                                    <p class="text-sm font-semibold">{{ __('catalog.common.no_data') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
