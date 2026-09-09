@php
    $siteFooterHtml = app(\App\Services\PagePartialResolver::class)->resolveSiteDefault('footer_id', app()->getLocale());
@endphp
@if(!empty(trim($siteFooterHtml)))
    {!! $siteFooterHtml !!}
@else
<footer class="elementor elementor-101 elementor-location-footer" data-elementor-id="101" data-elementor-post-type="elementor_library" data-elementor-type="footer">
<section class="elementor-section elementor-top-section elementor-element elementor-element-e2ea0c3 elementor-section-full_width footer-form elementor-section-height-default elementor-section-height-default" data-dce-background-image-url="/wp-content/uploads/2021/12/bg-cta.jpg" data-e-type="section" data-element_type="section" data-id="e2ea0c3" data-settings='{"background_background":"classic"}' style="background-image: url('/wp-content/uploads/2021/12/bg-cta.jpg'); background-size: cover; background-position: center;">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-708a17d" data-e-type="column" data-element_type="column" data-id="708a17d">
<div class="elementor-widget-wrap elementor-element-populated">
<section class="elementor-section elementor-inner-section elementor-element elementor-element-6e9aa1f elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="6e9aa1f" data-settings='{"background_background":"classic"}'>
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-7290a0d" data-e-type="column" data-element_type="column" data-id="7290a0d">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-cf03bfa elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="cf03bfa" data-widget_type="heading.default">
<div class="elementor-widget-container">
<h2 class="elementor-heading-title elementor-size-default">
              Discover Our Exclusive Services
             </h2>
</div>
</div>
<div class="elementor-element elementor-element-2a97772 gravity-design elementor-widget elementor-widget-shortcode" data-e-type="widget" data-element_type="widget" data-id="2a97772" data-widget_type="shortcode.default">
<div class="elementor-widget-container">
<div class="elementor-shortcode">
<div class="gf_browser_chrome gform_wrapper gravity-theme gform-theme--no-framework" data-form-index="0" data-form-theme="gravity-theme" id="gform_wrapper_4">
<div class="gform_anchor" id="gf_4" tabindex="-1">
</div>
<div class="gform_heading">
<h2 class="gform_title">
                 Bottom Enquiry Form
                </h2>
<p class="gform_description">
</p>
</div>
<form action="/#gf_4" data-formid="4" enctype="multipart/form-data" id="gform_4" method="post" novalidate="" target="gform_ajax_frame_4">
<input class="gforms-pum" type="hidden" value='{"closepopup":false,"closedelay":0,"openpopup":false,"openpopup_id":0}'/>
<div class="gform-body gform_body">
<div class="gform_fields top_label form_sublabel_below description_below validation_below" id="gform_fields_4">
<div class="gfield gfield--type-text gfield--width-full gf_left_half gfield--width-half gfield_contains_required field_sublabel_below gfield--no-description field_description_below field_validation_below gfield_visibility_visible" id="field_4_1">
<label class="gfield_label gform-field-label" for="input_4_1">
                    Company Name
                    <span class="gfield_required">
<span class="gfield_required gfield_required_text">
                      (Required)
                     </span>
</span>
</label>
<div class="ginput_container ginput_container_text">
<input aria-invalid="false" aria-required="true" class="large" id="input_4_1" name="input_1" placeholder="Company Name*" type="text" value=""/>
</div>
</div>
<div class="gfield gfield--type-textarea gfield--width-full gf_right_half gfield--width-half gfield_contains_required field_sublabel_below gfield--no-description field_description_below field_validation_below gfield_visibility_visible" id="field_4_4">
<label class="gfield_label gform-field-label" for="input_4_4">
                    Message
                    <span class="gfield_required">
<span class="gfield_required gfield_required_text">
                      (Required)
                     </span>
</span>
</label>
<div class="ginput_container ginput_container_textarea">
<textarea aria-invalid="false" aria-required="true" class="textarea small" cols="50" id="input_4_4" name="input_4" placeholder="Message*" rows="10"></textarea>
</div>
</div>
<div class="gfield gfield--type-email gfield--width-full gf_left_half gfield--width-half gfield_contains_required field_sublabel_below gfield--no-description field_description_below field_validation_below gfield_visibility_visible" id="field_4_5">
<label class="gfield_label gform-field-label" for="input_4_5">
                    Email
                    <span class="gfield_required">
<span class="gfield_required gfield_required_text">
                      (Required)
                     </span>
