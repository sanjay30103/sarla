#!/bin/bash
# Renders the PHP pages to plain HTML in dist/ (for GitHub Pages or any static host).
set -euo pipefail
cd "$(dirname "$0")"

npm run build --silent

rm -rf dist
mkdir -p dist/assets/css
cp -R assets/img assets/js dist/assets/
cp assets/css/style.css dist/assets/css/
touch dist/.nojekyll

for page in index menu our-story contact book; do
  SARLA_STATIC=1 php -d display_errors=stderr "$page.php" \
    | sed -E 's/(href|action)="([a-z-]+)\.php/\1="\2.html/g' > "dist/$page.html"
done

echo "Static site written to dist/"
