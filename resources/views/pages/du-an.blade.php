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

    .elementor-12382 .card {
        cursor: pointer !important;
        text-decoration: none !important;
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
                                                            <h3 class="text name"><a href="{{ route('projects.hospitality') }}" style="color: inherit; text-decoration: none; pointer-events: auto; cursor: pointer;">Hospitality</a></h3>
                                                            <p class="text description">Our Projects</p>
                                                        </div>
                                                        <div class="info next--info">
                                                            <h3 class="text name"><a href="{{ route('projects.residential') }}" style="color: inherit; text-decoration: none; pointer-events: auto; cursor: pointer;">Residential</a></h3>
                                                            <p class="text description">Our Projects</p>
                                                        </div>
                                                        <div class="info previous--info">
                                                            <h3 class="text name"><a href="{{ route('projects.commercial') }}" style="color: inherit; text-decoration: none; pointer-events: auto; cursor: pointer;">Commercial</a></h3>
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
</div>
@endsection

@push('scripts')
<script src="/wp-content/plugins/custom-lux/assets/TweenLite.min.js"></script>
<script src="/wp-content/plugins/custom-lux/assets/imagesloaded.pkgd.min.js"></script>
<script src="/wp-content/plugins/custom-lux/assets/CSSPlugin.min.js"></script>
<script src="/wp-content/plugins/custom-lux/assets/gsap.min.js"></script>
<script src="/wp-content/plugins/custom-lux/assets/carousel.js"></script>
@endpush
