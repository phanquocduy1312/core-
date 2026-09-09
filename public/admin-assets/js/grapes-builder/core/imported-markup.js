/**
 * Makes imported Elementor markup behave like a page builder's own blocks.
 *
 * Two problems this solves, both measured on the LuxLight homepage:
 *
 *  1. Elementor paints most of its imagery as a CSS background on an otherwise
 *     empty <div> (.swiper-slide-bg, .separador, figure). GrapesJS's parser
 *     turns any element whose only child is a text node into an editable `text`
 *     component — whitespace counts — so clicking one of those image blocks
 *     opened the rich-text editor instead of selecting the block. There is no
 *     text to edit in them; the click should select.
 *
 *  2. Once selected, changing that image meant knowing to open Style Manager →
 *     Decorations → Ảnh nền. A toolbar button on the element itself is the
 *     gesture people expect from WordPress/Elementor.
 */
(function (global) {
    'use strict';

    var BG_URL_RE = /background(-image)?\s*:\s*[^;]*url\(/i;

    /**
     * Text carried by a component, ignoring markup. Read from the model rather
     * than the DOM so it works during `component:create`, before render.
     */
    function textContent(component) {
        var out = '';
        var children = component.components();
        if (!children || !children.length) return out;

        children.forEach(function (child) {
            if (child.get('type') === 'textnode') {
                out += child.get('content') || '';
            } else {
                out += textContent(child);
            }
        });

        return out;
    }

    /**
     * Does this component paint a background image? Checks the parsed style and
     * any inline style attribute the parser left behind.
     */
    function hasBackgroundImage(component) {
        var style = component.getStyle() || {};
        if (style['background-image'] || BG_URL_RE.test(style.background || '')) {
            return true;
        }

        var inline = (component.getAttributes() || {}).style || '';
        if (BG_URL_RE.test(inline)) return true;

        // Elementor keeps most section backgrounds in the page's own stylesheet
        // (post-<id>.css), not inline, so the model knows nothing about them.
        // The rendered element does. Only counts once the canvas has painted,
        // which is why the button is (re)resolved on selection.
        var el = component.getEl();
        if (!el || !el.ownerDocument || !el.ownerDocument.defaultView) return false;

        var painted = el.ownerDocument.defaultView.getComputedStyle(el).backgroundImage;

        // Gradients also land in background-image and are not replaceable art.
        return !!painted && painted !== 'none' && painted.indexOf('url(') !== -1;
    }

    function backgroundToolbarItem(resolveTarget, title) {
        return {
            attributes: {
                class: 'fa fa-picture-o',
                title: title || 'Đổi ảnh nền'
            },
            command: function (editor) {
                var target = resolveTarget ? resolveTarget() : editor.getSelected();
                if (!target) return;

                editor.AssetManager.open({
                    types: ['image'],
                    accept: 'image/*',
                    target: target,
                    select: function (asset) {
                        var src = typeof asset === 'string'
                            ? asset
                            : (typeof asset.getSrc === 'function'
                                ? asset.getSrc()
                                : (typeof asset.get === 'function' ? asset.get('src') : (asset.src || '')));
                        if (!src) return;
                        // addStyle bypasses the Style Manager's Property model,
                        // so the keyword has to be written by hand here — the
                        // theme's own rules are !important and would win.
                        target.addStyle({ 'background-image': "url('" + src + "') !important" });
                        try {
                            var sm = editor.StyleManager;
                            if (sm) {
                                var bgProp = sm.getProperty('decorations', 'background-image');
                                if (bgProp) bgProp.setValue("url('" + src + "')");
                            }
                        } catch (e) {}
                        editor.AssetManager.close();
                    }
                });
            }
        };
    }

    /**
     * `toolbar` is only populated once GrapesJS renders the default one, so add
     * to whatever is already there rather than replacing it.
     */
    function isBackgroundButton(item) {
        return !!(item.attributes && /^Đổi ảnh nền/.test(item.attributes.title || ''));
    }

    function setBackgroundButton(component, resolveTarget, title) {
        var toolbar = (component.get('toolbar') || []).filter(function (item) {
            return !isBackgroundButton(item);
        });

        if (resolveTarget) {
            toolbar.push(backgroundToolbarItem(resolveTarget, title));
        }

        component.set('toolbar', toolbar);
    }

    function addBackgroundButton(component) {
        setBackgroundButton(component, function () { return component; }, 'Đổi ảnh nền');
    }

    function tame(component) {
        if (!component || component.get('type') === 'wrapper') return;

        var blank = textContent(component).trim() === '';
        var painted = hasBackgroundImage(component);

        // A text component with nothing to type in is a click trap: selecting it
        // drops straight into the RTE. Only the editable flag is touched, so the
        // component keeps its type and GrapesJS's own behaviour otherwise.
        //
        // Restricted to text components on purpose. On an image `editable` is
        // what lets a double-click open the media library — an <img> has no
        // children, so an unguarded check reads it as blank and silently took
        // image replacement away.
        if (blank && component.get('type') === 'text' && component.get('editable')) {
            component.set('editable', false);
        }

        if (painted) {
            component.set('name', component.get('name') || 'Khối ảnh nền');
            addBackgroundButton(component);
        } else if (blank && component.get('type') === 'text') {
            component.set('name', component.get('name') || 'Khối');
        }
    }

    /**
     * Click again in the same spot to select the element one layer deeper.
     *
     * Elementor stacks its decoration layers: at the centre of a project card
     * sit six overlapping divs, and the one that actually carries the image is
     * the third of them. A click always lands on the topmost, so the background
     * controls looked empty and the image underneath was unreachable — there is
     * no gesture in GrapesJS for "the thing beneath this thing".
     *
     * First click behaves normally. Each further click at the same point walks
     * down the stack and then wraps around, so every layer is reachable without
     * hunting through the layer tree. The badge names whatever is selected, so
     * the walk is visible.
     */
    // Components under the most recent click, topmost first. Elementor stacks
    // its decoration layers as siblings, so the element carrying the visible
    // image is neither the clicked element nor one of its descendants — the
    // click stack is the only place it can be found.
    var lastStack = [];

    function enableStackDrilling(editor) {
        var SAME_SPOT = 5; // px
        var last = null;
        var depth = 0;

        function componentsUnder(doc, x, y) {
            var wrapperEl = editor.getWrapper().getEl();
            var all = editor.getWrapper().find('*');
            var seen = [];

            doc.elementsFromPoint(x, y).forEach(function (el) {
                if (!wrapperEl.contains(el)) return;

                for (var i = 0; i < all.length; i++) {
                    if (all[i].getEl() !== el) continue;
                    if (all[i].get('selectable') && seen.indexOf(all[i]) === -1) {
                        seen.push(all[i]);
                    }
                    break;
                }
            });

            return seen;
        }

        editor.on('canvas:frame:load:body', function () {
            var doc = editor.Canvas.getDocument();
            if (!doc || doc.__stackDrilling) return;
            doc.__stackDrilling = true;

            // GrapesJS selects on mousedown, and `component:selected` fires
            // there — before any click handler. The stack has to be recorded
            // this early or the selection handler sees a stale one.
            doc.addEventListener('mousedown', function (ev) {
                lastStack = componentsUnder(doc, ev.clientX, ev.clientY);
            }, true);

            // Capture phase: GrapesJS stops click propagation inside the
            // canvas (it has to, or every link in the page would navigate), so
            // a listener on the bubble phase is never reached. Capture runs
            // before that, and still after GrapesJS's own mousedown selection —
            // which is what lets this override the choice on repeat clicks.
            doc.addEventListener('click', function (ev) {
                // A double-click is two clicks in the same spot, and it means
                // "edit this text", not "go deeper". Leave it to GrapesJS.
                if (ev.detail > 1) return;

                var x = ev.clientX;
                var y = ev.clientY;
                var sameSpot = last
                    && Math.abs(last.x - x) <= SAME_SPOT
                    && Math.abs(last.y - y) <= SAME_SPOT;

                depth = sameSpot ? depth + 1 : 0;
                last = { x: x, y: y };

                // Let GrapesJS own the first click so normal selection, text
                // editing and drag handles keep working untouched.
                if (depth === 0) return;

                var stack = lastStack;
                if (stack.length < 2) return;

                if (depth >= stack.length) depth = 0;

                // GrapesJS runs its own selection later in the same click, so a
                // synchronous select here would be overwritten. Defer by a tick
                // to have the last word.
                var target = stack[depth];
                setTimeout(function () { editor.select(target); }, 0);
            }, true);
        });
    }

    /**
     * Offer the background-image action on whatever the user actually clicked.
     *
     * The layer holding a card's image is a sibling of the layer that receives
     * the click, so selecting the card gives a component with no background of
     * its own: the Style Manager's Ảnh nền field is empty and there is nothing
     * to act on. When exactly one layer under the cursor paints an image, put
     * the button on the selection and point it at that layer, so one click on
     * the picture is enough to replace it.
     */
    function offerBackgroundOfClickedStack(editor, component) {
        if (!component) return;

        // Resolved at selection time on purpose: only then is the element
        // rendered, so a background coming from the theme's stylesheet is
        // visible to getComputedStyle.
        if (hasBackgroundImage(component)) {
            setBackgroundButton(component, function () { return component; }, 'Đổi ảnh nền');
            return;
        }

        if (lastStack.indexOf(component) === -1) return;

        // elementsFromPoint is ordered topmost-first, so the first layer that
        // paints an image is the one visible under the cursor — the picture the
        // user just clicked on. Ancestors further down may paint their own
        // backgrounds; those are not what was clicked.
        var painted = null;
        for (var i = 0; i < lastStack.length; i++) {
            if (hasBackgroundImage(lastStack[i])) { painted = lastStack[i]; break; }
        }
        if (!painted || painted === component) return;

        setBackgroundButton(
            component,
            function () { return painted; },
            'Đổi ảnh nền (lớp ảnh bên dưới)'
        );
    }

    function init(editor) {
        // Runs for the initial import and for anything added later.
        editor.on('component:create', tame);

        editor.on('component:selected', function (component) {
            offerBackgroundOfClickedStack(editor, component);
        });

        // The initial setComponents() happens before this module can attach in
        // some load orders; sweep whatever is already on the canvas.
        editor.on('load', function () {
            editor.getWrapper().find('*').forEach(tame);
        });

        enableStackDrilling(editor);
    }

    global.GrapesImportedMarkup = { init: init };
})(window);
