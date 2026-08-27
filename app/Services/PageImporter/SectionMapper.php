<?php

namespace App\Services\PageImporter;

use DOMElement;
use DOMXPath;

class SectionMapper
{
    private ComponentMapper $componentMapper;
    private MediaImporter $mediaImporter;

    public function __construct(ComponentMapper $componentMapper, MediaImporter $mediaImporter)
    {
        $this->componentMapper = $componentMapper;
        $this->mediaImporter = $mediaImporter;
    }

    public function mapSection(array $classification, ImportContext $context, ImportReport $report, int $index): array
    {
        $semanticType = $classification['semanticType'];
        $confidence = $classification['confidence'];
        $layout = $classification['layout'] ?? [];
        $node = $classification['node'];

        $sourceId = $node->getAttribute('id') ?: ($node->getAttribute('class') ?: 'section-' . ($index + 1));

        // 1. Check if we should auto-match to Predefined Section Variant
        if ($context->autoMatchSections && $confidence >= $context->confidenceThreshold && $semanticType !== 'generic') {
            $matchedVariant = $this->matchVariant($semanticType, $layout);
            if ($matchedVariant) {
                $sectionComponent = $this->buildPredefinedSection($semanticType, $matchedVariant, $node, $context, $report, $index);
                $report->registryMatched++;
                $report->addSectionMapping(
                    $sourceId,
                    $semanticType,
                    $matchedVariant,
                    $confidence,
                    "Matched variant {$matchedVariant} based on layout & semantic signals"
                );
                return $sectionComponent;
            }
        }

        // 2. Fallback to Generic Component Composition (M3 Composite Tree)
        $report->composedGeneric++;
        $report->addSectionMapping(
            $sourceId,
            $semanticType,
            null,
            $confidence,
            "Composed as generic M3 composite layout"
        );

        return $this->buildGenericSection($node, $context, $report, $index);
    }

    private function matchVariant(string $semanticType, array $layout): ?string
    {
        switch ($semanticType) {
            case 'hero':
                return ($layout['columns'] ?? 1) >= 2 ? 'hero-01' : 'hero-02';
            case 'about':
                return ($layout['columns'] ?? 1) >= 2 ? 'about-02' : 'about-01';
            case 'services':
                return 'services-01';
            case 'projects':
                return 'projects-01';
            case 'gallery':
                return 'gallery-01';
            case 'cta':
                return 'cta-02';
            case 'contact':
                return 'contact-01';
            default:
                return null;
        }
    }

