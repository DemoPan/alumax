<?php
if (!defined('ABSPATH')) { exit; }

// 关于我们页：全部文案/图片在后台「关于我们设置」编辑（inc/about-settings.php）

get_header();
?>
<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
  <div class="flex flex-col w-full">

    <!-- HERO -->
    <section class="relative w-full -mt-20 pt-24 pb-14 bg-primary-container text-on-primary overflow-hidden">
      <div class="absolute inset-0 z-0 bg-cover bg-center pointer-events-none"
        style="background-image: linear-gradient(to right, rgba(13, 27, 42, 0.94) 0%, rgba(13, 27, 42, 0.84) 60%, rgba(13, 27, 42, 0.92) 100%), url('<?php echo esc_url(alumax_about('hero_bg')); ?>');"></div>
      <div class="absolute inset-0 opacity-20 pointer-events-none mix-blend-screen"
        style="background-image: radial-gradient(#d6e4f9 1px, transparent 1px); background-size: 32px 32px;"></div>
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin relative z-10 space-y-8">
        <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'About Us', 'archive_url' => get_permalink(), 'current' => '']); ?>
        <div class="space-y-4 max-w-4xl">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-tertiary-container/80 backdrop-blur-md border border-on-tertiary-fixed-variant font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed-dim">
            <?php echo esc_html(alumax_about('hero_badge')); ?>
          </div>
          <h1 class="font-display-xl text-display-xl text-on-primary tracking-tight font-bold"><?php echo esc_html(alumax_about('hero_title')); ?></h1>
          <p class="font-body-md text-body-md text-primary-fixed-dim max-w-3xl leading-relaxed"><?php echo esc_html(alumax_about('hero_intro')); ?></p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-px bg-on-tertiary-fixed-variant/50 border border-on-tertiary-fixed-variant shadow-md">
          <?php for ($i = 1; $i <= 5; $i++) : ?>
          <div class="bg-primary-container/90 p-4">
            <div class="font-headline-lg text-headline-lg text-on-primary tracking-tight"><?php echo esc_html(alumax_about("hero_metric{$i}_value")); ?></div>
            <span class="font-label-sm text-label-sm text-secondary-fixed tracking-widest uppercase mt-2 font-semibold block"><?php echo esc_html(alumax_about("hero_metric{$i}_label")); ?></span>
            <p class="font-body-sm text-body-sm text-on-primary-container mt-1"><?php echo esc_html(alumax_about("hero_metric{$i}_sub")); ?></p>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>

    <!-- SECTION 01 · HERITAGE -->
    <section class="w-full py-20 bg-surface border-b border-outline-variant/30">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-10">
        <div class="space-y-4 max-w-4xl">
          <div class="flex items-center gap-3">
            <span class="font-label-md text-label-md text-secondary font-bold uppercase tracking-widest"><?php echo esc_html(alumax_about('s1_eyebrow')); ?></span>
            <span class="font-label-sm text-label-sm text-outline uppercase"><?php echo esc_html(alumax_about('s1_eyebrow_sub')); ?></span>
          </div>
          <h2 class="font-display-lg text-display-lg text-on-surface font-bold tracking-tight"><?php echo esc_html(alumax_about('s1_title')); ?></h2>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed"><?php echo esc_html(alumax_about('s1_narrative')); ?></p>
        </div>
        <?php
        $video_url = alumax_about('s1_video_url');
        $tag = $video_url !== '' ? 'a' : 'div';
        $href = $video_url !== '' ? ' href="' . esc_url($video_url) . '" target="_blank" rel="noopener noreferrer"' : '';
        ?>
        <<?php echo $tag; ?> class="block relative w-full h-[320px] md:h-[520px] overflow-hidden shadow-2xl bg-surface-container border border-on-tertiary-fixed-variant group cursor-pointer"<?php echo $href; ?>>
          <img alt="<?php echo esc_attr(alumax_about('s1_video_caption')); ?>"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
            src="<?php echo esc_url(alumax_about('s1_video_image')); ?>">
          <div class="absolute inset-0 bg-gradient-to-t from-tertiary-container/95 via-tertiary-container/40 to-tertiary-container/60 pointer-events-none"></div>
          <div class="absolute top-4 left-4 right-4 flex items-start justify-between gap-3">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-primary font-semibold bg-tertiary-container/80 px-2.5 py-1 border border-on-tertiary-fixed-variant"><?php echo esc_html(alumax_about('s1_video_badge')); ?></span>
            <div class="flex gap-2">
              <span class="font-label-sm text-label-sm px-2.5 py-1 bg-secondary-fixed-dim text-primary-container font-bold uppercase tracking-wider">4K UHD</span>
              <span class="font-label-sm text-label-sm px-2.5 py-1 bg-tertiary-container/80 text-outline-variant border border-on-tertiary-fixed-variant">60 FPS</span>
            </div>
          </div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="relative">
              <div class="absolute inset-0 rounded-full border border-secondary-fixed-dim/40 animate-ping pointer-events-none"></div>
              <div class="w-20 h-20 rounded-full bg-secondary-fixed-dim text-primary-container shadow-2xl flex items-center justify-center transition-transform group-hover:scale-110">
                <span class="material-symbols-outlined text-[36px]">play_arrow</span>
              </div>
            </div>
          </div>
          <div class="absolute bottom-0 inset-x-0 p-5 bg-gradient-to-t from-tertiary-container via-tertiary-container/90 to-transparent">
            <span class="font-label-sm text-label-sm uppercase tracking-widest text-on-primary font-semibold bg-tertiary-container/90 px-4 py-1.5 border border-on-tertiary-fixed-variant backdrop-blur-md"><?php echo esc_html(alumax_about('s1_video_caption')); ?></span>
          </div>
        </<?php echo $tag; ?>>
      </div>
    </section>

    <!-- SECTION 02 · TIMELINE -->
    <section class="w-full py-20 bg-surface-container-low border-b border-outline-variant/30">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-10">
        <div class="space-y-4 max-w-4xl">
          <div class="flex items-center gap-3">
            <span class="font-label-md text-label-md text-secondary font-bold uppercase tracking-widest"><?php echo esc_html(alumax_about('s2_eyebrow')); ?></span>
            <span class="font-label-sm text-label-sm text-outline uppercase"><?php echo esc_html(alumax_about('s2_eyebrow_sub')); ?></span>
          </div>
          <h2 class="font-display-lg text-display-lg text-on-surface font-bold tracking-tight"><?php echo esc_html(alumax_about('s2_title')); ?></h2>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed"><?php echo esc_html(alumax_about('s2_subtitle')); ?></p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
          <?php for ($i = 1; $i <= 3; $i++) : ?>
          <div class="bg-surface-container-lowest p-6 border border-outline-variant/40 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
            <div class="space-y-3">
              <span class="font-label-md text-label-md text-secondary font-bold"><?php echo esc_html(alumax_about("s2_card{$i}_years")); ?></span>
              <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold"><?php echo esc_html(alumax_about("s2_card{$i}_title")); ?></h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed"><?php echo esc_html(alumax_about("s2_card{$i}_desc")); ?></p>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/20 flex items-center justify-between gap-3 text-on-surface font-label-sm text-label-sm">
              <span class="text-outline uppercase"><?php echo esc_html(alumax_about("s2_card{$i}_foot_label")); ?></span>
              <span class="font-semibold text-right"><?php echo esc_html(alumax_about("s2_card{$i}_foot_value")); ?></span>
            </div>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>

    <!-- SECTION 03 · MACHINERY MATRIX -->
    <section class="w-full py-20 bg-surface border-b border-outline-variant/30" id="manufacturing-matrix">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-outline-variant/30">
          <div class="space-y-3 max-w-3xl">
            <div class="flex items-center gap-3">
              <span class="font-label-md text-label-md text-secondary font-bold uppercase tracking-widest"><?php echo esc_html(alumax_about('s3_eyebrow')); ?></span>
              <span class="font-label-sm text-label-sm text-outline uppercase"><?php echo esc_html(alumax_about('s3_eyebrow_sub')); ?></span>
            </div>
            <h2 class="font-display-lg text-display-lg text-on-surface font-bold tracking-tight"><?php echo esc_html(alumax_about('s3_title')); ?></h2>
          </div>
          <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md leading-relaxed"><?php echo esc_html(alumax_about('s3_intro')); ?></p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
          <?php for ($i = 1; $i <= 3; $i++) : ?>
          <div class="bg-surface-container-lowest border border-outline-variant/40 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group p-5">
            <div>
              <div class="w-full h-48 overflow-hidden bg-surface-container border border-outline-variant/30 relative mb-5">
                <img alt="<?php echo esc_attr(alumax_about("s3_card{$i}_title")); ?>"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  src="<?php echo esc_url(alumax_about("s3_card{$i}_image")); ?>">
                <div class="absolute top-3 left-3 flex items-center gap-1.5 px-2.5 py-1 bg-tertiary-container/90 backdrop-blur-md border border-on-tertiary-fixed-variant text-on-primary font-label-sm text-label-sm">
                  <span class="material-symbols-outlined text-[14px]">domain</span>
                  <span><?php echo esc_html(alumax_about("s3_card{$i}_brand")); ?></span>
                </div>
                <span class="absolute top-3 right-3 font-label-sm text-label-sm px-2 py-0.5 bg-secondary-fixed-dim text-primary-container font-bold uppercase tracking-wider"><?php echo esc_html(alumax_about("s3_card{$i}_country")); ?></span>
              </div>
              <div class="flex items-center justify-between gap-3 mb-2 font-label-sm text-label-sm">
                <span class="text-secondary font-bold uppercase tracking-wider"><?php echo esc_html(alumax_about("s3_card{$i}_stage")); ?></span>
                <span class="px-1.5 py-0.5 bg-surface-container border border-outline-variant/30 text-on-surface"><?php echo esc_html(alumax_about("s3_card{$i}_units")); ?></span>
              </div>
              <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mt-2"><?php echo esc_html(alumax_about("s3_card{$i}_title")); ?></h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mt-2"><?php echo esc_html(alumax_about("s3_card{$i}_desc")); ?></p>
            </div>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>

    <!-- SECTION 04 · QUALITY PROTOCOL -->
    <section class="w-full py-20 bg-surface-container-low">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-outline-variant/30">
          <div class="space-y-3 max-w-3xl">
            <div class="flex items-center gap-3">
              <span class="font-label-md text-label-md text-secondary font-bold uppercase tracking-widest"><?php echo esc_html(alumax_about('s4_eyebrow')); ?></span>
              <span class="font-label-sm text-label-sm text-outline uppercase"><?php echo esc_html(alumax_about('s4_eyebrow_sub')); ?></span>
            </div>
            <h2 class="font-display-lg text-display-lg text-on-surface font-bold tracking-tight"><?php echo esc_html(alumax_about('s4_title')); ?></h2>
          </div>
          <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md leading-relaxed"><?php echo esc_html(alumax_about('s4_intro')); ?></p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
          <?php for ($i = 1; $i <= 4; $i++) : ?>
          <div class="bg-surface-container-lowest border border-outline-variant/40 p-6 flex flex-col justify-between shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="space-y-3">
              <div class="flex items-center justify-between gap-2">
                <span class="font-label-md text-label-md font-bold text-secondary"><?php echo esc_html(alumax_about("s4_card{$i}_phase")); ?></span>
                <span class="font-label-sm text-label-sm text-outline uppercase"><?php echo esc_html(alumax_about("s4_card{$i}_stage")); ?></span>
              </div>
              <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-secondary group-hover:bg-tertiary-container group-hover:text-secondary-fixed-dim transition-colors">
                <span class="material-symbols-outlined text-[18px]"><?php echo esc_html(alumax_about("s4_card{$i}_icon")); ?></span>
              </div>
              <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold"><?php echo esc_html(alumax_about("s4_card{$i}_title")); ?></h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed"><?php echo esc_html(alumax_about("s4_card{$i}_desc")); ?></p>
              <div class="flex flex-wrap gap-1.5 pt-1">
                <span class="font-label-sm text-label-sm px-2 py-0.5 bg-surface-container border border-outline-variant/30 text-on-surface"><?php echo esc_html(alumax_about("s4_card{$i}_badge1")); ?></span>
                <span class="font-label-sm text-label-sm px-2 py-0.5 bg-surface-container border border-outline-variant/30 text-on-surface"><?php echo esc_html(alumax_about("s4_card{$i}_badge2")); ?></span>
              </div>
            </div>
            <div class="mt-6 pt-4 border-t border-outline-variant/30 flex flex-col gap-1.5 font-label-sm text-label-sm">
              <div class="flex items-center justify-between gap-2">
                <span class="text-outline uppercase"><?php echo esc_html(alumax_about("s4_card{$i}_spec1_label")); ?></span>
                <span class="font-semibold text-on-surface text-right"><?php echo esc_html(alumax_about("s4_card{$i}_spec1_value")); ?></span>
              </div>
              <div class="flex items-center justify-between gap-2">
                <span class="text-outline uppercase"><?php echo esc_html(alumax_about("s4_card{$i}_spec2_label")); ?></span>
                <span class="font-semibold text-on-surface text-right"><?php echo esc_html(alumax_about("s4_card{$i}_spec2_value")); ?></span>
              </div>
            </div>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>

  </div>
</main>
<?php
get_footer();
