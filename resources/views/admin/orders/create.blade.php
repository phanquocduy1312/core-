@extends('admin.layouts.app')

@section('title', 'Tạo đơn hàng')

@section('content')
    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1 text-white">Tạo đơn hàng thủ công</h4>
                <nav class="flex text-sm text-slate-350" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.home') }}</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <a href="{{ route('admin.orders.index') }}" class="text-slate-300 hover:text-white transition-colors">{{ __('admin.menu.orders') }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="mx-1 text-slate-500"></iconify-icon>
                                <span class="text-slate-400">Tạo đơn hàng</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-admin.button variant="outline" size="sm" href="{{ route('admin.orders.index') }}">
                    Quay lại
                </x-admin.button>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
            <div class="flex items-center gap-2">
                <iconify-icon icon="solar:danger-triangle-bold" class="text-lg"></iconify-icon>
                <span class="font-bold">{{ $errors->first() }}</span>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.orders.store') }}" class="space-y-6">
        @csrf
        
        <!-- Customer Info Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="mb-4">
                <h5 class="font-bold text-gray-900">Thông tin khách hàng</h5>
                <p class="text-xs text-gray-500 mt-0.5">Nhập đầy đủ thông tin giao hàng và thanh toán cho đơn hàng.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
                <div class="md:col-span-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Tên khách hàng <span class="text-red-500">*</span></label>
                    <input name="customer_name" value="{{ old('customer_name') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" required>
                </div>
                <div class="md:col-span-3">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" required>
                </div>
                <div class="md:col-span-3">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Số điện thoại <span class="text-red-500">*</span></label>
                    <input name="customer_phone" value="{{ old('customer_phone') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" required>
                </div>
                <div class="md:col-span-8">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Địa chỉ giao hàng <span class="text-red-500">*</span></label>
                    <input name="shipping_address" value="{{ old('shipping_address') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" required>
                </div>
                <div class="md:col-span-4">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Phương thức thanh toán <span class="text-red-500">*</span></label>
                    <select name="payment_method" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" required>
                        <option value="">Chọn phương thức</option>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method->method_code }}" @selected(old('payment_method') === $method->method_code)>{{ $method->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-4">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Giảm giá thủ công</label>
                    <input type="number" min="0" step="0.01" name="discount" value="{{ old('discount', 0) }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors">
                    <p class="text-2xs text-gray-400 mt-1">Áp dụng thêm sau campaign/Flash Sale đang chạy.</p>
                </div>
                <div class="md:col-span-4">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Phí giao hàng</label>
                    <input type="number" min="0" step="0.01" name="shipping_fee" value="{{ old('shipping_fee', 0) }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors">
                </div>
                <div class="md:col-span-4">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Ghi chú</label>
                    <input name="notes" value="{{ old('notes') }}" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors">
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between border-b border-gray-150 pb-4 mb-4">
                <h5 class="font-bold text-gray-900">Sản phẩm chọn mua</h5>
                <button type="button" id="add-item" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-primary text-primary hover:bg-red-50 px-3 py-1.5 text-xs">
                    <iconify-icon icon="solar:add-circle-linear" class="mr-1"></iconify-icon> Thêm sản phẩm
                </button>
            </div>
            
            <div id="order-items" class="space-y-4">
                <!-- Javascript will append items here -->
            </div>
        </div>

        <!-- Action Submit -->
        <div class="flex items-center gap-3">
            <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors bg-primary hover:bg-primary-hover active:bg-primary-active text-white px-5 py-2.5 text-sm">
                Tạo đơn hàng
            </button>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors border border-gray-300 bg-white text-gray-700 hover:bg-gray-55 px-5 py-2.5 text-sm">
                {{ __('catalog.actions.cancel') }}
            </a>
        </div>
    </form>

    <!-- Item Template -->
    <template id="order-item-template">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end border border-gray-200 rounded-xl p-4 bg-gray-50/50 order-item">
            <div class="md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-750">Danh mục</label>
                <select class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none category-select" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    <option value="uncategorized">Chưa phân loại</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-750">Thương hiệu</label>
                <select class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none brand-select">
                    <option value="">Tất cả thương hiệu</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                    <option value="unbranded">Không thương hiệu</option>
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-750">Sản phẩm</label>
                <select name="items[__INDEX__][product_id]" class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none product-select" required disabled>
                    <option value="">Chọn danh mục trước</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-category="{{ $product->category_id ?? 'uncategorized' }}" data-brand="{{ $product->brand_id ?? 'unbranded' }}">{{ $product->name }} ({{ $product->sku }})</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="block mb-1.5 text-xs font-semibold text-gray-750">Biến thể (tuỳ chọn)</label>
                <select name="items[__INDEX__][variant_id]" class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none variant-select" disabled>
                    <option value="">Chọn sản phẩm trước</option>
                    @foreach($products as $product)
                        @foreach($product->variants as $variant)
                            <option value="{{ $variant->id }}" data-product="{{ $product->id }}">{{ $variant->name }}{{ $variant->sku ? ' — '.$variant->sku : '' }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-1">
                <label class="block mb-1.5 text-xs font-semibold text-gray-750">Số lượng</label>
                <input type="number" min="1" name="items[__INDEX__][quantity]" value="1" class="block w-full p-2 text-xs text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" required>
            </div>
            <div class="md:col-span-1 flex justify-end">
                <button type="button" class="inline-flex items-center justify-center w-9 h-9 font-semibold text-red-650 hover:text-white border border-red-200 hover:bg-red-500 rounded-lg transition-colors focus:outline-none remove-item" title="Xóa sản phẩm">
                    <iconify-icon icon="solar:trash-bin-trash-linear" class="text-lg"></iconify-icon>
                </button>
            </div>
        </div>
    </template>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('order-items');
    const template = document.getElementById('order-item-template').innerHTML;
    let index = 0;
    const addItem = () => {
        container.insertAdjacentHTML('beforeend', template.replaceAll('__INDEX__', index++));
        const row = container.lastElementChild;
        const category = row.querySelector('.category-select');
        const brand = row.querySelector('.brand-select');
        const product = row.querySelector('.product-select');
        const variants = row.querySelector('.variant-select');
        const productPlaceholder = product.querySelector('option[value=""]');
        const variantPlaceholder = variants.querySelector('option[value=""]');
        const filterProducts = () => {
            const selectedCategory = category.value;
            const selectedBrand = brand.value;
            product.disabled = !selectedCategory;
            productPlaceholder.textContent = selectedCategory ? 'Chọn sản phẩm' : 'Chọn danh mục trước';
            [...product.options].forEach(option => {
                const isVisible = !option.value || (option.dataset.category === selectedCategory && (!selectedBrand || option.dataset.brand === selectedBrand));
                option.hidden = !isVisible;
                option.disabled = !isVisible;
            });
        };
        const filterVariants = () => {
            variants.disabled = !product.value;
            variantPlaceholder.textContent = product.value ? 'Không chọn biến thể' : 'Chọn sản phẩm trước';
            [...variants.options].forEach(option => {
                const isVisible = !option.value || option.dataset.product === product.value;
                option.hidden = !isVisible;
                option.disabled = !isVisible;
            });
        };
        category.addEventListener('change', () => {
            product.value = '';
            variants.value = '';
            filterProducts();
            filterVariants();
        });
        brand.addEventListener('change', () => {
            product.value = '';
            variants.value = '';
            filterProducts();
            filterVariants();
        });
        product.addEventListener('change', () => { variants.value = ''; filterVariants(); });
        filterProducts();
        filterVariants();
        row.querySelector('.remove-item').addEventListener('click', () => row.remove());
    };
    document.getElementById('add-item').addEventListener('click', addItem);
    addItem();
});
</script>
@endpush
