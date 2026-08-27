<?php

namespace App\Support;

class DynamicBlockConfigValidator
{
    public const ALLOWED_DYNAMIC_TYPES = [
        'product-grid',
        'product-tabs',
        'post-list',
        'category-grid',
        'latest-reviews',
        'contact-form',
        'partial',
    ];

    public static function isAllowedType(string $type): bool
    {
        return in_array($type, self::ALLOWED_DYNAMIC_TYPES, true);
    }

    public static function validateProductGrid(array $config): array
    {
        $align = $config['align'] ?? 'left';
        $query = $config['query'] ?? 'latest';
        return [
            'category' => trim((string) ($config['category'] ?? '')),
            'limit' => max(1, min(24, (int) ($config['limit'] ?? 8))),
            'query' => in_array($query, ['latest', 'featured'], true) ? $query : 'latest',
            'columns' => max(1, min(10, (int) ($config['columns'] ?? 4))),
            'gap' => max(0, min(100, (int) ($config['gap'] ?? 24))),
            'align' => in_array($align, ['left', 'center', 'right'], true) ? $align : 'left',
        ];
    }

    public static function validateProductTabs(array $config): array
    {
        $align = $config['align'] ?? 'left';
        return [
            'limit' => max(1, min(48, (int) ($config['limit'] ?? 16))),
            'columns' => max(1, min(10, (int) ($config['columns'] ?? 4))),
            'gap' => max(0, min(100, (int) ($config['gap'] ?? 24))),
            'align' => in_array($align, ['left', 'center', 'right'], true) ? $align : 'left',
        ];
    }

    public static function validatePostList(array $config): array
    {
        $align = $config['align'] ?? 'left';
        return [
            'category' => trim((string) ($config['category'] ?? '')),
            'limit' => max(1, min(12, (int) ($config['limit'] ?? 3))),
            'columns' => max(1, min(6, (int) ($config['columns'] ?? 3))),
            'gap' => max(0, min(100, (int) ($config['gap'] ?? 24))),
            'align' => in_array($align, ['left', 'center', 'right'], true) ? $align : 'left',
        ];
    }

    public static function validateCategoryGrid(array $config): array
    {
        $align = $config['align'] ?? 'center';
        return [
            'limit' => max(1, min(24, (int) ($config['limit'] ?? 8))),
            'columns' => max(1, min(12, (int) ($config['columns'] ?? 4))),
            'gap' => max(0, min(100, (int) ($config['gap'] ?? 24))),
            'align' => in_array($align, ['left', 'center', 'right'], true) ? $align : 'center',
        ];
    }

    public static function validateLatestReviews(array $config): array
    {
        return [
            'limit' => max(1, min(12, (int) ($config['limit'] ?? 4))),
            'columns' => max(1, min(6, (int) ($config['columns'] ?? 4))),
            'gap' => max(0, min(100, (int) ($config['gap'] ?? 24))),
        ];
    }

    public static function validatePartial(array $config): array
    {
        $partialId = (int) ($config['partialId'] ?? ($config['partial_id'] ?? 0));
        return [
            'partial_id' => max(0, $partialId),
        ];
    }

    public static function validateContactForm(array $config): array
    {
        return [];
    }

    /**
     * Centralized serializer from canonical config to safe runtime HTML element
     */
    public static function serializeToHtml(string $dynamicType, array $config): string
    {
        if (! self::isAllowedType($dynamicType)) {
            return '';
        }

        $attrs = ['data-page-block' => $dynamicType];

        switch ($dynamicType) {
            case 'product-grid':
                $validated = self::validateProductGrid($config);
                if ($validated['category'] !== '') $attrs['data-category'] = $validated['category'];
                $attrs['data-limit'] = (string) $validated['limit'];
                $attrs['data-query'] = $validated['query'];
                $attrs['data-columns'] = (string) $validated['columns'];
                $attrs['data-gap'] = (string) $validated['gap'];
                $attrs['data-align'] = $validated['align'];
                break;

            case 'product-tabs':
                $validated = self::validateProductTabs($config);
                $attrs['data-limit'] = (string) $validated['limit'];
                $attrs['data-columns'] = (string) $validated['columns'];
                $attrs['data-gap'] = (string) $validated['gap'];
                $attrs['data-align'] = $validated['align'];
                break;

            case 'post-list':
                $validated = self::validatePostList($config);
                if ($validated['category'] !== '') $attrs['data-category'] = $validated['category'];
                $attrs['data-limit'] = (string) $validated['limit'];
                $attrs['data-columns'] = (string) $validated['columns'];
                $attrs['data-gap'] = (string) $validated['gap'];
                $attrs['data-align'] = $validated['align'];
                break;

            case 'category-grid':
                $validated = self::validateCategoryGrid($config);
                $attrs['data-limit'] = (string) $validated['limit'];
                $attrs['data-columns'] = (string) $validated['columns'];
                $attrs['data-gap'] = (string) $validated['gap'];
                $attrs['data-align'] = $validated['align'];
                break;

            case 'latest-reviews':
                $validated = self::validateLatestReviews($config);
                $attrs['data-limit'] = (string) $validated['limit'];
                $attrs['data-columns'] = (string) $validated['columns'];
                $attrs['data-gap'] = (string) $validated['gap'];
                break;

            case 'partial':
                $validated = self::validatePartial($config);
                $attrs['data-partial-id'] = (string) $validated['partial_id'];
                break;

            case 'contact-form':
                break;
        }

        $attrStrings = [];
        foreach ($attrs as $k => $v) {
            $attrStrings[] = sprintf('%s="%s"', $k, htmlspecialchars($v, ENT_QUOTES, 'UTF-8'));
        }

        return '<div ' . implode(' ', $attrStrings) . '></div>';
    }
}
