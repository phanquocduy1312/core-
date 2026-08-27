@php
    $bulkFormId = $bulkFormId ?? 'bulk-actions-form';
    $bulkActionUrl = $bulkActionUrl ?? '#';
    $bulkItemLabel = $bulkItemLabel ?? 'mục';
@endphp

<form id="{{ $bulkFormId }}" method="POST" action="{{ $bulkActionUrl }}" class="hidden">
    @csrf
    @method('PATCH')
    <input type="hidden" name="action" value="" data-bulk-action-input>
</form>

<div class="hidden flex-wrap items-center gap-3 px-6 py-3 border-b border-gray-200 bg-slate-50" data-bulk-toolbar="{{ $bulkFormId }}">
    <span class="text-xs font-semibold text-gray-700"><span data-bulk-count class="font-bold text-gray-900">0</span> {{ $bulkItemLabel }} đã chọn</span>
    <button type="button" class="inline-flex items-center gap-1 py-1 px-2.5 text-xs font-semibold text-emerald-605 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 rounded-lg transition-colors focus:outline-none" data-bulk-action="activate">
        <iconify-icon icon="solar:check-circle-linear" class="text-sm"></iconify-icon>Kích hoạt
    </button>
    <button type="button" class="inline-flex items-center gap-1 py-1 px-2.5 text-xs font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-lg transition-colors focus:outline-none" data-bulk-action="deactivate">
        <iconify-icon icon="solar:eye-closed-linear" class="text-sm"></iconify-icon>Tạm ẩn
    </button>
    <button type="button" class="inline-flex items-center gap-1 py-1 px-2.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition-colors focus:outline-none" data-bulk-action="delete">
        <iconify-icon icon="solar:trash-bin-trash-linear" class="text-sm"></iconify-icon>Xóa đã chọn
    </button>
    <button type="button" class="text-xs font-semibold text-gray-500 hover:text-gray-700 ml-auto focus:outline-none" data-bulk-clear>Bỏ chọn</button>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[data-bulk-toolbar]').forEach(function (toolbar) {
                    const formId = toolbar.dataset.bulkToolbar;
                    const form = document.getElementById(formId);
                    const selectAll = document.querySelector('[data-bulk-select-all="' + formId + '"]');
                    const checkboxes = Array.from(document.querySelectorAll('[data-bulk-select="' + formId + '"]'));
                    const count = toolbar.querySelector('[data-bulk-count]');
                    const actionInput = form ? form.querySelector('[data-bulk-action-input]') : null;

                    if (!form || !actionInput || !checkboxes.length) {
                        return;
                    }

                    const selected = function () {
                        return checkboxes.filter(function (checkbox) { return checkbox.checked; });
                    };

                    const refresh = function () {
                        const selectedItems = selected();
                        const total = selectedItems.length;
                        toolbar.classList.toggle('hidden', total === 0);
                        toolbar.classList.toggle('flex', total > 0);
                        count.textContent = String(total);

                        if (selectAll) {
                            selectAll.checked = total > 0 && total === checkboxes.length;
                            selectAll.indeterminate = total > 0 && total < checkboxes.length;
                        }
                    };

                    checkboxes.forEach(function (checkbox) {
                        checkbox.addEventListener('change', refresh);
                    });

                    if (selectAll) {
                        selectAll.addEventListener('change', function () {
                            checkboxes.forEach(function (checkbox) {
                                checkbox.checked = selectAll.checked;
                            });
                            refresh();
                        });
                    }

                    toolbar.querySelector('[data-bulk-clear]').addEventListener('click', function () {
                        checkboxes.forEach(function (checkbox) { checkbox.checked = false; });
                        refresh();
                    });

                    toolbar.querySelectorAll('[data-bulk-action]').forEach(function (button) {
                        button.addEventListener('click', function () {
                            const total = selected().length;
                            const action = button.dataset.bulkAction;
                            if (total === 0) {
                                return;
                            }

                            if (action === 'delete' && !window.confirm('Xóa vĩnh viễn ' + total + ' mục đã chọn? Hành động này không thể hoàn tác.')) {
                                return;
                            }

                            actionInput.value = action;
                            form.submit();
                        });
                    });
                });
            });
        </script>
    @endpush
@endonce
