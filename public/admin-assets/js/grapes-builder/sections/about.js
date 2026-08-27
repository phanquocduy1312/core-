/**
 * GrapesJS About Section Patterns: about-01, about-02
 * Composed 100% from M3 components with pure semantic classes & role metadata
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesSectionRegistry;
    var Helpers = global.GrapesSectionHelpers || {};

    if (!Registry) return;

    // ABOUT 01: Image Left + Content Right
    Registry.register({
        type: 'about',
        variant: 'about-01',
        name: 'Giới thiệu 01 — Ảnh Trái & Nội Dung Phải',
        category: 'Giới thiệu',
        keywords: ['about', 'story', 'image-left'],
        layoutHints: { columns: 2, imagePosition: 'left', alignment: 'left' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-about') : 'sec-about-01';
            return {
                type: 'builder-section',
                sectionType: 'about',
                variant: 'about-01',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-about-01'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-columns',
                                classes: ['builder-columns-2'],
                                components: [
                                    {
                                        type: 'builder-column',
                                        components: [
                                            Helpers.placeholderImage ? Helpers.placeholderImage('Giới thiệu doanh nghiệp', 'general/hero-placeholder', ['builder-shadow-md']) : {
                                                type: 'image',
                                                tagName: 'img',
                                                role: 'about-image',
                                                classes: ['builder-img', 'builder-rounded-2xl', 'builder-shadow-md'],
                                                attributes: { src: '/admin-assets/images/builder/hero-placeholder.svg', alt: 'About', loading: 'lazy' },
                                                mediaRef: 'general/hero-placeholder'
                                            }
                                        ]
                                    },
                                    {
                                        type: 'builder-column',
                                        components: [
                                            {
                                                type: 'builder-stack',
                                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-4'],
                                                components: [
                                                    {
                                                        type: 'builder-heading',
                                                        tagName: 'h2',
                                                        role: 'section-title',
                                                        content: 'Về Chúng Tôi — Hành Trình Kiến Tạo Giá Trị',
                                                        classes: ['section-title']
                                                    },
                                                    {
                                                        type: 'builder-paragraph',
                                                        role: 'section-description',
                                                        content: 'Với hơn 10 năm kinh nghiệm trong ngành, chúng tôi tự hào mang đến cho quý khách hàng những trải nghiệm dịch vụ và sản phẩm tiêu chuẩn quốc tế.',
                                                        classes: ['section-description']
                                                    },
                                                    {
                                                        type: 'builder-button',
                                                        role: 'primary-action',
                                                        content: 'Tìm hiểu thêm',
                                                        classes: ['builder-btn', 'builder-btn-primary'],
                                                        attributes: { href: '#ve-chung-toi', target: '_self' }
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

    // ABOUT 02: Content Left + Stats Right
    Registry.register({
        type: 'about',
        variant: 'about-02',
        name: 'Giới thiệu 02 — Nội Dung & Số Liệu Ấn Tượng',
        category: 'Giới thiệu',
        keywords: ['about', 'stats', 'numbers', 'counters'],
        layoutHints: { columns: 2, rightSlot: 'stats-grid' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-about') : 'sec-about-02';
            return {
                type: 'builder-section',
                sectionType: 'about',
                variant: 'about-02',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-about-02'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-columns',
                                classes: ['builder-columns-2'],
                                components: [
                                    {
                                        type: 'builder-column',
                                        components: [
                                            {
                                                type: 'builder-stack',
                                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-4'],
                                                components: [
                                                    {
                                                        type: 'builder-heading',
                                                        tagName: 'h2',
                                                        role: 'section-title',
                                                        content: 'Con Số Biết Nói & Uy Tín Vững Bền',
                                                        classes: ['section-title']
                                                    },
                                                    {
                                                        type: 'builder-paragraph',
                                                        role: 'section-description',
                                                        content: 'Mỗi dự án hoàn thành là một minh chứng cho sự tận tâm, chuyên nghiệp và trách nhiệm đối với đối tác và khách hàng.',
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
                                                type: 'builder-grid',
                                                classes: ['builder-grid-2'],
                                                components: [
                                                    {
                                                        type: 'builder-stack',
                                                        role: 'about-stat-item',
                                                        classes: ['builder-stat-card'],
                                                        components: [
                                                            { type: 'builder-heading', tagName: 'h3', role: 'stat-value', content: '10+', classes: ['stat-value'] },
                                                            { type: 'builder-paragraph', role: 'stat-label', content: 'Năm kinh nghiệm', classes: ['stat-label'] }
                                                        ]
                                                    },
                                                    {
                                                        type: 'builder-stack',
                                                        role: 'about-stat-item',
                                                        classes: ['builder-stat-card'],
                                                        components: [
                                                            { type: 'builder-heading', tagName: 'h3', role: 'stat-value', content: '250+', classes: ['stat-value'] },
                                                            { type: 'builder-paragraph', role: 'stat-label', content: 'Khách hàng VIP', classes: ['stat-label'] }
                                                        ]
                                                    },
                                                    {
                                                        type: 'builder-stack',
                                                        role: 'about-stat-item',
                                                        classes: ['builder-stat-card'],
                                                        components: [
                                                            { type: 'builder-heading', tagName: 'h3', role: 'stat-value', content: '100%', classes: ['stat-value'] },
                                                            { type: 'builder-paragraph', role: 'stat-label', content: 'Hài lòng dịch vụ', classes: ['stat-label'] }
                                                        ]
                                                    },
                                                    {
                                                        type: 'builder-stack',
                                                        role: 'about-stat-item',
                                                        classes: ['builder-stat-card'],
                                                        components: [
                                                            { type: 'builder-heading', tagName: 'h3', role: 'stat-value', content: '24/7', classes: ['stat-value'] },
                                                            { type: 'builder-paragraph', role: 'stat-label', content: 'Hỗ trợ kỹ thuật', classes: ['stat-label'] }
                                                        ]
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
