<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>@yield('title', 'LuxLight | Multinational Lighting Project Supplier')</title>
    <meta name="description" content="@yield('meta_description', 'Based in Singapore, LuxLight offers out-of-the shelf lighting solutions and professional distribution of architectural and decorative lighting.')">

    <link rel="icon" href="{{ asset('wp-content/uploads/2021/12/Luxlight-e1640658214702.png') }}" sizes="32x32">

    {{-- ------------------------------------------------------------------
         Frontend stylesheets — single source of truth: config/theme.php
         The GrapesJS builder canvas loads this exact same list, so what you
         see in the builder is what renders on the public site.
         ------------------------------------------------------------------ --}}
    @include('partials.theme-styles')

    @yield('styles')
    @stack('styles')

</head>
<body class="page-template page-template-elementor_header_footer elementor-default elementor-template-full-width elementor-kit-7 elementor-page">

    @if(isset($headerHtml))
        {!! $headerHtml !!}
    @else
        @include('partials.header')
    @endif

    <main id="primary" class="{{ \App\Support\ThemeAssets::contentClass() }}">
        @yield('content')
    </main>

    @if(isset($footerHtml))
        {!! $footerHtml !!}
    @else
        @include('partials.footer')
    @endif

    @include('client.partials.admin-bar')

    <!-- Scripts -->
    <script>
   var gform;gform||(document.addEventListener("gform_main_scripts_loaded",function(){gform.scriptsLoaded=!0}),document.addEventListener("gform/theme/scripts_loaded",function(){gform.themeScriptsLoaded=!0}),window.addEventListener("DOMContentLoaded",function(){gform.domLoaded=!0}),gform={domLoaded:!1,scriptsLoaded:!1,themeScriptsLoaded:!1,isFormEditor:()=>"function"==typeof InitializeEditor,callIfLoaded:function(o){return!(!gform.domLoaded||!gform.scriptsLoaded||!gform.themeScriptsLoaded&&!gform.isFormEditor()||(gform.isFormEditor()&&console.warn("The use of gform.initializeOnLoaded() is deprecated in the form editor context and will be removed in Gravity Forms 3.1."),o(),0))},initializeOnLoaded:function(o){gform.callIfLoaded(o)||(document.addEventListener("gform_main_scripts_loaded",()=>{gform.scriptsLoaded=!0,gform.callIfLoaded(o)}),document.addEventListener("gform/theme/scripts_loaded",()=>{gform.themeScriptsLoaded=!0,gform.callIfLoaded(o)}),window.addEventListener("DOMContentLoaded",()=>{gform.domLoaded=!0,gform.callIfLoaded(o)}))},hooks:{action:{},filter:{}},addAction:function(o,r,e,t){gform.addHook("action",o,r,e,t)},addFilter:function(o,r,e,t){gform.addHook("filter",o,r,e,t)},doAction:function(o){gform.doHook("action",o,arguments)},applyFilters:function(o){return gform.doHook("filter",o,arguments)},removeAction:function(o,r){gform.removeHook("action",o,r)},removeFilter:function(o,r,e){gform.removeHook("filter",o,r,e)},addHook:function(o,r,e,t,n){null==gform.hooks[o][r]&&(gform.hooks[o][r]=[]);var d=gform.hooks[o][r];null==n&&(n=r+"_"+d.length),gform.hooks[o][r].push({tag:n,callable:e,priority:t=null==t?10:t})},doHook:function(r,o,e){var t;if(e=Array.prototype.slice.call(e,1),null!=gform.hooks[r][o]&&((o=gform.hooks[r][o]).sort(function(o,r){return o.priority-r.priority}),o.forEach(function(o){"function"!=typeof(t=o.callable)&&(t=window[t]),"action"==r?t.apply(null,e):e[0]=t.apply(null,e)})),"filter"==r)return e[0]},removeHook:function(o,r,t,n){var e;null!=gform.hooks[o][r]&&(e=(e=gform.hooks[o][r]).filter(function(o,r,e){return!!(null!=n&&n!=o.tag||null!=t&&t!=o.priority)}),gform.hooks[o][r]=e)}});
  </script>
    <script src="/wp-includes/js/jquery/jquery.min.js"></script>
    <script src="/wp-includes/js/jquery/jquery-migrate.min.js"></script>
    <script>
   var monsterinsights_frontend = {"js_events_tracking":"true","download_extensions":"doc,pdf,ppt,zip,xls,docx,pptx,xlsx","inbound_paths":"[{\"path\":\"\\\/go\\\/\",\"label\":\"affiliate\"},{\"path\":\"\\\/recommend\\\/\",\"label\":\"affiliate\"}]","home_url":"https:\/\/www.luxlight.sg","hash_tracking":"false","v4_id":"G-SJX6TLL2TQ"};
  </script>
    <script src="/wp-content/themes/twentytwentyone/assets/js/primary-navigation.js"></script>
    <script src="/wp-content/plugins/gravityforms/js/jquery.json.min.js"></script>
    <script>
   var gf_global = {"gf_currency_config":{"name":"U.S. Dollar","symbol_left":"$","symbol_right":"","symbol_padding":"","thousand_separator":",","decimal_separator":".","decimals":2,"code":"USD"},"base_url":"/wp-content/plugins/gravityforms","number_formats":[],"spinnerUrl":"/wp-content/plugins/gravityforms/images/spinner.svg","version_hash":"f16d52d4e6b699366abcb6fd74371681","strings":{"newRowAdded":"New row added.","rowRemoved":"Row removed","formSaved":"The form has been saved.  The content contains the link to return and complete the form."}};
