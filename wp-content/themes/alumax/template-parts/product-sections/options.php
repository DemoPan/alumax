<?php
if (!defined('ABSPATH')) { exit; }

// 定制选项：eyebrow/标题/副文 + 图文卡片（技术图用 contain 模式）
// $args:
//   eyebrow, title, description（副文可留空）
//   cards  [ [image, image_alt, svg(原始 SVG 标记, 优先于 image), contain(bool, 技术线图置 true), title, text], ... ]
$alumax_o = $args;
?>
<section class="w-full bg-surface-container-low py-16 lg:py-24">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="flex flex-col mb-12">
      <span class="font-label text-xs font-semibold tracking-widest text-secondary uppercase mb-2"><?php echo esc_html($alumax_o['eyebrow']); ?></span>
      <h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
        <?php echo esc_html($alumax_o['title']); ?>
      </h2>
      <?php if (!empty($alumax_o['description'])) : ?>
        <p class="font-body text-sm text-on-surface-variant mt-2 max-w-2xl">
          <?php echo esc_html($alumax_o['description']); ?>
        </p>
      <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-<?php echo count($alumax_o['cards']) >= 4 ? '4' : '3'; ?> gap-6">
      <?php foreach ($alumax_o['cards'] as $alumax_card) : ?>
        <div class="flex flex-col bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow group">
          <?php if (!empty($alumax_card['svg']) || !empty($alumax_card['image'])) : ?>
            <div class="h-48 overflow-hidden bg-surface-container relative <?php echo !empty($alumax_card['contain']) ? 'p-4' : 'p-2'; ?> flex items-center justify-center">
              <?php if (!empty($alumax_card['svg'])) : ?>
                <?php echo $alumax_card['svg']; ?>
              <?php else : ?>
                <img class="w-full h-full <?php echo !empty($alumax_card['contain']) ? 'object-contain' : 'object-cover'; ?> transition-transform duration-500 group-hover:scale-105"
                  alt="<?php echo esc_attr($alumax_card['image_alt']); ?>"
                  src="<?php echo esc_url($alumax_card['image']); ?>">
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <div class="p-5 flex flex-col flex-1">
            <h3 class="font-headline font-bold text-base text-on-surface mb-1"><?php echo esc_html($alumax_card['title']); ?></h3>
            <p class="font-body text-xs text-on-surface-variant leading-relaxed">
              <?php echo esc_html($alumax_card['text']); ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
