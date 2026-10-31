<?php
if (!defined('ABSPATH')) { exit; }

// 案例详情页模板：所有板块由案例文章的详情 meta 动态渲染（数据与后台面板见 inc/case-details.php）。
// 后台「Material Substrates / Verification Metrics / 下载资料」面板数据仍保留，当前模板不渲染。
// 本页不含询价表单。

get_header();

while (have_posts()) : the_post();
$post_id  = get_the_ID();
$header   = alumax_case_header($post_id);
$snapshot = alumax_case_snapshot($post_id);
$metrics  = array_slice(alumax_case_metrics($post_id), 0, 4);
$gallery  = alumax_case_gallery($post_id);
$challenge = alumax_case_challenge($post_id);

$fallback_image = 'https://lh3.googleusercontent.com/aida-public/AB6AXuC-qAi3-NkN3D5kkzbuqChEsIoeZVK9qOB_tP12pm7Ywm0MddUBrDiPoGOEo2gNnKPIrMq9PAlAds9O1lNHApr4YA0afha7J0L8rP_SGE6dEVNQkJGGpGWL_mN3K9F2OP4911zYauzoSSiTHizJkeI8KnjKXn1GMiPK2dJaYFGIxiEgRyxcWsYqSDERLDLlZb84jOHeRr9zYvT_iJcwFJApFbg5R2Ha7XEAfYCPD_cNuWh4fFm1_xuD';
$featured  = get_the_post_thumbnail_url($post_id, 'full');
$hero_bg   = $featured ?: $fallback_image;

$excerpt = trim((string) get_post_field('post_excerpt', $post_id));
if ($excerpt === '') {
    $excerpt = wp_trim_words(wp_strip_all_tags(strip_shortcodes(excerpt_remove_blocks(get_post_field('post_content', $post_id))), true), 42, '…');
}
$content = apply_filters('the_content', get_post_field('post_content', $post_id));

$hero_meta = array_filter([$header['card_tagline'], $header['location']]);
$default_icons = ['aspect_ratio', 'thermostat', 'air', 'shield'];

$challenge_image  = $challenge['image'] ?: ($featured ?: $fallback_image);
$challenge_image2 = $challenge['image2'] ?: (!empty($gallery[1]['image']) ? $gallery[1]['image'] : $fallback_image);

