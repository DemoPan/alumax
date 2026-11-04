<?php
if (!defined('ABSPATH')) {
    exit;
}

// 通用页面模板：Privacy Policy / Terms of Supply 等纯内容页面使用

get_header();
?>
  <main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin py-space-xl">
      <h1 class="font-display-lg text-display-lg text-on-surface tracking-tight mb-space-lg"><?php the_title(); ?></h1>
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
