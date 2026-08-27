/**
 * GrapesJS Dynamic Post List Block (Canonical Config Model)
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesDynamicRegistry;
    var Base = global.GrapesDynamicBase;

    function initComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-dynamic-post-list', {
            model: {
                defaults: {
                    name: 'Danh sách bài viết (Động)',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    dynamicType: 'post-list',
                    config: {
                        category: '',
                        limit: 3,
                        columns: 3,
                        align: 'left'
                    },
                    traits: [
                        {
                            type: 'select',
                            label: 'Chuyên mục bài viết',
                            name: 'category',
                            options: [{ id: '', name: '— Tất cả chuyên mục —' }]
                        },
                        {
                            type: 'number',
                            label: 'Số lượng bài viết',
                            name: 'limit',
                            min: 1,
                            max: 12,
                            default: 3
                        },
                        {
                            type: 'select',
                            label: 'Số cột hiển thị',
                            name: 'columns',
                            options: [
                                { id: '1', name: '1 Cột' },
                                { id: '2', name: '2 Cột' },
                                { id: '3', name: '3 Cột' },
                                { id: '4', name: '4 Cột' }
                            ],
                            default: '3'
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
                        if (options.post_categories && options.post_categories.length > 0) {
                            var trait = model.getTrait('category');
                            if (trait) {
                                var opts = [{ id: '', name: '— Tất cả chuyên mục —' }];
                                options.post_categories.forEach(function (c) {
                                    opts.push({ id: c.slug, name: c.name });
                                });
                                trait.set('options', opts);
                            }
                        }
                    });

                    this.on('change:attributes:category change:attributes:limit change:attributes:columns change:attributes:align', this.syncConfigFromTrait);
                },

                syncConfigFromTrait: function () {
                    var attrs = this.getAttributes();
                    var currentCfg = this.get('config') || {};
                    var newCfg = {
                        category: (attrs.category !== undefined) ? attrs.category : currentCfg.category,
                        limit: (attrs.limit !== undefined) ? (parseInt(attrs.limit, 10) || 3) : currentCfg.limit,
                        columns: (attrs.columns !== undefined) ? (parseInt(attrs.columns, 10) || 3) : currentCfg.columns,
                        align: (attrs.align !== undefined) ? attrs.align : currentCfg.align
                    };

                    this.set('config', newCfg);
                    this.updatePreview();
                },

                updatePreview: function () {
                    var model = this;
                    var cfg = this.get('config') || {};

                    Base.fetchPreview(model.cid, 'post-list', cfg, function (err, html) {
                        if (!err && html) {
                            model.components(html);
                        } else {
                            var title = 'Danh Sách Bài Viết Mới';
                            var subtitle = 'Chuyên mục: ' + (cfg.category || 'Tất cả') + ' | Số lượng: ' + (cfg.limit || 3) + ' bài | ' + (cfg.columns || 3) + ' cột';
                            model.components(Base.createPlaceholderCard(title, subtitle, 'solar:document-text-bold'));
                        }
                    });
                },

                toHTML: function () {
                    return Base.serializeConfigToHtml('post-list', this.get('config'));
                }
            }
        });
    }

    if (Registry) {
        Registry.register({
            type: 'post-list',
            componentType: 'builder-dynamic-post-list',
            name: 'Bài Viết Mới',
            icon: 'solar:document-text-bold',
            category: 'DỮ LIỆU ĐỘNG',
            initComponent: initComponent,
            create: function () {
                return {
                    type: 'builder-dynamic-post-list',
                    dynamicType: 'post-list',
                    config: {
                        category: '',
                        limit: 3,
                        columns: 3,
                        align: 'left'
                    }
                };
            }
        });
    }
})(window);
