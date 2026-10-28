<?php
if (!defined('ABSPATH')) { exit; }

// 智能控制：左侧说明 + CTA，右侧运行模式卡（01/02/03 角标）
// $args:
//   eyebrow, title, description
//   cta    [label, url]
//   modes  [ [image, image_alt, tag, title, subtitle, text], ... ]
$alumax_c = $args;
?>
<section class="w-full bg-surface py-16 lg:py-24">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
      <div class="lg:col-span-5 flex flex-col">
        <span class="font-label text-xs font-semibold tracking-widest text-secondary uppercase mb-2"><?php echo esc_html($alumax_c['eyebrow']); ?></span>
        <h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight mb-4">
          <?php echo esc_html($alumax_c['title']); ?>
        </h2>
        <p class="font-body text-sm sm:text-base text-on-surface-variant leading-relaxed mb-6">
          <?php echo esc_html($alumax_c['description']); ?>
        </p>
        <?php if (!empty($alumax_c['cta'])) : ?>
          <div>
            <a class="inline-flex items-center gap-2 px-6 py-3.5 bg-primary-container text-on-primary font-headline text-xs font-semibold uppercase tracking-wider hover:bg-secondary transition-colors"
              href="<?php echo esc_url($alumax_c['cta']['url']); ?>">
              <span><?php echo esc_html($alumax_c['cta']['label']); ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        <?php endif; ?>
      </div>
      <div class="lg:col-span-7">
        <div class="grid grid-cols-1 sm:grid-cols-<?php echo count($alumax_c['modes']) >= 3 ? '3' : '2'; ?> gap-4 relative">
          <?php foreach ($alumax_c['modes'] as $alumax_mode) : ?>
            <div class="flex flex-col bg-surface-container-lowest shadow-sm group">
              <div class="h-44 overflow-hidden bg-surface-container-high relative">
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                  alt="<?php echo esc_attr($alumax_mode['image_alt']); ?>"
                  src="<?php echo esc_url($alumax_mode['image']); ?>">
                <?php if (!empty($alumax_mode['tag'])) : ?>
                  <div class="absolute top-3 left-3 px-2 py-0.5 bg-primary-container text-primary-fixed font-label text-[10px]">
                    <?php echo esc_html($alumax_mode['tag']); ?></div>
                <?php endif; ?>
              </div>
              <div class="p-4 flex flex-col">
                <h3 class="font-headline font-bold text-sm text-on-surface"><?php echo esc_html($alumax_mode['title']); ?></h3>
                <span class="font-label text-[11px] text-secondary font-semibold mt-1"><?php echo esc_html($alumax_mode['subtitle']); ?></span>
                <p class="font-body text-xs text-on-surface-variant mt-2"><?php echo esc_html($alumax_mode['text']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
