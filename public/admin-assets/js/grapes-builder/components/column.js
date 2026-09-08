/**
 * GrapesJS Column Component: builder-column
 * Single responsive column child inside a builder-columns wrapper
 */
(function (global) {
    'use strict';

    function initColumnComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-column', {
            model: {
                defaults: {
                    name: 'Cột (Column)',
                    tagName: 'div',
                    draggable: '.builder-columns',
                    droppable: true,
                    classes: ['builder-column'],
                    style: {
                        'min-height': '80px',
                        'padding': '12px',
                        'box-sizing': 'border-box',
                        'width': '100%'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'style-padding',
                            label: 'Lề trong (Padding)',
                            options: [
                                { id: '0px', label: '0px (Không lề)' },
                                { id: '12px', label: '12px (Nhỏ)' },
                                { id: '20px', label: '20px (Vừa)' },
                                { id: '32px', label: '32px (Rộng)' }
                            ],
                            default: '12px',
                            changeProp: 1
                        },
                        {
                            type: 'color',
                            name: 'style-background-color',
                            label: 'Màu nền cột',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-border-radius',
                            label: 'Bo góc cột',
                            options: [
                                { id: '0px', label: '0px (Vuông)' },
                                { id: '8px', label: '8px (Nhẹ)' },
                                { id: '16px', label: '16px (Bo tròn)' }
                            ],
                            default: '0px',
                            changeProp: 1
                        }
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
