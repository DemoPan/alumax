<?php
if (!defined('ABSPATH')) { exit; }
?>
  <main class="w-full bg-surface">
    <div class="flex flex-col w-full">
      <!-- BREADCRUMB & METADATA BAR -->
      <section class="w-full bg-surface-container-low py-space-sm">
        <div
          class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin flex flex-wrap items-center justify-between gap-space-sm">
          <nav
            class="flex items-center gap-2 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">
            <a class="hover:text-primary transition-colors" href="#">Products</a>
            <span class="text-outline-variant">/</span>
            <a class="hover:text-primary transition-colors" href="#">Solar &amp; Shading Systems</a>
            <span class="text-outline-variant">/</span>
            <span class="text-primary font-semibold">Intelligent Motorized Louvers</span>
            <span
              class="bg-surface-variant text-on-surface-variant px-2 py-0.5 rounded font-label-sm text-label-sm ml-1">ALU-SYS-MOT900</span>
          </nav>
          <div class="flex items-center gap-space-sm flex-wrap">
            <span
              class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-primary-container text-on-primary rounded font-label-sm text-label-sm uppercase tracking-wider">
              <span class="w-2 h-2 rounded-full bg-secondary-fixed animate-pulse"></span>
              BMS / IoT Connected
            </span>
            <span
              class="inline-flex items-center gap-1 px-2.5 py-1 bg-surface-container-high text-on-surface rounded font-label-sm text-label-sm uppercase tracking-wider">
              <span class="material-symbols-outlined text-sm text-secondary">cyclone</span>
              12-Level Typhoon Rated
            </span>
            <span
              class="inline-flex items-center gap-1 px-2.5 py-1 bg-secondary text-on-secondary rounded font-label-sm text-label-sm uppercase tracking-wider font-semibold">
              <span class="material-symbols-outlined text-sm">energy_savings_leaf</span>
              SHGC Reduction ≤ 34%
            </span>
          </div>
        </div>
      </section>
      <!-- PRODUCT HERO & INTERACTIVE SPECIFICATION DESK -->
      <section class="w-full bg-surface-bright py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <!-- Title Block -->
          <div class="mb-space-lg">
            <div class="flex items-center gap-3 mb-2">
              <span class="font-label-md text-label-md text-secondary uppercase tracking-widest font-semibold">Adaptive
                Dynamic Envelope System</span>
              <span class="w-8 h-px bg-secondary"></span>
              <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">ASTM E330 // EN 1991-1-4
                Certified</span>
            </div>
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-md">
              <div>
                <h1 class="font-display-xl text-display-xl text-primary tracking-tight">ALU-SYS-MOT900</h1>
                <p class="font-headline-md text-headline-md text-on-surface-variant font-normal">Intelligent Motorized /
                  Dynamic Solar-Tracking Louver Envelope</p>
              </div>
              <div class="flex items-center gap-space-sm">
                <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Engineering Class:</span>
                <span
                  class="font-label-md text-label-md text-on-primary px-3 py-1 bg-primary rounded font-semibold tracking-wider">Class
                  A Architectural Exterior</span>
              </div>
            </div>
          </div>
          <!-- Main Configurator Split -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
            <!-- Left: Visual Showcase & Active Blade Angle Inspector (7 Cols) -->
            <div class="lg:col-span-7 flex flex-col gap-space-md">
              <!-- Louver Simulation Canvas -->
              <div
                class="relative bg-primary-container text-on-primary rounded-xl overflow-hidden shadow-xl p-space-md min-h-[460px] flex flex-col justify-between">
                <!-- Background Graphic Grid Overlay -->
                <div class="absolute inset-0 opacity-10 pointer-events-none"
                  style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;">
                </div>
                <!-- Louver Angle Graphic Simulation -->
                <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-space-md">
                  <div class="space-y-1">
                    <span class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider">Blade Angle
                      Telemetry</span>
                    <div class="flex items-baseline gap-2">
                      <span class="font-display-lg text-display-lg text-white font-bold"
                        id="blade-angle-readout">45°</span>
                      <span class="font-label-md text-label-md text-slate-300">Optimal Solar Altitude</span>
                    </div>
                  </div>
                  <!-- Live Angle Control Dial -->
                  <div class="bg-white/10 backdrop-blur-md p-space-sm rounded-lg flex items-center gap-3">
                    <span class="font-label-sm text-label-sm text-slate-200">0° (Flat)</span>
                    <input
                      class="w-32 h-1.5 bg-slate-600 rounded-lg appearance-none cursor-pointer accent-secondary-fixed"
                      id="louver-angle-slider" max="105" min="0" type="range" value="45" />
                    <span class="font-label-sm text-label-sm text-slate-200">105° (Full Shade)</span>
                  </div>
                </div>
                <!-- Central Vector Blade Cross-Section Diagram -->
                <div class="relative z-10 my-space-md flex items-center justify-center py- space-sm">
                  <div class="w-full max-w-lg aspect-[16/9] flex items-center justify-center relative">
                    <!-- Solar Vector Rays Indicator -->
                    <div
                      class="absolute top-2 right-4 flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full font-label-sm text-label-sm text-secondary-fixed">
                      <span class="material-symbols-outlined text-sm">wb_sunny</span>
                      <span>Sun Vector: Azimuth 184° / Alt 52°</span>
                    </div>
                    <!-- Louver Blade Group that rotates via JS -->
                    <svg class="w-full h-full transition-transform duration-300 ease-out" id="louver-svg-canvas"
                      viewbox="0 0 500 280">
                      <defs>
                        <lineargradient id="bladeGrad" x1="0%" x2="100%" y1="0%" y2="100%">
                          <stop offset="0%" stop-color="#bac8dc"></stop>
                          <stop offset="50%" stop-color="#ffffff"></stop>
                          <stop offset="100%" stop-color="#778598"></stop>
                        </lineargradient>
                        <lineargradient id="actuatorGrad" x1="0%" x2="0%" y1="0%" y2="100%">
                          <stop offset="0%" stop-color="#ffddb5"></stop>
                          <stop offset="100%" stop-color="#7b5825"></stop>
                        </lineargradient>
                      </defs>
                      <!-- Reference Center Grid Line -->
                      <line stroke="#778598" stroke-dasharray="4 4" stroke-width="1" x1="40" x2="460" y1="140" y2="140">
                      </line>
                      <circle cx="250" cy="140" fill="none" opacity="0.4" r="110" stroke="#778598"
                        stroke-dasharray="2 6" stroke-width="1"></circle>
                      <!-- Rotating Group: Centered at (250, 140) -->
                      <g id="dynamic-blade-group" transform="rotate(45, 250, 140)">
                        <!-- Aerofoil Blade Shell -->
                        <path d="M 60 140 C 90 100, 410 100, 440 140 C 410 180, 90 180, 60 140 Z" fill="url(#bladeGrad)"
                          stroke="#bac8dc" stroke-width="2.5"></path>
                        <!-- Hollow Core Webs -->
                        <line stroke="#0f1c2c" stroke-width="3" x1="160" x2="160" y1="116" y2="164"></line>
                        <line stroke="#0f1c2c" stroke-width="3" x1="340" x2="340" y1="116" y2="164"></line>
                        <!-- Stainless Steel Pivot Shaft -->
                        <circle cx="250" cy="140" fill="#0f1c2c" r="18" stroke="#ffddb5" stroke-width="4"></circle>
                        <circle cx="250" cy="140" fill="#ffddb5" r="6"></circle>
                        <!-- Aerodynamic EPDM Soft Gasket Flange -->
                        <circle cx="60" cy="140" fill="#191c1e" r="6"></circle>
                        <circle cx="440" cy="140" fill="#191c1e" r="6"></circle>
                        <!-- Push-Pull Actuator Connection Eyelet -->
                        <circle cx="380" cy="140" fill="url(#actuatorGrad)" r="9"></circle>
                        <text fill="#ffddb5" font-family="JetBrains Mono" font-size="10" text-anchor="middle" x="380"
                          y="165">LINKAGE</text>
                      </g>
                      <!-- Static Drive Linkage Bar Mock -->
                      <rect fill="#7b5825" height="30" rx="3" width="16" x="242" y="240"></rect>
                      <line stroke="#ffddb5" stroke-dasharray="3 3" stroke-width="2" x1="250" x2="250" y1="140"
                        y2="240"></line>
                      <text fill="#d6e4f9" font-family="JetBrains Mono" font-size="10" text-anchor="middle" x="250"
                        y="275">IP66 ACTUATOR AXIS</text>
                    </svg>
                  </div>
                </div>
                <!-- Bottom Live Metric Readout -->
                <div
                  class="relative z-10 grid grid-cols-2 sm:grid-cols-4 gap-space-sm pt-space-sm border-t border-white/10">
                  <div class="space-y-0.5">
                    <span class="font-label-sm text-label-sm text-slate-300">Shading Efficiency</span>
                    <p class="font-headline-sm text-headline-sm text-secondary-fixed font-bold" id="eff-metric">78%</p>
                  </div>
                  <div class="space-y-0.5">
                    <span class="font-label-sm text-label-sm text-slate-300">Direct Lux Cutoff</span>
                    <p class="font-headline-sm text-headline-sm text-white font-bold" id="lux-metric">54,000 lx</p>
                  </div>
                  <div class="space-y-0.5">
                    <span class="font-label-sm text-label-sm text-slate-300">Actuator Torque</span>
                    <p class="font-headline-sm text-headline-sm text-white font-bold">450 N·m</p>
                  </div>
                  <div class="space-y-0.5">
                    <span class="font-label-sm text-label-sm text-slate-300">Rotational Accuracy</span>
                    <p class="font-headline-sm text-headline-sm text-secondary-fixed font-bold">±0.5°</p>
                  </div>
                </div>
              </div>
              <!-- Photo Gallery Strip with Spec Focus -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-space-sm">
                <div class="bg-surface-container rounded-lg overflow-hidden group relative shadow-sm">
                  <img class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-500"
                    data-alt="Close up architectural macro shot of 6063-T6 extruded aluminum aerofoil louver blade showing champagne bronze PVDF coating, internal stainless steel pivot bearing and IP66 drive arm connection in bright daylight."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCat9ZIymeplSXSclP7JOgI9cuS9Tul3NkbhLmPyy2HD5q9Hm6PZCveq-GzrLXb9G3IV3DMWwUUNKGXKBjWj0sigKrDFIgXy9NvcTaBPr5WGhvRakgdVgRnfNAK-9tcKV89cf1ZsY_xTSDUj5f33d1nQMUaekpAqMxL9b7B4wz-c0iZ-exnAY8RbFsHwUz_APA481g8e3UNE_eNPCC0rhkhj8OrQEqMe2HFCpHr6SA1cjCS4rkfpq8U" />
                  <div class="p-space-sm bg-surface-container">
                    <p class="font-label-sm text-label-sm text-primary font-semibold uppercase">Blade Profile Detail</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Aerofoil Wing Extrusion</p>
                  </div>
                </div>
                <div class="bg-surface-container rounded-lg overflow-hidden group relative shadow-sm">
                  <img class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-500"
                    data-alt="Industrial linear actuator mechanism mounted on dark architectural curtain wall frame with stainless steel push pull rod and braided waterproof conduit cables in modern engineering facility."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDuzshFfJKPRvtnSWRX-yh2h9l8ndurv6zJIgX_EwB_Xqnu91sE1VtO-hwggGvQ-09phbiqE7IVSog9KWoyqvFhHScs_WsC1BDEvdQKR4beV71Hs5t0rTIPGKaLdiiGW7SmKSQdJca3cCYRmuGzu_s38O-F9-JBHbzsooIFwLTQbpcAAJuN9NhbrDzdljxVF0sHmcgOBJSP2dp3FdQrdi1UqYCtk15S_w3vtpX_nuMx0Xnbb1H___dV" />
                  <div class="p-space-sm bg-surface-container">
                    <p class="font-label-sm text-label-sm text-primary font-semibold uppercase">Actuation Drive</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">IP66 Sealed 24V DC Rod</p>
                  </div>
                </div>
                <div class="bg-surface-container rounded-lg overflow-hidden group relative shadow-sm">
                  <img class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-500"
                    data-alt="Modern high rise glass tower facade exterior with thousands of synchronized bronze colored motorized aluminum louvers partially tilted against bright blue sky and sun reflections."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHqYM3W946J18XMVjvCKZp3iO3n40nEmdl26EwIuSbdpzOAhieWBQlOyIvc3rf2TjDIqu4XkaEqzOWmd06mNOC-_3ZbTuncmCrHYZQ10fhEQn3haxmawjcrLGfHVJY1Bi3FlDq5fFRe1TURwN111a2jmS3P2rnUApMQoRTziPDlGH0VgpQSNI2la7zV4Ot4MzMM5DMeBjRDqT_-R4GChqGnehB-Xz6ddi4C0BhvgWpXUa-Thctc13Q" />
                  <div class="p-space-sm bg-surface-container">
                    <p class="font-label-sm text-label-sm text-primary font-semibold uppercase">Facade Integration</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">KAFD Tower Reference</p>
                  </div>
                </div>
              </div>
              <!-- Quick Metric Highlights Strip -->
              <div class="bg-surface-container-low p-space-md rounded-xl grid grid-cols-2 md:grid-cols-4 gap-space-md">
                <div>
                  <span class="font-label-sm text-label-sm text-on-surface-variant uppercase block">Blade Width</span>
                  <span class="font-headline-sm text-headline-sm text-primary font-bold">150–600mm</span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-on-surface-variant uppercase block">Max Single
                    Span</span>
                  <span class="font-headline-sm text-headline-sm text-primary font-bold">6,000mm</span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-on-surface-variant uppercase block">Wind
                    Resistance</span>
                  <span class="font-headline-sm text-headline-sm text-primary font-bold">2.8×10³ N/m²</span>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-on-surface-variant uppercase block">Ingress
                    Rating</span>
                  <span class="font-headline-sm text-headline-sm text-primary font-bold">IP66 Industrial</span>
                </div>
              </div>
            </div>
            <!-- Right: Engineering Specification Configurator (5 Cols) -->
            <div class="lg:col-span-5 bg-surface-container-lowest p-space-lg rounded-xl shadow-lg space-y-space-md">
              <div class="space-y-1">
                <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest font-semibold">Tender
                  Specification Builder</span>
                <h2 class="font-headline-lg text-headline-lg text-primary">System Parameter Configurator</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Select profile geometries, drive systems,
                  and automation protocols for instant engineering estimation and schedule export.</p>
              </div>
              <!-- Configuration Controls -->
              <form class="space-y-space-md" onsubmit="event.preventDefault();">
                <!-- 1. Blade Profile Geometry -->
                <div>
                  <label class="block font-label-md text-label-md text-primary uppercase font-semibold mb-2">
                    1. Blade Profile Geometry <span class="text-secondary">*</span>
                  </label>
                  <div class="grid grid-cols-2 gap-2">
                    <label
                      class="flex flex-col p-3 rounded-lg bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors">
                      <div class="flex items-center justify-between mb-1">
                        <span class="font-headline-sm text-headline-sm text-primary">Aerofoil Wing</span>
                        <input checked="" class="text-secondary focus:ring-secondary" name="blade_geom" type="radio"
                          value="aerofoil" />
                      </div>
                      <span class="font-label-sm text-label-sm text-on-surface-variant">Standard High Aerodynamic</span>
                    </label>
                    <label
                      class="flex flex-col p-3 rounded-lg bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors">
                      <div class="flex items-center justify-between mb-1">
                        <span class="font-headline-sm text-headline-sm text-primary">Box Louver</span>
                        <input class="text-secondary focus:ring-secondary" name="blade_geom" type="radio" value="box" />
                      </div>
                      <span class="font-label-sm text-label-sm text-on-surface-variant">Modern Cuboid Reveal</span>
                    </label>
                    <label
                      class="flex flex-col p-3 rounded-lg bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors">
                      <div class="flex items-center justify-between mb-1">
                        <span class="font-headline-sm text-headline-sm text-primary">Parabolic Curve</span>
                        <input class="text-secondary focus:ring-secondary" name="blade_geom" type="radio"
                          value="parabolic" />
                      </div>
                      <span class="font-label-sm text-label-sm text-on-surface-variant">Max Lux Deflection</span>
                    </label>
                    <label
                      class="flex flex-col p-3 rounded-lg bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors">
                      <div class="flex items-center justify-between mb-1">
                        <span class="font-headline-sm text-headline-sm text-primary">Perforated Core</span>
                        <input class="text-secondary focus:ring-secondary" name="blade_geom" type="radio"
                          value="perforated" />
                      </div>
                      <span class="font-label-sm text-label-sm text-on-surface-variant">Acoustic &amp; Diffuse
                        View</span>
                    </label>
                  </div>
                </div>
                <!-- 2. Actuation & Drive Mechanism -->
                <div>
                  <label class="block font-label-md text-label-md text-primary uppercase font-semibold mb-2">
                    2. Actuator &amp; Drive Architecture <span class="text-secondary">*</span>
                  </label>
                  <div class="space-y-2">
                    <label class="flex items-start gap-3 p-3 rounded-lg bg-surface-container cursor-pointer">
                      <input checked="" class="mt-1 text-secondary focus:ring-secondary" name="actuator_type"
                        type="radio" value="24v" />
                      <div>
                        <span class="font-label-md text-label-md text-primary font-bold block">24V DC IP66 Linear
                          Actuator (Precision ±0.5° Encoder)</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Whisper-quiet low-voltage drive
                          with continuous pulse telemetry feedback. Silent mode &lt; 38 dB.</span>
                      </div>
                    </label>
                    <label class="flex items-start gap-3 p-3 rounded-lg bg-surface-container cursor-pointer">
                      <input class="mt-1 text-secondary focus:ring-secondary" name="actuator_type" type="radio"
                        value="230v" />
                      <div>
                        <span class="font-label-md text-label-md text-primary font-bold block">230V AC Heavy-Load
                          Tubular Transmission Motor</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">For high-span mega-blades up to
                          600mm. Built-in thermal cutoff and mechanical end-stops.</span>
                      </div>
                    </label>
                  </div>
                </div>
                <!-- 3. Smart Integration Protocol -->
                <div>
                  <label class="block font-label-md text-label-md text-primary uppercase font-semibold mb-2">
                    3. Building Management Integration <span class="text-secondary">*</span>
                  </label>
                  <div class="grid grid-cols-3 gap-2">
                    <label
                      class="flex items-center justify-between p-2.5 bg-surface-container rounded-lg cursor-pointer">
                      <span class="font-label-sm text-label-sm font-bold text-primary">BACnet IP</span>
                      <input checked="" class="rounded text-secondary focus:ring-secondary" name="protocol"
                        type="checkbox" value="bacnet" />
                    </label>
                    <label
                      class="flex items-center justify-between p-2.5 bg-surface-container rounded-lg cursor-pointer">
                      <span class="font-label-sm text-label-sm font-bold text-primary">KNX Bus</span>
                      <input checked="" class="rounded text-secondary focus:ring-secondary" name="protocol"
                        type="checkbox" value="knx" />
                    </label>
                    <label
                      class="flex items-center justify-between p-2.5 bg-surface-container rounded-lg cursor-pointer">
                      <span class="font-label-sm text-label-sm font-bold text-primary">Modbus RTU</span>
                      <input class="rounded text-secondary focus:ring-secondary" name="protocol" type="checkbox"
                        value="modbus" />
                    </label>
                  </div>
                </div>
                <!-- 4. Alloy & Surface Coating -->
                <div>
                  <label class="block font-label-md text-label-md text-primary uppercase font-semibold mb-2">
                    4. Extrusion Finish &amp; Architectural Grade
                  </label>
                  <select
                    class="w-full bg-surface-container rounded-lg p-3 font-body-md text-body-md text-primary focus:outline-none focus:bg-surface-container-high transition-colors">
                    <option>PPG Duranar® 3-Coat PVDF Coating (Color: Champagne Bronze #B88E56) - 20 Yr Warranty</option>
                    <option>25μm High-Spec Architectural Anodized (Natural Silver Matt)</option>
                    <option>25μm Deep Architectural Bronze Anodized</option>
                    <option>Fluoropolymer Powder Coat (Tiger Drylac Carbon Gray RAL 7021)</option>
                    <option>Custom Architectural Match (Spectrophotometer CIF Formulation)</option>
                  </select>
                </div>
                <!-- Action CTAs -->
                <div class="pt-space-sm space-y-2">
                  <a class="w-full py-3.5 px-space-md bg-secondary hover:bg-secondary/90 text-on-secondary rounded-lg font-label-md text-label-md uppercase tracking-wider font-semibold flex items-center justify-center gap-2 shadow-md transition-all"
                    href="#fast-rfq-section">
                    <span class="material-symbols-outlined text-base">request_quote</span>
                    Request Specimen Kit &amp; Engineering Tender Quote
                  </a>
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <a class="py-2.5 px-3 bg-surface-container-high hover:bg-surface-variant text-primary rounded-lg font-label-sm text-label-sm uppercase tracking-wider font-semibold flex items-center justify-center gap-2 transition-colors"
                      href="#technical-resources">
                      <span class="material-symbols-outlined text-base">description</span>
                      Download TDS (PDF 5.8MB)
                    </a>
                    <a class="py-2.5 px-3 bg-surface-container-high hover:bg-surface-variant text-primary rounded-lg font-label-sm text-label-sm uppercase tracking-wider font-semibold flex items-center justify-center gap-2 transition-colors"
                      href="#technical-resources">
                      <span class="material-symbols-outlined text-base">view_in_ar</span>
                      BIM LOD 400 (Revit 24MB)
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- ENGINEERING PERFORMANCE MATRIX -->
      <section class="w-full bg-surface py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-space-lg">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
            <div>
              <span
                class="font-label-sm text-label-sm text-secondary uppercase tracking-widest font-semibold block mb-1">Building
                Physics &amp; Structural Capacity</span>
              <h2 class="font-headline-lg text-headline-lg text-primary">Dynamic Performance &amp; Schedule Matrix</h2>
            </div>
            <div class="font-label-sm text-label-sm text-on-surface-variant">
              Testing Standards: ASTM E330 / EN 13659 / ISO 9001:2015
            </div>
          </div>
          <!-- Schedule Table -->
          <div class="overflow-x-auto bg-surface-container-lowest rounded-xl shadow-md">
            <table class="w-full text-left font-body-sm text-body-sm">
              <thead class="bg-primary-container text-on-primary font-label-sm text-label-sm uppercase tracking-wider">
                <tr>
                  <th class="py-4 px-space-md">Blade Model Code</th>
                  <th class="py-4 px-space-md">Profile Width</th>
                  <th class="py-4 px-space-md">Max Unsupported Span</th>
                  <th class="py-4 px-space-md">Wind Load Resistance</th>
                  <th class="py-4 px-space-md">SHGC Coefficient</th>
                  <th class="py-4 px-space-md">Acoustic Rating</th>
                  <th class="py-4 px-space-md">Cycle Life Testing</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-surface-container">
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-4 px-space-md font-label-md text-label-md font-semibold text-primary">ALU-MOT-200A</td>
                  <td class="py-4 px-space-md text-on-surface">200 mm (7.87 in)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm">3,500 mm</td>
                  <td class="py-4 px-space-md">2,400 Pa (Class 6 EN 13659)</td>
                  <td class="py-4 px-space-md text-secondary font-semibold">0.24 (76% Heat Block)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm">&lt; 34 dB(A)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm text-primary">100,000 Cycles</td>
                </tr>
                <tr class="bg-surface-container-low/50 hover:bg-surface-container-low transition-colors">
                  <td class="py-4 px-space-md font-label-md text-label-md font-semibold text-primary">ALU-MOT-300A
                    (Standard)</td>
                  <td class="py-4 px-space-md text-on-surface">300 mm (11.81 in)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm">4,800 mm</td>
                  <td class="py-4 px-space-md">2,800 Pa (Cat 5 Hurricane)</td>
                  <td class="py-4 px-space-md text-secondary font-semibold">0.18 (82% Heat Block)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm">&lt; 36 dB(A)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm text-primary">100,000 Cycles</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-4 px-space-md font-label-md text-label-md font-semibold text-primary">ALU-MOT-450M
                    (Mega-Span)</td>
                  <td class="py-4 px-space-md text-on-surface">450 mm (17.72 in)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm">5,500 mm</td>
                  <td class="py-4 px-space-md">3,200 Pa (High-Rise Zone)</td>
                  <td class="py-4 px-space-md text-secondary font-semibold">0.14 (86% Heat Block)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm">&lt; 38 dB(A)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm text-primary">120,000 Cycles</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-4 px-space-md font-label-md text-label-md font-semibold text-primary">ALU-MOT-600X
                    (Curtain Integrated)</td>
                  <td class="py-4 px-space-md text-on-surface">600 mm (23.62 in)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm">6,000 mm Reinforced</td>
                  <td class="py-4 px-space-md">3,600 Pa (Typhoon Spec)</td>
                  <td class="py-4 px-space-md text-secondary font-semibold">0.12 (88% Heat Block)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm">&lt; 40 dB(A)</td>
                  <td class="py-4 px-space-md font-label-sm text-label-sm text-primary">120,000 Cycles</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Engineering Callout Cards -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
            <div class="bg-surface-container p-space-md rounded-xl space-y-2">
              <div class="flex items-center gap-2 text-secondary">
                <span class="material-symbols-outlined text-lg">safety_check</span>
                <span class="font-label-md text-label-md uppercase font-bold text-primary">Fail-Safe Emergency
                  Return</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">Integrated supercapacitor &amp; 24V UPS
                returns all louvers to 0° aerodynamic horizontal within 4 seconds upon fire alarm trigger or main grid
                voltage drop.</p>
            </div>
            <div class="bg-surface-container p-space-md rounded-xl space-y-2">
              <div class="flex items-center gap-2 text-secondary">
                <span class="material-symbols-outlined text-lg">cyclone</span>
                <span class="font-label-md text-label-md uppercase font-bold text-primary">Typhoon Auto-Park
                  Logic</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">Rooftop 3-axis anemometer overrides BMS if
                sustained wind gusts exceed 28 m/s, locking blades at optimum low-drag pitch to minimize structural
                facade load.</p>
            </div>
            <div class="bg-surface-container p-space-md rounded-xl space-y-2">
              <div class="flex items-center gap-2 text-secondary">
                <span class="material-symbols-outlined text-lg">eco</span>
                <span class="font-label-md text-label-md uppercase font-bold text-primary">LEED v4 Credit
                  Contribution</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">Contributes directly to Energy &amp;
                Atmosphere (EA Credit 2: Optimize Energy Performance) and Indoor Environmental Quality (EQ Credit 7:
                Daylight).</p>
            </div>
          </div>
        </div>
      </section>
      <!-- SUBSTRUCTURE MOUNTING TYPOLOGIES -->
      <section class="w-full bg-surface-container-low py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-space-lg">
          <div class="max-w-2xl space-y-1">
            <span
              class="font-label-sm text-label-sm text-secondary uppercase tracking-widest font-semibold">Substructure
              Engineering</span>
            <h2 class="font-headline-lg text-headline-lg text-primary">Architectural Typologies &amp; Mounting Methods
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Engineered for direct integration into unitized
              curtain wall transoms, structural steel cantilevers, or double-skin thermal cavity facades.</p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
            <!-- Typology 01 -->
            <div
              class="bg-surface-container-lowest rounded-xl p-space-md shadow-md flex flex-col justify-between space-y-space-md">
              <div class="space-y-space-sm">
                <div class="bg-surface-container p-space-sm rounded-lg flex items-center justify-center h-48">
                  <svg class="w-full h-full" viewbox="0 0 240 140">
                    <rect fill="#0f1c2c" height="100" width="20" x="20" y="20"></rect>
                    <rect fill="#778598" height="8" width="160" x="40" y="40"></rect>
                    <path d="M 60 70 L 100 50 L 110 55 L 70 75 Z" fill="#ffddb5" stroke="#7b5825" stroke-width="1.5">
                    </path>
                    <path d="M 110 70 L 150 50 L 160 55 L 120 75 Z" fill="#ffddb5" stroke="#7b5825" stroke-width="1.5">
                    </path>
                    <path d="M 160 70 L 200 50 L 210 55 L 170 75 Z" fill="#ffddb5" stroke="#7b5825" stroke-width="1.5">
                    </path>
                    <line stroke="#ba1a1a" stroke-dasharray="2 2" stroke-width="1.5" x1="85" x2="185" y1="62" y2="62">
                    </line>
                    <circle cx="85" cy="62" fill="#ba1a1a" r="3"></circle>
                    <circle cx="135" cy="62" fill="#ba1a1a" r="3"></circle>
                    <circle cx="185" cy="62" fill="#ba1a1a" r="3"></circle>
                  </svg>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">Typology 01</span>
                  <h3 class="font-headline-md text-headline-md text-primary">Horizontal Cantilever Sunshade</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Mounted directly to slab edges or
                    outrigger steel trusses. Overhead solar blocking during high noon summer peaks.</p>
                </div>
              </div>
              <ul
                class="font-label-sm text-label-sm text-on-surface-variant space-y-1 pt-space-xs border-t border-surface-container">
                <li>• Actuation: Single Master Cylinder Push-Bar</li>
                <li>• Max Projection: Up to 2,400mm</li>
                <li>• Wind Uplift: Engineered for negative uplift</li>
              </ul>
            </div>
            <!-- Typology 02 -->
            <div
              class="bg-surface-container-lowest rounded-xl p-space-md shadow-md flex flex-col justify-between space-y-space-md">
              <div class="space-y-space-sm">
                <div class="bg-surface-container p-space-sm rounded-lg flex items-center justify-center h-48">
                  <svg class="w-full h-full" viewbox="0 0 240 140">
                    <rect fill="#778598" height="120" width="8" x="30" y="10"></rect>
                    <rect fill="#778598" height="120" width="8" x="200" y="10"></rect>
                    <!-- Vertical louvers in series -->
                    <path d="M 60 40 L 90 25 L 96 30 L 66 45 Z" fill="#ffddb5" stroke="#7b5825" stroke-width="1.5">
                    </path>
                    <path d="M 60 70 L 90 55 L 96 60 L 66 75 Z" fill="#ffddb5" stroke="#7b5825" stroke-width="1.5">
                    </path>
                    <path d="M 60 100 L 90 85 L 96 90 L 66 105 Z" fill="#ffddb5" stroke="#7b5825" stroke-width="1.5">
                    </path>
                    <line stroke="#ba1a1a" stroke-width="2" x1="81" x2="81" y1="37" y2="97"></line>
                    <rect fill="#0f1c2c" height="20" width="8" x="77" y="105"></rect>
                  </svg>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">Typology 02</span>
                  <h3 class="font-headline-md text-headline-md text-primary">Vertical Facade Ribbon Louvers</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Continuous vertical orientation to
                    intercept low-angle East/West morning and evening glare on high-rise envelopes.</p>
                </div>
              </div>
              <ul
                class="font-label-sm text-label-sm text-on-surface-variant space-y-1 pt-space-xs border-t border-surface-container">
                <li>• Actuation: Vertical Synchronized Tie-Rod</li>
                <li>• Max Blade Height: Up to 5,000mm</li>
                <li>• Self-Draining stainless pivot bearings</li>
              </ul>
            </div>
            <!-- Typology 03 -->
            <div
              class="bg-surface-container-lowest rounded-xl p-space-md shadow-md flex flex-col justify-between space-y-space-md">
              <div class="space-y-space-sm">
                <div class="bg-surface-container p-space-sm rounded-lg flex items-center justify-center h-48">
                  <svg class="w-full h-full" viewbox="0 0 240 140">
                    <!-- Double Skin Cavity -->
                    <line stroke="#0f1c2c" stroke-width="6" x1="40" x2="40" y1="10" y2="130"></line>
                    <line stroke="#0f1c2c" stroke-width="6" x1="190" x2="190" y1="10" y2="130"></line>
                    <rect fill="#f2f4f6" height="120" opacity="0.6" width="144" x="43" y="10"></rect>
                    <!-- Louvers inside cavity -->
                    <path d="M 90 35 L 135 25 L 140 29 L 95 39 Z" fill="#bac8dc" stroke="#0f1c2c" stroke-width="1.5">
                    </path>
                    <path d="M 90 70 L 135 60 L 140 64 L 95 74 Z" fill="#bac8dc" stroke="#0f1c2c" stroke-width="1.5">
                    </path>
                    <path d="M 90 105 L 135 95 L 140 99 L 95 109 Z" fill="#bac8dc" stroke="#0f1c2c" stroke-width="1.5">
                    </path>
                    <text fill="#778598" font-family="JetBrains Mono" font-size="9" text-anchor="middle" x="115"
                      y="130">THERMAL CAVITY</text>
                  </svg>
                </div>
                <div>
                  <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold">Typology 03</span>
                  <h3 class="font-headline-md text-headline-md text-primary">Double-Skin Cavity Louvers</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Installed inside naturally
                    ventilated double-wall cavities. Zero maintenance weather exposure and optimal stack-effect venting.
                  </p>
                </div>
              </div>
              <ul
                class="font-label-sm text-label-sm text-on-surface-variant space-y-1 pt-space-xs border-t border-surface-container">
                <li>• Actuation: Concealed Internal Rack &amp; Pinion</li>
                <li>• Thermal Buffer Optimization</li>
                <li>• Protected from airborne salt &amp; sand</li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <!-- CONTROL ARCHITECTURE & BMS TOPOLOGY -->
      <section class="w-full bg-primary-container text-on-primary py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-space-lg">
          <div class="max-w-2xl space-y-1">
            <span
              class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-widest font-semibold">Intelligent
              IoT Control Ecosystem</span>
            <h2 class="font-headline-lg text-headline-lg text-white">Automated Sun-Tracking Topology</h2>
            <p class="font-body-md text-body-md text-slate-300">Continuous solar calculation based on GPS astronomical
              coordinates, live rooftop lux measurement, and indoor HVAC demand feedback.</p>
          </div>
          <!-- Control Architecture Diagram Flow -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-space-md">
            <div class="bg-white/5 backdrop-blur-md p-space-md rounded-xl space-y-2">
              <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-secondary-fixed mb-2">
                <span class="material-symbols-outlined">wb_sunny</span>
              </div>
              <span class="font-label-sm text-label-sm text-secondary-fixed uppercase block">01. Environmental
                Sensing</span>
              <h3 class="font-headline-sm text-headline-sm text-white">Rooftop Weather Array</h3>
              <p class="font-body-sm text-body-sm text-slate-300">Multi-axis GPS sun tracker, ultrasonic wind direction
                &amp; speed anemometer, rain radar, and 4-quadrant lux sensor.</p>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-space-md rounded-xl space-y-2">
              <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-secondary-fixed mb-2">
                <span class="material-symbols-outlined">memory</span>
              </div>
              <span class="font-label-sm text-label-sm text-secondary-fixed uppercase block">02. Edge Logic
                Compute</span>
              <h3 class="font-headline-sm text-headline-sm text-white">ALUMAX Master Controller</h3>
              <p class="font-body-sm text-body-sm text-slate-300">Executes solar trajectory algorithms with anti-shadow
                zone calculations to dynamically reposition blades every 3 minutes.</p>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-space-md rounded-xl space-y-2">
              <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-secondary-fixed mb-2">
                <span class="material-symbols-outlined">hub</span>
              </div>
              <span class="font-label-sm text-label-sm text-secondary-fixed uppercase block">03. Protocol Gateway</span>
              <h3 class="font-headline-sm text-headline-sm text-white">BACnet / KNX Bridge</h3>
              <p class="font-body-sm text-body-sm text-slate-300">Bi-directional integration with Johnson Controls,
                Siemens, Schneider, and Honeywell building automation networks.</p>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-space-md rounded-xl space-y-2">
              <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-secondary-fixed mb-2">
                <span class="material-symbols-outlined">precision_manufacturing</span>
              </div>
              <span class="font-label-sm text-label-sm text-secondary-fixed uppercase block">04. Precise
                Actuation</span>
              <h3 class="font-headline-sm text-headline-sm text-white">IP66 Slave Linear Drives</h3>
              <p class="font-body-sm text-body-sm text-slate-300">Directly synchronized arrays moving up to 40 blades
                simultaneously per actuator with hall-effect millimetric precision.</p>
            </div>
          </div>
          <!-- Telemetry Dashboard Banner -->
          <div
            class="bg-white/10 rounded-xl p-space-md flex flex-col md:flex-row items-center justify-between gap-space-md">
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined text-secondary-fixed text-3xl">cloud_sync</span>
              <div>
                <h4 class="font-headline-sm text-headline-sm text-white">Predictive Maintenance &amp; Cloud Telemetry
                </h4>
                <p class="font-body-sm text-body-sm text-slate-300">Continuous motor current draw monitoring detects ice
                  obstruction or mechanical friction before system faults occur.</p>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <span
                class="font-label-sm text-label-sm px-3 py-1 bg-white/15 text-white rounded uppercase font-semibold">Zero-Latency
                Override</span>
              <span
                class="font-label-sm text-label-sm px-3 py-1 bg-white/15 text-white rounded uppercase font-semibold">10-Yr
                Warranty</span>
            </div>
          </div>
        </div>
      </section>
      <!-- INTERNATIONAL EXPORT & CRATED PACKAGING -->
      <section class="w-full bg-surface py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-xl items-center">
            <div class="space-y-space-md">
              <div class="space-y-1">
                <span
                  class="font-label-sm text-label-sm text-secondary uppercase tracking-widest font-semibold">Precision
                  Export Logistics</span>
                <h2 class="font-headline-lg text-headline-lg text-primary">Pre-Wired Cassettes &amp; Drop-in Site
                  Assembly</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">To eliminate overseas installation errors
                  and accelerate high-rise schedules, ALUMAX manufactures louver arrays as pre-assembled modular
                  cassettes complete with factory-tested IP66 wiring looms and M12 waterproof plugs.</p>
              </div>
              <div class="space-y-space-sm">
                <div class="flex items-start gap-3">
                  <span class="material-symbols-outlined text-secondary text-xl mt-0.5">verified</span>
                  <div>
                    <h4 class="font-headline-sm text-headline-sm text-primary">100% Pre-Commissioned at Factory</h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Every motorized module undergoes a
                      mandatory 50-cycle burn-in test with electronic angle verification before crating.</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <span class="material-symbols-outlined text-secondary text-xl mt-0.5">inventory</span>
                  <div>
                    <h4 class="font-headline-sm text-headline-sm text-primary">ISPM-15 Certified Shock-Damped Crating
                    </h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Reinforced timber crates lined with
                      non-abrasive closed-cell PE foam to ensure zero micro-scratches on PVDF architectural surfaces
                      during ocean transit.</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <span class="material-symbols-outlined text-secondary text-xl mt-0.5">local_shipping</span>
                  <div>
                    <h4 class="font-headline-sm text-headline-sm text-primary">40ft High Cube Container Optimization
                    </h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Standardized cassette spans are
                      engineered to nest seamlessly into container freight, maximizing volume efficiency and reducing
                      CIF shipping costs.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-surface-container rounded-2xl p-space-md shadow-md space-y-space-sm">
              <img class="w-full h-80 object-cover rounded-xl"
                data-alt="Factory logistics floor showing high end export crating of large bronze aluminum motorized louver cassettes in certified wooden shockproof crates with container loading forklifts in background."
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBMKl6Us8UE8s1JBWdm5qgb3hxGbVWC-ZYrMTqE5k6Vg9T4xxGCG8OoewrK_msLgbW7qUCtG-Fxw2kHzjKT-dxZMVQe5Y9dSnqJzzI0tswJpgbePk8-ER_vALoG5718vkiRq-mT_3NMngLdoo1nijGh7V3-S28XP7m7SRzzEN775A_etJB5kzDNThF9NrHF0j9-sa6Q17p0kceUalQz_BZvAlZKpVvNliURqc_zP1XGHHDHQgOI4uR1" />
              <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm pt-1">
                <span>Packaging Spec: Export Heavy Wooden Pallet</span>
                <span class="text-secondary font-semibold">ISPM-15 Heat Treated / IP66 Plugs</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- LANDMARK BUILT REFERENCES -->
      <section class="w-full bg-surface-container-low py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-space-lg">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
            <div>
              <span
                class="font-label-sm text-label-sm text-secondary uppercase tracking-widest font-semibold block mb-1">Global
                Project Deployments</span>
              <h2 class="font-headline-lg text-headline-lg text-primary">Landmark Built References</h2>
            </div>
            <a class="font-label-md text-label-md text-secondary uppercase tracking-wider font-semibold flex items-center gap-1 hover:text-primary transition-colors"
              href="#fast-rfq-section">
              View Complete Global Case Studies <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
            <!-- Reference 01 -->
            <div
              class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-md flex flex-col justify-between group">
              <div>
                <img class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                  data-alt="Gleaming modern commercial skyscraper in Riyadh King Abdullah Financial District with thousands of motorized vertical bronze louvers tracking the desert sun against a deep blue sky."
                  src="https://lh3.googleusercontent.com/aida-public/AB6AXuDpCWs7ubNnrKv6CHZ1w8S0KOcEP91EoOS88B_lvK5CdG_Zh4nYw9WZIHqxfnd8mwI0iJTFi2cAJ1YArO8nwa9_GUa3-2Ph1EJYCn_I36DMWji0y9XP5_Zo8yG4cXsT-i774OwR4F1iB7bsmHtiQVdFo1GFo1e8i00S5N_80g3S73bL6XN7TqORZBHif0skLIQtLDPhXhdWYfvo0uAaO0TgrDPwM-wGMg0WBUfiX3Q0iXNOPLBbf0xu" />
                <div class="p-space-md space-y-2">
                  <div
                    class="flex items-center justify-between font-label-sm text-label-sm text-secondary font-semibold">
                    <span>RIYADH, SAUDI ARABIA</span>
                    <span>2024 COMPLETED</span>
                  </div>
                  <h3 class="font-headline-md text-headline-md text-primary">KAFD Financial Center Tower 3</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">14,200 m² dynamic solar facade connected
                    to district BACnet network. Reduced peak cooling loads by 34% in extreme 50°C summer conditions.</p>
                </div>
              </div>
              <div
                class="px-space-md pb-space-md pt-space-xs border-t border-surface-container flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant">
                <span>Model: ALU-MOT-300A</span>
                <span class="font-semibold text-primary">14,200 m²</span>
              </div>
            </div>
            <!-- Reference 02 -->
            <div
              class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-md flex flex-col justify-between group">
              <div>
                <img class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                  data-alt="Lush tropical eco-building in Singapore with high cantilevered aluminum aerofoil sunshade louvers and integrated vertical green facades in bright humid daylight."
                  src="https://lh3.googleusercontent.com/aida-public/AB6AXuA0jhV9zxt_rTYN6Q_N7ik7KGOhqVb2fso_iku6XD98GUXWtjmB3k2ArfKc6jp-pQrcpWqDztBLcvYLE1hjpe3UR84TovUg8Ia-PQcjMgltk9P3WPxtpXISWzvAW2t3LqnRr_4zCC4BeGU5sQgDzo059Q2PLpSIOpO2r7NOmVnzef0d5N9kbO5Otoi3lOGxnnCkW2qnzuhp2frWehmrCjasxfvWcdX3xPUWkSOhbhrPXOQ29nPF_urf" />
                <div class="p-space-md space-y-2">
                  <div
                    class="flex items-center justify-between font-label-sm text-label-sm text-secondary font-semibold">
                    <span>SINGAPORE</span>
                    <span>2023 COMPLETED</span>
                  </div>
                  <h3 class="font-headline-md text-headline-md text-primary">South Beach Eco-Complex</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">9,800 m² horizontal cantilever motorized
                    louvers with automated rainfall retraction sensors and salt-mist resistant PVDF coating.</p>
                </div>
              </div>
              <div
                class="px-space-md pb-space-md pt-space-xs border-t border-surface-container flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant">
                <span>Model: ALU-MOT-450M</span>
                <span class="font-semibold text-primary">9,800 m²</span>
              </div>
            </div>
            <!-- Reference 03 -->
            <div
              class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-md flex flex-col justify-between group">
              <div>
                <img class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                  data-alt="Futuristic glass research university building in Zurich Switzerland featuring dynamic white and silver aerofoil louver panels reflecting alpine sunlight."
                  src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFneZb9GYxBf6S7gpIGmiWwze6Eb0gNp_12pp1tE_E61jFbvStS0FDQWq1OlY9OH8PclIX1_jAjzv7KNFW0VoM6-fxmTJhG-uhivQLqbK0hao35waZxytP0k-QG_B0o3qOHVcEtmjTlpwKGMhmZfC3W0Cl5VntgFhcOY9Xxrk5fuujv41-rg8i4TqOMX7zfSzs4kw33AGixG1acO4T2SgbdnCw5yJhMcVgN4tzLyInD0XW4DsgwnXM" />
                <div class="p-space-md space-y-2">
                  <div
                    class="flex items-center justify-between font-label-sm text-label-sm text-secondary font-semibold">
                    <span>ZURICH, SWITZERLAND</span>
                    <span>2024 COMPLETED</span>
                  </div>
                  <h3 class="font-headline-md text-headline-md text-primary">Zurich Green Tech Campus</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">7,500 m² sun-tracking ribbon envelope
                    with KNX bus integration, achieving Minergie-P eco certification with 32% annual HVAC power savings.
                  </p>
                </div>
              </div>
              <div
                class="px-space-md pb-space-md pt-space-xs border-t border-surface-container flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant">
                <span>Model: ALU-MOT-200A</span>
                <span class="font-semibold text-primary">7,500 m²</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- FAST TENDER RFQ DESK & SAMPLES DISPATCH -->
      <section class="w-full bg-surface py-space-xl" id="fast-rfq-section">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <div
            class="bg-surface-container-lowest rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 lg:grid-cols-12">
            <!-- Left Side: Tender Desk Intro (5 Cols) -->
            <div
              class="lg:col-span-5 bg-primary-container text-on-primary p-space-lg flex flex-col justify-between space-y-space-lg">
              <div class="space-y-space-md">
                <div>
                  <span
                    class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-widest font-semibold block mb-2">Direct
                    Factory Tender Desk</span>
                  <h2 class="font-headline-lg text-headline-lg text-white">Engineering RFQ &amp; Specimen Kit Dispatch
                  </h2>
                </div>
                <p class="font-body-md text-body-md text-slate-300">
                  Submit your architectural schedule, facade elevations, or BIM Revit models. Our engineering
                  consultation desk returns structural wind-load verifications, motor load calculations, and CIF project
                  pricing within 24 hours.
                </p>
                <div class="space-y-3 pt-space-sm border-t border-white/10">
                  <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary-fixed text-xl">timer</span>
                    <span class="font-label-sm text-label-sm text-slate-200">Guaranteed 24-Hour International
                      Engineering Turnaround</span>
                  </div>
                  <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary-fixed text-xl">package_2</span>
                    <span class="font-label-sm text-label-sm text-slate-200">Complimentary DHL Air Freight Specimen Kit
                      with Actuator Mockup</span>
                  </div>
                  <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary-fixed text-xl">verified_user</span>
                    <span class="font-label-sm text-label-sm text-slate-200">Full ASTM / EN Compliance Test Reports
                      Included</span>
                  </div>
                </div>
              </div>
              <div
                class="p-space-sm bg-white/5 rounded-lg border-l-4 border-secondary font-label-sm text-label-sm text-slate-300">
                For emergency facade inquiries or large tenders exceeding 10,000 m², email direct to: <strong
                  class="text-secondary-fixed block mt-1">export@alumax-facade.com</strong>
              </div>
            </div>
            <!-- Right Side: Fast RFQ Form (7 Cols) -->
            <div class="lg:col-span-7 p-space-lg bg-surface-container-lowest">
              <form class="space-y-space-md"
                onsubmit="event.preventDefault(); alert('Tender Request Logged. An ALUMAX Facade Engineer will review your parameters within 24 hours.');">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                  <div>
                    <label class="block font-label-sm text-label-sm text-primary uppercase font-semibold mb-1">
                      Project Name <span class="text-secondary">*</span>
                    </label>
                    <input
                      class="w-full bg-surface-container rounded-lg p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-high transition-colors"
                      placeholder="e.g. Marina Financial Tower Phase 2" required="" type="text" />
                  </div>
                  <div>
                    <label class="block font-label-sm text-label-sm text-primary uppercase font-semibold mb-1">
                      Destination Port (CIF) <span class="text-secondary">*</span>
                    </label>
                    <input
                      class="w-full bg-surface-container rounded-lg p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-high transition-colors"
                      placeholder="e.g. Jebel Ali, Rotterdam, Singapore" required="" type="text" />
                  </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md">
                  <div>
                    <label class="block font-label-sm text-label-sm text-primary uppercase font-semibold mb-1">
                      Estimated Area (m²) <span class="text-secondary">*</span>
                    </label>
                    <input
                      class="w-full bg-surface-container rounded-lg p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-high transition-colors"
                      placeholder="e.g. 4,500" required="" type="number" />
                  </div>
                  <div>
                    <label class="block font-label-sm text-label-sm text-primary uppercase font-semibold mb-1">
                      Blade Width
                    </label>
                    <select
                      class="w-full bg-surface-container rounded-lg p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-high transition-colors">
                      <option>200mm (ALU-MOT-200A)</option>
                      <option selected="">300mm (ALU-MOT-300A)</option>
                      <option>450mm (ALU-MOT-450M)</option>
                      <option>600mm (ALU-MOT-600X)</option>
                      <option>Custom Profile Span</option>
                    </select>
                  </div>
                  <div>
                    <label class="block font-label-sm text-label-sm text-primary uppercase font-semibold mb-1">
                      BMS Protocol
                    </label>
                    <select
                      class="w-full bg-surface-container rounded-lg p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-high transition-colors">
                      <option>BACnet IP / MSTP</option>
                      <option>KNX Bus Protocol</option>
                      <option>Modbus RTU</option>
                      <option>Standalone Weather Station</option>
                      <option>Dry Contact Relays</option>
                    </select>
                  </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                  <div>
                    <label class="block font-label-sm text-label-sm text-primary uppercase font-semibold mb-1">
                      Professional Email <span class="text-secondary">*</span>
                    </label>
                    <input
                      class="w-full bg-surface-container rounded-lg p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-high transition-colors"
                      placeholder="architect@firm.com" required="" type="email" />
                  </div>
                  <div>
                    <label class="block font-label-sm text-label-sm text-primary uppercase font-semibold mb-1">
                      Contact Phone / WhatsApp
                    </label>
                    <input
                      class="w-full bg-surface-container rounded-lg p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-high transition-colors"
                      placeholder="+971 50 000 0000" type="text" />
                  </div>
                </div>
                <div>
                  <label class="block font-label-sm text-label-sm text-primary uppercase font-semibold mb-1">
                    Engineering Scope &amp; Special Wind-Load Requirements
                  </label>
                  <textarea
                    class="w-full bg-surface-container rounded-lg p-3 font-body-sm text-body-sm text-primary focus:outline-none focus:bg-surface-container-high transition-colors"
                    placeholder="Provide design wind pressures, bracket attachment substrate (concrete slab / unitized transom), and desired surface finish..."
                    rows="3"></textarea>
                </div>
                <div class="p-space-sm bg-surface-container rounded-lg flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-on-surface-variant">upload_file</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Attach CAD / BIM Drawings (Max
                      50MB, ZIP, DWG, RVT)</span>
                  </div>
                  <button
                    class="px-3 py-1 bg-surface-container-high text-primary rounded font-label-sm text-label-sm font-semibold hover:bg-surface-variant transition-colors"
                    type="button">Browse</button>
                </div>
                <button
                  class="w-full py-4 bg-primary hover:bg-secondary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider font-semibold transition-all shadow-md flex items-center justify-center gap-2"
                  type="submit">
                  <span class="material-symbols-outlined text-lg">send</span>
                  Submit Engineering Inquiry &amp; Request Sample Box
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- CLIENT-SIDE MICRO-INTERACTIONS SCRIPT -->
      <script>
        document.addEventListener('DOMContentLoaded', () => {
          const angleSlider = document.getElementById('louver-angle-slider');
          const angleReadout = document.getElementById('blade-angle-readout');
          const bladeGroup = document.getElementById('dynamic-blade-group');
          const effMetric = document.getElementById('eff-metric');
          const luxMetric = document.getElementById('lux-metric');

          if (angleSlider && bladeGroup) {
            angleSlider.addEventListener('input', (e) => {
              const val = parseInt(e.target.value, 10);
              angleReadout.textContent = val + '°';
              bladeGroup.setAttribute('transform', `rotate(${val}, 250, 140)`);

              // Calculate dynamic live metrics based on rotation angle
              const efficiency = Math.round(20 + (val / 105) * 78);
              effMetric.textContent = efficiency + '%';

              const luxCutoff = Math.round(12000 + (val / 105) * 58000);
              luxMetric.textContent = luxCutoff.toLocaleString() + ' lx';
            });
          }
        });
      </script>
    </div>
  </main>
  <!-- SCRIPT FOR HERO SLIDE SWITCHER -->
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
