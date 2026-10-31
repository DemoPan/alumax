<?php
if (!defined('ABSPATH')) { exit; }

// 项目中心页（案例归档）：Hero + 前端筛选条 + Spotlight（最新案例）+ 案例卡片网格 + 真实分页。
// 筛选为纯前端 JS 按卡片文本匹配；本页不含询价表单。

get_header();

$paged = max(1, (int) get_query_var('paged'));
$fallback_image = 'https://lh3.googleusercontent.com/aida-public/AB6AXuC-qAi3-NkN3D5kkzbuqChEsIoeZVK9qOB_tP12pm7Ywm0MddUBrDiPoGOEo2gNnKPIrMq9PAlAds9O1lNHApr4YA0afha7J0L8rP_SGE6dEVNQkJGGpGWL_mN3K9F2OP4911zYauzoSSiTHizJkeI8KnjKXn1GMiPK2dJaYFGIxiEgRyxcWsYqSDERLDLlZb84jOHeRr9zYvT_iJcwFJApFbg5R2Ha7XEAfYCPD_cNuWh4fFm1_xuD';
$hero_bg = 'https://lh3.googleusercontent.com/aida/AEtjO1VUQCHakCTsoRpuJrVgGotL75_s3xJUfmltXG5JSKGnrKuodK0hqQwVJbHbLwJmZFKa1DrnMeSaXK7no4Cv38op_VnK44t8_cu1_qSrFeU801bn57VmDbpeeHGpI1Sn3JJij0f_SKteAsSzUYx3XsTjV3ASNU4DqHC4bGlbe9pCgwu91yVhxu8AZ0aB2_l5oQuXFbf0XdrVczZKHDUH2PO1SIDQ1P84s-r_u0NbLOfLqpOwMtr7PDezKA';

// Spotlight：仅第 1 页显示最新一篇案例，并从卡片网格中排除
$spotlight = null;
if ($paged === 1) {
    $latest = get_posts(['post_type' => 'case', 'posts_per_page' => 1, 'post_status' => 'publish']);
    $spotlight = $latest ? $latest[0] : null;
}

$query_args = [
    'post_type'           => 'case',
    'posts_per_page'      => 9,
    'paged'               => $paged,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true,
];
if ($spotlight) {
    $query_args['post__not_in'] = [$spotlight->ID];
}
$cases = new WP_Query($query_args);

