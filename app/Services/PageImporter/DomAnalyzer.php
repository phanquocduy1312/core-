<?php

namespace App\Services\PageImporter;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;

class DomAnalyzer
{
    private const UNWANTED_TAGS = [
        'script', 'noscript', 'object', 'embed', 'applet',
        'canvas', 'template', 'svg' // Note: SVGs evaluated or mapped to icons
    ];

    public function analyze(string $html, ?string $sourceUrl = null, ?string $baseUrl = null): SourceDocument
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $prev = libxml_use_internal_errors(true);
        $dom->loadHTML(
            '<?xml encoding="utf-8" ?>' . $html,
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();
        libxml_use_internal_errors($prev);

        $xpath = new DOMXPath($dom);

        // 1. Extract Metadata
        $title = $this->extractTitle($xpath);
        $language = $this->extractLanguage($xpath);
        $metadata = $this->extractMetadata($xpath);
        $stylesheets = $this->extractStylesheets($xpath);

        // 2. Remove Unwanted Elements & Trackers
        $this->purgeUnwantedElements($xpath);

        return new SourceDocument(
            $title,
            $language,
            $sourceUrl,
            $baseUrl,
            $dom,
            $stylesheets,
            $metadata,
            $html
        );
    }

    private function extractTitle(DOMXPath $xpath): string
    {
        $nodes = $xpath->query('//title');
        if ($nodes && $nodes->length > 0) {
            return trim($nodes->item(0)->textContent);
        }
        $h1 = $xpath->query('//h1');
        if ($h1 && $h1->length > 0) {
            return trim($h1->item(0)->textContent);
        }
        return 'Imported Page';
    }

    private function extractLanguage(DOMXPath $xpath): string
    {
        $htmlNodes = $xpath->query('//html[@lang]');
        if ($htmlNodes && $htmlNodes->length > 0) {
            $lang = $htmlNodes->item(0)->getAttribute('lang');
            $code = strtolower(substr(trim($lang), 0, 2));
            if (in_array($code, ['vi', 'en', 'ko', 'zh', 'ja'], true)) {
                return $code;
            }
        }
        return 'vi';
    }

    private function extractMetadata(DOMXPath $xpath): array
    {
        $metadata = [];

        foreach ($xpath->query('//meta') ?: [] as $meta) {
            if (! $meta instanceof DOMElement) continue;

            $name = strtolower($meta->getAttribute('name') ?: $meta->getAttribute('property'));
            $content = $meta->getAttribute('content');

            if ($name && $content) {
                if ($name === 'description' || $name === 'og:description') {
                    $metadata['description'] = trim($content);
                } elseif ($name === 'og:title') {
                    $metadata['og_title'] = trim($content);
                } elseif ($name === 'og:image') {
                    $metadata['og_image'] = trim($content);
                }
            }
        }

        return $metadata;
    }

    private function extractStylesheets(DOMXPath $xpath): array
    {
        $styles = [];
        foreach ($xpath->query('//style') ?: [] as $style) {
            if ($style instanceof DOMElement) {
                $styles[] = $style->textContent;
            }
        }
        return $styles;
    }

    private function purgeUnwantedElements(DOMXPath $xpath): void
    {
        // Purge script/noscript/tracking
        $query = '//script | //noscript | //object | //embed | //applet | //template | //iframe[not(contains(@src, "youtube") or contains(@src, "vimeo"))]';
        foreach (iterator_to_array($xpath->query($query) ?: []) as $node) {
            $node->parentNode?->removeChild($node);
        }

        // Purge inline event handlers and tracking attributes
        foreach ($xpath->query('//*[@*]') ?: [] as $el) {
            if (! $el instanceof DOMElement) continue;

            $attrsToRemove = [];
            foreach ($el->attributes as $attr) {
                $name = $attr->nodeName;
                $lowerName = strtolower($name);
                if (str_starts_with($lowerName, 'on') || str_starts_with($lowerName, 'data-gtm') || str_starts_with($lowerName, 'data-ga')) {
                    $attrsToRemove[] = $name;
                }
            }

            foreach ($attrsToRemove as $name) {
                $el->removeAttribute($name);
            }
        }
    }
}
