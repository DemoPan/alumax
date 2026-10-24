<?php
if (!defined('ABSPATH')) { exit; }
?>
<main class="w-full bg-surface"><div class="flex flex-col w-full">
<?php get_template_part('template-parts/product-breadcrumb'); ?>
<!-- SECTION 2: PRODUCT HERO SHOWCASE & SPECIFICATION CALCULATOR -->
<section class="w-full bg-surface px-margin-mobile md:px-margin py-8 md:py-12">
<div class="max-w-[1440px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- LEFT 7 COLS: INTERACTIVE MEDIA SHOWCASE -->
<div class="lg:col-span-7 flex flex-col gap-5">
<!-- Main Stage Viewport -->
<div class="relative w-full aspect-[16/10] bg-primary-container overflow-hidden shadow-xl group rounded-xl">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="3D technical cross-section render of architectural aluminum honeycomb composite panel ALU-HC-5000 showing hexagonal core foil bonded between AA3003 alloy skins with structural epoxy, champagne bronze brushed metallic sheen, warm side lighting, industrial photorealistic blueprint background." id="main-product-stage" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1MbVdmT_8dmFjH8F0IgVR_SQsEr3SgGwTHW3_6wd-qHzmDadsdlhi0auR4spzoTyeF8knvWDkMkcwvEqtedX_it_W0yhWw4vBlh_aEnNHYlEK_3ZBPNXMwhwSh7eh965n1PThfzPgqAivV1jBWfknonx5GoR2eYGPUwuL3To9N0QvCUO1Q6gI1Te6YaR2tWqWcoPjI0s6UWKK_Q8rfIgSxU7kBhQQV4NjDV--Vm4">
<div class="absolute inset-0 bg-gradient-to-t from-primary-container/80 via-transparent to-transparent pointer-events-none"></div>
<div class="absolute top-4 left-4 flex flex-col gap-2">
<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary-container/90 backdrop-blur-md text-white font-label text-label-sm uppercase tracking-widest">
<span class="w-2 h-2 rounded-full bg-secondary"></span>
              AEROSPACE GRADE CORE ALLOY 3003
            </span>
