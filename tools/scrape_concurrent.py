import urllib.request
import urllib.parse
import ssl
import re
import json
import concurrent.futures

ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

def fetch_single(item):
    idx, url = item
    req = urllib.request.Request(
        url,
        headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}
    )
    try:
        with urllib.request.urlopen(req, context=ctx, timeout=12) as resp:
            html = resp.read().decode('utf-8', errors='ignore')
    except Exception as e:
        print(f"[{idx}] Error: {e}", flush=True)
        return None

    # Title
    t_match = re.search(r'<h1[^>]*>(.*?)</h1>', html, re.DOTALL)
    title = re.sub(r'<[^>]+>', '', t_match.group(1)).strip() if t_match else ''

    # Slice article content
    h1_pos = html.find('<h1')
    footer_pos = html.find('footer')
    if footer_pos == -1:
        footer_pos = len(html)
    article_slice = html[h1_pos:footer_pos] if h1_pos != -1 else html

    # Paragraphs in article slice
    ps = re.findall(r'<p[^>]*>(.*?)</p>', article_slice, re.DOTALL)
    cleaned_ps = []
    for p in ps:
        clean = re.sub(r'<[^>]+>', '', p).strip()
        if clean and not any(k in clean for k in ['Главная', 'Примеры сотрудничества', 'Авторское право', '@qq.com', '+86-', 'провинция Аньхой']):
            cleaned_ps.append(clean)

    # Images
    imgs = re.findall(r'<img[^>]+src=["\']([^"\']+)["\']', article_slice)
    valid_imgs = []
    for img in imgs:
        if 'uploads' in img and not any(k in img for k in ['logo', 'close', 'icon', 'banner', 'sidebar', 'qr']):
            valid_imgs.append(img)

    unique_imgs = []
    for im in valid_imgs:
        if im not in unique_imgs:
            unique_imgs.append(im)

    print(f"[{idx}] Fetched: {title} ({len(cleaned_ps)} p, {len(unique_imgs)} imgs)", flush=True)

    return {
        'id': idx,
        'url': url,
        'title_ru': title,
        'paragraphs_ru': cleaned_ps,
        'images': unique_imgs
    }

def main():
    with open('case_urls.json', 'r', encoding='utf-8') as f:
        urls = json.load(f)

    items = list(enumerate(urls, 1))
    results = []

    print(f"Fetching {len(items)} cases in parallel with 8 threads...", flush=True)
    with concurrent.futures.ThreadPoolExecutor(max_workers=8) as executor:
        for res in executor.map(fetch_single, items):
            if res:
                results.append(res)

    results.sort(key=lambda x: x['id'])
    with open('all_cases_scraped.json', 'w', encoding='utf-8') as f:
        json.dump(results, f, ensure_ascii=False, indent=2)

    print(f"All done! Successfully saved {len(results)} cases to all_cases_scraped.json", flush=True)

if __name__ == '__main__':
    main()
