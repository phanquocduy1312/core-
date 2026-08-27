/**
 * GrapesJS Stack Component: builder-stack
 * Flexbox container (Vertical / Horizontal) for composing sections & cards
 */
(function (global) {
    'use strict';

    function initStackComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-stack', {
            model: {
                defaults: {
                    name: 'Khối xếp chồng (Stack)',
                    tagName: 'div',
                    droppable: true,
                    classes: ['flex', 'w-full'],
                    style: {
                        'display': 'flex',
                        'flex-direction': 'column',
                        'gap': '16px',
                        'align-items': 'stretch',
                        'justify-content': 'flex-start'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'stack-direction',
                            label: 'Hướng sắp xếp (Direction)',
                            options: [
                                { id: 'column', label: 'Dọc (Vertical / Column)' },
                                { id: 'row', label: 'Ngang (Horizontal / Row)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'stack-gap',
                            label: 'Khoảng cách giữa các phần tử (Gap)',
                            options: [
                                { id: '0px', label: '0px (Dính liền)' },
                                { id: '8px', label: '8px (Nhỏ)' },
                                { id: '16px', label: '16px (Tiêu chuẩn)' },
                                { id: '24px', label: '24px (Vừa)' },
                                { id: '32px', label: '32px (Rộng)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'stack-align',
                            label: 'Căn gióng (Align Items)',
                            options: [
                                { id: 'stretch', label: 'Kéo dài toàn bộ (Stretch)' },
                                { id: 'flex-start', label: 'Đầu dòng (Start)' },
                                { id: 'center', label: 'Chính giữa (Center)' },
                                { id: 'flex-end', label: 'Cuối dòng (End)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'stack-justify',
                            label: 'Phân bổ (Justify Content)',
                            options: [
                                { id: 'flex-start', label: 'Bắt đầu (Start)' },
                                { id: 'center', label: 'Chính giữa (Center)' },
                                { id: 'flex-end', label: 'Kết thúc (End)' },
                                { id: 'space-between', label: 'Dãn đều 2 đầu (Space Between)' }
                            ],
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:stack-direction change:stack-gap change:stack-align change:stack-justify', this.handleStyles);
                },

                handleStyles: function () {
                    var dir = this.get('stack-direction') || 'column';
                    var gap = this.get('stack-gap') || '16px';
                    var align = this.get('stack-align') || 'stretch';
                    var justify = this.get('stack-justify') || 'flex-start';

                    this.addStyle({
                        'display': 'flex',
                        'flex-direction': dir,
                        'gap': gap,
                        'align-items': align,
                        'justify-content': justify
                    });
                }
            }
        });
    }

    global.GrapesStackComponent = { init: initStackComponent };
})(window);
