<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InlinePageUpdateRequest;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use App\Models\PageRevision;
use App\Services\ActivityLogger;
use App\Services\LanguageRegistry;
use App\Services\PageBlockRenderer;
use App\Services\PageBuilderService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        private readonly PageBuilderService $pages,
        private readonly LanguageRegistry $languages,
        private readonly PageBlockRenderer $blockRenderer,
    ) {}

    public function index(Request $request)
    {
        $pages = Page::query()
            ->pages()
            ->with('localizedSlugs')
            ->when($request->query('q'), function ($query, $keyword) {
                $query->where('slug', 'like', "%{$keyword}%")
                    ->orWhere('title', 'like', "%{$keyword}%");
            })
            ->when($request->filled('status'), fn ($query) => $query->where('is_active', $request->boolean('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create', [
            'page' => new Page(['is_active' => false]),
            'contentLanguages' => $this->languages->active(),
            'defaultContentLocale' => $this->languages->defaultLocale(),
            'revisions' => collect(),
            'headerPartials' => Page::query()->partials()->where('partial_role', 'header')->get(),
            'footerPartials' => Page::query()->partials()->where('partial_role', 'footer')->get(),
            'allPartials' => Page::query()->partials()->where('is_active', true)->get(),
        ]);
    }

    public function store(PageRequest $request)
    {
        $page = $this->pages->create($request->validated());
        ActivityLogger::log('created', $page, "Tạo trang {$page->slug}");

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Đã tạo trang.');
    }

    public function edit(string $locale, Page $page)
    {
        abort_if($page->isPartial(), 404);

        return view('admin.pages.edit', [
            'page' => $page->load('localizedSlugs'),
            'contentLanguages' => $this->languages->active(),
            'defaultContentLocale' => $this->languages->defaultLocale(),
            'revisions' => $page->revisions()->with('creator')->limit(20)->get(),
            'headerPartials' => Page::query()->partials()->where('partial_role', 'header')->get(),
            'footerPartials' => Page::query()->partials()->where('partial_role', 'footer')->get(),
            'allPartials' => Page::query()->partials()->where('is_active', true)->where('id', '!=', $page->id)->get(),
        ]);
    }

    public function update(PageRequest $request, string $locale, Page $page)
    {
        abort_if($page->isPartial(), 404);

        $page = $this->pages->update($page, $request->validated(), $request->user()?->id);
        ActivityLogger::log('updated', $page, "Cập nhật trang {$page->slug}");

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Đã lưu trang.');
    }

    public function destroy(string $locale, Page $page)
    {
        abort_if($page->isPartial(), 404);

        $page->delete();
        ActivityLogger::log('deleted', $page, "Xóa trang {$page->slug}");

        return redirect()->route('admin.pages.index')->with('success', 'Đã xóa trang.');
    }

    public function preview(Request $request, string $locale, Page $page)
    {
        abort_if($page->isPartial(), 404);

        $previewLocale = $this->languages->resolve((string) $request->query('content_locale', $this->languages->defaultLocale()));
        $draft = $this->pages->editorContent($page, $previewLocale);
        $html = $draft['html'];

        $partials = app(\App\Services\PagePartialResolver::class);
        $headerHtml = $partials->resolveHeader($page, $previewLocale);
        $footerHtml = $partials->resolveFooter($page, $previewLocale);

        return view('client.pages.show', [
            'page' => $page,
            'title' => $page->getTranslation('title', $previewLocale, false),
            'html' => $html,
            'renderedHtml' => $this->blockRenderer->render($html, $previewLocale),
            'headerHtml' => $headerHtml,
            'footerHtml' => $footerHtml,
            'css' => $draft['css'],
            'metaTitle' => $page->getTranslation('meta_title', $previewLocale, false),
            'metaDescription' => $page->getTranslation('meta_description', $previewLocale, false),
        ]);
    }

    public function storePreview(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'nullable',
            'html' => 'required|string',
            'css' => 'nullable|string',
            'locale' => 'required|string',
            'title' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'header_mode' => 'nullable|string',
            'header_partial_id' => 'nullable|integer',
            'footer_mode' => 'nullable|string',
            'footer_partial_id' => 'nullable|integer',
        ]);

        $validated['html'] = app(\App\Support\PageHtmlSanitizer::class)->clean($validated['html']);
        $validated['css'] = $this->pages->cleanCss($validated['css'] ?? '');
        $validated['created_by'] = $request->user()->id;

        $previewToken = \Illuminate\Support\Str::random(40);
        \Illuminate\Support\Facades\Cache::put("page-preview:{$previewToken}", $validated, now()->addMinutes(5));

        return response()->json([
            'success' => true,
            'preview_url' => route('admin.pages.preview.render', ['token' => $previewToken]),
        ]);
    }

    public function renderPreview(Request $request)
    {
        $token = $request->query('token');
        $previewData = \Illuminate\Support\Facades\Cache::get("page-preview:{$token}");

        if (!$previewData || ($previewData['created_by'] ?? null) !== $request->user()->id) {
            abort(404, 'Mã xem trước đã hết hạn hoặc không hợp lệ.');
        }

        $previewLocale = $previewData['locale'];
        $html = $previewData['html'];

        $pageId = $previewData['page_id'] ?? null;
        if ($pageId && $pageId !== 'new') {
            $page = Page::query()->find($pageId);
        }
        if (!isset($page) || !$page) {
            $page = new Page();
        }

        $page->header_mode = $previewData['header_mode'] ?? 'inherit';
        $page->header_partial_id = $previewData['header_partial_id'] ?? null;
        $page->footer_mode = $previewData['footer_mode'] ?? 'inherit';
        $page->footer_partial_id = $previewData['footer_partial_id'] ?? null;

        $partials = app(\App\Services\PagePartialResolver::class);
        $headerHtml = $partials->resolveHeader($page, $previewLocale);
        $footerHtml = $partials->resolveFooter($page, $previewLocale);

        return view('client.pages.show', [
            'page' => $page,
            'title' => $previewData['title'],
            'html' => $html,
            'renderedHtml' => $this->blockRenderer->render($html, $previewLocale),
            'headerHtml' => $headerHtml,
            'footerHtml' => $footerHtml,
            'css' => $previewData['css'] ?? '',
            'metaTitle' => $previewData['meta_title'] ?? '',
            'metaDescription' => $previewData['meta_description'] ?? '',
        ]);
    }

    public function inlineUpdate(InlinePageUpdateRequest $request, string $locale, Page $page)
    {
        abort_if($page->isPartial(), 404);

        $validated = $request->validated();
        $contentLocale = $validated['content_locale'];
        $page = $this->pages->updateLocale($page, $contentLocale, $validated, $request->user()?->id);
        ActivityLogger::log('updated', $page, "Sửa trực tiếp trang {$page->slug}", [
            'content_locale' => $contentLocale,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đã lưu trang.',
            'data' => [
                'html' => $page->getTranslation('published_html', $contentLocale, false),
                'css' => $page->getTranslation('published_css', $contentLocale, false),
                'updated_at' => $page->updated_at?->toISOString(),
            ],
        ]);
    }

    public function restore(Request $request, string $locale, Page $page, PageRevision $revision)
    {
        abort_if($page->isPartial(), 404);

        $page = $this->pages->restore($page, $revision, $request->user()?->id);
        ActivityLogger::log('restored', $page, "Khôi phục phiên bản trang {$page->slug}", ['revision_id' => $revision->id]);

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Đã khôi phục phiên bản.');
    }

    public function builder(Request $request, string $locale, Page $page)
    {
        $contentLocale = $this->languages->resolve((string) $request->query('content_locale', $this->languages->defaultLocale()));
        $builderData = $this->pages->projects($page)[$contentLocale] ?? [];

        // Header/footer are rendered into the canvas as locked context so the
        // designer edits the page body against the real site chrome. When editing
        // a header or footer partial itself, do not wrap it with its own chrome.
        $partials = app(\App\Services\PagePartialResolver::class);
        $headerHtml = '';
        $footerHtml = '';
        if (! $page->isPartial()) {
            $headerHtml = $this->chromeHtml($partials->resolveHeader($page, $contentLocale), $page->header_mode, 'partials.header');
            $footerHtml = $this->chromeHtml($partials->resolveFooter($page, $contentLocale), $page->footer_mode, 'partials.footer');
        } elseif ($page->partial_role === 'header') {
            $footerHtml = $this->chromeHtml($partials->resolveFooter($page, $contentLocale), $page->footer_mode, 'partials.footer');
        } elseif ($page->partial_role === 'footer') {
            $headerHtml = $this->chromeHtml($partials->resolveHeader($page, $contentLocale), $page->header_mode, 'partials.header');
        }

        $pageHtml = (string) $page->getTranslation('published_html', $contentLocale, false);

        // LanguageRegistry::active() yields Language models, not code => name.
        $contentLanguages = $this->languages->active();
        $contentLanguageLinks = $contentLanguages
            ->map(fn ($language) => [
                'code' => $language->code,
                'name' => $language->native_name ?: $language->name,
                'url' => route('admin.pages.builder', ['locale' => $locale, 'page' => $page->id, 'content_locale' => $language->code]),
                'active' => $language->code === $contentLocale,
            ])
            ->values()
            ->all();

        $defaultHeader = $partials->selectedPartial($page, 'header');
        $defaultFooter = $partials->selectedPartial($page, 'footer');
        $headerBuilderUrl = $defaultHeader ? route('admin.pages.builder', ['locale' => $locale, 'page' => $defaultHeader->id, 'content_locale' => $contentLocale]) : null;
        $footerBuilderUrl = $defaultFooter ? route('admin.pages.builder', ['locale' => $locale, 'page' => $defaultFooter->id, 'content_locale' => $contentLocale]) : null;

        $backUrl = $page->isPartial()
            ? route('admin.partials.index', ['locale' => $locale])
            : route('admin.pages.index', ['locale' => $locale]);

        return view('admin.pages.builder', [
            'page' => $page->load('localizedSlugs'),
            'contentLocale' => $contentLocale,
            'contentLanguages' => $contentLanguages,
            'contentLanguageLinks' => $contentLanguageLinks,
            'defaultContentLocale' => $this->languages->defaultLocale(),
            'builderData' => $builderData,
            'editorContent' => $this->pages->editorContent($page, $contentLocale),
            'canvasStyles' => \App\Support\ThemeAssets::canvasStyles($pageHtml, $headerHtml, $footerHtml),
            'canvasBodyClass' => \App\Support\ThemeAssets::bodyClass(),
            'canvasContentClass' => \App\Support\ThemeAssets::contentClass(),
            'builderVersion' => \App\Support\ThemeAssets::builderVersion(),
            'canvasHeaderHtml' => $headerHtml,
            'canvasFooterHtml' => $footerHtml,
            'canvasUrl' => route('admin.pages.builder.canvas', ['locale' => $locale, 'page' => $page->id, 'content_locale' => $contentLocale]),
            'saveUrl' => route('admin.pages.builder.save', ['locale' => $locale, 'page' => $page->id]),
            'publishUrl' => route('admin.pages.builder.publish', ['locale' => $locale, 'page' => $page->id]),
            'previewUrl' => $page->isPartial() ? null : route('admin.pages.preview', ['locale' => $locale, 'page' => $page->id, 'content_locale' => $contentLocale]),
            'mediaResourcesUrl' => route('admin.media.resources', ['locale' => $locale]),
            'mediaUploadUrl' => route('admin.media.upload', ['locale' => $locale]),
            'backUrl' => $backUrl,
            'headerBuilderUrl' => $headerBuilderUrl,
            'footerBuilderUrl' => $footerBuilderUrl,
        ]);
    }

    /**
     * Header/footer markup to frame the builder canvas with.
     *
     * PagePartialResolver only knows about partials stored as Page records. This
     * site's chrome lives in Blade (resources/views/partials/header.blade.php),
     * so with no partial rows in the database the resolver correctly returns ''
     * and the builder would show a page with no header or footer at all. Fall
     * back to the layout's own partials — the same markup the public site uses.
     */
    private function chromeHtml(string $resolved, ?string $mode, string $fallbackView): string
    {
        if ($resolved !== '' || $mode === 'none') {
            return $resolved;
        }

        try {
            return view($fallbackView)->render();
        } catch (\Throwable $e) {
            // Chrome is context, not content: never let it break the builder.
            report($e);

            return '';
        }
    }

    public function builderCanvas(Request $request, string $locale, Page $page)
    {
        $contentLocale = $this->languages->resolve((string) $request->query('content_locale', $this->languages->defaultLocale()));
        $html = $page->getTranslation('published_html', $contentLocale, false) ?: '';
        $css = $page->getTranslation('published_css', $contentLocale, false) ?: '';

        $partials = app(\App\Services\PagePartialResolver::class);
        $headerHtml = '';
        $footerHtml = '';
        if (! $page->isPartial()) {
            $headerHtml = $partials->resolveHeader($page, $contentLocale);
            $footerHtml = $partials->resolveFooter($page, $contentLocale);
        } elseif ($page->partial_role === 'header') {
            $footerHtml = $partials->resolveFooter($page, $contentLocale);
        } elseif ($page->partial_role === 'footer') {
            $headerHtml = $partials->resolveHeader($page, $contentLocale);
        }

        return view('admin.pages.builder-canvas', [
            'page' => $page,
            'contentLocale' => $contentLocale,
            'title' => $page->getTranslation('title', $contentLocale, false),
            'html' => $html,
            'css' => $css,
            'headerHtml' => $headerHtml,
            'footerHtml' => $footerHtml,
        ]);
    }

    public function builderOptions(Request $request, string $locale)
    {
        $locale = $this->languages->resolve($locale);

        $categories = \App\Models\Category::query()
            ->where('is_active', true)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'slug' => $c->slug,
                'name' => $c->getTranslation('name', $locale, false) ?: $c->slug,
            ]);

        $postCategories = \App\Models\PostCategory::query()
            ->where('is_active', true)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'slug' => $c->slug,
                'name' => $c->getTranslation('name', $locale, false) ?: $c->slug,
            ]);

        $partials = Page::query()
            ->partials()
            ->where('is_active', true)
            ->get()
            ->map(fn ($p) => [
                'id' => $p->id,
                'role' => $p->partial_role,
                'title' => $p->getTranslation('title', $locale, false) ?: "Partial #{$p->id}",
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'categories' => $categories,
                'post_categories' => $postCategories,
                'partials' => $partials,
            ],
        ]);
    }

    public function builderDynamicPreview(Request $request, string $locale)
    {
        $validated = $request->validate([
            'dynamic_type' => 'required|string|in:' . implode(',', \App\Support\DynamicBlockConfigValidator::ALLOWED_DYNAMIC_TYPES),
            'config' => 'nullable|array',
        ]);

        $locale = $this->languages->resolve($locale);
        $type = $validated['dynamic_type'];
        $cfg = $validated['config'] ?? [];

        $rawHtml = \App\Support\DynamicBlockConfigValidator::serializeToHtml($type, $cfg);
        $renderedHtml = $this->blockRenderer->render($rawHtml, $locale);

        return response()->json([
            'success' => true,
            'html' => $renderedHtml,
        ]);
    }

    public function builderSave(Request $request, string $locale, Page $page)
    {
        $validated = $request->validate([
            'content_locale' => 'required|string',
            'published_html' => 'nullable|string',
            'published_css' => 'nullable|string',
            'builder_data' => 'required|array',
        ]);

        $contentLocale = $validated['content_locale'];
        abort_unless($this->languages->supports($contentLocale), 422, __('pages.invalid_locale'));
        $payload = [
            'content_locale' => $contentLocale,
            'published_html' => $validated['published_html'] ?? '',
            'published_css' => $validated['published_css'] ?? '',
            'builder_data' => $validated['builder_data'],
        ];

        $page = $this->pages->saveDraft($page, $contentLocale, $payload, $request->user()?->id);
        if ($page->isPartial()) {
            \Illuminate\Support\Facades\Cache::increment('page-partials-version');
        }

        ActivityLogger::log('updated', $page, "Lưu bản nháp builder trang {$page->slug}", [
            'content_locale' => $contentLocale,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đã lưu bản nháp thành công.',
            'data' => [
                'updated_at' => $page->updated_at?->toISOString(),
            ],
        ]);
    }

    public function builderPublish(Request $request, string $locale, Page $page)
    {
        $validated = $request->validate([
            'content_locale' => 'nullable|string',
            'published_html' => 'required|string',
            'published_css' => 'nullable|string',
            'builder_data' => 'nullable|array',
        ]);

        $contentLocale = $validated['content_locale'] ?? $this->languages->defaultLocale();
        abort_unless($this->languages->supports($contentLocale), 422, __('pages.invalid_locale'));
        $builderData = $validated['builder_data'] ?? ($page->getTranslation('builder_data', $contentLocale, false) ?: []);

        $this->pages->updateLocale($page, $contentLocale, [
            'content_locale' => $contentLocale,
            'published_html' => $validated['published_html'],
            'published_css' => $validated['published_css'] ?? '',
            'builder_data' => $builderData,
        ], $request->user()?->id);

        $page->update([
            'is_active' => true,
            'published_at' => $page->published_at ?: now(),
        ]);

        if ($page->isPartial()) {
            \Illuminate\Support\Facades\Cache::increment('page-partials-version');
        }

        ActivityLogger::log('updated', $page, "Xuất bản trang {$page->slug}");

        return response()->json([
            'success' => true,
            'message' => 'Đã xuất bản trang thành công.',
            'data' => [
                'is_active' => $page->is_active,
                'published_at' => $page->published_at?->toISOString(),
            ],
        ]);
    }
}
