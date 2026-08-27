/**
 * Laravel Storage Adapter for GrapesJS
 * Persists GrapesJS Project Data to Laravel MariaDB backend (pages.builder_data)
 */
(function (global) {
    'use strict';

    function initLaravelStorage(editor, config) {
        var storageManager = editor.Storage;

        // Add custom storage type 'laravel'
        storageManager.add('laravel', {
            async load() {
                // Initial project data provided by Laravel blade
                if (config.builderData && Object.keys(config.builderData).length > 0 && config.builderData.pages) {
                    return config.builderData;
                }
                return {};
            },

            async store(data) {
                var rawProjectData = editor.getProjectData();
                var projectData = global.GrapesDynamicBase
                    ? global.GrapesDynamicBase.normalizeDynamicProjectData(rawProjectData)
                    : rawProjectData;

                var html = editor.getHtml();
                var css = editor.getCss();

                var response = await fetch(config.saveUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': config.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        content_locale: config.locale,
                        builder_data: projectData,
                        published_html: html,
                        published_css: css
                    })
                });

                var res = await response.json();
                if (!response.ok || !res.success) {
                    throw new Error(res.message || 'Lỗi khi lưu bản nháp.');
                }
                return res;
            }
        });
    }

    global.GrapesLaravelStorage = {
        init: initLaravelStorage,

        async publish(editor, config) {
            var rawProjectData = editor.getProjectData();
            var projectData = global.GrapesDynamicBase
                ? global.GrapesDynamicBase.normalizeDynamicProjectData(rawProjectData)
                : rawProjectData;

            var html = editor.getHtml();
            var css = editor.getCss();

            var response = await fetch(config.publishUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': config.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    content_locale: config.locale,
                    builder_data: projectData,
                    published_html: html,
                    published_css: css
                })
            });

            var res = await response.json();
            if (!response.ok || !res.success) {
                throw new Error(res.message || 'Lỗi khi xuất bản trang.');
            }
            return res;
        }
    };
})(window);
