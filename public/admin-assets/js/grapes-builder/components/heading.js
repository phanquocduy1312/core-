/**
 * GrapesJS Heading Component: builder-heading
 */
(function (global) {
    'use strict';

    function initHeadingComponent(editor) {
        var DomComponents = editor.DomComponents;
        var CT = global.GrapesCommonTraits || {};

        DomComponents.addType('builder-heading', {
            model: {
                defaults: {
                    name: 'Tiêu đề (Heading)',
                    tagName: 'h2',
                    droppable: false,
                    editable: true,
                    content: 'Tiêu đề trang nổi bật',
                    classes: ['font-bold', 'text-slate-900', 'tracking-tight'],
                    traits: [
                        {
                            type: 'select',
                            name: 'tagName',
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
                        CT.alignTrait ? CT.alignTrait('left') : { type: 'text', name: 'align' },
                        CT.fontSizeTrait ? CT.fontSizeTrait('36px') : { type: 'text', name: 'font-size' },
                        CT.fontWeightTrait ? CT.fontWeightTrait('700') : { type: 'text', name: 'font-weight' },
                        CT.colorTrait ? CT.colorTrait('color', 'Màu chữ', '#0f172a') : { type: 'color', name: 'color' },
                        CT.spacingTrait ? CT.spacingTrait('margin-bottom', 'Khoảng cách dưới', [
                            { id: '0px', label: '0px' },
                            { id: '8px', label: '8px' },
                            { id: '16px', label: '16px (Chuẩn)' },
                            { id: '24px', label: '24px' },
                            { id: '32px', label: '32px' }
                        ]) : { type: 'text', name: 'margin-bottom' }
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
