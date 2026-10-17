<?php
if (!defined('ABSPATH')) { exit; }
get_header();
while (have_posts()) : the_post();
    $alumax_pid = get_the_ID();
    $alumax_term = alumax_news_primary_term($alumax_pid);
    $alumax_author = get_the_author_meta('display_name');
    $alumax_author_parts = preg_split('/\s+/', trim($alumax_author));
    $alumax_initials = '';
    foreach (array_slice($alumax_author_parts, 0, 2) as $alumax_part) {
        $alumax_initials .= strtoupper(mb_substr($alumax_part, 0, 1));
    }
    $alumax_thumb_url = get_the_post_thumbnail_url($alumax_pid, 'large');
    $alumax_thumb_caption = get_the_post_thumbnail_caption($alumax_pid);
    $alumax_prev_post = get_previous_post();
    $alumax_next_post = get_next_post();
    $alumax_permalink = get_permalink();
?>
  <main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
    <div class="w-full">
      <!-- Sticky Reading Progress Bar -->
      <div
        class="sticky top-20 z-40 w-full bg-surface-container-lowest/80 backdrop-blur-md border-b border-surface-container">
        <div class="h-[2px] bg-secondary w-0 transition-all duration-150" id="read-progress"></div>
      </div>
      <!-- Article Container: Clean, distraction-free centered reading column -->
      <article class="max-w-4xl mx-auto px-6 sm:px-8 py-10 md:py-16">
        <!-- Breadcrumb Navigation -->
        <nav
          class="flex items-center gap-2 font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant mb-8 flex-wrap">
          <a class="hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/')); ?>">Home</a>
          <span class="text-outline-variant">/</span>
          <a class="hover:text-primary transition-colors" href="<?php echo esc_url(alumax_news_url()); ?>">News &amp;
            Media</a>
          <?php if ($alumax_term) : ?>
          <span class="text-outline-variant">/</span>
          <span class="text-on-surface-variant"><?php echo esc_html($alumax_term->name); ?></span>
          <?php endif; ?>
          <span class="text-outline-variant">/</span>
          <span class="text-secondary font-semibold"><?php echo esc_html(wp_trim_words(get_the_title(), 6)); ?></span>
        </nav>
        <!-- Article Title -->
        <h1
          class="font-display-xl text-3xl sm:text-4xl md:text-[46px] md:leading-[54px] font-bold text-on-surface uppercase tracking-tight mb-8">
          <?php the_title(); ?>
        </h1>
        <!-- Author Info & Social Share Row -->
        <div
          class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 py-5 border-y border-outline-variant/30 mb-10 text-on-surface-variant">
          <div class="flex items-center gap-3">
            <div
              class="w-10 h-10 rounded-full bg-primary-container text-secondary-fixed flex items-center justify-center font-headline-sm text-sm font-bold">
              <?php echo esc_html($alumax_initials); ?>
            </div>
            <div>
              <p class="font-body-sm text-body-sm font-semibold text-on-surface"><?php echo esc_html($alumax_author); ?>
              </p>
              <p class="font-label-sm text-label-sm text-outline">Published on <?php echo esc_html(get_the_date('F j, Y')); ?> · <?php echo esc_html(alumax_reading_time($alumax_pid)); ?></p>
            </div>
          </div>
          <div class="flex items-center gap-2 self-start sm:self-auto">
            <span
              class="font-label-sm text-label-sm uppercase tracking-wider text-outline mr-1 hidden sm:inline">Share:</span>
            <button
              class="w-8 h-8 rounded border border-outline-variant/60 hover:border-secondary hover:text-secondary flex items-center justify-center transition-colors text-on-surface-variant"
              title="Share Article" onclick="shareArticle()">
              <span class="material-symbols-outlined text-[16px]">share</span>
            </button>
            <a class="w-8 h-8 rounded border border-outline-variant/60 hover:border-secondary hover:text-secondary flex items-center justify-center transition-colors text-on-surface-variant"
              title="Share via Email"
              href="mailto:?subject=<?php echo rawurlencode(get_the_title()); ?>&body=<?php echo rawurlencode($alumax_permalink); ?>">
              <span class="material-symbols-outlined text-[16px]">mail</span>
            </a>
            <button
              class="px-3 h-8 rounded border border-outline-variant/60 hover:border-secondary hover:text-secondary flex items-center gap-1.5 font-label-sm text-label-sm uppercase tracking-wider transition-colors text-on-surface-variant"
              id="copy-btn" onclick="copyLinkNotification()" title="Copy Link">
              <span class="material-symbols-outlined text-[15px]">link</span>
              <span class="">Copy Link</span>
            </button>
          </div>
        </div>
        <?php if ($alumax_thumb_url) : ?>
        <!-- Hero Image with Editorial Caption -->
        <figure class="mb-10">
          <div class="overflow-hidden bg-primary-container shadow-sm">
            <img class="w-full h-[380px] sm:h-[480px] object-cover"
              alt="<?php echo esc_attr(get_the_title()); ?>"
              src="<?php echo esc_url($alumax_thumb_url); ?>">
          </div>
          <?php if ($alumax_thumb_caption) : ?>
          <figcaption
            class="mt-3 text-right font-label-sm text-label-sm text-outline flex items-center justify-between border-b border-surface-container pb-2">
            <span class="text-left font-body-sm italic text-on-surface-variant"><?php echo esc_html($alumax_thumb_caption); ?></span>
          </figcaption>
          <?php endif; ?>
        </figure>
        <?php endif; ?>
        <!-- Post Body -->
        <div class="alumax-news-content mb-12">
          <?php the_content(); ?>
        </div>
        <!-- Related News / Article Navigation -->
        <div class="border-t border-outline-variant/40 pt-8 mt-12">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <!-- Previous Article Link -->
            <?php if ($alumax_prev_post) : ?>
            <a class="p-5 border border-outline-variant/40 hover:border-secondary transition-all flex flex-col gap-1 group bg-surface-container-lowest"
              href="<?php echo esc_url(get_permalink($alumax_prev_post)); ?>">
              <div
                class="flex items-center gap-2 text-outline text-label-sm font-label-sm uppercase group-hover:text-secondary transition-colors">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span class="">Previous Article</span>
              </div>
              <span
                class="font-headline-sm text-sm sm:text-base font-semibold text-on-surface group-hover:text-secondary transition-colors line-clamp-2 mt-1">
                <?php echo esc_html(get_the_title($alumax_prev_post)); ?>
              </span>
            </a>
            <?php endif; ?>
            <!-- Next Article Link -->
            <?php if ($alumax_next_post) : ?>
            <a class="p-5 border border-outline-variant/40 hover:border-secondary transition-all flex flex-col gap-1 text-right group bg-surface-container-lowest sm:col-start-2"
              href="<?php echo esc_url(get_permalink($alumax_next_post)); ?>">
              <div
                class="flex items-center justify-end gap-2 text-outline text-label-sm font-label-sm uppercase group-hover:text-secondary transition-colors">
                <span class="">Next Article</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </div>
              <span
                class="font-headline-sm text-sm sm:text-base font-semibold text-on-surface group-hover:text-secondary transition-colors line-clamp-2 mt-1">
                <?php echo esc_html(get_the_title($alumax_next_post)); ?>
              </span>
            </a>
            <?php endif; ?>
          </div>
          <!-- Back to News Center Button -->
          <div class="flex justify-center">
            <a class="inline-flex items-center gap-2 px-6 py-3 border border-outline-variant font-label-md text-label-md uppercase tracking-wider font-semibold text-on-surface hover:bg-surface-container-high transition-colors"
              href="<?php echo esc_url(alumax_news_url()); ?>">
              <span class="material-symbols-outlined text-[18px]">grid_view</span>
              <span class="">Back to News Center</span>
            </a>
          </div>
        </div>
      </article>
      <style>
        .alumax-news-content {
          font-family: 'Manrope', sans-serif;
          font-size: 1rem;
          line-height: 1.75;
          color: #44474c;
        }
        @media (min-width: 640px) {
          .alumax-news-content { font-size: 1.125rem; }
        }
        .alumax-news-content p { margin: 0 0 1.25rem; }
        .alumax-news-content h2,
        .alumax-news-content h3 {
          font-family: 'Space Grotesk', sans-serif;
          font-weight: 700;
          text-transform: uppercase;
          letter-spacing: -0.01em;
          color: #191c1e;
          border-left: 6px solid #b88e56;
          padding-left: 0.75rem;
          margin: 2.5rem 0 1.25rem;
        }
        .alumax-news-content h2 { font-size: 1.5rem; line-height: 2rem; }
        .alumax-news-content h3 { font-size: 1.25rem; line-height: 1.75rem; }
        @media (min-width: 640px) {
          .alumax-news-content h2 { font-size: 1.875rem; line-height: 2.25rem; }
        }
        .alumax-news-content a { color: #7b5825; text-decoration: underline; }
        .alumax-news-content strong { color: #191c1e; }
        .alumax-news-content img {
          width: 100%;
          height: auto;
          margin: 2rem 0;
          background: #eceef0;
        }
        .alumax-news-content figure { margin: 2rem 0; }
        .alumax-news-content figure img { margin: 0; }
        .alumax-news-content figcaption {
          margin-top: 0.625rem;
          font-family: 'JetBrains Mono', monospace;
          font-size: 11px;
          line-height: 14px;
          letter-spacing: 0.08em;
          color: #74777d;
          font-style: italic;
        }
        .alumax-news-content blockquote {
          margin: 2rem 0;
          border-left: 4px solid #b88e56;
          background: #f2f4f6;
          padding: 1.5rem;
          font-style: italic;
          color: #191c1e;
        }
        .alumax-news-content blockquote p:last-child { margin-bottom: 0; }
        .alumax-news-content ul,
        .alumax-news-content ol { margin: 0 0 1.25rem 1.5rem; }
        .alumax-news-content ul { list-style: disc; }
        .alumax-news-content ol { list-style: decimal; }
        .alumax-news-content li { margin-bottom: 0.5rem; }
      </style>
      <!-- Reading Progress & Micro-Interactions -->
      <script>
        window.addEventListener('scroll', () => {
          const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
          const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
          const scrolled = (winScroll / height) * 100;
          const bar = document.getElementById('read-progress');
          if (bar) bar.style.width = scrolled + '%';
        });

        function shareArticle() {
          if (navigator.share) {
            navigator.share({ title: document.title, url: window.location.href }).catch(() => {});
          } else {
            copyLinkNotification();
          }
        }

        function copyLinkNotification() {
          navigator.clipboard?.writeText(window.location.href);
          const btn = document.getElementById('copy-btn');
          if (btn) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span class="material-symbols-outlined text-[15px]">check</span><span>Copied</span>';
            setTimeout(() => {
              btn.innerHTML = originalText;
            }, 2000);
          }
        }
      </script>
    </div>
  </main>
<?php
endwhile;
get_footer();
