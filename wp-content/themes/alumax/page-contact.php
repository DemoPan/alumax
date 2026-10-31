<?php
if (!defined('ABSPATH')) { exit; }

// 联系我们页：全部文案在后台「联系我们设置」编辑（inc/contact-settings.php）；
// 表单复用产品页公共询价表单（template-parts/product-sections/inquiry.php），提交记录见后台「询价记录」

get_header();
?>
<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
  <div class="flex flex-col w-full">

    <!-- HERO -->
    <section class="relative bg-primary-container text-inverse-on-surface py-16 lg:py-20 border-b border-on-tertiary-fixed-variant overflow-hidden">
      <div class="absolute inset-0 opacity-20 pointer-events-none">
        <img alt="<?php echo esc_attr(alumax_contact('hero_title')); ?>" class="w-full h-full object-cover" src="<?php echo esc_url(alumax_contact('hero_image')); ?>">
      </div>
      <div class="relative max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
        <div class="max-w-3xl space-y-4">
          <div class="inline-flex items-center gap-2 px-3 py-1 bg-tertiary-container border border-on-tertiary-fixed-variant text-secondary-fixed-dim font-label text-xs uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-secondary-fixed-dim animate-pulse"></span>
            <?php echo esc_html(alumax_contact('hero_eyebrow')); ?>
          </div>
          <h1 class="font-headline text-3xl sm:text-5xl lg:text-[46px] font-bold text-white tracking-tight leading-tight">
            <?php echo esc_html(alumax_contact('hero_title')); ?><br>
            <span class="text-secondary-fixed-dim"><?php echo esc_html(alumax_contact('hero_title_accent')); ?></span>
          </h1>
          <p class="font-body text-outline-variant text-base sm:text-lg leading-relaxed"><?php echo esc_html(alumax_contact('hero_desc')); ?></p>
          <div class="flex flex-wrap gap-4 pt-3">
            <?php for ($i = 1; $i <= 3; $i++) : ?>
            <div class="flex items-center gap-2 text-xs font-label text-inverse-on-surface bg-tertiary-container px-3.5 py-1.5 border border-on-tertiary-fixed-variant">
              <span class="material-symbols-outlined text-secondary-fixed-dim text-[18px]"><?php echo esc_html(alumax_contact("hero_pill{$i}_icon")); ?></span>
              <span><?php echo esc_html(alumax_contact("hero_pill{$i}_text")); ?></span>
            </div>
            <?php endfor; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- OUR OFFICE -->
    <section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin py-10 lg:py-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center">
        <div class="space-y-6">
          <div>
            <span class="font-label text-xs sm:text-sm font-semibold tracking-widest text-secondary uppercase"><?php echo esc_html(alumax_contact('office_eyebrow')); ?></span>
            <h2 class="font-headline text-3xl sm:text-4xl lg:text-[40px] font-bold text-primary-container tracking-tight mt-1"><?php echo esc_html(alumax_contact('office_title')); ?></h2>
          </div>
          <p class="font-body text-sm sm:text-base text-on-surface-variant leading-relaxed"><?php echo esc_html(alumax_contact('office_desc')); ?></p>
          <div class="space-y-5">
            <?php for ($i = 1; $i <= 3; $i++) : ?>
            <div class="flex items-start gap-4">
              <div class="w-11 h-11 rounded-sm bg-surface-container-low border border-outline-variant/40 text-secondary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]"><?php echo esc_html(alumax_contact("office_row{$i}_icon")); ?></span>
              </div>
              <div class="space-y-0.5">
                <span class="font-label text-xs font-semibold uppercase tracking-wider text-on-surface block"><?php echo esc_html(alumax_contact("office_row{$i}_label")); ?></span>
                <p class="font-body text-sm text-on-surface-variant"><?php echo esc_html(alumax_contact("office_row{$i}_line1")); ?></p>
                <?php if (alumax_contact("office_row{$i}_line2") !== '') : ?>
                <p class="font-label text-xs text-outline"><?php echo esc_html(alumax_contact("office_row{$i}_line2")); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <?php endfor; ?>
          </div>
        </div>
        <div class="relative w-full h-[340px] sm:h-[390px] overflow-hidden shadow-md bg-surface-container-high border border-outline-variant/30 flex flex-col items-center justify-center gap-3">
          <span class="material-symbols-outlined text-primary-container text-[56px]" style="font-variation-settings: 'FILL' 1;">location_on</span>
          <span class="font-label text-sm font-semibold text-primary-container uppercase tracking-wider"><?php echo esc_html(alumax_contact('map_label')); ?></span>
          <?php if (alumax_contact('map_url') !== '') : ?>
          <a class="inline-flex items-center gap-2 px-4 py-2 mt-2 bg-surface-container-lowest text-primary-container font-label text-xs font-semibold shadow-md hover:bg-secondary-fixed transition-colors"
            href="<?php echo esc_url(alumax_contact('map_url')); ?>" rel="noopener noreferrer" target="_blank">
            <span>View on Google Maps</span>
            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- 公共询价表单（与产品页一致） -->
    <?php
    $bullets = [];
    for ($i = 1; $i <= 3; $i++) {
        $bullets[] = [
            'icon'  => alumax_contact("form_bullet{$i}_icon"),
            'title' => alumax_contact("form_bullet{$i}_title"),
            'text'  => alumax_contact("form_bullet{$i}_text"),
        ];
    }
    get_template_part('template-parts/product-sections/inquiry', null, [
        'eyebrow'      => alumax_contact('form_eyebrow'),
        'title'        => alumax_contact('form_title'),
        'description'  => alumax_contact('form_desc'),
        'bullets'      => $bullets,
        'form_title'   => alumax_contact('form_card_title'),
        'form_badge'   => alumax_contact('form_card_badge'),
        'submit_label' => alumax_contact('form_submit'),
    ]);
    ?>

  </div>
</main>
<?php
get_footer();
