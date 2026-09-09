/**
 * GrapesJS Custom Image Component & Media Reference
 * Stores src, alt, mediaRef in GrapesJS Project Data without dirtying published HTML.
 */
(function (global) {
    'use strict';

    function isPlaceholder(src) {
        if (!src || typeof src !== 'string') return true;
        var trimmed = src.trim();
        return trimmed === ''
            || trimmed.charAt(0) === '<'
            || trimmed.indexOf('data:image/svg+xml') === 0
            || trimmed.indexOf('/<svg') !== -1;
    }

    function resolveImageUrl(src) {
        if (isPlaceholder(src)) return '';
        var trimmed = src.trim();
        if (trimmed.indexOf('http://') === 0 || trimmed.indexOf('https://') === 0 || trimmed.indexOf('data:') === 0) {
            return trimmed;
        }
        var base = (global.location && global.location.origin) ? global.location.origin : '';
        if (trimmed.charAt(0) === '/') {
            return base + trimmed;
        }
        return base + '/' + trimmed;
    }

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
                                var resolved = resolveImageUrl(asset.src);
                                targetComponent.set('src', resolved);
                                targetComponent.addAttributes({
                                    'src': resolved,
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
                        var resolved = resolveImageUrl(input.value);
                        targetComponent.set('src', resolved);
                        targetComponent.addAttributes({ 'src': resolved });
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
        DomComponents.addType('image', {
            extend: 'image',
            isComponent: function (el) {
                if (!el) return false;
                if (el.type === 'image') return true;
                var tag = (el.tagName || el.nodeName || '').toLowerCase();
                return tag === 'img';
            },
            model: {
                defaults: {
                    name: 'Hình ảnh (Image)',
                    tagName: 'img',
                    type: 'image',
                    src: '',
                    void: true,
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
                },

                init: function () {
                    // Ensure src attribute and model property are in lockstep and resolved
                    var attr = this.getAttributes() || {};
                    var rawSrc = '';
                    if (attr.src && !isPlaceholder(attr.src)) {
                        rawSrc = attr.src;
                    } else if (this.get('src') && !isPlaceholder(this.get('src'))) {
                        rawSrc = this.get('src');
                    }

                    if (rawSrc) {
                        var resolved = resolveImageUrl(rawSrc);
                        this.set('src', resolved, { silent: true });
                        this.addAttributes({ src: resolved });
                    } else {
                        this.set('src', '', { silent: true });
                    }

                    this.on('change:src', function () {
                        var currentSrc = this.get('src');
                        if (currentSrc && !isPlaceholder(currentSrc)) {
                            var res = resolveImageUrl(currentSrc);
                            this.addAttributes({ src: res });
                        }
                    });

                    this.on('change:attributes:src', function () {
                        var attrSrc = (this.getAttributes() || {}).src;
                        if (attrSrc && !isPlaceholder(attrSrc)) {
                            var res = resolveImageUrl(attrSrc);
                            if (this.get('src') !== res) {
                                this.set('src', res);
                            }
                        }
                    });

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
            },
            view: {
                init: function () {
                    this.listenTo(this.model, 'change:src', this.updateSrc);
                    this.listenTo(this.model, 'change:attributes:src', this.updateSrc);
                },
                updateSrc: function () {
                    var attr = (this.model.getAttributes && this.model.getAttributes()) || {};
                    var modelSrc = this.model.get('src') || '';
                    var rawSrc = '';
                    if (attr.src && !isPlaceholder(attr.src)) {
                        rawSrc = attr.src;
                    } else if (modelSrc && !isPlaceholder(modelSrc)) {
                        rawSrc = modelSrc;
                    }

                    var src = resolveImageUrl(rawSrc);
                    if (this.el) {
                        if (src) {
                            if (this.el.getAttribute('src') !== src) {
                                this.el.setAttribute('src', src);
                            }
                            if (this.el.src !== src) {
                                this.el.src = src;
                            }
                            this.el.classList.remove('gjs-plh-image');
                        } else {
                            this.el.removeAttribute('src');
                            this.el.classList.add('gjs-plh-image');
                        }
                        this.el.removeAttribute('loading');
                        this.el.removeAttribute('decoding');
                    }
                },
                render: function () {
                    if (this.constructor.__super__ && this.constructor.__super__.render) {
                        this.constructor.__super__.render.apply(this, arguments);
                    }
                    this.updateSrc();
                    return this;
                },
                onRender: function () {
                    this.updateSrc();
                }
            }
        });
    }

    global.GrapesImageComponent = {
        init: initImageComponent
    };
})(window);