var gf_global = {"gf_currency_config":{"name":"U.S. Dollar","symbol_left":"$","symbol_right":"","symbol_padding":"","thousand_separator":",","decimal_separator":".","decimals":2,"code":"USD"},"base_url":"/wp-content/plugins/gravityforms","number_formats":[],"spinnerUrl":"/wp-content/plugins/gravityforms/images/spinner.svg","version_hash":"f16d52d4e6b699366abcb6fd74371681","strings":{"newRowAdded":"New row added.","rowRemoved":"Row removed","formSaved":"The form has been saved.  The content contains the link to return and complete the form."}};
var gform_i18n = {"datepicker":{"days":{"monday":"Mo","tuesday":"Tu","wednesday":"We","thursday":"Th","friday":"Fr","saturday":"Sa","sunday":"Su"},"months":{"january":"January","february":"February","march":"March","april":"April","may":"May","june":"June","july":"July","august":"August","september":"September","october":"October","november":"November","december":"December"},"firstDay":1,"iconText":"Select date"}};
var gf_legacy_multi = {"3":""};
var gform_gravityforms = {"strings":{"invalid_file_extension":"This type of file is not allowed. Must be one of the following:","file_uploaded":"File uploaded","delete_file":"Delete this file","in_progress":"in progress","file_exceeds_limit":"File exceeds size limit","illegal_extension":"This type of file is not allowed.","max_reached":"Maximum number of files reached","unknown_error":"There was a problem while saving the file on the server","currently_uploading":"Please wait for the uploading to complete","cancel":"Cancel","cancel_upload":"Cancel this upload","cancelled":"Cancelled","error":"Error","message":"Message"},"vars":{"images_url":"/wp-content/plugins/gravityforms/images"}};
//# sourceURL=gform_gravityforms-js-extra
  </script>
    <script src="/wp-content/plugins/gravityforms/js/gravityforms.min.js"></script>
    <script src="/wp-content/plugins/gravityforms/assets/js/dist/utils.min.js"></script>

    <script>
               gform.initializeOnLoaded( function() {gformInitSpinner( 4, '/wp-content/plugins/gravityforms/images/spinner.svg', true );jQuery('#gform_ajax_frame_4').on('load',function(){var contents = jQuery(this).contents().find('*').html();var is_postback = contents.indexOf('GF_AJAX_POSTBACK') >= 0;if(!is_postback){return;}var form_content = jQuery(this).contents().find('#gform_wrapper_4');var is_confirmation = jQuery(this).contents().find('#gform_confirmation_wrapper_4').length > 0;var is_redirect = contents.indexOf('gformRedirect(){') >= 0;var is_form = form_content.length > 0 && ! is_redirect && ! is_confirmation;var mt = parseInt(jQuery('html').css('margin-top'), 10) + parseInt(jQuery('body').css('margin-top'), 10) + 100;if(is_form){jQuery('#gform_wrapper_4').html(form_content.html());if(form_content.hasClass('gform_validation_error')){jQuery('#gform_wrapper_4').addClass('gform_validation_error');} else {jQuery('#gform_wrapper_4').removeClass('gform_validation_error');}setTimeout( function() { /* delay the scroll by 50 milliseconds to fix a bug in chrome */ jQuery(document).scrollTop(jQuery('#gform_wrapper_4').offset().top - mt); }, 50 );if(window['gformInitDatepicker']) {gformInitDatepicker();}if(window['gformInitPriceFields']) {gformInitPriceFields();}var current_page = jQuery('#gform_source_page_number_4').val();gformInitSpinner( 4, '/wp-content/plugins/gravityforms/images/spinner.svg', true );jQuery(document).trigger('gform_page_loaded', [4, current_page]);window['gf_submitting_4'] = false;}else if(!is_redirect){var confirmation_content = jQuery(this).contents().find('.GF_AJAX_POSTBACK').html();if(!confirmation_content){confirmation_content = contents;}jQuery('#gform_wrapper_4').replaceWith(confirmation_content);jQuery(document).scrollTop(jQuery('#gf_4').offset().top - mt);jQuery(document).trigger('gform_confirmation_loaded', [4]);window['gf_submitting_4'] = false;wp.a11y.speak(jQuery('#gform_confirmation_message_4').text());}else{jQuery('#gform_4').append(contents);if(window['gformRedirect']) {gformRedirect();}}jQuery(document).trigger("gform_pre_post_render", [{ formId: "4", currentPage: "current_page", abort: function() { this.preventDefault(); } }]);        if (event && event.defaultPrevented) {                return;        }        const gformWrapperDiv = document.getElementById( "gform_wrapper_4" );        if ( gformWrapperDiv ) {            const visibilitySpan = document.createElement( "span" );            visibilitySpan.id = "gform_visibility_test_4";            gformWrapperDiv.insertAdjacentElement( "afterend", visibilitySpan );        }        const visibilityTestDiv = document.getElementById( "gform_visibility_test_4" );        let postRenderFired = false;        function triggerPostRender() {            if ( postRenderFired ) {                return;            }            postRenderFired = true;            gform.core.triggerPostRenderEvents( 4, current_page );            if ( visibilityTestDiv ) {                visibilityTestDiv.parentNode.removeChild( visibilityTestDiv );            }        }        function debounce( func, wait, immediate ) {            var timeout;            return function() {                var context = this, args = arguments;                var later = function() {                    timeout = null;                    if ( !immediate ) func.apply( context, args );                };                var callNow = immediate && !timeout;                clearTimeout( timeout );                timeout = setTimeout( later, wait );                if ( callNow ) func.apply( context, args );            };        }        const debouncedTriggerPostRender = debounce( function() {            triggerPostRender();        }, 200 );        if ( visibilityTestDiv && visibilityTestDiv.offsetParent === null ) {            const observer = new MutationObserver( ( mutations ) => {                mutations.forEach( ( mutation ) => {                    if ( mutation.type === 'attributes' && visibilityTestDiv.offsetParent !== null ) {                        debouncedTriggerPostRender();                        observer.disconnect();                    }                });            });            observer.observe( document.body, {                attributes: true,                childList: false,                subtree: true,                attributeFilter: [ 'style', 'class' ],            });        } else {            triggerPostRender();        }    } );} );
              </script>
    <script>
          jQuery(document).ready(function(){
  jQuery("#customcolmn i.fas.fa-search").click(function(){
    jQuery("#customcolmn").toggleClass('active');
	jQuery("#customcolmn .elementor-search-form").toggleClass('activeTG');
		jQuery(".site-tools").toggleClass('activeTG');

  });
});
         </script>
    <script>
   {"prefetch":[{"source":"document","where":{"and":[{"href_matches":"/*"},{"not":{"href_matches":["/wp-*.php","/wp-admin/*","/wp-content/uploads/*","/wp-content/*","/wp-content/plugins/*","/wp-content/themes/twentytwentyone/*","/*\\?(.+)","/*ao_noptirocket*","/*jetpack=comms*","/*kinsta-monitor*","/*ao_speedup_cachebuster*","/*removed_item*","/my-account*","/wc-api/*","/edd-api/*","/wp-json*"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
  </script>
    <script>
   $(document).ready(function(){
 $('.elementor-search-form__input').hide();
  $(".elementor-search-form__submit").click(function(){
     $('.elementor-search-form__input').slideToggle('slow');
  });
});
  </script>
    <script>
      gform.initializeOnLoaded( function() {gformInitSpinner( 3, '/wp-content/plugins/gravityforms/images/spinner.svg', true );jQuery('#gform_ajax_frame_3').on('load',function(){var contents = jQuery(this).contents().find('*').html();var is_postback = contents.indexOf('GF_AJAX_POSTBACK') >= 0;if(!is_postback){return;}var form_content = jQuery(this).contents().find('#gform_wrapper_3');var is_confirmation = jQuery(this).contents().find('#gform_confirmation_wrapper_3').length > 0;var is_redirect = contents.indexOf('gformRedirect(){') >= 0;var is_form = form_content.length > 0 && ! is_redirect && ! is_confirmation;var mt = parseInt(jQuery('html').css('margin-top'), 10) + parseInt(jQuery('body').css('margin-top'), 10) + 100;if(is_form){jQuery('#gform_wrapper_3').html(form_content.html());if(form_content.hasClass('gform_validation_error')){jQuery('#gform_wrapper_3').addClass('gform_validation_error');} else {jQuery('#gform_wrapper_3').removeClass('gform_validation_error');}setTimeout( function() { /* delay the scroll by 50 milliseconds to fix a bug in chrome */ jQuery(document).scrollTop(jQuery('#gform_wrapper_3').offset().top - mt); }, 50 );if(window['gformInitDatepicker']) {gformInitDatepicker();}if(window['gformInitPriceFields']) {gformInitPriceFields();}var current_page = jQuery('#gform_source_page_number_3').val();gformInitSpinner( 3, '/wp-content/plugins/gravityforms/images/spinner.svg', true );jQuery(document).trigger('gform_page_loaded', [3, current_page]);window['gf_submitting_3'] = false;}else if(!is_redirect){var confirmation_content = jQuery(this).contents().find('.GF_AJAX_POSTBACK').html();if(!confirmation_content){confirmation_content = contents;}jQuery('#gform_wrapper_3').replaceWith(confirmation_content);jQuery(document).scrollTop(jQuery('#gf_3').offset().top - mt);jQuery(document).trigger('gform_confirmation_loaded', [3]);window['gf_submitting_3'] = false;wp.a11y.speak(jQuery('#gform_confirmation_message_3').text());}else{jQuery('#gform_3').append(contents);if(window['gformRedirect']) {gformRedirect();}}jQuery(document).trigger("gform_pre_post_render", [{ formId: "3", currentPage: "current_page", abort: function() { this.preventDefault(); } }]);        if (event && event.defaultPrevented) {                return;        }        const gformWrapperDiv = document.getElementById( "gform_wrapper_3" );        if ( gformWrapperDiv ) {            const visibilitySpan = document.createElement( "span" );            visibilitySpan.id = "gform_visibility_test_3";            gformWrapperDiv.insertAdjacentElement( "afterend", visibilitySpan );        }        const visibilityTestDiv = document.getElementById( "gform_visibility_test_3" );        let postRenderFired = false;        function triggerPostRender() {            if ( postRenderFired ) {                return;            }            postRenderFired = true;            gform.core.triggerPostRenderEvents( 3, current_page );            if ( visibilityTestDiv ) {                visibilityTestDiv.parentNode.removeChild( visibilityTestDiv );            }        }        function debounce( func, wait, immediate ) {            var timeout;            return function() {                var context = this, args = arguments;                var later = function() {                    timeout = null;                    if ( !immediate ) func.apply( context, args );                };                var callNow = immediate && !timeout;                clearTimeout( timeout );                timeout = setTimeout( later, wait );                if ( callNow ) func.apply( context, args );            };        }        const debouncedTriggerPostRender = debounce( function() {            triggerPostRender();        }, 200 );        if ( visibilityTestDiv && visibilityTestDiv.offsetParent === null ) {            const observer = new MutationObserver( ( mutations ) => {                mutations.forEach( ( mutation ) => {                    if ( mutation.type === 'attributes' && visibilityTestDiv.offsetParent !== null ) {                        debouncedTriggerPostRender();                        observer.disconnect();                    }                });            });            observer.observe( document.body, {                attributes: true,                childList: false,                subtree: true,                attributeFilter: [ 'style', 'class' ],            });        } else {            triggerPostRender();        }    } );} );
     </script>
    <script>
   document.body.classList.remove('no-js');
//# sourceURL=twenty_twenty_one_supports_js
  </script>
    <script>
   ( () => {
					const lazyloadRunObserver = () => {
						const lazyloadBackgrounds = document.querySelectorAll( `.e-con.e-parent:not(.e-lazyloaded)` );
						const lazyloadBackgroundObserver = new IntersectionObserver( ( entries ) => {
							entries.forEach( ( entry ) => {
								if ( entry.isIntersecting ) {
									let lazyloadBackground = entry.target;
									if( lazyloadBackground ) {
										lazyloadBackground.classList.add( 'e-lazyloaded' );
									}
									lazyloadBackgroundObserver.unobserve( entry.target );
								}
							});
						}, { rootMargin: '200px 0px 200px 0px' } );
						lazyloadBackgrounds.forEach( ( lazyloadBackground ) => {
							lazyloadBackgroundObserver.observe( lazyloadBackground );
						} );
					};
					const events = [
						'DOMContentLoaded',
						'elementor/lazyload/observe',
					];
					events.forEach( ( event ) => {
						document.addEventListener( event, lazyloadRunObserver );
					} );
				} )();
  </script>
    <script src="/wp-content/plugins/post-carousel-addons-for-elementor/assets/slick/slick.min.js"></script>
    <script src="/wp-content/plugins/post-carousel-addons-for-elementor/assets/js/app.js"></script>
    <script src="/wp-content/plugins/custom-lux/assets/TweenLite.min.js"></script>
    <script src="/wp-content/plugins/custom-lux/assets/imagesloaded.pkgd.min.js"></script>
    <script src="/wp-content/plugins/custom-lux/assets/CSSPlugin.min.js"></script>
    <script src="/wp-content/plugins/custom-lux/assets/gsap.min.js"></script>
    <script src="/wp-content/plugins/custom-lux/assets/carousel.js"></script>
    <script src="/wp-content/plugins/custom-lux/assets/ab_slider.js"></script>
    <script src="/wp-content/plugins/dynamicconditions/Public/js/dynamic-conditions-public.js"></script>
    <script src="/wp-content/themes/twentytwentyone/assets/js/responsive-embeds.js"></script>
    <script src="/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js"></script>
    <script src="/wp-content/plugins/elementor/assets/js/frontend-modules.min.js"></script>
    <script>
   jQuery.uiBackCompat = true;
//# sourceURL=jquery-ui-core-js-before
  </script>
    <script src="/wp-includes/js/jquery/ui/core.min.js"></script>
    <script>
   var PremiumSettings = {"ajaxurl":"/wp-admin/admin-ajax.php","nonce":"a007736995"};
//# sourceURL=elementor-frontend-js-extra
  </script>
    <script>
   var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnX":"Share on X","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close","a11yCarouselPrevSlideMessage":"Previous slide","a11yCarouselNextSlideMessage":"Next slide","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.3","is_static":false,"experimentalFeatures":{"additional_custom_breakpoints":true,"e_panel_promotions":true,"theme_builder_v2":true,"landing-pages":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true,"e_pro_atomic_form":true,"e_pro_collection_loop":true,"e_pro_variables":true,"e_pro_interactions":true},"urls":{"assets":"\/wp-content\/plugins\/elementor\/assets\/","ajaxurl":"\/wp-admin\/admin-ajax.php","uploadUrl":"\/wp-content\/uploads"},"nonces":{"floatingButtonsClickTracking":"d3d70f6fde","atomicFormsSendForm":"32e101316e"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[],"dynamicooo":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":184,"title":"LuxLight%20%7C%20Multinational%20Lighting%20Project%20Supplier","excerpt":"","featuredImage":"\/wp-content\/uploads\/2021\/12\/Luxlight-e1640658214702.png"}};
//# sourceURL=elementor-frontend-js-before
  </script>
    <script src="/wp-content/plugins/elementor/assets/js/frontend.min.js"></script>
    <script src="/wp-content/plugins/elementor-pro/assets/lib/smartmenus/jquery.smartmenus.min.js"></script>
    <script src="/wp-content/plugins/elementor-pro/assets/lib/sticky/jquery.sticky.min.js"></script>
    <script src="/wp-includes/js/imagesloaded.min.js"></script>
    <script src="/wp-content/plugins/elementor/assets/lib/swiper/v8/swiper.min.js"></script>
    <script src="/wp-includes/js/dist/dom-ready.min.js"></script>
    <script src="/wp-includes/js/dist/hooks.min.js"></script>
    <script src="/wp-includes/js/dist/i18n.min.js"></script>
    <script>
   wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
//# sourceURL=wp-i18n-js-after
  </script>
    <script src="/wp-includes/js/dist/a11y.min.js"></script>
    <script src="/wp-content/plugins/gravityforms/js/placeholders.jquery.min.js"></script>
    <script src="/wp-content/plugins/gravityforms/assets/js/dist/vendor-theme.min.js"></script>
    <script>
   var gform_theme_config = {"common":{"form":{"honeypot":{"version_hash":"f16d52d4e6b699366abcb6fd74371681"},"ajax":{"ajaxurl":"/wp-admin/admin-ajax.php","ajax_submission_nonce":"1fa8e8e521","i18n":{"step_announcement":"Step %1$s of %2$s, %3$s","unknown_error":"There was an unknown error processing your request. Please try again.","error_403":"The request was blocked (403 error) for unknown security reasons. Remove any code-like text (scripts or DB queries) and try again."}}}},"hmr_dev":"","public_path":"/wp-content/plugins/gravityforms/assets/js/dist/","config_nonce":"c0c17c25e5"};
//# sourceURL=gform_gravityforms_theme-js-extra
  </script>
    <script src="/wp-content/plugins/gravityforms/assets/js/dist/scripts-theme.min.js"></script>
    <script>
   var pum_vars = {"version":"1.24.0","pm_dir_url":"/wp-content/plugins/popup-maker/","ajaxurl":"/wp-admin/admin-ajax.php","restapi":"/wp-json/pum/v1","rest_nonce":null,"default_theme":"11668","debug_mode":"","disable_tracking":"","disable_url_params":"","home_url":"/","message_position":"top","core_sub_forms_enabled":"1","popups":[],"cookie_domain":"","paramNames":{"popup_id":"pid","cta":"cta","notrack":"notrack"},"analytics_enabled":"1","analytics_route":"analytics","analytics_api":"/wp-json/pum/v1"};
var pum_sub_vars = {"ajaxurl":"/wp-admin/admin-ajax.php","message_position":"top"};
var pum_popups = {"pum-11677":{"triggers":[],"cookies":[],"disable_on_mobile":false,"disable_on_tablet":false,"atc_promotion":null,"explain":null,"type_section":null,"theme_id":"11669","size":"medium","responsive_min_width":"0%","responsive_max_width":"100%","custom_width":"640px","custom_height_auto":false,"custom_height":"380px","scrollable_content":false,"animation_type":"fade","animation_speed":"350","animation_origin":"center top","open_sound":"none","custom_sound":"","location":"center top","position_top":"100","position_bottom":"0","position_left":"0","position_right":"0","position_from_trigger":false,"position_fixed":false,"overlay_disabled":false,"stackable":false,"disable_reposition":false,"zindex":"1999999999","close_button_delay":"0","fi_promotion":null,"close_on_form_submission":false,"close_on_form_submission_delay":"0","close_on_overlay_click":false,"close_on_esc_press":false,"close_on_f4_press":false,"disable_form_reopen":false,"disable_accessibility":false,"theme_slug":"lightbox","id":11677,"slug":"subscribe"}};
//# sourceURL=popup-maker-site-js-extra
  </script>
    <script src="/wp-content/uploads/pum/pum-site-scripts.js"></script>
    <script src="/wp-content/plugins/premium-addons-for-elementor/assets/frontend/min-js/elements-handler.min.js"></script>
    <script>
   var ald_params = {"nonce":"20546223fe","ajaxurl":"/wp-admin/admin-ajax.php","ald_pro":"0"};
//# sourceURL=ald-scripts-js-extra
  </script>
    <script src="/wp-content/plugins/ajax-load-more-anything/assets/scripts.js"></script>
    <script src="/wp-content/plugins/premium-addons-for-elementor/assets/frontend/min-js/premium-dis-conditions.min.js"></script>
    <script src="/wp-content/plugins/elementor-pro/assets/js/webpack-pro.runtime.min.js"></script>
    <script>
   var ElementorProFrontendConfig = {"ajaxurl":"\/wp-admin\/admin-ajax.php","nonce":"26119c1975","urls":{"assets":"\/wp-content\/plugins\/elementor-pro\/assets\/","rest":"\/wp-json\/"},"settings":{"lazy_load_background_images":true},"popup":{"hasPopUps":true},"shareButtonsNetworks":{"facebook":{"title":"Facebook","has_counter":true},"twitter":{"title":"Twitter"},"linkedin":{"title":"LinkedIn","has_counter":true},"pinterest":{"title":"Pinterest","has_counter":true},"reddit":{"title":"Reddit","has_counter":true},"vk":{"title":"VK","has_counter":true},"odnoklassniki":{"title":"OK","has_counter":true},"tumblr":{"title":"Tumblr"},"digg":{"title":"Digg"},"skype":{"title":"Skype"},"stumbleupon":{"title":"StumbleUpon","has_counter":true},"mix":{"title":"Mix"},"telegram":{"title":"Telegram"},"pocket":{"title":"Pocket","has_counter":true},"xing":{"title":"XING","has_counter":true},"whatsapp":{"title":"WhatsApp"},"email":{"title":"Email"},"print":{"title":"Print"},"x-twitter":{"title":"X"},"threads":{"title":"Threads"}},"facebook_sdk":{"lang":"en_US","app_id":""},"lottie":{"defaultAnimationUrl":"\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}};
//# sourceURL=elementor-pro-frontend-js-before
  </script>
    <script src="/wp-content/plugins/elementor-pro/assets/js/frontend.min.js"></script>
    <script src="/wp-content/plugins/elementor-pro/assets/js/elements-handlers.min.js"></script>
    <script>
   {"baseUrl":"https://s.w.org/images/core/emoji/17.0.2/72x72/","ext":".png","svgUrl":"https://s.w.org/images/core/emoji/17.0.2/svg/","svgExt":".svg","source":{"concatemoji":"/wp-includes/js/wp-emoji-release.min.js?ver=7.1"}}
  </script>
    <script>
   /*! This file is auto-generated */
var e="script#wp-emoji-settings",t=document.querySelector(e);if(!(t instanceof HTMLScriptElement))throw new Error("Element missing: "+e);const r=JSON.parse(t.text),s=(window._wpemojiSettings=r,"wpEmojiSettingsSupports"),o=["flag","emoji"];function i(e){try{var t={supportTests:e,timestamp:(new Date).valueOf()};sessionStorage.setItem(s,JSON.stringify(t))}catch(e){}}function c(e,t,n){e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(t,0,0);t=new Uint32Array(e.getImageData(0,0,e.canvas.width,e.canvas.height).data);e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(n,0,0);const r=new Uint32Array(e.getImageData(0,0,e.canvas.width,e.canvas.height).data);return t.every((e,t)=>e===r[t])}function p(e,t){e.clearRect(0,0,e.canvas.width,e.canvas.height),e.fillText(t,0,0);var n=e.getImageData(16,16,1,1);for(let e=0;e<n.data.length;e++)if(0!==n.data[e])return!1;return!0}function u(e,t,n,r){switch(t){case"flag":return n(e,"\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f","\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f")?!1:!n(e,"\ud83c\udde8\ud83c\uddf6","\ud83c\udde8\u200b\ud83c\uddf6")&&!n(e,"\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f","\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f");case"emoji":return!r(e,"\ud83e\u1fac8")}return!1}function f(e,t,n,r){let a;const s=(a="undefined"!=typeof WorkerGlobalScope&&self instanceof WorkerGlobalScope?new OffscreenCanvas(300,150):document.createElement("canvas")).getContext("2d",{willReadFrequently:!0}),o=(s.textBaseline="top",s.font="600 32px Arial",{});return e.forEach(e=>{o[e]=t(s,e,n,r)}),o}function a(e){var t=document.createElement("script");t.src=e,t.defer=!0,document.head.appendChild(t)}r.supports={everything:!0,everythingExceptFlag:!0},new Promise(t=>{let n=function(){try{var e=JSON.parse(sessionStorage.getItem(s));if("object"==typeof e&&"number"==typeof e.timestamp&&(new Date).valueOf()<e.timestamp+604800&&"object"==typeof e.supportTests)return e.supportTests}catch(e){}return null}();if(!n){if("undefined"!=typeof Worker&&"undefined"!=typeof OffscreenCanvas&&"undefined"!=typeof URL&&URL.createObjectURL&&"undefined"!=typeof Blob)try{var e="postMessage("+f.toString()+"("+[JSON.stringify(o),u.toString(),c.toString(),p.toString()].join(",")+"));",r=new Blob([e],{type:"text/javascript"});const a=new Worker(URL.createObjectURL(r),{name:"wpTestEmojiSupports"});return void(a.onmessage=e=>{i(n=e.data),a.terminate(),t(n)})}catch(e){}i(n=f(o,u,c,p))}t(n)}).then(e=>{for(const n in e)r.supports[n]=e[n],r.supports.everything=r.supports.everything&&r.supports[n],"flag"!==n&&(r.supports.everythingExceptFlag=r.supports.everythingExceptFlag&&r.supports[n]);var t;r.supports.everythingExceptFlag=r.supports.everythingExceptFlag&&!r.supports.flag,r.supports.everything||((t=r.source||{}).concatemoji?a(t.concatemoji):t.wpemoji&&t.twemoji&&(a(t.twemoji),a(t.wpemoji)))});
//# sourceURL=/wp-includes/js/wp-emoji-loader.min.js
  </script>
    <script>
   gform.initializeOnLoaded( function() { jQuery(document).on('gform_post_render', function(event, formId, currentPage){if(formId == 3) {if(typeof Placeholders != 'undefined'){
                        Placeholders.enable();
                    }} } );jQuery(document).on('gform_post_conditional_logic', function(event, formId, fields, isInit){} ) } );
  </script>
    <script>
   gform.initializeOnLoaded( function() {jQuery(document).trigger("gform_pre_post_render", [{ formId: "3", currentPage: "1", abort: function() { this.preventDefault(); } }]);        if (event && event.defaultPrevented) {                return;        }        const gformWrapperDiv = document.getElementById( "gform_wrapper_3" );        if ( gformWrapperDiv ) {            const visibilitySpan = document.createElement( "span" );            visibilitySpan.id = "gform_visibility_test_3";            gformWrapperDiv.insertAdjacentElement( "afterend", visibilitySpan );        }        const visibilityTestDiv = document.getElementById( "gform_visibility_test_3" );        let postRenderFired = false;        function triggerPostRender() {            if ( postRenderFired ) {                return;            }            postRenderFired = true;            gform.core.triggerPostRenderEvents( 3, 1 );            if ( visibilityTestDiv ) {                visibilityTestDiv.parentNode.removeChild( visibilityTestDiv );            }        }        function debounce( func, wait, immediate ) {            var timeout;            return function() {                var context = this, args = arguments;                var later = function() {                    timeout = null;                    if ( !immediate ) func.apply( context, args );                };                var callNow = immediate && !timeout;                clearTimeout( timeout );                timeout = setTimeout( later, wait );                if ( callNow ) func.apply( context, args );            };        }        const debouncedTriggerPostRender = debounce( function() {            triggerPostRender();        }, 200 );        if ( visibilityTestDiv && visibilityTestDiv.offsetParent === null ) {            const observer = new MutationObserver( ( mutations ) => {                mutations.forEach( ( mutation ) => {                    if ( mutation.type === 'attributes' && visibilityTestDiv.offsetParent !== null ) {                        debouncedTriggerPostRender();                        observer.disconnect();                    }                });            });            observer.observe( document.body, {                attributes: true,                childList: false,                subtree: true,                attributeFilter: [ 'style', 'class' ],            });        } else {            triggerPostRender();        }    } );
  </script>
    <script>
   gform.initializeOnLoaded( function() { jQuery(document).on('gform_post_render', function(event, formId, currentPage){if(formId == 4) {if(typeof Placeholders != 'undefined'){
                        Placeholders.enable();
                    }} } );jQuery(document).on('gform_post_conditional_logic', function(event, formId, fields, isInit){} ) } );
  </script>
    <script>
   gform.initializeOnLoaded( function() {jQuery(document).trigger("gform_pre_post_render", [{ formId: "4", currentPage: "1", abort: function() { this.preventDefault(); } }]);        if (event && event.defaultPrevented) {                return;        }        const gformWrapperDiv = document.getElementById( "gform_wrapper_4" );        if ( gformWrapperDiv ) {            const visibilitySpan = document.createElement( "span" );            visibilitySpan.id = "gform_visibility_test_4";            gformWrapperDiv.insertAdjacentElement( "afterend", visibilitySpan );        }        const visibilityTestDiv = document.getElementById( "gform_visibility_test_4" );        let postRenderFired = false;        function triggerPostRender() {            if ( postRenderFired ) {                return;            }            postRenderFired = true;            gform.core.triggerPostRenderEvents( 4, 1 );            if ( visibilityTestDiv ) {                visibilityTestDiv.parentNode.removeChild( visibilityTestDiv );            }        }        function debounce( func, wait, immediate ) {            var timeout;            return function() {                var context = this, args = arguments;                var later = function() {                    timeout = null;                    if ( !immediate ) func.apply( context, args );                };                var callNow = immediate && !timeout;                clearTimeout( timeout );                timeout = setTimeout( later, wait );                if ( callNow ) func.apply( context, args );            };        }        const debouncedTriggerPostRender = debounce( function() {            triggerPostRender();        }, 200 );        if ( visibilityTestDiv && visibilityTestDiv.offsetParent === null ) {            const observer = new MutationObserver( ( mutations ) => {                mutations.forEach( ( mutation ) => {                    if ( mutation.type === 'attributes' && visibilityTestDiv.offsetParent !== null ) {                        debouncedTriggerPostRender();                        observer.disconnect();                    }                });            });            observer.observe( document.body, {                attributes: true,                childList: false,                subtree: true,                attributeFilter: [ 'style', 'class' ],            });        } else {            triggerPostRender();        }    } );
  </script>
    <script>
    jQuery(document).ready(function($) {
        if (typeof Swiper !== 'undefined') {
            $('.project-carousel-home .elementor-slides-wrapper').each(function() {
                var $wrapper = $(this);
                if (!$wrapper[0].swiper) {
                    new Swiper($wrapper[0], {
                        slidesPerView: 1,
                        spaceBetween: 0,
                        loop: true,
                        speed: 1000,
                        effect: 'fade',
                        fadeEffect: {
                            crossFade: true
                        },
                        autoplay: {
                            delay: 4500,
                            disableOnInteraction: false
                        },
                        navigation: {
                            nextEl: $wrapper.closest('.elementor-widget-container').find('.elementor-swiper-button-next')[0],
                            prevEl: $wrapper.closest('.elementor-widget-container').find('.elementor-swiper-button-prev')[0]
                        }
                    });
                }
            });
        }
    });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>