</div>
<div class="absolute bottom-4 left-4 right-4 flex items-end justify-between pointer-events-none">
<div class="text-white">
<p class="font-label text-label-sm text-secondary-fixed uppercase tracking-wider">ALU-HC-5000 Series</p>
<h2 class="font-headline text-headline-sm md:text-headline-md tracking-tight font-semibold text-white">Hexagonal Honeycomb Composite Panel</h2>
<p class="font-body text-body-sm text-surface-container-high">金属蜂窝板 // Architectural Ultra-Flat Curtain Wall Skin</p>
</div>
<button aria-label="Inspect Spec Detail" class="pointer-events-auto p-2.5 bg-white/10 hover:bg-secondary text-white transition-all shadow-md backdrop-blur-md" id="zoom-toggle">
<span class="material-symbols-outlined text-lg block">zoom_in</span>
</button>
</div>
</div>
<!-- Thumbnail Selector Module -->
<div class="grid grid-cols-4 gap-3"><button aria-label="View Honeycomb Cutaway" class="gallery-thumb active-thumb relative aspect-[4/3] bg-surface-container overflow-hidden rounded-lg p-0.5 transition-all shadow-sm focus:outline-none ring-2 ring-secondary ring-offset-2" onclick="updateGallery(0, '3D technical cross-section render of architectural aluminum honeycomb composite panel ALU-HC-5000 showing hexagonal core foil bonded between AA3003 alloy skins with structural epoxy, champagne bronze brushed metallic sheen.')" type="button">
<img class="w-full h-full object-cover rounded-md" data-alt="Macro close-up cutaway view of hexagonal aluminum honeycomb core foil cell structure with precise adhesive fillets, metallic silver and bronze industrial lighting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBo2BF3icxVlMbshDHifitpMxjCOlzGR6w8j7hMyVtPDbonJxHSFizPHZ0ad32OFyZkzVsaxXCN0UZ2b00C5hbTsmUjciyV3hYVlC416hH4Ge7i6aidRd2me1bkK7tTpwtD_fpYUyZdK-AAPszLM7XwK-6Fbtu1Sy0HirdghTdymVpIfICRjt3TB1HBa-Cs5kHUA6M31hfgBXvIrQ3GB04ItZESMHUqswMDCgrF0AU">
<span class="absolute bottom-1 left-1 right-1 font-label text-[9px] uppercase tracking-wider bg-primary/80 text-white px-1 py-0.5 text-center truncate rounded-sm">Core Cutaway</span>
</button>
<button aria-label="View Airport Installation" class="gallery-thumb relative aspect-[4/3] bg-surface-container overflow-hidden rounded-lg p-0.5 transition-all shadow-sm focus:outline-none" onclick="updateGallery(1, 'Expansive modern international airport facade clad in large champagne bronze aluminum honeycomb panels, crisp shadow reveals, pristine mirror-flat reflections of sky under bright daylight.')" type="button">
<img class="w-full h-full object-cover rounded-md" data-alt="Expansive exterior photograph of modern commercial high-rise envelope featuring huge 2000x5000mm ultra-flat aluminum honeycomb cladding panels in metallic champagne finish." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOqtNmRyl2NnQHAaSJgmkGPdNNGIVgS7ulbNI8_0PeWSvM7c8OccuY738USzPsOsVOfwzswQcdWBV_4KmSIoP-hhKp97W9o3Vs9zpBvTsGUWTCfaanc5Qo6MKF3r776LErUl9Dbsfx3IL6LKnYc5ul7xJ2res_3PU-qhgWhWXuSOLsqVhY2ZSAB9LTggfw4IEuoW2CJ3lJa0Nvfat1KgBz11fVZ-heomHFFIp6zWk">
<span class="absolute bottom-1 left-1 right-1 font-label text-[9px] uppercase tracking-wider bg-primary/80 text-white px-1 py-0.5 text-center truncate rounded-sm">Building Facade</span>
</button>
<button aria-label="View PVDF Coating Specimen" class="gallery-thumb relative aspect-[4/3] bg-surface-container overflow-hidden rounded-lg p-0.5 transition-all shadow-sm focus:outline-none" onclick="updateGallery(2, 'Extreme close up of architectural aluminum panel surface showing PPG Duranar 3-coat fluoropolymer PVDF champagne bronze metallic finish with micaceous sparkle under studio illumination.')" type="button">
<img class="w-full h-full object-cover rounded-md" data-alt="Extreme macro sample of champagne bronze architectural fluorocarbon PVDF coating on aluminum honeycomb substrate showcasing uniform metallic pearlescent grain." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNSeJfWO7rFwWACLKRAi-InedVOcLFGjfWMyrCcCovvNU_OmSSEtx1Beas8F9aUZk4t0AtDeCKKQqKK2JXKpfEhdFEQgBc4SePxCCfSGA4kvici-TmSdWczybxM2ea0uOkJh5RnyR9Xeuyk7OOF-94gcRIafa-mNotzjTCS0UP9oKL3GpI5D7EnlcF5_YfyHaESOcPYcP__uz06fLc4dcPZp0-7SUZ3vLi3j_IB58">
<span class="absolute bottom-1 left-1 right-1 font-label text-[9px] uppercase tracking-wider bg-primary/80 text-white px-1 py-0.5 text-center truncate rounded-sm">PVDF Champagne</span>
</button>
<button aria-label="View Substructure Hook-on" class="gallery-thumb relative aspect-[4/3] bg-surface-container overflow-hidden rounded-lg p-0.5 transition-all shadow-sm focus:outline-none" onclick="updateGallery(3, 'CAD technical section render of concealed aluminum hook-on bracket extrusion and EPDM sealing gasket assembly secured behind honeycomb cassette panel for high-rise unitized facade.')" type="button">
<img class="w-full h-full object-cover rounded-md" data-alt="Engineering 3D visualization of concealed structural hook-on extruded aluminum clip engaged into vertical facade mullion, showing gasket assembly and panel edge return." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDTnLBY_Dj7dy7VZcrjZXf95_Z4RfXe6VmkJsSiiUpjESmZtaOO2G6htHEDwtxfh5kwUDkwaKDtKYvAduGvUl6-m8JNaOQGOKQs2Vatqmw1oodBOMNWEfZwCUO_E8LhOowAmDTEtjYhgnkhCgihm-KZHyJEtdaZd0xWyhOiOkA1VIOXNfNC-OukY6cHXRH4IW4dAXTkl65XeziObz56UMuLwIRxNOHKg9NACo8Zotg">
<span class="absolute bottom-1 left-1 right-1 font-label text-[9px] uppercase tracking-wider bg-primary/80 text-white px-1 py-0.5 text-center truncate rounded-sm">Hook-on Joint</span>
</button></div>
<!-- Quick Engineering Specification Strip -->
<div class="rounded-xl bg-[#0d1b2a] text-white p-4 shadow-xl border border-white/10 mt-2">
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-white/10 gap-3 md:gap-0">
<div class="px-3 py-1 flex flex-col justify-between">
<span class="font-label text-label-sm text-slate-400 uppercase">Max Dimension</span>
<span class="font-headline text-headline-sm font-semibold text-white mt-1">2,200×6,000</span>
<span class="font-label text-[10px] text-secondary-fixed">mm Mega-Format</span>
</div>
<div class="px-3 py-1 flex flex-col justify-between pt-2 md:pt-1">
<span class="font-label text-label-sm text-slate-400 uppercase">Hex Cell Size</span>
<span class="font-headline text-headline-sm font-semibold text-white mt-1">1/4" &amp; 3/8"</span>
<span class="font-label text-[10px] text-slate-400">6.35mm / 9.5mm</span>
</div>
<div class="px-3 py-1 flex flex-col justify-between pt-2 md:pt-1">
<span class="font-label text-label-sm text-slate-400 uppercase">Fire Reaction</span>
<span class="font-headline text-headline-sm font-semibold text-secondary-fixed mt-1">Class A2</span>
<span class="font-label text-[10px] text-slate-400">EN 13501-1 s1, d0</span>
</div>
<div class="px-3 py-1 flex flex-col justify-between pt-2 md:pt-1">
<span class="font-label text-label-sm text-slate-400 uppercase">Planar Flatness</span>
<span class="font-headline text-headline-sm font-semibold text-white mt-1">&lt; 0.5 mm</span>
<span class="font-label text-[10px] text-slate-400">Zero Oil-Canning/m</span>
</div>
<div class="px-3 py-1 flex flex-col justify-between pt-2 md:pt-1 col-span-2 sm:col-span-1">
<span class="font-label text-label-sm text-slate-400 uppercase">Coating Life</span>
<span class="font-headline text-headline-sm font-semibold text-white mt-1">30 Years</span>
<span class="font-label text-[10px] text-slate-400">PPG Duranar PVDF</span>
</div>
</div>
</div>
</div>
<!-- RIGHT 5 COLS: INTERACTIVE SPECIFICATION MATRIX & RFQ CALLOUT -->
<div class="lg:col-span-5 bg-surface-container-lowest p-6 md:p-8 shadow-xl flex flex-col gap-6 rounded-xl border border-surface-container-high"><div>
<div class="flex items-center justify-between mb-1">
<span class="font-label text-label-sm text-secondary uppercase font-semibold tracking-wider">Engineering Configurator</span>
<span class="font-label text-label-sm text-outline uppercase">BIM LOD-400 Model</span>
</div>
<h1 class="font-headline text-headline-lg font-bold text-primary tracking-tight">ALU-HC-5000</h1>
<p class="font-body text-body-sm text-on-surface-variant mt-1">
Continuous roll-bonded sandwich composite engineered for extreme wind pressure, high-rise building envelopes, and monolithic visual flatness.
</p>
</div>
<div class="space-y-2">
<div class="flex justify-between items-baseline">
<label class="font-label text-label-sm uppercase font-semibold text-primary">1. Facing Aluminum Alloy Grade</label>
<span class="font-label text-label-sm text-secondary" id="selected-alloy-label">AA3003-H24 (Standard)</span>
</div>
<div class="grid grid-cols-2 gap-2.5">
<button class="config-btn active-choice px-3 py-2.5 text-left font-label text-label-sm bg-[#0d1b2a] text-white border-2 border-secondary rounded-lg transition-all flex flex-col shadow-sm" onclick="selectConfig('alloy', 'AA3003-H24', this)" type="button">
<span class="font-semibold text-white">AA3003-H24</span>
<span class="text-[10px] text-secondary-fixed">High Tensile Architectural</span>
</button>
<button class="config-btn px-3 py-2.5 text-left font-label text-label-sm bg-surface-container-low hover:bg-surface-container-high text-primary border border-outline-variant/60 rounded-lg transition-all flex flex-col" onclick="selectConfig('alloy', 'AA5052-H32', this)" type="button">
<span class="font-semibold">AA5052-H32</span>
<span class="text-[10px] text-outline">Marine / Coastal Anti-Corrosion</span>
</button>
</div>
</div>
<div class="space-y-2">
<div class="flex justify-between items-baseline">
<label class="font-label text-label-sm uppercase font-semibold text-primary">2. Composite Total Thickness</label>
<span class="font-label text-label-sm text-secondary" id="selected-thick-label">20 mm (High-Rise Standard)</span>
</div>
<div class="grid grid-cols-5 gap-2">
<button class="thick-btn px-2 py-2.5 text-center font-label text-label-sm bg-surface-container-low hover:bg-surface-container-high text-primary border border-outline-variant/60 rounded-lg transition-all" onclick="selectConfig('thick', '10mm', this)" type="button">10mm</button>
<button class="thick-btn px-2 py-2.5 text-center font-label text-label-sm bg-surface-container-low hover:bg-surface-container-high text-primary border border-outline-variant/60 rounded-lg transition-all" onclick="selectConfig('thick', '15mm', this)" type="button">15mm</button>
<button class="thick-btn active-choice px-2 py-2.5 text-center font-label text-label-sm bg-[#0d1b2a] text-white border-2 border-secondary rounded-lg transition-all shadow-sm font-semibold" onclick="selectConfig('thick', '20mm', this)" type="button">20mm</button>
<button class="thick-btn px-2 py-2.5 text-center font-label text-label-sm bg-surface-container-low hover:bg-surface-container-high text-primary border border-outline-variant/60 rounded-lg transition-all" onclick="selectConfig('thick', '25mm', this)" type="button">25mm</button>
<button class="thick-btn px-2 py-2.5 text-center font-label text-label-sm bg-surface-container-low hover:bg-surface-container-high text-primary border border-outline-variant/60 rounded-lg transition-all" onclick="selectConfig('thick', '50mm', this)" type="button">50mm</button>
</div>
</div>
<div class="space-y-2">
<div class="flex justify-between items-baseline">
<label class="font-label text-label-sm uppercase font-semibold text-primary">3. Honeycomb Core Foil &amp; Bonding</label>
<span class="font-label text-label-sm text-secondary">0.06mm Foil // Epoxy Hot-Melt</span>
</div>
<div class="grid grid-cols-2 gap-2.5">
<div class="p-2.5 bg-surface-container-low border border-outline-variant/50 rounded-lg flex items-center justify-between">
<span class="font-label text-label-sm text-on-surface">Foil Thickness:</span>
<span class="font-label text-label-sm font-semibold text-primary">0.05 - 0.08 mm</span>
</div>
<div class="p-2.5 bg-surface-container-low border border-outline-variant/50 rounded-lg flex items-center justify-between">
<span class="font-label text-label-sm text-on-surface">Bonding Tech:</span>
<span class="font-label text-label-sm font-semibold text-primary">DuPont Polyurethane</span>
</div>
</div>
</div>
<div class="space-y-2">
<div class="flex justify-between items-baseline">
<label class="font-label text-label-sm uppercase font-semibold text-primary">4. Architectural Finish Palette</label>
<span class="font-label text-label-sm text-secondary" id="selected-finish-label">Champagne Bronze Metallic</span>
</div>
<div class="flex items-center gap-2.5">
<button aria-label="Champagne Bronze" class="color-chip w-9 h-9 rounded-lg bg-[#B88E56] shadow-sm relative focus:outline-none ring-2 ring-secondary ring-offset-2 transition-all" onclick="selectColor('Champagne Bronze Metallic', this)" type="button"></button>
<button aria-label="Anthracite Grey" class="color-chip w-9 h-9 rounded-lg bg-[#2E3440] shadow-sm relative focus:outline-none border border-outline-variant/50 transition-all" onclick="selectColor('Architectural Anthracite (RAL 7016)', this)" type="button"></button>
<button aria-label="Pure White" class="color-chip w-9 h-9 rounded-lg bg-[#E5E9F0] shadow-sm relative focus:outline-none border border-outline-variant/50 transition-all" onclick="selectColor('Pure Signal White (RAL 9003)', this)" type="button"></button>
<button aria-label="Anodized Silver" class="color-chip w-9 h-9 rounded-lg bg-[#A0AEC0] shadow-sm relative focus:outline-none border border-outline-variant/50 transition-all" onclick="selectColor('Natural Anodized Silver Matt', this)" type="button"></button>
<button aria-label="Custom RAL Palette" class="color-chip w-9 h-9 rounded-lg bg-primary flex items-center justify-center text-white text-[10px] font-label font-bold focus:outline-none border border-outline-variant/50 transition-all" onclick="selectColor('Custom RAL / NCS Architect Formulation', this)" type="button">RAL+</button>
</div>
</div>
<div class="p-4 bg-surface-container-low border border-outline-variant/50 rounded-lg space-y-2">
<div class="flex justify-between items-center text-label text-label-sm">
<span class="text-outline uppercase">Weight per Area:</span>
<span class="font-semibold text-primary" id="calc-weight">6.85 kg / m²</span>
</div>
<div class="flex justify-between items-center text-label text-label-sm">
<span class="text-outline uppercase">Section Modulus (W):</span>
<span class="font-semibold text-primary" id="calc-modulus">19.2 cm³ / m</span>
</div>
<div class="flex justify-between items-center text-label text-label-sm">
<span class="text-outline uppercase">Tensile Strength:</span>
<span class="font-semibold text-secondary">&gt; 2.2 MPa (ASTM C297)</span>
</div>
</div>
<div class="flex flex-col gap-3 pt-2">
<a class="w-full py-4 bg-secondary hover:bg-secondary/90 text-on-secondary font-headline text-headline-sm uppercase tracking-wider text-center font-semibold rounded-lg shadow-lg transition-all flex items-center justify-center gap-2" href="#fast-rfq-section">
<span class="material-symbols-outlined text-xl">inventory_2</span>
<span class="">REQUEST SPECIMEN KIT &amp; PROJECT QUOTE</span>
</a>
<div class="grid grid-cols-2 gap-2.5">
<button class="py-3 px-4 bg-primary text-white hover:bg-secondary font-label text-label-sm uppercase tracking-wider rounded-lg transition-colors flex items-center justify-center gap-2 shadow-sm" onclick="triggerDownload('TDS-ALU-HC-5000-EN.pdf')" type="button">
<span class="material-symbols-outlined text-base">download</span>
<span class="">TDS SPEC (PDF)</span>
</button>
<button class="py-3 px-4 bg-surface-container-high hover:bg-surface-container-highest text-primary font-label text-label-sm uppercase tracking-wider rounded-lg transition-colors flex items-center justify-center gap-2 border border-outline-variant/40 shadow-sm" onclick="triggerDownload('BIM-ALUMAX-HC5000-REVIT-DWG.zip')" type="button">
<span class="material-symbols-outlined text-base">folder_zip</span>
<span class="">BIM &amp; CAD</span>
</button>
</div>
</div></div>
</div>
</section>
<!-- SECTION 3: ENGINEERING PERFORMANCE & RIGOROUS TESTING MATRIX -->
<section class="w-full bg-surface-container-low px-margin-mobile md:px-margin py-16">
<div class="max-w-[1440px] mx-auto space-y-10">
<!-- Section Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<div class="flex items-center gap-2 text-secondary font-label text-label-sm uppercase font-semibold">
<span class="w-2 h-2 bg-secondary"></span>
<span class="">TESTED PER ASTM &amp; BS EN SPECIFICATIONS</span>
</div>
<h2 class="font-headline text-headline-lg font-bold text-primary mt-1">Structural &amp; Physical Performance Data</h2>
<p class="font-body text-body-md text-on-surface-variant max-w-2xl mt-1">
            Certified by TÜV Rheinland, SGS, and Intertek testing institutes. Validated for high-amplitude wind turbulence, typhoon zones, and stringent commercial facade codes.
          </p>
