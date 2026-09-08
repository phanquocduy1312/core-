/**
 * GrapesJS Custom Image Component & Media Reference
 * Stores src, alt, mediaRef in GrapesJS Project Data without dirtying published HTML.
 */
(function (global) {
    'use strict';

    function initImageComponent(editor) {
        var DomComponents = editor.DomComponents;

        // Custom Media Picker Trait
        editor.TraitManager.addType('media-picker', {
            createInput: function ({ trait }) {
                var el = document.createElement('div');
                el.className = 'flex items-center gap-1.5 w-full';

                var input = document.createElement('input');
                input.type = 'text';
                input.className = 'gjs-field flex-1 text-xs px-2 py-1 bg-slate-50 border border-slate-200 rounded-lg';
                input.value = trait.getTargetValue() || '';

                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'px-2 py-1 bg-primary text-white text-xs font-bold rounded-lg hover:bg-primary/90 transition-all shrink-0 flex items-center gap-1';
                btn.innerHTML = '<iconify-icon icon="solar:gallery-linear"></iconify-icon><span>Chọn</span>';

                btn.addEventListener('click', function () {
                    if (global.GrapesMediaAdapter) {
                        var targetComponent = editor.getSelected();
                        global.GrapesMediaAdapter.open(function (asset) {
                            input.value = asset.src;
                            if (targetComponent) {
                                targetComponent.removeAttributes(['srcset', 'sizes', 'data-src', 'data-srcset', 'data-lazy-src', 'data-lazy-srcset']);
                                targetComponent.set('src', asset.src);
                                targetComponent.addAttributes({
                                    'src': asset.src,
                                    'alt': targetComponent.getAttributes().alt || asset.alt || ''
                                });
                                targetComponent.set('mediaRef', asset.publicId || asset.id || '');
                            }
                        }, targetComponent);
                    }
                });

                input.addEventListener('change', function () {
                    var targetComponent = editor.getSelected();
                    if (targetComponent) {
                        targetComponent.removeAttributes(['srcset', 'sizes', 'data-src', 'data-srcset', 'data-lazy-src', 'data-lazy-srcset']);
                                targetComponent.set('src', input.value);
                        targetComponent.addAttributes({ 'src': input.value });
                    }
                });

                el.appendChild(input);
                el.appendChild(btn);
                return el;
            },
            onUpdate: function ({ elInput, trait }) {
                var input = elInput.querySelector('input');
                if (input) {
                    input.value = trait.getTargetValue() || '';
                }
            }
        });

        // Extend standard Image component
        var imageType = DomComponents.getType('image');
        DomComponents.addType('image', {
            model: {
                defaults: Object.assign({}, imageType ? imageType.model.prototype.defaults : {}, {
                    name: 'Hình ảnh (Image)',
                    droppable: false,
                    resizable: true,
                    traits: [
                        {
                            type: 'media-picker',
                            name: 'src',
                            label: 'Hình ảnh (URL)',
                        },
                        {
                            type: 'text',
                            name: 'mediaRef',
                            label: 'Media Ref (Mã tham chiếu)',
                            placeholder: 'general/photo-name',
                            changeProp: 1
                        },
                        {
                            type: 'text',
                            name: 'alt',
                            label: 'Văn bản thay thế (Alt)',
                            placeholder: 'Mô tả hình ảnh...',
                        },
                        {
                            type: 'text',
                            name: 'title',
                            label: 'Tiêu đề hiển thị (Title)',
                            placeholder: 'Tooltip khi hover chuột...',
                        },
                        {
                            type: 'select',
                            name: 'style-object-fit',
                            label: 'Hiển thị (Object Fit)',
                            options: [
                                { id: 'cover', label: 'Cắt vừa khung (Cover)' },
                                { id: 'contain', label: 'Thu nhỏ vừa vặn (Contain)' },
                                { id: 'fill', label: 'Kéo giãn (Fill)' },
                                { id: 'none', label: 'Kích thước gốc (None)' },
                                { id: 'scale-down', label: 'Tự động thu nhỏ (Scale Down)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-object-position',
                            label: 'Vị trí trọng tâm (Position)',
                            options: [
                                { id: 'center', label: 'Căn giữa (Center)' },
                                { id: 'top', label: 'Căn trên (Top)' },
                                { id: 'bottom', label: 'Căn dưới (Bottom)' },
                                { id: 'left', label: 'Căn trái (Left)' },
                                { id: 'right', label: 'Căn phải (Right)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'loading',
                            label: 'Tải chậm (Lazy Load)',
                            options: [
                                { id: 'lazy', label: 'Tải khi cuộn tới (Lazy)' },
                                { id: 'eager', label: 'Tải ngay (Eager)' }
                            ]
                        }
                    ]
                }),

                init: function () {
                    this.on('change:style-object-fit', this.handleObjectFitChange);
                    this.on('change:style-object-position', this.handleObjectPositionChange);
                },

                handleObjectFitChange: function () {
                    var fit = this.get('style-object-fit');
                    if (fit) {
                        this.addStyle({ 'object-fit': fit });
                    }
                },

                handleObjectPositionChange: function () {
                    var pos = this.get('style-object-position');
                    if (pos) {
                        this.addStyle({ 'object-position': pos });
                    }
                }
            }
        });
    }

    global.GrapesImageComponent = {
        init: initImageComponent
    };
})(window);
