/**
 * Laravel Media Library Adapter for GrapesJS Asset Manager
 * Professional Media Manager with Drag & Drop Upload, Details Sidebar,
 * Image Dimensions, Alt Text Management, and Double-Click Quick Selection.
 */
(function (global) {
    'use strict';

    var activeEditor = null;
    var currentCallback = null;
    var currentTargetComponent = null;
    var currentFolder = 'all';
    var nextCursor = null;
    var isLoading = false;
    var mediaItems = [];
    var config = {};
    var selectedMediaItem = null;
    var currentTab = 'library'; // 'library' | 'upload'

    function initMediaAdapter(editor, builderConfig) {
        activeEditor = editor;
        config = builderConfig || {};

        // Custom GrapesJS Asset Manager opener command
        editor.Commands.add('open-assets', {
            run: function (ed, sender, options) {
                // Normalize arguments: GrapesJS may pass options as sender or options
                var opts = (options && typeof options === 'object' && (options.target || options.select || options.types))
                    ? options
                    : ((sender && typeof sender === 'object' && (sender.target || sender.select || sender.types))
                        ? sender
                        : (options || sender || {}));

                var target = opts.target || ed.getSelected();
                var selectCallback = typeof opts.select === 'function'
                    ? opts.select
                    : (typeof opts.onSelect === 'function' ? opts.onSelect : null);

                // Detect existing image URL for auto-selection in library
                var existingUrl = null;
                if (target) {
                    if (typeof target.get === 'function') {
                        existingUrl = target.get('src') || (target.getAttributes && target.getAttributes().src);
                    }
                    if (!existingUrl && typeof target.getStyle === 'function') {
                        var style = target.getStyle() || {};
                        var bg = style['background-image'] || style.background || '';
                        var m = String(bg).match(/url\(['"]?([^'")]+)['"]?\)/i);
                        if (m) existingUrl = m[1];
                    }
                }

                openMediaModal(function (asset) {
                    // 1. If select callback was provided (StyleManager Property or AssetManager.open)
                    if (selectCallback) {
                        var assetModel = null;
                        try {
                            assetModel = ed.AssetManager.add({
                                type: 'image',
                                src: asset.src,
                                name: asset.name || asset.publicId || '',
                                alt: asset.alt || ''
                            });
                            if (Array.isArray(assetModel)) assetModel = assetModel[0];
                        } catch (e) {
                            console.warn('AssetManager.add notice:', e);
                        }

                        // Ensure compatibility methods on asset object
                        var assetObj = assetModel || { src: asset.src };
                        assetObj.getSrc = function () { return asset.src; };
                        if (!assetObj.get) {
                            assetObj.get = function (prop) { return prop === 'src' ? asset.src : asset[prop]; };
                        }

                        try {
                            selectCallback(assetObj, true);
                        } catch (err) {
                            console.warn('Error executing selectCallback:', err);
                        }
                    }

                    // 2. Direct property update if target is a Style Manager Property
                    if (target && typeof target.set === 'function' && target.get && typeof target.get === 'function' && target.get('property') === 'background-image') {
                        try {
                            target.set('value', 'url("' + asset.src + '")');
                        } catch (e) {}
                    }

                    // 3. Update the component directly
                    var compToUpdate = (target && typeof target.addStyle === 'function') ? target : ed.getSelected();
                    if (compToUpdate && typeof compToUpdate.addStyle === 'function') {
                        var isImg = compToUpdate.get('type') === 'image' || (compToUpdate.get('tagName') || '').toLowerCase() === 'img';
                        if (isImg) {
                            compToUpdate.removeAttributes(['srcset', 'sizes', 'data-src', 'data-srcset', 'data-lazy-src', 'data-lazy-srcset']);
                            compToUpdate.set('src', asset.src);
                            compToUpdate.addAttributes({
                                'src': asset.src,
                                'alt': asset.alt || (compToUpdate.getAttributes() || {}).alt || '',
                                'title': asset.title || (compToUpdate.getAttributes() || {}).title || ''
                            });
                            compToUpdate.set('mediaRef', asset.publicId || asset.id || '');
                        } else {
                            // Section, column, container, slide background image
                            compToUpdate.addStyle({ 'background-image': 'url("' + asset.src + '") !important' });

                            // If this component is an elementor overlay, also update the sibling .swiper-slide-bg or parent
                            var el = compToUpdate.getEl ? compToUpdate.getEl() : null;
                            if (el && el.classList && el.classList.contains('elementor-background-overlay')) {
                                var parent = compToUpdate.parent && compToUpdate.parent();
                                if (parent) {
                                    var bgSibling = parent.components().find(function (c) {
                                        var cEl = c.getEl ? c.getEl() : null;
                                        return cEl && cEl.classList.contains('swiper-slide-bg');
                                    });
                                    if (bgSibling) {
                                        bgSibling.addStyle({ 'background-image': 'url("' + asset.src + '") !important' });
                                    }
                                    parent.addStyle({ 'background-image': 'url("' + asset.src + '") !important' });
                                }
                            }
                        }

                        // Keep Style Manager UI in sync if open
                        try {
                            var sm = ed.StyleManager;
                            if (sm) {
                                var bgProp = sm.getProperty('decorations', 'background-image');
                                if (bgProp) bgProp.setValue('url("' + asset.src + '")');
                            }
                        } catch (e) {}
                    }
                }, target, existingUrl);
            }
        });

        // Register close-assets command
        editor.Commands.add('close-assets', {
            run: function () {
                var modal = document.getElementById('grapes-media-modal');
                if (modal) modal.classList.add('hidden');
            }
        });

        // Add a floating toolbar button on image components for 1-click image replacement
        editor.on('component:selected', function (component) {
            if (!component || (component.get('type') !== 'image' && (component.get('tagName') || '').toLowerCase() !== 'img')) {
                return;
            }
            var toolbar = (component.get('toolbar') || []).slice();
            var hasChangeImage = toolbar.some(function (item) {
                return item.id === 'change-image-asset';
            });
            if (!hasChangeImage) {
                toolbar.unshift({
                    id: 'change-image-asset',
                    attributes: {
                        class: 'fa fa-picture-o',
                        title: 'Thay đổi hình ảnh (Thư viện / Tải ảnh lên)'
                    },
                    command: function (ed) {
                        ed.runCommand('open-assets', { target: component });
                    }
                });
                component.set('toolbar', toolbar);
            }
        });

        // Canvas double-click listener: double-clicking an image tag or background on the canvas opens media modal
        editor.on('canvas:frame:load:body', function () {
            var doc = editor.Canvas.getDocument();
            if (!doc || doc.__mediaImageDblClick) return;
            doc.__mediaImageDblClick = true;

            doc.addEventListener('dblclick', function (e) {
                var targetEl = e.target;
                if (!targetEl) return;

                if (targetEl.tagName === 'IMG') {
                    e.preventDefault();
                    e.stopPropagation();
                    var comp = editor.getSelected();
                    if (!comp || (comp.getEl && comp.getEl() !== targetEl)) {
                        var all = editor.getWrapper().find('*');
                        for (var i = 0; i < all.length; i++) {
                            if (all[i].getEl() === targetEl) {
                                comp = all[i];
                                editor.select(comp);
                                break;
                            }
                        }
                    }
                    editor.runCommand('open-assets', { target: comp });
                    return;
                }

                var bgEl = targetEl.closest('.swiper-slide-bg, [style*="background-image"]');
                if (bgEl) {
                    var sel = editor.getSelected();
                    if (sel) {
                        editor.runCommand('open-assets', { target: sel });
                    }
                }
            }, true);
        });

        // Setup DOM Modal elements
        createMediaModalHtml();
    }

    function createMediaModalHtml() {
        if (document.getElementById('grapes-media-modal')) return;

        var modalHtml = [
            '<style id="grapes-media-modal-styles">',
            '  #grapes-media-modal {',
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
            '    user-select: none !important;',
            '    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;',
            '  }',
            '  #grapes-media-modal.hidden { display: none !important; }',
            '  #grapes-media-modal * { box-sizing: border-box; }',
            '  #grapes-media-modal .media-dialog {',
            '    background: #ffffff !important;',
            '    border-radius: 16px !important;',
            '    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4) !important;',
            '    width: 100% !important;',
            '    max-width: 1100px !important;',
            '    height: 88vh !important;',
            '    max-height: 850px !important;',
            '    min-height: 520px !important;',
            '    display: flex !important;',
            '    flex-direction: column !important;',
            '    overflow: hidden !important;',
            '    border: 1px solid #e2e8f0 !important;',
            '  }',
            '  #grapes-media-modal .media-header {',
            '    padding: 12px 20px !important;',
            '    border-bottom: 1px solid #e2e8f0 !important;',
            '    display: flex !important;',
            '    align-items: center !important;',
            '    justify-content: space-between !important;',
            '    background: #f8fafc !important;',
            '    flex-shrink: 0 !important;',
            '  }',
            '  #grapes-media-modal .media-tabs-nav {',
            '    display: flex !important;',
            '    align-items: center !important;',
            '    gap: 4px !important;',
            '    border: 1px solid #e2e8f0 !important;',
            '    background: #f1f5f9 !important;',
            '    padding: 3px !important;',
            '    border-radius: 10px !important;',
            '  }',
            '  #grapes-media-modal .media-tab-btn {',
            '    padding: 6px 14px !important;',
            '    border-radius: 7px !important;',
            '    font-size: 12px !important;',
            '    font-weight: 600 !important;',
            '    border: none !important;',
            '    cursor: pointer !important;',
            '    display: flex !important;',
            '    align-items: center !important;',
            '    gap: 6px !important;',
            '    transition: all 0.2s ease !important;',
            '    background: transparent;',
            '    color: #64748b;',
            '  }',
            '  #grapes-media-modal .media-tab-btn.active {',
            '    background: #ffffff !important;',
            '    color: #00a0d2 !important;',
            '    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;',
            '    font-weight: 700 !important;',
            '  }',
            '  #grapes-media-modal .media-toolbar {',
            '    padding: 10px 20px !important;',
            '    border-bottom: 1px solid #e2e8f0 !important;',
            '    background: #ffffff !important;',
            '    display: flex !important;',
            '    flex-wrap: wrap !important;',
            '    align-items: center !important;',
            '    justify-content: space-between !important;',
            '    gap: 12px !important;',
            '    flex-shrink: 0 !important;',
            '  }',
            '  #grapes-media-modal .media-body {',
            '    flex: 1 !important;',
            '    display: flex !important;',
            '    overflow: hidden !important;',
            '  }',
            '  #grapes-media-modal .media-grid-scroll {',
            '    flex: 1 !important;',
            '    overflow-y: auto !important;',
            '    padding: 20px !important;',
            '    background: #f8fafc !important;',
            '    position: relative !important;',
            '  }',
            '  #grapes-media-modal .media-items-grid {',
            '    display: grid !important;',
            '    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)) !important;',
            '    gap: 14px !important;',
            '  }',
            '  #grapes-media-modal .media-modal-card {',
            '    background: #ffffff !important;',
            '    border: 1.5px solid #e2e8f0 !important;',
            '    border-radius: 12px !important;',
            '    overflow: hidden !important;',
            '    cursor: pointer !important;',
            '    position: relative !important;',
            '    transition: all 0.2s ease !important;',
            '  }',
            '  #grapes-media-modal .media-modal-card:hover {',
            '    border-color: #00a0d2 !important;',
            '    transform: translateY(-2px) !important;',
            '    box-shadow: 0 6px 16px rgba(0, 160, 210, 0.15) !important;',
            '  }',
            '  #grapes-media-modal .media-modal-card.is-selected {',
            '    border-color: #00a0d2 !important;',
            '    box-shadow: 0 0 0 3px rgba(0, 160, 210, 0.4) !important;',
            '  }',
            '  #grapes-media-modal .media-modal-card.is-selected .media-selected-badge {',
            '    display: flex !important;',
            '  }',
            '  #grapes-media-modal .media-selected-badge {',
            '    display: none;',
            '    position: absolute !important;',
            '    top: 6px !important;',
            '    right: 6px !important;',
            '    width: 24px !important;',
            '    height: 24px !important;',
            '    border-radius: 50% !important;',
            '    background: #00a0d2 !important;',
            '    color: #ffffff !important;',
            '    align-items: center !important;',
            '    justify-content: center !important;',
            '    box-shadow: 0 2px 6px rgba(0,0,0,0.2) !important;',
            '  }',
            '  #grapes-media-modal .media-details-sidebar {',
            '    width: 310px !important;',
            '    border-left: 1px solid #e2e8f0 !important;',
            '    background: #ffffff !important;',
            '    display: flex !important;',
            '    flex-direction: column !important;',
            '    flex-shrink: 0 !important;',
            '    overflow-y: auto !important;',
            '    padding: 16px !important;',
            '  }',
            '  #grapes-media-modal .media-footer {',
            '    padding: 12px 20px !important;',
            '    border-top: 1px solid #e2e8f0 !important;',
            '    background: #ffffff !important;',
            '    display: flex !important;',
            '    align-items: center !important;',
            '    justify-content: space-between !important;',
            '    flex-shrink: 0 !important;',
            '  }',
            '  #grapes-media-modal .media-dropzone {',
            '    width: 100% !important;',
            '    max-width: 600px !important;',
            '    border: 2px dashed #cbd5e1 !important;',
            '    border-radius: 20px !important;',
            '    padding: 48px 24px !important;',
            '    background: #ffffff !important;',
            '    text-align: center !important;',
            '    cursor: pointer !important;',
            '    transition: all 0.2s ease !important;',
            '  }',
            '  #grapes-media-modal .media-dropzone.drag-active {',
            '    border-color: #00a0d2 !important;',
            '    background: rgba(0, 160, 210, 0.06) !important;',
            '    transform: scale(1.01) !important;',
            '  }',
            '</style>',
            '<div id="grapes-media-modal" class="hidden">',
            '  <div class="media-dialog">',
            '',
            '    <!-- Modal Header -->',
            '    <div class="media-header">',
            '      <div style="display: flex; align-items: center; gap: 12px;">',
            '        <div style="width: 36px; height: 36px; border-radius: 10px; background: #e0f2fe; color: #00a0d2; display: flex; align-items: center; justify-content: center; font-size: 20px;">',
            '          <iconify-icon icon="solar:gallery-wide-bold-duotone"></iconify-icon>',
            '        </div>',
            '        <div>',
            '          <h3 style="margin: 0; font-size: 14px; font-weight: 700; color: #1e293b;">Thư viện Media & Tải ảnh lên</h3>',
            '          <p style="margin: 2px 0 0 0; font-size: 11px; color: #64748b;">Quản lý kho ảnh chuyên nghiệp, tải ảnh nhanh và chèn vào trang</p>',
            '        </div>',
            '      </div>',
            '',
            '      <!-- Tabs Navigation -->',
            '      <div class="media-tabs-nav">',
            '        <button type="button" id="tab-btn-library" class="media-tab-btn active">',
            '          <iconify-icon icon="solar:album-bold-duotone" style="font-size: 14px;"></iconify-icon>',
            '          <span>Thư viện ảnh</span>',
            '        </button>',
            '        <button type="button" id="tab-btn-upload" class="media-tab-btn">',
            '          <iconify-icon icon="solar:cloud-upload-bold-duotone" style="font-size: 14px;"></iconify-icon>',
            '          <span>Tải tệp lên</span>',
            '        </button>',
            '      </div>',
            '',
            '      <button type="button" id="btn-close-media-modal" style="background: none; border: none; font-size: 22px; color: #94a3b8; cursor: pointer; padding: 4px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">',
            '        <iconify-icon icon="solar:close-square-linear"></iconify-icon>',
            '      </button>',
            '    </div>',
            '',
            '    <!-- TAB 1: LIBRARY VIEW -->',
            '    <div id="media-tab-pane-library" style="flex: 1; display: flex; flex-direction: column; overflow: hidden;">',
            '      <!-- Toolbar -->',
            '      <div class="media-toolbar">',
            '        <div style="display: flex; align-items: center; gap: 10px;">',
            '          <!-- Folder Filter -->',
            '          <select id="media-folder-select" style="padding: 6px 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 12px; font-weight: 600; color: #334155; outline: none;">',
            '            <option value="all">Tất cả thư mục</option>',
            '            <option value="general">Chung (General)</option>',
            '            <option value="products">Sản phẩm (Products)</option>',
            '            <option value="banners">Banner & Quảng cáo</option>',
            '            <option value="categories">Danh mục</option>',
            '            <option value="posts">Bài viết & Tin tức</option>',
            '          </select>',
            '          <!-- Search Input -->',
            '          <div style="position: relative;">',
            '            <input type="text" id="media-search-input" placeholder="Tìm kiếm theo tên ảnh..." style="padding: 6px 12px 6px 30px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 12px; color: #334155; width: 220px; outline: none;">',
            '            <iconify-icon icon="solar:magnifer-linear" style="position: absolute; left: 9px; top: 8px; color: #94a3b8; font-size: 14px;"></iconify-icon>',
            '          </div>',
            '          <button type="button" id="btn-refresh-media" title="Làm mới danh sách" style="padding: 6px 8px; background: none; border: 1px solid #e2e8f0; border-radius: 8px; color: #64748b; cursor: pointer;">',
            '            <iconify-icon icon="solar:refresh-linear" style="font-size: 14px;"></iconify-icon>',
            '          </button>',
            '        </div>',
            '',
            '        <!-- Quick Upload Button -->',
            '        <div>',
            '          <label for="media-file-input-quick" style="padding: 6px 14px; background: #00a0d2; color: #fff; font-size: 12px; font-weight: 700; border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 6px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">',
            '            <iconify-icon icon="solar:upload-track-2-bold" style="font-size: 15px;"></iconify-icon>',
            '            <span>+ Tải ảnh mới</span>',
            '          </label>',
            '          <input type="file" id="media-file-input-quick" accept="image/jpeg,image/png,image/webp,image/gif" style="display: none;">',
            '        </div>',
            '      </div>',
            '',
            '      <!-- Body: Gallery Grid + Sidebar Details -->',
            '      <div class="media-body">',
            '        <!-- Gallery Grid (Left) -->',
            '        <div id="media-grid-scroll" class="media-grid-scroll">',
            '          <div id="media-items-grid" class="media-items-grid"></div>',
            '          <button type="button" id="media-load-more" style="display:none;margin:16px auto;padding:10px 20px;color:#fff;background:#0284c7;border:0;border-radius:6px;cursor:pointer">' + ((config.labels || {}).loadMore || 'Load more') + '</button>',
            '',
            '          <!-- Empty State -->',
            '          <div id="media-empty-state" style="display: none; text-align: center; padding: 60px 20px; color: #94a3b8;">',
            '            <iconify-icon icon="solar:gallery-remove-line-duotone" style="font-size: 56px; color: #cbd5e1; margin-bottom: 8px;"></iconify-icon>',
            '            <p style="margin: 0; font-weight: 700; font-size: 14px; color: #334155;">Chưa có hình ảnh nào</p>',
            '            <p style="margin: 4px 0 0 0; font-size: 12px; color: #94a3b8;">Kéo thả tệp vào đây hoặc chuyển sang tab "Tải tệp lên" để thêm ảnh mới.</p>',
            '          </div>',
            '',
            '          <!-- Loading Spinner -->',
            '          <div id="media-loading-state" style="display: none; text-align: center; padding: 60px 20px; color: #94a3b8;">',
            '            <div style="display: inline-block; width: 32px; height: 32px; border: 3px solid #00a0d2; border-top-color: transparent; border-radius: 50%; animation: spin 0.8s linear infinite; margin-bottom: 8px;"></div>',
            '            <p style="margin: 0; font-size: 12px; font-weight: 600; color: #475569;">Đang tải thư viện Media...</p>',
            '          </div>',
            '        </div>',
            '',
            '        <!-- Details Sidebar (Right) -->',
            '        <div id="media-details-sidebar" class="media-details-sidebar">',
            '          <div id="media-details-empty" style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 20px; color: #94a3b8;">',
            '            <iconify-icon icon="solar:info-square-line-duotone" style="font-size: 48px; color: #cbd5e1; margin-bottom: 8px;"></iconify-icon>',
            '            <p style="margin: 0; font-size: 12px; font-weight: 700; color: #475569;">Chi tiết hình ảnh</p>',
            '            <p style="margin: 4px 0 0 0; font-size: 11px; color: #94a3b8;">Chọn một ảnh từ thư viện để xem thông tin, chỉnh sửa Alt text hoặc chèn vào trang.</p>',
            '          </div>',
            '',
            '          <div id="media-details-content" style="display: none; flex-direction: column; gap: 12px;">',
            '            <h4 style="margin: 0; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">Chi tiết tệp đính kèm</h4>',
            '            <!-- Preview Image -->',
            '            <div style="width: 100%; aspect-ratio: 16/9; background: #f8fafc; border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; position: relative;">',
            '              <img id="detail-preview-img" src="" alt="" style="max-height: 100%; max-width: 100%; object-fit: contain;">',
            '              <a id="detail-view-full" href="#" target="_blank" style="position: absolute; bottom: 6px; right: 6px; background: rgba(0,0,0,0.65); color: #fff; font-size: 10px; padding: 3px 8px; border-radius: 6px; text-decoration: none; display: flex; align-items: center; gap: 4px;">',
            '                <iconify-icon icon="solar:maximize-square-linear"></iconify-icon> <span>Xem cỡ gốc</span>',
            '              </a>',
            '            </div>',
            '',
            '            <!-- Metadata Info -->',
            '            <div style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; padding: 10px; font-size: 11px; display: flex; flex-direction: column; gap: 6px; color: #475569;">',
            '              <div style="display: flex; justify-content: space-between;"><span style="color: #94a3b8;">Tên tệp:</span><span id="detail-filename" style="font-weight: 600; color: #1e293b; max-width: 170px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">-</span></div>',
            '              <div style="display: flex; justify-content: space-between;"><span style="color: #94a3b8;">Kích thước:</span><span id="detail-dimensions" style="font-weight: 600; color: #1e293b;">-</span></div>',
            '              <div style="display: flex; justify-content: space-between;"><span style="color: #94a3b8;">Dung lượng:</span><span id="detail-filesize" style="font-weight: 600; color: #1e293b;">-</span></div>',
            '              <div style="display: flex; justify-content: space-between;"><span style="color: #94a3b8;">Định dạng:</span><span id="detail-format" style="font-weight: 600; color: #1e293b; text-transform: uppercase;">-</span></div>',
            '              <div style="display: flex; justify-content: space-between;"><span style="color: #94a3b8;">Ngày tải:</span><span id="detail-date" style="font-weight: 600; color: #1e293b;">-</span></div>',
            '            </div>',
            '',
            '            <!-- Alt text field -->',
            '            <div>',
            '              <label for="detail-alt-input" style="display: block; font-size: 11px; font-weight: 700; color: #334155; margin-bottom: 4px;">Văn bản thay thế (Alt Text) <span style="color: #00a0d2;">*SEO</span></label>',
            '              <input type="text" id="detail-alt-input" placeholder="Mô tả hình ảnh cho SEO..." style="width: 100%; padding: 6px 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 11px; color: #334155; outline: none;">',
            '            </div>',
            '',
            '            <!-- Title field -->',
            '            <div>',
            '              <label for="detail-title-input" style="display: block; font-size: 11px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tiêu đề (Title)</label>',
            '              <input type="text" id="detail-title-input" placeholder="Tiêu đề tooltip..." style="width: 100%; padding: 6px 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 11px; color: #334155; outline: none;">',
            '            </div>',
            '',
            '            <!-- Action Buttons in Sidebar -->',
            '            <div style="padding-top: 8px; border-top: 1px solid #f1f5f9; display: flex; flex-direction: column; gap: 8px;">',
            '              <button type="button" id="btn-detail-insert" style="width: 100%; padding: 8px 12px; background: #00a0d2; color: #fff; font-size: 12px; font-weight: 700; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;">',
            '                <iconify-icon icon="solar:check-read-linear" style="font-size: 15px;"></iconify-icon>',
            '                <span>Chèn ảnh này vào trang</span>',
            '              </button>',
            '              <div style="display: flex; align-items: center; gap: 8px;">',
            '                <button type="button" id="btn-detail-copy-url" style="flex: 1; padding: 6px 8px; background: #f1f5f9; color: #334155; font-size: 11px; font-weight: 600; border: 1px solid #e2e8f0; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 4px;">',
            '                  <iconify-icon icon="solar:copy-linear"></iconify-icon> <span>Sao chép link</span>',
            '                </button>',
            '                <button type="button" id="btn-detail-delete" style="padding: 6px 10px; background: #fee2e2; color: #dc2626; font-size: 11px; font-weight: 600; border: none; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 4px;">',
            '                  <iconify-icon icon="solar:trash-bin-trash-linear"></iconify-icon> <span>Xóa</span>',
            '                </button>',
            '              </div>',
            '            </div>',
            '          </div>',
            '        </div>',
            '      </div>',
            '    </div>',
            '',
            '    <!-- TAB 2: UPLOAD VIEW (Drag & Drop Zone) -->',
            '    <div id="media-tab-pane-upload" style="display: none; flex: 1; flex-direction: column; padding: 32px; background: #f8fafc; align-items: center; justify-content: center; overflow-y: auto;">',
            '      <div id="media-main-dropzone" class="media-dropzone">',
            '        <div style="width: 72px; height: 72px; border-radius: 20px; background: #e0f2fe; color: #00a0d2; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto; font-size: 36px;">',
            '          <iconify-icon icon="solar:cloud-upload-bold-duotone"></iconify-icon>',
            '        </div>',
            '        <h4 style="margin: 0 0 6px 0; font-size: 16px; font-weight: 700; color: #1e293b;">Kéo và thả tệp ảnh vào đây để tải lên</h4>',
            '        <p style="margin: 0 0 20px 0; font-size: 12px; color: #94a3b8;">hoặc nhấp chuột vào khung để chọn ảnh từ máy tính của bạn</p>',
            '',
            '        <label for="media-file-input-full" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 24px; background: #00a0d2; color: #fff; font-size: 13px; font-weight: 700; border-radius: 10px; cursor: pointer; box-shadow: 0 2px 6px rgba(0,160,210,0.3);">',
            '          <iconify-icon icon="solar:folder-open-bold" style="font-size: 16px;"></iconify-icon>',
            '          <span>Chọn tệp ảnh từ máy tính</span>',
            '        </label>',
            '        <input type="file" id="media-file-input-full" accept="image/jpeg,image/png,image/webp,image/gif" style="display: none;">',
            '',
            '        <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f5f9; font-size: 11px; color: #94a3b8; display: flex; align-items: center; justify-content: center; gap: 16px;">',
            '          <span>✓ Định dạng: JPG, PNG, WebP, GIF</span>',
            '          <span>✓ Dung lượng tối đa: 10MB/ảnh</span>',
            '          <span>✓ Tự động tối ưu hóa</span>',
            '        </div>',
            '      </div>',
            '',
            '      <!-- Upload Progress Bar (Visible during upload) -->',
            '      <div id="media-upload-progress-wrap" style="display: none; width: 100%; max-width: 450px; margin-top: 20px; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">',
            '        <div style="display: flex; align-items: center; justify-content: space-between; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 8px;">',
            '          <span id="upload-progress-filename" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 250px;">Đang tải lên...</span>',
            '          <span id="upload-progress-percent" style="color: #00a0d2;">Đang xử lý...</span>',
            '        </div>',
            '        <div style="width: 100%; background: #f1f5f9; height: 8px; border-radius: 9999px; overflow: hidden;">',
            '          <div id="upload-progress-bar" style="background: #00a0d2; height: 100%; border-radius: 9999px; transition: width 0.3s ease; width: 33%;"></div>',
            '        </div>',
            '      </div>',
            '    </div>',
            '',
            '    <!-- Modal Footer -->',
            '    <div class="media-footer">',
            '      <div style="font-size: 12px; color: #64748b; font-weight: 500;" id="media-selected-info">Chưa chọn hình ảnh nào</div>',
            '      <div style="display: flex; align-items: center; gap: 10px;">',
            '        <button type="button" id="btn-cancel-media" style="padding: 8px 16px; border: 1px solid #e2e8f0; background: #fff; border-radius: 8px; font-size: 12px; font-weight: 700; color: #334155; cursor: pointer;">Đóng</button>',
            '        <button type="button" id="btn-confirm-media" style="padding: 8px 22px; background: #00a0d2; color: #fff; font-size: 12px; font-weight: 700; border: none; border-radius: 8px; cursor: not-allowed; opacity: 0.5;" disabled>✓ Chọn ảnh này</button>',
            '      </div>',
            '    </div>',
            '',
            '  </div>',
            '</div>'
        ].join('\n');

        document.body.insertAdjacentHTML('beforeend', modalHtml);
        bindModalEvents();
    }

    function switchTab(tab) {
        currentTab = tab;
        var tabBtnLib = document.getElementById('tab-btn-library');
        var tabBtnUpload = document.getElementById('tab-btn-upload');
        var paneLib = document.getElementById('media-tab-pane-library');
        var paneUpload = document.getElementById('media-tab-pane-upload');

        if (tab === 'library') {
            if (tabBtnLib) tabBtnLib.classList.add('active');
            if (tabBtnUpload) tabBtnUpload.classList.remove('active');
            if (paneLib) paneLib.style.display = 'flex';
            if (paneUpload) paneUpload.style.display = 'none';
        } else {
            if (tabBtnUpload) tabBtnUpload.classList.add('active');
            if (tabBtnLib) tabBtnLib.classList.remove('active');
            if (paneUpload) paneUpload.style.display = 'flex';
            if (paneLib) paneLib.style.display = 'none';
        }
    }

    function closeModal() {
        var modal = document.getElementById('grapes-media-modal');
        if (modal) modal.classList.add('hidden');
        selectedMediaItem = null;
        currentCallback = null;
        currentTargetComponent = null;
        resetDetailsSidebar();
    }

    function bindModalEvents() {
        var modal = document.getElementById('grapes-media-modal');
        var btnClose = document.getElementById('btn-close-media-modal');
        var btnCancel = document.getElementById('btn-cancel-media');
        var btnConfirm = document.getElementById('btn-confirm-media');
        var btnDetailInsert = document.getElementById('btn-detail-insert');
        var tabBtnLib = document.getElementById('tab-btn-library');
        var tabBtnUpload = document.getElementById('tab-btn-upload');
        var folderSelect = document.getElementById('media-folder-select');
        var searchInput = document.getElementById('media-search-input');
        var btnRefresh = document.getElementById('btn-refresh-media');
        var loadMore = document.getElementById('media-load-more');
        if (loadMore) loadMore.addEventListener('click', function () { if (nextCursor && !isLoading) loadMediaResources(false); });
        var fileInputQuick = document.getElementById('media-file-input-quick');
        var fileInputFull = document.getElementById('media-file-input-full');
        var mainDropzone = document.getElementById('media-main-dropzone');
        var altInput = document.getElementById('detail-alt-input');
        var titleInput = document.getElementById('detail-title-input');
        var btnCopyUrl = document.getElementById('btn-detail-copy-url');
        var btnDelete = document.getElementById('btn-detail-delete');

        if (btnClose) btnClose.addEventListener('click', closeModal);
        if (btnCancel) btnCancel.addEventListener('click', closeModal);

        if (tabBtnLib) tabBtnLib.addEventListener('click', function () { switchTab('library'); });
        if (tabBtnUpload) tabBtnUpload.addEventListener('click', function () { switchTab('upload'); });

        if (folderSelect) {
            folderSelect.addEventListener('change', function () {
                currentFolder = this.value;
                loadMediaResources(true);
            });
        }

        if (btnRefresh) {
            btnRefresh.addEventListener('click', function () {
                loadMediaResources(true);
            });
        }

        var searchDebounceTimer = null;
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                var query = this.value.toLowerCase().trim();
                clearTimeout(searchDebounceTimer);
                searchDebounceTimer = setTimeout(function () {
                    filterMediaItems(query);
                }, 200);
            });
        }

        if (fileInputQuick) {
            fileInputQuick.addEventListener('change', function () {
                if (this.files && this.files.length) {
                    uploadMediaFiles(this.files);
                    this.value = '';
                }
            });
        }

        if (fileInputFull) {
            fileInputFull.addEventListener('change', function () {
                if (this.files && this.files.length) {
                    uploadMediaFiles(this.files);
                    this.value = '';
                }
            });
        }

        // Drag and drop onto main dropzone
        if (mainDropzone) {
            mainDropzone.addEventListener('dragover', function (e) {
                e.preventDefault();
                mainDropzone.classList.add('drag-active');
            });
            mainDropzone.addEventListener('dragleave', function (e) {
                e.preventDefault();
                mainDropzone.classList.remove('drag-active');
            });
            mainDropzone.addEventListener('drop', function (e) {
                e.preventDefault();
                e.stopPropagation();
                mainDropzone.classList.remove('drag-active');
                if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
                    uploadMediaFiles(e.dataTransfer.files);
                }
            });
            mainDropzone.addEventListener('click', function (e) {
                if (e.target.tagName !== 'LABEL' && e.target.tagName !== 'INPUT') {
                    fileInputFull.click();
                }
            });
        }

        // Global Drag and Drop anywhere on modal
        if (modal) {
            modal.addEventListener('dragover', function (e) {
                e.preventDefault();
            });
            modal.addEventListener('drop', function (e) {
                e.preventDefault();
                if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
                    uploadMediaFiles(e.dataTransfer.files);
                }
            });
        }

        // Alt and Title inputs sync with selectedMediaItem
        if (altInput) {
            altInput.addEventListener('input', function () {
                if (selectedMediaItem) selectedMediaItem.alt = this.value;
            });
        }
        if (titleInput) {
            titleInput.addEventListener('input', function () {
                if (selectedMediaItem) selectedMediaItem.title = this.value;
            });
        }

        // Copy URL button
        if (btnCopyUrl) {
            btnCopyUrl.addEventListener('click', function () {
                if (!selectedMediaItem || !selectedMediaItem.src) return;
                navigator.clipboard.writeText(selectedMediaItem.src).then(function () {
                    toast('success', 'Đã sao chép liên kết ảnh vào bộ nhớ tạm!');
                }).catch(function () {
                    window.prompt('Sao chép liên kết ảnh:', selectedMediaItem.src);
                });
            });
        }

        // Delete button
        if (btnDelete) {
            btnDelete.addEventListener('click', deleteSelectedMediaItem);
        }

        // Confirm Selection Buttons (Footer button & Sidebar button)
        if (btnConfirm) btnConfirm.addEventListener('click', confirmSelection);
        if (btnDetailInsert) btnDetailInsert.addEventListener('click', confirmSelection);
    }

    function confirmSelection() {
        if (!selectedMediaItem) return;

        if (typeof currentCallback === 'function') {
            currentCallback(selectedMediaItem);
        } else if (activeEditor) {
            // Fallback: apply to target or selected component
            var comp = currentTargetComponent || activeEditor.getSelected();
            if (comp && typeof comp.addStyle === 'function') {
                var isImg = comp.get('type') === 'image' || (comp.get('tagName') || '').toLowerCase() === 'img';
                if (isImg) {
                    comp.removeAttributes(['srcset', 'sizes', 'data-src', 'data-srcset', 'data-lazy-src', 'data-lazy-srcset']);
                            comp.set('src', selectedMediaItem.src);
                    comp.addAttributes({
                        'src': selectedMediaItem.src,
                        'alt': selectedMediaItem.alt || ''
                    });
                } else {
                    comp.addStyle({ 'background-image': 'url("' + selectedMediaItem.src + '") !important' });
                }
            }
        }

        closeModal();
        toast('success', 'Đã chèn hình ảnh thành công!');
    }

    async function loadMediaResources(reset, selectTargetUrl) {
        if (isLoading && !reset) return;
        isLoading = true;
        if (reset) {
            mediaItems = [];
            nextCursor = null;
            selectedMediaItem = null;
            resetDetailsSidebar();
            updateConfirmButton();
        }

        var loadingEl = document.getElementById('media-loading-state');
        var emptyEl = document.getElementById('media-empty-state');
        var gridEl = document.getElementById('media-items-grid');

        if (reset && gridEl) gridEl.innerHTML = '';
        if (loadingEl) loadingEl.style.display = 'block';
        if (emptyEl) emptyEl.style.display = 'none';

        try {
            var url = config.mediaResourcesUrl || '/vi/admin/media/resources';
            var params = new URLSearchParams();
            if (currentFolder && currentFolder !== 'all') params.append('folder', currentFolder);
            if (nextCursor) params.append('cursor', nextCursor);

            var fullUrl = url + (url.indexOf('?') === -1 ? '?' : '&') + params.toString();
            var response = await fetch(fullUrl, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) throw new Error('Media request failed');
            var data = await response.json();
            var resources = data.resources || [];
            nextCursor = data.next_cursor || null;

            if (reset) mediaItems = resources;
            else mediaItems = mediaItems.concat(resources);

            renderMediaGrid(mediaItems, selectTargetUrl || (!reset && selectedMediaItem ? selectedMediaItem.src : null));
            var loadMore = document.getElementById('media-load-more');
            if (loadMore) loadMore.style.display = nextCursor ? 'block' : 'none';

            if (mediaItems.length === 0 && emptyEl) {
                emptyEl.style.display = 'block';
            }
        } catch (err) {
            console.error('Error loading media resources:', err);
            toast('error', 'Không thể nạp danh sách hình ảnh từ Media Library.');
        } finally {
            isLoading = false;
            if (loadingEl) loadingEl.style.display = 'none';
        }
    }

    function renderMediaGrid(items, autoSelectUrl) {
        var gridEl = document.getElementById('media-items-grid');
        if (!gridEl) return;
        gridEl.innerHTML = '';

        items.forEach(function (item) {
            var card = document.createElement('div');
            card.className = 'media-modal-card';
            card.dataset.src = item.secure_url;
            card.dataset.publicId = item.public_id || '';

            var filename = (item.public_id || item.secure_url).split('/').pop();
            var sizeKb = item.bytes ? (item.bytes > 1024 * 1024 ? (item.bytes / (1024 * 1024)).toFixed(1) + ' MB' : Math.round(item.bytes / 1024) + ' KB') : '';
            var dimensions = (item.width && item.height) ? item.width + ' × ' + item.height : '';

            var isPreselected = autoSelectUrl && (autoSelectUrl === item.secure_url || autoSelectUrl.indexOf(filename) !== -1);
            if (isPreselected) {
                card.classList.add('is-selected');
                selectItem(item, card);
            }

            card.innerHTML = [
                '<div style="width: 100%; aspect-ratio: 1/1; background: #f1f5f9; overflow: hidden; display: flex; align-items: center; justify-content: center; position: relative;">',
                '  <img src="' + item.secure_url + '" alt="' + filename + '" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">',
                '  <div class="media-selected-badge" style="' + (isPreselected ? 'display: flex;' : '') + '">',
                '    <iconify-icon icon="solar:check-circle-bold" style="font-size: 16px;"></iconify-icon>',
                '  </div>',
                '</div>',
                '<div style="padding: 8px 10px; background: #fff;">',
                '  <div style="font-size: 11px; font-weight: 700; color: #1e293b; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="' + filename + '">' + filename + '</div>',
                '  <div style="font-size: 10px; color: #94a3b8; margin-top: 2px; display: flex; align-items: center; justify-content: space-between;">',
                '    <span>' + sizeKb + '</span>',
                '    <span>' + dimensions + '</span>',
                '  </div>',
                '</div>'
            ].join('\n');

            // Single click: select item & update details sidebar
            card.addEventListener('click', function () {
                selectItem(item, card);
            });

            // Double click: immediately insert image into page
            card.addEventListener('dblclick', function (e) {
                e.preventDefault();
                selectItem(item, card);
                confirmSelection();
            });

            gridEl.appendChild(card);
        });
    }

    function selectItem(item, cardEl) {
        document.querySelectorAll('.media-modal-card').forEach(function (c) {
            c.classList.remove('is-selected');
            var badge = c.querySelector('.media-selected-badge');
            if (badge) badge.style.display = 'none';
        });

        if (cardEl) {
            cardEl.classList.add('is-selected');
            var badge = cardEl.querySelector('.media-selected-badge');
            if (badge) badge.style.display = 'flex';
        }

        var filename = (item.public_id || item.secure_url).split('/').pop();
        var rawName = filename.replace(/\.[^/.]+$/, '').replace(/[-_]+/g, ' ');

        selectedMediaItem = {
            src: item.secure_url,
            publicId: item.public_id || '',
            id: item.public_id || '',
            name: filename,
            alt: rawName,
            title: rawName,
            bytes: item.bytes,
            format: item.format,
            width: item.width,
            height: item.height,
            created_at: item.created_at
        };

        updateDetailsSidebar(selectedMediaItem);
        updateConfirmButton();
    }

    function updateDetailsSidebar(item) {
        var emptyEl = document.getElementById('media-details-empty');
        var contentEl = document.getElementById('media-details-content');
        var imgEl = document.getElementById('detail-preview-img');
        var viewFullEl = document.getElementById('detail-view-full');
        var filenameEl = document.getElementById('detail-filename');
        var dimensionsEl = document.getElementById('detail-dimensions');
        var filesizeEl = document.getElementById('detail-filesize');
        var formatEl = document.getElementById('detail-format');
        var dateEl = document.getElementById('detail-date');
        var altInput = document.getElementById('detail-alt-input');
        var titleInput = document.getElementById('detail-title-input');

        if (!item) {
            resetDetailsSidebar();
            return;
        }

        if (emptyEl) emptyEl.style.display = 'none';
        if (contentEl) contentEl.style.display = 'flex';

        if (imgEl) imgEl.src = item.src;
        if (viewFullEl) viewFullEl.href = item.src;

        var filename = item.src.split('/').pop();
        if (filenameEl) {
            filenameEl.textContent = filename;
            filenameEl.title = filename;
        }

        if (dimensionsEl) {
            dimensionsEl.textContent = (item.width && item.height) ? (item.width + ' × ' + item.height + ' px') : 'Tự động (Vector/Auto)';
        }
        if (filesizeEl) {
            filesizeEl.textContent = item.bytes ? (item.bytes > 1024 * 1024 ? (item.bytes / (1024 * 1024)).toFixed(1) + ' MB' : Math.round(item.bytes / 1024) + ' KB') : 'Không xác định';
        }
        if (formatEl) {
            formatEl.textContent = (item.format || filename.split('.').pop() || 'IMG').toUpperCase();
        }

        if (dateEl) {
            if (item.created_at) {
                try {
                    var d = new Date(item.created_at);
                    dateEl.textContent = d.toLocaleDateString('vi-VN') + ' ' + d.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
                } catch (e) {
                    dateEl.textContent = item.created_at;
                }
            } else {
                dateEl.textContent = 'Hôm nay';
            }
        }

        if (altInput) altInput.value = item.alt || '';
        if (titleInput) titleInput.value = item.title || '';
    }

    function resetDetailsSidebar() {
        var emptyEl = document.getElementById('media-details-empty');
        var contentEl = document.getElementById('media-details-content');
        if (emptyEl) emptyEl.style.display = 'flex';
        if (contentEl) contentEl.style.display = 'none';
    }

    function updateConfirmButton() {
        var btnConfirm = document.getElementById('btn-confirm-media');
        var selectedInfo = document.getElementById('media-selected-info');
        if (!btnConfirm || !selectedInfo) return;

        if (selectedMediaItem) {
            btnConfirm.disabled = false;
            btnConfirm.style.opacity = '1';
            btnConfirm.style.cursor = 'pointer';
            var filename = selectedMediaItem.src.split('/').pop();
            var sizeStr = selectedMediaItem.bytes ? ' (' + (selectedMediaItem.bytes > 1024 * 1024 ? (selectedMediaItem.bytes / (1024 * 1024)).toFixed(1) + ' MB' : Math.round(selectedMediaItem.bytes / 1024) + ' KB') + ')' : '';
            selectedInfo.innerHTML = '<span style="color: #1e293b; font-weight: 700;">Đã chọn:</span> <span style="color: #00a0d2; font-weight: 600;">' + filename + '</span>' + sizeStr;
        } else {
            btnConfirm.disabled = true;
            btnConfirm.style.opacity = '0.5';
            btnConfirm.style.cursor = 'not-allowed';
            selectedInfo.textContent = 'Chưa chọn hình ảnh nào';
        }
    }

    function filterMediaItems(query) {
        if (!query) {
            renderMediaGrid(mediaItems);
            return;
        }
        var filtered = mediaItems.filter(function (item) {
            var name = (item.public_id || item.secure_url).toLowerCase();
            return name.indexOf(query) !== -1;
        });
        renderMediaGrid(filtered);
    }

    async function uploadMediaFiles(fileList) {
        if (!fileList || !fileList.length) return;

        var progressWrap = document.getElementById('media-upload-progress-wrap');
        var filenameEl = document.getElementById('upload-progress-filename');
        var percentEl = document.getElementById('upload-progress-percent');
        var progressBar = document.getElementById('upload-progress-bar');

        if (progressWrap) progressWrap.style.display = 'block';

        var lastUploadedUrl = null;
        var uploadFailures = 0;
        var folder = currentFolder === 'all' ? 'general' : currentFolder;
        var uploadUrl = config.mediaUploadUrl || '/vi/admin/media/upload';

        for (var i = 0; i < fileList.length; i++) {
            var file = fileList[i];
            if (filenameEl) filenameEl.textContent = file.name + ' (' + (i + 1) + '/' + fileList.length + ')';
            if (percentEl) percentEl.textContent = 'Đang tải lên...';
            if (progressBar) progressBar.style.width = Math.round(((i + 0.5) / fileList.length) * 100) + '%';

            var formData = new FormData();
            formData.append('file', file);
            formData.append('folder', folder);
            formData.append('image_only', '1');

            try {
                var response = await fetch(uploadUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': config.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });

                var res = await response.json();
                if (!response.ok || !res.success) {
                    throw new Error(res.message || ((config.labels || {}).uploadFailed || 'Image upload failed') + ': ' + file.name);
                }

                lastUploadedUrl = res.url;
            } catch (err) {
                uploadFailures++;
                console.error('Upload error:', err);
                toast('error', err.message || 'Không thể tải ảnh lên.');
            }
        }

        if (progressBar) progressBar.style.width = '100%';
        if (percentEl) percentEl.textContent = uploadFailures ? ((config.labels || {}).uploadFailed || 'Image upload failed') : 'Hoàn tất!';

        setTimeout(function () {
            if (progressWrap) progressWrap.style.display = 'none';
            // Switch back to library view and select the newly uploaded image
            if (lastUploadedUrl) {
                switchTab('library');
                loadMediaResources(true, lastUploadedUrl);
            }
            if (!uploadFailures) toast('success', 'Đã tải ảnh lên thành công!');
        }, 500);
    }

    async function deleteSelectedMediaItem() {
        if (!selectedMediaItem) return;
        var publicId = selectedMediaItem.publicId || selectedMediaItem.id;
        if (!publicId) return;

        if (global.Swal) {
            var confirmed = await global.Swal.fire({
                title: 'Xác nhận xóa ảnh?',
                text: 'Hành động này sẽ xóa vĩnh viễn tệp ảnh khỏi thư viện.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e32326',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Xóa vĩnh viễn',
                cancelButtonText: 'Hủy'
            });
            if (!confirmed.isConfirmed) return;
        } else {
            if (!window.confirm('Bạn có chắc muốn xóa vĩnh viễn ảnh này?')) return;
        }

        var uploadUrl = config.mediaUploadUrl || '/vi/admin/media/upload';
        var deleteUrl = uploadUrl.replace(/\/upload$/, '/delete');

        try {
            var response = await fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': config.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ public_id: publicId })
            });

            var res = await response.json();
            if (!response.ok || !res.success) {
                throw new Error(res.message || 'Không thể xóa tệp tin.');
            }

            toast('success', 'Đã xóa ảnh thành công.');
            selectedMediaItem = null;
            resetDetailsSidebar();
            updateConfirmButton();
            loadMediaResources(true);
        } catch (err) {
            console.error('Delete error:', err);
            toast('error', err.message || 'Lỗi khi xóa tệp tin.');
        }
    }

    function openMediaModal(callback, targetComponent, autoSelectUrl) {
        currentCallback = callback;
        currentTargetComponent = targetComponent;
        var modal = document.getElementById('grapes-media-modal');
        if (!modal) createMediaModalHtml();
        modal = document.getElementById('grapes-media-modal');
        modal.classList.remove('hidden');

        switchTab('library');
        loadMediaResources(true, autoSelectUrl);
    }

    function toast(icon, title) {
        if (global.Swal) {
            global.Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: title,
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });
        } else {
            console.log('[' + icon + '] ' + title);
        }
    }

    global.GrapesMediaAdapter = {
        init: initMediaAdapter,
        open: openMediaModal
    };
})(window);
