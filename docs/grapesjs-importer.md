# GrapesJS Clone Importer Foundation Engine (v1.0.0-m7.1.2)

## 1. Architecture Overview

The Clone Importer is an isolated backend engine located under `app/Services/PageImporter/`. It strictly produces canonical, validated GrapesJS Project Data complying with the frozen Builder Contract (`schema_version = 1`).

```
app/Services/PageImporter/
├── Importer.php                 (Master Pipeline Orchestrator)
├── ImportContext.php            (Input Config, Strategy, Thresholds, Locale)
├── ImportResult.php             (Output Model with ProjectData, HTML, Report)
├── ImportReport.php             (Structured Diagnostic & Mapping Metrics)
├── SourceDocument.php           (Sanitized DOM, Meta, Stylesheets, Assets)
├── SourceFetcher.php            (SSRF Protection, Fixture Reader, Safe HTTP)
├── DomAnalyzer.php              (Tag Purging: Scripts, Inline Handlers, Trackers)
├── SectionClassifier.php        (Semantic Scoring, Card Grid Detection)
├── SectionMapper.php            (Predefined Variant Matching & Role Population)
├── ComponentMapper.php          (DOM to M3 Canonical Components, Anti-Explosion)
├── StyleExtractor.php           (Visual CSS Property Extraction & Sanitization)
├── ResponsiveMapper.php         (Breakpoint Normalization: 992px, 768px, 480px)
├── MediaImporter.php            (MIME Validation, Media Storage, Dedup)
├── ProjectBuilder.php           (GrapesJS Tree Assembly, ID Normalization, Orphan Filter)
├── ProjectValidator.php         (Strict Schema v1 & Component Allowlist Validation)
└── Exceptions/                  (ImporterException, SecurityException, ValidationException)
```

---

## 2. Style Target Binding & Zero Orphan Rules (M7.1.2 Contract)

1. **Exact Component $\leftrightarrow$ CSS Selector Binding:**
   Every class or ID referenced in `ProjectData.styles` must bind to a component present in the generated GrapesJS component tree.
2. **Orphan Style Filtering:**
   `ProjectBuilder::filterBoundStyles()` inspects all class names and IDs across the tree. Any unmapped or orphan CSS rule from the source document is stripped and logged to `ImportReport::$orphanStyleRules`.
3. **No Unstyled Components:**
   When an element possesses meaningful visual styles, its classes are merged into the target component (`component.classes`), ensuring the CSS rule immediately attaches in GrapesJS Canvas and public render.

---

## 3. Strict Safety & Security Boundaries

1. **SSRF Prevention:** `SourceFetcher` resolves target hostnames and validates that destination IPs do not fall into loopback (`127.0.0.1`, `::1`), private ranges (`10.0.0.0/8`, `172.16.0.0/12`, `192.168.0.0/16`), or cloud metadata endpoints (`169.254.169.254`).
2. **Purged Payloads:** All `<script>`, `<noscript>`, `<object>`, `<embed>`, inline event handlers (`onclick`, `onerror`, `onload`), and dangerous protocol links (`javascript:`, `data:`) are permanently removed during DOM analysis.
3. **MIME Sniffing & Media Storage:** Remote media is sniffed via `finfo_buffer()` on actual payload bytes. Fake headers with executable/HTML bodies are immediately rejected. Valid images are saved to target storage (`/storage/imported/{hash}.{ext}`) with canonical `mediaRef`.
4. **Draft-Only Persistence:** The importer **NEVER** auto-publishes pages. All imported pages are stored strictly in Draft mode (`is_active = false`, `published_at = null`), requiring manual visual review by an admin before publishing.

---

## 4. Developer Entrypoint & CLI Usage

Local fixtures can be imported directly via Artisan CLI:

```bash
php artisan page-builder:import-fixture tests/Fixtures/page-import/styled-landing.html --locale=vi
```

Options:
- `--locale`: Content locale (`vi`, `en`, `ko`). Defaults to `vi`.
- `--page`: Target Page ID if replacing an existing draft.
- `--threshold`: Confidence threshold for automatic section variant matching (Default: `0.70`).
