import os
import subprocess
import time
from PIL import Image

def generate_logos():
    edge_path = r"C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe"
    
    # Target directories
    theme_logo_dir = os.path.abspath("wp-content/themes/alumax/assets/images/logo")
    static_logo_dir = os.path.abspath("static-export/assets/images/logo")
    static_root_dir = os.path.abspath("static-export")
    
    os.makedirs(theme_logo_dir, exist_ok=True)
    os.makedirs(static_logo_dir, exist_ok=True)

    # Base font CSS path
    fonts_css = os.path.abspath("wp-content/themes/alumax/assets/css/fonts.css").replace("\\", "/")

    # Templates
    templates = {
        # 1. Primary Full Lockup on Signature Dark Background
        "logo-400x400-dark.png": {
            "bg_color": "#0d1b2a",
            "html": f"""<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="file:///{fonts_css}">
  <style>
    * {{ box-sizing: border-box; margin: 0; padding: 0; }}
    html, body {{
      width: 400px;
      height: 400px;
      background: #0d1b2a;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      -webkit-font-smoothing: antialiased;
    }}
    .icon-wrap {{
      width: 140px;
      height: 140px;
      display: flex;
      align-items: center;
      justify-content: center;
      filter: drop-shadow(0 6px 20px rgba(0,0,0,0.35));
    }}
    .brand-title {{
      font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
      font-weight: 700;
      color: #ffffff;
      font-size: 28px;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      margin-top: 20px;
      line-height: 1;
      text-align: center;
    }}
    .brand-desc {{
      font-family: 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif;
      font-weight: 600;
      color: #edbe82;
      font-size: 10.5px;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      margin-top: 10px;
      line-height: 1;
      text-align: center;
    }}
  </style>
</head>
<body>
  <div class="icon-wrap">
    <svg width="140" height="140" viewBox="0 0 40 40">
      <defs>
        <linearGradient id="goldGrad" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#ffe4c4"/>
          <stop offset="100%" stop-color="#edbe82"/>
        </linearGradient>
      </defs>
      <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="url(#goldGrad)" stroke-linejoin="round" stroke-linecap="round" stroke-width="3.5"/>
      <path d="M20 14L28 30H12L20 14Z" fill="url(#goldGrad)" fill-opacity="0.88"/>
      <line stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" x1="7.5" x2="32.5" y1="26" y2="26"/>
    </svg>
  </div>
  <div class="brand-title">ALUVIONA</div>
  <div class="brand-desc">Architectural Metal Solutions</div>
</body>
</html>"""
        },

        # 2. Primary Full Lockup on Transparent Background (Light text for dark themes)
        "logo-400x400-transparent.png": {
            "bg_color": "00000000",
            "html": f"""<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="file:///{fonts_css}">
  <style>
    * {{ box-sizing: border-box; margin: 0; padding: 0; }}
    html, body {{
      width: 400px;
      height: 400px;
      background: transparent;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      -webkit-font-smoothing: antialiased;
    }}
    .icon-wrap {{
      width: 140px;
      height: 140px;
      display: flex;
      align-items: center;
      justify-content: center;
    }}
    .brand-title {{
      font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
      font-weight: 700;
      color: #ffffff;
      font-size: 28px;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      margin-top: 20px;
      line-height: 1;
      text-align: center;
    }}
    .brand-desc {{
      font-family: 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif;
      font-weight: 600;
      color: #edbe82;
      font-size: 10.5px;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      margin-top: 10px;
      line-height: 1;
      text-align: center;
    }}
  </style>
</head>
<body>
  <div class="icon-wrap">
    <svg width="140" height="140" viewBox="0 0 40 40">
      <defs>
        <linearGradient id="goldGrad" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#ffe4c4"/>
          <stop offset="100%" stop-color="#edbe82"/>
        </linearGradient>
      </defs>
      <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="url(#goldGrad)" stroke-linejoin="round" stroke-linecap="round" stroke-width="3.5"/>
      <path d="M20 14L28 30H12L20 14Z" fill="url(#goldGrad)" fill-opacity="0.88"/>
      <line stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" x1="7.5" x2="32.5" y1="26" y2="26"/>
    </svg>
  </div>
  <div class="brand-title">ALUVIONA</div>
  <div class="brand-desc">Architectural Metal Solutions</div>
</body>
</html>"""
        },

        # 3. Primary Full Lockup on White Background (Dark text for print / light themes)
        "logo-400x400-white-bg.png": {
            "bg_color": "#ffffff",
            "html": f"""<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="file:///{fonts_css}">
  <style>
    * {{ box-sizing: border-box; margin: 0; padding: 0; }}
    html, body {{
      width: 400px;
      height: 400px;
      background: #ffffff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      -webkit-font-smoothing: antialiased;
    }}
    .icon-wrap {{
      width: 140px;
      height: 140px;
      display: flex;
      align-items: center;
      justify-content: center;
    }}
    .brand-title {{
      font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
      font-weight: 700;
      color: #0d1b2a;
      font-size: 28px;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      margin-top: 20px;
      line-height: 1;
      text-align: center;
    }}
    .brand-desc {{
      font-family: 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif;
      font-weight: 600;
      color: #b88e56;
      font-size: 10.5px;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      margin-top: 10px;
      line-height: 1;
      text-align: center;
    }}
  </style>
</head>
<body>
  <div class="icon-wrap">
    <svg width="140" height="140" viewBox="0 0 40 40">
      <defs>
        <linearGradient id="goldGradLight" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#edbe82"/>
          <stop offset="100%" stop-color="#b88e56"/>
        </linearGradient>
      </defs>
      <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="url(#goldGradLight)" stroke-linejoin="round" stroke-linecap="round" stroke-width="3.5"/>
      <path d="M20 14L28 30H12L20 14Z" fill="url(#goldGradLight)" fill-opacity="0.92"/>
      <line stroke="#0d1b2a" stroke-width="2.2" stroke-linecap="round" x1="7.5" x2="32.5" y1="26" y2="26"/>
    </svg>
  </div>
  <div class="brand-title">ALUVIONA</div>
  <div class="brand-desc">Architectural Metal Solutions</div>
</body>
</html>"""
        },

        # 4. Pure Geometric Emblem / Monogram (Transparent Background)
        "logo-mark-400x400-transparent.png": {
            "bg_color": "00000000",
            "html": f"""<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    * {{ box-sizing: border-box; margin: 0; padding: 0; }}
    html, body {{
      width: 400px;
      height: 400px;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }}
  </style>
</head>
<body>
  <svg width="270" height="270" viewBox="0 0 40 40">
    <defs>
      <linearGradient id="goldMark" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="#ffe4c4"/>
        <stop offset="100%" stop-color="#edbe82"/>
      </linearGradient>
    </defs>
    <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="url(#goldMark)" stroke-linejoin="round" stroke-linecap="round" stroke-width="3.5"/>
    <path d="M20 14L28 30H12L20 14Z" fill="url(#goldMark)" fill-opacity="0.88"/>
    <line stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" x1="7.5" x2="32.5" y1="26" y2="26"/>
  </svg>
</body>
</html>"""
        },

        # 5. Pure Geometric Emblem / Monogram (Dark Background)
        "logo-mark-400x400-dark.png": {
            "bg_color": "#0d1b2a",
            "html": f"""<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    * {{ box-sizing: border-box; margin: 0; padding: 0; }}
    html, body {{
      width: 400px;
      height: 400px;
      background: #0d1b2a;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }}
  </style>
</head>
<body>
  <svg width="270" height="270" viewBox="0 0 40 40" style="filter: drop-shadow(0 8px 30px rgba(0,0,0,0.5));">
    <defs>
      <linearGradient id="goldMark" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="#ffe4c4"/>
        <stop offset="100%" stop-color="#edbe82"/>
      </linearGradient>
    </defs>
    <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="url(#goldMark)" stroke-linejoin="round" stroke-linecap="round" stroke-width="3.5"/>
    <path d="M20 14L28 30H12L20 14Z" fill="url(#goldMark)" fill-opacity="0.88"/>
    <line stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" x1="7.5" x2="32.5" y1="26" y2="26"/>
  </svg>
</body>
</html>"""
        },

        # 6. Official App Icon / Squircle Avatar Badge
        "logo-badge-400x400.png": {
            "bg_color": "00000000",
            "html": f"""<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    * {{ box-sizing: border-box; margin: 0; padding: 0; }}
    html, body {{
      width: 400px;
      height: 400px;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }}
  </style>
</head>
<body>
  <svg width="380" height="380" viewBox="0 0 64 64" style="filter: drop-shadow(0 10px 30px rgba(0,0,0,0.4));">
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
    <rect width="64" height="64" rx="14" fill="url(#aluvionaBg)"/>
    <rect x="0.75" y="0.75" width="62.5" height="62.5" rx="13.25" fill="none" stroke="#25384d" stroke-width="1.5"/>
    <g transform="translate(32, 33) scale(1.28) translate(-20, -18)">
      <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="url(#aluvionaGold)" stroke-linejoin="round" stroke-linecap="round" stroke-width="3.5"/>
      <path d="M20 14L28 30H12L20 14Z" fill="url(#aluvionaGold)" fill-opacity="0.88"/>
      <line stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" x1="7.5" x2="32.5" y1="26" y2="26"/>
    </g>
  </svg>
</body>
</html>"""
        }
    }

    temp_html_path = os.path.abspath("temp_render.html")

    for filename, config in templates.items():
        with open(temp_html_path, "w", encoding="utf-8") as f:
            f.write(config["html"])
        
        target_path = os.path.join(theme_logo_dir, filename)
        
        cmd = [
            edge_path,
            "--headless",
            "--disable-gpu",
            "--no-sandbox",
            f"--window-size=400,400"
        ]
        if config["bg_color"] == "00000000":
            cmd.append("--default-background-color=00000000")
        
        cmd.append(f"--screenshot={target_path}")
        cmd.append(f"file:///{temp_html_path.replace(os.sep, '/')}")
        
        subprocess.run(cmd, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
        time.sleep(0.5)

        # Verify and copy to static export directories
        if os.path.exists(target_path):
            with Image.open(target_path) as im:
                # Ensure exact 400x400
                if im.size != (400, 400):
                    im = im.resize((400, 400), Image.Resampling.LANCZOS)
                    im.save(target_path, "PNG")
                
                # Copy to static-export/assets/images/logo/
                static_target = os.path.join(static_logo_dir, filename)
                im.save(static_target, "PNG")

                # If primary logo, also save directly in static-export root
                if filename in ["logo-400x400-dark.png", "logo-400x400-transparent.png", "logo-badge-400x400.png"]:
                    root_name = filename.replace("-400x400", "")
                    im.save(os.path.join(static_root_dir, filename), "PNG")
                    im.save(os.path.join(static_root_dir, root_name), "PNG")
                    print(f"Exported root: {filename} and {root_name}")

            print(f"Successfully generated: {filename} ({im.size[0]}x{im.size[1]})")
        else:
            print(f"Failed to generate: {filename}")

    if os.path.exists(temp_html_path):
        os.remove(temp_html_path)

if __name__ == "__main__":
    generate_logos()
