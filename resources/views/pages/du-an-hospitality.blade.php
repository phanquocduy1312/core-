@extends('layouts.app')

@section('title', 'Hospitality Lighting Projects - LuxLight')
@section('meta_description', 'Numerous Sizable Lighting Projects across Hospitality, Residential and Commercial Sectors - LuxLight Singapore')

@push('styles')
<link href="/wp-content/uploads/elementor/css/post-5335.css" id="elementor-post-5335-css" media="all" rel="stylesheet"/>
<link href="/wp-content/uploads/premium-addons-elementor/pafe-5335.css" id="pafe-5335-css" media="all" rel="stylesheet"/>
<style>
    /* Projects Hero Banner Styling - Perfectly Balanced Size */
    .elementor-5335,
    .elementor-5335 *,
    .elementor-5335 .hero-projects-content {
        box-sizing: border-box;
        border: none !important;
        outline: none !important;
    }
    .elementor-5335 .hero-projects-section {
        background: linear-gradient(rgba(11, 21, 35, 0.72), rgba(11, 21, 35, 0.72)), url('/wp-content/uploads/2021/12/Marina-One@2x.jpg') center/cover no-repeat !important;
        min-height: 380px !important;
        height: auto !important;
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 70px 20px 60px 20px !important;
        margin: 0 !important;
        overflow: hidden !important;
    }
    .elementor-5335 .hero-projects-content {
        max-width: 820px !important;
        margin: 0 auto !important;
        text-align: center !important;
        position: relative !important;
        z-index: 2 !important;
    }
    .elementor-5335 .hero-projects-content h1 {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 35px !important;
        font-weight: 300 !important;
        line-height: 46px !important;
        letter-spacing: -0.2px !important;
        color: #FFFFFF !important;
        margin: 0 auto !important;
        max-width: 780px !important;
    }
    .elementor-5335 .hero-projects-content p.quote {
        font-family: "Din", sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 300 !important;
        color: #FFFFFF !important;
        margin-top: 18px !important;
        margin-bottom: 4px !important;
        letter-spacing: 0.2px !important;
    }
    .elementor-5335 .hero-projects-content p.author {
        font-family: "Din", sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 300 !important;
        color: #FFFFFF !important;
        margin-top: 4px !important;
    }

    /* Filter Bar Styling */
    .elementor-5335 .project-filter-section {
        background-color: #FFFFFF !important;
        padding: 50px 20px 30px 20px !important;
    }
    .elementor-5335 .elementor-icon-list-items {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 36px !important;
        padding: 0 !important;
        margin: 0 auto 35px auto !important;
        list-style: none !important;
    }
    .elementor-5335 .elementor-icon-list-item {
        margin: 0 !important;
        padding: 0 !important;
    }
    .elementor-5335 .elementor-icon-list-item a {
        font-family: "DIN", sans-serif !important;
        font-size: 22px !important;
        font-weight: 400 !important;
        color: #0B1523 !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }
    .elementor-5335 .elementor-icon-list-item a:hover {
        color: #EAA931 !important;
    }
    .elementor-5335 .elementor-icon-list-item.active a,
    .elementor-5335 .elementor-icon-list-item a.active {
        color: #EAA931 !important;
        font-weight: 500 !important;
    }

    /* 3-Column Premium Blog Grid Styling */
    .elementor-5335 .premium-blog-wrap {
        display: flex !important;
        flex-wrap: wrap !important;
        margin: 0 -15px !important;
    }
    .elementor-5335 .premium-blog-post-outer-container {
        width: 33.333333% !important;
        padding: 0 15px 30px 15px !important;
        box-sizing: border-box !important;
        display: block !important;
    }
    .elementor-5335 .premium-blog-post-container {
        position: relative !important;
        overflow: hidden !important;
        height: 380px !important;
        background-color: #0B1523 !important;
        border-radius: 4px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06) !important;
    }
    .elementor-5335 .premium-blog-thumb-effect-wrapper {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        overflow: hidden !important;
    }
    .elementor-5335 .premium-blog-thumbnail-container {
        width: 100% !important;
        height: 100% !important;
        overflow: hidden !important;
    }
    .elementor-5335 .premium-blog-thumbnail-container img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }
    .elementor-5335 .premium-blog-post-container:hover .premium-blog-thumbnail-container img {
        transform: scale(1.08) !important;
    }
    .elementor-5335 .premium-blog-content-wrapper {
        position: absolute !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        padding: 30px 24px 20px 24px !important;
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(11, 21, 35, 0.75) 50%, rgba(11, 21, 35, 0.92) 100%) !important;
        z-index: 3 !important;
        display: flex !important;
        flex-direction: column !important;
        pointer-events: none !important;
    }
    .elementor-5335 .premium-blog-entry-title {
        margin: 0 !important;
        padding: 0 !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .elementor-5335 .premium-blog-entry-title a {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 24px !important;
        font-weight: 400 !important;
        line-height: 30px !important;
        color: #FFFFFF !important;
        opacity: 1 !important;
        visibility: visible !important;
        text-decoration: none !important;
        pointer-events: auto !important;
        display: inline-block !important;
    }
    .elementor-5335 .premium-blog-entry-title a:hover {
        color: #EAA931 !important;
    }
    .elementor-5335 .premium-blog-entry-location {
        font-family: "DIN", sans-serif !important;
        font-size: 13px !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        color: #EAA931 !important;
        margin-top: 6px !important;
    }

    @media (max-width: 991px) {
        .elementor-5335 .premium-blog-post-outer-container {
            width: 50% !important;
        }
    }
    @media (max-width: 640px) {
        .elementor-5335 .premium-blog-post-outer-container {
            width: 100% !important;
        }
        .elementor-5335 .hero-projects-content h1 {
            font-size: 24px !important;
            line-height: 32px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="elementor elementor-5335" data-elementor-id="5335" data-elementor-post-type="page" data-elementor-type="wp-page">
    <!-- Hero Banner Section -->
    <section class="elementor-section elementor-top-section hero-projects-section elementor-section-full_width elementor-section-height-default">
        <div class="elementor-container elementor-column-gap-default">
            <div class="hero-projects-content">
                <h1>Numerous Sizable Lighting Projects across Hospitality, Residential and Commercial Sectors</h1>
                <p class="quote">‘When you possess light within, you see it externally’</p>
                <p class="author">Anas Nin</p>
            </div>
        </div>
    </section>

    <!-- Filter Bar & Projects Grid Section -->
    <section class="elementor-section elementor-top-section project-filter-section elementor-section-full_width elementor-section-height-default">
        <div class="elementor-container elementor-column-gap-default" style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
            <div class="elementor-widget-wrap" style="width: 100%;">
                <!-- Filter Tabs -->
                <div class="elementor-widget elementor-widget-icon-list">
                    <ul class="elementor-icon-list-items elementor-inline-items">
                        <li class="elementor-icon-list-item elementor-inline-item active">
                            <a class="active" href="{{ url('/hospitality-lighting-projects') }}">
                                <span class="elementor-icon-list-text">Hospitality</span>
                            </a>
                        </li>
                        <li class="elementor-icon-list-item elementor-inline-item">
                            <a class="" href="{{ url('/residential-lighting-projects') }}">
                                <span class="elementor-icon-list-text">Residential</span>
                            </a>
                        </li>
                        <li class="elementor-icon-list-item elementor-inline-item">
                            <a class="" href="{{ url('/commercial-lighting-projects') }}">
                                <span class="elementor-icon-list-text">Commercial</span>
                            </a>
                        </li>
                        <li class="elementor-icon-list-item elementor-inline-item">
                            <a class="" href="{{ url('/other-lighting-projects') }}">
                                <span class="elementor-icon-list-text">Others</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Dynamic Projects Grid -->
                <div class="premium-blog-wrap premium-blog-even" data-page="5335">
                    @forelse($projects as $project)
                        @php
                            $locale = app()->getLocale();
                            $title = $project->getTranslation('title', $locale, false) ?: $project->getTranslation('title', 'en', false) ?: $project->title;
                            $location = $project->getTranslation('location', $locale, false) ?: $project->getTranslation('location', 'en', false);
                            $img = $project->image_url ?: asset('images/icons/default-product.png');
                            $detailUrl = url('/projects/' . ($project->slug ?: $project->id));
                        @endphp
                        <div class="premium-blog-post-outer-container">
                            <div class="premium-blog-post-container premium-blog-skin-banner">
                                <div class="premium-blog-thumb-effect-wrapper">
                                    <div class="premium-blog-thumbnail-container premium-blog-none-effect">
                                        <img alt="{{ $title }}"
                                             src="{{ $img }}"
                                             onerror="this.onerror=null;this.src='{{ asset('images/icons/default-product.png') }}';"
                                             loading="lazy" />
                                    </div>
                                    <div class="premium-blog-thumbnail-overlay">
                                        <a class="elementor-icon" href="{{ $detailUrl }}">
                                            <span class="sr-only">{{ $title }}</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="premium-blog-content-wrapper">
                                    <div class="premium-blog-inner-container">
                                        <h2 class="premium-blog-entry-title">
                                            <a href="{{ $detailUrl }}">
                                                {{ $title }}
                                            </a>
                                        </h2>
                                        @if($location)
                                            <div class="premium-blog-entry-location">
                                                {{ $location }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="width: 100%; padding: 80px 20px; text-align: center; color: #64748b;">
                            <p style="font-size: 18px; font-weight: 500;">{{ __('admin.projects.no_projects') }}</p>
                        </div>
                    @endforelse
                </div>

                @if($projects->hasPages())
                    <div class="lux-projects-pagination" style="margin-top: 40px; margin-bottom: 30px; display: flex; justify-content: center; width: 100%;">
                        {{ $projects->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
