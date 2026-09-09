/**
 * GrapesJS Dynamic Project Grid Block (Canonical Config Model)
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesDynamicRegistry;
    var Base = global.GrapesDynamicBase;

    function initComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-dynamic-project-grid', {
            model: {
                defaults: {
                    name: 'Lưới Dự Án (Động)',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    dynamicType: 'project-grid',
                    config: {
                        category: '',
                        limit: 6,
                        columns: 3,
                        align: 'left'
                    },
                    traits: [
                        {
                            type: 'select',
                            label: 'Chuyên mục dự án',
                            name: 'category',
                            options: [
                                { id: '', name: '— Tất cả chuyên mục —' },
                                { id: 'hospitality', name: 'Khách sạn & Nghỉ dưỡng' },
                                { id: 'residential', name: 'Nhà ở & Căn hộ' },
                                { id: 'commercial', name: 'Thương mại & Văn phòng' },
                                { id: 'other', name: 'Dự án khác' }
                            ]
                        },
                        {
                            type: 'number',
                            label: 'Số lượng dự án',
                            name: 'limit',
                            min: 1,
                            max: 24,
                            default: 6
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
                    this.updatePreview();
                    this.on('change:attributes:category change:attributes:limit change:attributes:columns change:attributes:align', this.syncConfigFromTrait);
                },

                syncConfigFromTrait: function () {
                    var attrs = this.getAttributes();
                    var currentCfg = this.get('config') || {};
                    var newCfg = {
                        category: (attrs.category !== undefined) ? attrs.category : currentCfg.category,
                        limit: (attrs.limit !== undefined) ? (parseInt(attrs.limit, 10) || 6) : currentCfg.limit,
                        columns: (attrs.columns !== undefined) ? (parseInt(attrs.columns, 10) || 3) : currentCfg.columns,
                        align: (attrs.align !== undefined) ? attrs.align : currentCfg.align
                    };

                    this.set('config', newCfg);
                    this.updatePreview();
                },

                updatePreview: function () {
                    var model = this;
                    var cfg = this.get('config') || {};

                    Base.fetchPreview(model.cid, 'project-grid', cfg, function (err, html) {
                        if (!err && html) {
                            model.components(html);
                        } else {
                            var title = 'Lưới Dự Án Chiếu Sáng';
                            var subtitle = 'Chuyên mục: ' + (cfg.category || 'Tất cả') + ' | Số lượng: ' + (cfg.limit || 6) + ' dự án | ' + (cfg.columns || 3) + ' cột';
                            model.components(Base.createPlaceholderCard(title, subtitle, 'solar:city-bold'));
                        }
                    });
                },

                toHTML: function () {
                    return Base.serializeConfigToHtml('project-grid', this.get('config'));
                }
            }
        });
    }

    if (Registry) {
        Registry.register({
            type: 'project-grid',
            componentType: 'builder-dynamic-project-grid',
            name: 'Lưới Dự Án',
            icon: 'solar:city-bold',
            category: 'DỮ LIỆU ĐỘNG',
            initComponent: initComponent,
            create: function () {
                return {
                    type: 'builder-dynamic-project-grid',
                    dynamicType: 'project-grid',
                    config: {
                        category: '',
                        limit: 6,
                        columns: 3,
                        align: 'left'
                    }
                };
            }
        });
    }
})(window);
