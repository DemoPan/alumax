<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
  <main class="w-full pt-20 bg-surface">
    <div class="flex flex-col w-full">
      <!-- Top Breadcrumb & Live Certification Banner -->
      <section class="w-full bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-margin py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
          <div class="flex items-center gap-2 font-label-md text-label-md text-on-surface-variant">
            <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home"
              href="<?php echo esc_url(home_url('/')); ?>">
              <span class="material-symbols-outlined text-base">home</span>
              <span class="">Home</span>
            </a>
            <span class="">/</span>
            <span class="text-primary font-medium">Projects &amp; Case Studies Archive</span>
          </div>
          <div class="inline-flex items-center gap-2 bg-surface-container-lowest px-3 py-1.5 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface">
              60+ GLOBAL LANDMARK INSTALLATIONS <span class="text-outline-variant font-light mx-1">|</span> ASTM E330
              &amp; CWCT VERIFIED <span class="text-outline-variant font-light mx-1">|</span> EN 13501 A2-s1,d0
            </span>
          </div>
        </div>
      </section>
      <!-- Hero & Global Delivery Metrics Strip -->
      <section class="w-full bg-surface py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-margin">
          <div class="max-w-4xl space-y-4">
            <div
              class="inline-flex items-center gap-2 px-3 py-1 bg-secondary-container text-on-secondary-container font-label-sm text-label-sm uppercase tracking-widest">
              <span class="material-symbols-outlined text-sm">verified</span>
              Tier-1 Global Architectural Portfolios &amp; Engineering References
            </div>
            <h1 class="font-display-xl text-display-xl text-primary tracking-tight">
              Landmark Architectural Facades &amp; Global Installations
            </h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl pt-2">
              Explore precision-manufactured exterior cladding, solid aluminum cassettes, dynamic kinetic solar louvers,
              and bespoke honeycomb envelope assemblies engineered for iconic international towers, cultural
              institutions, and mega airport hubs.
            </p>
          </div>
          <!-- Quick Key Metrics Strip -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter mt-12">
            <div class="bg-surface-container-lowest p-6 shadow-sm relative overflow-hidden group">
              <div class="w-1.5 h-full bg-secondary absolute left-0 top-0"></div>
              <div class="flex items-center justify-between mb-2">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Installed
                  Envelope Area</span>
                <span class="material-symbols-outlined text-secondary text-2xl">layers</span>
              </div>
              <div class="font-display-lg text-display-lg text-primary tracking-tight">1.2M+ <span
                  class="font-headline-sm text-headline-sm text-secondary">m²</span></div>
              <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">Certified exterior curtain wall and
                cladding surfaces delivered globally.</p>
            </div>
            <div class="bg-surface-container-lowest p-6 shadow-sm relative overflow-hidden group">
              <div class="w-1.5 h-full bg-primary absolute left-0 top-0"></div>
              <div class="flex items-center justify-between mb-2">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Global
                  Reach</span>
                <span class="material-symbols-outlined text-primary text-2xl">public</span>
              </div>
              <div class="font-display-lg text-display-lg text-primary tracking-tight">60+ <span
                  class="font-headline-sm text-headline-sm text-on-surface-variant">Nations</span></div>
              <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">Active presence across GCC, EU, UK,
                ASEAN, and the Americas.</p>
            </div>
            <div class="bg-surface-container-lowest p-6 shadow-sm relative overflow-hidden group">
              <div class="w-1.5 h-full bg-secondary absolute left-0 top-0"></div>
              <div class="flex items-center justify-between mb-2">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Milling &amp;
                  Curvature Tolerance</span>
                <span class="material-symbols-outlined text-secondary text-2xl">precision_manufacturing</span>
              </div>
              <div class="font-display-lg text-display-lg text-primary tracking-tight">±0.3 <span
                  class="font-headline-sm text-headline-sm text-secondary">mm</span></div>
              <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">German 5-axis CNC machining centers for
                flawless joint reveals.</p>
            </div>
            <div class="bg-surface-container-lowest p-6 shadow-sm relative overflow-hidden group">
              <div class="w-1.5 h-full bg-primary absolute left-0 top-0"></div>
              <div class="flex items-center justify-between mb-2">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">QC Logistics
                  Pass Rate</span>
                <span class="material-symbols-outlined text-primary text-2xl">verified_user</span>
              </div>
              <div class="font-display-lg text-display-lg text-primary tracking-tight">99.98%</div>
              <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">Export sea-transit crating standard with
                zero micro-scratch assurance.</p>
            </div>
          </div>
        </div>
      </section>
      <!-- Interactive Filter & Specification Search Suite -->
      <section class="w-full bg-surface-container-lowest py-8 shadow-sm">
        <div class="max-w-7xl mx-auto px-margin space-y-6">
          <!-- Search and Views -->
          <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            <div class="relative flex-1">
              <span
                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">search</span>
              <input
                class="w-full pl-12 pr-4 h-12 bg-surface text-on-surface placeholder-on-surface-variant font-body-md text-body-md outline-none focus:bg-surface-container-low transition-colors"
                placeholder="Search project name, city, architect, alloy grade (e.g. KAFD, Singapore, AA5052, Louvre)..."
                type="text">
            </div>
            <div class="flex items-center gap-3 self-end lg:self-auto">
              <div class="bg-surface-container flex p-1">
                <button
                  class="px-4 py-2 bg-surface-container-lowest shadow-sm text-primary flex items-center gap-2 font-label-sm text-label-sm uppercase">
                  <span class="material-symbols-outlined text-base">grid_view</span>
                  <span class="">Grid View</span>
                </button>
                <button
                  class="px-4 py-2 text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-2 font-label-sm text-label-sm uppercase">
                  <span class="material-symbols-outlined text-base">table_rows</span>
                  <span class="">Spec Schedule</span>
                </button>
              </div>
              <button
                class="h-12 px-5 bg-surface-container-high text-on-surface hover:bg-secondary hover:text-on-secondary transition-colors font-label-sm text-label-sm uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-base">tune</span>
                <span class="">Reset (58)</span>
              </button>
            </div>
          </div>
          <!-- Region Filter Tabs -->
          <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
            <button
              class="px-5 py-2.5 bg-primary-container text-on-primary font-label-md text-label-md uppercase whitespace-nowrap">
              All Regions (58)
            </button>
            <button
              class="px-5 py-2.5 bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors font-label-md text-label-md uppercase whitespace-nowrap">
              Middle East &amp; GCC (24)
            </button>
            <button
              class="px-5 py-2.5 bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors font-label-md text-label-md uppercase whitespace-nowrap">
              Europe &amp; UK (16)
            </button>
            <button
              class="px-5 py-2.5 bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors font-label-md text-label-md uppercase whitespace-nowrap">
              Asia-Pacific (11)
            </button>
            <button
              class="px-5 py-2.5 bg-surface-container-low text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors font-label-md text-label-md uppercase whitespace-nowrap">
              North America (7)
            </button>
          </div>
          <!-- Dropdown Selectors: System, Typology, Code Verification -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
            <div class="flex flex-col gap-1">
              <label class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Cladding /
                Envelope System</label>
              <div class="relative">
                <select
                  class="w-full h-11 px-4 pr-10 bg-surface text-on-surface font-label-md text-label-md appearance-none outline-none cursor-pointer">
                  <option>All Systems Matrix</option>
                  <option>Solid Aluminum Cladding (2.5mm - 4.0mm)</option>
                  <option>Intelligent Motorized Solar Louvers</option>
                  <option>Calibrated Honeycomb Composite Panels</option>
                  <option>Corrugated Core Lightweight Panels (ACCP)</option>
                  <option>Bespoke CNC Perforated Art Screens</option>
                </select>
                <span
                  class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none text-lg">expand_more</span>
              </div>
            </div>
            <div class="flex flex-col gap-1">
              <label class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Building
                Typology</label>
              <div class="relative">
                <select
                  class="w-full h-11 px-4 pr-10 bg-surface text-on-surface font-label-md text-label-md appearance-none outline-none cursor-pointer">
                  <option>All Typologies</option>
                  <option>Supertall Commercial &amp; Towers</option>
                  <option>International Airport &amp; Transit Hubs</option>
                  <option>Corporate Headquarters &amp; Campuses</option>
                  <option>Cultural Pavilions &amp; Civic Arenas</option>
                  <option>Maritime Ports &amp; Specialized Coastal Facilities</option>
                </select>
                <span
                  class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none text-lg">expand_more</span>
              </div>
            </div>
            <div class="flex flex-col gap-1">
              <label class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant">Engineering
                Code / Fire Rating</label>
              <div class="relative">
                <select
                  class="w-full h-11 px-4 pr-10 bg-surface text-on-surface font-label-md text-label-md appearance-none outline-none cursor-pointer">
                  <option>All Verified Standards</option>
                  <option>ASTM E84 Class A Fire Certified</option>
                  <option>EN 13501-1 Class A2-s1, d0 Combustibility</option>
                  <option>CWCT Full Facade Rig Tested</option>
                  <option>ASTM E330 Structural Deflection (≥ 5.0 kPa)</option>
                  <option>AAMA 501.4 Interstory Seismic Drift Passed</option>
                </select>
                <span
                  class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none text-lg">expand_more</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Featured Landmark Project Spotlight -->
      <section class="w-full bg-surface py-16">
        <div class="max-w-7xl mx-auto px-margin">
          <div class="flex items-center justify-between mb-8">
            <div class="space-y-1">
              <div class="flex items-center gap-2">
                <span
                  class="px-2.5 py-0.5 bg-secondary text-on-secondary font-label-sm text-label-sm uppercase tracking-wider">Spotlight
                  Reference</span>
                <span class="font-label-sm text-label-sm text-on-surface-variant">RIYADH, SAUDI ARABIA</span>
              </div>
              <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight">KAFD Tower 3 Financial District
              </h2>
            </div>
            <div class="hidden sm:flex items-center gap-2 font-label-sm text-label-sm text-on-surface-variant">
              <span class="">PROJECT ARCHIVE REF: #ALX-GCC-2024-K3</span>
            </div>
          </div>
          <!-- Main Spotlight Card Bento -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter bg-surface-container-lowest p-6 md:p-8 shadow-sm">
            <!-- Visual & In-Situ Facade Photography -->
            <div class="lg:col-span-7 flex flex-col justify-between space-y-6">
              <div class="relative overflow-hidden group">
                <img
                  class="w-full h-[440px] object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                  data-alt="Modern architectural photography of KAFD Financial Tower in Riyadh at sunset. Sleek bronze-tinted aluminum facade panels and dynamic kinetic motorized solar louvers reflecting golden desert twilight. Precision vertical joints and high-tech curtain wall cladding."
                  src="https://lh3.googleusercontent.com/aida-public/AB6AXuA9l4zjX7ku8F7DgDE4ZWZYEsb4OjsivesQZKirh38ax61AWQpqWUEjakSkX6PTWl1FVTWabYn0602fr0qrBdi0LygjE54EUjLybMNFbCO0FIgk5jkiObvup-UbcLQk3aidVQ9Ywd34mDwDq6Y38N93WJvc4ZMDS7qX9q3gwaTIdNQBtk6Iv5aYZvznTymzwmSUk22oWUSE_RIgVD7LzgVYrMAPifjR-XMTkQQRLqya0QjPT-riEJ0W">
                <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                  <span
                    class="px-3 py-1 bg-primary-container text-on-primary font-label-sm text-label-sm uppercase">LEED
                    Platinum</span>
                  <span
                    class="px-3 py-1 bg-surface-container-lowest/90 backdrop-blur-md text-primary font-label-sm text-label-sm uppercase">CWCT
                    Rig Certified</span>
                  <span class="px-3 py-1 bg-secondary text-on-secondary font-label-sm text-label-sm uppercase">Dynamic
                    Tracking</span>
                </div>
                <div
                  class="absolute bottom-4 left-4 right-4 p-4 bg-primary-container/90 backdrop-blur-md text-on-primary flex items-center justify-between">
                  <div>
                    <span class="font-label-sm text-label-sm uppercase text-secondary-fixed block">Facade
                      Technology</span>
                    <span class="font-body-md text-body-md font-medium">Kinetic Micro-Perforated Sun-Shields + Solid
                      Aluminum Spandrel Envelope</span>
                  </div>
                  <span class="material-symbols-outlined text-secondary text-2xl">cyclone</span>
                </div>
              </div>
              <div class="grid grid-cols-3 gap-4">
                <div class="bg-surface-container-low p-4">
                  <span class="font-label-sm text-label-sm uppercase text-on-surface-variant block">Delivered
                    Envelope</span>
                  <span class="font-headline-sm text-headline-sm text-primary">22,700 m²</span>
                  <span class="font-label-sm text-label-sm text-secondary block mt-1">14.2k m² Louvers + 8.5k m²
                    Panels</span>
                </div>
                <div class="bg-surface-container-low p-4">
                  <span class="font-label-sm text-label-sm uppercase text-on-surface-variant block">Alloy &amp;
                    Substrate</span>
                  <span class="font-headline-sm text-headline-sm text-primary">AA5052-H32</span>
                  <span class="font-label-sm text-label-sm text-on-surface-variant block mt-1">4.0mm CNC Deep
                    Formed</span>
                </div>
                <div class="bg-surface-container-low p-4">
                  <span class="font-label-sm text-label-sm uppercase text-on-surface-variant block">Thermal Shift</span>
                  <span class="font-headline-sm text-headline-sm text-secondary">-34.2%</span>
                  <span class="font-label-sm text-label-sm text-on-surface-variant block mt-1">Peak Solar SHGC
                    0.14</span>
                </div>
              </div>
            </div>
            <!-- Technical Specification & Submittal Matrix -->
            <div class="lg:col-span-5 flex flex-col justify-between space-y-6">
              <div>
                <div class="pb-4">
                  <span class="font-label-sm text-label-sm uppercase text-secondary font-medium tracking-wider">Dynamic
                    Motorized Envelope Deployment</span>
                  <h3 class="font-headline-md text-headline-md text-primary mt-1">Engineering Specification Breakdown
                  </h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">
                    Engineered to resist catastrophic desert thermal cycles and abrasive sandstorm micro-erosion. Fitted
                    with industrial stepper motors communicating via BACnet directly with building BMS.
                  </p>
                </div>
                <!-- Detailed Spec Table -->
                <div class="space-y-2 pt-2">
                  <div class="flex items-center justify-between p-3 bg-surface-container-low">
                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Surface Finish
                      Spec</span>
                    <span class="font-label-md text-label-md font-semibold text-primary">PPG Duranar XL 3-Coat
                      PVDF</span>
                  </div>
                  <div class="flex items-center justify-between p-3 bg-surface-container">
                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Color Designation</span>
                    <span class="font-label-md text-label-md font-medium text-primary">Desert Sand Metallic (Matte
                      25°)</span>
                  </div>
                  <div class="flex items-center justify-between p-3 bg-surface-container-low">
                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Windload Proof
                      Testing</span>
                    <span class="font-label-md text-label-md font-semibold text-secondary">ASTM E330 6.20 kPa
                      Ultimate</span>
                  </div>
                  <div class="flex items-center justify-between p-3 bg-surface-container">
                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Air &amp; Water
                      Infiltration</span>
                    <span class="font-label-md text-label-md font-medium text-primary">CWCT 1,200 Pa Air / 600 Pa
                      Water</span>
                  </div>
                  <div class="flex items-center justify-between p-3 bg-surface-container-low">
                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Fire Reaction
                      Index</span>
                    <span class="font-label-md text-label-md font-semibold text-primary">EN 13501-1 Class A1 / A2
                      Non-Combustible</span>
                  </div>
                  <div class="flex items-center justify-between p-3 bg-surface-container">
                    <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Manufacturing
                      Cycle</span>
                    <span class="font-label-md text-label-md font-medium text-primary">Foshan Mega Plant, Bay 4 (62
                      Days)</span>
                  </div>
                </div>
              </div>
              <!-- Spotlight CTAs -->
              <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-4">
                <a class="flex-1 h-12 bg-primary-container text-on-primary hover:bg-secondary hover:text-on-secondary transition-colors font-headline-sm text-label-md uppercase tracking-wider flex items-center justify-center gap-2"
                  data-path="contact-us" href="<?php echo esc_url(home_url('/contact/')); ?>">
                  <span class="">View Case Study Report</span>
                  <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
                <a class="h-12 px-5 bg-surface-container text-primary hover:bg-surface-container-high transition-colors font-label-md text-label-md uppercase tracking-wider flex items-center justify-center gap-2"
                  data-path="resources" href="<?php echo esc_url(home_url('/resources/')); ?>">
                  <span class="material-symbols-outlined text-lg">folder_zip</span>
                  <span class="">BIM Submittal (18.4MB)</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Global Landmark Projects Grid (6 Reference Icons) -->
      <section class="w-full bg-surface-container-low py-16">
        <div class="max-w-7xl mx-auto px-margin space-y-12">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
              <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-medium">Project
                Index Matrix</span>
              <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">International Landmark
                Installations</h2>
            </div>
            <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md">
              Precision prefabricated assemblies engineered to meet municipal building envelope fire standards, extreme
              wind deflection criteria, and tight construction timelines.
            </p>
          </div>
          <!-- 6-Card High-Performance Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <div
              class="bg-surface-container-lowest flex flex-col justify-between shadow-sm hover:shadow-md transition-all duration-300 group">
              <div>
                <div class="relative overflow-hidden aspect-[16/10]">
                  <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?>
                  <?php else : ?>
                  <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    alt="<?php echo esc_attr(get_the_title()); ?>"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNhhALaG1JSYrw57ZzWiS9ev6jkWxpCmjGF8qaOwuPZP0XJf1WbpGL2aeUsKwXGC9UiNm2JcFhtSKQPLsRBzZu0jE3gw2CPZLZQBN0HHQhPJC5kD75T4dSLlBAcAU7Q5PMVmNDX29BDNK_zBjsHhwFaz4Z-RWf5eKCi0vWFUgA5QgzhlLGXPkiYiLNUV1hdvy9XRZBeQhQg9IVK2AZ3k_TItDUwnLr72Nu1mVTg-Kn9EauH2QaFeRH">
                  <?php endif; ?>
                </div>
                <div class="p-6 space-y-4">
                  <div>
                    <h3
                      class="font-headline-md text-headline-md text-primary mt-1 group-hover:text-secondary transition-colors">
                      <?php echo esc_html(get_the_title()); ?>
                    </h3>
                    <span class="font-label-sm text-label-sm text-on-surface-variant block mt-0.5"><?php echo esc_html(get_the_excerpt()); ?></span>
                  </div>
                </div>
              </div>
              <div class="p-6 pt-0">
                <a class="w-full h-11 bg-surface-container hover:bg-primary-container hover:text-on-primary transition-colors text-primary font-label-sm text-label-sm uppercase flex items-center justify-center gap-2"
                  href="<?php echo esc_url(get_the_permalink()); ?>">
                  <span class="">View Case Study</span>
                  <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
              </div>
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <p class="col-span-full py-12 text-center font-body-md text-body-md text-on-surface-variant">
              <?php esc_html_e('No case studies published yet. Please check back soon.', 'alumax'); ?>
            </p>
            <?php endif; ?>
          </div>
          <!-- Pagination -->
          <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-6">
            <?php
            the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => '<span class="material-symbols-outlined text-lg">chevron_left</span>',
                'next_text' => '<span class="material-symbols-outlined text-lg">chevron_right</span>',
            ]);
            ?>
          </div>
        </div>
      </section>
      <!-- Global Logistics, Sea-Freight & Overseas Erection Assurance -->
      <section class="w-full bg-surface py-16">
        <div class="max-w-7xl mx-auto px-margin space-y-12">
          <div class="max-w-3xl space-y-2">
            <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-medium">Export
              Rigor</span>
            <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight">Heavy Industrial Packaging &amp;
              Ocean Logistics</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">
              Standardized containerized packing engineered specifically for intermodal sea transit, zero condensation
              damage, and streamlined site sequencing.
            </p>
          </div>
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <!-- Regional Distribution Breakdown Card with Inline SVG Chart -->
            <div
              class="lg:col-span-4 bg-surface-container-lowest p-6 shadow-sm flex flex-col justify-between space-y-6">
              <div>
                <div class="flex items-center justify-between pb-4">
                  <span class="font-label-sm text-label-sm uppercase text-on-surface-variant">Global Dispatch
                    Portfolio</span>
                  <span class="material-symbols-outlined text-secondary">pie_chart</span>
                </div>
                <!-- Inline SVG Regional Donut Visualization -->
                <div class="flex items-center justify-center py-4">
                  <div class="relative w-48 h-48">
                    <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">
                      <!-- GCC / Middle East: 45% (dasharray 127, circumference ~283, radius 45) -->
                      <circle cx="50" cy="50" fill="none" r="45" stroke="#7b5825" stroke-dasharray="127 283"
                        stroke-dashoffset="0" stroke-width="10"></circle>
                      <!-- Europe & UK: 30% (dasharray 85) -->
                      <circle cx="50" cy="50" fill="none" r="45" stroke="#0f1c2c" stroke-dasharray="85 283"
                        stroke-dashoffset="-127" stroke-width="10"></circle>
                      <!-- Asia-Pacific & Americas: 25% (dasharray 71) -->
                      <circle cx="50" cy="50" fill="none" r="45" stroke="#bac8dc" stroke-dasharray="71 283"
                        stroke-dashoffset="-212" stroke-width="10"></circle>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                      <span class="font-display-lg text-display-lg text-primary leading-none">60+</span>
                      <span class="font-label-sm text-label-sm text-on-surface-variant uppercase mt-1">Countries</span>
                    </div>
                  </div>
                </div>
                <!-- Legend -->
                <div class="space-y-2 pt-4">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                      <span class="w-3 h-3 bg-secondary"></span>
                      <span class="font-label-sm text-label-sm text-on-surface">GCC &amp; Middle East</span>
                    </div>
                    <span class="font-label-sm text-label-sm font-semibold text-primary">45%</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                      <span class="w-3 h-3 bg-primary-container"></span>
                      <span class="font-label-sm text-label-sm text-on-surface">Europe, UK &amp; Scandinavia</span>
                    </div>
                    <span class="font-label-sm text-label-sm font-semibold text-primary">30%</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                      <span class="w-3 h-3 bg-primary-fixed-dim"></span>
                      <span class="font-label-sm text-label-sm text-on-surface">Asia-Pacific &amp; Americas</span>
                    </div>
                    <span class="font-label-sm text-label-sm font-semibold text-primary">25%</span>
                  </div>
                </div>
              </div>
              <div class="p-3 bg-surface-container text-on-surface-variant font-label-sm text-label-sm">
                Direct departures via FOB Nansha, Yantian, and Ningbo container hubs.
              </div>
            </div>
            <!-- 3 Feature Pillars of Sea-Freight & Packaging -->
            <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-3 gap-gutter">
              <div class="bg-surface-container-lowest p-6 shadow-sm flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                  <div class="w-12 h-12 bg-surface-container flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">package_2</span>
                  </div>
                  <h4 class="font-headline-sm text-headline-sm text-primary">Fumigation-Free Plywood Crating</h4>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Panels individually isolated with double 80-micron protective film, edge corner guards, desiccant
                    bags, and heavy-duty steel bands for intermodal stability.
                  </p>
                </div>
                <div class="p-3 bg-surface-container-low font-label-sm text-label-sm text-secondary font-semibold">
                  99.98% Damage-Free Delivery
                </div>
              </div>
              <div class="bg-surface-container-lowest p-6 shadow-sm flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                  <div class="w-12 h-12 bg-surface-container flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-2xl">science</span>
                  </div>
                  <h4 class="font-headline-sm text-headline-sm text-primary">4,000h Salt Spray Salt-Fog ASTM B117</h4>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Every marine and coastal batch receives laboratory validation to guarantee zero blistering,
                    delamination, or edge corrosion in extreme marine environments.
                  </p>
                </div>
                <div class="p-3 bg-surface-container-low font-label-sm text-label-sm text-primary font-semibold">
                  ISO 9227 &amp; Qualicoat Class 2
                </div>
              </div>
              <div class="bg-surface-container-lowest p-6 shadow-sm flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                  <div class="w-12 h-12 bg-surface-container flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">schedule</span>
                  </div>
                  <h4 class="font-headline-sm text-headline-sm text-primary">18-25 Days Lead to Port</h4>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    From shop drawing approval to shipping container seal. Fast-track fabrication sequencing aligned
                    with overseas tower crane schedules and milestone tenders.
                  </p>
                </div>
                <div class="p-3 bg-surface-container-low font-label-sm text-label-sm text-secondary font-semibold">
                  Dedicated Berth Logistics
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Fast-Track Engineering Consultation & Tender RFP Submission -->
      <section class="w-full bg-primary-container text-on-primary py-16">
        <div class="max-w-7xl mx-auto px-margin">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <!-- Left: RFP Prompt & Assurances -->
            <div class="lg:col-span-5 space-y-6">
              <div
                class="inline-flex items-center gap-2 px-3 py-1 bg-secondary text-on-secondary font-label-sm text-label-sm uppercase tracking-wider">
                Fast-Track Engineering Services
              </div>
              <h2 class="font-headline-lg text-headline-lg tracking-tight">
                Initiate Project Submittal &amp; Facade Engineering Tender
              </h2>
              <p class="font-body-md text-body-md text-on-primary-container">
                Upload your architectural drawings, BIM files, or tender bill of quantities (BOQ). Our senior facade
                engineering desk prepares structural static calculations, wind pressure estimates, and CIF freight
                pricing within 24 business hours.
              </p>
              <div class="space-y-3 pt-4">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-secondary/20 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-lg">check</span>
                  </div>
                  <span class="font-body-sm text-body-sm">Complimentary 3D Structural Stress &amp; Wind Rig
                    Calculations</span>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-secondary/20 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-lg">check</span>
                  </div>
                  <span class="font-body-sm text-body-sm">Expedited Hand-Sample Swatch Box Dispatched via DHL
                    Express</span>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-secondary/20 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-lg">check</span>
                  </div>
                  <span class="font-body-sm text-body-sm">Certified EN / ASTM / AS Testing Submittal Package
                    Included</span>
                </div>
              </div>
              <div class="p-4 bg-surface-container-highest/10 mt-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-secondary text-2xl">support_agent</span>
                <div>
                  <span class="font-label-sm text-label-sm uppercase text-on-primary-container block">Direct Overseas
                    Engineering Desk</span>
                  <span
                    class="font-label-md text-label-md font-semibold text-on-primary">engineering@alumax-envelopes.com</span>
                </div>
              </div>
            </div>
            <!-- Right: Technical RFQ / Tender Form -->
            <div class="lg:col-span-7 bg-surface-container-lowest text-on-surface p-8 shadow-xl">
              <form class="space-y-4"
                onsubmit="event.preventDefault(); alert('Engineering submittal received. Our senior facade lead will contact you within 24 hours with static calculations.');">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="font-label-sm text-label-sm uppercase text-on-surface-variant block mb-1">Your Name /
                      Title *</label>
                    <input
                      class="w-full h-11 px-3 bg-surface border-b-2 border-outline-variant focus:border-secondary outline-none font-body-sm text-body-sm transition-colors"
                      placeholder="e.g. David Weber, Chief Façade Consultant" required="" type="text">
                  </div>
                  <div>
                    <label class="font-label-sm text-label-sm uppercase text-on-surface-variant block mb-1">Company /
                      Organization *</label>
                    <input
                      class="w-full h-11 px-3 bg-surface border-b-2 border-outline-variant focus:border-secondary outline-none font-body-sm text-body-sm transition-colors"
                      placeholder="e.g. Zaha Hadid Architects / Mace Group" required="" type="text">
                  </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="font-label-sm text-label-sm uppercase text-on-surface-variant block mb-1">Professional
                      Email *</label>
                    <input
                      class="w-full h-11 px-3 bg-surface border-b-2 border-outline-variant focus:border-secondary outline-none font-body-sm text-body-sm transition-colors"
                      placeholder="weber@consulting-facade.de" required="" type="email">
                  </div>
                  <div>
                    <label class="font-label-sm text-label-sm uppercase text-on-surface-variant block mb-1">Target
                      Project Location / Country *</label>
                    <input
                      class="w-full h-11 px-3 bg-surface border-b-2 border-outline-variant focus:border-secondary outline-none font-body-sm text-body-sm transition-colors"
                      placeholder="e.g. Riyadh, Saudi Arabia or London, UK" required="" type="text">
                  </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="font-label-sm text-label-sm uppercase text-on-surface-variant block mb-1">Primary
                      Envelope System Needed</label>
                    <select
                      class="w-full h-11 px-3 bg-surface border-b-2 border-outline-variant focus:border-secondary outline-none font-body-sm text-body-sm transition-colors">
                      <option>Solid Aluminum Cladding (2.5mm - 4.0mm)</option>
                      <option>Calibrated Honeycomb Composite Panels</option>
                      <option>Intelligent Motorized Solar Louvers</option>
                      <option>Corrugated Core Lightweight Panels (ACCP)</option>
                      <option>Mixed Complex Facade Package</option>
                    </select>
                  </div>
                  <div>
                    <label class="font-label-sm text-label-sm uppercase text-on-surface-variant block mb-1">Estimated
                      Total Facade Area (m²)</label>
                    <input
                      class="w-full h-11 px-3 bg-surface border-b-2 border-outline-variant focus:border-secondary outline-none font-body-sm text-body-sm transition-colors"
                      placeholder="e.g. 15,000 m² or BOQ attached" type="text">
                  </div>
                </div>
                <div>
                  <label class="font-label-sm text-label-sm uppercase text-on-surface-variant block mb-1">Project Scope
                    &amp; Engineering Requirements</label>
                  <textarea
                    class="w-full p-3 bg-surface border-b-2 border-outline-variant focus:border-secondary outline-none font-body-sm text-body-sm transition-colors resize-none"
                    placeholder="Detail required alloy (AA3003/AA5052), wind pressure criteria, paint coating (PPG/AkzoNobel PVDF), target handover date, and testing codes..."
                    rows="3"></textarea>
                </div>
                <!-- Drag & Drop File Upload Mimic -->
                <div
                  class="p-4 bg-surface border border-dashed border-outline-variant flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left cursor-pointer hover:bg-surface-container-low transition-colors">
                  <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary text-2xl">cloud_upload</span>
                    <div>
                      <span class="font-label-sm text-label-sm uppercase text-primary font-medium block">Upload
                        Architectural CAD / Revit / BOQ</span>
                      <span class="font-body-sm text-body-sm text-on-surface-variant">DWG, RVT, PDF, or ZIP (Up to
                        100MB)</span>
                    </div>
                  </div>
                  <span
                    class="px-3 py-1.5 bg-surface-container-high text-on-surface font-label-sm text-label-sm uppercase">Browse
                    File</span>
                </div>
                <div class="pt-2">
                  <button
                    class="w-full h-12 bg-primary-container text-on-primary hover:bg-secondary hover:text-on-secondary transition-colors font-headline-sm text-label-md uppercase tracking-wider flex items-center justify-center gap-2 shadow-sm"
                    type="submit">
                    <span class="">Submit Tender For Engineering Review &amp; Quotation</span>
                    <span class="material-symbols-outlined text-lg">send</span>
                  </button>
                  <div
                    class="flex items-center justify-center gap-4 mt-2 text-on-surface-variant font-label-sm text-label-sm">
                    <span class="">✓ Non-Disclosure Agreement (NDA) Protected</span>
                    <span class="">✓ Direct Factory Commercial Pricing</span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

<?php get_footer(); ?>
