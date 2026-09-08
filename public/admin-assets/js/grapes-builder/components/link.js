/**
 * GrapesJS Link Component: builder-link & builder-link-box
 * Semantic <a> with link traits, targets, colors, and inline styling
 */
(function (global) {
    'use strict';

    function initLinkComponent(editor) {
        var DomComponents = editor.DomComponents;

        // 1. Single Text Link Component (builder-link)
        DomComponents.addType('builder-link', {
            extend: 'link',
            isComponent: function () { return false; },
            model: {
                defaults: {
                    name: 'Thẻ liên kết (Link)',
                    tagName: 'a',
                    droppable: false,
                    editable: true,
                    content: 'Văn bản liên kết (Link) →',
                    attributes: {
                        href: '#',
                        target: '_self',
                        title: ''
                    },
                    classes: ['builder-link'],
                    style: {
                        'color': '#00a0d2',
                        'text-decoration': 'underline',
                        'font-weight': '600',
                        'font-size': '15px',
                        'cursor': 'pointer',
                        'display': 'inline-block',
                        'transition': 'all 0.2s ease'
                    },
                    traits: [
                        {
                            type: 'text',
                            name: 'href',
                            label: 'Đường dẫn (URL / Link)',
                            placeholder: 'https://... hoặc #lien-he',
                            default: '#'
                        },
                        {
                            type: 'select',
                            name: 'target',
                            label: 'Mở tab mới',
                            options: [
                                { id: '_self', label: 'Cùng trang (_self)' },
                                { id: '_blank', label: 'Tab mới (_blank)' }
                            ],
                            default: '_self'
                        },
                        {
                            type: 'text',
                            name: 'title',
                            label: 'Tiêu đề tooltip (Title)',
                            placeholder: 'Gợi ý khi rê chuột...'
                        },
                        {
                            type: 'select',
                            name: 'rel',
                            label: 'Thuộc tính Rel (SEO)',
                            options: [
                                { id: '', label: 'Mặc định' },
                                { id: 'noopener noreferrer', label: 'noopener noreferrer' },
                                { id: 'nofollow', label: 'nofollow' },
                                { id: 'sponsored', label: 'sponsored' }
                            ]
                        },
                        {
                            type: 'select',
                            name: 'link-color',
                            label: 'Màu liên kết',
                            options: [
                                { id: '#00a0d2', label: 'Xanh LuxLight (#00a0d2)' },
                                { id: '#c5a880', label: 'Vàng đồng Luxury (#c5a880)' },
                                { id: '#e32326', label: 'Đỏ nổi bật (#e32326)' },
                                { id: '#1e293b', label: 'Đen sang trọng (#1e293b)' },
                                { id: '#64748b', label: 'Xám thanh lịch (#64748b)' }
                            ],
                            default: '#00a0d2',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'link-underline',
                            label: 'Gạch chân',
                            options: [
                                { id: 'underline', label: 'Có gạch chân (Underline)' },
                                { id: 'none', label: 'Không gạch chân (None)' }
                            ],
                            default: 'underline',
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:link-color', this.handleColorChange);
                    this.on('change:link-underline', this.handleUnderlineChange);
                },

                handleColorChange: function () {
                    var color = this.get('link-color');
                    if (color) this.addStyle({ 'color': color });
                },

                handleUnderlineChange: function () {
                    var underline = this.get('link-underline');
                    if (underline) this.addStyle({ 'text-decoration': underline });
                }
            }
        });

        // 2. Clickable Box / Card Link Container (builder-link-box)
        DomComponents.addType('builder-link-box', {
            model: {
                defaults: {
                    name: 'Khối liên kết (Link Box)',
                    tagName: 'a',
                    droppable: true,
                    editable: false,
                    attributes: {
                        href: '#',
                        target: '_self',
                        title: ''
                    },
                    classes: ['builder-link-box'],
                    style: {
                        'display': 'block',
                        'text-decoration': 'none',
                        'color': 'inherit',
                        'padding': '16px 20px',
                        'border-radius': '10px',
                        'background': '#f8fafc',
                        'border': '1px solid #e2e8f0',
                        'cursor': 'pointer',
                        'transition': 'all 0.2s ease',
                        'box-sizing': 'border-box'
                    },
                    components: [
                        {
                            type: 'text',
                            tagName: 'div',
                            content: 'Khối liên kết (Clickable Card)',
                            style: { 'font-weight': '700', 'font-size': '15px', 'color': '#1e293b', 'margin-bottom': '4px' }
                        },
                        {
                            type: 'text',
                            tagName: 'div',
                            content: 'Bấm vào để chuyển hướng đến trang tương ứng. Có thể kéo thả thêm widget khác vào đây.',
                            style: { 'font-size': '13px', 'color': '#64748b' }
                        }
                    ],
                    traits: [
                        {
                            type: 'text',
                            name: 'href',
                            label: 'Đường dẫn (URL)',
                            placeholder: 'https://... hoặc #lien-he',
                            default: '#'
                        },
                        {
                            type: 'select',
                            name: 'target',
                            label: 'Mở tab mới',
                            options: [
                                { id: '_self', label: 'Cùng trang (_self)' },
                                { id: '_blank', label: 'Tab mới (_blank)' }
                            ],
                            default: '_self'
                        },
                        {
                            type: 'text',
                            name: 'title',
                            label: 'Tiêu đề tooltip (Title)',
                            placeholder: 'Gợi ý khi rê chuột...'
                        },
                        {
                            type: 'select',
                            name: 'rel',
                            label: 'Thuộc tính Rel (SEO)',
                            options: [
                                { id: '', label: 'Mặc định' },
                                { id: 'noopener noreferrer', label: 'noopener noreferrer' },
                                { id: 'nofollow', label: 'nofollow' }
                            ]
                        }
                    ]
                }
            }
        });

        // Add Quick Edit Link URL floating toolbar button
        editor.on('component:selected', function (component) {
            if (!component) return;
            var type = component.get('type');
            var tag = (component.get('tagName') || '').toLowerCase();
            if (type !== 'builder-link' && type !== 'builder-link-box' && tag !== 'a') {
                return;
            }
            var toolbar = (component.get('toolbar') || []).slice();
            var hasLinkBtn = toolbar.some(function (item) {
                return item.id === 'edit-link-url';
            });
            if (!hasLinkBtn) {
                toolbar.unshift({
                    id: 'edit-link-url',
                    attributes: {
                        class: 'fa fa-link',
                        title: 'Chỉnh sửa liên kết (URL / Link)'
                    },
                    command: function (ed) {
                        var currentHref = (component.getAttributes() || {}).href || '#';
                        if (global.Swal) {
                            global.Swal.fire({
                                title: 'Cài đặt liên kết (Link URL)',
                                input: 'text',
                                inputValue: currentHref,
                                inputPlaceholder: 'https://... hoặc /trang-chu hoặc #lien-he',
                                showCancelButton: true,
                                confirmButtonText: 'Lưu liên kết',
                                cancelButtonText: 'Hủy',
                                confirmButtonColor: '#00a0d2'
                            }).then(function (res) {
                                if (res.isConfirmed && res.value !== null) {
                                    component.addAttributes({ href: res.value });
                                    var tr = component.getTrait && component.getTrait('href');
                                    if (tr) tr.setValue(res.value);
                                }
                            });
                        } else {
                            var newHref = window.prompt('Nhập đường dẫn liên kết (URL):', currentHref);
                            if (newHref !== null) {
                                component.addAttributes({ href: newHref });
                                var tr = component.getTrait && component.getTrait('href');
                                if (tr) tr.setValue(newHref);
                            }
                        }
                    }
                });
                component.set('toolbar', toolbar);
            }
        });
    }

    global.GrapesLinkComponent = {
        init: initLinkComponent
    };
})(window);
