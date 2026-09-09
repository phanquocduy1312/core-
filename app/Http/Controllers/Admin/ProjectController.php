<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesBulkActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use App\Services\ActivityLogger;
use App\Services\CloudinaryService;
use App\Services\LanguageRegistry;
use App\Services\LocalizedSlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    use HandlesBulkActions;

    public function __construct(
        private readonly LanguageRegistry $languages,
        private readonly LocalizedSlugService $localizedSlugs,
        private readonly CloudinaryService $cloudinary,
    ) {}


    public function index(Request $request, ?string $locale = null)
    {
        $perPage = (int) $request->query('per_page', 10);
        if (! in_array($perPage, [10, 20, 50, 100], true)) {
            $perPage = 10;
        }

        $projects = Project::query()
            ->when($request->query('q'), function ($query, $keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                    ->orWhere('slug', 'like', "%{$keyword}%")
                    ->orWhere('client', 'like', "%{$keyword}%");
            })
            ->when($request->query('category'), function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($request->filled('status'), function ($query) {
                $query->where('is_active', request('status'));
            })
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();

        $categories = Project::CATEGORIES;

        return view('admin.projects.index', compact('projects', 'categories', 'perPage'));
    }

    public function create(?string $locale = null)
    {
        $project = new Project([
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 0,
            'category' => 'hospitality',
        ]);
        $categories = Project::CATEGORIES;
        $locales = $this->languages->codes();

        return view('admin.projects.create', compact('project', 'categories', 'locales'));
    }

    public function store(ProjectRequest $request, ?string $locale = null)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image_url'] = $this->cloudinary->uploadImage($request->file('image'), 'projects');
        }

        if ($request->hasFile('banner')) {
            $validated['banner_url'] = $this->cloudinary->uploadImage($request->file('banner'), 'projects/banners');
        }

        $gallery = is_array($request->input('gallery')) ? $request->input('gallery') : [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $gallery[] = $this->cloudinary->uploadImage($file, 'projects/gallery');
            }
        }
        $validated['gallery'] = array_values(array_filter($gallery));

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        // Auto-generate slugs
        $slugs = [];
        foreach ($this->languages->codes() as $code) {
            $titleInLocale = $validated['title'][$code] ?? $validated['title']['vi'] ?? $validated['title']['en'] ?? '';
            $slugs[$code] = Str::slug($titleInLocale);
        }
        $validated['slug'] = $slugs['vi'] ?? Str::slug($validated['title']['vi'] ?? 'project');

        $project = DB::transaction(function () use ($validated, $slugs) {
            $project = Project::create($validated);
            $this->localizedSlugs->sync($project, $slugs, $validated['title']);
            return $project;
        });

        ActivityLogger::log('create', $project, 'Tạo dự án mới: ' . $project->getTranslation('title', 'vi'));

        return redirect()->route('admin.projects.index')
            ->with('success', __('admin.projects.created_success', ['title' => $project->getTranslation('title', 'vi')]));
    }

    public function edit(string $locale, Project $project)
    {
        $categories = Project::CATEGORIES;
        $locales = $this->languages->codes();

        return view('admin.projects.edit', compact('project', 'categories', 'locales'));
    }

    public function update(ProjectRequest $request, string $locale, Project $project)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image_url'] = $this->cloudinary->uploadImage($request->file('image'), 'projects');
        }

        if ($request->hasFile('banner')) {
            $validated['banner_url'] = $this->cloudinary->uploadImage($request->file('banner'), 'projects/banners');
        }

        $gallery = is_array($request->input('gallery')) ? $request->input('gallery') : ($project->gallery ?: []);
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $gallery[] = $this->cloudinary->uploadImage($file, 'projects/gallery');
            }
        }
        $validated['gallery'] = array_values(array_filter($gallery));

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? $project->sort_order);

        // Auto-generate slugs
        $slugs = [];
        foreach ($this->languages->codes() as $code) {
            $titleInLocale = $validated['title'][$code] ?? $validated['title']['vi'] ?? $validated['title']['en'] ?? '';
            $slugs[$code] = Str::slug($titleInLocale);
        }
        $validated['slug'] = $slugs['vi'] ?? $project->slug;

        DB::transaction(function () use ($project, $validated, $slugs) {
            $project->update($validated);
            $this->localizedSlugs->sync($project, $slugs, $validated['title']);
        });

        ActivityLogger::log('update', $project, 'Cập nhật dự án: ' . $project->getTranslation('title', 'vi'));

        return redirect()->route('admin.projects.index')
            ->with('success', __('admin.projects.updated_success', ['title' => $project->getTranslation('title', 'vi')]));
    }

    public function destroy(string $locale, Project $project)
    {
        $title = $project->getTranslation('title', 'vi');
        ActivityLogger::log('delete', $project, 'Xóa dự án: ' . $title);
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', __('admin.projects.deleted_success', ['title' => $title]));
    }


    public function bulk(Request $request, ?string $locale = null)
    {
        $validated = $this->validatedBulkAction($request, 'projects');
        $ids = $validated['ids'];

        if ($validated['action'] === 'delete') {
            $deleted = DB::transaction(function () use ($ids): int {
                $projects = Project::query()->whereIn('id', $ids)->lockForUpdate()->get();
                $projects->each->delete();

                return $projects->count();
            });

            ActivityLogger::log('bulk_deleted', null, 'Xóa hàng loạt dự án', [
                'model' => Project::class,
                'ids' => $ids,
                'count' => $deleted,
            ]);

            return back()->with('success', __('admin.projects.deleted_bulk_success', ['count' => $deleted]));
        }

        $isActive = $validated['action'] === 'activate';
        $updated = Project::query()->whereIn('id', $ids)->update(['is_active' => $isActive]);

        ActivityLogger::log('bulk_status_changed', null, 'Cập nhật trạng thái hàng loạt dự án', [
            'model' => Project::class,
            'ids' => $ids,
            'count' => $updated,
            'is_active' => $isActive,
        ]);

        return back()->with('success', __('admin.projects.updated_bulk_status', [
            'status' => $isActive ? __('admin.projects.fields.active') : __('admin.projects.fields.inactive'),
            'count' => $updated,
        ]));
    }
}
