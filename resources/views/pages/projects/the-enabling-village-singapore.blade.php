@extends('layouts.app')

@section('title', 'The Enabling Village, Singapore - LuxLight Project')
@section('meta_description', 'Commercial Lighting Project for a Community at Enabling Village, a common space for people with disabilities and the able-bodied. Supply of Interior & Outdoor Lighting')

@push('styles')
<link href="/wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min.css" rel="stylesheet"/>
<style>
    /* Scope for Single Project Page */
    .project-single-wrapper {
        background-color: #FFFFFF;
        width: 100%;
        overflow: hidden;
    }

    /* 1. Top Hero Banner */
    .project-hero-banner {
        position: relative;
        width: 100%;
        min-height: 240px;
        height: 260px;
        background: linear-gradient(rgba(11, 21, 35, 0.45), rgba(11, 21, 35, 0.45)), url('/wp-content/uploads/2021/12/The-Enabling-Village@25x.jpg') center/cover no-repeat !important;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .project-hero-banner h1 {
        font-family: "ACaslonPro", Georgia, serif !important;
        font-size: 38px !important;
        font-weight: 300 !important;
        line-height: 48px !important;
        color: #FFFFFF !important;
        text-align: center !important;
        margin: 0 !important;
        padding: 0 20px !important;
        letter-spacing: -0.5px !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5) !important;
    }

    /* 2. Our Project Heading Section */
    .project-title-section {
        position: relative;
        background-color: #FFFFFF;
        background-image: url('/wp-content/uploads/2021/12/bg-logo-3-2.jpg');
        background-position: top left;
        background-repeat: no-repeat;
        background-size: 26% auto;
        padding: 50px 20px 25px 20px;
    }
    .project-title-container {
        max-width: 1140px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
    }
    .project-title-line {
        flex: 1;
        height: 1px;
        background-color: #E2E2E2;
    }
    .project-title-text {
        font-family: "ACaslonPro", Georgia, serif !important;
        font-size: 42px !important;
        font-weight: 400 !important;
        color: #112135 !important;
        margin: 0 !important;
        white-space: nowrap !important;
        letter-spacing: -0.5px !important;
    }

    /* 3. Project Detail Content (2 Columns) */
    .project-content-section {
        background-color: #FFFFFF;
        padding: 10px 20px 70px 20px;
    }
    .project-content-container {
        max-width: 1140px;
        margin: 0 auto;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 50px;
    }
    .project-gallery-col {
        flex: 1 1 50%;
        max-width: 50%;
        position: relative;
        box-sizing: border-box;
    }
    .project-info-col {
        flex: 1 1 50%;
        max-width: 50%;
        box-sizing: border-box;
        padding-top: 5px;
    }

    /* Swiper Slider with 40px top-right border-radius */
    .project-swiper {
        width: 100%;
        overflow: hidden;
        border-radius: 0 40px 0 0 !important;
        background-color: #F8F9FA;
        position: relative;
    }
    .project-swiper .swiper-wrapper {
        display: flex;
    }
    .project-swiper .swiper-slide {
        flex-shrink: 0;
        width: 100%;
        height: 380px;
        overflow: hidden;
    }
    .project-swiper .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        border-radius: 0 40px 0 0 !important;
    }
    /* Dots positioned inside bottom of photo like reference */
    .project-swiper-pagination {
        position: absolute !important;
        bottom: 16px !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 10 !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 9px !important;
        margin: 0 !important;
    }
    .project-swiper-pagination .swiper-pagination-bullet {
        width: 8px !important;
        height: 8px !important;
        border-radius: 50% !important;
        background: #FFFFFF !important;
        opacity: 0.55 !important;
        cursor: pointer !important;
        transition: all 0.25s ease !important;
    }
    .project-swiper-pagination .swiper-pagination-bullet-active {
        background: #FFFFFF !important;
        opacity: 1 !important;
        transform: scale(1.25) !important;
    }

    /* Right Column Typography & Brand Styling */
    .project-name {
        font-family: "ACaslonPro", Georgia, serif !important;
        font-size: 26px !important;
        font-weight: 700 !important;
        line-height: 32px !important;
        color: #AB9A71 !important;
        margin: 0 0 14px 0 !important;
        letter-spacing: -0.3px !important;
    }
    .project-location {
        font-family: "DIN", sans-serif !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #112135 !important;
        margin: 0 0 16px 0 !important;
    }
    .project-description {
        font-family: "DIN", sans-serif !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        line-height: 25px !important;
        color: #112135 !important;
        margin: 0 0 18px 0 !important;
    }
    .project-scope-title {
        font-family: "DIN", sans-serif !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #112135 !important;
        margin: 18px 0 8px 0 !important;
    }
    .project-scope-list {
        font-family: "DIN", sans-serif !important;
        font-size: 14px !important;
        line-height: 24px !important;
        color: #112135 !important;
        margin: 0 0 28px 0 !important;
        padding-left: 20px !important;
    }
    .project-scope-list li {
        margin-bottom: 4px !important;
    }
    .project-back-btn {
        display: inline-block !important;
        background-color: #0B1523 !important;
        color: #FFFFFF !important;
        font-family: "DIN", sans-serif !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        letter-spacing: 0.3px !important;
        padding: 11px 50px !important;
        border-radius: 0px !important;
        text-decoration: none !important;
        transition: background-color 0.25s ease !important;
        border: none !important;
        cursor: pointer !important;
    }
    .project-back-btn:hover {
        background-color: #EAA931 !important;
        color: #FFFFFF !important;
    }

    @media (max-width: 991px) {
        .project-content-container {
            flex-direction: column !important;
        }
        .project-gallery-col,
        .project-info-col {
            max-width: 100% !important;
            flex: 1 1 100% !important;
        }
        .project-swiper .swiper-slide {
            height: 320px;
        }
    }
    @media (max-width: 640px) {
        .project-hero-banner {
            min-height: 180px;
            height: 180px;
        }
        .project-hero-banner h1 {
            font-size: 24px !important;
            line-height: 32px !important;
        }
        .project-title-text {
            font-size: 28px !important;
        }
        .project-title-section {
            padding: 30px 15px 20px 15px;
        }
        .project-title-line {
            display: none;
        }
        .project-swiper .swiper-slide {
            height: 240px;
        }
    }
