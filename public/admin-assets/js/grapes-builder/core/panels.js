/**
 * Editor chrome, built out of GrapesJS's own Panels module.
 *
 * Everything the builder needs beyond the stock UI — page title, locale switch,
 * devices, undo/redo, header/footer preview, save, publish — is declared as a
 * GrapesJS panel button. That keeps a single layout engine in charge: GrapesJS
 * positions `commands` (top bar), `options` (top right), `views` (right column
 * tabs) and `views-container` from its own stylesheet, so the chrome cannot
 * overflow and shove the canvas off screen the way the hand-built shell did.
 */
(function (global) {
    'use strict';

    /**
     * The `options` and `views` panels below reproduce GrapesJS's own defaults.
     * They are spelled out rather than inherited because declaring `panels` at
     * init replaces the defaults wholesale, and the stock `commands` panel ships
     * a single empty button we do not want.
     */
    function definitions(config) {
        return [
            { id: 'commands', buttons: commandButtons(config) },
            {
                id: 'options',
                buttons: [
                    {
                        id: 'sw-visibility',
                        command: 'core:component-outline',
                        context: 'sw-visibility',
                        className: 'fa fa-square-o',
                        active: true,
                        attributes: { title: 'Hiện viền các khối' }
                    },
                    {
                        id: 'preview',
                        command: 'core:preview',
                        context: 'preview',
                        className: 'fa fa-eye',
                        attributes: { title: 'Xem trước (ẩn công cụ)' }
                    },
                    {
                        id: 'fullscreen',
                        command: 'core:fullscreen',
                        context: 'fullscreen',
                        className: 'fa fa-arrows-alt',
                        attributes: { title: 'Toàn màn hình' }
                    },
                    {
                        id: 'edit-code',
                        command: 'core:edit-code',
                        className: 'fa fa-code',
                        togglable: false,
                        attributes: { title: 'Xem & sửa mã nguồn HTML/CSS' }
                    },
                    {
                        id: 'builder-chrome',
                        command: 'core:toggle-chrome',
                        className: 'fa fa-window-maximize',
                        attributes: { title: 'Hiện Header & Footer thật của website (chỉ xem)' }
                    },
                    {
                        id: 'builder-collapse',
                        command: 'core:toggle-panel',
                        className: 'fa fa-angle-double-right',
                        attributes: { title: 'Thu gọn bảng bên phải (mở rộng vùng thiết kế)' }
                    },
                    {
                        id: 'builder-free-drag',
                        command: 'core:toggle-free-drag',
                        className: 'fa fa-arrows',
                        attributes: { title: 'Kéo thả tự do (đặt phần tử ở vị trí bất kỳ)' }
                    }
                ]
            },
            {
                id: 'views',
                buttons: [
                    {
                        id: 'open-sm',
                        command: 'open-sm',
                        className: 'fa fa-paint-brush',
                        active: true,
                        togglable: false,
                        attributes: { title: 'Kiểu dáng (Style Manager)' }
                    },
                    {
                        id: 'open-tm',
                        command: 'open-tm',
                        className: 'fa fa-cog',
                        togglable: false,
                        attributes: { title: 'Thuộc tính (Settings)' }
                    },
                    {
                        id: 'open-layers',
                        command: 'open-layers',
                        className: 'fa fa-bars',
                        togglable: false,
                        attributes: { title: 'Lớp (Layer Manager)' }
                    },
                    {
                        id: 'open-blocks',
                        command: 'open-blocks',
                        className: 'fa fa-th-large',
                        togglable: false,
                        attributes: { title: 'Khối (Blocks)' }
                    }
                ]
            }
        ];
    }

    function escapeHtml(value) {
        return String(value == null ? '' : value).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }

    function commandButtons(config) {
        var buttons = [
            {
                id: 'builder-back',
                command: 'core:back-to-pages',
                className: 'fa fa-arrow-left',
                togglable: false,
                attributes: { title: 'Quay lại danh sách trang' }
            },
            {
                // A label, not a control: `tagName: span` + no command.
                id: 'builder-title',
                tagName: 'span',
                className: 'builder-meta',
                label: escapeHtml(config.pageTitle || ''),
                togglable: false,
                attributes: { title: config.pageTitle || '' }
            },
            {
                id: 'builder-status',
                tagName: 'span',
                className: 'builder-badge ' + (config.isPublished ? 'builder-badge--live' : 'builder-badge--draft'),
                label: config.isPublished ? 'Đã xuất bản' : 'Bản nháp',
                togglable: false
            }
        ];

        if (config.isPartial) {
            var roleTitle = config.partialRole === 'header' ? 'Khối: Header' : (config.partialRole === 'footer' ? 'Khối: Footer' : 'Khối dùng chung');
            buttons.push({
                id: 'builder-role-badge',
                tagName: 'span',
                className: 'builder-badge builder-badge--partial',
                label: roleTitle,
                togglable: false
            });
        }

        (config.contentLanguages || []).forEach(function (lang) {
            // A single language needs no switch.
            if ((config.contentLanguages || []).length < 2) return;
            buttons.push({
                id: 'builder-locale-' + lang.code,
                className: 'builder-locale',
                label: escapeHtml(String(lang.code).toUpperCase()),
                command: 'core:switch-locale',
                togglable: false,
                active: !!lang.active,
                attributes: { title: lang.name, 'data-locale-url': lang.url }
            });
        });

        buttons.push(
            {
                id: 'device-desktop',
                command: 'set-device-desktop',
                className: 'fa fa-desktop',
                context: 'device',
                active: true,
                attributes: { title: 'Máy tính (Desktop)' }
            },
            {
                id: 'device-tablet',
                command: 'set-device-tablet',
                className: 'fa fa-tablet',
                context: 'device',
                attributes: { title: 'Máy tính bảng (768px)' }
            },
            {
                id: 'device-mobile',
                command: 'set-device-mobile',
                className: 'fa fa-mobile',
                context: 'device',
                attributes: { title: 'Điện thoại (375px)' }
            },
            {
                id: 'builder-undo',
                command: 'core:undo',
                className: 'fa fa-undo',
                togglable: false,
                attributes: { title: 'Hoàn tác (Ctrl+Z)' }
            },
            {
                id: 'builder-redo',
                command: 'core:redo',
                className: 'fa fa-repeat',
                togglable: false,
                attributes: { title: 'Làm lại (Ctrl+Shift+Z)' }
            },
            {
                id: 'builder-save',
                command: 'core:save-draft',
                className: 'builder-action builder-action--draft',
                label: 'Lưu nháp',
                togglable: false,
                attributes: { title: 'Lưu bản nháp (Ctrl+S)' }
            },
            {
                id: 'builder-publish',
                command: 'core:publish',
                className: 'builder-action builder-action--publish',
                label: 'Xuất bản',
                togglable: false,
                attributes: { title: 'Xuất bản trang lên website' }
            }
        );

        if (!config.isPartial) {
            if (config.headerBuilderUrl) {
                buttons.push({
                    id: 'builder-edit-header-btn',
                    command: 'core:open-header-builder',
                    className: 'builder-action builder-action--header',
                    label: 'Sửa Header ↗',
                    togglable: false,
                    attributes: { title: 'Mở trình thiết kế Header trong tab mới' }
                });
            }
            if (config.footerBuilderUrl) {
                buttons.push({
                    id: 'builder-edit-footer-btn',
                    command: 'core:open-footer-builder',
                    className: 'builder-action builder-action--footer',
                    label: 'Sửa Footer ↗',
                    togglable: false,
                    attributes: { title: 'Mở trình thiết kế Footer trong tab mới' }
                });
            }
        }

        return buttons;
    }

    /**
     * Keep the device buttons in sync when the device changes from anywhere
     * other than a click on them (a command, a keyboard shortcut, a restore).
     */
    function bindDeviceSync(editor) {
        var byDevice = {
            Desktop: 'device-desktop',
            Tablet: 'device-tablet',
            Mobile: 'device-mobile'
        };

        editor.on('change:device', function () {
            var current = editor.getDevice();
            Object.keys(byDevice).forEach(function (name) {
                var btn = editor.Panels.getButton('commands', byDevice[name]);
                if (btn) btn.set('active', name === current, { silent: true });
                if (btn) btn.trigger('updateActive');
            });
        });
    }

    /**
     * Apply the stored header/footer preference on every frame load and keep the
     * toggle showing it. Done here rather than through the button's `active`
     * flag: an active-at-init button fires its command before the canvas frame
     * exists, so the chrome would silently fail to mount.
     */
    function bindChromeSync(editor, config) {
        // Post-render event: on `canvas:frame:load` the wrapper does not exist
        // yet, so the header/footer were being inserted into an empty body and
        // ended up in the wrong place (or threw on a detached wrapper).
        editor.on('canvas:frame:load:body', function () {
            if (!global.GrapesCanvasContext) return;

            var wanted = localStorage.getItem('grapes_chrome_visible') !== 'false';
            global.GrapesCanvasContext.setChromeVisible(editor, config, wanted);

            var btn = editor.Panels.getButton('options', 'builder-chrome');
            if (!btn) return;
            btn.set('active', wanted, { silent: true });
            btn.trigger('updateActive');
        });
    }

    function init(editor, config) {
        bindDeviceSync(editor);
        bindChromeSync(editor, config || {});
    }

    global.GrapesPanels = {
        definitions: definitions,
        init: init
    };
})(window);
