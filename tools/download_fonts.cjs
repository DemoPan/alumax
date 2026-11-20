const fs = require('fs');
const path = require('path');

const FONTS_DIR = path.join(__dirname, '..', 'wp-content', 'themes', 'alumax', 'assets', 'fonts');
const CSS_DIR = path.join(__dirname, '..', 'wp-content', 'themes', 'alumax', 'assets', 'css');
const OUTPUT_CSS = path.join(CSS_DIR, 'fonts.css');

if (!fs.existsSync(FONTS_DIR)) fs.mkdirSync(FONTS_DIR, { recursive: true });
if (!fs.existsSync(CSS_DIR)) fs.mkdirSync(CSS_DIR, { recursive: true });

const UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36';

const URLS = [
  'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Manrope:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap',
  'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap'
];

async function downloadBuffer(url) {
  const res = await fetch(url, { headers: { 'User-Agent': UA } });
  if (!res.ok) throw new Error(`Failed to fetch ${url}: ${res.statusText}`);
  return Buffer.from(await res.arrayBuffer());
}

async function run() {
  let combinedCss = '';
  const urlMap = new Map(); // remoteUrl -> localFilename

  for (const url of URLS) {
    console.log(`Fetching CSS from: ${url}`);
    const res = await fetch(url, { headers: { 'User-Agent': UA } });
    if (!res.ok) throw new Error(`HTTP error ${res.status}`);
    const css = await res.text();
    combinedCss += '\n' + css;
  }

  // Find all url(...) in combinedCss
  const urlRegex = /url\((https:\/\/fonts\.gstatic\.com\/[^)]+)\)/g;
  let match;
  let idx = 0;

  while ((match = urlRegex.exec(combinedCss)) !== null) {
    const remoteUrl = match[1];
    if (!urlMap.has(remoteUrl)) {
      idx++;
      const ext = path.extname(new URL(remoteUrl).pathname) || '.woff2';
      // Clean descriptive name
      let filename = `font-${idx}${ext}`;
      if (remoteUrl.includes('materialsymbols')) {
        filename = `material-symbols-variable${ext}`;
      } else if (remoteUrl.includes('jetbrainsmono')) {
        filename = `jetbrains-mono-${idx}${ext}`;
      } else if (remoteUrl.includes('manrope')) {
        filename = `manrope-${idx}${ext}`;
      } else if (remoteUrl.includes('spacegrotesk')) {
        filename = `space-grotesk-${idx}${ext}`;
      }
      urlMap.set(remoteUrl, filename);
    }
  }

  console.log(`Found ${urlMap.size} font files to download...`);

  for (const [remoteUrl, localName] of urlMap.entries()) {
    const targetFile = path.join(FONTS_DIR, localName);
    if (!fs.existsSync(targetFile)) {
      process.stdout.write(`Downloading ${localName}... `);
      const buf = await downloadBuffer(remoteUrl);
      fs.writeFileSync(targetFile, buf);
      console.log(`done (${buf.length} bytes)`);
    } else {
      console.log(`Already exists: ${localName}`);
    }
  }

  // Rewrite URLs in CSS to relative path: ../fonts/<filename>
  let rewrittenCss = combinedCss;
  for (const [remoteUrl, localName] of urlMap.entries()) {
    rewrittenCss = rewrittenCss.split(remoteUrl).join(`../fonts/${localName}`);
  }

  fs.writeFileSync(OUTPUT_CSS, rewrittenCss.trim() + '\n', 'utf-8');
  console.log(`\nSuccessfully created local fonts stylesheet: ${OUTPUT_CSS}`);
}

run().catch(err => {
  console.error('Error downloading fonts:', err);
  process.exit(1);
});
