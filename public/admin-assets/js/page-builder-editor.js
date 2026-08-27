/**
 * Shared GrapesJS editor enhancements: block grouping, a right-click context
 * menu, block ID/name management, and "save selection as a shared block".
 * Loaded alongside page-builder-blocks.js by both the full admin builder
 * (_form.blade.php) and the on-site inline editor (admin-bar.blade.php).
 */
(function (global) {
    function slugifyId(value) {
        return (value || '')
            .toString()
            .normalize('NFD')
            .replace(/[̀-ͯ]/g, '')
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '')
            .slice(0, 60);
    }

    function isHidden(component) {
        return component.getStyle && component.getStyle().display === 'none';
    }

    function toggleHidden(component) {
        if (isHidden(component)) {
            component.removeStyle('display');
        } else {
            component.addStyle({ display: 'none' });
        }
    }

    function registerGroupingCommands(editor) {
        editor.Commands.add('page:group', {
            run: function (ed) {
                var selected = ed.getSelectedAll ? ed.getSelectedAll() : [ed.getSelected()].filter(Boolean);
                if (!selected || selected.length < 2) return;

                var parent = selected[0].parent();
                if (!parent || !selected.every(function (c) { return c.parent() === parent; })) {
                    window.alert('Chỉ nhóm được các khối cùng cấp (cùng một khối cha).');
                    return;
                }

                var indexes = selected.map(function (c) { return parent.components().indexOf(c); });
                var insertAt = Math.min.apply(null, indexes);

                var group = parent.components().add({
                    tagName: 'div',
                    attributes: { 'data-page-block': 'group' },
                    'custom-name': 'Nhóm khối',
                    style: { display: 'flex', 'flex-wrap': 'wrap', gap: '16px', width: '100%' },
                }, { at: insertAt });

                selected.forEach(function (comp) {
                    group.components().add(comp);
                });
                ed.select(group);
            },
        });

        editor.Commands.add('page:ungroup', {
            run: function (ed) {
                var selected = ed.getSelected();
                if (!selected || (selected.getAttributes() || {})['data-page-block'] !== 'group') return;

                var parent = selected.parent();
                if (!parent) return;

                var index = parent.components().indexOf(selected);
                var children = selected.components().models.slice();
                children.forEach(function (child, i) {
                    parent.components().add(child, { at: index + i });
                });
                selected.remove();
            },
        });

        editor.Keymaps.add('page:group', 'ctrl+g', 'page:group');
        editor.Keymaps.add('page:ungroup', 'ctrl+shift+g', 'page:ungroup');
    }

    function registerIdAndNameTraits(editor) {
        editor.on('component:selected', function (component) {
            var traits = component.get('traits');
            if (!traits || !traits.add) return;

            if (!traits.where({ name: 'id' }).length) {
                traits.add({
                    type: 'text',
                    name: 'id',
                    label: 'ID khối (liên kết #...)',
                    changeProp: false,
                });
            }
            if (!traits.where({ name: 'custom-name' }).length) {
                traits.add({
                    type: 'text',
                    name: 'custom-name',
                    label: 'Tên hiển thị (trong Layer)',
                    changeProp: true,
                });
            }
        });

        editor.on('component:update:attributes', function (component) {
            var id = (component.getAttributes() || {}).id;
            if (!id) return;
            var clean = slugifyId(id);
            if (clean === id) return;

            var duplicate = editor.getWrapper().find('#' + clean).some(function (found) {
                return found !== component;
            });
            if (duplicate) {
                window.alert('ID "' + clean + '" đã được dùng cho khối khác. Vui lòng chọn ID khác.');
                component.addAttributes({ id: '' });
                return;
            }
            component.addAttributes({ id: clean });
        });
    }

    var DYNAMIC_BLOCK_TRAITS = {
        'product-tabs': [
            { name: 'data-limit', label: 'Số lượng hiển thị', type: 'number' },
            { name: 'data-columns', label: 'Số cột hiển thị', type: 'select', options: [
                { id: '2', name: '2 Cột' },
                { id: '3', name: '3 Cột' },
                { id: '4', name: '4 Cột' },
                { id: '5', name: '5 Cột' },
            ] },
            { name: 'data-gap', label: 'Khoảng cách (px)', type: 'select', options: [
                { id: '12', name: '12px' },
                { id: '16', name: '16px' },
                { id: '24', name: '24px' },
                { id: '32', name: '32px' },
                { id: '40', name: '40px' },
            ] },
            { name: 'data-align', label: 'Canh lề chữ', type: 'select', options: [
                { id: 'left', name: 'Căn trái' },
                { id: 'center', name: 'Căn giữa' },
                { id: 'right', name: 'Căn phải' },
            ] },
        ],
        'product-grid': [
            { name: 'data-query', label: 'Truy vấn', type: 'select', options: [
                { id: 'latest', name: 'Mới nhất' },
                { id: 'featured', name: 'Nổi bật' },
            ] },
            { name: 'data-category', label: 'Danh mục (để trống = tất cả)', type: 'text' },
            { name: 'data-limit', label: 'Số lượng hiển thị', type: 'number' },
            { name: 'data-columns', label: 'Số cột hiển thị', type: 'select', options: [
                { id: '2', name: '2 Cột' },
                { id: '3', name: '3 Cột' },
                { id: '4', name: '4 Cột' },
                { id: '5', name: '5 Cột' },
            ] },
            { name: 'data-gap', label: 'Khoảng cách (px)', type: 'select', options: [
                { id: '12', name: '12px' },
                { id: '16', name: '16px' },
                { id: '24', name: '24px' },
                { id: '32', name: '32px' },
                { id: '40', name: '40px' },
            ] },
            { name: 'data-align', label: 'Canh lề chữ', type: 'select', options: [
                { id: 'left', name: 'Căn trái' },
                { id: 'center', name: 'Căn giữa' },
                { id: 'right', name: 'Căn phải' },
            ] },
        ],
        'post-list': [
            { name: 'data-category', label: 'Danh mục bài viết (để trống = tất cả)', type: 'text' },
            { name: 'data-limit', label: 'Số lượng hiển thị', type: 'number' },
            { name: 'data-columns', label: 'Số cột hiển thị', type: 'select', options: [
                { id: '2', name: '2 Cột' },
                { id: '3', name: '3 Cột' },
                { id: '4', name: '4 Cột' },
            ] },
            { name: 'data-gap', label: 'Khoảng cách (px)', type: 'select', options: [
                { id: '16', name: '16px' },
                { id: '24', name: '24px' },
                { id: '32', name: '32px' },
            ] },
            { name: 'data-align', label: 'Canh lề chữ', type: 'select', options: [
                { id: 'left', name: 'Căn trái' },
                { id: 'center', name: 'Căn giữa' },
                { id: 'right', name: 'Căn phải' },
            ] },
        ],
        'category-grid': [
            { name: 'data-limit', label: 'Số lượng hiển thị', type: 'number' },
            { name: 'data-columns', label: 'Số cột hiển thị', type: 'select', options: [
                { id: '3', name: '3 Cột' },
                { id: '4', name: '4 Cột' },
                { id: '6', name: '6 Cột' },
                { id: '8', name: '8 Cột' },
            ] },
            { name: 'data-gap', label: 'Khoảng cách (px)', type: 'select', options: [
                { id: '12', name: '12px' },
                { id: '16', name: '16px' },
                { id: '24', name: '24px' },
                { id: '32', name: '32px' },
            ] },
            { name: 'data-align', label: 'Canh lề chữ', type: 'select', options: [
                { id: 'left', name: 'Căn trái' },
                { id: 'center', name: 'Căn giữa' },
                { id: 'right', name: 'Căn phải' },
            ] },
        ],
        'latest-reviews': [
            { name: 'data-limit', label: 'Số lượng hiển thị', type: 'number' },
            { name: 'data-columns', label: 'Số cột hiển thị', type: 'select', options: [
                { id: '2', name: '2 Cột' },
                { id: '3', name: '3 Cột' },
                { id: '4', name: '4 Cột' },
            ] },
            { name: 'data-gap', label: 'Khoảng cách (px)', type: 'select', options: [
                { id: '16', name: '16px' },
                { id: '24', name: '24px' },
                { id: '32', name: '32px' },
            ] },
        ],
    };

    function registerDynamicBlockTraits(editor) {
        editor.on('component:selected', function (component) {
            var attrs = component.getAttributes() || {};
            var blockType = attrs['data-page-block'];
            var traits = component.get('traits');
            if (!traits || !traits.add) return;

            (DYNAMIC_BLOCK_TRAITS[blockType] || []).forEach(function (definition) {
                if (traits.where({ name: definition.name }).length) return;
                traits.add({
                    type: definition.type,
                    name: definition.name,
                    label: definition.label,
                    options: definition.options,
                    changeProp: false,
                });
            });

            if (blockType === 'partial') {
                if (traits.where({ name: 'data-partial-id' }).length) return;
                var options = (global.pageBuilderPartials || []).map(function (partial) {
                    return { id: String(partial.id), name: partial.title };
                });
                traits.add({
                    type: 'select',
                    name: 'data-partial-id',
                    label: 'Chọn khối dùng chung',
                    options: options,
                    changeProp: false,
                });
            }
        });
    }

    function findComponentByLabel(editor, options) {
        options = options || {};
        var results = [];
        function walk(component) {
            var attrs = component.getAttributes() || {};
            if (attrs.id) {
                results.push({
                    id: attrs.id,
                    name: component.get('custom-name') || component.get('name') || component.get('tagName') || 'Khối',
                    component: component,
                });
            }
            component.components().forEach(walk);
        }
        walk(editor.getWrapper());
        return results;
    }

    function buildBlockListModal(editor) {
        var overlay = document.createElement('div');
        overlay.style.cssText = 'display:none;position:fixed;inset:0;background:rgba(10,18,28,.55);z-index:100000;align-items:center;justify-content:center;';
        var dialog = document.createElement('div');
        dialog.style.cssText = 'background:#fff;border-radius:10px;width:100%;max-width:480px;max-height:70vh;display:flex;flex-direction:column;font:14px/1.4 Arial,sans-serif;color:#243447;overflow:hidden;';
        var header = document.createElement('div');
        header.style.cssText = 'padding:14px 18px;border-bottom:1px solid #eef1f5;display:flex;justify-content:space-between;align-items:center;';
        header.innerHTML = '<strong>Danh sách khối có ID</strong>';
        var closeButton = document.createElement('button');
        closeButton.type = 'button';
        closeButton.textContent = 'Đóng';
        closeButton.style.cssText = 'border:0;background:#f1f3f6;border-radius:6px;padding:6px 12px;cursor:pointer;';
        header.appendChild(closeButton);

        var searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Tìm theo ID hoặc tên...';
        searchInput.style.cssText = 'margin:12px 18px;padding:8px 10px;border:1px solid #d9e0e8;border-radius:6px;';

        var list = document.createElement('div');
        list.style.cssText = 'overflow:auto;padding:0 8px 12px;';

        dialog.append(header, searchInput, list);
        overlay.appendChild(dialog);
        document.body.appendChild(overlay);

        function render(filterText) {
            list.innerHTML = '';
            var items = findComponentByLabel(editor);
            var needle = (filterText || '').toLowerCase();
            items
                .filter(function (item) {
                    return !needle || item.id.toLowerCase().indexOf(needle) !== -1 || String(item.name).toLowerCase().indexOf(needle) !== -1;
                })
                .forEach(function (item) {
                    var row = document.createElement('button');
                    row.type = 'button';
                    row.style.cssText = 'display:block;width:100%;text-align:left;padding:10px 12px;border:0;background:transparent;border-radius:6px;cursor:pointer;';
                    row.onmouseenter = function () { row.style.background = '#f5f7fa'; };
                    row.onmouseleave = function () { row.style.background = 'transparent'; };
                    row.innerHTML = '<div style="font-weight:600">' + item.name + '</div><div style="color:#64748b;font-size:12px">#' + item.id + '</div>';
                    row.addEventListener('click', function () {
                        editor.select(item.component);
                        var scrollToEl = editor.Commands.get('core:component-outline');
                        try { editor.runCommand('core:component-outline'); } catch (e) { /* no-op */ }
                        overlay.style.display = 'none';
                    });
                    list.appendChild(row);
                });

            if (!list.children.length) {
                var empty = document.createElement('div');
                empty.style.cssText = 'padding:24px;text-align:center;color:#94a3b8';
                empty.textContent = 'Chưa có khối nào đặt ID.';
                list.appendChild(empty);
            }
        }

        searchInput.addEventListener('input', function () { render(searchInput.value); });
        closeButton.addEventListener('click', function () { overlay.style.display = 'none'; });
        overlay.addEventListener('click', function (e) { if (e.target === overlay) overlay.style.display = 'none'; });

        return {
            open: function () {
                render('');
                searchInput.value = '';
                overlay.style.display = 'flex';
                searchInput.focus();
            },
        };
    }

    function saveSelectionAsPartial(editor, config, component) {
        var defaultTitle = component.get('custom-name') || 'Khối dùng chung mới';
        var title = window.prompt('Đặt tên cho khối dùng chung này:', defaultTitle);
        if (!title) return;

        var html = editor.getHtml({ component: component });
        var css = editor.getCss({ component: component }) || '';

        fetch(config.saveAsPartialUrl, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': config.csrfToken,
            },
            body: JSON.stringify({ title: title, published_html: html, published_css: css }),
        })
            .then(function (response) { return response.json().then(function (json) { return { ok: response.ok, json: json }; }); })
            .then(function (result) {
                if (!result.ok || !result.json.success) {
                    window.alert(result.json.message || 'Không thể lưu khối dùng chung.');
                    return;
                }
                if (typeof config.onPartialCreated === 'function') {
                    config.onPartialCreated(result.json.id, result.json.title);
                }
                window.alert('Đã lưu "' + result.json.title + '" vào Khối dùng chung.');
            })
            .catch(function () {
                window.alert('Không thể lưu khối dùng chung. Vui lòng thử lại.');
            });
    }

    function registerContextMenu(editor, config) {
        config = config || {};
        var menuEl = document.createElement('div');
        menuEl.style.cssText = 'position:fixed;z-index:99999;display:none;background:#fff;border:1px solid #d9e0e8;'
            + 'border-radius:8px;box-shadow:0 12px 32px rgba(0,0,0,.18);min-width:230px;'
            + 'font:14px/1.4 Arial,sans-serif;padding:6px 0;';
        document.body.appendChild(menuEl);

        function hideMenu() {
            menuEl.style.display = 'none';
            menuEl.innerHTML = '';
        }

        function addItem(label, onClick, options) {
            options = options || {};
            var el = document.createElement('button');
            el.type = 'button';
            el.style.cssText = 'display:flex;justify-content:space-between;align-items:center;gap:16px;width:100%;'
                + 'padding:8px 14px;border:0;background:transparent;text-align:left;cursor:pointer;color:#243447;font:inherit;';
            var labelSpan = document.createElement('span');
            labelSpan.textContent = label;
            el.appendChild(labelSpan);
            if (options.shortcut) {
                var kbd = document.createElement('span');
                kbd.textContent = options.shortcut;
                kbd.style.cssText = 'color:#94a3b8;font-size:12px';
                el.appendChild(kbd);
            }
            if (options.disabled) {
                el.style.opacity = '.4';
                el.style.cursor = 'not-allowed';
            } else {
                el.addEventListener('mouseenter', function () { el.style.background = '#f5f7fa'; });
                el.addEventListener('mouseleave', function () { el.style.background = 'transparent'; });
                el.addEventListener('click', function () {
                    hideMenu();
                    onClick();
                });
            }
            menuEl.appendChild(el);
        }

        function addDivider() {
            var hr = document.createElement('div');
            hr.style.cssText = 'height:1px;background:#eef1f5;margin:6px 0';
            menuEl.appendChild(hr);
        }

        function showMenu(clientX, clientY, component) {
            menuEl.innerHTML = '';
            var attrs = component.getAttributes() || {};
            var isGroup = attrs['data-page-block'] === 'group';
            var selectedAll = editor.getSelectedAll ? editor.getSelectedAll() : [component];
            var parent = component.parent();
            var isTopLevel = !parent || (parent.is && parent.is('wrapper'));

            addItem('Nhóm lại', function () { editor.runCommand('page:group'); }, { shortcut: 'Ctrl+G', disabled: selectedAll.length < 2 });
            addItem('Bỏ nhóm', function () { editor.runCommand('page:ungroup'); }, { shortcut: 'Ctrl+Shift+G', disabled: !isGroup });
            addDivider();
            addItem('Sao chép', function () { editor.runCommand('core:copy'); }, { shortcut: 'Ctrl+C' });
            addItem('Dán', function () { editor.runCommand('core:paste'); }, { shortcut: 'Ctrl+V' });
            addItem('Nhân bản', function () { editor.runCommand('tlb-clone'); }, { shortcut: 'Ctrl+D' });
            addItem('Xoá', function () { editor.runCommand('core:component-delete'); }, { shortcut: 'Del' });
            addDivider();
            addItem('Đưa lên trước', function () {
                if (!parent) return;
                var index = parent.components().indexOf(component);
                if (index > 0) parent.components().add(component, { at: index - 1 });
            }, { disabled: isTopLevel });
            addItem('Đưa ra sau', function () {
                if (!parent) return;
                var index = parent.components().indexOf(component);
                if (index < parent.components().length - 1) parent.components().add(component, { at: index + 2 });
            }, { disabled: isTopLevel });
            addItem(component.get('locked') ? 'Mở khoá' : 'Khoá', function () {
                component.set('locked', !component.get('locked'));
            });
            addItem(isHidden(component) ? 'Hiện' : 'Ẩn', function () { toggleHidden(component); });
            addDivider();
            addItem('Chọn phần tử cha', function () {
                if (parent) editor.select(parent);
            }, { disabled: isTopLevel });
            addItem('Đổi tên khối…', function () {
                var current = component.get('custom-name') || '';
                var next = window.prompt('Tên hiển thị cho khối này:', current);
                if (next !== null) component.set('custom-name', next);
            });
            addItem('Copy ID', function () {
                var id = attrs.id;
                if (!id) { window.alert('Khối này chưa có ID. Đặt ID trong bảng Cài đặt (Settings) trước.'); return; }
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText('#' + id);
                } else {
                    window.prompt('Sao chép ID:', '#' + id);
                }
            }, { disabled: !attrs.id });
            addItem('Lưu thành khối dùng chung…', function () {
                if (config.saveAsPartialUrl) saveSelectionAsPartial(editor, config, component);
            }, { disabled: !config.saveAsPartialUrl });

            var menuWidth = 240;
            var menuHeight = menuEl.children.length * 36 + 12;
            var left = Math.min(clientX, window.innerWidth - menuWidth - 8);
            var top = Math.min(clientY, window.innerHeight - menuHeight - 8);
            menuEl.style.left = Math.max(8, left) + 'px';
            menuEl.style.top = Math.max(8, top) + 'px';
            menuEl.style.display = 'block';
        }

        document.addEventListener('click', hideMenu);
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') hideMenu(); });
        window.addEventListener('resize', hideMenu);

        editor.on('load', function () {
            var canvasDoc = editor.Canvas.getDocument();
            if (!canvasDoc) return;

            canvasDoc.addEventListener('contextmenu', function (e) {
                e.preventDefault();
                hideMenu();

                window.setTimeout(function () {
                    var component = editor.getSelected();
                    if (!component) return;

                    var frameEl = editor.Canvas.getFrameEl();
                    var frameRect = frameEl ? frameEl.getBoundingClientRect() : { left: 0, top: 0 };
                    showMenu(frameRect.left + e.clientX, frameRect.top + e.clientY, component);
                }, 0);
            });
        });
    }

    function registerButtonTooltips(editor) {
        function setBtnTooltip(btn, text) {
            if (!btn) return;
            btn.set('attributes', { title: text });
            btn.set('title', text);
            if (btn.el) {
                btn.el.setAttribute('title', text);
                btn.el.removeAttribute('data-tooltip');
            }
        }

        function updateTooltips() {
            var panels = editor.Panels;
            var lang = document.documentElement.lang || 'vi';
            var isEn = lang.indexOf('en') === 0;

            function setDomTooltip(selector, text) {
                const el = document.querySelector(selector);
                if (el) {
                    el.setAttribute('title', text);
                    el.removeAttribute('data-tooltip');
                }
            }

            // Options panel
            setDomTooltip('.gjs-pn-btn.fa-eye', isEn ? 'Preview' : 'Chế độ xem trước (Preview)');
            setDomTooltip('.gjs-pn-btn.fa-external-link', isEn ? 'View on website' : 'Xem trên trang web');
            setDomTooltip('.gjs-pn-btn.fa-code', isEn ? 'View code' : 'Xem mã nguồn (Code view)');
            setDomTooltip('.gjs-pn-btn.fa-square-o', isEn ? 'Show/Hide grid outlines' : 'Hiện/Ẩn viền khung (Grid outline)');
            setDomTooltip('.gjs-pn-btn.fa-check-square-o', isEn ? 'Show/Hide grid outlines' : 'Hiện/Ẩn viền khung (Grid outline)');

            // Views panel
            setDomTooltip('.gjs-pn-btn.fa-paint-brush', isEn ? 'Style Manager' : 'Chỉnh sửa kiểu dáng (Style Manager)');
            setDomTooltip('.gjs-pn-btn.fa-cog', isEn ? 'Trait Manager (Settings)' : 'Cấu hình thuộc tính (Trait Manager)');
            setDomTooltip('.gjs-pn-btn.fa-bars', isEn ? 'Layers Manager' : 'Quản lý các lớp (Layers)');
            setDomTooltip('.gjs-pn-btn.fa-th-large', isEn ? 'Blocks Manager' : 'Quản lý các khối (Blocks)');

            var optPanel = panels.getPanel('options');
            if (optPanel) {
                var fsBtn = panels.getButton('options', 'fullscreen');
                if (fsBtn) {
                    fsBtn.set('attributes', { class: 'gjs-pn-btn fa fa-external-link', title: isEn ? 'View on website' : 'Xem trên trang web' });
                }
                setBtnTooltip(panels.getButton('options', 'sw-visibility'), isEn ? 'Show/Hide grid outlines' : 'Hiện/Ẩn viền khung (Grid outline)');
                setBtnTooltip(panels.getButton('options', 'preview'), isEn ? 'Preview' : 'Chế độ xem trước (Preview)');
                setBtnTooltip(panels.getButton('options', 'export-template'), isEn ? 'View code' : 'Xem mã nguồn (Code view)');
            }

            var viewsPanel = panels.getPanel('views');
            if (viewsPanel) {
                setBtnTooltip(panels.getButton('views', 'open-sm'), isEn ? 'Style Manager' : 'Chỉnh sửa kiểu dáng (Style Manager)');
                setBtnTooltip(panels.getButton('views', 'open-tm'), isEn ? 'Trait Manager (Settings)' : 'Cấu hình thuộc tính (Trait Manager)');
                setBtnTooltip(panels.getButton('views', 'open-layers'), isEn ? 'Layers Manager' : 'Quản lý các lớp (Layers)');
                setBtnTooltip(panels.getButton('views', 'open-blocks'), isEn ? 'Blocks Manager' : 'Quản lý các khối (Blocks)');
            }
        }

        if (editor.Panels) {
            updateTooltips();
        }
        editor.on('load', function () {
            updateTooltips();
            setTimeout(updateTooltips, 50);
            setTimeout(updateTooltips, 200);
            setTimeout(updateTooltips, 500);
        });
    }

    function registerPageBuilderEditorEnhancements(editor, config) {
        registerGroupingCommands(editor);
        registerIdAndNameTraits(editor);
        registerDynamicBlockTraits(editor);
        registerContextMenu(editor, config || {});
        registerButtonTooltips(editor);

        // Override fullscreen button to trigger the website preview instead
        editor.Commands.add('fullscreen', {
            run: function (ed) {
                const previewBtn = document.getElementById('page-builder-preview-button');
                if (previewBtn) {
                    previewBtn.click();
                }
                // Immediately turn off the active state of GrapesJS button
                const btn = ed.Panels.getButton('options', 'fullscreen');
                if (btn) btn.set('active', false);
            },
            stop: function (ed) {}
        });

        var blockListModal = buildBlockListModal(editor);
        global.__pageBuilderBlockListModal = blockListModal;
    }

    global.registerPageBuilderEditorEnhancements = registerPageBuilderEditorEnhancements;
    global.openPageBuilderBlockList = function () {
        if (global.__pageBuilderBlockListModal) global.__pageBuilderBlockListModal.open();
    };
})(window);
