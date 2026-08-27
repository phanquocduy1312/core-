/**
 * GrapesJS Dynamic Product Tabs Block (Canonical Config Model)
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesDynamicRegistry;
    var Base = global.GrapesDynamicBase;

    function initComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-dynamic-product-tabs', {
            model: {
                defaults: {
                    name: 'Tabs Sản phẩm theo danh mục (Động)',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    dynamicType: 'product-tabs',
                    config: {
                        limit: 16,
                        columns: 4,
                        align: 'left'
                    },
                    traits: [
                        {
                            type: 'number',
                            label: 'Số lượng sản phẩm',
                            name: 'limit',
                            min: 1,
                            max: 48,
                            default: 16
                        },
                        {
                            type: 'select',
                            label: 'Số cột hiển thị',
                            name: 'columns',
                            options: [
                                { id: '2', name: '2 Cột' },
                                { id: '3', name: '3 Cột' },
                                { id: '4', name: '4 Cột' }
                            ],
                            default: '4'
                        },
                        {
                            type: 'select',
                            label: 'Căn lề',
                            name: 'align',
                            options: [
                                { id: 'left', name: 'Trái' },
                                { id: 'center', name: 'Giữa' }
                            ],
                            default: 'left'
                        }
                    ]
                },

                init: function () {
                    this.updatePreview();
                    this.on('change:attributes:limit change:attributes:columns change:attributes:align', this.syncConfigFromTrait);
                },

                syncConfigFromTrait: function () {
                    var attrs = this.getAttributes();
                    var currentCfg = this.get('config') || {};
                    var newCfg = {
                        limit: (attrs.limit !== undefined) ? (parseInt(attrs.limit, 10) || 16) : currentCfg.limit,
                        columns: (attrs.columns !== undefined) ? (parseInt(attrs.columns, 10) || 4) : currentCfg.columns,
                        align: (attrs.align !== undefined) ? attrs.align : currentCfg.align
                    };

                    this.set('config', newCfg);
                    this.updatePreview();
                },

                updatePreview: function () {
                    var model = this;
                    var cfg = this.get('config') || {};

                    Base.fetchPreview(model.cid, 'product-tabs', cfg, function (err, html) {
                        if (!err && html) {
                            model.components(html);
                        } else {
                            var title = 'Tabs Danh Mục Sản Phẩm (Động)';
                            var subtitle = 'Hiển thị các tab danh mục lọc sản phẩm tự động';
                            model.components(Base.createPlaceholderCard(title, subtitle, 'solar:folder-with-files-bold'));
                        }
                    });
                },

                toHTML: function () {
                    return Base.serializeConfigToHtml('product-tabs', this.get('config'));
                }
            }
        });
    }

    if (Registry) {
        Registry.register({
            type: 'product-tabs',
            componentType: 'builder-dynamic-product-tabs',
            name: 'Tabs Sản Phẩm',
            icon: 'solar:folder-with-files-bold',
            category: 'DỮ LIỆU ĐỘNG',
            initComponent: initComponent,
            create: function () {
                return {
                    type: 'builder-dynamic-product-tabs',
                    dynamicType: 'product-tabs',
                    config: {
                        limit: 16,
                        columns: 4,
                        align: 'left'
                    }
                };
            }
        });
    }
})(window);
