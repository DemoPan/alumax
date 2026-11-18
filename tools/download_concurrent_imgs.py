import json
import os
import urllib.request
import urllib.parse
import ssl
import concurrent.futures

ctx = ssl.create_default_context()
ctx.check_hostname = False
ctx.verify_mode = ssl.CERT_NONE

with open('all_cases_scraped.json', 'r', encoding='utf-8') as f:
    cases = json.load(f)

os.makedirs('downloaded_case_images', exist_ok=True)

def download_one(task):
    cid, idx, img_url, dest = task
    if os.path.exists(dest) and os.path.getsize(dest) > 3000:
        return (cid, dest, True)

    candidates = [img_url]
    if 'www.alumveneer.com/wp-content/uploads/' in img_url:
        fname = img_url.split('/')[-1]
        candidates.append(f'https://ecdn.cnyandex.com/9fme7pxx/uploads/{fname}')
    elif 'ecdn.cnyandex.com/9fme7pxx/uploads/' in img_url:
        fname = img_url.split('/')[-1]
        candidates.append(f'https://www.alumveneer.com/wp-content/uploads/{fname}')

    for c in candidates:
        try:
            parsed = urllib.parse.urlsplit(c)
            encoded_path = urllib.parse.quote(parsed.path)
            full_url = urllib.parse.urlunsplit((parsed.scheme, parsed.netloc, encoded_path, parsed.query, parsed.fragment))
            req = urllib.request.Request(full_url, headers={'User-Agent': 'Mozilla/5.0'})
            with urllib.request.urlopen(req, context=ctx, timeout=12) as resp:
                data = resp.read()
                if len(data) > 3000:
                    with open(dest, 'wb') as out_f:
                        out_f.write(data)
                    return (cid, dest, True)
        except Exception:
            pass
    return (cid, dest, False)

def main():
    tasks = []
    for c in cases:
        cid = c['id']
        specific_imgs = [im for im in c['images'] if f"Примеры-сотрудничества{cid}-" in im]
        other_imgs = [im for im in c['images'] if im not in specific_imgs]
        ordered_imgs = specific_imgs + other_imgs
        for idx, img_url in enumerate(ordered_imgs):
            ext = os.path.splitext(img_url)[1] or '.jpg'
            if '?' in ext: ext = ext.split('?')[0]
            fname = f"case_{cid:02d}_{idx+1}{ext}"
            dest = os.path.join('downloaded_case_images', fname)
            tasks.append((cid, idx, img_url, dest))

    print(f"Total images to process: {len(tasks)} with 16 threads...", flush=True)
    with concurrent.futures.ThreadPoolExecutor(max_workers=16) as executor:
        results = list(executor.map(download_one, tasks))

    # Build downloaded map
    downloaded_map = {}
    for c in cases:
        downloaded_map[c['id']] = []

    for cid, dest, success in results:
        if success and os.path.exists(dest) and os.path.getsize(dest) > 3000:
            if dest not in downloaded_map[cid]:
                downloaded_map[cid].append(dest)

    with open('downloaded_images_map.json', 'w', encoding='utf-8') as f:
        json.dump(downloaded_map, f, ensure_ascii=False, indent=2)

    total_downloaded = sum(len(v) for v in downloaded_map.values())
    print(f"Finished! Total images available: {total_downloaded}", flush=True)
    for cid in sorted(downloaded_map.keys()):
        print(f"Case {cid:02d}: {len(downloaded_map[cid])} imgs", flush=True)

if __name__ == '__main__':
    main()
