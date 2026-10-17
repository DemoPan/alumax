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
  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-surface font-body-md text-on-surface antialiased selection:bg-secondary selection:text-white'); ?>>
  <?php wp_body_open(); ?>
  <header
    class="fixed top-0 left-0 right-0 z-50 bg-[#0d1b2a]/95 backdrop-blur-xl border-b border-white/10 transition-all">
    <div
      class="h-20 max-w-[1440px] mx-auto px-margin-mobile md:px-margin flex items-center justify-between gap-space-lg">
      <!-- Clean geometric logo only -->
      <div class="flex items-center">
        <a aria-label="ALUMAX Home" class="flex items-center group" href="<?php echo esc_url(home_url('/')); ?>">
          <svg class="h-9 w-9 text-secondary-fixed transition-transform duration-300 group-hover:scale-105"
            fill="currentColor" viewBox="0 0 40 40">
            <path d="M20 2L37 32H3L20 2Z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="3.5">
            </path>
            <path d="M20 14L28 30H12L20 14Z" fill="currentColor" fill-opacity="0.85"></path>
            <line stroke="#ffffff" stroke-width="2" x1="8" x2="32" y1="26" y2="26"></line>
          </svg>
        </a>
      </div>
      <!-- Navigation links -->
      <nav class="hidden xl:flex items-center gap-space-lg">
        <?php foreach ($nav_items as $item) : ?>
        <a class="<?php echo esc_attr(alumax_nav_class($item['active'])); ?>"
          href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
        <?php endforeach; ?>
      </nav>
      <!-- Language Selector Dropdown & Sample Box CTA -->
      <div class="flex items-center gap-3">
        <!-- Language Dropdown -->
        <div class="relative group py-2">
          <button
            class="flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/15 border border-white/15 font-label-sm text-label-sm text-white transition-all"
            type="button">
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
      </div>
    </div>
  </header>
