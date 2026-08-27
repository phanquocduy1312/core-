/**
 * GrapesJS Layout Blocks Registration (Category: BỐ CỤC)
 */
(function (global) {
    'use strict';

    function initLayoutBlocks(editor) {
        var BlockManager = editor.BlockManager;
        var category = 'BỐ CỤC';

        // 1. Section + Container
        BlockManager.add('layout-section', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:align-bottom-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Section</span></div>',
            category: category,
            content: {
                type: 'builder-section',
                components: [
                    {
                        type: 'builder-container',
                        components: [
                            { type: 'builder-heading', content: 'Tiêu đề Section mới' },
                            { type: 'builder-paragraph', content: 'Mô tả nội dung cho section vừa thêm vào trang.' }
                        ]
                    }
                ]
            }
        });

        // 2. Container
        BlockManager.add('layout-container', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:maximize-square-minimalistic-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Khung chứa</span></div>',
            category: category,
            content: {
                type: 'builder-container'
            }
        });

        // 3. 2 Columns (50% / 50%)
        BlockManager.add('layout-2-columns', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:sub-square-bold-duotone" class="text-primary text-xl"></iconify-icon><span>2 Cột (50/50)</span></div>',
            category: category,
            content: {
                type: 'builder-columns',
                'columns-layout': '1-1',
                style: {
                    'display': 'grid',
                    'grid-template-columns': 'repeat(2, minmax(0, 1fr))',
                    'gap': '32px',
                    'align-items': 'center'
                },
                components: [
                    { type: 'builder-column' },
                    { type: 'builder-column' }
                ]
            }
        });

        // 4. 3 Columns (33% / 33% / 33%)
        BlockManager.add('layout-3-columns', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:slider-vertical-bold-duotone" class="text-primary text-xl"></iconify-icon><span>3 Cột Đều</span></div>',
            category: category,
            content: {
                type: 'builder-columns',
                'columns-layout': '1-1-1',
                style: {
                    'display': 'grid',
                    'grid-template-columns': 'repeat(3, minmax(0, 1fr))',
                    'gap': '24px',
                    'align-items': 'start'
                },
                components: [
                    { type: 'builder-column' },
                    { type: 'builder-column' },
                    { type: 'builder-column' }
                ]
            }
        });

        // 5. 4 Columns (25% / 25% / 25% / 25%)
        BlockManager.add('layout-4-columns', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:widget-add-bold-duotone" class="text-primary text-xl"></iconify-icon><span>4 Cột Đều</span></div>',
            category: category,
            content: {
                type: 'builder-columns',
                'columns-layout': '1-1-1-1',
                style: {
                    'display': 'grid',
                    'grid-template-columns': 'repeat(4, minmax(0, 1fr))',
                    'gap': '20px',
                    'align-items': 'start'
                },
                components: [
                    { type: 'builder-column' },
                    { type: 'builder-column' },
                    { type: 'builder-column' },
                    { type: 'builder-column' }
                ]
            }
        });

        // 6. Grid
        BlockManager.add('layout-grid', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:widget-2-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Lưới (Grid)</span></div>',
            category: category,
            content: {
                type: 'builder-grid'
            }
        });

        // 7. Stack
        BlockManager.add('layout-stack', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Khối xếp (Stack)</span></div>',
            category: category,
            content: {
                type: 'builder-stack'
            }
        });
    }

    global.GrapesLayoutBlocks = { init: initLayoutBlocks };
})(window);
