/**
 * GrapesJS Gallery Section Patterns: gallery-01, gallery-02
 * Composed 100% from M3 components with pure semantic classes & role metadata
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesSectionRegistry;
    var Helpers = global.GrapesSectionHelpers || {};

    if (!Registry) return;

    function galleryImage(alt, mediaRef) {
        return {
            type: 'image',
            tagName: 'img',
            role: 'gallery-item',
            attributes: {
                src: '/admin-assets/images/builder/hero-placeholder.svg',
                alt: alt || 'Ảnh thư viện',
                loading: 'lazy'
            },
            mediaRef: mediaRef || 'general/hero-placeholder',
            classes: ['builder-gallery-img']
        };
    }

    // GALLERY 01: 4 Images Grid
    Registry.register({
        type: 'gallery',
        variant: 'gallery-01',
        name: 'Thư viện 01 — Lưới 4 Ảnh',
        category: 'Thư viện ảnh',
        keywords: ['gallery', 'photos', '4-columns'],
        layoutHints: { columns: 4, itemType: 'image' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-gallery') : 'sec-gallery-01';
            return {
                type: 'builder-section',
                sectionType: 'gallery',
                variant: 'gallery-01',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-gallery-01'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-stack',
                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-3', 'builder-align-center', 'builder-text-center', 'builder-mb-10'],
                                components: [
                                    { type: 'builder-heading', tagName: 'h2', role: 'section-title', content: 'Thư Viện Hình Ảnh & Video', classes: ['section-title'] },
                                    { type: 'builder-paragraph', role: 'section-description', content: 'Khoảnh khắc thực tế trong các chuyến hải trình cùng khách hàng.', classes: ['section-description', 'builder-container-sm'] }
                                ]
                            },
                            {
                                type: 'builder-grid',
                                classes: ['builder-grid-4'],
                                components: [
                                    galleryImage('Khoảnh khắc hoàng hôn', 'general/hero-placeholder'),
                                    galleryImage('Nội thất phòng khách du thuyền', 'general/hero-placeholder'),
                                    galleryImage('Boong tắm nắng', 'general/hero-placeholder'),
                                    galleryImage('Bữa tiệc tối trên biển', 'general/hero-placeholder')
                                ]
                            }
                        ]
                    }
                ]
            };
        }
    });

    // GALLERY 02: 6 Images Showcase Grid
    Registry.register({
        type: 'gallery',
        variant: 'gallery-02',
        name: 'Thư viện 02 — Lưới 6 Ảnh Toàn Cảnh',
        category: 'Thư viện ảnh',
        keywords: ['gallery', 'showcase', '6-images', '3-columns'],
        layoutHints: { columns: 3, itemType: 'image' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-gallery') : 'sec-gallery-02';
            return {
                type: 'builder-section',
                sectionType: 'gallery',
                variant: 'gallery-02',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-gallery-02'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-grid',
                                classes: ['builder-grid-3'],
                                components: [
                                    galleryImage('Ảnh 1', 'general/hero-placeholder'),
                                    galleryImage('Ảnh 2', 'general/hero-placeholder'),
                                    galleryImage('Ảnh 3', 'general/hero-placeholder'),
                                    galleryImage('Ảnh 4', 'general/hero-placeholder'),
                                    galleryImage('Ảnh 5', 'general/hero-placeholder'),
                                    galleryImage('Ảnh 6', 'general/hero-placeholder')
                                ]
                            }
                        ]
                    }
                ]
            };
        }
    });
})(window);
