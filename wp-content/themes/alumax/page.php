<?php
if (!defined('ABSPATH')) {
    exit;
}

// 通用页面模板：Privacy Policy / Terms of Supply 等纯内容页面使用

get_header();
?>
  <main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
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
    <article class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin py-12 lg:py-16">
      <div class="alumax-page-content font-body-md text-body-md text-on-surface-variant max-w-3xl space-y-4">
        <?php the_content(); ?>
      </div>
    </article>
    <?php endwhile; endif; ?>
  </main>
  <style>
    .alumax-page-content h2 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 24px;
      line-height: 32px;
      font-weight: 600;
      color: #191c1e;
      margin-top: 2rem;
    }
    .alumax-page-content ul { list-style: disc; padding-left: 1.5rem; }
    .alumax-page-content a { color: #7b5825; text-decoration: underline; }
  </style>
<?php
get_footer();
