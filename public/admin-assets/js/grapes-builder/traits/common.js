/**
 * GrapesJS Shared Traits & Style Helpers
 * Reusable trait definitions for typography, spacing, alignment, colors, and layout
 */
(function (global) {
    'use strict';

    var CommonTraits = {
        alignTrait: function (defaultVal) {
            return {
                type: 'select',
                name: 'style-text-align',
                label: 'Căn lề (Align)',
                default: defaultVal || 'left',
                options: [
                    { id: 'left', label: 'Trái (Left)' },
                    { id: 'center', label: 'Giữa (Center)' },
                    { id: 'right', label: 'Phải (Right)' },
                    { id: 'justify', label: 'Đều 2 bên (Justify)' }
                ],
                changeProp: 1
            };
        },

        colorTrait: function (name, label, defaultVal) {
            return {
                type: 'color',
                name: 'style-' + (name || 'color'),
                label: label || 'Màu chữ (Color)',
                default: defaultVal || '',
                changeProp: 1
            };
        },

        fontSizeTrait: function (defaultVal) {
            return {
                type: 'select',
                name: 'style-font-size',
                label: 'Cỡ chữ (Font Size)',
                default: defaultVal || '',
                options: [
                    { id: '', label: 'Mặc định (Inherit)' },
                    { id: '12px', label: '12px (Rất nhỏ)' },
                    { id: '14px', label: '14px (Nhỏ)' },
                    { id: '16px', label: '16px (Chuẩn)' },
                    { id: '18px', label: '18px (Vừa)' },
                    { id: '20px', label: '20px (Lớn)' },
                    { id: '24px', label: '24px (H4)' },
                    { id: '30px', label: '30px (H3)' },
                    { id: '36px', label: '36px (H2)' },
                    { id: '48px', label: '48px (H1)' },
                    { id: '60px', label: '60px (Hero XL)' }
                ],
                changeProp: 1
            };
        },

        fontWeightTrait: function (defaultVal) {
            return {
                type: 'select',
                name: 'style-font-weight',
                label: 'Độ đậm chữ (Weight)',
                default: defaultVal || '',
                options: [
                    { id: '', label: 'Mặc định' },
                    { id: '300', label: 'Mảnh (Light 300)' },
                    { id: '400', label: 'Bình thường (Regular 400)' },
                    { id: '500', label: 'Vừa (Medium 500)' },
                    { id: '600', label: 'Bán đậm (SemiBold 600)' },
                    { id: '700', label: 'Đậm (Bold 700)' },
                    { id: '800', label: 'Rất đậm (ExtraBold 800)' },
                    { id: '900', label: 'Siêu đậm (Black 900)' }
                ],
                changeProp: 1
            };
        },

        spacingTrait: function (name, label, options) {
            return {
                type: 'select',
                name: 'style-' + name,
                label: label,
                options: options || [
                    { id: '', label: '0px' },
                    { id: '8px', label: '8px (Nhỏ)' },
                    { id: '16px', label: '16px (Vừa)' },
                    { id: '24px', label: '24px (Tiêu chuẩn)' },
                    { id: '32px', label: '32px (Rộng)' },
                    { id: '48px', label: '48px (Lớn)' },
                    { id: '64px', label: '64px (Rất lớn)' },
                    { id: '80px', label: '80px (Hero Padding)' }
                ],
                changeProp: 1
            };
        },

        borderRadiusTrait: function () {
            return {
                type: 'select',
                name: 'style-border-radius',
                label: 'Bo góc (Radius)',
                options: [
                    { id: '0px', label: 'Vuông vức (0px)' },
                    { id: '6px', label: 'Bo nhẹ (6px)' },
                    { id: '12px', label: 'Bo tròn vừa (12px)' },
                    { id: '16px', label: 'Bo tròn lớn (16px)' },
                    { id: '24px', label: 'Bo tròn 24px' },
                    { id: '9999px', label: 'Hình viên thuốc (Pill)' }
                ],
                changeProp: 1
            };
        },

        linkTargetTrait: function () {
            return {
                type: 'select',
                name: 'target',
                label: 'Mở tab mới',
                options: [
                    { id: '_self', label: 'Cùng tab (_self)' },
                    { id: '_blank', label: 'Tab mới (_blank)' }
                ]
            };
        }
    };

    global.GrapesCommonTraits = CommonTraits;
})(window);
