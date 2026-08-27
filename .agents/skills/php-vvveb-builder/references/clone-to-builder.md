# Clone / Reference Site -> Builder Workflow

Use only for sites the user is authorized to reproduce or use as a design/reference source.

## Objective

Translate the source website into reusable Vvveb-native components/blocks/sections that fit the existing PHP application. Do not dump a copied site into unrelated static files.

## 1. Inspect source structure

Identify:

- pages/routes
- global header/footer
- page sections
- repeated card patterns
- typography and design tokens
- responsive behavior
- images/icons/video
- dynamic-looking content such as posts/products/projects

## 2. Classify each region

For every region choose one:

- existing builder component
- existing builder block
- existing section variant
- new reusable variant
- new reusable section/component
- dynamic PHP component

Prefer reuse over proliferation.

## 3. Import assets

For permitted assets:

- download locally
- validate file type
- optimize according to project conventions
- import through media storage
- rewrite all URLs

Do not leave source-domain image URLs in production content.

## 4. Rebuild markup cleanly

Reproduce the intended layout using the project's semantic HTML and CSS conventions. Do not preserve unnecessary source classes, framework debris, analytics attributes, tracking IDs, script tags, or backend form endpoints.

## 5. Handle dynamic areas

Convert lists of projects/posts/products/etc. to dynamic builder components backed by PHP queries. The editor stores configuration, not a frozen copy of records.

## 6. Make it editable

Ensure the customer can change the things expected in a page builder:

- text
- images
- links/buttons
- section order
- reusable blocks/sections
- supported colors/styles
- responsive settings available in the current builder

## 7. Compare

Check desktop, tablet, and mobile against the reference. Fix reusable variants rather than one-off page hacks whenever possible.

## 8. Promote reusable patterns

If a newly created section is general enough, register it in the company block/section library so future projects can reuse it.
