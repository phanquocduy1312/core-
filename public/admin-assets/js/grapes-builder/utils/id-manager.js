/**
 * GrapesJS Unique ID Manager & Normalizer
 * Ensures all components have unique IDs on creation, duplication, and programmatic import.
 */
(function (global) {
    'use strict';

    var idCounter = 0;

    function generateUniqueId(prefix) {
        idCounter += 1;
        var cleanPrefix = (prefix || 'el').replace(/[^a-zA-Z0-9_-]/g, '');
        return cleanPrefix + '-' + Math.random().toString(36).substring(2, 7) + '-' + idCounter;
    }

    /**
     * Recursively regenerate IDs for cloned or colliding component nodes.
     * @param {Object} node - Component JSON object or Model
     * @param {Set|Array} seenIds - Set of already existing IDs
     */
    function normalizeNodeIds(node, seenIds) {
        if (!node || typeof node !== 'object') return;

        var attrs = node.attributes || (node.get && typeof node.get === 'function' ? node.get('attributes') : null);

        if (attrs && attrs.id) {
            var currentId = attrs.id;
            var isColliding = seenIds.has ? seenIds.has(currentId) : (seenIds.indexOf(currentId) !== -1);

            if (isColliding) {
                var prefix = currentId.split('-')[0] || 'el';
                var newId = generateUniqueId(prefix);
                if (typeof node.set === 'function') {
                    var newAttrs = Object.assign({}, node.get('attributes') || {}, { id: newId });
                    node.set('attributes', newAttrs);
                } else {
                    node.attributes.id = newId;
                }
                if (seenIds.add) seenIds.add(newId);
                else seenIds.push(newId);
            } else {
                if (seenIds.add) seenIds.add(currentId);
                else seenIds.push(currentId);
            }
        }

        var children = node.components || (node.get && typeof node.get === 'function' ? node.get('components') : null);
        if (children) {
            if (Array.isArray(children)) {
                children.forEach(function (child) {
                    normalizeNodeIds(child, seenIds);
                });
            } else if (children.forEach && typeof children.forEach === 'function') {
                children.forEach(function (child) {
                    normalizeNodeIds(child, seenIds);
                });
            }
        }
    }

    /**
     * Normalizes an entire GrapesJS Project Data object to resolve any duplicate IDs.
     * @param {Object} projectData
     * @returns {Object} Normalized projectData
     */
    function normalizeProjectData(projectData) {
        if (!projectData || !projectData.pages || !Array.isArray(projectData.pages)) {
            return projectData;
        }

        var seenIds = new Set();

        projectData.pages.forEach(function (page) {
            if (page.frames && Array.isArray(page.frames)) {
                page.frames.forEach(function (frame) {
                    if (frame.component) {
                        normalizeNodeIds(frame.component, seenIds);
                    }
                });
            }
        });

        return projectData;
    }

    /**
     * Attaches clone hook to GrapesJS editor
     * @param {Object} editor
     */
    function attachCloneHook(editor) {
        if (!editor) return;

        editor.on('component:clone', function (clonedComponent) {
            var seenIds = new Set();

            // Collect all existing IDs in the canvas
            var allComponents = editor.getWrapper().find('*');
            allComponents.forEach(function (comp) {
                if (comp !== clonedComponent) {
                    var id = comp.getAttributes().id;
                    if (id) seenIds.add(id);
                }
            });

            // Regenerate ID for cloned tree
            function regenerateClonedTree(comp) {
                var attrs = comp.getAttributes();
                if (attrs && attrs.id) {
                    var prefix = attrs.id.split('-')[0] || 'el';
                    var newId = generateUniqueId(prefix);
                    var updatedAttrs = Object.assign({}, attrs, { id: newId });
                    comp.setAttributes(updatedAttrs);
                    seenIds.add(newId);
                }
                var children = comp.components();
                if (children && children.forEach) {
                    children.forEach(function (child) {
                        regenerateClonedTree(child);
                    });
                }
            }

            regenerateClonedTree(clonedComponent);
        });
    }

    global.GrapesIdManager = {
        generateId: generateUniqueId,
        normalizeProjectData: normalizeProjectData,
        normalizeNodeIds: normalizeNodeIds,
        attachCloneHook: attachCloneHook
    };
})(window);
