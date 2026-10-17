<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
  <main class="w-full pt-20 bg-surface min-h-screen">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin py-space-xl">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article <?php post_class('mb-space-xl'); ?>>
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-space-sm">
              <a class="hover:text-secondary transition-colors" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="font-body-md text-body-md text-on-surface-variant">
              <?php the_excerpt(); ?>
            </div>
          </article>
        <?php endwhile; ?>
        <?php the_posts_pagination(); ?>
      <?php else : ?>
        <p class="font-body-md text-body-md text-on-surface-variant">Nothing found.</p>
      <?php endif; ?>
    </div>
  </main>
<?php
get_footer();
