<?php
if (!defined('ABSPATH')) { exit; }

// 色板（Color & Coating）：白底模块，放在技术参数与定制选项之间
// $args:
//   eyebrow, title, description（副文可留空）
//   swatches  [ [color(十六进制色值), name, code, bespoke(填 1 为"定制配色"渐变卡)], ... ]
$alumax_c = $args;
?>
<section class="w-full bg-surface py-16 lg:py-24">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="flex flex-col mb-12">
      <span class="font-label text-xs font-semibold tracking-widest text-secondary uppercase mb-2"><?php echo esc_html($alumax_c['eyebrow']); ?></span>
      <h2 class="font-headline font-bold text-2xl sm:text-3xl text-primary tracking-tight">
        <?php echo esc_html($alumax_c['title']); ?>
      </h2>
      <?php if (!empty($alumax_c['description'])) : ?>
        <p class="font-body text-sm text-on-surface-variant mt-2 max-w-2xl">
          <?php echo esc_html($alumax_c['description']); ?>
        </p>
      <?php endif; ?>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
      <?php foreach ($alumax_c['swatches'] as $alumax_sw) : ?>
        <div class="bg-surface-container-lowest p-3 shadow-sm hover:shadow-md transition-all <?php echo !empty($alumax_sw['bespoke']) ? 'flex flex-col justify-between' : ''; ?>">
          <?php if (!empty($alumax_sw['bespoke'])) : ?>
            <div class="h-24 bg-gradient-to-tr from-secondary via-primary-container to-secondary-fixed w-full mb-3 shadow-inner flex items-center justify-center">
              <span class="material-symbols-outlined text-white text-3xl">palette</span>
            </div>
            <div>
              <div class="font-headline text-xs font-bold text-on-surface"><?php echo esc_html($alumax_sw['name']); ?></div>
              <div class="font-label text-[10px] text-secondary font-bold"><?php echo esc_html($alumax_sw['code']); ?></div>
            </div>
          <?php else : ?>
            <div class="h-24 w-full mb-3 shadow-inner" style="background-color: <?php echo esc_attr($alumax_sw['color']); ?>"></div>
            <div class="font-headline text-xs font-bold text-on-surface"><?php echo esc_html($alumax_sw['name']); ?></div>
            <div class="font-label text-[10px] text-on-surface-variant"><?php echo esc_html($alumax_sw['code']); ?></div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
