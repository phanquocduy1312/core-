<?php

namespace App\Services\PageImporter;

use DOMDocument;

class SourceDocument
{
    public string $title;
    public string $language;
    public ?string $sourceUrl;
    public ?string $baseUrl;
    public DOMDocument $dom;
    public array $stylesheets = [];
    public array $metadata = [];
    public string $rawHtml;

    public function __construct(
        string $title,
        string $language,
        ?string $sourceUrl,
        ?string $baseUrl,
        DOMDocument $dom,
        array $stylesheets = [],
        array $metadata = [],
        string $rawHtml = ''
    ) {
        $this->title = $title;
        $this->language = $language;
        $this->sourceUrl = $sourceUrl;
        $this->baseUrl = $baseUrl;
        $this->dom = $dom;
        $this->stylesheets = $stylesheets;
        $this->metadata = $metadata;
        $this->rawHtml = $rawHtml;
    }
}
