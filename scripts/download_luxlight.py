#!/usr/bin/env python3
import os
import re
import sys
import time
import urllib.parse
from concurrent.futures import ThreadPoolExecutor, as_completed
import xml.etree.ElementTree as ET
import requests
from bs4 import BeautifulSoup

BASE_URL = "https://www.luxlight.sg"
OUTPUT_DIR = "/var/www/vhosts/revoluxasia796.mbws.vn/httpdocs/theme"
HEADERS = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36"
}

session = requests.Session()
session.headers.update(HEADERS)

MEDIA_EXTS = ('.jpg', '.jpeg', '.png', '.gif', '.webp', '.svg', '.pdf', '.mp4', '.woff', '.woff2', '.ttf', '.eot')

all_assets_to_download = set()
downloaded_assets_count = 0
saved_pages_count = 0

def fetch_sitemap_urls():
    sitemaps = [
        f"{BASE_URL}/sitemap_index.xml",
        f"{BASE_URL}/page-sitemap.xml",
        f"{BASE_URL}/projects-sitemap.xml",
        f"{BASE_URL}/post-sitemap.xml",
        f"{BASE_URL}/project_category-sitemap.xml",
        f"{BASE_URL}/category-sitemap.xml"
    ]
    html_urls = {f"{BASE_URL}/"}
    asset_urls = set()

    for sm in sitemaps:
        try:
            resp = session.get(sm, timeout=15)
            if resp.status_code == 200:
                root = ET.fromstring(resp.content)
                for elem in root.iter():
                    if elem.tag.endswith('loc') and elem.text:
                        text = elem.text.strip()
                        if text.endswith('.xml'):
                            try:
                                sub_resp = session.get(text, timeout=15)
                                if sub_resp.status_code == 200:
                                    sub_root = ET.fromstring(sub_resp.content)
                                    for sub_elem in sub_root.iter():
                                        if sub_elem.tag.endswith('loc') and sub_elem.text:
                                            loc_val = sub_elem.text.strip()
                                            if BASE_URL in loc_val and not loc_val.endswith('.xml'):
                                                if any(loc_val.lower().endswith(ext) for ext in MEDIA_EXTS):
                                                    asset_urls.add(loc_val)
                                                else:
                                                    html_urls.add(loc_val)
                            except Exception as e:
                                print(f"Error sub-sitemap: {e}")
                        elif BASE_URL in text:
                            if any(text.lower().endswith(ext) for ext in MEDIA_EXTS):
                                asset_urls.add(text)
                            else:
                                html_urls.add(text)
        except Exception as e:
            print(f"Error fetching sitemap {sm}: {e}")

    return html_urls, asset_urls

def url_to_local_path(url):
    parsed = urllib.parse.urlparse(url)
    path = parsed.path
    if path.startswith('/'):
        path = path[1:]
    if not path:
        return "index.html"
    if path.endswith('/'):
        return path + "index.html"
    if '.' not in os.path.basename(path):
        return path + "/index.html"
    return path

def download_single_asset(asset_url):
    global downloaded_assets_count
    if not asset_url or asset_url.startswith('data:'):
        return
    asset_url = urllib.parse.urljoin(BASE_URL, asset_url)
    parsed = urllib.parse.urlparse(asset_url)
    
    if parsed.netloc and parsed.netloc != urllib.parse.urlparse(BASE_URL).netloc:
        if 'wp-content' not in asset_url and 'wp-includes' not in asset_url and 'fonts.googleapis.com' not in parsed.netloc and 'fonts.gstatic.com' not in parsed.netloc:
            return

    rel_path = parsed.path.lstrip('/')
    if not rel_path:
        return
    
    local_file = os.path.join(OUTPUT_DIR, rel_path)
    if os.path.exists(local_file) and os.path.getsize(local_file) > 0:
        downloaded_assets_count += 1
        return

    os.makedirs(os.path.dirname(local_file), exist_ok=True)
    
    try:
        r = session.get(asset_url, timeout=20, stream=True)
        if r.status_code == 200:
            with open(local_file, 'wb') as f:
                for chunk in r.iter_content(chunk_size=16384):
                    f.write(chunk)
            downloaded_assets_count += 1
            
            # If CSS, parse for background urls / fonts
            if rel_path.endswith('.css'):
                try:
                    with open(local_file, 'r', encoding='utf-8', errors='ignore') as f:
                        css_content = f.read()
                    css_urls = re.findall(r'url\s*\(\s*[\'"]?([^\'")]+)[\'"]?\s*\)', css_content)
                    for cu in css_urls:
                        cu = cu.strip()
                        if cu.startswith('data:'):
                            continue
                        full_cu = urllib.parse.urljoin(asset_url, cu)
                        all_assets_to_download.add(full_cu)
                except Exception:
                    pass
    except Exception as e:
        print(f"Failed {asset_url}: {e}")

