/**
 * GrapesJS Sections Block Registration
 * Registers all M4 Section patterns into GrapesJS Block Manager and injects shared CSS rules
 */
(function (global) {
    'use strict';

    function initSectionBlocks(editor) {
        var BlockManager = editor.BlockManager;
        var Helpers = global.GrapesSectionHelpers;

        // Keep Shared Section CSS rules in GrapesJS CssComposer so existing pages and layouts continue to render properly
        if (Helpers && Helpers.SHARED_SECTION_CSS && editor.Css) {
            try {
                editor.Css.addRules(Helpers.SHARED_SECTION_CSS);
            } catch (e) {
                console.warn('Could not inject shared section CSS rules:', e);
            }
        }

        // Clean up any pattern-* or MẪU SECTION blocks if present
        if (BlockManager && BlockManager.getAll) {
            var blocks = BlockManager.getAll();
            var toRemove = [];
            blocks.forEach(function (b) {
                var id = b.getId ? b.getId() : (b.get ? b.get('id') : '');
                var cat = b.get ? b.get('category') : '';
                var catId = typeof cat === 'object' ? (cat.id || cat.label || '') : (cat || '');
                if ((id && id.indexOf('pattern-') === 0) || (catId && catId.indexOf('MẪU SECTION') !== -1)) {
                    toRemove.push(id);
                }
            });
            toRemove.forEach(function (id) {
                BlockManager.remove(id);
            });
        }
    }

    global.GrapesSectionBlocks = {
        init: initSectionBlocks
    };
})(window);
