// 按 section 注释切分设计稿 HTML，输出每节的纯文本 + 图片清单
const fs = require('fs');
const html = fs.readFileSync(process.argv[2], 'utf8');

let m = html.match(/<main[\s\S]*?<\/main>/i) || html.match(/<body[\s\S]*?<\/body>/i);
let s = m ? m[0] : html;

// 找形如 <!-- ==== --> <!-- 标题 --> <!-- ==== --> 的分节标记
const markerRe = /<!--\s*=+\s*-->\s*<!--([\s\S]*?)-->/g;
const marks = [];
let mm;
while ((mm = markerRe.exec(s)) !== null) {
  marks.push({ title: mm[1].trim(), start: mm.index, end: markerRe.lastIndex });
}

const decode = (t) => t
  .replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>')
  .replace(/&quot;/g, '"').replace(/&#0?39;/g, "'").replace(/&nbsp;/g, ' ')
  .replace(/&reg;/g, '®').replace(/&times;/g, '×').replace(/&oslash;/g, 'ø')
  .replace(/&Oslash;/g, 'Ø').replace(/&mu;/g, 'μ').replace(/&deg;/g, '°')
  .replace(/&plusmn;/g, '±').replace(/&sup2;/g, '²').replace(/&sup3;/g, '³')
  .replace(/&#(\d+);/g, (_, n) => String.fromCharCode(n));

function dump(chunk) {
  // 图片
  const imgs = [];
  const imgRe = /<img[^>]*>/gi;
  let im;
  while ((im = imgRe.exec(chunk)) !== null) {
    const tag = im[0];
    const src = (tag.match(/\bsrc="([^"]*)"/) || [])[1] || '';
    const alt = (tag.match(/\b(?:data-)?alt="([^"]*)"/) || [])[1] || '';
    if (src) imgs.push(`  [IMG] ${src}\n        alt: ${decode(alt)}`);
  }
  // 表格行单独保留结构
  let txt = chunk
    .replace(/<script[\s\S]*?<\/script>/gi, '')
    .replace(/<style[\s\S]*?<\/style>/gi, '')
    .replace(/<svg[\s\S]*?<\/svg>/gi, ' [SVG] ')
    .replace(/<!--[\s\S]*?-->/g, ' ')
    .replace(/<\/(tr|p|div|h[1-6]|li|td|th|span|a|button)>/gi, '\n')
    .replace(/<br[^>]*>/gi, ' /BR/ ')
    .replace(/<[^>]+>/g, ' ')
    .replace(/material-symbols-outlined[^>]*>\s*([a-z0-9_]+)\s*\n/gi, '[ICON:$1]\n');
  txt = decode(txt)
    .split('\n')
    .map((l) => l.replace(/\s+/g, ' ').trim())
    .filter((l) => l.length > 0)
    .join('\n  ');
  return { txt, imgs };
}

if (marks.length === 0) {
  const { txt, imgs } = dump(s);
  console.log(txt);
  console.log(imgs.join('\n'));
  process.exit(0);
}

marks.forEach((mk, i) => {
  const end = i + 1 < marks.length ? marks[i + 1].start : s.length;
  const chunk = s.slice(mk.end, end);
  const { txt, imgs } = dump(chunk);
  console.log(`\n##### ${mk.title}`);
  console.log('  ' + txt.slice(0, 4000));
  if (imgs.length) console.log(imgs.join('\n'));
});
