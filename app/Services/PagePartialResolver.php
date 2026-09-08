<?php

namespace App\Services;

use App\Models\Page;
use App\Models\ProjectSetting;

class PagePartialResolver
{
    public function __construct(private readonly PageBlockRenderer $blockRenderer)
    {
    }

    public function selectedPartial(Page $page, string $role): ?Page
    {
        $mode = $page->{$role.'_mode'};
        if ($mode === 'none') return null;
        $id = $mode === 'custom' ? $page->{$role.'_partial_id'} : $this->siteDefaultPartialId($role.'_id');

        return $id ? Page::query()->partials()->where('partial_role', $role)->find($id) : null;
    }

    private function renderPartial(Page $partial, string $locale, string $html): string
    {
        $css = (string) $partial->getTranslation('published_css', $locale, false);
        $content = $this->blockRenderer->render($html, $locale, [$partial->id]);

        return ($css !== '' ? '<style data-partial-css="'.$partial->id.'">'.$css.'</style>' : '').$content;
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

        return $this->renderPartial($partial, $locale, $html);
    }

    public function resolveSiteDefault(string $siteDefaultKey, string $locale): string
    {
        try {
            $partialId = $this->siteDefaultPartialId($siteDefaultKey);
            if (! $partialId) {
                return '';
            }

            $partial = Page::query()->partials()->where('is_active', true)->find($partialId);
            if (! $partial) {
                return '';
            }

            $html = (string) $partial->getTranslation('published_html', $locale, false);
            if (trim($html) === '') {
                return '';
            }

            return $this->renderPartial($partial, $locale, $html);
        } catch (\Throwable $e) {
            return '';
        }
    }

    public function ensureDefaultPartialsExist(): array
    {
        $header = Page::query()->partials()->where('partial_role', 'header')->first();
        if (! $header) {
            $headerHtml = '';
            try {
                $headerHtml = view('partials.header')->render();
            } catch (\Throwable $e) {
                report($e);
            }

            $header = Page::query()->create([
                'type' => 'partial',
                'partial_role' => 'header',
                'slug' => 'header-default',
                'title' => [
                    'vi' => 'Header mặc định',
                    'en' => 'Default Header',
                    'ko' => '기본 헤더',
                ],
                'builder_data' => [
                    'vi' => [],
                    'en' => [],
                    'ko' => [],
                ],
                'published_html' => [
                    'vi' => $headerHtml,
                    'en' => $headerHtml,
                    'ko' => $headerHtml,
                ],
                'published_css' => [
                    'vi' => '',
                    'en' => '',
                    'ko' => '',
                ],
                'is_active' => true,
            ]);
        }

        $footer = Page::query()->partials()->where('partial_role', 'footer')->first();
        if (! $footer) {
            $footerHtml = '';
            try {
                $footerHtml = view('partials.footer')->render();
            } catch (\Throwable $e) {
                report($e);
            }

            $footer = Page::query()->create([
                'type' => 'partial',
                'partial_role' => 'footer',
                'slug' => 'footer-default',
                'title' => [
                    'vi' => 'Footer mặc định',
                    'en' => 'Default Footer',
                    'ko' => '기본 푸터',
                ],
                'builder_data' => [
                    'vi' => [],
                    'en' => [],
                    'ko' => [],
                ],
                'published_html' => [
                    'vi' => $footerHtml,
                    'en' => $footerHtml,
                    'ko' => $footerHtml,
                ],
                'published_css' => [
                    'vi' => '',
                    'en' => '',
                    'ko' => '',
                ],
                'is_active' => true,
            ]);
        }

        $settingRecord = ProjectSetting::query()->where('setting_key', 'layout_partials')->first();
        $settings = $settingRecord?->setting_value ?? [];

        $changed = false;
        if (empty($settings['header_id'])) {
            $settings['header_id'] = $header->id;
            $changed = true;
        }
        if (empty($settings['footer_id'])) {
            $settings['footer_id'] = $footer->id;
            $changed = true;
        }

        if ($changed || ! $settingRecord) {
            ProjectSetting::query()->updateOrCreate(
                ['setting_key' => 'layout_partials'],
                ['setting_value' => $settings],
            );
            \Illuminate\Support\Facades\Cache::increment('page-partials-version');
        }

        return [
            'header_id' => $header->id,
            'footer_id' => $footer->id,
        ];
    }

    private function siteDefaultPartialId(string $key): ?int
    {
        try {
            $record = ProjectSetting::query()->where('setting_key', 'layout_partials')->first();
            $settings = $record?->setting_value ?? [];

            return $settings[$key] ?? null;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