    private function buildPredefinedSection(string $semanticType, string $variant, DOMElement $node, ImportContext $context, ImportReport $report, int $index): array
    {
        $xpath = new DOMXPath($node->ownerDocument);

        $nodeClasses = array_filter(explode(' ', trim($node->getAttribute('class'))));
        $nodeId = trim($node->getAttribute('id'));

        // Extract content roles
        $titleNode = $xpath->query('.//h1 | .//h2 | .//h3', $node)->item(0);
        $titleText = $titleNode ? trim($titleNode->textContent) : 'Tiêu Đề Mục';
        $titleClasses = array_filter(explode(' ', trim($titleNode instanceof DOMElement ? $titleNode->getAttribute('class') : '')));
        $titleId = ($titleNode instanceof DOMElement) ? trim($titleNode->getAttribute('id')) : null;

        $pNode = $xpath->query('.//p', $node)->item(0);
        $pText = $pNode ? trim($pNode->textContent) : 'Mô tả nội dung mục...';
        $pClasses = array_filter(explode(' ', trim($pNode instanceof DOMElement ? $pNode->getAttribute('class') : '')));
        $pId = ($pNode instanceof DOMElement) ? trim($pNode->getAttribute('id')) : null;

        $btnNode = $xpath->query('.//a[contains(@class, "btn") or contains(@class, "button")] | .//button', $node)->item(0);
        $btnText = $btnNode ? trim($btnNode->textContent) : 'Xem Thêm';
        $rawHref = ($btnNode instanceof DOMElement) ? ($btnNode->getAttribute('href') ?: '#') : '#';
        $btnHref = $this->sanitizeHref($rawHref);
        $btnClasses = array_filter(explode(' ', trim($btnNode instanceof DOMElement ? $btnNode->getAttribute('class') : '')));
        $btnId = ($btnNode instanceof DOMElement) ? trim($btnNode->getAttribute('id')) : null;

        $imgNode = $xpath->query('.//img', $node)->item(0);
        $rawImgSrc = ($imgNode instanceof DOMElement) ? ($imgNode->getAttribute('src') ?: 'https://placehold.co/800x600') : 'https://placehold.co/800x600';
        $imgAlt = ($imgNode instanceof DOMElement) ? ($imgNode->getAttribute('alt') ?: $titleText) : $titleText;
        $imgClasses = array_filter(explode(' ', trim($imgNode instanceof DOMElement ? $imgNode->getAttribute('class') : '')));
        $imgId = ($imgNode instanceof DOMElement) ? trim($imgNode->getAttribute('id')) : null;

        $mediaResult = $this->mediaImporter->importMedia($rawImgSrc, $context, $report);
        $mediaRef = $mediaResult['mediaRef'];
        $targetSrc = $mediaResult['src'];

        $containerComponents = [];

        // Build inner content according to variant
        if ($semanticType === 'hero') {
            $hAttrs = [];
            if ($titleId) $hAttrs['id'] = $titleId;

            $pAttrs = [];
            if ($pId) $pAttrs['id'] = $pId;

            $bAttrs = ['href' => $btnHref];
            if ($btnId) $bAttrs['id'] = $btnId;

            $textStack = [
                'type' => 'builder-stack',
                'classes' => ['builder-stack', 'hero-content-stack'],
                'components' => [
                    [
                        'type' => 'builder-heading',
                        'tagName' => 'h1',
                        'role' => 'section-title',
                        'content' => $titleText,
                        'classes' => array_values(array_unique(array_merge(['builder-heading', 'hero-title'], $titleClasses))),
                        'attributes' => $hAttrs,
                    ],
                    [
                        'type' => 'builder-paragraph',
                        'tagName' => 'p',
                        'role' => 'section-description',
                        'content' => $pText,
                        'classes' => array_values(array_unique(array_merge(['builder-paragraph', 'hero-subtitle'], $pClasses))),
                        'attributes' => $pAttrs,
                    ],
                    [
                        'type' => 'builder-button',
                        'tagName' => 'a',
                        'role' => 'primary-action',
                        'content' => $btnText,
                        'attributes' => $bAttrs,
                        'classes' => array_values(array_unique(array_merge(['builder-btn', 'btn-primary'], $btnClasses))),
                    ],
                ],
            ];

            if ($variant === 'hero-01') {
                $iAttrs = ['src' => $targetSrc, 'alt' => $imgAlt];
                if ($imgId) $iAttrs['id'] = $imgId;

                $imageComponent = [
                    'type' => 'image',
                    'role' => 'hero-image',
                    'mediaRef' => $mediaRef,
                    'attributes' => $iAttrs,
                    'classes' => array_values(array_unique(array_merge(['builder-image', 'hero-img'], $imgClasses))),
                ];

                // Detect source split-grid classes
                $gridNodes = $xpath->query('.//*[contains(@class, "grid") or contains(@class, "columns") or contains(@class, "split")]', $node);
                $gridSourceClasses = array_filter(explode(' ', trim($gridNodes && $gridNodes->length > 0 ? $gridNodes->item(0)->getAttribute('class') : '')));
                $colsClasses = array_values(array_unique(array_merge(['builder-columns', 'hero-split-grid'], $gridSourceClasses)));

                $containerComponents[] = [
                    'type' => 'builder-columns',
                    'classes' => $colsClasses,
                    'components' => [
                        ['type' => 'builder-column', 'classes' => ['builder-column'], 'components' => [$textStack]],
                        ['type' => 'builder-column', 'classes' => ['builder-column'], 'components' => [$imageComponent]],
                    ],
                ];
            } else {
                $containerComponents[] = $textStack;
            }
        } elseif ($semanticType === 'services') {
            $hAttrs = [];
            if ($titleId) $hAttrs['id'] = $titleId;

            $containerComponents[] = [
                'type' => 'builder-heading',
                'tagName' => 'h2',
                'role' => 'section-title',
                'content' => $titleText,
                'classes' => array_values(array_unique(array_merge(['builder-heading', 'section-title'], $titleClasses))),
                'attributes' => $hAttrs,
            ];

            // Build grid cards from child elements
            $cardNodes = $xpath->query('.//*[contains(@class, "card") or contains(@class, "item") or contains(@class, "service")]', $node);
            $cards = [];
            if ($cardNodes && $cardNodes->length >= 2) {
                foreach ($cardNodes as $cn) {
                    if (! $cn instanceof DOMElement) continue;
                    $cTitle = $xpath->query('.//h3 | .//h4 | .//h5', $cn)->item(0);
                    $cP = $xpath->query('.//p', $cn)->item(0);
                    $cClasses = array_filter(explode(' ', trim($cn->getAttribute('class'))));

                    $cards[] = [
                        'type' => 'builder-stack',
                        'role' => 'service-item',
                        'classes' => array_values(array_unique(array_merge(['builder-stack', 'service-card'], $cClasses))),
                        'components' => [
                            [
                                'type' => 'builder-heading',
                                'tagName' => 'h3',
                                'content' => $cTitle ? trim($cTitle->textContent) : 'Dịch Vụ',
                                'classes' => ['service-title'],
                            ],
                            [
                                'type' => 'builder-paragraph',
                                'tagName' => 'p',
                                'content' => $cP ? trim($cP->textContent) : 'Chi tiết dịch vụ...',
                                'classes' => ['service-desc'],
                            ],
                        ],
                    ];
                }
            } else {
                for ($i = 1; $i <= 3; $i++) {
                    $cards[] = [
                        'type' => 'builder-stack',
                        'role' => 'service-item',
                        'classes' => ['builder-stack', 'service-card'],
                        'components' => [
                            ['type' => 'builder-heading', 'tagName' => 'h3', 'content' => "Dịch Vụ {$i}", 'classes' => ['service-title']],
                            ['type' => 'builder-paragraph', 'tagName' => 'p', 'content' => 'Trải nghiệm dịch vụ cao cấp chuẩn quốc tế.', 'classes' => ['service-desc']],
                        ],
                    ];
                }
            }

            $gridNodes = $xpath->query('.//*[contains(@class, "grid") or contains(@class, "container")]', $node);
            $gridClasses = array_filter(explode(' ', trim($gridNodes && $gridNodes->length > 0 ? $gridNodes->item(0)->getAttribute('class') : '')));
            $servicesGridClasses = array_values(array_unique(array_merge(['builder-grid', 'services-grid'], $gridClasses)));

            $containerComponents[] = [
                'type' => 'builder-grid',
                'classes' => $servicesGridClasses,
                'components' => $cards,
            ];
        } elseif ($semanticType === 'gallery') {
            $hAttrs = [];
            if ($titleId) $hAttrs['id'] = $titleId;

            $containerComponents[] = [
                'type' => 'builder-heading',
                'tagName' => 'h2',
                'role' => 'section-title',
                'content' => $titleText,
                'classes' => array_values(array_unique(array_merge(['builder-heading', 'section-title'], $titleClasses))),
                'attributes' => $hAttrs,
            ];

            $imgNodes = $xpath->query('.//img', $node);
            $galleryItems = [];
            foreach ($imgNodes ?: [] as $gi) {
                if (! $gi instanceof DOMElement) continue;
                $gSrc = $gi->getAttribute('src') ?: 'https://placehold.co/600x400';
                $gAlt = $gi->getAttribute('alt') ?: 'Hình ảnh bộ sưu tập';
                $giClasses = array_filter(explode(' ', trim($gi->getAttribute('class'))));
                $giId = trim($gi->getAttribute('id'));

                $gRes = $this->mediaImporter->importMedia($gSrc, $context, $report);

                $iAttrs = ['src' => $gRes['src'], 'alt' => $gAlt];
                if ($giId) $iAttrs['id'] = $giId;

                $galleryItems[] = [
                    'type' => 'image',
                    'role' => 'gallery-item',
                    'mediaRef' => $gRes['mediaRef'],
                    'attributes' => $iAttrs,
                    'classes' => array_values(array_unique(array_merge(['gallery-img'], $giClasses))),
                ];
            }

            $containerComponents[] = [
                'type' => 'builder-grid',
                'classes' => ['builder-grid', 'gallery-grid'],
                'components' => $galleryItems,
            ];
        } else {
            $hAttrs = [];
            if ($titleId) $hAttrs['id'] = $titleId;

            $pAttrs = [];
            if ($pId) $pAttrs['id'] = $pId;

            $containerComponents[] = [
                'type' => 'builder-heading',
                'tagName' => 'h2',
                'role' => 'section-title',
                'content' => $titleText,
                'classes' => array_values(array_unique(array_merge(['builder-heading', 'section-title'], $titleClasses))),
                'attributes' => $hAttrs,
            ];
            $containerComponents[] = [
                'type' => 'builder-paragraph',
                'tagName' => 'p',
                'role' => 'section-description',
                'content' => $pText,
                'classes' => array_values(array_unique(array_merge(['builder-paragraph', 'section-desc'], $pClasses))),
                'attributes' => $pAttrs,
            ];
            if ($btnText && $btnText !== 'Xem Thêm') {
                $bAttrs = ['href' => $btnHref];
                if ($btnId) $bAttrs['id'] = $btnId;

                $containerComponents[] = [
                    'type' => 'builder-button',
                    'tagName' => 'a',
                    'role' => 'primary-action',
                    'content' => $btnText,
                    'attributes' => $bAttrs,
                    'classes' => array_values(array_unique(array_merge(['builder-btn', 'btn-primary'], $btnClasses))),
                ];
            }
        }

        $secAttrs = [];
        if ($nodeId) $secAttrs['id'] = $nodeId;

        return [
            'type' => 'builder-section',
            'sectionType' => $semanticType,
            'variant' => $variant,
            'classes' => array_values(array_unique(array_merge(['builder-section', "section-{$variant}"], $nodeClasses))),
            'attributes' => $secAttrs,
            'components' => [
                [
                    'type' => 'builder-container',
                    'classes' => ['builder-container'],
                    'components' => $containerComponents,
                ],
            ],
        ];
    }

    private function buildGenericSection(DOMElement $node, ImportContext $context, ImportReport $report, int $index): array
    {
        $nodeClasses = array_filter(explode(' ', trim($node->getAttribute('class'))));
        $nodeId = trim($node->getAttribute('id'));

        $mappedChildren = $this->componentMapper->mapChildren($node, $context, $report);

        $secAttrs = [];
        if ($nodeId) $secAttrs['id'] = $nodeId;

        return [
            'type' => 'builder-section',
            'classes' => array_values(array_unique(array_merge(['builder-section', 'section-generic'], $nodeClasses))),
            'attributes' => $secAttrs,
            'components' => [
                [
                    'type' => 'builder-container',
                    'classes' => ['builder-container'],
                    'components' => $mappedChildren,
                ],
            ],
        ];
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
