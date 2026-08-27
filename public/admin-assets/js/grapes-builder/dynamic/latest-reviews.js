/**
 * GrapesJS Dynamic Latest Reviews Block (Canonical Config Model)
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesDynamicRegistry;
    var Base = global.GrapesDynamicBase;

    function initComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-dynamic-latest-reviews', {
            model: {
                defaults: {
                    name: 'Đánh giá khách hàng (Động)',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    dynamicType: 'latest-reviews',
                    config: {
                        limit: 4,
                        columns: 4
                    },
                    traits: [
                        {
                            type: 'number',
                            label: 'Số lượng đánh giá',
                            name: 'limit',
                            min: 1,
                            max: 12,
                            default: 4
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
                        }
                    ]
                },

                init: function () {
                    this.updatePreview();
                    this.on('change:attributes:limit change:attributes:columns', this.syncConfigFromTrait);
                },

                syncConfigFromTrait: function () {
                    var attrs = this.getAttributes();
                    var currentCfg = this.get('config') || {};
                    var newCfg = {
                        limit: (attrs.limit !== undefined) ? (parseInt(attrs.limit, 10) || 4) : currentCfg.limit,
                        columns: (attrs.columns !== undefined) ? (parseInt(attrs.columns, 10) || 4) : currentCfg.columns
                    };

                    this.set('config', newCfg);
                    this.updatePreview();
                },

                updatePreview: function () {
                    var model = this;
                    var cfg = this.get('config') || {};

                    Base.fetchPreview(model.cid, 'latest-reviews', cfg, function (err, html) {
                        if (!err && html) {
                            model.components(html);
                        } else {
                            var title = 'Đánh Giá Khách Hàng';
                            var subtitle = 'Số lượng: ' + (cfg.limit || 4) + ' đánh giá | ' + (cfg.columns || 4) + ' cột';
                            model.components(Base.createPlaceholderCard(title, subtitle, 'solar:stars-bold'));
                        }
                    });
                },

                toHTML: function () {
                    return Base.serializeConfigToHtml('latest-reviews', this.get('config'));
                }
            }
        });
    }

    if (Registry) {
        Registry.register({
            type: 'latest-reviews',
            componentType: 'builder-dynamic-latest-reviews',
            name: 'Đánh Giá Mới',
            icon: 'solar:stars-bold',
            category: 'DỮ LIỆU ĐỘNG',
            initComponent: initComponent,
            create: function () {
                return {
                    type: 'builder-dynamic-latest-reviews',
                    dynamicType: 'latest-reviews',
                    config: {
                        limit: 4,
                        columns: 4
                    }
                };
            }
        });
    }
})(window);
