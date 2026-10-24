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
?>
<!-- PRODUCT CARD: <?php echo esc_html(get_the_title()); ?> -->
<div
  class="product-item product-card--standard bg-surface-container-lowest border border-surface-container-high rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all group flex flex-col"
  data-categories="<?php echo esc_attr($alumax_card_cats); ?>"
  data-specs="<?php echo esc_attr(strtolower(trim($alumax_card_specs_text))); ?>">
  <div class="product-card-row flex flex-col flex-1">
    <div class="product-card-media relative aspect-[16/10] overflow-hidden bg-surface-container">
      <img alt="<?php echo esc_attr(get_the_title()); ?>"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        src="<?php echo esc_url($alumax_card_img); ?>">
      <div
        class="media-overlay hidden absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-transparent via-[#0d1b2a]/40 to-[#0d1b2a]">
      </div>
    </div>
    <div class="product-card-body p-6 flex flex-col flex-1 space-y-3">
      <h4
        class="font-headline-md text-headline-md text-on-surface group-hover:text-secondary transition-colors">
        <?php the_title(); ?>
      </h4>
      <div class="card-desc font-body-sm text-body-sm text-on-surface-variant">
        <?php echo esc_html(alumax_product_card_desc()); ?>
      </div>
      <?php if (!empty($alumax_card_specs)) : ?>
      <div class="grid grid-cols-2 gap-3 font-label-sm text-label-sm">
        <?php
        $alumax_spec_count = count($alumax_card_specs);
        foreach ($alumax_card_specs as $alumax_spec_index => $alumax_spec) :
            $alumax_spec_span = ($alumax_spec_count % 2 === 1 && $alumax_spec_index === $alumax_spec_count - 1) ? ' col-span-2' : '';
            ?>
        <div
          class="spec-chip bg-surface-container-low p-2.5 rounded border border-surface-container-high<?php echo $alumax_spec_span; ?>">
          <span class="spec-name text-on-surface-variant block text-[11px] uppercase"><?php echo esc_html($alumax_spec['name']); ?>:</span>
          <span class="spec-value text-on-surface font-semibold"><?php echo esc_html($alumax_spec['value']); ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <div class="card-footer mt-auto pt-4">
        <a class="card-link font-label-md text-label-md text-secondary hover:text-primary font-semibold inline-flex items-center gap-1 uppercase"
          href="<?php echo esc_url(get_permalink()); ?>">
          <span class="">View Product</span>
          <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
      </div>
    </div>
  </div>
</div>
