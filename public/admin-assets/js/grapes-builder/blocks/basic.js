/**
 * GrapesJS Basic Blocks Registration (Category: CƠ BẢN)
 */
(function (global) {
    'use strict';

    function initBasicBlocks(editor) {
        var BlockManager = editor.BlockManager;
        var category = 'CƠ BẢN';

        // 1. Heading
        BlockManager.add('builder-heading', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:text-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Tiêu đề</span></div>',
            category: category,
            content: {
                type: 'builder-heading',
                content: 'Tiêu đề trang nổi bật'
            }
        });

        // 2. Paragraph
        BlockManager.add('builder-paragraph', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:notes-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Đoạn văn</span></div>',
            category: category,
            content: {
                type: 'builder-paragraph',
                content: 'Đoạn văn mô tả nội dung chi tiết. Nhấp đúp để chỉnh sửa trực tiếp văn bản.'
            }
        });

        // 3. Button
        BlockManager.add('builder-button', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:cursor-square-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Nút bấm</span></div>',
            category: category,
            content: {
                type: 'builder-button',
                content: 'Khám phá ngay'
            }
        });

        // 4. Image
        BlockManager.add('builder-image', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:gallery-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Hình ảnh</span></div>',
            category: category,
            content: {
                type: 'image',
                tagName: 'img',
                attributes: {
                    src: '/admin-assets/images/builder/hero-placeholder.svg',
                    alt: 'Hình ảnh minh họa',
                    loading: 'lazy'
                },
                mediaRef: 'general/hero-placeholder',
                classes: ['w-full', 'rounded-2xl', 'shadow-md', 'object-cover']
            }
        });

        // 5. Icon
        BlockManager.add('builder-icon', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:star-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Biểu tượng</span></div>',
            category: category,
            content: {
                type: 'builder-icon',
                attributes: { icon: 'solar:shield-check-bold' }
            }
        });

        // 6. Video
        BlockManager.add('builder-video', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:videocamera-record-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Video</span></div>',
            category: category,
            content: {
                type: 'builder-video'
            }
        });

        // 7. Divider
        BlockManager.add('builder-divider', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:minus-square-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Đường kẻ</span></div>',
            category: category,
            content: {
                type: 'builder-divider'
            }
        });

        // 8. Spacer
        BlockManager.add('builder-spacer', {
            label: '<div class="flex items-center gap-2"><iconify-icon icon="solar:square-double-alt-vertical-bold-duotone" class="text-primary text-xl"></iconify-icon><span>Khoảng cách</span></div>',
            category: category,
            content: {
                type: 'builder-spacer'
            }
        });
    }

    global.GrapesBasicBlocks = { init: initBasicBlocks };
})(window);
