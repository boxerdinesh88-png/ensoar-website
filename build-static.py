"""Render the PHP site to plain HTML in docs/ for the GitHub Pages preview.
Usage: python build-static.py [path-to-php.exe]   (the live site on InfinityFree uses the PHP files directly)
"""
import re, shutil, subprocess, sys
from pathlib import Path

php = sys.argv[1] if len(sys.argv) > 1 else 'php'
root = Path(__file__).parent
out = root / 'docs'
shutil.rmtree(out, ignore_errors=True)
for d in ('css', 'js', 'img'):
    shutil.copytree(root / d, out / d)
(out / '.nojekyll').touch()

pages = ['index', 'about', 'services', 'emi-calculator', 'eligibility', 'partner', 'faq', 'contact']
phone = re.search(r"PHONE_RAW\s*=\s*'(\d+)'", (root / 'includes/config.php').read_text(encoding='utf-8')).group(1)
for p in pages:
    html = subprocess.run([php, f'{p}.php'], cwd=root, capture_output=True, check=True).stdout.decode('utf-8')
    assert 'Fatal error' not in html and 'Warning:' not in html, f'PHP error in {p}.php'
    html = re.sub(r'href="([a-z-]+)\.php', r'href="\1.html', html)
    html = html.replace('action="submit.php" method="post"', f'action="#" data-wa="{phone}"')
    (out / f'{p}.html').write_text(html, encoding='utf-8')
print('built', len(pages), 'pages into', out)
