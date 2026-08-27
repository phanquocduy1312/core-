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
                label: '<div class="flex items-center gap-2 text-left"><iconify-icon icon="' + block.icon + '" class="text-indigo-600 text-xl shrink-0"></iconify-icon><div class="truncate"><div class="font-bold text-xs text-slate-800">' + block.name + '</div><div class="text-[10px] text-slate-400 font-mono">' + block.type + '</div></div></div>',
                category: categoryName,
                content: block.create
            });
        });
    }

    global.GrapesDynamicBlocks = {
        init: initDynamicBlocks
    };
})(window);
