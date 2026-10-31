<?php
if (!defined('ABSPATH')) { exit; }

// 公共面包屑：三级（默认）Home / 归档名 / 当前页标题；传 current => '' 时为二级：Home / 归档名
// args:
//   current       当前页标题（默认文章标题）
//   archive_label 归档名（默认 Products，案例页传 Projects）
//   archive_url   归档链接（默认产品归档，案例页传 case 归档链接）
//   variant       'hero' = 深色 Hero 内嵌变体（无独立灰条、无 pt-24，由 Hero 负责与固定导航的间距）
$alumax_breadcrumb_current = array_key_exists('current', $args) ? $args['current'] : get_the_title();
$alumax_breadcrumb_variant = isset($args['variant']) ? $args['variant'] : 'bar';
$alumax_breadcrumb_archive_label = isset($args['archive_label']) ? $args['archive_label'] : 'Products';
$alumax_breadcrumb_archive_url = isset($args['archive_url']) ? $args['archive_url'] : get_post_type_archive_link('product');

if ($alumax_breadcrumb_variant === 'hero') :
?>
<!-- BREADCRUMB（Hero 内嵌深色版） -->
<nav aria-label="Breadcrumb"
  class="flex items-center flex-wrap gap-2 font-label text-xs tracking-wider text-primary-fixed-dim uppercase">
  <a class="hover:text-secondary-fixed transition-colors flex items-center gap-1"
    href="<?php echo esc_url(home_url('/')); ?>">
    <span class="material-symbols-outlined text-sm">home</span> Home
  </a>
  <span class="text-outline">/</span>
  <?php if ($alumax_breadcrumb_current === '') : ?>
    <span class="text-on-primary font-semibold"><?php echo esc_html($alumax_breadcrumb_archive_label); ?></span>
  <?php else : ?>
    <a class="hover:text-secondary-fixed transition-colors"
      href="<?php echo esc_url($alumax_breadcrumb_archive_url); ?>"><?php echo esc_html($alumax_breadcrumb_archive_label); ?></a>
    <span class="text-outline">/</span>
    <span class="text-on-primary font-semibold"><?php echo esc_html($alumax_breadcrumb_current); ?></span>
  <?php endif; ?>
</nav>
<?php
return;
endif;
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
        <span class="text-primary font-semibold"><?php echo esc_html($alumax_breadcrumb_archive_label); ?></span>
      <?php else : ?>
        <a class="hover:text-primary transition-colors"
          href="<?php echo esc_url($alumax_breadcrumb_archive_url); ?>"><?php echo esc_html($alumax_breadcrumb_archive_label); ?></a>
        <span class="text-outline-variant">/</span>
        <span class="text-primary font-semibold"><?php echo esc_html($alumax_breadcrumb_current); ?></span>
      <?php endif; ?>
    </nav>
  </div>
</section>
