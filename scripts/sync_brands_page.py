import os
import re
import subprocess
import requests
from bs4 import BeautifulSoup

headers = {"User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64)"}

def main():
    with open("theme/luxlight-lighting-brands/index.html", "r", encoding="utf-8") as f:
        html = f.read()

    soup = BeautifulSoup(html, "html.parser")
    elementor_div = soup.find("div", class_=re.compile(r"elementor-2192"))

    if not elementor_div:
        print("Error: elementor-2192 not found")
        return

    # Collect URLs
    urls = set()
    for img in elementor_div.find_all("img"):
        if img.get("src"):
            urls.add(img.get("src"))
        if img.get("data-src"):
            urls.add(img.get("data-src"))

    for elem in elementor_div.find_all(attrs={"data-dce-background-image-url": True}):
        urls.add(elem["data-dce-background-image-url"])

    css_path = "public/wp-content/uploads/elementor/css/post-2192.css"
    if os.path.exists(css_path):
        with open(css_path, "r", encoding="utf-8") as f:
            css_text = f.read()
        for match in re.findall(r"url\([\"']?([^\"')]+)[\"']?\)", css_text):
            urls.add(match)

    print(f"Total asset URLs found: {len(urls)}")

    downloaded = 0
    for u in sorted(urls):
        u_clean = u.split("?")[0].split("#")[0]
        if not any(u_clean.lower().endswith(ext) for ext in [".jpg", ".png", ".jpeg", ".webp", ".svg", ".woff", ".woff2"]):
            continue

        rel = u_clean
        if "luxlight.sg/" in rel:
            rel = rel.split("luxlight.sg/")[1]
        elif rel.startswith("/"):
            rel = rel[1:]

        local_path = os.path.join("public", rel)

        need_download = False
        if not os.path.exists(local_path):
            need_download = True
        else:
            try:
                out = subprocess.check_output(["file", local_path]).decode("utf-8")
                if "data" in out and not any(k in out for k in ["image data", "PNG image", "JPEG image", "WebP", "GIF", "SVG", "Font", "font"]):
                    need_download = True
            except Exception:
                need_download = True

        if need_download:
            os.makedirs(os.path.dirname(local_path), exist_ok=True)
            fetch_url = f"https://www.luxlight.sg/{rel}"
            try:
                r = requests.get(fetch_url, timeout=15, headers=headers)
                if r.status_code == 200 and len(r.content) > 50:
                    with open(local_path, "wb") as f:
                        f.write(r.content)
                    print(f"Downloaded: {rel} ({len(r.content)} bytes)")
                    downloaded += 1
                else:
                    print(f"Failed HTTP {r.status_code}: {fetch_url}")
            except Exception as e:
                print(f"Error fetching {fetch_url}: {e}")

    print(f"Finished assets sync. Total downloaded/fixed: {downloaded}")

if __name__ == "__main__":
    main()
