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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
          <!-- Card 1 -->
          <div
            class="bg-surface-container-lowest p-6 rounded-xl border border-surface-container-high hover:border-secondary/50 hover:shadow-lg transition-all flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div
                class="w-12 h-12 rounded-lg bg-[#0d1b2a] flex items-center justify-center text-white font-label-md font-bold tracking-wider">
                PVDF
              </div>
              <div>
                <h3 class="font-headline-sm text-body-lg text-on-surface font-bold">Fluorocarbon PVDF (Kynar 500)</h3>
                <span class="font-label-sm text-[11px] text-secondary uppercase font-semibold">AAMA 2605
                  Certified</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                3-Coat 2-Bake system, 35μm minimum dry film thickness. Engineered for extreme solar UV and salt-spray
                resistance.
              </p>
            </div>
            <div
              class="pt-3 border-t border-surface-container-high font-label-sm text-[12px] text-on-surface font-semibold flex items-center justify-between">
              <span class="text-on-surface-variant">Warranty</span>
              <span class="text-secondary font-bold">30-Yr Exterior</span>
            </div>
          </div>
          <!-- Card 2 -->
          <div
            class="bg-surface-container-lowest p-6 rounded-xl border border-surface-container-high hover:border-secondary/50 hover:shadow-lg transition-all flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div
                class="w-12 h-12 rounded-lg bg-secondary flex items-center justify-center text-white font-label-md font-bold tracking-wider">
                ANO
              </div>
              <div>
                <h3 class="font-headline-sm text-body-lg text-on-surface font-bold">Architectural Anodizing</h3>
                <span class="font-label-sm text-[11px] text-secondary uppercase font-semibold">Class 1
                  Electrolytic</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                Electrolytic satin finish available in natural silver, champagne, and dark bronze with uniform 25μm
                oxide depth.
              </p>
            </div>
            <div
              class="pt-3 border-t border-surface-container-high font-label-sm text-[12px] text-on-surface font-semibold flex items-center justify-between">
              <span class="text-on-surface-variant">Oxide Layer</span>
              <span class="text-secondary font-bold">25μm Depth</span>
            </div>
          </div>
          <!-- Card 3 -->
          <div
            class="bg-surface-container-lowest p-6 rounded-xl border border-surface-container-high hover:border-secondary/50 hover:shadow-lg transition-all flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div
                class="w-12 h-12 rounded-lg bg-surface-container-high flex items-center justify-center text-on-surface font-label-md font-bold tracking-wider">
                STN
              </div>
              <div>
                <h3 class="font-headline-sm text-body-lg text-on-surface font-bold">Textured Stone &amp; Quartz</h3>
                <span class="font-label-sm text-[11px] text-secondary uppercase font-semibold">Natural Mineral
                  Look</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                3D mineral tactile coating providing granite/limestone look while being 80% lighter than natural stone
                slabs.
              </p>
            </div>
            <div
              class="pt-3 border-t border-surface-container-high font-label-sm text-[12px] text-on-surface font-semibold flex items-center justify-between">
              <span class="text-on-surface-variant">Combustibility</span>
              <span class="text-secondary font-bold">Class A Non-Comb.</span>
            </div>
          </div>
          <!-- Card 4 -->
          <div
            class="bg-surface-container-lowest p-6 rounded-xl border border-surface-container-high hover:border-secondary/50 hover:shadow-lg transition-all flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div
                class="w-12 h-12 rounded-lg bg-on-secondary-container flex items-center justify-center text-white font-label-md font-bold tracking-wider">
                WOD
              </div>
              <div>
                <h3 class="font-headline-sm text-body-lg text-on-surface font-bold">Thermal Transfer Woodgrain</h3>
                <span class="font-label-sm text-[11px] text-secondary uppercase font-semibold">High-Vacuum
                  Sublimation</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                High-vacuum thermal transfer delivering warm architectural wood effect with zero rotting, swelling, or
                splintering.
              </p>
            </div>
            <div
              class="pt-3 border-t border-surface-container-high font-label-sm text-[12px] text-on-surface font-semibold flex items-center justify-between">
              <span class="text-on-surface-variant">Stability</span>
              <span class="text-secondary font-bold">UV-Stabilized</span>
            </div>
          </div>
          <!-- Card 5 -->
          <div
            class="bg-surface-container-lowest p-6 rounded-xl border border-surface-container-high hover:border-secondary/50 hover:shadow-lg transition-all flex flex-col justify-between space-y-4">
            <div class="space-y-3">
              <div
                class="w-12 h-12 rounded-lg bg-[#191c1e] flex items-center justify-center text-white font-label-md font-bold tracking-wider">
                FEVE
              </div>
              <div>
                <h3 class="font-headline-sm text-body-lg text-on-surface font-bold">FEVE Ultra-Weatherable</h3>
                <span class="font-label-sm text-[11px] text-secondary uppercase font-semibold">Self-Cleaning
                  Fluoropolymer</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                High-gloss, scratch-resistant fluoropolymer coating with hydrophobic self-cleaning properties and
                anti-graffiti finish.
              </p>
            </div>
            <div
              class="pt-3 border-t border-surface-container-high font-label-sm text-[12px] text-on-surface font-semibold flex items-center justify-between">
              <span class="text-on-surface-variant">Gloss Retention</span>
              <span class="text-secondary font-bold">&gt; 80% at 20 Years</span>
            </div>
          </div>
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
          <div class="shrink-0">
            <span
              class="inline-flex items-center gap-2 px-3 py-1.5 bg-secondary/15 rounded-full font-label-sm text-label-sm text-secondary font-semibold">
              <span class="material-symbols-outlined text-base">verified</span>
              LOD 400 BIM Ready • ASTM Certified
            </span>
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
          $alumax_product_fallback_img = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBSKyFgB-1gbPpcw77fwoFlWVCl7zs2f77dw-F_B0OucwuvHrZB8vEP7rBJKUyhYc5Z8nCY_hcrotCjS9nPVqJuUPUQ0r5etRuiCD6SfwbOZaIjGx-1EcWaTq4izjVVqXD5owfxdUQCVqBbm_i9EAtd-0Hbe2iPdCCEOhJtamPymYhAueolPEEC2hg64MwJDjmfWAkfsdzhbwDrgkYmAm4wzbcSowYbFGTrrOKFfy-ENc_UOKnn-sdT';
          if ($alumax_products->have_posts()) :
              $alumax_product_index = 0;
              while ($alumax_products->have_posts()) :
                  $alumax_products->the_post();
                  $alumax_product_index++;
                  $alumax_product_img = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $alumax_product_fallback_img;
                  $alumax_specs = alumax_product_specs(get_the_ID());
                  if ($alumax_product_index === 1) :
                      ?>
          <!-- FEATURED CARD: 第一个产品（占两列） -->
          <div
            class="lg:col-span-2 bg-[#0d1b2a] text-white rounded-2xl overflow-hidden shadow-2xl border border-white/10 flex flex-col justify-between group">
            <div class="grid grid-cols-1 md:grid-cols-12 h-full">
              <!-- Image half -->
              <div class="md:col-span-6 relative min-h-[300px] md:min-h-full bg-black overflow-hidden">
                <img alt="<?php echo esc_attr(get_the_title()); ?>"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                  src="<?php echo esc_url($alumax_product_img); ?>">
                <div
                  class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-transparent via-[#0d1b2a]/40 to-[#0d1b2a]">
                </div>
                <div class="absolute top-4 left-4 flex items-center gap-2">
                  <span
                    class="bg-secondary text-on-secondary font-label-sm text-label-sm font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow">
                    FEATURED FLAGSHIP SYSTEM
                  </span>
                </div>
              </div>
              <!-- Content half -->
              <div class="md:col-span-6 p-6 md:p-8 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                  <div class="flex items-center justify-between pb-2 border-b border-white/10">
                    <span
                      class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider font-semibold">Flagship
                      System</span>
                  </div>
                  <h3 class="font-display-lg text-headline-lg uppercase font-bold text-white leading-tight">
                    <?php the_title(); ?>
                  </h3>
                  <div class="font-body-sm text-body-sm text-slate-300">
                    <?php echo esc_html(get_the_excerpt()); ?>
                  </div>
                  <?php if (!empty($alumax_specs)) : ?>
                  <!-- Quick spec indicators -->
                  <div class="grid grid-cols-2 gap-3 font-label-sm text-label-sm">
                    <?php foreach ($alumax_specs as $alumax_spec) : ?>
                    <div class="bg-white/5 p-2.5 rounded border border-white/10">
                      <span class="text-slate-400 block text-[11px] uppercase"><?php echo esc_html($alumax_spec['name']); ?></span>
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
                    <span class="">View System</span>
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
                  <?php else : ?>
          <!-- 普通产品卡 -->
          <div
            class="bg-surface-container-lowest border border-surface-container-high rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all group flex flex-col justify-between">
            <div>
              <div class="relative aspect-[16/10] overflow-hidden bg-surface-container">
                <img alt="<?php echo esc_attr(get_the_title()); ?>"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  src="<?php echo esc_url($alumax_product_img); ?>">
              </div>
              <div class="p-6 space-y-3">
                <h4
                  class="font-headline-md text-headline-md text-on-surface group-hover:text-secondary transition-colors">
                  <?php the_title(); ?>
                </h4>
                <div class="font-body-sm text-body-sm text-on-surface-variant">
                  <?php echo esc_html(get_the_excerpt()); ?>
                </div>
                <?php if (!empty($alumax_specs)) : ?>
                <div class="bg-surface-container-low p-3 rounded font-label-sm text-label-sm space-y-1">
                  <?php foreach ($alumax_specs as $alumax_spec) : ?>
                  <div class="flex justify-between"><span class="text-on-surface-variant"><?php echo esc_html($alumax_spec['name']); ?></span><span
                      class="font-semibold text-on-surface"><?php echo esc_html($alumax_spec['value']); ?></span></div>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="p-6 pt-0">
              <a class="font-label-md text-label-md text-secondary hover:text-primary font-semibold flex items-center gap-1 uppercase"
                href="<?php echo esc_url(get_permalink()); ?>">
                <span class="">View System</span>
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
              </a>
            </div>
          </div>
                  <?php endif;
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
    <!-- SECTION 4: HEAVY INDUSTRIAL MANUFACTURING & LOGISTICS                     -->
    <!-- ========================================================================= -->
    <section class="w-full py-24 bg-surface-container-lowest border-y border-surface-container-high"
      id="manufacturing-strengths">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
          <div class="lg:col-span-8 space-y-3">
            <div class="flex items-center gap-2">
              <span class="w-2 h-6 bg-secondary rounded-full"></span>
              <span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-semibold"><?php echo esc_html(alumax_home('s4_eyebrow')); ?></span>
            </div>
            <h2 class="font-display-lg text-display-lg text-on-surface uppercase tracking-tight">
              <?php echo esc_html(alumax_home('s4_title')); ?>
            </h2>
          </div>
          <div class="lg:col-span-4 lg:text-right">
            <p class="font-body-md text-body-md text-on-surface-variant">
              <?php echo esc_html(alumax_home('s4_subtitle')); ?>
            </p>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="p-6 bg-surface-container-low rounded-xl space-y-4 border border-surface-container-high">
            <div
              class="w-12 h-12 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
              <span class="material-symbols-outlined text-2xl">precision_manufacturing</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-on-surface">6 CNC Punch &amp; Bending</h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant">
              Automated Trumpf &amp; Amada multi-axis turret systems providing 0.05mm positioning precision for complex
              parametric facades.
            </p>
            <div class="font-label-sm text-label-sm text-secondary font-semibold">TOLERANCE: ±0.3mm MAX</div>
          </div>
          <div class="p-6 bg-surface-container-low rounded-xl space-y-4 border border-surface-container-high">
            <div
              class="w-12 h-12 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
              <span class="material-symbols-outlined text-2xl">format_paint</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-on-surface">Ransburg Coating Lines</h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant">
              Japanese 300m automated electrostatic vertical fluorocarbon coating lines guaranteeing uniform film depth
              and pigment adhesion.
            </p>
            <div class="font-label-sm text-label-sm text-secondary font-semibold">25-YEAR COATING INTEGRITY</div>
          </div>
          <div class="p-6 bg-surface-container-low rounded-xl space-y-4 border border-surface-container-high">
            <div
              class="w-12 h-12 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
              <span class="material-symbols-outlined text-2xl">apartment</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-on-surface">BIM LOD 400 Integration</h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant">
              In-house technical office with 35 structural facade specialists generating Rhino/Grasshopper parametric
              geometry and fabrication models.
            </p>
            <div class="font-label-sm text-label-sm text-secondary font-semibold">3D SCAN COLLISION DETECT</div>
          </div>
          <div class="p-6 bg-surface-container-low rounded-xl space-y-4 border border-surface-container-high">
            <div
              class="w-12 h-12 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
              <span class="material-symbols-outlined text-2xl">verified</span>
            </div>
            <h3 class="font-headline-md text-headline-md text-on-surface">Independent Test Labs</h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant">
              Full compliance with ASTM E84 Class A flame spread, EN 13501-1 reaction to fire, CWCT wind load testing,
              and QUALICOAT certifications.
            </p>
            <div class="font-label-sm text-label-sm text-secondary font-semibold">CE / ISO9001 / SGS TESTED</div>
          </div>
        </div>
        <!-- Packaging and Ocean Logistics Banner -->
        <div
          class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-[#0d1b2a] text-white p-8 md:p-12 rounded-2xl border border-white/10 shadow-xl">
          <div class="lg:col-span-6 space-y-6">
            <div class="font-label-md text-label-md text-secondary-fixed uppercase tracking-widest font-semibold">Export
              Packaging &amp; Ocean Logistics</div>
            <h3 class="font-display-lg text-display-lg uppercase leading-tight font-bold">
              Reinforced Fumigation-Free Crating for Zero Maritime Damage
            </h3>
            <p class="font-body-md text-body-md text-slate-300">
              Each architectural unit is encased in UV-resistant protective films, corner foam cushions, and
              moisture-controlled steel-strapped crates fitted with internal desiccants to prevent container
              condensation damage.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
              <div
                class="flex items-center gap-2 font-label-sm text-label-sm bg-white/10 px-3.5 py-2 rounded border border-white/10 text-white">
                <span class="material-symbols-outlined text-secondary-fixed text-base">directions_boat</span>
                <span class="">Direct Seaport Clearance: Shenzhen / Guangzhou</span>
              </div>
              <div
                class="flex items-center gap-2 font-label-sm text-label-sm bg-white/10 px-3.5 py-2 rounded border border-white/10 text-white">
                <span class="material-symbols-outlined text-secondary-fixed text-base">security</span>
                <span class="">100% Full Marine Insurance Coverage</span>
              </div>
            </div>
          </div>
          <div class="lg:col-span-6">
            <div class="relative aspect-video rounded-xl overflow-hidden shadow-2xl border border-white/10">
              <img alt="Automated robotic arm manufacturing facade components in modern plant"
                class="w-full h-full object-cover"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDE-ogS2i698NEexYc67G_2BdzCnVs2BWBJEP09_l9Iq4-JSDFvoIlgK0Ipgxo-GG9a4YIONPzkLm6g9TiwNMGQOGbqL4VASjm_gW354KUpcfwHYyg1k3XXUcFFZ_w3HYOaLi8SRCcEWEqqgu9hY1GL-COt-TJfaueT1R_r_gt4g-loQFkolFVoObqvuuaLbD5p6NgDGMX3o5McA78MMrkPVQlcx91Ye1oKymxqEO05fb6t4Zcp28t6">
              <div class="absolute inset-0 bg-primary/20"></div>
            </div>
          </div>
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
