<?php
if (!defined('ABSPATH')) {
    exit;
}

$nav_items = [
    ['label' => 'Home', 'url' => home_url('/'), 'active' => is_front_page()],
    ['label' => 'Products', 'url' => get_post_type_archive_link('product'), 'active' => is_post_type_archive('product') || is_singular('product')],
    ['label' => 'Projects', 'url' => get_post_type_archive_link('case'), 'active' => is_post_type_archive('case') || is_singular('case')],
    ['label' => 'About Us', 'url' => home_url('/about/'), 'active' => is_page('about')],
    ['label' => 'News', 'url' => alumax_news_url(), 'active' => is_post_type_archive('news') || is_singular('news') || is_tax(['news_category', 'news_tag'])],
    ['label' => 'Resources', 'url' => home_url('/resources/'), 'active' => is_page('resources')],
    ['label' => 'Contact', 'url' => home_url('/contact/'), 'active' => is_page('contact')],
];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.svg'); ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon-32x32.png'); ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon-16x16.png'); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/apple-touch-icon.png'); ?>">
  <link rel="manifest" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/site.webmanifest'); ?>">
  <link rel="shortcut icon" href="<?php echo esc_url(home_url('/favicon.ico')); ?>">
  <meta name="theme-color" content="#0d1b2a">
  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-surface font-body-md text-on-surface antialiased selection:bg-secondary selection:text-white'); ?>>
  <?php wp_body_open(); ?>
  <header
    class="fixed top-0 left-0 right-0 z-50 bg-[#0d1b2a]/95 backdrop-blur-xl border-b border-white/10 transition-all">
    <div
      class="h-20 max-w-[1440px] mx-auto px-margin-mobile md:px-margin flex items-center justify-between gap-space-lg">
      <!-- Clean geometric logo + Brand Name & Descriptor -->
      <div class="flex items-center">
        <a aria-label="Aluviona - Architectural Metal Solutions" class="flex items-center gap-3 group" href="<?php echo esc_url(home_url('/')); ?>">
          <svg class="h-9 w-9 text-secondary-fixed transition-transform duration-300 group-hover:scale-105 shrink-0"
            fill="currentColor" viewBox="0 0 40 40">
            <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="3.5">
            </path>
            <path d="M20 14L28 30H12L20 14Z" fill="currentColor" fill-opacity="0.85"></path>
            <line stroke="#ffffff" stroke-width="2" x1="8" x2="32" y1="26" y2="26"></line>
          </svg>
          <div class="flex flex-col justify-center">
            <span class="font-headline font-bold text-white tracking-wider text-[17px] uppercase leading-none">ALUVIONA</span>
            <span class="font-label text-[8px] text-secondary-fixed tracking-widest uppercase mt-1 leading-none">Architectural Metal Solutions</span>
          </div>
        </a>
      </div>
      <!-- Navigation links -->
      <nav class="hidden xl:flex items-center gap-space-lg">
        <?php foreach ($nav_items as $item) : ?>
        <a class="<?php echo esc_attr(alumax_nav_class($item['active'])); ?>"
          href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
        <?php endforeach; ?>
      </nav>
      <!-- Language Selector Dropdown & Mobile Menu Button -->
      <div class="flex items-center gap-2 sm:gap-3">
        <!-- Language Dropdown -->
        <div class="relative group py-2">
          <button
            class="flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/15 border border-white/15 font-label-sm text-label-sm text-white transition-all cursor-pointer"
            type="button"
            aria-label="Select language">
            <span class="material-symbols-outlined text-[16px] text-secondary-fixed">language</span>
            <span class="font-semibold tracking-wider text-secondary-fixed">EN</span>
            <span
              class="material-symbols-outlined text-sm text-slate-400 group-hover:text-white transition-transform group-hover:rotate-180">expand_more</span>
          </button>
          <div
            class="invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 absolute right-0 top-full mt-1 w-44 bg-[#0d1b2a] border border-white/15 rounded-xl shadow-2xl p-2 z-50 text-left backdrop-blur-xl">
            <a class="flex items-center justify-between px-3 py-2 rounded font-label-sm text-label-sm text-secondary-fixed bg-white/10 font-semibold"
              href="#">
              <span class="">English (EN)</span>
              <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
            </a>
            <a class="flex items-center justify-between px-3 py-2 rounded font-label-sm text-label-sm text-slate-300 hover:text-white hover:bg-white/5 transition-colors"
              href="#">
              <span class="">Español (ES)</span>
            </a>
            <a class="flex items-center justify-between px-3 py-2 rounded font-label-sm text-label-sm text-slate-300 hover:text-white hover:bg-white/5 transition-colors"
              href="#">
              <span class="">Français (FR)</span>
            </a>
            <a class="flex items-center justify-between px-3 py-2 rounded font-label-sm text-label-sm text-slate-300 hover:text-white hover:bg-white/5 transition-colors"
              href="#">
              <span class="">العربية (AR)</span>
            </a>
            <a class="flex items-center justify-between px-3 py-2 rounded font-label-sm text-label-sm text-slate-300 hover:text-white hover:bg-white/5 transition-colors"
              href="#">
              <span class="">Deutsch (DE)</span>
            </a>
          </div>
        </div>

        <!-- Mobile Menu Toggle Button (Visible on screens < xl) -->
        <button
          id="mobile-menu-toggle"
          class="xl:hidden flex items-center justify-center w-10 h-10 rounded-lg bg-white/10 hover:bg-white/15 border border-white/15 text-white transition-all cursor-pointer focus:outline-none focus:ring-2 focus:ring-secondary"
          type="button"
          aria-label="Toggle navigation menu"
          aria-expanded="false"
          aria-controls="mobile-menu-drawer">
          <span id="mobile-menu-icon" class="material-symbols-outlined text-2xl transition-transform duration-200">menu</span>
        </button>
      </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div
      id="mobile-menu-drawer"
      class="xl:hidden hidden border-t border-white/10 bg-[#0d1b2a]/98 backdrop-blur-2xl shadow-2xl transition-all duration-300 overflow-y-auto max-h-[calc(100vh-5rem)]">
      <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin py-5 space-y-5">
        <!-- Mobile Navigation Links -->
        <nav class="flex flex-col space-y-1" aria-label="Mobile Navigation">
          <?php foreach ($nav_items as $item) : ?>
          <a
            class="flex items-center justify-between px-4 py-3 rounded-lg font-label text-sm uppercase tracking-wider transition-colors <?php echo $item['active'] ? 'text-secondary-fixed bg-white/10 font-bold border-l-2 border-secondary pl-3.5' : 'text-slate-200 hover:text-white hover:bg-white/5'; ?>"
            href="<?php echo esc_url($item['url']); ?>">
            <span><?php echo esc_html($item['label']); ?></span>
            <span class="material-symbols-outlined text-sm opacity-50">chevron_right</span>
          </a>
          <?php endforeach; ?>
        </nav>

        <!-- Mobile Quick Contact & Inquiry CTA -->
        <div class="pt-4 border-t border-white/10 space-y-3">
          <a
            class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-secondary text-white font-label text-xs uppercase tracking-wider font-semibold rounded-lg hover:bg-secondary/90 transition-colors shadow-lg"
            href="<?php echo esc_url(home_url('/contact/')); ?>">
            <span class="material-symbols-outlined text-base">mail</span>
            <span>Request Project Consultation</span>
          </a>
          <div class="grid grid-cols-2 gap-2 text-xs font-label text-slate-300">
            <a
              class="flex items-center gap-2 p-2.5 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 transition-colors"
              href="tel:+8618930079759">
              <span class="material-symbols-outlined text-sm text-secondary-fixed">call</span>
              <span class="truncate">+86 18930079759</span>
            </a>
            <a
              class="flex items-center gap-2 p-2.5 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 transition-colors"
              href="mailto:sales@aluviona.com">
              <span class="material-symbols-outlined text-sm text-secondary-fixed">mail</span>
              <span class="truncate">sales@aluviona.com</span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Menu Interaction Script -->
    <script>
      (function () {
        var toggle = document.getElementById('mobile-menu-toggle');
        var drawer = document.getElementById('mobile-menu-drawer');
        var icon = document.getElementById('mobile-menu-icon');
        if (!toggle || !drawer || !icon) return;

        function setMenu(open) {
          if (open) {
            drawer.classList.remove('hidden');
            toggle.setAttribute('aria-expanded', 'true');
            icon.textContent = 'close';
            document.body.classList.add('overflow-hidden');
          } else {
            drawer.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
            icon.textContent = 'menu';
            document.body.classList.remove('overflow-hidden');
          }
        }

        toggle.addEventListener('click', function (e) {
          e.stopPropagation();
          var isExpanded = toggle.getAttribute('aria-expanded') === 'true';
          setMenu(!isExpanded);
        });

        drawer.querySelectorAll('a').forEach(function (link) {
          link.addEventListener('click', function () {
            setMenu(false);
          });
        });

        document.addEventListener('click', function (e) {
          if (toggle.getAttribute('aria-expanded') === 'true') {
            if (!drawer.contains(e.target) && !toggle.contains(e.target)) {
              setMenu(false);
            }
          }
        });

        document.addEventListener('keydown', function (e) {
          if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
            setMenu(false);
          }
        });

        window.addEventListener('resize', function () {
          if (window.innerWidth >= 1280 && toggle.getAttribute('aria-expanded') === 'true') {
            setMenu(false);
          }
        });
      })();
    </script>
    </div>
  </header>
