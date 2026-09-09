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
    .elementor-5335 .elementor-element.elementor-element-04bd32d,
    .elementor-5335 .hero-projects-content {
        box-sizing: border-box;
        border: none !important;
        outline: none !important;
    }
    .elementor-5335 .elementor-element.elementor-element-04bd32d {
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
    
    .elementor-5335 .elementor-element.elementor-element-04bd32d > .elementor-container {
        min-height: 0 !important;
        height: auto !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
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
    .elementor-5335 .elementor-element.elementor-element-39f7706 {
        background-color: #FFFFFF !important;
        padding: 50px 20px 30px 20px !important;
    }
    .elementor-5335 .elementor-element-6044d00 {
        display: none !important;
    }
    .elementor-5335 .elementor-element-9c6c13d .elementor-icon-list-items {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 36px !important;
        padding: 0 !important;
        margin: 0 auto 35px auto !important;
        list-style: none !important;
    }
    .elementor-5335 .elementor-element-9c6c13d .elementor-icon-list-item {
        margin: 0 !important;
        padding: 0 !important;
    }
    .elementor-5335 .elementor-element-9c6c13d .elementor-icon-list-item a {
        font-family: "DIN", sans-serif !important;
        font-size: 22px !important;
        font-weight: 400 !important;
        color: #0B1523 !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }
    .elementor-5335 .elementor-element-9c6c13d .elementor-icon-list-item a:hover {
        color: #EAA931 !important;
    }
    .elementor-5335 .elementor-element-9c6c13d .elementor-icon-list-item.active a,
    .elementor-5335 .elementor-element-9c6c13d .elementor-icon-list-item a.active {
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
    .elementor-5335 .premium-blog-thumbnail-overlay {
        display: none !important;
    }
    .elementor-5335 .elementor-element-ed359d8 {
        display: none !important;
    }

    @media (max-width: 991px) {
        .elementor-5335 .premium-blog-post-outer-container {
            width: 50% !important;
        }
        .elementor-5335 .premium-blog-post-container {
            height: 320px !important;
        }
    }
    @media (max-width: 640px) {
        .elementor-5335 .hero-projects-content h1 {
            font-size: 22px !important;
            line-height: 30px !important;
        }
        .elementor-5335 .elementor-element.elementor-element-04bd32d {
            padding: 40px 15px !important;
            min-height: 280px !important;
        }
        .elementor-5335 .elementor-element-9c6c13d .elementor-icon-list-items {
            gap: 16px !important;
        }
        .elementor-5335 .elementor-element-9c6c13d .elementor-icon-list-item a {
            font-size: 18px !important;
        }
        .elementor-5335 .premium-blog-post-outer-container {
            width: 100% !important;
        }
        .elementor-5335 .premium-blog-post-container {
            height: 280px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="elementor elementor-5335" data-elementor-id="5335" data-elementor-post-type="page" data-elementor-type="wp-page">
    <!-- Hero Banner Section -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-04bd32d elementor-section-full_width elementor-section-height-default elementor-section-items-middle" data-dce-background-color="#000000" data-dce-background-overlay-color="#000000" data-e-type="section" data-element_type="section" data-id="04bd32d" data-settings='{"background_background":"classic"}'>
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3c1ce94" data-e-type="column" data-element_type="column" data-id="3c1ce94">
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
<section class="elementor-section elementor-top-section elementor-element elementor-element-39f7706 elementor-section-full_width project-filter elementor-section-height-default elementor-section-height-default" data-dce-background-image-url="/wp-content/uploads/2021/12/bg-logo-3-2.jpg" data-e-type="section" data-element_type="section" data-id="39f7706" data-settings='{"background_background":"classic"}'>
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-86e206e" data-e-type="column" data-element_type="column" data-id="86e206e">
<div class="elementor-widget-wrap elementor-element-populated">
<section class="elementor-section elementor-inner-section elementor-element elementor-element-6044d00 elementor-section-full_width elementor-section-content-middle elementor-reverse-tablet elementor-reverse-mobile elementor-hidden-desktop elementor-hidden-tablet elementor-hidden-mobile elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="6044d00">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-d1b19be" data-e-type="column" data-element_type="column" data-id="d1b19be">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-cc51088" data-e-type="column" data-element_type="column" data-id="cc51088">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-898485e" data-e-type="column" data-element_type="column" data-id="898485e">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-b3b9b5b elementor-align-center filter-btn-h elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="b3b9b5b" data-widget_type="button.default">
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
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-20801a1" data-e-type="column" data-element_type="column" data-id="20801a1">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-beec1af elementor-align-center elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="beec1af" data-widget_type="button.default">
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
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-75f61f0" data-e-type="column" data-element_type="column" data-id="75f61f0">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-f879315 elementor-align-center elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="f879315" data-widget_type="button.default">
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
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-fc6489f" data-e-type="column" data-element_type="column" data-id="fc6489f">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-f9b0e37 elementor-align-center elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="f9b0e37" data-widget_type="button.default">
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
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-b66d204" data-e-type="column" data-element_type="column" data-id="b66d204">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-3c59f21" data-e-type="column" data-element_type="column" data-id="3c59f21">
<div class="elementor-widget-wrap">
</div>
</div>
</div>
</section>
<section class="elementor-section elementor-inner-section elementor-element elementor-element-fd23b6c elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="fd23b6c">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-99c57b9" data-e-type="column" data-element_type="column" data-id="99c57b9">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-9c6c13d elementor-icon-list--layout-inline elementor-list-item-link-inline elementor-align-center elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="9c6c13d" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items elementor-inline-items">
<li class="elementor-icon-list-item elementor-inline-item active">
<a class="active" href="{{ url('/hospitality-lighting-projects') }}">
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
<li class="elementor-icon-list-item elementor-inline-item">
<a href="{{ url('/commercial-lighting-projects') }}">
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
<section class="elementor-section elementor-inner-section elementor-element elementor-element-e8f3320 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="e8f3320">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-1bddf9e" data-e-type="column" data-element_type="column" data-id="1bddf9e">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-5153b33 premium-blog-align-left elementor-widget elementor-widget-premium-addon-blog" data-e-type="widget" data-element_type="widget" data-id="5153b33" data-settings='{"force_height":"true","premium_blog_columns_number":"33.33%","premium_blog_grid":"yes","premium_blog_layout":"even","premium_blog_columns_number_tablet":"50%","premium_blog_columns_number_mobile":"100%"}' data-widget_type="premium-addon-blog.default">
<div class="elementor-widget-container">
<div class="premium-blog-wrap premium-blog-even" data-page="5335">
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="Dusit Thani Laguna" class="attachment-full size-full wp-image-10908" decoding="async" fetchpriority="high" height="1415" sizes="(max-width: 1415px) 100vw, 1415px" src="/wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x.jpg" srcset="/wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x.jpg 1415w, /wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x-300x300.jpg 300w, /wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x-150x150.jpg 150w, /wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x-768x768.jpg 768w" style="width:100%;height:100%;max-width:1415px" width="1415"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/dusit-thani-laguna" target="_blank">
<span class="elementor-screen-only">
                    Dusit Thani Laguna, Singapore
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
<a href="/projects/dusit-thani-laguna" target="_blank">
                    Dusit Thani Laguna, Singapore
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
<img alt="Constance Lemuria Praslin" class="attachment-full size-full wp-image-10907" decoding="async" height="599" sizes="(max-width: 599px) 100vw, 599px" src="/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg" srcset="/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg 599w, /wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599-300x300.jpg 300w, /wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599-150x150.jpg 150w" style="width:100%;height:100%;max-width:599px" width="599"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/constance-lemuria-praslin" target="_blank">
<span class="elementor-screen-only">
                    Constance Lemuria Praslin, Seychelles
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
<a href="/projects/constance-lemuria-praslin" target="_blank">
                    Constance Lemuria Praslin, Seychelles
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
<img alt="Cinnamon Grand Colombo" class="attachment-full size-full wp-image-10906" decoding="async" height="2560" loading="lazy" sizes="(max-width: 2560px) 100vw, 2560px" src="/wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-scaled.jpg" srcset="/wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-scaled.jpg 2560w, /wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-300x300.jpg 300w, /wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-150x150.jpg 150w, /wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-768x768.jpg 768w, /wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-2048x2048.jpg 2048w, /wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:2560px" width="2560"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/cinnamon-grand-colombo" target="_blank">
<span class="elementor-screen-only">
                    Cinnamon Grand Colombo, Sri Lanka
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
<a href="/projects/cinnamon-grand-colombo" target="_blank">
                    Cinnamon Grand Colombo, Sri Lanka
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
<img alt="InterContinental Dhaka" class="attachment-full size-full wp-image-10915" decoding="async" height="1950" loading="lazy" sizes="(max-width: 1950px) 100vw, 1950px" src="/wp-content/uploads/2021/12/InterContinental-Dhaka@15x.jpg" srcset="/wp-content/uploads/2021/12/InterContinental-Dhaka@15x.jpg 1950w, /wp-content/uploads/2021/12/InterContinental-Dhaka@15x-300x300.jpg 300w, /wp-content/uploads/2021/12/InterContinental-Dhaka@15x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/InterContinental-Dhaka@15x-150x150.jpg 150w, /wp-content/uploads/2021/12/InterContinental-Dhaka@15x-768x768.jpg 768w, /wp-content/uploads/2021/12/InterContinental-Dhaka@15x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/InterContinental-Dhaka@15x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:1950px" width="1950"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/intercontinental-dhaka" target="_blank">
<span class="elementor-screen-only">
                    InterContinental Dhaka, Bangladesh
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
<a href="/projects/intercontinental-dhaka" target="_blank">
                    InterContinental Dhaka, Bangladesh
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
<img alt="" class="attachment-full size-full wp-image-10919" decoding="async" height="2560" loading="lazy" sizes="(max-width: 2560px) 100vw, 2560px" src="/wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-scaled.jpg" srcset="/wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-scaled.jpg 2560w, /wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-300x300.jpg 300w, /wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-150x150.jpg 150w, /wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-768x768.jpg 768w, /wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-2048x2048.jpg 2048w, /wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:2560px" width="2560"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/alexandra-park-hotel-singapore" target="_blank">
<span class="elementor-screen-only">
                    Park Alexandra Hotel, Singapore
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
<a href="/projects/alexandra-park-hotel-singapore" target="_blank">
                    Park Alexandra Hotel, Singapore
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
<img alt="Anantara Desaru Coast Resort &amp; Villas" class="attachment-full size-full wp-image-10901" decoding="async" height="2560" loading="lazy" sizes="(max-width: 2560px) 100vw, 2560px" src="/wp-content/uploads/2021/12/Anantara-Desaru@5x-scaled.jpg" srcset="/wp-content/uploads/2021/12/Anantara-Desaru@5x-scaled.jpg 2560w, /wp-content/uploads/2021/12/Anantara-Desaru@5x-300x300.jpg 300w, /wp-content/uploads/2021/12/Anantara-Desaru@5x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/Anantara-Desaru@5x-150x150.jpg 150w, /wp-content/uploads/2021/12/Anantara-Desaru@5x-768x768.jpg 768w, /wp-content/uploads/2021/12/Anantara-Desaru@5x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/Anantara-Desaru@5x-2048x2048.jpg 2048w, /wp-content/uploads/2021/12/Anantara-Desaru@5x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:2560px" width="2560"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/anantara-desaru-coast-resort-villas" target="_blank">
<span class="elementor-screen-only">
                    Anantara Desaru Coast Resort &amp; Villas, Malaysia
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
<a href="/projects/anantara-desaru-coast-resort-villas" target="_blank">
                    Anantara Desaru Coast Resort &amp; Villas, Malaysia
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
<img alt="" class="attachment-full size-full wp-image-10910" decoding="async" height="650" loading="lazy" sizes="(max-width: 650px) 100vw, 650px" src="/wp-content/uploads/2021/12/Gaia_650x650.jpg" srcset="/wp-content/uploads/2021/12/Gaia_650x650.jpg 650w, /wp-content/uploads/2021/12/Gaia_650x650-300x300.jpg 300w, /wp-content/uploads/2021/12/Gaia_650x650-150x150.jpg 150w" style="width:100%;height:100%;max-width:650px" width="650"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/gaia-hotel-bandung-indonesia" target="_blank">
<span class="elementor-screen-only">
                    Gaia Hotel Bandung, Indonesia
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
<a href="/projects/gaia-hotel-bandung-indonesia" target="_blank">
                    Gaia Hotel Bandung, Indonesia
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
<img alt="Heritance Aarah" class="attachment-full size-full wp-image-10913" decoding="async" height="792" loading="lazy" sizes="(max-width: 792px) 100vw, 792px" src="/wp-content/uploads/2021/12/heritance-aarah_792x792.jpg" srcset="/wp-content/uploads/2021/12/heritance-aarah_792x792.jpg 792w, /wp-content/uploads/2021/12/heritance-aarah_792x792-300x300.jpg 300w, /wp-content/uploads/2021/12/heritance-aarah_792x792-150x150.jpg 150w, /wp-content/uploads/2021/12/heritance-aarah_792x792-768x768.jpg 768w" style="width:100%;height:100%;max-width:792px" width="792"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/heritance-aarah-maldives" target="_blank">
<span class="elementor-screen-only">
                    Heritance Aarah, Maldives
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
<a href="/projects/heritance-aarah-maldives" target="_blank">
                    Heritance Aarah, Maldives
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
<img alt="Hilton Colombo" class="attachment-full size-full wp-image-10914" decoding="async" height="2560" loading="lazy" sizes="(max-width: 2560px) 100vw, 2560px" src="/wp-content/uploads/2021/12/Hilton-Colombo@4x-scaled.jpg" srcset="/wp-content/uploads/2021/12/Hilton-Colombo@4x-scaled.jpg 2560w, /wp-content/uploads/2021/12/Hilton-Colombo@4x-300x300.jpg 300w, /wp-content/uploads/2021/12/Hilton-Colombo@4x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/Hilton-Colombo@4x-150x150.jpg 150w, /wp-content/uploads/2021/12/Hilton-Colombo@4x-768x768.jpg 768w, /wp-content/uploads/2021/12/Hilton-Colombo@4x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/Hilton-Colombo@4x-2048x2048.jpg 2048w, /wp-content/uploads/2021/12/Hilton-Colombo@4x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:2560px" width="2560"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/hilton-colombo-residences-colombo" target="_blank">
<span class="elementor-screen-only">
                    Hilton Colombo Residences, Colombo
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
<a href="/projects/hilton-colombo-residences-colombo" target="_blank">
                    Hilton Colombo Residences, Colombo
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
<img alt="One&amp;only Le Siant" class="attachment-full size-full wp-image-10918" decoding="async" height="576" loading="lazy" sizes="(max-width: 576px) 100vw, 576px" src="/wp-content/uploads/2021/12/Oneonly-Le-Siant_576x576.jpg" srcset="/wp-content/uploads/2021/12/Oneonly-Le-Siant_576x576.jpg 576w, /wp-content/uploads/2021/12/Oneonly-Le-Siant_576x576-300x300.jpg 300w, /wp-content/uploads/2021/12/Oneonly-Le-Siant_576x576-150x150.jpg 150w" style="width:100%;height:100%;max-width:576px" width="576"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/oneonly-le-saint-geran-mauritius" target="_blank">
<span class="elementor-screen-only">
                    One&amp;Only Le Saint Géran, Mauritius
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
<a href="/projects/oneonly-le-saint-geran-mauritius" target="_blank">
                    One&amp;Only Le Saint Géran, Mauritius
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
<img alt="Raffles Maldives Meradhoo Resort" class="attachment-full size-full wp-image-5540" decoding="async" height="768" loading="lazy" sizes="(max-width: 768px) 100vw, 768px" src="/wp-content/uploads/2021/12/Raffles_Maldives_Meradho.jpg" srcset="/wp-content/uploads/2021/12/Raffles_Maldives_Meradho.jpg 768w, /wp-content/uploads/2021/12/Raffles_Maldives_Meradho-300x300.jpg 300w, /wp-content/uploads/2021/12/Raffles_Maldives_Meradho-150x150.jpg 150w" style="width:100%;height:100%;max-width:768px" width="768"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/raffles-maldives-meradhoo-resort-maldives" target="_blank">
<span class="elementor-screen-only">
                    Raffles Maldives Meradhoo Resort, Maldives
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
<a href="/projects/raffles-maldives-meradhoo-resort-maldives" target="_blank">
                    Raffles Maldives Meradhoo Resort, Maldives
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
<img alt="Sedona Hotel Mandalay Myanmar" class="attachment-full size-full wp-image-10922" decoding="async" height="2560" loading="lazy" sizes="(max-width: 2560px) 100vw, 2560px" src="/wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-scaled.jpg" srcset="/wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-scaled.jpg 2560w, /wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-300x300.jpg 300w, /wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-150x150.jpg 150w, /wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-768x768.jpg 768w, /wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-2048x2048.jpg 2048w, /wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:2560px" width="2560"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/sedona-hotel-mandalay-myanmar" target="_blank">
<span class="elementor-screen-only">
                    Sedona Hotel Mandalay, Myanmar
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
<a href="/projects/sedona-hotel-mandalay-myanmar" target="_blank">
                    Sedona Hotel Mandalay, Myanmar
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
<img alt="W Singapore" class="attachment-full size-full wp-image-10928" decoding="async" height="2000" loading="lazy" sizes="(max-width: 2000px) 100vw, 2000px" src="/wp-content/uploads/2021/12/W-Hotel@125x.jpg" srcset="/wp-content/uploads/2021/12/W-Hotel@125x.jpg 2000w, /wp-content/uploads/2021/12/W-Hotel@125x-300x300.jpg 300w, /wp-content/uploads/2021/12/W-Hotel@125x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/W-Hotel@125x-150x150.jpg 150w, /wp-content/uploads/2021/12/W-Hotel@125x-768x768.jpg 768w, /wp-content/uploads/2021/12/W-Hotel@125x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/W-Hotel@125x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:2000px" width="2000"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/w-singapore" target="_blank">
<span class="elementor-screen-only">
                    W Singapore – Sentosa Cove, Singapore
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
<a href="/projects/w-singapore" target="_blank">
                    W Singapore – Sentosa Cove, Singapore
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
<img alt="" class="attachment-full size-full wp-image-13418" decoding="async" height="1200" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px" src="/wp-content/uploads/2024/01/Artyzen-Square.jpg" srcset="/wp-content/uploads/2024/01/Artyzen-Square.jpg 1200w, /wp-content/uploads/2024/01/Artyzen-Square-300x300.jpg 300w, /wp-content/uploads/2024/01/Artyzen-Square-1024x1024.jpg 1024w, /wp-content/uploads/2024/01/Artyzen-Square-150x150.jpg 150w, /wp-content/uploads/2024/01/Artyzen-Square-768x768.jpg 768w" style="width:100%;height:100%;max-width:1200px" width="1200"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/artyzen-cuscaden-hotel" target="_blank">
<span class="elementor-screen-only">
                    Artyzen Cuscaden Hotel
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
<a href="/projects/artyzen-cuscaden-hotel" target="_blank">
                    Artyzen Cuscaden Hotel
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
<section class="elementor-section elementor-top-section elementor-element elementor-element-ed359d8 elementor-reverse-tablet elementor-reverse-mobile elementor-hidden-desktop elementor-hidden-tablet elementor-hidden-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-dce-background-image-url="/wp-content/uploads/2021/12/bg-logo-3-2.jpg" data-e-type="section" data-element_type="section" data-id="ed359d8" data-settings='{"background_background":"classic"}'>
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-d89c401" data-e-type="column" data-element_type="column" data-id="d89c401">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-a8fe940 dce-posts-layout-float dce-col-3 project-filter dce-col-tablet-3 dce-col-mobile-1 dce-align-left elementor-widget elementor-widget-dce-dynamicposts-v2" data-e-type="widget" data-element_type="widget" data-id="a8fe940" data-settings='{"style_items":"float","grid_filters_all_filter":"yes","grid_filters_all_default":"yes","grid_filters_grid_type":"flex"}' data-widget_type="dce-dynamicposts-v2.grid-filters">
<div class="elementor-widget-container">
<div class="dce-fix-background-loop dce-posts-container dce-posts dce-dynamic-posts-collection dce-grid-filters-container dce-skin-grid-filters dce-skin-grid dce-skin-grid-flex">
<div class="dce-filters align-center">
<span class="filters-item filter-active">
<a data-filter="*" href="#">
</a>
</span>
<span class="filters-separator">
</span>
<span class="filters-item">
<a data-e-disable-page-transition="false" data-filter=".project_category-commercial" href="#">
             Commercial
            </a>
</span>
<span class="filters-separator">
</span>
<span class="filters-item">
<a data-e-disable-page-transition="false" data-filter=".project_category-hospitality" href="#">
             Hospitality
            </a>
</span>
<span class="filters-separator">
</span>
<span class="filters-item">
<a data-e-disable-page-transition="false" data-filter=".project_category-others" href="#">
             Others
            </a>
</span>
<span class="filters-separator">
</span>
<span class="filters-item">
<a data-e-disable-page-transition="false" data-filter=".project_category-residential" href="#">
             Residential
            </a>
</span>
</div>
<div class="dce-posts-wrapper dce-grid-filters-wrapper dce-wrapper-grid-filters dce-wrapper-grid">
<article class="post-7646 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="7646" data-dce-post-index="0">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/dusit-thani-laguna" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/dusit-thani-laguna" target="_blank">
                 Dusit Thani Laguna, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-8424 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="8424" data-dce-post-index="1">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/constance-lemuria-praslin" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/constance-lemuria-praslin" target="_blank">
                 Constance Lemuria Praslin, Seychelles
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-8434 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="8434" data-dce-post-index="2">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/cinnamon-grand-colombo" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Cinnamon-Grand-Colombo@5x-scaled.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/cinnamon-grand-colombo" target="_blank">
                 Cinnamon Grand Colombo, Sri Lanka
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-8513 projects type-projects status-publish has-post-thumbnail hentry project_category-residential entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="8513" data-dce-post-index="3">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/private-house" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Chancery-Lane_1000x1000.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/private-house" target="_blank">
                 Private House, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-10" data-dce-order="">
                   Residential
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-8526 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="8526" data-dce-post-index="4">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/atlas-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/ATLAS_900x900.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/atlas-singapore" target="_blank">
                 ATLAS, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-8547 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="8547" data-dce-post-index="5">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/asia-square-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Asia-Square_600x600.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/asia-square-singapore" target="_blank">
                 Asia Square, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-8562 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="8562" data-dce-post-index="6">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/intercontinental-dhaka" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/InterContinental-Dhaka@15x.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/intercontinental-dhaka" target="_blank">
                 InterContinental Dhaka, Bangladesh
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-8588 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="8588" data-dce-post-index="7">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/alexandra-park-hotel-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Park-Alexandra-Hotel@25x-scaled.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/alexandra-park-hotel-singapore" target="_blank">
                 Park Alexandra Hotel, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-8607 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="8607" data-dce-post-index="8">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/anantara-desaru-coast-resort-villas" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Anantara-Desaru@5x-scaled.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/anantara-desaru-coast-resort-villas" target="_blank">
                 Anantara Desaru Coast Resort &amp; Villas, Malaysia
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11764 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11764" data-dce-post-index="9">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/funan-mall-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Funan-Mall_900x900.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/funan-mall-singapore" target="_blank">
                 Funan, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11765 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11765" data-dce-post-index="10">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/gaia-hotel-bandung-indonesia" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Gaia_650x650.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/gaia-hotel-bandung-indonesia" target="_blank">
                 Gaia Hotel Bandung, Indonesia
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11767 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11767" data-dce-post-index="11">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/heritance-aarah-maldives" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/heritance-aarah_792x792.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/heritance-aarah-maldives" target="_blank">
                 Heritance Aarah, Maldives
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11768 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11768" data-dce-post-index="12">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/hilton-colombo-residences-colombo" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Hilton-Colombo@4x-scaled.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/hilton-colombo-residences-colombo" target="_blank">
                 Hilton Colombo Residences, Colombo
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11771 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11771" data-dce-post-index="13">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/marina-one-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Marina-One@2x.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/marina-one-singapore" target="_blank">
                 Marina One, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11773 projects type-projects status-publish has-post-thumbnail hentry project_category-residential entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11773" data-dce-post-index="14">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/oakwood-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Oakwood@2x.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/oakwood-singapore" target="_blank">
                 Oakwood, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-10" data-dce-order="">
                   Residential
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11774 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11774" data-dce-post-index="15">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/oneonly-le-saint-geran-mauritius" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Oneonly-Le-Siant_576x576.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/oneonly-le-saint-geran-mauritius" target="_blank">
                 One&amp;Only Le Saint Géran, Mauritius
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11775 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11775" data-dce-post-index="16">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/psa-liveable-city-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/PSA-1@35x-scaled.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/psa-liveable-city-singapore" target="_blank">
                 PSA Liveable City, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11776 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11776" data-dce-post-index="17">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/raffles-maldives-meradhoo-resort-maldives" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Raffles_Maldives_Meradho.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/raffles-maldives-meradhoo-resort-maldives" target="_blank">
                 Raffles Maldives Meradhoo Resort, Maldives
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11777 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11777" data-dce-post-index="18">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/sedona-hotel-mandalay-myanmar" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Sedona-Mandala-Myanmar-scaled.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/sedona-hotel-mandalay-myanmar" target="_blank">
                 Sedona Hotel Mandalay, Myanmar
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11778 projects type-projects status-publish has-post-thumbnail hentry project_category-residential entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11778" data-dce-post-index="19">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/somerset-chancellor-court" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/Somerset-Chanceller-HCMC@3x-scaled.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/somerset-chancellor-court" target="_blank">
                 Somerset Chancellor Court, Ho Chi Minh City
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-10" data-dce-order="">
                   Residential
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11779 projects type-projects status-publish has-post-thumbnail hentry project_category-others entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11779" data-dce-post-index="20">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/the-enabling-village-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/The-Enabling-Village@25x.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/the-enabling-village-singapore" target="_blank">
                 The Enabling Village, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-15" data-dce-order="">
                   Others
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11780 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11780" data-dce-post-index="21">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/the-work-project-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/The-Work-Project_03@03x.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/the-work-project-singapore" target="_blank">
                 The Work Project, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11781 projects type-projects status-publish has-post-thumbnail hentry project_category-residential entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11781" data-dce-post-index="22">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/twentyone-angullia-park-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/TwentyOneAngullia065@3x-scaled.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/twentyone-angullia-park-singapore" target="_blank">
                 TwentyOne Angullia Park, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-10" data-dce-order="">
                   Residential
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-11782 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="11782" data-dce-post-index="23">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/w-singapore" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2021/12/W-Hotel@125x.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/w-singapore" target="_blank">
                 W Singapore – Sentosa Cove, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-13386 projects type-projects status-publish has-post-thumbnail hentry project_category-others entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="13386" data-dce-post-index="24">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/church-of-the-nativity-of-the-blessed-virgin-mary" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2023/10/Church-of-Nativity.png); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/church-of-the-nativity-of-the-blessed-virgin-mary" target="_blank">
                 Church of the Nativity of the Blessed Virgin Mary
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-15" data-dce-order="">
                   Others
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-13401 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="13401" data-dce-post-index="25">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/st-james-power-station" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2023/11/St-James-Power-Station-Square-Website.png); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/st-james-power-station" target="_blank">
                 St. James Power Station
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-13410 projects type-projects status-publish has-post-thumbnail hentry project_category-hospitality entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="13410" data-dce-post-index="26">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/artyzen-cuscaden-hotel" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2024/01/Artyzen-Square.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/artyzen-cuscaden-hotel" target="_blank">
                 Artyzen Cuscaden Hotel
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-9" data-dce-order="">
                   Hospitality
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-13466 projects type-projects status-publish has-post-thumbnail hentry project_category-others entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="13466" data-dce-post-index="27">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/church-of-the-blessed-sacrament" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/church-of-the-blessed-sacrament" target="_blank">
                 Church of the Blessed Sacrament
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-15" data-dce-order="">
                   Others
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-13483 projects type-projects status-publish has-post-thumbnail hentry project_category-residential entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="13483" data-dce-post-index="28">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/residential-lighting-amber-pa" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2024/10/Luxligh.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/residential-lighting-amber-pa" target="_blank">
                 Amber Park, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-10" data-dce-order="">
                   Residential
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-13499 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="13499" data-dce-post-index="29">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/commercial-lighting-the-clubroom" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2024/10/Luxligh.png); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/commercial-lighting-the-clubroom" target="_blank">
                 The Clubroom, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
<article class="post-13508 projects type-projects status-publish has-post-thumbnail hentry project_category-commercial entry dce-post dce-post-item dce-item-filterable dce-grid-filters-item dce-item-grid-filters dce-item-grid" data-dce-post-id="13508" data-dce-post-index="30">
<div class="dce-post-block">
<div class="dce-image-area dce-item-area">
<div class="dce-item dce-item_image elementor-repeater-item-b5217c2">
<a class="dce-post-image dce-post-bgimage dce-post-overlayimage" href="/projects/commercial-lighting-cloudstreet" target="_blank">
<figure class="dce-img dce-bgimage" style="background-image: url(/wp-content/uploads/2024/12/Untitled-design-34.jpg); background-repeat: no-repeat; background-size: cover; display: block;">
</figure>
</a>
</div>
</div>
<div class="dce-content-area dce-item-area">
<div class="dce-item dce-item_title elementor-repeater-item-0d20b87">
<h3 class="dce-post-title">
<a href="/projects/commercial-lighting-cloudstreet" target="_blank">
                 Cloudstreet, Singapore
                </a>
</h3>
</div>
<div class="dce-item dce-item_termstaxonomy elementor-repeater-item-af5f98d">
<div class="dce-post-terms">
<ul class="dce-terms-list dce-taxonomy-project_category">
<li class="dce-term-item">
<span class="dce-term dce-term-11" data-dce-order="">
                   Commercial
                  </span>
</li>
</ul>
</div>
</div>
</div>
</div>
</article>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
@endsection