$archive_url = get_post_type_archive_link('case');
?>
<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
  <div class="flex flex-col w-full">

    <!-- 01 / PROJECT HERO -->
    <section class="w-full text-white relative overflow-hidden py-8 md:py-12 border-b border-white/10"
      id="project-hero"
      style="background-image: linear-gradient(rgba(13, 27, 42, 0.78), rgba(13, 27, 42, 0.88)), url('<?php echo esc_url($hero_bg); ?>'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin relative z-10 space-y-6">
        <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'Projects', 'archive_url' => $archive_url]); ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
          <div class="lg:col-span-8 space-y-4">
            <h1 class="font-display-xl text-display-xl tracking-tight text-white font-bold"><?php the_title(); ?></h1>
            <div class="flex flex-wrap items-center gap-3 font-label-sm text-label-sm text-secondary-fixed-dim tracking-wider uppercase font-semibold">
              <?php foreach ($hero_meta as $i => $meta_item) : ?>
                <?php if ($i > 0) : ?><span class="text-white/40">//</span><?php endif; ?>
                <span><?php echo esc_html($meta_item); ?></span>
              <?php endforeach; ?>
              <?php if ($header['completed'] !== '') : ?>
                <?php if ($hero_meta) : ?><span class="text-white/40">//</span><?php endif; ?>
                <span class="text-white"><?php echo esc_html($header['completed']); ?></span>
              <?php endif; ?>
            </div>
            <?php if ($excerpt !== '') : ?>
            <p class="font-body-md text-body-md text-slate-300 max-w-3xl leading-relaxed"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>
          </div>
          <?php if ($snapshot) : ?>
          <div class="lg:col-span-4 bg-[#0d1b2a]/80 border border-white/15 backdrop-blur-md p-5 space-y-2.5 rounded-lg shadow-xl">
            <div class="font-label-sm text-label-sm text-secondary-fixed-dim uppercase tracking-widest flex items-center justify-between border-b border-white/10 pb-2">
              <span>Project Snapshot</span>
              <span class="material-symbols-outlined text-[16px]">domain</span>
            </div>
            <div class="space-y-1.5 font-body-sm text-body-sm text-slate-300">
              <?php foreach (array_slice($snapshot, 0, 5) as $row) : ?>
              <div class="flex justify-between gap-3 py-1 bg-white/5 px-2.5 rounded">
                <span class="text-slate-400"><?php echo esc_html($row['label']); ?></span>
                <span class="text-white font-medium text-right"><?php echo esc_html($row['value']); ?></span>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <?php if ($metrics) : ?>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-6 pt-6 border-t border-white/10">
          <?php foreach ($metrics as $i => $metric) :
            $icon = !empty($metric['icon']) ? $metric['icon'] : $default_icons[$i % 4]; ?>
          <div class="p-3.5 bg-white/5 border border-white/10 rounded">
            <div class="flex items-center justify-between mb-1">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed-dim"><?php echo esc_html($metric['name']); ?></span>
              <span class="material-symbols-outlined text-secondary-fixed-dim text-[18px]"><?php echo esc_html($icon); ?></span>
            </div>
            <div class="font-headline-md text-headline-md text-white font-bold tracking-tight"><?php echo esc_html($metric['value']); ?></div>
            <?php if (!empty($metric['desc'])) : ?>
            <p class="font-body-sm text-body-sm text-slate-300 mt-0.5"><?php echo esc_html($metric['desc']); ?></p>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- 02 / PROJECT OVERVIEW -->
    <section class="w-full bg-surface-container-low py-10 md:py-14 border-b border-surface-container" id="project-overview">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-3">
          <div>
            <div class="inline-flex items-center gap-2 text-secondary font-label-md text-label-md uppercase tracking-wider font-semibold mb-1">
              <span class="material-symbols-outlined text-[18px]">corporate_fare</span>
              <span>02 // Project Overview</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">
              <?php echo esc_html($header['overview_heading'] !== '' ? $header['overview_heading'] : get_the_title()); ?>
            </h2>
          </div>
        </div>
        <?php if (trim(wp_strip_all_tags($content)) !== '') : ?>
        <div class="font-body-md text-body-md text-on-surface leading-relaxed max-w-4xl [&_p]:mb-4"><?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput -- the_content 已过滤 ?></div>
        <?php endif; ?>
        <?php if ($snapshot) : ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 pt-2">
          <?php foreach ($snapshot as $row) : ?>
          <div class="p-3.5 bg-surface-container-lowest border border-surface-container rounded-lg space-y-1">
            <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold block"><?php echo esc_html($row['label']); ?></span>
            <h4 class="font-headline-sm text-[16px] text-on-surface font-semibold"><?php echo esc_html($row['value']); ?></h4>
            <?php if (!empty($row['sub'])) : ?>
            <p class="font-body-sm text-[11px] text-on-surface-variant"><?php echo esc_html($row['sub']); ?></p>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- 03 / PROJECT CHALLENGE -->
    <section class="w-full bg-surface py-16 md:py-24 border-b border-surface-container" id="project-challenge">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
          <div class="space-y-3 max-w-4xl">
            <div class="inline-flex items-center gap-2 text-secondary font-label-md text-label-md uppercase tracking-wider font-semibold mb-2">
              <span class="material-symbols-outlined text-[18px]">warning</span>
              <span>03 // Project Challenge</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">
              <?php echo esc_html($challenge['heading'] !== '' ? $challenge['heading'] : 'The Design & Engineering Challenge'); ?>
            </h2>
            <?php if ($challenge['text'] !== '') : ?>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed"><?php echo esc_html($challenge['text']); ?></p>
            <?php endif; ?>
          </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-stretch">
          <div class="lg:col-span-5 flex flex-col gap-gutter">
            <div class="relative group overflow-hidden rounded-xl bg-primary-container shadow-md flex-1 min-h-[300px]">
              <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                alt="<?php echo esc_attr($challenge['image_title'] !== '' ? $challenge['image_title'] : get_the_title()); ?>"
                src="<?php echo esc_url($challenge_image); ?>">
              <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-transparent to-transparent"></div>
              <div class="absolute bottom-4 left-4 right-4 text-white">
                <?php if ($challenge['image_label'] !== '') : ?>
                <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary-fixed-dim bg-[#0d1b2a]/80 px-2.5 py-1"><?php echo esc_html($challenge['image_label']); ?></span>
                <?php endif; ?>
                <?php if ($challenge['image_title'] !== '') : ?>
                <p class="font-headline-sm text-headline-sm mt-1.5 font-semibold"><?php echo esc_html($challenge['image_title']); ?></p>
                <?php endif; ?>
                <?php if ($challenge['image_desc'] !== '') : ?>
                <p class="font-body-sm text-body-sm text-slate-300"><?php echo esc_html($challenge['image_desc']); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="relative group overflow-hidden rounded-xl bg-primary-container shadow-md h-52">
              <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                alt="<?php echo esc_attr($challenge['image2_title'] !== '' ? $challenge['image2_title'] : get_the_title()); ?>"
                src="<?php echo esc_url($challenge_image2); ?>">
              <div class="absolute inset-0 bg-gradient-to-t from-primary-container/90 via-transparent to-transparent"></div>
              <div class="absolute bottom-3 left-4 right-4 text-white">
                <?php if ($challenge['image2_label'] !== '') : ?>
                <span class="font-label-sm text-label-sm text-secondary-fixed-dim uppercase"><?php echo esc_html($challenge['image2_label']); ?></span>
                <?php endif; ?>
                <?php if ($challenge['image2_title'] !== '') : ?>
                <p class="font-label-md text-label-md font-semibold text-white"><?php echo esc_html($challenge['image2_title']); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php if (!empty($challenge['cards'])) : ?>
          <div class="lg:col-span-7 flex flex-col justify-between space-y-4">
            <?php foreach ($challenge['cards'] as $i => $card) : ?>
            <div class="p-6 bg-surface-container-low border border-surface-container rounded-lg space-y-3 hover:border-secondary transition-all">
              <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-secondary/15 text-secondary flex items-center justify-center font-label-sm font-bold shrink-0"><?php echo esc_html(str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold"><?php echo esc_html($card['title']); ?></h3>
              </div>
              <?php if (!empty($card['text'])) : ?>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed pl-11"><?php echo esc_html($card['text']); ?></p>
              <?php endif; ?>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- 04 / PROJECT GALLERY -->
    <section class="w-full bg-surface py-16 md:py-24 border-b border-surface-container" id="project-gallery">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
          <div>
            <div class="inline-flex items-center gap-2 text-secondary font-label-md text-label-md uppercase tracking-wider font-semibold mb-2">
              <span class="material-symbols-outlined text-[18px]">photo_library</span>
              <span>04 // Project Gallery</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">Architectural Envelope &amp; Fabrication Gallery</h2>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-gutter">
          <?php
          $gallery_spans = ['lg:col-span-8 min-h-[380px] md:min-h-[440px]', 'lg:col-span-4 min-h-[380px] md:min-h-[440px]', 'lg:col-span-6 min-h-[340px]', 'lg:col-span-6 min-h-[340px]'];
          foreach ($gallery as $i => $item) :
            $image = $item['image'] !== '' ? $item['image'] : ($i === 0 && $featured ? $featured : $fallback_image);
            ?>
          <div class="<?php echo esc_attr($gallery_spans[$i]); ?> relative group overflow-hidden rounded-xl bg-primary-container shadow-md flex flex-col justify-end">
            <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
              alt="<?php echo esc_attr($item['title'] !== '' ? $item['title'] : get_the_title()); ?>"
              src="<?php echo esc_url($image); ?>">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-primary-container/30 to-transparent"></div>
            <div class="relative z-10 p-6 <?php echo $i === 0 ? 'md:p-8' : ''; ?> text-white space-y-2">
              <?php if ($item['label'] !== '') : ?>
              <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/10 font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed-dim rounded">
                <span><?php echo esc_html(($i + 1) . ' // ' . $item['label']); ?></span>
              </div>
              <?php endif; ?>
              <?php if ($item['title'] !== '') : ?>
              <h3 class="font-headline-sm text-headline-sm font-bold text-white"><?php echo esc_html($item['title']); ?></h3>
              <?php endif; ?>
              <?php if ($item['desc'] !== '') : ?>
              <p class="font-body-sm text-body-sm text-slate-300 max-w-xl"><?php echo esc_html($item['desc']); ?></p>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- 05 / RELATED PRODUCTS -->
    <?php
    $products = new WP_Query([
        'post_type'           => 'product',
        'posts_per_page'      => 3,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
    ]);
    if ($products->have_posts()) :
        $product_archive = get_post_type_archive_link('product');
        ?>
    <section class="w-full bg-surface-container-low py-16 md:py-24 border-b border-surface-container" id="related-products">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
          <div>
            <div class="inline-flex items-center gap-2 text-secondary font-label-md text-label-md uppercase tracking-wider font-semibold mb-2">
              <span class="material-symbols-outlined text-[18px]">inventory_2</span>
              <span>05 // Related Products</span>
            </div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">Products Used in This Project</h2>
          </div>
          <?php if ($product_archive) : ?>
          <a class="font-label-md text-label-md text-secondary hover:underline uppercase tracking-wider inline-flex items-center gap-1.5 font-semibold"
            href="<?php echo esc_url($product_archive); ?>">
            <span>View All Products</span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
          <?php endif; ?>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
          <?php
          while ($products->have_posts()) : $products->the_post();
              $pid   = get_the_ID();
              $specs = array_slice(alumax_product_specs($pid), 0, 3);
              $terms = get_the_terms($pid, 'product_category');
              $eyebrow = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'Engineered Envelope System';
              $badge   = !empty($specs[0]['value']) ? $specs[0]['value'] : $eyebrow;
              $pimg    = get_the_post_thumbnail_url($pid, 'large') ?: alumax_product_fallback_image();
              $pdesc   = wp_trim_words(alumax_product_card_desc($pid), 24, '…');
              ?>
          <div class="bg-surface-container-lowest rounded-xl overflow-hidden border border-surface-container shadow-sm hover:shadow-md hover:border-secondary transition-all flex flex-col justify-between group">
            <div>
              <div class="relative h-56 overflow-hidden bg-primary-container">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                  alt="<?php echo esc_attr(get_the_title()); ?>"
                  src="<?php echo esc_url($pimg); ?>">
                <div class="absolute top-3 left-3 bg-[#0d1b2a]/90 text-white font-label-sm text-label-sm px-2.5 py-1 rounded"><?php echo esc_html($badge); ?></div>
              </div>
              <div class="p-6 space-y-4">
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold"><?php echo esc_html($eyebrow); ?></span>
                  <h3 class="font-headline-sm text-headline-sm text-on-surface mt-1 font-bold group-hover:text-secondary transition-colors"><?php the_title(); ?></h3>
                  <?php if ($pdesc !== '') : ?>
                  <p class="font-body-sm text-body-sm text-on-surface-variant mt-2 leading-relaxed"><?php echo esc_html($pdesc); ?></p>
                  <?php endif; ?>
                </div>
                <?php if ($specs) : ?>
                <div class="space-y-1.5 pt-3 border-t border-surface-container font-mono text-label-sm text-on-surface-variant">
                  <?php foreach ($specs as $spec) : ?>
                  <div class="flex justify-between gap-3">
                    <span><?php echo esc_html($spec['name']); ?></span>
                    <span class="font-semibold text-on-surface text-right"><?php echo esc_html($spec['value']); ?></span>
                  </div>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="p-6 pt-0">
              <a class="w-full py-3 bg-surface-container hover:bg-secondary hover:text-on-secondary text-on-surface font-label-md text-label-md uppercase tracking-wider rounded font-semibold transition-all flex items-center justify-center gap-2"
                href="<?php the_permalink(); ?>">
                <span>View Product Technical Specs</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

  </div>
</main>
<?php
endwhile;

get_footer();
