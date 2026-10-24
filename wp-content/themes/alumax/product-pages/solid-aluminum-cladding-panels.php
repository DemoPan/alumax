<?php
if (!defined('ABSPATH')) { exit; }
?>
  <main class="w-full bg-surface">
    <div class="flex flex-col w-full">
      <?php get_template_part('template-parts/product-breadcrumb'); ?>
      <!-- PRODUCT HERO & INTERACTIVE SPECIFICATION CONFIGURATOR -->
      <section class="w-full bg-surface py-space-xl">
        <div
          class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
          <!-- LEFT: Architectural Interactive Media Gallery (7 cols) -->
          <div class="lg:col-span-7 flex flex-col gap-space-md">
            <!-- Main High-Res Canvas Viewport -->
            <div
              class="relative w-full aspect-[4/3] bg-surface-container-high rounded-xl overflow-hidden shadow-md group">
              <div class="w-full h-full bg-cover bg-center transition-all duration-500"
                data-alt="Photorealistic architectural rendering of 3D exploded isometric diagram for solid aluminum rainscreen panel cassette ALU-SLD-3003, showing precision CNC folding flanges, perimeter bracket hooks, structural stiffener ribs welded with studs, insulated thermal cavity, and extruded aluminum vertical mullions in gunmetal grey, industrial studio technical lighting."
                id="main-gallery-view"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCMaebn_zw5fDUqnAtlaZfqZvG-sCB3Fdf2KCyerz0QO_y1b7b4vqgFM8M2edZ4fukyBa_4N7F127hZSyPgGnjklyfMiUU5zgURK0ex9jg1dhafHaQ08I7zVEdMLCr-PKAoYPVCO8rIGgKXsRYAq_tvjo719MYLQNlg5TNBL7Zs8mlRmTWO_dD27bAkCglmKxcITr7MNUji6NJLzMwLbZLiiOKE4nnPOwFRN1qZ18N3h6S1LT0oUROu')">
                <!-- View Mode Watermark -->
                <div
                  class="absolute top-4 left-4 flex items-center gap-2 px-3 py-1.5 rounded-lg bg-primary-container/85 backdrop-blur-md text-on-primary font-label-sm text-label-sm uppercase tracking-wider">
                  <span class="material-symbols-outlined text-sm text-secondary-fixed">layers</span>
                  <span id="gallery-mode-label">Exploded Cassette Assembly</span>
                </div>
                <!-- Interactive 3D BIM Viewer Launch Tag -->
                <button
                  class="absolute bottom-4 right-4 flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface/90 hover:bg-surface text-primary backdrop-blur-md font-label-sm text-label-sm uppercase tracking-wider shadow-lg transition-transform hover:scale-105 font-semibold"
                  type="button">
                  <span class="material-symbols-outlined text-base text-secondary">view_in_ar</span>
                  Launch 3D BIM Viewer (LOD 400)
                </button>
              </div>
            </div>
            <!-- Thumbnail Switcher Array -->
            <div class="grid grid-cols-4 gap-space-sm">
              <button
                class="gallery-thumb-btn active text-left p-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container transition-all"
                data-img-alt="Photorealistic architectural rendering of 3D exploded isometric diagram for solid aluminum rainscreen panel cassette ALU-SLD-3003, showing precision CNC folding flanges, perimeter bracket hooks, structural stiffener ribs welded with studs, insulated thermal cavity, and extruded aluminum vertical mullions in gunmetal grey, industrial studio technical lighting."
                data-title="Exploded Cassette Assembly" type="button">
                <div class="w-full aspect-[16/10] rounded bg-surface-container-highest overflow-hidden mb-1.5">
                  <div class="w-full h-full bg-cover bg-center"
                    data-alt="3D exploded isometric structural diagram of architectural solid aluminum rainscreen cassette panel with stiffeners and clips"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBnHm8JxCmqkipz0n7PXRe53qkUXQZla6KBSlunl7yUFxNhdKiSeGTllMVT8Vg9BsT3dA7Ru24-iqYHD1OuZkv3v49hc9MBecrUvNV6PuXxwwxbRqAbNashv6I4WI3p7xLHiQrZozd_Z8pm8e6Ryyu7cF3WVSVA7FViANj9uMGWTsFxGh5fNKHD-U6JoyHKeSEXC5spq_2K3LCAsGV9-vi2GL2alhKrGUGyG_sk1nFwbtbSpG-79t2Z')">
                  </div>
                </div>
                <span class="font-label-sm text-[11px] block uppercase font-bold text-primary truncate">1. 3D
                  Exploded</span>
              </button>
              <button
                class="gallery-thumb-btn text-left p-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container transition-all"
                data-img-alt="High-resolution telephoto architectural photography of monumental commercial skyscraper facade in Dubai draped with matte champagne-bronze 3.0mm solid aluminum cladding cassettes, razor-sharp shadow reveals, modern glass reflections and structural fins under bright afternoon desert sunlight."
                data-title="Completed Landmark Tower Facade" type="button">
                <div class="w-full aspect-[16/10] rounded bg-surface-container-highest overflow-hidden mb-1.5">
                  <div class="w-full h-full bg-cover bg-center"
                    data-alt="High-rise commercial skyscraper exterior clad in champagne bronze solid aluminum facade cassettes under bright blue sky"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC3qXmRr9rBYqFHlsZCRnIbqrnx0ldQ99QfY3tiUIGwWZ3KRczCYALbEV0ioX2uwbi4Mr6BfrBHlY4X4uJk51oz_h2p5JMHKRTaBWlfz-5Nw_St93m735r7YyEAIEhYoLWHAvoqv9I5b1hZ6hQSuaHQwtNnZ-35wyj26qmIpxw90Rz6T4dIbRSOV6fDRobvKvTdpcugjFM4SgDzpWB4l9ybuQ2Md5HIgJfUd2r_0bXs61d_nFOyVIXD')">
                  </div>
                </div>
                <span class="font-label-sm text-[11px] block uppercase font-bold text-on-surface-variant truncate">2.
                  Built Facade</span>
              </button>
              <button
                class="gallery-thumb-btn text-left p-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container transition-all"
                data-img-alt="Ultra-close macro photograph of architectural solid aluminum panel surface with 3-coat metallic fluoropolymer PVDF coating, showing subtle microscopic mica metallic flakes catching grazing raking light, extreme flatness with zero oil canning, precision chamfered corner edge."
                data-title="Macro Surface Texture (70% PVDF)" type="button">
                <div class="w-full aspect-[16/10] rounded bg-surface-container-highest overflow-hidden mb-1.5">
                  <div class="w-full h-full bg-cover bg-center"
                    data-alt="Macro close-up of metallic fluoropolymer PVDF coated aluminum panel surface showing fine micaceous flake finish and CNC edge"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDRsSxZrAQ-SPkGwK7tpEAmOoKxNWyt3mLg3WQozIVYt09hzzJeDRWt1xnyFIOHBW0pm-EG9LeMgeLhDXl5yxLN4zro9DF8ozgXnwaLA0ilhnWf-4fmeNz9Yx94uoYKI8KS4Ce9CPGWnwKDI4DifeyK62WV803QY85KXCT0db82iltFv27f6mhYNqNumUrQG8qMTqJlwzD_mGUoJYMR4nd4VdKTH6L5b37CrjE7X_T27CmvZHOJq-6O')">
                  </div>
                </div>
                <span class="font-label-sm text-[11px] block uppercase font-bold text-on-surface-variant truncate">3.
                  PVDF Texture</span>
              </button>
              <button
                class="gallery-thumb-btn text-left p-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container transition-all"
                data-img-alt="Technical macro photo of the reverse side of 3.0mm aluminum cladding panel, displaying automated robotic capacitor discharge stud welding with reinforcement stiffener rib and CNC CNC V-groove 90-degree folding corner without micro-fractures, factory inspection testing environment."
                data-title="Corner Bending &amp; Stud Welding Rigidity" type="button">
                <div class="w-full aspect-[16/10] rounded bg-surface-container-highest overflow-hidden mb-1.5">
                  <div class="w-full h-full bg-cover bg-center"
                    data-alt="Factory technical photograph of rear stiffener rib robotic stud weld on 3mm solid aluminum cassette"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAehKXxEpMUSxtLPiEIpzZ2VUYkJXhAyqOuYJwOOQN5Gw1xLrgGq9PD_388mrE3_ijVp-bzr4qaIOtodEu9h0Qu7-Yv-OhpaoEHidja0lqzgFc-eJbe-1M0KVlmLE3X-rpYkin5GzLqdLtRi4tw_btUzOXxk1TO97-wKs2qdHAlfPPmIVGjrFyw8fiRZxyCooebQxpjEAXkJu5m1X0uhSxv5dFYR7jU8rpobR5yi5uVs4OuikE7cR7Z')">
                  </div>
                </div>
                <span class="font-label-sm text-[11px] block uppercase font-bold text-on-surface-variant truncate">4.
                  Stud &amp; Joint Rigidity</span>
              </button>
            </div>
            <!-- Quick Spec Highlights Bar below gallery -->
            <div
              class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm grid grid-cols-2 md:grid-cols-4 gap-space-sm text-center">
              <div class="p-2">
                <div class="font-label-sm text-label-sm text-on-surface-variant uppercase">Max Sheet Span</div>
                <div class="font-headline-sm text-headline-sm text-primary font-bold">2,200×6,000<span
                    class="text-xs font-normal">mm</span></div>
              </div>
              <div class="p-2">
                <div class="font-label-sm text-label-sm text-on-surface-variant uppercase">Standard Alloy</div>
                <div class="font-headline-sm text-headline-sm text-primary font-bold">AA3003-H24</div>
              </div>
              <div class="p-2">
                <div class="font-label-sm text-label-sm text-on-surface-variant uppercase">Fire Resistance</div>
                <div class="font-headline-sm text-headline-sm text-secondary font-bold">A2-s1,d0</div>
              </div>
              <div class="p-2">
                <div class="font-label-sm text-label-sm text-on-surface-variant uppercase">Coating Warranty</div>
                <div class="font-headline-sm text-headline-sm text-primary font-bold">30 Years</div>
              </div>
            </div>
          </div>
          <!-- RIGHT: Engineering Selector & RFQ Engine (5 cols) -->
          <div
            class="lg:col-span-5 flex flex-col gap-space-md bg-surface-container-lowest p-space-lg rounded-xl shadow-sm">
            <!-- Title & Identification -->
            <div class="space-y-1">
              <div class="flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-widest">PRODUCT
                  SPEC SHEET // ARCHITECTURAL GRADE</span>
                <span class="font-label-sm text-label-sm text-on-surface-variant">CODE: ALU-SLD-3003</span>
              </div>
              <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight font-bold">
                Solid Aluminum Cladding Panels
              </h1>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                Architectural brake-formed solid rainscreen cassettes engineered for severe wind pressures,
                non-combustible building codes, and high-prestige curtain wall enclosures.
              </p>
            </div>
            <!-- 1. Alloy Substrate Toggle -->
            <div class="space-y-1.5 pt-2">
              <div class="flex items-center justify-between">
                <label class="font-label-sm text-label-sm uppercase font-semibold text-primary">Substrate Alloy
                  Grade</label>
                <span class="font-label-sm text-xs text-on-surface-variant">ISO 209-1 Standard</span>
              </div>
              <div class="grid grid-cols-2 gap-2">
                <label
                  class="relative flex flex-col p-3 rounded-lg bg-surface-container cursor-pointer transition-all hover:bg-surface-container-high has-[:checked]:bg-primary-container has-[:checked]:text-on-primary">
                  <input checked="" class="sr-only" name="alloy" type="radio" value="3003" />
                  <span class="font-label-md text-label-md font-bold uppercase">AA3003-H24</span>
                  <span class="font-body-sm text-xs opacity-80 mt-0.5">Commercial Standard / High Formability</span>
                </label>
                <label
                  class="relative flex flex-col p-3 rounded-lg bg-surface-container cursor-pointer transition-all hover:bg-surface-container-high has-[:checked]:bg-primary-container has-[:checked]:text-on-primary">
                  <input class="sr-only" name="alloy" type="radio" value="5052" />
                  <span class="font-label-md text-label-md font-bold uppercase">AA5052-H32</span>
                  <span class="font-body-sm text-xs opacity-80 mt-0.5">Marine Grade / Coastal Severe Salt Spray</span>
                </label>
              </div>
            </div>
            <!-- 2. Nominal Caliber / Thickness Selector -->
            <div class="space-y-1.5">
              <div class="flex items-center justify-between">
                <label class="font-label-sm text-label-sm uppercase font-semibold text-primary">Nominal Thickness
                  Caliber</label>
                <span class="font-label-sm text-xs text-secondary font-medium">Standard Architectural Spec: 2.5mm /
                  3.0mm</span>
              </div>
              <div class="grid grid-cols-4 gap-2">
                <label
                  class="flex flex-col items-center justify-center py-2.5 px-2 rounded-lg bg-surface-container cursor-pointer transition-all hover:bg-surface-container-high has-[:checked]:bg-secondary has-[:checked]:text-on-secondary">
                  <input class="sr-only" name="thickness" type="radio" value="2.0" />
                  <span class="font-headline-sm text-headline-sm font-bold">2.0</span>
                  <span class="font-label-sm text-[10px] uppercase font-semibold">Interior / Soffit</span>
                </label>
                <label
                  class="flex flex-col items-center justify-center py-2.5 px-2 rounded-lg bg-surface-container cursor-pointer transition-all hover:bg-surface-container-high has-[:checked]:bg-secondary has-[:checked]:text-on-secondary">
                  <input checked="" class="sr-only" name="thickness" type="radio" value="2.5" />
                  <span class="font-headline-sm text-headline-sm font-bold">2.5</span>
                  <span class="font-label-sm text-[10px] uppercase font-semibold">Standard Facade</span>
                </label>
                <label
                  class="flex flex-col items-center justify-center py-2.5 px-2 rounded-lg bg-surface-container cursor-pointer transition-all hover:bg-surface-container-high has-[:checked]:bg-secondary has-[:checked]:text-on-secondary">
                  <input class="sr-only" name="thickness" type="radio" value="3.0" />
                  <span class="font-headline-sm text-headline-sm font-bold">3.0</span>
                  <span class="font-label-sm text-[10px] uppercase font-semibold">Heavy Wind Load</span>
                </label>
                <label
                  class="flex flex-col items-center justify-center py-2.5 px-2 rounded-lg bg-surface-container cursor-pointer transition-all hover:bg-surface-container-high has-[:checked]:bg-secondary has-[:checked]:text-on-secondary">
                  <input class="sr-only" name="thickness" type="radio" value="4.0" />
                  <span class="font-headline-sm text-headline-sm font-bold">4.0</span>
                  <span class="font-label-sm text-[10px] uppercase font-semibold">Mega Spans</span>
                </label>
              </div>
            </div>
            <!-- 3. Surface Finish & Coating System -->
            <div class="space-y-1.5">
              <label class="font-label-sm text-label-sm uppercase font-semibold text-primary block">Coating
                Technology</label>
              <select
                class="w-full bg-surface-container text-on-surface font-body-md text-body-md py-2.5 px-3 rounded-lg border-0 focus:ring-2 focus:ring-secondary">
                <option>PPG Duranar® 3-Coat PVDF (70% Kynar 500 / AAMA 2605)</option>
                <option>AkzoNobel Interpon® D3000 Hyper-Durable Architectural Powder</option>
                <option>Anodized Architectural Class I (25μm Protective Film)</option>
                <option>Architectural Sublimation Faux Stone &amp; Terrazzo</option>
              </select>
            </div>
            <!-- 4. Architectural Color Swatches -->
            <div class="space-y-2">
              <div class="flex items-center justify-between">
                <label class="font-label-sm text-label-sm uppercase font-semibold text-primary">Pre-Approved Exterior
                  Finishes</label>
                <span class="font-label-sm text-xs font-semibold text-secondary" id="selected-color-name">Champagne
                  Bronze Metallic</span>
              </div>
              <div class="flex items-center gap-3">
                <button
                  class="color-swatch-btn w-9 h-9 rounded-full bg-[#D4AF37] ring-2 ring-offset-2 ring-secondary transition-all transform hover:scale-110"
                  data-name="Champagne Bronze Metallic" title="Champagne Bronze" type="button"></button>
                <button
                  class="color-swatch-btn w-9 h-9 rounded-full bg-[#B8C2CC] ring-1 ring-outline-variant transition-all transform hover:scale-110"
                  data-name="Titanium Silver Metallic (RAL 9006)" title="Titanium Silver" type="button"></button>
                <button
                  class="color-swatch-btn w-9 h-9 rounded-full bg-[#2C3437] ring-1 ring-outline-variant transition-all transform hover:scale-110"
                  data-name="Mica Anthracite Dark Grey" title="Mica Anthracite" type="button"></button>
                <button
                  class="color-swatch-btn w-9 h-9 rounded-full bg-[#5E4834] ring-1 ring-outline-variant transition-all transform hover:scale-110"
                  data-name="Architectural Pure Bronze" title="Pure Bronze" type="button"></button>
                <button
                  class="color-swatch-btn w-9 h-9 rounded-full bg-[#8E9094] ring-1 ring-outline-variant transition-all transform hover:scale-110"
                  data-name="Raw Cast-Concrete Mineral Grey" title="Raw Concrete" type="button"></button>
                <button
                  class="w-9 h-9 rounded-full bg-surface-container flex items-center justify-center text-xs font-label-sm text-primary font-bold hover:bg-surface-container-high transition-colors"
                  title="Custom RAL/NCS Match" type="button">
                  RAL+
                </button>
              </div>
            </div>
            <!-- Call-to-Action Buttons for International Buyers -->
            <div class="pt-2 flex flex-col gap-2">
              <a class="w-full py-3.5 px-4 bg-secondary hover:bg-secondary/90 text-on-secondary rounded-lg font-headline-sm text-label-lg uppercase tracking-wider text-center font-bold shadow-md transition-all"
                href="#engineering-tender-rfq">
                Request Specimen Kit &amp; Project Quote
              </a>
              <div class="grid grid-cols-2 gap-2">
                <button
                  class="flex items-center justify-center gap-1.5 py-2.5 px-3 bg-surface-container hover:bg-surface-container-high text-primary font-label-sm text-label-sm uppercase rounded-lg transition-colors font-semibold"
                  type="button">
                  <span class="material-symbols-outlined text-base">picture_as_pdf</span>
                  <span>TDS PDF (4.2MB)</span>
                </button>
                <button
                  class="flex items-center justify-center gap-1.5 py-2.5 px-3 bg-surface-container hover:bg-surface-container-high text-primary font-label-sm text-label-sm uppercase rounded-lg transition-colors font-semibold"
                  type="button">
                  <span class="material-symbols-outlined text-base">deployed_code</span>
                  <span>BIM &amp; DWG (18MB)</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ENGINEERING PERFORMANCE MATRIX & STRUCTURAL CALCULATIONS -->
      <section class="w-full bg-surface-container-low py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-space-lg">
          <div class="space-y-1">
            <span class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-widest">LABORATORY
              VERIFIED METRICS</span>
            <h2 class="font-headline-lg text-headline-lg text-primary font-bold">
              Engineering Performance &amp; Static Criteria
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-3xl">
              Compliant with international building safety codes for super high-rise envelopes, seismic zones, and
              corrosive marine coastal atmospheres.
            </p>
          </div>
          <!-- Specification Schedule Table -->
          <div class="w-full overflow-x-auto bg-surface-container-lowest rounded-xl shadow-sm">
            <table class="w-full text-left font-body-sm text-body-sm text-on-surface">
              <thead class="bg-primary-container text-on-primary font-label-sm text-label-sm uppercase tracking-wider">
                <tr>
                  <th class="py-3.5 px-4 font-bold">Performance Parameter</th>
                  <th class="py-3.5 px-4 font-bold">Testing Standard</th>
                  <th class="py-3.5 px-4 font-bold">Certified Value (2.5mm)</th>
                  <th class="py-3.5 px-4 font-bold">Certified Value (3.0mm)</th>
                  <th class="py-3.5 px-4 font-bold">Structural Impact</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-surface-container">
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-3.5 px-4 font-semibold text-primary">Wind Load Sustained Pressure</td>
                  <td class="py-3.5 px-4 font-label-sm text-xs">ASTM E330 / EN 12179</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-primary">3.8 kPa (Design Load)</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-secondary">5.2 kPa (Super-Tower Rating)</td>
                  <td class="py-3.5 px-4 text-xs text-on-surface-variant">Zero permanent deformation at 150% safety
                    margin</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-3.5 px-4 font-semibold text-primary">Combustibility &amp; Fire Reaction</td>
                  <td class="py-3.5 px-4 font-label-sm text-xs">EN 13501-1 / ASTM E84</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-primary">Class A2-s1, d0</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-secondary">Class A2-s1, d0 (Flame Spread 0)</td>
                  <td class="py-3.5 px-4 text-xs text-on-surface-variant">Strictly non-combustible; ideal for
                    high-density public towers</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-3.5 px-4 font-semibold text-primary">Tensile Strength (Rm)</td>
                  <td class="py-3.5 px-4 font-label-sm text-xs">ASTM B209M / ISO 6892</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-primary">145 - 180 MPa</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-secondary">160 - 215 MPa</td>
                  <td class="py-3.5 px-4 text-xs text-on-surface-variant">Exceptional rigidity against severe seismic
                    displacement</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-3.5 px-4 font-semibold text-primary">Salt Spray Resistance (Corrosion)</td>
                  <td class="py-3.5 px-4 font-label-sm text-xs">ASTM B117 (4,000 Hours)</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-primary">No blister, Creep &lt; 1mm</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-secondary">No blister, Creep &lt; 0.5mm</td>
                  <td class="py-3.5 px-4 text-xs text-on-surface-variant">Suitable for marine docks, offshore hubs, and
                    coastal airports</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-3.5 px-4 font-semibold text-primary">Color Retention &amp; Chalking</td>
                  <td class="py-3.5 px-4 font-label-sm text-xs">AAMA 2605-20 (10-Yr Florida)</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-primary">ΔE &lt; 5.0 Hunters</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-secondary">ΔE &lt; 3.0 Hunters</td>
                  <td class="py-3.5 px-4 text-xs text-on-surface-variant">Fluoropolymer film preserves luster without
                    chalking for 30 years</td>
                </tr>
                <tr class="hover:bg-surface-container-low transition-colors">
                  <td class="py-3.5 px-4 font-semibold text-primary">Acoustic Transmission Loss</td>
                  <td class="py-3.5 px-4 font-label-sm text-xs">ISO 10140-2 / ASTM E90</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-primary">Rw = 28 dB</td>
                  <td class="py-3.5 px-4 font-label-md font-bold text-secondary">Rw = 32 dB (Up to 48dB w/ core)</td>
                  <td class="py-3.5 px-4 text-xs text-on-surface-variant">Reduces high-frequency exterior urban traffic
                    disturbance</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Live Engineering Calculation Note Cards -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
            <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm space-y-2">
              <div class="flex items-center gap-2 text-secondary">
                <span class="material-symbols-outlined">straighten</span>
                <span class="font-label-md text-label-md uppercase font-bold">Span vs. Stiffener Rule</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                For cassette widths exceeding 800mm or areas &gt; 1.2 m², ALUMAX embeds factory robotic-welded aluminum
                channel stiffeners every 500mm to eliminate optical oil-canning.
              </p>
            </div>
            <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm space-y-2">
              <div class="flex items-center gap-2 text-secondary">
                <span class="material-symbols-outlined">device_thermostat</span>
                <span class="font-label-md text-label-md uppercase font-bold">Thermal Expansion Calc</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                Aluminum linear expansion rate is 2.4 mm/m at ΔT = 100°C. All fixing bracket slots feature 6mm ovalized
                thermal glide tolerances to prevent buckling.
              </p>
            </div>
            <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm space-y-2">
              <div class="flex items-center gap-2 text-secondary">
                <span class="material-symbols-outlined">recycling</span>
                <span class="font-label-md text-label-md uppercase font-bold">LEED v4 Green Credit</span>
              </div>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                Contains up to 45% post-industrial recycled aluminum billet. 100% infinitely recyclable at building
                decommissioning with negligible carbon degradation.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- TYPICAL CURTAIN WALL INSTALLATION DETAIL SYSTEMS -->
      <section class="w-full bg-surface py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-space-lg">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-1">
              <span class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-widest">FACADE
                ENGINEERING TYPOLOGIES</span>
              <h2 class="font-headline-lg text-headline-lg text-primary font-bold">
                Fixing Methods &amp; Substructure Details
              </h2>
            </div>
            <div class="flex items-center gap-2">
              <span class="font-label-sm text-label-sm text-on-surface-variant">CAD Elevation Detail Packages
                Available</span>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
            <!-- System 1: Open-Joint Ventilated Rainscreen -->
            <div
              class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all">
              <div class="w-full aspect-[16/11] bg-surface-container-high overflow-hidden relative">
                <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                  data-alt="Technical architectural section diagram of Open-Joint Ventilated Rainscreen with solid aluminum cladding cassette, concealed aluminum brackets, continuous vertical drainage cavity, rockwool mineral insulation, and high-performance weather barrier membrane."
                  style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCoR34GLzSdo-qYsQRCBw7_pmQgW87GqXjfLoUTKmBQzvcW3ua6is9MCEernEw_rGleFzhBgUMWzRfDKB_iOu1GOdDSLWZk5m16dw0dtIC1ZFPv8PvQYylMs5rLE2X7CD6BkiagMehL43_QFZXZPNGoAZCvSTmVnV1U7R790gPzNh9uxZQDIXDzeJiSpLoKZFAcC4ldbdBAmSifuACrjBD8ppQFI3ah5vrrLUNPwivacQlzBSI4dQy_')">
                </div>
                <span
                  class="absolute top-3 left-3 px-2.5 py-1 bg-primary text-on-primary font-label-sm text-label-sm font-bold uppercase rounded">Type
                  01</span>
              </div>
              <div class="p-space-md flex-1 flex flex-col justify-between space-y-space-sm">
                <div class="space-y-2">
                  <h3 class="font-headline-sm text-headline-sm text-primary font-bold">Open-Joint Ventilated Rainscreen
                  </h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Features 12mm dry open shadow reveals without exposed silicone. Pressure-equalized cavity drains
                    condensate instantly, preventing facade staining and dust streaks.
                  </p>
                </div>
                <div
                  class="space-y-1 pt-2 border-t border-surface-container font-label-sm text-xs text-on-surface-variant">
                  <div><strong class="text-primary">Joint Width:</strong> 10mm - 16mm Open Gap</div>
                  <div><strong class="text-primary">Substructure:</strong> Extruded 6063-T6 Aluminum Mullion</div>
                  <div><strong class="text-primary">Best Suited:</strong> Commercial Towers, Public Museums</div>
                </div>
              </div>
            </div>
            <!-- System 2: Sealed Silicone Joint System -->
            <div
              class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all">
              <div class="w-full aspect-[16/11] bg-surface-container-high overflow-hidden relative">
                <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                  data-alt="Technical cross section blueprint drawing of Sealed Weatherproof Silicone Joint facade cassette system, showing closed-cell PE backer rod, neutral-cure silicone sealant bead, perimeter slotted fixing tabs, and continuous thermal break isolator pads."
                  style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDV7jiiCf7Eyx4nrwNIju5iL3PuuAhGZrcZ9h49JJgoj1tp773Iu1BneHx_9UmcC6mdUTZg0hKz0pKRKTLgVTSYtDvCuvutzRY3YG7lmWcc1EdVmc2U2Lq2eK60us4jsIix28A7H3grOL5he4qBzd9xapBT1gl3xhr0vPMmhazwRhqUNPiqB4Zc70IbgQTb1AgMin_b6Yk1T4tVZt6gm_G72ugfGELggrU2FR_ual6dUVWMjbPqMD0i')">
                </div>
                <span
                  class="absolute top-3 left-3 px-2.5 py-1 bg-primary text-on-primary font-label-sm text-label-sm font-bold uppercase rounded">Type
                  02</span>
              </div>
              <div class="p-space-md flex-1 flex flex-col justify-between space-y-space-sm">
                <div class="space-y-2">
                  <h3 class="font-headline-sm text-headline-sm text-primary font-bold">Weatherproof Sealed Joint</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Classic watertight envelope configuration utilizing non-staining structural silicone over PE backer
                    rod. Offers maximum air-impermeability and acoustic attenuation.
                  </p>
                </div>
                <div
                  class="space-y-1 pt-2 border-t border-surface-container font-label-sm text-xs text-on-surface-variant">
                  <div><strong class="text-primary">Joint Seal:</strong> Dow Corning 791 / Sika Hybrids</div>
                  <div><strong class="text-primary">Substructure:</strong> Galvanized Steel Tube or Aluminum Angles
                  </div>
                  <div><strong class="text-primary">Best Suited:</strong> High-Acoustic Zones, Hospital Facades</div>
                </div>
              </div>
            </div>
            <!-- System 3: Fast-Track Cassette Hook-on -->
            <div
              class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all">
              <div class="w-full aspect-[16/11] bg-surface-container-high overflow-hidden relative">
                <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                  data-alt="CAD 3D perspective diagram of Fast-Track Cassette Hook-on installation system for high-rise buildings, displaying interlocking horizontal hook brackets with anti-rattle nylon isolators, rapid crane installation sequence, and safety locking set screws."
                  style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBzLHMDt2yUvDvMLnCCH9auUKgECDqm52qe3pPt8JBDTMZ4qzlbsNyo3BpdSITPsIroHS3MMRo8C02Yi26UXhOeqOuVxbAq5hY0f98DcNBa099qSOxABde7R3hS5CHWDv7Xpr15MXMWZJKMbOCazI61DmDW1i8C3ow192-pC3ShJpsvW_IvlldzbsOuN1utG23VdmoIMCWvxDPk0PVMuiSAwd7L18yyMQQOYwNG6IaIBoJcqLVJApSR')">
                </div>
                <span
                  class="absolute top-3 left-3 px-2.5 py-1 bg-primary text-on-primary font-label-sm text-label-sm font-bold uppercase rounded">Type
                  03</span>
              </div>
              <div class="p-space-md flex-1 flex flex-col justify-between space-y-space-sm">
                <div class="space-y-2">
                  <h3 class="font-headline-sm text-headline-sm text-primary font-bold">High-Rise Hook-On Cassette</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Modular interlocking hung brackets designed for expedited crane-assisted exterior erection. Each
                    panel is individually demountable for lifetime utility inspection.
                  </p>
                </div>
                <div
                  class="space-y-1 pt-2 border-t border-surface-container font-label-sm text-xs text-on-surface-variant">
                  <div><strong class="text-primary">Installation Rate:</strong> Up to 150m² / team per day</div>
                  <div><strong class="text-primary">Damping:</strong> Neoprene Anti-Rattle Bushings</div>
                  <div><strong class="text-primary">Best Suited:</strong> Supertall Skyscrapers, Tight Urban Sites</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- EXPORT PACKAGING & INDUSTRIAL QUALITY CONTROL -->
      <section class="w-full bg-surface-container-low py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-space-lg">
          <div class="space-y-1">
            <span class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-widest">INTERNATIONAL
              LOGISTICS PROTOCOL</span>
            <h2 class="font-headline-lg text-headline-lg text-primary font-bold">
              Zero-Defect Export Packing &amp; Factory Inspection
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-3xl">
              Engineered for transoceanic container handling. All crates are fabricated to ISPM-15 phytosanitary
              standards with moisture-sealed internal barriers.
            </p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-md">
            <!-- Feature 1 -->
            <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm space-y-3">
              <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl text-secondary">verified_user</span>
              </div>
              <h4 class="font-headline-sm text-headline-sm text-primary font-bold">80μm Laser-Safe Film</h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                UV-resistant protective film applied immediately after coil coating. Prevents transit abrasion and
                strips cleanly without residue after up to 6 months of outdoor exposure.
              </p>
            </div>
            <!-- Feature 2 -->
            <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm space-y-3">
              <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl text-secondary">inventory</span>
              </div>
              <h4 class="font-headline-sm text-headline-sm text-primary font-bold">Fumigation-Free Crating</h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                Plywood crates reinforced with galvanized steel corner angles and foam cushion dividers, compliant with
                strict EU, USA, and Australian border customs directives.
              </p>
            </div>
            <!-- Feature 3 -->
            <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm space-y-3">
              <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl text-secondary">precision_manufacturing</span>
              </div>
              <h4 class="font-headline-sm text-headline-sm text-primary font-bold">5-Axis CNC Precision</h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                Bystronic laser cutting and automated Salvagnini panel benders deliver dimension tolerances within
                ±0.5mm across spans up to 6 meters length.
              </p>
            </div>
            <!-- Feature 4 -->
            <div class="p-space-md bg-surface-container-lowest rounded-xl shadow-sm space-y-3">
              <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-2xl text-secondary">sailing</span>
              </div>
              <h4 class="font-headline-sm text-headline-sm text-primary font-bold">Container Stuffing Plan</h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                Pre-computed 3D load optimization diagrams for 20GP and 40HQ ocean containers prevent in-transit
                shifting and maximize cubic meter freight economics.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- INTERNATIONAL PROJECT CASE STUDIES -->
      <section class="w-full bg-surface py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-space-lg">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-1">
              <span class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-widest">BUILT
                REFERENCES</span>
              <h2 class="font-headline-lg text-headline-lg text-primary font-bold">
                Global Landmark Deliveries
              </h2>
            </div>
            <a class="font-label-sm text-label-sm uppercase font-bold text-secondary hover:text-primary transition-colors flex items-center gap-1"
              href="#fast-rfq-section">
              View Complete Portfolio Archive →
            </a>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
            <!-- Project 1 -->
            <div
              class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all">
              <div class="w-full aspect-[16/10] bg-surface-container-high overflow-hidden relative">
                <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                  data-alt="Architectural photograph of Dubai Financial Center commercial office tower clad in customized champagne gold PVDF solid aluminum cladding panels reflecting desert sky at sunset, sharp angular faceted facade geometry."
                  style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDIdER5BVdBVcy11SFx0tMEvT9WTvVoptNe3coGStpz9GWrx6bPzftJNMhdGwm_UJntK_OvxY7lL7JZYmH3cwPU4yoIqNhvCk6uh61SFuLeT4lqubB8RF2igE4WNqhhrg-nyWBlEr1CWoU8ET8HtIwoUFYe2VBMXI4ZCbTgm1yI5wPDH57OgR3aoKFmpUTSofPnjnoRJLGTIDvM9a-7sd44kdFbE_aEEy_RgENoKTHuzOq5kwjVkeAa')">
                </div>
                <div
                  class="absolute bottom-3 left-3 px-3 py-1 bg-primary-container/90 backdrop-blur text-on-primary font-label-sm text-label-sm rounded">
                  Dubai, UAE // 35,000 m²
                </div>
              </div>
              <div class="p-space-md flex-1 flex flex-col justify-between space-y-space-sm">
                <div class="space-y-1">
                  <h3 class="font-headline-sm text-headline-sm text-primary font-bold">DIFC North Commercial Tower</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    3.0mm AA3003-H24 Cassettes with 3-coat PPG Duranar® Sunstorm Champagne finish. Withstood 4.5 kPa
                    localized cyclic gust tests during extreme regional sandstorms.
                  </p>
                </div>
                <div
                  class="pt-2 border-t border-surface-container flex items-center justify-between text-xs font-label-sm text-on-surface-variant">
                  <span>Completed: 2023</span>
                  <span class="text-secondary font-semibold">TPI Inspection Passed</span>
                </div>
              </div>
            </div>
            <!-- Project 2 -->
            <div
              class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all">
              <div class="w-full aspect-[16/10] bg-surface-container-high overflow-hidden relative">
                <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                  data-alt="Architectural exterior photograph of Singapore Changi Airport Terminal concourse canopy clad with ultra-smooth titanium silver aluminum rainscreen panels, lush tropical landscaping integration, crystal clear daylight reflections."
                  style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBMIwf9wD7p68eLiOTa2kQyuhVrC_WJHQz25Hz9oGePyaWWXnQ4-7lloxTbOXZs5S0Tr8E2op5LzcUDbmCtPbqMGsJOBjMGhbvnMFAU7ECY46aG-dz0IlPxYlSNVjzDsTej_K5XqNgrAweWMOi7Pzz7uYrgsYJTomCsu5IhzBDzSTzI5L29pnXXyho_97IMGGJWoyYMN1t2o0KLxBqfIrumjAL1rrJjn60oHl0npZ5LVRA7BQ8ILhrW')">
                </div>
                <div
                  class="absolute bottom-3 left-3 px-3 py-1 bg-primary-container/90 backdrop-blur text-on-primary font-label-sm text-label-sm rounded">
                  Singapore // 22,000 m²
                </div>
              </div>
              <div class="p-space-md flex-1 flex flex-col justify-between space-y-space-sm">
                <div class="space-y-1">
                  <h3 class="font-headline-sm text-headline-sm text-primary font-bold">Changi Aviation Expansion
                    Concourse</h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    2.5mm AA5052-H32 Marine Grade Panels with AkzoNobel Interpon D3000 fluoropolymer powder. Zero
                    surface degradation in severe tropical humidity and salt air.
                  </p>
                </div>
                <div
                  class="pt-2 border-t border-surface-container flex items-center justify-between text-xs font-label-sm text-on-surface-variant">
                  <span>Completed: 2022</span>
                  <span class="text-secondary font-semibold">BCA Green Mark Platinum</span>
                </div>
              </div>
            </div>
            <!-- Project 3 -->
            <div
              class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all">
              <div class="w-full aspect-[16/10] bg-surface-container-high overflow-hidden relative">
                <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                  data-alt="Modern architectural photography of Frankfurt Innovation Hub featuring dark charcoal grey solid aluminum exterior panels with integrated vertical LED reveals, German winter overcast lighting, high contrast aesthetic."
                  style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDn4sDOlD_hxwZh3ma96sOj4dC5I9wd_GaNtD7hQDO3fNKSRGcU6yzDdttNYJ6zJCVMztC1gS1I0a3IkJwcSxg0DlBvqGcD9kBswwfuRv7B1IprH3uibZSZxFRJts6V5nh9adp-nvp45KgqLgRNyCFQYQTb3-Ern4ZlD5Q_za-aPwQ5v_AXeHlLaAsx-Sg3JoXsgrFWSQX8O3au3egDizFTr-wtM70OE0vb4EEfEO0U_mipdVy-kQxy')">
                </div>
                <div
                  class="absolute bottom-3 left-3 px-3 py-1 bg-primary-container/90 backdrop-blur text-on-primary font-label-sm text-label-sm rounded">
                  Frankfurt, Germany // 18,000 m²
                </div>
              </div>
              <div class="p-space-md flex-1 flex flex-col justify-between space-y-space-sm">
                <div class="space-y-1">
                  <h3 class="font-headline-sm text-headline-sm text-primary font-bold">Frankfurt Eco-Tech Headquarters
                  </h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Class A2-s1,d0 certified 3.0mm cassettes in Mica Anthracite. Custom CNC perforations engineered for
                    acoustic absorption and back-ventilated air renewal.
                  </p>
                </div>
                <div
                  class="pt-2 border-t border-surface-container flex items-center justify-between text-xs font-label-sm text-on-surface-variant">
                  <span>Completed: 2024</span>
                  <span class="text-secondary font-semibold">DGNB Gold Certified</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ENGINEERING TENDER DESK & RFQ INQUIRY SECTION -->
      <section class="w-full bg-primary-container text-on-primary py-space-xl" id="engineering-tender-rfq">
        <div
          class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
          <!-- Left Consultation Callout (5 cols) -->
          <div class="lg:col-span-5 space-y-space-md">
            <span class="font-label-sm text-label-sm text-secondary-fixed font-bold uppercase tracking-widest">GLOBAL
              TENDER DESK</span>
            <h2 class="font-headline-lg text-headline-lg text-on-primary font-bold leading-tight">
              Request Factory-Direct Pricing &amp; Static Calculations
            </h2>
            <p class="font-body-md text-body-md text-on-primary-container">
              Submit your tender bill of quantities (BOQ), architectural elevation drawings, or wind load parameters.
              Our senior facade engineering team produces official CIF/FOB proposals within 24 business hours.
            </p>
            <div class="space-y-3 pt-2">
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-secondary-fixed text-xl">speed</span>
                <div>
                  <div class="font-label-md text-label-md font-bold uppercase text-on-primary">24-Hour Turnaround</div>
                  <div class="font-body-sm text-xs text-on-primary-container">Complete bill of materials pricing and
                    structural feasibility check</div>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-secondary-fixed text-xl">inventory_2</span>
                <div>
                  <div class="font-label-md text-label-md font-bold uppercase text-on-primary">Complimentary Courier Kit
                  </div>
                  <div class="font-body-sm text-xs text-on-primary-container">Air-shipped material binder containing cut
                    swatches and corner mockups</div>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-secondary-fixed text-xl">verified</span>
                <div>
                  <div class="font-label-md text-label-md font-bold uppercase text-on-primary">Third-Party Inspection
                    Support</div>
                  <div class="font-body-sm text-xs text-on-primary-container">SGS, TÜV, and BV factory inspection
                    acceptance before port departure</div>
                </div>
              </div>
            </div>
            <div
              class="p-space-md rounded-xl bg-surface-container-lowest/10 backdrop-blur border border-white/10 space-y-1">
              <div class="font-label-sm text-xs uppercase text-secondary-fixed font-bold">Direct Engineering Hotline
              </div>
              <div class="font-headline-sm text-headline-sm text-on-primary font-bold">+971 4 881 2940 / +86 757 8299
                1040</div>
              <div class="font-label-sm text-xs text-on-primary-container">tender@alumax-facade.com // Mon–Fri
                08:00–20:00 (GMT+4 / GMT+8)</div>
            </div>
          </div>
          <!-- Right Interactive Tender Form (7 cols) -->
          <div class="lg:col-span-7 bg-surface text-on-surface p-space-lg rounded-xl shadow-xl">
            <form class="space-y-space-md" id="rfq-direct-form"
              onsubmit="event.preventDefault(); alert('Inquiry received. An ALUMAX Facade Project Engineer will contact you within 24 hours with static analysis and quotation.');">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                <!-- Project Name -->
                <div class="space-y-1">
                  <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                    Project Name <span class="text-secondary">*</span>
                  </label>
                  <input
                    class="w-full bg-surface-container text-on-surface px-3 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-secondary font-body-md text-body-md"
                    placeholder="e.g. Al Maryah Commercial Tower" required="" type="text" />
                </div>
                <!-- Project Location & Country -->
                <div class="space-y-1">
                  <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                    Destination Port / Country <span class="text-secondary">*</span>
                  </label>
                  <input
                    class="w-full bg-surface-container text-on-surface px-3 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-secondary font-body-md text-body-md"
                    placeholder="e.g. Jebel Ali, Dubai or Rotterdam" required="" type="text" />
                </div>
                <!-- Est Surface Area -->
                <div class="space-y-1">
                  <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                    Estimated Cladding Area (m²) <span class="text-secondary">*</span>
                  </label>
                  <input
                    class="w-full bg-surface-container text-on-surface px-3 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-secondary font-body-md text-body-md"
                    placeholder="e.g. 15,000" required="" type="number" />
                </div>
                <!-- Target Thickness Selection -->
                <div class="space-y-1">
                  <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                    Nominal Caliber <span class="text-secondary">*</span>
                  </label>
                  <select
                    class="w-full bg-surface-container text-on-surface px-3 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-secondary font-body-md text-body-md">
                    <option>2.5mm (Standard High-Rise Rainscreen)</option>
                    <option>3.0mm (Super High-Rise &amp; Heavy Wind Load)</option>
                    <option>2.0mm (Soffit &amp; Canopy Applications)</option>
                    <option>4.0mm (Oversized Bespoke Curved Panels)</option>
                  </select>
                </div>
                <!-- Substrate Alloy Selection -->
                <div class="space-y-1">
                  <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                    Alloy Grade
                  </label>
                  <select
                    class="w-full bg-surface-container text-on-surface px-3 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-secondary font-body-md text-body-md">
                    <option>AA3003-H24 (Standard Commercial)</option>
                    <option>AA5052-H32 (Marine Coastal &amp; Severe Atmosphere)</option>
                    <option>AA1100-H14 (General Industrial)</option>
                  </select>
                </div>
                <!-- Desired Coating Finish -->
                <div class="space-y-1">
                  <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                    Finish System
                  </label>
                  <select
                    class="w-full bg-surface-container text-on-surface px-3 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-secondary font-body-md text-body-md">
                    <option>3-Coat PVDF (70% Kynar 500 / PPG Duranar)</option>
                    <option>AkzoNobel Interpon D3000 Powder</option>
                    <option>Class I Hard Anodized (25 Microns)</option>
                    <option>Special Stone/Wood Architectural Sublimation</option>
                  </select>
                </div>
              </div>
              <!-- Professional Contact Details -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md pt-2">
                <div class="space-y-1">
                  <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                    Contact Person &amp; Title <span class="text-secondary">*</span>
                  </label>
                  <input
                    class="w-full bg-surface-container text-on-surface px-3 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-secondary font-body-md text-body-md"
                    placeholder="e.g. Marcus Vance, Senior Facade Architect" required="" type="text" />
                </div>
                <div class="space-y-1">
                  <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                    Corporate Email Address <span class="text-secondary">*</span>
                  </label>
                  <input
                    class="w-full bg-surface-container text-on-surface px-3 py-2.5 rounded-lg border-0 focus:ring-2 focus:ring-secondary font-body-md text-body-md"
                    placeholder="vance@foster-partners.com" required="" type="email" />
                </div>
              </div>
              <!-- File Upload Zone -->
              <div class="space-y-1 pt-2">
                <label class="block font-label-sm text-label-sm uppercase font-bold text-primary">
                  Attach Elevation CAD / Revit Model / BOQ (Optional)
                </label>
                <div
                  class="p-space-md border-2 border-dashed border-outline-variant rounded-xl flex flex-col items-center justify-center text-center bg-surface-container-low hover:bg-surface-container transition-colors cursor-pointer">
                  <span class="material-symbols-outlined text-3xl text-secondary mb-1">cloud_upload</span>
                  <span class="font-label-sm text-label-sm text-primary font-bold">Drag and drop drawing files here, or
                    browse local disk</span>
                  <span class="font-body-sm text-xs text-on-surface-variant mt-0.5">Supports DWG, DXF, RVT, IFC, PDF,
                    and ZIP up to 50MB</span>
                </div>
              </div>
              <!-- Submit Button -->
              <div class="pt-2">
                <button
                  class="w-full py-4 px-6 bg-secondary hover:bg-secondary/90 text-on-secondary font-headline-sm text-label-lg uppercase tracking-wider rounded-lg font-bold shadow-lg transition-all flex items-center justify-center gap-2"
                  type="submit">
                  <span class="material-symbols-outlined">send</span>
                  <span>Submit Project for Engineering Tender Review</span>
                </button>
                <p class="font-label-sm text-[11px] text-center text-on-surface-variant mt-2">
                  Protected by Non-Disclosure Agreement (NDA). All structural intellectual property remains
                  confidential.
                </p>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- INTERACTIVE GALLERY & SWATCH SWITCHER SCRIPT -->
      <script>
        document.addEventListener('DOMContentLoaded', () => {
          // 1. Gallery Switcher Logic
          const mainView = document.getElementById('main-gallery-view');
          const modeLabel = document.getElementById('gallery-mode-label');
          const thumbBtns = document.querySelectorAll('.gallery-thumb-btn');

          thumbBtns.forEach(btn => {
            btn.addEventListener('click', () => {
              // Remove active state
              thumbBtns.forEach(b => {
                b.classList.remove('active', 'bg-surface-container');
                b.classList.add('bg-surface-container-low');
              });
              // Add active state
              btn.classList.add('active', 'bg-surface-container');
              btn.classList.remove('bg-surface-container-low');

              const newTitle = btn.getAttribute('data-title');
              const newAlt = btn.getAttribute('data-img-alt');

              if (modeLabel && newTitle) {
                modeLabel.textContent = newTitle;
              }
              if (mainView && newAlt) {
                mainView.setAttribute('data-alt', newAlt);
                // Flash transition effect
                mainView.classList.add('opacity-80');
                setTimeout(() => {
                  mainView.classList.remove('opacity-80');
                }, 180);
              }
            });
          });

          // 2. Color Swatch Selector Logic
          const colorBtns = document.querySelectorAll('.color-swatch-btn');
          const selectedColorText = document.getElementById('selected-color-name');

          colorBtns.forEach(cBtn => {
            cBtn.addEventListener('click', () => {
              colorBtns.forEach(b => {
                b.classList.remove('ring-2', 'ring-secondary', 'ring-offset-2');
                b.classList.add('ring-1', 'ring-outline-variant');
              });
              cBtn.classList.add('ring-2', 'ring-secondary', 'ring-offset-2');
              cBtn.classList.remove('ring-1', 'ring-outline-variant');

              const colorName = cBtn.getAttribute('data-name');
              if (selectedColorText && colorName) {
                selectedColorText.textContent = colorName;
              }
            });
          });
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
