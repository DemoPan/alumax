<?php
if (!defined('ABSPATH')) { exit; }
get_header();

$alumax_paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
$alumax_year = isset($_GET['news_year']) ? absint($_GET['news_year']) : 0;

$alumax_query_args = [
    'post_type' => 'news',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'paged' => $alumax_paged,
];
if ($alumax_year) {
    $alumax_query_args['year'] = $alumax_year;
}

$alumax_news_query = new WP_Query($alumax_query_args);
$alumax_posts = $alumax_news_query->posts;

$alumax_archive_url = alumax_news_url();
$alumax_year_base_url = $alumax_archive_url;

$alumax_slides = array_values(array_filter(alumax_news_hero_slides(), function ($slide) {
    return $slide['title'] !== '';
}));

global $wpdb;
$alumax_years = $wpdb->get_col(
    "SELECT DISTINCT YEAR(post_date) FROM {$wpdb->posts}
     WHERE post_type = 'news' AND post_status = 'publish' AND YEAR(post_date) > 1970
     ORDER BY post_date DESC"
);

$alumax_terms = get_terms(['taxonomy' => 'news_category', 'hide_empty' => true]);
$alumax_total_news = (int) wp_count_posts('news')->publish;
$alumax_fallback_img = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKAOkBKrv6a2PFgXpQ1vnS8GEWLQixnUu8eLhG5dJV8FnRmKIHvP-6MonzL8nXwBm1SSeWUeLOPVGvaLBlJ2Y_LApkt-0X2WlPMIKukpBbrlX6neR94y8rZqqWHhGFILudwNzu6UHlRfaFfqiy96c1y6BVraP1211LTE1EWbT7t9m0rJOlX6IOoA0d6FRNT4vMrThBbABfBZEzmN73RGxplrvmnq5yBSwoWQPXeyL4sjLtDFgwiTJ1';
?>
  <main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
    <div class="flex flex-col w-full">

      <!-- HERO -->
      <?php $hero_bg = '/wp-content/uploads/alumax-site-2e42e7ec62.jpg'; ?>
      <section class="relative w-full -mt-20 pt-32 pb-12 bg-primary-container text-on-primary overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 z-0 bg-cover bg-center pointer-events-none"
          style="background-image: linear-gradient(to right, rgba(13, 27, 42, 0.94) 0%, rgba(13, 27, 42, 0.84) 60%, rgba(13, 27, 42, 0.92) 100%), url('<?php echo esc_url($hero_bg); ?>');"></div>
        <div class="absolute inset-0 opacity-20 pointer-events-none mix-blend-screen"
          style="background-image: radial-gradient(#d6e4f9 1px, transparent 1px); background-size: 32px 32px;"></div>
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin relative z-10 space-y-6">
          <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'News', 'archive_url' => alumax_news_url(), 'current' => '']); ?>
          <div class="space-y-4 max-w-4xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-tertiary-container/80 backdrop-blur-md border border-on-tertiary-fixed-variant font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed-dim">
              <span class="material-symbols-outlined text-[15px]">newspaper</span>
              <span><?php echo esc_html(alumax_news_page('archive_eyebrow') ?: 'Architectural Dispatch & Media Hub'); ?></span>
            </div>
            <h1 class="font-display-xl text-display-xl text-white tracking-tight font-bold">
              <?php echo esc_html(alumax_news_page('archive_title') ?: 'News, Global Exhibitions & Media Center'); ?>
            </h1>
            <p class="font-body-md text-body-md text-primary-fixed-dim max-w-3xl leading-relaxed">
              <?php echo esc_html(alumax_news_page('archive_intro') ?: 'Latest Architectural Innovations, Global Trade Exhibitions, Landmark Project Completions, and Industry Insights engineered for facades that define skyline identity.'); ?>
            </p>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-3 bg-white/5 backdrop-blur-md border border-white/10 p-4 mt-6 md:mt-8">
            <div class="p-3 border-l-2 border-secondary">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-slate-400 block">Published Releases</span>
              <div class="font-headline-lg text-headline-lg text-white tracking-tight mt-1"><?php echo esc_html($alumax_total_news); ?>+ <span class="font-label-md text-label-md text-secondary-fixed">Articles</span></div>
              <p class="font-body-sm text-body-sm text-slate-400 mt-1">Global technical &amp; media dispatches</p>
            </div>
            <div class="p-3 border-l-2 border-white/40">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-slate-400 block">International Expos</span>
              <div class="font-headline-lg text-headline-lg text-white tracking-tight mt-1">12+ <span class="font-label-md text-label-md text-secondary-fixed">Regions</span></div>
              <p class="font-body-sm text-body-sm text-slate-400 mt-1">Big 5 Dubai, Riyadh, BAU Munich</p>
            </div>
            <div class="p-3 border-l-2 border-secondary">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-slate-400 block">Compliance Reports</span>
              <div class="font-headline-lg text-headline-lg text-white tracking-tight mt-1">A2-s1,d0</div>
              <p class="font-body-sm text-body-sm text-slate-400 mt-1">ASTM E84 &amp; EN 13501-1 fire dossiers</p>
            </div>
            <div class="p-3 border-l-2 border-white/40">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-slate-400 block">Press Inquiries</span>
              <div class="font-headline-lg text-headline-lg text-white tracking-tight mt-1">24h SLA</div>
              <p class="font-body-sm text-body-sm text-slate-400 mt-1">Dedicated architecture media desk</p>
            </div>
          </div>
        </div>
      </section>
    <!-- ======================================================================= -->
    <!-- 3. NEWS ARTICLES DISPLAY SECTION WITH TOP CONTROL TOOLBAR & VIEW TOGGLE -->
    <!-- ======================================================================= -->
    <section class="w-full max-w-[1440px] mx-auto px-margin-mobile md:px-margin py-16">
      <!-- Top Control Toolbar -->
      <div class="space-y-6 pb-8 border-b border-surface-container-high mb-10">
        <!-- Header Title & Telemetry -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
          <div>
            <div class="flex items-center gap-2 font-label text-[11px] text-secondary uppercase tracking-widest mb-1">
              <span><?php echo esc_html(alumax_news_page('archive_eyebrow')); ?></span>
              <span>•</span>
              <span>Total <?php echo esc_html($alumax_news_query->found_posts); ?> Releases</span>
            </div>
            <h2 class="font-headline text-[28px] sm:text-[34px] font-bold text-on-surface tracking-tight">
              <?php echo esc_html(alumax_news_page('archive_title')); ?>
            </h2>
          </div>
          <!-- View Switcher (Card View vs List View) & Year Filter -->
          <div class="flex flex-wrap items-center gap-3">
            <!-- Year Filter -->
            <?php if (!empty($alumax_years)) : ?>
            <select
              class="h-10 pl-3 pr-8 bg-surface-container-lowest border border-outline-variant font-label text-[12px] text-on-surface focus:outline-none focus:border-secondary"
              id="news-year-select"
              onchange="if (this.value) { window.location.href = this.value; }">
              <option data-year="" value="<?php echo esc_url($alumax_year_base_url); ?>" <?php selected($alumax_year, 0); ?>>All Years</option>
              <?php foreach ($alumax_years as $alumax_y) : ?>
              <option data-year="<?php echo esc_attr($alumax_y); ?>" value="<?php echo esc_url(add_query_arg('news_year', $alumax_y, $alumax_year_base_url)); ?>" <?php selected($alumax_year, (int) $alumax_y); ?>><?php echo esc_html($alumax_y); ?></option>
              <?php endforeach; ?>
            </select>
            <?php endif; ?>
            <!-- VIEW TOGGLE BUTTONS (CRITICAL REQUIREMENT) -->
            <div class="flex items-center bg-surface-container-high p-1 border border-outline-variant/60">
              <button
                class="view-toggle-btn active flex items-center gap-1.5 px-3 py-1.5 bg-surface-container-lowest text-on-surface shadow-sm font-label text-[12px] font-semibold transition-all"
                id="btn-card-view" title="Switch to Card View">
                <span class="material-symbols-outlined text-[16px] text-secondary">grid_view</span>
                <span class="hidden sm:inline">Card View</span>
              </button>
              <button
                class="view-toggle-btn flex items-center gap-1.5 px-3 py-1.5 text-on-surface-variant hover:text-on-surface font-label text-[12px] transition-all"
                id="btn-list-view" title="Switch to List View">
                <span class="material-symbols-outlined text-[16px]">view_list</span>
                <span class="hidden sm:inline">List View</span>
              </button>
            </div>
          </div>
        </div>
        <!-- Category Tabs -->
        <div class="flex flex-wrap items-center gap-2 overflow-x-auto" id="filter-container">
          <button
            class="filter-tab active px-4 py-2 bg-primary text-white font-label text-[12px] uppercase tracking-wider font-semibold shadow-sm transition-colors"
            data-cat="all">
            All News (<?php echo esc_html($alumax_total_news); ?>)
          </button>
          <?php if (!is_wp_error($alumax_terms)) : ?>
            <?php foreach ($alumax_terms as $alumax_term) : ?>
          <button
            class="filter-tab px-4 py-2 bg-surface-container-high hover:bg-surface-container-highest text-on-surface-variant hover:text-on-surface font-label text-[12px] uppercase tracking-wider transition-colors"
            data-cat="<?php echo esc_attr($alumax_term->slug); ?>">
            <?php echo esc_html($alumax_term->name); ?>
          </button>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
      <!-- ===================================================================== -->
      <!-- VIEW MODE A: CARD VIEW (GRID VIEW - 3 COLUMNS)                        -->
      <!-- ===================================================================== -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter" id="news-card-view-container">
        <?php if (!empty($alumax_posts)) : ?>
          <?php foreach ($alumax_posts as $alumax_post) :
              $alumax_pid = $alumax_post->ID;
              $alumax_term = alumax_news_primary_term($alumax_pid);
              $alumax_cat_slug = $alumax_term ? $alumax_term->slug : 'all';
              $alumax_thumb = get_the_post_thumbnail_url($alumax_pid, 'large') ?: $alumax_fallback_img;
              $alumax_location = get_post_meta($alumax_pid, 'location', true);
              $alumax_permalink = get_permalink($alumax_pid);
              ?>
          <article
            class="news-item flex flex-col bg-surface-container-lowest border border-surface-container-high hover:border-secondary/40 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group"
            data-category="<?php echo esc_attr($alumax_cat_slug); ?>"
            data-year="<?php echo esc_attr(get_the_date('Y', $alumax_pid)); ?>">
            <div class="relative h-60 overflow-hidden bg-primary-container">
              <img alt="<?php echo esc_attr(get_the_title($alumax_pid)); ?>"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                src="<?php echo esc_url($alumax_thumb); ?>" />
              <?php if ($alumax_term) : ?>
              <div class="absolute top-4 left-4">
                <span
                  class="px-2.5 py-1 bg-surface-container-lowest/95 backdrop-blur text-on-surface font-label text-[11px] uppercase tracking-wider font-semibold">
                  <?php echo esc_html($alumax_term->name); ?>
                </span>
              </div>
              <?php endif; ?>
              <?php if ($alumax_location) : ?>
              <div
                class="absolute bottom-3 right-3 px-2 py-0.5 bg-primary-container/85 text-surface-bright font-label text-[11px]">
                <?php echo esc_html($alumax_location); ?>
              </div>
              <?php endif; ?>
            </div>
            <div class="p-6 flex flex-col flex-1 justify-between">
              <div>
                <div class="flex items-center gap-3 font-label text-[12px] text-on-surface-variant mb-3">
                  <span class="flex items-center gap-1"><span
                      class="material-symbols-outlined text-[14px] text-secondary">calendar_today</span>
                    <?php echo esc_html(get_the_date('M j, Y', $alumax_pid)); ?></span>
                  <span>•</span>
                  <span><?php echo esc_html(alumax_reading_time($alumax_pid)); ?></span>
                </div>
                <h3
                  class="font-headline text-[18px] leading-snug text-on-surface font-semibold mb-3 group-hover:text-secondary transition-colors line-clamp-2">
                  <a href="<?php echo esc_url($alumax_permalink); ?>"><?php echo esc_html(get_the_title($alumax_pid)); ?></a>
                </h3>
                <p class="font-body text-[13px] text-on-surface-variant line-clamp-2 mb-6 leading-relaxed">
                  <?php echo esc_html(wp_trim_words(wp_strip_all_tags($alumax_post->post_excerpt ?: $alumax_post->post_content), 30)); ?>
                </p>
              </div>
              <div class="pt-4 border-t border-surface-container-high flex items-center justify-between">
                <span class="font-label text-[11px] text-on-surface-variant uppercase font-medium">Dispatch //
                  N-<?php echo esc_html($alumax_pid); ?></span>
                <a href="<?php echo esc_url($alumax_permalink); ?>"
                  class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#0d1b2a] hover:bg-secondary text-white font-label text-[12px] uppercase font-semibold transition-colors">
                  <span>View Details</span>
                  <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        <?php else : ?>
          <p class="col-span-full font-body text-[15px] text-on-surface-variant text-center py-16">
            <?php esc_html_e('No news items found. Please check back soon.', 'alumax'); ?>
          </p>
        <?php endif; ?>
      </div>
      <!-- ===================================================================== -->
      <!-- VIEW MODE B: LIST VIEW (HORIZONTAL SLEEK ROWS - TOGGLED VIA JS)       -->
      <!-- ===================================================================== -->
      <div class="hidden flex-col gap-4" id="news-list-view-container">
        <?php foreach ($alumax_posts as $alumax_post) :
            $alumax_pid = $alumax_post->ID;
            $alumax_term = alumax_news_primary_term($alumax_pid);
            $alumax_cat_slug = $alumax_term ? $alumax_term->slug : 'all';
            $alumax_thumb = get_the_post_thumbnail_url($alumax_pid, 'large') ?: $alumax_fallback_img;
            $alumax_location = get_post_meta($alumax_pid, 'location', true);
            $alumax_permalink = get_permalink($alumax_pid);
            $alumax_tags = get_the_terms($alumax_pid, 'news_tag');
            ?>
        <article
          class="news-list-item bg-surface-container-lowest border border-surface-container-high hover:border-secondary/50 p-5 md:p-6 shadow-sm hover:shadow-lg transition-all duration-300 group"
          data-category="<?php echo esc_attr($alumax_cat_slug); ?>"
          data-year="<?php echo esc_attr(get_the_date('Y', $alumax_pid)); ?>">
          <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
            <!-- 16:9 Thumbnail -->
            <div class="md:col-span-4 lg:col-span-3 relative aspect-[16/10] overflow-hidden bg-primary-container">
              <img alt="<?php echo esc_attr(get_the_title($alumax_pid)); ?>"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                src="<?php echo esc_url($alumax_thumb); ?>" />
              <?php if ($alumax_term) : ?>
              <div class="absolute top-2 left-2 px-2 py-0.5 bg-black/80 text-white font-label text-[10px] uppercase">
                <?php echo esc_html($alumax_term->name); ?>
              </div>
              <?php endif; ?>
            </div>
            <!-- Info & Excerpt -->
            <div class="md:col-span-5 lg:col-span-6 space-y-2">
              <div class="flex flex-wrap items-center gap-3 font-label text-[11px] text-on-surface-variant">
                <span class="text-secondary font-semibold"><?php echo esc_html(get_the_date('M j, Y', $alumax_pid)); ?></span>
                <span>•</span>
                <span><?php echo esc_html(alumax_reading_time($alumax_pid)); ?></span>
                <?php if ($alumax_location) : ?>
                <span>•</span>
                <span class="px-2 py-0.5 bg-surface-container-high text-on-surface"><?php echo esc_html($alumax_location); ?></span>
                <?php endif; ?>
              </div>
              <h3
                class="font-headline text-[18px] sm:text-[20px] font-bold text-on-surface group-hover:text-secondary transition-colors">
                <a href="<?php echo esc_url($alumax_permalink); ?>"><?php echo esc_html(get_the_title($alumax_pid)); ?></a>
              </h3>
              <p class="font-body text-[13px] text-on-surface-variant line-clamp-2 leading-relaxed">
                <?php echo esc_html(wp_trim_words(wp_strip_all_tags($alumax_post->post_excerpt ?: $alumax_post->post_content), 36)); ?>
              </p>
              <?php if ($alumax_tags && !is_wp_error($alumax_tags)) : ?>
              <div class="flex flex-wrap gap-2 pt-1">
                <?php foreach ($alumax_tags as $alumax_tag) : ?>
                <span class="font-label text-[10px] px-2 py-0.5 bg-surface-container text-on-surface-variant"><?php echo esc_html($alumax_tag->name); ?></span>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
            <!-- Right CTA Button -->
            <div class="md:col-span-3 lg:col-span-3 flex md:justify-end">
              <a href="<?php echo esc_url($alumax_permalink); ?>"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 h-11 px-6 bg-[#0d1b2a] group-hover:bg-secondary text-white font-label text-[12px] uppercase font-semibold tracking-wider transition-colors shadow-sm">
                <span>View Details</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
      <!-- Pagination Footer -->
      <?php
      $alumax_page_links = paginate_links([
          'total' => $alumax_news_query->max_num_pages,
          'current' => $alumax_paged,
          'type' => 'array',
          'prev_text' => '<span class="material-symbols-outlined text-[16px]">chevron_left</span>',
          'next_text' => '<span class="material-symbols-outlined text-[16px]">chevron_right</span>',
          'add_args' => array_filter([
              'news_year' => $alumax_year ?: null,
          ]),
      ]);
      ?>
      <div
        class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 bg-surface-container-low p-4 border border-surface-container-high">
        <div class="font-label text-[12px] text-on-surface-variant">
          Displaying <strong><?php echo esc_html(count($alumax_posts)); ?></strong> of
          <strong><?php echo esc_html($alumax_news_query->found_posts); ?></strong> published architectural releases &amp;
          dispatches
        </div>
        <?php if (!empty($alumax_page_links)) : ?>
        <div class="news-pagination flex items-center gap-2">
          <?php foreach ($alumax_page_links as $alumax_link) : ?>
            <?php echo wp_kses_post($alumax_link); ?>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <style>
        .news-pagination .page-numbers {
          display: flex;
          align-items: center;
          justify-content: center;
          min-width: 2.25rem;
          height: 2.25rem;
          padding: 0 0.25rem;
          font-family: 'JetBrains Mono', monospace;
          font-size: 12px;
          background: #ffffff;
          color: #191c1e;
          border: 1px solid rgba(196, 198, 204, 0.5);
          transition: all 0.15s;
        }
        .news-pagination a.page-numbers:hover {
          background: #e6e8ea;
        }
        .news-pagination a.page-numbers.prev:hover,
        .news-pagination a.page-numbers.next:hover {
          background: #7b5825;
          color: #ffffff;
        }
        .news-pagination .page-numbers.current {
          background: #0d1b2a;
          color: #ffffff;
          font-weight: 600;
          border-color: #0d1b2a;
        }
        .news-pagination .page-numbers.dots {
          background: transparent;
          border-color: transparent;
        }
      </style>
    </section>

  <!-- ========================================================================= -->
  <!-- NEWSLETTER SIGNUP ( → ，)     -->
  <!-- ========================================================================= -->
  <?php if (alumax_news_page('newsletter_title') !== '') : ?>
    <section class="w-full bg-[#0a0d12] text-white py-16 lg:py-20 relative overflow-hidden">
      <div class="max-w-4xl mx-auto px-margin-mobile md:px-margin text-center space-y-6">
        <h2 class="font-headline text-2xl sm:text-3xl font-bold tracking-tight"><?php echo esc_html(alumax_news_page('newsletter_title')); ?></h2>
        <p class="font-body text-sm text-slate-400"><?php echo esc_html(alumax_news_page('newsletter_desc')); ?></p>
        <form id="alumax-newsletter-form" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
          <input type="email" name="email" required placeholder="name@company.com" class="flex-1 h-12 px-4 bg-white/10 border border-white/20 text-white placeholder:text-slate-500 font-body text-sm focus:outline-none focus:border-secondary-fixed">
          <button type="submit" class="h-12 px-6 bg-secondary text-on-primary font-label text-sm font-semibold uppercase tracking-wider hover:bg-secondary-fixed-dim transition-colors flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[18px]">send</span><?php echo esc_html(alumax_news_page('newsletter_button')); ?>
          </button>
        </form>
        <p id="alumax-newsletter-msg" class="font-label text-[11px] text-slate-500"><?php echo esc_html(alumax_news_page('newsletter_note')); ?></p>
      </div>
    </section>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('alumax-newsletter-form');
        if (!form) return;
        form.addEventListener('submit', function (e) {
          e.preventDefault();
          var email = form.querySelector('input[name="email"]').value.trim();
          var msg = document.getElementById('alumax-newsletter-msg');
          var btn = form.querySelector('button[type="submit"]');
          btn.disabled = true;
          var body = new FormData();
          body.append('inquiry_name', 'Newsletter Subscriber');
          body.append('inquiry_email', email);
          body.append('inquiry_page', 'Newsletter Signup');
          fetch('<?php echo esc_url(rest_url('alumax/v1/inquiry')); ?>', { method: 'POST', body: body })
            .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, data: d }; }); })
            .then(function (res) {
              if (res.ok && res.data && res.data.success) {
                form.innerHTML = '<p class="font-body text-sm text-secondary-fixed py-3">Thank you! You have been subscribed successfully.</p>';
                msg.textContent = '';
              } else {
                btn.disabled = false;
                msg.textContent = 'Subscription failed. Please try again.';
                msg.classList.remove('text-slate-500');
                msg.classList.add('text-red-400');
              }
            })
            .catch(function () {
              btn.disabled = false;
              msg.textContent = 'Network error. Please try again.';
              msg.classList.remove('text-slate-500');
              msg.classList.add('text-red-400');
            });
        });
      });
    </script>
  <?php endif; ?>

  <!-- ========================================================================= -->
  <!-- INTERACTIVE VANILLA JAVASCRIPT: CAROUSEL & VIEW TOGGLE (CARD / LIST)       -->
  <!-- ========================================================================= -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // -------------------------------------------------------------
      // 1. CAROUSEL SLIDER ENGINE
      // -------------------------------------------------------------
      const slides = document.querySelectorAll('.carousel-slide');
      const tabs = document.querySelectorAll('.carousel-tab-btn');
      const prevBtn = document.getElementById('carousel-prev-btn');
      const nextBtn = document.getElementById('carousel-next-btn');
      const counter = document.getElementById('carousel-counter');
      let currentSlide = 0;
      let autoPlayInterval = null;

      function goToSlide(index) {
        if (!slides.length) return;
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;

        slides.forEach((slide, i) => {
          if (i === index) {
            slide.classList.remove('opacity-0', 'z-10');
            slide.classList.add('opacity-100', 'z-20');
          } else {
            slide.classList.remove('opacity-100', 'z-20');
            slide.classList.add('opacity-0', 'z-10');
          }
        });

        tabs.forEach((tab, i) => {
          if (i === index) {
            tab.classList.add('active', 'border-secondary', 'text-secondary-fixed');
            tab.classList.remove('border-transparent', 'text-slate-400');
          } else {
            tab.classList.remove('active', 'border-secondary', 'text-secondary-fixed');
            tab.classList.add('border-transparent', 'text-slate-400');
          }
        });

        if (counter) {
          counter.textContent = `0${index + 1} / 0${slides.length}`;
        }
        currentSlide = index;
      }

      function nextSlide() {
        goToSlide(currentSlide + 1);
      }

      function prevSlide() {
        goToSlide(currentSlide - 1);
      }

      function startTimer() {
        autoPlayInterval = setInterval(nextSlide, 6500);
      }

      function resetTimer() {
        clearInterval(autoPlayInterval);
        startTimer();
      }

      if (slides.length) {
        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetTimer(); });
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetTimer(); });

        tabs.forEach((tab) => {
          tab.addEventListener('click', () => {
            const target = parseInt(tab.getAttribute('data-target'), 10);
            goToSlide(target);
            resetTimer();
          });
        });

        startTimer();
      }

      // -------------------------------------------------------------
      // 2. VIEW SWITCHER (CARD VIEW vs LIST VIEW)
      // -------------------------------------------------------------
      const btnCardView = document.getElementById('btn-card-view');
      const btnListView = document.getElementById('btn-list-view');
      const cardContainer = document.getElementById('news-card-view-container');
      const listContainer = document.getElementById('news-list-view-container');

      function setViewMode(mode) {
        if (mode === 'card') {
          // Activate Card button
          btnCardView.classList.add('active', 'bg-surface-container-lowest', 'text-on-surface', 'shadow-sm', 'font-semibold');
          btnCardView.classList.remove('text-on-surface-variant');
          btnCardView.querySelector('.material-symbols-outlined').classList.add('text-secondary');

          // Deactivate List button
          btnListView.classList.remove('active', 'bg-surface-container-lowest', 'text-on-surface', 'shadow-sm', 'font-semibold');
          btnListView.classList.add('text-on-surface-variant');
          btnListView.querySelector('.material-symbols-outlined').classList.remove('text-secondary');

          // Toggle displays
          cardContainer.classList.remove('hidden');
          listContainer.classList.add('hidden');
        } else {
          // Activate List button
          btnListView.classList.add('active', 'bg-surface-container-lowest', 'text-on-surface', 'shadow-sm', 'font-semibold');
          btnListView.classList.remove('text-on-surface-variant');
          btnListView.querySelector('.material-symbols-outlined').classList.add('text-secondary');

          // Deactivate Card button
          btnCardView.classList.remove('active', 'bg-surface-container-lowest', 'text-on-surface', 'shadow-sm', 'font-semibold');
          btnCardView.classList.add('text-on-surface-variant');
          btnCardView.querySelector('.material-symbols-outlined').classList.remove('text-secondary');

          // Toggle displays
          cardContainer.classList.add('hidden');
          listContainer.classList.remove('hidden');
          listContainer.classList.add('flex');
        }
      }

      if (btnCardView && btnListView) {
        btnCardView.addEventListener('click', () => setViewMode('card'));
        btnListView.addEventListener('click', () => setViewMode('list'));
      }

      // -------------------------------------------------------------
      // 3. FILTERS: category tabs + year
      // ，，
      // （ JS  GET ）
      // -------------------------------------------------------------
      const filterTabs = document.querySelectorAll('.filter-tab');
      const cardItems = document.querySelectorAll('.news-item');
      const listItems = document.querySelectorAll('.news-list-item');
      const yearSelect = document.getElementById('news-year-select');

      const filterState = { cat: 'all', year: '' };

      function applyNewsFilters() {
        const matches = (el) => {
          const catOk = filterState.cat === 'all' || el.getAttribute('data-category') === filterState.cat;
          const yearOk = !filterState.year || el.getAttribute('data-year') === filterState.year;
          return catOk && yearOk;
        };
        cardItems.forEach((card) => { card.style.display = matches(card) ? 'flex' : 'none'; });
        listItems.forEach((item) => { item.style.display = matches(item) ? 'block' : 'none'; });
      }

      filterTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
          filterTabs.forEach((t) => {
            t.classList.remove('bg-primary', 'text-white', 'font-semibold');
            t.classList.add('bg-surface-container-high', 'text-on-surface-variant');
          });
          tab.classList.remove('bg-surface-container-high', 'text-on-surface-variant');
          tab.classList.add('bg-primary', 'text-white', 'font-semibold');

          filterState.cat = tab.getAttribute('data-cat');
          applyNewsFilters();
        });
      });

      if (yearSelect) {
        yearSelect.removeAttribute('onchange');
        yearSelect.addEventListener('change', () => {
          const opt = yearSelect.options[yearSelect.selectedIndex];
          filterState.year = opt ? (opt.getAttribute('data-year') || '') : '';
          applyNewsFilters();
        });
      }
    });
  </script>
    </div>
  </main>
<?php get_footer();
