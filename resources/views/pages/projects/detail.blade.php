@extends('layouts.app')

@php
    $locale = app()->getLocale();
    $title = $project->getTranslation('title', $locale) ?: $project->getTranslation('title', 'en');
    $location = $project->getTranslation('location', $locale) ?: $project->getTranslation('location', 'en');
    $summary = $project->getTranslation('summary', $locale) ?: $project->getTranslation('summary', 'en');
    $content = $project->getTranslation('content', $locale) ?: $project->getTranslation('content', 'en');
    $bannerImage = $project->banner_url ?: ($project->image_url ?: '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg');
    $gallery = is_array($project->gallery) && count($project->gallery) > 0 ? $project->gallery : ($project->image_url ? [$project->image_url] : []);
@endphp

@section('title', $title . ' - LuxLight Project')

@push('styles')
<link rel="stylesheet" href="/wp-content/uploads/elementor/css/post-7892.css" media="all">
<style>
.project-detail-hero {
    position: relative;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 480px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.project-detail-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
}
.project-detail-hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: #ffffff;
    max-width: 900px;
    padding: 40px 20px;
}
.project-detail-hero h1 {
    font-size: 42px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 12px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.5);
}
.project-detail-hero .hero-location {
    font-size: 20px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #f1f5f9;
}
.project-detail-body {
    padding: 60px 0;
    background: #ffffff;
}
.project-section-title-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 48px;
    gap: 20px;
}
.project-section-title-line {
    flex: 1;
    height: 1px;
    background: #cbd5e1;
    max-width: 200px;
}
.project-section-title {
    font-size: 28px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #1e293b;
    margin: 0;
    text-transform: uppercase;
}
.project-gallery-carousel .swiper-slide img {
    width: 100%;
    height: 480px;
    object-fit: cover;
    border-radius: 8px;
}
.project-info-sidebar {
    padding-left: 24px;
}
.project-info-title {
    font-size: 32px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.25;
}
.project-info-location {
    font-size: 16px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 24px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.project-info-badge {
    display: inline-block;
    background: #f1f5f9;
    color: #334155;
    font-size: 13px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 9999px;
    margin-bottom: 20px;
}
.project-info-desc {
    color: #475569;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 24px;
}
.project-info-scope {
    background: #f8fafc;
    border-left: 4px solid #172033;
    padding: 16px 20px;
    border-radius: 0 8px 8px 0;
    margin-bottom: 32px;
}
.project-info-scope h4 {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
}
.btn-back-to-list {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #172033;
    color: #ffffff !important;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 12px 28px;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-back-to-list:hover {
    background: #334155;
    transform: translateY(-1px);
}
.related-projects-section {
    padding: 60px 0;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}
.related-card {
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.related-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.1);
}
.related-card-img {
    height: 240px;
    width: 100%;
    object-fit: cover;
}
.related-card-body {
    padding: 20px;
    flex-grow: 1;
}
.related-card-title {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
}
.related-card-loc {
    font-size: 13px;
    color: #64748b;
    text-transform: uppercase;
}
</style>
@endpush

@section('content')
<div class="elementor elementor-7892 elementor-location-single">
    <!-- Hero Banner Section -->
    <section class="project-detail-hero" style="background-image: url('{{ $bannerImage }}');">
        <div class="project-detail-hero-content">
            <h1 class="elementor-heading-title">{{ $title }}</h1>
            @if($location)
                <div class="hero-location">{{ $location }}</div>
            @endif
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="project-detail-body">
        <div class="container mx-auto px-4" style="max-width: 1240px;">
            <div class="project-section-title-wrap">
                <div class="project-section-title-line"></div>
                <h2 class="project-section-title">Our Project</h2>
                <div class="project-section-title-line"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Gallery Carousel (Left 7 Cols) -->
                <div class="lg:col-span-7">
                    @if(count($gallery) > 1)
                        <div class="swiper project-gallery-carousel rounded-lg shadow-lg">
                            <div class="swiper-wrapper">
                                @foreach($gallery as $imgUrl)
                                    <div class="swiper-slide">
                                        <img src="{{ $imgUrl }}" alt="{{ $title }}" loading="lazy">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    @elseif(count($gallery) === 1)
                        <div class="rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $gallery[0] }}" alt="{{ $title }}" style="width:100%; height:480px; object-fit:cover;">
                        </div>
                    @else
                        <div class="rounded-lg shadow-lg overflow-hidden" style="background:#e2e8f0; height:480px; display:flex; align-items:center; justify-content:center; color:#64748b;">
                            <span>No project image available</span>
                        </div>
                    @endif
                </div>

                <!-- Project Info (Right 5 Cols) -->
                <div class="lg:col-span-5 project-info-sidebar">
                    <h2 class="project-info-title">{{ $title }}</h2>
                    @if($location)
                        <div class="project-info-location">{{ $location }}</div>
                    @endif

                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="project-info-badge">{{ $project->categoryLabel($locale) }}</span>
                        @if($project->completion_year)
                            <span class="project-info-badge">{{ $project->completion_year }}</span>
                        @endif
                        @if($project->client)
                            <span class="project-info-badge">{{ $project->client }}</span>
                        @endif
                    </div>

                    @if($summary)
                        <div class="project-info-desc">
                            {!! nl2br(e($summary)) !!}
                        </div>
                    @endif

                    @if($content)
                        <div class="project-info-scope">
                            <h4>What LuxLight provides?</h4>
                            <div style="font-size:14px; color:#334155; line-height:1.6;">
                                {!! nl2br(e($content)) !!}
                            </div>
                        </div>
                    @endif

                    <div class="mt-8">
                        <a href="{{ url($project->categoryUrl()) }}" class="btn-back-to-list">
                            <span>Back to List</span>
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Projects Section -->
    @if(isset($relatedProjects) && $relatedProjects->isNotEmpty())
    <section class="related-projects-section">
        <div class="container mx-auto px-4" style="max-width: 1240px;">
            <div class="project-section-title-wrap" style="margin-bottom: 36px;">
                <div class="project-section-title-line"></div>
                <h3 class="project-section-title" style="font-size: 22px;">Related Projects</h3>
                <div class="project-section-title-line"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProjects as $rel)
                    @php
                        $relTitle = $rel->getTranslation('title', $locale) ?: $rel->getTranslation('title', 'en');
                        $relLoc = $rel->getTranslation('location', $locale) ?: $rel->getTranslation('location', 'en');
                        $relImg = $rel->image_url ?: '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg';
                    @endphp
                    <a href="{{ url('/projects/' . $rel->slug) }}" class="related-card">
                        <img src="{{ $relImg }}" alt="{{ $relTitle }}" class="related-card-img" loading="lazy">
                        <div class="related-card-body">
                            <h4 class="related-card-title">{{ $relTitle }}</h4>
                            @if($relLoc)
                                <div class="related-card-loc">{{ $relLoc }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
