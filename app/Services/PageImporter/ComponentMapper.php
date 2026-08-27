<?php

namespace App\Services\PageImporter;

use DOMElement;
use DOMNode;
use DOMText;

class ComponentMapper
{
    private MediaImporter $mediaImporter;

    public function __construct(MediaImporter $mediaImporter)
    {
        $this->mediaImporter = $mediaImporter;
    }

    /**
     * Maps child nodes of a DOMElement into an array of canonical M3 components
     */
    public function mapChildren(DOMElement $parent, ImportContext $context, ?ImportReport $report = null): array
    {
        $components = [];

        foreach ($parent->childNodes as $child) {
            if ($child instanceof DOMElement) {
                $mapped = $this->mapElement($child, $context, $report);
                if ($mapped !== null) {
                    $components[] = $mapped;
                }
            } elseif ($child instanceof DOMText && trim($child->textContent) !== '') {
                $text = trim($child->textContent);
                if (strlen($text) > 0) {
                    $components[] = [
                        'type' => 'builder-paragraph',
                        'tagName' => 'p',
                        'content' => $text,
                        'classes' => ['builder-paragraph'],
                    ];
                }
            }
        }

        return $components;
    }

    public function mapElement(DOMElement $el, ImportContext $context, ?ImportReport $report = null): ?array
    {
        $tag = strtolower($el->tagName);
        $sourceClasses = array_filter(explode(' ', trim($el->getAttribute('class'))));
        $sourceId = trim($el->getAttribute('id'));

        // 1. Headings (h1 - h6)
        if (preg_match('/^h([1-6])$/', $tag, $m)) {
            $text = trim($el->textContent);
            if ($text === '') return null;

            $classes = array_values(array_unique(array_merge(['builder-heading'], $sourceClasses)));
            $comp = [
                'type' => 'builder-heading',
                'tagName' => $tag,
                'content' => $text,
                'classes' => $classes,
            ];
            if ($sourceId) $comp['attributes']['id'] = $sourceId;
            return $comp;
        }

        // 2. Paragraphs & Text Blocks
        if ($tag === 'p' || $tag === 'blockquote' || $tag === 'cite') {
            $text = trim($el->textContent);
            if ($text === '') return null;

            $classes = array_values(array_unique(array_merge(['builder-paragraph'], $sourceClasses)));
            $comp = [
                'type' => 'builder-paragraph',
                'tagName' => 'p',
                'content' => $text,
                'classes' => $classes,
            ];
            if ($sourceId) $comp['attributes']['id'] = $sourceId;
            return $comp;
        }

        // 3. Buttons & CTA Links
        if ($tag === 'a' || $tag === 'button') {
            $text = trim($el->textContent);
            $href = $el->getAttribute('href') ?: '#';
            if ($text === '' && ! $el->getElementsByTagName('img')->length) return null;

            $classes = array_values(array_unique(array_merge(['builder-btn', 'btn-primary'], $sourceClasses)));
            $attrs = [
                'href' => $this->sanitizeHref($href),
                'target' => $el->getAttribute('target') ?: '_self',
            ];
            if ($sourceId) $attrs['id'] = $sourceId;

            return [
                'type' => 'builder-button',
                'tagName' => 'a',
                'content' => $text ?: 'Xem Thêm',
                'attributes' => $attrs,
                'classes' => $classes,
            ];
        }

        // 4. Images
        if ($tag === 'img') {
            $src = $el->getAttribute('src');
            if (! $src) return null;

            $activeReport = $report ?: new ImportReport();
            $mediaRes = $this->mediaImporter->importMedia($src, $context, $activeReport);

            $classes = array_values(array_unique(array_merge(['builder-image'], $sourceClasses)));
            $attrs = [
                'src' => $mediaRes['src'],
                'alt' => $el->getAttribute('alt') ?: 'Hình ảnh',
                'loading' => $el->getAttribute('loading') ?: 'lazy',
            ];
            if ($sourceId) $attrs['id'] = $sourceId;

            return [
                'type' => 'image',
                'mediaRef' => $mediaRes['mediaRef'],
                'attributes' => $attrs,
                'classes' => $classes,
            ];
        }

        // 5. Divider
        if ($tag === 'hr') {
            $classes = array_values(array_unique(array_merge(['builder-divider'], $sourceClasses)));
            $comp = [
                'type' => 'builder-divider',
                'classes' => $classes,
            ];
            if ($sourceId) $comp['attributes']['id'] = $sourceId;
            return $comp;
        }

        // 6. Video Embeds (YouTube / Vimeo)
        if ($tag === 'iframe') {
            $src = $el->getAttribute('src');
            if (str_contains($src, 'youtube.com') || str_contains($src, 'youtu.be') || str_contains($src, 'vimeo.com')) {
                $classes = array_values(array_unique(array_merge(['builder-video'], $sourceClasses)));
                $attrs = ['src' => $src];
                if ($sourceId) $attrs['id'] = $sourceId;
                return [
                    'type' => 'builder-video',
                    'attributes' => $attrs,
                    'classes' => $classes,
                ];
            }
            return null;
        }

        // 7. Generic Div / Layout Containers
        $childComponents = $this->mapChildren($el, $context, $report);
        if (empty($childComponents)) {
            return null;
        }

        // Collapse single child if it's already a container or section
        if (count($childComponents) === 1) {
            $first = $childComponents[0];
            if (isset($first['type']) && in_array($first['type'], ['builder-container', 'builder-grid', 'builder-columns', 'builder-stack'], true)) {
                return $first;
            }
        }

        // Determine if this element behaves like a grid, columns or stack
        $classesStr = strtolower($el->getAttribute('class'));
        $type = (str_contains($classesStr, 'grid') || str_contains($classesStr, 'row')) ? 'builder-grid' : 'builder-stack';
        $classes = array_values(array_unique(array_merge([$type], $sourceClasses)));

        $comp = [
            'type' => $type,
            'classes' => $classes,
            'components' => $childComponents,
        ];
        if ($sourceId) $comp['attributes']['id'] = $sourceId;

        return $comp;
    }

    private function sanitizeHref(string $href): string
    {
        $clean = trim($href);
        if (str_starts_with($clean, 'javascript:') || str_starts_with($clean, 'data:')) {
            return '#';
        }
        return $clean;
    }
}
