@extends('layouts.app')

@section('title', 'Lighting Projects in Asia - LuxLight')
@section('meta_description', 'Numerous Sizable Lighting Projects across Hospitality, Residential and Commercial Sectors - LuxLight Singapore')

@push('styles')
<link href="/wp-content/plugins/custom-lux/assets/custom.css" id="custom-carousel-css-css" media="all" rel="stylesheet"/>
<link href="/wp-content/uploads/elementor/css/post-12382.css" id="elementor-post-12382-css" media="all" rel="stylesheet"/>
<style>
    /* Projects Hero Banner Styling - Perfectly Balanced Size */
    .elementor-12382,
    .elementor-12382 *,
    .elementor-12382 .elementor-element.elementor-element-c57d41d,
    .elementor-12382 .hero-projects-content {
        box-sizing: border-box;
        border: none !important;
        outline: none !important;
    }
    .elementor-12382 .elementor-element.elementor-element-c57d41d {
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
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
    }
    
    .elementor-12382 .elementor-element.elementor-element-c57d41d > .elementor-container {
        min-height: 0 !important;
        height: auto !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    
    .elementor-12382 .hero-projects-content {
        max-width: 820px !important;
        margin: 0 auto !important;
        text-align: center !important;
        position: relative !important;
        z-index: 2 !important;
    }
    
    .elementor-12382 .hero-projects-content h1 {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 35px !important;
        font-weight: 300 !important;
        line-height: 46px !important;
        letter-spacing: -0.2px !important;
        color: #FFFFFF !important;
        margin: 0 auto !important;
        max-width: 780px !important;
    }
    
    .elementor-12382 .hero-projects-content p.quote {
        font-family: "Din", sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 300 !important;
        color: #FFFFFF !important;
        margin-top: 18px !important;
        margin-bottom: 4px !important;
        letter-spacing: 0.2px !important;
    }
    
    .elementor-12382 .hero-projects-content p.author {
        font-family: "Din", sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 300 !important;
        color: #FFFFFF !important;
        margin-top: 4px !important;
    }

    /* Section 2: Our Projects 3D Carousel */
    .elementor-12382 .sliderSection {
        background-color: #FFFFFF !important;
        padding: 40px 0 70px 0 !important;
    }
    
    .elementor-12382 .lux-carousel h2 {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 42px !important;
        font-weight: 400 !important;
        color: #0B1523 !important;
        text-align: center !important;
        margin-bottom: 30px !important;
    }
    
    .elementor-12382 .app {
        position: relative !important;
        width: 100% !important;
        min-height: 600px !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        overflow: hidden !important;
    }
    
    .elementor-12382 .cardList__btn {
        background-color: transparent !important;
        border: none !important;
        cursor: pointer !important;
        z-index: 10 !important;
        padding: 10px !important;
        outline: none !important;
        transition: transform 0.3s ease !important;
    }
    .elementor-12382 .cardList__btn:hover {
        transform: translateY(-50%) scale(0.35) !important;
    }

    @media only screen and (max-width: 767px) {
        .elementor-12382 .hero-projects-content h1 {
            font-size: 20px !important;
            line-height: 28px !important;
        }
        .elementor-12382 .elementor-element.elementor-element-c57d41d {
            padding: 35px 15px !important;
        }
    }
    @media (max-width: 991px) {
        .elementor-12382 .premium-blog-post-outer-container {
            width: 50% !important;
        }
    }
    @media (max-width: 640px) {
        .elementor-12382 .premium-blog-post-outer-container {
            width: 100% !important;
        }
    }
</style>
@endpush

@section('content')
<div class="elementor elementor-12382" data-elementor-id="12382" data-elementor-post-type="page" data-elementor-type="wp-page">
    <!-- Hero Banner Section -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-c57d41d elementor-section-full_width elementor-section-height-default elementor-section-items-middle" data-dce-background-color="#000000" data-dce-background-overlay-color="#000000" data-e-type="section" data-element_type="section" data-id="c57d41d" data-settings='{"background_background":"classic"}'>
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-acf0cc5" data-e-type="column" data-element_type="column" data-id="acf0cc5">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="hero-projects-content">
                        <h1>Numerous Sizable Lighting Projects across Hospitality, Residential and Commerical Sectors</h1>
                        <p class="quote">‘When you possess light within, you see it externally’</p>
                        <p class="author">Anas Nin</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3D Carousel Section: Our Projects -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-7f761ee elementor-section-full_width sliderSection elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="7f761ee">
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-355128a" data-e-type="column" data-element_type="column" data-id="355128a">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-fac59b6 elementor-widget elementor-widget-shortcode" data-e-type="widget" data-element_type="widget" data-id="fac59b6" data-widget_type="shortcode.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-shortcode">
                                <section class="subpge pb-0 lux-carousel">
                                    <div class="container-fluid p-0">
                                        <div class="section-header text-center">
                                            <h2>Our Projects</h2>
                                        </div>
                                        <div class="section-body mt-4">
                                            <div class="app">
                                                <div class="cardList">
                                                    <button aria-label="Previous" class="cardList__btn btn btn--left" type="button">
                                                        <img alt="Previous" decoding="async" src="/wp-content/plugins/custom-lux/assets/icon_arrow_long-brown.svg"/>
                                                    </button>
                                                    <div class="cards__wrapper">
                                                        <a class="card current--card" href="{{ route('projects.hospitality') }}">
                                                            <div class="card__image">
                                                                <img alt="Hospitality Projects" decoding="async" src="/wp-content/uploads/2021/12/Residential_2000x2577-scaled.jpg"/>
                                                            </div>
                                                        </a>
                                                        <a class="card next--card" href="{{ route('projects.residential') }}">
                                                            <div class="card__image">
                                                                <img alt="Residential Projects" decoding="async" src="/wp-content/uploads/2021/12/Residential_663x854.jpg"/>
                                                            </div>
                                                        </a>
                                                        <a class="card previous--card" href="{{ route('projects.commercial') }}">
                                                            <div class="card__image">
                                                                <img alt="Commercial Projects" decoding="async" src="/wp-content/uploads/2021/12/Commercial_384x495.jpg"/>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <button aria-label="Next" class="cardList__btn btn btn--right" type="button">
                                                        <img alt="Next" decoding="async" src="/wp-content/plugins/custom-lux/assets/icon_arrow_long-brown.svg"/>
                                                    </button>
                                                </div>
                                                <div class="infoList">
                                                    <div class="info__wrapper">
                                                        <div class="info current--info">
                                                            <h3 class="text name">Hospitality</h3>
                                                            <p class="text description">Our Projects</p>
                                                        </div>
                                                        <div class="info next--info">
                                                            <h3 class="text name">Residential</h3>
                                                            <p class="text description">Our Projects</p>
                                                        </div>
                                                        <div class="info previous--info">
                                                            <h3 class="text name">Commercial</h3>
                                                            <p class="text description">Our Projects</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="app__bg">
                                                    <div class="app__bg__image current--image">
                                                        <img alt="" decoding="async" src="/wp-content/uploads/2021/12/Residential_2000x2577-scaled.jpg"/>
                                                    </div>
                                                    <div class="app__bg__image next--image">
                                                        <img alt="" decoding="async" src="/wp-content/uploads/2021/12/Residential_663x854.jpg"/>
                                                    </div>
                                                    <div class="app__bg__image previous--image">
                                                        <img alt="" decoding="async" src="/wp-content/uploads/2021/12/Commercial_384x495.jpg"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="loading__wrapper">
                                                <div class="loader--text">Loading...</div>
                                                <div class="loader"><span></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Projects List Section -->
    <section class="elementor-section elementor-top-section project-filter-section elementor-section-full_width elementor-section-height-default" style="background-color: #ffffff; padding: 60px 0 80px 0;">
        <div class="elementor-container elementor-column-gap-default" style="max-width: 1200px; margin: 0 auto; padding: 0 15px; display: block;">
            <div class="elementor-widget-wrap" style="width: 100%; display: block;">
                <!-- Filter Tabs -->
                <div class="elementor-widget elementor-widget-icon-list" style="margin-bottom: 45px; width: 100%; text-align: center;">
                    <ul class="elementor-icon-list-items elementor-inline-items" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 36px; list-style: none; padding: 0; margin: 0;">
                        <li class="elementor-icon-list-item elementor-inline-item">
                            <a class="{{ empty($category) ? 'active' : '' }}" href="{{ url('/du-an') }}" style="font-family: 'DIN', sans-serif; font-size: 22px; font-weight: 500; color: {{ empty($category) ? '#EAA931' : '#0B1523' }}; text-decoration: none;">
                                <span class="elementor-icon-list-text">All</span>
                            </a>
                        </li>
                        <li class="elementor-icon-list-item elementor-inline-item">
                            <a href="{{ url('/hospitality-lighting-projects') }}" style="font-family: 'DIN', sans-serif; font-size: 22px; font-weight: 400; color: #0B1523; text-decoration: none;">
                                <span class="elementor-icon-list-text">Hospitality</span>
                            </a>
                        </li>
                        <li class="elementor-icon-list-item elementor-inline-item">
                            <a href="{{ url('/residential-lighting-projects') }}" style="font-family: 'DIN', sans-serif; font-size: 22px; font-weight: 400; color: #0B1523; text-decoration: none;">
                                <span class="elementor-icon-list-text">Residential</span>
                            </a>
                        </li>
                        <li class="elementor-icon-list-item elementor-inline-item">
                            <a href="{{ url('/commercial-lighting-projects') }}" style="font-family: 'DIN', sans-serif; font-size: 22px; font-weight: 400; color: #0B1523; text-decoration: none;">
                                <span class="elementor-icon-list-text">Commercial</span>
                            </a>
                        </li>
                        <li class="elementor-icon-list-item elementor-inline-item">
                            <a href="{{ url('/other-lighting-projects') }}" style="font-family: 'DIN', sans-serif; font-size: 22px; font-weight: 400; color: #0B1523; text-decoration: none;">
                                <span class="elementor-icon-list-text">Others</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Dynamic Projects Grid -->
                <div class="premium-blog-wrap premium-blog-even" style="display: flex; flex-wrap: wrap; width: 100%; margin: 0 -15px;">
                    @forelse($projects as $project)
                        @php
                            $locale = app()->getLocale();
                            $title = $project->getTranslation('title', $locale, false) ?: $project->getTranslation('title', 'en', false) ?: $project->title;
                            $location = $project->getTranslation('location', $locale, false) ?: $project->getTranslation('location', 'en', false);
                            $img = $project->image_url ?: asset('images/icons/default-product.png');
                            $detailUrl = url('/projects/' . ($project->slug ?: $project->id));
                        @endphp
                        <div class="premium-blog-post-outer-container" style="width: 33.333333%; max-width: 33.333333%; flex: 0 0 33.333333%; padding: 0 15px 30px 15px; box-sizing: border-box; display: block;">
                            <div class="premium-blog-post-container" style="position: relative; overflow: hidden; height: 380px; background-color: #0B1523; border-radius: 4px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); width: 100%;">
                                <div class="premium-blog-thumb-effect-wrapper" style="position: absolute; inset: 0; overflow: hidden; width: 100%; height: 100%;">
                                    <div class="premium-blog-thumbnail-container" style="width: 100%; height: 100%;">
                                        <img alt="{{ $title }}"
                                             src="{{ $img }}"
                                             onerror="this.onerror=null;this.src='{{ asset('images/icons/default-product.png') }}';"
                                             style="width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);"
                                             loading="lazy" />
                                    </div>
                                    <a class="premium-blog-thumbnail-overlay" href="{{ $detailUrl }}" style="position: absolute; inset: 0; z-index: 2; display: block;">
                                        <span class="sr-only">{{ $title }}</span>
                                    </a>
                                </div>
                                <div class="premium-blog-content-wrapper" style="position: absolute; left: 0; right: 0; bottom: 0; padding: 30px 24px 20px 24px; background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(11, 21, 35, 0.75) 50%, rgba(11, 21, 35, 0.92) 100%); z-index: 3; display: flex; flex-direction: column; pointer-events: none;">
                                    <div class="premium-blog-inner-container">
                                        <h2 class="premium-blog-entry-title" style="margin: 0; font-family: 'ACaslonPro', serif; font-size: 24px; font-weight: 400; line-height: 30px; color: #FFFFFF;">
                                            <a href="{{ $detailUrl }}" style="color: #FFFFFF; text-decoration: none; pointer-events: auto;">
                                                {{ $title }}
                                            </a>
                                        </h2>
                                        @if($location)
                                            <div class="premium-blog-entry-location" style="font-family: 'DIN', sans-serif; font-size: 13px; letter-spacing: 0.5px; text-transform: uppercase; color: #EAA931; margin-top: 6px;">
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
                    <div class="lux-projects-pagination" style="margin-top: 40px; margin-bottom: 20px; display: flex; justify-content: center; width: 100%;">
                        {{ $projects->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="/wp-content/plugins/custom-lux/assets/TweenLite.min.js"></script>
<script src="/wp-content/plugins/custom-lux/assets/imagesloaded.pkgd.min.js"></script>
<script src="/wp-content/plugins/custom-lux/assets/CSSPlugin.min.js"></script>
<script src="/wp-content/plugins/custom-lux/assets/gsap.min.js"></script>
<script src="/wp-content/plugins/custom-lux/assets/carousel.js"></script>
@endpush
