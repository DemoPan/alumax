<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
  <main class="w-full bg-surface">
    <div class="flex flex-col w-full">
      <?php get_template_part('template-parts/product-breadcrumb', null, array('current' => '')); ?>
      <!-- 1. INTRO HERO BAR -->
      <section class="w-full bg-surface-container-low py-12">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <!-- Main Headline Grid -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end">
            <div class="lg:col-span-8 space-y-4">
              <h1 class="font-display-xl text-display-xl tracking-tight text-on-surface">
                <?php echo esc_html(alumax_pa('hero_title')); ?>
              </h1>
              <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl">
                <?php echo esc_html(alumax_pa('hero_subtitle')); ?>
              </p>
            </div>
            <!-- Quick Spec Document CTA Stack -->
            <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3">
              <a class="group flex items-center justify-between p-4 rounded bg-primary text-on-primary hover:bg-secondary transition-all shadow-md"
                href="#technical-resources">
                <div class="flex items-center gap-3">
                  <span
                    class="material-symbols-outlined text-secondary-fixed group-hover:text-white transition-colors">menu_book</span>
                  <div class="text-left">
                    <span class="block font-headline-sm text-headline-sm leading-tight">Master Spec Book</span>
                    <span class="block font-label-sm text-label-sm text-outline-variant group-hover:text-white/80">PDF
                      Catalog, 42MB (Metric &amp; Imperial)</span>
                  </div>
                </div>
                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">download</span>
              </a>
              <a class="flex items-center justify-between p-4 rounded bg-surface-container-highest hover:bg-secondary-fixed/50 text-on-surface transition-all"
                href="#rfq-section">
                <div class="flex items-center gap-3">
                  <span class="material-symbols-outlined text-secondary">inventory_2</span>
                  <div class="text-left">
                    <span class="block font-headline-sm text-headline-sm leading-tight">Request Sample Box</span>
                    <span class="block font-label-sm text-label-sm text-on-surface-variant">Includes 6 finishes &amp;
                      core mockups</span>
                  </div>
                </div>
                <span class="material-symbols-outlined text-on-surface-variant">arrow_forward</span>
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- 2. ADVANCED ENGINEERING FILTER CONSOLE -->
      <section class="sticky top-20 z-40 bg-surface shadow-sm py-4">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-4">
          <!-- Top Tier: Primary Application Tabs & View Switcher -->
          <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
            <!-- Application Filter Tabs（动态读取产品分类，后台 产品 → 产品分类 配置） -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 md:pb-0" id="filter-tabs">
              <?php
              $alumax_archive_total = (int) wp_count_posts('product')->publish;
              $alumax_archive_cats = get_terms(['taxonomy' => 'product_category', 'hide_empty' => true]);
              if (is_wp_error($alumax_archive_cats)) {
                  $alumax_archive_cats = [];
              }
              ?>
              <button
                class="filter-tab active px-4 py-2 rounded font-label-md text-label-md uppercase tracking-wider bg-primary text-on-primary whitespace-nowrap transition-colors"
                data-filter="all">
                All Systems (<?php echo $alumax_archive_total; ?>)
              </button>
              <?php foreach ($alumax_archive_cats as $alumax_archive_cat) : ?>
              <button
                class="filter-tab px-4 py-2 rounded font-label-md text-label-md uppercase tracking-wider bg-surface-container-high text-on-surface hover:bg-surface-variant whitespace-nowrap transition-colors"
                data-filter="<?php echo esc_attr($alumax_archive_cat->slug); ?>">
                <?php echo esc_html($alumax_archive_cat->name); ?> (<?php echo (int) $alumax_archive_cat->count; ?>)
              </button>
              <?php endforeach; ?>
            </div>
            <!-- View Mode Switch（服务端切换：?view=list 时所有卡片用主推卡样式） -->
            <?php
            $alumax_list_view = isset($_GET['view']) && $_GET['view'] === 'list';
            $alumax_archive_link = get_post_type_archive_link('product');
            ?>
            <div class="flex items-center gap-3">
              <div class="flex items-center bg-surface-container-high p-1 rounded">
                <a class="p-1.5 rounded <?php echo $alumax_list_view ? 'text-outline hover:text-on-surface transition-colors' : 'bg-surface-container-lowest text-primary shadow-sm'; ?>"
                  href="<?php echo esc_url($alumax_archive_link); ?>" title="Grid View">
                  <span class="material-symbols-outlined text-lg">grid_view</span>
                </a>
                <a class="p-1.5 rounded <?php echo $alumax_list_view ? 'bg-surface-container-lowest text-primary shadow-sm' : 'text-outline hover:text-on-surface transition-colors'; ?>"
                  href="<?php echo esc_url(add_query_arg('view', 'list', $alumax_archive_link)); ?>" title="List View">
                  <span class="material-symbols-outlined text-lg">format_list_bulleted</span>
                </a>
              </div>
            </div>
          </div>
          <!-- Second Tier: Detailed Parameter Filters (Dropdown Chips) -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-2 pt-2">
            <!-- Fire Rating Filter -->
            <div class="relative">
              <select
                class="w-full appearance-none bg-surface-container px-3 py-2 rounded font-label-sm text-label-sm text-on-surface cursor-pointer focus:outline-none focus:ring-1 focus:ring-secondary pr-8"
                id="filter-fire">
                <option value="all">Fire Rating: All Standards</option>
                <option value="A2">EN 13501-1 Class A2-s1, d0</option>
                <option value="A1">ASTM E84 Non-Combustible</option>
                <option value="B1">Class B1 Flame Retardant</option>
              </select>
              <span
                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-sm text-outline pointer-events-none">unfold_more</span>
            </div>
            <!-- Material Alloy Filter -->
            <div class="relative">
              <select
                class="w-full appearance-none bg-surface-container px-3 py-2 rounded font-label-sm text-label-sm text-on-surface cursor-pointer focus:outline-none focus:ring-1 focus:ring-secondary pr-8"
                id="filter-alloy">
                <option value="all">Alloy Grade: All Grades</option>
                <option value="3003">Alloy 3003-H24 (Standard Architectural)</option>
                <option value="5052">Alloy 5052-H32 (Marine/High-Corrosion)</option>
                <option value="steel">Cold-Rolled Galvanized Steel (DX51D)</option>
                <option value="1100">Alloy 1100 (Deep Curving / Spinning)</option>
              </select>
              <span
                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-sm text-outline pointer-events-none">unfold_more</span>
            </div>
            <!-- Coating System Filter -->
            <div class="relative">
              <select
                class="w-full appearance-none bg-surface-container px-3 py-2 rounded font-label-sm text-label-sm text-on-surface cursor-pointer focus:outline-none focus:ring-1 focus:ring-secondary pr-8"
                id="filter-coating">
                <option value="all">Surface Coating: All Finishes</option>
                <option value="pvdf">PPG Duranar® PVDF 3-Coat (70% Kynar)</option>
                <option value="anodized">Class I Anodized (25μm Marine)</option>
                <option value="powder">AAMA 2605 Architectural Powder</option>
                <option value="wood-stone">Sublimated Stone / Woodgrain</option>
              </select>
              <span
                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-sm text-outline pointer-events-none">unfold_more</span>
            </div>
            <!-- Core / Thickness Filter -->
            <div class="relative">
              <select
                class="w-full appearance-none bg-surface-container px-3 py-2 rounded font-label-sm text-label-sm text-on-surface cursor-pointer focus:outline-none focus:ring-1 focus:ring-secondary pr-8"
                id="filter-thickness">
                <option value="all">Panel Caliber: Standard &amp; Custom</option>
                <option value="2.0">Solid Sheet: 2.0mm - 3.0mm</option>
                <option value="4.0">Solid Sheet: 4.0mm - 6.0mm</option>
                <option value="composite">Composite Core: 10mm - 50mm</option>
              </select>
              <span
                class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-sm text-outline pointer-events-none">unfold_more</span>
            </div>
          </div>
        </div>
      </section>
      <!-- 3. COMPREHENSIVE PRODUCT CATALOG (11 CATEGORIES) -->
      <section class="w-full py-16">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <!-- Section Intro & Dynamic Filter Results Count -->
          <div class="flex items-center justify-between pb-8">
            <div>
              <span class="font-label-sm text-label-sm uppercase tracking-widest text-outline">Structural Facade
                Portfolio</span>
              <h2 class="font-headline-lg text-headline-lg text-on-surface">Architectural Metal Catalog</h2>
            </div>
            <div class="font-label-md text-label-md text-on-surface-variant">
              Showing <span class="font-semibold text-secondary"
                id="product-count"><?php echo $alumax_archive_total . ' of ' . $alumax_archive_total; ?></span> Systems
            </div>
          </div>
          <!-- PRODUCT CARDS GRID -->
          <div class="<?php echo $alumax_list_view ? 'grid grid-cols-1 gap-8' : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8'; ?>" id="products-container">
            <?php if (have_posts()) : ?>
              <?php $alumax_product_index = 0; ?>
              <?php while (have_posts()) : the_post(); ?>
                <?php
                $alumax_product_index++;
                if ($alumax_list_view) {
                    // 列表模式：所有卡片都复用主推卡样式，仅第一张显示 FEATURED 徽章
                    get_template_part('template-parts/product-card-featured', null, array('badge' => $alumax_product_index === 1));
                } else {
                    get_template_part('template-parts/' . ($alumax_product_index === 1 ? 'product-card-featured' : 'product-card'));
                }
                ?>
              <?php endwhile; ?>
            <?php else : ?>
              <div
                class="col-span-full bg-surface-container-lowest rounded shadow-sm p-12 text-center space-y-3">
                <span class="material-symbols-outlined text-4xl text-outline">inventory_2</span>
                <p class="font-body-md text-body-md text-on-surface-variant">
                  No product systems are published yet. Please check back soon or contact our engineering team for the
                  latest catalog.
                </p>
              </div>
            <?php endif; ?>
          </div>
          <div class="mt-12">
            <?php
            the_posts_pagination(array(
              'mid_size'  => 2,
              'prev_text' => esc_html__('Previous', 'alumax'),
              'next_text' => esc_html__('Next', 'alumax'),
            ));
            ?>
          </div>
        </div>
      </section>
      <!-- 4. TECHNICAL COMPARISON & SELECTION MATRIX -->
      <section class="w-full bg-surface-container-low py-16">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-8">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
              <span
                class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-semibold">Engineering
                Selection Matrix</span>
              <h2 class="font-headline-lg text-headline-lg text-on-surface mt-1">Material Performance Benchmark</h2>
              <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mt-1">
                Compare core structural parameters across primary curtain wall panel architectures to determine the
                optimal balance of wind-load resistance, planarity, and mass.
              </p>
            </div>
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-outline">
              <span class="material-symbols-outlined text-base">verified</span>
              <span>Verified under ASTM E330 &amp; EN 13830 standards</span>
            </div>
          </div>
          <!-- Schedule Table -->
          <div class="overflow-x-auto rounded bg-surface-container-lowest shadow-sm">
            <table class="w-full text-left font-body-sm text-body-sm text-on-surface min-w-[900px]">
              <thead class="bg-primary text-on-primary font-label-sm text-label-sm uppercase tracking-wider">
                <tr>
                  <th class="p-4">System Type</th>
                  <th class="p-4">Core Architecture</th>
                  <th class="p-4">Fire Standard</th>
                  <th class="p-4">Average Mass</th>
                  <th class="p-4">Wind Deflection (L/175)</th>
                  <th class="p-4">Cost Index</th>
                  <th class="p-4">Ideal Architectural Application</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-surface-container font-body-sm text-body-sm">
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="p-4 font-semibold text-primary">Solid Aluminum (3.0mm)</td>
                  <td class="p-4 text-on-surface-variant">Homogeneous Solid AA3003</td>
                  <td class="p-4"><span
                      class="px-2 py-0.5 rounded bg-primary/10 text-primary font-label-sm text-label-sm font-semibold">Class
                      A1/A2</span></td>
                  <td class="p-4 font-label-sm text-label-sm">8.1 kg/m²</td>
                  <td class="p-4">Stiffener Required &gt; 1200mm</td>
                  <td class="p-4 font-label-sm text-label-sm">$$$$</td>
                  <td class="p-4 text-on-surface-variant">Complex 3D organic curves, extreme impact facades</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors bg-surface-container-lowest">
                  <td class="p-4 font-semibold text-secondary">Aluminum Honeycomb</td>
                  <td class="p-4 text-on-surface-variant">Hexagonal Foil (Alloy 3003)</td>
                  <td class="p-4"><span
                      class="px-2 py-0.5 rounded bg-secondary/15 text-secondary font-label-sm text-label-sm font-semibold">Class
                      A2-s1,d0</span></td>
                  <td class="p-4 font-label-sm text-label-sm">5.8 - 6.5 kg/m²</td>
                  <td class="p-4 text-secondary font-semibold">Span 2,200mm unassisted</td>
                  <td class="p-4 font-label-sm text-label-sm">$$$$$</td>
                  <td class="p-4 text-on-surface-variant">Super-tall curtain walls requiring zero oil-canning</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="p-4 font-semibold text-primary">Corrugated ACCP</td>
                  <td class="p-4 text-on-surface-variant">Sine Wave Aluminum Core</td>
                  <td class="p-4"><span
                      class="px-2 py-0.5 rounded bg-primary/10 text-primary font-label-sm text-label-sm font-semibold">Class
                      A2 Non-Comb.</span></td>
                  <td class="p-4 font-label-sm text-label-sm">4.6 kg/m²</td>
                  <td class="p-4">Span 1,500mm unassisted</td>
                  <td class="p-4 font-label-sm text-label-sm">$$$</td>
                  <td class="p-4 text-on-surface-variant">Cost-engineered high-rise facade fire retrofit</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors bg-surface-container-lowest">
                  <td class="p-4 font-semibold text-primary">Mineral Core ACP (4mm)</td>
                  <td class="p-4 text-on-surface-variant">Fire-retardant Mineral Compound</td>
                  <td class="p-4"><span
                      class="px-2 py-0.5 rounded bg-surface-container-highest text-on-surface-variant font-label-sm text-label-sm">Class
                      B1 / A2</span></td>
                  <td class="p-4 font-label-sm text-label-sm">7.6 kg/m²</td>
                  <td class="p-4">Rout &amp; Fold Cassette System</td>
                  <td class="p-4 font-label-sm text-label-sm">$$</td>
                  <td class="p-4 text-on-surface-variant">Commercial retail, fascia wraps, canopy canopies</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="p-4 font-semibold text-primary">Galvanized Steel Panel</td>
                  <td class="p-4 text-on-surface-variant">High Tensile DX51D+Z Steel</td>
                  <td class="p-4"><span
                      class="px-2 py-0.5 rounded bg-primary/10 text-primary font-label-sm text-label-sm font-semibold">Class
                      A1 Incombustible</span></td>
                  <td class="p-4 font-label-sm text-label-sm">12.2 - 15.5 kg/m²</td>
                  <td class="p-4">High structural yield</td>
                  <td class="p-4 font-label-sm text-label-sm">$$$</td>
                  <td class="p-4 text-on-surface-variant">Metro stations, airport concourses, high impact walls</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
      <!-- 5. GLOBAL STANDARDS & LABORATORY CERTIFICATIONS -->
      <section class="w-full bg-surface-container-high py-12">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="font-label-sm text-label-sm uppercase tracking-widest text-outline">Third-Party Testing &amp;
              Verification</span>
            <h3 class="font-headline-md text-headline-md text-on-surface mt-1">Conforming to International Building
              Codes</h3>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <!-- Badge 1: ASTM E84 -->
            <div class="p-4 bg-surface-container-lowest rounded text-center shadow-sm space-y-1">
              <span class="material-symbols-outlined text-secondary text-2xl">local_fire_department</span>
              <div class="font-label-md text-label-md font-bold text-on-surface">ASTM E84</div>
              <div class="font-label-sm text-label-sm text-outline">Class A Flame Spread &lt; 15</div>
            </div>
            <!-- Badge 2: EN 13501-1 -->
            <div class="p-4 bg-surface-container-lowest rounded text-center shadow-sm space-y-1">
              <span class="material-symbols-outlined text-secondary text-2xl">shield_with_heart</span>
              <div class="font-label-md text-label-md font-bold text-on-surface">EN 13501-1</div>
              <div class="font-label-sm text-label-sm text-outline">Euroclass A2-s1, d0</div>
            </div>
            <!-- Badge 3: AAMA 2605 -->
            <div class="p-4 bg-surface-container-lowest rounded text-center shadow-sm space-y-1">
              <span class="material-symbols-outlined text-secondary text-2xl">format_paint</span>
              <div class="font-label-md text-label-md font-bold text-on-surface">AAMA 2605</div>
              <div class="font-label-sm text-label-sm text-outline">10-Yr Florida Weathering</div>
            </div>
            <!-- Badge 4: ASTM E330 -->
            <div class="p-4 bg-surface-container-lowest rounded text-center shadow-sm space-y-1">
              <span class="material-symbols-outlined text-secondary text-2xl">air</span>
              <div class="font-label-md text-label-md font-bold text-on-surface">ASTM E330</div>
              <div class="font-label-sm text-label-sm text-outline">Structural Wind Load 5.0kPa</div>
            </div>
            <!-- Badge 5: ISO 9001 / 14001 -->
            <div class="p-4 bg-surface-container-lowest rounded text-center shadow-sm space-y-1">
              <span class="material-symbols-outlined text-secondary text-2xl">verified_user</span>
              <div class="font-label-md text-label-md font-bold text-on-surface">ISO 9001/14001</div>
              <div class="font-label-sm text-label-sm text-outline">TÜV SÜD Audited Plant</div>
            </div>
            <!-- Badge 6: CE Marking -->
            <div class="p-4 bg-surface-container-lowest rounded text-center shadow-sm space-y-1">
              <span class="material-symbols-outlined text-secondary text-2xl">euro_symbol</span>
              <div class="font-label-md text-label-md font-bold text-on-surface">CE CPR 305/2011</div>
              <div class="font-label-sm text-label-sm text-outline">EU Curtain Wall Certified</div>
            </div>
          </div>
        </div>
      </section>
      <!-- 6. HIGH-CONVERSION ENGINEERING RFQ & SPEC CONSULTATION FORM -->
      <section class="w-full bg-primary-container text-white py-16" id="rfq-section">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left: Consultation Narrative & Direct Engineering Access -->
            <div class="lg:col-span-5 space-y-6">
              <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded bg-white/10 font-label-sm text-label-sm text-secondary-fixed">
                <span class="material-symbols-outlined text-sm">support_agent</span>
                <span>Direct Facade Engineering Desk</span>
              </div>
              <h2 class="font-display-lg text-display-lg tracking-tight text-white">
                Need Custom Dimensions, Perforation Patterns, or Engineered Mock-ups?
              </h2>
              <p class="font-body-md text-body-md text-slate-300">
                Submit your project schedule, wind-load parameters, or architectural elevations. Our technical facade
                team responds with preliminary structural sizing, BIM details (LOD 400), and formal CIF/FOB export
                pricing within 24 business hours.
              </p>
              <!-- Contact Guarantee Cards -->
              <div class="space-y-3 pt-2">
                <div class="flex items-center gap-3 p-3 rounded bg-white/5">
                  <span class="material-symbols-outlined text-secondary-fixed">schedule</span>
                  <div>
                    <span class="block font-label-md text-label-md text-white font-semibold">24-Hour B2B
                      Turnaround</span>
                    <span class="block font-body-sm text-body-sm text-slate-400">Guaranteed response for commercial
                      procurement RFQs.</span>
                  </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded bg-white/5">
                  <span class="material-symbols-outlined text-secondary-fixed">box</span>
                  <div>
                    <span class="block font-label-md text-label-md text-white font-semibold">Global Sample
                      Dispatch</span>
                    <span class="block font-body-sm text-body-sm text-slate-400">FedEx / DHL express sample boxes
                      delivered worldwide.</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- Right: Actionable RFQ Form -->
            <div class="lg:col-span-7 bg-surface-container-lowest text-on-surface p-8 rounded shadow-xl">
              <h3 class="font-headline-sm text-headline-sm text-primary mb-2">Request Architectural Consultation &amp;
                Tender Pricing</h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant mb-6">Complete the engineering fields below
                for custom production runs and export quotation.</p>
              <form class="space-y-4" id="rfq-form">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <!-- Project Name -->
                  <div>
                    <label class="block font-label-sm text-label-sm uppercase text-outline mb-1 font-semibold">Project
                      Name *</label>
                    <input
                      class="w-full px-3 py-2.5 rounded bg-surface font-body-sm text-body-sm text-on-surface border border-outline-variant focus:outline-none focus:border-secondary transition-colors"
                      placeholder="e.g. Dubai Marina Horizon Tower" required="" type="text" />
                  </div>
                  <!-- Location / Country -->
                  <div>
                    <label class="block font-label-sm text-label-sm uppercase text-outline mb-1 font-semibold">Country /
                      Project City *</label>
                    <input
                      class="w-full px-3 py-2.5 rounded bg-surface font-body-sm text-body-sm text-on-surface border border-outline-variant focus:outline-none focus:border-secondary transition-colors"
                      placeholder="e.g. Riyadh, Saudi Arabia / Sydney, AU" required="" type="text" />
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <!-- System of Interest -->
                  <div>
                    <label class="block font-label-sm text-label-sm uppercase text-outline mb-1 font-semibold">System
                      Line *</label>
                    <select
                      class="w-full px-3 py-2.5 rounded bg-surface font-body-sm text-body-sm text-on-surface border border-outline-variant focus:outline-none focus:border-secondary transition-colors cursor-pointer">
                      <option>Solid Aluminum Panels (3.0mm)</option>
                      <option>Intelligent Motorized Louvers</option>
                      <option>Aluminum Honeycomb Panels</option>
                      <option>Corrugated Core Panels (ACCP)</option>
                      <option>Architectural Steel Wall Panels</option>
                      <option>Aluminum Grilles / Screens</option>
                      <option>Sunshade S-Blade Louvers</option>
                      <option>Aluminum Composite (ACP)</option>
                      <option>Metal Acoustic Ceilings</option>
                      <option>Insulated Metal Panels</option>
                      <option>Coil Coated Aluminum Sheets</option>
                    </select>
                  </div>
                  <!-- Estimated Surface Area -->
                  <div>
                    <label class="block font-label-sm text-label-sm uppercase text-outline mb-1 font-semibold">Est.
                      Quantity (m²) *</label>
                    <input
                      class="w-full px-3 py-2.5 rounded bg-surface font-body-sm text-body-sm text-on-surface border border-outline-variant focus:outline-none focus:border-secondary transition-colors"
                      placeholder="e.g. 8,500 m²" required="" type="text" />
                  </div>
                  <!-- Fire Specification Requirement -->
                  <div>
                    <label class="block font-label-sm text-label-sm uppercase text-outline mb-1 font-semibold">Fire
                      Requirement</label>
                    <select
                      class="w-full px-3 py-2.5 rounded bg-surface font-body-sm text-body-sm text-on-surface border border-outline-variant focus:outline-none focus:border-secondary transition-colors cursor-pointer">
                      <option>EN 13501-1 Class A2-s1, d0</option>
                      <option>ASTM E84 Non-Combustible</option>
                      <option>Standard Architectural Grade</option>
                    </select>
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <!-- Name & Company -->
                  <div>
                    <label class="block font-label-sm text-label-sm uppercase text-outline mb-1 font-semibold">Full Name
                      &amp; Title *</label>
                    <input
                      class="w-full px-3 py-2.5 rounded bg-surface font-body-sm text-body-sm text-on-surface border border-outline-variant focus:outline-none focus:border-secondary transition-colors"
                      placeholder="Eng. Robert Mitchell (Facade Director)" required="" type="text" />
                  </div>
                  <!-- Corporate Email -->
                  <div>
                    <label class="block font-label-sm text-label-sm uppercase text-outline mb-1 font-semibold">Corporate
                      Email *</label>
                    <input
                      class="w-full px-3 py-2.5 rounded bg-surface font-body-sm text-body-sm text-on-surface border border-outline-variant focus:outline-none focus:border-secondary transition-colors"
                      placeholder="r.mitchell@engineering-firm.com" required="" type="email" />
                  </div>
                </div>
                <!-- Upload Field -->
                <div
                  class="p-4 rounded border border-dashed border-outline-variant bg-surface hover:bg-surface-container-low transition-colors flex flex-col items-center justify-center text-center cursor-pointer">
                  <span class="material-symbols-outlined text-3xl text-secondary mb-1">cloud_upload</span>
                  <span class="font-label-md text-label-md text-on-surface font-semibold">Attach Elevation Drawings or
                    Tender Schedule</span>
                  <span class="font-label-sm text-label-sm text-outline mt-0.5">Accepts DWG, RVT (Revit), PDF, STP up to
                    100MB</span>
                </div>
                <!-- Submit Button -->
                <button
                  class="w-full py-3.5 px-6 rounded bg-primary hover:bg-secondary text-on-primary font-headline-sm text-headline-sm uppercase tracking-wider transition-colors shadow-md flex items-center justify-center gap-2"
                  type="submit">
                  <span class="material-symbols-outlined">send</span>
                  <span>Submit for Engineering Review &amp; CIF Pricing</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- 7. TECHNICAL SPECIFICATION MODAL DIALOG CONTAINER (HIDDEN BY DEFAULT) -->
      <div class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4"
        id="spec-modal">
        <div
          class="bg-surface-container-lowest rounded max-w-3xl w-full max-h-[921px] overflow-y-auto p-6 md:p-8 space-y-6 relative shadow-2xl">
          <!-- Close Button -->
          <button class="absolute top-4 right-4 p-2 text-outline hover:text-on-surface transition-colors"
            id="close-modal">
            <span class="material-symbols-outlined text-2xl">close</span>
          </button>
          <div>
            <div class="font-label-sm text-label-sm text-secondary uppercase font-semibold">Standard Schedule &amp; BIM
              Reference</div>
            <h3 class="font-headline-md text-headline-md text-on-surface mt-1" id="modal-title">Detailed Technical
              Specifications</h3>
          </div>
          <div class="space-y-4 font-body-sm text-body-sm text-on-surface" id="modal-content">
            <!-- Injected via javascript -->
          </div>
          <div class="flex items-center justify-end gap-3 pt-4 border-t border-surface-container">
            <button
              class="px-4 py-2 rounded bg-surface-container-high hover:bg-surface-variant font-label-md text-label-md text-on-surface"
              id="modal-secondary-btn">
              Close Window
            </button>
            <a class="px-4 py-2 rounded bg-primary hover:bg-secondary text-on-primary font-label-md text-label-md uppercase tracking-wider transition-colors"
              href="#rfq-section" id="modal-inquire-btn">
              Inquire This Specific Model
            </a>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        // 1. DYNAMIC CATEGORY & PARAMETER FILTERING
        // 分类标签联动后台「产品分类」；参数下拉与产品的「产品特性」字段文本匹配
        const tabs = document.querySelectorAll('.filter-tab');
        const products = document.querySelectorAll('.product-item');
        const productCount = document.getElementById('product-count');

        const fireSelect = document.getElementById('filter-fire');
        const alloySelect = document.getElementById('filter-alloy');
        const coatingSelect = document.getElementById('filter-coating');
        const thicknessSelect = document.getElementById('filter-thickness');

        function applyFilters() {
          const activeTab = document.querySelector('.filter-tab.active');
          const activeFilter = activeTab ? activeTab.getAttribute('data-filter') : 'all';
          const fireVal = fireSelect.value.toLowerCase();
          const alloyVal = alloySelect.value.toLowerCase();
          const coatingVal = coatingSelect.value.toLowerCase();
          const thicknessVal = thicknessSelect.value.toLowerCase();

          let visible = 0;

          products.forEach(item => {
            const itemCats = (item.getAttribute('data-categories') || '').split(/\s+/);
            const itemSpecs = item.getAttribute('data-specs') || '';

            const matchesCat = (activeFilter === 'all') || itemCats.includes(activeFilter);
            const matchesFire = (fireVal === 'all') || itemSpecs.includes(fireVal);
            const matchesAlloy = (alloyVal === 'all') || itemSpecs.includes(alloyVal);
            const matchesCoating = (coatingVal === 'all') || itemSpecs.includes(coatingVal);
            const matchesThickness = (thicknessVal === 'all') || itemSpecs.includes(thicknessVal);

            if (matchesCat && matchesFire && matchesAlloy && matchesCoating && matchesThickness) {
              item.classList.remove('hidden');
              visible++;
            } else {
              item.classList.add('hidden');
            }
          });

          if (productCount) {
            productCount.textContent = `${visible} of ${products.length}`;
          }
        }

        tabs.forEach(tab => {
          tab.addEventListener('click', () => {
            tabs.forEach(t => {
              t.classList.remove('active', 'bg-primary', 'text-on-primary');
              t.classList.add('bg-surface-container-high', 'text-on-surface');
            });
            tab.classList.add('active', 'bg-primary', 'text-on-primary');
            tab.classList.remove('bg-surface-container-high', 'text-on-surface');
            applyFilters();
          });
        });

        if (fireSelect) fireSelect.addEventListener('change', applyFilters);
        if (alloySelect) alloySelect.addEventListener('change', applyFilters);
        if (coatingSelect) coatingSelect.addEventListener('change', applyFilters);
        if (thicknessSelect) thicknessSelect.addEventListener('change', applyFilters);

        // 2. SPECIFICATION MODAL BEHAVIOR
        const modal = document.getElementById('spec-modal');
        const closeModal = document.getElementById('close-modal');
        const modalSecondary = document.getElementById('modal-secondary-btn');
        const modalInquire = document.getElementById('modal-inquire-btn');
        const modalTitle = document.getElementById('modal-title');
        const modalContent = document.getElementById('modal-content');
        const modalTriggers = document.querySelectorAll('.spec-modal-trigger');

        const specData = {
          "4": {
            title: "Intelligent Motorized / Dynamic Solar-Tracking Louvers (ALU-SYS-MOT900)",
            content: `
          <div class="grid grid-cols-2 gap-4 bg-surface-container-low p-4 rounded font-label-sm text-label-sm mb-4">
            <div><strong class="text-secondary">Extrusion Alloy:</strong> AA6063-T6 Structural Profile</div>
            <div><strong class="text-secondary">Motor Protocol:</strong> Modbus RTU / BACnet IP / KNX 24V</div>
            <div><strong class="text-secondary">Operating Temp:</strong> -35°C to +80°C Desert Tested</div>
            <div><strong class="text-secondary">Windload Deflection:</strong> Tested under static 5.5 kPa</div>
          </div>
          <p>Features internal microprocessor intelligence capable of automated sun tracking based on astronomical GPS algorithms or daylight sensor inputs. Louvers are engineered with fail-safe automatic storm retraction modes.</p>
          <ul class="list-disc pl-5 space-y-1 font-body-sm text-body-sm text-on-surface-variant">
            <li>Fully certified under CE EN 13659 (Shutters and external blinds performance)</li>
            <li>Stainless steel AISI 316 internal linkage rods and self-lubricating bronze bearings</li>
            <li>Available with integrated photovoltaic solar harvesting strips on top blade face</li>
          </ul>
        `
          },
          "6": {
            title: "Solid Aluminum Cladding Panels (ALU-SLD-3003)",
            content: `
          <div class="grid grid-cols-2 gap-4 bg-surface-container-low p-4 rounded font-label-sm text-label-sm mb-4">
            <div><strong class="text-secondary">Standard Thickness:</strong> 2.5mm / 3.0mm / 4.0mm</div>
            <div><strong class="text-secondary">Surface Coating:</strong> 3-Coat 70% Kynar 500 PVDF (35μm)</div>
            <div><strong class="text-secondary">Fire Classification:</strong> EN 13501-1 Class A1 / A2</div>
            <div><strong class="text-secondary">Standard ASTM:</strong> ASTM B209M / AAMA 2605</div>
          </div>
          <p>Fabricated through precision CNC shearing, grooving, bending, and stud welding. Backside features factory-bonded extruded hat-channel stiffeners to ensure flawless wind deflection compliance without oil-canning.</p>
        `
          },
          "8": {
            title: "Aluminum Honeycomb Composite Panels (ALU-HNY-6000)",
            content: `
          <div class="grid grid-cols-2 gap-4 bg-surface-container-low p-4 rounded font-label-sm text-label-sm mb-4">
            <div><strong class="text-secondary">Total Panel Depth:</strong> 10mm, 15mm, 20mm, 25mm, 50mm</div>
            <div><strong class="text-secondary">Core Cell Size:</strong> 1/4" (6.35mm) Hexagonal Foil</div>
            <div><strong class="text-secondary">Skin Thickness:</strong> 1.0mm front / 0.8mm rear</div>
            <div><strong class="text-secondary">Peel Resistance:</strong> > 130 N·mm/mm</div>
          </div>
          <p>Manufactured on a continuous hot-press aerospace lamination line using two-component polyurethane thermosetting adhesive. Ideal for monumental flat curtain walls and extreme wind suction zones.</p>
        `
          }
        };

        modalTriggers.forEach(btn => {
          btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-modal');
            const data = specData[id] || {
              title: "Technical Specification Schedule",
              content: "<p>Detailed submittal package, BIM LOD 400 objects, and material test reports can be requested directly via our export desk using the inquiry form below.</p>"
            };

            if (modalTitle) modalTitle.textContent = data.title;
            if (modalContent) modalContent.innerHTML = data.content;
            if (modal) modal.classList.remove('hidden');
          });
        });

        function hideModal() {
          if (modal) modal.classList.add('hidden');
        }

        if (closeModal) closeModal.addEventListener('click', hideModal);
        if (modalSecondary) modalSecondary.addEventListener('click', hideModal);
        if (modalInquire) modalInquire.addEventListener('click', hideModal);

        // Close when clicking modal backdrop
        if (modal) {
          modal.addEventListener('click', (e) => {
            if (e.target === modal) hideModal();
          });
        }

        // 4. RFQ SUBMISSION MICRO-INTERACTION
        const rfqForm = document.getElementById('rfq-form');
        if (rfqForm) {
          rfqForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const submitBtn = rfqForm.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;

            submitBtn.innerHTML = `
          <span class="material-symbols-outlined animate-spin text-xl">progress_activity</span>
          <span>Transmitting Tender Data...</span>
        `;
            submitBtn.disabled = true;

            setTimeout(() => {
              submitBtn.innerHTML = `
            <span class="material-symbols-outlined text-xl">check_circle</span>
            <span>RFQ Received // Engineering Desk Assigned</span>
          `;
              submitBtn.classList.remove('bg-primary');
              submitBtn.classList.add('bg-secondary');
              rfqForm.reset();

              setTimeout(() => {
                submitBtn.innerHTML = originalContent;
                submitBtn.classList.add('bg-primary');
                submitBtn.classList.remove('bg-secondary');
                submitBtn.disabled = false;
              }, 4000);
            }, 1200);
          });
        }
      });
    </script>
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