</div>
<div class="flex items-center gap-2">
<span class="px-3 py-1.5 bg-surface-container-highest font-label text-label-sm text-primary uppercase">
            QA Batch: ISO 9001:2015
          </span>
<span class="px-3 py-1.5 bg-secondary-container text-on-secondary-container font-label text-label-sm uppercase font-semibold">
            TÜV Pass Report #8921-EU
          </span>
</div>
</div>
<!-- High Density Spec Table -->
<div class="w-full overflow-x-auto shadow-sm bg-surface-container-lowest">
<table class="w-full text-left font-body text-body-sm text-on-surface border-collapse">
<thead>
<tr class="bg-primary text-white font-label text-label-sm uppercase tracking-wider">
<th class="py-3.5 px-4 font-semibold">Test Parameter / 性能参数</th>
<th class="py-3.5 px-4 font-semibold">International Standard</th>
<th class="py-3.5 px-4 font-semibold">ALUMAX Tested Metric</th>
<th class="py-3.5 px-4 font-semibold">Standard Cladding Contrast</th>
<th class="py-3.5 px-4 font-semibold">Compliance Status</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container">
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-3 px-4 font-semibold text-primary">Flatness Deviation / 表面平整度</td>
<td class="py-3 px-4 font-label text-label-sm text-outline">EN 485-4 / ASTM B209</td>
<td class="py-3 px-4 font-label text-label-sm text-secondary font-bold">&lt; 0.5 mm / m (Planar Zero Oil-Canning)</td>
<td class="py-3 px-4 text-on-surface-variant">&gt; 2.5 mm / m (Solid 3mm Plate)</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 bg-primary/10 text-primary font-label text-xs uppercase font-semibold">OPTIMAL A+</span></td>
</tr>
<tr class="bg-surface-container-low/50 hover:bg-surface-container-low transition-colors">
<td class="py-3 px-4 font-semibold text-primary">Tensile Flatwise Bond Strength / 剥离粘结强度</td>
<td class="py-3 px-4 font-label text-label-sm text-outline">ASTM C297 / ASTM D1781</td>
<td class="py-3 px-4 font-label text-label-sm text-primary font-bold">&gt; 2.25 MPa (Core Failure Mode Only)</td>
<td class="py-3 px-4 text-on-surface-variant">0.80 MPa Standard ACP</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 bg-primary/10 text-primary font-label text-xs uppercase font-semibold">PASS EXCEED</span></td>
</tr>
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-3 px-4 font-semibold text-primary">Wind Pressure Design Load / 抗风压承载力</td>
<td class="py-3 px-4 font-label text-label-sm text-outline">ASTM E330 / BS EN 12179</td>
<td class="py-3 px-4 font-label text-label-sm text-secondary font-bold">Up to +6.5 kPa / -6.5 kPa Gust Load</td>
<td class="py-3 px-4 text-on-surface-variant">2.8 kPa Requires Mid-Stiffeners</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 bg-primary/10 text-primary font-label text-xs uppercase font-semibold">TYPHOON CLASS</span></td>
</tr>
<tr class="bg-surface-container-low/50 hover:bg-surface-container-low transition-colors">
<td class="py-3 px-4 font-semibold text-primary">Fire Classification Reaction / 防火等级</td>
<td class="py-3 px-4 font-label text-label-sm text-outline">EN 13501-1 / ASTM E84 / NFPA 285</td>
<td class="py-3 px-4 font-label text-label-sm text-primary font-bold">Class A2-s1, d0 (Non-Combustible Core)</td>
<td class="py-3 px-4 text-on-surface-variant">Class B / PE Core Combustible</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 bg-secondary/15 text-secondary font-label text-xs uppercase font-semibold">GLOBAL PASS</span></td>
</tr>
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-3 px-4 font-semibold text-primary">Salt Spray Fog Resistance / 耐盐雾腐蚀</td>
<td class="py-3 px-4 font-label text-label-sm text-outline">ASTM B117 / AAMA 2605-13</td>
<td class="py-3 px-4 font-label text-label-sm text-primary font-bold">4,000 Hours (Rating 10 Zero Blistering)</td>
<td class="py-3 px-4 text-on-surface-variant">1,500 Hours Standard Powder</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 bg-primary/10 text-primary font-label text-xs uppercase font-semibold">COASTAL GRADE</span></td>
</tr>
<tr class="bg-surface-container-low/50 hover:bg-surface-container-low transition-colors">
<td class="py-3 px-4 font-semibold text-primary">Acoustic Sound Transmission / 隔声降噪</td>
<td class="py-3 px-4 font-label text-label-sm text-outline">ASTM E90 / ISO 717-1</td>
<td class="py-3 px-4 font-label text-label-sm text-primary font-bold">Rw = 33 dB (Sound Damping Resonance)</td>
<td class="py-3 px-4 text-on-surface-variant">Rw = 24 dB (Hollow Sheet Vibration)</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 bg-primary/10 text-primary font-label text-xs uppercase font-semibold">CERTIFIED</span></td>
</tr>
<tr class="hover:bg-surface-container-low transition-colors">
<td class="py-3 px-4 font-semibold text-primary">Thermal Linear Expansion / 热膨胀系数</td>
<td class="py-3 px-4 font-label text-label-sm text-outline">ASTM E228</td>
<td class="py-3 px-4 font-label text-label-sm text-primary font-bold">2.4 × 10⁻⁵ / °C (Synchronized Face &amp; Back)</td>
<td class="py-3 px-4 text-on-surface-variant">High differential warping risk</td>
<td class="py-3 px-4"><span class="px-2 py-0.5 bg-primary/10 text-primary font-label text-xs uppercase font-semibold">STABLE</span></td>
</tr>
</tbody>
</table>
</div>
<!-- Engineering Graphic Metric Highlights -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
<!-- Metric Chart 1: Rigidity-to-Weight Ratio -->
<div class="p-6 bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between">
<span class="font-label text-label-sm text-outline uppercase">Rigidity vs Weight</span>
<span class="material-symbols-outlined text-secondary">balance</span>
</div>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-2">Flexural Rigidity (EI)</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-1">
              Honeycomb sandwich achieves 500% higher flexural stiffness than 3.0mm solid plate at 40% reduced structural dead load.
            </p>
