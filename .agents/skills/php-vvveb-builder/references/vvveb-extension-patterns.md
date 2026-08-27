# VvvebJs Extension Patterns

## Verify the installed version first

Inspect the vendored VvvebJs source and release notes before relying on method names. Upstream has changed API names across releases, including save-related functions.

Official upstream concepts include Components, Blocks, Sections, File Manager, Undo, inputs/properties, media upload/gallery, and `getHtml` processing events.

## Components

Use components for editable elements/widgets. Prefer `Vvveb.Components.add(...)` for new types or `Vvveb.Components.extend(...)` when extending existing behavior.

A component should define:

- stable unique name
- selector/node matching
- insertion HTML
- user-editable properties
- safe input types
- optional lifecycle callbacks only when required

Avoid putting business queries directly in browser-side component code.

## Sections

Use sections for large reusable page slices such as Hero, About, Services, Projects shell, CTA, Contact, or Footer-like layout fragments.

Vvveb's section API uses a unique ID plus metadata such as name, preview image, and HTML. Keep section HTML self-contained and theme-compatible.

## Blocks

Use blocks for reusable fragments smaller than a full page section. Group them by business purpose rather than by one-off customer names.

## Company variants

Prefer semantic IDs:

```text
company/hero/split-image
company/services/cards-3
company/projects/masonry
```

Do not use IDs like `client-a-home-section-4` unless it truly cannot be generalized.

## Properties

Expose only meaningful editable controls. Typical safe controls:

- text
- link
- image
- color/token
- alignment
- spacing presets
- select/toggle
- column count
- item limit
- variant

Avoid exposing arbitrary JavaScript or PHP.

## Save/load

Use the actual APIs from the vendored build. Common upstream patterns include:

```js
Vvveb.Builder.setHtml(html)
Vvveb.Builder.getHtml()
```

Treat these as examples to verify, not immutable contracts.

## Save processing events

If the installed version supports `vvveb.getHtml.before`, `vvveb.getHtml.after`, or `vvveb.getHtml.filter`, use them for deterministic cleanup/serialization rather than brittle DOM scraping outside the builder.

## Media

Vvveb provides image upload/media capabilities and file-upload input types. In a company CMS, route those operations through the existing media API instead of keeping the demo upload backend.

## Styling

Prefer existing site/theme CSS utilities and component CSS. Avoid generating large quantities of unstructured inline CSS where a reusable class/variant can represent the same design.
