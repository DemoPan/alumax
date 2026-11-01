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

  <!-- WhatsApp 悬浮按钮：号码/预填消息/二维码在「联系我们设置」配置，号码留空则不显示 -->
  <?php
  $wa_number = preg_replace('/\D+/', '', alumax_contact('whatsapp_number'));
  if ($wa_number !== '') :
      $wa_msg  = alumax_contact('whatsapp_message');
      $wa_link = 'https://wa.me/' . $wa_number . ($wa_msg !== '' ? '?text=' . rawurlencode($wa_msg) : '');
      $wa_qr   = alumax_contact('whatsapp_qr');
  ?>
  <div class="fixed bottom-6 right-6 z-50 group">
    <?php if ($wa_qr !== '') : ?>
    <div class="absolute bottom-full right-0 mb-3 w-44 p-3 bg-white shadow-2xl border border-outline-variant/30 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200 pointer-events-none">
      <img src="<?php echo esc_url($wa_qr); ?>" alt="WhatsApp QR Code" class="w-full h-auto">
      <p class="font-label text-[11px] text-on-surface-variant text-center mt-2">Scan to chat on WhatsApp</p>
    </div>
    <?php endif; ?>
    <a href="<?php echo esc_url($wa_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp"
      class="flex w-14 h-14 rounded-full bg-[#25D366] text-white shadow-2xl items-center justify-center hover:scale-110 transition-transform">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7" aria-hidden="true">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-1.911-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
      </svg>
    </a>
  </div>
  <?php endif; ?>

  <?php wp_footer(); ?>
</body>

</html>
