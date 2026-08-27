/**
 * GrapesJS Dynamic Product Grid Block (Canonical Config Model)
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesDynamicRegistry;
    var Base = global.GrapesDynamicBase;

    function initComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-dynamic-product-grid', {
            model: {
                defaults: {
                    name: 'Lưới sản phẩm (Động)',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    dynamicType: 'product-grid',
                    config: {
                        category: '',
                        limit: 8,
                        query: 'latest',
                        columns: 4,
                        align: 'left'
                    },
                    traits: [
                        {
                            type: 'select',
                            label: 'Danh mục',
                            name: 'category',
                            options: [{ id: '', name: '— Tất cả danh mục —' }]
                        },
                        {
                            type: 'number',
                            label: 'Số lượng sản phẩm',
                            name: 'limit',
                            min: 1,
                            max: 24,
                            default: 8
                        },
                        {
                            type: 'select',
                            label: 'Loại truy vấn',
                            name: 'query',
                            options: [
                                { id: 'latest', name: 'Mới nhất' },
                                { id: 'featured', name: 'Nổi bật' }
                            ],
                            default: 'latest'
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
                    var model = this;
                    this.updatePreview();

                    Base.fetchOptions(function (options) {
                        if (options.categories && options.categories.length > 0) {
                            var trait = model.getTrait('category');
                            if (trait) {
                                var opts = [{ id: '', name: '— Tất cả danh mục —' }];
                                options.categories.forEach(function (c) {
                                    opts.push({ id: c.slug, name: c.name });
                                });
                                trait.set('options', opts);
                            }
                        }
                    });

                    this.on('change:attributes:category change:attributes:limit change:attributes:query change:attributes:columns change:attributes:align', this.syncConfigFromTrait);
                },

                syncConfigFromTrait: function () {
                    var attrs = this.getAttributes();
                    var currentCfg = this.get('config') || {};
                    var newCfg = {
                        category: (attrs.category !== undefined) ? attrs.category : currentCfg.category,
                        limit: (attrs.limit !== undefined) ? (parseInt(attrs.limit, 10) || 8) : currentCfg.limit,
                        query: (attrs.query !== undefined) ? attrs.query : currentCfg.query,
                        columns: (attrs.columns !== undefined) ? (parseInt(attrs.columns, 10) || 4) : currentCfg.columns,
                        align: (attrs.align !== undefined) ? attrs.align : currentCfg.align
                    };

                    this.set('config', newCfg);
                    this.updatePreview();
                },

                updatePreview: function () {
                    var model = this;
                    var cfg = this.get('config') || {};

                    Base.fetchPreview(model.cid, 'product-grid', cfg, function (err, html) {
                        if (!err && html) {
                            model.components(html);
                        } else {
                            var title = 'Lưới Sản Phẩm Động (' + (cfg.query === 'featured' ? 'Nổi bật' : 'Mới nhất') + ')';
                            var subtitle = 'Danh mục: ' + (cfg.category || 'Tất cả') + ' | Số lượng: ' + (cfg.limit || 8) + ' sản phẩm | ' + (cfg.columns || 4) + ' cột';
                            model.components(Base.createPlaceholderCard(title, subtitle, 'solar:cart-large-2-bold'));
                        }
                    });
                },

                toHTML: function () {
                    return Base.serializeConfigToHtml('product-grid', this.get('config'));
                }
            }
        });
    }

    if (Registry) {
        Registry.register({
            type: 'product-grid',
            componentType: 'builder-dynamic-product-grid',
            name: 'Lưới Sản Phẩm',
            icon: 'solar:cart-large-2-bold',
            category: 'DỮ LIỆU ĐỘNG',
            initComponent: initComponent,
            create: function () {
                return {
                    type: 'builder-dynamic-product-grid',
                    dynamicType: 'product-grid',
                    config: {
                        category: '',
                        limit: 8,
                        query: 'latest',
                        columns: 4,
                        align: 'left'
                    }
                };
            }
        });
    }
})(window);
