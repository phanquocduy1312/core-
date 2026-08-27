/**
 * GrapesJS Grid Component: builder-grid
 * CSS Grid layout wrapper with configurable columns and gap
 */
(function (global) {
    'use strict';

    function initGridComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-grid', {
            model: {
                defaults: {
                    name: 'Lưới (Grid)',
                    tagName: 'div',
                    droppable: true,
                    classes: ['grid', 'w-full'],
                    style: {
                        'display': 'grid',
                        'grid-template-columns': 'repeat(3, minmax(0, 1fr))',
                        'gap': '24px'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'grid-cols',
                            label: 'Số cột hiển thị (Columns)',
                            options: [
                                { id: '1', label: '1 Cột' },
                                { id: '2', label: '2 Cột' },
                                { id: '3', label: '3 Cột' },
                                { id: '4', label: '4 Cột' },
                                { id: '5', label: '5 Cột' },
                                { id: '6', label: '6 Cột' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'grid-gap',
                            label: 'Khoảng cách giữa các ô (Gap)',
                            options: [
                                { id: '8px', label: '8px' },
                                { id: '16px', label: '16px (Nhỏ)' },
                                { id: '24px', label: '24px (Chuẩn)' },
                                { id: '32px', label: '32px (Rộng)' },
                                { id: '48px', label: '48px' }
                            ],
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:grid-cols change:grid-gap', this.handleStyles);
                },

                handleStyles: function () {
                    var cols = this.get('grid-cols') || '3';
                    var gap = this.get('grid-gap') || '24px';
                    this.addStyle({
                        'display': 'grid',
                        'grid-template-columns': 'repeat(' + cols + ', minmax(0, 1fr))',
                        'gap': gap
                    });
                }
            }
        });
    }

    global.GrapesGridComponent = { init: initGridComponent };
})(window);
