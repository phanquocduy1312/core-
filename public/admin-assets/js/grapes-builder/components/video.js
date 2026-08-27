/**
 * GrapesJS Video Component: builder-video
 * Embeds responsive YouTube / Vimeo or HTML5 video securely
 */
(function (global) {
    'use strict';

    function initVideoComponent(editor) {
        var DomComponents = editor.DomComponents;

        DomComponents.addType('builder-video', {
            model: {
                defaults: {
                    name: 'Video (Media Video)',
                    tagName: 'div',
                    droppable: false,
                    classes: ['relative', 'w-full', 'overflow-hidden', 'rounded-2xl', 'shadow-lg'],
                    style: {
                        'aspect-ratio': '16/9',
                        'background-color': '#0f172a'
                    },
                    components: [
                        {
                            tagName: 'iframe',
                            attributes: {
                                src: 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                                title: 'Video player',
                                frameborder: '0',
                                allow: 'accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
                                allowfullscreen: 'true'
                            },
                            classes: ['w-full', 'h-full', 'border-0']
                        }
                    ],
                    traits: [
                        {
                            type: 'text',
                            name: 'video-url',
                            label: 'Đường dẫn Video (URL)',
                            placeholder: 'https://www.youtube.com/watch?v=...',
                            default: 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                            changeProp: 1
                        },
                        {
                            type: 'select',
                            name: 'video-aspect',
                            label: 'Tỷ lệ khung hình (Aspect Ratio)',
                            options: [
                                { id: '16/9', label: 'Ngang chuẩn 16:9' },
                                { id: '4/3', label: 'Truyền thống 4:3' },
                                { id: '1/1', label: 'Vuông 1:1' },
                                { id: '9/16', label: 'Dọc Shorts 9:16' }
                            ],
                            changeProp: 1
                        }
                    ]
                },

                init: function () {
                    this.on('change:video-url', this.handleUrlChange);
                    this.on('change:video-aspect', this.handleAspectChange);
                },

                handleUrlChange: function () {
                    var ytMatch = rawUrl.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/);
                    var vimeoMatch = rawUrl.match(/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)/);

                    if (ytMatch && ytMatch[1]) {
                        embedUrl = 'https://www.youtube.com/embed/' + ytMatch[1];
                    } else if (vimeoMatch && vimeoMatch[3]) {
                        embedUrl = 'https://player.vimeo.com/video/' + vimeoMatch[3];
                    } else {
                        // Fallback safe embed if non-whitelisted or invalid
                        embedUrl = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
                    }

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
