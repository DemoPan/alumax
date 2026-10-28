<?php
if (!defined('ABSPATH')) { exit; }

// 安装方式：eyebrow/标题/副文 + 安装节点卡片（SVG 技术图优先，其次图片）+ 底部说明
// $args:
//   eyebrow, title, description, note（均可留空）
//   items  [ [svg(原始 SVG 标记, 优先于 image), image, image_alt, tag, title, text], ... ]
$alumax_i = $args;
?>
<section class="w-full bg-surface py-16 lg:py-24" id="installation">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="flex flex-col mb-12">
      <?php if (!empty($alumax_i['eyebrow'])) : ?>
        <span class="font-label text-xs font-semibold tracking-widest text-secondary uppercase mb-2"><?php echo esc_html($alumax_i['eyebrow']); ?></span>
      <?php endif; ?>
      <h2 class="font-headline font-bold text-2xl sm:text-3xl lg:text-4xl text-primary tracking-tight">
        <?php echo esc_html($alumax_i['title']); ?>
      </h2>
      <?php if (!empty($alumax_i['description'])) : ?>
        <p class="font-body text-sm text-on-surface-variant mt-2 max-w-2xl">
          <?php echo esc_html($alumax_i['description']); ?>
        </p>
      <?php endif; ?>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-<?php echo count($alumax_i['items']) >= 4 ? '4' : (count($alumax_i['items']) === 2 ? '2' : '3'); ?> gap-6">
      <?php foreach ($alumax_i['items'] as $alumax_item) : ?>
        <div class="flex flex-col bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow group">
          <?php if (!empty($alumax_item['svg']) || !empty($alumax_item['image'])) : ?>
            <div class="h-44 overflow-hidden bg-surface-container relative p-3 flex items-center justify-center">
              <?php if (!empty($alumax_item['svg'])) : ?>
                <?php echo $alumax_item['svg']; ?>
              <?php else : ?>
                <img class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105"
                  alt="<?php echo esc_attr($alumax_item['image_alt'] ?? ''); ?>"
                  src="<?php echo esc_url($alumax_item['image']); ?>">
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <div class="p-5 flex flex-col flex-1">
            <?php if (!empty($alumax_item['tag'])) : ?>
              <span class="font-label text-[10px] text-secondary font-bold uppercase mb-1"><?php echo esc_html($alumax_item['tag']); ?></span>
            <?php endif; ?>
            <h3 class="font-headline font-bold text-base text-on-surface mb-1"><?php echo esc_html($alumax_item['title']); ?></h3>
            <?php if (!empty($alumax_item['text'])) : ?>
              <p class="font-body text-xs text-on-surface-variant leading-relaxed">
                <?php echo esc_html($alumax_item['text']); ?>
              </p>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php if (!empty($alumax_i['note'])) : ?>
      <p class="font-body text-xs text-on-surface-variant mt-8 max-w-3xl">
        <?php echo esc_html($alumax_i['note']); ?>
      </p>
    <?php endif; ?>
  </div>
</section>