// 筛选下拉配置：option 文本 => 匹配关键词（纯前端按卡片文本过滤）
$filters = [
    'Fire Rating' => [
        'Fire Rating: All Standards' => '',
        'ASTM E84 Class A'           => 'ASTM E84',
        'EN 13501-1'                 => 'EN 13501',
        'CWCT Rig Certified'         => 'CWCT',
    ],
    'Alloy Grade' => [
        'Alloy Grade: All Grades' => '',
        'AA5052 Marine Grade'     => 'AA5052',
        'AA3003 Formed Alloy'     => 'AA3003',
        'AA6063 Extrusion Grade'  => '6063',
    ],
    'Surface Coating' => [
        'Surface Coating: All Finishes' => '',
        'PVDF Fluoropolymer'            => 'PVDF',
        'Anodized Class 1'              => 'Anodized',
        'Powder Coated'                 => 'Powder',
    ],
    'Panel System' => [
        'Panel System: All Types' => '',
        'Solid Aluminum'          => 'Solid Aluminum',
        'Honeycomb'               => 'Honeycomb',
        'Louvers / Shading'       => 'Louver',
    ],
];
?>
<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">

  <!-- HERO -->
  <section class="relative w-full overflow-hidden bg-[#0d1b2a] text-white py-8 md:py-10 border-b border-white/10">
    <div class="absolute inset-0 z-0">
      <img class="w-full h-full object-cover opacity-25 filter brightness-75 contrast-125" alt="Architectural Facade Envelope" src="<?php echo esc_url($hero_bg); ?>">
      <div class="absolute inset-0 bg-gradient-to-r from-[#0d1b2a] via-[#0d1b2a]/85 to-[#0d1b2a]/60"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-[#0d1b2a] via-transparent to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-margin-mobile md:px-margin space-y-6">
      <div class="pb-2">
        <?php get_template_part('template-parts/product-breadcrumb', null, ['variant' => 'hero', 'archive_label' => 'Projects', 'archive_url' => get_post_type_archive_link('case'), 'current' => '']); ?>
      </div>
      <div class="max-w-4xl space-y-3 pt-2">
        <h1 class="font-display-xl text-display-xl text-white tracking-tight">Landmark Architectural Facades &amp; Global Installations</h1>
        <p class="font-body-md text-body-md text-slate-300 max-w-3xl">Explore precision-manufactured exterior cladding, solid aluminum cassettes, dynamic kinetic solar louvers, and bespoke honeycomb envelope assemblies engineered for iconic international towers and cultural institutions.</p>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-3 bg-white/5 backdrop-blur-md border border-white/10 p-4 mt-6">
        <div class="p-3 border-l-2 border-secondary">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-slate-400 block">Installed Envelope Area</span>
          <div class="font-headline-lg text-headline-lg text-white tracking-tight mt-1">1.2M+ <span class="font-label-md text-label-md text-secondary-fixed">m²</span></div>
          <p class="font-body-sm text-body-sm text-slate-400 mt-1">Certified curtain wall &amp; cladding</p>
        </div>
        <div class="p-3 border-l-2 border-white/40">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-slate-400 block">Global Reach</span>
          <div class="font-headline-lg text-headline-lg text-white tracking-tight mt-1">60+ <span class="font-label-md text-label-md text-slate-300">Nations</span></div>
          <p class="font-body-sm text-body-sm text-slate-400 mt-1">Active presence in GCC, EU &amp; Americas</p>
        </div>
        <div class="p-3 border-l-2 border-secondary">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-slate-400 block">Milling Tolerance</span>
          <div class="font-headline-lg text-headline-lg text-white tracking-tight mt-1">±0.3 <span class="font-label-md text-label-md text-secondary-fixed">mm</span></div>
          <p class="font-body-sm text-body-sm text-slate-400 mt-1">German 5-axis CNC machining</p>
        </div>
        <div class="p-3 border-l-2 border-white/40">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-slate-400 block">QC Logistics Pass Rate</span>
          <div class="font-headline-lg text-headline-lg text-white tracking-tight mt-1">99.98%</div>
          <p class="font-body-sm text-body-sm text-slate-400 mt-1">Zero micro-scratch export crating</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FILTER BAR（纯前端筛选） -->
  <section class="w-full bg-surface py-6 border-b border-surface-container-high">
    <div class="max-w-7xl mx-auto px-margin-mobile md:px-margin space-y-4">
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Filter case studies by engineering specification</p>
        <div class="flex items-center bg-surface-container-low p-1 border border-outline-variant/30">
          <button id="case-grid-view" class="w-8 h-8 flex items-center justify-center bg-surface-container-lowest text-primary shadow-sm" type="button" aria-label="Grid view">
            <span class="material-symbols-outlined text-[18px]">grid_view</span>
          </button>
          <button id="case-list-view" class="w-8 h-8 flex items-center justify-center text-on-surface-variant hover:text-on-surface transition-colors" type="button" aria-label="List view">
            <span class="material-symbols-outlined text-[18px]">format_list_bulleted</span>
          </button>
        </div>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
        <?php foreach ($filters as $group => $options) : ?>
        <div class="relative">
          <select class="case-filter w-full h-10 px-3 pr-8 bg-surface border border-outline-variant text-on-surface font-label-sm text-label-sm appearance-none outline-none focus:border-secondary cursor-pointer" aria-label="<?php echo esc_attr($group); ?>">
            <?php foreach ($options as $label => $keyword) : ?>
            <option value="<?php echo esc_attr($keyword); ?>"><?php echo esc_html($label); ?></option>
            <?php endforeach; ?>
          </select>
          <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none text-base">unfold_more</span>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php if ($spotlight) :
      $sid       = $spotlight->ID;
      $sheader   = alumax_case_header($sid);
      $smetrics  = array_slice(alumax_case_metrics($sid), 0, 3);
      $schallenge = alumax_case_challenge($sid);
      $sverify   = array_slice(alumax_case_verification($sid), 0, 6);
      $sdownloads = alumax_case_downloads($sid);
      $simage    = get_the_post_thumbnail_url($sid, 'full') ?: $fallback_image;
      $sbadges   = array_slice(array_filter(array_map('trim', explode('&', $sheader['certification']))), 0, 3);
      $sdesc     = $schallenge['text'] !== '' ? $schallenge['text'] : wp_trim_words(wp_strip_all_tags(strip_shortcodes(excerpt_remove_blocks($spotlight->post_content)), true), 40, '…');
      $sbim      = null;
      foreach ($sdownloads as $dl) {
          if (!empty($dl['url']) && $dl['url'] !== '#') { $sbim = $dl; break; }
      }
      ?>
  <!-- SPOTLIGHT（最新案例） -->
  <section class="w-full bg-surface py-16">
    <div class="max-w-7xl mx-auto px-margin-mobile md:px-margin">
      <div class="flex items-center justify-between mb-8">
        <div class="space-y-1">
          <div class="flex items-center gap-2 flex-wrap">
            <span class="px-2.5 py-0.5 bg-secondary text-on-secondary font-label-sm text-label-sm uppercase tracking-wider">Spotlight Reference</span>
            <span class="font-label-sm text-label-sm text-on-surface-variant uppercase"><?php echo esc_html($sheader['location']); ?></span>
          </div>
          <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight"><?php echo esc_html(get_the_title($sid)); ?></h2>
        </div>
        <?php if ($sheader['ref_code'] !== '') : ?>
        <div class="hidden sm:flex items-center gap-2 font-label-sm text-label-sm text-on-surface-variant">
          <span>PROJECT ARCHIVE REF: <?php echo esc_html($sheader['ref_code']); ?></span>
        </div>
        <?php endif; ?>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
        <div class="lg:col-span-7 flex flex-col justify-between space-y-6">
          <div class="relative overflow-hidden group">
            <img class="w-full h-[440px] object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="<?php echo esc_attr(get_the_title($sid)); ?>" src="<?php echo esc_url($simage); ?>">
            <?php if ($sbadges) : ?>
            <div class="absolute top-4 left-4 flex flex-wrap gap-2">
              <?php foreach ($sbadges as $bi => $badge) : ?>
              <span class="px-3 py-1 <?php echo $bi === 0 ? 'bg-primary-container text-on-primary' : 'bg-surface-container-lowest/90 backdrop-blur-md text-primary'; ?> font-label-sm text-label-sm uppercase"><?php echo esc_html($badge); ?></span>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if ($sheader['card_tagline'] !== '') : ?>
            <div class="absolute bottom-4 left-4 right-4 p-4 bg-primary-container/90 backdrop-blur-md text-on-primary flex items-center justify-between">
              <div>
                <span class="font-label-sm text-label-sm uppercase text-secondary-fixed block">Facade Technology</span>
                <span class="font-body-md text-body-md font-medium"><?php echo esc_html($sheader['card_tagline']); ?></span>
              </div>
              <span class="material-symbols-outlined text-secondary text-2xl">cyclone</span>
            </div>
            <?php endif; ?>
          </div>
          <?php if ($smetrics) : ?>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <?php foreach ($smetrics as $metric) : ?>
            <div class="bg-surface-container-low p-4">
              <span class="font-label-sm text-label-sm uppercase text-on-surface-variant block"><?php echo esc_html($metric['name']); ?></span>
              <span class="font-headline-sm text-headline-sm text-primary"><?php echo esc_html($metric['value']); ?></span>
              <?php if (!empty($metric['desc'])) : ?>
              <span class="font-label-sm text-label-sm text-secondary block mt-1"><?php echo esc_html($metric['desc']); ?></span>
              <?php endif; ?>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
        <div class="lg:col-span-5 flex flex-col justify-between space-y-6">
          <div>
            <div class="pb-4">
              <?php if ($sheader['card_tagline'] !== '') : ?>
              <span class="font-label-sm text-label-sm uppercase text-secondary font-medium tracking-wider"><?php echo esc_html($sheader['card_tagline']); ?></span>
              <?php endif; ?>
              <h3 class="font-headline-md text-headline-md text-primary mt-1">Engineering Specification Breakdown</h3>
              <?php if ($sdesc !== '') : ?>
              <p class="font-body-sm text-body-sm text-on-surface-variant mt-2"><?php echo esc_html($sdesc); ?></p>
              <?php endif; ?>
            </div>
            <?php if ($sverify) : ?>
            <div class="space-y-2 pt-2">
              <?php foreach ($sverify as $vi => $row) : ?>
              <div class="flex items-center justify-between gap-3 p-3 <?php echo $vi % 2 === 0 ? 'bg-surface-container-low' : 'bg-surface-container'; ?>">
                <span class="font-label-sm text-label-sm uppercase text-on-surface-variant"><?php echo esc_html($row['param']); ?></span>
                <span class="font-label-md text-label-md font-semibold text-primary text-right"><?php echo esc_html($row['result']); ?></span>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>
          <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-4">
            <a class="flex-1 h-12 bg-primary-container text-on-primary hover:bg-secondary hover:text-on-secondary transition-colors font-headline-sm text-label-md uppercase tracking-wider flex items-center justify-center gap-2" href="<?php echo esc_url(get_permalink($sid)); ?>">
              <span>View Case Study Report</span>
              <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </a>
            <?php if ($sbim) : ?>
            <a class="h-12 px-5 bg-surface-container text-primary hover:bg-surface-container-high transition-colors font-label-md text-label-md uppercase tracking-wider flex items-center justify-center gap-2" href="<?php echo esc_url($sbim['url']); ?>">
              <span class="material-symbols-outlined text-lg">folder_zip</span>
              <span><?php echo esc_html(!empty($sbim['btn']) ? $sbim['btn'] : 'Download Assets'); ?></span>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 案例卡片网格 -->
  <section class="w-full bg-surface-container-low py-16">
    <div class="max-w-7xl mx-auto px-margin-mobile md:px-margin space-y-12">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
          <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-medium">Project Index Matrix</span>
          <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">International Landmark Installations</h2>
        </div>
        <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md">Precision prefabricated assemblies engineered to meet municipal building envelope fire standards, extreme wind deflection criteria, and tight construction timelines.</p>
      </div>

      <?php if ($cases->have_posts()) : ?>
      <div id="case-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
        <?php
        while ($cases->have_posts()) : $cases->the_post();
            $cid     = get_the_ID();
            $cheader = alumax_case_header($cid);
            $cmetrics = array_slice(alumax_case_metrics($cid), 0, 4);
            $cimage  = get_the_post_thumbnail_url($cid, 'large') ?: $fallback_image;
            $cyear   = '';
            if (preg_match('/\d{4}/', $cheader['completed'], $m)) {
                $cyear = $m[0];
            } else {
                $cyear = get_the_date('Y', $cid);
            }
            $clocation = trim($cheader['location']);
            ?>
        <div class="case-card bg-surface-container-lowest flex flex-col justify-between shadow-sm hover:shadow-md transition-all duration-300 group">
          <div class="case-card-body">
            <div class="case-card-media relative overflow-hidden aspect-[16/10]">
              <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="<?php echo esc_attr(get_the_title()); ?>" src="<?php echo esc_url($cimage); ?>">
              <?php if ($cheader['card_tagline'] !== '') : ?>
              <div class="absolute top-3 left-3 bg-primary-container text-on-primary font-label-sm text-label-sm px-2.5 py-1 uppercase"><?php echo esc_html($cheader['card_tagline']); ?></div>
              <?php endif; ?>
              <div class="absolute top-3 right-3 bg-surface-container-lowest/90 backdrop-blur text-primary font-label-sm text-label-sm px-2.5 py-1"><?php echo esc_html(trim($cyear . ' // ' . $clocation, ' /')); ?></div>
            </div>
            <div class="p-6 space-y-4">
              <div>
                <?php if ($cheader['certification'] !== '') : ?>
                <span class="font-label-sm text-label-sm text-secondary uppercase font-semibold"><?php echo esc_html($cheader['certification']); ?></span>
                <?php endif; ?>
                <h3 class="font-headline-md text-headline-md text-primary mt-1 group-hover:text-secondary transition-colors"><?php the_title(); ?></h3>
              </div>
              <?php if ($cmetrics) : ?>
              <div class="space-y-2 pt-2">
                <?php foreach ($cmetrics as $mi => $metric) : ?>
                <div class="flex items-center justify-between gap-3 text-body-sm <?php echo $mi % 2 === 0 ? 'bg-surface-container-low' : 'bg-surface-container'; ?> p-2">
                  <span class="text-on-surface-variant font-label-sm text-label-sm"><?php echo esc_html($metric['name']); ?>:</span>
                  <span class="font-label-sm text-label-sm font-semibold text-primary text-right"><?php echo esc_html($metric['value']); ?></span>
                </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="case-card-footer p-6 pt-0">
            <a class="w-full h-11 bg-surface-container hover:bg-primary-container hover:text-on-primary transition-colors text-primary font-label-sm text-label-sm uppercase flex items-center justify-center gap-2" href="<?php the_permalink(); ?>">
              <span>View Case Study</span>
              <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
      <p id="case-filter-empty" class="hidden font-body-md text-body-md text-on-surface-variant text-center py-8">No case studies match the selected specification filters.</p>

      <!-- 分页 -->
      <?php
      $total = (int) $cases->found_posts;
      $shown_from = ($paged - 1) * 9 + 1;
      $shown_to = min($paged * 9, $total);
      $links = paginate_links([
          'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
          'format'    => '?paged=%#%',
          'current'   => $paged,
          'total'     => (int) $cases->max_num_pages,
          'type'      => 'array',
          'prev_text' => '<span class="material-symbols-outlined text-lg">chevron_left</span>',
          'next_text' => '<span class="material-symbols-outlined text-lg">chevron_right</span>',
      ]);
      ?>
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Showing <?php echo esc_html($shown_from . ' – ' . $shown_to . ' of ' . $total); ?> Verified Global Case Studies</p>
        <?php if ($links) : ?>
        <div class="flex items-center gap-2">
          <?php foreach ($links as $link) :
              if (strpos($link, 'dots') !== false) {
                  echo '<span class="px-2 text-on-surface-variant">…</span>';
                  continue;
              }
              $is_current = strpos($link, 'current') !== false;
              $classes = $is_current
                  ? 'w-10 h-10 bg-primary-container text-on-primary font-label-sm text-label-sm flex items-center justify-center'
                  : 'w-10 h-10 bg-surface-container-lowest text-on-surface font-label-sm text-label-sm hover:bg-surface-container flex items-center justify-center';
              echo str_replace('page-numbers', 'page-numbers ' . $classes, $link); // phpcs:ignore WordPress.Security.EscapeOutput -- paginate_links 输出
          endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <?php else : ?>
      <p class="font-body-md text-body-md text-on-surface-variant text-center py-8">No case studies published yet.</p>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </section>

  <style>
    /* 列表视图：横向卡片布局（自有 CSS，不依赖 Tailwind CDN 动态生成） */
    #case-grid.list-mode { grid-template-columns: 1fr; }
    #case-grid.list-mode .case-card { flex-direction: row; }
    #case-grid.list-mode .case-card-body { display: flex; flex: 1 1 auto; min-width: 0; }
    #case-grid.list-mode .case-card-media { width: 300px; flex-shrink: 0; aspect-ratio: auto; }
    #case-grid.list-mode .case-card-footer { display: flex; align-items: center; padding: 1.5rem; }
    #case-grid.list-mode .case-card-footer a { width: auto; height: auto; padding: 0.75rem 1.25rem; white-space: nowrap; }
    @media (max-width: 767px) {
      #case-grid.list-mode .case-card { flex-direction: column; }
      #case-grid.list-mode .case-card-body { flex-direction: column; }
      #case-grid.list-mode .case-card-media { width: 100%; aspect-ratio: 16 / 10; }
    }
  </style>
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    // 纯前端规格筛选：按卡片文本匹配关键词
    const selects = document.querySelectorAll('.case-filter');
    const cards = document.querySelectorAll('.case-card');
    const emptyMsg = document.getElementById('case-filter-empty');
    function applyCaseFilters() {
      const keywords = Array.from(selects).map((s) => s.value.toLowerCase()).filter(Boolean);
      let visible = 0;
      cards.forEach((card) => {
        const text = card.textContent.toLowerCase();
        const ok = keywords.every((kw) => text.includes(kw));
        card.classList.toggle('hidden', !ok);
        if (ok) visible++;
      });
      if (emptyMsg) emptyMsg.classList.toggle('hidden', visible !== 0);
    }
    selects.forEach((s) => s.addEventListener('change', applyCaseFilters));

    // 网格 / 列表视图切换：切换 #case-grid 的 list-mode class（样式见上方 <style>）
    const grid = document.getElementById('case-grid');
    const btnGrid = document.getElementById('case-grid-view');
    const btnList = document.getElementById('case-list-view');
    const activeClasses = ['bg-surface-container-lowest', 'text-primary', 'shadow-sm'];
    const idleClasses = ['text-on-surface-variant'];
    function setView(mode) {
      if (!grid) return;
      grid.classList.toggle('list-mode', mode === 'list');
      const on = mode === 'list' ? btnList : btnGrid;
      const off = mode === 'list' ? btnGrid : btnList;
      on.classList.add(...activeClasses);
      on.classList.remove(...idleClasses);
      off.classList.remove(...activeClasses);
      off.classList.add(...idleClasses);
    }
    if (btnGrid && btnList) {
      btnGrid.addEventListener('click', () => setView('grid'));
      btnList.addEventListener('click', () => setView('list'));
    }
  });
  </script>

</main>
<?php
get_footer();
