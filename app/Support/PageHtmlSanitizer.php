<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;

class PageHtmlSanitizer
{
    private const ALLOWED_TAGS = [
        'a', 'article', 'aside', 'b', 'blockquote', 'br', 'button', 'circle', 'code',
        'dd', 'details', 'div', 'dl', 'dt', 'em', 'figcaption', 'figure', 'footer', 'g',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'header', 'hr', 'i', 'iconify-icon', 'iframe', 'img', 'li', 'line',
        'main', 'mark', 'nav', 'ol', 'p', 'path', 'picture', 'polygon', 'polyline', 'pre',
        'rect', 'section', 'small', 'source', 'span', 'strong', 'summary', 'svg', 'table',
        'tbody', 'td', 'tfoot', 'th', 'thead', 'tr', 'u', 'ul',
    ];

    private const ALLOWED_ATTRIBUTES = [
        'allowfullscreen', 'alt', 'class', 'colspan', 'd', 'fill', 'frameborder', 'height', 'href',
        'icon', 'id', 'loading', 'points', 'preserveaspectratio', 'referrerpolicy',
        'rel', 'role', 'rowspan', 'sandbox', 'scope', 'src', 'srcset', 'stroke', 'stroke-linecap',
        'stroke-linejoin', 'stroke-width', 'style', 'target', 'title', 'type', 'viewbox',
        'width', 'xmlns',
    ];

    public const ALLOWED_DATA_ATTRIBUTES = [
        'data-page-block',
        'data-category',
        'data-limit',
        'data-query',
        'data-columns',
        'data-gap',
        'data-align',
        'data-partial-id',
        'data-tab',
        'data-cat',
    ];

    public function clean(?string $html): string
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="utf-8" ?><div id="page-builder-root">'.(string) $html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $xpath = new DOMXPath($document);
        foreach (iterator_to_array($xpath->query('//script|//object|//embed|//form|//input|//textarea|//select') ?: []) as $node) {
            $node->parentNode?->removeChild($node);
        }

        foreach (iterator_to_array($xpath->query('//iframe') ?: []) as $iframe) {
            if (! $iframe instanceof DOMElement || ! $this->safeIframeSrc($iframe->getAttribute('src'))) {
                $iframe->parentNode?->removeChild($iframe);
                continue;
            }
            $iframe->setAttribute('loading', 'lazy');
            $iframe->setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
            $iframe->setAttribute('sandbox', 'allow-scripts allow-same-origin allow-presentation allow-popups');
        }

        foreach (iterator_to_array($xpath->query('//*') ?: []) as $element) {
            if (! $element instanceof DOMElement || $element->getAttribute('id') === 'page-builder-root') {
                continue;
            }
            if (! in_array(strtolower($element->tagName), self::ALLOWED_TAGS, true)) {
                $this->unwrap($element);
                continue;
            }

            foreach (iterator_to_array($element->attributes) as $attribute) {
                $name = strtolower($attribute->name);
                $isAllowedDataAttr = in_array($name, self::ALLOWED_DATA_ATTRIBUTES, true);
                $allowedAttribute = in_array($name, self::ALLOWED_ATTRIBUTES, true)
                    || str_starts_with($name, 'aria-')
                    || $isAllowedDataAttr;
                if (! $allowedAttribute
                    || str_starts_with($name, 'on')
                    || (in_array($name, ['href', 'src', 'srcset'], true) && ! $this->safeUrl($attribute->value))
                    || ($name === 'style' && $this->containsDangerousCss($attribute->value))) {
                    $element->removeAttribute($attribute->name);
                }
            }
            if ($element->hasAttribute('target') && $element->getAttribute('target') === '_blank') {
                $element->setAttribute('rel', 'noopener noreferrer');
            }
        }

        $root = $document->getElementById('page-builder-root');
        if (! $root) return '';

        $output = '';
        foreach ($root->childNodes as $child) {
            $output .= $document->saveHTML($child);
        }

        return $output;
    }

    private function unwrap(DOMNode $node): void
    {
        $parent = $node->parentNode;
        if (! $parent) return;
        while ($node->firstChild) {
            $parent->insertBefore($node->firstChild, $node);
        }
        $parent->removeChild($node);
    }

    private function safeUrl(string $url): bool
    {
        $url = trim($url);
        if ($url === '' || str_starts_with($url, '/') || str_starts_with($url, '#')) return true;
        $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https', 'mailto', 'tel'], true);
    }

    private function safeIframeSrc(string $url): bool
    {
        $url = trim($url);
        if ($url === '' || strtolower((string) parse_url($url, PHP_URL_SCHEME)) !== 'https') {
            return false;
        }

        $host = strtolower((string) parse_url($url, PHP_URL_HOST));
        $allowedHosts = array_map('strtolower', config('page_builder.allowed_iframe_hosts', []));

        return in_array($host, $allowedHosts, true);
    }

    private function containsDangerousCss(string $css): bool
    {
        return (bool) preg_match(
            '/@import|expression\s*\(|javascript\s*:|behavior\s*:|-moz-binding|<\s*\/?\s*(script|style)/i',
            $css,
        );
    }
}