</div>
<div class="mt-6 space-y-3 font-label text-label-sm">
<div>
<div class="flex justify-between mb-1">
<span class="text-on-surface">ALU-HC-5000 (20mm)</span>
<span class="font-bold text-secondary">EI: 450 N·m²</span>
</div>
<div class="w-full bg-surface-container h-2.5">
<div class="bg-secondary h-2.5 w-[94%]"></div>
</div>
</div>
<div>
<div class="flex justify-between mb-1">
<span class="text-outline">Solid Aluminum (3.0mm)</span>
<span class="text-outline">EI: 82 N·m²</span>
</div>
<div class="w-full bg-surface-container h-2.5">
<div class="bg-outline h-2.5 w-[22%]"></div>
</div>
</div>
</div>
</div>
<!-- Metric Chart 2: Fire Curve / EN13501 -->
<div class="p-6 bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between">
<span class="font-label text-label-sm text-outline uppercase">Fire Curve Compliance</span>
<span class="material-symbols-outlined text-secondary">local_fire_department</span>
</div>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-2">Calorific Energy Limit</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-1">
              Total PCS gross heat of combustion tested strictly below &lt; 3.0 MJ/kg limit, guaranteeing non-propagating facade envelope.
            </p>
</div>
<!-- Inline SVG Flame Curve Graph -->
<div class="mt-6">
<svg class="w-full h-20 text-secondary" fill="none" viewBox="0 0 300 80">
<path d="M0 70 Q 50 65, 100 40 T 200 20 T 300 15" stroke="currentColor" stroke-width="2.5"></path>
<path d="M0 70 L300 70" stroke="#c4c6cc" stroke-dasharray="4" stroke-width="1"></path>
<circle cx="100" cy="40" fill="currentColor" r="4"></circle>
<circle cx="200" cy="20" fill="currentColor" r="4"></circle>
<circle cx="300" cy="15" fill="currentColor" r="4"></circle>
<text fill="#74777d" font-family="JetBrains Mono" font-size="9" x="5" y="78">0°C</text>
<text fill="#74777d" font-family="JetBrains Mono" font-size="9" x="140" y="78">450°C</text>
<text fill="#74777d" font-family="JetBrains Mono" font-size="9" x="250" y="78">750°C A2</text>
</svg>
<div class="flex justify-between font-label text-[10px] text-outline mt-1">
<span class="">Time / Temperature Curve</span>
<span class="text-secondary font-bold">Zero Toxic Smoke Drop (d0)</span>
</div>
</div>
</div>
<!-- Metric Chart 3: Wind-Tunnel Dynamic Simulation -->
<div class="p-6 bg-surface-container-lowest shadow-sm flex flex-col justify-between">
<div>
<div class="flex items-center justify-between">
<span class="font-label text-label-sm text-outline uppercase">Dynamic Turbulence</span>
<span class="material-symbols-outlined text-secondary">air</span>
</div>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-2">Wind Tunnel Tested</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-1">
              Simulated under coastal hurricane suction vortex pressures with zero corner peel or rivet hole fatigue over 100,000 cyclic pulses.
            </p>
</div>
<div class="mt-6 p-3 bg-surface-container flex items-center justify-between font-label text-label-sm">
<div>
<span class="block text-outline text-[10px] uppercase">Peak Suction Pressure</span>
<span class="font-headline text-headline-sm font-bold text-primary">6,500 Pa</span>
</div>
<span class="material-symbols-outlined text-3xl text-secondary">verified_user</span>
</div>
</div>
</div>
</div>
</section>
<!-- SECTION 4: SUBSTRUCTURE & ARCHITECTURAL FIXING TYPOLOGIES -->
<section class="w-full bg-surface px-margin-mobile md:px-margin py-16">
<div class="max-w-[1440px] mx-auto space-y-12">
<div>
<span class="font-label text-label-sm text-secondary uppercase font-semibold tracking-wider">Engineering Substructure Integration</span>
<h2 class="font-headline text-headline-lg font-bold text-primary mt-1">Three Structural Fixing Typologies</h2>
<p class="font-body text-body-md text-on-surface-variant max-w-3xl mt-2">
          Engineered for rapid site installation, thermal movement compensation, and complete moisture management. Choose the structural bracket typology best suited for your facade envelope requirement.
        </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Typology 01 -->
