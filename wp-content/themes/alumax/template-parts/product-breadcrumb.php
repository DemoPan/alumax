<?php
if (!defined('ABSPATH')) { exit; }

// 三级（默认）：Home / Products / 当前页标题；传 current => '' 时为二级：Home / Products
$alumax_breadcrumb_current = array_key_exists('current', $args) ? $args['current'] : get_the_title();
?>
<!-- BREADCRUMB -->
<section class="w-full bg-surface-container-low border-b border-surface-variant">
  <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin pt-24 pb-4">
    <nav aria-label="Breadcrumb"
      class="flex items-center flex-wrap gap-2 text-on-surface-variant font-label-sm text-label-sm">
      <a class="hover:text-primary transition-colors flex items-center gap-1"
        href="<?php echo esc_url(home_url('/')); ?>">
        <span class="material-symbols-outlined text-sm">home</span> Home
      </a>
      <span class="text-outline-variant">/</span>
      <?php if ($alumax_breadcrumb_current === '') : ?>
        <span class="text-primary font-semibold">Products</span>
      <?php else : ?>
        <a class="hover:text-primary transition-colors"
          href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Products</a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-semibold"><?php echo esc_html($alumax_breadcrumb_current); ?></span>
      <?php endif; ?>
    </nav>
  </div>
</section>
