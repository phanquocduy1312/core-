/**
 * GrapesJS Heading Component: builder-heading
 * Professional WordPress / Elementor style Heading with clear typography and full traits
 */
(function (global) {
    'use strict';

    function initHeadingComponent(editor) {
        var DomComponents = editor.DomComponents;
        var CT = global.GrapesCommonTraits || {};

        DomComponents.addType('builder-heading', {
            extend: 'text',
            isComponent: function () { return false; },
            model: {
                defaults: {
                    name: 'Tiêu đề (Heading)',
                    tagName: 'h2',
                    droppable: false,
                    editable: true,
                    content: 'Tiêu đề trang nổi bật',
                    classes: ['builder-heading'],
                    style: {
                        'color': '#0f172a',
                        'font-size': '32px',
                        'font-weight': '700',
                        'line-height': '1.3',
                        'margin-top': '0px',
                        'margin-bottom': '16px',
                        'letter-spacing': '-0.02em',
                        'display': 'block'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'tagName',
                            changeProp: 1,
                            label: 'Cấp thẻ (HTML Tag)',
                            default: 'h2',
                            options: [
                                { id: 'h1', label: 'H1 (Tiêu đề chính trang)' },
                                { id: 'h2', label: 'H2 (Tiêu đề mục lớn)' },
                                { id: 'h3', label: 'H3 (Tiêu đề mục vừa)' },
                                { id: 'h4', label: 'H4 (Tiêu đề mục nhỏ)' },
                                { id: 'h5', label: 'H5 (Tiêu đề phụ)' },
                                { id: 'h6', label: 'H6 (Tiêu đề vi mô)' }
                            ]
                        },
                        {
                            type: 'select',
                            name: 'style-text-align',
                            label: 'Căn lề (Align)',
                            options: [
                                { id: 'left', label: 'Căn trái' },
                                { id: 'center', label: 'Căn giữa' },
                                { id: 'right', label: 'Căn phải' }
                            ],
                            default: 'left',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-font-size',
                            label: 'Cỡ chữ (Font size)',
                            options: [
                                { id: '20px', label: '20px (Nhỏ)' },
                                { id: '24px', label: '24px (Vừa)' },
                                { id: '28px', label: '28px (Lớn)' },
                                { id: '32px', label: '32px (Tiêu chuẩn H2)' },
                                { id: '40px', label: '40px (Rất lớn H1)' },
                                { id: '48px', label: '48px (Hero Title)' }
                            ],
                            default: '32px',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-font-weight',
                            label: 'Độ đậm (Font weight)',
                            options: [
                                { id: '500', label: 'Trung bình (Medium 500)' },
                                { id: '600', label: 'Bán đậm (SemiBold 600)' },
                                { id: '700', label: 'Đậm (Bold 700)' },
                                { id: '800', label: 'Cực đậm (ExtraBold 800)' }
                            ],
                            default: '700',
                            changeProp: 1
                        },
                        {
                            type: 'color',
                            name: 'style-color',
                            label: 'Màu chữ',
                            default: '#0f172a',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-margin-bottom',
                            label: 'Khoảng cách dưới',
                            options: [
                                { id: '0px', label: '0px' },
                                { id: '8px', label: '8px (Nhỏ)' },
                                { id: '16px', label: '16px (Tiêu chuẩn)' },
                                { id: '24px', label: '24px (Rộng)' },
                                { id: '32px', label: '32px (Rất rộng)' }
                            ],
                            default: '16px',
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:style-text-align change:style-font-size change:style-font-weight change:style-color change:style-margin-bottom', this.handleStyles);
                },

                handleStyles: function () {
                    var style = {};
                    if (this.get('style-text-align')) style['text-align'] = this.get('style-text-align');
                    if (this.get('style-font-size')) style['font-size'] = this.get('style-font-size');
                    if (this.get('style-font-weight')) style['font-weight'] = this.get('style-font-weight');
                    if (this.get('style-color')) style['color'] = this.get('style-color');
                    if (this.get('style-margin-bottom')) style['margin-bottom'] = this.get('style-margin-bottom');
                    this.addStyle(style);
                }
            }
        });
    }

    global.GrapesHeadingComponent = { init: initHeadingComponent };
})(window);
