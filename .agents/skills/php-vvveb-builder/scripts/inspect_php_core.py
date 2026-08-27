#!/usr/bin/env python3
"""Create a compact inventory of an existing PHP project before VvvebJs integration."""

from __future__ import annotations

import argparse
import json
import os
from pathlib import Path

SKIP_DIRS = {
    ".git", ".idea", ".vscode", "vendor", "node_modules", "storage/logs",
    "cache", ".cache", "dist", "build"
}

IMPORTANT_NAMES = {
    "composer.json", "composer.lock", ".htaccess", "index.php", "routes.php",
    "web.php", "api.php", "config.php", "database.php", "bootstrap.php"
}

KEYWORDS = {
    "router": ["route", "router"],
    "auth": ["auth", "login", "session", "middleware", "permission", "role"],
    "admin": ["admin", "dashboard"],
    "media": ["media", "upload", "image", "attachment", "file"],
    "page": ["page", "content", "cms"],
    "database": ["database", "db", "model", "repository", "migration"],
    "view": ["view", "template", "layout"],
}


def skipped(rel: Path) -> bool:
    rel_s = rel.as_posix().lower()
    return any(rel_s == x or rel_s.startswith(x + "/") for x in SKIP_DIRS)


def scan(root: Path, max_files: int) -> dict:
    files = []
    categories = {k: [] for k in KEYWORDS}
    php_count = 0

    for current, dirs, names in os.walk(root):
        cur = Path(current)
        rel_dir = cur.relative_to(root)
        dirs[:] = [d for d in dirs if not skipped(rel_dir / d)]

        for name in names:
            rel = rel_dir / name
            if skipped(rel):
                continue
            suffix = Path(name).suffix.lower()
            if suffix == ".php":
                php_count += 1

            low = rel.as_posix().lower()
            is_interesting = name.lower() in IMPORTANT_NAMES or suffix in {".php", ".json", ".yaml", ".yml"}
            if is_interesting and len(files) < max_files:
                files.append(rel.as_posix())

            for category, words in KEYWORDS.items():
                if any(word in low for word in words) and len(categories[category]) < 30:
                    categories[category].append(rel.as_posix())

    composer = None
    composer_path = root / "composer.json"
    if composer_path.exists():
        try:
            composer = json.loads(composer_path.read_text(encoding="utf-8"))
        except Exception as exc:  # report, do not fail inventory
            composer = {"_error": str(exc)}

    top_dirs = sorted([p.name for p in root.iterdir() if p.is_dir() and p.name not in SKIP_DIRS])

    return {
        "root": str(root.resolve()),
        "php_file_count": php_count,
        "top_level_directories": top_dirs,
        "composer": composer,
        "candidate_files": files,
        "signals": categories,
    }


def main() -> None:
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument("project", help="Path to PHP project root")
    parser.add_argument("--max-files", type=int, default=200)
    parser.add_argument("--output", help="Optional JSON output file")
    args = parser.parse_args()

    root = Path(args.project).expanduser().resolve()
    if not root.is_dir():
        raise SystemExit(f"Project directory not found: {root}")

    result = scan(root, max(20, args.max_files))
    text = json.dumps(result, indent=2, ensure_ascii=False)

    if args.output:
        Path(args.output).write_text(text + "\n", encoding="utf-8")
    else:
        print(text)


if __name__ == "__main__":
    main()
