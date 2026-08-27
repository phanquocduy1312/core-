<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\LocalizedContent;
use App\Services\LocalizedSlugService;
use App\Services\PageBlockRenderer;
use App\Services\PagePartialResolver;
use App\Support\FeatureGate;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function __construct(
        private readonly LocalizedSlugService $localizedSlugs,
        private readonly LocalizedContent $content,
        private readonly FeatureGate $features,
        private readonly PageBlockRenderer $blockRenderer,
        private readonly PagePartialResolver $partials,
    ) {}

    public function show(string $locale, string $slug): View
    {
        abort_unless($this->features->enabled('cms_page'), 404);

        $page = $this->localizedSlugs->find(Page::class, $slug, app()->getLocale());

        abort_unless(
            $page
                && ! $page->isPartial()
                && $page->is_active
                && $page->published_at
                && ! $page->published_at->isFuture(),
            404,
        );

        $page->load('localizedSlugs');

        $html = $this->content->get($page, 'published_html');
        $resolvedLocale = app()->getLocale();
        $partialsVersion = Cache::get('page-partials-version', 0);
        $cacheKey = "page-block-render:{$page->id}:{$resolvedLocale}:{$page->updated_at?->timestamp}:v{$partialsVersion}";
        $renderedHtml = Cache::remember($cacheKey, now()->addHour(), fn () => $this->blockRenderer->render($html, $resolvedLocale));

        $headerCacheKey = "page-header:{$page->id}:{$resolvedLocale}:v{$partialsVersion}";
        $footerCacheKey = "page-footer:{$page->id}:{$resolvedLocale}:v{$partialsVersion}";
        $headerHtml = Cache::remember($headerCacheKey, now()->addHour(), fn () => $this->partials->resolveHeader($page, $resolvedLocale));
        $footerHtml = Cache::remember($footerCacheKey, now()->addHour(), fn () => $this->partials->resolveFooter($page, $resolvedLocale));

        return view('client.pages.show', [
            'page' => $page,
            'title' => $this->content->get($page, 'title'),
            'html' => $html,
            'renderedHtml' => $renderedHtml,
            'headerHtml' => $headerHtml,
            'footerHtml' => $footerHtml,
            'css' => $this->content->get($page, 'published_css'),
            'metaTitle' => $this->content->get($page, 'meta_title'),
            'metaDescription' => $this->content->get($page, 'meta_description'),
        ]);
    }
}
