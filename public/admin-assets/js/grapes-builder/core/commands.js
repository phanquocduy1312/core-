/**
 * GrapesJS Core Commands
 *
 * Every button in core/panels.js is bound to a command declared here or to one
 * of GrapesJS's built-ins (core:preview, core:fullscreen, core:undo, …).
 */
(function (global) {
    'use strict';

    /**
     * Put a panel button into a busy state while an async command runs.
     * Returns a restore function.
     */
    function busy(editor, panelId, buttonId, busyLabel) {
        var btn = editor.Panels.getButton(panelId, buttonId);
        if (!btn) return function () {};

        var label = btn.get('label');
        btn.set('label', busyLabel);
        btn.set('className', (btn.get('className') || '') + ' gjs-pn-btn--busy');

        return function () {
            btn.set('label', label);
            btn.set('className', (btn.get('className') || '').replace(/\s*gjs-pn-btn--busy/, ''));
        };
    }

    function dialog(title, text, icon) {
        if (global.Swal) {
            global.Swal.fire(title, text, icon);
        } else if (icon === 'error') {
            window.alert(title + '\n' + text);
        }
    }

    function initCommands(editor, config) {
        var Commands = editor.Commands;

        // --- Save draft ------------------------------------------------------
        Commands.add('core:save-draft', {
            async run(ed) {
                var restore = busy(ed, 'commands', 'builder-save', 'Đang lưu…');
                try {
                    await ed.store();
                    if (global.Swal) {
                        global.Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Đã lưu bản nháp!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                } catch (err) {
                    dialog('Lỗi', err.message || 'Không thể lưu bản nháp.', 'error');
                } finally {
                    restore();
                }
            }
        });

        // --- Publish ---------------------------------------------------------
        Commands.add('core:publish', {
            async run(ed) {
                if (global.Swal) {
                    var confirmed = await global.Swal.fire({
                        title: 'Xác nhận xuất bản?',
                        text: 'Trang sẽ được xuất bản công khai lên website khách hàng.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Xuất bản ngay',
                        cancelButtonText: 'Hủy',
                        confirmButtonColor: '#e32326'
                    });
                    if (!confirmed.isConfirmed) return;
                }

                var restore = busy(ed, 'commands', 'builder-publish', 'Đang xuất bản…');
                try {
                    await global.GrapesLaravelStorage.publish(ed, config);
                    ed.clearDirtyCount();
                    ed.trigger('builder:published');

                    var badge = ed.Panels.getButton('commands', 'builder-status');
                    if (badge) {
                        badge.set('label', 'Đã xuất bản');
                        badge.set('className', 'builder-badge builder-badge--live');
                    }

                    dialog('Thành công', 'Trang đã được xuất bản lên website!', 'success');
                } catch (err) {
                    dialog('Lỗi', err.message || 'Không thể xuất bản trang.', 'error');
                } finally {
                    restore();
                }
            }
        });

        // --- Source code -----------------------------------------------------
        //
        // GrapesJS's built-in core:open-code is read-only. Being able to paste
        // markup back in is the escape hatch that keeps the builder from being a
        // dead end whenever a layout needs a hand-written tweak.
        Commands.add('core:edit-code', {
            run(ed) {
                var wrap = document.createElement('div');
                wrap.innerHTML = [
                    '<label class="builder-code-label">HTML</label>',
                    '<textarea id="gjs-code-html" spellcheck="false" rows="16" class="builder-code-field"></textarea>',
                    '<label class="builder-code-label">CSS</label>',
                    '<textarea id="gjs-code-css" spellcheck="false" rows="10" class="builder-code-field"></textarea>',
                    '<div style="display:flex;align-items:center;gap:12px;margin-top:12px">',
                    '  <span style="flex:1;color:#aaa;font-size:11px">Áp dụng sẽ thay thế toàn bộ nội dung trang. Vẫn hoàn tác được bằng Ctrl+Z.</span>',
                    '  <button type="button" id="gjs-code-apply" class="gjs-pn-btn builder-action builder-action--publish">Áp dụng</button>',
                    '</div>'
                ].join('');

                wrap.querySelector('#gjs-code-html').value = ed.getHtml();
                wrap.querySelector('#gjs-code-css').value = ed.getCss();

                wrap.querySelector('#gjs-code-apply').addEventListener('click', function () {
                    try {
                        ed.setComponents(wrap.querySelector('#gjs-code-html').value);
                        ed.setStyle(wrap.querySelector('#gjs-code-css').value);
                        ed.Modal.close();
                    } catch (err) {
                        dialog('Mã không hợp lệ', err.message || 'Không phân tích được HTML/CSS.', 'error');
                    }
                });

                ed.Modal.open({ title: 'Mã nguồn trang (HTML / CSS)', content: wrap });
            }
        });

        // --- Header / footer preview -----------------------------------------
        Commands.add('core:toggle-chrome', {
            run(ed) {
                localStorage.setItem('grapes_chrome_visible', 'true');
                if (!global.GrapesCanvasContext) return;
                global.GrapesCanvasContext.setChromeVisible(ed, config, true);

                var hasChrome = (config.canvasHeaderHtml || '').trim() || (config.canvasFooterHtml || '').trim();
                if (!hasChrome) {
                    dialog('Chưa có Header/Footer', 'Trang này không được gán Header hoặc Footer nào.', 'info');
                }
            },
            stop(ed) {
                localStorage.setItem('grapes_chrome_visible', 'false');
                if (global.GrapesCanvasContext) {
                    global.GrapesCanvasContext.setChromeVisible(ed, config, false);
                }
            }
        });

        // --- Header / footer builder links ----------------------------------
        Commands.add('core:open-header-builder', {
            run() {
                if (config.headerBuilderUrl) {
                    window.open(config.headerBuilderUrl, '_blank');
                }
            }
        });

        Commands.add('core:open-footer-builder', {
            run() {
                if (config.footerBuilderUrl) {
                    window.open(config.footerBuilderUrl, '_blank');
                }
            }
        });

        // --- Collapse the right column -----------------------------------------
        //
        // Flipping one CSS variable (see .builder-panel-collapsed in
        // builder.blade.php) is enough: GrapesJS sizes the views column, the
        // options offset and the canvas from --gjs-left-width. The canvas still
        // needs a refresh so it re-measures its offsets, otherwise drag targets
        // and the selection outline stay anchored to the old width.
        var COLLAPSED_CLASS = 'builder-panel-collapsed';

        function setPanelCollapsed(ed, collapsed) {
            document.documentElement.classList.toggle(COLLAPSED_CLASS, collapsed);
            localStorage.setItem('grapes_panel_collapsed', collapsed ? 'true' : 'false');

            var btn = ed.Panels.getButton('options', 'builder-collapse');
            if (btn) {
                btn.set('className', collapsed
                    ? 'fa fa-angle-double-left'
                    : 'fa fa-angle-double-right');
                btn.set('attributes', {
                    title: collapsed
                        ? 'Mở lại bảng bên phải'
                        : 'Thu gọn bảng bên phải (mở rộng vùng thiết kế)'
                });
            }

            setTimeout(function () {
                try { ed.refresh(); } catch (err) { /* canvas not ready */ }
            }, 260);
        }

        Commands.add('core:toggle-panel', {
            run(ed) { setPanelCollapsed(ed, true); },
            stop(ed) { setPanelCollapsed(ed, false); }
        });

        // Restore the last choice once the editor is up.
        editor.on('load', function () {
            if (localStorage.getItem('grapes_panel_collapsed') !== 'true') return;
            var btn = editor.Panels.getButton('options', 'builder-collapse');
            if (btn) btn.set('active', true);
        });

        // --- Free drag mode ---------------------------------------------------
        // 'absolute' lets an element be dragged anywhere instead of only between
        // flow slots — the literal "chỉnh sửa tự do" ask.
        Commands.add('core:toggle-free-drag', {
            run(ed) { ed.setDragMode('absolute'); },
            stop(ed) { ed.setDragMode(''); }
        });

        // --- Navigation --------------------------------------------------------
        Commands.add('core:back-to-pages', {
            run(ed) {
                if (ed.isDirty && ed.isDirty() && !window.confirm('Bạn có thay đổi chưa lưu. Rời khỏi trình thiết kế?')) {
                    return;
                }
                window.onbeforeunload = null;
                window.location.href = config.backUrl;
            }
        });

        Commands.add('core:switch-locale', {
            run(ed, sender) {
                var url = sender && sender.get && sender.get('attributes')['data-locale-url'];
                if (!url) return;
                if (ed.isDirty && ed.isDirty() && !window.confirm('Bạn có thay đổi chưa lưu. Chuyển ngôn ngữ?')) {
                    return;
                }
                window.onbeforeunload = null;
                window.location.href = url;
            }
        });

        // --- Devices ------------------------------------------------------------
        Commands.add('set-device-desktop', { run(ed) { ed.setDevice('Desktop'); } });
        Commands.add('set-device-tablet', { run(ed) { ed.setDevice('Tablet'); } });
        Commands.add('set-device-mobile', { run(ed) { ed.setDevice('Mobile'); } });
    }

    global.GrapesCommands = {
        init: initCommands
    };
})(window);
