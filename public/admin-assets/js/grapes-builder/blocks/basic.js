/**
 * GrapesJS Basic Blocks Registration (Category: CƠ BẢN)
 * High-contrast, beautifully styled, WordPress / Elementor style blocks
 */
(function (global) {
    'use strict';

    function initBasicBlocks(editor) {
        var BlockManager = editor.BlockManager;
        var category = 'CƠ BẢN';

        // 1. Heading
        BlockManager.add('builder-heading', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#3b82f6;"><path d="M5 4v3h5.5v12h3V7H19V4H5z"/></svg><span class="block-title">Tiêu Đề</span></div>',
            category: category,
            content: {
                type: 'builder-heading',
                content: 'Tiêu đề ấn tượng của bạn'
            }
        });

        // 2. Paragraph
        BlockManager.add('builder-paragraph', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#38bdf8;"><path d="M14 17H4v-2h10v2zm6-8H4V7h16v2zm0-4H4V3h16v2zm0 8H4v-2h16v2zm-6 4H4v-2h10v2z"/></svg><span class="block-title">Đoạn Văn</span></div>',
            category: category,
            content: {
                type: 'builder-paragraph',
                content: 'Đoạn văn mô tả nội dung chi tiết tại đây. Nhấp đúp để chỉnh sửa trực tiếp văn bản hoặc chọn màu sắc, cỡ chữ trong bảng thuộc tính bên phải.'
            }
        });

        // 2b. Link (Thẻ liên kết)
        BlockManager.add('builder-link', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#00a0d2;"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg><span class="block-title">Thẻ Link</span></div>',
            category: category,
            content: {
                type: 'builder-link'
            }
        });

        // 2c. Link Box (Khối liên kết)
        BlockManager.add('builder-link-box', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#0284c7;"><path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/></svg><span class="block-title">Khối Link</span></div>',
            category: category,
            content: {
                type: 'builder-link-box'
            }
        });

        // 3. Button
        BlockManager.add('builder-button', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#f59e0b;"><path d="M19 6H5a3 3 0 0 0-3 3v6a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3zm1 9a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v6z"/></svg><span class="block-title">Nút Bấm</span></div>',
            category: category,
            content: {
                type: 'builder-button',
                content: 'Khám phá ngay →'
            }
        });

        // 4. Image (Real luxury lighting photo from site)
        BlockManager.add('builder-image', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#10b981;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.96-2.36L6.5 17h11l-3.54-4.71z"/></svg><span class="block-title">Hình Ảnh</span></div>',
            category: category,
            content: {
                type: 'image',
                tagName: 'img',
                attributes: {
                    src: '/wp-content/uploads/2024/10/Luxligh.jpg',
                    alt: 'Dự án chiếu sáng kiến trúc LuxLight',
                    loading: 'lazy'
                },
                style: {
                    'width': '100%',
                    'max-width': '100%',
                    'height': 'auto',
                    'border-radius': '12px',
                    'box-shadow': '0 8px 24px rgba(0,0,0,0.12)',
                    'display': 'block',
                    'object-fit': 'cover'
                },
                classes: ['builder-img']
            }
        });

        // 5. Icon
        BlockManager.add('builder-icon', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#c5a880;"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg><span class="block-title">Biểu Tượng</span></div>',
            category: category,
            content: {
                type: 'builder-icon',
                attributes: { icon: 'solar:star-bold-duotone' }
            }
        });

        // 6. Video (Architectural Showcase - No Rickroll!)
        BlockManager.add('builder-video', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#ef4444;"><path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/></svg><span class="block-title">Video</span></div>',
            category: category,
            content: {
                type: 'builder-video'
            }
        });

        // 7. Divider
        BlockManager.add('builder-divider', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#94a3b8;"><path d="M2 11h20v2H2z"/></svg><span class="block-title">Đường Kẻ</span></div>',
            category: category,
            content: {
                type: 'builder-divider'
            }
        });

        // 8. Spacer
        BlockManager.add('builder-spacer', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#8b5cf6;"><path d="M13 2v6h-2V2h2zm-2 20v-6h2v6h-2zm-9-9h20v-2H2v2z"/></svg><span class="block-title">Khoảng Cách</span></div>',
            category: category,
            content: {
                type: 'builder-spacer'
            }
        });
    }

    global.GrapesBasicBlocks = { init: initBasicBlocks };
})(window);
