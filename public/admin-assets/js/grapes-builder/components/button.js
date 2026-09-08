/**
 * GrapesJS Button Component: builder-button
 * Semantic <a> with luxury styling, variants, and link traits
 */
(function (global) {
    'use strict';

    var BUTTON_VARIANTS = {
        'gold': {
            'background-color': '#c5a880',
            'color': '#ffffff',
            'border': '1px solid #c5a880'
        },
        'dark': {
            'background-color': '#111827',
            'color': '#ffffff',
            'border': '1px solid #1f2937'
        },
        'primary': {
            'background-color': '#e32326',
            'color': '#ffffff',
            'border': '1px solid #e32326'
        },
        'outline': {
            'background-color': 'transparent',
            'color': '#c5a880',
            'border': '2px solid #c5a880'
        },
        'white': {
            'background-color': '#ffffff',
            'color': '#111827',
            'border': '1px solid #e5e7eb'
        }
    };

    function initButtonComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-button', {
            extend: 'link',
            isComponent: function () { return false; },
            model: {
                defaults: {
                    name: 'Nút bấm (Button)',
                    tagName: 'a',
                    droppable: false,
                    editable: true,
                    content: 'Khám phá ngay →',
                    attributes: {
                        href: '#',
                        target: '_self'
                    },
                    classes: ['builder-btn'],
                    style: {
                        'background-color': '#c5a880',
                        'color': '#ffffff',
                        'padding': '14px 32px',
                        'border-radius': '8px',
                        'font-size': '15px',
                        'font-weight': '600',
                        'text-decoration': 'none',
                        'display': 'inline-flex',
                        'align-items': 'center',
                        'justify-content': 'center',
                        'gap': '8px',
                        'box-shadow': '0 4px 14px rgba(197, 168, 128, 0.35)',
                        'border': '1px solid #c5a880',
                        'cursor': 'pointer',
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
                            type: 'select',
                            name: 'button-variant',
                            label: 'Kiểu dáng nút (Variant)',
                            options: [
                                { id: 'gold', label: 'Vàng đồng sang trọng (Gold Luxury)' },
                                { id: 'dark', label: 'Màu đen quý phái (Dark Slate)' },
                                { id: 'primary', label: 'Đỏ nổi bật (Red Brand)' },
                                { id: 'outline', label: 'Đường viền tinh tế (Outline)' },
                                { id: 'white', label: 'Nền trắng (White Card)' }
                            ],
                            default: 'gold',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'button-size',
                            label: 'Kích thước nút (Size)',
                            options: [
                                { id: 'sm', label: 'Nhỏ (10px 20px - 13px)' },
                                { id: 'md', label: 'Tiêu chuẩn (14px 32px - 15px)' },
                                { id: 'lg', label: 'Lớn (16px 40px - 17px)' }
                            ],
                            default: 'md',
                            changeProp: 1
                        },
                        {
                            type: 'color',
                            name: 'style-background-color',
                            label: 'Tùy chỉnh màu nền',
                            default: '#c5a880',
                            changeProp: 1
                        },
                        {
                            type: 'color',
                            name: 'style-color',
                            label: 'Tùy chỉnh màu chữ',
                            default: '#ffffff',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-border-radius',
                            label: 'Bo góc (Border Radius)',
                            options: [
                                { id: '0px', label: 'Vuông góc (0px)' },
                                { id: '4px', label: 'Bo nhẹ (4px)' },
                                { id: '8px', label: 'Tiêu chuẩn (8px)' },
                                { id: '14px', label: 'Bo tròn lớn (14px)' },
                                { id: '9999px', label: 'Viên thuốc tròn đều (Pill)' }
                            ],
                            default: '8px',
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:button-variant', this.handleVariant);
                    this.on('change:button-size', this.handleSize);
                    this.on('change:style-background-color change:style-color change:style-border-radius', this.handleCustomStyles);
                },

                handleVariant: function () {
                    var v = this.get('button-variant') || 'gold';
                    var cfg = BUTTON_VARIANTS[v];
                    if (cfg) {
                        this.addStyle(cfg);
                    }
                },

                handleSize: function () {
                    var s = this.get('button-size') || 'md';
                    if (s === 'sm') {
                        this.addStyle({ 'padding': '10px 20px', 'font-size': '13px' });
                    } else if (s === 'lg') {
                        this.addStyle({ 'padding': '16px 40px', 'font-size': '17px' });
                    } else {
                        this.addStyle({ 'padding': '14px 32px', 'font-size': '15px' });
                    }
                },

                handleCustomStyles: function () {
                    var style = {};
                    if (this.get('style-background-color')) style['background-color'] = this.get('style-background-color');
                    if (this.get('style-color')) style['color'] = this.get('style-color');
                    if (this.get('style-border-radius')) style['border-radius'] = this.get('style-border-radius');
                    this.addStyle(style);
                }
            }
        });
    }

    global.GrapesButtonComponent = { init: initButtonComponent };
})(window);
