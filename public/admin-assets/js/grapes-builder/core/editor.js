/**
 * GrapesJS Core Editor Initialization
 *
 * The editor chrome is GrapesJS's own (see core/panels.js): its Panels module
 * owns the top bar, the right-hand views column and the canvas placement. This
 * file only configures the editor and wires the behaviour GrapesJS has no
 * opinion about — loading, saving, and canvas/frontend parity.
 *
 * Two properties it is responsible for:
 *
 *  1. The canvas renders the page as the public site does. It loads the
 *     frontend stylesheet manifest (config/theme.php, handed over as
 *     `config.canvasStyles`) rather than a hand-maintained subset, and applies
 *     the site's <body> classes. Admin/Tailwind CSS is deliberately NOT loaded
 *     into the canvas — its resets restyled the Elementor markup.
 *
 *  2. Editing does not corrupt the document. See loadInitialContent() and
 *     bindDirtyTracking() for the specific failure modes that used to bite.
 */
(function (global) {
    'use strict';

    // Used only if the server did not hand over a manifest (should not happen).
    var FALLBACK_CANVAS_STYLES = [
        '/wp-content/plugins/elementor/assets/css/frontend.min.css',
        '/wp-content/plugins/custom-lux/assets/custom.css',
        '/theme/site-inline.css'
    ];

    function toast(icon, title, text) {
        if (!global.Swal) {
            if (icon === 'error') console.error(title, text || '');
            return;
        }
        global.Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            title: title,
            text: text || undefined,
            showConfirmButton: false,
            timer: icon === 'error' ? 6000 : 2500,
            timerProgressBar: true
        });
    }

    function createEditor(config) {
        config = config || {};

        var canvasStyles = (config.canvasStyles && config.canvasStyles.length)
            ? config.canvasStyles
            : FALLBACK_CANVAS_STYLES;

        var editor = grapesjs.init({
            container: '#gjs-container',
            height: '100%',
            width: 'auto',
            fromElement: false,

            // We drive loading and the unload prompt ourselves.
            noticeOnUnload: false,

            storageManager: {
                type: 'laravel',
                autosave: false,
                // Manual: loadInitialContent() below owns the load sequence.
                // Leaving this on made GrapesJS load the project a second time,
                // on top of our load, which duplicated undo steps and marked a
                // freshly-opened page as dirty.
                autoload: false
            },

            blockManager: {},
            layerManager: {},
            traitManager: {},
            selectorManager: { componentFirst: true },

            parser: {
                // GrapesJS calls a container a `text` component when every one
                // of its children is already textual. Its default textTypes
                // includes 'text' itself, so the verdict cascades upward: on an
                // Elementor page, where each widget nests its copy in several
                // divs, a whole card — background image, heading, button —
                // collapses into a single text blob. Clicking it opens the rich
                // text editor and nothing inside can be selected or restyled.
                //
                // Dropping 'text' stops the cascade at the element that really
                // holds the text. Inline formatting is unaffected: those tags
                // are matched through textTags below, extended with the inline
                // elements this theme actually uses.
                textTypes: ['textnode', 'comment'],
                textTags: [
                    'br', 'b', 'i', 'u', 'a', 'ul', 'ol',
                    'strong', 'em', 'span', 'small', 'sub', 'sup', 'mark', 'code'
                ]
            },

            styleManager: {
                sectors: global.GrapesStyleSectors
                    ? global.GrapesStyleSectors.build()
                    : []
            },

            deviceManager: {
                devices: [
                    { id: 'desktop', name: 'Desktop', width: '' },
                    { id: 'tablet', name: 'Tablet', width: '768px', widthMedia: '1024px' },
                    { id: 'mobile', name: 'Mobile', width: '375px', widthMedia: '767px' }
                ]
            },

            panels: {
                defaults: global.GrapesPanels ? global.GrapesPanels.definitions(config) : undefined
            },

            canvas: {
                styles: canvasStyles,
                // Iconify only: it renders the icons used by this builder's own
                // section blocks. The theme's own JS (jQuery/Elementor/Swiper)
                // is intentionally not run inside the canvas — it rewrites the
                // DOM behind GrapesJS's back and desynchronises the model.
                scripts: [
                    'https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js'
                ]
            }
        });

        // --- Adapters ------------------------------------------------------
        if (global.GrapesLaravelStorage) global.GrapesLaravelStorage.init(editor, config);
        if (global.GrapesMediaAdapter) global.GrapesMediaAdapter.init(editor, config);

        // --- Basic components ----------------------------------------------
        if (global.GrapesHeadingComponent) global.GrapesHeadingComponent.init(editor);
        if (global.GrapesParagraphComponent) global.GrapesParagraphComponent.init(editor);
        if (global.GrapesLinkComponent) global.GrapesLinkComponent.init(editor);
        if (global.GrapesButtonComponent) global.GrapesButtonComponent.init(editor);
        if (global.GrapesImageComponent) global.GrapesImageComponent.init(editor);
        if (global.GrapesDividerComponent) global.GrapesDividerComponent.init(editor);
        if (global.GrapesSpacerComponent) global.GrapesSpacerComponent.init(editor);
        if (global.GrapesIconComponent) global.GrapesIconComponent.init(editor);
        if (global.GrapesVideoComponent) global.GrapesVideoComponent.init(editor);
        if (global.GrapesCustomHtmlComponent) global.GrapesCustomHtmlComponent.init(editor);

        // --- Layout components ----------------------------------------------
        if (global.GrapesSectionComponent) global.GrapesSectionComponent.init(editor);
        if (global.GrapesContainerComponent) global.GrapesContainerComponent.init(editor);
        if (global.GrapesColumnComponent) global.GrapesColumnComponent.init(editor);
        if (global.GrapesColumnsComponent) global.GrapesColumnsComponent.init(editor);
        if (global.GrapesGridComponent) global.GrapesGridComponent.init(editor);
        if (global.GrapesStackComponent) global.GrapesStackComponent.init(editor);

        // --- Blocks ----------------------------------------------------------
        if (global.GrapesBasicBlocks) global.GrapesBasicBlocks.init(editor);
        if (global.GrapesLayoutBlocks) global.GrapesLayoutBlocks.init(editor);
        if (global.GrapesContentWidgets) global.GrapesContentWidgets.init(editor);
        if (global.GrapesSectionBlocks) global.GrapesSectionBlocks.init(editor);
        if (global.GrapesDynamicBlocks) global.GrapesDynamicBlocks.init(editor);

        // --- Commands, panels, RTE, ID hygiene --------------------------------
        if (global.GrapesCommands) global.GrapesCommands.init(editor, config);
        if (global.GrapesPanels) global.GrapesPanels.init(editor, config);
        if (global.GrapesRte) global.GrapesRte.init(editor);
        if (global.GrapesImportedMarkup) global.GrapesImportedMarkup.init(editor);
        if (global.GrapesIdManager && global.GrapesIdManager.attachCloneHook) {
            global.GrapesIdManager.attachCloneHook(editor);
        }

        // Body classes and editor-only canvas CSS have to be re-applied on every
        // frame load: switching device rebuilds the iframe document from
        // scratch. The header/footer preview is handled by core/panels.js,
        // which also owns its toggle's state.
        //
        // `canvas:frame:load:body` and not `canvas:frame:load`: GrapesJS fires
        // the latter *before* its own renderHead() and renderBody(), so at that
        // point the head holds no theme stylesheets and the body holds no
        // wrapper — body classes landed on nothing and the injected <style> was
        // outranked by every sheet appended after it.
        // Direct DOM healing for all <img> tags inside the canvas iframe
        editor.on('canvas:frame:load:body', function () {
            if (global.GrapesCanvasContext) {
                global.GrapesCanvasContext.apply(editor, config);
            }
            healCanvasImages(editor);
            setTimeout(function () { healCanvasImages(editor); }, 100);
            setTimeout(function () { healCanvasImages(editor); }, 500);
        });

        loadInitialContent(editor, config);
        bindEditorBehaviour(editor);

        return editor;
    }

    function isPlaceholder(src) {
        if (!src || typeof src !== 'string') return true;
        var trimmed = src.trim();
        return trimmed === ''
            || trimmed.charAt(0) === '<'
            || trimmed.indexOf('data:image/svg+xml') === 0
            || trimmed.indexOf('/<svg') !== -1;
    }

    function healCanvasImages(editor) {
        try {
            var doc = editor.Canvas.getDocument();
            if (!doc) return;
            var origin = (global.location && global.location.origin) ? global.location.origin : '';
            var imgs = doc.querySelectorAll('img');
            imgs.forEach(function (img) {
                img.removeAttribute('loading');
                img.removeAttribute('decoding');
                var rawSrc = img.getAttribute('src');
                if (rawSrc && !isPlaceholder(rawSrc)) {
                    var resolvedSrc = rawSrc;
                    if (resolvedSrc.charAt(0) === '/' && origin) {
                        resolvedSrc = origin + resolvedSrc;
                    }
                    if (img.src !== resolvedSrc) {
                        img.src = resolvedSrc;
                    }
                    img.classList.remove('gjs-plh-image');
                }
            });
        } catch (canvasImgErr) {
            // ignore
        }
    }

    function traverseComponents(comp, callback) {
        if (!comp) return;
        callback(comp);
        var children = comp.components();
        if (children) {
            if (typeof children.forEach === 'function') {
                children.forEach(function (child) {
                    traverseComponents(child, callback);
                });
            } else if (Array.isArray(children)) {
                children.forEach(function (child) {
                    traverseComponents(child, callback);
                });
            } else if (children.models && Array.isArray(children.models)) {
                children.models.forEach(function (child) {
                    traverseComponents(child, callback);
                });
            }
        }
    }

    function reconcileImageComponents(editor) {
        try {
            var wrapper = editor.getWrapper();
            if (!wrapper) return;
            var origin = (global.location && global.location.origin) ? global.location.origin : '';

            traverseComponents(wrapper, function (c) {
                var tag = (c.get('tagName') || '').toLowerCase();
                var type = c.get('type');
                if (tag === 'img' || type === 'image') {
                    var attr = c.getAttributes() || {};
                    var rawSrc = '';
                    if (attr.src && !isPlaceholder(attr.src)) {
                        rawSrc = attr.src;
                    } else if (c.get('src') && !isPlaceholder(c.get('src'))) {
                        rawSrc = c.get('src');
                    }
                    if (rawSrc && typeof rawSrc === 'string') {
                        var resolvedSrc = rawSrc;
                        if (resolvedSrc.charAt(0) === '/' && origin) {
                            resolvedSrc = origin + resolvedSrc;
                        }
                        if (c.get('type') !== 'image') {
                            c.set('type', 'image');
                        }
                        c.set('src', resolvedSrc);
                        c.addAttributes({ src: resolvedSrc });
                    }
                }
            });

            healCanvasImages(editor);
        } catch (syncErr) {
            // ignore
        }
    }

    /**
     * Load order matters, and the old sequence had two document-corrupting bugs:
     *
     *   - setStyle(initialCss) ran unconditionally *after* loadProjectData(),
     *     replacing every rule the project data had just restored with the
     *     flattened published CSS. Styles silently reverted on reopen.
     *   - the load itself landed on the undo stack, so one Ctrl+Z on a freshly
     *     opened page wiped the whole document.
     *
     * Project data is the source of truth when present; the published HTML/CSS
     * pair is only a fallback for pages that predate the builder.
     */
    function loadInitialContent(editor, config) {
        var data = config.builderData;
        var hasProjectData = !!(data && typeof data === 'object'
            && Array.isArray(data.pages) && data.pages.length
            && data.pages.some(function (page) {
                return page.component != null || (Array.isArray(page.frames)
                    && page.frames.some(function (frame) { return frame.component != null; }));
            }));

        var loaded = false;

        if (hasProjectData) {
            try {
                var safe = (global.GrapesIdManager && global.GrapesIdManager.normalizeProjectData)
                    ? global.GrapesIdManager.normalizeProjectData(data)
                    : data;
                editor.loadProjectData(safe);
                loaded = true;
            } catch (err) {
                console.warn('Không đọc được builder_data, chuyển sang HTML đã xuất bản:', err);
            }
        }

        if (!loaded) {
            var safeHtml = (config.initialHtml || '').replace(/<img\b([^>]*?)\bloading=["']lazy["']/gi, '<img$1loading="eager"');
            editor.setComponents(safeHtml);
            // Only meaningful on this path — project data carries its own rules.
            if (config.initialCss) editor.setStyle(config.initialCss);
        }

        // Reconcile and synchronize all <img> components so images render reliably
        reconcileImageComponents(editor);
        healCanvasImages(editor);

        setTimeout(function () { healCanvasImages(editor); }, 100);
        setTimeout(function () { healCanvasImages(editor); }, 500);
        setTimeout(function () { healCanvasImages(editor); }, 1500);

        // Loading is not an edit: keep it off the undo stack and out of the
        // dirty state, otherwise every page opens "unsaved" and one undo is
        // enough to blank it.
        editor.UndoManager.clear();
        editor.clearDirtyCount();
    }

    function bindEditorBehaviour(editor) {
        bindDirtyTracking(editor);

        // Ctrl+S saves. GrapesJS already binds undo/redo, copy/paste and delete.
        window.addEventListener('keydown', function (e) {
            if (!(e.ctrlKey || e.metaKey)) return;
            if ((e.key || '').toLowerCase() !== 's') return;
            e.preventDefault();
            editor.runCommand('core:save-draft');
        });

        // Surface storage failures instead of swallowing them.
        editor.on('storage:error', function (err) {
            toast('error', 'Lưu thất bại', (err && err.message) || 'Không rõ nguyên nhân.');
        });

    }

    /**
     * The old dirty flag was armed before the document finished loading, so the
     * component:add events emitted *by the load itself* flagged an untouched
     * page as modified and every navigation away raised a bogus
     * "unsaved changes" prompt. Arm it only once the editor is idle.
     */
    function bindDirtyTracking(editor) {
        var isDirty = false;
        var armed = false;

        editor.on('load', function () {
            reconcileImageComponents(editor);
            healCanvasImages(editor);
            // A tick after load: loadProjectData's own events have drained.
            setTimeout(function () {
                reconcileImageComponents(editor);
                healCanvasImages(editor);
                armed = true;
                isDirty = false;
            }, 50);
            setTimeout(function () {
                healCanvasImages(editor);
            }, 300);
        });

        editor.on('component:update component:add component:remove style:update trait:value', function () {
            if (armed) isDirty = true;
        });

        editor.on('storage:after:store builder:published', function () {
            isDirty = false;
        });

        // core:back-to-pages needs to know whether to warn before navigating.
        editor.isDirty = function () { return isDirty; };

        window.addEventListener('beforeunload', function (e) {
            if (!isDirty) return;
            e.preventDefault();
            e.returnValue = 'Bạn có thay đổi chưa lưu trong Visual Page Builder. Bạn có chắc muốn rời đi?';
            return e.returnValue;
        });
    }

    global.GrapesEditor = {
        init: function (config) {
            try {
                return createEditor(config);
            } catch (err) {
                console.error('Không khởi tạo được trình thiết kế:', err);
                toast('error', 'Không mở được trình thiết kế', err && err.message);
                throw err;
            }
        }
    };
})(window);
