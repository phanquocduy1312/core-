import re

def main():
    with open("theme/luxlight-lighting-brands/index.html", "r", encoding="utf-8") as f:
        lines = f.readlines()

    # Lines 1811 to 4507 (1-indexed, so 1810 to 4507 in 0-indexed)
    elementor_lines = lines[1810:4507]
    content = "".join(elementor_lines)

    # 1. Remove elementor-invisible
    content = content.replace("elementor-invisible", "")

    # 2. Replace absolute URLs with local / route URLs
    content = content.replace("https://www.luxlight.sg/wp-content", "/wp-content")
    content = content.replace("http://www.luxlight.sg/wp-content", "/wp-content")
    content = content.replace("https://luxlight.sg/wp-content", "/wp-content")

    # Replace navigation links
    content = re.sub(r'href="https?://(?:www\.)?luxlight\.sg/about-luxlight/?"', 'href="{{ route(\'about\') }}"', content)
    content = re.sub(r'href="https?://(?:www\.)?luxlight\.sg/luxlight-lighting-brands/?"', 'href="{{ route(\'brands\') }}"', content)
    content = re.sub(r'href="https?://(?:www\.)?luxlight\.sg/lighting-projects-in-asia/?"', 'href="{{ route(\'projects\') }}"', content)
    content = re.sub(r'href="https?://(?:www\.)?luxlight\.sg/contact-luxlight/?"', 'href="{{ route(\'contact\') }}"', content)
    content = re.sub(r'href="https?://(?:www\.)?luxlight\.sg/?"', 'href="{{ url(\'/\') }}"', content)

    # 3. Clean srcset and sizes on img tags so they do not cause broken image layout
    content = re.sub(r'\s+srcset="[^"]*"', '', content)
    content = re.sub(r'\s+sizes="[^"]*"', '', content)

    blade_template = f"""@extends('layouts.app')

@section('title', 'Brands - LuxLight')
@section('meta_description', 'Wide Range of International Lighting Brands for Your Selection - LuxLight Singapore')

@push('styles')
<link href="/wp-content/uploads/elementor/css/post-2192.css" id="elementor-post-2192-css" media="all" rel="stylesheet"/>
<style>
    /* Brands Hero Banner Overrides */
    .elementor-2192 .elementor-element.elementor-element-7ff2bc8 {{
        background-image: url(/wp-content/uploads/2021/12/Banner_3_1242x621.jpg) !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        min-height: 390px !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
    }}
    .elementor-2192 .elementor-element.elementor-element-cfbae39 .elementor-heading-title {{
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 50.4px !important;
        font-weight: 300 !important;
        line-height: 60.8px !important;
        letter-spacing: -0.6px !important;
        color: #FFFFFF !important;
        text-align: center !important;
    }}
    .elementor-2192 .elementor-element.elementor-element-6a01dff,
    .elementor-2192 .elementor-element.elementor-element-6a01dff .elementor-widget-container {{
        font-family: "Din", sans-serif !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        color: #FFFFFF !important;
        text-align: center !important;
    }}
    .elementor-2192 .elementor-element.elementor-element-e3a7625,
    .elementor-2192 .elementor-element.elementor-element-e3a7625 .elementor-widget-container {{
        font-family: "ACaslonPro", serif, sans-serif !important;
        font-size: 16.8px !important;
        font-weight: 400 !important;
        line-height: 30.24px !important;
        color: #EAA931 !important;
        text-align: center !important;
    }}
    
    /* Background watermark for brand section */
    .elementor-2192 .elementor-element.elementor-element-e4602ea {{
        background-image: url(/wp-content/uploads/2021/12/bg-logo-3-2.jpg) !important;
        background-position: top center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        background-color: #FFFFFF !important;
    }}
    
    /* Ensure Brand Logos & Images maintain clean display */
    .elementor-2192 .elementor-widget-image img {{
        max-width: 100% !important;
        height: auto !important;
        display: block !important;
    }}
</style>
@endpush

@section('content')
{content}
@endsection
"""

    out_path = "resources/views/pages/thuong-hieu.blade.php"
    with open(out_path, "w", encoding="utf-8") as f:
        f.write(blade_template)
    print(f"Successfully generated {out_path} ({len(blade_template)} bytes)!")

if __name__ == "__main__":
    main()
