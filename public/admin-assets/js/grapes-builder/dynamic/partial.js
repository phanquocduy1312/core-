/**
 * GrapesJS Dynamic Partial Component (Canonical Config Model)
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesDynamicRegistry;
    var Base = global.GrapesDynamicBase;

    function initComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-dynamic-partial', {
            model: {
                defaults: {
                    name: 'Thành phần dùng chung (Partial)',
                    tagName: 'div',
                    droppable: false,
                    editable: false,
                    dynamicType: 'partial',
                    config: {
                        partialId: 0
                    },
                    traits: [
                        {
                            type: 'select',
                            label: 'Chọn Partial',
                            name: 'partialId',
                            options: [{ id: '0', name: '— Chọn khối dùng chung —' }]
                        }
                    ]
                },

                init: function () {
                    var model = this;
                    this.updatePreview();

                    Base.fetchOptions(function (options) {
                        if (options.partials && options.partials.length > 0) {
                            var trait = model.getTrait('partialId');
                            if (trait) {
                                var opts = [{ id: '0', name: '— Chọn khối dùng chung —' }];
                                options.partials.forEach(function (p) {
                                    var roleLabel = p.role ? '[' + p.role.toUpperCase() + '] ' : '';
                                    opts.push({ id: String(p.id), name: roleLabel + p.title });
                                });
                                trait.set('options', opts);
                            }
                        }
                    });

                    this.on('change:attributes:partialId', this.syncConfigFromTrait);
                },

                syncConfigFromTrait: function () {
                    var attrs = this.getAttributes();
                    var currentCfg = this.get('config') || {};
                    var newCfg = {
                        partialId: (attrs.partialId !== undefined) ? (parseInt(attrs.partialId, 10) || 0) : currentCfg.partialId
                    };

                    this.set('config', newCfg);
                    this.updatePreview();
                },

                updatePreview: function () {
                    var model = this;
                    var cfg = this.get('config') || {};
                    var partialId = parseInt(cfg.partialId || cfg.partial_id, 10) || 0;

                    if (partialId <= 0) {
                        model.components(Base.createPlaceholderCard(
                            'Khối Dùng Chung (Partial)',
                            'Vui lòng chọn Partial trong bảng thuộc tính bên phải',
                            'solar:widget-5-bold'
                        ));
                        return;
                    }

                    Base.fetchPreview(model.cid, 'partial', cfg, function (err, html) {
                        if (!err && html) {
                            model.components(html);
                        } else {
                            var title = 'Khối Dùng Chung (Partial #' + partialId + ')';
                            var subtitle = 'Dữ liệu được nạp động từ Partial ID ' + partialId;
                            model.components(Base.createPlaceholderCard(title, subtitle, 'solar:widget-5-bold'));
                        }
                    });
                },

                toHTML: function () {
                    return Base.serializeConfigToHtml('partial', this.get('config'));
                }
            }
        });
    }

    if (Registry) {
        Registry.register({
            type: 'partial',
            componentType: 'builder-dynamic-partial',
            name: 'Khối Dùng Chung (Partial)',
            icon: 'solar:widget-5-bold',
            category: 'DỮ LIỆU ĐỘNG',
            initComponent: initComponent,
            create: function () {
                return {
                    type: 'builder-dynamic-partial',
                    dynamicType: 'partial',
                    config: {
                        partialId: 0
                    }
                };
            }
        });
    }
})(window);
