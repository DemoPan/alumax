<?php
if (!defined('ABSPATH')) { exit; }

// 产品 Hero：深色全幅背景图 + 标题/副标题/描述 + 双按钮 + 底部特性徽章
// $args:
//   bg_image    背景图 URL
//   title       H1（支持 <br>）
//   subtitle    金色副标题
//   description 描述段落
//   primary     [label, url] 金色主按钮
//   secondary   [label, url, icon] 幽灵按钮
//   badges      [ [icon, title, text], ... ] 底部玻璃拟态徽章
$alumax_h = $args;
?>
<section class="relative w-full bg-primary-container overflow-hidden min-h-[580px] lg:min-h-[640px] flex items-center">
  <?php if (!empty($alumax_h['bg_image'])) : ?>
    <div class="absolute inset-0 bg-cover bg-center z-0"
      style="background-image: url('<?php echo esc_url($alumax_h['bg_image']); ?>');"></div>
  <?php endif; ?>
  <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-primary-container/80 to-transparent z-0 opacity-90"></div>
  <div class="absolute inset-0 bg-gradient-to-r from-primary-container via-primary-container/70 to-transparent z-0"></div>

  <div class="relative z-10 max-w-[1440px] mx-auto px-6 lg:px-12 pt-28 lg:pt-32 pb-16 lg:pb-24 w-full flex flex-col justify-between h-full gap-10">
    <?php get_template_part('template-parts/product-breadcrumb', null, array('variant' => 'hero')); ?>
    <div class="max-w-3xl flex flex-col">
      <h1 class="font-headline font-bold text-3xl sm:text-4xl lg:text-5xl text-on-primary leading-tight tracking-tight mb-4">
        <?php echo wp_kses($alumax_h['title'], array('br' => array())); ?>
      </h1>
      <?php if (!empty($alumax_h['subtitle'])) : ?>
        <div class="flex items-center gap-3 mb-5">
          <span class="font-headline font-medium text-lg sm:text-xl text-secondary-fixed"><?php echo esc_html($alumax_h['subtitle']); ?></span>
        </div>
      <?php endif; ?>
      <?php if (!empty($alumax_h['description'])) : ?>
        <p class="font-body text-sm sm:text-base text-primary-fixed-dim leading-relaxed mb-8 max-w-2xl">
          <?php echo esc_html($alumax_h['description']); ?>
        </p>
      <?php endif; ?>
      <div class="flex flex-wrap items-center gap-4">
        <?php if (!empty($alumax_h['primary'])) : ?>
          <a class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-secondary text-on-secondary font-headline text-xs font-semibold uppercase tracking-wider shadow-md hover:bg-secondary-container hover:text-on-secondary-container transition-all duration-200"
            href="<?php echo esc_url($alumax_h['primary']['url']); ?>">
            <span><?php echo esc_html($alumax_h['primary']['label']); ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        <?php endif; ?>
        <?php if (!empty($alumax_h['secondary'])) : ?>
          <a class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-surface-container-highest/20 backdrop-blur-md text-on-primary font-headline text-xs font-semibold uppercase tracking-wider border border-outline-variant/30 shadow-sm hover:bg-surface-container-highest/30 transition-colors"
            href="<?php echo esc_url($alumax_h['secondary']['url']); ?>">
            <?php if (!empty($alumax_h['secondary']['icon'])) : ?>
              <span class="material-symbols-outlined text-[18px]"><?php echo esc_html($alumax_h['secondary']['icon']); ?></span>
            <?php endif; ?>
            <span><?php echo esc_html($alumax_h['secondary']['label']); ?></span>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <?php if (!empty($alumax_h['badges'])) : ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-6 border-t border-outline-variant/30">
        <?php foreach ($alumax_h['badges'] as $alumax_badge) : ?>
          <div class="flex items-center gap-3 p-3 bg-surface-container-lowest/10 backdrop-blur-md border border-outline-variant/20 rounded-sm">
            <div class="w-9 h-9 rounded-sm bg-surface-container-highest/30 flex items-center justify-center text-secondary-fixed shrink-0">
              <span class="material-symbols-outlined text-[20px]"><?php echo esc_html($alumax_badge['icon']); ?></span>
            </div>
            <div class="flex flex-col">
              <span class="font-headline font-semibold text-xs text-on-primary"><?php echo esc_html($alumax_badge['title']); ?></span>
              <span class="font-body text-[11px] text-primary-fixed-dim leading-tight"><?php echo esc_html($alumax_badge['text']); ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
