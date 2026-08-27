/**
 * GrapesJS Contact Section Patterns: contact-01, contact-02
 * Composed 100% from M3 components with pure semantic classes & role metadata
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesSectionRegistry;
    var Helpers = global.GrapesSectionHelpers || {};

    if (!Registry) return;

    // CONTACT 01: Info Left + Visual Form Box Right
    Registry.register({
        type: 'contact',
        variant: 'contact-01',
        name: 'Liên hệ 01 — Thông Tin & Hộp Liên Hệ',
        category: 'Liên hệ',
        keywords: ['contact', 'form', 'info-split'],
        layoutHints: { columns: 2, splitRatio: '1:1' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-contact') : 'sec-contact-01';
            return {
                type: 'builder-section',
                sectionType: 'contact',
                variant: 'contact-01',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-contact-01'],
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
                                                role: 'contact-info-group',
                                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-5'],
                                                components: [
                                                    { type: 'builder-heading', tagName: 'h2', role: 'section-title', content: 'Kết Nối Với Chúng Tôi', classes: ['section-title'] },
                                                    { type: 'builder-paragraph', role: 'section-description', content: 'Chúng tôi luôn sẵn sàng lắng nghe và tư vấn giải pháp du thuyền hoàn hảo cho quý khách.', classes: ['section-description'] },
                                                    {
                                                        type: 'builder-stack',
                                                        classes: ['contact-info-row'],
                                                        components: [
                                                            { type: 'builder-icon', attributes: { icon: 'solar:phone-calling-bold' }, classes: ['contact-icon'] },
                                                            { type: 'builder-paragraph', content: 'Hotline: (+84) 90 123 4567', classes: ['contact-text'] }
                                                        ]
                                                    },
                                                    {
                                                        type: 'builder-stack',
                                                        classes: ['contact-info-row'],
                                                        components: [
                                                            { type: 'builder-icon', attributes: { icon: 'solar:letter-bold' }, classes: ['contact-icon'] },
                                                            { type: 'builder-paragraph', content: 'Email: info@sontungyacht.com', classes: ['contact-text'] }
                                                        ]
                                                    },
                                                    {
                                                        type: 'builder-stack',
                                                        classes: ['contact-info-row'],
                                                        components: [
                                                            { type: 'builder-icon', attributes: { icon: 'solar:map-point-bold' }, classes: ['contact-icon'] },
                                                            { type: 'builder-paragraph', content: 'Bến Du Thuyền Quốc Tế, TP. Hồ Chí Minh', classes: ['contact-text'] }
                                                        ]
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
                                                role: 'contact-form-box',
                                                classes: ['builder-contact-box'],
                                                components: [
                                                    { type: 'builder-heading', tagName: 'h3', content: 'Để Lại Thông Tin Yêu Cầu', classes: ['service-title'] },
                                                    { type: 'builder-paragraph', content: 'Chuyên viên tư vấn sẽ liên hệ lại với quý khách trong vòng 15 phút.', classes: ['section-description'] },
                                                    {
                                                        type: 'builder-button',
                                                        role: 'primary-action',
                                                        content: 'Gửi yêu cầu tư vấn',
                                                        classes: ['builder-btn', 'builder-btn-primary', 'builder-w-full'],
                                                        attributes: { href: '#', target: '_self' }
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

    // CONTACT 02: 3 Cards Grid
    Registry.register({
        type: 'contact',
        variant: 'contact-02',
        name: 'Liên hệ 02 — Lưới 3 Thẻ Thông Tin',
        category: 'Liên hệ',
        keywords: ['contact', 'cards', '3-columns', 'channels'],
        layoutHints: { columns: 3, itemType: 'contact-card' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-contact') : 'sec-contact-02';
            return {
                type: 'builder-section',
                sectionType: 'contact',
                variant: 'contact-02',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-contact-02'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-grid',
                                classes: ['builder-grid-3'],
                                components: [
                                    {
                                        type: 'builder-stack',
                                        role: 'contact-card',
                                        classes: ['builder-contact-card'],
                                        components: [
                                            { type: 'builder-icon', attributes: { icon: 'solar:phone-calling-bold' }, classes: ['service-icon'] },
                                            { type: 'builder-heading', tagName: 'h3', content: 'Điện Thoại', classes: ['service-title'] },
                                            { type: 'builder-paragraph', content: '(+84) 90 123 4567\nPhục vụ 24/7', classes: ['section-description'] }
                                        ]
                                    },
                                    {
                                        type: 'builder-stack',
                                        role: 'contact-card',
                                        classes: ['builder-contact-card'],
                                        components: [
                                            { type: 'builder-icon', attributes: { icon: 'solar:letter-bold' }, classes: ['service-icon'] },
                                            { type: 'builder-heading', tagName: 'h3', content: 'Hộp Thư', classes: ['service-title'] },
                                            { type: 'builder-paragraph', content: 'info@sontungyacht.com\ncontact@sontungyacht.com', classes: ['section-description'] }
                                        ]
                                    },
                                    {
                                        type: 'builder-stack',
                                        role: 'contact-card',
                                        classes: ['builder-contact-card'],
                                        components: [
                                            { type: 'builder-icon', attributes: { icon: 'solar:map-point-bold' }, classes: ['service-icon'] },
                                            { type: 'builder-heading', tagName: 'h3', content: 'Địa Chỉ Bến', classes: ['service-title'] },
                                            { type: 'builder-paragraph', content: 'Bến Du Thuyền Quốc Tế\nTP. Hồ Chí Minh', classes: ['section-description'] }
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
