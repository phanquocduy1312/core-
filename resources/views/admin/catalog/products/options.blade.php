@extends('admin.layouts.app')

@section('title', 'Thuộc tính biến thể')

@section('content')
    @php
        $contentLanguages = app(\App\Services\LanguageRegistry::class)->active();
        $defaultContentLocale = app(\App\Services\LanguageRegistry::class)->defaultLocale();
    @endphp

    <!-- Header Banner -->
    <div class="relative overflow-hidden mb-6 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl shadow-sm border border-slate-700/50">
        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h4 class="text-xl font-bold mb-1">Thuộc tính biến thể: {{ $product->name }}</h4>
                <div class="text-slate-300 text-sm">Khai báo các giá trị trước, sau đó tạo các tổ hợp SKU.</div>
            </div>
            <x-admin.button variant="secondary" size="sm" href="{{ route('admin.products.show', $product) }}">
                <iconify-icon icon="solar:arrow-left-linear" class="mr-1"></iconify-icon> Quay lại sản phẩm
            </x-admin.button>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.products.options.update', $product) }}" class="admin-form-with-sticky-actions space-y-6">
        @csrf
        @method('PUT')

        <!-- Languages Bar Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4">
                <div class="flex space-x-2">
                    @foreach($contentLanguages as $language)
                        <button type="button" class="option-locale-switch whitespace-nowrap px-4 py-2 text-xs font-semibold border rounded-lg transition-colors focus:outline-none @if($language->code === $defaultContentLocale) active bg-primary text-white border-primary @else bg-white text-gray-700 border-gray-300 hover:bg-gray-50 @endif" data-option-locale="{{ $language->code }}">
                            {{ $language->native_name }}
                        </button>
                    @endforeach
                </div>
                <div>
                    @foreach($contentLanguages as $language)
                        @if($language->code !== $defaultContentLocale)
                            <button type="button" class="inline-flex items-center gap-1.5 py-1.5 px-3 text-xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors focus:outline-none option-translate-button hidden js-translate-locale" data-option-translation-target="{{ $language->code }}" data-source-locale="{{ $defaultContentLocale }}" data-target-locale="{{ $language->code }}">
                                <iconify-icon icon="solar:global-linear" class="text-sm"></iconify-icon>
                                Dịch {{ strtoupper($defaultContentLocale) }} → {{ strtoupper($language->code) }}
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div id="option-groups" class="space-y-6">
            @forelse($product->optionGroups as $groupIndex => $group)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 option-group" data-group-index="{{ $groupIndex }}">
                    <input type="hidden" name="groups[{{ $groupIndex }}][id]" value="{{ $group->id }}">
                    <div class="grid grid-cols-12 gap-6 items-end mb-6">
                        <div class="col-span-12 md:col-span-6">
                            <label class="block mb-2 text-sm font-semibold text-gray-900">Tên nhóm</label>
                            @foreach($contentLanguages as $language)
                                @php($code = $language->code)
                                <div class="option-locale-field option-locale-{{ $code }} @if($code !== $defaultContentLocale) hidden @endif">
                                    <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="groups[{{ $groupIndex }}][name][{{ $code }}]" value="{{ old("groups.$groupIndex.name.$code", $group->getTranslation('name', $code, false)) }}" data-i18n-locale="{{ $code }}" data-i18n-field="group_{{ $groupIndex }}_name" @required($code === $defaultContentLocale)>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="block mb-2 text-sm font-semibold text-gray-900">Kiểu hiển thị</label>
                            <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="groups[{{ $groupIndex }}][display_type]">
                                @foreach(['select' => 'Danh sách', 'color' => 'Màu sắc', 'image' => 'Ảnh'] as $type => $label)
                                    <option value="{{ $type }}" @selected(old("groups.$groupIndex.display_type", $group->display_type) === $type)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <button type="button" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-2.5 text-sm remove-group">Xóa nhóm</button>
                        </div>
                    </div>
                    
                    <div class="values space-y-3">
                        @foreach($group->values as $valueIndex => $value)
                            @include('admin.catalog.products.partials.option-value-row', ['groupIndex' => $groupIndex, 'valueIndex' => $valueIndex, 'value' => $value])
                        @endforeach
                    </div>
                    
                    <button type="button" class="inline-flex items-center gap-1.5 py-1.5 px-3 text-xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors focus:outline-none mt-4 add-value">
                        <iconify-icon icon="solar:add-circle-linear" class="text-sm"></iconify-icon>
                        Thêm giá trị
                    </button>
                </div>
            @empty
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 option-group" data-group-index="0">
                    <div class="grid grid-cols-12 gap-6 items-end mb-6">
                        <div class="col-span-12 md:col-span-6">
                            <label class="block mb-2 text-sm font-semibold text-gray-900">Tên nhóm</label>
                            @foreach($contentLanguages as $language)
                                @php($code = $language->code)
                                <div class="option-locale-field option-locale-{{ $code }} @if($code !== $defaultContentLocale) hidden @endif">
                                    <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="groups[0][name][{{ $code }}]" value="{{ $code === $defaultContentLocale ? 'Màu sắc' : '' }}" data-i18n-locale="{{ $code }}" data-i18n-field="group_0_name" @required($code === $defaultContentLocale)>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label class="block mb-2 text-sm font-semibold text-gray-900">Kiểu hiển thị</label>
                            <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" name="groups[0][display_type]">
                                <option value="select">Danh sách</option>
                                <option value="color" selected>Màu sắc</option>
                                <option value="image">Ảnh</option>
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <button type="button" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-2.5 text-sm remove-group">Xóa nhóm</button>
                        </div>
                    </div>

                    <div class="values space-y-3">
                        @include('admin.catalog.products.partials.option-value-row', ['groupIndex' => 0, 'valueIndex' => 0, 'value' => null])
                    </div>

                    <button type="button" class="inline-flex items-center gap-1.5 py-1.5 px-3 text-xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors focus:outline-none mt-4 add-value">
                        <iconify-icon icon="solar:add-circle-linear" class="text-sm"></iconify-icon>
                        Thêm giá trị
                    </button>
                </div>
            @endforelse
        </div>

        <button type="button" id="add-group" class="inline-flex items-center gap-2 py-2 px-4 text-sm font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors focus:outline-none">
            <iconify-icon icon="solar:add-circle-bold-duotone" class="text-lg"></iconify-icon>
            Thêm nhóm thuộc tính
        </button>

        @include('admin.shared.form-actions', ['cancelUrl' => route('admin.products.show', $product)])
    </form>

    <!-- HTML Templates -->
    <template id="value-template">
        <div class="grid grid-cols-12 gap-3 items-end value-row">
            <div class="col-span-12 md:col-span-4">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700">Giá trị</label>
                @foreach($contentLanguages as $language)
                    @php($code = $language->code)
                    <div class="option-locale-field option-locale-{{ $code }} @if($code !== $defaultContentLocale) hidden @endif">
                        <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" data-name="groups[__GROUP__][values][__VALUE__][label][{{ $code }}]" data-locale="{{ $code }}" data-field-template="group___GROUP___value___VALUE___label" @required($code === $defaultContentLocale)>
                    </div>
                @endforeach
            </div>
            <div class="col-span-12 md:col-span-2">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700">Mã màu</label>
                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" data-name="groups[__GROUP__][values][__VALUE__][color_hex]" placeholder="#FFFFFF">
            </div>
            <div class="col-span-12 md:col-span-4">
                <label class="block mb-1.5 text-xs font-semibold text-gray-700">Ảnh URL</label>
                <input type="url" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" data-name="groups[__GROUP__][values][__VALUE__][image_url]">
            </div>
            <div class="col-span-6 md:col-span-1 flex items-center justify-center pb-3">
                <input type="hidden" data-name="groups[__GROUP__][values][__VALUE__][is_active]" value="0">
                <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" data-name="groups[__GROUP__][values][__VALUE__][is_active]" value="1" checked>
                <span class="ml-2 text-xs font-semibold text-gray-800">Bật</span>
            </div>
            <div class="col-span-6 md:col-span-1">
                <button type="button" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-2.5 text-sm remove-value">
                    &times;
                </button>
            </div>
        </div>
    </template>

    <template id="group-template">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 option-group">
            <div class="grid grid-cols-12 gap-6 items-end mb-6">
                <div class="col-span-12 md:col-span-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Tên nhóm</label>
                    @foreach($contentLanguages as $language)
                        @php($code = $language->code)
                        <div class="option-locale-field option-locale-{{ $code }} @if($code !== $defaultContentLocale) hidden @endif">
                            <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" data-name="groups[__GROUP__][name][{{ $code }}]" data-locale="{{ $code }}" data-field-template="group___GROUP___name" @required($code === $defaultContentLocale)>
                        </div>
                    @endforeach
                </div>
                <div class="col-span-12 md:col-span-4">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Kiểu hiển thị</label>
                    <select class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none" data-name="groups[__GROUP__][display_type]">
                        <option value="select">Danh sách</option>
                        <option value="color">Màu sắc</option>
                        <option value="image">Ảnh</option>
                    </select>
                </div>
                <div class="col-span-12 md:col-span-2">
                    <button type="button" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-2.5 text-sm remove-group">Xóa nhóm</button>
                </div>
            </div>
            <div class="values space-y-3"></div>
            <button type="button" class="inline-flex items-center gap-1.5 py-1.5 px-3 text-xs font-semibold text-primary bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors focus:outline-none mt-4 add-value">
                <iconify-icon icon="solar:add-circle-linear" class="text-sm"></iconify-icon>
                Thêm giá trị
            </button>
        </div>
    </template>

    @include('admin.shared.translation-assets')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const groups = document.getElementById('option-groups');
    const valueTemplate = document.getElementById('value-template');
    const groupTemplate = document.getElementById('group-template');
    const nextGroupIndex = () => Math.max(-1, ...[...groups.querySelectorAll('.option-group')].map((el) => Number(el.dataset.groupIndex || -1))) + 1;
    
    const addValue = (group) => {
        const groupIndex = group.dataset.groupIndex;
        const valueIndex = group.querySelectorAll('.value-row').length;
        const node = valueTemplate.content.cloneNode(true);
        node.querySelectorAll('[data-name]').forEach((input) => {
            input.name = input.dataset.name.replaceAll('__GROUP__', groupIndex).replaceAll('__VALUE__', valueIndex);
            if (input.dataset.locale) input.dataset.i18nLocale = input.dataset.locale;
            if (input.dataset.fieldTemplate) input.dataset.i18nField = input.dataset.fieldTemplate.replaceAll('__GROUP__', groupIndex).replaceAll('__VALUE__', valueIndex);
        });
        group.querySelector('.values').appendChild(node);
        document.querySelector('.option-locale-switch.active')?.click();
    };

    document.getElementById('add-group').addEventListener('click', () => {
        const groupIndex = nextGroupIndex();
        const node = groupTemplate.content.cloneNode(true);
        const group = node.querySelector('.option-group');
        group.dataset.groupIndex = groupIndex;
        group.querySelectorAll('[data-name]').forEach((input) => {
            input.name = input.dataset.name.replaceAll('__GROUP__', groupIndex);
            if (input.dataset.locale) input.dataset.i18nLocale = input.dataset.locale;
            if (input.dataset.fieldTemplate) input.dataset.i18nField = input.dataset.fieldTemplate.replaceAll('__GROUP__', groupIndex);
        });
        groups.appendChild(node);
        addValue(groups.lastElementChild);
        document.querySelector('.option-locale-switch.active')?.click();
    });

    groups.addEventListener('click', (event) => {
        if (event.target.closest('.add-value')) addValue(event.target.closest('.option-group'));
        if (event.target.closest('.remove-value')) event.target.closest('.value-row').remove();
        if (event.target.closest('.remove-group')) event.target.closest('.option-group').remove();
    });

    document.querySelectorAll('.option-locale-switch').forEach((button) => button.addEventListener('click', () => {
        document.querySelectorAll('.option-locale-switch').forEach((item) => {
            const isActive = item === button;
            item.classList.toggle('active', isActive);
            if (isActive) {
                item.classList.add('bg-primary', 'text-white', 'border-primary');
                item.classList.remove('bg-white', 'text-gray-700', 'border-gray-300', 'hover:bg-gray-50');
            } else {
                item.classList.remove('bg-primary', 'text-white', 'border-primary');
                item.classList.add('bg-white', 'text-gray-700', 'border-gray-300', 'hover:bg-gray-50');
            }
        });
        document.querySelectorAll('.option-locale-field').forEach((field) => field.classList.toggle('hidden', !field.classList.contains(`option-locale-${button.dataset.optionLocale}`)));
        document.querySelectorAll('.option-translate-button').forEach((item) => item.classList.toggle('hidden', item.dataset.optionTranslationTarget !== button.dataset.optionLocale));
    }));
});
</script>
@endpush
