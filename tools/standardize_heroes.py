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

# 1. page-about.php: pt-24 -> pt-28 and add border-b
def modify_about(c):
    c = c.replace(
        '<section class="relative w-full -mt-20 pt-24 pb-14 bg-primary-container text-on-primary overflow-hidden">',
        '<section class="relative w-full -mt-20 pt-28 pb-14 bg-primary-container text-on-primary overflow-hidden border-b border-white/10">'
    )
    return c

# 2. page-resources.php: Hero section standardization
def modify_resources(c):
    old_hero_start = '<section class="relative w-full bg-primary-container text-on-primary overflow-hidden py-16 lg:py-24">'
    new_hero_start = """<?php $hero_bg = '/wp-content/uploads/steel-wall-panels-hero.jpg'; ?>
      <section class="relative w-full -mt-20 pt-28 pb-14 bg-primary-container text-on-primary overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 z-0 bg-cover bg-center pointer-events-none"
          style="background-image: linear-gradient(to right, rgba(13, 27, 42, 0.94) 0%, rgba(13, 27, 42, 0.84) 60%, rgba(13, 27, 42, 0.92) 100%), url('<?php echo esc_url($hero_bg); ?>');"></div>
        <div class="absolute inset-0 opacity-20 pointer-events-none mix-blend-screen"
          style="background-image: radial-gradient(#d6e4f9 1px, transparent 1px); background-size: 32px 32px;"></div>
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin relative z-10 space-y-6">
          <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'Resources', 'archive_url' => home_url('/resources/'), 'current' => '']); ?>"""
    
    # We replace from old_hero_start down to max-w-[1440px] mx-auto px-margin relative z-10">
    pattern = r'<section class="relative w-full bg-primary-container text-on-primary overflow-hidden py-16 lg:py-24">.*?<div class="max-w-\[1440px\] mx-auto px-margin relative z-10">'
    c = re.sub(pattern, new_hero_start, c, count=1, flags=re.DOTALL)
    
    # Also standardize px-margin to px-margin-mobile md:px-margin across content containers
    c = c.replace('max-w-[1440px] mx-auto px-margin space-y-', 'max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-')
    c = c.replace('max-w-[1440px] mx-auto px-margin flex', 'max-w-[1440px] mx-auto px-margin-mobile md:px-margin flex')
    c = c.replace('max-w-[1440px] mx-auto px-margin grid', 'max-w-[1440px] mx-auto px-margin-mobile md:px-margin grid')
    return c

# 3. archive-news.php: Breadcrumb in Hero slide telemetry
def modify_archive_news(c):
    target = """              <div class="flex items-center gap-3">
                <span
                  class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-secondary-fixed-dim animate-pulse"></span>
                <span class="text-secondary-fixed uppercase tracking-widest font-semibold"><?php echo esc_html($alumax_slide['kicker']); ?></span>
              </div>"""
    replacement = """              <div class="flex items-center gap-3">
                <span
                  class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-secondary-fixed-dim animate-pulse"></span>
                <span class="text-secondary-fixed uppercase tracking-widest font-semibold"><?php echo esc_html($alumax_slide['kicker']); ?></span>
              </div>
              <div>
                <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'News', 'archive_url' => alumax_news_url(), 'current' => '']); ?>
              </div>"""
    c = c.replace(target, replacement)
    return c

# 4. home.php: Hero section standardization
def modify_home(c):
    old_hero = r'<!-- Immersive Editorial Scrim / Header Extension -->\s*<div class="relative w-full bg-primary-container text-on-primary overflow-hidden pb-16">.*?<div class="relative max-w-\[1440px\] mx-auto px-margin pt-12 md:pt-16">'
    new_hero = """<!-- Immersive Editorial Scrim / Header Extension -->
      <section class="relative w-full -mt-20 pt-28 pb-14 bg-primary-container text-on-primary overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 z-0 bg-cover bg-center pointer-events-none"
          style="background-image: linear-gradient(to right, rgba(13, 27, 42, 0.94) 0%, rgba(13, 27, 42, 0.84) 60%, rgba(13, 27, 42, 0.92) 100%), url('/wp-content/uploads/alumax-site-2e42e7ec62.jpg');"></div>
        <div class="absolute inset-0 opacity-20 pointer-events-none mix-blend-screen"
          style="background-image: radial-gradient(#d6e4f9 1px, transparent 1px); background-size: 32px 32px;"></div>
        <div class="relative max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-6">
          <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'News', 'archive_url' => alumax_news_url(), 'current' => '']); ?>"""
    c = re.sub(old_hero, new_hero, c, count=1, flags=re.DOTALL)
    # Close section instead of closing div if matching
    # In home.php, line 64 was </div> </div> for the hero container and outer div
    c = c.replace(
        '        </div>\n      </div>\n      <!-- Featured Spotlight Article',
        '        </div>\n      </section>\n      <!-- Featured Spotlight Article'
    )
    c = c.replace(
        '        </div>\r\n      </div>\r\n      <!-- Featured Spotlight Article',
        '        </div>\r\n      </section>\r\n      <!-- Featured Spotlight Article'
    )
    # Replace px-margin with px-margin-mobile md:px-margin
    c = c.replace('max-w-[1440px] mx-auto px-margin', 'max-w-[1440px] mx-auto px-margin-mobile md:px-margin')
    return c

