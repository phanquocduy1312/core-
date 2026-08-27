/**
 * Page Builder UX Shell Javascript Engine
 */
(function (global) {
    'use strict';

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    function createInsertButton(editor, parentComponent, isRoot) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'pb-add-button';
        
        const labelText = isRoot ? '+ Add elements' : '+ Add to Section';
        btn.innerHTML = `<iconify-icon icon="solar:add-circle-linear"></iconify-icon> <span>${labelText}</span>`;
        btn.title = labelText;
        
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const index = parentComponent.components().length;
            openInsertBlockDialog(editor, parentComponent, index);
        });
        
        return btn;
    }

    function openInsertBlockDialog(editor, parentComponent, index) {
        let modal = document.getElementById('pb-insert-modal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'pb-insert-modal';
            
            const dialog = document.createElement('div');
            dialog.className = 'pb-modal-dialog';
            
            const header = document.createElement('div');
            header.className = 'pb-modal-header';
            header.innerHTML = `
                <h3 class="pb-modal-title">Thêm khối nội dung</h3>
                <button type="button" class="pb-modal-close" id="pb-insert-modal-close">
                    <iconify-icon icon="solar:close-circle-linear" class="text-xl"></iconify-icon>
                </button>
            `;
            dialog.appendChild(header);
            
            const body = document.createElement('div');
            body.className = 'pb-modal-body';
            body.id = 'pb-insert-modal-body';
            dialog.appendChild(body);
            
            modal.appendChild(dialog);
            const container = document.getElementById('client-inline-editor') || document.body;
            container.appendChild(modal);
            
            document.getElementById('pb-insert-modal-close').addEventListener('click', () => {
                modal.style.setProperty('display', 'none', 'important');
            });
        }
        
        const body = document.getElementById('pb-insert-modal-body');
        body.innerHTML = '';
        
        const blocks = editor.BlockManager.getAll().models;
        blocks.forEach((block) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'pb-block-item-btn';
            
            const iconContainer = document.createElement('div');
            iconContainer.className = 'pb-block-icon-box';
            iconContainer.innerHTML = block.get('media') || '<iconify-icon icon="solar:widget-3-linear" class="text-xl"></iconify-icon>';
            
            const textContainer = document.createElement('div');
            textContainer.className = 'pb-block-label';
            textContainer.textContent = block.get('label');
            
            btn.append(iconContainer, textContainer);
            
            btn.addEventListener('click', () => {
                modal.style.setProperty('display', 'none', 'important');
                const content = block.get('content');
                const newComp = parentComponent.components().add(content, { at: index });
                editor.select(newComp);
                // Trigger tree render
                const elementTree = document.getElementById('pb-element-tree');
                if (elementTree) {
                    renderTree(editor, elementTree, newComp);
                }
            });
            
            body.appendChild(btn);
        });
        
        modal.style.setProperty('display', 'flex', 'important');
    }

    function renderTree(editor, container, activeComponent) {
        if (!container) return;
        const wrapper = editor.getWrapper();
        container.innerHTML = '';

        function buildNode(component, depth) {
            if (!component) return null;
            if (component.get('layerable') === false) return null;

            const tagName = component.get('tagName');
            const type = component.get('type');

            const nodeWrapper = document.createElement('div');
            nodeWrapper.className = 'pb-tree-node-wrapper';

            const node = document.createElement('div');
            node.className = 'pb-tree-node';
            if (activeComponent === component) {
                node.classList.add('is-active');
            }

            const nodeLeft = document.createElement('div');
            nodeLeft.className = 'pb-node-left';
            nodeLeft.style.paddingLeft = (depth * 12) + 'px';

            const children = component.components();
            const hasChildren = children && children.length > 0;

            if (hasChildren) {
                const caret = document.createElement('span');
                caret.className = 'pb-node-caret';
                caret.innerHTML = '<iconify-icon icon="solar:alt-arrow-down-linear"></iconify-icon>';
                
                const isCollapsed = component.get('is-collapsed') || false;
                if (isCollapsed) {
                    caret.classList.add('is-collapsed');
                }
                caret.addEventListener('click', (e) => {
                    e.stopPropagation();
                    component.set('is-collapsed', !isCollapsed);
                    renderTree(editor, container, editor.getSelected());
                });
                nodeLeft.appendChild(caret);
            } else {
                const spacer = document.createElement('span');
                spacer.style.width = '14px';
                nodeLeft.appendChild(spacer);
            }

            const icon = document.createElement('span');
            icon.className = 'pb-node-icon';
            let iconName = 'solar:widget-linear';
            if (type === 'image') iconName = 'solar:gallery-linear';
            else if (type === 'text') iconName = 'solar:document-text-linear';
            else if (tagName === 'section') iconName = 'solar:box-linear';
            icon.innerHTML = `<iconify-icon icon="${iconName}"></iconify-icon>`;
            nodeLeft.appendChild(icon);

            const label = document.createElement('span');
            label.className = 'pb-node-label';
            label.textContent = component.get('custom-name') || component.getName() || tagName || 'Khối';
            nodeLeft.appendChild(label);

            node.appendChild(nodeLeft);

            const gear = document.createElement('span');
            gear.className = 'pb-node-gear';
            gear.innerHTML = '<iconify-icon icon="solar:settings-linear"></iconify-icon>';
            gear.addEventListener('click', (e) => {
                e.stopPropagation();
                editor.select(component);
                const drawer = document.getElementById('pb-settings-drawer');
                if (drawer) drawer.classList.remove('is-hidden');
            });
            node.appendChild(gear);

            node.addEventListener('click', () => {
                editor.select(component);
            });

            nodeWrapper.appendChild(node);

            const isCollapsed = component.get('is-collapsed') || false;
            const isContainer = tagName === 'section' || type === 'section' || tagName === 'div' || type === 'row' || type === 'container' || tagName === 'main' || tagName === 'article' || tagName === 'header' || tagName === 'footer';
            
            if (!isCollapsed) {
                if (hasChildren) {
                    const childrenContainer = document.createElement('div');
                    childrenContainer.className = 'pb-tree-children';
                    
                    children.forEach((child) => {
                        const childNode = buildNode(child, depth + 1);
                        if (childNode) {
                            childrenContainer.appendChild(childNode);
                        }
                    });
                    
                    if (isContainer) {
                        childrenContainer.appendChild(createInsertButton(editor, component, false));
                    }
                    nodeWrapper.appendChild(childrenContainer);
                } else if (isContainer) {
                    const childrenContainer = document.createElement('div');
                    childrenContainer.className = 'pb-tree-children';
                    childrenContainer.appendChild(createInsertButton(editor, component, false));
                    nodeWrapper.appendChild(childrenContainer);
                }
            }

            return nodeWrapper;
        }

        wrapper.components().forEach((comp) => {
            const node = buildNode(comp, 0);
            if (node) {
                container.appendChild(node);
            }
        });

        container.appendChild(createInsertButton(editor, wrapper, true));
    }

    function mountPageBuilderShell(editor, config) {
        config = config || {};
        
        const settingsDrawer = document.getElementById('pb-settings-drawer');
        const settingsClose = document.getElementById('pb-settings-close');
        const settingsToggle = document.getElementById('pb-panel-settings-toggle');

        if (settingsToggle) {
            settingsToggle.addEventListener('click', () => {
                if (settingsDrawer) {
                    settingsDrawer.classList.toggle('is-hidden');
                    editor.refresh();
                }
            });
        }

        if (settingsClose) {
            settingsClose.addEventListener('click', () => {
                if (settingsDrawer) {
                    settingsDrawer.classList.add('is-hidden');
                    editor.refresh();
                }
            });
        }

        // Set device event listeners
        const devices = {
            desktop: document.getElementById('pb-device-desktop'),
            tablet: document.getElementById('pb-device-tablet'),
            mobile: document.getElementById('pb-device-mobile'),
        };

        const setDevice = (deviceName) => {
            Object.values(devices).forEach(btn => {
                if (btn) btn.classList.remove('is-active');
            });
            if (deviceName === 'Desktop' && devices.desktop) {
                devices.desktop.classList.add('is-active');
                editor.setDevice('Desktop');
            } else if (deviceName === 'Tablet' && devices.tablet) {
                devices.tablet.classList.add('is-active');
                editor.setDevice('Tablet');
            } else if (deviceName === 'Mobile' && devices.mobile) {
                devices.mobile.classList.add('is-active');
                editor.setDevice('Mobile');
            }
        };

        if (devices.desktop) devices.desktop.addEventListener('click', () => setDevice('Desktop'));
        if (devices.tablet) devices.tablet.addEventListener('click', () => setDevice('Tablet'));
        if (devices.mobile) devices.mobile.addEventListener('click', () => setDevice('Mobile'));

        // Bind update/save button inside left panel footer
        const submitBtn = document.getElementById('pb-submit-proxy') || document.getElementById('client-inline-editor-save');
        if (submitBtn) {
            submitBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (config.mode === 'admin') {
                    const saveBtn = document.querySelector('button[type="submit"]');
                    if (saveBtn) saveBtn.click();
                } else {
                    const clientSaveBtn = document.getElementById('client-inline-editor-save');
                    if (clientSaveBtn && clientSaveBtn !== submitBtn) clientSaveBtn.click();
                }
            });
        }

        // Undo / Redo
        const undoBtn = document.getElementById('pb-undo') || document.getElementById('client-inline-editor-undo') || document.getElementById('page-builder-undo-button');
        const redoBtn = document.getElementById('pb-redo') || document.getElementById('client-inline-editor-redo') || document.getElementById('page-builder-redo-button');

        if (undoBtn) {
            undoBtn.addEventListener('click', (e) => {
                e.preventDefault();
                editor.runCommand('core:undo');
            });
        }
        if (redoBtn) {
            redoBtn.addEventListener('click', (e) => {
                e.preventDefault();
                editor.runCommand('core:redo');
            });
        }

        // Preview button
        const previewBtn = document.getElementById('pb-preview-btn') || document.getElementById('page-builder-preview-button');
        if (previewBtn && previewBtn.id === 'pb-preview-btn') {
            previewBtn.addEventListener('click', () => {
                const realPreview = document.getElementById('page-builder-preview-button');
                if (realPreview) realPreview.click();
            });
        }

        // Element tree rendering and component selected hooks
        const treeContainer = document.getElementById('pb-element-tree');
        
        const debouncedRender = debounce(() => {
            renderTree(editor, treeContainer, editor.getSelected());
        }, 150);

        // Setup a placeholder for settings
        let settingsPlaceholder = document.getElementById('pb-settings-placeholder');
        if (!settingsPlaceholder && settingsDrawer) {
            settingsPlaceholder = document.createElement('div');
            settingsPlaceholder.id = 'pb-settings-placeholder';
            settingsPlaceholder.className = 'pb-settings-placeholder';
            settingsPlaceholder.innerHTML = `
                <iconify-icon icon="solar:widget-add-linear" class="text-4xl text-gray-300 mb-2" style="font-size: 32px; color: #a1a1aa;"></iconify-icon>
                <div class="text-xs text-gray-400 text-center px-4 font-semibold" style="font-family:'Quicksand',sans-serif;">Chọn một phần tử để thiết lập thuộc tính</div>
            `;
            const body = document.getElementById('pb-settings-body');
            if (body) {
                body.parentNode.insertBefore(settingsPlaceholder, body);
            }
        }

        const updatePlaceholderVisibility = () => {
            const selected = editor.getSelected();
            const body = document.getElementById('pb-settings-body');
            if (selected) {
                if (settingsPlaceholder) settingsPlaceholder.style.setProperty('display', 'none', 'important');
                if (body) body.style.setProperty('display', 'block', 'important');
            } else {
                if (settingsPlaceholder) settingsPlaceholder.style.setProperty('display', 'flex', 'important');
                if (body) body.style.setProperty('display', 'none', 'important');
            }
        };

        editor.on('component:selected', (comp) => {
            renderTree(editor, treeContainer, comp);
            updatePlaceholderVisibility();
            if (settingsDrawer && settingsDrawer.classList.contains('is-hidden')) {
                settingsDrawer.classList.remove('is-hidden');
                editor.refresh();
            }
        });

        editor.on('component:deselected', () => {
            updatePlaceholderVisibility();
        });

        // Run once initially
        updatePlaceholderVisibility();

        editor.on('component:add component:remove component:update:components sorter:drag:end', debouncedRender);

        // Initial render
        editor.on('load', () => {
            renderTree(editor, treeContainer, editor.getSelected());
        });

        // If editor is already loaded when mounting
        if (editor.getWrapper()) {
            renderTree(editor, treeContainer, editor.getSelected());
        }
    }

    global.mountPageBuilderShell = mountPageBuilderShell;

})(window);