</span>
</label>
<div class="ginput_container ginput_container_email">
<input aria-invalid="false" aria-required="true" class="large" id="input_4_5" name="input_5" placeholder="Email*" type="email" value=""/>
</div>
</div>
</div>
</div>
<div class="gform-footer gform_footer top_label">
<input class="gform_button button" data-submission-type="submit" id="gform_submit_button_4" onclick="gform.submission.handleButtonClick(this);" type="submit" value="Submit Now"/>
<input name="gform_ajax" type="hidden" value="form_id=4&amp;title=1&amp;description=1&amp;tabindex=0&amp;theme=gravity-theme&amp;styles=[]&amp;hash=b22815f28795e7c766d718cd2907686f"/>
<input class="gform_hidden" data-js="gform_submission_method_4" name="gform_submission_method" type="hidden" value="iframe"/>
<input class="gform_hidden" data-js="gform_theme_4" id="gform_theme_4" name="gform_theme" type="hidden" value="gravity-theme"/>
<input class="gform_hidden" data-js="gform_style_settings_4" id="gform_style_settings_4" name="gform_style_settings" type="hidden" value="[]"/>
<input class="gform_hidden" name="is_submit_4" type="hidden" value="1"/>
<input class="gform_hidden" name="gform_submit" type="hidden" value="4"/>
<input class="gform_hidden" data-currency="USD" name="gform_currency" type="hidden" value="M0KDHeVzd3znrzbjrG09Uu/PthLbQp5sPrSCBUW0Pip14qUdxv+qgaAbNrYN7PwupX77UcJBCe7F0eL4pTMRAPyhU3/DHAR0FBlAXI80vvg52TQ="/>
<input class="gform_hidden" name="gform_unique_id" type="hidden" value=""/>
<input class="gform_hidden" name="state_4" type="hidden" value="WyJbXSIsIjhkMWNjYjc3MWNhYjg0MDFhZmFlMWYxMThiMWVjZjMzIl0="/>
<input autocomplete="off" class="gform_hidden" id="gform_target_page_number_4" name="gform_target_page_number_4" type="hidden" value="0"/>
<input autocomplete="off" class="gform_hidden" id="gform_source_page_number_4" name="gform_source_page_number_4" type="hidden" value="1"/>
<input name="gform_field_values" type="hidden" value=""/>
</div>
</form>
</div>
<iframe id="gform_ajax_frame_4" name="gform_ajax_frame_4" src="about:blank" style="display:none;width:0px;height:0px;" title="This iframe contains the logic required to handle Ajax powered Gravity Forms.">
</iframe>
<script>
               gform.initializeOnLoaded( function() {gformInitSpinner( 4, '/wp-content/plugins/gravityforms/images/spinner.svg', true );jQuery('#gform_ajax_frame_4').on('load',function(){var contents = jQuery(this).contents().find('*').html();var is_postback = contents.indexOf('GF_AJAX_POSTBACK') >= 0;if(!is_postback){return;}var form_content = jQuery(this).contents().find('#gform_wrapper_4');var is_confirmation = jQuery(this).contents().find('#gform_confirmation_wrapper_4').length > 0;var is_redirect = contents.indexOf('gformRedirect(){') >= 0;var is_form = form_content.length > 0 && ! is_redirect && ! is_confirmation;var mt = parseInt(jQuery('html').css('margin-top'), 10) + parseInt(jQuery('body').css('margin-top'), 10) + 100;if(is_form){jQuery('#gform_wrapper_4').html(form_content.html());if(form_content.hasClass('gform_validation_error')){jQuery('#gform_wrapper_4').addClass('gform_validation_error');} else {jQuery('#gform_wrapper_4').removeClass('gform_validation_error');}setTimeout( function() { /* delay the scroll by 50 milliseconds to fix a bug in chrome */ jQuery(document).scrollTop(jQuery('#gform_wrapper_4').offset().top - mt); }, 50 );if(window['gformInitDatepicker']) {gformInitDatepicker();}if(window['gformInitPriceFields']) {gformInitPriceFields();}var current_page = jQuery('#gform_source_page_number_4').val();gformInitSpinner( 4, '/wp-content/plugins/gravityforms/images/spinner.svg', true );jQuery(document).trigger('gform_page_loaded', [4, current_page]);window['gf_submitting_4'] = false;}else if(!is_redirect){var confirmation_content = jQuery(this).contents().find('.GF_AJAX_POSTBACK').html();if(!confirmation_content){confirmation_content = contents;}jQuery('#gform_wrapper_4').replaceWith(confirmation_content);jQuery(document).scrollTop(jQuery('#gf_4').offset().top - mt);jQuery(document).trigger('gform_confirmation_loaded', [4]);window['gf_submitting_4'] = false;wp.a11y.speak(jQuery('#gform_confirmation_message_4').text());}else{jQuery('#gform_4').append(contents);if(window['gformRedirect']) {gformRedirect();}}jQuery(document).trigger("gform_pre_post_render", [{ formId: "4", currentPage: "current_page", abort: function() { this.preventDefault(); } }]);        if (event && event.defaultPrevented) {                return;        }        const gformWrapperDiv = document.getElementById( "gform_wrapper_4" );        if ( gformWrapperDiv ) {            const visibilitySpan = document.createElement( "span" );            visibilitySpan.id = "gform_visibility_test_4";            gformWrapperDiv.insertAdjacentElement( "afterend", visibilitySpan );        }        const visibilityTestDiv = document.getElementById( "gform_visibility_test_4" );        let postRenderFired = false;        function triggerPostRender() {            if ( postRenderFired ) {                return;            }            postRenderFired = true;            gform.core.triggerPostRenderEvents( 4, current_page );            if ( visibilityTestDiv ) {                visibilityTestDiv.parentNode.removeChild( visibilityTestDiv );            }        }        function debounce( func, wait, immediate ) {            var timeout;            return function() {                var context = this, args = arguments;                var later = function() {                    timeout = null;                    if ( !immediate ) func.apply( context, args );                };                var callNow = immediate && !timeout;                clearTimeout( timeout );                timeout = setTimeout( later, wait );                if ( callNow ) func.apply( context, args );            };        }        const debouncedTriggerPostRender = debounce( function() {            triggerPostRender();        }, 200 );        if ( visibilityTestDiv && visibilityTestDiv.offsetParent === null ) {            const observer = new MutationObserver( ( mutations ) => {                mutations.forEach( ( mutation ) => {                    if ( mutation.type === 'attributes' && visibilityTestDiv.offsetParent !== null ) {                        debouncedTriggerPostRender();                        observer.disconnect();                    }                });            });            observer.observe( document.body, {                attributes: true,                childList: false,                subtree: true,                attributeFilter: [ 'style', 'class' ],            });        } else {            triggerPostRender();        }    } );} );
              </script>
