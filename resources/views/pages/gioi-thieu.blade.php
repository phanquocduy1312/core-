@extends('layouts.app')

@section('title', 'About Us - LuxLight')
@section('meta_description', 'Founded in 2006, LuxLight dedicates to offer total lighting solution with full range of lighting selection among architectural, outdoor and decorative lightings as a leading lighting solution provider based in Singapore.')

@push('styles')
<link href="/wp-content/uploads/elementor/css/post-799.css" id="elementor-post-799-css" media="all" rel="stylesheet"/>
<style>
    /* Specific About Page Enhancements & Overrides */
    .elementor-799 .elementor-element.elementor-element-9f8c445 {
        background-image: url(/wp-content/uploads/2021/12/Banner_2_3055x1527-scaled.jpg) !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        min-height: 390px !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
    .elementor-799 .elementor-element.elementor-element-463af9f .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 50.4px !important;
        font-weight: 300 !important;
        line-height: 60.8px !important;
        letter-spacing: -0.6px !important;
        color: #FFFFFF !important;
        text-align: center !important;
    }
    .elementor-799 .elementor-element.elementor-element-a277e6e .elementor-heading-title {
        font-family: "Din", sans-serif !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        color: #FFFFFF !important;
        text-align: center !important;
    }
    .elementor-799 .elementor-element.elementor-element-6ee43f9 .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 16.8px !important;
        font-weight: 400 !important;
        line-height: 30.24px !important;
        letter-spacing: 0px !important;
        color: #EAA931 !important;
        text-align: center !important;
    }
    
    .elementor-799 .elementor-element.elementor-element-42d4326 {
        background-image: url(/wp-content/uploads/2021/12/bg-logo-2.jpg) !important;
        background-position: top right !important;
        background-repeat: no-repeat !important;
        background-size: contain !important;
        background-color: #FFFFFF !important;
        padding: 4% 4% 9% 4% !important;
    }
    .elementor-799 .elementor-element.elementor-element-e970492 {
        background-color: #ECECEC !important;
        padding: 50px 50px 50px 50px !important;
    }
    .elementor-799 .elementor-element.elementor-element-3313115 .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 44.8px !important;
        font-weight: 400 !important;
        line-height: 53.76px !important;
        letter-spacing: 0.6px !important;
        color: #0B1523 !important;
    }
    .elementor-799 .elementor-element.elementor-element-a7c8baa,
    .elementor-799 .elementor-element.elementor-element-b2a273e,
    .elementor-799 .elementor-element.elementor-element-b7d4acd {
        font-family: "Din", sans-serif !important;
        font-size: 14px !important;
        font-weight: 300 !important;
        line-height: 28px !important;
        letter-spacing: 0px !important;
        color: #0B1523 !important;
        text-align: justify !important;
    }
    .elementor-799 .elementor-element.elementor-element-b2a273e a {
        color: #0B1523 !important;
        font-weight: 600 !important;
        text-decoration: underline !important;
    }
    .elementor-799 .elementor-element.elementor-element-a7c26ed img {
        height: 420px !important;
        width: 100% !important;
        object-fit: cover !important;
        object-position: center center !important;
        border-radius: 0px 45px 0px 0px !important;
        display: block !important;
    }
    
    .elementor-799 .elementor-element.elementor-element-682d232 {
        background-image: url(/wp-content/uploads/2021/12/bg-mission-vission.jpg) !important;
        background-repeat: repeat !important;
        background-size: auto !important;
        padding: 5% 4% 5% 4% !important;
    }
    .elementor-799 .elementor-element.elementor-element-7cb16d2 img {
        border-radius: 0px 50px 0px 0px !important;
        width: 100% !important;
        max-width: 850px !important;
        height: 480px !important;
        object-fit: cover !important;
        object-position: center center !important;
        display: block !important;
    }
    .elementor-799 .elementor-element.elementor-element-25bc77c .elementor-heading-title,
    .elementor-799 .elementor-element.elementor-element-29e1d22 .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 44.08px !important;
        font-weight: 400 !important;
        line-height: 53.76px !important;
        letter-spacing: -0.6px !important;
        color: #FFFFFF !important;
    }
    .elementor-799 .elementor-element.elementor-element-0cfc578,
    .elementor-799 .elementor-element.elementor-element-092c8df {
        font-family: "Din", sans-serif !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        line-height: 25.2px !important;
        letter-spacing: 0px !important;
        color: #FFFFFF !important;
    }
    .elementor-799 .elementor-element.elementor-element-092c8df ul {
        list-style-type: disc !important;
        padding-left: 20px !important;
        margin: 0 !important;
        color: #FFFFFF !important;
    }
    .elementor-799 .elementor-element.elementor-element-092c8df li {
        margin-bottom: 8px !important;
        color: #FFFFFF !important;
    }
</style>
@endpush

