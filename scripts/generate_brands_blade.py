import os
import re
from bs4 import BeautifulSoup

def main():
    print("Reading theme/luxlight-lighting-brands/index.html...")
    with open("theme/luxlight-lighting-brands/index.html", "r", encoding="utf-8") as f:
        html = f.read()

    soup = BeautifulSoup(html, "html.parser")
    elementor_div = soup.find("div", class_=re.compile(r"elementor-2192"))
    if not elementor_div:
        print("Error: elementor-2192 not found!")
        return

    # Clean HTML elements
    for tag in elementor_div.find_all(True):
        classes = tag.get("class", [])
        if "elementor-invisible" in classes:
            classes.remove("elementor-invisible")
            tag["class"] = classes

        if tag.get("data-dce-background-image-url"):
            bg = tag["data-dce-background-image-url"]
            tag["data-dce-background-image-url"] = bg.replace("https://www.luxlight.sg", "").replace("http://www.luxlight.sg", "")

        if tag.name == "img":
            src = tag.get("src", "")
            if src:
                tag["src"] = src.replace("https://www.luxlight.sg", "").replace("http://www.luxlight.sg", "")
            if tag.get("srcset"):
                del tag["srcset"]
            if tag.get("sizes"):
                del tag["sizes"]

        if tag.name == "a":
            href = tag.get("href", "")
            if href:
                if href in ["https://www.luxlight.sg", "https://www.luxlight.sg/"]:
                    tag["href"] = "{{ url('/') }}"
                elif "luxlight.sg/about" in href:
                    tag["href"] = "{{ route('about') }}"
                elif "luxlight.sg/luxlight-lighting-brands" in href or "luxlight.sg/brands" in href:
                    tag["href"] = "{{ route('brands') }}"
                elif "luxlight.sg/lighting-projects-in-asia" in href or "luxlight.sg/projects" in href:
                    tag["href"] = "{{ route('projects') }}"
                elif "luxlight.sg/contact" in href:
                    tag["href"] = "{{ route('contact') }}"
                elif href.startswith("https://www.luxlight.sg/"):
                    rel_link = href.replace("https://www.luxlight.sg", "")
                    tag["href"] = rel_link

    elementor_html = str(elementor_div)
    elementor_html = elementor_html.replace("https://www.luxlight.sg/wp-content", "/wp-content")
    elementor_html = elementor_html.replace("http://www.luxlight.sg/wp-content", "/wp-content")
    elementor_html = elementor_html.replace("https://luxlight.sg/wp-content", "/wp-content")

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
{elementor_html}
@endsection
"""

    out_path = "resources/views/pages/thuong-hieu.blade.php"
    with open(out_path, "w", encoding="utf-8") as f:
        f.write(blade_template)
    print(f"Successfully generated {out_path}!")

if __name__ == "__main__":
    main()
