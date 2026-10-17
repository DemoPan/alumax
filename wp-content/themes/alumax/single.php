<?php
if (!defined('ABSPATH')) { exit; }
get_header();
while (have_posts()) : the_post();
?>
  <main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
    <div class="flex flex-col w-full">
      <!-- Editorial Progress Anchor Bar -->
      <div class="sticky top-20 z-40 w-full bg-surface-container-lowest/90 backdrop-blur-md shadow-sm">
        <div class="max-w-[1440px] mx-auto px-margin py-3 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-secondary"></span>
            <span
              class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant font-semibold">Press
              Release // Dispatch DXB-2025</span>
          </div>
          <div class="hidden md:flex items-center gap-6 font-label-sm text-label-sm">
            <span class="text-on-surface-variant">DWTC Stand SS2-D41</span>
            <span class="text-outline-variant">•</span>
            <span class="text-on-surface font-semibold">Nov 24–27, 2025</span>
            <a class="px-3 py-1 bg-primary text-on-primary font-label-sm text-label-sm uppercase tracking-wider hover:bg-secondary transition-colors"
              href="#booking-card">Reserve VIP Pass</a>
          </div>
        </div>
        <div class="w-full h-[2px] bg-surface-container">
          <div class="h-full bg-secondary transition-all duration-150 w-0" id="read-progress"></div>
        </div>
      </div>
      <!-- Breadcrumb & Header Meta Block -->
      <section class="w-full bg-surface-container-low pt-8 pb-12">
        <div class="max-w-[1440px] mx-auto px-margin">
          <!-- Breadcrumbs -->
          <nav
            class="flex items-center gap-2 font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mb-8 flex-wrap">
            <a class="hover:text-primary transition-colors" data-path="home" href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span class="text-outline-variant">/</span>
            <a class="hover:text-primary transition-colors" data-path="news" href="<?php echo esc_url(alumax_news_url()); ?>">News &amp; Media</a>
            <span class="text-outline-variant">/</span>
            <span class="text-on-surface-variant">Global Exhibitions</span>
            <span class="text-outline-variant">/</span>
            <span class="text-secondary font-semibold">The Big 5 Dubai 2025</span>
          </nav>
          <!-- Meta Pill & Topic -->
          <div class="flex flex-wrap items-center gap-3 mb-6">
            <span
              class="inline-flex items-center gap-2 px-3 py-1 bg-primary-container text-secondary-fixed font-label-sm text-label-sm font-semibold uppercase tracking-wider">
              <span class="material-symbols-outlined text-[14px]">flag</span>
              <?php the_category(' '); ?>
            </span>
            <span
              class="px-2.5 py-1 bg-surface-container-highest text-on-surface-variant font-label-sm text-label-sm uppercase">
              Middle East Expansion
            </span>
            <span
              class="px-2.5 py-1 bg-surface-container-highest text-on-surface-variant font-label-sm text-label-sm uppercase">
              Live Stand Preview
            </span>
          </div>
          <!-- Main Editorial Headline -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-9">
              <h1
                class="font-display-xl text-display-xl text-on-surface tracking-tight leading-tight uppercase font-bold mb-6">
                <?php the_title(); ?>
              </h1>
              <p class="font-body-lg text-body-lg text-on-surface-variant max-w-4xl leading-relaxed">
                Presenting engineered envelope technologies designed for extreme GCC meteorological conditions:
                ASTM-tested 6.2 kPa wind-resistance, BMS-linked automated solar tracking, and sand-abrasion-resistant
                PVDF finishes at Stand SS2-D41.
              </p>
            </div>
            <div class="lg:col-span-3 flex lg:flex-col justify-between items-start lg:items-end gap-4 pt-2">
              <div class="p-4 bg-surface-container-lowest shadow-sm w-full">
                <span class="font-label-sm text-label-sm text-outline uppercase block mb-1">Dispatch Origin</span>
                <span class="font-headline-sm text-headline-sm text-on-surface font-semibold block">DUBAI // UAE</span>
                <span class="font-label-sm text-label-sm text-secondary block mt-1">HALL 4 · BOOTH SS2-D41</span>
              </div>
            </div>
          </div>
          <!-- Author Bylines & Share Bar -->
          <div
            class="mt-8 pt-6 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-surface-container-lowest p-6 shadow-sm">
            <div class="flex flex-wrap items-center gap-6">
              <div class="flex items-center gap-3">
                <div
                  class="w-10 h-10 rounded-full bg-primary-container text-secondary-fixed flex items-center justify-center font-headline-sm text-headline-sm font-bold">
                  AX
                </div>
                <div>
                  <p class="font-label-sm text-label-sm text-outline uppercase">Published By</p>
                  <p class="font-body-sm text-body-sm font-semibold text-on-surface">ALUMAX Global Engineering Media
                    Desk</p>
                </div>
              </div>
              <div class="hidden sm:block w-[1px] h-8 bg-surface-container-highest"></div>
              <div>
                <p class="font-label-sm text-label-sm text-outline uppercase">Release Date</p>
                <p class="font-body-sm text-body-sm text-on-surface font-semibold"><?php echo esc_html(get_the_date()); ?></p>
              </div>
              <div class="hidden sm:block w-[1px] h-8 bg-surface-container-highest"></div>
              <div>
                <p class="font-label-sm text-label-sm text-outline uppercase">Estimated Reading</p>
                <p class="font-body-sm text-body-sm text-on-surface font-semibold">4 Mins Technical Read</p>
              </div>
            </div>
            <!-- Social Action Toolset -->
            <div class="flex items-center gap-2">
              <span
                class="font-label-sm text-label-sm uppercase tracking-wider text-outline mr-2 hidden xl:inline">Share
                Dossier:</span>
              <button
                class="w-9 h-9 flex items-center justify-center bg-surface-container-low hover:bg-primary hover:text-on-primary text-on-surface transition-colors"
                title="Share on LinkedIn">
                <span class="material-symbols-outlined text-[18px]">share</span>
              </button>
              <button
                class="w-9 h-9 flex items-center justify-center bg-surface-container-low hover:bg-primary hover:text-on-primary text-on-surface transition-colors"
                title="Post to X / Twitter">
                <span class="material-symbols-outlined text-[18px]">tag</span>
              </button>
              <button
                class="w-9 h-9 flex items-center justify-center bg-surface-container-low hover:bg-primary hover:text-on-primary text-on-surface transition-colors"
                title="Share via WeChat / QR">
                <span class="material-symbols-outlined text-[18px]">qr_code_2</span>
              </button>
              <button
                class="w-9 h-9 flex items-center justify-center bg-surface-container-low hover:bg-primary hover:text-on-primary text-on-surface transition-colors"
                title="Send by Email">
                <span class="material-symbols-outlined text-[18px]">mail</span>
              </button>
              <button
                class="px-3 h-9 flex items-center gap-1.5 bg-surface-container-high hover:bg-secondary hover:text-on-secondary text-on-surface text-label-sm font-label-sm font-semibold transition-colors uppercase"
                id="copy-btn" onclick="copyLinkNotification()" title="Copy Document URL">
                <span class="material-symbols-outlined text-[16px]">link</span>
                <span>Copy Link</span>
              </button>
            </div>
          </div>
        </div>
      </section>
      <!-- Editorial Canvas (12-Col Split) -->
      <section class="w-full py-12 bg-surface">
        <div class="max-w-[1440px] mx-auto px-margin">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left / Center: Article Narrative (8 Cols) -->
            <article class="lg:col-span-8 flex flex-col gap-10">
              <!-- Hero Exhibition Booth Image Feature -->
              <div class="relative w-full shadow-md overflow-hidden bg-primary-container">
                <img class="w-full h-[460px] object-cover transition-transform duration-700 hover:scale-[1.02]"
                  alt="<?php echo esc_attr(get_the_title()); ?>"
                  data-alt="Futuristic multi-level architectural pavilion exhibition stand for ALUMAX at Dubai World Trade Centre. The booth showcases colossal curved gold and dark champagne aluminum composite facade cassettes, kinetic automated solar louvers pivoting seamlessly under dramatic spotlighting, sleek minimalist reception counters, and international architects inspecting precision milled mockups in high-end exhibition lighting."
                  src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDZFrO4fmzFRzKCz_kLA1gAwwxtW4qWC52J88PqmyaZZUve3GU7mh9e3T9g7fPFDHMD2IdmhyMCGZjrI0cT3QWb4NFG_eTAMz_WWhxA87abVfyRPwPPmMFn6fSr_FHZsBQCpxeOJnBTB7Km2HxR9if0gZIT8of9KgmhcFCNfsvhdEnd85iRsnxkR0PU2bxWKD7Y5JwITs8paAj4_HTSWEtwMEFEhXDqW3HXVdVJABdKq-vv47vhPeKm'); ?>" />
                <div
                  class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-primary-container via-primary-container/80 to-transparent p-6 text-on-primary">
                  <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                      <span
                        class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider block">Stand
                        SS2-D41 Architectural Mockup</span>
                      <p class="font-headline-sm text-headline-sm font-semibold text-on-primary mt-1">ALUMAX Pavilion
                        Structure · DWTC Sheikh Saeed Hall 2</p>
                    </div>
                    <div
                      class="px-3 py-1.5 bg-surface-container-lowest/10 backdrop-blur-md font-label-sm text-label-sm text-on-primary">
                      AREA: 180 SQM CUSTOM FABRICATION
                    </div>
                  </div>
                </div>
              </div>
              <!-- Post Body -->
              <div class="flex flex-col gap-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
                <?php the_content(); ?>
              </div>
              <!-- Exhibition Visiting Details Master Card -->
              <div class="p-8 bg-primary-container text-on-primary shadow-xl mt-4" id="booking-card">
                <div
                  class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-surface-tint/30">
                  <div>
                    <span
                      class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-widest font-semibold block mb-1">OFFICIAL
                      STAND INVITATION</span>
                    <h3 class="font-headline-lg text-headline-lg font-bold uppercase tracking-tight text-on-primary">
                      The Big 5 Global Dubai 2025
                    </h3>
                  </div>
                  <div class="flex items-center gap-2">
                    <span
                      class="px-3 py-1 bg-secondary text-on-secondary font-label-sm text-label-sm font-semibold uppercase">Hall
                      4 Stand SS2-D41</span>
                    <span class="px-3 py-1 bg-surface-container-highest/20 font-label-sm text-label-sm uppercase">Open
                      Daily 10:00 - 18:00</span>
                  </div>
                </div>
                <!-- Detail Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 py-6">
                  <div>
                    <span class="font-label-sm text-label-sm text-on-primary-container uppercase block">Host
                      Venue</span>
                    <p class="font-body-md text-body-md font-semibold text-on-primary mt-1">Dubai World Trade Centre
                      (DWTC)</p>
                    <p class="font-body-sm text-body-sm text-on-primary-container">Sheikh Zayed Road, Dubai, UAE</p>
                  </div>
                  <div>
                    <span class="font-label-sm text-label-sm text-on-primary-container uppercase block">Exhibition
                      Dates</span>
                    <p class="font-body-md text-body-md font-semibold text-on-primary mt-1">November 24 – 27, 2025</p>
                    <p class="font-body-sm text-body-sm text-on-primary-container">Monday through Thursday</p>
                  </div>
                  <div>
                    <span class="font-label-sm text-label-sm text-on-primary-container uppercase block">Booth
                      Identity</span>
                    <p class="font-body-md text-body-md font-semibold text-on-primary mt-1">Sheikh Saeed Hall 2</p>
                    <p class="font-body-sm text-body-sm text-on-primary-container">Stand SS2-D41 (Island Site)</p>
                  </div>
                  <div>
                    <span class="font-label-sm text-label-sm text-on-primary-container uppercase block">On-Site
                      Team</span>
                    <p class="font-body-md text-body-md font-semibold text-on-primary mt-1">ALUMAX Middle East Desk</p>
                    <p class="font-body-sm text-body-sm text-on-primary-container">Structural &amp; Export Engineers</p>
                  </div>
                </div>
                <!-- Embedded Interactive Map Component -->
                <div class="w-full my-4">
                  <div class="w-full h-52 bg-cover bg-center shadow-inner relative flex items-end p-4"
                    data-location="Dubai World Trade Centre, Dubai, UAE"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBwlMcBaPxXyCGSwO9y2K3vDhJznlEz0aH3n5J5r_cWANsfJdw_e5LfjaidYT3OSVo2IbuaMIIHTJK3rR2yqsgQNm4COPJ0m22Fd1eOKpMZFZPueFHaeGB_RnvsbIX9wFcF1IXwcRIeb8q6lHgzZOjnJIsDVHL6ADpyRn4pRMEz-RBP0fFV-PbF3K8ATrfYscyYJn-KN_0nAk6XowNa_qdfR_XT0ueTXU7D6RIjB337tAaW4cY2qIyU')">
                    <div class="p-3 bg-surface-container-lowest/95 backdrop-blur text-on-surface shadow-md">
                      <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-secondary">pin_drop</span>
                        <span class="font-label-sm text-label-sm font-bold uppercase">DWTC Main Exhibition Concourse
                          Entrance</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Reservation Interaction Form -->
                <div class="pt-6 mt-2 bg-surface-container-lowest text-on-surface p-6">
                  <h4 class="font-headline-sm text-headline-sm font-bold uppercase text-on-surface mb-2">
                    Book a 1-on-1 VIP Facade Consultation at Dubai Stand
                  </h4>
                  <p class="font-body-sm text-body-sm text-on-surface-variant mb-6">
                    Reserve an uninterrupted 45-minute technical workshop with our Chief Structural Façade Engineers.
                    Bring your CAD elevation drafts or wind-load project specifications.
                  </p>
                  <form class="grid grid-cols-1 md:grid-cols-3 gap-4" id="vip-form"
                    onsubmit="event.preventDefault(); showConfirmation();">
                    <div>
                      <label
                        class="font-label-sm text-label-sm uppercase tracking-wider text-outline block mb-1">Architect /
                        Engineer Name *</label>
                      <input
                        class="w-full h-11 px-3 bg-surface border border-outline-variant font-body-sm text-body-sm focus:outline-none focus:border-secondary transition-colors"
                        placeholder="e.g. Tariq Mansoor" required="" type="text" />
                    </div>
                    <div>
                      <label
                        class="font-label-sm text-label-sm uppercase tracking-wider text-outline block mb-1">Corporate
                        Email *</label>
                      <input
                        class="w-full h-11 px-3 bg-surface border border-outline-variant font-body-sm text-body-sm focus:outline-none focus:border-secondary transition-colors"
                        placeholder="tariq@aecom-partner.com" required="" type="email" />
                    </div>
                    <div>
                      <label
                        class="font-label-sm text-label-sm uppercase tracking-wider text-outline block mb-1">Preferred
                        Date</label>
                      <select
                        class="w-full h-11 px-3 bg-surface border border-outline-variant font-body-sm text-body-sm focus:outline-none focus:border-secondary transition-colors">
                        <option>Monday, Nov 24 (11:00 AM)</option>
                        <option>Tuesday, Nov 25 (02:00 PM)</option>
                        <option>Wednesday, Nov 26 (10:30 AM)</option>
                        <option>Thursday, Nov 27 (03:00 PM)</option>
                      </select>
                    </div>
                    <div class="md:col-span-3 flex flex-col sm:flex-row items-center justify-between gap-4 mt-2">
                      <div class="flex items-center gap-2 text-outline font-label-sm text-label-sm">
                        <span class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                        <span>Includes reserved VIP specimen pack + complimentary barista pass at booth.</span>
                      </div>
                      <div class="flex items-center gap-3 w-full sm:w-auto">
                        <button
                          class="w-full sm:w-auto px-6 h-12 bg-primary text-on-primary font-label-md text-label-md uppercase tracking-wider font-semibold hover:bg-secondary transition-colors"
                          type="submit">
                          Confirm Appointment
                        </button>
                        <a class="w-full sm:w-auto px-5 h-12 flex items-center justify-center gap-2 bg-surface-container-high text-on-surface font-label-md text-label-md uppercase tracking-wider font-semibold hover:bg-surface-container-highest transition-colors"
                          download="" href="#">
                          <span class="material-symbols-outlined text-[18px]">download</span>
                          Brochure (PDF)
                        </a>
                      </div>
                    </div>
                  </form>
                  <!-- Hidden confirmation state -->
                  <div class="hidden mt-4 p-4 bg-secondary-fixed text-on-secondary-fixed" id="booking-success">
                    <div class="flex items-center gap-2">
                      <span class="material-symbols-outlined text-[20px]">task_alt</span>
                      <span class="font-label-md text-label-md font-bold uppercase">Consultation Request
                        Transmitted</span>
                    </div>
                    <p class="font-body-sm text-body-sm mt-1">Our Middle East liaison will send your calendar invite and
                      DWTC visitor pass credentials within 4 business hours.</p>
                  </div>
                </div>
              </div>
            </article>
            <!-- Right: Technical Sidebar & Related Ecosystem (4 Cols) -->
            <aside class="lg:col-span-4 flex flex-col gap-8">
              <!-- Featured Product 1: Solid Aluminum Cladding -->
              <div class="bg-surface-container-lowest shadow-sm overflow-hidden flex flex-col">
                <div class="p-4 bg-surface-container text-on-surface flex items-center justify-between">
                  <span class="font-label-sm text-label-sm uppercase tracking-wider font-semibold">Featured Core
                    System</span>
                  <span class="font-label-sm text-label-sm text-secondary font-mono">SPEC ALU-SC40</span>
                </div>
                <div class="h-44 overflow-hidden relative">
                  <img class="w-full h-full object-cover"
                    data-alt="Close up architectural detail of hyperbolic 3D curved solid aluminum cladding panels installed on an ultra-modern corporate tower facade in Riyadh with precision panel reveals and hairline shadows."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPaKmlHW1VdlWeqSpqHYUEaTGb6BauP1tP1rex3DXdnc_SIfiOsTfFmTViPeFQcUIPHZ1OjhCOGt4aPdMU53Ma-KIYmLt__xltU6Qqw7CddEvrt9_LU8Fqcdml1Dn-LSY9hOgHBuM3PeAZTUhwi--og8lVVHCeC0MCYGlgH77I2yV4THg5h9Xt9vo8TaoMl0vNJaQlB0xxdharrYZ1mPnRp0X2tbRG1XhYnfIFbd1W-I9ooLqXxOo5" />
                  <span
                    class="absolute top-2 right-2 px-2 py-0.5 bg-primary text-on-primary font-label-sm text-label-sm">AA5052-H32</span>
                </div>
                <div class="p-6 flex flex-col gap-3">
                  <h4 class="font-headline-sm text-headline-sm font-bold text-on-surface uppercase">Hyperbolic Curved
                    Cladding</h4>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Seamless multi-directional fluid geometries manufactured via precision stretch forming. Ideal for
                    signature stadium canopies and airport shells.
                  </p>
                  <div class="flex flex-wrap gap-2 pt-2">
                    <span
                      class="px-2 py-0.5 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Class
                      A1 Fire</span>
                    <span
                      class="px-2 py-0.5 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">6.2
                      kPa Wind</span>
                    <span
                      class="px-2 py-0.5 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">25Y
                      PVDF</span>
                  </div>
                  <a class="inline-flex items-center gap-2 font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold hover:text-primary transition-colors mt-2"
                    data-path="products" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">
                    <span>View Engineering Specs</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                  </a>
                </div>
              </div>
              <!-- Featured Product 2: Kinetic Solar Louvers -->
              <div class="bg-surface-container-lowest shadow-sm overflow-hidden flex flex-col">
                <div class="p-4 bg-surface-container text-on-surface flex items-center justify-between">
                  <span class="font-label-sm text-label-sm uppercase tracking-wider font-semibold">Solar Control
                    Technology</span>
                  <span class="font-label-sm text-label-sm text-secondary font-mono">SPEC ALU-SL500</span>
                </div>
                <div class="h-44 overflow-hidden relative">
                  <img class="w-full h-full object-cover"
                    data-alt="Motorized intelligent aluminum sunshade louvers angled toward late afternoon sun on an office building curtain wall facade, casting rhythmic geometric linear shadows across double-glazed glass."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8Dit-q0xak5eZ8dCpLreA1ZfUKevef03Mk_UT7HGBYVbK4WpKW9kY-Dj81Pk5O65hXH2EFQNc3j9Gr76TsxzkwZdn16KfiA5sZbdCRDFhe8E8iFCyaa0iV3rtoPAPKJSYfQNn8cusOFJAgBRA0UUvq6HEZkDf1zyjpnkSB_RZ4-FLMs6ZlDKvmfYEudPeY4-HgdGOZXI3_yiwwz_y5LjPTHBw6-c2lZk0IjIffncknUsm2_ZEusLq" />
                  <span
                    class="absolute top-2 right-2 px-2 py-0.5 bg-primary text-on-primary font-label-sm text-label-sm">BACnet
                    / Modbus</span>
                </div>
                <div class="p-6 flex flex-col gap-3">
                  <h4 class="font-headline-sm text-headline-sm font-bold text-on-surface uppercase">Automated Aerofoil
                    Louvers</h4>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Sun-tracking motorized louvers with internal drive gears, operating seamlessly under continuous dust
                    and thermal expansion cycles.
                  </p>
                  <div class="flex flex-wrap gap-2 pt-2">
                    <span
                      class="px-2 py-0.5 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">300-600mm
                      Chord</span>
                    <span
                      class="px-2 py-0.5 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">IP67
                      Enclosure</span>
                    <span
                      class="px-2 py-0.5 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Quiet
                      Stepper</span>
                  </div>
                  <a class="inline-flex items-center gap-2 font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold hover:text-primary transition-colors mt-2"
                    data-path="products" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">
                    <span>Download CAD / BIM Profiles</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                  </a>
                </div>
              </div>
              <!-- Featured Case Study Reference -->
              <div class="bg-primary-container text-on-primary p-6 shadow-sm flex flex-col gap-4">
                <div class="flex items-center justify-between">
                  <span
                    class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider font-semibold">GCC
                    Benchmark Case Study</span>
                  <span class="material-symbols-outlined text-[20px] text-secondary">apartment</span>
                </div>
                <div class="h-40 overflow-hidden relative">
                  <img class="w-full h-full object-cover"
                    data-alt="King Abdullah Financial District KAFD Tower 3 in Riyadh, Saudi Arabia, towering under clear skies with bespoke champagne-bronze aluminum facade cladding and continuous solar louvers."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDh4sAG3n6o3l9CIIgYmQ3Z_FVYsEZunyCARxZDydQ1Ol7bgaStG6TDRXdK9EtwlX4KBz57bZVVRt43DcrUmjks2gn70qua-Uw3P1I3lSqjpm4iRPM78AnukrC2ZMnkjOSsTebPH5hhlTtOjWLXN_R7ZTRtTx-kxpKEVQxK1JTGFWzVQD4lwfI69qRAoFaMfkOEHT_t_qgKp7ywfrdadmfgUs9Fo6-N7gNcQHS6BvHPl8iDya10aMKs" />
                </div>
                <div>
                  <h4 class="font-headline-sm text-headline-sm font-bold uppercase text-on-primary">KAFD Financial Tower
                    3</h4>
                  <p class="font-label-sm text-label-sm text-on-primary-container mt-1">Riyadh, Kingdom of Saudi Arabia
                  </p>
                  <p class="font-body-sm text-body-sm text-on-primary-container mt-2">
                    Supplied 42,000 m² of custom 3.0mm solid PVDF cladding cassettes and intelligent horizontal solar
                    louvers certified to GCC wind-load standards.
                  </p>
                </div>
                <a class="inline-flex items-center gap-2 font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed font-bold hover:text-on-primary transition-colors"
                  data-path="projects" href="<?php echo esc_url(get_post_type_archive_link('case')); ?>">
                  <span>Inspect Full Case Study Dossier</span>
                  <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                </a>
              </div>
              <!-- Related Exhibition & Industry Articles -->
              <div class="bg-surface-container-lowest p-6 shadow-sm flex flex-col gap-4">
                <span class="font-label-sm text-label-sm uppercase tracking-widest text-outline font-semibold">Related
                  Coverage &amp; Dispatches</span>
                <div class="flex flex-col gap-4">
                  <?php
                  $alumax_related = new WP_Query(array(
                    'posts_per_page'      => 3,
                    'post__not_in'        => array(get_the_ID()),
                    'ignore_sticky_posts' => true,
                  ));
                  while ($alumax_related->have_posts()) :
                    $alumax_related->the_post();
                    $alumax_related_cats = get_the_category();
                  ?>
                  <a class="group flex flex-col gap-1 pb-3 border-b border-surface-container" data-path="news" href="<?php echo esc_url(get_permalink()); ?>">
                    <span class="font-label-sm text-label-sm text-secondary font-mono"><?php echo esc_html(strtoupper(get_the_date('d M Y'))); ?></span>
                    <p
                      class="font-body-sm text-body-sm font-semibold text-on-surface group-hover:text-secondary transition-colors">
                      <?php the_title(); ?>
                    </p>
                    <span class="font-label-sm text-label-sm text-outline"><?php echo esc_html($alumax_related_cats ? $alumax_related_cats[0]->name : 'News'); ?></span>
                  </a>
                  <?php
                  endwhile;
                  wp_reset_postdata();
                  ?>
                </div>
              </div>
              <!-- Sample Box Banner Sticky CTA -->
              <div class="bg-secondary-fixed text-on-secondary-fixed p-6 flex flex-col gap-3 shadow-sm">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-[20px] text-secondary">inventory_2</span>
                  <span class="font-label-sm text-label-sm uppercase font-bold tracking-wider">Fast-Track Specifier
                    Kit</span>
                </div>
                <h4 class="font-headline-sm text-headline-sm font-bold uppercase">Can't Attend Dubai Big 5?</h4>
                <p class="font-body-sm text-body-sm text-on-secondary-fixed-variant">
                  Request courier dispatch of the 2025 Architectural Swatch Box directly to your international studio at
                  zero procurement cost.
                </p>
                <a class="mt-2 h-10 px-4 bg-primary text-on-primary flex items-center justify-center font-label-sm text-label-sm uppercase tracking-wider font-semibold hover:bg-secondary transition-colors"
                  data-path="sample-box" href="#">
                  Request Free Sample Box
                </a>
              </div>
            </aside>
          </div>
        </div>
      </section>
      <!-- Bottom Navigation Row: Previous / Next Articles -->
      <section class="w-full bg-surface-container-low py-8">
        <div class="max-w-[1440px] mx-auto px-margin">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Previous -->
            <?php $alumax_prev_post = get_previous_post(); if ($alumax_prev_post) : ?>
            <a class="p-6 bg-surface-container-lowest shadow-sm flex items-center justify-between group hover:bg-surface-container transition-colors"
              data-path="news" href="<?php echo esc_url(get_permalink($alumax_prev_post)); ?>">
              <div class="flex items-center gap-4">
                <span
                  class="material-symbols-outlined text-[28px] text-outline group-hover:-translate-x-1 transition-transform">arrow_back</span>
                <div>
                  <span class="font-label-sm text-label-sm text-outline uppercase block">Previous Dispatch</span>
                  <span
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors">
                    <?php echo esc_html(get_the_title($alumax_prev_post)); ?>
                  </span>
                </div>
              </div>
            </a>
            <?php endif; ?>
            <!-- Next -->
            <?php $alumax_next_post = get_next_post(); if ($alumax_next_post) : ?>
            <a class="p-6 bg-surface-container-lowest shadow-sm flex items-center justify-between group hover:bg-surface-container transition-colors text-right"
              data-path="news" href="<?php echo esc_url(get_permalink($alumax_next_post)); ?>">
              <div class="flex items-center justify-between w-full">
                <div class="text-left md:text-right w-full">
                  <span class="font-label-sm text-label-sm text-outline uppercase block">Next Dispatch</span>
                  <span
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors">
                    <?php echo esc_html(get_the_title($alumax_next_post)); ?>
                  </span>
                </div>
                <span
                  class="material-symbols-outlined text-[28px] text-outline group-hover:translate-x-1 transition-transform ml-4">arrow_forward</span>
              </div>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </section>
      <!-- Inline Micro-Interactions Script -->
      <script>
        // Reading Progress Indicator
        window.addEventListener('scroll', () => {
          const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
          const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
          const scrolled = (winScroll / height) * 100;
          const bar = document.getElementById('read-progress');
          if (bar) bar.style.width = scrolled + '%';
        });

        // Copy Link Notification Feedback
        function copyLinkNotification() {
          navigator.clipboard?.writeText(window.location.href);
          const btn = document.getElementById('copy-btn');
          if (btn) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span class="material-symbols-outlined text-[16px]">check</span><span>Copied!</span>';
            setTimeout(() => {
              btn.innerHTML = originalText;
            }, 2000);
          }
        }

        // VIP Form Confirmation
        function showConfirmation() {
          const form = document.getElementById('vip-form');
          const alertBox = document.getElementById('booking-success');
          if (form && alertBox) {
            form.classList.add('opacity-50', 'pointer-events-none');
            alertBox.classList.remove('hidden');
          }
        }
      </script>
    </div>
  </main>
<?php
endwhile;
get_footer();
