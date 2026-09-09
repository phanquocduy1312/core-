@extends('layouts.app')

@section('title', 'Brands - LuxLight')
@section('meta_description', 'Wide Range of International Lighting Brands for Your Selection - LuxLight Singapore')

@push('styles')
<link href="/wp-content/plugins/elementor-pro/assets/css/widget-flip-box.min.css" id="widget-flip-box-css" media="all" rel="stylesheet"/>
<link href="/wp-content/plugins/elementor/assets/css/widget-divider.min.css" id="widget-divider-css" media="all" rel="stylesheet"/>
<link href="/wp-content/uploads/elementor/css/post-2192.css" id="elementor-post-2192-css" media="all" rel="stylesheet"/>
<style>
    /* Brands Hero Banner Overrides */
    .elementor-2192 .elementor-element.elementor-element-7ff2bc8 {
        background-image: url(/wp-content/uploads/2021/12/Banner_3_1242x621.jpg) !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        min-height: 460px !important;
        margin-top: 0 !important;
        padding: 80px 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .elementor-2192 .elementor-element.elementor-element-cfbae39 .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 48px !important;
        font-weight: 300 !important;
        line-height: 58px !important;
        letter-spacing: -0.5px !important;
        color: #FFFFFF !important;
        text-align: center !important;
        margin-bottom: 20px !important;
    }
    .elementor-2192 .elementor-element.elementor-element-6a01dff,
    .elementor-2192 .elementor-element.elementor-element-6a01dff .elementor-widget-container {
        font-family: "Din", sans-serif !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        color: #FFFFFF !important;
        text-align: center !important;
    }
    .elementor-2192 .elementor-element.elementor-element-e3a7625,
    .elementor-2192 .elementor-element.elementor-element-e3a7625 .elementor-widget-container {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 17px !important;
        font-weight: 400 !important;
        line-height: 32px !important;
        color: #EAA931 !important;
        text-align: center !important;
        margin-top: 8px !important;
    }
    
    /* Background watermark for brand section */
    .elementor-2192 .elementor-element.elementor-element-e4602ea {
        background-image: url(/wp-content/uploads/2021/12/bg-logo-3-2.jpg) !important;
        background-position: top center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        background-color: #FFFFFF !important;
        padding-top: 50px !important;
        padding-bottom: 70px !important;
    }
    
    .elementor-2192 .elementor-element.elementor-element-28088c7 {
        text-align: center !important;
        margin-bottom: 35px !important;
    }
    .elementor-2192 .elementor-element.elementor-element-28088c7 .elementor-heading-title {
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 44px !important;
        font-weight: 400 !important;
        color: #0B1523 !important;
        letter-spacing: -0.5px !important;
    }
    
    /* Elementor Flip Box Essential Styling & Hover Interactions */
    .elementor-2192 .elementor-flip-box {
        position: relative !important;
        height: 380px !important;
        overflow: hidden !important;
        cursor: pointer !important;
    }
    .elementor-2192 .elementor-flip-box__layer {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        transition: opacity 0.4s ease-in-out !important;
    }
    .elementor-2192 .elementor-flip-box__front {
        z-index: 1 !important;
        opacity: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: flex-end !important;
        background-size: cover !important;
        background-position: center !important;
    }
    .elementor-2192 .elementor-flip-box__front .elementor-flip-box__layer__overlay {
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: auto !important;
        padding: 0 !important;
        margin: 0 !important;
        display: flex !important;
        justify-content: flex-start !important;
        align-items: flex-end !important;
        background: transparent !important;
    }
    .elementor-2192 .elementor-flip-box__front .elementor-flip-box__layer__inner {
        width: 100% !important;
        display: flex !important;
        justify-content: flex-start !important;
    }
    .elementor-2192 .elementor-flip-box__front .elementor-flip-box__layer__title {
        background-color: #AB9A71 !important;
        color: #FFFFFF !important;
        font-family: "Din", sans-serif !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        letter-spacing: 0.5px !important;
        padding: 6px 18px !important;
        margin: 0 !important;
        display: inline-block !important;
        line-height: normal !important;
    }
    .elementor-2192 .elementor-flip-box__back {
        z-index: 2 !important;
        opacity: 0 !important;
        pointer-events: none !important;
        background-color: rgba(11, 21, 35, 0.75) !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: flex-start !important;
        padding: 25px 20px 20px 20px !important;
        box-sizing: border-box !important;
    }
    .elementor-2192 .elementor-flip-box__back .elementor-flip-box__layer__overlay {
        background: transparent !important;
        padding: 0 !important;
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }
    .elementor-2192 .elementor-flip-box__back .elementor-flip-box__layer__inner {
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }
    .elementor-2192 .elementor-flip-box:hover .elementor-flip-box__back,
    .elementor-2192 .elementor-flip-box.is-flipped .elementor-flip-box__back {
        opacity: 1 !important;
        pointer-events: auto !important;
    }
    .elementor-2192 .elementor-flip-box:hover .elementor-flip-box__front,
    .elementor-2192 .elementor-flip-box.is-flipped .elementor-flip-box__front {
        opacity: 1 !important;
    }
    .elementor-2192 .elementor-flip-box__back .elementor-flip-box__layer__description {
        color: #FFFFFF !important;
        font-family: "Din", sans-serif !important;
        font-size: 13px !important;
        line-height: 21px !important;
        font-weight: 300 !important;
        text-align: justify !important;
        margin-bottom: 15px !important;
    }
    .elementor-2192 .elementor-flip-box__button {
        background-color: #0B1523 !important;
        color: #FFFFFF !important;
        padding: 8px 18px !important;
        font-family: "Din", sans-serif !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        text-decoration: none !important;
        display: inline-block !important;
        border: 1px solid rgba(255,255,255,0.2) !important;
        transition: background 0.3s ease !important;
        align-self: flex-start !important;
        margin-top: auto !important;
    }
    .elementor-2192 .elementor-flip-box__button:hover {
        background-color: #EAA931 !important;
        border-color: #EAA931 !important;
        color: #FFFFFF !important;
    }
    
    /* Brand Logos & Section Dividers */
    .elementor-2192 .elementor-widget-image {
        margin: 16px 0 10px 0 !important;
        min-height: 42px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        background: transparent !important;
    }
    .elementor-2192 .elementor-widget-image .elementor-widget-container {
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
        background: transparent !important;
    }
    .elementor-2192 .elementor-widget-image img {
        max-height: 38px !important;
        width: auto !important;
        max-width: 160px !important;
        object-fit: contain !important;
        object-position: left center !important;
        display: block !important;
        mix-blend-mode: multiply !important;
        background-color: transparent !important;
    }
    .elementor-2192 .elementor-widget-divider {
        margin: 10px 0 25px 0 !important;
    }
    .elementor-2192 .elementor-divider-separator {
        border-top: 1px solid #DEDEDE !important;
        width: 100% !important;
    }
    
    /* 4-column responsive grid */
    @media (min-width: 1025px) {
        .elementor-2192 .elementor-inner-column.elementor-col-25 {
            width: 25% !important;
            padding: 0 12px !important;
            box-sizing: border-box !important;
        }
    }
    @media (max-width: 1024px) and (min-width: 768px) {
        .elementor-2192 .elementor-inner-column.elementor-col-25 {
            width: 50% !important;
            padding: 0 12px !important;
            margin-bottom: 25px !important;
            box-sizing: border-box !important;
        }
    }
    @media (max-width: 767px) {
        .elementor-2192 .elementor-inner-column.elementor-col-25 {
            width: 100% !important;
            padding: 0 10px !important;
            margin-bottom: 25px !important;
            box-sizing: border-box !important;
        }
    }
