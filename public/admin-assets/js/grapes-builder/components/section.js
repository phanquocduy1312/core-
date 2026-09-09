/**
 * GrapesJS Section Component: builder-section
 * Semantic <section> with responsive padding and background options
 */
(function (global) {
    'use strict';

    function initSectionComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-section', {
            model: {
                defaults: {
                    name: 'Phần trang (Section)',
                    tagName: 'section',
                    droppable: true,
                    classes: ['builder-section'],
                    style: {
                        'position': 'relative',
                        'width': '100%',
                        'padding-top': '60px',
                        'padding-bottom': '60px',
                        'background-color': '#ffffff',
                        'box-sizing': 'border-box'
                    },
                    traits: [
                        {
                            type: 'text',
                            name: 'id',
                            label: 'Mã định danh (Anchor ID)',
                            placeholder: 'gioi-thieu, dich-vu,...'
                        },
                        {
                            type: 'select',
                            name: 'section-bg-preset',
                            label: 'Mẫu màu nền (Preset)',
                            options: [
                                { id: '#ffffff', label: 'Trắng tinh tế (#ffffff)' },
                                { id: '#f8fafc', label: 'Xám nhạt hiện đại (#f8fafc)' },
                                { id: '#0c1525', label: 'Xanh đen LuxLight (#0c1525)' },
                                { id: '#111827', label: 'Đen sang trọng (#111827)' },
                                { id: '#fbf8f3', label: 'Vàng cát ấm áp (#fbf8f3)' },
                                { id: 'transparent', label: 'Trong suốt (Transparent)' }
                            ],
                            default: '#ffffff',
                            changeProp: 1
                        },
                        {
                            type: 'color',
                            name: 'style-background-color',
                            label: 'Tùy chỉnh mã màu nền',
                            default: '#ffffff',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-padding-top',
                            label: 'Khoảng đệm trên (Padding Top)',
                            options: [
                                { id: '0px', label: '0px' },
                                { id: '30px', label: '30px (Nhỏ)' },
                                { id: '60px', label: '60px (Tiêu chuẩn)' },
                                { id: '80px', label: '80px (Rộng)' },
                                { id: '120px', label: '120px (Hero)' }
                            ],
                            default: '60px',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'style-padding-bottom',
                            label: 'Khoảng đệm dưới (Padding Bottom)',
                            options: [
                                { id: '0px', label: '0px' },
                                { id: '30px', label: '30px (Nhỏ)' },
                                { id: '60px', label: '60px (Tiêu chuẩn)' },
                                { id: '80px', label: '80px (Rộng)' },
                                { id: '120px', label: '120px (Hero)' }
                            ],
                            default: '60px',
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:section-bg-preset', this.handleBgPreset);
                    this.on('change:style-background-color change:style-padding-top change:style-padding-bottom', this.handleStyles);
                },

                handleBgPreset: function () {
                    var bg = this.get('section-bg-preset') || '#ffffff';
                    this.addStyle({ 'background-color': bg });
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
