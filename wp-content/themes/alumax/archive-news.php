<?php
if (!defined('ABSPATH')) { exit; }
get_header();

$alumax_paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
$alumax_search = isset($_GET['news_search']) ? sanitize_text_field(wp_unslash($_GET['news_search'])) : '';
$alumax_year = isset($_GET['news_year']) ? absint($_GET['news_year']) : 0;

$alumax_query_args = [
    'post_type' => 'news',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'paged' => $alumax_paged,
];
if ($alumax_search !== '') {
    $alumax_query_args['s'] = $alumax_search;
}
if ($alumax_year) {
    $alumax_query_args['year'] = $alumax_year;
}

$alumax_news_query = new WP_Query($alumax_query_args);
$alumax_posts = $alumax_news_query->posts;

$alumax_archive_url = alumax_news_url();
$alumax_year_base_url = $alumax_search !== '' ? add_query_arg('news_search', $alumax_search, $alumax_archive_url) : $alumax_archive_url;

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
    <?php if (!empty($alumax_slides)) : ?>
    <!-- ======================================================================= -->
    <!-- 2. HERO SECTION - FULL-SCREEN HIGH-IMPACT CAROUSEL / SLIDER             -->
    <!-- ======================================================================= -->
    <section class="relative w-full h-[620px] bg-[#0d1b2a] text-white overflow-hidden select-none" id="hero-carousel">
      <!-- Radial grid background pattern -->
      <div
        class="absolute inset-0 opacity-10 bg-[radial-gradient(#edbe82_1px,transparent_1px)] [background-size:28px_28px] pointer-events-none z-10">
      </div>
      <!-- Slide Items Wrapper -->
      <div class="relative w-full h-full" id="slides-wrapper">
        <?php foreach ($alumax_slides as $alumax_i => $alumax_slide) : ?>
        <div
          class="carousel-slide <?php echo $alumax_i === 0 ? 'active opacity-100 z-20' : 'opacity-0 z-10'; ?> absolute inset-0 transition-opacity duration-700 ease-in-out flex flex-col justify-between"
          data-slide-index="<?php echo esc_attr($alumax_i); ?>">
          <?php if ($alumax_slide['image']) : ?>
          <div class="absolute inset-0 z-0">
            <img alt="<?php echo esc_attr($alumax_slide['title']); ?>" class="w-full h-full object-cover"
              src="<?php echo esc_url($alumax_slide['image']); ?>" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#0d1b2a] via-[#0d1b2a]/75 to-[#0d1b2a]/50"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0d1b2a] via-[#0d1b2a]/80 to-transparent"></div>
          </div>
          <?php endif; ?>
          <!-- Slide Top Telemetry -->
          <div class="relative z-30 max-w-[1440px] w-full mx-auto px-margin-mobile md:px-margin pt-8">
            <div
              class="flex flex-wrap items-center justify-between gap-4 font-label text-[11px] pb-4 border-b border-white/10 text-[#c4c6cc]">
              <div class="flex items-center gap-3">
                <span
                  class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-secondary-fixed-dim animate-pulse"></span>
                <span class="text-secondary-fixed uppercase tracking-widest font-semibold"><?php echo esc_html($alumax_slide['kicker']); ?></span>
              </div>
            </div>
          </div>
          <!-- Slide Content Center -->
          <div class="relative z-30 max-w-[1440px] w-full mx-auto px-margin-mobile md:px-margin my-auto pb-4">
            <div class="max-w-3xl space-y-4">
              <div class="flex items-center gap-2.5">
                <?php if ($alumax_slide['badge']) : ?>
                <span
                  class="px-3 py-1 bg-secondary text-white font-label text-[11px] font-semibold uppercase tracking-wider">
                  <?php echo esc_html($alumax_slide['badge']); ?>
                </span>
                <?php endif; ?>
                <?php if ($alumax_slide['post_id']) : ?>
                <span
                  class="px-2.5 py-1 bg-white/10 text-secondary-fixed backdrop-blur-md font-label text-[11px] uppercase tracking-wider">
                  <?php echo esc_html(get_the_date('M j, Y', $alumax_slide['post_id']) . ' · ' . alumax_reading_time($alumax_slide['post_id'])); ?>
                </span>
                <?php endif; ?>
              </div>
              <h1
                class="font-headline text-[32px] sm:text-[44px] lg:text-[48px] font-bold text-white tracking-tight leading-tight">
                <?php echo esc_html($alumax_slide['title']); ?>
              </h1>
              <?php if ($alumax_slide['description']) : ?>
              <p class="font-body text-[15px] sm:text-[17px] text-slate-300 leading-relaxed max-w-2xl">
                <?php echo esc_html($alumax_slide['description']); ?>
              </p>
              <?php endif; ?>
              <div class="pt-3 flex flex-wrap items-center gap-4">
                <?php if ($alumax_slide['url']) : ?>
                <a href="<?php echo esc_url($alumax_slide['url']); ?>"
                  class="inline-flex items-center justify-center gap-2 h-12 px-7 bg-[#b88e56] hover:bg-[#edbe82] text-[#0f1c2c] font-headline text-[14px] uppercase tracking-wider font-semibold transition-colors">
                  <span>View Details</span>
                  <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </a>
                <?php endif; ?>
                <?php if ($alumax_slide['location']) : ?>
                <div
                  class="hidden md:flex items-center gap-2 px-4 py-2.5 bg-[#021d35]/80 border border-[#324863] text-slate-300 font-label text-[12px]">
                  <span class="material-symbols-outlined text-[16px] text-secondary-fixed">pin_drop</span>
                  <span><?php echo esc_html($alumax_slide['location']); ?></span>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- Spacer for bottom progress bar -->
          <div class="h-16"></div>
        </div>
        <?php endforeach; ?>
      </div>
      <!-- Carousel Navigation & Indicators Bottom Bar -->
      <div class="absolute bottom-0 left-0 right-0 z-40 bg-[#0a1520]/80 backdrop-blur-md border-t border-white/10 py-3">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin flex items-center justify-between gap-4">
          <!-- Slide Switcher Tabs -->
          <div class="flex items-center gap-2 sm:gap-4 overflow-x-auto" id="carousel-tab-nav">
            <?php foreach ($alumax_slides as $alumax_i => $alumax_slide) : ?>
            <button
              class="carousel-tab-btn <?php echo $alumax_i === 0 ? 'active border-secondary text-secondary-fixed' : 'border-transparent text-slate-400 hover:text-white'; ?> px-3 py-1.5 flex items-center gap-2 text-left border-b-2 font-label text-[12px]"
              data-target="<?php echo esc_attr($alumax_i); ?>">
              <span class="font-bold"><?php echo esc_html(str_pad((string) ($alumax_i + 1), 2, '0', STR_PAD_LEFT)); ?></span>
              <span class="hidden sm:inline font-medium uppercase truncate max-w-[200px]"><?php echo esc_html($alumax_slide['tab'] ?: $alumax_slide['title']); ?></span>
            </button>
            <?php endforeach; ?>
          </div>
          <!-- Slide Controls Prev/Next -->
          <div class="flex items-center gap-2">
            <button aria-label="Previous Slide"
              class="w-9 h-9 border border-[#324863] bg-[#021d35] hover:bg-[#b88e56] hover:text-[#0f1c2c] text-white flex items-center justify-center transition-colors"
              id="carousel-prev-btn">
              <span class="material-symbols-outlined text-[18px]">chevron_left</span>
            </button>
            <span class="font-label text-[11px] text-[#c4c6cc] px-1" id="carousel-counter">01 / <?php echo esc_html(str_pad((string) count($alumax_slides), 2, '0', STR_PAD_LEFT)); ?></span>
            <button aria-label="Next Slide"
              class="w-9 h-9 border border-[#324863] bg-[#021d35] hover:bg-[#b88e56] hover:text-[#0f1c2c] text-white flex items-center justify-center transition-colors"
              id="carousel-next-btn">
              <span class="material-symbols-outlined text-[18px]">chevron_right</span>
            </button>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>
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
              <span>02 / Editorial Archive</span>
              <span>•</span>
              <span>Total <?php echo esc_html($alumax_news_query->found_posts); ?> Releases</span>
            </div>
            <h2 class="font-headline text-[28px] sm:text-[34px] font-bold text-on-surface tracking-tight">
              Curated Architectural Dispatches
            </h2>
          </div>
          <!-- View Switcher (Card View vs List View) & Search -->
          <div class="flex flex-wrap items-center gap-3">
            <!-- Search Input -->
            <form class="relative w-full sm:w-64" method="get" action="<?php echo esc_url($alumax_archive_url); ?>">
              <input
                class="w-full h-10 pl-9 pr-3 bg-surface-container-lowest border border-outline-variant text-body text-[13px] text-on-surface placeholder:text-outline focus:outline-none focus:border-secondary"
                placeholder="Search news or alloy..." type="text" name="news_search"
                value="<?php echo esc_attr($alumax_search); ?>" />
              <?php if ($alumax_year) : ?>
              <input type="hidden" name="news_year" value="<?php echo esc_attr($alumax_year); ?>" />
              <?php endif; ?>
              <button type="submit" aria-label="Search"
                class="absolute left-0 top-0 w-9 h-10 flex items-center justify-center">
                <span class="material-symbols-outlined text-[18px] text-outline">search</span>
              </button>
            </form>
            <!-- Year Filter -->
            <?php if (!empty($alumax_years)) : ?>
            <select
              class="h-10 pl-3 pr-8 bg-surface-container-lowest border border-outline-variant font-label text-[12px] text-on-surface focus:outline-none focus:border-secondary"
              onchange="if (this.value) { window.location.href = this.value; }">
              <option value="<?php echo esc_url($alumax_year_base_url); ?>" <?php selected($alumax_year, 0); ?>>All Years</option>
              <?php foreach ($alumax_years as $alumax_y) : ?>
              <option value="<?php echo esc_url(add_query_arg('news_year', $alumax_y, $alumax_year_base_url)); ?>" <?php selected($alumax_year, (int) $alumax_y); ?>><?php echo esc_html($alumax_y); ?></option>
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
            data-category="<?php echo esc_attr($alumax_cat_slug); ?>">
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
          data-category="<?php echo esc_attr($alumax_cat_slug); ?>">
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
              'news_search' => $alumax_search !== '' ? $alumax_search : null,
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
      // 3. CATEGORY FILTER TABS
      // -------------------------------------------------------------
      const filterTabs = document.querySelectorAll('.filter-tab');
      const cardItems = document.querySelectorAll('.news-item');
      const listItems = document.querySelectorAll('.news-list-item');

      filterTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
          filterTabs.forEach((t) => {
            t.classList.remove('bg-primary', 'text-white', 'font-semibold');
            t.classList.add('bg-surface-container-high', 'text-on-surface-variant');
          });
          tab.classList.remove('bg-surface-container-high', 'text-on-surface-variant');
          tab.classList.add('bg-primary', 'text-white', 'font-semibold');

          const cat = tab.getAttribute('data-cat');

          // Filter card items
          cardItems.forEach((card) => {
            const cardCat = card.getAttribute('data-category');
            if (cat === 'all' || cardCat === cat) {
              card.style.display = 'flex';
            } else {
              card.style.display = 'none';
            }
          });

          // Filter list items
          listItems.forEach((item) => {
            const itemCat = item.getAttribute('data-category');
            if (cat === 'all' || itemCat === cat) {
              item.style.display = 'block';
            } else {
              item.style.display = 'none';
            }
          });
        });
      });
    });
  </script>
  </main>
<?php get_footer();
