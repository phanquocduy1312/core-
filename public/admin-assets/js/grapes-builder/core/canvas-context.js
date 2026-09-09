/**
 * Canvas ⇄ frontend parity.
 *
 * The GrapesJS iframe starts as a bare document, so the theme's CSS only lands
 * the same way it does on the public site if we also replay:
 *
 *   1. the <body> classes the theme's rules are scoped against
 *      (elementor-kit-7, elementor-page, …) — without them every
 *      `.elementor-kit-7 h2 { … }` rule silently misses;
 *   2. the real header/footer around the editable region, so section padding,
 *      sticky offsets and above-the-fold framing read the way they will live.
 *
 * The header/footer are injected as plain DOM siblings of the GrapesJS wrapper.
 * They never enter the component tree, so editor.getHtml() — and therefore the
 * saved/published HTML — stays exactly the page body and nothing else.
 */
(function (global) {
    'use strict';

    var CHROME_ATTR = 'data-builder-chrome';
    var HELPER_STYLE_ID = 'gjs-builder-helpers';

    /**
     * Editor-only affordances. Every rule here is scoped to an editor attribute
     * or applies zero layout, so nothing it does can change how the page looks.
     */
    var HELPER_CSS = [
        /* Empty containers and columns: prominent, clean Elementor-style dropzones */
        '[data-gjs-highlightable]:empty {',
        '  min-height: 60px;',
        '  outline: 1px dashed rgba(59, 130, 246, 0.4);',
        '  outline-offset: -1px;',
        '}',
        '.builder-column:empty {',
        '  min-height: 90px !important;',
        '  outline: 1px dashed rgba(59, 130, 246, 0.45) !important;',
        '  outline-offset: -2px !important;',
        '  border-radius: 8px;',
        '  background: rgba(59, 130, 246, 0.02);',
        '  display: flex !important;',
        '  align-items: center;',
        '  justify-content: center;',
        '  cursor: pointer !important;',
        '  transition: all 0.2s ease !important;',
        '}',
        '.builder-column:empty:hover {',
        '  border-color: #00a0d2 !important;',
        '  background: rgba(0, 160, 210, 0.08) !important;',
        '  outline: 2px dashed #00a0d2 !important;',
        '}',
        '.builder-column:empty::after {',
        '  content: "➕ Nhấp hoặc thả widget vào cột";',
        '  color: #0284c7;',
        '  font-size: 13px;',
        '  font-weight: 700;',
        '  font-family: system-ui, -apple-system, sans-serif;',
        '  pointer-events: none;',
        '}',
        '.builder-container:empty {',
        '  min-height: 80px !important;',
        '  outline: 2px dashed rgba(148, 163, 184, 0.4) !important;',
        '  border-radius: 10px;',
        '  background: rgba(241, 245, 249, 0.4);',
        '  display: flex !important;',
        '  align-items: center;',
        '  justify-content: center;',
        '  cursor: pointer !important;',
        '  transition: all 0.2s ease !important;',
        '}',
        '.builder-container:empty:hover {',
        '  border-color: #00a0d2 !important;',
        '  background: rgba(0, 160, 210, 0.08) !important;',
        '  outline: 2px dashed #00a0d2 !important;',
        '}',
        '.builder-container:empty::after {',
        '  content: "➕ Nhấp để thêm Section hoặc Cột vào đây";',
        '  color: #0284c7;',
        '  font-size: 13px;',
        '  font-weight: 700;',
        '  font-family: system-ui, -apple-system, sans-serif;',
        '  pointer-events: none;',
        '}',
        '.builder-grid:empty {',
        '  min-height: 100px !important;',
        '  outline: 2px dashed rgba(59, 130, 246, 0.4) !important;',
        '  border-radius: 10px;',
        '  background: rgba(241, 245, 249, 0.4);',
        '  display: flex !important;',
        '  align-items: center;',
        '  justify-content: center;',
        '  cursor: pointer !important;',
        '  transition: all 0.2s ease !important;',
        '}',
        '.builder-grid:empty:hover {',
        '  border-color: #00a0d2 !important;',
        '  background: rgba(0, 160, 210, 0.08) !important;',
        '  outline: 2px dashed #00a0d2 !important;',
        '}',
        '.builder-grid:empty::after {',
        '  content: "➕ Nhấp để thêm thẻ hoặc widget vào lưới";',
        '  color: #0284c7;',
        '  font-size: 13px;',
        '  font-weight: 700;',
        '  font-family: system-ui, -apple-system, sans-serif;',
        '  pointer-events: none;',
        '}',
        '.builder-grid-item:empty {',
        '  min-height: 90px !important;',
        '  outline: 1px dashed rgba(59, 130, 246, 0.45) !important;',
        '  outline-offset: -2px !important;',
        '  border-radius: 8px;',
        '  background: rgba(59, 130, 246, 0.02);',
        '  display: flex !important;',
        '  align-items: center;',
        '  justify-content: center;',
        '  cursor: pointer !important;',
        '  transition: all 0.2s ease !important;',
        '}',
        '.builder-grid-item:empty:hover {',
        '  border-color: #00a0d2 !important;',
        '  background: rgba(0, 160, 210, 0.08) !important;',
        '  outline: 2px dashed #00a0d2 !important;',
        '}',
        '.builder-grid-item:empty::after {',
        '  content: "➕ Nhấp để thêm widget vào ô lưới";',
        '  color: #0284c7;',
        '  font-size: 13px;',
        '  font-weight: 700;',
        '  font-family: system-ui, -apple-system, sans-serif;',
        '  pointer-events: none;',
        '}',
        /* Video wrapper click protection in editor so toolbar with Delete button always appears */
        '.builder-video-wrapper iframe {',
        '  pointer-events: none !important;',
        '}',
        '.gjs-selected.builder-video-wrapper {',
        '  outline: 2px solid #3b82f6 !important;',
        '  outline-offset: 2px;',
        '}',
        /* Decorative Elementor background overlays: pass pointer events through so clicking selects the slide/section with the actual image */
        '.elementor-background-overlay {',
        '  pointer-events: none !important;',
        '}',
        /* Map wrapper click protection in editor so double-click and toolbar work reliably */
        '.builder-map-wrapper iframe {',
        '  pointer-events: none !important;',
        '}',
        '.gjs-selected.builder-map-wrapper {',
        '  outline: 2px solid #3b82f6 !important;',
        '  outline-offset: 2px;',
        '}',
        /* Custom HTML embed block: clear affordances in editor */
        '.builder-custom-embed {',
        '  cursor: pointer !important;',
        '}',
        '.builder-custom-embed:hover {',
        '  border-color: #00a0d2 !important;',
        '  background: rgba(0, 160, 210, 0.04) !important;',
        '}',
        '.gjs-selected.builder-custom-embed {',
        '  outline: 2px solid #00a0d2 !important;',
        '  outline-offset: 2px;',
        '}',
        /* Locked header/footer preview: inert to page clicks, but allows clicking the edit button */
        '[' + CHROME_ATTR + '] {',
        '  position: relative;',
        '  user-select: none;',
        '}',
        '[' + CHROME_ATTR + '] > *:not([' + CHROME_ATTR + '-action]) {',
        '  pointer-events: none;',
        '}',
        '[' + CHROME_ATTR + ']::after {',
        '  content: attr(data-builder-chrome-label);',
        '  position: absolute;',
        '  top: 0;',
        '  left: 0;',
        '  z-index: 999999;',
        '  background: rgba(15, 23, 42, 0.85);',
        '  color: #fff;',
        '  font: 700 10px/1 system-ui, sans-serif;',
        '  letter-spacing: 0.5px;',
        '  text-transform: uppercase;',
        '  padding: 4px 8px;',
        '  border-radius: 0 0 6px 0;',
        '  pointer-events: none;',
        '}',
        '[' + CHROME_ATTR + ']::before {',
        '  content: "";',
        '  position: absolute;',
        '  inset: 0;',
        '  z-index: 999997;',
        '  background: rgba(148, 163, 184, 0.08);',
        '  pointer-events: none;',
        '}',
        '[' + CHROME_ATTR + ']:hover::before {',
        '  background: rgba(227, 35, 38, 0.04);',
        '  outline: 2px dashed rgba(227, 35, 38, 0.4);',
        '  outline-offset: -2px;',
        '}',
        '[' + CHROME_ATTR + '-action] {',
        '  position: absolute;',
        '  top: 6px;',
        '  right: 12px;',
        '  z-index: 999999;',
        '  background: #e32326;',
        '  color: #ffffff !important;',
        '  font: 700 11px/1.2 system-ui, -apple-system, sans-serif;',
        '  padding: 6px 12px;',
        '  border-radius: 4px;',
        '  text-decoration: none !important;',
        '  box-shadow: 0 2px 8px rgba(0,0,0,0.3);',
        '  pointer-events: auto !important;',
        '  cursor: pointer !important;',
        '  display: inline-flex;',
        '  align-items: center;',
        '  gap: 4px;',
        '  transition: all 0.15s ease;',
        '}',
        '[' + CHROME_ATTR + '-action]:hover {',
        '  background: #b91c1c;',
        '  transform: translateY(-1px);',
        '  box-shadow: 0 4px 12px rgba(0,0,0,0.4);',
        '}',

        /* --------------------------------------------------------------
           Carousels, frozen on their first slide.

           Swiper/Slick collapse their slides onto one another at runtime.
           The canvas deliberately does not run the theme's JavaScript, so
           without this every slide of a hero slider lays out side by side at
           full width and one section eats the entire viewport — the page
           becomes impossible to read or edit. Showing slide 1 statically is
           what the visitor sees on load anyway.
           -------------------------------------------------------------- */
        '.swiper-wrapper, .slick-track {',
        '  display: block !important;',
        '  transform: none !important;',
        '  width: 100% !important;',
        '}',
        '.swiper-slide, .slick-slide {',
        '  display: none !important;',
        '}',
        '.swiper-slide:first-child, .slick-slide:first-child {',
        '  display: block !important;',
        '  width: 100% !important;',
        '  margin: 0 !important;',
        '  float: none !important;',
        '}',
        /* Navigation chrome for a carousel that cannot move is just noise. */
        '.swiper-button-next, .swiper-button-prev, .swiper-pagination,',
        '.slick-arrow, .slick-dots, .elementor-swiper-button {',
        '  display: none !important;',
        '}',
        /* Brand logo images in editor canvas (scoped to .brand-btn) */
        '.brand-btn .elementor-widget-image {',
        '  margin: 16px 0 10px 0 !important;',
        '  min-height: 42px !important;',
        '  display: flex !important;',
        '  align-items: center !important;',
        '  justify-content: flex-start !important;',
        '  background: transparent !important;',
        '  visibility: visible !important;',
        '  opacity: 1 !important;',
        '}',
        '.brand-btn .elementor-widget-image .elementor-widget-container {',
        '  display: flex !important;',
        '  align-items: center !important;',
        '  width: 100% !important;',
        '  background: transparent !important;',
        '  visibility: visible !important;',
        '  opacity: 1 !important;',
        '}',
        '.brand-btn .elementor-widget-image img {',
        '  max-height: 38px !important;',
        '  width: auto !important;',
        '  max-width: 160px !important;',
        '  object-fit: contain !important;',
        '  object-position: left center !important;',
        '  mix-blend-mode: multiply !important;',
        '  display: block !important;',
        '  background-color: transparent !important;',
        '  visibility: visible !important;',
        '  opacity: 1 !important;',
        '}',
        '.brand-btn .elementor-widget-divider {',
        '  margin: 10px 0 25px 0 !important;',
        '}',
        '.brand-btn .elementor-divider-separator {',
        '  border-top: 1px solid #DEDEDE !important;',
        '  width: 100% !important;',
        '}',
        'img.gjs-plh-image {',
        '  min-width: 60px !important;',
        '  min-height: 30px !important;',
        '}',
        '/* Base styles for builder-link and builder-btn */',
        '.builder-link {',
        '  color: #00a0d2;',
        '  text-decoration: underline;',
        '  font-weight: 600;',
        '  font-size: 15px;',
        '  cursor: pointer;',
        '  display: inline-block;',
        '  transition: all 0.2s ease;',
        '}',
        '.builder-btn {',
        '  background-color: #c5a880;',
        '  color: #ffffff;',
        '  padding: 14px 32px;',
        '  border-radius: 8px;',
        '  font-size: 15px;',
        '  font-weight: 600;',
        '  text-decoration: none;',
        '  display: inline-flex;',
        '  align-items: center;',
        '  justify-content: center;',
        '  gap: 8px;',
        '  box-shadow: 0 4px 14px rgba(197, 168, 128, 0.35);',
        '  border: 1px solid #c5a880;',
        '  cursor: pointer;',
        '  transition: all 0.2s ease;',
        '}'
    ].join('\n');

    function canvasDoc(editor) {
        try {
            return editor.Canvas.getDocument();
        } catch (err) {
            return null;
        }
    }

    function canvasBody(editor) {
        try {
            return editor.Canvas.getBody();
        } catch (err) {
            var doc = canvasDoc(editor);
            return doc ? doc.body : null;
        }
    }

    /**
     * The element GrapesJS renders the component tree into. Depending on the
     * version this is either the <body> itself or a wrapper node inside it.
     */
    function wrapperEl(editor) {
        var body = canvasBody(editor);

        try {
            if (typeof editor.Canvas.getWrapperEl === 'function') {
                var el = editor.Canvas.getWrapperEl();
                // Only trust it once it is actually in the document: called too
                // early it is a detached node, and insertBefore on its null
                // parentNode throws and aborts the whole mount.
                if (el && el.parentNode) return el;
            }
        } catch (err) { /* fall through */ }

        if (!body) return null;

        return body.querySelector('[data-gjs-type="wrapper"]') || body;
    }

    function injectBaseTag(editor) {
        var doc = canvasDoc(editor);
        if (!doc || !doc.head || doc.querySelector('base')) return;

        var base = doc.createElement('base');
        base.href = (global.location && global.location.origin ? global.location.origin : '') + '/';
        doc.head.insertBefore(base, doc.head.firstChild);
    }

    function injectHelperStyles(editor) {
        var doc = canvasDoc(editor);
        if (!doc || !doc.head || doc.getElementById(HELPER_STYLE_ID)) return;

        var style = doc.createElement('style');
        style.id = HELPER_STYLE_ID;
        style.textContent = HELPER_CSS;
        doc.head.appendChild(style);
    }

    function applyBodyClass(editor, bodyClass) {
        var body = canvasBody(editor);
        if (!body || !bodyClass) return;

        bodyClass.split(/\s+/).forEach(function (cls) {
            if (cls) body.classList.add(cls);
        });
    }

    function buildChrome(doc, html, position, label, editUrl) {
        var el = doc.createElement(position === 'header' ? 'header' : 'footer');
        el.setAttribute(CHROME_ATTR, position);
        el.setAttribute('data-builder-chrome-label', label);
        el.setAttribute('data-gjs-ignore', 'true');
        el.innerHTML = html;

        if (editUrl) {
            var actionBtn = doc.createElement('a');
            actionBtn.setAttribute('href', editUrl);
            actionBtn.setAttribute('target', '_blank');
            actionBtn.setAttribute(CHROME_ATTR + '-action', 'true');
            actionBtn.setAttribute('data-gjs-ignore', 'true');
            actionBtn.innerHTML = '✏️ Chỉnh sửa ' + (position === 'header' ? 'Header' : 'Footer');
            actionBtn.title = 'Mở trình thiết kế ' + (position === 'header' ? 'Header' : 'Footer') + ' trong tab mới để chỉnh sửa';
            el.appendChild(actionBtn);
        }

        return el;
    }

    /**
     * Mount (or remove) the locked header/footer preview.
     * Returns true when the chrome ended up visible.
     */
    function setChromeVisible(editor, config, visible) {
        var doc = canvasDoc(editor);
        var body = canvasBody(editor);
        var wrapper = wrapperEl(editor);
        if (!doc || !body) return false;

        // Always clear first so the toggle is idempotent.
        Array.prototype.slice.call(doc.querySelectorAll('[' + CHROME_ATTR + ']')).forEach(function (el) {
            el.parentNode.removeChild(el);
        });

        if (!visible) return false;

        var header = (config.canvasHeaderHtml || '').trim();
        var footer = (config.canvasFooterHtml || '').trim();
        if (!header && !footer) return false;

        // When the wrapper *is* the body, siblings are impossible — fall back to
        // first/last child. GrapesJS never re-reads the DOM, so the component
        // tree (and the exported HTML) is unaffected either way.
        var anchorParent = wrapper === body ? body : wrapper.parentNode;
        var isBodyWrapper = wrapper === body;

        if (header) {
            var headerEl = buildChrome(doc, header, 'header', 'Header — dùng chung website', config.headerBuilderUrl);
            if (isBodyWrapper) {
                body.insertBefore(headerEl, body.firstChild);
            } else {
                anchorParent.insertBefore(headerEl, wrapper);
            }
        }

        if (footer) {
            var footerEl = buildChrome(doc, footer, 'footer', 'Footer — dùng chung website', config.footerBuilderUrl);
            if (isBodyWrapper) {
                body.appendChild(footerEl);
            } else if (wrapper.nextSibling) {
                anchorParent.insertBefore(footerEl, wrapper.nextSibling);
            } else {
                anchorParent.appendChild(footerEl);
            }
        }

        return true;
    }



    function isChromeVisible(editor) {
        var doc = canvasDoc(editor);
        return !!(doc && doc.querySelector('[' + CHROME_ATTR + ']'));
    }

    /**
     * On the public site the page body sits inside <main class="site-main">, and
     * the theme spaces top-level sections with `.site-main > * { margin-top }`.
     * The canvas wrapper is a bare div, so without this the vertical rhythm in
     * the builder is visibly tighter than the live page.
     *
     * Applied to the DOM node, not the wrapper component, so it never reaches
     * editor.getHtml() and cannot leak into the saved markup.
     */
    function applyContentClass(editor, contentClass) {
        var wrapper = wrapperEl(editor);
        var body = canvasBody(editor);
        if (!wrapper || wrapper === body || !contentClass) return;

        contentClass.split(/\s+/).forEach(function (cls) {
            if (cls) wrapper.classList.add(cls);
        });
    }

    /**
     * Called on every canvas (re)load. The canvas is rebuilt on device switch
     * and on loadProjectData, so this has to be safe to run repeatedly.
     */
    function apply(editor, config) {
        injectBaseTag(editor);
        injectHelperStyles(editor);
        applyBodyClass(editor, config.canvasBodyClass);
        applyContentClass(editor, config.canvasContentClass);
    }

    global.GrapesCanvasContext = {
        apply: apply,
        setChromeVisible: setChromeVisible,
        isChromeVisible: isChromeVisible,
        wrapperEl: wrapperEl
    };
})(window);
