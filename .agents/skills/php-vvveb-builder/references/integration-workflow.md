# Integration Workflow

## 1. Inventory the core

Run `scripts/inspect_php_core.py` and inspect representative files. Identify the existing admin route/controller/view/auth/media patterns.

## 2. Vendor VvvebJs

Use the approved upstream release or repository version chosen by the team. Keep it under an isolated vendor/assets directory. Preserve the upstream license and notices.

Do not import the full Vvveb CMS when only VvvebJs is required.

## 3. Create the builder route

Use the existing router and admin middleware. Typical conceptual routes:

```text
GET  /admin/pages/{id}/builder
GET  /admin/pages/{id}/builder/content
POST /admin/pages/{id}/builder/save
POST /admin/pages/{id}/builder/publish
POST /admin/builder/media/upload
GET  /admin/builder/media
```

Names and verbs must follow the existing app's conventions.

## 4. Load editor content

Prefer loading the editable HTML from the database and passing it into VvvebJs. VvvebJs supports initializing a blank page then setting HTML via its builder API in versions that expose `Vvveb.Builder.setHtml(...)`.

Do not assume the exact API without checking the vendored version.

## 5. Save through the application

Obtain the current page HTML using the API exposed by the installed VvvebJs version (commonly `Vvveb.Builder.getHtml()`). POST it to the existing PHP application with CSRF/auth protection and store via the page service/repository.

Do not use Vvveb's demo `save.php` as production persistence when the application already has a database layer.

## 6. Integrate media

If the application already has media management, adapt Vvveb's file/image inputs to that service.

Required UX:

- existing media list
- upload
- choose
- replace
- alt text where available

## 7. Register company blocks/sections

Keep custom extension files separate from upstream. Register company-specific component groups, blocks, and sections after the core builder scripts load.

## 8. Support dynamic PHP blocks

Add safe components for business modules. Store only configuration. Render actual data through PHP both in preview and public output.

## 9. Preview and publish

Preview must render draft content in the normal public layout while requiring authorization or a signed preview token. Public routes must read published content only when draft/published separation exists.

## 10. Regression test

Run the acceptance checklist and ensure the existing admin remains unaffected.
