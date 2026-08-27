---
name: php-vvveb-builder
description: Integrate, extend, and use VvvebJs as a visual UI/UX page builder inside an existing PHP admin core, while preserving the project's router, auth, permissions, database, media, layouts, and frontend conventions. Use for adding drag-and-drop page editing, components/blocks/sections, image replacement/media integration, save/load/publish, dynamic PHP blocks, responsive editing, or for converting an authorized/reference website into the project's Vvveb-compatible page structure. Also use when maintaining or extending an existing VvvebJs integration in a PHP project.
---

# PHP Vvveb Builder

Treat VvvebJs as the **editor engine**, not as a replacement CMS. Preserve the existing PHP application's architecture and adapt VvvebJs to it.

## Core rules

1. **Existing Core First.** Reuse the project's router, controllers, auth, permissions, CSRF, database layer, admin shell, media/upload system, helpers, logging, and coding conventions whenever they exist.
2. **Do not create a parallel admin stack.** Never introduce a second auth system, router, database wrapper, media library, or admin layout merely because the Vvveb demo includes one.
3. **Frontend stays PHP-rendered.** Do not convert the public site to React/Vue/Next.js. VvvebJs edits page markup; PHP remains responsible for routing, dynamic data, permissions, SEO, and final delivery.
4. **Vendor VvvebJs separately.** Keep upstream VvvebJs files isolated from company overrides. Put custom integration code, components, sections, adapters, and styles outside the vendor directory so updates remain manageable.
5. **Inspect the installed VvvebJs version before coding against internals.** Upstream APIs and names can change. For example, recent upstream history renamed `saveAjax` to `save`. Prefer the vendored source/API actually present in the project over remembered examples.
6. **Never hotlink cloned/reference-site assets.** For an authorized clone/rebuild workflow, import permitted assets into the project's media system and rewrite URLs locally.
7. **Do not blindly copy third-party backend code, analytics, trackers, forms, secrets, or scripts.** Recreate only the intended visual/functional behavior within the local PHP architecture.

## Start every integration by inspecting the project

When code execution is available, run:

```bash
python scripts/inspect_php_core.py /path/to/project
```

Use the report to identify the real conventions before proposing or editing files.

Confirm at minimum:

- public/document root
- router and route registration
- base admin controller
- authentication/authorization middleware
- CSRF pattern
- database/model/repository pattern
- admin view/layout system
- asset bundling/loading
- upload/media service
- page/content tables or migrations
- existing cache and publish behavior

If a feature already exists, adapt to it instead of recreating it.

Read `references/architecture.md` for the target architecture and persistence rules.

## Decide the task path

### A. Add VvvebJs to an existing PHP admin

Follow `references/integration-workflow.md`.

Primary outcome:

- `/admin/.../builder` opens inside the existing admin authorization model
- VvvebJs loads editable page content
- Save writes to the project's database/service layer, not arbitrary files
- image selection/upload uses the existing media system when available
- preview/publish use existing page lifecycle conventions
- public frontend renders the published result through PHP

### B. Add or customize builder blocks/components/sections

Use the native concepts intentionally:

- **Component**: an editable HTML element or widget with properties.
- **Block**: a reusable draggable content fragment.
- **Section**: a larger predefined horizontal page slice/layout.
- **Dynamic PHP block**: a builder-visible placeholder/configuration whose live content is resolved by PHP from application data.

Read `references/vvveb-extension-patterns.md` before adding custom extensions.

### C. Convert a reference/authorized website into the builder structure

Follow `references/clone-to-builder.md`.

The output must be builder-native rather than a pile of one-off files. Prefer:

1. reuse an existing component/section/block when structurally compatible;
2. create a new variant when the content model is the same but design differs;
3. create a new reusable component/section only when necessary;
4. keep dynamic business data in PHP/database queries, not hardcoded copied HTML.

## Persistence contract

VvvebJs is HTML-oriented. Do not pretend it natively uses GrapesJS-style project JSON.

Default persistence model:

- store editable builder HTML/content in the database;
- store page-level/custom CSS separately when the integration needs it;
- store builder metadata separately when needed (version, template, enabled assets, block settings, revision info);
- keep `draft` and `published` states separate if the existing CMS supports publishing;
- preserve server-side dynamic placeholders/components in a controlled format that PHP resolves on output.

Prefer existing page/content tables. Add new tables only when the current schema cannot safely represent builder state.

Never allow arbitrary PHP code to be saved from the visual editor.

## Dynamic PHP content

For content such as posts, products, projects, services, categories, team members, forms, or other database-driven entities:

- expose a safe builder component/placeholder;
- store only configuration such as source, category, limit, ordering, variant, IDs, or filters;
- resolve actual records server-side in PHP;
- render safe preview content inside the editor without turning database records into permanent copied markup unless explicitly requested.

Keep a strict allowlist of dynamic component types and supported options.

## Media behavior

Make image editing feel like WordPress:

- click/select image;
- choose **Replace image**;
- open existing Media Library when available;
- upload new images through the project's upload endpoint/service;
- select existing media;
- save local media URL/ID mapping;
- support alt text where the project supports it.

If the core has no media manager, implement the smallest adapter needed for VvvebJs upload/gallery behavior; do not build a second full CMS unless requested.

## Frontend rendering

Choose the least invasive model compatible with the existing app:

1. Controller loads the published page record.
2. Resolve controlled dynamic placeholders/components in PHP.
3. Inject/render the resulting builder body inside the site's existing public layout.
4. Load only the theme/block assets required by that page where practical.
5. Preserve canonical tags, metadata, structured data, headers, breadcrumbs, and other PHP-managed SEO concerns.

Do not ship VvvebJs admin/editor JavaScript to public visitors.

## Security requirements

Always preserve or add:

- admin authentication and page-edit permission checks;
- CSRF protection on saves/uploads/publish actions;
- server-side validation of page IDs and ownership/scope;
- upload MIME/type/size validation;
- HTML sanitization appropriate to the project's trust model;
- restriction of arbitrary scripts, event-handler attributes, dangerous URLs, and executable uploads;
- path traversal protection;
- safe dynamic-block allowlists;
- no execution of PHP supplied through builder content.

Only expose raw HTML/custom JS to a privileged role if the product explicitly requires it.

## Quality gate before declaring completion

Run through `references/acceptance-checklist.md`.

At minimum verify:

- edit existing page
- add component/block/section
- reorder/delete/duplicate
- change text
- replace/upload image
- desktop/tablet/mobile preview
- save then reload without data loss
- preview draft
- publish and view public page
- dynamic PHP block still queries live data
- unauthorized admin cannot save
- public page loads without builder admin assets
- existing non-builder admin modules still work

## Deliverable style

When implementing in a repository:

- make actual code changes when tools permit;
- summarize reused existing services and newly added adapters;
- list migrations/endpoints only if actually needed;
- mention assumptions and compatibility risks;
- avoid proposing a new architecture when the current one already solves the concern.

When asked only for a plan, provide a file-level integration plan based on the inspected repository rather than generic pseudocode.

## References

- `references/architecture.md` — target architecture, boundaries, persistence, dynamic rendering.
- `references/integration-workflow.md` — step-by-step VvvebJs integration into an existing PHP admin.
- `references/vvveb-extension-patterns.md` — components, blocks, sections, media, and version-safe extension patterns.
- `references/clone-to-builder.md` — workflow for converting a permitted/reference website into builder-native structures.
- `references/acceptance-checklist.md` — completion and regression checks.
