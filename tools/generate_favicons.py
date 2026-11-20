import os
import shutil
from PIL import Image, ImageDraw

def create_favicons():
    # Target directories
    theme_img_dir = os.path.abspath('wp-content/themes/alumax/assets/images')
    os.makedirs(theme_img_dir, exist_ok=True)
    
    # 1. Generate favicon.svg
    svg_content = """<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
  <defs>
    <linearGradient id="aluvionaBg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#16273b"/>
      <stop offset="100%" stop-color="#0a1420"/>
    </linearGradient>
    <linearGradient id="aluvionaGold" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#ffe4c4"/>
      <stop offset="100%" stop-color="#edbe82"/>
    </linearGradient>
  </defs>
  
  <!-- Container with subtle border -->
  <rect width="64" height="64" rx="14" fill="url(#aluvionaBg)"/>
  <rect x="0.75" y="0.75" width="62.5" height="62.5" rx="13.25" fill="none" stroke="#25384d" stroke-width="1.5"/>

  <!-- Aluviona Architectural Metal A-Geometry -->
  <g transform="translate(32, 33) scale(1.28) translate(-20, -18)">
    <!-- Outer Triangle Structural Frame -->
    <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="url(#aluvionaGold)" stroke-linejoin="round" stroke-linecap="round" stroke-width="3.5"/>
    <!-- Inner Facade Infill -->
    <path d="M20 14L28 30H12L20 14Z" fill="url(#aluvionaGold)" fill-opacity="0.88"/>
    <!-- Horizontal Structural Transom -->
    <line stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" x1="7.5" x2="32.5" y1="26" y2="26"/>
  </g>
</svg>"""

    svg_path = os.path.join(theme_img_dir, 'favicon.svg')
    with open(svg_path, 'w', encoding='utf-8') as f:
        f.write(svg_content)
    print(f"Created: {svg_path}")

    # 2. Render supersampled raster images with Pillow
    CANVAS_SIZE = 2048
    im = Image.new('RGBA', (CANVAS_SIZE, CANVAS_SIZE), (0, 0, 0, 0))
    draw = ImageDraw.Draw(im)

    # Gradient background simulation for container
    # We draw concentric rounded rectangles or linear color interpolation
    draw.rounded_rectangle([48, 48, CANVAS_SIZE - 48, CANVAS_SIZE - 48], radius=440, fill=(13, 27, 42, 255), outline=(37, 56, 77, 255), width=28)

    cx = 1024
    cy = 1060
    S = 39.0

    def pt(x, y):
        return (cx + (x - 20) * S, cy + (y - 17.5) * S)

    p_top = pt(20, 2)
    p_right = pt(37, 32)
    p_left = pt(3, 32)

    gold = (248, 214, 168, 255) # secondary-fixed metallic architectural gold

    # Outer triangle lines
    outer_pts = [p_top, p_right, p_left, p_top]
    draw.line(outer_pts, fill=gold, width=int(3.5 * S), joint='curve')
    r_cap = int(3.5 * S / 2)
    for p in [p_top, p_right, p_left]:
        draw.ellipse([p[0] - r_cap, p[1] - r_cap, p[0] + r_cap, p[1] + r_cap], fill=gold)

    # Inner triangle
    inner_pts = [pt(20, 14), pt(28, 30), pt(12, 30)]
    draw.polygon(inner_pts, fill=(237, 190, 130, 225))

    # Transom line
    p_t1 = pt(7.5, 26)
    p_t2 = pt(32.5, 26)
    w_transom = int(2.2 * S)
    draw.line([p_t1, p_t2], fill=(255, 255, 255, 255), width=w_transom)
    r_t = w_transom // 2
    draw.ellipse([p_t1[0] - r_t, p_t1[1] - r_t, p_t1[0] + r_t, p_t1[1] + r_t], fill=(255, 255, 255, 255))
    draw.ellipse([p_t2[0] - r_t, p_t2[1] - r_t, p_t2[0] + r_t, p_t2[1] + r_t], fill=(255, 255, 255, 255))

    # Save PNG files at multiple standard resolutions
    sizes = {
        'android-chrome-512x512.png': (512, 512),
        'android-chrome-192x192.png': (192, 192),
        'apple-touch-icon.png': (180, 180),
        'favicon-32x32.png': (32, 32),
        'favicon-16x16.png': (16, 16),
    }

    for filename, (w, h) in sizes.items():
        resized = im.resize((w, h), Image.Resampling.LANCZOS)
        out_file = os.path.join(theme_img_dir, filename)
        resized.save(out_file, 'PNG')
        print(f"Created: {out_file}")

    # Save multi-size favicon.ico
    ico_path = os.path.join(theme_img_dir, 'favicon.ico')
    im.save(ico_path, format='ICO', sizes=[(16, 16), (32, 32), (48, 48)])
    print(f"Created: {ico_path}")

    # Copy to root favicon.ico (WordPress Studio root and static-export root)
    root_ico = os.path.abspath('favicon.ico')
    shutil.copy2(ico_path, root_ico)
    print(f"Copied to root: {root_ico}")

    # 3. Create site.webmanifest
    manifest_content = """{
  "name": "Aluviona - Architectural Metal Solutions",
  "short_name": "Aluviona",
  "icons": [
    {
      "src": "/wp-content/themes/alumax/assets/images/android-chrome-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "/wp-content/themes/alumax/assets/images/android-chrome-512x512.png",
      "sizes": "512x512",
      "type": "image/png"
    }
  ],
  "theme_color": "#0d1b2a",
  "background_color": "#0d1b2a",
  "display": "standalone"
}"""
    manifest_path = os.path.join(theme_img_dir, 'site.webmanifest')
    with open(manifest_path, 'w', encoding='utf-8') as f:
        f.write(manifest_content)
    print(f"Created: {manifest_path}")

if __name__ == '__main__':
    create_favicons()