<div class="bg-surface-container-lowest shadow-md flex flex-col">
<div class="w-full aspect-[16/10] bg-surface-container overflow-hidden rounded-xl">
<img class="w-full h-full object-cover" data-alt="Technical architectural diagram showing Type 01 concealed hook-on hanging cassette extruded aluminum brackets with anti-vibration rubber damper pads secured to vertical curtain wall mullion." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmr-lVzqPy_oyivFsGWdyicQpeKgvgsbvLZxiDasRqTVQhDRO73hztcz0pr1pI4MnJDuDL-VG1_saFjiZot28s6FQxzz36QFpMSwEKzosLyVn0XczcNT21zII7l8Q2HnGheTdFkvvPzZMH2kCbKjU58eAG-Oaqosf4flMyBirGu2gGw0KJiXUeOXp3sLgjRrdvUkaN4fCuJM4sPXxTd3UN0WrTz_5OuhzfIO4eQiE">
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between">
<span class="font-label text-label-sm text-secondary font-bold">TYPE 01 // 挂接式</span>
<span class="px-2 py-0.5 bg-surface-container text-outline font-label text-[10px]">HIGH-RISE FAVORITE</span>
</div>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-2">Concealed Hook-On Hanging Cassette</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-2">
                Panels are CNC-routed into modular trays with factory-riveted aluminum hanging hooks. Engages seamlessly onto extruded vertical runner mullions with zero visible fasteners.
              </p>
</div>
<ul class="font-label text-label-sm text-outline space-y-1.5 pt-2">
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">Fast single-panel demountability</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">Joint reveal width: 12mm – 20mm</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">Accommodates seismic drift up to 1:50</span>
</li>
</ul>
</div>
</div>
<!-- Typology 02 -->
<div class="bg-surface-container-lowest shadow-md flex flex-col">
<div class="w-full aspect-[16/10] bg-surface-container overflow-hidden rounded-xl">
<img class="w-full h-full object-cover" data-alt="Detailed section drawing of Type 02 open-joint pressure-equalized rainscreen system using continuous EPDM extruded gasket baffle and ventilated drainage cavity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTob3sYkWNu-5wetrm6wvimQK1uQzSGSyRDrNV7Y2-XGhKHl4JZGkN83xB6fDsxE--a_FQSKydiu83tPYGvEuYKF5G6RgLjJiLM24d2EI3yNXL5g2pYaPuXdT330vTdV5kvkODuAs1-ZB2M6Gtl16GfVhFgzSlLNxLH1w6FaCk5fEPLPNv5tNXJEpqd-kJQKlyT6Kzf_CEnkuhcapkO2JZGcdY3q7QA6FVBVCRKNY">
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between">
<span class="font-label text-label-sm text-secondary font-bold">TYPE 02 // 开缝雨幕</span>
<span class="px-2 py-0.5 bg-surface-container text-outline font-label text-[10px]">MAINTENANCE-FREE</span>
</div>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-2">Open-Joint Rainscreen Baffle</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-2">
                Pressure-equalized back-ventilated cavity with internal EPDM silicone baffle profiles. Eliminates cosmetic silicone joint staining on facade panels for decades.
              </p>
</div>
<ul class="font-label text-label-sm text-outline space-y-1.5 pt-2">
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">Eliminates silicone streaking / bleed</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">Continuous rear ventilation cavity &gt; 50mm</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">Optimal thermal bridging decoupling</span>
</li>
</ul>
</div>
</div>
<!-- Typology 03 -->
<div class="bg-surface-container-lowest shadow-md flex flex-col">
<div class="w-full aspect-[16/10] bg-surface-container overflow-hidden rounded-xl">
<img class="w-full h-full object-cover" data-alt="Engineering cross-section detail of Type 03 interlocking male-female tongue and groove architectural aluminum honeycomb cladding system with concealed mechanical anchor screws." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAGN6wcNhLZb0OZGAo_p6X9yATJnCEtaTopHPcPNOqF3IT2bW5CGIv4rN0RWnDH1TbwqDGLWbs6ILrKqGXTqHhceYl0BMeUchAjnHbEb4mHxgAtiNoX_YSjoV3kWhrrkmB9ypfNzZ6Oh_kX_GKTyEiKbQqWc-PVBjkiQS9-IjaP24GIZMQXJoZyAZvIJ0ToiTU0LgMaw7JbT23xBcT_TfFSJOAosQ_hsNynsm_gTw">
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-4">
<div>
<div class="flex items-center justify-between">
<span class="font-label text-label-sm text-secondary font-bold">TYPE 03 // 企口插接式</span>
<span class="px-2 py-0.5 bg-surface-container text-outline font-label text-[10px]">ULTRA-FAST SPEED</span>
</div>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-2">Tongue &amp; Groove Interlocking</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-2">
                Continuous extruded male-female perimeter profiles bonded during panel manufacturing. Panels interlock directly on site, dramatically shortening crane installation cycles.
              </p>
</div>
<ul class="font-label text-label-sm text-outline space-y-1.5 pt-2">
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">Self-aligning precision joint line</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">Minimal framing sub-structure required</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
<span class="">High acoustic insulation performance</span>
</li>
</ul>
</div>
</div>
</div>
</div>
</section>
<!-- SECTION 5: EXPORT LOGISTICS, PACKING & FACTORY AUTOMATION -->
<section class="w-full bg-primary-container text-white px-margin-mobile md:px-margin py-16">
<div class="max-w-[1440px] mx-auto space-y-12">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div>
<span class="font-label text-label-sm text-secondary-fixed uppercase font-semibold">GLOBAL SEA-FREIGHT &amp; CNC FABRICATION</span>
<h2 class="font-headline text-headline-lg font-bold text-white mt-1">Export Packaging &amp; Mill Quality Control</h2>
<p class="font-body text-body-md text-surface-container-high max-w-2xl mt-1">
            Every shipment arrives uncompromised. Engineered packaging tailored for heavy containerized ocean freight, with zero moisture intrusion and edge collision protection.
          </p>
</div>
<div class="flex items-center gap-4">
<div class="text-right font-label text-label-sm">
<span class="block text-secondary-fixed font-bold">100% EXPORT COMPLIANT</span>
<span class="text-surface-container-high">ISPM-15 Fumigated Timber</span>
</div>
<span class="material-symbols-outlined text-4xl text-secondary-fixed">inventory</span>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="p-6 bg-white/5 backdrop-blur-sm space-y-3">
<div class="w-10 h-10 bg-secondary flex items-center justify-center text-white font-bold font-label">01</div>
<h3 class="font-headline text-headline-sm font-semibold text-white">80μm Protective Film</h3>
<p class="font-body text-body-sm text-surface-container-high">
            Self-adhesive UV-resistant peelable polyethylene film guarantees surface zero-scratch through shipping, uncrating, and contractor erection.
          </p>
</div>
<div class="p-6 bg-white/5 backdrop-blur-sm space-y-3">
<div class="w-10 h-10 bg-secondary flex items-center justify-center text-white font-bold font-label">02</div>
<h3 class="font-headline text-headline-sm font-semibold text-white">5-Axis CNC Edge Milling</h3>
<p class="font-body text-body-sm text-surface-container-high">
            German Homag router lines precision-groove core borders with 0.1mm tolerance, executing seamless 90° mitered returns without alloy micro-cracks.
          </p>
</div>
<div class="p-6 bg-white/5 backdrop-blur-sm space-y-3">
<div class="w-10 h-10 bg-secondary flex items-center justify-center text-white font-bold font-label">03</div>
<h3 class="font-headline text-headline-sm font-semibold text-white">Steel-Strapped Crates</h3>
<p class="font-body text-body-sm text-surface-container-high">
            Encased in heavy 18mm solid fumigated marine plywood cases, cushioned with polyethylene foam blocks and waterproof desiccant packs.
          </p>
