import re

def update_file(path, modifier_fn):
    with open(path, 'r', encoding='utf-8', errors='ignore') as f:
        content = f.read()
    new_content = modifier_fn(content)
    if new_content != content:
        with open(path, 'w', encoding='utf-8', newline='') as f:
            f.write(new_content)
        print(f"Updated {path}")
    else:
        print(f"No changes in {path}")

# 1. archive-case.php
def modify_archive_case(c):
    # Change hero background image to architectural building picture
    c = re.sub(
        r"\$fallback_image\s*=\s*'[^']+';",
        "$fallback_image = '/wp-content/uploads/pre-insulated-wall-panels-hero-building.jpg';",
        c
    )
    c = re.sub(
        r"\$hero_bg\s*=\s*'[^']+';",
        "$hero_bg = '/wp-content/uploads/pre-insulated-wall-panels-hero-building.jpg';",
        c
    )
    # Add <div class="flex flex-col w-full"> inside <main> if missing
    if '<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">\n  <!-- HERO -->' in c:
        c = c.replace(
            '<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">\n  <!-- HERO -->',
            '<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">\n  <div class="flex flex-col w-full">\n\n    <!-- HERO -->'
        )
        # Close the div before </main>
        c = c.replace('</main>', '  </div>\n</main>')
    elif '<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">\r\n  <!-- HERO -->' in c:
        c = c.replace(
            '<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">\r\n  <!-- HERO -->',
            '<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">\r\n  <div class="flex flex-col w-full">\r\n\r\n    <!-- HERO -->'
        )
        c = c.replace('</main>', '  </div>\r\n</main>')

    # Update section padding: pt-32 pb-12 (48px top, 48px bottom visible)
    c = re.sub(
        r'<section class="relative w-full -mt-20 pt-\d+ pb-\d+ bg-primary-container',
        '<section class="relative w-full -mt-20 pt-32 pb-12 bg-primary-container',
        c
    )
    # Standardize inner container space-y to space-y-6
    c = c.replace('space-y-6 md:space-y-8', 'space-y-6')
    return c

# 2. single-case.php
def modify_single_case(c):
    c = re.sub(
        r"\$fallback_image\s*=\s*'[^']+';",
        "$fallback_image = '/wp-content/uploads/pre-insulated-wall-panels-hero-building.jpg';",
        c
    )
    # Update section padding: pt-32 pb-12
    c = re.sub(
        r'<section class="relative w-full -mt-20 pt-\d+ pb-\d+ bg-primary-container text-on-primary overflow-hidden border-b border-white/10" id="project-hero">',
        '<section class="relative w-full -mt-20 pt-32 pb-12 bg-primary-container text-on-primary overflow-hidden border-b border-white/10" id="project-hero">',
        c
    )
    return c

# 3. page-about.php
def modify_page_about(c):
    # Update section padding: pt-32 pb-12 (48px top visible, 48px bottom visible)
    c = re.sub(
        r'<section class="relative w-full -mt-20 pt-\d+ pb-\d+ bg-primary-container text-on-primary overflow-hidden border-b border-white/10">',
        '<section class="relative w-full -mt-20 pt-32 pb-12 bg-primary-container text-on-primary overflow-hidden border-b border-white/10">',
        c
    )
    # Update space-y-8 to space-y-6 so Breadcrumb -> Badge is 24px (consistent with other pages)
    # and add mt-8 to the metrics grid
    c = c.replace(
        '<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin relative z-10 space-y-8">',
        '<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin relative z-10 space-y-6">'
    )
    c = c.replace(
        '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-px bg-on-tertiary-fixed-variant/50 border border-on-tertiary-fixed-variant shadow-md">',
        '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-px bg-on-tertiary-fixed-variant/50 border border-on-tertiary-fixed-variant shadow-md mt-6 md:mt-8">'
    )
    return c

# 4. archive-news.php
def modify_archive_news(c):
    # 1. Pull breadcrumb to top of #hero-carousel as persistent top-left navigation
    old_top_carousel = r'(<section class="relative w-full h-\[620px\] bg-\[#0d1b2a\] text-white overflow-hidden select-none" id="hero-carousel">\s*<!-- Radial grid background pattern -->\s*<div\s+class="absolute inset-0 opacity-10 bg-\[radial-gradient\(#edbe82_1px,transparent_1px\)\] \[background-size:28px_28px\] pointer-events-none z-10">\s*</div>)'
    
    new_top_carousel = r"""\1
      <!-- Persistent Top-Left Breadcrumb Bar (Standard Position) -->
      <div class="relative z-40 max-w-[1440px] w-full mx-auto px-margin-mobile md:px-margin pt-6">
        <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'News', 'archive_url' => alumax_news_url(), 'current' => '']); ?>
      </div>"""
    c = re.sub(old_top_carousel, new_top_carousel, c, count=1)

    # 2. Remove the breadcrumb from inside the slide telemetry bar
    target_telemetry_breadcrumb = r'<div>\s*<\?php get_template_part\(\'template-parts/product-breadcrumb\', null, \[\'variant\' => \'hero\', \'archive_label\' => \'News\', \'archive_url\' => alumax_news_url\(\), \'current\' => \'\'\]\);\s*\?>\s*</div>'
    c = re.sub(target_telemetry_breadcrumb, '', c)
    return c

# 5. archive-product.php, page-contact.php, page-resources.php: unify to pt-32 pb-12
def modify_other_heroes(c):
    c = re.sub(
        r'<section class="relative w-full -mt-20 pt-\d+ pb-\d+ bg-primary-container text-on-primary overflow-hidden border-b border-white/10">',
        '<section class="relative w-full -mt-20 pt-32 pb-12 bg-primary-container text-on-primary overflow-hidden border-b border-white/10">',
        c
    )
    return c

if __name__ == '__main__':
    update_file('wp-content/themes/alumax/archive-case.php', modify_archive_case)
    update_file('wp-content/themes/alumax/single-case.php', modify_single_case)
    update_file('wp-content/themes/alumax/page-about.php', modify_page_about)
    update_file('wp-content/themes/alumax/archive-news.php', modify_archive_news)
    update_file('wp-content/themes/alumax/archive-product.php', modify_other_heroes)
    update_file('wp-content/themes/alumax/page-contact.php', modify_other_heroes)
    update_file('wp-content/themes/alumax/page-resources.php', modify_other_heroes)
