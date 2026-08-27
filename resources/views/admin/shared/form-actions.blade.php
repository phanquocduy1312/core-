<div class="admin-sticky-actions">
    <div class="admin-sticky-actions__inner flex gap-3">
        <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-primary hover:bg-primary-hover active:bg-primary-active focus:ring-primary px-5 py-2.5 text-sm">{{ $saveLabel ?? __('catalog.actions.save') }}</button>
        <a href="{{ $cancelUrl }}" class="inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 text-gray-700 bg-transparent border border-gray-300 hover:bg-gray-50 active:bg-gray-100 focus:ring-gray-500 px-5 py-2.5 text-sm">{{ $cancelLabel ?? __('catalog.actions.cancel') }}</a>
    </div>
</div>
