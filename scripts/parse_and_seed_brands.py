import re
import json
from bs4 import BeautifulSoup

def main():
    print("Reading post-2192.css...")
    with open("public/wp-content/uploads/elementor/css/post-2192.css", "r", encoding="utf-8") as f:
        css = f.read()

    # Map widget ID to background image
    bg_map = {}
    pattern = r"\.elementor-element-([a-z0-9]+)\s+\.elementor-flip-box__front\{[^}]*background-image:\s*url\([\"']?([^\"')]+)[\"']?\)"
    for m in re.finditer(pattern, css):
        bg_map[m.group(1)] = m.group(2)

    print(f"Found {len(bg_map)} background images in post-2192.css")

    print("Reading thuong-hieu.blade.php...")
    with open("resources/views/pages/thuong-hieu.blade.php", "r", encoding="utf-8") as f:
        html = f.read()

    soup = BeautifulSoup(html, "html.parser")
    brand_section = soup.find("section", class_=re.compile(r"brand-btn"))

    brands = []
    seen_names = set()

    if brand_section:
        order = 10
        for col in brand_section.find_all("div", class_=re.compile(r"elementor-col-25")):
            flipbox_widget = col.find("div", class_=re.compile(r"elementor-widget-flip-box"))
            if not flipbox_widget:
                continue

            widget_id = None
            for c in flipbox_widget.get("class", []):
                if c.startswith("elementor-element-"):
                    widget_id = c.replace("elementor-element-", "")
                    break

            showcase_img = bg_map.get(widget_id, "")

            title_tag = flipbox_widget.find("h3", class_="elementor-flip-box__layer__title")
            country = title_tag.get_text(strip=True) if title_tag else ""

            desc_tag = flipbox_widget.find("div", class_="elementor-flip-box__layer__description")
            desc = desc_tag.get_text(separator="\n", strip=True) if desc_tag else ""

            btn_tag = flipbox_widget.find("a", class_="elementor-flip-box__button")
            website = btn_tag.get("href", "") if btn_tag else ""

            logo_widget = col.find("div", class_=re.compile(r"elementor-widget-image"))
            logo_img = ""
            brand_name = ""
            if logo_widget:
                img = logo_widget.find("img")
                if img:
                    logo_img = img.get("src", "")
                    brand_name = img.get("alt", "").strip()

            if not brand_name:
                # Deduce from logo src or desc
                if logo_img:
                    fname = logo_img.split("/")[-1].split(".")[0].split("_")[0]
                    brand_name = fname.capitalize()
                else:
                    brand_name = f"Brand {order // 10}"

            # Clean name
            brand_name = brand_name.title()
            
            # Make sure name is unique
            unique_name = brand_name
            counter = 2
            while unique_name in seen_names:
                unique_name = f"{brand_name} {counter}"
                counter += 1
            seen_names.add(unique_name)

            brands.append({
                "name": unique_name,
                "country": country,
                "description": desc,
                "website_url": website,
                "image_url": logo_img,
                "showcase_image": showcase_img,
                "sort_order": order,
                "is_active": True,
            })
            order += 10

    print(f"Extracted {len(brands)} unique brands!")
    with open("database/seeders/luxlight_brands.json", "w", encoding="utf-8") as f:
        json.dump(brands, f, ensure_ascii=False, indent=2)
    print("Saved to database/seeders/luxlight_brands.json")

if __name__ == "__main__":
    main()
