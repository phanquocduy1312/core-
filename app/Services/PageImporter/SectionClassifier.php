<?php

namespace App\Services\PageImporter;

use DOMElement;
use DOMNode;
use DOMXPath;

class SectionClassifier
{
    /**
     * Finds top-level visual sections within the document
     *
     * @return array<DOMElement>
     */
    public function findSectionNodes(SourceDocument $document): array
    {
        $xpath = new DOMXPath($document->dom);

        // 1. If explicit <section> tags exist in document (>= 2), use them directly
        $allSections = $xpath->query('//section');
        if ($allSections && $allSections->length >= 2) {
            return iterator_to_array($allSections);
        }

        // 2. Otherwise search inside main wrapper
        $mainQuery = '//main | //div[@id="main"] | //div[@id="content"] | //div[@id="app"]';
        $mains = $xpath->query($mainQuery);
        $root = ($mains && $mains->length > 0) ? $mains->item(0) : $xpath->query('//body')->item(0);
        if (! $root) $root = $document->dom->documentElement;

        $sections = [];
        foreach ($root->childNodes as $child) {
            if ($child instanceof DOMElement) {
                $tag = strtolower($child->tagName);
                if ($tag === 'header' || $tag === 'footer' || $tag === 'nav') {
                    continue;
                }

                if (trim($child->textContent) !== '' || $xpath->query('.//img', $child)->length > 0) {
                    $sections[] = $child;
                }
            }
        }

        return $sections;
    }

    /**
     * Classifies a single section DOM element
     */
    public function classify(DOMElement $node, SourceDocument $document, int $sectionIndex = 0): array
    {
        $xpath = new DOMXPath($document->dom);

        $text = strtolower($node->textContent);
        $classId = strtolower($node->getAttribute('class') . ' ' . $node->getAttribute('id'));

        $headings = $xpath->query('.//h1 | .//h2 | .//h3', $node);
        $paragraphs = $xpath->query('.//p', $node);
        $images = $xpath->query('.//img', $node);
        $buttons = $xpath->query('.//a[contains(@class, "btn") or contains(@class, "button")] | .//button', $node);
        $forms = $xpath->query('.//form | .//input', $node);

        $imageCount = $images ? $images->length : 0;
        $headingCount = $headings ? $headings->length : 0;
        $buttonCount = $buttons ? $buttons->length : 0;
        $formCount = $forms ? $forms->length : 0;

        // Check repeated card structure
        $cardGrid = $this->detectRepeatedGrid($node, $xpath);

        // 1. Contact Section
        if ($formCount > 0 || str_contains($classId, 'contact') || str_contains($classId, 'lien-he')) {
            return [
                'semanticType' => 'contact',
                'confidence' => 0.90,
                'layout' => ['hasForm' => true],
                'node' => $node,
            ];
        }

        // 2. Hero Section (Explicit hero/banner class or H1 with image/button)
        if (str_contains($classId, 'hero') || str_contains($classId, 'banner') || ($headingCount > 0 && $xpath->query('.//h1', $node)->length > 0) || ($sectionIndex === 0 && !str_contains($classId, 'service') && !str_contains($classId, 'gallery'))) {
            $imagePos = ($imageCount > 0) ? 'right' : 'none';
            return [
                'semanticType' => 'hero',
                'confidence' => 0.92,
                'layout' => [
                    'columns' => ($imageCount > 0) ? 2 : 1,
                    'imagePosition' => $imagePos,
                    'hasButton' => $buttonCount > 0,
                ],
                'node' => $node,
            ];
        }

        // 3. Services / Features Section
        if (str_contains($classId, 'service') || str_contains($classId, 'feature') || str_contains($classId, 'dich-vu') || (($cardGrid['isGrid'] ?? false) && ($cardGrid['itemCount'] >= 3))) {
            return [
                'semanticType' => 'services',
                'confidence' => 0.88,
                'layout' => [
                    'columns' => $cardGrid['columns'] ?? 3,
                    'itemCount' => $cardGrid['itemCount'] ?? 3,
                ],
                'node' => $node,
            ];
        }

        // 6. Call to Action (CTA) Section
        if (($buttonCount > 0 && $headingCount <= 2 && $imageCount <= 1) || str_contains($classId, 'cta') || str_contains($classId, 'call-to-action')) {
            return [
                'semanticType' => 'cta',
                'confidence' => 0.82,
                'layout' => [
                    'hasButton' => true,
                    'alignment' => 'center',
                ],
                'node' => $node,
            ];
        }

        // 7. About Section
        if (str_contains($classId, 'about') || str_contains($classId, 'gioi-thieu') || ($imageCount === 1 && $headingCount >= 1 && $paragraphs && $paragraphs->length >= 1)) {
            return [
                'semanticType' => 'about',
                'confidence' => 0.80,
                'layout' => [
                    'columns' => ($imageCount > 0) ? 2 : 1,
                    'imagePosition' => 'left',
                ],
                'node' => $node,
            ];
        }

        // Fallback: Generic Section
        return [
            'semanticType' => 'generic',
            'confidence' => 0.60,
            'layout' => [
                'columns' => $cardGrid['columns'] ?? 1,
            ],
            'node' => $node,
        ];
    }

    private function detectRepeatedGrid(DOMElement $node, DOMXPath $xpath): array
    {
        $children = [];
        foreach ($node->childNodes as $c) {
            if ($c instanceof DOMElement && trim($c->textContent) !== '') {
                $children[] = $c;
            }
        }

        // If direct children or nested inner wrapper has 3+ sibling cards
        $candidates = $children;
        if (count($children) === 1 && $children[0] instanceof DOMElement) {
            $innerChildren = [];
            foreach ($children[0]->childNodes as $ic) {
                if ($ic instanceof DOMElement && trim($ic->textContent) !== '') {
                    $innerChildren[] = $ic;
                }
            }
            if (count($innerChildren) >= 2) {
                $candidates = $innerChildren;
            }
        }

        $count = count($candidates);
        if ($count >= 2) {
            $cols = ($count === 2) ? 2 : (($count === 3) ? 3 : (($count === 4) ? 4 : 3));
            return [
                'isGrid' => true,
                'itemCount' => $count,
                'columns' => $cols,
                'items' => $candidates,
            ];
        }

        return ['isGrid' => false, 'itemCount' => 0, 'columns' => 1, 'items' => []];
    }
}
