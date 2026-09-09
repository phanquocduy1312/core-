@extends('layouts.app')

@section('title', 'Commercial Lighting Projects - LuxLight')
@section('meta_description', 'Numerous Sizable Lighting Projects across Hospitality, Residential and Commercial Sectors - LuxLight Singapore')

@push('styles')
<link href="/wp-content/uploads/elementor/css/post-10034.css" id="elementor-post-10034-css" media="all" rel="stylesheet"/>
<link href="/wp-content/uploads/premium-addons-elementor/pafe-10034.css" id="pafe-10034-css" media="all" rel="stylesheet"/>
<style>
    /* Projects Hero Banner Styling - Perfectly Balanced Size */
    .elementor-10034,
    .elementor-10034 *,
    .elementor-10034 .elementor-element.elementor-element-289d27d,
    .elementor-10034 .hero-projects-content {
        box-sizing: border-box;
        border: none !important;
        outline: none !important;
    }
    .elementor-10034 .elementor-element.elementor-element-289d27d {
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
    
    .elementor-10034 .elementor-element.elementor-element-289d27d > .elementor-container {
        min-height: 0 !important;
        height: auto !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    
    .elementor-10034 .hero-projects-content {
        max-width: 820px !important;
        margin: 0 auto !important;
        text-align: center !important;
        position: relative !important;
        z-index: 2 !important;
    }
    
    .elementor-10034 .hero-projects-content h1 {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 35px !important;
        font-weight: 300 !important;
        line-height: 46px !important;
        letter-spacing: -0.2px !important;
        color: #FFFFFF !important;
        margin: 0 auto !important;
        max-width: 780px !important;
    }
    
    .elementor-10034 .hero-projects-content p.quote {
        font-family: "Din", sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 300 !important;
        color: #FFFFFF !important;
        margin-top: 18px !important;
        margin-bottom: 4px !important;
        letter-spacing: 0.2px !important;
    }
    
    .elementor-10034 .hero-projects-content p.author {
        font-family: "Din", sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 300 !important;
        color: #FFFFFF !important;
        margin-top: 4px !important;
    }

    /* Filter Bar Styling */
    .elementor-10034 .elementor-element.elementor-element-1c966ca {
        background-color: #FFFFFF !important;
        padding: 50px 20px 30px 20px !important;
    }
    .elementor-10034 .elementor-element-3485a33 {
        display: none !important;
    }
    .elementor-10034 .elementor-element-5f58de5 .elementor-icon-list-items {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 36px !important;
        padding: 0 !important;
        margin: 0 auto 35px auto !important;
        list-style: none !important;
    }
    .elementor-10034 .elementor-element-5f58de5 .elementor-icon-list-item {
        margin: 0 !important;
        padding: 0 !important;
    }
    .elementor-10034 .elementor-element-5f58de5 .elementor-icon-list-item a {
        font-family: "DIN", sans-serif !important;
        font-size: 22px !important;
        font-weight: 400 !important;
        color: #0B1523 !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }
    .elementor-10034 .elementor-element-5f58de5 .elementor-icon-list-item a:hover {
        color: #EAA931 !important;
    }
    .elementor-10034 .elementor-element-5f58de5 .elementor-icon-list-item.active a,
    .elementor-10034 .elementor-element-5f58de5 .elementor-icon-list-item a.active {
        color: #EAA931 !important;
        font-weight: 500 !important;
    }

    /* 3-Column Premium Blog Grid Styling */
    .elementor-10034 .premium-blog-wrap {
        display: flex !important;
        flex-wrap: wrap !important;
        margin: 0 -15px !important;
    }
    .elementor-10034 .premium-blog-post-outer-container {
        width: 33.333333% !important;
        padding: 0 15px 30px 15px !important;
        box-sizing: border-box !important;
        display: block !important;
    }
    .elementor-10034 .premium-blog-post-container {
        position: relative !important;
        overflow: hidden !important;
        height: 380px !important;
        background-color: #0B1523 !important;
        border-radius: 4px !important;
    }
    .elementor-10034 .premium-blog-thumb-effect-wrapper {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        overflow: hidden !important;
    }
    .elementor-10034 .premium-blog-thumbnail-container {
        width: 100% !important;
        height: 100% !important;
        overflow: hidden !important;
    }
    .elementor-10034 .premium-blog-thumbnail-container img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }
    .elementor-10034 .premium-blog-post-container:hover .premium-blog-thumbnail-container img {
        transform: scale(1.08) !important;
    }
    .elementor-10034 .premium-blog-content-wrapper {
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
    .elementor-10034 .premium-blog-entry-title {
        margin: 0 !important;
        padding: 0 !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .elementor-10034 .premium-blog-entry-title a {
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
    .elementor-10034 .premium-blog-thumbnail-overlay {
        display: none !important;
    }

    @media (max-width: 991px) {
        .elementor-10034 .premium-blog-post-outer-container {
            width: 50% !important;
        }
        .elementor-10034 .premium-blog-post-container {
            height: 320px !important;
        }
    }
    @media (max-width: 640px) {
        .elementor-10034 .hero-projects-content h1 {
            font-size: 22px !important;
            line-height: 30px !important;
        }
        .elementor-10034 .elementor-element.elementor-element-289d27d {
            padding: 40px 15px !important;
            min-height: 280px !important;
        }
        .elementor-10034 .elementor-element-5f58de5 .elementor-icon-list-items {
            gap: 16px !important;
        }
        .elementor-10034 .elementor-element-5f58de5 .elementor-icon-list-item a {
            font-size: 18px !important;
        }
        .elementor-10034 .premium-blog-post-outer-container {
            width: 100% !important;
        }
        .elementor-10034 .premium-blog-post-container {
            height: 280px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="elementor elementor-10034" data-elementor-id="10034" data-elementor-post-type="page" data-elementor-type="wp-page">
    <!-- Hero Banner Section -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-289d27d elementor-section-full_width elementor-section-height-default elementor-section-items-middle" data-dce-background-color="#000000" data-dce-background-overlay-color="#000000" data-e-type="section" data-element_type="section" data-id="289d27d" data-settings='{"background_background":"classic"}'>
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ddae463" data-e-type="column" data-element_type="column" data-id="ddae463">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="hero-projects-content">
                        <h1>Numerous Sizable Lighting Projects across Hospitality, Residential and Commercial Sectors</h1>
                        <p class="quote">‘When you possess light within, you see it externally’</p>
                        <p class="author">Anas Nin</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="elementor-section elementor-top-section elementor-element elementor-element-1c966ca elementor-section-full_width project-filter elementor-section-height-default elementor-section-height-default" data-dce-background-image-url="/wp-content/uploads/2021/12/bg-logo-3-2.jpg" data-e-type="section" data-element_type="section" data-id="1c966ca" data-settings='{"background_background":"classic"}'>
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5842541" data-e-type="column" data-element_type="column" data-id="5842541">
<div class="elementor-widget-wrap elementor-element-populated">
<section class="elementor-section elementor-inner-section elementor-element elementor-element-3485a33 elementor-section-full_width elementor-section-content-middle elementor-reverse-tablet elementor-reverse-mobile elementor-hidden-desktop elementor-hidden-tablet elementor-hidden-mobile elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="3485a33">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-eb7f0bc" data-e-type="column" data-element_type="column" data-id="eb7f0bc">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-66e36d7" data-e-type="column" data-element_type="column" data-id="66e36d7">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-8a4f0a0" data-e-type="column" data-element_type="column" data-id="8a4f0a0">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-fbacf22 elementor-align-justify elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="fbacf22" data-widget_type="button.default">
<div class="elementor-widget-container">
<div class="elementor-button-wrapper">
<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ url('/hospitality-lighting-projects') }}">
<span class="elementor-button-content-wrapper">
<span class="elementor-button-text">
                 Hospitality
                </span>
</span>
</a>
</div>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-5283ac4" data-e-type="column" data-element_type="column" data-id="5283ac4">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-a3908a1 elementor-align-justify elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="a3908a1" data-widget_type="button.default">
<div class="elementor-widget-container">
<div class="elementor-button-wrapper">
<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ url('/residential-lighting-projects') }}">
<span class="elementor-button-content-wrapper">
<span class="elementor-button-text">
                 Residential
                </span>
</span>
</a>
</div>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-5cd55f5" data-e-type="column" data-element_type="column" data-id="5cd55f5">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-bee07e8 elementor-align-justify filter-btn-c elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="bee07e8" data-widget_type="button.default">
<div class="elementor-widget-container">
<div class="elementor-button-wrapper">
<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ url('/commercial-lighting-projects') }}">
<span class="elementor-button-content-wrapper">
<span class="elementor-button-text">
                 Commercial
                </span>
</span>
</a>
</div>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-2e82719" data-e-type="column" data-element_type="column" data-id="2e82719">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-8b0bb43 elementor-align-justify elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="8b0bb43" data-widget_type="button.default">
<div class="elementor-widget-container">
<div class="elementor-button-wrapper">
<a class="elementor-button elementor-button-link elementor-size-sm" href="{{ url('/other-lighting-projects') }}">
<span class="elementor-button-content-wrapper">
<span class="elementor-button-text">
                 Others
                </span>
</span>
</a>
</div>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-45c521c" data-e-type="column" data-element_type="column" data-id="45c521c">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-551a333" data-e-type="column" data-element_type="column" data-id="551a333">
<div class="elementor-widget-wrap">
</div>
</div>
</div>
</section>
<section class="elementor-section elementor-inner-section elementor-element elementor-element-1cb517c elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="1cb517c">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-6ca5eb8" data-e-type="column" data-element_type="column" data-id="6ca5eb8">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-5f58de5 elementor-icon-list--layout-inline elementor-list-item-link-inline elementor-align-center elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="5f58de5" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items elementor-inline-items">
<li class="elementor-icon-list-item elementor-inline-item">
<a href="{{ url('/hospitality-lighting-projects') }}">
<span class="elementor-icon-list-text">
                 Hospitality
                </span>
</a>
</li>
<li class="elementor-icon-list-item elementor-inline-item">
<a href="{{ url('/residential-lighting-projects') }}">
<span class="elementor-icon-list-text">
                 Residential
                </span>
</a>
</li>
<li class="elementor-icon-list-item elementor-inline-item active">
<a class="active" href="{{ url('/commercial-lighting-projects') }}">
<span class="elementor-icon-list-text">
                 Commercial
                </span>
</a>
</li>
<li class="elementor-icon-list-item elementor-inline-item">
<a href="{{ url('/other-lighting-projects') }}">
<span class="elementor-icon-list-text">
                 Others
                </span>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="elementor-section elementor-inner-section elementor-element elementor-element-455fc8a elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="455fc8a">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-653e72e" data-e-type="column" data-element_type="column" data-id="653e72e">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-86fced4 premium-blog-align-left elementor-widget elementor-widget-premium-addon-blog" data-e-type="widget" data-element_type="widget" data-id="86fced4" data-settings='{"force_height":"true","premium_blog_columns_number":"33.33%","premium_blog_grid":"yes","premium_blog_layout":"even","premium_blog_columns_number_tablet":"50%","premium_blog_columns_number_mobile":"100%"}' data-widget_type="premium-addon-blog.default">
<div class="elementor-widget-container">
<div class="premium-blog-wrap premium-blog-even" data-page="10034">
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="ATLAS" class="attachment-full size-full wp-image-12302" decoding="async" fetchpriority="high" height="900" sizes="(max-width: 900px) 100vw, 900px" src="/wp-content/uploads/2021/12/ATLAS_900x900.jpg" srcset="/wp-content/uploads/2021/12/ATLAS_900x900.jpg 900w, /wp-content/uploads/2021/12/ATLAS_900x900-300x300.jpg 300w, /wp-content/uploads/2021/12/ATLAS_900x900-150x150.jpg 150w, /wp-content/uploads/2021/12/ATLAS_900x900-768x768.jpg 768w" style="width:100%;height:100%;max-width:900px" width="900"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/atlas-singapore" target="_blank">
<span class="elementor-screen-only">
                    ATLAS, Singapore
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/atlas-singapore" target="_blank">
                    ATLAS, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="Asia Square" class="attachment-full size-full wp-image-10902" decoding="async" height="600" sizes="(max-width: 600px) 100vw, 600px" src="/wp-content/uploads/2021/12/Asia-Square_600x600.jpg" srcset="/wp-content/uploads/2021/12/Asia-Square_600x600.jpg 600w, /wp-content/uploads/2021/12/Asia-Square_600x600-300x300.jpg 300w, /wp-content/uploads/2021/12/Asia-Square_600x600-150x150.jpg 150w" style="width:100%;height:100%;max-width:600px" width="600"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/asia-square-singapore" target="_blank">
<span class="elementor-screen-only">
                    Asia Square, Singapore
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/asia-square-singapore" target="_blank">
                    Asia Square, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="" class="attachment-full size-full wp-image-12303" decoding="async" height="900" loading="lazy" sizes="(max-width: 900px) 100vw, 900px" src="/wp-content/uploads/2021/12/Funan-Mall_900x900.jpg" srcset="/wp-content/uploads/2021/12/Funan-Mall_900x900.jpg 900w, /wp-content/uploads/2021/12/Funan-Mall_900x900-300x300.jpg 300w, /wp-content/uploads/2021/12/Funan-Mall_900x900-150x150.jpg 150w, /wp-content/uploads/2021/12/Funan-Mall_900x900-768x768.jpg 768w" style="width:100%;height:100%;max-width:900px" width="900"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/funan-mall-singapore" target="_blank">
<span class="elementor-screen-only">
                    Funan, Singapore
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/funan-mall-singapore" target="_blank">
                    Funan, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="Marina One" class="attachment-full size-full wp-image-10916" decoding="async" height="1900" loading="lazy" sizes="(max-width: 1900px) 100vw, 1900px" src="/wp-content/uploads/2021/12/Marina-One@2x.jpg" srcset="/wp-content/uploads/2021/12/Marina-One@2x.jpg 1900w, /wp-content/uploads/2021/12/Marina-One@2x-300x300.jpg 300w, /wp-content/uploads/2021/12/Marina-One@2x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/Marina-One@2x-150x150.jpg 150w, /wp-content/uploads/2021/12/Marina-One@2x-768x768.jpg 768w, /wp-content/uploads/2021/12/Marina-One@2x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/Marina-One@2x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:1900px" width="1900"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/marina-one-singapore" target="_blank">
<span class="elementor-screen-only">
                    Marina One, Singapore
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/marina-one-singapore" target="_blank">
                    Marina One, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="PSA Liveable City" class="attachment-full size-full wp-image-10920" decoding="async" height="2560" loading="lazy" sizes="(max-width: 2560px) 100vw, 2560px" src="/wp-content/uploads/2021/12/PSA-1@35x-scaled.jpg" srcset="/wp-content/uploads/2021/12/PSA-1@35x-scaled.jpg 2560w, /wp-content/uploads/2021/12/PSA-1@35x-300x300.jpg 300w, /wp-content/uploads/2021/12/PSA-1@35x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/PSA-1@35x-150x150.jpg 150w, /wp-content/uploads/2021/12/PSA-1@35x-768x768.jpg 768w, /wp-content/uploads/2021/12/PSA-1@35x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/PSA-1@35x-2048x2048.jpg 2048w, /wp-content/uploads/2021/12/PSA-1@35x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:2560px" width="2560"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/psa-liveable-city-singapore" target="_blank">
<span class="elementor-screen-only">
                    PSA Liveable City, Singapore
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/psa-liveable-city-singapore" target="_blank">
                    PSA Liveable City, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="The Work Project" class="attachment-full size-full wp-image-10926" decoding="async" height="1800" loading="lazy" sizes="(max-width: 1800px) 100vw, 1800px" src="/wp-content/uploads/2021/12/The-Work-Project_03@03x.jpg" srcset="/wp-content/uploads/2021/12/The-Work-Project_03@03x.jpg 1800w, /wp-content/uploads/2021/12/The-Work-Project_03@03x-300x300.jpg 300w, /wp-content/uploads/2021/12/The-Work-Project_03@03x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/The-Work-Project_03@03x-150x150.jpg 150w, /wp-content/uploads/2021/12/The-Work-Project_03@03x-768x768.jpg 768w, /wp-content/uploads/2021/12/The-Work-Project_03@03x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/The-Work-Project_03@03x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:1800px" width="1800"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/the-work-project-singapore" target="_blank">
<span class="elementor-screen-only">
                    The Work Project, Singapore
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/the-work-project-singapore" target="_blank">
                    The Work Project, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="" class="attachment-full size-full wp-image-13408" decoding="async" height="1200" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px" src="/wp-content/uploads/2023/11/St-James-Power-Station-Square-Website.png" srcset="/wp-content/uploads/2023/11/St-James-Power-Station-Square-Website.png 1200w, /wp-content/uploads/2023/11/St-James-Power-Station-Square-Website-300x300.png 300w, /wp-content/uploads/2023/11/St-James-Power-Station-Square-Website-1024x1024.png 1024w, /wp-content/uploads/2023/11/St-James-Power-Station-Square-Website-150x150.png 150w, /wp-content/uploads/2023/11/St-James-Power-Station-Square-Website-768x768.png 768w" style="width:100%;height:100%;max-width:1200px" width="1200"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/st-james-power-station" target="_blank">
<span class="elementor-screen-only">
                    St. James Power Station
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/st-james-power-station" target="_blank">
                    St. James Power Station
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="Commercial Lighting" class="attachment-full size-full wp-image-13504" decoding="async" height="2160" loading="lazy" sizes="(max-width: 2160px) 100vw, 2160px" src="/wp-content/uploads/2024/10/Luxligh.png" srcset="/wp-content/uploads/2024/10/Luxligh.png 2160w, /wp-content/uploads/2024/10/Luxligh-300x300.png 300w, /wp-content/uploads/2024/10/Luxligh-1024x1024.png 1024w, /wp-content/uploads/2024/10/Luxligh-150x150.png 150w, /wp-content/uploads/2024/10/Luxligh-768x768.png 768w, /wp-content/uploads/2024/10/Luxligh-1536x1536.png 1536w, /wp-content/uploads/2024/10/Luxligh-2048x2048.png 2048w, /wp-content/uploads/2024/10/Luxligh-1568x1568.png 1568w" style="width:100%;height:100%;max-width:2160px" width="2160"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/commercial-lighting-the-clubroom" target="_blank">
<span class="elementor-screen-only">
                    The Clubroom, Singapore
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/commercial-lighting-the-clubroom" target="_blank">
                    The Clubroom, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="" class="attachment-full size-full wp-image-13514" decoding="async" height="1080" loading="lazy" sizes="(max-width: 1080px) 100vw, 1080px" src="/wp-content/uploads/2024/12/Untitled-design-34.jpg" srcset="/wp-content/uploads/2024/12/Untitled-design-34.jpg 1080w, /wp-content/uploads/2024/12/Untitled-design-34-300x300.jpg 300w, /wp-content/uploads/2024/12/Untitled-design-34-1024x1024.jpg 1024w, /wp-content/uploads/2024/12/Untitled-design-34-150x150.jpg 150w, /wp-content/uploads/2024/12/Untitled-design-34-768x768.jpg 768w" style="width:100%;height:100%;max-width:1080px" width="1080"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/commercial-lighting-cloudstreet" target="_blank">
<span class="elementor-screen-only">
                    Cloudstreet, Singapore
                   </span>
</a>
</div>
</div>
<div class="premium-blog-content-wrapper">
<div class="premium-blog-inner-container">
<div class="premium-blog-cats-container">
<ul class="post-categories">
</ul>
</div>
<h2 class="premium-blog-entry-title">
<a href="/projects/commercial-lighting-cloudstreet" target="_blank">
                    Cloudstreet, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
</div>
</div>
</div>
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