</style>
@endpush

@section('content')
  <div class="elementor elementor-2192" data-elementor-id="2192" data-elementor-post-type="page" data-elementor-type="wp-page">
   <section class="elementor-section elementor-top-section elementor-element elementor-element-7ff2bc8 elementor-section-full_width elementor-section-height-min-height elementor-section-height-default elementor-section-items-middle" data-dce-background-image-url="/wp-content/uploads/2021/12/Banner_3_1242x621.jpg" data-dce-background-overlay-color="#000000" data-e-type="section" data-element_type="section" data-id="7ff2bc8" data-settings='{"background_background":"classic"}'>
    <div class="elementor-background-overlay">
    </div>
    <div class="elementor-container elementor-column-gap-default">
     <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-8acc696" data-e-type="column" data-element_type="column" data-id="8acc696" data-settings='{"background_background":"classic"}'>
      <div class="elementor-widget-wrap elementor-element-populated">
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-efece27 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="efece27">
        <div class="elementor-background-overlay">
        </div>
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-58a0c01 elementor-hidden-mobile" data-e-type="column" data-element_type="column" data-id="58a0c01">
          <div class="elementor-widget-wrap">
          </div>
         </div>
         <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-5e7d95d" data-e-type="column" data-element_type="column" data-id="5e7d95d">
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-cfbae39 animated-slow  elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="cfbae39" data-settings='{"_animation":"slideInUp"}' data-widget_type="heading.default">
            <div class="elementor-widget-container">
             <h2 class="elementor-heading-title elementor-size-default">
              Wide Range of International Lighting Brands for Your Selection
             </h2>
            </div>
           </div>
           <div class="elementor-element elementor-element-6a01dff animated-slow  elementor-widget elementor-widget-text-editor" data-e-type="widget" data-element_type="widget" data-id="6a01dff" data-settings='{"_animation":"slideInUp","_animation_delay":700}' data-widget_type="text-editor.default">
            <div class="elementor-widget-container">
             ‘Give light and people will find the way’
            </div>
           </div>
           <div class="elementor-element elementor-element-e3a7625 animated-slow  elementor-widget elementor-widget-text-editor" data-e-type="widget" data-element_type="widget" data-id="e3a7625" data-settings='{"_animation":"slideInUp","_animation_delay":1000}' data-widget_type="text-editor.default">
            <div class="elementor-widget-container">
             Ella Baker
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-64ee698 elementor-hidden-mobile" data-e-type="column" data-element_type="column" data-id="64ee698">
          <div class="elementor-widget-wrap">
          </div>
         </div>
        </div>
       </section>
      </div>
     </div>
    </div>
   </section>
   <section class="elementor-section elementor-top-section elementor-element elementor-element-e4602ea elementor-section-full_width brand-btn elementor-section-height-default elementor-section-height-default" data-dce-background-image-url="/wp-content/uploads/2021/12/bg-logo-3-2.jpg" data-e-type="section" data-element_type="section" data-id="e4602ea" data-settings='{"background_background":"classic"}'>
    <div class="elementor-container elementor-column-gap-default">
     <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-692a9e0" data-e-type="column" data-element_type="column" data-id="692a9e0">
      <div class="elementor-widget-wrap elementor-element-populated">
       <div class="elementor-element elementor-element-28088c7  elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="28088c7" data-settings='{"_animation":"slideInUp"}' data-widget_type="heading.default">
        <div class="elementor-widget-container">
         <h2 class="elementor-heading-title elementor-size-default">
          Our Brands
         </h2>
        </div>
       </div>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-d5b28c2 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="d5b28c2">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-476cc08 animated-slow " data-e-type="column" data-element_type="column" data-id="476cc08" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-c285c12 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="c285c12" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  America
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Acolyte is one of the world’s leading providers of architectural LED lighting solutions. Through the collaboration with international designers, their products are found in major installations around the globe, from first-class hotels and high-end restaurants to luxury homes and sparkling modern sports stadiums.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://genledbrands.com/acolyte/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-4786d4b dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="4786d4b" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="acolyte" class="attachment-full size-full wp-image-13067" decoding="async" height="37" src="/wp-content/uploads/2022/01/acolyte_png_re-1.png" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-20ef80e elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="20ef80e" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-1afe0d5 animated-slow " data-e-type="column" data-element_type="column" data-id="1afe0d5" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-e2f2bed elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="e2f2bed" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Aldabra's lighting solutions are proudly “Made in Italy” where they design, engineer and manufacturer under strict parameters to insure quality. It is a reference point for professional architectural and landscape exterior lighting. Through the use of innovative materials, Aldabra products are highly resistant to challenging environments, an essential element in an era of deep climate change.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://en.aldabra.it/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-27cd264 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="27cd264" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="aldabra" class="attachment-full size-full wp-image-13068" decoding="async" height="37" src="/wp-content/uploads/2022/01/aldabra_png_re-1.png" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-53f878a elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="53f878a" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-86f807a animated-slow " data-e-type="column" data-element_type="column" data-id="86f807a" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-247e706 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="247e706" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  China
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Inspired by the concept of simplicity and flexibility, apexLED provides quality LED lighting solutions that deliver the right ambience maximizing the architectural designs.
Drawing on our expertise in various industries, our broad range of products improves the lighting executions for many hospitality, residential, retail outlets, commercial and architectural applications.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" role="button" tabindex="0">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-0769860 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="0769860" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="apex" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/apex_re_opt1-1.jpg" title="apex_re_opt1"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-77b1325 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="77b1325" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-7f7b114 animated-slow " data-e-type="column" data-element_type="column" data-id="7f7b114" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-c33a514 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="c33a514" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   In 2015 Ares enters the Flos group. Flos and Ares fully share not only advanced research and innovation processes, but also the concept of integration between lighting units, architecture and spaces, and the idea of experiencing light as an emotion.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.aresill.net/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-ccb58bd dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="ccb58bd" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="ares" class="attachment-full size-full wp-image-13071" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/ares_png_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-3fde69a elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="3fde69a" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-0af4ca1 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="0af4ca1">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-8dbed6a animated-slow " data-e-type="column" data-element_type="column" data-id="8dbed6a" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-e024eec elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="e024eec" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  UK
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Since 1997, Astro's founders John Fearon and James Bassant, have shared a passion for British lighting design and a vision to create products with distinctive quality. Obsessive over the details, they refine elements others may overlook, challenging ourselves so we get it just right. The luminaires begin life here in the UK as simple drawings within our sketchbooks. Future-proofed designs with a pared-down aesthetic. It's a simplicity of form that ensures the products retain a timeless quality.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.astrolighting.com/site-version" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-0f54964 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="0f54964" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="astro" class="attachment-full size-full wp-image-13072" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/astro_png_re-1.png" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-035a335 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="035a335" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-b364a9b animated-slow " data-e-type="column" data-element_type="column" data-id="b364a9b" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-231d52e elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="231d52e" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Germany
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Barthelme is an innovative owner-managed family business and one of the technology leaders for LED lighting systems. The Barthelme product line ranges from IP protected flexible LED stripes, to a variety of innovative profiles and customized luminaires through to intelligent controllers for comfortable lighting management. Luminaires from the “Made in Germany” collection are developed and manufactured with passion for the product and customer at the company headquarters in Nurnberg.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.barthelme.de/content/en/default.aspx" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-98bb876 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="98bb876" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="barthelme" class="attachment-large size-large wp-image-13073" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/barthelme_logo_2015_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-69b4154 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="69b4154" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-20da0ae animated-slow " data-e-type="column" data-element_type="column" data-id="20da0ae" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-e34c825 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="e34c825" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Czech Republic
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   The Czech premium lighting brand, Brokis, stands for the synthesis of exquisite design, superior quality, and the remarkable craftsmanship of Bohemian glass artisans. Conceived by renowned Czech and foreign designers, the original BROKIS lighting collections have steadily earned international acclaim and recognition. The Brokis portfolio features modern functional lighting fixtures, decorative objects, and unique lighting solutions for architects and interior designers.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.brokis.cz/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-c93a6ec dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="c93a6ec" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="brokis" class="attachment-large size-large wp-image-13076" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/brokis_logo2017_ALT_black_sRGB_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-7cb1f08 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="7cb1f08" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-2e5f643 animated-slow " data-e-type="column" data-element_type="column" data-id="2e5f643" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-821b2e8 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="821b2e8" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Japan
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Brownie Ecotronics was founded in 2012 by Mr.Hideki Kataoka, driven by great passion and strong belief in developing professional architectural LED lighting.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="http://www.brownie-led.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-04c7ff1 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="04c7ff1" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="brownie" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/brownie_re-1.jpg" title="brownie_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-99fc95d elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="99fc95d" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-eb80350 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="eb80350">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-0b3bd74 animated-slow " data-e-type="column" data-element_type="column" data-id="0b3bd74" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-7af405e elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="7af405e" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  China
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   CDN is a top lighting solution provider from China who has been providing well-designed quality lighting products and praised services to over 2500 hotels globally.
Meanwhile, CDN also became a strategic lighting supplier of many big property developers, retail shops and shopping malls.
CDN provides broad range of products including interior lighting, exterior lighting, decorative lighting, emergency lighting for hotels, retail shops, shopping malls, residential buildings, museums, public facilities, sports facilities, infrastructure facilities, etc.
Besides our own standard items, CDN also has a very strong capacity to customize lighting for various projects according to specific designs.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.cdnlight.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-e98d47b dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="e98d47b" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="LOGO" decoding="async" loading="lazy" src="/wp-content/uploads/elementor/thumbs/LOGO-rhojzz21007lufwk0goy6zt81rktqeepomv8d61bsi.png" title="LOGO"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-dc89d8d elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="dc89d8d" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-a330cda animated-slow " data-e-type="column" data-element_type="column" data-id="a330cda" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-0535995 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="0535995" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Belgium
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   At Delta Light – a Belgian family business – they design and manufacture architectural lighting and collaborate with architects, designers, contractors and investors to integrate light into their projects.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.deltalight.com/en" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-5723131 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="5723131" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="delta light" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/delta-light_re-1.jpg" title="delta-light_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-630e45c elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="630e45c" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-ca808b2 animated-slow " data-e-type="column" data-element_type="column" data-id="ca808b2" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-5cfcd8d elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="5cfcd8d" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  US
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Ecosense is an LED technology company. Recognized by the likes of Red Dot for innovation and design, as well as Inc. 500 and Deloitte Technology Fast 500 for consistently making their fastest growing companies lists, we serve a creative class of artists and designers and have been fortunate to light the most coveted spaces on earth. At Ecosense, we strive to pioneer in the areas of color science, hardware, software, and data science.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.ecosenselighting.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-2beaaf6 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="2beaaf6" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="ecosense" class="attachment-full size-full wp-image-13079" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/ecosense_logo_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-81bf54b elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="81bf54b" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-44adc4d animated-slow " data-e-type="column" data-element_type="column" data-id="44adc4d" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-fe01c04 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="fe01c04" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Japan
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   ENDO Lighting is the pioneer of LED lighting. Succeeding in practical use of LED light devices first in the world, we will continue to pursue the possibilities of LED. The LED technology leads the industry, and their lighting devices have the excellent safety and reliability.
Lights of ENDO Lighting are being used everywhere, from shops, offices, and to world heritages.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.endo-lighting.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-d63652c dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="d63652c" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="endo" class="attachment-large size-large wp-image-13080" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/endo_logo_re_opt1-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-df7a0e8 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="df7a0e8" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-5bf4160 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="5bf4160">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-ee9911b animated-slow " data-e-type="column" data-element_type="column" data-id="ee9911b" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-0183486 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="0183486" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Germany
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   ERCO is a leading international specialist in architectural lighting, and is the first lighting manufacturer with a portfolio with 100% LED technology. Founded in 1934, ERCO operates as a global player with independent sales organisations and partners in 55 countries worldwide.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.erco.com/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-5f61118 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="5f61118" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="erco" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/erco_png_re-1.png" title="erco_png_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-3712239 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="3712239" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-ca2661a animated-slow " data-e-type="column" data-element_type="column" data-id="ca2661a" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-e27ac31 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="e27ac31" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Since 1984 Esse-ci has designed and manufactured interior lighting solutions, thinking of light as a factor able to promote the growth of the customers’ business. Initially, their products were intended for the industrial market. Today, Esse-ci offers a complete architectural range of solutions for interiors, with an emphasis on continuous light lines to meet the specific needs of the service world: from offices to all kinds of stores, from large scale retail channels to large public and private infrastructures such as schools, hospitals, museums.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.esse-ci.com/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-fbb2953 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="fbb2953" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="esse-ci" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/esse-ci_png_re-1.png" title="esse-ci_png_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-0d8ebb4 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="0d8ebb4" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-2a5c53e animated-slow " data-e-type="column" data-element_type="column" data-id="2a5c53e" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-4330be2 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="4330be2" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Exenia is a significant player in the professional lighting sector, specialised in the production of LED lighting fixtures for indoor use, suitable for all types of installations, from residential to commercial, from museums to showrooms. A growing company, with an entrepreneurial culture solidly based on the principles of collaboration, transparency, respect, social responsibility, quality, research, innovation, sustainability, design and personalization.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.exenia.eu/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-36095ad dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="36095ad" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="exenia" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/exenia-logo_re-1.jpg" title="exenia-logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-4c65283 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="4c65283" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-837d2d0 animated-slow " data-e-type="column" data-element_type="column" data-id="837d2d0" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-5c0cb0f elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="5c0cb0f" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Spain
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Faro Barcelona is a Spanish company founded in 1945 that produces interior lamps and outdoor lighting.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://faro.es/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-094c58f dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="094c58f" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="faro" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/faro-logo_re-1.jpg" title="faro logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-4bfc10a elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="4bfc10a" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-ec2bb78 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="ec2bb78">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-186af75 animated-slow " data-e-type="column" data-element_type="column" data-id="186af75" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-bc71d89 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="bc71d89" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Croatia
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   FILIX Lighting was founded in 1990 with the main idea of developing illumination solutions.  With implementation of modern technology and trough research and development they are able to create LED products that minimize and optimize energy consumption, while delivering maximum light output and desired effects. The product range is currently based on high quality outdoor lighting fixtures whose main purpose is to decorate and illuminate outdoor spaces and areas.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.filixlighting.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-5110a6b dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="5110a6b" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="filix" class="attachment-large size-large wp-image-13016" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/filix_logo_1_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-ba09219 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="ba09219" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-9af9022 animated-slow " data-e-type="column" data-element_type="column" data-id="9af9022" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-6b660e9 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="6b660e9" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Established in 1962 in Merano, Italy, FLOS is recognised as a world leading manufacturer of innovative lighting solutions in the residential and architectural sectors, featuring high quality products and systems characterised by fine design. The company has grown significantly over more than fifty years in business, demonstrating its ongoing commitment to research and innovation in lighting, combined with an extraordinary ability to identify new creative talents.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.flos.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-1dc2245 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="1dc2245" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="flos" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/flos_logo_re-1.jpg" title="flos_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-4324295 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="4324295" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-b1a4142 animated-slow " data-e-type="column" data-element_type="column" data-id="b1a4142" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-804578e elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="804578e" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Malaysia
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Grunzell are a provider of high quality, well-designed and engineered LED lighting products and solutions.  Established by a team of passionate LED lighting experts and in partnership with their distinguished and experienced lighting designers, the company offers a range of innovative world class LED lighting exterior and interior products that represents real value without compromise on quality.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.grunzell.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-a60c332 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="a60c332" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="grunzell" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/Grunzell-Website-Logo_re-1.jpg" title="Grunzell-Website-Logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-bee1ccc elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="bee1ccc" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-5cb52ae animated-slow " data-e-type="column" data-element_type="column" data-id="5cb52ae" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-0b94685 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="0b94685" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Established in 1959, iGuzzini is an international community at the service of architecture and lighting culture. It is a creative hub with a strong vocation for innovation, as well as a centre for excellence dedicated to the study, design and development of lighting. unanticipated level.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.iguzzini.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-e45ab8e dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="e45ab8e" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="iguzzini" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/iGuzzini-logo_re-1.jpg" title="iGuzzini-logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-447d166 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="447d166" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-78d7c92 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="78d7c92">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-b7381fd animated-slow " data-e-type="column" data-element_type="column" data-id="b7381fd" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-794c801 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="794c801" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Korea
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   KKDC is an established lighting manufacturer producing a wide range of specialist LED lighting solutions for high-end architectural markets worldwide.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://kkdc.lighting/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-1299a63 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="1299a63" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="kkdc" class="attachment-large size-large wp-image-13022" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/kkdc_logo_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-e279ab8 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="e279ab8" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-d3ec992 animated-slow " data-e-type="column" data-element_type="column" data-id="d3ec992" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-ee194dd elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="ee194dd" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Australia
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   KLIK Systems manufacturers of bespoke fittings is an Australian owned lighting manufacturer that has been supplying the Australasian region with high quality architectural linear lighting for more than forty two years, within the KLIK design team alone, there are over sixty years combined experience.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://kliksystems.com.au/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-b73d02e dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="b73d02e" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="klik" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/klik-system_logo_re-1.jpg" title="klik-system_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-052d0b1 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="052d0b1" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-77f7466 animated-slow " data-e-type="column" data-element_type="column" data-id="77f7466" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-29eb918 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="29eb918" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Belgium
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Kreon epitomises the language of form in present-day architecture, an architecture based on right angles and lines. It is to this same sober architecture that the appliances owe their universal and timeless character.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="http://www.kreon.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-15cdbdc dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="15cdbdc" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="kreon" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/kreon_re-1.jpg" title="kreon_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-4c2a044 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="4c2a044" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-f0b4a36 animated-slow " data-e-type="column" data-element_type="column" data-id="f0b4a36" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-b9fa297 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="b9fa297" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Spain
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   "We advise, we design, we produce and make your technical lighting projects possible. " For more than 45 years, Lamp has maintained its essential commitment: to bring to life functional and customized solutions for our customers' lighting challenges, adapted to any architectural project around the world. Lamp is work and attitude, Lamp is Worktitude for Light.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.lamp.es/en" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-2dfe86c dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="2dfe86c" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="lamp lighting" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/lamp_re-1.jpg" title="lamp_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-c5d376a elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="c5d376a" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-2d070f3 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="2d070f3">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-aaf7028 animated-slow " data-e-type="column" data-element_type="column" data-id="aaf7028" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-b31011b elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="b31011b" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  UK
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   LightGraphix design and manufacture lighting for architectural, marine and display use. The company started in 1979 in Dartford.  LightGraphix is very proud of the fact that all their products are manufactured in the UK which helps them ensure quality, flexibility on delivery and the production of custom lengths. They have supplied lighting for a wide variety of projects throughout the world, with 25% of the production exported.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.lightgraphix.co.uk/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-d6f0319 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="d6f0319" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="light graphix" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/Lightgraphix-logo_re-1.jpg" title="Lightgraphix-logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-5ea0d07 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="5ea0d07" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-fad7e6e animated-slow " data-e-type="column" data-element_type="column" data-id="fad7e6e" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-cb62bff elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="cb62bff" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Linea Light Group simultaneously maintains its presence as a leader in professional lighting with the I-Lèd brand, acknowledged as one of the major innovators in the LED area. From 2019, they have been in the urban &amp; industrial lighting segment with dedicated products, reinforcing the presence in the technical lighting market with efficient and innovative products. Precision, speed and reliability are the characteristics that have always defined Linea Light Group.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="http://www.linealight.com" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-47da60b dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="47da60b" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="linea light" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/linea-light-group_logo_re-1.jpg" title="linea-light-group_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-a57704a elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="a57704a" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-33b97c9 animated-slow " data-e-type="column" data-element_type="column" data-id="33b97c9" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-d0eaac7 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="d0eaac7" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Lombardo Lighting has been producing unique lighting products in Europe. They are the lighting manufacturer and designer based in the Villongo, Italy. Lombardo’s key focus is in the exterior lighting market.such as schools, hospitals, museums.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.lombardo.it/en" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-a0ae1c8 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="a0ae1c8" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="lombardo" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/lombardo_logo_re-1.jpg" title="lombardo_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-32a68a8 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="32a68a8" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-24ee336 animated-slow " data-e-type="column" data-element_type="column" data-id="24ee336" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-e1352be elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="e1352be" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Luce &amp; Light (L&amp;L) specialises in designing and producing lighting systems using LED technology since 2007. They are proud to be an authentic example of the Made in Italy branding, with a flair for innovation and a profound appreciation of architectural projects. Their lighting fixtures integrate perfectly with both indoor and outdoor spaces and surfaces to recreate natural architectural illumination.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.lucelight.it/en/" target="_blank">
                  Vist Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-2ed4bfd dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="2ed4bfd" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="luce &amp; light" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/luce_light_logo_opt2_re-1.jpg" title="luce_light_logo_opt2_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-f3fe487 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="f3fe487" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-da9327e elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="da9327e">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-36ba2fd animated-slow " data-e-type="column" data-element_type="column" data-id="36ba2fd" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-1bbfcdb elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="1bbfcdb" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Japan
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   The Luci Division of PROTERAS Co., Ltd., launched the Luci brand in 2004, and in 2005 the LED lighting business became a separate division from the space creation business. In 2009, they established a Chinese subsidiary, LUCI (SHANGHAI) LIGHTING TECHNOLOGY CO., LTD. (Offices in Shanghai and Beijing), in 2011 they opened a staffed office in Singapore and in 2012, they established a Singaporean subsidiary Luci Pte. Ltd. (Offices in Singapore and Hong Kong) to increasingly expand into overseas markets to make Luci a global brand.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.luci.co.jp/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-6f2f888 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="6f2f888" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="luci" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/luci_logo_re-1.jpg" title="luci_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-68f0603 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="68f0603" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-b459263 animated-slow " data-e-type="column" data-element_type="column" data-id="b459263" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-4738527 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="4738527" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Australia
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Lumascape transforms outdoor architectural spaces with precision engineered lighting solutions that are proven to perform.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://lumascape.net/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-b9c21dd dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="b9c21dd" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="lumascape" class="attachment-large size-large wp-image-13034" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/lumascape_logo_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-3a581a2 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="3a581a2" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-b9d5361 animated-slow " data-e-type="column" data-element_type="column" data-id="b9d5361" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-ad26aa5 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="ad26aa5" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   It is through its design that Marset aims to convey its most essential values: Good design, high quality, technological rigor, innovation, sustainability, durability, authenticity.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.marset.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-7207a4c dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="7207a4c" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="marset" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/marset_logo_re-1.jpg" title="marset_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-22d4e7f elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="22d4e7f" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-7bf5d65 animated-slow " data-e-type="column" data-element_type="column" data-id="7bf5d65" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-2408d4f elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="2408d4f" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Denmark
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   As a world leader in the creation of dynamic lighting solutions for the entertainment, architectural, and commercial sectors, Martin lighting and video systems are renowned the world over. Martin also offers a range of advanced lighting controllers and media servers, as well as a complete line of smoke machines as a complement to intelligent lighting. Martin operates the industry’s most complete and capable distributor network with local partners in nearly 100 countries. Founded in 1987 and based in Aarhus, Denmark, Martin is the lighting division of global infotainment and audio company HARMAN International Industries.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.martin.com/en-US" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-a0b755f dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="a0b755f" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="martin" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/martin_png_re-1.png" title="martin_png_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-bdfe847 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="bdfe847" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-56896a2 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="56896a2">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-fb22f1c animated-slow " data-e-type="column" data-element_type="column" data-id="fb22f1c" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-c18e096 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="c18e096" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Japan
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   ODELIC is a leading lighting manufacturer in Japan with 70 years of history. At ODELIC, we are dedicated to enriching lives and the future with advanced technology. Through ongoing R&amp;D into people-friendly lighting solutions, we are helping to promote comfort, convenience and quality of life for all.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.odelic.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-04b760b dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="04b760b" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="odelic" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/odelic_logo_re-1.jpg" title="odelic_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-e76ce85 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="e76ce85" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-9c97574 animated-slow " data-e-type="column" data-element_type="column" data-id="9c97574" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-4117eba elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="4117eba" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  UK
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Established in 1973, Orluna manufactures the UK’s best-selling architectural downlight, Orluna is a major international lighting business. Origin luminiaire collection offers the finest quality of light and colour rendition of any downlight available across the world. Their aim is to help lighting and interior designers realise the full potential of their projects by offering unparalled quality of light. Origin enriches colours in fabrics and materials and the accurate beam control helps to achieve the desired scheme effect.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.orluna.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-0594231 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="0594231" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="orluna" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/Orluna_logo_re-1.jpg" title="Orluna_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-5969153 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="5969153" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-cb992b2 animated-slow " data-e-type="column" data-element_type="column" data-id="cb992b2" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-1ec55ab elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="1ec55ab" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Germany
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Osram offers innovative and sustainable lighting solutions. The product portfolio of Osram ranges from modules, LED lamps and luminaires to light management systems.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.osram.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-d768726 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="d768726" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="osram" class="attachment-large size-large wp-image-13042" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/osram_png_re-1.png" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-39326af elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="39326af" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-dc2af64 animated-slow " data-e-type="column" data-element_type="column" data-id="dc2af64" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-dc9871c elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="dc9871c" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Panzeri has produced and sold lighting Made in Italy to over 50 countries worldwide since 1947. Panzeri lamps are made with care and attention to detail, designed to illuminate and decorate indoor and outdoor spaces offering multiple stylistic solutions, produced in Italy at an eco-compatible production plant almost entirely powered by solar energy.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://panzeri.it/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-339bc66 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="339bc66" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="panzeri" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/panzeri_re-1.jpg" title="panzeri_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-7e229b2 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="7e229b2" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-e900173 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="e900173">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-9c2213a animated-slow " data-e-type="column" data-element_type="column" data-id="9c2213a" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-5f74e17 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="5f74e17" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Platek is an international company projected to innovate in the field of architectural and decorative outdoor lighting. The range of products includes integrated architectural lighting systems consisting of floor recessed concealed lighting, appliques, suspensions, projectors and posts. All these products have an optical systems with LED technology, managed internally by the company.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.platek.eu/eng/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-b36da6e dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="b36da6e" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="platek" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/platek-logo-01_re-1.jpg" title="platek-logo-01_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-a827468 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="a827468" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-5e09e99 animated-slow " data-e-type="column" data-element_type="column" data-id="5e09e99" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-12dc113 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="12dc113" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  UK
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Precision Lighting is a British manufacturer with a proud legacy of collaborating with architects, lighting designers, interior designers and end-clients to deliver architectural luminaires and lighting systems that represent a fusion of optical excellence and aesthetic appreciation. From concept design through to prototype engineering, and delivery of finished product, the in-house London-based R+D team is committed to the development of luminaires and systems that deliver for specifier and end-users alike.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="http://precisionlighting.co.uk/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-9fc275a dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="9fc275a" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="precision lighting" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/precision_logo_re-1.jpg" title="precision_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-d0f280b elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="d0f280b" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-85ef6e4 animated-slow " data-e-type="column" data-element_type="column" data-id="85ef6e4" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-9ad5ff2 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="9ad5ff2" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Austria
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   PROLICHT is a globally successful manufacturer of architectural premium-lighting-concepts.As internationally operating company, PROLICHT maintains a global sales network with specialized partners in more than 70 countries. PROLICHT specialises in the manufacturing of architectural luminaires and lighting systems for the retail industry, offices, public buildings, the hotel sector and gastronomy.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.prolicht.at/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-8fffc79 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="8fffc79" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="prolicht" class="attachment-medium size-medium wp-image-13046" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/Prolicht_logo_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-dfa205f elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="dfa205f" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-4072c78 animated-slow " data-e-type="column" data-element_type="column" data-id="4072c78" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-6f74c59 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="6f74c59" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  UK
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Remote Controlled Lighting (RCL) is the pioneer of remote controlled motorised architectural spotlights. With over 18 years experience and over 100,000 fixtures installed worldwide, the family-owned British company produces luminaires that are intelligent, reliable and efficient. RCL’s passionate product designers and engineers are constantly striving to bring cutting-edge lighting technologies to an ever-evolving product portfolio.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://rclighting.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-4edfa34 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="4edfa34" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="rcl" class="attachment-medium size-medium wp-image-13047" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/RCL_logo_re-1.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-590641e elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="590641e" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-d0a3b53 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="d0a3b53">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-de321a6 animated-slow " data-e-type="column" data-element_type="column" data-id="de321a6" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-bc32642 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="bc32642" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  China
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   REVOLUX is one of our in-house brands which produced from qualified manufactures from Asia countries such as China, Malaysia, Vietnam…etc
With REVOLUX solution we are very flexible in complying with our customer’s requirements from specifications to project’s budget but still ensure about quality of project.
REVOLUX brings to our clients and partners the best of its expertise and experience, through reliable and customer-centric solutions.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="{{ url('/') }}" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-160b97d dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="160b97d" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="REVOLUX" decoding="async" loading="lazy" src="/wp-content/uploads/elementor/thumbs/REVOLUX-1-r4uzmk86yh41iulmp6a569ygab8rspl3cuvh1uht6o.png" title="REVOLUX"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-2066852 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="2066852" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-c5d4c68 animated-slow " data-e-type="column" data-element_type="column" data-id="c5d4c68" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-9414197 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="9414197" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Germany
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Over the last 40 years, the SLV Lighting Group has perfected professional lighting solutions, selling in over 100 countries, with the support of 15 subsidiaries. Light is, and always has been the passion. A passion that is applied across the entire supply-chain: from in-house innovation, to quality assurance at the highest standard and an affordable price at the end.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.slv.com/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-480aa4a dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="480aa4a" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="slv" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/SLV_logo_re-1.jpg" title="SLV_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-18faa5c elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="18faa5c" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-8b8a268 animated-slow " data-e-type="column" data-element_type="column" data-id="8b8a268" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-b31844a elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="b31844a" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  United States
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Our founder Shuji Nakamura, Nobel Prize winner and the father of modern day LED lighting, wanted to create a light source that would match the characteristics of our most natural illumination: the sun. It is why the company is called SORAA, which means “sky” in kanji.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.soraa.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-4b958a7 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="4b958a7" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="soraa" class="attachment-large size-large wp-image-13052" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/soraa_re-2.jpg" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-0d11f7a elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="0d11f7a" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-9c39655 animated-slow " data-e-type="column" data-element_type="column" data-id="9c39655" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-8c65e24 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="8c65e24" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   In 2019, Stilnovo was acquired by Linea Light Group, inheriting a collection of simple and contemporary light fixtures.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.stilnovo.com/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-45d55a4 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="45d55a4" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="stilnovo" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/stilnovo_png_re-1.png" title="stilnovo_png_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-3c34544 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="3c34544" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-a1ddbd0 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="a1ddbd0">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-e8921f5 animated-slow " data-e-type="column" data-element_type="column" data-id="e8921f5" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-06b7984 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="06b7984" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Italy
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Targetti has been designing and producing indoor and outdoor architectural light fixtures since 1928. For ninety years our products have been the epitome of innovation, research and attention to detail.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.targetti.com/en" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-1a40f90 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="1a40f90" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="targetti" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/TARGETT-LOGO_re-1.jpg" title="TARGETT-LOGO_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-bd2c0c4 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="bd2c0c4" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-e4b71b8 animated-slow " data-e-type="column" data-element_type="column" data-id="e4b71b8" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-17e353e elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="17e353e" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Japan
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   TOKISTAR focuses on providing energy-efficient LED Systems. Their installations span the globe in hotels , malls , restaurants , casinos , amusement parks and many other locations.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://toki.co.jp/tokistar/en/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-8959bee dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="8959bee" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="Tokistar Lighting" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/Tokistar_logo_opt2_re-1.jpg" title="Tokistar_logo_opt2_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-6126aab elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="6126aab" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-7dd7692 animated-slow " data-e-type="column" data-element_type="column" data-id="7dd7692" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-687af16 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="687af16" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Germany
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Traxon Technologies, an OSRAM business, together with its control brand, e:cue, is a global leader in solid state lighting and control systems providing complete, sustainable and intelligent lighting solutions.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="http://www.traxontechnologies.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-57cfe3b dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="57cfe3b" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="Traxon Logo-LuxLight Website 3" decoding="async" loading="lazy" src="/wp-content/uploads/2024/02/Traxon-Logo-LuxLight-Website-3.jpg" title="Traxon Logo-LuxLight Website 3"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-0d85289 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="0d85289" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-d55495e animated-slow " data-e-type="column" data-element_type="column" data-id="d55495e" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-a7726ad elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="a7726ad" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Australia
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Unios believes in light as an extension of every surface, every structure – enriching everyday experiences through light. By blending precise design and engineering, we bring light to life in all its diversity. As agile makers of light, we shape and build luminaires that blend aesthetics and technology. Our luminaires help define and accentuate the environments we live and work in; now and in the future.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://unios.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-00bb220 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="00bb220" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="unios" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/unios_logo_re-1.jpg" title="unios_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-68db5df elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="68db5df" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-27b9c09 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="27b9c09">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-a745375 animated-slow " data-e-type="column" data-element_type="column" data-id="a745375" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-3535b3a elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="3535b3a" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Spain
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Vibia is a global architectural lighting company based in Barcelona. From local knowledge they have built up a global business. They are present in 80 countries and have a subsidiary in New Jersey (USA). The Vibia community keeps growing. Today over a 100,000 professionals work on their lighting projects on vibia.com.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.vibia.com/en/int/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-31dd34c dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="31dd34c" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="vibia" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/vibia_logo_320x103_re-1.jpg" title="vibia_logo_320x103_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-858c6a4 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="858c6a4" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-eda9e4d animated-slow " data-e-type="column" data-element_type="column" data-id="eda9e4d" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-65cd96c elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="65cd96c" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  China
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Visual Feast was founded in 2009 and is committed to the design, development, and manufacture of high-quality luminaires. The company’s creative designers have developed state-of-the-art collections incorporating new technology and materials, backed by an R&amp;D team that draws on the expertise of invited consultants from Japan and Europe.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.vflighting.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-e3b961a dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="e3b961a" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="visual feast" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/visual-feast_re-1.jpg" title="visual feast_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-e810704 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="e810704" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-f37f46b animated-slow " data-e-type="column" data-element_type="column" data-id="f37f46b" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-12d8181 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="12d8181" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Japan
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Wako Industries Co. Ltd provides LED lighting solution for Architectural and Interior Design application. They emphasis on color consistency, high Color Rendering Index (CRI), and accurate color temperature on our LED products. They also provide customized lighting fixture design for lighting designer to achieve innovatiove and creative application for their needs and realize their vision.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" role="button" tabindex="0">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-ff3f2a3 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="ff3f2a3" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="wako" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/wako_logo_re-1.jpg" title="wako_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-e85a3e0 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="e85a3e0" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-a46fc96 animated-slow " data-e-type="column" data-element_type="column" data-id="a46fc96" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-f67a991 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="f67a991" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Germany
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   WE-EF is a global manufacturer of high-performance exterior lighting solutions. Since 1950 they have developed innovative luminaires of outstanding optical quality and sound mechanical engineering. From street and area luminaires to projectors and inground up lights, WE-EF offers a complete spectrum of lighting solutions for demanding outdoor environments.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.we-ef.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-eaccabe dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="eaccabe" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="WE-EF Logo - LuxLight Website 3" decoding="async" loading="lazy" src="/wp-content/uploads/2024/02/WE-EF-Logo-LuxLight-Website-3.jpg" title="WE-EF Logo – LuxLight Website 3"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-5704a75 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="5704a75" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-4195cb0 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="4195cb0">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-2d1d627 animated-slow " data-e-type="column" data-element_type="column" data-id="2d1d627" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-c789fde elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="c789fde" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Germany
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   WIBRE Elektrogeräte Edmund Breuninger GmbH &amp; Co.KG is a company based in Leingarten, Baden-Württemberg, Germany. WIBRE is a leading manufacturer of underwater spotlights and exterior spotlights with IP68 protection system.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.wibre.de/en/start.html" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-ac0db06 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="ac0db06" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="wibre" class="attachment-large size-large wp-image-13065" decoding="async" height="37" loading="lazy" src="/wp-content/uploads/2022/01/wibre_png_re-1.png" style="width:100%;height:23.13%;max-width:160px" width="160"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-3cbe327 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="3cbe327" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-1eaa911 animated-slow " data-e-type="column" data-element_type="column" data-id="1eaa911" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-865da51 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="865da51" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  UK
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   WILA Lighting Ltd is part of Experience Brands and is based in Oxfordshire, UK. WILA specialises in personalised lighting solutions and believe that no two projects are the same.

