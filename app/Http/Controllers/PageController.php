<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    private function managedPage(string $slug, string $fallback)
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable('pages')) return view($fallback);
        $page = \App\Models\Page::query()->pages()->where('slug', $slug)->first();
        if (! $page || ! app(\App\Support\FeatureGate::class)->enabled('cms_page')) {
            return view($fallback);
        }

        return app(\App\Http\Controllers\Client\PageController::class)->show(app()->getLocale(), $slug);
    }

    public function home()
    {
        return $this->managedPage('trang-chu', 'pages.home');
    }

    public function about()
    {
        return $this->managedPage('gioi-thieu', 'pages.gioi-thieu');
    }

    public function brands()
    {
        return $this->managedPage('thuong-hieu', 'pages.thuong-hieu');
    }

    public function projects()
    {
        return view('pages.du-an');
    }

    public function hospitalityProjects(Request $request)
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable('projects')) {
            $projects = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
            return view('pages.du-an-hospitality', compact('projects'));
        }

        $projects = \App\Models\Project::query()
            ->where('is_active', true)
            ->where('category', 'hospitality')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('pages.du-an-hospitality', compact('projects'));
    }

    public function residentialProjects(Request $request)
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable('projects')) {
            $projects = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
            return view('pages.du-an-residential', compact('projects'));
        }

        $projects = \App\Models\Project::query()
            ->where('is_active', true)
            ->where('category', 'residential')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('pages.du-an-residential', compact('projects'));
    }

    public function commercialProjects(Request $request)
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable('projects')) {
            $projects = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
            return view('pages.du-an-commercial', compact('projects'));
        }

        $projects = \App\Models\Project::query()
            ->where('is_active', true)
            ->where('category', 'commercial')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('pages.du-an-commercial', compact('projects'));
    }

    public function otherProjects(Request $request)
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable('projects')) {
            $projects = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 12);
            return view('pages.du-an-other', compact('projects'));
        }

        $projects = \App\Models\Project::query()
            ->where('is_active', true)
            ->where('category', 'other')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('pages.du-an-other', compact('projects'));
    }

    public function projectDetail(string $slug)
    {
        $locale = app()->getLocale();
        $project = null;

        if (\Illuminate\Support\Facades\Schema::hasTable('projects')) {
            $project = \App\Models\Project::query()->where('is_active', true)
                ->where(function ($query) use ($slug, $locale) {
                    $query->where('slug', $slug)
                        ->orWhere("slug->{$locale}", $slug)
                        ->orWhere('slug->vi', $slug)
                        ->orWhere('slug->en', $slug);
                })->first();

            if (! $project && \Illuminate\Support\Facades\Schema::hasTable('localized_slugs')) {
                $type = (new \App\Models\Project())->getMorphClass();
                $localized = \App\Models\LocalizedSlug::query()
                    ->where('sluggable_type', $type)
                    ->where('slug', $slug)
                    ->first();
                if ($localized) {
                    $project = \App\Models\Project::query()->where('is_active', true)->find($localized->sluggable_id);
                }
            }
        }

        if ($project) {
            $relatedProjects = \App\Models\Project::query()
                ->where('is_active', true)
                ->where('id', '!=', $project->id)
                ->where('category', $project->category)
                ->orderBy('sort_order')
                ->latest('id')
                ->limit(3)
                ->get();

            return view('pages.projects.detail', compact('project', 'relatedProjects'));
        }

        $viewName = "pages.projects.{$slug}";
        if (View::exists($viewName)) {
            return view($viewName);
        }

        return redirect()->route('projects.list');
    }


    public function technicalSupport()
    {
        return view('pages.ho-tro-ky-thuat');
    }

    public function news()
    {
        return view('pages.tin-tuc');
    }

    public function contact()
    {
        return $this->managedPage('lien-he', 'pages.lien-he');
    }

    public function privacyPolicy()
    {
        return $this->managedPage('privacy-policy', 'pages.privacy-policy');
    }

    public function termsOfUse()
    {
        return $this->managedPage('terms-of-use', 'pages.terms-of-use');
    }

    public function subscribeNewsletter(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'referral' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill in all required fields properly.',
                'errors' => $validator->errors(),
            ], 422);
        }

        \Illuminate\Support\Facades\Log::info('Newsletter subscriber:', $request->only(['first_name', 'last_name', 'email', 'company', 'referral']));

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to LuxLight!',
        ]);
    }
}
