@extends('layouts.app')

@php
    $locale = app()->getLocale();
    $title = $project->getTranslation('title', $locale) ?: $project->getTranslation('title', 'en');
    $location = $project->getTranslation('location', $locale) ?: $project->getTranslation('location', 'en');
    $summary = $project->getTranslation('summary', $locale) ?: $project->getTranslation('summary', 'en');
    $content = $project->getTranslation('content', $locale) ?: $project->getTranslation('content', 'en');
    $bannerImage = $project->banner_url ?: ($project->image_url ?: '/wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x.jpg');
    $gallery = is_array($project->gallery) && count($project->gallery) > 0 ? $project->gallery : ($project->image_url ? [$project->image_url] : [$bannerImage]);
@endphp

@section('title', $title . ' - LuxLight')
@section('meta_description', $summary ?: 'Lighting project ' . $title . ' by LuxLight Singapore.')

@push('styles')
<link rel="stylesheet" href="/wp-content/uploads/elementor/css/post-7892.css" media="all">
<link rel="stylesheet" href="/wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min.css" media="all">
<link rel="stylesheet" href="/wp-content/plugins/elementor/assets/css/conditionals/e-swiper.min.css" media="all">
<style>
    /* Reset & Hero Banner */
    .elementor-7892 {
        width: 100%;
        overflow-x: hidden;
    }
    .elementor-7892 .elementor-element-4a4e154 {
        background-size: cover !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
        min-height: 420px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative !important;
        padding: 80px 20px !important;
        margin: 0 !important;
    }
    .elementor-7892 .elementor-element-4a4e154 .elementor-background-overlay {
        position: absolute !important;
        inset: 0 !important;
        background-color: rgba(0, 0, 0, 0.48) !important;
        z-index: 1 !important;
    }
    .elementor-7892 .elementor-element-4a4e154 .elementor-container {
        position: relative !important;
        z-index: 2 !important;
        width: 100% !important;
        max-width: 1100px !important;
        margin: 0 auto !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        text-align: center !important;
    }
    .elementor-7892 .elementor-element-58f1af6 {
        width: 100% !important;
        text-align: center !important;
    }
    .elementor-7892 .elementor-element-58f1af6 h1,
    .elementor-7892 .elementor-element-58f1af6 .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 46px !important;
        font-weight: 300 !important;
        line-height: 56px !important;
        letter-spacing: -0.5px !important;
        color: #FFFFFF !important;
        text-align: center !important;
        margin: 0 auto !important;
        max-width: 900px !important;
        text-shadow: 0 2px 8px rgba(0,0,0,0.4) !important;
    }
    .elementor-7892 .project-hero-location {
        font-family: "DIN", sans-serif !important;
        font-size: 15px !important;
        letter-spacing: 2px !important;
        text-transform: uppercase !important;
        color: #EAA931 !important;
        margin-top: 14px !important;
        font-weight: 500 !important;
        text-align: center !important;
    }

    /* Section 2: Our Project Divider Section */
    .elementor-7892 .elementor-element-19e35a6 {
        background: url('/wp-content/uploads/2021/12/bg-logo-3-2.jpg') top left no-repeat !important;
        background-size: 25% auto !important;
        padding: 50px 20px 20px 20px !important;
        width: 100% !important;
    }
    .elementor-7892 .elementor-element-8fc6156 .elementor-container {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;
        max-width: 1200px !important;
        margin: 0 auto !important;
        width: 100% !important;
    }
    .elementor-7892 .elementor-element-1852d49,
    .elementor-7892 .elementor-element-3ea48f2 {
        flex: 1 1 35% !important;
        width: 35% !important;
    }
    .elementor-7892 .elementor-element-228a1a1 {
        flex: 0 0 auto !important;
        padding: 0 28px !important;
        text-align: center !important;
    }
    .elementor-7892 .elementor-element-8d6bab3 .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 42px !important;
        font-weight: 400 !important;
        color: #112135 !important;
        margin: 0 !important;
        white-space: nowrap !important;
    }
    .elementor-7892 .elementor-divider-separator {
        display: block !important;
        width: 100% !important;
        border-top: 1px solid #E2E8F0 !important;
    }

    /* Section 3: 2-Column Side-by-Side Content */
    .elementor-7892 .elementor-element-12dd6ed {
        padding: 30px 20px 80px 20px !important;
        width: 100% !important;
    }
    .elementor-7892 .elementor-element-12dd6ed > .elementor-container {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        max-width: 1200px !important;
        margin: 0 auto !important;
        align-items: flex-start !important;
        width: 100% !important;
    }
    .elementor-7892 .elementor-element-6a7ea84 {
        width: 50% !important;
        flex: 0 0 50% !important;
        box-sizing: border-box !important;
        padding-right: 25px !important;
    }
    .elementor-7892 .elementor-element-55fee92 {
        width: 50% !important;
        flex: 0 0 50% !important;
        box-sizing: border-box !important;
        padding-left: 35px !important;
    }
    .elementor-7892 .swiper-slide-image {
        width: 100% !important;
        height: 480px !important;
        object-fit: cover !important;
        border-radius: 0px 40px 0px 0px !important;
        display: block !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08) !important;
    }
    .elementor-7892 .elementor-element-cec0b8c .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 26px !important;
        font-weight: 700 !important;
        line-height: 34px !important;
        color: #AB9A71 !important;
        margin-top: 0 !important;
        margin-bottom: 8px !important;
    }
    .elementor-7892 .elementor-element-4d2777e {
        font-family: "DIN", sans-serif !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        letter-spacing: 1px !important;
        text-transform: uppercase !important;
        color: #64748B !important;
        margin-bottom: 22px !important;
    }
    .elementor-7892 .elementor-element-a64eeda {
        font-family: "DIN", sans-serif !important;
        font-size: 15px !important;
        line-height: 26px !important;
        color: #112135 !important;
    }
    .elementor-7892 .elementor-element-a64eeda p {
        margin-bottom: 16px !important;
    }
    .elementor-7892 .elementor-element-ef6b01d .elementor-button {
        display: inline-block !important;
        background-color: #0B1523 !important;
        font-family: "DIN", sans-serif !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        letter-spacing: 1.5px !important;
        text-transform: uppercase !important;
        color: #FFFFFF !important;
        text-decoration: none !important;
        padding: 14px 44px !important;
        border-radius: 2px !important;
        transition: all 0.3s ease !important;
        cursor: pointer !important;
        margin-top: 20px !important;
    }
    .elementor-7892 .elementor-element-ef6b01d .elementor-button:hover {
        background-color: #EAA931 !important;
        color: #FFFFFF !important;
    }

    @media (max-width: 900px) {
        .elementor-7892 .elementor-element-6a7ea84,
        .elementor-7892 .elementor-element-55fee92 {
            width: 100% !important;
            flex: 0 0 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .elementor-7892 .elementor-element-55fee92 {
            margin-top: 35px !important;
        }
        .elementor-7892 .elementor-element-58f1af6 h1 {
            font-size: 32px !important;
            line-height: 40px !important;
        }
        .elementor-7892 .elementor-element-8d6bab3 .elementor-heading-title {
            font-size: 30px !important;
        }
        .elementor-7892 .swiper-slide-image {
            height: 340px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="elementor elementor-7892 elementor-location-single">
    <!-- Hero Banner Section -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-4a4e154 elementor-section-full_width elementor-section-height-default elementor-section-items-middle" style="background-image: url('{{ $bannerImage }}');">
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-element elementor-element-58f1af6 elementor-widget elementor-widget-heading">
                <div class="elementor-widget-container">
                    <h1 class="elementor-heading-title elementor-size-default">
                        {{ $title }}
                    </h1>
                    @if($location)
                        <div class="project-hero-location">
                            {{ $location }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Our Project Title & Dividers -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-19e35a6 elementor-section-full_width elementor-section-height-default">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-968158b">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <section class="elementor-section elementor-inner-section elementor-element elementor-element-8fc6156 elementor-section-full_width elementor-section-content-middle elementor-section-height-default">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-1852d49">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-31a99b4 elementor-widget-divider--view-line elementor-widget elementor-widget-divider">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-divider">
                                                <span class="elementor-divider-separator"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-228a1a1">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-8d6bab3 elementor-widget elementor-widget-heading">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">
                                                Our Project
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-3ea48f2">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-69571bb elementor-widget-divider--view-line elementor-widget elementor-widget-divider">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-divider">
                                                <span class="elementor-divider-separator"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: 2-Column Side-by-Side Content -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-12dd6ed elementor-section-full_width elementor-section-height-default">
        <div class="elementor-container elementor-column-gap-default">
            <!-- Left Column: Gallery / Carousel (50%) -->
            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-6a7ea84">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-0b29f2b elementor-pagination-position-inside project-carousel elementor-widget elementor-widget-image-carousel">
                        <div class="elementor-widget-container">
                            <div class="elementor-image-carousel-wrapper swiper" dir="ltr">
                                <div class="elementor-image-carousel swiper-wrapper">
                                    @foreach($gallery as $imgUrl)
                                        <div class="swiper-slide">
                                            <figure class="swiper-slide-inner">
                                                <img alt="{{ $title }}"
                                                     class="swiper-slide-image"
                                                     src="{{ $imgUrl }}"
                                                     onerror="this.onerror=null;this.src='{{ asset('images/icons/default-product.png') }}';"
                                                     loading="lazy"/>
                                            </figure>
                                        </div>
                                    @endforeach
                                </div>
                                @if(count($gallery) > 1)
                                    <div class="swiper-pagination"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Project Details (50%) -->
            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-55fee92">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <!-- Project Title -->
                    <div class="elementor-element elementor-element-cec0b8c elementor-widget elementor-widget-heading">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">
                                {{ $title }}
                            </h2>
                        </div>
                    </div>

                    <!-- Project Location -->
                    @if($location)
                        <div class="elementor-element elementor-element-4d2777e elementor-widget elementor-widget-text-editor">
                            <div class="elementor-widget-container">
                                {{ $location }}
                            </div>
                        </div>
                    @endif

                    <!-- Details Body -->
                    <div class="elementor-element elementor-element-a64eeda elementor-widget elementor-widget-text-editor">
                        <div class="elementor-widget-container">
                            @if($project->completion_year)
                                <p style="margin-bottom: 12px; font-weight: 500;">
                                    {{ str_starts_with(strtolower($project->completion_year), 'project') ? $project->completion_year : 'Project Completion in ' . $project->completion_year . '.' }}
                                </p>
                            @endif

                            @if($summary)
                                <p style="margin-bottom: 16px; line-height: 1.8;">
                                    {!! nl2br(e($summary)) !!}
                                </p>
                            @endif

                            @if($content)
                                <p style="margin-top: 20px; margin-bottom: 8px; font-weight: 600; color: #112135;">
                                    What LuxLight provides?
                                </p>
                                <div style="line-height: 1.8; color: #475569;">
                                    {!! nl2br(e($content)) !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Back to List Button -->
                    <section class="elementor-section elementor-inner-section elementor-element elementor-element-d634e1e elementor-section-full_width elementor-section-height-default">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-02941d8">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-ef6b01d elementor-align-left elementor-widget elementor-widget-button">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                <a class="elementor-button elementor-button-link elementor-size-sm" href="{{ url($project->categoryUrl()) }}">
                                                    <span class="elementor-button-content-wrapper">
                                                        <span class="elementor-button-text">Back to List</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="/wp-content/plugins/elementor/assets/lib/swiper/v8/swiper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined' && document.querySelector('.project-carousel .swiper-slide')) {
        var slideCount = document.querySelectorAll('.project-carousel .swiper-slide').length;
        if (slideCount > 1) {
            new Swiper('.project-carousel .swiper', {
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.project-carousel .swiper-pagination',
                    clickable: true,
                },
            });
        }
    }
});
</script>
@endpush
