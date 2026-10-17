<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
  <footer class="w-full bg-[#0d1b2a] text-white border-t border-white/10">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin pt-space-xl pb-space-lg">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-space-xl pb-space-xl">
        <!-- Col 1 & 2: Brand, Summary & Social Media Icons -->
        <div class="lg:col-span-2 space-y-space-md">
          <div class="flex items-center gap-3">
            <svg class="h-8 w-8 text-secondary-fixed" fill="currentColor" viewBox="0 0 40 40">
              <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="currentColor" stroke-linejoin="round"
                stroke-width="3.5"></path>
              <path d="M20 14L28 30H12L20 14Z" fill="currentColor" fill-opacity="0.85"></path>
              <line stroke="#ffffff" stroke-width="2" x1="8" x2="32" y1="26" y2="26"></line>
            </svg>
            <span class="font-headline-sm text-headline-sm uppercase tracking-tight text-white font-bold">ALUMAX
              ARCHITECTURAL</span>
          </div>
          <p class="font-body-md text-body-md text-slate-300 max-w-md">
            Global premier manufacturer of precision-engineered curtain walls, motorized adaptive facades, and
            high-performance architectural envelopes. Supplying tested systems to over 60 countries across Europe, the
            Middle East, Southeast Asia, and the Americas.
          </p>
          <!-- Social Media Icons for International B2B Reach -->
          <div class="space-y-2 pt-2">
            <span
              class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider block font-semibold">Global
              Social &amp; Project Channels</span>
            <div class="flex items-center gap-2">
              <!-- LinkedIn -->
              <a aria-label="ALUMAX on LinkedIn"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-secondary border border-white/15 flex items-center justify-center text-white transition-all hover:scale-105 group"
                href="#" title="LinkedIn">
                <span class="font-label-sm text-label-sm font-bold group-hover:text-on-secondary">in</span>
              </a>
              <!-- YouTube -->
              <a aria-label="ALUMAX on YouTube"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-secondary border border-white/15 flex items-center justify-center text-white transition-all hover:scale-105 group"
                href="#" title="YouTube">
                <span class="material-symbols-outlined text-lg group-hover:text-on-secondary">smart_display</span>
              </a>
              <!-- X (Twitter) -->
              <a aria-label="ALUMAX on X"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-secondary border border-white/15 flex items-center justify-center text-white transition-all hover:scale-105 group"
                href="#" title="X (Twitter)">
                <span class="font-label-sm text-label-sm font-bold group-hover:text-on-secondary">𝕏</span>
              </a>
              <!-- WeChat -->
              <a aria-label="ALUMAX on WeChat"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-secondary border border-white/15 flex items-center justify-center text-white transition-all hover:scale-105 group"
                href="#" title="WeChat">
                <span class="material-symbols-outlined text-lg group-hover:text-on-secondary">chat</span>
              </a>
              <!-- Instagram -->
              <a aria-label="ALUMAX on Instagram"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-secondary border border-white/15 flex items-center justify-center text-white transition-all hover:scale-105 group"
                href="#" title="Instagram">
                <span class="material-symbols-outlined text-lg group-hover:text-on-secondary">photo_camera</span>
              </a>
            </div>
          </div>
          <div class="flex flex-wrap gap-space-sm pt-space-xs">
            <span
              class="font-label-sm text-label-sm px-space-sm py-space-xs bg-white/10 text-white uppercase rounded">ISO
              9001:2015</span>
            <span
              class="font-label-sm text-label-sm px-space-sm py-space-xs bg-white/10 text-white uppercase rounded">CE
              Certified</span>
            <span
              class="font-label-sm text-label-sm px-space-sm py-space-xs bg-white/10 text-white uppercase rounded">ASTM
              E84 / EN13501 A2</span>
            <span
              class="font-label-sm text-label-sm px-space-sm py-space-xs bg-white/10 text-white uppercase rounded">BMS
              IoT Ready</span>
          </div>
        </div>
        <!-- Col 3: Systems Matrix -->
        <div class="space-y-space-md">
          <div class="font-headline-sm text-headline-sm text-white uppercase font-bold">Systems Matrix</div>
          <ul class="space-y-space-xs">
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Intelligent Motorized Louvers</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Solid Aluminum Panels (3.0mm)</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Aluminum Honeycomb Panels</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Corrugated Core Panels</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Pre-Insulated Envelope Panels</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Architectural Louvers &amp; Sunshades</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">High-Traffic Steel Cladding</a></li>
          </ul>
        </div>
        <!-- Col 4: Engineering & Export -->
        <div class="space-y-space-md">
          <div class="font-headline-sm text-headline-sm text-white uppercase font-bold">Engineering &amp; Export</div>
          <ul class="space-y-space-xs">
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(home_url('/resources/')); ?>">BIM LOD 400 Library</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(home_url('/resources/')); ?>">ASTM &amp; EN Test Certifications</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_post_type_archive_link('case')); ?>">Airport &amp; High-Rise References</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(home_url('/about/')); ?>">CNC Precision Lines</a></li>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(home_url('/about/')); ?>">Export Shipping &amp; Crating</a></li>
          </ul>
        </div>
        <!-- Col 5: Global Inquiries -->
        <div class="space-y-space-md">
          <div class="font-headline-sm text-headline-sm text-white uppercase font-bold">Global Inquiries</div>
          <p class="font-body-sm text-body-sm text-slate-300">Engineering Consultation &amp; Overseas Export Support
            Center.</p>
          <div class="font-label-sm text-label-sm space-y-space-xs text-slate-300">
            <p class="">Dubai, UAE // Regional MENA Office</p>
            <p class="">Rotterdam, NL // European Logistics Hub</p>
            <p class="">Foshan, CN // Global Manufacturing Center</p>
            <p class="text-secondary-fixed font-semibold pt-space-xs">export@alumax-facade.com</p>
          </div>
          <div class="pt-space-xs">
            <a class="inline-block font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed hover:text-white transition-colors"
              href="<?php echo esc_url(home_url('/contact/')); ?>">
              Global Representative Network →
            </a>
          </div>
        </div>
      </div>
      <!-- Bottom Legal & Copyright -->
      <div
        class="pt-space-lg border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-space-md">
        <p class="font-label-sm text-label-sm text-slate-400">© <?php echo esc_html(gmdate('Y')); ?> ALUMAX Architectural Envelopes Co., Ltd. All rights
          reserved. Precision Architectural Facade Systems.</p>
        <div class="flex items-center gap-space-lg font-label-sm text-label-sm text-slate-400">
          <a class="hover:text-white transition-colors" href="#">Privacy Policy</a>
          <a class="hover:text-white transition-colors" href="#">Export Compliance &amp; Certifications</a>
          <a class="hover:text-white transition-colors" href="#">Terms of Supply</a>
        </div>
      </div>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>

</html>
