/**
 * GrapesJS Icon Component: builder-icon
 * Reuses iconify-icon already loaded across the project
 */
(function (global) {
    'use strict';

    function initIconComponent(editor) {
        var DomComponents = editor.DomComponents;
        var CT = global.GrapesCommonTraits || {};

        DomComponents.addType('builder-icon', {
            model: {
                defaults: {
                    name: 'Biểu tượng (Icon)',
                    tagName: 'iconify-icon',
                    droppable: false,
                    attributes: {
                        icon: 'solar:star-bold-duotone'
                    },
                    style: {
                        'font-size': '36px',
                        'color': '#e32326',
                        'display': 'inline-block'
                    },
                    traits: [
                        {
                            type: 'text',
                            name: 'icon',
                            label: 'Mã biểu tượng (Icon Name)',
                            placeholder: 'solar:star-bold-duotone, solar:shield-check-bold,...',
                            default: 'solar:star-bold-duotone'
                        },
                        {
                            type: 'select',
                            name: 'icon-size',
                            label: 'Kích cỡ (Size)',
                            options: [
                                { id: '18px', label: '18px (Nhỏ)' },
                                { id: '24px', label: '24px (Vừa)' },
                                { id: '36px', label: '36px (Tiêu chuẩn)' },
                                { id: '48px', label: '48px (Lớn)' },
                                { id: '64px', label: '64px (Rất lớn)' }
                            ],
                            changeProp: 1
                        },
                        CT.colorTrait ? CT.colorTrait('color', 'Màu sắc (Color)', '#e32326') : { type: 'color', name: 'color' }
                    ]
                },

                init: function () {
                    this.on('change:icon-size change:style-color', this.handleStyles);
                },

                handleStyles: function () {
                    var s = this.get('icon-size');
                    var c = this.get('style-color');
                    var style = {};
                    if (s) style['font-size'] = s;
                    if (c) style['color'] = c;
                    this.addStyle(style);
                }
            }
        });
    }

    global.GrapesIconComponent = { init: initIconComponent };
})(window);
