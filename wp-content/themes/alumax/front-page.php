<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
  <main class="w-full bg-surface">
    <!-- ========================================================================= -->
    <!-- SECTION 1: IMMERSIVE FULL-VIEWPORT HERO WITH TECHNICAL METADATA BADGES    -->
    <!-- ========================================================================= -->
    <section
      class="relative w-full min-h-screen flex flex-col justify-between pt-24 pb-12 bg-[#0d1b2a] text-white overflow-hidden">
      <div class="absolute inset-0 z-0">
        <img alt="Kinetic Facade Architecture"
          class="w-full h-full object-cover opacity-35 transition-opacity duration-700" id="hero-bg-slide"
          src="<?php echo esc_url(alumax_home('hero_slide1_image')); ?>">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0d1b2a] via-[#0d1b2a]/60 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#0d1b2a] via-[#0d1b2a]/75 to-transparent"></div>
        <div class="absolute inset-0 opacity-10 pointer-events-none"
          style="background-image: radial-gradient(#d6e4f9 1px, transparent 1px); background-size: 36px 36px;"></div>
      </div>
      <?php $alumax_hero_link = alumax_home('hero_link_url'); ?>
      <?php if ($alumax_hero_link) : ?>
      <!-- Whole-hero stretched link (sits above content, below the scenario switcher) -->
      <a aria-label="<?php echo esc_attr(alumax_home('hero_title')); ?>" class="absolute inset-0 z-20"
        href="<?php echo esc_url($alumax_hero_link); ?>"></a>
      <?php endif; ?>
      <!-- Top Telemetry & Badges -->
      <div class="relative z-10 max-w-[1440px] w-full mx-auto px-margin-mobile md:px-margin pt-4">
        <div
          class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-white/10 font-label-sm text-label-sm">
          <div class="flex items-center gap-3">
            <span
              class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/30 border border-secondary/50 rounded-full text-secondary-fixed font-semibold tracking-wider uppercase">
              <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
              Live Presentation Mode
            </span>
            <span class="hidden md:inline text-slate-300 font-label-sm">ASTM E84 Class A • EN 13501-1 Non-Combustible A2
              • CWCT Tested</span>
          </div>
          <div class="flex items-center gap-6 text-slate-300">
            <span class="flex items-center gap-1.5"><span
                class="material-symbols-outlined text-secondary text-sm">hub</span> Global LOD 400 BIM</span>
            <span class="flex items-center gap-1.5"><span
                class="material-symbols-outlined text-secondary text-sm">public</span> Export to 60+ Nations</span>
            <span class="flex items-center gap-1.5"><span
                class="material-symbols-outlined text-secondary text-sm">precision_manufacturing</span> ISO 9001 / CE
              Certified</span>
          </div>
        </div>
      </div>
      <!-- Hero Content -->
      <div class="relative z-10 max-w-[1440px] w-full mx-auto px-margin-mobile md:px-margin my-auto py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          <div class="lg:col-span-8 space-y-6">
            <div
              class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-white/10 border border-white/15 rounded-full font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider backdrop-blur-md">
              <span class="material-symbols-outlined text-base">architecture</span>
              <span class=""><?php echo esc_html(alumax_home('hero_badge')); ?></span>
            </div>
            <h1
              class="font-display-xl text-display-xl uppercase tracking-tight text-white leading-tight font-bold max-w-4xl">
              <?php echo esc_html(alumax_home('hero_title')); ?>
            </h1>
            <p class="font-body-lg text-body-lg text-slate-300 max-w-3xl leading-relaxed">
              <?php echo esc_html(alumax_home('hero_subtitle')); ?>
            </p>
            <!-- Technical Metadata Metric Badges -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2 pb-2 max-w-3xl">
              <?php for ($i = 1; $i <= 4; $i++) : ?>
              <div class="bg-white/5 border border-white/10 p-4 rounded-lg backdrop-blur-md">
                <span
                  class="font-display-lg text-display-lg <?php echo $i % 2 === 1 ? 'text-secondary-fixed' : 'text-white'; ?> block leading-none font-bold"><?php echo esc_html(alumax_home("hero_stat{$i}_value")); ?></span>
                <span class="font-label-sm text-label-sm text-slate-300 uppercase mt-1 block"><?php echo esc_html(alumax_home("hero_stat{$i}_label")); ?></span>
              </div>
              <?php endfor; ?>
            </div>
          </div>
          <!-- Telemetry Box -->
          <div class="lg:col-span-4 hidden lg:block">
            <div class="bg-[#0f1c2c]/90 border border-white/15 p-6 rounded-2xl shadow-2xl backdrop-blur-xl space-y-4">
              <div class="flex items-center justify-between pb-3 border-b border-white/10">
                <div class="flex items-center gap-2">
                  <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                  <span
                    class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider font-semibold">Active
                    Engineering Profile</span>
                </div>
                <span class="font-label-sm text-label-sm text-slate-400">SYS-LOU-2025</span>
              </div>
              <div class="space-y-3 font-label-sm text-label-sm">
                <div class="flex justify-between items-center py-1 border-b border-white/5">
                  <span class="text-slate-400">Actuation:</span>
                  <span class="text-white font-medium">BMS Direct Linear (24V DC / Modbus)</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-white/5">
                  <span class="text-slate-400">Rotation Capability:</span>
                  <span class="text-white font-medium">0° to 90° Continuous Stepless</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-white/5">
                  <span class="text-slate-400">Wind Pressure Rating:</span>
                  <span class="text-white font-medium">Tested up to Typhoon Class 12 (5.8 kPa)</span>
                </div>
                <div class="flex justify-between items-center py-1 border-b border-white/5">
                  <span class="text-slate-400">Acoustic Reduction:</span>
                  <span class="text-white font-medium">Rw 32 dB Acoustic Chamber Tested</span>
                </div>
                <div class="flex justify-between items-center py-1">
                  <span class="text-slate-400">Coating Spec:</span>
                  <span class="text-secondary-fixed font-medium">PPG Duranar XL 3-Coat PVDF (30-Yr)</span>
                </div>
              </div>
              <div class="pt-2">
                <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                  <div class="h-full bg-secondary w-3/4 rounded-full"></div>
                </div>
                <div class="flex justify-between text-[11px] text-slate-400 font-label-sm mt-1">
                  <span class="">Solar Heat Gain (SHGC): 0.14</span>
                  <span class="">Energy Savings: -38%</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero Scenario Switcher (kept above the stretched link so controls stay clickable) -->
      <div class="relative z-30 max-w-[1440px] w-full mx-auto px-margin-mobile md:px-margin pt-4">
        <div
          class="bg-black/40 border border-white/15 backdrop-blur-xl rounded-xl p-3 flex flex-col md:flex-row items-center justify-between gap-4">
          <div class="flex items-center gap-3 shrink-0">
            <button
              class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors"
              id="playback-toggle-btn" title="Toggle Auto-presentation" type="button">
              <span class="material-symbols-outlined text-lg" id="playback-icon">pause</span>
            </button>
            <div class="flex flex-col">
              <span class="font-label-sm text-label-sm text-white uppercase tracking-wider font-semibold">Cinematic
                Showcase</span>
              <span class="font-label-sm text-[11px] text-slate-400">3 Architectural Sequences</span>
            </div>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 w-full md:max-w-3xl" id="hero-slide-nav">
            <?php for ($i = 1; $i <= 3; $i++) : ?>
            <button
              class="hero-slide-btn flex items-center gap-3 p-2.5 rounded-lg border text-left transition-all <?php echo $i === 1 ? 'active bg-white/15 border-secondary' : 'hover:bg-white/10 bg-white/5 border-white/5'; ?>"
              data-bg="<?php echo esc_url(alumax_home("hero_slide{$i}_image")); ?>"
              type="button">
              <span class="w-2 h-2 rounded-full shrink-0 <?php echo $i === 1 ? 'bg-secondary' : 'bg-slate-500'; ?>"></span>
              <div class="min-w-0">
                <div class="font-label-sm text-label-sm text-white font-semibold truncate uppercase"><?php echo esc_html(alumax_home("hero_slide{$i}_title")); ?></div>
                <div class="text-[11px] text-slate-300 font-label-sm truncate"><?php echo esc_html(alumax_home("hero_slide{$i}_sub")); ?></div>
              </div>
            </button>
            <?php endfor; ?>
          </div>
          <div class="hidden xl:flex items-center gap-2 font-label-sm text-label-sm text-secondary-fixed shrink-0">
            <span class="material-symbols-outlined text-lg">flight_takeoff</span>
            <span class="">Worldwide DHL 24h Express Dispatch</span>
          </div>
        </div>
      </div>
    </section>
    <!-- ========================================================================= -->
    <!-- SECTION 2: ARCHITECTURAL SURFACE FINISHES & COATING STANDARDS (REDESIGNED)-->
    <!-- ========================================================================= -->
    <section class="w-full py-20 bg-surface-container-low border-b border-surface-container-high"
      id="surface-finishes-palette">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-10">
        <div
          class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-surface-container-high pb-6">
          <div class="space-y-3">
            <div class="flex items-center gap-2">
              <span class="w-2 h-6 bg-secondary rounded-full"></span>
              <span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-semibold"><?php echo esc_html(alumax_home('s2_eyebrow')); ?></span>
            </div>
            <h2 class="font-display-lg text-display-lg text-on-surface uppercase tracking-tight">
              <?php echo esc_html(alumax_home('s2_title')); ?>
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-3xl">
              <?php echo esc_html(alumax_home('s2_subtitle')); ?>
            </p>
          </div>
          <div class="shrink-0">
            <a class="inline-flex items-center gap-2 font-label-md text-label-md text-secondary hover:text-primary transition-colors font-semibold uppercase"
              href="#fast-rfq-section">
              <span class="">Request Physical 30-Color Architectural Swatch Deck</span>
              <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
          </div>
        </div>
        <!-- 5 Finish Cards Grid -->
        <?php
        $s2_card_gradients = [
            'linear-gradient(rgba(13, 27, 42, 0.88) 0%, rgba(13, 27, 42, 0.96) 100%)',
            'linear-gradient(rgba(35, 24, 12, 0.85) 0%, rgba(15, 22, 33, 0.95) 100%)',
            'linear-gradient(rgba(25, 28, 30, 0.88) 0%, rgba(13, 27, 42, 0.95) 100%)',
            'linear-gradient(rgba(42, 24, 0, 0.86) 0%, rgba(13, 27, 42, 0.96) 100%)',
            'linear-gradient(rgba(15, 28, 44, 0.86) 0%, rgba(13, 27, 42, 0.96) 100%)',
        ];
        ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
          <?php for ($i = 1; $i <= 5; $i++) :
            $s2_card_image = alumax_home("s2_card{$i}_image");
            $s2_card_bg = $s2_card_gradients[$i - 1]
                . ($s2_card_image ? ', url("' . esc_url($s2_card_image) . '")' : '')
                . ' center center / cover';
            ?>
          <div
            class="relative overflow-hidden rounded-xl border border-white/10 shadow-lg hover:border-secondary hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group"
            style="background: <?php echo esc_attr($s2_card_bg); ?>;">
            <div class="p-6 space-y-4 relative z-10">
              <div class="space-y-1">
                <span class="font-label-sm text-[11px] text-secondary-fixed uppercase font-semibold tracking-wider block"><?php echo esc_html(alumax_home("s2_card{$i}_tag")); ?></span>
                <h3 class="font-headline-sm text-body-lg text-white font-bold leading-tight"><?php echo esc_html(alumax_home("s2_card{$i}_title")); ?></h3>
              </div>
              <p class="font-body-sm text-body-sm text-slate-300 leading-relaxed">
                <?php echo esc_html(alumax_home("s2_card{$i}_desc")); ?>
              </p>
            </div>
            <div
              class="relative z-10 p-6 pt-3 border-t border-white/10 bg-black/30 backdrop-blur-sm font-label-sm text-[12px] flex items-center justify-between">
              <span class="text-slate-400"><?php echo esc_html(alumax_home("s2_card{$i}_spec_label")); ?></span>
              <span class="text-secondary-fixed font-bold tracking-wide"><?php echo esc_html(alumax_home("s2_card{$i}_spec_value")); ?></span>
            </div>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>
    <!-- ========================================================================= -->
    <!-- SECTION 3: UNIFIED PRODUCT SHOWCASE MODULE (MERGED ALL PRODUCTS)          -->
    <!-- ========================================================================= -->
    <section class="w-full py-24 bg-surface" id="featured-envelope-systems">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-16">
        <!-- Header -->
        <div
          class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-surface-container-high pb-6">
          <div class="space-y-3">
            <div class="flex items-center gap-2">
              <span class="w-2 h-6 bg-secondary rounded-full"></span>
              <span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-semibold"><?php echo esc_html(alumax_home('s3_eyebrow')); ?></span>
            </div>
            <h2 class="font-display-lg text-display-lg text-on-surface uppercase tracking-tight">
              <?php echo esc_html(alumax_home('s3_title')); ?>
            </h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
              <?php echo esc_html(alumax_home('s3_subtitle')); ?>
            </p>
          </div>
        </div>
        <!-- Bento Grid Showcase: Intelligent Louvers spans 2 columns, accompanied by other 5 products -->
        <!-- Bento Grid Showcase: 动态读取「产品」文章，第一张为主推大卡 -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <?php
          $alumax_products = new WP_Query([
              'post_type' => 'product',
              'posts_per_page' => 5,
          ]);
          if ($alumax_products->have_posts()) :
              $alumax_product_index = 0;
              while ($alumax_products->have_posts()) :
                  $alumax_products->the_post();
                  $alumax_product_index++;
                  get_template_part('template-parts/' . ($alumax_product_index === 1 ? 'product-card-featured' : 'product-card'));
              endwhile;
              wp_reset_postdata();
          else : ?>
          <div
            class="col-span-full p-8 bg-surface-container-low rounded-xl border border-surface-container-high text-center">
            <p class="font-body-md text-body-md text-on-surface-variant">Products coming soon. Add entries under
              "Products" in the dashboard to feature them here.</p>
          </div>
          <?php endif; ?>
        </div>
        <!-- Bottom Full Catalog Button -->
        <div class="text-center pt-6">
          <a class="inline-flex items-center gap-3 px-8 py-4 bg-[#0d1b2a] hover:bg-secondary text-white font-headline-sm text-label-md uppercase tracking-wider rounded-lg transition-colors shadow-md"
            href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">
            <span class="">Explore All Product Lines &amp; Full Engineering Catalog →</span>
          </a>
        </div>
      </div>
    </section>
    <!-- ========================================================================= -->
    <!-- SECTION 4: SMART MANUFACTURING & FABRICATION PRECISION                    -->
    <!-- ========================================================================= -->
    <?php
    $s4_bg_image = alumax_home('s4_bg_image');
    $s4_bg = 'linear-gradient(rgba(13, 27, 42, 0.92), rgba(13, 27, 42, 0.85), rgba(13, 27, 42, 0.96))'
        . ($s4_bg_image ? ', url("' . esc_url($s4_bg_image) . '")' : '')
        . ' center center / cover no-repeat';
    ?>
    <section class="relative w-full py-24 bg-[#0d1b2a] text-white border-y border-white/10 overflow-hidden"
      id="manufacturing-strengths"
      style="background: <?php echo esc_attr($s4_bg); ?>;">
      <div class="relative z-10 max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-16">
        <!-- Section Header -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 border-b border-white/10 pb-8">
          <div class="space-y-3 lg:col-span-8">
            <div
              class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/20 border border-secondary/40 rounded-full font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed">
              <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
              <?php echo esc_html(alumax_home('s4_eyebrow')); ?>
            </div>
            <h2 class="font-display-lg text-display-lg uppercase tracking-tight text-white font-bold leading-tight">
              <?php echo esc_html(alumax_home('s4_title')); ?>
            </h2>
          </div>
          <div class="lg:max-w-md shrink-0">
            <p class="font-body-md text-body-md text-slate-300 leading-relaxed">
              <?php echo esc_html(alumax_home('s4_subtitle')); ?>
            </p>
          </div>
        </div>

        <!-- Core Manufacturing Metrics Strip (5 KPI Cards) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
          <?php for ($i = 1; $i <= 5; $i++) : ?>
          <div
            class="p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur-md space-y-1<?php echo $i === 5 ? ' col-span-2 sm:col-span-1' : ''; ?>">
            <span
              class="font-display-lg text-headline-lg <?php echo $i % 2 === 1 ? 'text-secondary-fixed' : 'text-white'; ?> font-bold block leading-none"><?php echo esc_html(alumax_home("s4_metric{$i}_value")); ?></span>
            <span
              class="font-label-sm text-[12px] text-slate-300 uppercase block font-medium"><?php echo esc_html(alumax_home("s4_metric{$i}_label")); ?></span>
          </div>
          <?php endfor; ?>
        </div>

        <!-- 6 Advanced Fabrication Processes Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php for ($i = 1; $i <= 6; $i++) : ?>
          <div
            class="bg-white/5 border border-white/10 rounded-xl p-6 backdrop-blur-md space-y-4 hover:border-secondary transition-all group flex flex-col justify-between shadow-lg">
            <div class="space-y-3">
              <div
                class="w-12 h-12 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center text-secondary-fixed">
                <span class="material-symbols-outlined text-2xl"><?php echo esc_html(alumax_home("s4_card{$i}_icon")); ?></span>
              </div>
              <h3
                class="font-headline-md text-headline-md text-white font-bold group-hover:text-secondary-fixed transition-colors">
                <?php echo esc_html(alumax_home("s4_card{$i}_title")); ?>
              </h3>
              <p class="font-body-sm text-body-sm text-slate-300 leading-relaxed">
                <?php echo esc_html(alumax_home("s4_card{$i}_desc")); ?>
              </p>
            </div>
            <div class="pt-4 border-t border-white/10 flex items-center justify-between font-label-sm text-[12px]">
              <span class="text-slate-400"><?php echo esc_html(alumax_home("s4_card{$i}_spec_label")); ?></span>
              <span class="text-secondary-fixed font-semibold"><?php echo esc_html(alumax_home("s4_card{$i}_spec_value")); ?></span>
            </div>
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </section>
    <!-- ========================================================================= -->
    <!-- SECTION 5: CONCISE LANDMARK PROJECTS (PREMIER BENCHMARKS)                 -->
    <!-- ========================================================================= -->
    <section class="w-full py-24 bg-surface" id="landmark-projects">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-12">
        <div
          class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6 border-b border-surface-container-high">
          <div class="space-y-3">
            <div class="flex items-center gap-2">
              <span class="w-2 h-6 bg-secondary rounded-full"></span>
              <span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-semibold"><?php echo esc_html(alumax_home('s5_eyebrow')); ?></span>
            </div>
            <h2 class="font-display-lg text-display-lg text-on-surface uppercase tracking-tight">
              <?php echo esc_html(alumax_home('s5_title')); ?>
            </h2>
          </div>
          <div class="shrink-0">
            <a class="inline-flex items-center gap-2 px-6 py-3.5 bg-[#0d1b2a] hover:bg-secondary text-white font-label-md text-label-md uppercase tracking-wider rounded transition-colors shadow-sm"
              href="<?php echo esc_url(get_post_type_archive_link('case')); ?>">
              <span class="">View All 1,200+ Global Case Studies</span>
              <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
          </div>
        </div>
        <!-- 2 Premier Benchmarks -->
        <!-- Premier Benchmarks: 动态读取「案例」文章，第一张为主卡 -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
          <?php
          $alumax_cases = new WP_Query([
              'post_type' => 'case',
              'posts_per_page' => 2,
          ]);
          $alumax_case_fallback_img = 'https://lh3.googleusercontent.com/aida-public/AB6AXuDSiqGc-P2zUtof-U7Frj19aZ3jT7n9WPKwqoVb72PruTpf-UlOuguqyOAj26EDvquR1sCqmQtK2TwjD_eVKQhHs-j-dnInViZEURFVnGWnpjW7nWJZh9UhSKkQRxHYgzB9QjSwCkPyMYClQjPC8nlBuMCfOK-CnpH_h456yL654iZH57rgV6SnUts7OOhdldfIc7RtAtcICgLKfKDDX4rnYdz7LOOEVVO4mfCEYNXuW8uRR3Jgjf8E';
          if ($alumax_cases->have_posts()) :
              $alumax_case_index = 0;
              while ($alumax_cases->have_posts()) :
                  $alumax_cases->the_post();
                  $alumax_case_index++;
                  $alumax_case_img = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $alumax_case_fallback_img;
                  if ($alumax_case_index === 1) :
                      ?>
          <div
            class="lg:col-span-8 group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-surface-container-high flex flex-col justify-between">
            <div class="relative aspect-[16/10] overflow-hidden bg-surface-container">
              <img alt="<?php echo esc_attr(get_the_title()); ?>"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                src="<?php echo esc_url($alumax_case_img); ?>">
              <div class="absolute inset-0 bg-gradient-to-t from-[#0d1b2a] via-[#0d1b2a]/30 to-transparent"></div>
              <div class="absolute bottom-6 left-6 right-6 text-white space-y-2">
                <h3 class="font-headline-lg text-headline-lg uppercase tracking-tight text-white font-bold">
                  <?php the_title(); ?>
                </h3>
                <p class="font-body-md text-body-md text-slate-300 max-w-2xl line-clamp-2">
                  <?php echo esc_html(get_the_excerpt()); ?>
                </p>
              </div>
            </div>
            <div
              class="p-6 bg-surface-container-low flex flex-wrap items-center justify-between gap-4 font-label-sm text-label-sm">
              <a class="text-secondary font-semibold hover:text-primary flex items-center gap-1 uppercase"
                href="<?php echo esc_url(get_permalink()); ?>">
                <span class="">View Case Study</span>
                <span class="material-symbols-outlined text-sm">east</span>
              </a>
            </div>
          </div>
                  <?php else : ?>
          <div
            class="lg:col-span-4 group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-surface-container-high flex flex-col justify-between">
            <div class="relative aspect-square lg:aspect-[4/5] overflow-hidden bg-surface-container">
              <img alt="<?php echo esc_attr(get_the_title()); ?>"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                src="<?php echo esc_url($alumax_case_img); ?>">
              <div class="absolute inset-0 bg-gradient-to-t from-[#0d1b2a] via-[#0d1b2a]/30 to-transparent"></div>
              <div class="absolute bottom-6 left-6 right-6 text-white space-y-2">
                <h3 class="font-headline-md text-headline-md uppercase text-white font-bold"><?php the_title(); ?></h3>
                <p class="font-body-sm text-body-sm text-slate-300 line-clamp-2">
                  <?php echo esc_html(get_the_excerpt()); ?>
                </p>
              </div>
            </div>
            <div class="p-6 bg-surface-container-low space-y-2 font-label-sm text-label-sm">
              <div class="pt-2">
                <a class="text-secondary font-semibold hover:text-primary flex items-center gap-1 uppercase"
                  href="<?php echo esc_url(get_permalink()); ?>">
                  <span class="">View Case Study</span>
                  <span class="material-symbols-outlined text-sm">east</span>
                </a>
              </div>
            </div>
          </div>
                  <?php endif;
              endwhile;
              wp_reset_postdata();
          else : ?>
          <div
            class="lg:col-span-12 p-8 bg-surface-container-low rounded-xl border border-surface-container-high text-center">
            <p class="font-body-md text-body-md text-on-surface-variant">Case studies coming soon. Add entries under
              "Cases" in the dashboard to feature them here.</p>
          </div>
          <?php endif; ?>
        </div>
        <!-- Call to action block -->
        <div
          class="p-8 bg-surface-container-low rounded-xl border border-surface-container-high flex flex-col sm:flex-row items-center justify-between gap-6">
          <div class="space-y-1">
            <h4 class="font-headline-sm text-headline-sm uppercase text-on-surface">Looking for references in your
              geographic region?</h4>
            <p class="font-body-sm text-body-sm text-on-surface-variant">We have supplied high-rise commercial, airport,
              transit hub, and stadium envelopes across North America, Europe, MENA, and Asia Pacific.</p>
          </div>
          <a class="shrink-0 px-6 py-3 bg-secondary hover:bg-secondary/90 text-on-secondary font-label-md text-label-md uppercase tracking-wider rounded transition-colors"
            href="<?php echo esc_url(get_post_type_archive_link('case')); ?>">
            Explore Global Project Case Studies →
          </a>
        </div>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const heroBg = document.getElementById('hero-bg-slide');
      const slideBtns = document.querySelectorAll('.hero-slide-btn');
      const playbackToggle = document.getElementById('playback-toggle-btn');
      const playbackIcon = document.getElementById('playback-icon');

      let currentSlide = 0;
      let isPlaying = true;
      let timer = null;

      function switchSlide(index) {
        slideBtns.forEach((btn, i) => {
          const dot = btn.querySelector('span');
          if (i === index) {
            btn.classList.add('active', 'bg-white/15', 'border-secondary');
            btn.classList.remove('bg-white/5', 'border-white/5');
            if (dot) {
              dot.classList.add('bg-secondary');
              dot.classList.remove('bg-slate-500');
            }
            const newBg = btn.getAttribute('data-bg');
            if (newBg && heroBg) {
              heroBg.src = newBg;
            }
          } else {
            btn.classList.remove('active', 'bg-white/15', 'border-secondary');
            btn.classList.add('bg-white/5', 'border-white/5');
            if (dot) {
              dot.classList.remove('bg-secondary');
              dot.classList.add('bg-slate-500');
            }
          }
        });
        currentSlide = index;
      }

      slideBtns.forEach((btn, idx) => {
        btn.addEventListener('click', () => {
          switchSlide(idx);
        });
      });

      function startSlideshow() {
        timer = setInterval(() => {
          let next = (currentSlide + 1) % slideBtns.length;
          switchSlide(next);
        }, 5500);
      }

      function stopSlideshow() {
        if (timer) clearInterval(timer);
      }

      if (playbackToggle) {
        playbackToggle.addEventListener('click', () => {
          isPlaying = !isPlaying;
          if (isPlaying) {
            playbackIcon.textContent = 'pause';
            startSlideshow();
          } else {
            playbackIcon.textContent = 'play_arrow';
            stopSlideshow();
          }
        });
      }

      startSlideshow();
    });
  </script>
<?php get_footer(); ?>
