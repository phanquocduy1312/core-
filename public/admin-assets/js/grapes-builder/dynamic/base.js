/**
 * GrapesJS Dynamic Base Utilities & Server Preview Fetcher
 */
(function (global) {
    'use strict';

    var cachedOptions = null;
    var activeAbortControllers = {};
    var debounceTimers = {};

    function fetchOptions(callback) {
        if (cachedOptions) {
            callback(cachedOptions);
            return;
        }
        var locale = (window.BUILDER_CONFIG && window.BUILDER_CONFIG.locale) || 'vi';
        var url = '/' + locale + '/admin/pages/builder/options';

        fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data && data.success && data.data) {
                cachedOptions = data.data;
                callback(cachedOptions);
            } else {
                callback({ categories: [], post_categories: [], partials: [] });
            }
        })
        .catch(function (err) {
            console.warn('Could not fetch builder dynamic options:', err);
            callback({ categories: [], post_categories: [], partials: [] });
        });
    }

    /**
     * Debounced Preview Fetcher with AbortController to prevent race conditions
     */
    function fetchPreview(componentId, dynamicType, config, callback) {
        var reqKey = componentId || dynamicType;

        // Cancel pending request for this component
        if (activeAbortControllers[reqKey]) {
            activeAbortControllers[reqKey].abort();
            delete activeAbortControllers[reqKey];
        }

        // Clear existing debounce timer
        if (debounceTimers[reqKey]) {
            clearTimeout(debounceTimers[reqKey]);
        }

        debounceTimers[reqKey] = setTimeout(function () {
            var controller = new AbortController();
            activeAbortControllers[reqKey] = controller;

            var locale = (window.BUILDER_CONFIG && window.BUILDER_CONFIG.locale) || 'vi';
            var url = '/' + locale + '/admin/pages/builder/dynamic-preview';

            var csrfToken = document.querySelector('meta[name="csrf-token"]')
                ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                : '';

            fetch(url, {
                method: 'POST',
                signal: controller.signal,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    dynamic_type: dynamicType,
                    config: config || {}
                })
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                delete activeAbortControllers[reqKey];
                if (data && data.success && data.html) {
                    callback(null, data.html);
                } else {
                    callback(new Error(data.message || 'Preview failed'));
                }
            })
            .catch(function (err) {
                if (err.name === 'AbortError') {
                    // Ignored: superseding request took over
                    return;
                }
                delete activeAbortControllers[reqKey];
                callback(err);
            });
        }, 300);
    }

    /**
     * Centralized Client-Side Serializer (Matches DynamicBlockConfigValidator)
     */
    function serializeConfigToHtml(dynamicType, config) {
        config = config || {};
        var attrs = { 'data-page-block': dynamicType };

        if (dynamicType === 'product-grid') {
            if (config.category) attrs['data-category'] = String(config.category);
            attrs['data-limit'] = String(Math.max(1, Math.min(24, parseInt(config.limit, 10) || 8)));
            attrs['data-query'] = (config.query === 'featured') ? 'featured' : 'latest';
            attrs['data-columns'] = String(Math.max(1, Math.min(10, parseInt(config.columns, 10) || 4)));
            if (config.gap !== undefined) attrs['data-gap'] = String(Math.max(0, Math.min(100, parseInt(config.gap, 10) || 24)));
            if (config.align) attrs['data-align'] = config.align;
        } else if (dynamicType === 'product-tabs') {
            attrs['data-limit'] = String(Math.max(1, Math.min(48, parseInt(config.limit, 10) || 16)));
            attrs['data-columns'] = String(Math.max(1, Math.min(10, parseInt(config.columns, 10) || 4)));
            if (config.gap !== undefined) attrs['data-gap'] = String(Math.max(0, Math.min(100, parseInt(config.gap, 10) || 24)));
            if (config.align) attrs['data-align'] = config.align;
        } else if (dynamicType === 'post-list') {
            if (config.category) attrs['data-category'] = String(config.category);
            attrs['data-limit'] = String(Math.max(1, Math.min(12, parseInt(config.limit, 10) || 3)));
            attrs['data-columns'] = String(Math.max(1, Math.min(6, parseInt(config.columns, 10) || 3)));
            if (config.gap !== undefined) attrs['data-gap'] = String(Math.max(0, Math.min(100, parseInt(config.gap, 10) || 24)));
            if (config.align) attrs['data-align'] = config.align;
        } else if (dynamicType === 'category-grid') {
            attrs['data-limit'] = String(Math.max(1, Math.min(24, parseInt(config.limit, 10) || 8)));
            attrs['data-columns'] = String(Math.max(1, Math.min(12, parseInt(config.columns, 10) || 4)));
            if (config.gap !== undefined) attrs['data-gap'] = String(Math.max(0, Math.min(100, parseInt(config.gap, 10) || 24)));
            if (config.align) attrs['data-align'] = config.align;
        } else if (dynamicType === 'latest-reviews') {
            attrs['data-limit'] = String(Math.max(1, Math.min(12, parseInt(config.limit, 10) || 4)));
            attrs['data-columns'] = String(Math.max(1, Math.min(6, parseInt(config.columns, 10) || 4)));
            if (config.gap !== undefined) attrs['data-gap'] = String(Math.max(0, Math.min(100, parseInt(config.gap, 10) || 24)));
        } else if (dynamicType === 'partial') {
            var pId = parseInt(config.partialId || config.partial_id, 10) || 0;
            attrs['data-partial-id'] = String(pId);
        }

        var pairs = [];
        for (var k in attrs) {
            pairs.push(k + '="' + attrs[k] + '"');
        }
        return '<div ' + pairs.join(' ') + '></div>';
    }

    /**
     * Normalizes Project Data before saving/exporting:
     * - Cleans dynamic blocks to CANONICAL STATE ONLY ({ type, dynamicType, config })
     * - Strips ephemeral preview DOM children (no DB snapshot data)
     * - Removes duplicate runtime attributes
     */
    function normalizeDynamicProjectData(node) {
        if (!node || typeof node !== 'object') return node;

        if (Array.isArray(node)) {
            return node.map(normalizeDynamicProjectData);
        }

        var isDynamic = node.dynamicType || (node.type && node.type.indexOf('builder-dynamic') === 0);

        if (isDynamic) {
            // Clean canonical node
            var cleanNode = {
                type: node.type,
                dynamicType: node.dynamicType,
                config: Object.assign({}, node.config || {})
            };
            if (node.classes) cleanNode.classes = node.classes;
            return cleanNode;
        }

        var result = {};
        for (var key in node) {
            if (key === 'components' && Array.isArray(node.components)) {
                result.components = node.components.map(normalizeDynamicProjectData);
            } else if (key === 'frames' && Array.isArray(node.frames)) {
                result.frames = node.frames.map(normalizeDynamicProjectData);
            } else if (key === 'pages' && Array.isArray(node.pages)) {
                result.pages = node.pages.map(normalizeDynamicProjectData);
            } else {
                result[key] = node[key];
            }
        }
        return result;
    }

    function createPlaceholderCard(title, subtitle, icon) {
        return '<div class="builder-dynamic-placeholder" style="padding: 32px 20px; background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 16px; text-align: center; font-family: sans-serif;">'
            + '<div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 12px; background: #e0e7ff; color: #4338ca; margin-bottom: 12px;">'
            + '<iconify-icon icon="' + (icon || 'solar:database-bold') + '" style="font-size: 24px;"></iconify-icon>'
            + '</div>'
            + '<div style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">' + title + '</div>'
            + '<div style="font-size: 13px; color: #64748b;">' + subtitle + '</div>'
            + '</div>';
    }

    global.GrapesDynamicBase = {
        fetchOptions: fetchOptions,
        fetchPreview: fetchPreview,
        serializeConfigToHtml: serializeConfigToHtml,
        normalizeDynamicProjectData: normalizeDynamicProjectData,
        createPlaceholderCard: createPlaceholderCard
    };
})(window);
