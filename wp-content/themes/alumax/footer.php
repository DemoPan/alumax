<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
  <footer class="w-full bg-[#0d1b2a] text-white border-t border-white/10">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin pt-space-xl pb-space-lg">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-space-xl pb-space-xl">
        <!-- Col 1 & 2: Brand, Summary & Social Media Icons（品牌信息在「站点设置」编辑） -->
        <div class="lg:col-span-2 space-y-space-md">
          <div class="flex items-center gap-3">
            <?php $footer_logo = alumax_site('brand_logo'); ?>
            <?php if ($footer_logo !== '') : ?>
            <img class="h-8 w-auto" src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr(alumax_site('brand_name')); ?>">
            <?php else : ?>
            <svg class="h-8 w-8 text-secondary-fixed" fill="currentColor" viewBox="0 0 40 40">
              <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="currentColor" stroke-linejoin="round"
                stroke-width="3.5"></path>
              <path d="M20 14L28 30H12L20 14Z" fill="currentColor" fill-opacity="0.85"></path>
              <line stroke="#ffffff" stroke-width="2" x1="8" x2="32" y1="26" y2="26"></line>
            </svg>
            <?php endif; ?>
            <span class="font-headline-sm text-headline-sm uppercase tracking-tight text-white font-bold"><?php echo esc_html(alumax_site('brand_name')); ?></span>
          </div>
          <p class="font-body-md text-body-md text-slate-300 max-w-md">
            <?php echo esc_html(alumax_site('brand_summary')); ?>
          </p>
          <!-- Social Media Icons for International B2B Reach -->
          <div class="space-y-2 pt-2">
            <span
              class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider block font-semibold">Global
              Social &amp; Project Channels</span>
            <div class="flex items-center gap-2">
              <?php foreach ((array) alumax_site('socials') as $social) :
                  $social_label = isset($social['label']) ? $social['label'] : '';
                  $social_image = isset($social['image']) ? $social['image'] : '';
                  $social_url   = isset($social['url']) ? $social['url'] : '';
                  if ($social_url === '' || $social_label === '' || $social_image === '') {
                      continue;
                  }
                  ?>
              <a aria-label="<?php echo esc_attr('ALUMAX on ' . $social_label); ?>"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-secondary border border-white/15 flex items-center justify-center text-white transition-all hover:scale-105 group"
                href="<?php echo esc_url($social_url); ?>" title="<?php echo esc_attr($social_label); ?>">
                <img src="<?php echo esc_url($social_image); ?>" alt="<?php echo esc_attr($social_label); ?>"
                  class="w-5 h-5 object-contain">
              </a>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="flex flex-wrap gap-space-sm pt-space-xs">
            <?php foreach ((array) alumax_site('certs') as $cert) :
                $cert_image = isset($cert['image']) ? $cert['image'] : '';
                $cert_text  = isset($cert['text']) ? $cert['text'] : '';
                if ($cert_text === '') {
                    continue;
                }
                ?>
            <span
              class="inline-flex items-center gap-1.5 font-label-sm text-label-sm px-space-sm py-space-xs bg-white/10 text-white uppercase rounded">
              <?php if ($cert_image !== '') : ?>
              <img src="<?php echo esc_url($cert_image); ?>" alt="" class="h-3.5 w-auto">
              <?php endif; ?>
              <?php echo esc_html($cert_text); ?>
            </span>
            <?php endforeach; ?>
          </div>
        </div>
        <!-- Col 3: Products（自动读取最新 10 个产品） -->
        <div class="space-y-space-md">
          <div class="font-headline-sm text-headline-sm text-white uppercase font-bold">Products</div>
          <ul class="space-y-space-xs">
            <?php
            $footer_products = get_posts(['post_type' => 'product', 'posts_per_page' => 10, 'post_status' => 'publish']);
            foreach ($footer_products as $footer_product) :
                ?>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_permalink($footer_product)); ?>"><?php echo esc_html(get_the_title($footer_product)); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <!-- Col 4: Projects（自动读取最新 10 个项目） -->
        <div class="space-y-space-md">
          <div class="font-headline-sm text-headline-sm text-white uppercase font-bold">Projects</div>
          <ul class="space-y-space-xs">
            <?php
            $footer_cases = get_posts(['post_type' => 'case', 'posts_per_page' => 10, 'post_status' => 'publish']);
            foreach ($footer_cases as $footer_case) :
                ?>
            <li class="font-body-sm text-body-sm text-slate-300"><a class="hover:text-white transition-colors"
                href="<?php echo esc_url(get_permalink($footer_case)); ?>"><?php echo esc_html(get_the_title($footer_case)); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <!-- Col 5: Global Headquarters（信息在「站点设置」编辑） -->
        <div class="space-y-space-md">
          <div class="font-headline-sm text-headline-sm text-white uppercase font-bold"><?php echo esc_html(alumax_site('hq_title')); ?></div>
          <p class="font-body-sm text-body-sm text-slate-300"><?php echo esc_html(alumax_site('hq_desc')); ?></p>
          <div class="font-label-sm text-label-sm space-y-space-xs text-slate-300">
            <?php for ($i = 1; $i <= 3; $i++) :
                $hq_icon = alumax_site("hq_row{$i}_icon");
                $hq_text = alumax_site("hq_row{$i}_text");
                if ($hq_text === '') {
                    continue;
                }
                ?>
            <p class="flex items-start gap-2">
              <?php if ($hq_icon !== '') : ?>
              <span class="material-symbols-outlined text-base text-secondary-fixed shrink-0"><?php echo esc_html($hq_icon); ?></span>
              <?php endif; ?>
              <span><?php echo esc_html($hq_text); ?></span>
            </p>
            <?php endfor; ?>
          </div>
          <div class="pt-space-xs">
            <a class="inline-block font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed hover:text-white transition-colors"
              href="<?php echo esc_url(alumax_site('hq_link_url') !== '' ? alumax_site('hq_link_url') : home_url('/contact/')); ?>">
              <?php echo esc_html(alumax_site('hq_link_text')); ?>
            </a>
          </div>
        </div>
      </div>
      <!-- Bottom Legal & Copyright -->
      <div
        class="pt-space-lg border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-space-md">
        <p class="font-label-sm text-label-sm text-slate-400"><?php echo esc_html(str_replace('{year}', gmdate('Y'), alumax_site('copyright_text'))); ?></p>
        <div class="flex items-center gap-space-lg font-label-sm text-label-sm text-slate-400">
          <?php
          $legal_pages = [
              'privacy-policy'     => 'Privacy Policy',
              'export-compliance'  => 'Export Compliance & Certifications',
              'terms-of-supply'    => 'Terms of Supply',
          ];
          foreach ($legal_pages as $legal_slug => $legal_label) :
              $legal_page = get_page_by_path($legal_slug);
              $legal_url  = ($legal_page && $legal_page->post_status === 'publish') ? get_permalink($legal_page) : '#';
              ?>
          <a class="hover:text-white transition-colors" href="<?php echo esc_url($legal_url); ?>"><?php echo esc_html($legal_label); ?></a>
          <?php endforeach; ?>
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