WILA prides itself on its ability to respond to project specific requirements with personalised lighting solutions, delivering exceptional customer service and manufacturing flexibility.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.wila.co.uk/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-0999176 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="0999176" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="WILA Logo 2" decoding="async" loading="lazy" src="/wp-content/uploads/2024/02/WILA-Logo-2.jpg" title="WILA Logo 2"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-6855b31 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="6855b31" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-5fe5fbe animated-slow " data-e-type="column" data-element_type="column" data-id="5fe5fbe" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-a4ed985 elementor-flip-box--effect-fade image-1 elementor-widget elementor-widget-flip-box" data-e-type="widget" data-element_type="widget" data-id="a4ed985" data-widget_type="flip-box.default">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <h3 class="elementor-flip-box__layer__title">
                  Sweden
                 </h3>
                </div>
               </div>
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 <div class="elementor-flip-box__layer__description">
                  <p style="margin-bottom:1em">
                   Zero Interiör was founded in 1978 with the vision of making unique light fixtures for a design-interested audience. These products, in combination with a deep understanding of how best to illuminate public indoor and outdoor environments, is at the heart of our identity.  Their local roots and manufacturing have built long-term relationships with customers and suppliers that are vital to them. More than 80% of manufacturing takes place within roughly 200 km of Nybro in Småland and all assembly occurs in the workshop in Nybro.
                  </p>
                 </div>
                 <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="https://www.zerolighting.com/" target="_blank">
                  Visit Website
                 </a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element elementor-element-31aefe5 dce_masking-none elementor-widget elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="31aefe5" data-widget_type="image.default">
            <div class="elementor-widget-container">
             <img alt="zero" decoding="async" loading="lazy" src="/wp-content/uploads/2022/01/zero_logo_re-1.jpg" title="zero_logo_re"/>
            </div>
           </div>
           <div class="elementor-element elementor-element-36a2c2b elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="36a2c2b" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-2d4a73b animated-slow " data-e-type="column" data-element_type="column" data-id="2d4a73b" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-11fc7cd elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="11fc7cd" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
       </section>
       <section class="elementor-section elementor-inner-section elementor-element elementor-element-1bf7962 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="1bf7962">
        <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-38a8c54 animated-slow " data-e-type="column" data-element_type="column" data-id="38a8c54" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-39357d6 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="39357d6" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
             </div>
            </div>
           </div>
          </div>
         </div>
         <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-b975ab8 animated-slow " data-e-type="column" data-element_type="column" data-id="b975ab8" data-settings='{"background_background":"classic","animation":"slideInUp"}'>
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-element-79e525d elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-e-type="widget" data-element_type="widget" data-id="79e525d" data-widget_type="divider.default">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator">
              </span>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.elementor-2192 .elementor-flip-box').forEach(function(box) {
        box.addEventListener('click', function(e) {
            // If click was directly on the "Visit Website" link, let the link open
            if (e.target.closest('.elementor-flip-box__button')) {
                return;
            }
            if (window.innerWidth <= 1024) {
                this.classList.toggle('is-flipped');
            }
        });
    });
});
</script>
@endpush
