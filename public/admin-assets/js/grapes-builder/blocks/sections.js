/**
 * GrapesJS Sections Block Registration
 * Registers all M4 Section patterns into GrapesJS Block Manager and injects shared CSS rules
 */
(function (global) {
    'use strict';

    function initSectionBlocks(editor) {
        var BlockManager = editor.BlockManager;
        var Registry = global.GrapesSectionRegistry;
        var Helpers = global.GrapesSectionHelpers;

        if (!Registry || !BlockManager) return;

        // Inject Shared Section CSS rules into GrapesJS CssComposer if not already added
        if (Helpers && Helpers.SHARED_SECTION_CSS && editor.Css) {
            try {
                editor.Css.addRules(Helpers.SHARED_SECTION_CSS);
            } catch (e) {
                console.warn('Could not inject shared section CSS rules:', e);
            }
        }

        var allSections = Registry.getAll();

        allSections.forEach(function (sec) {
            var blockId = 'pattern-' + sec.type + '-' + sec.variant;
            var categoryName = 'MẪU SECTION: ' + (sec.category || 'Chung');

            BlockManager.add(blockId, {
                label: '<div class="flex items-center gap-2 text-left"><iconify-icon icon="solar:widget-add-bold-duotone" class="text-primary text-xl shrink-0"></iconify-icon><div class="truncate"><div class="font-bold text-xs text-slate-800">' + sec.name + '</div><div class="text-[10px] text-slate-400 font-mono">' + sec.variant + '</div></div></div>',
                category: categoryName,
                content: sec.create
            });
        });
    }

    global.GrapesSectionBlocks = {
        init: initSectionBlocks
    };
})(window);
