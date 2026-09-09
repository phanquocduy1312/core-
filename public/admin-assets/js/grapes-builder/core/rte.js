/**
 * Rich text editing.
 *
 * GrapesJS ships bold / italic / underline / strike / link only. Editing copy
 * on an imported Elementor page needs more than that — alignment, lists, text
 * colour and a way to strip pasted formatting — otherwise every small copy
 * change has to be done by hand in the HTML.
 */
(function (global) {
    'use strict';

    function icon(svgPath) {
        return '<svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor">' + svgPath + '</svg>';
    }

    function exec(rte, command, value) {
        rte.exec(command, value);
    }

    function init(editor) {
        var rte = editor.RichTextEditor;
        if (!rte) return;

        // --- Alignment -----------------------------------------------------
        [
            { name: 'align-left', cmd: 'justifyLeft', title: 'Căn trái', d: 'M3 5h18v2H3zM3 9h12v2H3zM3 13h18v2H3zM3 17h12v2H3z' },
            { name: 'align-center', cmd: 'justifyCenter', title: 'Căn giữa', d: 'M3 5h18v2H3zM6 9h12v2H6zM3 13h18v2H3zM6 17h12v2H6z' },
            { name: 'align-right', cmd: 'justifyRight', title: 'Căn phải', d: 'M3 5h18v2H3zM9 9h12v2H9zM3 13h18v2H3zM9 17h12v2H9z' },
            { name: 'align-justify', cmd: 'justifyFull', title: 'Căn đều hai bên', d: 'M3 5h18v2H3zM3 9h18v2H3zM3 13h18v2H3zM3 17h18v2H3z' }
        ].forEach(function (a) {
            rte.add(a.name, {
                icon: icon('<path d="' + a.d + '"/>'),
                attributes: { title: a.title },
                result: function (r) { exec(r, a.cmd); }
            });
        });

        // --- Lists ---------------------------------------------------------
        rte.add('unordered-list', {
            icon: icon('<path d="M4 6.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm0 5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm0 5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zM8 7h13v2H8zM8 12h13v2H8zM8 17h13v2H8z"/>'),
            attributes: { title: 'Danh sách dấu chấm' },
            result: function (r) { exec(r, 'insertUnorderedList'); }
        });

        rte.add('ordered-list', {
            icon: icon('<path d="M3 6h1V3H2v1h1zM2 9h2v1H2v1h3V7H2zM5 13H2v1h2v1H2v1h3zM8 4h13v2H8zM8 11h13v2H8zM8 18h13v2H8z"/>'),
            attributes: { title: 'Danh sách đánh số' },
            result: function (r) { exec(r, 'insertOrderedList'); }
        });

        // --- Text colour ---------------------------------------------------
        // `result` fires on change, so the picker applies live while open.
        rte.add('fore-color', {
            icon: '<input type="color" class="gjs-rte-color" title="Màu chữ" style="width:20px;height:16px;padding:0;border:0;background:none;cursor:pointer">',
            attributes: { title: 'Màu chữ' },
            event: 'input',
            result: function (r, action) {
                exec(r, 'foreColor', action.btn.firstChild.value);
            }
        });

        rte.add('back-color', {
            icon: '<input type="color" class="gjs-rte-color" title="Màu nền chữ" style="width:20px;height:16px;padding:0;border:0;background:none;cursor:pointer">',
            attributes: { title: 'Màu nền chữ (highlight)' },
            event: 'input',
            result: function (r, action) {
                exec(r, 'hiliteColor', action.btn.firstChild.value);
            }
        });

        // --- Superscript / subscript ---------------------------------------
        rte.add('superscript', {
            icon: icon('<path d="M18 7h-2V6h1.5c.8 0 1.5-.6 1.5-1.4V4c0-.8-.7-1.4-1.5-1.4H16v1h1.5c.3 0 .5.2.5.4v.6c0 .2-.2.4-.5.4H16V7h2zM4 6h3.3l3.2 5-3.6 6h2.4l2.5-4.3L14.3 17h2.4l-3.6-6 3.2-5h-2.4l-2.4 3.8L9.1 6z"/>'),
            attributes: { title: 'Chỉ số trên' },
            result: function (r) { exec(r, 'superscript'); }
        });

        rte.add('subscript', {
            icon: icon('<path d="M18 21h-2v-1h1.5c.8 0 1.5-.6 1.5-1.4v-.6c0-.8-.7-1.4-1.5-1.4H16v1h1.5c.3 0 .5.2.5.4v.6c0 .2-.2.4-.5.4H16V21h2zM4 6h3.3l3.2 5-3.6 6h2.4l2.5-4.3L14.3 17h2.4l-3.6-6 3.2-5h-2.4l-2.4 3.8L9.1 6z"/>'),
            attributes: { title: 'Chỉ số dưới' },
            result: function (r) { exec(r, 'subscript'); }
        });

        // --- Clear formatting ----------------------------------------------
        // The single most useful action when copy is pasted in from Word/Docs.
        rte.add('clear-format', {
            icon: icon('<path d="M6 5v3h5.5l-1.6 9h3l1.6-9H20V5zM3.4 3.4 2 4.8 19.2 22l1.4-1.4z"/>'),
            attributes: { title: 'Xoá định dạng' },
            result: function (r) { exec(r, 'removeFormat'); }
        });
    }

    global.GrapesRte = { init: init };
})(window);
