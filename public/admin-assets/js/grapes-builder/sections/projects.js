/**
 * GrapesJS Projects Section Patterns: projects-01, projects-02
 * Composed 100% from M3 components with pure semantic classes & role metadata
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesSectionRegistry;
    var Helpers = global.GrapesSectionHelpers || {};

    if (!Registry) return;

    function createProjectCard(title, category, mediaRef) {
        return {
            type: 'builder-stack',
            role: 'project-item',
            classes: ['builder-project-card'],
            components: [
                Helpers.placeholderImage ? Helpers.placeholderImage(title, mediaRef) : {
                    type: 'image',
                    tagName: 'img',
                    role: 'project-image',
                    classes: ['builder-img'],
                    attributes: { src: '/admin-assets/images/builder/hero-placeholder.svg', alt: title, loading: 'lazy' },
                    mediaRef: mediaRef || 'general/hero-placeholder'
                },
                {
                    type: 'builder-stack',
                    classes: ['project-card-body'],
                    components: [
                        {
                            type: 'builder-paragraph',
                            role: 'project-category',
                            content: category || 'Hạng Mục Du Thuyền',
                            classes: ['project-category']
                        },
                        {
                            type: 'builder-heading',
                            tagName: 'h3',
                            role: 'project-title',
                            content: title || 'Tên dự án nổi bật',
                            classes: ['project-title']
                        },
                        {
                            type: 'builder-button',
                            role: 'project-link',
                            content: 'Xem dự án →',
                            classes: ['builder-btn', 'builder-btn-outline'],
                            attributes: { href: '#', target: '_self' }
                        }
                    ]
                }
            ]
        };
    }

    // PROJECTS 01: 3 Project Cards Grid
    Registry.register({
        type: 'projects',
        variant: 'projects-01',
        name: 'Dự án 01 — Lưới 3 Dự Án Tiêu Biểu',
        category: 'Dự án',
        keywords: ['projects', 'portfolio', '3-columns'],
        layoutHints: { columns: 3, itemType: 'project-card' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-projects') : 'sec-projects-01';
            return {
                type: 'builder-section',
                sectionType: 'projects',
                variant: 'projects-01',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-projects-01'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-stack',
                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-3', 'builder-align-center', 'builder-text-center', 'builder-mb-12'],
                                components: [
                                    { type: 'builder-heading', tagName: 'h2', role: 'section-title', content: 'Bộ Sưu Tập & Dự Án Mới Nhất', classes: ['section-title'] },
                                    { type: 'builder-paragraph', role: 'section-description', content: 'Tổng hợp các dự án bàn giao du thuyền và hải trình thực tế đã thực hiện.', classes: ['section-description', 'builder-container-sm'] }
                                ]
                            },
                            {
                                type: 'builder-grid',
                                classes: ['builder-grid-3'],
                                components: [
                                    createProjectCard('Du Thuyền Majesty 120', 'Siêu du thuyền 2026', 'general/hero-placeholder'),
                                    createProjectCard('Du Thuyền Nomad 95', 'Du thuyền thám hiểm', 'general/hero-placeholder'),
                                    createProjectCard('Du Thuyền Oryx 379', 'Du thuyền thể thao', 'general/hero-placeholder')
                                ]
                            }
                        ]
                    }
                ]
            };
        }
    });

    // PROJECTS 02: Featured Left + 2 Cards Right
    Registry.register({
        type: 'projects',
        variant: 'projects-02',
        name: 'Dự án 02 — Dự Án Lớn & 2 Dự Án Phụ',
        category: 'Dự án',
        keywords: ['projects', 'featured', 'split'],
        layoutHints: { columns: 2, splitRatio: '1:1' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-projects') : 'sec-projects-02';
            return {
                type: 'builder-section',
                sectionType: 'projects',
                variant: 'projects-02',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-projects-02'],
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
                                            createProjectCard('Hải Trình Hạ Long Premium', 'Dự Án Trọng Điểm', 'general/hero-placeholder')
                                        ]
                                    },
                                    {
                                        type: 'builder-column',
                                        components: [
                                            {
                                                type: 'builder-stack',
                                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-6'],
                                                components: [
                                                    createProjectCard('Lễ Bàn Giao Sunseeker 74', 'Sự Kiện Bàn Giao', 'general/hero-placeholder'),
                                                    createProjectCard('Hải Trình Phú Quốc Sunset', 'Tour Riêng Tư', 'general/hero-placeholder')
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
