@extends('layouts.app')

@section('title', 'Other Lighting Projects - LuxLight')
@section('meta_description', 'Numerous Sizable Lighting Projects across Hospitality, Residential and Commercial Sectors - LuxLight Singapore')

@push('styles')
<link href="/wp-content/uploads/elementor/css/post-10052.css" id="elementor-post-10052-css" media="all" rel="stylesheet"/>
<link href="/wp-content/uploads/premium-addons-elementor/pafe-10052.css" id="pafe-10052-css" media="all" rel="stylesheet"/>
<style>
    /* Projects Hero Banner Styling - Perfectly Balanced Size */
    .elementor-10052,
    .elementor-10052 *,
    .elementor-10052 .elementor-element.elementor-element-bf80133,
    .elementor-10052 .hero-projects-content {
        box-sizing: border-box;
        border: none !important;
        outline: none !important;
    }
    .elementor-10052 .elementor-element.elementor-element-bf80133 {
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
    
    .elementor-10052 .elementor-element.elementor-element-bf80133 > .elementor-container {
        min-height: 0 !important;
        height: auto !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    
    .elementor-10052 .hero-projects-content {
        max-width: 820px !important;
        margin: 0 auto !important;
        text-align: center !important;
        position: relative !important;
        z-index: 2 !important;
    }
    
    .elementor-10052 .hero-projects-content h1 {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 35px !important;
        font-weight: 300 !important;
        line-height: 46px !important;
        letter-spacing: -0.2px !important;
        color: #FFFFFF !important;
        margin: 0 auto !important;
        max-width: 780px !important;
    }
    
    .elementor-10052 .hero-projects-content p.quote {
        font-family: "Din", sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 300 !important;
        color: #FFFFFF !important;
        margin-top: 18px !important;
        margin-bottom: 4px !important;
        letter-spacing: 0.2px !important;
    }
    
    .elementor-10052 .hero-projects-content p.author {
        font-family: "Din", sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 300 !important;
        color: #FFFFFF !important;
        margin-top: 4px !important;
    }

    /* Filter Bar Styling */
    .elementor-10052 .elementor-element.elementor-element-889b781 {
        background-color: #FFFFFF !important;
        padding: 50px 20px 30px 20px !important;
    }
    .elementor-10052 .elementor-element-4d7a4eb {
        display: none !important;
    }
    .elementor-10052 .elementor-element-661c2a3 .elementor-icon-list-items {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 36px !important;
        padding: 0 !important;
        margin: 0 auto 35px auto !important;
        list-style: none !important;
    }
    .elementor-10052 .elementor-element-661c2a3 .elementor-icon-list-item {
        margin: 0 !important;
        padding: 0 !important;
    }
    .elementor-10052 .elementor-element-661c2a3 .elementor-icon-list-item a {
        font-family: "DIN", sans-serif !important;
        font-size: 22px !important;
        font-weight: 400 !important;
        color: #0B1523 !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }
    .elementor-10052 .elementor-element-661c2a3 .elementor-icon-list-item a:hover {
        color: #EAA931 !important;
    }
    .elementor-10052 .elementor-element-661c2a3 .elementor-icon-list-item.active a,
    .elementor-10052 .elementor-element-661c2a3 .elementor-icon-list-item a.active {
        color: #EAA931 !important;
        font-weight: 500 !important;
    }

    /* 3-Column Premium Blog Grid Styling */
    .elementor-10052 .premium-blog-wrap {
        display: flex !important;
        flex-wrap: wrap !important;
        margin: 0 -15px !important;
    }
    .elementor-10052 .premium-blog-post-outer-container {
        width: 33.333333% !important;
        padding: 0 15px 30px 15px !important;
        box-sizing: border-box !important;
        display: block !important;
    }
    .elementor-10052 .premium-blog-post-container {
        position: relative !important;
        overflow: hidden !important;
        height: 380px !important;
        background-color: #0B1523 !important;
        border-radius: 4px !important;
    }
    .elementor-10052 .premium-blog-thumb-effect-wrapper {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        overflow: hidden !important;
    }
    .elementor-10052 .premium-blog-thumbnail-container {
        width: 100% !important;
        height: 100% !important;
        overflow: hidden !important;
    }
    .elementor-10052 .premium-blog-thumbnail-container img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }
    .elementor-10052 .premium-blog-post-container:hover .premium-blog-thumbnail-container img {
        transform: scale(1.08) !important;
    }
    .elementor-10052 .premium-blog-content-wrapper {
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
    .elementor-10052 .premium-blog-entry-title {
        margin: 0 !important;
        padding: 0 !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .elementor-10052 .premium-blog-entry-title a {
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
    .elementor-10052 .premium-blog-thumbnail-overlay {
        display: none !important;
    }

    @media (max-width: 991px) {
        .elementor-10052 .premium-blog-post-outer-container {
            width: 50% !important;
        }
        .elementor-10052 .premium-blog-post-container {
            height: 320px !important;
        }
    }
    @media (max-width: 640px) {
        .elementor-10052 .hero-projects-content h1 {
            font-size: 22px !important;
            line-height: 30px !important;
        }
        .elementor-10052 .elementor-element.elementor-element-bf80133 {
            padding: 40px 15px !important;
            min-height: 280px !important;
        }
        .elementor-10052 .elementor-element-661c2a3 .elementor-icon-list-items {
            gap: 16px !important;
        }
        .elementor-10052 .elementor-element-661c2a3 .elementor-icon-list-item a {
            font-size: 18px !important;
        }
        .elementor-10052 .premium-blog-post-outer-container {
            width: 100% !important;
        }
        .elementor-10052 .premium-blog-post-container {
            height: 280px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="elementor elementor-10052" data-elementor-id="10052" data-elementor-post-type="page" data-elementor-type="wp-page">
    <!-- Hero Banner Section -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-bf80133 elementor-section-full_width elementor-section-height-default elementor-section-items-middle" data-dce-background-color="#000000" data-dce-background-overlay-color="#000000" data-e-type="section" data-element_type="section" data-id="bf80133" data-settings='{"background_background":"classic"}'>
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-2bfae19" data-e-type="column" data-element_type="column" data-id="2bfae19">
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
<section class="elementor-section elementor-top-section elementor-element elementor-element-889b781 elementor-section-full_width project-filter elementor-section-height-default elementor-section-height-default" data-dce-background-image-url="/wp-content/uploads/2021/12/bg-logo-3-2.jpg" data-e-type="section" data-element_type="section" data-id="889b781" data-settings='{"background_background":"classic"}'>
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-9a3bd91" data-e-type="column" data-element_type="column" data-id="9a3bd91">
<div class="elementor-widget-wrap elementor-element-populated">
<section class="elementor-section elementor-inner-section elementor-element elementor-element-4d7a4eb elementor-section-full_width elementor-section-content-middle elementor-reverse-tablet elementor-reverse-mobile elementor-hidden-desktop elementor-hidden-tablet elementor-hidden-mobile elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="4d7a4eb">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-5d732b1" data-e-type="column" data-element_type="column" data-id="5d732b1">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-9fb5571" data-e-type="column" data-element_type="column" data-id="9fb5571">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-3c3649f" data-e-type="column" data-element_type="column" data-id="3c3649f">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-26b1630 elementor-align-justify elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="26b1630" data-widget_type="button.default">
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
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-09b61c2" data-e-type="column" data-element_type="column" data-id="09b61c2">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-deb697e elementor-align-justify elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="deb697e" data-widget_type="button.default">
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
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-a168eae" data-e-type="column" data-element_type="column" data-id="a168eae">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-4439987 elementor-align-justify elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="4439987" data-widget_type="button.default">
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
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-31da6ba" data-e-type="column" data-element_type="column" data-id="31da6ba">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-adfa3db elementor-align-justify filter-btn-i elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="adfa3db" data-widget_type="button.default">
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
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-9083081" data-e-type="column" data-element_type="column" data-id="9083081">
<div class="elementor-widget-wrap">
</div>
</div>
<div class="elementor-column elementor-col-12 elementor-inner-column elementor-element elementor-element-482be2e" data-e-type="column" data-element_type="column" data-id="482be2e">
<div class="elementor-widget-wrap">
</div>
</div>
</div>
</section>
<section class="elementor-section elementor-inner-section elementor-element elementor-element-0a872f3 elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="0a872f3">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-741d9be" data-e-type="column" data-element_type="column" data-id="741d9be">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-661c2a3 elementor-icon-list--layout-inline elementor-list-item-link-inline elementor-align-center elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="661c2a3" data-widget_type="icon-list.default">
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
<li class="elementor-icon-list-item elementor-inline-item">
<a href="{{ url('/commercial-lighting-projects') }}">
<span class="elementor-icon-list-text">
                 Commercial
                </span>
</a>
</li>
<li class="elementor-icon-list-item elementor-inline-item active">
<a class="active" href="{{ url('/other-lighting-projects') }}">
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
<section class="elementor-section elementor-inner-section elementor-element elementor-element-e9af8e6 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="e9af8e6">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-e260508" data-e-type="column" data-element_type="column" data-id="e260508">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-b82e223 premium-blog-align-left elementor-widget elementor-widget-premium-addon-blog" data-e-type="widget" data-element_type="widget" data-id="b82e223" data-settings='{"force_height":"true","premium_blog_columns_number":"33.33%","custom_posts_filter":[],"premium_blog_grid":"yes","premium_blog_layout":"even","premium_blog_columns_number_tablet":"50%","premium_blog_columns_number_mobile":"100%"}' data-widget_type="premium-addon-blog.default">
<div class="elementor-widget-container">
<div class="premium-blog-wrap premium-blog-even" data-page="10052">
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="The Enabling Village, Singapore" class="attachment-full size-full wp-image-10925" decoding="async" fetchpriority="high" height="2250" sizes="(max-width: 2250px) 100vw, 2250px" src="/wp-content/uploads/2021/12/The-Enabling-Village@25x.jpg" srcset="/wp-content/uploads/2021/12/The-Enabling-Village@25x.jpg 2250w, /wp-content/uploads/2021/12/The-Enabling-Village@25x-300x300.jpg 300w, /wp-content/uploads/2021/12/The-Enabling-Village@25x-1024x1024.jpg 1024w, /wp-content/uploads/2021/12/The-Enabling-Village@25x-150x150.jpg 150w, /wp-content/uploads/2021/12/The-Enabling-Village@25x-768x768.jpg 768w, /wp-content/uploads/2021/12/The-Enabling-Village@25x-1536x1536.jpg 1536w, /wp-content/uploads/2021/12/The-Enabling-Village@25x-2048x2048.jpg 2048w, /wp-content/uploads/2021/12/The-Enabling-Village@25x-1568x1568.jpg 1568w" style="width:100%;height:100%;max-width:2250px" width="2250"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/the-enabling-village-singapore" target="_blank">
<span class="elementor-screen-only">
                    The Enabling Village, Singapore
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
<a href="/projects/the-enabling-village-singapore" target="_blank">
                    The Enabling Village, Singapore
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
<div class="premium-blog-content-inner-wrapper">
<p class="premium-blog-post-content">
</p>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="" class="attachment-full size-full wp-image-13387" decoding="async" height="1183" sizes="(max-width: 1184px) 100vw, 1184px" src="/wp-content/uploads/2023/10/Church-of-Nativity.png" srcset="/wp-content/uploads/2023/10/Church-of-Nativity.png 1184w, /wp-content/uploads/2023/10/Church-of-Nativity-300x300.png 300w, /wp-content/uploads/2023/10/Church-of-Nativity-1024x1024.png 1024w, /wp-content/uploads/2023/10/Church-of-Nativity-150x150.png 150w, /wp-content/uploads/2023/10/Church-of-Nativity-768x767.png 768w" style="width:100%;height:99.92%;max-width:1184px" width="1184"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/church-of-the-nativity-of-the-blessed-virgin-mary" target="_blank">
<span class="elementor-screen-only">
                    Church of the Nativity of the Blessed Virgin Mary
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
<a href="/projects/church-of-the-nativity-of-the-blessed-virgin-mary" target="_blank">
                    Church of the Nativity of the Blessed Virgin Mary
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
<div class="premium-blog-content-inner-wrapper">
<p class="premium-blog-post-content">
</p>
</div>
</div>
</div>
</div>
<div class="premium-blog-post-outer-container" data-total="1">
<div class="premium-blog-post-container premium-blog-skin-banner">
<div class="premium-blog-thumb-effect-wrapper">
<div class="premium-blog-thumbnail-container premium-blog-none-effect">
<img alt="" class="attachment-full size-full wp-image-13473" decoding="async" height="1200" loading="lazy" sizes="(max-width: 1200px) 100vw, 1200px" src="/wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website.jpg" srcset="/wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website.jpg 1200w, /wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website-300x300.jpg 300w, /wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website-1024x1024.jpg 1024w, /wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website-150x150.jpg 150w, /wp-content/uploads/2024/05/Church-of-Blessed-Sacrament-Website-768x768.jpg 768w" style="width:100%;height:100%;max-width:1200px" width="1200"/>
</div>
<div class="premium-blog-thumbnail-overlay">
<a class="elementor-icon" href="/projects/church-of-the-blessed-sacrament" target="_blank">
<span class="elementor-screen-only">
                    Church of the Blessed Sacrament
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
<a href="/projects/church-of-the-blessed-sacrament" target="_blank">
                    Church of the Blessed Sacrament
                   </a>
</h2>
<div class="premium-blog-entry-meta">
</div>
</div>
<div class="premium-blog-content-inner-wrapper">
<p class="premium-blog-post-content">
</p>
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
