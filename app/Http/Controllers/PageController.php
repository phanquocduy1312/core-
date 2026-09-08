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
        return $this->managedPage('du-an', 'pages.du-an');
    }

    public function hospitalityProjects()
    {
        return view('pages.du-an-hospitality');
    }

    public function residentialProjects()
    {
        return view('pages.du-an-residential');
    }

    public function commercialProjects()
    {
        return view('pages.du-an-commercial');
    }

    public function otherProjects()
    {
        return view('pages.du-an-other');
    }

    public function projectDetail(string $slug)
    {
        $viewName = "pages.projects.{$slug}";
        if (View::exists($viewName)) {
            return view($viewName);
        }

        // Generic fallback or 404
        return view('pages.du-an');
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
        return view('pages.privacy-policy');
    }

    public function termsOfUse()
    {
        return view('pages.terms-of-use');
    }
}
