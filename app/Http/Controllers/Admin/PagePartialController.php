<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PagePartialRequest;
use App\Models\Page;
use App\Models\PageRevision;
use App\Services\ActivityLogger;
use App\Services\LanguageRegistry;
use App\Services\PageBuilderService;
use Illuminate\Http\Request;

class PagePartialController extends Controller
{
    public function __construct(
        private readonly PageBuilderService $pages,
        private readonly LanguageRegistry $languages,
    ) {}

    public function index(Request $request)
    {
        $partials = Page::query()
            ->partials()
            ->when($request->query('q'), fn ($query, $keyword) => $query->where('title', 'like', "%{$keyword}%"))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.partials.index', compact('partials'));
    }

    public function create()
    {
        return view('admin.partials.create', [
            'page' => new Page(['type' => 'partial', 'partial_role' => 'generic', 'is_active' => true]),
            'contentLanguages' => $this->languages->active(),
            'defaultContentLocale' => $this->languages->defaultLocale(),
            'revisions' => collect(),
            'allPartials' => Page::query()->partials()->where('is_active', true)->get(),
        ]);
    }

    public function store(PagePartialRequest $request)
    {
        $data = array_merge($request->validated(), ['type' => 'partial']);
        $partial = $this->pages->create($data);
        ActivityLogger::log('created', $partial, "Tạo khối dùng chung {$partial->slug}");

        return redirect()->route('admin.partials.edit', $partial)->with('success', 'Đã tạo khối dùng chung.');
    }

    public function storeFromSelection(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'published_html' => ['required', 'string', 'max:1000000'],
            'published_css' => ['nullable', 'string', 'max:500000'],
        ]);

        $defaultLocale = $this->languages->defaultLocale();
        $partial = $this->pages->create([
            'type' => 'partial',
            'partial_role' => 'generic',
            'title' => [$defaultLocale => $validated['title']],
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [$defaultLocale => $validated['published_html']],
            'published_css' => [$defaultLocale => $validated['published_css'] ?? ''],
            'is_active' => true,
        ]);

        ActivityLogger::log('created', $partial, "Tạo khối dùng chung từ builder: {$partial->slug}");

        return response()->json([
            'success' => true,
            'id' => $partial->id,
            'title' => $partial->getTranslation('title', $defaultLocale, false),
        ]);
    }

    public function edit(string $locale, Page $partial)
    {
        abort_unless($partial->isPartial(), 404);

        return view('admin.partials.edit', [
            'page' => $partial->load('localizedSlugs'),
            'contentLanguages' => $this->languages->active(),
            'defaultContentLocale' => $this->languages->defaultLocale(),
            'revisions' => $partial->revisions()->with('creator')->limit(20)->get(),
            'allPartials' => Page::query()->partials()->where('is_active', true)->where('id', '!=', $partial->id)->get(),
        ]);
    }

    public function update(PagePartialRequest $request, string $locale, Page $partial)
    {
        abort_unless($partial->isPartial(), 404);

        $data = array_merge($request->validated(), ['type' => 'partial']);
        $partial = $this->pages->update($partial, $data, $request->user()?->id);
        ActivityLogger::log('updated', $partial, "Cập nhật khối dùng chung {$partial->slug}");

        return redirect()->route('admin.partials.edit', $partial)->with('success', 'Đã lưu khối dùng chung.');
    }

    public function destroy(string $locale, Page $partial)
    {
        abort_unless($partial->isPartial(), 404);

        $partial->delete();
        ActivityLogger::log('deleted', $partial, "Xóa khối dùng chung {$partial->slug}");

        return redirect()->route('admin.partials.index')->with('success', 'Đã xóa khối dùng chung.');
    }

    public function restore(Request $request, string $locale, Page $partial, PageRevision $revision)
    {
        abort_unless($partial->isPartial(), 404);

        $partial = $this->pages->restore($partial, $revision, $request->user()?->id);
        ActivityLogger::log('restored', $partial, "Khôi phục phiên bản khối dùng chung {$partial->slug}", ['revision_id' => $revision->id]);

        return redirect()->route('admin.partials.edit', $partial)->with('success', 'Đã khôi phục phiên bản.');
    }
}
