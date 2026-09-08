/**
 * GrapesJS Paragraph Component: builder-paragraph
 * Clean body text with high readability and easy style traits
 */
(function (global) {
    'use strict';

    function initParagraphComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-paragraph', {
            extend: 'text',
            isComponent: function () { return false; },
            model: {
                defaults: {
                    name: 'Đoạn văn (Paragraph)',
                    tagName: 'p',
                    droppable: false,
                    editable: true,
                    content: 'Đoạn văn mô tả nội dung chi tiết. Nhấp đúp vào đây để chỉnh sửa văn bản trực tiếp hoặc thay đổi kiểu dáng trong bảng thuộc tính.',
                    classes: ['builder-paragraph'],
                    style: {
                        'color': '#475569',
                        'font-size': '16px',
                        'line-height': '1.7',
                        'margin-top': '0px',
                        'margin-bottom': '20px',
                        'display': 'block'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'style-text-align',
                            label: 'Căn lề',
                            options: [
                                { id: 'left', label: 'Căn trái' },
                                { id: 'center', label: 'Căn giữa' },
                                { id: 'right', label: 'Căn phải' },
                                { id: 'justify', label: 'Căn đều hai bên' }
                            ],
                            default: 'left',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-font-size',
                            label: 'Cỡ chữ',
                            options: [
                                { id: '14px', label: '14px (Nhỏ - Chú thích)' },
                                { id: '16px', label: '16px (Tiêu chuẩn)' },
                                { id: '18px', label: '18px (Vừa - Đoạn mở đầu)' },
                                { id: '20px', label: '20px (Lớn - Lead text)' }
                            ],
                            default: '16px',
                            changeProp: 1
                        },
                        {
                            type: 'color',
                            name: 'style-color',
                            label: 'Màu chữ',
                            default: '#475569',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-line-height',
                            label: 'Giãn dòng (Line Height)',
                            options: [
                                { id: '1.4', label: 'Hẹp (1.4)' },
                                { id: '1.6', label: 'Vừa phải (1.6)' },
                                { id: '1.8', label: 'Rộng thoáng (1.8)' }
                            ],
                            default: '1.7',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-margin-bottom',
                            label: 'Khoảng cách dưới',
                            options: [
                                { id: '0px', label: '0px' },
                                { id: '10px', label: '10px (Nhỏ)' },
                                { id: '20px', label: '20px (Tiêu chuẩn)' },
                                { id: '30px', label: '30px (Rộng)' }
                            ],
                            default: '20px',
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:style-text-align change:style-font-size change:style-color change:style-line-height change:style-margin-bottom', this.handleStyles);
                },

                handleStyles: function () {
                    var style = {};
                    if (this.get('style-text-align')) style['text-align'] = this.get('style-text-align');
                    if (this.get('style-font-size')) style['font-size'] = this.get('style-font-size');
                    if (this.get('style-color')) style['color'] = this.get('style-color');
                    if (this.get('style-line-height')) style['line-height'] = this.get('style-line-height');
                    if (this.get('style-margin-bottom')) style['margin-bottom'] = this.get('style-margin-bottom');
                    this.addStyle(style);
                }
            }
        });
    }

    global.GrapesParagraphComponent = { init: initParagraphComponent };
})(window);
