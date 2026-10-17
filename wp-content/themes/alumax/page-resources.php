<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
    <div class="flex flex-col w-full">
      <!-- Hero Section: Technical Library & Compliance Hub -->
      <section class="relative w-full bg-primary-container text-on-primary overflow-hidden py-16 lg:py-24">
        <!-- Ambient Structural Grid Overlay -->
        <div
          class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#edbe82_1px,transparent_1px)] [background-size:24px_24px]">
        </div>
        <div class="max-w-[1440px] mx-auto px-margin relative z-10">
          <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 pb-12">
            <div class="max-w-3xl space-y-4">
              <div
                class="inline-flex items-center gap-2 px-3 py-1 bg-surface-variant/10 text-secondary-fixed-dim rounded-full text-label-sm font-label-sm tracking-wider uppercase">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary-fixed-dim"></span>
                A2-s1, d0 / ASTM E330 / CWCT Certified Archive
              </div>
              <h1 class="font-display-xl text-display-xl tracking-tight text-surface-bright">
                Technical Library &amp; <br /><span class="text-secondary-fixed-dim">Compliance Hub</span>
              </h1>
              <p class="font-body-lg text-body-lg text-outline-variant max-w-2xl leading-relaxed">
                Download ASTM/EN Certified Test Dossiers, BIM LOD 400 Families, CAD Detail Sections, and Facade
                Engineering Whitepapers for high-performance building envelopes.
              </p>
            </div>
            <!-- Quick Spec Metrics Counter -->
            <div class="grid grid-cols-3 gap-4 p-4 bg-tertiary-container/60 rounded-xl backdrop-blur-md">
              <div class="flex flex-col px-3">
                <span class="font-label-sm text-label-sm text-outline-variant uppercase">Validated Tests</span>
                <span class="font-headline-lg text-headline-lg text-surface-bright font-bold">128+</span>
              </div>
              <div class="flex flex-col px-3">
                <span class="font-label-sm text-label-sm text-outline-variant uppercase">Global Regions</span>
                <span class="font-headline-lg text-headline-lg text-secondary-fixed-dim font-bold">48</span>
              </div>
              <div class="flex flex-col px-3">
                <span class="font-label-sm text-label-sm text-outline-variant uppercase">BIM LOD Level</span>
                <span class="font-headline-lg text-headline-lg text-surface-bright font-bold">400</span>
              </div>
            </div>
          </div>
          <!-- Quick Search Bar & Category Chips -->
          <div class="flex flex-col gap-6 pt-6">
            <div class="relative w-full max-w-4xl shadow-xl">
              <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline-variant">
                <span class="material-symbols-outlined text-2xl">search</span>
              </div>
              <input
                class="w-full h-14 pl-12 pr-32 bg-surface-container-lowest text-on-surface font-body-md text-body-md rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary-fixed"
                id="searchInput"
                placeholder="Search standards (e.g. ASTM E330, EN 13501, CWCT), DWG profiles, or acoustic reports..."
                type="text" />
              <button
                class="absolute inset-y-2 right-2 px-6 bg-primary-container text-on-primary font-label-md text-label-md rounded flex items-center justify-center gap-2 hover:bg-secondary transition-colors">
                FILTER
              </button>
            </div>
            <!-- Filter Chips Matrix -->
            <div class="flex flex-wrap items-center gap-2" id="filterContainer">
              <button
                class="filter-btn active px-4 py-2 bg-secondary-fixed text-on-secondary-fixed rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors"
                data-filter="all">
                All Resources (128)
              </button>
              <button
                class="filter-btn px-4 py-2 bg-surface-container-high/40 text-surface-bright hover:bg-surface-container-high rounded font-label-sm text-label-sm font-medium tracking-wider uppercase transition-colors"
                data-filter="test-reports">
                Test Reports (34)
              </button>
              <button
                class="filter-btn px-4 py-2 bg-surface-container-high/40 text-surface-bright hover:bg-surface-container-high rounded font-label-sm text-label-sm font-medium tracking-wider uppercase transition-colors"
                data-filter="cad-dwg">
                CAD/DWG Details (42)
              </button>
              <button
                class="filter-btn px-4 py-2 bg-surface-container-high/40 text-surface-bright hover:bg-surface-container-high rounded font-label-sm text-label-sm font-medium tracking-wider uppercase transition-colors"
                data-filter="bim-lod">
                BIM LOD 400 (28)
              </button>
              <button
                class="filter-btn px-4 py-2 bg-surface-container-high/40 text-surface-bright hover:bg-surface-container-high rounded font-label-sm text-label-sm font-medium tracking-wider uppercase transition-colors"
                data-filter="whitepapers">
                Whitepapers &amp; Guides (16)
              </button>
              <button
                class="filter-btn px-4 py-2 bg-surface-container-high/40 text-surface-bright hover:bg-surface-container-high rounded font-label-sm text-label-sm font-medium tracking-wider uppercase transition-colors"
                data-filter="leed-epd">
                LEED/EPD (8)
              </button>
            </div>
          </div>
        </div>
      </section>
      <!-- Section 1: Interactive Download Matrix -->
      <section class="w-full bg-surface-bright py-16">
        <div class="max-w-[1440px] mx-auto px-margin space-y-8">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
              <span
                class="font-label-sm text-label-sm uppercase text-secondary font-semibold tracking-widest">Repository
                Dossier</span>
              <h2 class="font-headline-lg text-headline-lg text-on-surface">Validated Engineering Artifacts</h2>
            </div>
            <div class="flex items-center gap-3">
              <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Sorting by: Standard
                Authority</span>
              <div
                class="px-3 py-1.5 bg-surface-container-lowest text-on-surface text-label-sm font-label-sm rounded shadow-sm flex items-center gap-1">
                <span>ASTM International / EN</span>
                <span class="material-symbols-outlined text-sm">arrow_drop_down</span>
              </div>
            </div>
          </div>
          <!-- Resource Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="resourceMatrix">
            <!-- Item 1: Wind Load Rig Test -->
            <div
              class="resource-card group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              data-category="test-reports">
              <div class="space-y-4">
                <div class="flex items-start justify-between">
                  <span
                    class="p-3 rounded-lg bg-surface-container-low text-secondary group-hover:bg-secondary-fixed transition-colors">
                    <span class="material-symbols-outlined text-2xl">science</span>
                  </span>
                  <span
                    class="px-2 py-1 bg-surface-container text-on-surface-variant font-label-sm text-label-sm rounded uppercase font-semibold">
                    PDF · 14.2 MB
                  </span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">ASTM E330 &amp;
                    CWCT</span>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors mt-1">
                    Rig Dynamic Wind Load &amp; Air/Water Infiltration Dossier
                  </h3>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  Full-scale environmental chamber performance verification reaching 6.20 kPa dynamic structural
                  pressure with zero moisture failure under pulsating water heads.
                </p>
              </div>
              <div class="pt-6 mt-6 flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-outline">REV 2024.3</span>
                <button
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-on-primary hover:bg-secondary rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD
                </button>
              </div>
            </div>
            <!-- Item 2: Fire Classification -->
            <div
              class="resource-card group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              data-category="test-reports">
              <div class="space-y-4">
                <div class="flex items-start justify-between">
                  <span
                    class="p-3 rounded-lg bg-surface-container-low text-secondary group-hover:bg-secondary-fixed transition-colors">
                    <span class="material-symbols-outlined text-2xl">local_fire_department</span>
                  </span>
                  <span
                    class="px-2 py-1 bg-surface-container text-on-surface-variant font-label-sm text-label-sm rounded uppercase font-semibold">
                    PDF · 8.6 MB
                  </span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">EN 13501-1</span>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors mt-1">
                    Fire Reaction Classification (Class A1 / A2-s1, d0)
                  </h3>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  Combustibility, heat release rate (FIGRA), smoke emission, and flaming droplet testing certificates
                  for both solid core and honeycomb infill composites.
                </p>
              </div>
              <div class="pt-6 mt-6 flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-outline">REV 2024.1</span>
                <button
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-on-primary hover:bg-secondary rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD
                </button>
              </div>
            </div>
            <!-- Item 3: Solid Cladding CAD Library -->
            <div
              class="resource-card group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              data-category="cad-dwg">
              <div class="space-y-4">
                <div class="flex items-start justify-between">
                  <span
                    class="p-3 rounded-lg bg-surface-container-low text-secondary group-hover:bg-secondary-fixed transition-colors">
                    <span class="material-symbols-outlined text-2xl">architecture</span>
                  </span>
                  <span
                    class="px-2 py-1 bg-surface-container text-on-surface-variant font-label-sm text-label-sm rounded uppercase font-semibold">
                    DWG · 42.0 MB
                  </span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">CAD DETAIL
                    PACK</span>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors mt-1">
                    Solid Aluminum Cladding Detail Library (Expansion &amp; Spandrels)
                  </h3>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  Standard 2D and 3D DWG blocks covering dead-load mullion anchors, hyperbolic curved perimeter
                  spandrels, thermal break junctions, and silicone gaskets.
                </p>
              </div>
              <div class="pt-6 mt-6 flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-outline">AUTOCAD 2018+</span>
                <button
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-on-primary hover:bg-secondary rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD
                </button>
              </div>
            </div>
            <!-- Item 4: BIM LOD 400 Louvers -->
            <div
              class="resource-card group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              data-category="bim-lod">
              <div class="space-y-4">
                <div class="flex items-start justify-between">
                  <span
                    class="p-3 rounded-lg bg-surface-container-low text-secondary group-hover:bg-secondary-fixed transition-colors">
                    <span class="material-symbols-outlined text-2xl">view_in_ar</span>
                  </span>
                  <span
                    class="px-2 py-1 bg-surface-container text-on-surface-variant font-label-sm text-label-sm rounded uppercase font-semibold">
                    RVT · 28.5 MB
                  </span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">AUTODESK REVIT</span>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors mt-1">
                    Intelligent Motorized Louver LOD 400 Parametric Family
                  </h3>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  Includes full fabrication geometry, actuator cable conduit paths, automated thermal solar tracking
                  control logic, and COBie asset scheduling attributes.
                </p>
              </div>
              <div class="pt-6 mt-6 flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-outline">REVIT 2021-2024</span>
                <button
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-on-primary hover:bg-secondary rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD
                </button>
              </div>
            </div>
            <!-- Item 5: Acoustic Barrier ASTM E90 -->
            <div
              class="resource-card group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              data-category="test-reports">
              <div class="space-y-4">
                <div class="flex items-start justify-between">
                  <span
                    class="p-3 rounded-lg bg-surface-container-low text-secondary group-hover:bg-secondary-fixed transition-colors">
                    <span class="material-symbols-outlined text-2xl">hearing</span>
                  </span>
                  <span
                    class="px-2 py-1 bg-surface-container text-on-surface-variant font-label-sm text-label-sm rounded uppercase font-semibold">
                    PDF · 6.4 MB
                  </span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">ASTM E90 / ISO
                    10140</span>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors mt-1">
                    Sound Transmission Loss &amp; Acoustic Barrier Report
                  </h3>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  Independent laboratory acoustic transmission index (Rw / STC 38-44 dB) measuring honeycomb sandwich
                  panels engineered with high-density mineral decoupling layers.
                </p>
              </div>
              <div class="pt-6 mt-6 flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-outline">REV 2023.2</span>
                <button
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-on-primary hover:bg-secondary rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD
                </button>
              </div>
            </div>
            <!-- Item 6: Salt Spray & Corrosion Test -->
            <div
              class="resource-card group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              data-category="test-reports">
              <div class="space-y-4">
                <div class="flex items-start justify-between">
                  <span
                    class="p-3 rounded-lg bg-surface-container-low text-secondary group-hover:bg-secondary-fixed transition-colors">
                    <span class="material-symbols-outlined text-2xl">waves</span>
                  </span>
                  <span
                    class="px-2 py-1 bg-surface-container text-on-surface-variant font-label-sm text-label-sm rounded uppercase font-semibold">
                    PDF · 9.1 MB
                  </span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">ASTM B117 / ISO
                    9227</span>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors mt-1">
                    4,000-Hour Accelerated Salt Spray &amp; Cyclic Corrosion Report
                  </h3>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  Marine and coastal harsh atmosphere exposure data. Zero blister initiation, under-film corrosion creep
                  below 0.5mm on marine-grade 5052 and 3003 alloys.
                </p>
              </div>
              <div class="pt-6 mt-6 flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-outline">REV 2024.1</span>
                <button
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-on-primary hover:bg-secondary rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD
                </button>
              </div>
            </div>
            <!-- Item 7: Coating Specs -->
            <div
              class="resource-card group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              data-category="whitepapers">
              <div class="space-y-4">
                <div class="flex items-start justify-between">
                  <span
                    class="p-3 rounded-lg bg-surface-container-low text-secondary group-hover:bg-secondary-fixed transition-colors">
                    <span class="material-symbols-outlined text-2xl">format_paint</span>
                  </span>
                  <span
                    class="px-2 py-1 bg-surface-container text-on-surface-variant font-label-sm text-label-sm rounded uppercase font-semibold">
                    PDF · 11.0 MB
                  </span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">AAMA 2605 /
                    QUALICOAT</span>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors mt-1">
                    Architectural Anodizing &amp; PVDF Resin Coating Manual
                  </h3>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  Definitive master specification guidance covering 70% Kynar 500 / Hylar 5000 multi-coat liquid spray
                  vs. class 1 hard-coat architectural anodization (25μm).
                </p>
              </div>
              <div class="pt-6 mt-6 flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-outline">EDITION 5.0</span>
                <button
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-on-primary hover:bg-secondary rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD
                </button>
              </div>
            </div>
            <!-- Item 8: Seismic Interstory Drift -->
            <div
              class="resource-card group bg-surface-container-lowest p-6 rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              data-category="test-reports">
              <div class="space-y-4">
                <div class="flex items-start justify-between">
                  <span
                    class="p-3 rounded-lg bg-surface-container-low text-secondary group-hover:bg-secondary-fixed transition-colors">
                    <span class="material-symbols-outlined text-2xl">vibration</span>
                  </span>
                  <span
                    class="px-2 py-1 bg-surface-container text-on-surface-variant font-label-sm text-label-sm rounded uppercase font-semibold">
                    PDF · 7.8 MB
                  </span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">AAMA 501.4</span>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors mt-1">
                    Seismic Interstory Drift &amp; Dynamic Displacements
                  </h3>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3">
                  Full-scale cyclic horizontal displacement testing measuring envelope panels subjected to design
                  displacement (0.010 H) and extreme drift limit states (0.015 H).
                </p>
              </div>
              <div class="pt-6 mt-6 flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-outline">REV 2024.2</span>
                <button
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary-container text-on-primary hover:bg-secondary rounded font-label-sm text-label-sm font-semibold tracking-wider uppercase transition-colors">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Section 2: Facade Engineering Calculators & Tools -->
      <section class="w-full bg-surface-container-low py-16">
        <div class="max-w-[1440px] mx-auto px-margin space-y-10">
          <div class="max-w-2xl">
            <span class="font-label-sm text-label-sm uppercase text-secondary font-semibold tracking-widest">Interactive
              Engineering Suite</span>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Preliminary Calculation Modules</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">
              Real-time structural estimation engines calibrated against Eurocode EN 1991-1-4 and ASCE 7-16 facade wind
              pressure matrices.
            </p>
          </div>
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Module 1: Thermal Delta / SHGC Calculator -->
            <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm flex flex-col justify-between space-y-6">
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <span class="font-headline-sm text-headline-sm text-on-surface font-semibold">Thermal &amp; SHGC
                    Index</span>
                  <span class="material-symbols-outlined text-secondary">thermostat</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Calculate overall envelope Solar Heat Gain Coefficient (SHGC) with integrated dynamic louver angle
                  modulation.
                </p>
                <div class="space-y-4 pt-2">
                  <div class="space-y-1">
                    <div class="flex justify-between font-label-sm text-label-sm text-on-surface">
                      <span>LOUVER TILT ANGLE</span>
                      <span class="font-bold text-secondary" id="angleVal">45°</span>
                    </div>
                    <input class="w-full h-1.5 bg-surface-container-highest rounded cursor-pointer accent-secondary"
                      id="angleSlider" max="90" min="0" type="range" value="45" />
                  </div>
                  <div class="space-y-1">
                    <label class="font-label-sm text-label-sm uppercase text-on-surface font-medium">Glazing Baseline
                      SHGC</label>
                    <select
                      class="w-full p-2.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded focus:outline-none"
                      id="baseGlazing">
                      <option value="0.55">Double IGU Clear (SHGC: 0.55)</option>
                      <option value="0.38">Low-E Solar Control (SHGC: 0.38)</option>
                      <option value="0.25">Triple Glazed Selective (SHGC: 0.25)</option>
                    </select>
                  </div>
                  <!-- Real-time SVG Metric Indicator -->
                  <div class="p-4 bg-surface-container-low rounded-lg flex items-center justify-between">
                    <div>
                      <span class="font-label-sm text-label-sm text-outline uppercase block">Effective SHGC</span>
                      <span class="font-display-lg text-display-lg text-on-surface font-bold"
                        id="shgcResult">0.19</span>
                    </div>
                    <div class="w-16 h-16 flex items-center justify-center">
                      <svg class="w-full h-full transform -rotate-90" viewbox="0 0 36 36">
                        <path class="text-surface-container-highest"
                          d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none"
                          stroke="currentColor" stroke-width="3"></path>
                        <path class="text-secondary"
                          d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none"
                          id="shgcRing" stroke="currentColor" stroke-dasharray="65, 100" stroke-linecap="round"
                          stroke-width="3"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
              <button
                class="w-full py-2.5 bg-primary-container text-on-primary hover:bg-secondary font-label-sm text-label-sm uppercase font-semibold rounded transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">print</span>
                Generate Thermal Dossier
              </button>
            </div>
            <!-- Module 2: Wind Pressure Span Guide -->
            <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm flex flex-col justify-between space-y-6">
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <span class="font-headline-sm text-headline-sm text-on-surface font-semibold">Wind Load Span
                    Guide</span>
                  <span class="material-symbols-outlined text-secondary">air</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Check allowable unbraced mullion span according to ASCE 7-16 / EN 1991 wind pressure requirements.
                </p>
                <div class="space-y-4 pt-2">
                  <div class="space-y-1">
                    <label class="font-label-sm text-label-sm uppercase text-on-surface font-medium">Design Wind
                      Pressure ($q_p$)</label>
                    <div class="grid grid-cols-3 gap-2">
                      <button
                        class="wind-btn active py-2 bg-secondary-fixed text-on-secondary-fixed text-label-sm font-label-sm font-bold rounded"
                        data-pressure="2.5" type="button">2.5 kPa</button>
                      <button
                        class="wind-btn py-2 bg-surface-container text-on-surface text-label-sm font-label-sm font-medium rounded"
                        data-pressure="4.0" type="button">4.0 kPa</button>
                      <button
                        class="wind-btn py-2 bg-surface-container text-on-surface text-label-sm font-label-sm font-medium rounded"
                        data-pressure="6.0" type="button">6.0 kPa</button>
                    </div>
                  </div>
                  <div class="space-y-1">
                    <div class="flex justify-between font-label-sm text-label-sm text-on-surface">
                      <span>SPAN HEIGHT (FLOOR-TO-FLOOR)</span>
                      <span class="font-bold text-secondary" id="spanVal">3.8 m</span>
                    </div>
                    <input class="w-full h-1.5 bg-surface-container-highest rounded cursor-pointer accent-secondary"
                      id="spanSlider" max="5.0" min="2.5" step="0.1" type="range" value="3.8" />
                  </div>
                  <div class="p-4 bg-surface-container-low rounded-lg space-y-2">
                    <div class="flex justify-between items-center">
                      <span class="font-label-sm text-label-sm text-outline uppercase">Min Mullion Inertia
                        ($I_{xx}$)</span>
                      <span class="font-headline-sm text-headline-sm text-on-surface font-bold" id="inertiaResult">245
                        cm⁴</span>
                    </div>
                    <div class="w-full bg-surface-container-highest h-2 rounded-full overflow-hidden">
                      <div class="bg-secondary h-full rounded-full transition-all duration-300" id="inertiaBar"
                        style="width: 58%"></div>
                    </div>
                  </div>
                </div>
              </div>
              <button
                class="w-full py-2.5 bg-primary-container text-on-primary hover:bg-secondary font-label-sm text-label-sm uppercase font-semibold rounded transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">tune</span>
                Select Extrusion Profile
              </button>
            </div>
            <!-- Module 3: Panel Thickness Selector -->
            <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm flex flex-col justify-between space-y-6">
              <div class="space-y-4">
                <div class="flex items-center justify-between">
                  <span class="font-headline-sm text-headline-sm text-on-surface font-semibold">Cladding Thickness
                    Core</span>
                  <span class="material-symbols-outlined text-secondary">layers</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Determine minimum plate gauge or honeycomb sandwich core thickness to avoid permanent deflection
                  ($L/180$).
                </p>
                <div class="space-y-4 pt-2">
                  <div class="space-y-1">
                    <label class="font-label-sm text-label-sm uppercase text-on-surface font-medium">Panel Width /
                      Module</label>
                    <select
                      class="w-full p-2.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded focus:outline-none"
                      id="panelModule">
                      <option value="1200">1200 mm × 2400 mm</option>
                      <option selected="" value="1500">1500 mm × 3000 mm (Large Format)</option>
                      <option value="2000">2000 mm × 4000 mm (Monumental)</option>
                    </select>
                  </div>
                  <div class="p-4 bg-surface-container-low rounded-lg space-y-3">
                    <div class="flex items-center justify-between">
                      <span class="font-label-sm text-label-sm text-on-surface uppercase">Solid Aluminum:</span>
                      <span class="font-label-lg text-label-lg font-bold text-secondary" id="solidGauge">3.0 mm
                        (AA3003-H14)</span>
                    </div>
                    <div class="flex items-center justify-between">
                      <span class="font-label-sm text-label-sm text-on-surface uppercase">Honeycomb Sandwich:</span>
                      <span class="font-label-lg text-label-lg font-bold text-on-surface" id="honeycombGauge">15.0 mm
                        Core (0.8/0.8)</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-xs text-outline pt-1">
                      <span class="material-symbols-outlined text-sm text-secondary">verified</span>
                      <span>Tested compliant with ASTM B209M stress limits</span>
                    </div>
                  </div>
                </div>
              </div>
              <button
                class="w-full py-2.5 bg-primary-container text-on-primary hover:bg-secondary font-label-sm text-label-sm uppercase font-semibold rounded transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">file_download</span>
                Export Structural Calculation
              </button>
            </div>
          </div>
        </div>
      </section>
      <!-- Section 3: Environmental Product Declarations & Green Credits -->
      <section class="w-full bg-surface-bright py-16">
        <div class="max-w-[1440px] mx-auto px-margin">
          <div class="bg-primary-container text-on-primary rounded-2xl p-8 lg:p-12 relative overflow-hidden">
            <div
              class="absolute -right-24 -bottom-24 w-96 h-96 bg-secondary-container/10 rounded-full blur-3xl pointer-events-none">
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
              <div class="lg:col-span-7 space-y-6">
                <div
                  class="inline-flex items-center gap-2 px-3 py-1 bg-surface-variant/20 text-secondary-fixed-dim rounded-full text-label-sm font-label-sm uppercase tracking-wider">
                  <span class="material-symbols-outlined text-base">eco</span>
                  Circularity &amp; Embodied Carbon Data
                </div>
                <h2 class="font-headline-lg text-headline-lg text-surface-bright font-bold">
                  Environmental Product Declarations (EPD) &amp; Green Building Credits
                </h2>
                <p class="font-body-md text-body-md text-outline-variant leading-relaxed">
                  Accelerate LEED v4/v4.1, BREEAM, and DGNB credits with third-party verified Type III EPD dossiers,
                  post-consumer recycled aluminum content statements (up to 75% recycled billet), and Life Cycle
                  Assessments (ISO 14025 / EN 15804).
                </p>
                <!-- Rating System Badges -->
                <div class="grid grid-cols-3 gap-4 pt-2">
                  <div class="p-4 bg-tertiary-container/80 rounded-lg">
                    <span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold block">LEED
                      v4.1</span>
                    <span class="font-body-sm text-body-sm text-outline-variant">MR: EPD &amp; Material Sourcing (Up to
                      4 Pts)</span>
                  </div>
                  <div class="p-4 bg-tertiary-container/80 rounded-lg">
                    <span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold block">BREEAM
                      Int.</span>
                    <span class="font-body-sm text-body-sm text-outline-variant">Mat 01 Life Cycle Impacts Exemplary
                      Tier</span>
                  </div>
                  <div class="p-4 bg-tertiary-container/80 rounded-lg">
                    <span class="font-label-sm text-label-sm text-secondary-fixed uppercase font-bold block">DGNB
                      Gold</span>
                    <span class="font-body-sm text-body-sm text-outline-variant">ENV 1.1 / 2.1 Environmental Balance
                      Score</span>
                  </div>
                </div>
              </div>
              <!-- Download Spec Pack Card -->
              <div
                class="lg:col-span-5 bg-surface-container-lowest text-on-surface p-8 rounded-xl shadow-2xl space-y-6">
                <div class="flex items-center gap-3">
                  <div
                    class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
                    <span class="material-symbols-outlined text-2xl">folder_zip</span>
                  </div>
                  <div>
                    <h4 class="font-headline-sm text-headline-sm font-semibold">Green Building Package</h4>
                    <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Full Documentation Suite
                      · 34 MB</span>
                  </div>
                </div>
                <div class="space-y-3 font-body-sm text-body-sm text-on-surface-variant">
                  <div class="flex items-center justify-between p-2 rounded bg-surface-container-low">
                    <span class="flex items-center gap-2">
                      <span class="material-symbols-outlined text-base text-secondary">description</span>
                      Type III EPD Dossier (Solid Aluminum)
                    </span>
                    <span class="font-label-sm text-label-sm font-bold text-on-surface">PDF</span>
                  </div>
                  <div class="flex items-center justify-between p-2 rounded bg-surface-container-low">
                    <span class="flex items-center gap-2">
                      <span class="material-symbols-outlined text-base text-secondary">description</span>
                      Honeycomb Panel Recycled Billet Verification
                    </span>
                    <span class="font-label-sm text-label-sm font-bold text-on-surface">PDF</span>
                  </div>
                  <div class="flex items-center justify-between p-2 rounded bg-surface-container-low">
                    <span class="flex items-center gap-2">
                      <span class="material-symbols-outlined text-base text-secondary">description</span>
                      VOC Emissions &amp; Qualicoat Chemical Safety
                    </span>
                    <span class="font-label-sm text-label-sm font-bold text-on-surface">PDF</span>
                  </div>
                </div>
                <button
                  class="w-full py-3 bg-secondary text-on-primary hover:bg-secondary-fixed-variant font-label-md text-label-md font-semibold tracking-wider uppercase rounded transition-colors flex items-center justify-center gap-2">
                  <span class="material-symbols-outlined text-base">download</span>
                  DOWNLOAD COMPLETE GREEN PACK (ZIP)
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Section 4: Technical Submittal Request & Engineering Support Desk -->
      <section class="w-full bg-surface-bright py-16">
        <div class="max-w-[1440px] mx-auto px-margin">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Contact & Direct Consultation Context -->
            <div class="lg:col-span-5 space-y-6">
              <span
                class="font-label-sm text-label-sm uppercase text-secondary font-semibold tracking-widest">Engineering
                Liaison</span>
              <h2 class="font-headline-lg text-headline-lg text-on-surface font-semibold">
                Custom Specification &amp; Facade Engineering Support
              </h2>
              <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                Need tailored wind-tunnel pressure assessments, custom die-extrusion shop drawings, or project-specific
                mock-up witness test protocols? Transmit your project details to our technical team in Rotterdam or
                Foshan.
              </p>
              <div class="space-y-4 pt-4">
                <div class="flex items-start gap-4 p-4 bg-surface-container-lowest rounded-lg shadow-sm">
                  <span class="material-symbols-outlined text-2xl text-secondary">engineering</span>
                  <div>
                    <h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Project-Specific
                      Engineering</h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Calculation books signed by certified
                      structural façade engineers for local authority approval (IBC/Eurocodes).</p>
                  </div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-surface-container-lowest rounded-lg shadow-sm">
                  <span class="material-symbols-outlined text-2xl text-secondary">schedule</span>
                  <div>
                    <h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold">24-48 Hour Turnaround
                    </h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Rapid turnaround for preliminary
                      submittals, CAD block custom adaptations, and panel schedules.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- RFQ & Technical Submittal Form -->
            <div class="lg:col-span-7 bg-surface-container-lowest p-8 lg:p-10 rounded-2xl shadow-sm">
              <h3 class="font-headline-md text-headline-md text-on-surface font-semibold mb-6">
                Project Submittal Request Form
              </h3>
              <form class="space-y-6"
                onsubmit="event.preventDefault(); alert('Submittal inquiry registered. Engineering dossier queued.');">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface uppercase">Full Name <span
                        class="text-secondary">*</span></label>
                    <input
                      class="w-full h-11 px-4 bg-surface-container-low text-on-surface font-body-md text-body-md rounded focus:outline-none focus:ring-2 focus:ring-secondary"
                      placeholder="Arch. Julian Sterling" required="" type="text" />
                  </div>
                  <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface uppercase">Work Email <span
                        class="text-secondary">*</span></label>
                    <input
                      class="w-full h-11 px-4 bg-surface-container-low text-on-surface font-body-md text-body-md rounded focus:outline-none focus:ring-2 focus:ring-secondary"
                      placeholder="j.sterling@facadestudio.com" required="" type="email" />
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface uppercase">Consultancy / Firm <span
                        class="text-secondary">*</span></label>
                    <input
                      class="w-full h-11 px-4 bg-surface-container-low text-on-surface font-body-md text-body-md rounded focus:outline-none focus:ring-2 focus:ring-secondary"
                      placeholder="Foster + Partners / Buro Happold" required="" type="text" />
                  </div>
                  <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface uppercase">Project Location &amp;
                      Country</label>
                    <input
                      class="w-full h-11 px-4 bg-surface-container-low text-on-surface font-body-md text-body-md rounded focus:outline-none focus:ring-2 focus:ring-secondary"
                      placeholder="Riyadh, Saudi Arabia" type="text" />
                  </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface uppercase">System
                      Architecture</label>
                    <select
                      class="w-full h-11 px-4 bg-surface-container-low text-on-surface font-body-md text-body-md rounded focus:outline-none focus:ring-2 focus:ring-secondary">
                      <option>Solid Aluminum Cladding (3.0mm)</option>
                      <option>Aluminum Honeycomb Structural Panels</option>
                      <option>Intelligent Motorized Solar Louvers</option>
                      <option>Insulated Unitized Spandrel Assembly</option>
                      <option>Curved / Hyperbolic Bespoke Grilles</option>
                    </select>
                  </div>
                  <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface uppercase">Estimated Façade Surface
                      Area</label>
                    <select
                      class="w-full h-11 px-4 bg-surface-container-low text-on-surface font-body-md text-body-md rounded focus:outline-none focus:ring-2 focus:ring-secondary">
                      <option>Under 2,000 m²</option>
                      <option>2,000 – 10,000 m²</option>
                      <option>10,000 – 30,000 m²</option>
                      <option>30,000+ m² (Monumental Scheme)</option>
                    </select>
                  </div>
                </div>
                <div class="space-y-2">
                  <label class="block font-label-md text-label-md text-on-surface uppercase">Technical Request &amp;
                    Specific Fire/Wind Criteria</label>
                  <textarea
                    class="w-full p-4 bg-surface-container-low text-on-surface font-body-md text-body-md rounded focus:outline-none focus:ring-2 focus:ring-secondary"
                    placeholder="Detail any specific local authority testing prerequisites (e.g. NFPA 285, ASTM E119 2-hour rating, specific RAL/PVDF color matching, or hurricane wind load certification)..."
                    rows="4"></textarea>
                </div>
                <!-- Drag & Drop Mock Attachment -->
                <div
                  class="p-6 bg-surface-container-low rounded-lg text-center cursor-pointer hover:bg-surface-container-high transition-colors">
                  <span class="material-symbols-outlined text-3xl text-secondary">cloud_upload</span>
                  <p class="font-body-sm text-body-sm text-on-surface font-medium mt-1">Upload CAD Elevation, Tender
                    Specification or Façade Schedule</p>
                  <span class="font-label-sm text-label-sm text-outline">DWG, DXF, IFC, RVT, or PDF up to 50 MB</span>
                </div>
                <button
                  class="w-full py-4 bg-primary-container text-on-primary hover:bg-secondary font-label-lg text-label-lg font-bold tracking-wider uppercase rounded shadow-lg transition-colors flex items-center justify-center gap-2"
                  type="submit">
                  <span class="material-symbols-outlined">send</span>
                  TRANSMIT SPECIFICATION DOSSIER REQUEST
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- Interactive Filtering & Calculator Script -->
      <script>
        // Tab Filter Logic
        const filterBtns = document.querySelectorAll('.filter-btn');
        const resourceCards = document.querySelectorAll('.resource-card');
        const searchInput = document.getElementById('searchInput');

        filterBtns.forEach(btn => {
          btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
              b.classList.remove('bg-secondary-fixed', 'text-on-secondary-fixed', 'font-semibold');
              b.classList.add('bg-surface-container-high/40', 'text-surface-bright', 'font-medium');
            });
            btn.classList.remove('bg-surface-container-high/40', 'text-surface-bright', 'font-medium');
            btn.classList.add('bg-secondary-fixed', 'text-on-secondary-fixed', 'font-semibold');

            const category = btn.getAttribute('data-filter');
            filterItems(category, searchInput.value.toLowerCase());
          });
        });

        if (searchInput) {
          searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            const activeBtn = document.querySelector('.filter-btn.bg-secondary-fixed');
            const category = activeBtn ? activeBtn.getAttribute('data-filter') : 'all';
            filterItems(category, query);
          });
        }

        function filterItems(category, query) {
          resourceCards.forEach(card => {
            const itemCategory = card.getAttribute('data-category');
            const textContent = card.innerText.toLowerCase();
            const matchesCategory = (category === 'all' || itemCategory === category);
            const matchesQuery = !query || textContent.includes(query);

            if (matchesCategory && matchesQuery) {
              card.style.display = 'flex';
            } else {
              card.style.display = 'none';
            }
          });
        }

        // Solar Heat Gain Coefficient Dynamic Simulator
        const angleSlider = document.getElementById('angleSlider');
        const angleVal = document.getElementById('angleVal');
        const baseGlazing = document.getElementById('baseGlazing');
        const shgcResult = document.getElementById('shgcResult');
        const shgcRing = document.getElementById('shgcRing');

        function updateSHGC() {
          if (!angleSlider || !shgcResult) return;
          const angle = parseInt(angleSlider.value, 10);
          const base = parseFloat(baseGlazing.value);
          angleVal.innerText = angle + '°';

          // Reduction factor formula based on louver tilt
          const factor = 1 - (angle / 90) * 0.72;
          const calculated = (base * factor).toFixed(2);
          shgcResult.innerText = calculated;

          const percentage = Math.min(100, Math.max(10, Math.round(calculated * 150)));
          if (shgcRing) {
            shgcRing.setAttribute('stroke-dasharray', `${percentage}, 100`);
          }
        }

        if (angleSlider && baseGlazing) {
          angleSlider.addEventListener('input', updateSHGC);
          baseGlazing.addEventListener('change', updateSHGC);
        }

        // Wind Span Calculator
        const windBtns = document.querySelectorAll('.wind-btn');
        const spanSlider = document.getElementById('spanSlider');
        const spanVal = document.getElementById('spanVal');
        const inertiaResult = document.getElementById('inertiaResult');
        const inertiaBar = document.getElementById('inertiaBar');

        let currentPressure = 2.5;

        windBtns.forEach(btn => {
          btn.addEventListener('click', () => {
            windBtns.forEach(b => {
              b.classList.remove('bg-secondary-fixed', 'text-on-secondary-fixed', 'font-bold');
              b.classList.add('bg-surface-container', 'text-on-surface', 'font-medium');
            });
            btn.classList.add('bg-secondary-fixed', 'text-on-secondary-fixed', 'font-bold');
            btn.classList.remove('bg-surface-container', 'text-on-surface', 'font-medium');
            currentPressure = parseFloat(btn.getAttribute('data-pressure'));
            updateWindGuide();
          });
        });

        if (spanSlider) {
          spanSlider.addEventListener('input', () => {
            spanVal.innerText = spanSlider.value + ' m';
            updateWindGuide();
          });
        }

        function updateWindGuide() {
          if (!spanSlider || !inertiaResult) return;
          const span = parseFloat(spanSlider.value);
          // Rough sizing formula for demonstration: I = (q * L^4) factor
          const inertia = Math.round((currentPressure * Math.pow(span, 3.8) * 1.8));
          inertiaResult.innerText = inertia + ' cm⁴';
          const pct = Math.min(100, Math.round((inertia / 800) * 100));
          if (inertiaBar) inertiaBar.style.width = pct + '%';
        }

        // Module Cladding Gauge Selection
        const panelModule = document.getElementById('panelModule');
        const solidGauge = document.getElementById('solidGauge');
        const honeycombGauge = document.getElementById('honeycombGauge');

        if (panelModule) {
          panelModule.addEventListener('change', () => {
            const val = panelModule.value;
            if (val === '1200') {
              solidGauge.innerText = '2.5 mm (AA3003-H14)';
              honeycombGauge.innerText = '10.0 mm Core (0.7/0.7)';
            } else if (val === '1500') {
              solidGauge.innerText = '3.0 mm (AA3003-H14)';
              honeycombGauge.innerText = '15.0 mm Core (0.8/0.8)';
            } else {
              solidGauge.innerText = '4.0 mm Structural (AA5052-H32)';
              honeycombGauge.innerText = '25.0 mm Honeycomb (1.0/1.0)';
            }
          });
        }
      </script>
    </div>
  </main>

<?php get_footer(); ?>
