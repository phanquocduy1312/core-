/**
 * GrapesJS Custom HTML Embed & Code Editor Component
 * Supports custom HTML/CSS/JS, Google Maps embed, iframes, and widgets.
 * Handles double-click to open code editor, traits, and floating toolbar.
 */
(function (global) {
    'use strict';

    var currentTargetComponent = null;

    var DEFAULT_PLACEHOLDER = '<div style="color:#64748b; font-family:monospace; font-size:13px; text-align:center; padding:12px; pointer-events:none;">&lt;!-- Nhấp đúp để dán mã HTML / Embed Script tại đây --&gt;</div>';

    function initCustomHtmlComponent(editor) {
        var DomComponents = editor.DomComponents;

        // 1. Component definition for builder-custom-html
        DomComponents.addType('builder-custom-html', {
            model: {
                defaults: {
                    name: 'Mã HTML Tùy Ý',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    classes: ['builder-custom-embed'],
                    style: {
                        'padding': '16px',
                        'background-color': '#f8fafc',
                        'border': '1.5px dashed #94a3b8',
                        'border-radius': '10px',
                        'margin': '16px 0',
                        'min-height': '60px',
                        'box-sizing': 'border-box',
                        'cursor': 'pointer'
                    },
                    content: DEFAULT_PLACEHOLDER,
                    traits: [
                        {
                            type: 'button',
                            label: 'Trình soạn thảo',
                            text: '✎ Mở bảng sửa mã HTML',
                            command: function (ed) {
                                ed.runCommand('open-custom-html-modal', { target: ed.getSelected() });
                            }
                        }
                    ]
                }
            }
        });

        // 2. Command: open-custom-html-modal
        editor.Commands.add('open-custom-html-modal', {
            run: function (ed, sender, options) {
                var opts = (options && typeof options === 'object') ? options : (sender || {});
                var target = opts.target || ed.getSelected();
                if (!target) return;

                currentTargetComponent = target;
                createHtmlEditorModal();

                var modal = document.getElementById('grapes-custom-html-modal');
                var textarea = document.getElementById('grapes-custom-html-code');
                if (!modal || !textarea) return;

                var existingCode = target.get('customCode') || '';
                if (!existingCode) {
                    var inner = target.toHTML ? target.toHTML() : '';
                    if (inner.indexOf('&lt;!-- Nhấp đúp') !== -1 || inner.indexOf('<!-- Nhấp đúp') !== -1) {
                        existingCode = '';
                    } else {
                        existingCode = target.getInnerHTML ? target.getInnerHTML() : '';
                    }
                }

                textarea.value = existingCode;
                modal.classList.remove('hidden');
                setTimeout(function () { textarea.focus(); }, 100);
            }
        });

        // 3. Command: open-map-modal
        editor.Commands.add('open-map-modal', {
            run: function (ed, sender, options) {
                var opts = (options && typeof options === 'object') ? options : (sender || {});
                var target = opts.target || ed.getSelected();
                if (!target) return;

                var currentQuery = 'Hà Nội, Việt Nam';
                var iframe = target.find && target.find('iframe')[0];
                if (iframe) {
                    var src = iframe.getAttributes().src || '';
                    var m = src.match(/q=([^&]+)/);
                    if (m) currentQuery = decodeURIComponent(m[1]);
                }

                if (global.Swal) {
                    global.Swal.fire({
                        title: 'Cài đặt Bản đồ Google Maps',
                        text: 'Nhập địa chỉ hoặc tên địa điểm cần hiển thị:',
                        input: 'text',
                        inputValue: currentQuery,
                        inputPlaceholder: 'Ví dụ: Landmark 81, TP.HCM hoặc Hà Nội, Việt Nam',
                        showCancelButton: true,
                        confirmButtonText: 'Cập nhật bản đồ',
                        cancelButtonText: 'Hủy',
                        confirmButtonColor: '#00a0d2'
                    }).then(function (res) {
                        if (res.isConfirmed && res.value) {
                            var newUrl = 'https://maps.google.com/maps?q=' + encodeURIComponent(res.value.trim()) + '&t=&z=14&ie=UTF8&iwloc=&output=embed';
                            if (iframe) {
                                iframe.addAttributes({ src: newUrl });
                            } else {
                                target.components('<iframe src="' + newUrl + '" width="100%" height="100%" style="border:0; width:100%; height:100%; display:block;" frameborder="0"></iframe>');
                            }
                        }
                    });
                } else {
                    var newAddress = window.prompt('Nhập địa chỉ Google Maps:', currentQuery);
                    if (newAddress) {
                        var newUrl = 'https://maps.google.com/maps?q=' + encodeURIComponent(newAddress.trim()) + '&t=&z=14&ie=UTF8&iwloc=&output=embed';
                        if (iframe) {
                            iframe.addAttributes({ src: newUrl });
                        } else {
                            target.components('<iframe src="' + newUrl + '" width="100%" height="100%" style="border:0; width:100%; height:100%; display:block;" frameborder="0"></iframe>');
                        }
                    }
                }
            }
        });

        // 4. Floating toolbar button on custom-embed and map blocks
        editor.on('component:selected', function (component) {
            if (!component) return;
            var el = component.getEl ? component.getEl() : null;
            var isCustomEmbed = (component.get('type') === 'builder-custom-html') || (el && el.classList && el.classList.contains('builder-custom-embed'));
            var isMap = (el && el.classList && el.classList.contains('builder-map-wrapper'));

            if (isCustomEmbed) {
                var toolbar = (component.get('toolbar') || []).slice();
                var hasCodeBtn = toolbar.some(function (item) { return item.id === 'edit-custom-code'; });
                if (!hasCodeBtn) {
                    toolbar.unshift({
                        id: 'edit-custom-code',
                        attributes: {
                            class: 'fa fa-code',
                            title: 'Chỉnh sửa mã HTML / Script'
                        },
                        command: function (ed) {
                            ed.runCommand('open-custom-html-modal', { target: component });
                        }
                    });
                    component.set('toolbar', toolbar);
                }
            } else if (isMap) {
                var toolbar = (component.get('toolbar') || []).slice();
                var hasMapBtn = toolbar.some(function (item) { return item.id === 'edit-map-location'; });
                if (!hasMapBtn) {
                    toolbar.unshift({
                        id: 'edit-map-location',
                        attributes: {
                            class: 'fa fa-map-marker',
                            title: 'Thay đổi địa chỉ bản đồ'
                        },
                        command: function (ed) {
                            ed.runCommand('open-map-modal', { target: component });
                        }
                    });
                    component.set('toolbar', toolbar);
                }
            }
        });

        // 5. Canvas Double-click dispatcher
        function bindCanvasEvents() {
            var doc = editor.Canvas.getDocument();
            if (!doc || doc.__builderCustomDblClick) return;
            doc.__builderCustomDblClick = true;

            doc.addEventListener('dblclick', function (ev) {
                var targetEl = ev.target;
                if (!targetEl) return;

                // Check custom embed block
                var customEmbed = targetEl.closest('.builder-custom-embed, [data-gjs-type="builder-custom-html"]');
                if (customEmbed) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var comp = findComponentByElement(editor, customEmbed);
                    editor.runCommand('open-custom-html-modal', { target: comp || editor.getSelected() });
                    return;
                }

                // Check map wrapper block
                var mapWrapper = targetEl.closest('.builder-map-wrapper');
                if (mapWrapper) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var comp = findComponentByElement(editor, mapWrapper);
                    editor.runCommand('open-map-modal', { target: comp || editor.getSelected() });
                    return;
                }
            }, true); // Capture phase
        }

        editor.on('canvas:frame:load:body', bindCanvasEvents);
        editor.on('load', bindCanvasEvents);

        // Pre-create modal HTML
        createHtmlEditorModal();
    }

    function findComponentByElement(editor, domEl) {
        if (!domEl) return null;
        var all = editor.getWrapper().find('*');
        for (var i = 0; i < all.length; i++) {
            if (all[i].getEl() === domEl) return all[i];
        }
        return null;
    }

    function createHtmlEditorModal() {
        if (document.getElementById('grapes-custom-html-modal')) return;

        var html = [
            '<style id="grapes-custom-html-styles">',
            '  #grapes-custom-html-modal {',
            '    position: fixed !important;',
            '    top: 0 !important;',
            '    left: 0 !important;',
            '    right: 0 !important;',
            '    bottom: 0 !important;',
            '    width: 100vw !important;',
            '    height: 100vh !important;',
            '    z-index: 999999 !important;',
            '    display: flex !important;',
            '    align-items: center !important;',
            '    justify-content: center !important;',
            '    background: rgba(15, 23, 42, 0.78) !important;',
            '    backdrop-filter: blur(6px) !important;',
            '    -webkit-backdrop-filter: blur(6px) !important;',
            '    box-sizing: border-box !important;',
            '    padding: 16px !important;',
            '    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;',
            '  }',
            '  #grapes-custom-html-modal.hidden { display: none !important; }',
            '  #grapes-custom-html-modal * { box-sizing: border-box; }',
            '  #grapes-custom-html-modal .code-dialog {',
            '    background: #ffffff !important;',
            '    border-radius: 16px !important;',
            '    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4) !important;',
            '    width: 100% !important;',
            '    max-width: 860px !important;',
            '    height: 82vh !important;',
            '    max-height: 720px !important;',
            '    display: flex !important;',
            '    flex-direction: column !important;',
            '    overflow: hidden !important;',
            '    border: 1px solid #e2e8f0 !important;',
            '  }',
            '</style>',
            '<div id="grapes-custom-html-modal" class="hidden">',
            '  <div class="code-dialog">',
            '',
            '    <!-- Modal Header -->',
            '    <div style="padding: 14px 22px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; background: #f8fafc; flex-shrink: 0;">',
            '      <div style="display: flex; align-items: center; gap: 12px;">',
            '        <div style="width: 36px; height: 36px; border-radius: 10px; background: #ecfdf5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 20px;">',
            '          <iconify-icon icon="solar:code-square-bold-duotone"></iconify-icon>',
            '        </div>',
            '        <div>',
            '          <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: #1e293b;">Chèn Mã HTML / Embed Script</h3>',
            '          <p style="margin: 2px 0 0 0; font-size: 11px; color: #64748b;">Dán mã HTML tùy ý, iframe Google Maps, video nhúng hoặc mã script bên thứ ba</p>',
            '        </div>',
            '      </div>',
            '      <button type="button" id="btn-close-html-modal" style="background: none; border: none; font-size: 22px; color: #94a3b8; cursor: pointer; padding: 4px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">',
            '        <iconify-icon icon="solar:close-square-linear"></iconify-icon>',
            '      </button>',
            '    </div>',
            '',
            '    <!-- Modal Body -->',
            '    <div style="flex: 1; display: flex; flex-direction: column; padding: 16px 22px; background: #0f172a; overflow: hidden;">',
            '      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; font-size: 11px; color: #94a3b8;">',
            '        <span>Mã nguồn HTML / Embed:</span>',
            '        <span style="color: #38bdf8;">Hỗ trợ: &lt;div&gt;, &lt;iframe&gt;, &lt;style&gt;, &lt;script&gt;...</span>',
            '      </div>',
            '      <textarea id="grapes-custom-html-code" placeholder="<!-- Dán mã HTML hoặc Embed code của bạn vào đây -->" style="flex: 1; width: 100%; background: #1e293b; color: #f8fafc; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 13px; line-height: 1.6; border: 1px solid #334155; border-radius: 10px; padding: 14px; outline: none; resize: none; tab-size: 4;" spellcheck="false"></textarea>',
            '    </div>',
            '',
            '    <!-- Modal Footer -->',
            '    <div style="padding: 12px 22px; border-top: 1px solid #e2e8f0; background: #ffffff; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;">',
            '      <div style="font-size: 11px; color: #64748b;">Mẹo: Nhấn nút &quot;Cập nhật&quot; để hiển thị trực tiếp nội dung lên trang.</div>',
            '      <div style="display: flex; align-items: center; gap: 10px;">',
            '        <button type="button" id="btn-cancel-html-modal" style="padding: 8px 16px; border: 1px solid #e2e8f0; background: #fff; border-radius: 8px; font-size: 12px; font-weight: 700; color: #334155; cursor: pointer;">Hủy</button>',
            '        <button type="button" id="btn-confirm-html-modal" style="padding: 8px 22px; background: #10b981; color: #fff; font-size: 12px; font-weight: 700; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 6px;">✓ Cập nhật mã HTML</button>',
            '      </div>',
            '    </div>',
            '',
            '  </div>',
            '</div>'
        ].join('\n');

        document.body.insertAdjacentHTML('beforeend', html);

        var modal = document.getElementById('grapes-custom-html-modal');
        var btnClose = document.getElementById('btn-close-html-modal');
        var btnCancel = document.getElementById('btn-cancel-html-modal');
        var btnConfirm = document.getElementById('btn-confirm-html-modal');
        var textarea = document.getElementById('grapes-custom-html-code');

        function closeModal() {
            if (modal) modal.classList.add('hidden');
            currentTargetComponent = null;
        }

        if (btnClose) btnClose.addEventListener('click', closeModal);
        if (btnCancel) btnCancel.addEventListener('click', closeModal);

        if (btnConfirm) {
            btnConfirm.addEventListener('click', function () {
                if (!currentTargetComponent) return;
                var code = textarea.value.trim();

                currentTargetComponent.set('customCode', code);
                if (code) {
                    currentTargetComponent.components(code);
                } else {
                    currentTargetComponent.components(DEFAULT_PLACEHOLDER);
                }

                closeModal();
                if (global.Swal) {
                    global.Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Đã cập nhật mã HTML thành công!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }
    }

    global.GrapesCustomHtmlComponent = {
        init: initCustomHtmlComponent
    };
})(window);
