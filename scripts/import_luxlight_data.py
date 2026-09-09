#!/usr/bin/env python3
import os
import json
import glob
import pymysql
from bs4 import BeautifulSoup

DB_CONFIG = {
    'host': '127.0.0.1',
    'user': 'db_79e67b75',
    'password': 'QwYPZpVI91LE#b',
    'database': 'db_79e67b75',
    'charset': 'utf8mb4',
    'cursorclass': pymysql.cursors.DictCursor
}

THEME_DIR = "/var/www/vhosts/revoluxasia796.mbws.vn/httpdocs/theme"

def main():
    conn = pymysql.connect(**DB_CONFIG)
    cursor = conn.cursor()

    print("--- 1. Importing Project Categories ---")
    cat_files = glob.glob(os.path.join(THEME_DIR, "wp-json/wp/v2/project_category/*"))
    cat_id_map = {}
    for cf in cat_files:
        try:
            with open(cf, 'r', encoding='utf-8') as f:
                data = json.load(f)
                wp_cat_id = data.get('id')
                name = data.get('name')
                slug = data.get('slug')
                if not name or not slug:
                    continue

                cursor.execute("SELECT id FROM post_categories WHERE slug = %s", (slug,))
                row = cursor.fetchone()
                name_json = json.dumps({"vi": name, "en": name}, ensure_ascii=False)
                desc_json = json.dumps({"vi": f"Dự án {name}", "en": f"{name} Projects"}, ensure_ascii=False)
                
                if row:
                    cat_id_map[wp_cat_id] = row['id']
                else:
                    cursor.execute("""
                        INSERT INTO post_categories (name, slug, description, is_active, created_at, updated_at)
                        VALUES (%s, %s, %s, 1, NOW(), NOW())
                    """, (name_json, slug, desc_json))
                    cat_id_map[wp_cat_id] = cursor.lastrowid
                print(f"Mapped Category [{name}] (WP ID: {wp_cat_id}) -> DB ID: {cat_id_map.get(wp_cat_id)}")
        except Exception as e:
            print(f"Error reading category {cf}: {e}")

    conn.commit()

    print("\n--- 2. Importing All Projects into Posts Table ---")
    project_files = glob.glob(os.path.join(THEME_DIR, "wp-json/wp/v2/projects/*"))
    imported_count = 0

    for pf in project_files:
        try:
            with open(pf, 'r', encoding='utf-8') as f:
                data = json.load(f)
                title = data.get('title', {}).get('rendered', '')
                slug = data.get('slug', '')
                if not slug:
                    continue

                title = title.replace('&#038;', '&').replace('&amp;', '&')

                yoast = data.get('yoast_head_json', {})
                meta_desc = yoast.get('description', '') or ''
                meta_title = yoast.get('title', '') or f"{title} - LuxLight"

                image_url = ""
                og_images = yoast.get('og_image', [])
                if og_images and isinstance(og_images, list) and len(og_images) > 0:
                    img_raw = og_images[0].get('url', '')
                    if img_raw:
                        image_url = img_raw.replace('https://www.luxlight.sg/', '/').replace('http://www.luxlight.sg/', '/')

                wp_cats = data.get('project_category', [])
                db_cat_id = None
                if wp_cats and len(wp_cats) > 0:
                    db_cat_id = cat_id_map.get(wp_cats[0])

                project_html_file = os.path.join(THEME_DIR, f"projects/{slug}/index.html")
                content_html = ""
                if os.path.exists(project_html_file):
                    with open(project_html_file, 'r', encoding='utf-8', errors='ignore') as hf:
                        soup = BeautifulSoup(hf.read(), 'html.parser')
                        for tag in soup.find_all(['header', 'footer', 'script', 'style']):
                            tag.decompose()
                        content_div = soup.find('div', attrs={'data-elementor-type': 'wp-page'}) or soup.find('body')
                        if content_div:
                            content_html = str(content_div)
                
                if not content_html:
                    content_html = f"<p>{meta_desc}</p>"

                title_json = json.dumps({"vi": title, "en": title}, ensure_ascii=False)
                summary_json = json.dumps({"vi": meta_desc, "en": meta_desc}, ensure_ascii=False)
                content_json = json.dumps({"vi": content_html, "en": content_html}, ensure_ascii=False)
                seo_title_json = json.dumps({"vi": meta_title, "en": meta_title}, ensure_ascii=False)
                seo_desc_json = json.dumps({"vi": meta_desc, "en": meta_desc}, ensure_ascii=False)

                cursor.execute("SELECT id FROM posts WHERE slug = %s", (slug,))
                existing_post = cursor.fetchone()

                if existing_post:
                    cursor.execute("""
                        UPDATE posts SET
                            title = %s,
                            summary = %s,
                            content = %s,
                            image_url = %s,
                            category_id = %s,
                            seo_title = %s,
                            seo_description = %s,
                            is_active = 1,
                            published_at = NOW(),
                            updated_at = NOW()
                        WHERE id = %s
                    """, (title_json, summary_json, content_json, image_url, db_cat_id, seo_title_json, seo_desc_json, existing_post['id']))
                    print(f"Updated Project Post: [{title}] ({slug})")
                else:
                    cursor.execute("""
                        INSERT INTO posts (
                            title, slug, summary, content, image_url, category_id,
                            seo_title, seo_description, is_active,
                            views, published_at, created_at, updated_at
                        ) VALUES (
                            %s, %s, %s, %s, %s, %s,
                            %s, %s, 1,
                            0, NOW(), NOW(), NOW()
                        )
                    """, (
                        title_json, slug, summary_json, content_json, image_url, db_cat_id,
                        seo_title_json, seo_desc_json
                    ))
                    print(f"Inserted New Project Post: [{title}] ({slug})")
                
                imported_count += 1
        except Exception as e:
            print(f"Error importing project {pf}: {e}")

    conn.commit()
    print(f"\nSuccessfully imported/updated {imported_count} projects into database posts table!")

    cursor.execute("SELECT COUNT(*) as total FROM posts")
    total_posts = cursor.fetchone()['total']
    print(f"Total posts now in database: {total_posts}")

    cursor.close()
    conn.close()

if __name__ == "__main__":
    main()
