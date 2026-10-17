<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
    <div class="flex flex-col w-full">
      <!-- Top Ambient Banner & Header Intro -->
      <section class="relative w-full bg-primary-container text-on-primary py-space-xl overflow-hidden shadow-md"
        style="background-image: linear-gradient(to right, rgba(13, 27, 42, 0.95), rgba(13, 27, 42, 0.8)), url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuBojFWH-AeAihV0HwXIU0hfXHqIT0TZep1DVRCjXRRJ2dbcGrFlydkW_KTxdOXw0CdmlDrtbppnTId-1VF5DsgiVXDOwyHgHCyPsdea1XqlxesJBfOmyMS7Kl58U58TKD1Fp_LMnf128pYheojmLMzqp6Uf0yHHpOijfd3kAiTxLXxY5gaFJ3mpV5rjU7wrck8rKqA2WbPgiJangsPe6lx7IKqFZjbNRnK3H-d7hjBs_RYSU_ORNXmZ&quot;); background-size: cover; background-position: center center;">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
          <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <pattern height="48" id="grid-pattern" patternUnits="userSpaceOnUse" width="48">
                <path d="M 48 0 L 0 0 0 48" fill="none" stroke="currentColor" stroke-width="0.75"></path>
              </pattern>
            </defs>
            <rect fill="url(#grid-pattern)" height="100%" width="100%"></rect>
          </svg>
        </div>
        <div class="relative max-w-[1440px] mx-auto px-margin flex flex-col gap-space-md">
          <div class="flex items-center gap-3">
            <span
              class="inline-flex items-center px-3 py-1 bg-tertiary-container text-secondary-fixed font-label-sm text-label-sm uppercase tracking-widest shadow-sm">
              Technical Specification &amp; Global Tender Portal
            </span>
            <div class="h-2 w-2 rounded-full bg-secondary-fixed animate-ping"></div>
            <span class="font-label-sm text-label-sm text-outline-variant tracking-wider uppercase">Live Engineering
              Desks Connected</span>
          </div>
          <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-lg">
            <div class="max-w-3xl">
              <h1
                class="font-headline-lg text-headline-lg lg:font-display-xl lg:text-display-xl text-on-primary tracking-tight">
                Connect with Our Global Engineering &amp; Export Team
              </h1>
              <p class="font-body-lg text-body-lg text-outline-variant mt-space-sm leading-relaxed">
                24-Hour Rapid Response for Architectural Facade Submittals, BOQ Pricing, Free Sample Boxes, and
                Structural Engineering Consultations.
              </p>
            </div>
            <!-- Telemetry Stats Strip -->
            <div class="flex items-center gap-space-md bg-tertiary-container p-space-md shadow-sm">
              <div class="flex flex-col pr-4">
                <span class="font-label-sm text-label-sm text-outline-variant uppercase">Average Response</span>
                <span class="font-headline-md text-headline-md text-secondary-fixed font-bold tracking-tight">2.4
                  Hrs</span>
              </div>
              <div class="w-px h-10 bg-on-tertiary-fixed-variant"></div>
              <div class="flex flex-col pl-2">
                <span class="font-label-sm text-label-sm text-outline-variant uppercase">Global Dispatches</span>
                <span class="font-headline-md text-headline-md text-on-primary font-bold tracking-tight">84+
                  Countries</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Section 1: Global Hubs & Regional Representation Offices -->
      <section class="w-full bg-surface py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin flex flex-col gap-space-lg">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-2">
            <div>
              <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest block mb-1">Worldwide
                Deployment Network</span>
              <h2 class="font-headline-lg text-headline-lg text-on-surface">Regional Headquarters &amp; Façade Technical
                Desks</h2>
            </div>
            <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md">
              Direct lines to senior facade structural consultants, tender estimators, and regional logistic depots
              across international time zones.
            </p>
          </div>
          <!-- 4 Interactive Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-gutter">
            <!-- Card 1: Dubai (MENA) -->
            <div
              class="group bg-surface-container-lowest p-space-lg flex flex-col justify-between shadow-sm hover:shadow-xl transition-all duration-300">
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <span
                    class="font-label-sm text-label-sm uppercase px-2 py-0.5 bg-secondary-fixed text-on-secondary-fixed font-semibold">MENA
                    / GCC Desk</span>
                  <span class="flex items-center gap-1 font-label-sm text-label-sm text-secondary font-medium">
                    <span class="w-2 h-2 rounded-full bg-secondary"></span> UTC+4 (GST)
                  </span>
                </div>
                <h3
                  class="font-headline-sm text-headline-sm text-on-surface mt-2 group-hover:text-secondary transition-colors">
                  Middle East Regional Hub
                </h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Boulevard Plaza Tower 1, Suite 2404, Downtown Dubai, United Arab Emirates
                </p>
                <div class="pt-2 flex flex-col gap-1 text-on-surface">
                  <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] text-secondary">call</span>
                    <span class="font-label-md text-label-md font-semibold">+971 4 883 2910</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] text-secondary">schedule</span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant">Sun–Thu: 08:30 – 18:00</span>
                  </div>
                </div>
              </div>
              <div
                class="mt-space-md pt-space-sm bg-surface-container-low p-space-sm flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Civil Defense
                  Certified</span>
                <span class="material-symbols-outlined text-[18px] text-secondary">verified</span>
              </div>
            </div>
            <!-- Card 2: Rotterdam (Europe) -->
            <div
              class="group bg-surface-container-lowest p-space-lg flex flex-col justify-between shadow-sm hover:shadow-xl transition-all duration-300">
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <span
                    class="font-label-sm text-label-sm uppercase px-2 py-0.5 bg-primary-fixed text-on-primary-fixed font-semibold">European
                    Logistics</span>
                  <span class="flex items-center gap-1 font-label-sm text-label-sm text-primary-tint font-medium">
                    <span class="w-2 h-2 rounded-full bg-secondary"></span> UTC+1 (CET)
                  </span>
                </div>
                <h3
                  class="font-headline-sm text-headline-sm text-on-surface mt-2 group-hover:text-secondary transition-colors">
                  EU Technical &amp; Port Hub
                </h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Waalhaven Zuidzijde 42, 3089 JH Rotterdam, Kingdom of the Netherlands
                </p>
                <div class="pt-2 flex flex-col gap-1 text-on-surface">
                  <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] text-secondary">call</span>
                    <span class="font-label-md text-label-md font-semibold">+31 10 742 1880</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] text-secondary">schedule</span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant">Mon–Fri: 08:30 – 17:30</span>
                  </div>
                </div>
              </div>
              <div
                class="mt-space-md pt-space-sm bg-surface-container-low p-space-sm flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">CE &amp; EN-13501
                  Stock</span>
                <span class="material-symbols-outlined text-[18px] text-secondary">local_shipping</span>
              </div>
            </div>
            <!-- Card 3: Foshan Global HQ (Factory Direct) -->
            <div
              class="group bg-primary-container text-on-primary p-space-lg flex flex-col justify-between shadow-md hover:shadow-2xl transition-all duration-300">
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <span
                    class="font-label-sm text-label-sm uppercase px-2 py-0.5 bg-secondary-fixed text-on-secondary-fixed font-semibold">Global
                    HQ Plant</span>
                  <span class="flex items-center gap-1 font-label-sm text-label-sm text-secondary-fixed font-medium">
                    <span class="w-2 h-2 rounded-full bg-secondary-fixed"></span> UTC+8 (CST)
                  </span>
                </div>
                <h3
                  class="font-headline-sm text-headline-sm text-on-primary mt-2 group-hover:text-secondary-fixed transition-colors">
                  Foshan Manufacturing Base
                </h3>
                <p class="font-body-sm text-body-sm text-outline-variant">
                  ALUMAX Industrial Park, Songgang Block, Nanhai, Foshan, Guangdong, China
                </p>
                <div class="pt-2 flex flex-col gap-1 text-on-primary">
                  <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] text-secondary-fixed">call</span>
                    <span class="font-label-md text-label-md font-semibold">+86 757 8820 9000</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px] text-secondary-fixed">mail</span>
                    <span class="font-body-sm text-body-sm text-outline-variant">export@alumax-facade.com</span>
                  </div>
                </div>
              </div>
              <div
                class="mt-space-md pt-space-sm bg-tertiary-container p-space-sm flex items-center justify-between text-secondary-fixed">
                <span class="font-label-sm text-label-sm uppercase tracking-wider">120,000m² Plant Capacity</span>
                <span class="material-symbols-outlined text-[18px]">precision_manufacturing</span>
              </div>
            </div>
            <!-- Card 4: APAC & Americas Liaison Desks -->
            <div
              class="group bg-surface-container-lowest p-space-lg flex flex-col justify-between shadow-sm hover:shadow-xl transition-all duration-300">
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <span
                    class="font-label-sm text-label-sm uppercase px-2 py-0.5 bg-surface-container-highest text-on-surface font-semibold">Liaison
                    Desks</span>
                  <span class="flex items-center gap-1 font-label-sm text-label-sm text-on-surface-variant font-medium">
                    <span class="w-2 h-2 rounded-full bg-secondary"></span> Multi-Zone
                  </span>
                </div>
                <h3
                  class="font-headline-sm text-headline-sm text-on-surface mt-2 group-hover:text-secondary transition-colors">
                  APAC &amp; Americas Liaison
                </h3>
                <div class="space-y-3 pt-1">
                  <div>
                    <p class="font-label-sm text-label-sm text-secondary font-semibold uppercase">Singapore Hub</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Marina Bay Financial Centre Tower 2,
                      Singapore</p>
                  </div>
                  <div>
                    <p class="font-label-sm text-label-sm text-secondary font-semibold uppercase">Houston Representative
                    </p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Post Oak Blvd, Galleria Financial
                      Center, TX, USA</p>
                  </div>
                </div>
              </div>
              <div
                class="mt-space-md pt-space-sm bg-surface-container-low p-space-sm flex items-center justify-between">
                <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">ASTM / ASCE-7
                  Compliant</span>
                <span class="material-symbols-outlined text-[18px] text-secondary">travel_explore</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Section 2: High-Performance Technical Submittal & Inquiry Form -->
      <section class="w-full bg-surface-container-low py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
            <!-- Left Column: Why Specify ALUMAX? & Technical Standards -->
            <div class="lg:col-span-4 flex flex-col gap-space-lg">
              <div class="bg-surface-container-lowest p-space-lg shadow-sm">
                <span
                  class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-semibold">Consultancy
                  Standard</span>
                <h2 class="font-headline-md text-headline-md text-on-surface mt-1">Why Specify ALUMAX Architectural?
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant mt-space-sm">
                  We support architects, facade engineers, and general contractors from schematic design through
                  containerized sea freight delivery.
                </p>
                <ul class="flex flex-col gap-space-md mt-space-lg">
                  <li class="flex items-start gap-3">
                    <div
                      class="w-8 h-8 rounded-none bg-primary-container text-secondary-fixed flex items-center justify-center shrink-0">
                      <span class="material-symbols-outlined text-[18px]">timer</span>
                    </div>
                    <div>
                      <h4 class="font-headline-sm text-headline-sm text-on-surface">24h Engineering Turnaround</h4>
                      <p class="font-body-sm text-body-sm text-on-surface-variant">Complete initial take-off
                        calculations, panel subdivision proposals, and budget BOQ estimates.</p>
                    </div>
                  </li>
                  <li class="flex items-start gap-3">
                    <div
                      class="w-8 h-8 rounded-none bg-primary-container text-secondary-fixed flex items-center justify-center shrink-0">
                      <span class="material-symbols-outlined text-[18px]">calculate</span>
                    </div>
                    <div>
                      <h4 class="font-headline-sm text-headline-sm text-on-surface">Complimentary 3D Wind Calculation
                      </h4>
                      <p class="font-body-sm text-body-sm text-on-surface-variant">Wind pressure simulation according to
                        ASCE 7-16, EN 1991-1-4, or BS 6399 parameters.</p>
                    </div>
                  </li>
                  <li class="flex items-start gap-3">
                    <div
                      class="w-8 h-8 rounded-none bg-primary-container text-secondary-fixed flex items-center justify-center shrink-0">
                      <span class="material-symbols-outlined text-[18px]">flight_takeoff</span>
                    </div>
                    <div>
                      <h4 class="font-headline-sm text-headline-sm text-on-surface">Worldwide DHL Express Dispatch</h4>
                      <p class="font-body-sm text-body-sm text-on-surface-variant">Curated material finish boxes and
                        full mockup profile cuts shipped with priority international tracking.</p>
                    </div>
                  </li>
                  <li class="flex items-start gap-3">
                    <div
                      class="w-8 h-8 rounded-none bg-primary-container text-secondary-fixed flex items-center justify-center shrink-0">
                      <span class="material-symbols-outlined text-[18px]">verified_user</span>
                    </div>
                    <div>
                      <h4 class="font-headline-sm text-headline-sm text-on-surface">Accredited Testing &amp; Audits</h4>
                      <p class="font-body-sm text-body-sm text-on-surface-variant">Strict compliance and test reports:
                        ASTM E84 Class A, CWCT Dynamic Water/Air, EN 13501-1 (A2-s1, d0), and BS 8414.</p>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- Direct Escalation Card -->
              <div class="bg-primary-container text-on-primary p-space-lg shadow-sm flex flex-col gap-space-sm">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-secondary-fixed text-[20px]">bolt</span>
                  <span
                    class="font-label-md text-label-md text-secondary-fixed font-semibold uppercase tracking-wider">Fast-Track
                    Tender Hotline</span>
                </div>
                <p class="font-body-sm text-body-sm text-outline-variant">
                  Are you submitting within 48 hours for public infrastructure or mega-commercial tenders? Speak with
                  our Chief Façade Estimator directly.
                </p>
                <div class="pt-2 flex items-center gap-3">
                  <a class="inline-flex items-center gap-2 px-4 py-2 bg-secondary text-on-secondary font-label-md text-label-md uppercase tracking-wider hover:bg-secondary-fixed hover:text-on-secondary-fixed transition-colors"
                    href="tel:+8675788209000">
                    <span class="material-symbols-outlined text-[16px]">phone_in_talk</span>
                    Direct Priority Line
                  </a>
                </div>
              </div>
            </div>
            <!-- Right Column: Comprehensive Architectural Submittal Form -->
            <div class="lg:col-span-8 bg-surface-container-lowest p-space-lg lg:p-space-xl shadow-md">
              <div class="flex flex-col gap-1 pb-space-md">
                <div class="flex items-center justify-between">
                  <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-semibold">Tender
                    Form // Engineering Inquiry &amp; Specification</span>
                  <span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Ref: ALX-RFQ-2025</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-on-surface">Architectural Façade Submittal &amp;
                  Pricing Request</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Please provide project details and architectural drawings. Your request will be automatically routed
                  to the regional technical director.
                </p>
              </div>
              <form class="flex flex-col gap-space-md" id="alumax-inquiry-form"
                onsubmit="event.preventDefault(); handleFormSubmit();">
                <!-- Row 1: Personal & Firm Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                  <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md uppercase text-on-surface font-medium" for="fullName">
                      Full Name &amp; Professional Title <span class="text-secondary font-bold">*</span>
                    </label>
                    <input
                      class="h-11 px-3 bg-surface-bright text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-colors"
                      id="fullName" placeholder="e.g. David Sterling, Lead Facade Architect" required="" type="text">
                  </div>
                  <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md uppercase text-on-surface font-medium" for="companyName">
                      Company / Firm / Contractor <span class="text-secondary font-bold">*</span>
                    </label>
                    <input
                      class="h-11 px-3 bg-surface-bright text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-colors"
                      id="companyName" placeholder="e.g. Sterling &amp; Partners Architects LLC" required=""
                      type="text">
                  </div>
                </div>
                <!-- Row 2: Contact Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                  <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md uppercase text-on-surface font-medium" for="email">
                      Corporate Email <span class="text-secondary font-bold">*</span>
                    </label>
                    <input
                      class="h-11 px-3 bg-surface-bright text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-colors"
                      id="email" placeholder="d.sterling@architects.com" required="" type="email">
                  </div>
                  <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md uppercase text-on-surface font-medium" for="phone">
                      Phone (Country Code + Number) <span class="text-secondary font-bold">*</span>
                    </label>
                    <div class="flex gap-2">
                      <select
                        class="h-11 px-2 bg-surface-bright text-on-surface font-label-md text-label-md focus:outline-none shadow-sm shrink-0"
                        id="countryCode">
                        <option value="+971">UAE (+971)</option>
                        <option value="+31">NL (+31)</option>
                        <option value="+44">UK (+44)</option>
                        <option value="+1">USA (+1)</option>
                        <option value="+65">SG (+65)</option>
                        <option value="+86">CN (+86)</option>
                        <option value="+966">KSA (+966)</option>
                        <option value="+61">AUS (+61)</option>
                        <option value="+49">GER (+49)</option>
                      </select>
                      <input
                        class="h-11 px-3 w-full bg-surface-bright text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-colors"
                        id="phone" placeholder="50 123 4567" required="" type="tel">
                    </div>
                  </div>
                </div>
                <!-- Row 3: Project Scope & Dimensions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                  <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md uppercase text-on-surface font-medium"
                      for="projectLocation">
                      Project Location (City, Country) <span class="text-secondary font-bold">*</span>
                    </label>
                    <input
                      class="h-11 px-3 bg-surface-bright text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:outline-none shadow-sm transition-colors"
                      id="projectLocation" placeholder="e.g. Riyadh, Saudi Arabia / Manchester, UK" required=""
                      type="text">
                  </div>
                  <div class="flex flex-col gap-1">
                    <label class="font-label-md text-label-md uppercase text-on-surface font-medium" for="facadeArea">
                      Estimated Façade Area <span class="text-secondary font-bold">*</span>
                    </label>
                    <select
                      class="h-11 px-3 bg-surface-bright text-on-surface font-body-md text-body-md focus:outline-none shadow-sm"
                      id="facadeArea" required="">
                      <option disabled="" selected="" value="">Select estimated scope</option>
                      <option value="under_1000">Below 1,000 m² (&lt; 10,700 sq ft)</option>
                      <option value="1000_5000">1,000 – 5,000 m² (Commercial standard)</option>
                      <option value="5000_15000">5,000 – 15,000 m² (High-rise / Transit)</option>
                      <option value="15000_50000">15,000 – 50,000 m² (Mega-complex / Stadium)</option>
                      <option value="over_50000">50,000+ m² (Airport Terminal / District)</option>
                    </select>
                  </div>
                </div>
                <!-- Systems of Interest: Multi-Select Chips -->
                <div class="flex flex-col gap-2 pt-2">
                  <label class="font-label-md text-label-md uppercase text-on-surface font-medium">
                    Systems Under Specification (Select all that apply)
                  </label>
                  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-2"><label
                      class="flex items-center gap-2 p-2 bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors text-on-surface font-body-sm text-body-sm select-none"><input
                        checked="" class="accent-secondary h-4 w-4" name="systems" type="checkbox"
                        value="solid-cladding"><span class="">Solid Aluminum Cladding</span></label><label
                      class="flex items-center gap-2 p-2 bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors text-on-surface font-body-sm text-body-sm select-none"><input
                        class="accent-secondary h-4 w-4" name="systems" type="checkbox" value="motorized-louvers"><span
                        class="">Intelligent Motorized Louvers</span></label><label
                      class="flex items-center gap-2 p-2 bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors text-on-surface font-body-sm text-body-sm select-none"><input
                        class="accent-secondary h-4 w-4" name="systems" type="checkbox" value="honeycomb"><span
                        class="">Aluminum Honeycomb Panels</span></label><label
                      class="flex items-center gap-2 p-2 bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors text-on-surface font-body-sm text-body-sm select-none"><input
                        class="accent-secondary h-4 w-4" name="systems" type="checkbox" value="corrugated"><span
                        class="">Corrugated Core Panels</span></label><label
                      class="flex items-center gap-2 p-2 bg-surface-container cursor-pointer hover:bg-surface-container-high transition-colors text-on-surface font-body-sm text-body-sm select-none"><input
                        class="accent-secondary h-4 w-4" name="systems" type="checkbox" value="hyperbolic"><span
                        class="">Hyperbolic 3D Panels</span></label></div>
                </div>
                <!-- Drag & Drop Upload Block -->
                <div class="flex flex-col gap-1 pt-2">
                  <label
                    class="font-label-md text-label-md uppercase text-on-surface font-medium flex items-center justify-between">
                    <span class="">Tender Form // Engineering Inquiry &amp; Specification</span>
                    <span class="text-on-surface-variant font-normal">Formats: DWG, RVT, IFC, PDF (Max 50MB)</span>
                  </label>
                  <div
                    class="p-space-lg bg-surface-container-low flex flex-col items-center justify-center text-center cursor-pointer hover:bg-surface-container transition-colors shadow-sm"
                    id="dropzone">
                    <span class="material-symbols-outlined text-[36px] text-secondary mb-2">cloud_upload</span>
                    <p class="font-body-md text-body-md text-on-surface font-medium">
                      Drag and drop elevation blueprints, facade cut sheets, or tender BOQ here
                    </p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                      or <span class="text-secondary font-semibold underline">browse local directory</span> to attach
                      files
                    </p>
                    <input accept=".dwg,.rvt,.ifc,.pdf,.zip" class="hidden" id="fileUpload" multiple="" type="file">
                    <div class="mt-2 text-label-sm font-label-sm text-on-surface font-medium hidden" id="fileList">
                    </div>
                  </div>
                </div>
                <!-- Message & Scope Notes -->
                <div class="flex flex-col gap-1">
                  <label class="font-label-md text-label-md uppercase text-on-surface font-medium" for="message">
                    Scope Summary, Finish Code (PVDF/Anodized) &amp; Specific Fire Requirements
                  </label>
                  <textarea
                    class="p-3 bg-surface-bright text-on-surface font-body-md text-body-md focus:bg-surface-container-lowest focus:outline-none shadow-sm"
                    id="message"
                    placeholder="Please specify alloy requirements (e.g. AA3003 / AA5052), target paint coating (PPG Duranar / AkzoNobel Interpon D3000), wind pressure metrics, or delivery target date..."
                    rows="3"></textarea>
                </div>
                <!-- Sample Box Checkbox Callout -->
                <div class="p-space-md bg-secondary-fixed text-on-secondary-fixed shadow-sm flex items-start gap-3">
                  <input checked="" class="accent-secondary h-5 w-5 mt-0.5 shrink-0 cursor-pointer"
                    id="requestSampleBox" type="checkbox">
                  <label class="cursor-pointer" for="requestSampleBox">
                    <span class="font-headline-sm text-headline-sm block font-bold leading-tight">Request complimentary
                      physical aluminum sample kit delivered via DHL Express</span>
                    <span class="font-body-sm text-body-sm block mt-0.5 opacity-90">Includes 12 pre-anodized and 3-coat
                      PVDF architectural swatches with core cutaways (Standard 150×150mm).</span>
                  </label>
                </div>
                <!-- Submit Button & Disclaimer -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-space-md pt-space-sm">
                  <button
                    class="w-full sm:w-auto h-12 px-8 bg-primary-container text-on-primary font-headline-sm text-headline-sm tracking-wider uppercase hover:bg-secondary transition-colors shadow-md flex items-center justify-center gap-3"
                    type="submit">
                    <span class="material-symbols-outlined text-[20px]">Tender Form // Engineering Inquiry &amp;
                      Specification</span>
                    Submit Engineering Inquiry &amp; Request Quotation
                  </button>

                </div>
                <div
                  class="hidden p-space-md bg-surface-container-highest text-on-surface font-body-md text-body-md shadow-sm"
                  id="formSuccessMessage">
                  <div class="flex items-center gap-2 text-secondary font-bold">
                    <span class="material-symbols-outlined">task_alt</span>
                    Submittal Received Successfully
                  </div>
                  <p class="mt-1 font-body-sm text-body-sm text-on-surface-variant">Your facade dossier has been
                    dispatched to our engineering desk. A dedicated project engineer will confirm submittal receipt
                    within 2 hours.</p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- Section 3: Worldwide Sample Box Request Flow -->
      <section class="w-full bg-surface-container py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin">
          <div class="bg-primary-container text-on-primary shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 items-center">
              <!-- Image Column -->
              <div class="lg:col-span-5 h-80 lg:h-full relative overflow-hidden">
                <div class="bg-cover bg-center w-full h-full min-h-[340px]"
                  data-alt="High-end presentation of an architectural aluminum sample kit box by ALUMAX, displaying 12 precision-machined solid aluminum and honeycomb facade panels in champagne bronze, brushed graphite, perforated dark anthracite, and anodized gold finishes, resting on a clean slate architectural blueprints table in crisp daylight."
                  style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDU_xQ7AWzFHeuo6D-J1WvC2bSR1juE0Z7-lOfCC96rB74VGOPhG9DAOBseSNclaeLfkP6cuT9KnfqhC-FNd8gu_xVIQmvItiPq72KtPhDJknIgttqNbSuo8d1RtR054H_nhVZ6Y905pRegcA6u18tJSQ4ZZapDBMo3phsD99kqWsu4vGAdevsT5T-bYxzBd0tP1zslO4HQzUNGxJTmJTA4dprqAbS7-uvglKwdQ-qVBqES_HdoCu9O')">
                </div>
                <div
                  class="absolute inset-0 bg-gradient-to-t from-primary-container via-transparent to-transparent lg:hidden">
                </div>
                <div
                  class="absolute bottom-4 left-4 bg-tertiary-container px-3 py-1 font-label-sm text-label-sm text-secondary-fixed uppercase tracking-widest shadow-sm">
                  Edition 2025 // Global Architect Kit
                </div>
              </div>
              <!-- Content Column -->
              <div class="lg:col-span-7 p-space-lg lg:p-space-xl flex flex-col gap-space-md">
                <div class="flex flex-col gap-space-sm">
                  <div class="flex items-center justify-between">
                    <div
                      class="w-12 h-12 bg-surface-container text-on-surface flex items-center justify-center group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                      <span class="material-symbols-outlined text-[28px]">qr_code_2</span></div><span
                      class="font-label-sm text-label-sm text-secondary font-semibold uppercase">Enterprise Desk</span>
                  </div>
                  <h3 class="font-headline-sm text-headline-sm text-on-surface mt-2">Enterprise WeChat / Instant Desk
                  </h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant">Connect directly with technical
                    fabrication managers, quality assurance engineers, and export dispatch coordinators.</p>
                </div>
                <div
                  class="mt-space-lg pt-space-sm flex items-center justify-between text-on-surface font-label-md text-label-md font-semibold">
                  <span class="">ALUMAX_GLOBAL_TECH</span><span
                    class="material-symbols-outlined text-[18px] text-secondary">expand_content</span></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Section 4: Direct Communication Channels & Instant Engineering Chat -->
      <section class="w-full bg-surface py-space-xl">
        <div class="max-w-[1440px] mx-auto px-margin flex flex-col gap-space-lg">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-sm">
            <div>
              <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest block mb-1">Synchronous
                Communication</span>
              <h2 class="font-headline-lg text-headline-lg text-on-surface">Direct Instant Channels for Site Engineers
                &amp; Buyers</h2>
            </div>
            <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md">
              Immediate mobile connection for live site dimensions, urgent mock-up logistics, or immediate production
              line status inquiries.
            </p>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            <!-- Channel 1: WhatsApp for Business -->
            <a class="group bg-surface-container-lowest p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
              href="https://wa.me/8675788209000" rel="noopener noreferrer" target="_blank">
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <div
                    class="w-12 h-12 bg-surface-container text-on-surface flex items-center justify-center group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                    <span class="material-symbols-outlined text-[28px]">chat</span>
                  </div>
                  <span class="font-label-sm text-label-sm text-secondary font-semibold uppercase">Active Desk</span>
                </div>
                <h3 class="font-headline-sm text-headline-sm text-on-surface mt-2">WhatsApp for Business</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Live CAD drawing transmission, real-time voice notes, and fabrication video inspections directly with
                  project engineers.
                </p>
              </div>
              <div
                class="mt-space-lg pt-space-sm flex items-center justify-between text-on-surface font-label-md text-label-md font-semibold">
                <span class="">+86 757 8820 9000</span>
                <span
                  class="material-symbols-outlined text-[18px] text-secondary group-hover:translate-x-1 transition-transform">arrow_forward</span>
              </div>
            </a>
            <!-- Channel 2: WeChat Business -->
            <div
              class="group bg-surface-container-lowest p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <div
                    class="w-12 h-12 bg-surface-container text-on-surface flex items-center justify-center group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                    <span class="material-symbols-outlined text-[28px]">qr_code_2</span>
                  </div>
                  <span class="font-label-sm text-label-sm text-secondary font-semibold uppercase">Enterprise QR</span>
                </div>
                <h3 class="font-headline-sm text-headline-sm text-on-surface mt-2">WeChat Enterprise Contact</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Scan to initiate a dedicated WeChat project group with technical fabrication managers, quality
                  assurance, and dispatch supervisors.
                </p>
              </div>
              <div
                class="mt-space-lg pt-space-sm flex items-center justify-between text-on-surface font-label-md text-label-md font-semibold">
                <span class="">ALUMAX_GLOBAL_TECH</span>
                <span class="material-symbols-outlined text-[18px] text-secondary">expand_content</span>
              </div>
            </div>
            <!-- Channel 3: Emergency Logistics Line -->
            <div
              class="group bg-surface-container-lowest p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <div
                    class="w-12 h-12 bg-surface-container text-on-surface flex items-center justify-center group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                    <span class="material-symbols-outlined text-[28px]">support_agent</span>
                  </div>
                  <span class="font-label-sm text-label-sm text-secondary font-semibold uppercase">24/7 Sea
                    Freight</span>
                </div>
                <h3 class="font-headline-sm text-headline-sm text-on-surface mt-2">Emergency Container Logistics</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                  Live tracking for ocean bill of lading (B/L), customs fumigation certificates, container staging, and
                  sea freight schedules.
                </p>
              </div>
              <div
                class="mt-space-lg pt-space-sm flex items-center justify-between text-on-surface font-label-md text-label-md font-semibold">
                <span class="">logistics@alumax-facade.com</span>
                <span
                  class="material-symbols-outlined text-[18px] text-secondary group-hover:translate-x-1 transition-transform">send</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Interactive DOM Script for File Drag-and-Drop and Submittal Feedback -->
      <script>
        const dropzone = document.getElementById('dropzone');
        const fileUpload = document.getElementById('fileUpload');
        const fileList = document.getElementById('fileList');

        if (dropzone && fileUpload) {
          dropzone.addEventListener('click', () => fileUpload.click());

          ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
              e.preventDefault();
              e.stopPropagation();
              dropzone.classList.add('bg-surface-container-high');
            }, false);
          });

          ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
              e.preventDefault();
              e.stopPropagation();
              dropzone.classList.remove('bg-surface-container-high');
            }, false);
          });

          dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
          }, false);

          fileUpload.addEventListener('change', (e) => {
            handleFiles(e.target.files);
          });
        }

        function handleFiles(files) {
          if (!files || files.length === 0) return;
          fileList.classList.remove('hidden');
          const names = Array.from(files).map(f => `${f.name} (${(f.size / (1024 * 1024)).toFixed(1)} MB)`).join(', ');
          fileList.innerHTML = `<span class="text-secondary font-bold">Attached:</span> ${names}`;
        }

        function handleFormSubmit() {
          const btn = document.querySelector('#alumax-inquiry-form button[type="submit"]');
          const successDiv = document.getElementById('formSuccessMessage');

          btn.disabled = true;
          btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-[18px]">progress_activity</span> Transmitting Dossier...`;

          setTimeout(() => {
            btn.innerHTML = `<span class="material-symbols-outlined text-[18px]">done</span> Inquiry Submitted`;
            btn.classList.add('bg-secondary');
            successDiv.classList.remove('hidden');
            successDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
          }, 1200);
        }
      </script>
    </div>
  </main>

<?php get_footer(); ?>
