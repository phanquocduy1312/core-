<?php

namespace App\Services\PageImporter;

use DOMElement;

class StyleExtractor
{
    private const ALLOWED_CSS_PROPERTIES = [
        'color', 'background-color', 'background',
        'padding', 'padding-top', 'padding-bottom', 'padding-left', 'padding-right',
        'margin', 'margin-top', 'margin-bottom', 'margin-left', 'margin-right',
        'font-size', 'font-weight', 'line-height', 'letter-spacing', 'text-align',
        'border', 'border-radius', 'border-color', 'box-shadow',
        'gap', 'display', 'max-width', 'width', 'min-height', 'height',
        'object-fit', 'object-position'
    ];

    /**
     * Extracts and sanitizes inline styles from a DOM element
     */
    public function extractInlineStyles(?string $styleString, ?ImportReport $report = null): array
    {
        if (! $styleString) return [];

        $styles = [];
        $declarations = explode(';', $styleString);

        foreach ($declarations as $decl) {
            $parts = explode(':', trim($decl), 2);
            if (count($parts) === 2) {
                $prop = strtolower(trim($parts[0]));
                $val = trim($parts[1]);

                if (in_array($prop, self::ALLOWED_CSS_PROPERTIES, true)) {
                    $cleanedVal = $this->sanitizeValue($val);
                    if ($cleanedVal !== '') {
                        $styles[$prop] = $cleanedVal;
                        if ($report) $report->stylesExtracted++;
                    }
                } else {
                    if ($report) $report->stylesDropped++;
                }
            }
        }

        return $styles;
    }

    /**
     * Parses CSS stylesheet text into structured CSS Composer rules
     *
     * @return array<array{selectors: array<string>, style: array<string, string>, mediaText: ?string}>
     */
    public function parseStylesheet(string $cssText, ResponsiveMapper $responsiveMapper, ?ImportReport $report = null): array
    {
        $rules = [];

        // 1. Extract @media blocks
        $mediaPattern = '/@media\s*([^{]+)\{((?:[^{}]+|\{[^{}]*\})+)\}/si';
        preg_match_all($mediaPattern, $cssText, $mediaMatches, PREG_SET_ORDER);

        foreach ($mediaMatches as $m) {
            $rawQuery = trim($m[1]);
            $innerCss = trim($m[2]);
            $targetMedia = $responsiveMapper->mapMediaQuery($rawQuery);

            if ($targetMedia) {
                $innerRules = $this->parseSimpleRules($innerCss, $report);
                foreach ($innerRules as $r) {
                    $r['mediaText'] = $targetMedia;
                    $rules[] = $r;
                    if ($report) $report->responsiveRulesMapped++;
                }
            }
        }

        // 2. Remove @media blocks and parse standard desktop rules
        $cleanCss = preg_replace($mediaPattern, '', $cssText);
        $desktopRules = $this->parseSimpleRules($cleanCss, $report);
        foreach ($desktopRules as $r) {
            $r['mediaText'] = null;
            $rules[] = $r;
        }

        return $rules;
    }

    /**
     * Parses simple CSS rules: selector { prop: val; }
     */
    private function parseSimpleRules(string $cssText, ?ImportReport $report = null): array
    {
        $rules = [];
        preg_match_all('/([^{]+)\{([^}]+)\}/s', $cssText, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $rawSelectors = trim($match[1]);
            $declarations = trim($match[2]);

            // Skip global resets like body, html, *
            if (in_array(strtolower($rawSelectors), ['body', 'html', '*', ':root'], true)) {
                if ($report) $report->stylesDropped++;
                continue;
            }

            $selectors = array_filter(array_map('trim', explode(',', $rawSelectors)));
            $styleProps = $this->extractInlineStyles($declarations, $report);

            if (! empty($selectors) && ! empty($styleProps)) {
                $rules[] = [
                    'selectors' => $selectors,
                    'style' => $styleProps,
                ];
                if ($report) $report->stylesMapped++;
            }
        }

        return $rules;
    }

    private function sanitizeValue(string $val): string
    {
        if (str_contains($val, 'expression') || str_contains($val, 'javascript:') || str_contains($val, 'behavior:')) {
            return '';
        }
        return trim($val);
    }
}
