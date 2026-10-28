<?php
if (!defined('ABSPATH')) { exit; }

// 工程案例：eyebrow/标题 + 右侧"查看全部"链接 + 项目卡（地点角标/名称/系统/面积/年份）
// $args:
//   eyebrow, title
//   link      [label, url]（可留空）
//   projects  [ [image, image_alt, location, title, product, area, year], ... ]
$alumax_p = $args;
?>
<section class="w-full bg-surface-container-low py-16 lg:py-24">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
      <div>
        <span class="font-label text-xs font-semibold tracking-widest text-secondary uppercase mb-2"><?php echo esc_html($alumax_p['eyebrow']); ?></span>
        <h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
          <?php echo esc_html($alumax_p['title']); ?>
        </h2>
      </div>
      <?php if (!empty($alumax_p['link'])) : ?>
        <a class="inline-flex items-center gap-1.5 font-headline text-xs font-semibold uppercase tracking-wider text-secondary hover:text-on-surface transition-colors"
          href="<?php echo esc_url($alumax_p['link']['url']); ?>">
          <span><?php echo esc_html($alumax_p['link']['label']); ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-<?php echo count($alumax_p['projects']) >= 4 ? '4' : '3'; ?> gap-6">
      <?php foreach ($alumax_p['projects'] as $alumax_proj) : ?>
        <div class="flex flex-col bg-surface-container-lowest shadow-sm group">
          <div class="h-56 overflow-hidden bg-surface-container-high relative">
            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              alt="<?php echo esc_attr($alumax_proj['image_alt']); ?>"
              src="<?php echo esc_url($alumax_proj['image']); ?>">
            <?php if (!empty($alumax_proj['location'])) : ?>
              <div class="absolute bottom-3 left-3 px-2 py-1 bg-primary-container/90 text-primary-fixed font-label text-[10px]">
                <?php echo esc_html($alumax_proj['location']); ?></div>
            <?php endif; ?>
          </div>
          <div class="p-5 flex flex-col flex-1">
            <h3 class="font-headline font-bold text-base text-on-surface"><?php echo esc_html($alumax_proj['title']); ?></h3>
            <span class="font-body text-xs text-secondary font-medium mt-1"><?php echo esc_html($alumax_proj['product']); ?></span>
            <div class="mt-4 pt-3 border-t border-surface-container-high flex items-center justify-between font-label text-[11px] text-on-surface-variant">
              <span><?php echo esc_html($alumax_proj['area']); ?></span>
              <span><?php echo esc_html($alumax_proj['year']); ?></span>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
