@php
    $siteHeaderHtml = app(\App\Services\PagePartialResolver::class)->resolveSiteDefault('header_id', app()->getLocale());
@endphp
@if(!empty(trim($siteHeaderHtml)))
    {!! $siteHeaderHtml !!}
@else
<header class="elementor elementor-15 elementor-location-header" data-elementor-id="15" data-elementor-post-type="elementor_library" data-elementor-type="header" style="background-color:#0B1523!important;border:none!important;outline:none!important;box-shadow:none!important;">
<section class="elementor-section elementor-top-section elementor-element elementor-element-4815be32 elementor-section-full_width elementor-hidden-tablet elementor-hidden-mobile elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-dce-background-color="#0B1523" data-e-type="section" data-element_type="section" data-id="4815be32" style="background-color:#0B1523!important;border:none!important;outline:none!important;box-shadow:none!important;">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-3acfc7ba" data-e-type="column" data-element_type="column" data-id="3acfc7ba">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-eb8718d elementor-widget elementor-widget-theme-site-logo elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="eb8718d" data-widget_type="theme-site-logo.default">
<div class="elementor-widget-container">
<a href="{{ url('/') }}">
<img alt="" class="attachment-full size-full wp-image-13189" height="73" src="/wp-content/uploads/2022/02/Logo_300x73.png" style="width:100%;height:24.33%;max-width:300px" width="300"/>
</a>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-4183c01e site-tools" data-e-type="column" data-element_type="column" data-id="4183c01e">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-15209807 elementor-nav-menu__align-end elementor-nav-menu--dropdown-none elementor-hidden-tablet elementor-hidden-mobile elementor-widget elementor-widget-nav-menu" data-e-type="widget" data-element_type="widget" data-id="15209807" data-settings='{"submenu_icon":{"value":"","library":""},"layout":"horizontal"}' data-widget_type="nav-menu.default">
<div class="elementor-widget-container">
<nav aria-label="Menu" class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal">
<ul class="elementor-nav-menu" id="menu-1-15209807">
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8998">
<a class="elementor-item" href="{{ route('about') }}">
             About Us
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8996">
<a class="elementor-item" href="{{ route('brands') }}">
             Brands
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12519">
<a class="elementor-item" href="{{ route('projects') }}">
             Projects
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8997">
<a class="elementor-item" href="{{ route('contact') }}">
             Contact
            </a>
</li>
</ul>
</nav>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-726f2318 customcolmn" data-e-type="column" data-element_type="column" data-id="726f2318" id="customcolmn">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-3970beb elementor-search-form--skin-minimal searchbar elementor-widget elementor-widget-search-form" data-e-type="widget" data-element_type="widget" data-id="3970beb" data-settings='{"skin":"minimal"}' data-widget_type="search-form.default" id="searchbar">
<div class="elementor-widget-container">
<search role="search">
<form action="https://www.luxlight.sg" class="elementor-search-form" method="get">
<div class="elementor-search-form__container">
<label class="elementor-screen-only" for="elementor-search-form-3970beb">
             Search
            </label>
<div class="elementor-search-form__icon">
<i aria-hidden="true" class="fas fa-search">
</i>
<span class="elementor-screen-only">
              Search
             </span>
</div>
<input class="elementor-search-form__input" id="elementor-search-form-3970beb" name="s" placeholder="" type="search" value=""/>
</div>
</form>
</search>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-854a8ca" data-e-type="column" data-element_type="column" data-id="854a8ca">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-8cc2690 popmake-11677 elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="8cc2690" data-widget_type="button.default">
<div class="elementor-widget-container">
<div class="elementor-button-wrapper">
<a class="elementor-button elementor-button-link elementor-size-sm" href="#">
<span class="elementor-button-content-wrapper">
<span class="elementor-button-text">
             Subscribe
            </span>
