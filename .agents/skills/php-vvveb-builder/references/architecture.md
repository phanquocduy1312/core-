# Architecture Contract

## Goal

Embed VvvebJs into an existing PHP admin without replacing the application's core.

## Preferred boundaries

```text
Existing PHP App
├── Router / Middleware / Auth / CSRF
├── Admin layout
├── DB / Models / Repositories
├── Media / Uploads
├── Existing business modules
└── Page Builder Adapter
    ├── Builder controller/routes
    ├── Save/load/publish adapter
    ├── Media adapter
    ├── Dynamic component resolver
    ├── Custom Vvveb components/blocks/sections
    └── Vendor VvvebJs (isolated)
```

## Suggested file organization

Adapt names to the project rather than forcing this exact tree.

```text
app/
├── Controllers/Admin/PageBuilderController.php
├── Services/PageBuilderService.php
├── Services/BuilderMediaAdapter.php
├── Services/BuilderDynamicRenderer.php
└── Views/admin/builder/editor.php

public/
└── assets/builder/
    ├── vendor/vvvebjs/
    └── custom/
        ├── components.js
        ├── blocks.js
        ├── sections.js
        └── editor-overrides.css
```

## Persistence

VvvebJs edits HTML. Default to DB-backed HTML persistence rather than file writes.

Possible fields, only when existing schema lacks equivalents:

```text
builder_enabled
builder_draft_html
builder_published_html
builder_css
builder_meta_json
builder_version
published_at
```

If the app already has versioned page content, use that instead.

## Draft/publish

Preferred flow:

```text
Editor -> Save Draft -> Preview Draft -> Publish -> Public render
```

Do not overwrite published content on every editor keystroke unless that is already the CMS behavior.

## Dynamic components

Represent server-driven areas using controlled markup/metadata, for example:

```html
<div
  data-builder-dynamic="projects"
  data-limit="6"
  data-category="featured"
  data-variant="grid-01">
</div>
```

The exact representation is project-specific. Server-side code must parse only allowlisted attributes and replace the placeholder with a PHP-rendered view.

Never evaluate arbitrary PHP from builder HTML.

## Theme ownership

Global header/footer/navigation are normally PHP layout responsibilities. Only make them builder-editable if the product explicitly needs a theme builder.

## Upstream ownership

Keep VvvebJs vendor code replaceable. Patch upstream files only when unavoidable; document every patch. Prefer custom scripts loaded after upstream initialization.
