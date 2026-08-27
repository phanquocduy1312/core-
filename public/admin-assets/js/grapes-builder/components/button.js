/**
 * GrapesJS Button Component: builder-button
 * Semantic <a> with modern styling, variants, and link traits
 */
(function (global) {
    'use strict';

    function initButtonComponent(editor) {
        var DomComponents = editor.DomComponents;
        var CT = global.GrapesCommonTraits || {};

        DomComponents.addType('builder-button', {
            model: {
                defaults: {
                    name: 'Nút bấm (Button)',
                    tagName: 'a',
                    droppable: false,
                    editable: true,
                    content: 'Nhấp để hành động',
                    attributes: {
                        href: '#',
                        target: '_self'
                    },
                    classes: ['inline-flex', 'items-center', 'justify-center', 'font-bold', 'transition-all', 'duration-200', 'cursor-pointer'],
                    style: {
                        'background-color': '#e32326',
                        'color': '#ffffff',
                        'padding': '12px 24px',
                        'border-radius': '12px',
                        'text-decoration': 'none',
                        'display': 'inline-flex'
                    },
                    traits: [
                        {
                            type: 'text',
                            name: 'href',
                            label: 'Đường dẫn (URL / Link)',
                            placeholder: 'https://... hoặc #lien-he',
                            default: '#'
                        },
                        CT.linkTargetTrait ? CT.linkTargetTrait() : { type: 'text', name: 'target' },
                        {
                            type: 'select',
                            name: 'button-variant',
                            label: 'Kiểu nút (Variant)',
                            options: [
                                { id: 'primary', label: 'Chính (Đỏ Primary)' },
                                { id: 'dark', label: 'Màu tối (Dark Slate)' },
                                { id: 'outline', label: 'Đường viền (Outline)' },
                                { id: 'light', label: 'Màu nhạt (Light)' },
                                { id: 'white', label: 'Màu trắng (White Card)' }
                            ],
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'button-size',
                            label: 'Kích thước (Size)',
                            options: [
                                { id: 'sm', label: 'Nhỏ (Small: 8px 16px)' },
                                { id: 'md', label: 'Tiêu chuẩn (Medium: 12px 24px)' },
                                { id: 'lg', label: 'Lớn (Large: 16px 32px)' }
                            ],
                            changeProp: 1
                        },
                        CT.borderRadiusTrait ? CT.borderRadiusTrait() : { type: 'text', name: 'border-radius' },
                        CT.colorTrait ? CT.colorTrait('background-color', 'Màu nền', '#e32326') : { type: 'color', name: 'background-color' },
                        CT.colorTrait ? CT.colorTrait('color', 'Màu chữ', '#ffffff') : { type: 'color', name: 'color' }
                    ]
                },

                init: function () {
                    this.on('change:button-variant', this.handleVariant);
                    this.on('change:button-size', this.handleSize);
                    this.on('change:style-border-radius change:style-background-color change:style-color', this.handleStyles);
                },

                handleVariant: function () {
                    var v = this.get('button-variant');
                    if (v === 'primary') {
                        this.addStyle({ 'background-color': '#e32326', 'color': '#ffffff', 'border': 'none' });
                    } else if (v === 'dark') {
                        this.addStyle({ 'background-color': '#0f172a', 'color': '#ffffff', 'border': 'none' });
                    } else if (v === 'outline') {
                        this.addStyle({ 'background-color': 'transparent', 'color': '#e32326', 'border': '2px solid #e32326' });
                    } else if (v === 'light') {
                        this.addStyle({ 'background-color': '#f1f5f9', 'color': '#1e293b', 'border': 'none' });
                    } else if (v === 'white') {
                        this.addStyle({ 'background-color': '#ffffff', 'color': '#e32326', 'border': '1px solid #e2e8f0', 'box-shadow': '0 2px 4px rgba(0,0,0,0.05)' });
                    }
                },

                handleSize: function () {
                    var s = this.get('button-size');
                    if (s === 'sm') this.addStyle({ 'padding': '8px 16px', 'font-size': '12px' });
                    else if (s === 'md') this.addStyle({ 'padding': '12px 24px', 'font-size': '14px' });
                    else if (s === 'lg') this.addStyle({ 'padding': '16px 32px', 'font-size': '16px' });
                },

                handleStyles: function () {
                    var style = {};
                    if (this.get('style-border-radius')) style['border-radius'] = this.get('style-border-radius');
                    if (this.get('style-background-color')) style['background-color'] = this.get('style-background-color');
                    if (this.get('style-color')) style['color'] = this.get('style-color');
                    this.addStyle(style);
                }
            }
        });
    }

    global.GrapesButtonComponent = { init: initButtonComponent };
})(window);
