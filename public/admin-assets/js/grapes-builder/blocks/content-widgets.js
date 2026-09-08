/**
 * GrapesJS Rich Content & Interactive Widgets
 * WordPress / Elementor Grade Components:
 * - THẺ & NỘI DUNG: Icon Box, Image Box, Bảng Giá, Đánh Giá, Bộ Đếm, Checklist, Trích Dẫn, Thông Báo
 * - TƯƠNG TÁC & TIỆN ÍCH: FAQ (Accordion), Mạng Xã Hội, Bản Đồ Maps, Mã HTML, Thư Viện Ảnh
 */
(function (global) {
    'use strict';

    function initContentWidgets(editor) {
        var BlockManager = editor.BlockManager;
        if (!BlockManager) return;

        var CAT_CARDS = 'THẺ & NỘI DUNG';
        var CAT_INTERACTIVE = 'TƯƠNG TÁC & TIỆN ÍCH';

        // =========================================================================
        // DANH MỤC: THẺ & NỘI DUNG (Cards & Content)
        // =========================================================================

        // 1. Hộp biểu tượng (Icon Box)
        BlockManager.add('widget-icon-box', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#c5a880;"><path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99zM11 10h2v4h-2zm0 6h2v2h-2z"/></svg><span class="block-title">Hộp Biểu Tượng</span></div>',
            category: CAT_CARDS,
            content: {
                tagName: 'div',
                classes: ['builder-card', 'builder-icon-box'],
                style: {
                    'background-color': '#ffffff',
                    'padding': '32px 24px',
                    'border-radius': '16px',
                    'border': '1px solid #e2e8f0',
                    'box-shadow': '0 10px 25px -5px rgba(0, 0, 0, 0.05)',
                    'text-align': 'center',
                    'box-sizing': 'border-box',
                    'margin': '16px 0'
                },
                components: [
                    {
                        type: 'builder-icon',
                        attributes: { icon: 'solar:shield-star-bold-duotone' },
                        style: { 'font-size': '44px', 'color': '#c5a880', 'margin-bottom': '16px', 'display': 'inline-block' }
                    },
                    {
                        type: 'builder-heading',
                        tagName: 'h3',
                        content: 'Chất Lượng Vượt Trội',
                        style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                    },
                    {
                        type: 'builder-paragraph',
                        content: 'Sản phẩm nhập khẩu chính ngạch Châu Âu, độ bền kiểm định khắt khe và bảo hành tới 5 năm.',
                        style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '0px' }
                    }
                ]
            }
        });

        // 2. Hộp hình ảnh (Image Box)
        BlockManager.add('widget-image-box', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#10b981;"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg><span class="block-title">Hộp Hình Ảnh</span></div>',
            category: CAT_CARDS,
            content: {
                tagName: 'div',
                classes: ['builder-card', 'builder-image-box'],
                style: {
                    'background-color': '#ffffff',
                    'border-radius': '16px',
                    'border': '1px solid #e2e8f0',
                    'overflow': 'hidden',
                    'box-shadow': '0 10px 25px -5px rgba(0, 0, 0, 0.05)',
                    'margin': '16px 0',
                    'box-sizing': 'border-box'
                },
                components: [
                    {
                        type: 'image',
                        tagName: 'img',
                        attributes: {
                            src: '/wp-content/uploads/2024/10/Luxligh.jpg',
                            alt: 'Chiếu sáng cảnh quan biệt thự',
                            loading: 'lazy'
                        },
                        style: {
                            'width': '100%',
                            'height': '220px',
                            'object-fit': 'cover',
                            'display': 'block'
                        }
                    },
                    {
                        tagName: 'div',
                        style: { 'padding': '24px' },
                        components: [
                            {
                                type: 'builder-heading',
                                tagName: 'h3',
                                content: 'Chiếu Sáng Cảnh Quan',
                                style: { 'color': '#0f172a', 'font-size': '20px', 'font-weight': '700', 'margin-bottom': '10px' }
                            },
                            {
                                type: 'builder-paragraph',
                                content: 'Kiến tạo kiệt tác ánh sáng sân vườn và mặt tiền biệt thự với công nghệ LED thông minh chuẩn Châu Âu.',
                                style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin-bottom': '20px' }
                            },
                            {
                                type: 'builder-button',
                                content: 'Khám phá giải pháp →',
                                style: {
                                    'background-color': '#0f172a',
                                    'color': '#ffffff',
                                    'padding': '10px 22px',
                                    'border-radius': '8px',
                                    'font-size': '14px',
                                    'font-weight': '600',
                                    'text-decoration': 'none',
                                    'display': 'inline-block'
                                }
                            }
                        ]
                    }
                ]
            }
        });

        // 3. Bảng giá (Pricing Card)
        BlockManager.add('widget-pricing-card', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#f59e0b;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg><span class="block-title">Bảng Giá (Pricing)</span></div>',
            category: CAT_CARDS,
            content: {
                tagName: 'div',
                classes: ['builder-pricing-card'],
                style: {
                    'background-color': '#ffffff',
                    'padding': '36px 28px',
                    'border-radius': '16px',
                    'border': '2px solid #c5a880',
                    'box-shadow': '0 20px 35px -10px rgba(197, 168, 128, 0.25)',
                    'text-align': 'center',
                    'box-sizing': 'border-box',
                    'position': 'relative',
                    'margin': '16px 0'
                },
                components: [
                    {
                        tagName: 'div',
                        content: 'GÓI ĐƯỢC ƯA CHUỘNG NHẤT',
                        style: {
                            'background-color': '#c5a880',
                            'color': '#ffffff',
                            'font-size': '11px',
                            'font-weight': '800',
                            'letter-spacing': '1px',
                            'padding': '6px 16px',
                            'border-radius': '20px',
                            'display': 'inline-block',
                            'margin-bottom': '16px'
                        }
                    },
                    {
                        type: 'builder-heading',
                        tagName: 'h3',
                        content: 'Gói Cao Cấp (Premium)',
                        style: { 'color': '#0f172a', 'font-size': '22px', 'font-weight': '700', 'margin-bottom': '8px' }
                    },
                    {
                        tagName: 'div',
                        style: { 'margin': '20px 0', 'color': '#0f172a' },
                        components: [
                            { tagName: 'span', content: '2.500.000', style: { 'font-size': '36px', 'font-weight': '800', 'color': '#c5a880' } },
                            { tagName: 'span', content: ' đ / phòng', style: { 'font-size': '14px', 'color': '#64748b', 'font-weight': '500' } }
                        ]
                    },
                    {
                        tagName: 'ul',
                        style: { 'list-style': 'none', 'padding': '0', 'margin': '24px 0', 'text-align': 'left' },
                        components: [
                            { tagName: 'li', content: '✓ Khảo sát & đo sáng chuyên sâu tại công trình', style: { 'padding': '8px 0', 'color': '#334155', 'font-size': '14px', 'border-bottom': '1px dashed #e2e8f0' } },
                            { tagName: 'li', content: '✓ Bản vẽ mô phỏng 3D góc chiếu Dialux chi tiết', style: { 'padding': '8px 0', 'color': '#334155', 'font-size': '14px', 'border-bottom': '1px dashed #e2e8f0' } },
                            { tagName: 'li', content: '✓ Thiết bị LED CRI > 97 chống chói cao cấp', style: { 'padding': '8px 0', 'color': '#334155', 'font-size': '14px', 'border-bottom': '1px dashed #e2e8f0' } },
                            { tagName: 'li', content: '✓ Bảo hành tận nơi 5 năm đổi mới linh kiện', style: { 'padding': '8px 0', 'color': '#334155', 'font-size': '14px' } }
                        ]
                    },
                    {
                        type: 'builder-button',
                        content: 'Đăng Ký Tư Vấn Ngay',
                        style: {
                            'background-color': '#c5a880',
                            'color': '#ffffff',
                            'padding': '14px 28px',
                            'border-radius': '8px',
                            'font-size': '15px',
                            'font-weight': '700',
                            'text-decoration': 'none',
                            'display': 'block',
                            'width': '100%',
                            'box-sizing': 'border-box',
                            'box-shadow': '0 6px 16px rgba(197, 168, 128, 0.4)'
                        }
                    }
                ]
            }
        });

        // 4. Đánh giá khách hàng (Testimonial)
        BlockManager.add('widget-testimonial', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#ef4444;"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg><span class="block-title">Đánh Giá (Review)</span></div>',
            category: CAT_CARDS,
            content: {
                tagName: 'div',
                classes: ['builder-testimonial-card'],
                style: {
                    'background-color': '#ffffff',
                    'padding': '32px',
                    'border-radius': '16px',
                    'border': '1px solid #e2e8f0',
                    'box-shadow': '0 10px 25px -5px rgba(0, 0, 0, 0.05)',
                    'box-sizing': 'border-box',
                    'margin': '16px 0'
                },
                components: [
                    {
                        tagName: 'div',
                        content: '★★★★★',
                        style: { 'color': '#f59e0b', 'font-size': '20px', 'letter-spacing': '3px', 'margin-bottom': '16px' }
                    },
                    {
                        type: 'builder-paragraph',
                        content: '“Hệ thống chiếu sáng LuxLight nâng tầm toàn bộ kiến trúc biệt thự của chúng tôi. Ánh sáng ấm cúng, êm dịu cho mắt và tôn lên từng đường nét nội thất đá cẩm thạch.”',
                        style: { 'color': '#334155', 'font-size': '16px', 'font-style': 'italic', 'line-height': '1.7', 'margin-bottom': '24px' }
                    },
                    {
                        tagName: 'div',
                        style: { 'display': 'flex', 'align-items': 'center', 'gap': '14px' },
                        components: [
                            {
                                type: 'image',
                                tagName: 'img',
                                attributes: {
                                    src: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&auto=format&fit=crop&q=80',
                                    alt: 'Avatar khách hàng'
                                },
                                style: { 'width': '52px', 'height': '52px', 'border-radius': '50%', 'object-fit': 'cover' }
                            },
                            {
                                tagName: 'div',
                                components: [
                                    { tagName: 'div', content: 'KTS. Lê Hoàng Quân', style: { 'font-weight': '700', 'color': '#0f172a', 'font-size': '16px' } },
                                    { tagName: 'div', content: 'Giám đốc thiết kế — Urban Architecture Studio', style: { 'color': '#64748b', 'font-size': '13px' } }
                                ]
                            }
                        ]
                    }
                ]
            }
        });

        // 5. Bộ đếm số (Stat Counter)
        BlockManager.add('widget-counter', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#6366f1;"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14H6v-2h6v2zm4-4H6v-2h10v2zm0-4H6V7h10v2z"/></svg><span class="block-title">Bộ Đếm Số</span></div>',
            category: CAT_CARDS,
            content: {
                tagName: 'div',
                classes: ['builder-counter'],
                style: {
                    'background-color': '#f8fafc',
                    'padding': '28px 20px',
                    'border-radius': '14px',
                    'border': '1px solid #e2e8f0',
                    'text-align': 'center',
                    'box-sizing': 'border-box',
                    'margin': '16px 0'
                },
                components: [
                    {
                        tagName: 'div',
                        content: '500+',
                        style: {
                            'font-size': '44px',
                            'font-weight': '800',
                            'color': '#c5a880',
                            'line-height': '1',
                            'margin-bottom': '10px'
                        }
                    },
                    {
                        type: 'builder-paragraph',
                        content: 'DỰ ÁN ĐÃ BÀN GIAO TOÀN QUỐC',
                        style: {
                            'font-size': '13px',
                            'font-weight': '700',
                            'color': '#475569',
                            'letter-spacing': '1px',
                            'text-transform': 'uppercase',
                            'margin-bottom': '0px'
                        }
                    }
                ]
            }
        });

        // 6. Danh sách dấu tích (Icon List)
        BlockManager.add('widget-icon-list', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#06b6d4;"><path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/></svg><span class="block-title">Danh Sách Tick</span></div>',
            category: CAT_CARDS,
            content: {
                tagName: 'ul',
                classes: ['builder-icon-list'],
                style: {
                    'list-style': 'none',
                    'padding': '16px',
                    'margin': '16px 0',
                    'background': '#ffffff',
                    'border-radius': '12px',
                    'border': '1px solid #e2e8f0'
                },
                components: [
                    {
                        tagName: 'li',
                        style: { 'display': 'flex', 'align-items': 'center', 'gap': '12px', 'padding': '10px 0', 'border-bottom': '1px solid #f1f5f9', 'font-size': '15px', 'color': '#334155' },
                        components: [
                            { tagName: 'span', content: '✓', style: { 'color': '#10b981', 'font-weight': '800', 'font-size': '18px' } },
                            { tagName: 'span', content: 'Cam kết 100% đèn LED chính hãng COB / SMD cao cấp' }
                        ]
                    },
                    {
                        tagName: 'li',
                        style: { 'display': 'flex', 'align-items': 'center', 'gap': '12px', 'padding': '10px 0', 'border-bottom': '1px solid #f1f5f9', 'font-size': '15px', 'color': '#334155' },
                        components: [
                            { tagName: 'span', content: '✓', style: { 'color': '#10b981', 'font-weight': '800', 'font-size': '18px' } },
                            { tagName: 'span', content: 'Độ hoàn màu CRI > 97 Ra phản ánh trung thực vật liệu' }
                        ]
                    },
                    {
                        tagName: 'li',
                        style: { 'display': 'flex', 'align-items': 'center', 'gap': '12px', 'padding': '10px 0', 'border-bottom': '1px solid #f1f5f9', 'font-size': '15px', 'color': '#334155' },
                        components: [
                            { tagName: 'span', content: '✓', style: { 'color': '#10b981', 'font-weight': '800', 'font-size': '18px' } },
                            { tagName: 'span', content: 'Tương thích tuyệt đối hệ thống nhà thông minh Smarthome' }
                        ]
                    },
                    {
                        tagName: 'li',
                        style: { 'display': 'flex', 'align-items': 'center', 'gap': '12px', 'padding': '10px 0', 'font-size': '15px', 'color': '#334155' },
                        components: [
                            { tagName: 'span', content: '✓', style: { 'color': '#10b981', 'font-weight': '800', 'font-size': '18px' } },
                            { tagName: 'span', content: 'Đội ngũ kỹ thuật hỗ trợ lắp đặt và hướng dẫn tận tâm' }
                        ]
                    }
                ]
            }
        });

        // 7. Khối trích dẫn (Blockquote)
        BlockManager.add('widget-blockquote', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#d97706;"><path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z"/></svg><span class="block-title">Khối Trích Dẫn</span></div>',
            category: CAT_CARDS,
            content: {
                tagName: 'blockquote',
                classes: ['builder-blockquote'],
                style: {
                    'border-left': '4px solid #c5a880',
                    'background-color': '#faf8f5',
                    'padding': '24px 28px',
                    'margin': '20px 0',
                    'border-radius': '0 12px 12px 0',
                    'box-sizing': 'border-box'
                },
                components: [
                    {
                        type: 'builder-paragraph',
                        content: '“Ánh sáng không chỉ để thắp sáng màn đêm, mà là linh hồn điêu khắc nên chiều sâu và cảm xúc của không gian sống.”',
                        style: { 'font-size': '18px', 'font-style': 'italic', 'color': '#1e293b', 'line-height': '1.7', 'margin-bottom': '10px' }
                    },
                    {
                        tagName: 'cite',
                        content: '— Triết lý chiếu sáng kiến trúc LuxLight',
                        style: { 'font-size': '14px', 'font-weight': '700', 'color': '#c5a880', 'display': 'block', 'font-style': 'normal' }
                    }
                ]
            }
        });

        // 8. Hộp thông báo (Alert Banner)
        BlockManager.add('widget-alert', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#3b82f6;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg><span class="block-title">Hộp Thông Báo</span></div>',
            category: CAT_CARDS,
            content: {
                tagName: 'div',
                classes: ['builder-alert'],
                style: {
                    'background-color': '#eff6ff',
                    'border-left': '4px solid #3b82f6',
                    'padding': '18px 24px',
                    'border-radius': '0 10px 10px 0',
                    'margin': '16px 0',
                    'display': 'flex',
                    'align-items': 'center',
                    'gap': '14px'
                },
                components: [
                    {
                        tagName: 'span',
                        content: '🔔',
                        style: { 'font-size': '24px', 'shrink': '0' }
                    },
                    {
                        tagName: 'div',
                        components: [
                            { tagName: 'div', content: 'Chương trình ưu đãi tháng đặc biệt:', style: { 'font-weight': '700', 'color': '#1e3a8a', 'font-size': '15px', 'margin-bottom': '2px' } },
                            { tagName: 'div', content: 'Giảm ngay 15% cho tất cả đơn hàng đèn trang trí sân vườn cao cấp từ nay đến hết tháng.', style: { 'color': '#3b82f6', 'font-size': '14px' } }
                        ]
                    }
                ]
            }
        });

        // =========================================================================
        // DANH MỤC: TƯƠNG TÁC & TIỆN ÍCH (Interactive & Utilities)
        // =========================================================================

        // 9. Câu hỏi thường gặp (Accordion / FAQ)
        BlockManager.add('widget-faq-accordion', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#8b5cf6;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 16h-2v-2h2v2zm1.07-7.75l-.9.92C12.45 11.9 12 12.5 12 14h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H7c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.04-.42 1.99-1.07 2.75z"/></svg><span class="block-title">Hỏi Đáp (FAQ)</span></div>',
            category: CAT_INTERACTIVE,
            content: {
                tagName: 'div',
                classes: ['builder-faq-group'],
                style: { 'margin': '24px 0', 'display': 'flex', 'flex-direction': 'column', 'gap': '12px' },
                components: [
                    {
                        tagName: 'details',
                        attributes: { open: 'true' },
                        style: { 'background-color': '#ffffff', 'border': '1px solid #e2e8f0', 'border-radius': '10px', 'padding': '16px 20px', 'cursor': 'pointer' },
                        components: [
                            { tagName: 'summary', content: '1. Thời gian bảo hành của sản phẩm đèn LuxLight là bao lâu?', style: { 'font-weight': '700', 'color': '#0f172a', 'font-size': '16px', 'outline': 'none' } },
                            { tagName: 'p', content: 'Tất cả sản phẩm chính hãng đều được bảo hành tiêu chuẩn từ 3 đến 5 năm đổi mới linh kiện tận nơi.', style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin': '12px 0 0' } }
                        ]
                    },
                    {
                        tagName: 'details',
                        style: { 'background-color': '#ffffff', 'border': '1px solid #e2e8f0', 'border-radius': '10px', 'padding': '16px 20px', 'cursor': 'pointer' },
                        components: [
                            { tagName: 'summary', content: '2. Tôi có được tư vấn thiết kế mô phỏng 3D trước khi mua không?', style: { 'font-weight': '700', 'color': '#0f172a', 'font-size': '16px', 'outline': 'none' } },
                            { tagName: 'p', content: 'Hoàn toàn miễn phí! Đội ngũ kỹ sư Dialux của LuxLight sẽ mô phỏng chiếu sáng 3D chân thực cho căn hộ/biệt thự của bạn.', style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin': '12px 0 0' } }
                        ]
                    },
                    {
                        tagName: 'details',
                        style: { 'background-color': '#ffffff', 'border': '1px solid #e2e8f0', 'border-radius': '10px', 'padding': '16px 20px', 'cursor': 'pointer' },
                        components: [
                            { tagName: 'summary', content: '3. Phương thức thanh toán và giao hàng như thế nào?', style: { 'font-weight': '700', 'color': '#0f172a', 'font-size': '16px', 'outline': 'none' } },
                            { tagName: 'p', content: 'Chúng tôi hỗ trợ thanh toán trực tuyến qua VNPAY, thẻ tín dụng, chuyển khoản hoặc COD, giao hàng hỏa tốc toàn quốc.', style: { 'color': '#64748b', 'font-size': '14px', 'line-height': '1.6', 'margin': '12px 0 0' } }
                        ]
                    }
                ]
            }
        });

        // 10. Mạng xã hội (Social Icons)
        BlockManager.add('widget-social-icons', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#3b82f6;"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg><span class="block-title">Mạng Xã Hội</span></div>',
            category: CAT_INTERACTIVE,
            content: {
                tagName: 'div',
                classes: ['builder-social-links'],
                style: {
                    'display': 'flex',
                    'align-items': 'center',
                    'justify-content': 'center',
                    'gap': '14px',
                    'padding': '16px',
                    'margin': '16px 0'
                },
                components: [
                    {
                        tagName: 'a',
                        attributes: { href: 'https://facebook.com', target: '_blank', title: 'Facebook' },
                        style: { 'width': '42px', 'height': '42px', 'border-radius': '50%', 'background-color': '#1877f2', 'color': '#fff', 'display': 'flex', 'align-items': 'center', 'justify-content': 'center', 'text-decoration': 'none', 'font-size': '18px', 'font-weight': 'bold', 'box-shadow': '0 4px 10px rgba(24,119,242,0.3)' },
                        content: 'f'
                    },
                    {
                        tagName: 'a',
                        attributes: { href: 'https://zalo.me', target: '_blank', title: 'Zalo' },
                        style: { 'width': '42px', 'height': '42px', 'border-radius': '50%', 'background-color': '#0068ff', 'color': '#fff', 'display': 'flex', 'align-items': 'center', 'justify-content': 'center', 'text-decoration': 'none', 'font-size': '14px', 'font-weight': 'bold', 'box-shadow': '0 4px 10px rgba(0,104,255,0.3)' },
                        content: 'Zalo'
                    },
                    {
                        tagName: 'a',
                        attributes: { href: 'https://youtube.com', target: '_blank', title: 'YouTube' },
                        style: { 'width': '42px', 'height': '42px', 'border-radius': '50%', 'background-color': '#ff0000', 'color': '#fff', 'display': 'flex', 'align-items': 'center', 'justify-content': 'center', 'text-decoration': 'none', 'font-size': '18px', 'font-weight': 'bold', 'box-shadow': '0 4px 10px rgba(255,0,0,0.3)' },
                        content: '▶'
                    },
                    {
                        tagName: 'a',
                        attributes: { href: 'https://instagram.com', target: '_blank', title: 'Instagram' },
                        style: { 'width': '42px', 'height': '42px', 'border-radius': '50%', 'background': 'linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888)', 'color': '#fff', 'display': 'flex', 'align-items': 'center', 'justify-content': 'center', 'text-decoration': 'none', 'font-size': '18px', 'font-weight': 'bold', 'box-shadow': '0 4px 10px rgba(220,39,67,0.3)' },
                        content: '📷'
                    },
                    {
                        tagName: 'a',
                        attributes: { href: 'https://tiktok.com', target: '_blank', title: 'TikTok' },
                        style: { 'width': '42px', 'height': '42px', 'border-radius': '50%', 'background-color': '#000000', 'color': '#fff', 'display': 'flex', 'align-items': 'center', 'justify-content': 'center', 'text-decoration': 'none', 'font-size': '16px', 'font-weight': 'bold', 'box-shadow': '0 4px 10px rgba(0,0,0,0.3)' },
                        content: '🎵'
                    }
                ]
            }
        });

        // 11. Bản đồ Google Maps
        BlockManager.add('widget-google-map', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#ea4335;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg><span class="block-title">Bản Đồ (Maps)</span></div>',
            category: CAT_INTERACTIVE,
            content: {
                tagName: 'div',
                classes: ['builder-map-wrapper'],
                style: {
                    'width': '100%',
                    'aspect-ratio': '16/9',
                    'border-radius': '14px',
                    'overflow': 'hidden',
                    'box-shadow': '0 8px 24px rgba(0,0,0,0.1)',
                    'margin': '20px 0'
                },
                components: [
                    {
                        tagName: 'iframe',
                        selectable: false,
                        attributes: {
                            src: 'https://maps.google.com/maps?q=Hanoi,%20Vietnam&t=&z=13&ie=UTF8&iwloc=&output=embed',
                            width: '100%',
                            height: '100%',
                            frameborder: '0',
                            style: 'border:0; width:100%; height:100%; display:block;'
                        }
                    }
                ]
            }
        });

        // 12. Mã HTML tùy chỉnh (Custom HTML Embed)
        BlockManager.add('widget-custom-html', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#10b981;"><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg><span class="block-title">Mã HTML Tùy Ý</span></div>',
            category: CAT_INTERACTIVE,
            content: {
                type: 'builder-custom-html',
                classes: ['builder-custom-embed'],
                style: {
                    'padding': '20px',
                    'background-color': '#f8fafc',
                    'border': '1px dashed #94a3b8',
                    'border-radius': '8px',
                    'margin': '16px 0',
                    'min-height': '60px'
                },
                content: '<div style="color:#64748b; font-family:monospace; font-size:13px; text-align:center; padding:8px;">&lt;!-- Nhấp đúp để dán mã HTML / Embed Script tại đây --&gt;</div>'
            }
        });

        // 13. Bộ sưu tập ảnh (Image Gallery Grid)
        BlockManager.add('widget-image-gallery', {
            label: '<div class="block-card"><svg viewBox="0 0 24 24" width="24" height="24" style="fill:#38bdf8;"><path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/></svg><span class="block-title">Thư Viện Ảnh</span></div>',
            category: CAT_INTERACTIVE,
            content: {
                tagName: 'div',
                classes: ['builder-gallery-grid'],
                style: {
                    'display': 'grid',
                    'grid-template-columns': 'repeat(4, minmax(0, 1fr))',
                    'gap': '16px',
                    'margin': '24px 0',
                    'width': '100%',
                    'box-sizing': 'border-box'
                },
                components: [
                    {
                        type: 'image',
                        tagName: 'img',
                        attributes: { src: '/wp-content/uploads/2024/10/Luxligh.jpg', alt: 'Dự án 1' },
                        style: { 'width': '100%', 'height': '180px', 'object-fit': 'cover', 'border-radius': '10px', 'box-shadow': '0 4px 12px rgba(0,0,0,0.08)' }
                    },
                    {
                        type: 'image',
                        tagName: 'img',
                        attributes: { src: '/wp-content/uploads/2024/10/Luxligh.jpg', alt: 'Dự án 2' },
                        style: { 'width': '100%', 'height': '180px', 'object-fit': 'cover', 'border-radius': '10px', 'box-shadow': '0 4px 12px rgba(0,0,0,0.08)' }
                    },
                    {
                        type: 'image',
                        tagName: 'img',
                        attributes: { src: '/wp-content/uploads/2024/10/Luxligh.jpg', alt: 'Dự án 3' },
                        style: { 'width': '100%', 'height': '180px', 'object-fit': 'cover', 'border-radius': '10px', 'box-shadow': '0 4px 12px rgba(0,0,0,0.08)' }
                    },
                    {
                        type: 'image',
                        tagName: 'img',
                        attributes: { src: '/wp-content/uploads/2024/10/Luxligh.jpg', alt: 'Dự án 4' },
                        style: { 'width': '100%', 'height': '180px', 'object-fit': 'cover', 'border-radius': '10px', 'box-shadow': '0 4px 12px rgba(0,0,0,0.08)' }
                    }
                ]
            }
        });
        function editableLeaves(node) {
            if (!node || typeof node !== 'object') return;
            if (Array.isArray(node)) { node.forEach(editableLeaves); return; }
            if (!node.type && typeof node.content === 'string' && node.content.trim()
                && !node.components && !['iframe', 'img', 'svg', 'iconify-icon'].includes(node.tagName)) {
                node.type = node.tagName === 'a' ? 'link' : 'text';
            }
            if (node.components) editableLeaves(node.components);
        }
        BlockManager.getAll().forEach(function (block) { editableLeaves(block.get('content')); });
    }

    global.GrapesContentWidgets = {
        init: initContentWidgets
    };
})(window);
