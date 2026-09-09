/**
 * GrapesJS Video Component: builder-video
 * Embeds responsive YouTube / Vimeo or HTML5 video securely
 * Professional architectural & lighting showcase (No Rickroll)
 * Explicit toolbar with Delete / Clone / Move and iframe click protection
 */
(function (global) {
    'use strict';

    var DEFAULT_VIDEO_URL = 'https://www.youtube.com/embed/L_LUpnjgPso';

    function parseVideoUrl(rawUrl) {
        if (!rawUrl || typeof rawUrl !== 'string') return DEFAULT_VIDEO_URL;
        rawUrl = rawUrl.trim();

        // YouTube: match watch?v=, embed/, v/, youtu.be/, shorts/
        var ytMatch = rawUrl.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/))([\w-]{11})/);
        if (ytMatch && ytMatch[1]) {
            return 'https://www.youtube.com/embed/' + ytMatch[1];
        }

        // Vimeo: match vimeo.com/ID
        var vimeoMatch = rawUrl.match(/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)/);
        if (vimeoMatch && vimeoMatch[3]) {
            return 'https://player.vimeo.com/video/' + vimeoMatch[3];
        }

        if (rawUrl.indexOf('http://') === 0 || rawUrl.indexOf('https://') === 0) {
            return rawUrl;
        }

        return DEFAULT_VIDEO_URL;
    }

    function initVideoComponent(editor) {
        var DomComponents = editor.DomComponents;

        // Custom Delete Video Action Trait
        editor.TraitManager.addType('video-delete-action', {
            createInput: function ({ trait, component }) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.style.cssText = 'width: 100%; padding: 8px 12px; background: #dc2626; color: #ffffff; font-weight: 700; font-size: 12px; border: none; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 10px; transition: background 0.15s ease;';
                btn.innerHTML = '<svg viewBox="0 0 24 24" width="14" height="14" style="fill:currentColor;"><path d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12Z"/></svg> <span>Xóa video này khỏi trang</span>';
                btn.addEventListener('mouseover', function () { btn.style.background = '#b91c1c'; });
                btn.addEventListener('mouseout', function () { btn.style.background = '#dc2626'; });
                btn.addEventListener('click', function () {
                    var target = trait.target || component || editor.getSelected();
                    if (target && target.remove) {
                        target.remove();
                    }
                });
                return btn;
            }
        });

        DomComponents.addType('builder-video', {
            model: {
                defaults: {
                    name: 'Video (Media Player)',
                    tagName: 'div',
                    droppable: false,
                    selectable: true,
                    hoverable: true,
                    removable: true,
                    copyable: true,
                    draggable: true,
                    classes: ['builder-video-wrapper'],
                    style: {
                        'position': 'relative',
                        'width': '100%',
                        'max-width': '100%',
                        'aspect-ratio': '16/9',
                        'background-color': '#0f172a',
                        'border-radius': '12px',
                        'overflow': 'hidden',
                        'box-shadow': '0 10px 25px rgba(0,0,0,0.15)',
                        'margin': '20px 0'
                    },
                    toolbar: [
                        {
                            attributes: { title: 'Chọn phần tử cha' },
                            command: function (t) { return t.runCommand('core:component-exit', { force: 1 }); },
                            label: '<svg viewBox="0 0 24 24" width="16" height="16" style="fill:currentColor;display:block;"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>'
                        },
                        {
                            attributes: { class: 'gjs-no-touch-actions', draggable: true, title: 'Di chuyển' },
                            command: 'tlb-move',
                            label: '<svg viewBox="0 0 24 24" width="16" height="16" style="fill:currentColor;display:block;"><path d="M13 6v5h5V7.75L22.25 12 18 16.25V13h-5v5h3.25L12 22.25 7.75 18H11v-5H6v3.25L1.75 12 6 7.75V11h5V6H7.75L12 1.75 16.25 6H13Z"/></svg>'
                        },
                        {
                            attributes: { title: 'Nhân bản' },
                            command: 'tlb-clone',
                            label: '<svg viewBox="0 0 24 24" width="16" height="16" style="fill:currentColor;display:block;"><path d="M19 21H8V7h11m0-2H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2m-3-4H4a2 2 0 0 0-2 2v14h2V3h12V1Z"/></svg>'
                        },
                        {
                            attributes: { title: 'Xóa video' },
                            command: 'tlb-delete',
                            label: '<svg viewBox="0 0 24 24" width="16" height="16" style="fill:currentColor;display:block;"><path d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12Z"/></svg>'
                        }
                    ],
                    components: [
                        {
                            tagName: 'iframe',
                            selectable: false,
                            hoverable: false,
                            badgable: false,
                            draggable: false,
                            removable: false,
                            copyable: false,
                            attributes: {
                                src: DEFAULT_VIDEO_URL,
                                title: 'Video giới thiệu dự án chiếu sáng LuxLight',
                                frameborder: '0',
                                allow: 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
                                allowfullscreen: 'true'
                            },
                            style: {
                                'position': 'absolute',
                                'top': '0',
                                'left': '0',
                                'width': '100%',
                                'height': '100%',
                                'border': '0'
                            }
                        }
                    ],
                    traits: [
                        {
                            type: 'text',
                            name: 'video-url',
                            label: 'Link Video YouTube / Vimeo',
                            placeholder: 'Dán link YouTube (watch, shorts, youtu.be...)',
                            default: DEFAULT_VIDEO_URL,
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'video-aspect',
                            label: 'Tỷ lệ khung hình (Aspect Ratio)',
                            options: [
                                { id: '16/9', label: 'Ngang chuẩn (16:9)' },
                                { id: '4/3', label: 'Truyền thống (4:3)' },
                                { id: '1/1', label: 'Vuông (1:1)' },
                                { id: '9/16', label: 'Dọc Shorts / Reels (9:16)' }
                            ],
                            default: '16/9',
                            changeProp: 1
                        },
                        {
                            type: 'video-delete-action',
                            name: 'video-delete',
                            label: 'Xóa khối'
                        }
                    ]
                },

                init: function () {
                    this.on('change:video-url', this.handleUrlChange);
                    this.on('change:video-aspect', this.handleAspectChange);
                },

                handleUrlChange: function () {
                    var rawUrl = this.get('video-url') || '';
                    var embedUrl = parseVideoUrl(rawUrl);

                    var iframe = this.components().at(0);
                    if (iframe) {
                        iframe.addAttributes({ src: embedUrl });
                    }
                },

                handleAspectChange: function () {
                    var aspect = this.get('video-aspect') || '16/9';
                    this.addStyle({ 'aspect-ratio': aspect });
                }
            }
        });
    }

    global.GrapesVideoComponent = { init: initVideoComponent };
})(window);
