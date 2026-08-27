<?php

namespace App\Services;

use App\Models\Page;
use App\Models\ProjectSetting;

class PagePartialResolver
{
    public function __construct(private readonly PageBlockRenderer $blockRenderer)
    {
    }

    public function resolveHeader(Page $page, string $locale): string
    {
        return $this->resolve($page->header_mode, $page->header_partial_id, 'header_id', $locale);
    }

    public function resolveFooter(Page $page, string $locale): string
    {
        return $this->resolve($page->footer_mode, $page->footer_partial_id, 'footer_id', $locale);
    }

    private function resolve(?string $mode, ?int $customPartialId, string $siteDefaultKey, string $locale): string
    {
        if ($mode === 'none') {
            return '';
        }

        $partialId = $mode === 'custom' ? $customPartialId : $this->siteDefaultPartialId($siteDefaultKey);
        if (! $partialId) {
            return '';
        }

        $partial = Page::query()->partials()->where('is_active', true)->find($partialId);
        if (! $partial) {
            return '';
        }

        $html = (string) $partial->getTranslation('published_html', $locale, false);

        return $this->blockRenderer->render($html, $locale, [$partial->id]);
    }

    private function siteDefaultPartialId(string $key): ?int
    {
        $record = ProjectSetting::query()->where('setting_key', 'layout_partials')->first();
        $settings = $record?->setting_value ?? [];

        return $settings[$key] ?? null;
    }
}