</div>
<div class="p-6 bg-white/5 backdrop-blur-sm space-y-3">
<div class="w-10 h-10 bg-secondary flex items-center justify-center text-white font-bold font-label">04</div>
<h3 class="font-headline text-headline-sm font-semibold text-white">Container Loading Plan</h3>
<p class="font-body text-body-sm text-surface-container-high">
            Custom 3D loading simulations for 20ft / 40ft HQ containers maximize payload volume while isolating bundles against transit turbulence.
          </p>
</div>
</div>
</div>
</section>
<!-- SECTION 6: GLOBAL LANDMARK REFERENCE PROJECTS -->
<section class="w-full bg-surface px-margin-mobile md:px-margin py-16" id="landmark-projects">
<div class="max-w-[1440px] mx-auto space-y-12">
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<span class="font-label text-label-sm text-secondary uppercase font-semibold">PROJECT CREDENTIALS</span>
<h2 class="font-headline text-headline-lg font-bold text-primary mt-1">Built With ALU-HC-5000 Worldwide</h2>
<p class="font-body text-body-md text-on-surface-variant max-w-2xl mt-1">
            Proven endurance across ultra-humid maritime coastlines, high-wind financial towers, and iconic international transit hubs.
          </p>
</div>
<a class="font-label text-label-sm uppercase text-secondary hover:text-primary font-bold flex items-center gap-1" href="#fast-rfq-section">
<span class="">Request Case Study Dossier</span>
<span class="material-symbols-outlined text-base">arrow_forward</span>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Case 1 -->
<div class="bg-surface-container-lowest shadow-md overflow-hidden flex flex-col group">
<div class="relative aspect-[16/11] overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Modern architectural photography of Singapore Changi Airport Terminal envelope clad in massive curved metallic champagne aluminum honeycomb facade panels during golden hour." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAyBVaiQ0Zuf469JZiFH3-OsYxLHuUBshdKd5GUdIE7vKbf7GaP7QdysOviiJPLQyBEQ6-S19VGtCBxRamkoq87hNWfiWD9GN3BZphTmCPPUSc3Rg4-my8ubba_cDbh5FPzlzvbh8VcH7By66dQkFjoAzs2ZcJ7-6DtltDTgz_vWVkbPgAEU4B0_4LtytLcgUWt8IyydxWEgf5Bc5llitWBZbmb9aLEtGqbGM2tig">
<div class="absolute top-3 left-3 bg-primary/90 text-white font-label text-[11px] uppercase px-2.5 py-1">
              Singapore
            </div>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-3">
<div>
<span class="font-label text-label-sm text-secondary">Aviation Infrastructure</span>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-1">Changi International Hub Expansion</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-2">
                48,000 m² of 25mm bespoke curved aluminum honeycomb panels finished with 3-coat PPG Duranar Sunstorm mica PVDF.
              </p>
</div>
<div class="pt-3 font-label text-label-sm text-outline flex justify-between items-center bg-surface-container-low p-2">
<span class="">Façade Scope: 48,000 m²</span>
<span class="font-semibold text-primary">Tested: 5.8 kPa</span>
</div>
</div>
</div>
<!-- Case 2 -->
<div class="bg-surface-container-lowest shadow-md overflow-hidden flex flex-col group">
<div class="relative aspect-[16/11] overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="DIFC Dubai Financial District corporate skyscraper exterior showcasing ultra-flat anthracite gray aluminum honeycomb cassette panels in bright desert midday sun." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0KJjt5oWiTr761ol1a9O_YOdyx6N9cvWPpFtpsRckqFqG1Rf0tDciN0dTJvXOi5VhVTWFrNKtgWyWOkAZpIPWYiNBGjyB5xTM0cLD61r8hhSi6Rff0wL5plUU0KDZOqI_y0R6jomlVwgrnpCY6gHMje0EQv758Gcwe9keW5JBaQrxtZmk6nffq69em5e4a3mxRvDW-iNvFs3mUOALhfsUPRel1LJz0ENcYawAuT0">
<div class="absolute top-3 left-3 bg-primary/90 text-white font-label text-[11px] uppercase px-2.5 py-1">
              Dubai, UAE
            </div>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-3">
<div>
<span class="font-label text-label-sm text-secondary">Commercial Tower</span>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-1">DIFC Prime Tower &amp; Podium</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-2">
                32,000 m² of 20mm panels engineered for extreme ambient temperatures up to 55°C and intense sand abrasion resistance.
              </p>
</div>
<div class="pt-3 font-label text-label-sm text-outline flex justify-between items-center bg-surface-container-low p-2">
<span class="">Façade Scope: 32,000 m²</span>
<span class="font-semibold text-primary">Tested: 50 Year Life</span>
</div>
</div>
</div>
<!-- Case 3 -->
<div class="bg-surface-container-lowest shadow-md overflow-hidden flex flex-col group">
<div class="relative aspect-[16/11] overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" data-alt="Frankfurt modern commercial tower featuring precise monolithic silver anodized aluminum honeycomb cladding with sharp shadow reveals under dramatic European sky." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNXKmsHVFoeNxRUimPs6CHDtq1F-jpgg3XJzf6aGVdxZyKoaGvDWNRzd2MzyGaBmbKZofh3f9xuTydI4WHGJpXKTrSuDPhyXXdPoAmjj3vVkdXECifUVHYvwv-WODUtprjPsIN0OBeBs4k6VON87xX4EE5bZX9LIvncsikQ8cz9xA-lAwLSsryCi-uwSgsjzdsKsygUPJJMPznnGuJ52yAMFoDM1C0eh3SxO8VfY8">
<div class="absolute top-3 left-3 bg-primary/90 text-white font-label text-[11px] uppercase px-2.5 py-1">
              Frankfurt, Germany
            </div>
</div>
<div class="p-6 flex-1 flex flex-col justify-between space-y-3">
<div>
<span class="font-label text-label-sm text-secondary">European Headquarters</span>
<h3 class="font-headline text-headline-sm font-semibold text-primary mt-1">Taunus Sky Corporate Portal</h3>
<p class="font-body text-body-sm text-on-surface-variant mt-2">
                19,500 m² of natural anodized 20mm honeycomb panels complying strictly with German DIN 4102 and EN 13501-1 fire safety norms.
              </p>
</div>
<div class="pt-3 font-label text-label-sm text-outline flex justify-between items-center bg-surface-container-low p-2">
<span class="">Façade Scope: 19,500 m²</span>
<span class="font-semibold text-primary">DIN 4102 Pass</span>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- SECTION 7: FAST RFQ & ENGINEERING TENDER SUBMITTAL SECTION -->
<section class="w-full bg-surface-container-low px-margin-mobile md:px-margin py-16" id="fast-rfq-section">
<div class="max-w-[1440px] mx-auto">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 bg-surface-container-lowest p-8 md:p-12 shadow-xl">
<!-- Left 5 cols: Technical Submittal Instructions -->
<div class="lg:col-span-5 flex flex-col justify-between space-y-8">
<div>
<div class="flex items-center gap-2 text-secondary font-label text-label-sm uppercase font-semibold">
<span class="material-symbols-outlined text-base">verified</span>
<span class="">DIRECT FACTORY TECHNICAL DESK</span>
</div>
<h2 class="font-headline text-headline-lg font-bold text-primary mt-2">
              Request Project Tender Calculation &amp; Sample Kit
            </h2>
<p class="font-body text-body-md text-on-surface-variant mt-3">
              Submit your architectural schedule, elevations, or bill-of-quantities (BOQ). Our facade engineering group responds with static wind-load calculations, optimization yields, and factory-direct pricing within 24 business hours.
            </p>
