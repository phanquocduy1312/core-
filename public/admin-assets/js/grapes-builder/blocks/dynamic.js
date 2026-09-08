/**
 * GrapesJS Dynamic Blocks Registration
 * Registers all M5 Dynamic Blocks into GrapesJS Block Manager
 */
(function (global) {
    'use strict';

    function initDynamicBlocks(editor) {
        var BlockManager = editor.BlockManager;
        var Registry = global.GrapesDynamicRegistry;

        if (!Registry || !BlockManager) return;

        var allBlocks = Registry.getAll();

        // 1. Initialize component types in editor
        allBlocks.forEach(function (block) {
            if (typeof block.initComponent === 'function') {
                block.initComponent(editor);
            }
        });

        // 2. Add blocks to Block Manager
        allBlocks.forEach(function (block) {
            var blockId = 'dynamic-' + block.type;
            var categoryName = 'DỮ LIỆU ĐỘNG';

            BlockManager.add(blockId, {
                label: '<div class="block-card"><iconify-icon icon="' + block.icon + '" style="color:#6366f1;"></iconify-icon><span class="block-title">' + block.name + '</span></div>',
                category: categoryName,
                content: block.create()
            });
        });
    }

    global.GrapesDynamicBlocks = {
        init: initDynamicBlocks
    };
})(window);
