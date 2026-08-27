/**
 * GrapesJS Column Component: builder-column
 * Single responsive column child inside a builder-columns wrapper
 */
(function (global) {
    'use strict';

    function initColumnComponent(editor) {
        var DomComponents = editor.DomComponents;
        var CT = global.GrapesCommonTraits || {};

        DomComponents.addType('builder-column', {
            model: {
                defaults: {
                    name: 'Cột (Column)',
                    tagName: 'div',
                    draggable: 'builder-columns',
                    droppable: true,
                    classes: ['flex-1', 'min-w-0', 'w-full'],
                    style: {
                        'padding': '0px'
                    },
                    traits: [
                        CT.spacingTrait ? CT.spacingTrait('padding', 'Lề trong (Padding)', [
                            { id: '0px', label: '0px (Không lề)' },
                            { id: '12px', label: '12px (Nhỏ)' },
                            { id: '20px', label: '20px (Vừa)' },
                            { id: '32px', label: '32px (Rộng)' }
                        ]) : { type: 'text', name: 'padding' },
                        CT.colorTrait ? CT.colorTrait('background-color', 'Màu nền cột', '') : { type: 'color', name: 'background-color' },
                        CT.borderRadiusTrait ? CT.borderRadiusTrait() : { type: 'text', name: 'border-radius' }
                    ]
                },

                init: function () {
                    this.on('change:style-padding change:style-background-color change:style-border-radius', this.handleStyles);
                },

                handleStyles: function () {
                    var style = {};
                    if (this.get('style-padding')) style['padding'] = this.get('style-padding');
                    if (this.get('style-background-color')) style['background-color'] = this.get('style-background-color');
                    if (this.get('style-border-radius')) style['border-radius'] = this.get('style-border-radius');
                    this.addStyle(style);
                }
            }
        });
    }

    global.GrapesColumnComponent = { init: initColumnComponent };
})(window);
