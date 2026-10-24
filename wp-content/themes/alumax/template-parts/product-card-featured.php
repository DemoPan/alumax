<?php
if (!defined('ABSPATH')) { exit; }

$alumax_card_img = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: alumax_product_fallback_image();
$alumax_card_specs = alumax_product_specs(get_the_ID());
$alumax_card_terms = get_the_terms(get_the_ID(), 'product_category');
$alumax_card_cats = ($alumax_card_terms && !is_wp_error($alumax_card_terms)) ? implode(' ', wp_list_pluck($alumax_card_terms, 'slug')) : '';
$alumax_card_specs_text = '';
foreach ($alumax_card_specs as $alumax_spec) {
    $alumax_card_specs_text .= $alumax_spec['name'] . ' ' . $alumax_spec['value'] . ' | ';
}
// badge=false 时隐藏 FEATURED 徽章与 Flagship System 标签行（列表模式下非首张卡）
$alumax_card_badge = array_key_exists('badge', $args) ? (bool) $args['badge'] : true;
?>
<!-- FEATURED CARD: <?php echo esc_html(get_the_title()); ?> -->
<div
  class="product-item product-card--featured lg:col-span-2 bg-[#0d1b2a] text-white rounded-2xl overflow-hidden shadow-2xl border border-white/10 flex flex-col justify-between group"
  data-categories="<?php echo esc_attr($alumax_card_cats); ?>"
  data-specs="<?php echo esc_attr(strtolower(trim($alumax_card_specs_text))); ?>">
  <div class="grid grid-cols-1 md:grid-cols-12 h-full">
    <!-- Image half -->
    <div class="md:col-span-6 relative min-h-[300px] md:min-h-full bg-black overflow-hidden">
      <img alt="<?php echo esc_attr(get_the_title()); ?>"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
        src="<?php echo esc_url($alumax_card_img); ?>">
      <div
        class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-transparent via-[#0d1b2a]/40 to-[#0d1b2a]">
      </div>
      <?php if ($alumax_card_badge) : ?>
      <div class="absolute top-4 left-4 flex items-center gap-2">
        <span
          class="bg-secondary text-on-secondary font-label-sm text-label-sm font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow">
          FEATURED FLAGSHIP SYSTEM
        </span>
      </div>
      <?php endif; ?>
    </div>
    <!-- Content half -->
    <div class="md:col-span-6 p-6 md:p-8 flex flex-col justify-between space-y-6">
      <div class="space-y-4">
        <?php if ($alumax_card_badge) : ?>
        <div class="flex items-center justify-between pb-2 border-b border-white/10">
          <span
            class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider font-semibold">Flagship
            System</span>
        </div>
        <?php endif; ?>
        <h3 class="font-display-lg text-headline-lg uppercase font-bold text-white leading-tight">
          <?php the_title(); ?>
        </h3>
        <div class="font-body-sm text-body-sm text-slate-300">
          <?php echo esc_html(alumax_product_card_desc()); ?>
        </div>
        <?php if (!empty($alumax_card_specs)) : ?>
        <!-- Quick spec indicators -->
        <div class="grid grid-cols-2 gap-3 font-label-sm text-label-sm">
          <?php foreach ($alumax_card_specs as $alumax_spec) : ?>
          <div class="bg-white/5 p-2.5 rounded border border-white/10">
            <span class="text-slate-400 block text-[11px] uppercase"><?php echo esc_html($alumax_spec['name']); ?>:</span>
            <span class="text-white font-semibold"><?php echo esc_html($alumax_spec['value']); ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <!-- Buttons -->
      <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-white/10">
        <a class="flex-1 inline-flex items-center justify-center gap-2 h-11 bg-secondary hover:bg-secondary/90 text-on-secondary font-headline-sm text-label-sm uppercase tracking-wider rounded transition-colors font-semibold"
          href="<?php echo esc_url(get_permalink()); ?>">
          <span class="material-symbols-outlined text-sm">tune</span>
          <span class="">View Product</span>
        </a>
        <a class="flex-1 inline-flex items-center justify-center gap-2 h-11 bg-white/10 hover:bg-white/20 border border-white/15 text-white font-headline-sm text-label-sm uppercase tracking-wider rounded transition-colors font-semibold"
          href="#technical-resources">
          <span class="material-symbols-outlined text-sm">download</span>
          <span class="">Request Spec &amp; CAD</span>
        </a>
      </div>
    </div>
  </div>
</div>
