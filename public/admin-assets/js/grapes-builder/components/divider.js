/**
 * GrapesJS Divider Component: builder-divider
 */
(function (global) {
    'use strict';

    function initDividerComponent(editor) {
        var DomComponents = editor.DomComponents;
        var CT = global.GrapesCommonTraits || {};

        DomComponents.addType('builder-divider', {
            model: {
                defaults: {
                    name: 'Đường phân cách (Divider)',
                    tagName: 'hr',
                    droppable: false,
                    void: true,
                    style: {
                        'border': 'none',
                        'border-top': '1px solid #e2e8f0',
                        'margin': '24px auto',
                        'width': '100%'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'divider-style',
                            label: 'Kiểu đường kẻ',
                            options: [
                                { id: 'solid', label: 'Nét liền (Solid)' },
                                { id: 'dashed', label: 'Nét đứt (Dashed)' },
                                { id: 'dotted', label: 'Chấm chấm (Dotted)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'divider-width',
                            label: 'Độ rộng',
                            options: [
                                { id: '100%', label: '100% (Toàn chiều rộng)' },
                                { id: '75%', label: '75%' },
                                { id: '50%', label: '50% (Một nửa)' },
                                { id: '25%', label: '25% (Ngắn)' },
                                { id: '80px', label: '80px (Điểm nhấn tiêu đề)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'divider-thickness',
                            label: 'Độ dày',
                            options: [
                                { id: '1px', label: '1px (Mảnh)' },
                                { id: '2px', label: '2px (Vừa)' },
                                { id: '3px', label: '3px' },
                                { id: '4px', label: '4px (Dày)' }
                            ],
                            changeProp: 1
                        },
                        CT.colorTrait ? CT.colorTrait('border-color', 'Màu đường kẻ', '#e2e8f0') : { type: 'color', name: 'border-color' }
                    ]
                },

                init: function () {
                    this.on('change:divider-style change:divider-width change:divider-thickness change:style-border-color', this.handleStyles);
                },

                handleStyles: function () {
                    var st = this.get('divider-style') || 'solid';
                    var th = this.get('divider-thickness') || '1px';
                    var cl = this.get('style-border-color') || '#e2e8f0';
                    var wd = this.get('divider-width') || '100%';

                    this.addStyle({
                        'border': 'none',
                        'border-top': th + ' ' + st + ' ' + cl,
                        'width': wd,
                        'margin': '24px auto'
                    });
                }
            }
        });
    }

    global.GrapesDividerComponent = { init: initDividerComponent };
})(window);
