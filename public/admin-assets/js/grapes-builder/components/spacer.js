/**
 * GrapesJS Spacer Component: builder-spacer
 */
(function (global) {
    'use strict';

    function initSpacerComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-spacer', {
            model: {
                defaults: {
                    name: 'Khoảng cách (Spacer)',
                    tagName: 'div',
                    droppable: false,
                    classes: ['w-full', 'builder-spacer'],
                    style: {
                        'height': '32px',
                        'width': '100%'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'spacer-height',
                            label: 'Chiều cao (Height)',
                            options: [
                                { id: '16px', label: '16px (Nhỏ)' },
                                { id: '24px', label: '24px (Vừa)' },
                                { id: '32px', label: '32px (Tiêu chuẩn)' },
                                { id: '48px', label: '48px (Lớn)' },
                                { id: '64px', label: '64px (Rất lớn)' },
                                { id: '80px', label: '80px (Hero Space)' },
                                { id: '100px', label: '100px (Cực lớn)' }
                            ],
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:spacer-height', this.handleHeight);
                },

                handleHeight: function () {
                    var h = this.get('spacer-height') || '32px';
                    this.addStyle({ 'height': h });
                }
            }
        });
    }

    global.GrapesSpacerComponent = { init: initSpacerComponent };
})(window);
