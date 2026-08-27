/**
 * GrapesJS Core Editor Initialization & UI Controller
 * Implements Collapsible Sidebars, Focus Mode, Real Fullscreen, Preview, and Device Widths
 */
(function (global) {
    'use strict';

    function createEditor(config) {
        var editor = grapesjs.init({
            container: '#gjs-container',
            height: '100%',
            width: 'auto',
            fromElement: false,
            storageManager: {
                type: 'laravel',
                autosave: false,
                autoload: true
            },
            deviceManager: {
                devices: [
                    {
                        id: 'desktop',
                        name: 'Desktop',
                        width: '',
                    },
                    {
                        id: 'tablet',
                        name: 'Tablet',
                        width: '768px',
                        widthMedia: '992px',
                    },
                    {
                        id: 'mobile',
                        name: 'Mobile',
                        width: '375px',
                        widthMedia: '480px',
                    }
                ]
            },
            blockManager: {
                appendTo: '#gjs-blocks'
            },
            styleManager: {
                appendTo: '#gjs-styles',
                sectors: [
                    {
                        name: 'Kích thước & Lề (Dimensions & Spacing)',
                        open: true,
                        buildProps: ['width', 'max-width', 'min-height', 'height', 'margin', 'padding'],
                        properties: [
                            {
                                property: 'padding',
                                properties: [
                                    { name: 'Trên', property: 'padding-top' },
                                    { name: 'Phải', property: 'padding-right' },
                                    { name: 'Dưới', property: 'padding-bottom' },
                                    { name: 'Trái', property: 'padding-left' }
                                ]
                            },
                            {
                                property: 'margin',
                                properties: [
                                    { name: 'Trên', property: 'margin-top' },
                                    { name: 'Phải', property: 'margin-right' },
                                    { name: 'Dưới', property: 'margin-bottom' },
                                    { name: 'Trái', property: 'margin-left' }
                                ]
                            }
                        ]
                    },
                    {
                        name: 'Kiểu chữ (Typography)',
                        open: true,
                        buildProps: ['font-size', 'font-weight', 'line-height', 'letter-spacing', 'color', 'text-align'],
                        properties: [
                            {
                                name: 'Cỡ chữ',
                                property: 'font-size',
                                type: 'select',
                                defaults: '16px',
                                options: [
                                    { id: '14px', label: '14px' },
                                    { id: '16px', label: '16px' },
                                    { id: '18px', label: '18px' },
                                    { id: '20px', label: '20px' },
                                    { id: '24px', label: '24px' },
                                    { id: '30px', label: '30px' },
                                    { id: '36px', label: '36px' },
                                    { id: '38px', label: '38px' },
                                    { id: '48px', label: '48px' },
                                    { id: '60px', label: '60px' }
                                ]
                            },
                            {
                                name: 'Căn lề',
                                property: 'text-align',
                                type: 'radio',
                                defaults: 'left',
                                options: [
                                    { id: 'left', label: 'Trái' },
                                    { id: 'center', label: 'Giữa' },
                                    { id: 'right', label: 'Phải' },
                                    { id: 'justify', label: 'Đều' }
                                ]
                            }
                        ]
                    },
                    {
                        name: 'Bố cục (Layout)',
                        open: false,
                        buildProps: ['display', 'flex-direction', 'justify-content', 'align-items', 'gap']
                    },
                    {
                        name: 'Màu nền & Bo góc (Decorations)',
                        open: false,
                        buildProps: ['background-color', 'border-radius', 'border', 'box-shadow']
                    }
                ]
            },
            traitManager: {
                appendTo: '#gjs-traits'
            },
            layerManager: {
                appendTo: '#gjs-layers'
            },
            panels: {
                defaults: []
            },
            canvas: {
                styles: [
                    'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap',
                    '/build/assets/builder.css',
                    '/build/assets/admin.css'
                ],
                scripts: [
                    'https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js'
                ]
            }
        });

        // Initialize Laravel Storage Adapter
        if (global.GrapesLaravelStorage) {
            global.GrapesLaravelStorage.init(editor, config);
        }

        // Initialize Media Adapter (Media Library integration)
        if (global.GrapesMediaAdapter) {
            global.GrapesMediaAdapter.init(editor, config);
        }

        // Initialize Basic Components
        if (global.GrapesHeadingComponent) global.GrapesHeadingComponent.init(editor);
        if (global.GrapesParagraphComponent) global.GrapesParagraphComponent.init(editor);
        if (global.GrapesButtonComponent) global.GrapesButtonComponent.init(editor);
        if (global.GrapesImageComponent) global.GrapesImageComponent.init(editor);
        if (global.GrapesDividerComponent) global.GrapesDividerComponent.init(editor);
        if (global.GrapesSpacerComponent) global.GrapesSpacerComponent.init(editor);
        if (global.GrapesIconComponent) global.GrapesIconComponent.init(editor);
        if (global.GrapesVideoComponent) global.GrapesVideoComponent.init(editor);

        // Initialize Layout Components
        if (global.GrapesSectionComponent) global.GrapesSectionComponent.init(editor);
        if (global.GrapesContainerComponent) global.GrapesContainerComponent.init(editor);
        if (global.GrapesColumnComponent) global.GrapesColumnComponent.init(editor);
        if (global.GrapesColumnsComponent) global.GrapesColumnsComponent.init(editor);
        if (global.GrapesGridComponent) global.GrapesGridComponent.init(editor);
        if (global.GrapesStackComponent) global.GrapesStackComponent.init(editor);

        // Initialize Blocks
        if (global.GrapesBasicBlocks) global.GrapesBasicBlocks.init(editor);
        if (global.GrapesLayoutBlocks) global.GrapesLayoutBlocks.init(editor);
        if (global.GrapesSectionBlocks) global.GrapesSectionBlocks.init(editor);
        if (global.GrapesDynamicBlocks) global.GrapesDynamicBlocks.init(editor);

        // Initialize Commands
        if (global.GrapesCommands) {
            global.GrapesCommands.init(editor, config);
        }

        // Attach Unique ID Clone Hook
        if (global.GrapesIdManager && global.GrapesIdManager.attachCloneHook) {
            global.GrapesIdManager.attachCloneHook(editor);
        }

        // Load Initial Project Data from builder_data (Source of Truth)
        if (config.builderData && typeof config.builderData === 'object' && Object.keys(config.builderData).length > 0) {
            try {
                if (config.builderData.pages || config.builderData.components) {
                    var safeProjectData = global.GrapesIdManager && global.GrapesIdManager.normalizeProjectData
                        ? global.GrapesIdManager.normalizeProjectData(config.builderData)
                        : config.builderData;
                    editor.loadProjectData(safeProjectData);
                } else if (config.initialHtml) {
                    editor.setComponents(config.initialHtml);
                }
            } catch (e) {
                console.warn('Could not load project data, falling back to html:', e);
                if (config.initialHtml) editor.setComponents(config.initialHtml);
            }
        } else if (config.initialHtml) {
            editor.setComponents(config.initialHtml);
        }

        // Bind UI Controls (Sidebars, Focus Mode, Devices, Fullscreen, Preview)
        bindUiControls(editor, config);

        return editor;
    }

    function bindUiControls(editor, config) {
        var leftSidebar = document.getElementById('builder-left-sidebar');
        var rightSidebar = document.getElementById('builder-right-sidebar');
        var btnExpandLeft = document.getElementById('btn-expand-left');
        var btnExpandRight = document.getElementById('btn-expand-right');
        var btnCollapseLeft = document.getElementById('btn-collapse-left');
        var btnCollapseRight = document.getElementById('btn-collapse-right');
        var btnFocusMode = document.getElementById('btn-focus-mode');
        var btnPreview = document.getElementById('btn-preview');
        var btnFullscreen = document.getElementById('btn-fullscreen');
        var appRoot = document.getElementById('builder-app');

        // State tracking
        var isFocusMode = false;
        var savedLeftState = localStorage.getItem('grapes_left_collapsed') === 'true';
        var savedRightState = localStorage.getItem('grapes_right_collapsed') === 'true';

        // 1. Sidebar Collapse / Expand Helpers
        function setLeftCollapsed(collapsed) {
            if (collapsed) {
                leftSidebar.style.display = 'none';
                btnExpandLeft.classList.remove('hidden');
            } else {
                leftSidebar.style.display = 'flex';
                btnExpandLeft.classList.add('hidden');
            }
            if (!isFocusMode) {
                localStorage.setItem('grapes_left_collapsed', collapsed ? 'true' : 'false');
            }
            setTimeout(function () { editor.refresh(); }, 50);
        }

        function setRightCollapsed(collapsed) {
            if (collapsed) {
                rightSidebar.style.display = 'none';
                btnExpandRight.classList.remove('hidden');
            } else {
                rightSidebar.style.display = 'flex';
                btnExpandRight.classList.add('hidden');
            }
            if (!isFocusMode) {
                localStorage.setItem('grapes_right_collapsed', collapsed ? 'true' : 'false');
            }
            setTimeout(function () { editor.refresh(); }, 50);
        }

        // Restore saved sidebar states
        if (savedLeftState) setLeftCollapsed(true);
        if (savedRightState) setRightCollapsed(true);

        if (btnCollapseLeft) {
            btnCollapseLeft.addEventListener('click', function () { setLeftCollapsed(true); });
        }
        if (btnExpandLeft) {
            btnExpandLeft.addEventListener('click', function () { setLeftCollapsed(false); });
        }
        if (btnCollapseRight) {
            btnCollapseRight.addEventListener('click', function () { setRightCollapsed(true); });
        }
        if (btnExpandRight) {
            btnExpandRight.addEventListener('click', function () { setRightCollapsed(false); });
        }

        // 2. Focus Mode Toggle (Hides both sidebars, canvas gets 100% of workspace)
        function toggleFocusMode() {
            isFocusMode = !isFocusMode;
            if (isFocusMode) {
                setLeftCollapsed(true);
                setRightCollapsed(true);
                btnFocusMode.classList.add('bg-red-50', 'text-primary', 'border-red-200');
            } else {
                btnFocusMode.classList.remove('bg-red-50', 'text-primary', 'border-red-200');
                setLeftCollapsed(localStorage.getItem('grapes_left_collapsed') === 'true');
                setRightCollapsed(localStorage.getItem('grapes_right_collapsed') === 'true');
            }
        }

        if (btnFocusMode) {
            btnFocusMode.addEventListener('click', toggleFocusMode);
        }

        // Keyboard shortcut: Ctrl+Shift+F / Cmd+Shift+F for Focus Mode
        window.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'F' || e.key === 'f')) {
                e.preventDefault();
                toggleFocusMode();
            }
        });

        // 3. Real Fullscreen Mode (using Fullscreen API on #builder-app)
        if (btnFullscreen) {
            btnFullscreen.addEventListener('click', function () {
                if (!document.fullscreenElement) {
                    if (appRoot.requestFullscreen) {
                        appRoot.requestFullscreen();
                    } else if (appRoot.webkitRequestFullscreen) {
                        appRoot.webkitRequestFullscreen();
                    } else if (appRoot.msRequestFullscreen) {
                        appRoot.msRequestFullscreen();
                    }
                    btnFullscreen.classList.add('text-primary');
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                    btnFullscreen.classList.remove('text-primary');
                }
            });

            document.addEventListener('fullscreenchange', function () {
                if (!document.fullscreenElement) {
                    btnFullscreen.classList.remove('text-primary');
                }
                setTimeout(function () { editor.refresh(); }, 50);
            });
        }

        // 4. Preview Mode Toggle (GrapesJS core:preview command)
        if (btnPreview) {
            btnPreview.addEventListener('click', function () {
                if (editor.Commands.isActive('core:preview')) {
                    editor.stopCommand('core:preview');
                    btnPreview.classList.remove('bg-red-50', 'text-primary', 'border-red-200');
                } else {
                    editor.runCommand('core:preview');
                    btnPreview.classList.add('bg-red-50', 'text-primary', 'border-red-200');
                }
            });

            editor.on('stop:core:preview', function () {
                btnPreview.classList.remove('bg-red-50', 'text-primary', 'border-red-200');
            });
        }

        // 5. Device Switcher
        document.querySelectorAll('.device-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.device-btn').forEach(function (b) {
                    b.classList.remove('active');
                });
                this.classList.add('active');

                var device = this.dataset.device;
                document.body.setAttribute('data-current-device', device);
                editor.setDevice(device);
                setTimeout(function () { editor.refresh(); }, 50);
            });
        });

        // 6. Tab switcher in left/right sidebars
        document.querySelectorAll('.sidebar-tab-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var group = this.dataset.tabGroup;
                document.querySelectorAll('.sidebar-tab-btn[data-tab-group="' + group + '"]').forEach(function (b) {
                    b.classList.remove('active');
                });
                this.classList.add('active');

                var targetSelector = this.dataset.tabTarget;
                document.querySelectorAll('.tab-pane[data-tab-group="' + group + '"]').forEach(function (pane) {
                    pane.classList.add('hidden');
                });
                var targetPane = document.querySelector(targetSelector);
                if (targetPane) targetPane.classList.remove('hidden');
            });
        });

        // 7. Undo / Redo
        var undoBtn = document.getElementById('btn-undo');
        if (undoBtn) {
            undoBtn.addEventListener('click', function () {
                editor.UndoManager.undo();
            });
        }
        var redoBtn = document.getElementById('btn-redo');
        if (redoBtn) {
            redoBtn.addEventListener('click', function () {
                editor.UndoManager.redo();
            });
        }

        // 8. Save Draft
        var saveBtn = document.getElementById('btn-save-draft');
        if (saveBtn) {
            saveBtn.addEventListener('click', function () {
                editor.runCommand('core:save-draft');
            });
        }

        // 9. Publish
        var pubBtn = document.getElementById('btn-publish');
        if (pubBtn) {
            pubBtn.addEventListener('click', function () {
                editor.runCommand('core:publish');
            });
        }

        // 10. Dirty State & Unsaved Changes Protection
        var isDirty = false;
        editor.on('component:update component:add component:remove style:update trait:value', function () {
            isDirty = true;
        });
        editor.on('storage:after:store', function () {
            isDirty = false;
        });
        window.addEventListener('beforeunload', function (e) {
            if (isDirty) {
                e.preventDefault();
                e.returnValue = 'Bạn có thay đổi chưa lưu trong Visual Page Builder. Bạn có chắc muốn rời đi?';
                return e.returnValue;
            }
        });
    }

    global.GrapesEditor = {
        init: createEditor
    };
})(window);
