/**
 * GrapesJS Unified Section Registry
 * Machine-readable metadata and factory functions for section patterns
 */
(function (global) {
    'use strict';

    var sectionsRegistry = [];

    function registerSection(definition) {
        if (!definition || !definition.type || !definition.variant || !definition.create) {
            console.error('Invalid section definition:', definition);
            return;
        }
        var entry = {
            type: definition.type,
            variant: definition.variant,
            name: definition.name || (definition.type + ' ' + definition.variant),
            category: definition.category || 'MẪU SECTION',
            keywords: definition.keywords || [definition.type, definition.variant],
            layoutHints: definition.layoutHints || {},
            capabilities: definition.capabilities || ['editable', 'responsive', 'clonable'],
            create: definition.create
        };
        sectionsRegistry.push(entry);
    }

    function getSections(type) {
        if (!type) return sectionsRegistry;
        return sectionsRegistry.filter(function (s) {
            return s.type === type;
        });
    }

    function getSection(type, variant) {
        return sectionsRegistry.find(function (s) {
            return s.type === type && s.variant === variant;
        });
    }

    function getAllSections() {
        return sectionsRegistry;
    }

    global.GrapesSectionRegistry = {
        register: registerSection,
        getSections: getSections,
        getSection: getSection,
        getAll: getAllSections
    };
})(window);
