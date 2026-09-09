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
        $brands = \App\Models\Brand::query()
            ->active()
            ->ordered()
            ->get();

        return view('pages.thuong-hieu', compact('brands'));
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

    public function subscribeNewsletter(\App\Http\Requests\Front\NewsletterSubscribeRequest $request)
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('newsletter_subscribers')) {
            $subscriber = \App\Models\NewsletterSubscriber::query()->where('email', $request->email)->first();
            if ($subscriber) {
                if (! $subscriber->is_active) {
                    $subscriber->update([
                        'is_active' => true,
                        'subscribed_at' => now(),
                        'unsubscribed_at' => null,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'company' => $request->company,
                        'referral' => $request->referral,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! You are already registered for our newsletter updates.',
                ]);
            }

            \App\Models\NewsletterSubscriber::query()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'company' => $request->company,
                'referral' => $request->referral,
                'is_active' => true,
                'subscribed_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to LuxLight!',
        ]);
    }

    public function submitContact(\App\Http\Requests\Front\ContactInquirySubmitRequest $request)
    {
        $inquiryId = null;
        if (\Illuminate\Support\Facades\Schema::hasTable('contact_inquiries')) {
            $inquiry = \App\Models\ContactInquiry::query()->create([
                'name' => $request->name,
                'title' => $request->title,
                'company' => $request->company,
                'email' => $request->email,
                'phone' => $request->phone,
                'enquiry_type' => $request->enquiry_type ?: 'Sales Enquiry',
                'message' => $request->message,
                'status' => \App\Models\ContactInquiry::STATUS_NEW,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            $inquiryId = $inquiry->id;
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting LuxLight! We will get back to you shortly.',
                'inquiry_id' => $inquiryId,
            ]);
        }

        return back()->with('success', 'Thank you for contacting LuxLight! We will get back to you shortly.');
    }
}

