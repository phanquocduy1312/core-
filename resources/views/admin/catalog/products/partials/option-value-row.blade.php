<div class="grid grid-cols-12 gap-3 items-end value-row">
    @if($value)
        <input type="hidden" name="groups[{{ $groupIndex }}][values][{{ $valueIndex }}][id]" value="{{ $value->id }}">
    @endif
    
    <div class="col-span-12 md:col-span-4">
        <label class="block mb-1.5 text-xs font-semibold text-gray-700">Giá trị</label>
        @foreach($contentLanguages as $language)
            @php($code = $language->code)
            <div class="option-locale-field option-locale-{{ $code }} @if($code !== $defaultContentLocale) hidden @endif">
                <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="groups[{{ $groupIndex }}][values][{{ $valueIndex }}][label][{{ $code }}]" value="{{ old("groups.$groupIndex.values.$valueIndex.label.$code", $value?->getTranslation('label', $code, false)) }}" data-i18n-locale="{{ $code }}" data-i18n-field="group_{{ $groupIndex }}_value_{{ $valueIndex }}_label" @required($code === $defaultContentLocale)>
            </div>
        @endforeach
    </div>

    <div class="col-span-12 md:col-span-2">
        <label class="block mb-1.5 text-xs font-semibold text-gray-700">Mã màu</label>
        <input class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="groups[{{ $groupIndex }}][values][{{ $valueIndex }}][color_hex]" value="{{ old("groups.$groupIndex.values.$valueIndex.color_hex", $value?->color_hex) }}" placeholder="#FFFFFF">
    </div>

    <div class="col-span-12 md:col-span-4">
        <label class="block mb-1.5 text-xs font-semibold text-gray-700">Ảnh URL</label>
        <input type="url" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary focus:border-primary focus:outline-none transition-colors" name="groups[{{ $groupIndex }}][values][{{ $valueIndex }}][image_url]" value="{{ old("groups.$groupIndex.values.$valueIndex.image_url", $value?->image_url) }}">
    </div>

    <div class="col-span-6 md:col-span-1 flex items-center justify-center pb-3">
        <input type="hidden" name="groups[{{ $groupIndex }}][values][{{ $valueIndex }}][is_active]" value="0">
        <input class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary cursor-pointer" type="checkbox" name="groups[{{ $groupIndex }}][values][{{ $valueIndex }}][is_active]" value="1" @checked(old("groups.$groupIndex.values.$valueIndex.is_active", $value?->is_active ?? true))>
        <span class="ml-2 text-xs font-semibold text-gray-805">Bật</span>
    </div>

    <div class="col-span-6 md:col-span-1">
        <button type="button" class="w-full inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 py-2.5 text-sm remove-value">
            &times;
        </button>
    </div>
</div>