<div class="mt-8 space-y-4">
<div class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-xl mt-0.5">mark_email_read</span>
<div>
<h4 class="font-headline text-headline-sm text-primary font-semibold">Free Global Express Sample Box</h4>
<p class="font-body text-body-sm text-outline">Includes 20mm cutaway honeycomb samples, PVDF fan deck swatches, and test report certificates via DHL Express.</p>
</div>
</div>
<div class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary text-xl mt-0.5">architecture</span>
<div>
<h4 class="font-headline text-headline-sm text-primary font-semibold">BIM / Shop Drawing Review</h4>
<p class="font-body text-body-sm text-outline">Assistance in joint detailing, wind load verification, and extrusion die customization.</p>
</div>
</div>
</div>
</div>
<!-- Direct Contacts -->
<div class="p-4 bg-surface-container flex items-center justify-between font-label text-label-sm">
<div>
<span class="text-outline uppercase text-[10px] block">Emergency Facade RFQ Line</span>
<span class="font-bold text-primary">+86 757 8832 9900</span>
</div>
<span class="text-secondary font-bold">export@alumax-facade.com</span>
</div>
</div>
<!-- Right 7 cols: Interactive Engineering RFQ Form -->
<div class="lg:col-span-7">
<form class="space-y-5" id="engineering-rfq-form" onsubmit="handleRfqSubmit(event)">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div>
<label class="block font-label text-label-sm uppercase text-primary mb-1" for="rfq-name">
                  Full Name / Contact Person *
                </label>
<input class="w-full h-11 px-3 bg-surface-container-low text-primary font-body text-body-sm focus:bg-white focus:outline-none transition-colors" id="rfq-name" placeholder="e.g., Marcus Vance" required="" type="text">
</div>
<div>
<label class="block font-label text-label-sm uppercase text-primary mb-1" for="rfq-email">
                  Corporate Email *
                </label>
<input class="w-full h-11 px-3 bg-surface-container-low text-primary font-body text-body-sm focus:bg-white focus:outline-none transition-colors" id="rfq-email" placeholder="name@architecture-firm.com" required="" type="email">
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div>
<label class="block font-label text-label-sm uppercase text-primary mb-1" for="rfq-company">
                  Company / Organization *
                </label>
<input class="w-full h-11 px-3 bg-surface-container-low text-primary font-body text-body-sm focus:bg-white focus:outline-none transition-colors" id="rfq-company" placeholder="e.g., Foster Façade Engineering Ltd" required="" type="text">
</div>
<div>
<label class="block font-label text-label-sm uppercase text-primary mb-1" for="rfq-country">
                  Destination Country &amp; Port *
                </label>
<input class="w-full h-11 px-3 bg-surface-container-low text-primary font-body text-body-sm focus:bg-white focus:outline-none transition-colors" id="rfq-country" placeholder="e.g., Jebel Ali, UAE / Rotterdam, NL" required="" type="text">
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
<div>
<label class="block font-label text-label-sm uppercase text-primary mb-1" for="rfq-area">
                  Estimated Area (m²)
                </label>
<input class="w-full h-11 px-3 bg-surface-container-low text-primary font-body text-body-sm focus:bg-white focus:outline-none transition-colors" id="rfq-area" placeholder="e.g., 8,500" type="number">
</div>
<div>
<label class="block font-label text-label-sm uppercase text-primary mb-1" for="rfq-thickness">
                  Specified Thickness
                </label>
<select class="w-full h-11 px-3 bg-surface-container-low text-primary font-body text-body-sm focus:bg-white focus:outline-none transition-colors" id="rfq-thickness">
<option value="15mm">15 mm Honeycomb</option>
<option selected="" value="20mm">20 mm Honeycomb (Standard)</option>
<option value="25mm">25 mm Honeycomb</option>
<option value="50mm">50 mm Mega-Span</option>
<option value="Custom">Custom Core Architecture</option>
</select>
</div>
<div>
<label class="block font-label text-label-sm uppercase text-primary mb-1" for="rfq-wind">
                  Design Wind Load (kPa)
                </label>
<select class="w-full h-11 px-3 bg-surface-container-low text-primary font-body text-body-sm focus:bg-white focus:outline-none transition-colors" id="rfq-wind">
<option value="Standard">Standard (&lt; 2.5 kPa)</option>
<option selected="" value="Heavy">High-Rise (3.5 - 5.0 kPa)</option>
<option value="Typhoon">Extreme Hurricane (&gt; 5.5 kPa)</option>
</select>
</div>
</div>
<!-- Drag and Drop CAD File Uploader -->
<div class="space-y-1">
<label class="block font-label text-label-sm uppercase text-primary">
                Upload Architectural Drawings / BOQ / CAD (.DWG, .PDF, .RVT)
              </label>
<div class="w-full p-6 bg-surface-container-low hover:bg-surface-container text-center cursor-pointer transition-colors flex flex-col items-center justify-center gap-2" id="drop-zone" onclick="document.getElementById('rfq-file').click()">
<span class="material-symbols-outlined text-3xl text-secondary">cloud_upload</span>
<span class="font-label text-label-sm text-primary font-semibold">Click to select files or drag &amp; drop here</span>
<span class="font-body text-body-sm text-outline">Supported: DWG, DXF, RVT, PDF, STEP, ZIP (Up to 50MB)</span>
<input class="hidden" id="rfq-file" multiple="" onchange="handleFileSelect(this)" type="file">
<span class="hidden font-label text-label-sm text-secondary font-bold pt-1" id="file-name-indicator"></span>
</div>
</div>
<!-- Sample Box Checkbox -->
<div class="flex items-start gap-3 pt-1">
<input checked="" class="mt-1 w-4 h-4 text-secondary focus:ring-0 rounded-none bg-surface-container" id="rfq-sample-box" type="checkbox">
<label class="font-body text-body-sm text-on-surface select-none" for="rfq-sample-box">
<span class="font-semibold text-primary">Dispatch Physical Specimen Kit to my address.</span> Include AA3003-H24 cutaway honeycomb prototype, 3-coat champagne PVDF swatch card, and full ASTM/EN static calculation catalog.
              </label>
</div>
<button class="w-full py-4 bg-primary hover:bg-secondary text-white font-headline text-headline-sm uppercase tracking-wider font-semibold shadow-lg transition-all flex items-center justify-center gap-2" type="submit">
<span class="material-symbols-outlined text-xl">send</span>
<span class="">Transmit Engineering Tender Package</span>
</button>
<p class="font-label text-[11px] text-outline text-center uppercase tracking-wider">
              Guaranteed NDA Protection // Non-Disclosure Agreement Executed on Request
            </p>
