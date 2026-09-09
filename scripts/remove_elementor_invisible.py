#!/usr/bin/env python3
import os
import glob
import re

VIEWS_DIR = "/var/www/vhosts/revoluxasia796.mbws.vn/httpdocs/resources/views"

def main():
    blade_files = glob.glob(os.path.join(VIEWS_DIR, "**/*.blade.php"), recursive=True)
    count = 0
    for bf in blade_files:
        with open(bf, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Remove elementor-invisible
        new_content = content.replace("elementor-invisible", "")
        if new_content != content:
            with open(bf, 'w', encoding='utf-8') as f:
                f.write(new_content)
            count += 1
    print(f"Removed elementor-invisible class from {count} Blade templates.")

if __name__ == "__main__":
    main()