</style>
@endpush

@section('content')
<div class="project-single-wrapper">
    <!-- 1. Top Hero Banner -->
    <div class="project-hero-banner">
        <h1>The Enabling Village, Singapore</h1>
    </div>

    <!-- 2. Our Project Section Header -->
    <div class="project-title-section">
        <div class="project-title-container">
            <div class="project-title-line"></div>
            <h2 class="project-title-text">Our Project</h2>
            <div class="project-title-line"></div>
        </div>
    </div>

    <!-- 3. Project Detail Content -->
    <div class="project-content-section">
        <div class="project-content-container">
            <!-- Left Column: Gallery Carousel -->
            <div class="project-gallery-col">
                <div class="project-swiper swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="/wp-content/uploads/elementor/thumbs/Enabling_666x416-pisiv4w8yxsxprpdnzd7mwy6iyjopm4l6m5rg8mms8.jpg" alt="The Enabling Village, Singapore - 1">
                        </div>
                        <div class="swiper-slide">
                            <img src="/wp-content/uploads/elementor/thumbs/Enabling-Village_870x544-pisiv5u35ru81do0ihru7epn4cf1xb8biqt8xil8m0.jpg" alt="The Enabling Village, Singapore - 2">
                        </div>
                        <div class="swiper-slide">
                            <img src="/wp-content/uploads/elementor/thumbs/06012022-SG-Enable-View-1-scaled-pisiv14w7lnsfbuu9xqpcxwc5f27utpnu3jtj4s7h4.jpg" alt="The Enabling Village, Singapore - 3">
                        </div>
                    </div>
                    <!-- Swiper dots inside image -->
                    <div class="project-swiper-pagination"></div>
                </div>
            </div>

            <!-- Right Column: Project Info -->
            <div class="project-info-col">
                <h2 class="project-name">The Enabling Village</h2>
                <div class="project-location">Singapore</div>
                <div class="project-description">
                    An inclusive community space , home to several social businesses and community services, the place that receives the platinum award, the highest honor for BCA’s Universal Design Mark Award (UDMA). A common space for people with disabilities and the able-bodied.
                </div>
                <div class="project-scope-title">What LuxLight provides?</div>
                <ul class="project-scope-list">
                    <li>Interior &amp; Outdoor Lighting</li>
                </ul>
                <div class="project-button-wrap">
                    <a href="{{ url('/other-lighting-projects') }}" class="project-back-btn">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function() {
        function initProjectSwiper() {
            if (typeof Swiper !== 'undefined') {
                new Swiper('.project-swiper', {
                    loop: true,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.project-swiper-pagination',
                        clickable: true,
                    },
                });
            }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initProjectSwiper);
        } else {
            initProjectSwiper();
        }
    })();
</script>
@endpush
