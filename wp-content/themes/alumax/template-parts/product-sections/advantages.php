<?php
if (!defined('ABSPATH')) { exit; }

// 核心优势：eyebrow/标题/副文 + 横排图文卡片
// $args:
//   eyebrow, title, description（副文可留空）
//   cards  [ [image, image_alt, icon, title, text], ... ]（建议 4 张）
$alumax_a = $args;
?>
<section class="w-full bg-surface py-16 lg:py-24">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="flex flex-col mb-12">
      <span class="font-label text-xs font-semibold tracking-widest text-secondary uppercase mb-2"><?php echo esc_html($alumax_a['eyebrow']); ?></span>
      <h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
        <?php echo esc_html($alumax_a['title']); ?>
      </h2>
      <?php if (!empty($alumax_a['description'])) : ?>
        <p class="font-body text-sm text-on-surface-variant mt-2 max-w-2xl">
          <?php echo esc_html($alumax_a['description']); ?>
        </p>
      <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-<?php echo count($alumax_a['cards']) >= 4 ? '4' : '3'; ?> gap-6">
      <?php foreach ($alumax_a['cards'] as $alumax_card) : ?>
        <div class="flex flex-col bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow group">
          <div class="h-48 overflow-hidden bg-surface-container-high relative">
            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              alt="<?php echo esc_attr($alumax_card['image_alt']); ?>"
              src="<?php echo esc_url($alumax_card['image']); ?>">
          </div>
          <div class="p-6 flex flex-col flex-1">
            <div class="w-9 h-9 rounded-sm bg-surface-container flex items-center justify-center text-secondary mb-3">
              <span class="material-symbols-outlined text-[20px]"><?php echo esc_html($alumax_card['icon']); ?></span>
            </div>
            <h3 class="font-headline font-bold text-base text-on-surface mb-2"><?php echo esc_html($alumax_card['title']); ?></h3>
            <p class="font-body text-xs text-on-surface-variant leading-relaxed">
              <?php echo esc_html($alumax_card['text']); ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
