// 静态站点导出：爬取本地 WordPress (localhost:8881) 全部页面与站内资源，输出到 static-export/
// 用法：node tools/export-static.cjs  （需本地站点正在运行）
const fs = require('fs');
const path = require('path');

const ORIGIN = process.argv[2] || 'http://localhost:8881';
// 生产环境 WordPress 地址：静态站部署后，表单 REST 接口指向它
// 用法：node tools/export-static.cjs http://localhost:8881 https://cms.example.com
const PUBLIC_ORIGIN = process.argv[3] || ORIGIN;
const OUT = path.join(__dirname, '..', 'static-export');
const MAX_PAGES = 500;

const ASSET_RE = /\.(css|js|jpe?g|png|gif|svg|webp|ico|woff2?|ttf|eot|pdf|zip|mp4|webm|avif)(\?|#|$)/i;
const SKIP_RE = /^\/(wp-admin|wp-json|wp-login\.php|xmlrpc\.php|feed)/;
const SKIP_QUERY_RE = /[?&](news_search|news_year|s|p|replytocom|inquiry)=/;

const pageQueue = ['/'];
const seenPages = new Set();
const seenAssets = new Set();
let savedPages = 0;
let savedAssets = 0;
const failures = [];

function outFile(urlPath) {
  return path.join(OUT, decodeURIComponent(urlPath));
}

function write(urlPath, content) {
  const file = outFile(urlPath);
  fs.mkdirSync(path.dirname(file), { recursive: true });
  fs.writeFileSync(file, content);
}

function normalize(raw, base) {
  let u;
  try {
    u = new URL(raw, base);
  } catch {
    return null;
  }
  if (u.origin !== ORIGIN) return null;
  u.hash = '';
  return u;
}

function extractUrls(html, base) {
  const urls = [];
  const attrRe = /(?:href|src)\s*=\s*["']([^"']+)["']/gi;
  let m;
  while ((m = attrRe.exec(html))) urls.push(m[1]);
  const srcsetRe = /srcset\s*=\s*["']([^"']+)["']/gi;
  while ((m = srcsetRe.exec(html))) {
    for (const part of m[1].split(',')) {
      const u = part.trim().split(/\s+/)[0];
      if (u) urls.push(u);
    }
  }
  return urls.map((raw) => normalize(raw, base)).filter(Boolean);
}

async function saveAsset(u) {
  const key = u.pathname;
  if (seenAssets.has(key)) return;
  seenAssets.add(key);
  try {
    const res = await fetch(u.toString());
    if (!res.ok) { failures.push(`${res.status} ${u}`); return; }
    const buf = Buffer.from(await res.arrayBuffer());
    write(u.pathname, buf);
    savedAssets++;
  } catch (e) {
    failures.push(`${u} (${e.message})`);
  }
}

async function crawlPage(urlPath) {
  const url = ORIGIN + urlPath;
  let res;
  try {
    res = await fetch(url);
  } catch (e) {
    failures.push(`${url} (${e.message})`);
    return;
  }
  if (!res.ok) { failures.push(`${res.status} ${url}`); return; }
  const type = res.headers.get('content-type') || '';
  if (!type.includes('text/html')) return;

  let html = await res.text();
  const urls = extractUrls(html, url);

  // 去域名：站内链接与资源全部改写成根相对路径，部署到任意域名根目录即可用
  // 例外：wp-json 接口地址（表单提交用）保留为绝对地址，生产环境指向 PUBLIC_ORIGIN
  const ESC = ORIGIN.replace(/\//g, '\\/');
  const ESC_PUB = PUBLIC_ORIGIN.replace(/\//g, '\\/');
  html = html.split(ESC + '\\/wp-json').join('\x00ESCJSON\x00');
  html = html.split(ORIGIN + '/wp-json').join('\x00JSON\x00');
  html = html.split(ESC).join('\\/');
  html = html.split(ORIGIN).join('');
  html = html.split('\x00ESCJSON\x00').join(ESC_PUB + '\\/wp-json');
  html = html.split('\x00JSON\x00').join(PUBLIC_ORIGIN + '/wp-json');

  const savePath = urlPath.endsWith('/') ? urlPath + 'index.html' : urlPath;
  write(savePath, html);
  savedPages++;

  for (const u of urls) {
    if (SKIP_RE.test(u.pathname)) continue;
    if (ASSET_RE.test(u.pathname)) {
      await saveAsset(u);
    } else if (u.search === '' && !seenPages.has(u.pathname) && !SKIP_QUERY_RE.test(u.search)) {
      seenPages.add(u.pathname);
      pageQueue.push(u.pathname);
    }
  }
}

(async () => {
  fs.rmSync(OUT, { recursive: true, force: true });
  seenPages.add('/');
  while (pageQueue.length) {
    if (savedPages >= MAX_PAGES) break;
    await crawlPage(pageQueue.shift());
  }
  console.log(`pages: ${savedPages}, assets: ${savedAssets}`);
  if (failures.length) {
    console.log('failures:');
    for (const f of failures) console.log('  ' + f);
  }
})();
