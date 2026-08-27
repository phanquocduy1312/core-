/**
 * GrapesJS Hero Section Patterns: hero-01, hero-02
 * Composed 100% from M3 components with pure semantic classes & role metadata
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesSectionRegistry;
    var Helpers = global.GrapesSectionHelpers || {};

    if (!Registry) return;

    // HERO 01: Split 2 Columns (Text Left + Image Right)
    Registry.register({
        type: 'hero',
        variant: 'hero-01',
        name: 'Hero 01 — Hai Cột (Văn bản & Hình ảnh)',
        category: 'Hero',
        keywords: ['hero', 'split', 'image-right', 'cta-group'],
        layoutHints: { columns: 2, imagePosition: 'right', alignment: 'left' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-hero') : 'sec-hero-01';
            return {
                type: 'builder-section',
                sectionType: 'hero',
                variant: 'hero-01',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-hero-01'],
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
                                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-5'],
                                                components: [
                                                    {
                                                        type: 'builder-heading',
                                                        tagName: 'h1',
                                                        role: 'section-title',
                                                        content: 'Đẳng Cấp Du Thuyền Hạng Sang',
                                                        classes: ['hero-title']
                                                    },
                                                    {
                                                        type: 'builder-paragraph',
                                                        role: 'section-description',
                                                        content: 'Khám phá bộ sưu tập du thuyền sang trọng hàng đầu với thiết kế hoàn mỹ và dịch vụ đẳng cấp quốc tế.',
                                                        classes: ['section-description']
                                                    },
                                                    {
                                                        type: 'builder-stack',
                                                        role: 'action-group',
                                                        classes: ['builder-stack', 'builder-flex-row', 'builder-gap-3', 'builder-align-center'],
                                                        components: [
                                                            {
                                                                type: 'builder-button',
                                                                role: 'primary-action',
                                                                content: 'Khám phá ngay',
                                                                classes: ['builder-btn', 'builder-btn-primary'],
                                                                attributes: { href: '#danh-muc', target: '_self' }
                                                            },
                                                            {
                                                                type: 'builder-button',
                                                                role: 'secondary-action',
                                                                content: 'Liên hệ tư vấn',
                                                                classes: ['builder-btn', 'builder-btn-secondary'],
                                                                attributes: { href: '#lien-he', target: '_self' }
                                                            }
                                                        ]
                                                    }
                                                ]
                                            }
                                        ]
                                    },
                                    {
                                        type: 'builder-column',
                                        components: [
                                            Helpers.placeholderImage ? Helpers.placeholderImage('Du thuyền sang trọng', 'general/hero-placeholder', ['builder-shadow-xl']) : {
                                                type: 'image',
                                                tagName: 'img',
                                                role: 'hero-image',
                                                classes: ['builder-img', 'builder-rounded-2xl', 'builder-shadow-xl'],
                                                attributes: { src: '/admin-assets/images/builder/hero-placeholder.svg', alt: 'Hero', loading: 'lazy' },
                                                mediaRef: 'general/hero-placeholder'
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

    // HERO 02: Centered Content on Dark Background
    Registry.register({
        type: 'hero',
        variant: 'hero-02',
        name: 'Hero 02 — Căn Giữa Nền Tối',
        category: 'Hero',
        keywords: ['hero', 'centered', 'dark-mode', 'single-cta'],
        layoutHints: { columns: 1, alignment: 'center', theme: 'dark' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-hero') : 'sec-hero-02';
            return {
                type: 'builder-section',
                sectionType: 'hero',
                variant: 'hero-02',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-hero-02'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container', 'builder-container-sm'],
                        components: [
                            {
                                type: 'builder-stack',
                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-6', 'builder-align-center', 'builder-text-center'],
                                components: [
                                    {
                                        type: 'builder-heading',
                                        tagName: 'h1',
                                        role: 'section-title',
                                        content: 'Trải Nghiệm Nghỉ Dưỡng Thượng Lưu',
                                        classes: ['hero-title-center']
                                    },
                                    {
                                        type: 'builder-paragraph',
                                        role: 'section-description',
                                        content: 'Hành trình vượt sóng cùng những mẫu du thuyền hiện đại và trang thiết bị tân tiến nhất.',
                                        classes: ['section-description', 'section-description-light']
                                    },
                                    {
                                        type: 'builder-button',
                                        role: 'primary-action',
                                        content: 'Xem bảng giá chi tiết',
                                        classes: ['builder-btn', 'builder-btn-primary'],
                                        attributes: { href: '#pricing', target: '_self' }
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
