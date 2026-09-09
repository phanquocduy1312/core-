<?php

/*
|--------------------------------------------------------------------------
| Theme (frontend) asset manifest
|--------------------------------------------------------------------------
|
| Single source of truth for the stylesheets that make up the public site's
| look. It is consumed by two places, which must stay identical:
|
|   1. resources/views/layouts/app.blade.php  -> the public site <head>
|   2. Admin\PageController::builder()        -> the GrapesJS canvas iframe
|
| Add or remove a stylesheet here and both the site and the visual builder
| pick it up. Never hardcode a frontend stylesheet in the builder JS again.
|
*/

return [

    // Classes carried by the public <body>. The builder applies the same set
    // to the canvas wrapper so body-scoped theme rules resolve identically.
    'body_class' => 'page-template page-template-elementor_header_footer elementor-default elementor-template-full-width elementor-kit-7 elementor-page',

    // Class on the element the page body lives in on the public site
    // (<main class="site-main"> in layouts/app.blade.php). The theme spaces
    // top-level sections with `.site-main > * { margin-top }`, so the builder
    // canvas has to carry it or its vertical rhythm comes out tighter.
    'content_class' => 'site-main',

    // Extracted inline <style> blocks (WP globals, @font-face, custom CSS).
    'inline_css' => 'theme/site-inline.css',

    'stylesheets' => [
        ['href' => '/wp-content/plugins/dynamic-content-for-elementor/assets/css/animations.css', 'id' => 'dce-animations-css', 'media' => 'all'],
        ['href' => '/wp-includes/css/dist/theme/design-tokens.min.css', 'id' => 'wp-theme-css', 'media' => 'all'],
        ['href' => '/wp-includes/css/dist/components/style.min.css', 'id' => 'wp-components-css', 'media' => 'all'],
        ['href' => '/wp-includes/css/dist/preferences/style.min.css', 'id' => 'wp-preferences-css', 'media' => 'all'],
        ['href' => '/wp-includes/css/dist/block-editor/style.min.css', 'id' => 'wp-block-editor-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/popup-maker/dist/packages/block-library-style.css', 'id' => 'popup-maker-block-library-style-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/custom-lux/assets/custom.css', 'id' => 'custom-carousel-css-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/wp-slick-slider-and-image-carousel/assets/css/slick.css', 'id' => 'wpos-slick-style-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/wp-slick-slider-and-image-carousel/assets/css/wpsisac-public.css', 'id' => 'wpsisac-public-style-css', 'media' => 'all'],
        ['href' => '/wp-content/themes/twentytwentyone/style.css', 'id' => 'twenty-twenty-one-style-css', 'media' => 'all'],
        ['href' => '/wp-content/themes/twentytwentyone/assets/css/print.css', 'id' => 'twenty-twenty-one-print-style-css', 'media' => 'print'],
        ['href' => '/wp-content/plugins/elementor/assets/css/frontend.min.css', 'id' => 'elementor-frontend-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/css/widget-image.min.css', 'id' => 'widget-image-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor-pro/assets/css/widget-nav-menu.min.css', 'id' => 'widget-nav-menu-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor-pro/assets/css/widget-search-form.min.css', 'id' => 'widget-search-form-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css', 'id' => 'elementor-icons-shared-0-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css', 'id' => 'elementor-icons-fa-solid-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor-pro/assets/css/modules/sticky.min.css', 'id' => 'e-sticky-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor-pro/assets/css/modules/motion-fx.min.css', 'id' => 'e-motion-fx-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/css/widget-heading.min.css', 'id' => 'widget-heading-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css', 'id' => 'widget-icon-list-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/css/widget-social-icons.min.css', 'id' => 'widget-social-icons-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/css/conditionals/apple-webkit.min.css', 'id' => 'e-apple-webkit-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css', 'id' => 'elementor-icons-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-7.css', 'id' => 'elementor-post-7-css', 'media' => 'all'],
        ['href' => '/wp-includes/css/dashicons.min.css', 'id' => 'dashicons-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/post-carousel-addons-for-elementor/assets/slick/slick.css', 'id' => 'eshuzu_slick_style-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/post-carousel-addons-for-elementor/assets/css/post-carousel-addons-for-elementor.css', 'id' => 'eshuzu-widget-stylesheet-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/css/widget-image-box.min.css', 'id' => 'widget-image-box-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/lib/animations/styles/fadeInUp.min.css', 'id' => 'e-animation-fadeInUp-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/lib/animations/styles/slideInUp.min.css', 'id' => 'e-animation-slideInUp-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min.css', 'id' => 'swiper-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/css/conditionals/e-swiper.min.css', 'id' => 'e-swiper-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor-pro/assets/css/widget-slides.min.css', 'id' => 'widget-slides-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor-pro/assets/css/widget-testimonial-carousel.min.css', 'id' => 'widget-testimonial-carousel-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor-pro/assets/css/widget-carousel-module-base.min.css', 'id' => 'widget-carousel-module-base-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor-pro/assets/css/widget-flip-box.min.css', 'id' => 'widget-flip-box-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/css/widget-divider.min.css', 'id' => 'widget-divider-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-15.css', 'id' => 'elementor-post-15-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-101.css', 'id' => 'elementor-post-101-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-7892.css', 'id' => 'elementor-post-7892-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-5335.css', 'id' => 'elementor-post-5335-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/premium-addons-elementor/pafe-5335.css', 'id' => 'pafe-5335-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-10034.css', 'id' => 'elementor-post-10034-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-10020.css', 'id' => 'elementor-post-10020-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-10052.css', 'id' => 'elementor-post-10052-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-4817.css', 'id' => 'elementor-post-4817-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/css/post-4963.css', 'id' => 'elementor-post-4963-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/pum/pum-site-styles.css', 'id' => 'popup-maker-site-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/gravityforms/assets/css/dist/basic.min.css', 'id' => 'gform_basic-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/gravityforms/assets/css/dist/theme-components.min.css', 'id' => 'gform_theme_components-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/gravityforms/assets/css/dist/theme.min.css', 'id' => 'gform_theme-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/ajax-load-more-anything/assets/styles.min.css', 'id' => 'ald-styles-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/google-fonts/css/montserrat.css', 'id' => 'elementor-gf-local-montserrat-css', 'media' => 'all'],
        ['href' => '/wp-content/uploads/elementor/google-fonts/css/roboto.css', 'id' => 'elementor-gf-local-roboto-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/lib/font-awesome/css/regular.min.css', 'id' => 'elementor-icons-fa-regular-css', 'media' => 'all'],
        ['href' => '/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css', 'id' => 'elementor-icons-fa-brands-css', 'media' => 'all'],
    ],

];
