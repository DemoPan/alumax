<?php
if (!defined('ABSPATH')) { exit; }

// 技术参数：左侧规格表卡 + 右侧技术图形（剖面图/电机图等）
// $args:
//   eyebrow, title
//   table_title, table_ref
//   rows     [ [name, value, mono(可选 bool)], ... ]
//   buttons  [ [icon, label, url, style => 'primary'|'muted'], ... ]（表下方按钮）
//   side_cards  [ [title, tag, caption, svg(原始 SVG 标记) 或 image+image_alt], ... ]
// 安装方式已拆分为独立模块（template-parts/product-sections/install.php）
$alumax_s = $args;
?>
<section class="w-full bg-surface-container-low py-16 lg:py-24" id="technical-specifications">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="flex flex-col mb-10">
      <span class="font-label text-xs font-semibold tracking-widest text-secondary uppercase mb-2"><?php echo esc_html($alumax_s['eyebrow']); ?></span>
      <h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
        <?php echo esc_html($alumax_s['title']); ?>
      </h2>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
      <!-- Left: Engineering Spec Table -->
      <div class="lg:col-span-7 flex flex-col bg-surface-container-lowest shadow-sm p-6 sm:p-8">
        <div class="flex items-center justify-between pb-4 border-b border-surface-variant mb-4">
          <span class="font-headline font-bold text-base text-primary"><?php echo esc_html($alumax_s['table_title']); ?></span>
          <?php if (!empty($alumax_s['table_ref'])) : ?>
            <span class="font-label text-xs text-on-surface-variant uppercase"><?php echo esc_html($alumax_s['table_ref']); ?></span>
          <?php endif; ?>
        </div>
        <div class="flex flex-col divide-y divide-surface-container-high text-xs">
          <?php foreach ($alumax_s['rows'] as $alumax_row) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-3 py-3">
              <span class="font-headline font-semibold text-on-surface"><?php echo esc_html($alumax_row['name']); ?></span>
              <span class="sm:col-span-2 <?php echo !empty($alumax_row['mono']) ? 'font-label' : 'font-body'; ?> text-on-surface-variant"><?php echo esc_html($alumax_row['value']); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <?php if (!empty($alumax_s['buttons'])) : ?>
          <div class="flex flex-wrap items-center gap-3 pt-6 mt-4 border-t border-surface-variant">
            <?php foreach ($alumax_s['buttons'] as $alumax_btn) : ?>
              <a class="inline-flex items-center gap-2 px-5 py-3 <?php echo ($alumax_btn['style'] ?? 'primary') === 'primary'
                ? 'bg-primary-container text-on-primary hover:bg-secondary'
                : 'bg-surface-container text-on-surface hover:bg-surface-container-high'; ?> font-headline text-xs font-semibold uppercase tracking-wider transition-colors"
                href="<?php echo esc_url($alumax_btn['url']); ?>">
                <span class="material-symbols-outlined text-[16px]"><?php echo esc_html($alumax_btn['icon']); ?></span>
                <span><?php echo esc_html($alumax_btn['label']); ?></span>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- Right: Engineering Schematic Graphics -->
      <div class="lg:col-span-5 flex flex-col gap-6">
        <?php if (!empty($alumax_s['side_cards'])) : ?>
          <div class="grid grid-cols-1 sm:grid-cols-<?php echo count($alumax_s['side_cards']) > 1 ? '2' : '1'; ?> gap-4">
            <?php foreach ($alumax_s['side_cards'] as $alumax_card) : ?>
              <div class="bg-surface-container-lowest p-4 shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-3">
                  <span class="font-headline font-semibold text-xs text-on-surface"><?php echo esc_html($alumax_card['title']); ?></span>
                  <?php if (!empty($alumax_card['tag'])) : ?>
                    <span class="font-label text-[10px] text-secondary font-bold"><?php echo esc_html($alumax_card['tag']); ?></span>
                  <?php endif; ?>
                </div>
                <?php if (!empty($alumax_card['svg'])) : ?>
                  <div class="h-36 bg-surface-container flex items-center justify-center p-3 relative overflow-hidden">
                    <?php echo $alumax_card['svg']; ?>
                  </div>
                <?php elseif (!empty($alumax_card['image'])) : ?>
                  <div class="h-36 overflow-hidden bg-surface-container-high relative">
                    <img class="w-full h-full object-cover"
                      alt="<?php echo esc_attr($alumax_card['image_alt'] ?? ''); ?>"
                      src="<?php echo esc_url($alumax_card['image']); ?>">
                  </div>
                <?php endif; ?>
                <?php if (!empty($alumax_card['caption'])) : ?>
                  <span class="font-label text-[10px] text-on-surface-variant/80 mt-2"><?php echo esc_html($alumax_card['caption']); ?></span>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
