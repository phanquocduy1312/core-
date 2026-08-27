<?php

namespace App\Services\PageImporter;

use Illuminate\Support\Str;

class ProjectBuilder
{
    private int $idCounter = 1;

    public function buildProjectData(array $sectionComponents, array $styles = [], ?string $pageId = null, ?ImportReport $report = null): array
    {
        $this->idCounter = 1;
        $normalizedSections = $this->assignUniqueIds($sectionComponents);

        // Filter and bind styles to ensure NO orphan rules
        $boundStyles = $report ? $this->filterBoundStyles($styles, $normalizedSections, $report) : $styles;

        return [
            'pages' => [
                [
                    'id' => $pageId ?: 'page-main',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => $normalizedSections,
                            ],
                        ],
                    ],
                ],
            ],
            'styles' => $boundStyles,
        ];
    }

    public function generateHtml(array $sectionComponents): string
    {
        $html = '';
        foreach ($sectionComponents as $sec) {
            $html .= $this->renderComponentToHtml($sec);
        }
        return $html;
    }

    public function generateCss(array $styles): string
    {
        $desktopCss = '';
        $mediaCss = [];

        foreach ($styles as $rule) {
            $selectors = implode(', ', $rule['selectors'] ?? []);
            if (! $selectors || empty($rule['style'])) continue;

            $props = '';
            foreach ($rule['style'] as $k => $v) {
                $props .= "  {$k}: {$v};\n";
            }
            $ruleBlock = "{$selectors} {\n{$props}}\n";

            $media = $rule['mediaText'] ?? null;
            if ($media) {
                if (! isset($mediaCss[$media])) {
                    $mediaCss[$media] = '';
                }
                $mediaCss[$media] .= $ruleBlock;
            } else {
                $desktopCss .= $ruleBlock;
            }
        }

        $finalCss = $desktopCss;
        foreach ($mediaCss as $mediaQuery => $blocks) {
            $finalCss .= "@media {$mediaQuery} {\n{$blocks}}\n";
        }

        return trim($finalCss);
    }

    public function filterBoundStyles(array $styles, array $components, ImportReport $report): array
    {
        $treeClasses = [];
        $treeIds = [];
        $this->collectTreeTargets($components, $treeClasses, $treeIds);

        $boundRules = [];
        $report->styleRulesGenerated = count($styles);

        foreach ($styles as $rule) {
            $selectors = $rule['selectors'] ?? [];
            $isBound = false;

            foreach ($selectors as $sel) {
                $sel = trim($sel);
                // Check class selector e.g. .hero-title
                if (str_starts_with($sel, '.')) {
                    $className = substr($sel, 1);
                    if (in_array($className, $treeClasses, true)) {
                        $isBound = true;
                        break;
                    }
                }
                // Check ID selector e.g. #hero
                if (str_starts_with($sel, '#')) {
                    $idName = substr($sel, 1);
                    if (in_array($idName, $treeIds, true)) {
                        $isBound = true;
                        break;
                    }
                }
            }

            if ($isBound) {
                $boundRules[] = $rule;
                $report->styleRulesBound++;
            } else {
                $report->orphanStyleRules++;
                $selStr = implode(', ', $selectors);
                $report->addWarning("Dropped orphan CSS selector: '{$selStr}' (no matching component found in tree)");
            }
        }

        $report->styledComponents = count($treeClasses) + count($treeIds);
        return $boundRules;
    }

    private function collectTreeTargets(array $components, array &$classes, array &$ids): void
    {
        foreach ($components as $comp) {
            if (! is_array($comp)) continue;

            if (! empty($comp['classes']) && is_array($comp['classes'])) {
                foreach ($comp['classes'] as $c) {
                    $classes[] = $c;
                }
            }

            if (! empty($comp['attributes']['id'])) {
                $ids[] = $comp['attributes']['id'];
            }

            if (! empty($comp['components']) && is_array($comp['components'])) {
                $this->collectTreeTargets($comp['components'], $classes, $ids);
            }
        }
        $classes = array_values(array_unique($classes));
        $ids = array_values(array_unique($ids));
    }

    private function assignUniqueIds(array $components): array
    {
        $result = [];
        foreach ($components as $comp) {
            if (is_array($comp)) {
                if (empty($comp['attributes']['id'])) {
                    $type = $comp['type'] ?? 'comp';
                    $comp['attributes']['id'] = 'el-' . $type . '-' . ($this->idCounter++);
                }
                if (! empty($comp['components']) && is_array($comp['components'])) {
                    $comp['components'] = $this->assignUniqueIds($comp['components']);
                }
                $result[] = $comp;
            }
        }
        return $result;
    }

    private function renderComponentToHtml(array $comp): string
    {
        $type = $comp['type'] ?? 'default';
        $idAttr = ! empty($comp['attributes']['id']) ? ' id="' . e($comp['attributes']['id']) . '"' : '';

        // 1. Dynamic Blocks
        if (str_starts_with($type, 'builder-dynamic-') || $type === 'builder-partial') {
            $dynamicType = $comp['dynamicType'] ?? '';
            $cfg = $comp['config'] ?? [];
            return \App\Support\DynamicBlockConfigValidator::serializeToHtml($dynamicType, $cfg);
        }

        // 2. Sections
        if ($type === 'builder-section') {
            $cls = implode(' ', $comp['classes'] ?? ['builder-section']);
            $inner = '';
            foreach ($comp['components'] ?? [] as $child) {
                $inner .= $this->renderComponentToHtml($child);
            }
            return "<section class=\"{$cls}\"{$idAttr}>{$inner}</section>";
        }

        // 3. Containers / Layout
        if (in_array($type, ['builder-container', 'builder-columns', 'builder-column', 'builder-grid', 'builder-stack'], true)) {
            $cls = implode(' ', $comp['classes'] ?? ['builder-' . $type]);
            $inner = '';
            foreach ($comp['components'] ?? [] as $child) {
                $inner .= $this->renderComponentToHtml($child);
            }
            return "<div class=\"{$cls}\"{$idAttr}>{$inner}</div>";
        }

        // 4. Headings
        if ($type === 'builder-heading') {
            $tag = $comp['tagName'] ?? 'h2';
            $cls = implode(' ', $comp['classes'] ?? ['builder-heading']);
            $content = e($comp['content'] ?? '');
            return "<{$tag} class=\"{$cls}\"{$idAttr}>{$content}</{$tag}>";
        }

        // 5. Paragraphs
        if ($type === 'builder-paragraph') {
            $tag = $comp['tagName'] ?? 'p';
            $cls = implode(' ', $comp['classes'] ?? ['builder-paragraph']);
            $content = e($comp['content'] ?? '');
            return "<{$tag} class=\"{$cls}\"{$idAttr}>{$content}</{$tag}>";
        }

        // 6. Buttons
        if ($type === 'builder-button') {
            $cls = implode(' ', $comp['classes'] ?? ['builder-btn', 'btn-primary']);
            $href = e($comp['attributes']['href'] ?? '#');
            $target = e($comp['attributes']['target'] ?? '_self');
            $content = e($comp['content'] ?? 'Xem Thêm');
            return "<a href=\"{$href}\" target=\"{$target}\" class=\"{$cls}\"{$idAttr}>{$content}</a>";
        }

        // 7. Images
        if ($type === 'image') {
            $cls = implode(' ', $comp['classes'] ?? ['builder-image']);
            $src = e($comp['attributes']['src'] ?? '');
            $alt = e($comp['attributes']['alt'] ?? '');
            $loading = e($comp['attributes']['loading'] ?? 'lazy');
            return "<img src=\"{$src}\" alt=\"{$alt}\" loading=\"{$loading}\" class=\"{$cls}\"{$idAttr} />";
        }

        // 8. Divider
        if ($type === 'builder-divider') {
            return "<hr class=\"builder-divider\"{$idAttr} />";
        }

        return '';
    }
}