@section('content')
<div class="elementor elementor-799" data-elementor-id="799" data-elementor-post-type="page" data-elementor-type="wp-page">
    
    <!-- Hero / Banner Section -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-9f8c445 elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle" data-dce-background-image-url="/wp-content/uploads/2021/12/Banner_2_3055x1527-scaled.jpg" data-dce-background-overlay-color="#000000" data-e-type="section" data-element_type="section" data-id="9f8c445" data-settings='{"background_background":"classic"}'>
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-fa0f908" data-e-type="column" data-element_type="column" data-id="fa0f908">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-background-overlay"></div>
                    <div class="elementor-element elementor-element-463af9f animated-slow elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="463af9f" data-settings='{"_animation":"slideInUp"}' data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">
                                About LuxLight
                            </h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-a277e6e animated-slow elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="a277e6e" data-settings='{"_animation":"slideInUp"}' data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">
                                'As we work to create light for others, we naturally light our own way.'
                            </h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-6ee43f9 elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="6ee43f9" data-settings='{"_animation":"slideInUp"}' data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">
                                Mary Anne Radmacher
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Introduction Section -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-42d4326 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-dce-background-image-url="/wp-content/uploads/2021/12/bg-logo-2.jpg" data-e-type="section" data-element_type="section" data-id="42d4326" data-settings='{"background_background":"classic"}' id="company">
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-58daa7c" data-e-type="column" data-element_type="column" data-id="58daa7c">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <section class="elementor-section elementor-inner-section elementor-element elementor-element-e970492 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-dce-background-color="#ECECEC" data-e-type="section" data-element_type="section" data-id="e970492" data-settings='{"background_background":"classic"}'>
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-65cf113 animated-slow" data-e-type="column" data-element_type="column" data-id="65cf113" data-settings='{"animation":"fadeIn"}'>
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-3313115 elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="3313115" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">
                                                Company Introduction
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-a7c8baa elementor-widget elementor-widget-text-editor" data-e-type="widget" data-element_type="widget" data-id="a7c8baa" data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <p>
                                                Founded in 2006, LuxLight delicates to offer total lighting solution with full range of lighting selection among architectural, outdoor and decorative lightings as a leading lighting solution provider based in Singapore.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-b2a273e elementor-widget elementor-widget-text-editor" data-e-type="widget" data-element_type="widget" data-id="b2a273e" data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <p>
                                                With over 15 years of lighting project supply experience in South Asia and Southeast Asia, and gained full support from
                                                <a href="https://prosperity-grp.com/" target="_blank" rel="noopener noreferrer">
                                                    Prosperity Group
                                                </a>
                                                from 2020, LuxLight’s team is highly capable to demonstrate their expertise on the installation and project implementation perfectly to achieve satisfied result. Comprehensive, innovative and detail-minded make our services always in high standard, which meets the aspirational demands of architects, designers, lighting consultants and the owners or developers of different building projects.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-b7d4acd elementor-widget elementor-widget-text-editor" data-e-type="widget" data-element_type="widget" data-id="b7d4acd" data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <p>
                                                In this digital age that permeates our lives, the technology is transforming the way we access, use and manage illumination with ever greater imagination and ingenuity. At the heart of these transformations, LuxLight brings to our clients and partners the best of its expertise and experience, through reliable and customer-centric solutions.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-fc8274e animated-slow" data-e-type="column" data-element_type="column" data-id="fc8274e" data-settings='{"animation":"fadeInLeft"}'>
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-a7c26ed dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="a7c26ed" data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img src="/wp-content/uploads/2021/12/SG-Office-scaled.jpg" alt="LuxLight Singapore Office" style="width: 100%; height: 420px; object-fit: cover; object-position: center; border-radius: 0 45px 0 0; display: block;" />
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

    <!-- Mission & Vision Statement Section -->
    <section class="elementor-section elementor-top-section elementor-element elementor-element-682d232 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-dce-background-image-url="/wp-content/uploads/2021/12/bg-mission-vission.jpg" data-e-type="section" data-element_type="section" data-id="682d232" data-settings='{"background_background":"classic"}'>
        <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-0675c8a" data-e-type="column" data-element_type="column" data-id="0675c8a">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <section class="elementor-section elementor-inner-section elementor-element elementor-element-87081fe elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="87081fe">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-56ac273" data-e-type="column" data-element_type="column" data-id="56ac273">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-7cb16d2 animated-slow dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="7cb16d2" data-settings='{"_animation":"fadeInLeft"}' data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img src="/wp-content/uploads/2021/12/All-Day-Dining-5.jpg" alt="LuxLight Mission Vision Project" style="width: 100%; max-width: 850px; height: 480px; object-fit: cover; object-position: center; border-radius: 0 50px 0 0; display: block;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-bc5d646 animated-slow" data-e-type="column" data-element_type="column" data-id="bc5d646" data-settings='{"animation":"slideInUp"}'>
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-25bc77c elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="25bc77c" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">
                                                Mission Statement
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-0cfc578 elementor-widget elementor-widget-text-editor" data-e-type="widget" data-element_type="widget" data-id="0cfc578" data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <p>
                                                The mission of LuxLight is to provide architects, lighting designers and owners with full range of lighting selection to over-achieve the requirements of their high-end building projects and work in tandem with the respective manufacturers as a professional leading lighting supplier in Asia.
                                            </p>
                                            <p>
                                                Being the champions and ambassadors of the manufacturers whom we work hand-in-hand with, we aim to deliver the best customer experience and to make LuxLight the partner of choice by providing a comprehensive suite of solutions and services.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-29e1d22 elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="29e1d22" data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">
                                                Vision Statement
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-092c8df elementor-widget elementor-widget-text-editor" data-e-type="widget" data-element_type="widget" data-id="092c8df" data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <ul>
                                                <li>
                                                    We always strive to create a difference in each and every project undertaken.
                                                </li>
                                                <li>
                                                    We are responsible, accountable, competent and supportive lighting suppliers.
                                                </li>
                                                <li>
                                                    We promote honesty, integrity and professionalism in all we do.
                                                </li>
                                                <li>
                                                    We realize the conceptual art as customise decorative lights that fulfils both the art and science of illumination.
                                                </li>
                                            </ul>
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
