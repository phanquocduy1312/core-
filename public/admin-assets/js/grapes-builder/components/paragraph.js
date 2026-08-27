/**
 * GrapesJS Paragraph Component: builder-paragraph
 */
(function (global) {
    'use strict';

    function initParagraphComponent(editor) {
        var DomComponents = editor.DomComponents;
        var CT = global.GrapesCommonTraits || {};

        DomComponents.addType('builder-paragraph', {
            model: {
                defaults: {
                    name: 'Đoạn văn (Paragraph)',
                    tagName: 'p',
                    droppable: false,
                    editable: true,
                    content: 'Đoạn văn mô tả nội dung chi tiết. Nhấp đúp vào đây để chỉnh sửa văn bản trực tiếp hoặc thay đổi kiểu dáng trong bảng thuộc tính.',
                    classes: ['text-slate-600', 'leading-relaxed'],
                    traits: [
                        CT.alignTrait ? CT.alignTrait('left') : { type: 'text', name: 'align' },
                        CT.fontSizeTrait ? CT.fontSizeTrait('16px') : { type: 'text', name: 'font-size' },
                        CT.fontWeightTrait ? CT.fontWeightTrait('400') : { type: 'text', name: 'font-weight' },
                        CT.colorTrait ? CT.colorTrait('color', 'Màu chữ', '#475569') : { type: 'color', name: 'color' },
                        {
                            type: 'select',
                            name: 'style-line-height',
                            label: 'Giãn dòng (Line Height)',
                            options: [
                                { id: '1.4', label: 'Hẹp (1.4)' },
                                { id: '1.6', label: 'Vừa phải (1.6)' },
                                { id: '1.8', label: 'Rộng thoáng (1.8)' }
                            ],
                            changeProp: 1
                        },
                        CT.spacingTrait ? CT.spacingTrait('margin-bottom', 'Khoảng cách dưới', [
                            { id: '0px', label: '0px' },
                            { id: '8px', label: '8px' },
                            { id: '16px', label: '16px (Chuẩn)' },
                            { id: '24px', label: '24px' }
                        ]) : { type: 'text', name: 'margin-bottom' }
                    ]
                },

                init: function () {
                    this.on('change:style-text-align change:style-font-size change:style-font-weight change:style-color change:style-line-height change:style-margin-bottom', this.handleStyles);
                },

                handleStyles: function () {
                    var style = {};
                    if (this.get('style-text-align')) style['text-align'] = this.get('style-text-align');
                    if (this.get('style-font-size')) style['font-size'] = this.get('style-font-size');
                    if (this.get('style-font-weight')) style['font-weight'] = this.get('style-font-weight');
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