</div>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1783469" data-e-type="column" data-element_type="column" data-id="1783469">
<div class="elementor-widget-wrap">
</div>
</div>
</div>
</section>
</div>
</div>
</div>
</section>
<!-- dce invisible element 6e6de482 -->
<footer class="elementor-section elementor-top-section elementor-element elementor-element-68fa83e elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-dce-background-color="#0C1525" data-e-type="section" data-element_type="section" data-id="68fa83e" data-settings='{"background_background":"classic"}'>
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-8f7c501" data-e-type="column" data-element_type="column" data-id="8f7c501">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-cbac265 elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="cbac265" data-widget_type="heading.default">
<div class="elementor-widget-container">
<h4 class="elementor-heading-title elementor-size-default">
          Office
         </h4>
</div>
</div>
<div class="elementor-element elementor-element-57bad42 elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="57bad42" data-widget_type="heading.default">
<div class="elementor-widget-container">
<h2 class="elementor-heading-title elementor-size-default">
          Singapore
         </h2>
</div>
</div>
<div class="elementor-element elementor-element-d32a389 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="d32a389" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="tel:6562788588">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="fas fa-phone-alt">
</i>
</span>
<span class="elementor-icon-list-text">
             +65 6278 8588
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="mailto:sales@luxlight.sg">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="far fa-envelope">
</i>
</span>
<span class="elementor-icon-list-text">
             sales@luxlight.sg
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="fas fa-map-marker-alt">
</i>
</span>
<span class="elementor-icon-list-text">
            138 Joo Seng Road, #07-00 Singapore 368361
           </span>
</li>
</ul>
</div>
</div>
<div class="elementor-element elementor-element-8d079c1 elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="8d079c1" data-widget_type="heading.default">
<div class="elementor-widget-container">
<h2 class="elementor-heading-title elementor-size-default">
          Hong Kong
         </h2>
</div>
</div>
<div class="elementor-element elementor-element-4db7202 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="4db7202" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="tel:85225110022">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="fas fa-phone-alt">
</i>
</span>
<span class="elementor-icon-list-text">
             +852 2511 0022
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="mailto:sales@luxlight-prosperity.com">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="far fa-envelope">
</i>
</span>
<span class="elementor-icon-list-text">
             sales@luxlight-prosperity.com
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="fas fa-map-marker-alt">
</i>
</span>
<span class="elementor-icon-list-text">
            20/F, Cornell Centre, 50 Wing Tai Road, Chai Wan, Hong Kong
           </span>
