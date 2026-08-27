/**
 * GrapesJS Dynamic Category Grid Block (Canonical Config Model)
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesDynamicRegistry;
    var Base = global.GrapesDynamicBase;

    function initComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-dynamic-category-grid', {
            model: {
                defaults: {
                    name: 'Danh mục sản phẩm (Động)',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    dynamicType: 'category-grid',
                    config: {
                        limit: 8,
                        columns: 4,
                        align: 'center'
                    },
                    traits: [
                        {
                            type: 'number',
                            label: 'Số lượng danh mục',
                            name: 'limit',
                            min: 1,
                            max: 24,
                            default: 8
                        },
                        {
                            type: 'select',
                            label: 'Số cột hiển thị',
                            name: 'columns',
                            options: [
                                { id: '2', name: '2 Cột' },
                                { id: '3', name: '3 Cột' },
                                { id: '4', name: '4 Cột' },
                                { id: '6', name: '6 Cột' }
                            ],
                            default: '4'
                        },
                        {
                            type: 'select',
                            label: 'Căn lề',
                            name: 'align',
                            options: [
                                { id: 'center', name: 'Giữa' },
                                { id: 'left', name: 'Trái' }
                            ],
                            default: 'center'
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
                        limit: (attrs.limit !== undefined) ? (parseInt(attrs.limit, 10) || 8) : currentCfg.limit,
                        columns: (attrs.columns !== undefined) ? (parseInt(attrs.columns, 10) || 4) : currentCfg.columns,
                        align: (attrs.align !== undefined) ? attrs.align : currentCfg.align
                    };

                    this.set('config', newCfg);
                    this.updatePreview();
                },

                updatePreview: function () {
                    var model = this;
                    var cfg = this.get('config') || {};

                    Base.fetchPreview(model.cid, 'category-grid', cfg, function (err, html) {
                        if (!err && html) {
                            model.components(html);
                        } else {
                            var title = 'Lưới Danh Mục Sản Phẩm';
                            var subtitle = 'Số lượng: ' + (cfg.limit || 8) + ' danh mục | ' + (cfg.columns || 4) + ' cột';
                            model.components(Base.createPlaceholderCard(title, subtitle, 'solar:folder-bold'));
                        }
                    });
                },

                toHTML: function () {
                    return Base.serializeConfigToHtml('category-grid', this.get('config'));
                }
            }
        });
    }

    if (Registry) {
        Registry.register({
            type: 'category-grid',
            componentType: 'builder-dynamic-category-grid',
            name: 'Danh Mục Sản Phẩm',
            icon: 'solar:folder-bold',
            category: 'DỮ LIỆU ĐỘNG',
            initComponent: initComponent,
            create: function () {
                return {
                    type: 'builder-dynamic-category-grid',
                    dynamicType: 'category-grid',
                    config: {
                        limit: 8,
                        columns: 4,
                        align: 'center'
                    }
                };
            }
        });
    }
})(window);
