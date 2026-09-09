/**
 * GrapesJS Grid Component: builder-grid & builder-grid-item
 * CSS Grid layout wrapper with configurable columns, gap and responsive grid items
 */
(function (global) {
    'use strict';

    function initGridComponent(editor) {
        var DomComponents = editor.DomComponents;

        // Custom Add Grid Item Action Trait
        editor.TraitManager.addType('grid-add-item-action', {
            createInput: function ({ trait, component }) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.style.cssText = 'width: 100%; padding: 8px 12px; background: #3b82f6; color: #ffffff; font-weight: 700; font-size: 12px; border: none; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 10px; transition: background 0.15s ease;';
                btn.innerHTML = '<svg viewBox="0 0 24 24" width="14" height="14" style="fill:currentColor;"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg> <span>Thêm 1 ô lưới mới (+1 Card)</span>';
                btn.addEventListener('mouseover', function () { btn.style.background = '#2563eb'; });
                btn.addEventListener('mouseout', function () { btn.style.background = '#3b82f6'; });
                btn.addEventListener('click', function () {
                    var target = trait.target || component || editor.getSelected();
                    if (target && target.components) {
                        target.components().add({
                            type: 'builder-grid-item',
                            components: [
                                {
                                    type: 'builder-icon',
                                    attributes: { icon: 'solar:star-bold-duotone' },
                                    style: { 'font-size': '36px', 'color': '#c5a880', 'margin-bottom': '14px', 'display': 'inline-block' }
                                },
                                {
                                    type: 'builder-heading',
                                    tagName: 'h3',
                                    content: 'Mục Mới',
                                    style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                                },
                                {
                                    type: 'builder-paragraph',
                                    content: 'Mô tả chi tiết cho tính năng hoặc dịch vụ mới này.',
                                    style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '0px' }
                                }
                            ]
                        });
                    }
                });
                return btn;
            }
        });

        // 1. Single Grid Item
        DomComponents.addType('builder-grid-item', {
            model: {
                defaults: {
                    name: 'Ô lưới (Grid Item)',
                    tagName: 'div',
                    draggable: true,
                    droppable: true,
                    removable: true,
                    copyable: true,
                    classes: ['builder-grid-item'],
                    style: {
                        'background-color': '#f8fafc',
                        'padding': '24px',
                        'border-radius': '12px',
                        'border': '1px solid #e2e8f0',
                        'box-sizing': 'border-box',
                        'min-height': '120px',
                        'display': 'flex',
                        'flex-direction': 'column',
                        'justify-content': 'flex-start',
                        'transition': 'all 0.2s ease'
                    },
                    traits: [
                        {
                            type: 'color',
                            name: 'style-background-color',
                            label: 'Màu nền ô',
                            default: '#f8fafc',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-padding',
                            label: 'Lề trong (Padding)',
                            options: [
                                { id: '16px', label: '16px (Nhỏ)' },
                                { id: '24px', label: '24px (Tiêu chuẩn)' },
                                { id: '32px', label: '32px (Rộng)' },
                                { id: '0px', label: '0px (Không lề)' }
                            ],
                            default: '24px',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-border-radius',
                            label: 'Bo góc (Border Radius)',
                            options: [
                                { id: '0px', label: '0px (Vuông)' },
                                { id: '8px', label: '8px (Nhẹ)' },
                                { id: '12px', label: '12px (Tiêu chuẩn)' },
                                { id: '20px', label: '20px (Lớn)' }
                            ],
                            default: '12px',
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:style-background-color change:style-padding change:style-border-radius', this.handleStyles);
                },

                handleStyles: function () {
                    var style = {};
                    if (this.get('style-background-color')) style['background-color'] = this.get('style-background-color');
                    if (this.get('style-padding')) style['padding'] = this.get('style-padding');
                    if (this.get('style-border-radius')) style['border-radius'] = this.get('style-border-radius');
                    this.addStyle(style);
                }
            }
        });

        // 2. Grid Wrapper
        DomComponents.addType('builder-grid', {
            model: {
                defaults: {
                    name: 'Lưới (Grid Container)',
                    tagName: 'div',
                    droppable: true,
                    removable: true,
                    copyable: true,
                    draggable: true,
                    classes: ['builder-grid', 'w-full'],
                    style: {
                        'display': 'grid',
                        'grid-template-columns': 'repeat(3, minmax(0, 1fr))',
                        'gap': '24px',
                        'width': '100%',
                        'min-height': '100px',
                        'margin': '24px 0',
                        'box-sizing': 'border-box'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'grid-cols',
                            label: 'Số cột hiển thị (Columns)',
                            options: [
                                { id: '1', label: '1 Cột' },
                                { id: '2', label: '2 Cột' },
                                { id: '3', label: '3 Cột (Tiêu chuẩn)' },
                                { id: '4', label: '4 Cột' },
                                { id: '5', label: '5 Cột' },
                                { id: '6', label: '6 Cột' }
                            ],
                            default: '3',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'grid-gap',
                            label: 'Khoảng cách giữa các ô (Gap)',
                            options: [
                                { id: '12px', label: '12px (Nhỏ)' },
                                { id: '16px', label: '16px (Vừa)' },
                                { id: '24px', label: '24px (Tiêu chuẩn)' },
                                { id: '32px', label: '32px (Rộng)' },
                                { id: '48px', label: '48px (Rất rộng)' }
                            ],
                            default: '24px',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'grid-align',
                            label: 'Căn gióng dọc (Align Items)',
                            options: [
                                { id: 'stretch', label: 'Kéo đều chiều cao (Stretch)' },
                                { id: 'start', label: 'Căn lên trên (Start)' },
                                { id: 'center', label: 'Căn giữa (Center)' },
                                { id: 'end', label: 'Căn xuống dưới (End)' }
                            ],
                            default: 'stretch',
                            changeProp: 1
                        },
                        {
                            type: 'grid-add-item-action',
                            name: 'add-grid-item',
                            label: 'Thêm thẻ mới'
                        }
                    ]
                },

                init: function () {
                    this.on('change:grid-cols change:grid-gap change:grid-align', this.handleStyles);
                },

                handleStyles: function () {
                    var cols = this.get('grid-cols') || '3';
                    var gap = this.get('grid-gap') || '24px';
                    var align = this.get('grid-align') || 'stretch';
                    this.addStyle({
                        'display': 'grid',
                        'grid-template-columns': 'repeat(' + cols + ', minmax(0, 1fr))',
                        'gap': gap,
                        'align-items': align
                    });
                }
            }
        });
    }

    global.GrapesGridComponent = { init: initGridComponent };
})(window);
