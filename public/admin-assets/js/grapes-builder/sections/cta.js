/**
 * GrapesJS CTA (Call-to-Action) Section Patterns: cta-01, cta-02
 * Composed 100% from M3 components with pure semantic classes & role metadata
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesSectionRegistry;
    var Helpers = global.GrapesSectionHelpers || {};

    if (!Registry) return;

    // CTA 01: Centered Brand CTA
    Registry.register({
        type: 'cta',
        variant: 'cta-01',
        name: 'Kêu gọi 01 — Căn Giữa Nền Tối',
        category: 'Kêu gọi hành động (CTA)',
        keywords: ['cta', 'banner', 'dark-mode', 'conversion'],
        layoutHints: { columns: 1, alignment: 'center', theme: 'dark' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-cta') : 'sec-cta-01';
            return {
                type: 'builder-section',
                sectionType: 'cta',
                variant: 'cta-01',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-cta-01'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container', 'builder-container-sm'],
                        components: [
                            {
                                type: 'builder-stack',
                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-5', 'builder-align-center', 'builder-text-center'],
                                components: [
                                    {
                                        type: 'builder-heading',
                                        tagName: 'h2',
                                        role: 'section-title',
                                        content: 'Sẵn Sàng Cho Chuyến Hải Trình Tiếp Theo?',
                                        classes: ['section-title', 'section-title-white']
                                    },
                                    {
                                        type: 'builder-paragraph',
                                        role: 'section-description',
                                        content: 'Liên hệ ngay với chuyên viên tư vấn để nhận thông tin lịch trình và báo giá tốt nhất hôm nay.',
                                        classes: ['section-description', 'section-description-light']
                                    },
                                    {
                                        type: 'builder-button',
                                        role: 'primary-action',
                                        content: 'Đặt lịch tư vấn miễn phí',
                                        classes: ['builder-btn', 'builder-btn-primary'],
                                        attributes: { href: '#lien-he', target: '_self' }
                                    }
                                ]
                            }
                        ]
                    }
                ]
            };
        }
    });

    // CTA 02: Split Layout (Text Left + Button Right)
    Registry.register({
        type: 'cta',
        variant: 'cta-02',
        name: 'Kêu gọi 02 — Bố Cục Ngang (Text Trái, Nút Phải)',
        category: 'Kêu gọi hành động (CTA)',
        keywords: ['cta', 'split', 'horizontal'],
        layoutHints: { columns: 2, splitRatio: '2:1', alignment: 'center' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-cta') : 'sec-cta-02';
            return {
                type: 'builder-section',
                sectionType: 'cta',
                variant: 'cta-02',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-cta-02'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-columns',
                                classes: ['builder-columns-split'],
                                components: [
                                    {
                                        type: 'builder-column',
                                        components: [
                                            {
                                                type: 'builder-stack',
                                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-2'],
                                                components: [
                                                    {
                                                        type: 'builder-heading',
                                                        tagName: 'h2',
                                                        role: 'section-title',
                                                        content: 'Nhận Báo Giá Ưu Đãi Đặc Biệt Tháng Này',
                                                        classes: ['section-title']
                                                    },
                                                    {
                                                        type: 'builder-paragraph',
                                                        role: 'section-description',
                                                        content: 'Đăng ký nhận cẩm nang du thuyền và bảng giá hải trình chi tiết.',
                                                        classes: ['section-description']
                                                    }
                                                ]
                                            }
                                        ]
                                    },
                                    {
                                        type: 'builder-column',
                                        components: [
                                            {
                                                type: 'builder-stack',
                                                classes: ['builder-stack', 'builder-justify-end'],
                                                components: [
                                                    {
                                                        type: 'builder-button',
                                                        role: 'primary-action',
                                                        content: 'Liên hệ ngay',
                                                        classes: ['builder-btn', 'builder-btn-primary'],
                                                        attributes: { href: '#lien-he', target: '_self' }
                                                    }
                                                ]
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            };
        }
    });
})(window);
