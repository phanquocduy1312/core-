<?php

namespace App\Services\PageImporter;

use Illuminate\Support\Str;

class ImportContext
{
    public const STRATEGY_CREATE_NEW = 'CREATE_NEW_PAGE';
    public const STRATEGY_REPLACE_DRAFT = 'REPLACE_DRAFT';

    public string $jobId;
    public string $html;
    public ?string $sourceUrl;
    public ?string $baseUrl;
    public string $locale;
    public ?int $targetPageId;
    public string $strategy;
    public bool $autoMatchSections;
    public float $confidenceThreshold;
    public ?int $userId;
    public ?string $pageTitle;
    public ?string $pageSlug;

    public function __construct(
        string $html,
        ?string $sourceUrl = null,
        ?string $baseUrl = null,
        string $locale = 'vi',
        ?int $targetPageId = null,
        string $strategy = self::STRATEGY_CREATE_NEW,
        bool $autoMatchSections = true,
        float $confidenceThreshold = 0.70,
        ?int $userId = null,
        ?string $pageTitle = null,
        ?string $pageSlug = null,
        ?string $jobId = null
    ) {
        $this->jobId = $jobId ?: (string) Str::uuid();
        $this->html = $html;
        $this->sourceUrl = $sourceUrl;
        $this->baseUrl = $baseUrl ?: ($sourceUrl ? parse_url($sourceUrl, PHP_URL_SCHEME).'://'.parse_url($sourceUrl, PHP_URL_HOST) : null);
        $this->locale = $locale;
        $this->targetPageId = $targetPageId;
        $this->strategy = in_array($strategy, [self::STRATEGY_CREATE_NEW, self::STRATEGY_REPLACE_DRAFT], true)
            ? $strategy
            : self::STRATEGY_CREATE_NEW;
        $this->autoMatchSections = $autoMatchSections;
        $this->confidenceThreshold = $confidenceThreshold;
        $this->userId = $userId;
        $this->pageTitle = $pageTitle;
        $this->pageSlug = $pageSlug;
    }
}