</li>
</ul>
</div>
</div>
<div class="elementor-element elementor-element-b0a4754 elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="b0a4754" data-widget_type="heading.default">
<div class="elementor-widget-container">
<h2 class="elementor-heading-title elementor-size-default">
          Vietnam
         </h2>
</div>
</div>
<div class="elementor-element elementor-element-77d5ba4 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="77d5ba4" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="tel:+842866602739">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="fas fa-phone-alt">
</i>
</span>
<span class="elementor-icon-list-text">
             +84 28 66602739
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="mailto:sales@luxlight.com.vn">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="far fa-envelope">
</i>
</span>
<span class="elementor-icon-list-text">
             sales@luxlight.com.vn
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="fas fa-map-marker-alt">
</i>
</span>
<span class="elementor-icon-list-text">
            Unit 33.05, Landmark 81 Tower 720 Dien Bien Phu Street, Thanh My Tay Ward Ho Chi Minh City, Vietnam
           </span>
</li>
</ul>
</div>
</div>
<div class="elementor-element elementor-element-03c4aab elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="03c4aab" data-widget_type="heading.default">
<div class="elementor-widget-container">
<h2 class="elementor-heading-title elementor-size-default">
          Thailand
         </h2>
</div>
</div>
<div class="elementor-element elementor-element-c28f444 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="c28f444" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="tel:+66%20892312332">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="fas fa-phone-alt">
</i>
</span>
<span class="elementor-icon-list-text">
             +66 80 830 6509
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="mailto:sales@luxlight.co.th">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="far fa-envelope">
</i>
</span>
<span class="elementor-icon-list-text">
             sales@luxlight.co.th
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-icon">
<i aria-hidden="true" class="fas fa-map-marker-alt">
</i>
</span>
<span class="elementor-icon-list-text">
            546 Rachada One Building, 2nd  Floor, Unit 203, Ratchadaphisek Rd. Chandrakasam, Chatuchak, Bangkok 10900, Thailand
           </span>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-ba2bbef elementor-hidden-mobile" data-e-type="column" data-element_type="column" data-id="ba2bbef">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-6a3586c elementor-align-start elementor-hidden-tablet elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="6a3586c" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
<li class="elementor-icon-list-item">
<span class="elementor-icon-list-text">
</span>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-47743ff" data-e-type="column" data-element_type="column" data-id="47743ff">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-fc0493a elementor-align-start elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="fc0493a" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="{{ route('about') }}">
<span class="elementor-icon-list-text">
             About
            </span>
</a>
</li>
</ul>
</div>
</div>
<div class="elementor-element elementor-element-83001e7 elementor-align-start elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="83001e7" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="{{ route('about') }}">
<span class="elementor-icon-list-text">
             Company
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="{{ route('about') }}">
<span class="elementor-icon-list-text">
             Our Solutions
            </span>
</a>
</li>
</ul>
</div>
</div>
<section class="elementor-section elementor-inner-section elementor-element elementor-element-7f7cbe0 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="7f7cbe0">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-ebc7be2" data-e-type="column" data-element_type="column" data-id="ebc7be2">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-4f0d83b elementor-align-start elementor-hidden-desktop elementor-hidden-mobile elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="4f0d83b" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="{{ route('brands') }}">
<span class="elementor-icon-list-text">
                 Brands​
                </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="{{ route('contact') }}">
<span class="elementor-icon-list-text">
                 Contact​
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
</div>
</div>
<div class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-75878da" data-e-type="column" data-element_type="column" data-id="75878da">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-2c4b1a2 elementor-align-start elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="2c4b1a2" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="{{ route('projects') }}">
<span class="elementor-icon-list-text">
             Projects​
            </span>
</a>
</li>
</ul>
</div>
</div>
<div class="elementor-element elementor-element-96dfeb9 elementor-align-start elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="96dfeb9" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="/hospitality-lighting-projects/index.html">
<span class="elementor-icon-list-text">
             Hospitality
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="/residential-lighting-projects/index.html">
<span class="elementor-icon-list-text">
             Residential
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="/commercial-lighting-projects/index.html">
<span class="elementor-icon-list-text">
             Commercial
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="/other-lighting-projects/index.html">
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
<div class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-2bc6bf2 elementor-hidden-tablet" data-e-type="column" data-element_type="column" data-id="2bc6bf2">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-8dc6506 elementor-align-start elementor-hidden-tablet elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="8dc6506" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items">
<li class="elementor-icon-list-item">
<a href="{{ route('brands') }}">
<span class="elementor-icon-list-text">
             Brands​
            </span>
