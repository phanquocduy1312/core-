#!/usr/bin/env python3
import os
import re
import glob

PUBLIC_DIR = "/var/www/vhosts/revoluxasia796.mbws.vn/httpdocs/public"
VIEWS_DIR = "/var/www/vhosts/revoluxasia796.mbws.vn/httpdocs/resources/views"

def replace_luxlight_urls_in_file(file_path):
    try:
        with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
            content = f.read()
        
        # Replace absolute domain with relative root path
        new_content = content.replace("https://www.luxlight.sg/", "/")
        new_content = new_content.replace("http://www.luxlight.sg/", "/")
        new_content = new_content.replace("https:\\/\\/www.luxlight.sg\\/", "\\/")
        new_content = new_content.replace("http:\\/\\/www.luxlight.sg\\/", "\\/")
        new_content = new_content.replace("https://luxlight.sg/", "/")
        new_content = new_content.replace("http://luxlight.sg/", "/")

        if new_content != content:
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            return True
    except Exception as e:
        print(f"Error processing {file_path}: {e}")
    return False

def main():
    print("--- 1. Replacing absolute luxlight.sg URLs in all CSS & JS files ---")
    css_files = glob.glob(os.path.join(PUBLIC_DIR, "**/*.css"), recursive=True)
    js_files = glob.glob(os.path.join(PUBLIC_DIR, "**/*.js"), recursive=True)
    blade_files = glob.glob(os.path.join(VIEWS_DIR, "**/*.blade.php"), recursive=True)

    count = 0
    for f in css_files + js_files + blade_files:
        if replace_luxlight_urls_in_file(f):
            count += 1
    print(f"Updated {count} files with local relative URLs.")

    print("\n--- 2. Fixing app.blade.php (Remove reCAPTCHA badge & clean up styles) ---")
    app_blade = os.path.join(VIEWS_DIR, "layouts/app.blade.php")
    with open(app_blade, 'r', encoding='utf-8') as f:
        app_content = f.read()

    # Remove reCAPTCHA script
    app_content = re.sub(r'<script\s+src="https://www\.google\.com/recaptcha/api\.js[^"]*"></script>', '', app_content)
    app_content = re.sub(r'<script\s+src="https://www\.google\.com/recaptcha/[^"]*"></script>', '', app_content)
    
    # Hide .grecaptcha-badge if any
    custom_css = """
    <style>
        .grecaptcha-badge { display: none !important; }
        
        /* Swiper Showcase Slide Background Fixes */
        .elementor-repeater-item-b09b786 .swiper-slide-bg {
            background-image: url(/wp-content/uploads/2021/12/Grand_2000x1250.jpg) !important;
            background-size: cover !important;
            background-position: center !important;
        }
        .elementor-repeater-item-36dc570 .swiper-slide-bg {
            background-image: url(/wp-content/uploads/2021/12/Slide-4.jpg) !important;
            background-size: cover !important;
            background-position: center !important;
        }
        .elementor-repeater-item-0964814 .swiper-slide-bg {
            background-image: url(/wp-content/uploads/2021/12/Grand-Colombo_1498x936.jpg) !important;
            background-size: cover !important;
            background-position: center !important;
        }
        .elementor-repeater-item-d980b84 .swiper-slide-bg {
            background-image: url(/wp-content/uploads/2021/12/Dining-7.jpg) !important;
            background-size: cover !important;
            background-position: center !important;
        }
        
        /* Hero Section Slider Background */
        .index-hero figure {
            background-image: url(/wp-content/uploads/2021/12/Night_10000x4464-scaled.jpg) !important;
        }
        .index-hero .separador {
            background-image: url(/wp-content/uploads/2021/12/Night_10000x4464-1-scaled.jpg) !important;
        }
        
        /* Background overlays */
        .elementor-element-88227d1 {
            background-image: url(/wp-content/uploads/2021/12/bg-logo-3.jpg) !important;
            background-repeat: no-repeat !important;
        }
        .elementor-element-2afe5b48 {
            background-image: url(/wp-content/uploads/2021/12/bg-logo-1.png) !important;
            background-repeat: no-repeat !important;
        }
        .elementor-element-aa0364c {
            background-image: url(/wp-content/uploads/2021/12/1111111.png) !important;
        }
        .elementor-element-e2ea0c3 {
            background-image: url(/wp-content/uploads/2021/12/bg-cta.jpg) !important;
            background-size: cover !important;
        }
        
        /* Swiper slider buttons visibility */
        .elementor-swiper-button {
            color: #AB9A71 !important;
            cursor: pointer !important;
            z-index: 10 !important;
        }
        .elementor-swiper-button svg {
            fill: #AB9A71 !important;
        }
        .project-carousel-home .swiper-slide {
            height: 480px !important;
        }
        .project-carousel-home .swiper-slide-contents {
            position: relative;
            z-index: 5;
        }
    </style>
    """
    
    if '</head>' in app_content:
        app_content = app_content.replace('</head>', f'{custom_css}\n</head>')

    with open(app_blade, 'w', encoding='utf-8') as f:
        f.write(app_content)
    print("Updated layouts/app.blade.php with clean CSS & removed reCAPTCHA.")

if __name__ == "__main__":
    main()
