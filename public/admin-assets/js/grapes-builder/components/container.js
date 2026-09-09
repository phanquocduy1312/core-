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
                    classes: ['builder-container'],
                    style: {
                        'width': '100%',
                        'max-width': '1200px',
                        'margin-left': 'auto',
                        'margin-right': 'auto',
                        'padding-left': '20px',
                        'padding-right': '20px',
                        'box-sizing': 'border-box',
                        'min-height': '60px'
                    },
                    traits: [
                        {
                            type: 'select',
                            name: 'container-max-width',
                            label: 'Độ rộng tối đa (Max Width)',
                            options: [
                                { id: '1200px', label: 'Rộng chuẩn (1200px)' },
                                { id: '1024px', label: 'Vừa phải (1024px)' },
                                { id: '800px', label: 'Thu gọn đọc bài (800px)' },
                                { id: '100%', label: 'Tràn viền (100% Full Width)' }
                            ],
                            default: '1200px',
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
                            default: '20px',
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:container-max-width change:container-padding', this.handleStyles);
                },

                handleStyles: function () {
                    var mw = this.get('container-max-width') || '1200px';
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