def process_single_page(page_url):
    global saved_pages_count
    try:
        r = session.get(page_url, timeout=20)
        if r.status_code != 200:
            return
        
        soup = BeautifulSoup(r.content, 'html.parser')
        
        # Stylesheets
        for link in soup.find_all('link'):
            href = link.get('href')
            if href:
                full_href = urllib.parse.urljoin(page_url, href)
                all_assets_to_download.add(full_href)
                if BASE_URL in full_href or href.startswith('/'):
                    p = urllib.parse.urlparse(full_href).path.lstrip('/')
                    link['href'] = '/' + p

        # Scripts
        for script in soup.find_all('script'):
            src = script.get('src')
            if src:
                full_src = urllib.parse.urljoin(page_url, src)
                all_assets_to_download.add(full_src)
                if BASE_URL in full_src or src.startswith('/'):
                    p = urllib.parse.urlparse(full_src).path.lstrip('/')
                    script['src'] = '/' + p

        # Images & Pictures
        for img in soup.find_all(['img', 'source']):
            for attr in ['src', 'srcset', 'data-src', 'data-srcset', 'data-lazy-src', 'data-lazy-srcset']:
                val = img.get(attr)
                if val:
                    if 'srcset' in attr:
                        parts = val.split(',')
                        for part in parts:
                            u = part.strip().split(' ')[0]
                            if u:
                                full_u = urllib.parse.urljoin(page_url, u)
                                all_assets_to_download.add(full_u)
                    else:
                        full_val = urllib.parse.urljoin(page_url, val)
                        all_assets_to_download.add(full_val)
                        if BASE_URL in full_val or val.startswith('/'):
                            p = urllib.parse.urlparse(full_val).path.lstrip('/')
                            img[attr] = '/' + p

        # Style backgrounds
        for elem in soup.find_all(style=True):
            style = elem['style']
            css_urls = re.findall(r'url\s*\(\s*[\'"]?([^\'")]+)[\'"]?\s*\)', style)
            for cu in css_urls:
                if not cu.startswith('data:'):
                    full_cu = urllib.parse.urljoin(page_url, cu)
                    all_assets_to_download.add(full_cu)
                    if BASE_URL in full_cu or cu.startswith('/'):
                        p = urllib.parse.urlparse(full_cu).path.lstrip('/')
                        elem['style'] = elem['style'].replace(cu, '/' + p)

        # Internal links
        for a in soup.find_all('a', href=True):
            href = a['href']
            if href.startswith(BASE_URL) or (href.startswith('/') and not href.startswith('//')):
                full_href = urllib.parse.urljoin(BASE_URL, href)
                parsed_a = urllib.parse.urlparse(full_href)
                p = parsed_a.path
                if not p or p == '/':
                    a['href'] = '/index.html'
                else:
                    if p.endswith('/'):
                        a['href'] = p + 'index.html'
                    elif '.' not in os.path.basename(p):
                        a['href'] = p + '/index.html'

        # Save HTML
        local_rel_path = url_to_local_path(page_url)
        local_file_path = os.path.join(OUTPUT_DIR, local_rel_path)
        os.makedirs(os.path.dirname(local_file_path), exist_ok=True)
        
        with open(local_file_path, 'wb') as f:
            f.write(soup.prettify('utf-8'))
        saved_pages_count += 1
        print(f"Saved: {local_rel_path}")

    except Exception as e:
        print(f"Error {page_url}: {e}")

def main():
    os.makedirs(OUTPUT_DIR, exist_ok=True)
    print("Step 1: Finding all sitemap URLs...")
    html_urls, direct_assets = fetch_sitemap_urls()
    print(f"Discovered {len(html_urls)} HTML pages and {len(direct_assets)} media assets from sitemaps.")
    
    for a in direct_assets:
        all_assets_to_download.add(a)

    print(f"\nStep 2: Concurrently scraping {len(html_urls)} HTML pages...")
    with ThreadPoolExecutor(max_workers=15) as executor:
        futures = [executor.submit(process_single_page, u) for u in html_urls]
        for f in as_completed(futures):
            pass

    print(f"\nStep 3: Concurrently downloading {len(all_assets_to_download)} static assets (images, CSS, JS, fonts)...")
    with ThreadPoolExecutor(max_workers=25) as executor:
        futures = [executor.submit(download_single_asset, a) for a in all_assets_to_download]
        completed = 0
        total = len(futures)
        for f in as_completed(futures):
            completed += 1
            if completed % 50 == 0 or completed == total:
                print(f"Assets progress: {completed}/{total}")

    print("\nStep 4: Downloading any secondary CSS fonts & images...")
    current_assets = list(all_assets_to_download)
    with ThreadPoolExecutor(max_workers=25) as executor:
        futures = [executor.submit(download_single_asset, a) for a in current_assets]
        for f in as_completed(futures):
            pass

    print(f"\n[DONE] Successfully downloaded {saved_pages_count} pages and {len(all_assets_to_download)} assets into theme/!")

if __name__ == "__main__":
    main()
