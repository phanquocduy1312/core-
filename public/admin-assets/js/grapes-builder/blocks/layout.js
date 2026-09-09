/**
 * GrapesJS Layout Blocks Registration (Category: BỐ CỤC)
 * Fully styled, pre-populated WordPress / Elementor style layout components
 */
(function (global) {
    'use strict';

    function initLayoutBlocks(editor) {
        var BlockManager = editor.BlockManager;
        var category = 'BỐ CỤC';

        // 1. Section + Container + Starter Content
        BlockManager.add('layout-section', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#3b82f6;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 7h10v2H7zm0 4h10v2H7z"/></svg><span class="block-title">Section Mới</span></div>',
            category: category,
            content: {
                type: 'builder-section',
                style: {
                    'position': 'relative',
                    'width': '100%',
                    'padding-top': '60px',
                    'padding-bottom': '60px',
                    'background-color': '#ffffff'
                },
                components: [
                    {
                        type: 'builder-container',
                        components: [
                            {
                                type: 'builder-heading',
                                content: 'Khám Phá Giải Pháp Chiếu Sáng Đỉnh Cao',
                                style: {
                                    'color': '#0f172a',
                                    'font-size': '32px',
                                    'font-weight': '700',
                                    'text-align': 'center',
                                    'margin-bottom': '16px'
                                }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Chúng tôi kiến tạo không gian sống và làm việc đẳng cấp với hệ thống đèn trang trí và chiếu sáng kiến trúc hiện đại bậc nhất.',
                                style: {
                                    'color': '#475569',
                                    'font-size': '16px',
                                    'text-align': 'center',
                                    'max-width': '720px',
                                    'margin-left': 'auto',
                                    'margin-right': 'auto',
                                    'margin-bottom': '24px'
                                }
                            }
                        ]
                    }
                ]
            }
        });

        // 2. Container
        BlockManager.add('layout-container', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#10b981;"><path d="M3 3h18v18H3V3zm2 2v14h14V5H5z"/></svg><span class="block-title">Khung Chứa</span></div>',
            category: category,
            content: {
                type: 'builder-container',
                components: [
                    {
                        type: 'builder-heading',
                        content: 'Tiêu đề trong khung chứa',
                        style: {
                            'color': '#0f172a',
                            'font-size': '28px',
                            'font-weight': '700',
                            'margin-bottom': '12px'
                        }
                    },
                    {
                        type: 'builder-paragraph',
                        content: 'Nội dung nằm gọn bên trong khung chứa giới hạn 1200px.'
                    }
                ]
            }
        });

        // 3. 2 Columns (50% / 50%) - Elementor Style: Text + Button Left, Image Right
        BlockManager.add('layout-2-columns', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#f59e0b;"><path d="M3 3h8v18H3V3zm10 0h8v18h-8V3z"/></svg><span class="block-title">2 Cột (50/50)</span></div>',
            category: category,
            content: {
                type: 'builder-columns',
                'columns-layout': '1-1',
                style: {
                    'display': 'grid',
                    'grid-template-columns': 'repeat(2, minmax(0, 1fr))',
                    'gap': '36px',
                    'align-items': 'center',
                    'margin': '24px 0'
                },
                components: [
                    {
                        type: 'builder-column',
                        components: [
                            {
                                type: 'builder-heading',
                                content: 'Thiết Kế Ánh Sáng Kiến Trúc Đẳng Cấp',
                                style: {
                                    'color': '#0f172a',
                                    'font-size': '32px',
                                    'font-weight': '700',
                                    'line-height': '1.3',
                                    'margin-bottom': '16px'
                                }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Hòa quyện tinh hoa thiết kế Châu Âu cùng công nghệ LED thông minh, mang đến trải nghiệm thị giác ấn tượng và bền vững theo thời gian.',
                                style: {
                                    'color': '#475569',
                                    'font-size': '16px',
                                    'line-height': '1.7',
                                    'margin-bottom': '24px'
                                }
                            },
                            {
                                type: 'builder-button',
                                content: 'Tìm hiểu thêm →',
                                style: {
                                    'background-color': '#c5a880',
                                    'color': '#ffffff',
                                    'padding': '14px 32px',
                                    'border-radius': '8px',
                                    'font-size': '15px',
                                    'font-weight': '600',
                                    'text-decoration': 'none',
                                    'display': 'inline-flex',
                                    'box-shadow': '0 4px 14px rgba(197, 168, 128, 0.35)'
                                }
                            }
                        ]
                    },
                    {
                        type: 'builder-column',
                        components: [
                            {
                                type: 'image',
                                tagName: 'img',
                                attributes: {
                                    src: '/wp-content/uploads/2024/10/Luxligh.jpg',
                                    alt: 'Chiếu sáng không gian cao cấp',
                                    loading: 'lazy'
                                },
                                style: {
                                    'width': '100%',
                                    'max-width': '100%',
                                    'height': 'auto',
                                    'border-radius': '12px',
                                    'box-shadow': '0 10px 30px rgba(0,0,0,0.12)',
                                    'object-fit': 'cover',
                                    'display': 'block'
                                }
                            }
                        ]
                    }
                ]
            }
        });

        // 4. 3 Columns (33% / 33% / 33%) - 3 Feature Cards
        BlockManager.add('layout-3-columns', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#c5a880;"><path d="M3 3h5v18H3V3zm7 0h5v18h-5V3zm7 0h4v18h-4V3z"/></svg><span class="block-title">3 Cột Đều</span></div>',
            category: category,
            content: {
                type: 'builder-columns',
                'columns-layout': '1-1-1',
                style: {
                    'display': 'grid',
                    'grid-template-columns': 'repeat(3, minmax(0, 1fr))',
                    'gap': '24px',
                    'align-items': 'stretch',
                    'margin': '24px 0'
                },
                components: [
                    {
                        type: 'builder-column',
                        style: {
                            'background-color': '#f8fafc',
                            'padding': '28px 24px',
                            'border-radius': '12px',
                            'border': '1px solid #e2e8f0',
                            'box-sizing': 'border-box'
                        },
                        components: [
                            {
                                type: 'builder-icon',
                                attributes: { icon: 'solar:star-bold-duotone' },
                                style: { 'font-size': '36px', 'color': '#c5a880', 'margin-bottom': '16px', 'display': 'inline-block' }
                            },
                            {
                                type: 'builder-heading',
                                tagName: 'h3',
                                content: 'Thiết Kế Tinh Tế',
                                style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Tôn vinh vẻ đẹp kiến trúc với ngôn ngữ thiết kế sang trọng và độc bản.',
                                style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '0px' }
                            }
                        ]
                    },
                    {
                        type: 'builder-column',
                        style: {
                            'background-color': '#f8fafc',
                            'padding': '28px 24px',
                            'border-radius': '12px',
                            'border': '1px solid #e2e8f0',
                            'box-sizing': 'border-box'
                        },
                        components: [
                            {
                                type: 'builder-icon',
                                attributes: { icon: 'solar:shield-check-bold-duotone' },
                                style: { 'font-size': '36px', 'color': '#c5a880', 'margin-bottom': '16px', 'display': 'inline-block' }
                            },
                            {
                                type: 'builder-heading',
                                tagName: 'h3',
                                content: 'Chất Lượng Vượt Trội',
                                style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Nhập khẩu chính hãng, độ bền cao cùng chế độ bảo hành tới 5 năm.',
                                style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '0px' }
                            }
                        ]
                    },
                    {
                        type: 'builder-column',
                        style: {
                            'background-color': '#f8fafc',
                            'padding': '28px 24px',
                            'border-radius': '12px',
                            'border': '1px solid #e2e8f0',
                            'box-sizing': 'border-box'
                        },
                        components: [
                            {
                                type: 'builder-icon',
                                attributes: { icon: 'solar:heart-bold-duotone' },
                                style: { 'font-size': '36px', 'color': '#c5a880', 'margin-bottom': '16px', 'display': 'inline-block' }
                            },
                            {
                                type: 'builder-heading',
                                tagName: 'h3',
                                content: 'Hỗ Trợ Tận Tâm',
                                style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Đội ngũ kỹ sư chiếu sáng tư vấn mô phỏng 3D miễn phí cho mọi công trình.',
                                style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '0px' }
                            }
                        ]
                    }
                ]
            }
        });

        // 5. 4 Columns (25% / 25% / 25% / 25%) - 4 Stat Counters
        BlockManager.add('layout-4-columns', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#6366f1;"><path d="M2 3h4v18H2V3zm5 0h4v18H7V3zm5 0h4v18h-4V3zm5 0h5v18h-5V3z"/></svg><span class="block-title">4 Cột Đều</span></div>',
            category: category,
            content: {
                type: 'builder-columns',
                'columns-layout': '1-1-1-1',
                style: {
                    'display': 'grid',
                    'grid-template-columns': 'repeat(4, minmax(0, 1fr))',
                    'gap': '20px',
                    'align-items': 'center',
                    'margin': '24px 0',
                    'text-align': 'center'
                },
                components: [
                    {
                        type: 'builder-column',
                        style: { 'padding': '16px' },
                        components: [
                            { type: 'builder-heading', content: '500+', style: { 'color': '#c5a880', 'font-size': '36px', 'font-weight': '800', 'margin-bottom': '6px', 'text-align': 'center' } },
                            { type: 'builder-paragraph', content: 'Dự án đã bàn giao', style: { 'color': '#64748b', 'font-size': '14px', 'text-align': 'center', 'margin-bottom': '0px' } }
                        ]
                    },
                    {
                        type: 'builder-column',
                        style: { 'padding': '16px' },
                        components: [
                            { type: 'builder-heading', content: '15+', style: { 'color': '#c5a880', 'font-size': '36px', 'font-weight': '800', 'margin-bottom': '6px', 'text-align': 'center' } },
                            { type: 'builder-paragraph', content: 'Năm kinh nghiệm', style: { 'color': '#64748b', 'font-size': '14px', 'text-align': 'center', 'margin-bottom': '0px' } }
                        ]
                    },
                    {
                        type: 'builder-column',
                        style: { 'padding': '16px' },
                        components: [
                            { type: 'builder-heading', content: '99%', style: { 'color': '#c5a880', 'font-size': '36px', 'font-weight': '800', 'margin-bottom': '6px', 'text-align': 'center' } },
                            { type: 'builder-paragraph', content: 'Khách hàng hài lòng', style: { 'color': '#64748b', 'font-size': '14px', 'text-align': 'center', 'margin-bottom': '0px' } }
                        ]
                    },
                    {
                        type: 'builder-column',
                        style: { 'padding': '16px' },
                        components: [
                            { type: 'builder-heading', content: '24/7', style: { 'color': '#c5a880', 'font-size': '36px', 'font-weight': '800', 'margin-bottom': '6px', 'text-align': 'center' } },
                            { type: 'builder-paragraph', content: 'Hỗ trợ kỹ thuật', style: { 'color': '#64748b', 'font-size': '14px', 'text-align': 'center', 'margin-bottom': '0px' } }
                        ]
                    }
                ]
            }
        });

        // 6. Grid (3 Cột mẫu với 3 thẻ nội dung sang trọng)
        BlockManager.add('layout-grid', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#ec4899;"><path d="M3 3h8v8H3V3zm0 10h8v8H3v-8zm10-10h8v8h-8V3zm0 10h8v8h-8v-8z"/></svg><span class="block-title">Lưới (Grid)</span></div>',
            category: category,
            content: {
                type: 'builder-grid',
                'grid-cols': '3',
                style: {
                    'display': 'grid',
                    'grid-template-columns': 'repeat(3, minmax(0, 1fr))',
                    'gap': '24px',
                    'width': '100%',
                    'margin': '24px 0',
                    'box-sizing': 'border-box'
                },
                components: [
                    {
                        type: 'builder-grid-item',
                        components: [
                            {
                                type: 'builder-icon',
                                attributes: { icon: 'solar:star-bold-duotone' },
                                style: { 'font-size': '36px', 'color': '#c5a880', 'margin-bottom': '14px', 'display': 'inline-block' }
                            },
                            {
                                type: 'builder-heading',
                                tagName: 'h3',
                                content: 'Đèn Trang Trí Độc Bản',
                                style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Tạo điểm nhấn thẩm mỹ hoàn hảo cho phòng khách và sảnh đón sang trọng với các bộ sưu tập đèn cao cấp.',
                                style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '0px' }
                            }
                        ]
                    },
                    {
                        type: 'builder-grid-item',
                        components: [
                            {
                                type: 'builder-icon',
                                attributes: { icon: 'solar:sun-2-bold-duotone' },
                                style: { 'font-size': '36px', 'color': '#c5a880', 'margin-bottom': '14px', 'display': 'inline-block' }
                            },
                            {
                                type: 'builder-heading',
                                tagName: 'h3',
                                content: 'Chiếu Sáng Kiến Trúc',
                                style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Tối ưu hóa ánh sáng mặt tiền và không gian cảnh quan với độ bền vượt trội và hiệu suất tiết kiệm năng lượng.',
                                style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '0px' }
                            }
                        ]
                    },
                    {
                        type: 'builder-grid-item',
                        components: [
                            {
                                type: 'builder-icon',
                                attributes: { icon: 'solar:shield-check-bold-duotone' },
                                style: { 'font-size': '36px', 'color': '#c5a880', 'margin-bottom': '14px', 'display': 'inline-block' }
                            },
                            {
                                type: 'builder-heading',
                                tagName: 'h3',
                                content: 'Hệ Thống Smart Light',
                                style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Điều khiển ánh sáng thông minh qua ứng dụng, tùy biến kịch bản màu sắc và độ sáng theo từng khung giờ.',
                                style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '0px' }
                            }
                        ]
                    }
                ]
            }
        });

        // 7. Stack
        BlockManager.add('layout-stack', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#06b6d4;"><path d="M3 4h18v4H3V4zm0 6h18v4H3v-4zm0 6h18v4H3v-4z"/></svg><span class="block-title">Khối Xếp</span></div>',
            category: category,
            content: {
                type: 'builder-stack',
                components: [
                    {
                        type: 'builder-heading',
                        content: 'Khối Xếp Chồng Linh Hoạt',
                        style: { 'color': '#0f172a', 'font-size': '24px', 'font-weight': '700', 'margin-bottom': '8px' }
                    },
                    {
                        type: 'builder-paragraph',
                        content: 'Tự động sắp xếp các phần tử theo chiều dọc hoặc chiều ngang, dễ dàng đổi hướng trong bảng thuộc tính.'
                    },
                    {
                        type: 'builder-button',
                        content: 'Xem chi tiết →'
                    }
                ]
            }
        });
    }

    global.GrapesLayoutBlocks = { init: initLayoutBlocks };
})(window);