</a>
</li>
<li class="elementor-icon-list-item">
<a href="{{ route('contact') }}">
<span class="elementor-icon-list-text">
             Contact​
            </span>
</a>
</li>
</ul>
</div>
</div>
<div class="elementor-element elementor-element-28c935c elementor-grid-tablet-0 e-grid-align-mobile-center elementor-absolute e-grid-align-left pa-display-conditions-yes elementor-shape-rounded elementor-grid-0 elementor-widget elementor-widget-social-icons" data-e-type="widget" data-element_type="widget" data-id="28c935c" data-settings='{"_position":"absolute","pa_display_conditions_switcher":"yes"}' data-widget_type="social-icons.default">
<div class="elementor-widget-container">
<div class="elementor-social-icons-wrapper elementor-grid" role="list">
<span class="elementor-grid-item" role="listitem">
<a class="elementor-icon elementor-social-icon elementor-social-icon-instagram elementor-repeater-item-995a154" href="https://www.instagram.com/luxlight.premium" target="_blank">
<span class="elementor-screen-only">
             Instagram
            </span>
<i aria-hidden="true" class="fab fa-instagram">
</i>
</a>
</span>
<span class="elementor-grid-item" role="listitem">
<a class="elementor-icon elementor-social-icon elementor-social-icon-linkedin-in elementor-repeater-item-2f7e828" href="https://www.linkedin.com/company/luxlight-premium/" target="_blank">
<span class="elementor-screen-only">
             Linkedin-in
            </span>
<i aria-hidden="true" class="fab fa-linkedin-in">
</i>
</a>
</span>
</div>
</div>
</div>
</div>
</div>
</div>
</footer>
<footer class="elementor-section elementor-top-section elementor-element elementor-element-f888393 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-dce-background-color="#0C1525" data-e-type="section" data-element_type="section" data-id="f888393" data-settings='{"background_background":"classic"}'>
<div class="elementor-container elementor-column-gap-default">
</div>
</footer>
<footer class="elementor-section elementor-top-section elementor-element elementor-element-a2d700c elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-dce-background-color="#0C1525" data-e-type="section" data-element_type="section" data-id="a2d700c" data-settings='{"background_background":"classic"}'>
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-ccc7cbd" data-e-type="column" data-element_type="column" data-id="ccc7cbd">
<div class="elementor-widget-wrap elementor-element-populated">
<section class="elementor-section elementor-inner-section elementor-element elementor-element-df45576 elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-e-type="section" data-element_type="section" data-id="df45576">
<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-b053094" data-e-type="column" data-element_type="column" data-id="b053094">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-da74df6 elementor-widget elementor-widget-heading" data-e-type="widget" data-element_type="widget" data-id="da74df6" data-widget_type="heading.default">
<div class="elementor-widget-container">
<h2 class="elementor-heading-title elementor-size-default">
              © 2025 LuxLight. All rights reserved.
             </h2>
</div>
</div>
</div>
</div>
<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-6d2e900" data-e-type="column" data-element_type="column" data-id="6d2e900">
<div class="elementor-widget-wrap elementor-element-populated">
<div class="elementor-element elementor-element-7b42779 elementor-icon-list--layout-inline elementor-align-end elementor-mobile-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-e-type="widget" data-element_type="widget" data-id="7b42779" data-widget_type="icon-list.default">
<div class="elementor-widget-container">
<ul class="elementor-icon-list-items elementor-inline-items">
<li class="elementor-icon-list-item elementor-inline-item">
<a href="{{ url('/privacy-policy') }}">
<span class="elementor-icon-list-text">
                 Privacy Policy
                </span>
</a>
</li>
<li class="elementor-icon-list-item elementor-inline-item">
<a href="{{ url('/terms-of-use') }}">
<span class="elementor-icon-list-text">
                 Terms of Use
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
<div class="elementor-element elementor-element-c66e9da elementor-widget elementor-widget-html" data-e-type="widget" data-element_type="widget" data-id="c66e9da" data-widget_type="html.default">
<div class="elementor-widget-container">
<script>
          jQuery(document).ready(function(){
  jQuery("#customcolmn i.fas.fa-search").click(function(){
    jQuery("#customcolmn").toggleClass('active');
	jQuery("#customcolmn .elementor-search-form").toggleClass('activeTG');
		jQuery(".site-tools").toggleClass('activeTG');
	
  });
});
         </script>
</div>
</div>
</div>
</div>
</div>
</footer>
</footer>
@endif