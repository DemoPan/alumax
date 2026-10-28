<?php
if (!defined('ABSPATH')) { exit; }

// 产品介绍：左图（可选视频按钮浮层）+ 右侧 eyebrow/标题/段落 + 2x2 特性网格
// $args:
//   image, image_alt  左侧大图
//   video_label       视频按钮文案，留空则不显示按钮
//   eyebrow, title, description
//   features  [ [icon, title, text], ... ]（建议 4 个，2x2 网格）
$alumax_i = $args;
?>
<section class="w-full bg-surface-container-low py-16 lg:py-24">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
      <div class="lg:col-span-5 relative group overflow-hidden bg-surface-container shadow-md">
        <img class="w-full h-[360px] sm:h-[420px] object-cover transition-transform duration-500 group-hover:scale-105"
          alt="<?php echo esc_attr($alumax_i['image_alt']); ?>"
          src="<?php echo esc_url($alumax_i['image']); ?>">
        <div class="absolute inset-0 bg-primary-container/20 group-hover:bg-primary-container/30 transition-colors"></div>
        <?php if (!empty($alumax_i['video_label'])) : ?>
          <button class="absolute bottom-6 left-6 inline-flex items-center gap-3 px-5 py-3 bg-surface-container-lowest/95 backdrop-blur-md text-on-surface hover:text-secondary shadow-lg font-headline text-xs font-semibold uppercase tracking-wider transition-all"
            type="button">
            <span class="w-7 h-7 rounded-full bg-primary-container text-on-primary flex items-center justify-center">
              <span class="material-symbols-outlined text-[16px] translate-x-0.5">play_arrow</span>
            </span>
            <span><?php echo esc_html($alumax_i['video_label']); ?></span>
          </button>
        <?php endif; ?>
      </div>
      <div class="lg:col-span-7 flex flex-col">
        <span class="font-label text-xs font-semibold tracking-widest text-secondary uppercase mb-2"><?php echo esc_html($alumax_i['eyebrow']); ?></span>
        <h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight mb-4">
          <?php echo esc_html($alumax_i['title']); ?>
        </h2>
        <p class="font-body text-sm sm:text-base text-on-surface-variant leading-relaxed mb-8">
          <?php echo esc_html($alumax_i['description']); ?>
        </p>
        <?php if (!empty($alumax_i['features'])) : ?>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <?php foreach ($alumax_i['features'] as $alumax_feat) : ?>
              <div class="flex items-start gap-4 p-4 bg-surface-container-lowest shadow-sm">
                <div class="w-10 h-10 bg-surface-container-high flex items-center justify-center text-primary-container shrink-0">
                  <span class="material-symbols-outlined text-[22px]"><?php echo esc_html($alumax_feat['icon']); ?></span>
                </div>
                <div class="flex flex-col">
                  <h3 class="font-headline font-bold text-sm text-on-surface"><?php echo esc_html($alumax_feat['title']); ?></h3>
                  <p class="font-body text-xs text-on-surface-variant mt-0.5"><?php echo esc_html($alumax_feat['text']); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
