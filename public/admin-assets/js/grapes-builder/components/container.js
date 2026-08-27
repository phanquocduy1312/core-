/**
 * GrapesJS Container Component: builder-container
 * Max-width auto-centered responsive container
 */
(function (global) {
    'use strict';

    function initContainerComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-container', {
            model: {
                defaults: {
                    name: 'Khung chứa (Container)',
                    tagName: 'div',
                    droppable: true,
                    classes: ['mx-auto', 'w-full'],
                    style: {
                        'max-width': '1280px',
                        'padding-left': '20px',
                        'padding-right': '20px'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'container-max-width',
                            label: 'Độ rộng tối đa (Max Width)',
                            options: [
                                { id: '1280px', label: 'Rộng chuẩn (1280px - 7XL)' },
                                { id: '1140px', label: 'Vừa phải (1140px - 6XL)' },
                                { id: '1024px', label: 'Thu gọn (1024px - 5XL)' },
                                { id: '768px', label: 'Hẹp đọc bài viết (768px - 3XL)' },
                                { id: '100%', label: 'Tràn viền (100% Full Width)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'container-padding',
                            label: 'Lề trong 2 bên (Padding X)',
                            options: [
                                { id: '16px', label: '16px (Nhỏ)' },
                                { id: '20px', label: '20px (Tiêu chuẩn)' },
                                { id: '32px', label: '32px (Rộng)' },
                                { id: '0px', label: '0px (Không lề)' }
                            ],
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:container-max-width change:container-padding', this.handleStyles);
                },

                handleStyles: function () {
                    var mw = this.get('container-max-width') || '1280px';
                    var px = this.get('container-padding') || '20px';
                    this.addStyle({
                        'max-width': mw,
                        'padding-left': px,
                        'padding-right': px
                    });
                }
            }
        });
    }

    global.GrapesContainerComponent = { init: initContainerComponent };
})(window);
