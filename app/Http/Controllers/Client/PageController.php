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
        $renderedHtml = $this->blockRenderer->render($html, $resolvedLocale);
        $headerHtml = $this->partials->resolveHeader($page, $resolvedLocale);
        $footerHtml = $this->partials->resolveFooter($page, $resolvedLocale);

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
