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
    .elementor-2192 .brands-grid-row {
        display: flex !important;
        flex-wrap: wrap !important;
        margin: 0 -12px !important;
    }
    @media (min-width: 1025px) {
        .elementor-2192 .elementor-inner-column.elementor-col-25 {
            width: 25% !important;
            max-width: 25% !important;
            flex: 0 0 25% !important;
            padding: 0 12px !important;
            box-sizing: border-box !important;
            margin-bottom: 25px !important;
        }
    }
    @media (max-width: 1024px) and (min-width: 768px) {
        .elementor-2192 .elementor-inner-column.elementor-col-25 {
            width: 50% !important;
            max-width: 50% !important;
            flex: 0 0 50% !important;
            padding: 0 12px !important;
            margin-bottom: 25px !important;
            box-sizing: border-box !important;
        }
    }
    @media (max-width: 767px) {
        .elementor-2192 .elementor-inner-column.elementor-col-25 {
            width: 100% !important;
            max-width: 100% !important;
            flex: 0 0 100% !important;
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
    <div class="elementor-container elementor-column-gap-default" style="max-width: 1240px; margin: 0 auto; padding: 0 15px;">
     <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-692a9e0" data-e-type="column" data-element_type="column" data-id="692a9e0">
      <div class="elementor-widget-wrap elementor-element-populated">
       <div class="elementor-element elementor-element-28088c7  elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="28088c7" data-settings='{"_animation":"slideInUp"}' data-widget_type="heading.default">
        <div class="elementor-widget-container">
         <h2 class="elementor-heading-title elementor-size-default">
          Our Brands
         </h2>
        </div>
       </div>
       
       <div class="brands-grid-row">
        @forelse($brands as $brand)
         <div class="elementor-column elementor-col-25 elementor-inner-column brand-grid-item">
          <div class="elementor-widget-wrap elementor-element-populated">
           <div class="elementor-element elementor-flip-box--effect-fade elementor-widget elementor-widget-flip-box">
            <div class="elementor-widget-container">
             <div class="elementor-flip-box" tabindex="0">
              <div class="elementor-flip-box__layer elementor-flip-box__front" style="background-image: url('{{ $brand->showcase_image ?: ($brand->image_url ?: '/wp-content/uploads/2021/12/Banner_3_1242x621.jpg') }}');">
               @if($brand->country)
                <div class="elementor-flip-box__layer__overlay">
                 <div class="elementor-flip-box__layer__inner">
                  <h3 class="elementor-flip-box__layer__title">
                   {{ $brand->country }}
                  </h3>
                 </div>
                </div>
               @endif
              </div>
              <div class="elementor-flip-box__layer elementor-flip-box__back">
               <div class="elementor-flip-box__layer__overlay">
                <div class="elementor-flip-box__layer__inner">
                 @php
                     $brandDesc = $brand->getTranslation('description', app()->getLocale()) ?: $brand->description;
                 @endphp
                 @if($brandDesc)
                  <div class="elementor-flip-box__layer__description">
                   <p style="margin-bottom:1em">
                    {!! nl2br(e(strip_tags($brandDesc))) !!}
                   </p>
                  </div>
                 @endif
                 @if($brand->website_url)
                  <a class="elementor-flip-box__button elementor-button elementor-size-sm" href="{{ $brand->website_url }}" target="_blank" rel="noopener noreferrer">
                   {{ __('Visit Website') }}
                  </a>
                 @endif
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="elementor-element dce_masking-none elementor-widget elementor-widget-image">
            <div class="elementor-widget-container">
             @if($brand->image_url)
              <img alt="{{ $brand->name }}" class="attachment-full size-full" decoding="async" height="37" src="{{ $brand->image_url }}" style="width:auto;height:37px;max-width:160px;object-fit:contain;object-position:left center;mix-blend-mode:multiply;" />
             @else
              <span style="font-family: 'Din', sans-serif; font-size: 15px; font-weight: 600; color: #0B1523; line-height: 37px; display: inline-block;">{{ $brand->name }}</span>
             @endif
            </div>
           </div>
           <div class="elementor-element elementor-widget-divider--view-line elementor-widget elementor-widget-divider">
            <div class="elementor-widget-container">
             <div class="elementor-divider">
              <span class="elementor-divider-separator"></span>
             </div>
            </div>
           </div>
          </div>
         </div>
        @empty
         <div class="col-12 text-center py-5" style="width: 100%; text-align: center; padding: 60px 0;">
          <p style="font-family: 'Din', sans-serif; color: #666; font-size: 16px;">{{ __('No brands found.') }}</p>
         </div>
        @endforelse
       </div>

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
