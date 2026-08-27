/**
 * GrapesJS Section Component: builder-section
 * Semantic <section> with responsive padding and background options
 */
(function (global) {
    'use strict';

    function initSectionComponent(editor) {
        var DomComponents = editor.DomComponents;
        var CT = global.GrapesCommonTraits || {};

        DomComponents.addType('builder-section', {
            model: {
                defaults: {
                    name: 'Phần trang (Section)',
                    tagName: 'section',
                    droppable: true,
                    classes: ['relative', 'w-full', 'overflow-hidden'],
                    style: {
                        'padding-top': '80px',
                        'padding-bottom': '80px',
                        'background-color': '#ffffff'
                    },
                    traits: [
                        {
                            type: 'text',
                            name: 'id',
                            label: 'Mã định danh (Anchor ID)',
                            placeholder: 'gioi-thieu, dich-vu,...'
                        },
                        CT.colorTrait ? CT.colorTrait('background-color', 'Màu nền (Background)', '#ffffff') : { type: 'color', name: 'background-color' },
                        CT.spacingTrait ? CT.spacingTrait('padding-top', 'Khoảng đệm trên (Padding Top)') : { type: 'text', name: 'padding-top' },
                        CT.spacingTrait ? CT.spacingTrait('padding-bottom', 'Khoảng đệm dưới (Padding Bottom)') : { type: 'text', name: 'padding-bottom' }
                    ]
                },

                init: function () {
                    this.on('change:style-background-color change:style-padding-top change:style-padding-bottom', this.handleStyles);
                },

                handleStyles: function () {
                    var style = {};
                    if (this.get('style-background-color')) style['background-color'] = this.get('style-background-color');
                    if (this.get('style-padding-top')) style['padding-top'] = this.get('style-padding-top');
                    if (this.get('style-padding-bottom')) style['padding-bottom'] = this.get('style-padding-bottom');
                    this.addStyle(style);
                }
            }
        });
    }

    global.GrapesSectionComponent = { init: initSectionComponent };
})(window);