# 5. single-case.php: Standardize Hero padding and add background layers
def modify_single_case(c):
    # Dead google fallback link replacement
    c = re.sub(
        r"\$fallback_image = 'https://lh3\.googleusercontent\.com/[^']+';",
        "$fallback_image = '/wp-content/uploads/2026/11/case_13_1.jpg';",
        c
    )
    # Hero section standardization
    old_section = r'<!-- 01 / PROJECT HERO -->\s*<section class="w-full text-white relative overflow-hidden py-8 md:py-12 border-b border-white/10"\s*id="project-hero"[^>]*>'
    new_section = """<!-- 01 / PROJECT HERO -->
    <section class="relative w-full -mt-20 pt-28 pb-14 bg-primary-container text-on-primary overflow-hidden border-b border-white/10" id="project-hero">
      <div class="absolute inset-0 z-0 bg-cover bg-center pointer-events-none"
        style="background-image: linear-gradient(to right, rgba(13, 27, 42, 0.94) 0%, rgba(13, 27, 42, 0.84) 60%, rgba(13, 27, 42, 0.92) 100%), url('<?php echo esc_url($hero_bg); ?>');"></div>
      <div class="absolute inset-0 opacity-20 pointer-events-none mix-blend-screen"
        style="background-image: radial-gradient(#d6e4f9 1px, transparent 1px); background-size: 32px 32px;"></div>"""
    c = re.sub(old_section, new_section, c, count=1, flags=re.DOTALL)
    return c

# 6. template-parts/product-sections/hero.php: Margin unification
def modify_product_hero(c):
    c = c.replace('px-6 lg:px-12 pt-28 lg:pt-32 pb-16 lg:pb-24', 'px-margin-mobile md:px-margin pt-28 lg:pt-32 pb-16 lg:pb-24')
    return c

# 7. page.php: Add standard hero section with breadcrumb
def modify_page(c):
    old_code = r'<main class="w-full pt-20 bg-surface min-h-\[calc\(100vh-20rem\)\]">\s*<\?php if \(have_posts\(\)\) : while \(have_posts\(\)\) : the_post\(\); \?>\s*<article class="max-w-\[1440px\] mx-auto px-margin-mobile md:px-margin py-space-xl">\s*<h1 class="font-display-lg text-display-lg text-on-surface tracking-tight mb-space-lg"><\?php the_title\(\); \?></h1>'
    new_code = """<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <!-- HERO -->
    <section class="relative w-full -mt-20 pt-28 pb-14 bg-primary-container text-on-primary overflow-hidden border-b border-white/10">
      <div class="absolute inset-0 opacity-20 pointer-events-none mix-blend-screen"
        style="background-image: radial-gradient(#d6e4f9 1px, transparent 1px); background-size: 32px 32px;"></div>
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin relative z-10 space-y-6">
        <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'Legal', 'archive_url' => '', 'current' => get_the_title()]); ?>
        <div class="space-y-4 max-w-4xl">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-tertiary-container/80 backdrop-blur-md border border-on-tertiary-fixed-variant font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed-dim">
            <span>Corporate Governance</span>
          </div>
          <h1 class="font-display-xl text-display-xl text-white tracking-tight font-bold"><?php the_title(); ?></h1>
        </div>
      </div>
    </section>
    <article class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin py-12 lg:py-16">"""
    c = re.sub(old_code, new_code, c, count=1, flags=re.DOTALL)
    return c

if __name__ == '__main__':
    update_file('wp-content/themes/alumax/page-about.php', modify_about)
    update_file('wp-content/themes/alumax/page-resources.php', modify_resources)
    update_file('wp-content/themes/alumax/archive-news.php', modify_archive_news)
    update_file('wp-content/themes/alumax/home.php', modify_home)
    update_file('wp-content/themes/alumax/single-case.php', modify_single_case)
    update_file('wp-content/themes/alumax/template-parts/product-sections/hero.php', modify_product_hero)
    update_file('wp-content/themes/alumax/page.php', modify_page)
