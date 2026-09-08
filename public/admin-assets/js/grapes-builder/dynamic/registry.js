/**
 * GrapesJS Dynamic Blocks Registry
 * Machine-readable registry for server-resolved dynamic blocks & partials
 */
(function (global) {
    'use strict';

    var dynamicRegistry = [];

    function registerDynamicBlock(definition) {
        if (!definition || !definition.type || !definition.componentType) {
            console.error('Invalid dynamic block definition:', definition);
            return;
        }
        var entry = {
            type: definition.type,
            componentType: definition.componentType,
            name: definition.name || definition.type,
            category: definition.category || 'DỮ LIỆU ĐỘNG',
            icon: definition.icon || 'solar:database-bold',
            traits: definition.traits || [],
            defaults: definition.defaults || {},
            initComponent: definition.initComponent,
            create: definition.create
        };
        dynamicRegistry.push(entry);
    }

    function getDynamicBlock(type) {
        return dynamicRegistry.find(function (item) {
            return item.type === type || item.componentType === type;
        });
    }

    function getAllDynamicBlocks() {
        return dynamicRegistry;
    }

    global.GrapesDynamicRegistry = {
        register: registerDynamicBlock,
        get: getDynamicBlock,
        getAll: getAllDynamicBlocks
    };
})(window);
