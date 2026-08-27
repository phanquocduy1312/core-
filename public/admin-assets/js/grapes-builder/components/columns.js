/**
 * GrapesJS Columns Component: builder-columns
 * Flexible grid / flex column wrapper with responsive column presets
 */
(function (global) {
    'use strict';

    function initColumnsComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-columns', {
            model: {
                defaults: {
                    name: 'Các cột (Columns)',
                    tagName: 'div',
                    droppable: 'builder-column',
                    classes: ['grid', 'grid-cols-1', 'gap-8', 'w-full'],
                    style: {
                        'display': 'grid',
                        'grid-template-columns': 'repeat(2, minmax(0, 1fr))',
                        'gap': '32px',
                        'align-items': 'center'
                    },
                    components: [
                        { type: 'builder-column' },
                        { type: 'builder-column' }
                    ],
                    traits: [
                        {
                            type: 'select',
                            name: 'columns-layout',
                            label: 'Tỷ lệ các cột (Preset)',
                            options: [
                                { id: '1-1', label: '2 Cột Đều Nhau (50% / 50%)' },
                                { id: '1-2', label: '2 Cột Lệch Phải (33% / 66%)' },
                                { id: '2-1', label: '2 Cột Lệch Trái (66% / 33%)' },
                                { id: '1-3', label: '2 Cột Tỉ Lệ 25% / 75%' },
                                { id: '3-1', label: '2 Cột Tỉ Lệ 75% / 25%' },
                                { id: '1-1-1', label: '3 Cột Đều Nhau (33% / 33% / 33%)' },
                                { id: '1-1-1-1', label: '4 Cột Đều Nhau (25% / 25% / 25% / 25%)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'columns-gap',
                            label: 'Khoảng cách giữa các cột (Gap)',
                            options: [
                                { id: '16px', label: '16px (Nhỏ)' },
                                { id: '24px', label: '24px (Vừa)' },
                                { id: '32px', label: '32px (Tiêu chuẩn)' },
                                { id: '48px', label: '48px (Rộng)' },
                                { id: '64px', label: '64px (Rất rộng)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'columns-align',
                            label: 'Căn gióng dọc (Align Items)',
                            options: [
                                { id: 'center', label: 'Căn giữa (Center)' },
                                { id: 'start', label: 'Căn đỉnh trên (Start)' },
                                { id: 'end', label: 'Căn đáy dưới (End)' },
                                { id: 'stretch', label: 'Kéo dài bằng nhau (Stretch)' }
                            ],
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:columns-layout change:columns-gap change:columns-align', this.handleStyles);
                },

                handleStyles: function () {
                    var layout = this.get('columns-layout') || '1-1';
                    var gap = this.get('columns-gap') || '32px';
                    var align = this.get('columns-align') || 'center';

                    var gridCols = 'repeat(2, minmax(0, 1fr))';
                    if (layout === '1-1') gridCols = 'repeat(2, minmax(0, 1fr))';
                    else if (layout === '1-2') gridCols = '1fr 2fr';
                    else if (layout === '2-1') gridCols = '2fr 1fr';
                    else if (layout === '1-3') gridCols = '1fr 3fr';
                    else if (layout === '3-1') gridCols = '3fr 1fr';
                    else if (layout === '1-1-1') gridCols = 'repeat(3, minmax(0, 1fr))';
                    else if (layout === '1-1-1-1') gridCols = 'repeat(4, minmax(0, 1fr))';

                    this.addStyle({
                        'display': 'grid',
                        'grid-template-columns': gridCols,
                        'gap': gap,
                        'align-items': align
                    });
                }
            }
        });
    }

    global.GrapesColumnsComponent = { init: initColumnsComponent };
})(window);