</span>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="elementor-section elementor-top-section elementor-element elementor-element-6485131 elementor-section-full_width elementor-hidden-desktop elementor-section-height-default elementor-section-height-default" data-dce-background-color="#0B1523" data-e-type="section" data-element_type="section" data-id="6485131" style="background-color:#0B1523!important;border:none!important;outline:none!important;box-shadow:none!important;">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-bd69823" data-e-type="column" data-element_type="column" data-id="bd69823">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-dbd2dc8 elementor-widget elementor-widget-theme-site-logo elementor-widget-image" data-e-type="widget" data-element_type="widget" data-id="dbd2dc8" data-widget_type="theme-site-logo.default">
<div class="elementor-widget-container">
<a href="{{ url('/') }}">
<img alt="" class="attachment-full size-full wp-image-13189" height="73" src="/wp-content/uploads/2022/02/Logo_300x73.png" style="width:100%;height:24.33%;max-width:300px" width="300"/>
</a>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-89c1be5" data-e-type="column" data-element_type="column" data-id="89c1be5">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-c5e832d elementor-nav-menu--stretch elementor-nav-menu__align-end elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu" data-e-type="widget" data-element_type="widget" data-id="c5e832d" data-settings='{"full_width":"stretch","layout":"horizontal","submenu_icon":{"value":"&lt;i class=\"fas fa-caret-down\" aria-hidden=\"true\"&gt;&lt;\/i&gt;","library":"fa-solid"},"toggle":"burger"}' data-widget_type="nav-menu.default">
<div class="elementor-widget-container">
<nav aria-label="Menu" class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal">
<ul class="elementor-nav-menu" id="menu-1-c5e832d">
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8998">
<a class="elementor-item" href="{{ route('about') }}">
             About Us
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8996">
<a class="elementor-item" href="{{ route('brands') }}">
             Brands
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12519">
<a class="elementor-item" href="{{ route('projects') }}">
             Projects
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8997">
<a class="elementor-item" href="{{ route('contact') }}">
             Contact
            </a>
</li>
</ul>
</nav>
<div aria-expanded="false" aria-label="Menu Toggle" class="elementor-menu-toggle" role="button" tabindex="0">
<i aria-hidden="true" class="elementor-menu-toggle__icon--open eicon-menu-bar" role="presentation">
</i>
<i aria-hidden="true" class="elementor-menu-toggle__icon--close eicon-close" role="presentation">
</i>
</div>
<nav aria-hidden="true" class="elementor-nav-menu--dropdown elementor-nav-menu__container">
<ul class="elementor-nav-menu" id="menu-2-c5e832d">
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8998">
<a class="elementor-item" href="{{ route('about') }}" tabindex="-1">
             About Us
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8996">
<a class="elementor-item" href="{{ route('brands') }}" tabindex="-1">
             Brands
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12519">
<a class="elementor-item" href="{{ route('projects') }}" tabindex="-1">
             Projects
            </a>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8997">
<a class="elementor-item" href="{{ route('contact') }}" tabindex="-1">
             Contact
            </a>
</li>
</ul>
</nav>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-3f3b718 elementor-hidden-mobile elementor-hidden-tablet" data-e-type="column" data-element_type="column" data-id="3f3b718">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-bb4917e elementor-search-form--skin-full_screen elementor-widget elementor-widget-search-form" data-e-type="widget" data-element_type="widget" data-id="bb4917e" data-settings='{"skin":"full_screen"}' data-widget_type="search-form.default">
<div class="elementor-widget-container">
<search role="search">
<form action="https://www.luxlight.sg" class="elementor-search-form" method="get">
<div aria-label="Search" class="elementor-search-form__toggle" role="button" tabindex="0">
<i aria-hidden="true" class="fas fa-search">
</i>
</div>
<div class="elementor-search-form__container">
<label class="elementor-screen-only" for="elementor-search-form-bb4917e">
             Search
            </label>
<input class="elementor-search-form__input" id="elementor-search-form-bb4917e" name="s" placeholder="" type="search" value=""/>
<div aria-label="Close this search box." class="dialog-lightbox-close-button dialog-close-button" role="button" tabindex="0">
<i aria-hidden="true" class="eicon-close">
</i>
</div>
</div>
</form>
</search>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-f677a8e elementor-hidden-mobile elementor-hidden-tablet" data-e-type="column" data-element_type="column" data-id="f677a8e">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-80f2859 elementor-mobile-align-left elementor-widget elementor-widget-button" data-e-type="widget" data-element_type="widget" data-id="80f2859" data-widget_type="button.default">
<div class="elementor-widget-container">
<div class="elementor-button-wrapper">
<a class="elementor-button elementor-button-link elementor-size-sm" href="#">
<span class="elementor-button-content-wrapper">
<span class="elementor-button-text">
             Subscribe
            </span>
</span>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</header>
@endif