</form>
<!-- Toast Notification for Form Transmission -->
<div class="hidden mt-4 p-4 bg-primary text-white font-label text-label-sm flex items-center justify-between" id="rfq-toast"><button aria-label="View Honeycomb Cutaway" class="gallery-thumb active-thumb relative aspect-[4/3] bg-surface-container overflow-hidden rounded-lg p-0.5 transition-all shadow-sm focus:outline-none ring-2 ring-secondary ring-offset-2" onclick="updateGallery(0, '3D technical cross-section render of architectural aluminum honeycomb composite panel ALU-HC-5000 showing hexagonal core foil bonded between AA3003 alloy skins with structural epoxy, champagne bronze brushed metallic sheen.')" type="button">
<img class="w-full h-full object-cover rounded-md" data-alt="Macro close-up cutaway view of hexagonal aluminum honeycomb core foil cell structure with precise adhesive fillets, metallic silver and bronze industrial lighting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBo2BF3icxVlMbshDHifitpMxjCOlzGR6w8j7hMyVtPDbonJxHSFizPHZ0ad32OFyZkzVsaxXCN0UZ2b00C5hbTsmUjciyV3hYVlC416hH4Ge7i6aidRd2me1bkK7tTpwtD_fpYUyZdK-AAPszLM7XwK-6Fbtu1Sy0HirdghTdymVpIfICRjt3TB1HBa-Cs5kHUA6M31hfgBXvIrQ3GB04ItZESMHUqswMDCgrF0AU">
<span class="absolute bottom-1 left-1 right-1 font-label text-[9px] uppercase tracking-wider bg-primary/80 text-white px-1 py-0.5 text-center truncate rounded-sm">Core Cutaway</span>
</button>
<button aria-label="View Airport Installation" class="gallery-thumb relative aspect-[4/3] bg-surface-container overflow-hidden rounded-lg p-0.5 transition-all shadow-sm focus:outline-none" onclick="updateGallery(1, 'Expansive modern international airport facade clad in large champagne bronze aluminum honeycomb panels, crisp shadow reveals, pristine mirror-flat reflections of sky under bright daylight.')" type="button">
<img class="w-full h-full object-cover rounded-md" data-alt="Expansive exterior photograph of modern commercial high-rise envelope featuring huge 2000x5000mm ultra-flat aluminum honeycomb cladding panels in metallic champagne finish." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOqtNmRyl2NnQHAaSJgmkGPdNNGIVgS7ulbNI8_0PeWSvM7c8OccuY738USzPsOsVOfwzswQcdWBV_4KmSIoP-hhKp97W9o3Vs9zpBvTsGUWTCfaanc5Qo6MKF3r776LErUl9Dbsfx3IL6LKnYc5ul7xJ2res_3PU-qhgWhWXuSOLsqVhY2ZSAB9LTggfw4IEuoW2CJ3lJa0Nvfat1KgBz11fVZ-heomHFFIp6zWk">
<span class="absolute bottom-1 left-1 right-1 font-label text-[9px] uppercase tracking-wider bg-primary/80 text-white px-1 py-0.5 text-center truncate rounded-sm">Building Facade</span>
</button>
<button aria-label="View PVDF Coating Specimen" class="gallery-thumb relative aspect-[4/3] bg-surface-container overflow-hidden rounded-lg p-0.5 transition-all shadow-sm focus:outline-none" onclick="updateGallery(2, 'Extreme close up of architectural aluminum panel surface showing PPG Duranar 3-coat fluoropolymer PVDF champagne bronze metallic finish with micaceous sparkle under studio illumination.')" type="button">
<img class="w-full h-full object-cover rounded-md" data-alt="Extreme macro sample of champagne bronze architectural fluorocarbon PVDF coating on aluminum honeycomb substrate showcasing uniform metallic pearlescent grain." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNSeJfWO7rFwWACLKRAi-InedVOcLFGjfWMyrCcCovvNU_OmSSEtx1Beas8F9aUZk4t0AtDeCKKQqKK2JXKpfEhdFEQgBc4SePxCCfSGA4kvici-TmSdWczybxM2ea0uOkJh5RnyR9Xeuyk7OOF-94gcRIafa-mNotzjTCS0UP9oKL3GpI5D7EnlcF5_YfyHaESOcPYcP__uz06fLc4dcPZp0-7SUZ3vLi3j_IB58">
<span class="absolute bottom-1 left-1 right-1 font-label text-[9px] uppercase tracking-wider bg-primary/80 text-white px-1 py-0.5 text-center truncate rounded-sm">PVDF Champagne</span>
</button>
<button aria-label="View Substructure Hook-on" class="gallery-thumb relative aspect-[4/3] bg-surface-container overflow-hidden rounded-lg p-0.5 transition-all shadow-sm focus:outline-none" onclick="updateGallery(3, 'CAD technical section render of concealed aluminum hook-on bracket extrusion and EPDM sealing gasket assembly secured behind honeycomb cassette panel for high-rise unitized facade.')" type="button">
<img class="w-full h-full object-cover rounded-md" data-alt="Engineering 3D visualization of concealed structural hook-on extruded aluminum clip engaged into vertical facade mullion, showing gasket assembly and panel edge return." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDTnLBY_Dj7dy7VZcrjZXf95_Z4RfXe6VmkJsSiiUpjESmZtaOO2G6htHEDwtxfh5kwUDkwaKDtKYvAduGvUl6-m8JNaOQGOKQs2Vatqmw1oodBOMNWEfZwCUO_E8LhOowAmDTEtjYhgnkhCgihm-KZHyJEtdaZd0xWyhOiOkA1VIOXNfNC-OukY6cHXRH4IW4dAXTkl65XeziObz56UMuLwIRxNOHKg9NACo8Zotg">
<span class="absolute bottom-1 left-1 right-1 font-label text-[9px] uppercase tracking-wider bg-primary/80 text-white px-1 py-0.5 text-center truncate rounded-sm">Hook-on Joint</span>
</button></div>
</div>
</div>
</div>
</section>
<!-- INLINE CLIENT SCRIPT FOR INTERACTION -->
<script>
    // Gallery Switcher Function
    function updateGallery(index, promptAlt) {
      const stage = document.getElementById('main-product-stage');
      const thumbs = document.querySelectorAll('.gallery-thumb');
      
      thumbs.forEach((t, i) => {
        if (i === index) {
          t.classList.add('ring-2', 'ring-secondary');
        } else {
          t.classList.remove('ring-2', 'ring-secondary');
        }
      });

      if (stage) {
        stage.setAttribute('data-alt', promptAlt);
        // Force visual feedback transition
        stage.style.opacity = '0.7';
        setTimeout(() => {
          stage.style.opacity = '1';
        }, 150);
      }
    }

    // Interactive Configurator Selectors
    function selectConfig(type, val, btn) {
      if (type === 'alloy') {
        document.getElementById('selected-alloy-label').textContent = val + (val === 'AA3003-H24' ? ' (Standard)' : ' (Marine Grade)');
        document.querySelectorAll('.config-btn').forEach(b => b.classList.remove('bg-surface-container-high', 'text-secondary'));
        btn.classList.add('bg-surface-container-high', 'text-secondary');
      } else if (type === 'thick') {
        document.getElementById('selected-thick-label').textContent = val + ' Core Panel';
        document.querySelectorAll('.thick-btn').forEach(b => b.classList.remove('bg-secondary', 'text-white'));
        btn.classList.add('bg-secondary', 'text-white');
        
        // Dynamic spec recalculation
        const wElem = document.getElementById('calc-weight');
        const mElem = document.getElementById('calc-modulus');
        if (val === '10mm') {
          wElem.textContent = '5.40 kg / m²';
          mElem.textContent = '9.8 cm³ / m';
        } else if (val === '15mm') {
          wElem.textContent = '6.15 kg / m²';
          mElem.textContent = '14.5 cm³ / m';
        } else if (val === '20mm') {
          wElem.textContent = '6.85 kg / m²';
          mElem.textContent = '19.2 cm³ / m';
        } else if (val === '25mm') {
          wElem.textContent = '7.55 kg / m²';
          mElem.textContent = '24.1 cm³ / m';
        } else if (val === '50mm') {
          wElem.textContent = '11.20 kg / m²';
          mElem.textContent = '48.6 cm³ / m';
        }
      }
    }

    // Finish Chip Selector
    function selectColor(colorName, btn) {
      document.getElementById('selected-finish-label').textContent = colorName;
      document.querySelectorAll('.color-chip').forEach(c => c.classList.remove('ring-2', 'ring-secondary', 'ring-offset-2'));
      btn.classList.add('ring-2', 'ring-secondary', 'ring-offset-2');
    }

    // Trigger Mock Asset Downloads
    function triggerDownload(fileName) {
      alert('ALUMAX Secure Document Vault: Initiating download for verified engineering asset [' + fileName + '].');
    }

    // File Selection Handler
    function handleFileSelect(input) {
      const indicator = document.getElementById('file-name-indicator');
      if (input.files && input.files.length > 0) {
        indicator.textContent = 'Attached: ' + input.files.length + ' file(s) ready for submittal.';
        indicator.classList.remove('hidden');
      }
    }

    // RFQ Submission
    function handleRfqSubmit(e) {
      e.preventDefault();
      const toast = document.getElementById('rfq-toast');
      toast.classList.remove('hidden');
      document.getElementById('engineering-rfq-form').reset();
      document.getElementById('file-name-indicator').classList.add('hidden');
      toast.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
  </script>
</div></main>
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


