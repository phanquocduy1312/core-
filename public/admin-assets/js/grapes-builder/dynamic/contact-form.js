/**
 * GrapesJS Dynamic Contact Form Block (Canvas Submit Disabled)
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesDynamicRegistry;
    var Base = global.GrapesDynamicBase;

    function initComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-dynamic-contact-form', {
            model: {
                defaults: {
                    name: 'Form liên hệ (Động)',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    dynamicType: 'contact-form',
                    config: {},
                    traits: []
                },

                init: function () {
                    this.updatePreview();
                },

                updatePreview: function () {
                    var model = this;

                    Base.fetchPreview(model.cid, 'contact-form', {}, function (err, html) {
                        if (!err && html) {
                            // Strip live script in canvas and append disabled note
                            var safeCanvasHtml = html.replace(/<script[\s\S]*?<\/script>/gi, '');
                            model.components(safeCanvasHtml);
                        } else {
                            var title = 'Form Liên Hệ Khách Hàng (Tích hợp Hệ thống)';
                            var subtitle = 'Biểu mẫu gửi thông tin liên hệ được xử lý tự động bởi Core Backend';
                            model.components(Base.createPlaceholderCard(title, subtitle, 'solar:letter-bold'));
                        }
                    });
                },

                toHTML: function () {
                    return '<div data-page-block="contact-form"></div>';
                }
            }
        });
    }

    if (Registry) {
        Registry.register({
            type: 'contact-form',
            componentType: 'builder-dynamic-contact-form',
            name: 'Form Liên Hệ',
            icon: 'solar:letter-bold',
            category: 'DỮ LIỆU ĐỘNG',
            initComponent: initComponent,
            create: function () {
                return {
                    type: 'builder-dynamic-contact-form',
                    dynamicType: 'contact-form',
                    config: {}
                };
            }
        });
    }
})(window);
