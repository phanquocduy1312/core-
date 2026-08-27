/**
 * GrapesJS Services Section Patterns: services-01, services-02
 * Composed 100% from M3 components with pure semantic classes & role metadata
 */
(function (global) {
    'use strict';

    var Registry = global.GrapesSectionRegistry;
    var Helpers = global.GrapesSectionHelpers || {};

    if (!Registry) return;

    function createServiceCard(iconName, title, desc) {
        return {
            type: 'builder-stack',
            role: 'service-item',
            classes: ['builder-service-card'],
            components: [
                {
                    type: 'builder-icon',
                    role: 'service-icon',
                    attributes: { icon: iconName || 'solar:shield-check-bold' },
                    classes: ['service-icon']
                },
                {
                    type: 'builder-heading',
                    tagName: 'h3',
                    role: 'service-title',
                    content: title || 'Tên dịch vụ',
                    classes: ['service-title']
                },
                {
                    type: 'builder-paragraph',
                    role: 'service-description',
                    content: desc || 'Mô tả chi tiết các tiện ích và giá trị vượt trội mang lại cho khách hàng.',
                    classes: ['section-description']
                },
                {
                    type: 'builder-button',
                    role: 'service-link',
                    content: 'Xem chi tiết →',
                    classes: ['builder-btn', 'builder-btn-outline'],
                    attributes: { href: '#', target: '_self' }
                }
            ]
        };
    }

    // SERVICES 01: 3 Service Cards Grid
    Registry.register({
        type: 'services',
        variant: 'services-01',
        name: 'Dịch vụ 01 — 3 Thẻ Dịch Vụ Nổi Bật',
        category: 'Dịch vụ',
        keywords: ['services', 'cards', '3-columns'],
        layoutHints: { columns: 3, itemType: 'card' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-services') : 'sec-services-01';
            return {
                type: 'builder-section',
                sectionType: 'services',
                variant: 'services-01',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-services-01'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-stack',
                                classes: ['builder-stack', 'builder-flex-col', 'builder-gap-3', 'builder-align-center', 'builder-text-center', 'builder-mb-12'],
                                components: [
                                    { type: 'builder-heading', tagName: 'h2', role: 'section-title', content: 'Dịch Vụ Cao Cấp Của Chúng Tôi', classes: ['section-title'] },
                                    { type: 'builder-paragraph', role: 'section-description', content: 'Cung cấp hệ sinh thái giải pháp toàn diện cho mọi nhu cầu sở hữu và trải nghiệm du thuyền.', classes: ['section-description', 'builder-container-sm'] }
                                ]
                            },
                            {
                                type: 'builder-grid',
                                classes: ['builder-grid-3'],
                                components: [
                                    createServiceCard('solar:crown-bold', 'Cho Thuê Du Thuyền', 'Hạm đội du thuyền đẳng cấp phục vụ tiệc, sự kiện và hải trình riêng tư.'),
                                    createServiceCard('solar:wrench-bold', 'Bảo Dưỡng Kỹ Thuật', 'Dịch vụ bảo trì, chăm sóc động cơ và thân vỏ theo tiêu chuẩn nhà sản xuất.'),
                                    createServiceCard('solar:compass-bold', 'Hải Trình Thiết Kế Riêng', 'Tư vấn và xây dựng lộ trình khám phá biển đảo theo yêu cầu cá nhân hóa.')
                                ]
                            }
                        ]
                    }
                ]
            };
        }
    });

    // SERVICES 02: 4 Feature Items Grid
    Registry.register({
        type: 'services',
        variant: 'services-02',
        name: 'Dịch vụ 02 — Lưới 4 Tính Năng',
        category: 'Dịch vụ',
        keywords: ['services', 'features', '4-columns', 'grid'],
        layoutHints: { columns: 4, itemType: 'feature-card' },
        create: function () {
            var sectionId = Helpers.uid ? Helpers.uid('sec-services') : 'sec-services-02';
            return {
                type: 'builder-section',
                sectionType: 'services',
                variant: 'services-02',
                attributes: { id: sectionId },
                classes: ['builder-section', 'section-services-02'],
                components: [
                    {
                        type: 'builder-container',
                        classes: ['builder-container'],
                        components: [
                            {
                                type: 'builder-grid',
                                classes: ['builder-grid-4'],
                                components: [
                                    createServiceCard('solar:shield-check-bold', 'An Toàn Tuyệt Đối', 'Trang thiết bị hàng hải tối tân và đội cứu hộ chuyên nghiệp.'),
                                    createServiceCard('solar:clock-circle-bold', 'Hỗ Trợ 24/7', 'Đội ngũ tư vấn và kỹ thuật viên luôn túc trực mọi lúc mọi nơi.'),
                                    createServiceCard('solar:wallet-money-bold', 'Chi Phí Minh Bạch', 'Cam kết giá gốc niêm yết và không phát sinh phụ phí ẩn.'),
                                    createServiceCard('solar:star-bold', 'Dịch Vụ 5 Sao', 'Tiêu chuẩn phục vụ thượng lưu đem lại sự hài lòng tối đa.')
                                ]
                            }
                        ]
                    }
                ]
            };
        }
    });
})(window);
