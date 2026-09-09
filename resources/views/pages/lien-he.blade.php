@extends('layouts.app')

@section('title', 'Contact - LuxLight')
@section('meta_description', 'Contact LuxLight Singapore, Hong Kong, Vietnam and Thailand for architectural and decorative lighting solutions.')

@push('styles')
<style>
    /* Custom Typography matching luxlight.sg */
    @font-face {
        font-family: 'ACaslonPro';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url('/wp-content/uploads/2021/12/ACaslonPro-Regular.woff') format('woff');
    }
    @font-face {
        font-family: 'ACaslonPro';
        font-style: italic;
        font-weight: 400;
        font-display: swap;
        src: url('/wp-content/uploads/2021/12/ACaslonPro-Italic.woff') format('woff');
    }
    @font-face {
        font-family: 'ACaslonPro';
        font-style: normal;
        font-weight: 600;
        font-display: swap;
        src: url('/wp-content/uploads/2021/12/ACaslonPro-Bold.woff') format('woff');
    }
    @font-face {
        font-family: 'Din';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url('/wp-content/uploads/2021/12/DIN.woff') format('woff');
    }
    @font-face {
        font-family: 'Din';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: url('/wp-content/uploads/2021/12/DIN-Medium.woff') format('woff');
    }
    @font-face {
        font-family: 'Din';
        font-style: normal;
        font-weight: 700;
        font-display: swap;
        src: url('/wp-content/uploads/2021/12/DINBold.woff') format('woff');
    }

    /* Contact Page Master Layout */
    .lux-contact-wrapper {
        width: 100%;
        background-color: #ffffff;
        color: #0b1523;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    /* Hero Banner matching original */
    .lux-hero-banner {
        position: relative;
        width: 100%;
        min-height: 390px;
        background-image: url('/wp-content/uploads/2022/02/16.02.2022-St-Peter-N-Paul-Facade-scaled.jpg');
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 20px;
        margin: 0;
        border: none !important;
    }

    .lux-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #000000;
        opacity: 0.15;
        pointer-events: none;
    }

    .lux-hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: 0 auto;
    }

    .lux-hero-title {
        font-family: 'ACaslonPro', serif;
        font-size: 50.4px;
        font-weight: 300;
        line-height: 60.8px;
        letter-spacing: -0.6px;
        color: #ffffff;
        margin: 0 0 10px 0;
        text-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }

    .lux-hero-quote {
        font-family: 'Din', 'Calibri', sans-serif;
        font-size: 14px;
        font-weight: 400;
        color: #ffffff;
        margin: -9px 0 0 0;
        line-height: 1.6;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    .lux-hero-quote p {
        margin: 0;
        color: #ffffff;
    }

    .lux-hero-quote span.author {
        color: #ffffff;
        font-family: 'Calibri', sans-serif;
        font-size: 11pt;
        display: block;
        margin-top: 4px;
    }

    /* Main 2-Column Section matching original (.elementor-element-c2e322e) */
    .lux-main-section {
        width: 100%;
        padding: 5% 4% 3% 4%;
        box-sizing: border-box;
    }

    .lux-main-container {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        margin: 0 auto;
        box-sizing: border-box;
    }

    /* Left Column (36%) */
    .lux-col-left {
        width: 36%;
        padding: 10px 10px 10px 10px;
        box-sizing: border-box;
    }

    .lux-section-title {
        font-family: 'ACaslonPro', serif;
        font-size: 44.8px;
        font-weight: 400;
        line-height: 53.76px;
        color: #0B1523;
        margin: 0 0 25px 0;
    }

    .lux-form-wrapper {
        padding: 0 100px 0 0;
        box-sizing: border-box;
    }

    .lux-form-success {
        display: none;
        background-color: #f4f8f4;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 15px 20px;
        margin-bottom: 20px;
        font-family: 'Din', sans-serif;
        font-size: 14px;
    }

    .lux-gravity-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .lux-form-field {
        width: 100%;
    }

    .lux-gravity-form input[type="text"],
    .lux-gravity-form input[type="email"],
    .lux-gravity-form input[type="tel"],
    .lux-gravity-form select,
    .lux-gravity-form textarea {
        width: 100%;
        background-color: transparent !important;
        border: none !important;
        border-bottom: 1px solid #C8C9CB !important;
        border-radius: 0 !important;
        padding: 8px 0 !important;
        font-family: 'Din', sans-serif !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        color: #495057 !important;
        outline: 0 !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease;
        box-sizing: border-box;
    }

    .lux-gravity-form input[type="text"]:focus,
    .lux-gravity-form input[type="email"]:focus,
    .lux-gravity-form input[type="tel"]:focus,
    .lux-gravity-form select:focus,
    .lux-gravity-form textarea:focus {
        border-bottom: 1px solid #AB9A71 !important;
    }

    .lux-gravity-form input::placeholder,
    .lux-gravity-form textarea::placeholder {
        color: #495057;
        opacity: 0.75;
    }

    .lux-gravity-form select {
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2210%22%20height%3D%226%22%20viewBox%3D%220%200%2010%206%22%3E%3Cpath%20fill%3D%22%23495057%22%20d%3D%22M0%200l5%206%205-6z%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 5px center;
        background-size: 10px 6px;
    }

    .lux-gravity-form textarea {
        height: 100px !important;
        resize: none;
    }

    .lux-submit-button {
        align-self: flex-start;
        background-color: #0B1523;
        color: #FFFFFF;
        font-family: 'Din', 'D-DIN', sans-serif;
        font-size: 14.7px;
        font-weight: 500;
        line-height: 22.05px;
        letter-spacing: 0px;
        fill: #FFFFFF;
        border-radius: 0px;
        padding: 6px 13px 6px 12px;
        border: none;
        cursor: pointer;
        text-transform: capitalize;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin-top: 10px;
    }

    .lux-submit-button:hover {
        background-color: #E9A832;
        color: #FFFFFF;
    }

    /* Right Column (64%) */
    .lux-col-right {
        width: 64%;
        padding: 0px;
        box-sizing: border-box;
    }

    .lux-cards-row {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        gap: 0;
    }

    /* Individual Card Column (50%) */
    .lux-card-col {
        width: 50%;
        box-sizing: border-box;
    }

    .lux-card {
        background-color: #ffffff;
        background-image: url('/wp-content/uploads/2021/12/aarti.jpg');
        background-position: top right;
        background-repeat: no-repeat;
        background-size: 57% auto;
        box-shadow: 0px 1px 12px 0px rgba(170, 153, 153, 0.31);
        margin: 0px 50px 0px 0px;
        padding: 50px 0px 55px 50px;
        border-radius: 0px;
        box-sizing: border-box;
    }

    /* Branch Block */
    .lux-branch-block {
        box-sizing: border-box;
    }

    .lux-branch-title {
        font-family: 'ACaslonPro', serif;
        font-size: 36.4px;
        font-weight: 400;
        line-height: 43.68px;
        letter-spacing: -0.6px;
        color: #AB9A71;
        margin: 0 0 10px 0;
    }

    .lux-branch-list {
        list-style: none;
        padding: 0;
        margin: 0 0 0 6px;
    }

    .lux-branch-item {
        display: flex;
        align-items: flex-start;
        font-family: 'Din', sans-serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 25.2px;
        letter-spacing: 0px;
        color: #7a7a7a;
        margin-bottom: 2px;
    }

    .lux-branch-item .lux-icon {
        color: #AB9A71;
        font-size: 14px;
        width: 20px;
        min-width: 20px;
        margin-top: 5px;
        padding-right: 4px;
    }

    .lux-branch-item a {
        color: #7a7a7a;
        text-decoration: none;
        transition: color 0.3s;
    }

    .lux-branch-item a:hover {
        color: #AB9A71;
    }

    .lux-branch-item .lux-text {
        color: #7a7a7a;
    }

    /* Map Button Matching Elementor */
    .lux-map-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 15px;
        padding-right: 50px;
        box-sizing: border-box;
    }

    .lux-map-button {
        display: inline-block;
        background-color: #0B1523;
        color: #FFFFFF;
        font-family: 'Din', 'D-DIN', sans-serif;
        font-weight: 500;
        font-size: 14px;
        border-radius: 0px;
        padding: 8px 30px 8px 25px;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .lux-map-button:hover {
        background-color: #E9A832;
        color: #FFFFFF;
    }

    /* Responsive Queries matching original post-1650.css */
    @media (max-width: 1024px) {
        .lux-main-section {
            padding: 3% 3% 3% 3%;
        }
        .lux-form-wrapper {
            padding: 0;
        }
        .lux-card {
            margin: 0 20px 0 0;
            padding: 50px 20px 30px 20px;
        }
        .lux-map-container {
            padding-right: 20px;
        }
    }

    @media (max-width: 767px) {
        .lux-hero-title {
            font-size: 21px;
            line-height: 1.25;
        }
        .lux-hero-quote {
            font-size: 12.6px;
        }
        .lux-main-section {
            padding: 10% 0% 20% 0%;
        }
        .lux-col-left {
            width: 100%;
            padding: 20px 20px 20px 20px;
        }
        .lux-section-title {
            font-size: 33.6px;
            line-height: 1.2;
        }
        .lux-col-right {
            width: 100%;
            padding: 10px;
        }
        .lux-cards-row {
            flex-direction: column;
        }
        .lux-card-col {
            width: 100%;
            margin-bottom: 20px;
        }
        .lux-card {
            margin: 0;
            padding: 40px 15px 30px 15px;
            background-size: auto;
        }
        .lux-map-container {
            justify-content: center;
            padding-right: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="lux-contact-wrapper">
    <!-- Hero Banner Section -->
    <div class="lux-hero-banner">
        <div class="lux-hero-overlay"></div>
        <div class="lux-hero-content">
            <h1 class="lux-hero-title">Discover Our Exclusive Services</h1>
            <div class="lux-hero-quote">
                <p>‘Customer service represents the heart of a brand in the hearts of its customers.’</p>
                <span class="author">Kate Nasser</span>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="lux-main-section">
        <div class="lux-main-container">
            <!-- Left Column: Title & Gravity Form -->
            <div class="lux-col-left">
                <h2 class="lux-section-title">Discover Our<br/>Exclusive Services</h2>
                
                <div class="lux-form-wrapper">
                    <div class="lux-form-success" id="lux-success-msg">
                        Thank you for contacting LuxLight! We will get back to you shortly.
                    </div>

                    <form class="lux-gravity-form" id="lux-contact-form" onsubmit="event.preventDefault(); document.getElementById('lux-success-msg').style.display='block'; this.reset();">
                        <div class="lux-form-field">
                            <input aria-required="true" required name="input_3" placeholder="Name: *" type="text" value=""/>
                        </div>
                        <div class="lux-form-field">
                            <input aria-required="true" required name="input_4" placeholder="Title:*" type="text" value=""/>
                        </div>
                        <div class="lux-form-field">
                            <input aria-required="true" required name="input_5" placeholder="Company: *" type="text" value=""/>
                        </div>
                        <div class="lux-form-field">
                            <input aria-required="true" required name="input_25" placeholder="Email*" type="email" value=""/>
                        </div>
                        <div class="lux-form-field">
                            <input aria-required="true" required name="input_27" placeholder="Phone (Required)" type="tel" value=""/>
                        </div>
                        <div class="lux-form-field">
                            <select aria-required="true" name="input_18">
                                <option value="Sales Enquiry">Sales Enquiry</option>
                                <option value="Technical Enquiry">Technical Enquiry</option>
                                <option value="Feedback">Feedback</option>
                            </select>
                        </div>
                        <div class="lux-form-field">
                            <textarea aria-required="true" required cols="50" name="input_22" placeholder="Message*" rows="10"></textarea>
                        </div>
                        <button class="lux-submit-button" type="submit">Submit Now</button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Regional Office Cards -->
            <div class="lux-col-right">
                <div class="lux-cards-row">
                    <!-- Card 1: Singapore & Hong Kong -->
                    <div class="lux-card-col">
                        <div class="lux-card">
                            <!-- Singapore -->
                            <div class="lux-branch-block">
                                <h3 class="lux-branch-title">Singapore</h3>
                                <ul class="lux-branch-list">
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-phone-alt"></i></span>
                                        <span><a href="tel:-+65 6278 8588">+65 6278 8588</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-envelope"></i></span>
                                        <span><a href="mailto:sales@luxlight.sg">sales@luxlight.sg</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-map-marker-alt"></i></span>
                                        <span><a href="https://goo.gl/maps/Dw4yiXLRPqzeyszX9" target="_blank" rel="noopener noreferrer">138 Joo Seng Road, #07-00 Singapore 368361</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="far fa-clock"></i></span>
                                        <span class="lux-text">Monday - Friday<br/>9:00am to 6:00pm</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Hong Kong -->
                            <div class="lux-branch-block" style="margin-top: 35px;">
                                <h3 class="lux-branch-title">Hong Kong</h3>
                                <ul class="lux-branch-list">
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-phone-alt"></i></span>
                                        <span><a href="tel:-+852 2511 0022">+852 2511 0022</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-envelope"></i></span>
                                        <span><a href="mailto:sales@luxlight-prosperity.com">sales@luxlight-prosperity.com</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-map-marker-alt"></i></span>
                                        <span><a href="https://goo.gl/maps/HsK3N5VVBk53QGZk8" target="_blank" rel="noopener noreferrer">20/F, Cornell Centre, 50 Wing Tai Road, Chai Wan, Hong Kong</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="far fa-clock"></i></span>
                                        <span class="lux-text">Monday - Friday<br/>9:30am to 6:00pm</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Vietnam & Thailand -->
                    <div class="lux-card-col">
                        <div class="lux-card">
                            <!-- Vietnam -->
                            <div class="lux-branch-block">
                                <h3 class="lux-branch-title">Vietnam</h3>
                                <ul class="lux-branch-list">
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-phone-alt"></i></span>
                                        <span><a href="tel:+84 28 66602739">+84 28 66602739</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-envelope"></i></span>
                                        <span><a href="mailto:sales@luxlight.com.vn">sales@luxlight.com.vn</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-map-marker-alt"></i></span>
                                        <span class="lux-text">Unit 33.05, Landmark 81 Tower<br/>720 Dien Bien Phu Street,<br/>Thanh My Tay Ward<br/>Ho Chi Minh City, Vietnam</span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="far fa-clock"></i></span>
                                        <span class="lux-text">Monday - Friday<br/>9:00am to 6:00pm</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Thailand -->
                            <div class="lux-branch-block" style="margin-top: 20px;">
                                <h3 class="lux-branch-title">Thailand</h3>
                                <ul class="lux-branch-list">
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-phone-alt"></i></span>
                                        <span><a href="tel:+66 80 830 6509">+66 80 830 6509</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-envelope"></i></span>
                                        <span><a href="mailto:sales@luxlight.co.th">sales@luxlight.co.th</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="fas fa-map-marker-alt"></i></span>
                                        <span><a href="https://maps.app.goo.gl/qkKtKMPQp5JqygqF6" target="_blank" rel="noopener noreferrer">546 Rachada One Building, 2nd  Floor, Unit 203, Ratchadaphisek Rd. Chandrakasam, Chatuchak, Bangkok 10900, Thailand</a></span>
                                    </li>
                                    <li class="lux-branch-item">
                                        <span class="lux-icon"><i aria-hidden="true" class="far fa-clock"></i></span>
                                        <span class="lux-text">Monday - Friday<br/>9:00am to 6:00pm</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Map Button under Card 2 matching original -->
                        <div class="lux-map-container">
                            <a class="lux-map-button" href="https://goo.gl/maps/Dw4yiXLRPqzeyszX9" target="_blank" rel="noopener noreferrer">Map</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
