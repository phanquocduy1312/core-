# Acceptance Checklist

## Core compatibility

- Existing admin login/auth is reused.
- Existing permissions protect builder routes.
- Existing router/controller conventions are followed.
- Existing CSRF mechanism is preserved.
- No duplicate DB/auth/media framework was introduced unnecessarily.

## Builder UX

- Existing page opens in editor.
- Text can be edited.
- Component can be added.
- Block can be added.
- Section can be added.
- Elements can be reordered.
- Duplicate/delete work.
- Undo/redo work if enabled by the integration.
- Desktop/tablet/mobile preview works.

## Media

- Existing image can be replaced.
- New image can be uploaded.
- Existing media can be selected.
- Broken/source-domain hotlinks are not introduced.
- Upload validation is enforced server-side.

## Persistence

- Save persists to DB/application storage.
- Reload restores the same editable content.
- Draft does not unexpectedly overwrite published content.
- Publish updates the public version.
- Revision/history behavior follows the existing CMS when available.

## Dynamic PHP

- Dynamic component stores configuration only.
- Public output queries current data.
- Preview renders safely.
- Unknown dynamic component types are rejected/ignored safely.

## Frontend

- Public page uses the normal PHP layout.
- Metadata/SEO remains intact.
- Builder admin scripts are not loaded publicly.
- Responsive layout works.
- No source-site analytics/scripts/backend endpoints remain.

## Security

- Unauthorized users cannot load/save/publish.
- Save and upload endpoints require CSRF protection where applicable.
- User-controlled HTML is sanitized according to role/trust model.
- No arbitrary PHP execution is possible.
- File uploads cannot create executable server files.
