<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<?php while (have_posts()) : the_post(); ?>
<?php
$alumax_header       = alumax_case_header();
$alumax_snapshot     = alumax_case_snapshot();
$alumax_metrics      = alumax_case_metrics();
$alumax_gallery      = alumax_case_gallery();
$alumax_challenge    = alumax_case_challenge();
$alumax_systems_intro = alumax_case_systems_intro();
$alumax_systems      = alumax_case_systems();
$alumax_verification_intro = alumax_case_verification_intro();
$alumax_verification = alumax_case_verification();
$alumax_downloads    = alumax_case_downloads();

$alumax_metric_icons = ['aspect_ratio', 'thermostat', 'air', 'shield'];
$alumax_fallback_img = 'https://lh3.googleusercontent.com/aida-public/AB6AXuC-qAi3-NkN3D5kkzbuqChEsIoeZVK9qOB_tP12pm7Ywm0MddUBrDiPoGOEo2gNnKPIrMq9PAlAds9O1lNHApr4YA0afha7J0L8rP_SGE6dEVNQkJGGpGWL_mN3K9F2OP4911zYauzoSSiTHizJkeI8KnjKXn1GMiPK2dJaYFGIxiEgRyxcWsYqSDERLDLlZb84jOHeRr9zYvT_iJcwFJApFbg5R2Ha7XEAfYCPD_cNuWh4fFm1_xuD';
?>
  <main class="w-full bg-surface min-h-[calc(100vh-80px)]">
    <div class="flex flex-col w-full">
      <!-- BREADCRUMB & METADATA BAR -->
      <section class="w-full bg-surface-container-low">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin py-4">
          <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Navigation Trail -->
            <nav aria-label="Breadcrumb" class="flex items-center gap-2 overflow-x-auto whitespace-nowrap">
              <a class="font-label-md text-label-md text-on-surface-variant hover:text-secondary uppercase tracking-wider transition-colors"
                data-path="home" href="<?php echo esc_url(home_url('/')); ?>">Home</a>
              <span class="text-outline-variant font-label-md">/</span>
              <a class="font-label-md text-label-md text-on-surface-variant hover:text-secondary uppercase tracking-wider transition-colors"
                data-path="projects" href="<?php echo esc_url(get_post_type_archive_link('case')); ?>">Projects</a>
              <span class="text-outline-variant font-label-md">/</span>
              <span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Landmark Case
                Studies</span>
              <span class="text-outline-variant font-label-md">/</span>
              <span
                class="font-label-md text-label-md text-secondary uppercase tracking-wider font-semibold"><?php echo esc_html(get_the_title()); ?></span>
            </nav>
            <!-- Precision Meta Badges -->
            <div class="flex flex-wrap items-center gap-2">
              <?php if ($alumax_header['ref_code'] !== '') : ?>
              <span
                class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">
                <span class="w-1.5 h-1.5 bg-secondary"></span>
                REF: <?php echo esc_html($alumax_header['ref_code']); ?>
              </span>
              <?php endif; ?>
              <?php if ($alumax_header['location'] !== '') : ?>
              <span
                class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">
                <span class="material-symbols-outlined text-[13px] text-secondary">location_on</span>
                <?php echo esc_html($alumax_header['location']); ?>
              </span>
              <?php endif; ?>
              <?php if ($alumax_header['completed'] !== '') : ?>
              <span
                class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-surface-container font-label-sm text-label-sm text-on-surface-variant">
                <span class="material-symbols-outlined text-[13px] text-secondary">task_alt</span>
                <?php echo esc_html($alumax_header['completed']); ?>
              </span>
              <?php endif; ?>
              <?php if ($alumax_header['certification'] !== '') : ?>
              <span
                class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-secondary/10 font-label-sm text-label-sm text-secondary font-semibold">
                <span class="material-symbols-outlined text-[13px]">verified</span>
                <?php echo esc_html($alumax_header['certification']); ?>
              </span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </section>
      <!-- HERO SECTION -->
      <section class="w-full bg-primary-container text-on-primary relative overflow-hidden py-16 md:py-24">
        <!-- Architectural Subtle Grid Graphic -->
        <div class="absolute inset-0 opacity-5 pointer-events-none">
          <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <pattern height="64" id="arch-grid" patternUnits="userSpaceOnUse" width="64">
                <path d="M 64 0 L 0 0 0 64" fill="none" stroke="currentColor" stroke-width="1"></path>
              </pattern>
            </defs>
            <rect fill="url(#arch-grid)" height="100%" width="100%"></rect>
          </svg>
        </div>
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin relative z-10">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
            <div class="lg:col-span-8 space-y-6">
              <div
                class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/15 text-secondary font-label-sm text-label-sm tracking-widest uppercase">
                <span class="w-2 h-2 bg-secondary animate-pulse"></span>
                Commercial High-Rise Facade Case Dossier
              </div>
              <h1 class="font-display-xl text-display-xl tracking-tight text-on-primary">
                <?php echo esc_html(get_the_title()); ?>
              </h1>
              <p class="font-body-lg text-body-lg text-on-primary-container max-w-3xl leading-relaxed">
                <?php echo esc_html(get_the_excerpt()); ?>
              </p>
              <div class="flex flex-wrap items-center gap-4 pt-2">
                <a class="px-6 py-3 bg-secondary text-on-secondary font-headline-sm text-headline-sm uppercase tracking-wider hover:bg-secondary-fixed transition-all flex items-center gap-2 shadow-sm"
                  href="#rfq-section">
                  <span class="material-symbols-outlined text-[18px]">build</span>
                  <span class="">Engage Facade Engineering Team</span>
                </a>
                <?php if ($alumax_verification) : ?>
                <a class="px-6 py-3 bg-surface-container-lowest/10 text-on-primary font-headline-sm text-headline-sm uppercase tracking-wider hover:bg-surface-container-lowest/20 transition-all flex items-center gap-2"
                  href="#technical-specifications">
                  <span class="material-symbols-outlined text-[18px]">analytics</span>
                  <span class="">Full Spec Matrix</span>
                </a>
                <?php endif; ?>
              </div>
            </div>
            <?php if ($alumax_snapshot) : ?>
            <!-- Module 1: Project Snapshot -->
            <div class="lg:col-span-4 bg-surface-container-lowest/5 backdrop-blur-md p-6 space-y-4">
              <div
                class="font-label-md text-label-md text-secondary uppercase tracking-widest flex items-center justify-between">
                <span class="">Project Snapshot</span>
                <span class="material-symbols-outlined text-[18px]">domain</span>
              </div>
              <div class="space-y-3 font-body-sm text-body-sm text-on-primary-container">
                <?php foreach ($alumax_snapshot as $alumax_item) : ?>
                <div class="flex justify-between py-1.5 bg-surface-container-lowest/5 px-2.5">
                  <span class="text-on-primary-fixed-variant"><?php echo esc_html($alumax_item['label']); ?></span>
                  <span class="text-on-primary font-medium"><?php echo esc_html($alumax_item['value']); ?></span>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <?php if ($alumax_metrics) : ?>
          <!-- Module 2: KEY ENGINEERING METRICS -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mt-16 pt-8">
            <?php foreach ($alumax_metrics as $alumax_i => $alumax_metric) :
                $alumax_icon = $alumax_metric['icon'] !== ''
                    ? $alumax_metric['icon']
                    : $alumax_metric_icons[$alumax_i % count($alumax_metric_icons)];
                ?>
            <div class="p-6 bg-surface-container-lowest/5 hover:bg-surface-container-lowest/10 transition-colors">
              <div class="flex items-center justify-between mb-4">
                <span
                  class="font-label-sm text-label-sm uppercase tracking-wider text-secondary"><?php echo esc_html($alumax_metric['name']); ?></span>
                <span class="material-symbols-outlined text-secondary text-[20px]"><?php echo esc_html($alumax_icon); ?></span>
              </div>
              <div class="font-display-lg text-display-lg text-on-primary font-bold tracking-tight">
                <?php echo esc_html($alumax_metric['value']); ?></div>
              <?php if ($alumax_metric['desc'] !== '') : ?>
              <p class="font-body-sm text-body-sm text-on-primary-container mt-2">
                <?php echo esc_html($alumax_metric['desc']); ?>
              </p>
              <?php endif; ?>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </section>
      <!-- Module 3: PHOTOGRAPHY & VISUAL PROGRESSION（项目图集，固定三组） -->
      <?php
      $alumax_main_img = $alumax_gallery[0]['image'] !== ''
          ? $alumax_gallery[0]['image']
          : (get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $alumax_fallback_img);
      ?>
      <section class="w-full bg-surface-container-low py-12">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
            <div class="md:col-span-8 relative group overflow-hidden bg-primary-container min-h-[460px]">
              <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                alt="<?php echo esc_attr($alumax_gallery[0]['title'] !== '' ? $alumax_gallery[0]['title'] : get_the_title()); ?>"
                src="<?php echo esc_url($alumax_main_img); ?>">
              <div
                class="absolute inset-0 bg-gradient-to-t from-primary-container via-transparent to-transparent opacity-80">
              </div>
              <div
                class="absolute bottom-6 left-6 right-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                  <?php if ($alumax_gallery[0]['label'] !== '') : ?>
                  <span
                    class="font-label-sm text-label-sm uppercase tracking-widest text-secondary bg-primary-container/80 px-2 py-1"><?php echo esc_html($alumax_gallery[0]['label']); ?></span>
                  <?php endif; ?>
                  <?php if ($alumax_gallery[0]['title'] !== '') : ?>
                  <p class="font-headline-sm text-headline-sm text-on-primary mt-1 font-semibold">
                    <?php echo esc_html($alumax_gallery[0]['title']); ?></p>
                  <?php endif; ?>
                  <?php if ($alumax_gallery[0]['desc'] !== '') : ?>
                  <p class="font-body-sm text-body-sm text-on-primary-container"><?php echo esc_html($alumax_gallery[0]['desc']); ?>
                  </p>
                  <?php endif; ?>
                </div>
                <?php if ($alumax_header['location'] !== '') : ?>
                <span
                  class="font-label-sm text-label-sm text-secondary px-3 py-1 bg-primary-container/90"><?php echo esc_html($alumax_header['location']); ?></span>
                <?php endif; ?>
              </div>
            </div>
            <div class="md:col-span-4 flex flex-col gap-gutter">
              <?php for ($alumax_g = 1; $alumax_g < 3; $alumax_g++) :
                  $alumax_item = $alumax_gallery[$alumax_g];
                  if ($alumax_item['image'] === '' && $alumax_item['title'] === '') {
                      continue;
                  }
                  ?>
              <div class="relative group overflow-hidden bg-primary-container flex-1 min-h-[218px]">
                <?php if ($alumax_item['image'] !== '') : ?>
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                  alt="<?php echo esc_attr($alumax_item['title']); ?>"
                  src="<?php echo esc_url($alumax_item['image']); ?>">
                <?php endif; ?>
                <div class="absolute inset-0 bg-gradient-to-t from-primary-container/90 via-transparent to-transparent">
                </div>
                <div class="absolute bottom-4 left-4 right-4">
                  <?php if ($alumax_item['label'] !== '') : ?>
                  <span class="font-label-sm text-label-sm text-secondary"><?php echo esc_html($alumax_item['label']); ?></span>
                  <?php endif; ?>
                  <?php if ($alumax_item['title'] !== '') : ?>
                  <p class="font-label-md text-label-md text-on-primary font-medium"><?php echo esc_html($alumax_item['title']); ?>
                  </p>
                  <?php endif; ?>
                  <?php if ($alumax_item['desc'] !== '') : ?>
                  <p class="font-body-sm text-body-sm text-on-primary-container"><?php echo esc_html($alumax_item['desc']); ?></p>
                  <?php endif; ?>
                </div>
              </div>
              <?php endfor; ?>
            </div>
          </div>
        </div>
      </section>
      <!-- BLUEPRINT & ENGINEERING SPECIFICATION ANALYSIS -->
      <section class="w-full bg-surface py-16 md:py-24">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-16">
          <!-- Module 4: Architectural Challenge -->
          <?php
          $alumax_challenge_img = $alumax_challenge['image'] !== ''
              ? $alumax_challenge['image']
              : (get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $alumax_fallback_img);
          ?>
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-stretch">
            <div
              class="lg:col-span-5 relative group overflow-hidden rounded-xl bg-primary-container shadow-md flex flex-col justify-end min-h-[440px]">
              <img
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                alt="<?php echo esc_attr($alumax_challenge['image_title'] !== '' ? $alumax_challenge['image_title'] : get_the_title()); ?>"
                src="<?php echo esc_url($alumax_challenge_img); ?>">
              <div
                class="absolute inset-0 bg-gradient-to-t from-primary-container via-primary-container/40 to-transparent">
              </div>
              <div class="relative z-10 p-6 md:p-8 space-y-2">
                <?php if ($alumax_challenge['image_label'] !== '') : ?>
                <div
                  class="inline-flex items-center gap-2 px-3 py-1 bg-secondary text-on-secondary font-label-sm text-label-sm uppercase tracking-wider font-semibold rounded">
                  <span class="material-symbols-outlined text-[16px]">construction</span>
                  <span class=""><?php echo esc_html($alumax_challenge['image_label']); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($alumax_challenge['image_title'] !== '') : ?>
                <h4 class="font-headline-sm text-headline-sm text-white font-bold">
                  <?php echo esc_html($alumax_challenge['image_title']); ?></h4>
                <?php endif; ?>
                <?php if ($alumax_challenge['image_desc'] !== '') : ?>
                <p class="font-body-sm text-body-sm text-slate-300"><?php echo esc_html($alumax_challenge['image_desc']); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="lg:col-span-7 flex flex-col justify-between space-y-6">
              <div>
                <div
                  class="flex items-center gap-2 text-secondary font-label-md text-label-md uppercase tracking-wider font-semibold mb-2">
                  <span class="material-symbols-outlined text-[18px]">error_outline</span>
                  <span class="">01 // Architectural Challenge</span>
                </div>
                <?php if ($alumax_challenge['heading'] !== '') : ?>
                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">
                  <?php echo esc_html($alumax_challenge['heading']); ?>
                </h2>
                <?php endif; ?>
                <div class="font-body-md text-body-md text-on-surface-variant mt-2 leading-relaxed">
                  <?php
                  if ($alumax_challenge['text'] !== '') {
                      echo wpautop(esc_html($alumax_challenge['text']));
                  } else {
                      the_content();
                  }
                  ?>
                </div>
              </div>
              <?php if (!empty($alumax_challenge['cards'])) : ?>
              <div class="space-y-4">
                <?php foreach ($alumax_challenge['cards'] as $alumax_ci => $alumax_card) : ?>
                <div
                  class="p-5 bg-surface-container-low border border-surface-container hover:bg-surface-container-lowest transition-all rounded-lg space-y-2">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                      <span
                        class="w-8 h-8 rounded-full bg-secondary/10 text-secondary flex items-center justify-center font-label-sm font-bold"><?php printf('%02d', $alumax_ci + 1); ?></span>
                      <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold">
                        <?php echo esc_html($alumax_card['title']); ?></h3>
                    </div>
                  </div>
                  <p class="font-body-sm text-body-sm text-on-surface-variant pl-10 leading-relaxed">
                    <?php echo esc_html($alumax_card['text']); ?>
                  </p>
                </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php if ($alumax_systems) : ?>
          <!-- Module 5: Material Substrates -->
          <div class="space-y-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
              <div>
                <span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-semibold">02 //
                  Material Substrates Matrix</span>
                <?php if ($alumax_systems_intro['heading'] !== '') : ?>
                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">
                  <?php echo esc_html($alumax_systems_intro['heading']); ?>
                </h2>
                <?php endif; ?>
                <?php if ($alumax_systems_intro['text'] !== '') : ?>
                <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                  <?php echo esc_html($alumax_systems_intro['text']); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
              <?php foreach ($alumax_systems as $alumax_system) : ?>
              <div
                class="bg-surface-container-low p-6 rounded-lg border border-surface-container space-y-4 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                  <span class="p-2 rounded bg-secondary/10 text-secondary">
                    <span
                      class="material-symbols-outlined text-[24px]"><?php echo esc_html($alumax_system['icon'] !== '' ? $alumax_system['icon'] : 'view_in_ar'); ?></span>
                  </span>
                  <?php if ($alumax_system['code'] !== '') : ?>
                  <span
                    class="font-mono font-label-sm text-label-sm text-secondary font-bold"><?php echo esc_html($alumax_system['code']); ?></span>
                  <?php endif; ?>
                </div>
                <div>
                  <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold">
                    <?php echo esc_html($alumax_system['title']); ?></h3>
                  <?php if ($alumax_system['subtitle'] !== '') : ?>
                  <p class="font-label-sm text-label-sm text-on-surface-variant mt-0.5">
                    <?php echo esc_html($alumax_system['subtitle']); ?></p>
                  <?php endif; ?>
                </div>
                <?php
                $alumax_spec_lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $alumax_system['specs_text'])));
                if ($alumax_spec_lines) :
                    ?>
                <div
                  class="space-y-2 pt-2 border-t border-surface-container text-body-sm font-body-sm text-on-surface-variant">
                  <?php foreach ($alumax_spec_lines as $alumax_line) :
                      [$alumax_sname, $alumax_svalue] = array_pad(explode('|', $alumax_line, 2), 2, '');
                      ?>
                  <div class="flex justify-between">
                    <span class="text-on-surface-variant"><?php echo esc_html($alumax_sname); ?></span>
                    <span class="font-semibold text-on-surface"><?php echo esc_html($alumax_svalue); ?></span>
                  </div>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if ($alumax_verification) : ?>
          <!-- Module 6: Verification Metrics -->
          <div class="space-y-6 pt-6" id="technical-specifications">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
              <div>
                <span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-semibold">03 //
                  Verification Metrics</span>
                <?php if ($alumax_verification_intro['heading'] !== '') : ?>
                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">
                  <?php echo esc_html($alumax_verification_intro['heading']); ?>
                </h2>
                <?php endif; ?>
                <?php if ($alumax_verification_intro['text'] !== '') : ?>
                <p class="font-body-md text-body-md text-on-surface-variant mt-1">
                  <?php echo esc_html($alumax_verification_intro['text']); ?></p>
                <?php endif; ?>
              </div>
              <div class="flex items-center gap-2">
                <span
                  class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-secondary/10 text-secondary font-label-sm text-label-sm rounded font-semibold">
                  <span class="material-symbols-outlined text-[16px]">verified</span>
                  LAB VERIFIED: EXOVA / CWCT / TUV RHEINLAND
                </span>
              </div>
            </div>
            <div
              class="overflow-x-auto rounded-lg border border-surface-container shadow-sm bg-surface-container-lowest">
              <table class="w-full text-left border-collapse">
                <thead>
                  <tr class="bg-primary text-on-primary font-label-sm text-label-sm uppercase tracking-wider">
                    <th class="p-4 pl-6">Engineering Parameter</th>
                    <th class="p-4 font-mono">Design Requirement</th>
                    <th class="p-4 font-mono">ALUMAX Delivered Test Result</th>
                    <th class="p-4 pr-6 font-mono">Reference Standard</th>
                  </tr>
                </thead>
                <tbody class="font-body-sm text-body-sm text-on-surface divide-y divide-surface-container">
                  <?php foreach ($alumax_verification as $alumax_ri => $alumax_row) : ?>
                  <tr
                    class="<?php echo $alumax_ri % 2 ? 'bg-surface-container-low/40 ' : ''; ?>hover:bg-surface-container-low transition-colors">
                    <td class="p-4 pl-6 font-medium text-on-surface"><?php echo esc_html($alumax_row['param']); ?></td>
                    <td class="p-4 font-mono text-on-surface-variant"><?php echo esc_html($alumax_row['requirement']); ?></td>
                    <td class="p-4 font-mono"><span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-secondary/15 text-secondary font-bold rounded"><span
                          class="material-symbols-outlined text-[14px]">check_circle</span>
                        <?php echo esc_html($alumax_row['result']); ?></span>
                    </td>
                    <td class="p-4 pr-6 font-mono text-on-surface-variant"><?php echo esc_html($alumax_row['standard']); ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <?php endif; ?>
          <?php if ($alumax_downloads) : ?>
          <!-- Module 7: Downloadable Engineering Assets -->
          <div class="bg-[#0d1b2a] text-white p-8 md:p-12 rounded-xl shadow-xl space-y-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-white/10 pb-6">
              <div>
                <span class="font-label-md text-label-md uppercase tracking-wider text-secondary-fixed font-semibold">04
                  // Downloadable Engineering Assets</span>
                <h2 class="font-headline-lg text-headline-lg text-white tracking-tight font-bold mt-1">
                  CAD Blueprints &amp; Technical Submittals
                </h2>
                <p class="font-body-sm text-body-sm text-slate-300 mt-1">Free access for verified Facade consultants,
                  structural engineers &amp; architectural specifiers</p>
              </div>
              <div class="flex items-center gap-2 text-secondary-fixed font-label-sm text-label-sm">
                <span class="material-symbols-outlined text-[16px]">lock_open</span>
                <span class="">VERIFIED SPECIFIER DIRECT ACCESS</span>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
              <?php foreach ($alumax_downloads as $alumax_download) : ?>
              <div
                class="p-6 bg-white/5 border border-white/10 rounded-lg flex flex-col justify-between space-y-6 group hover:bg-white/10 hover:border-secondary transition-all">
                <div class="space-y-3">
                  <div class="flex items-center justify-between">
                    <span class="p-2.5 bg-secondary/15 text-secondary-fixed rounded">
                      <span
                        class="material-symbols-outlined text-[24px]"><?php echo esc_html($alumax_download['icon'] !== '' ? $alumax_download['icon'] : 'download'); ?></span>
                    </span>
                    <?php if ($alumax_download['meta'] !== '') : ?>
                    <span
                      class="font-mono font-label-sm text-label-sm text-secondary-fixed font-semibold"><?php echo esc_html($alumax_download['meta']); ?></span>
                    <?php endif; ?>
                  </div>
                  <h3 class="font-headline-sm text-headline-sm text-white font-semibold">
                    <?php echo esc_html($alumax_download['title']); ?></h3>
                  <?php if ($alumax_download['desc'] !== '') : ?>
                  <p class="font-body-sm text-body-sm text-slate-300 leading-relaxed">
                    <?php echo esc_html($alumax_download['desc']); ?>
                  </p>
                  <?php endif; ?>
                </div>
                <a class="inline-flex items-center justify-between w-full p-3 bg-white/10 hover:bg-secondary hover:text-on-secondary text-white font-label-md text-label-md uppercase tracking-wider transition-all rounded font-semibold"
                  href="<?php echo esc_url($alumax_download['url'] !== '' ? $alumax_download['url'] : '#'); ?>">
                  <span class=""><?php echo esc_html(!empty($alumax_download['btn']) ? $alumax_download['btn'] : 'Download'); ?></span>
                  <span class="material-symbols-outlined text-[18px]">download</span>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </section>
      <!-- Module 9: Portfolio Context（随机其它案例） -->
      <section class="w-full bg-surface-container-low py-16 md:py-24">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin space-y-12">
          <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
              <span class="font-label-md text-label-md uppercase tracking-wider text-secondary font-semibold">Portfolio
                Context</span>
              <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">
                Related International Envelope Projects
              </h2>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            <?php
            $related_cases = new WP_Query([
                'post_type'      => 'case',
                'posts_per_page' => 3,
                'post__not_in'   => [get_the_ID()],
                'orderby'        => 'rand',
            ]);
            ?>
            <?php while ($related_cases->have_posts()) : $related_cases->the_post(); ?>
            <?php
            $alumax_rel_header = get_post_meta(get_the_ID(), 'alumax_case_header', true);
            $alumax_rel_location = is_array($alumax_rel_header) && !empty($alumax_rel_header['location']) ? $alumax_rel_header['location'] : '';
            $alumax_rel_tagline = is_array($alumax_rel_header) && !empty($alumax_rel_header['card_tagline']) ? $alumax_rel_header['card_tagline'] : '';
            $alumax_rel_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <div
              class="bg-surface-container-lowest group overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col">
              <div class="relative h-60 overflow-hidden bg-primary">
                <?php if ($alumax_rel_img) : ?>
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                  alt="<?php echo esc_attr(get_the_title()); ?>"
                  src="<?php echo esc_url($alumax_rel_img); ?>">
                <?php endif; ?>
                <?php if ($alumax_rel_location !== '') : ?>
                <div
                  class="absolute top-3 left-3 bg-primary/90 text-on-primary font-label-sm text-label-sm px-2.5 py-1">
                  <?php echo esc_html($alumax_rel_location); ?>
                </div>
                <?php endif; ?>
              </div>
              <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                <div>
                  <?php if ($alumax_rel_tagline !== '') : ?>
                  <span
                    class="font-label-sm text-label-sm text-secondary uppercase font-semibold"><?php echo esc_html($alumax_rel_tagline); ?></span>
                  <?php endif; ?>
                  <h3
                    class="font-headline-sm text-headline-sm text-on-surface mt-1 group-hover:text-secondary transition-colors">
                    <?php echo esc_html(get_the_title()); ?>
                  </h3>
                  <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">
                    <?php echo esc_html(get_the_excerpt()); ?>
                  </p>
                </div>
                <a class="inline-flex items-center gap-2 font-label-md text-label-md uppercase tracking-wider text-on-surface hover:text-secondary font-semibold"
                  data-path="projects" href="<?php echo esc_url(get_permalink()); ?>">
                  <span class="">View Case Study</span>
                  <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
              </div>
            </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        </div>
      </section>
      <!-- ENGINEERING FAST-TRACK RFQ CONSULTATION SECTION -->
      <section class="w-full bg-primary-container text-on-primary py-20" id="rfq-section">
        <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
            <div class="lg:col-span-5 space-y-6">
              <div
                class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/15 text-secondary font-label-sm text-label-sm tracking-widest uppercase">
                Direct Technical Inquiry
              </div>
              <h2 class="font-display-lg text-display-lg tracking-tight text-on-primary">
                Specify ALUMAX on Your Next High-Rise
              </h2>
              <p class="font-body-md text-body-md text-on-primary-container leading-relaxed">
                Connect with our lead Facade structural engineers to discuss thermal calculations, windload simulations,
                parametric curved geometries, and export pricing schedules.
              </p>
              <div class="space-y-4 pt-2">
                <div class="flex items-center gap-3">
                  <span class="w-8 h-8 rounded-full bg-secondary/15 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                  </span>
                  <span class="font-body-sm text-body-sm text-on-primary">Complimentary Preliminary Wind &amp; Thermal
                    FEA Analysis</span>
                </div>
                <div class="flex items-center gap-3">
                  <span class="w-8 h-8 rounded-full bg-secondary/15 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-[18px]">view_in_ar</span>
                  </span>
                  <span class="font-body-sm text-body-sm text-on-primary">Custom Physical Mockup Sample Shipped via DHL
                    in 72h</span>
                </div>
                <div class="flex items-center gap-3">
                  <span class="w-8 h-8 rounded-full bg-secondary/15 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-[18px]">history_edu</span>
                  </span>
                  <span class="font-body-sm text-body-sm text-on-primary">Full Compliance with BS 8414, ASTM E84 &amp;
                    EN 13501 Standards</span>
                </div>
              </div>
            </div>
            <div class="lg:col-span-7 bg-surface-container-lowest p-8 md:p-10 text-on-surface shadow-xl">
              <form class="space-y-6" id="project-rfq-form"
                onsubmit="event.preventDefault(); document.getElementById('form-success').classList.remove('hidden'); document.getElementById('form-fields').classList.add('hidden');">
                <div class="space-y-6" id="form-fields">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                      <label class="font-label-md text-label-md uppercase text-on-surface tracking-wider block">
                        Your Name <span class="text-secondary">*</span>
                      </label>
                      <input
                        class="w-full h-11 px-3.5 bg-surface text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-1 focus:ring-secondary"
                        placeholder="e.g. Tariq Al-Mansoor" required="" type="text">
                    </div>
                    <div class="space-y-2">
                      <label class="font-label-md text-label-md uppercase text-on-surface tracking-wider block">
                        Professional Email <span class="text-secondary">*</span>
                      </label>
                      <input
                        class="w-full h-11 px-3.5 bg-surface text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-1 focus:ring-secondary"
                        placeholder="name@consultancy-firm.com" required="" type="email">
                    </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                      <label class="font-label-md text-label-md uppercase text-on-surface tracking-wider block">
                        Project Location / City <span class="text-secondary">*</span>
                      </label>
                      <input
                        class="w-full h-11 px-3.5 bg-surface text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-1 focus:ring-secondary"
                        placeholder="e.g. Riyadh, Dubai, or London" required="" type="text">
                    </div>
                    <div class="space-y-2">
                      <label class="font-label-md text-label-md uppercase text-on-surface tracking-wider block">
                        Est. Facade Area (m²)
                      </label>
                      <input
                        class="w-full h-11 px-3.5 bg-surface text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-1 focus:ring-secondary"
                        placeholder="e.g. 15,000 m²" type="text">
                    </div>
                  </div>
                  <div class="space-y-2">
                    <label class="font-label-md text-label-md uppercase text-on-surface tracking-wider block">
                      Applicable Envelope Systems
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 pt-1 font-body-sm text-body-sm">
                      <label class="flex items-center gap-2 cursor-pointer">
                        <input checked="" class="accent-secondary" type="checkbox">
                        <span class="">Motorized Louvers</span>
                      </label>
                      <label class="flex items-center gap-2 cursor-pointer">
                        <input checked="" class="accent-secondary" type="checkbox">
                        <span class="">Curved Spandrels</span>
                      </label>
                      <label class="flex items-center gap-2 cursor-pointer">
                        <input class="accent-secondary" type="checkbox">
                        <span class="">Honeycomb Panels</span>
                      </label>
                      <label class="flex items-center gap-2 cursor-pointer">
                        <input class="accent-secondary" type="checkbox">
                        <span class="">Corrugated Core</span>
                      </label>
                      <label class="flex items-center gap-2 cursor-pointer">
                        <input class="accent-secondary" type="checkbox">
                        <span class="">Solid Cladding</span>
                      </label>
                      <label class="flex items-center gap-2 cursor-pointer">
                        <input class="accent-secondary" type="checkbox">
                        <span class="">Architectural Grilles</span>
                      </label>
                    </div>
                  </div>
                  <div class="space-y-2">
                    <label class="font-label-md text-label-md uppercase text-on-surface tracking-wider block">
                      Upload Drawing / Architectural Brief (Optional)
                    </label>
                    <div
                      class="p-4 bg-surface flex flex-col items-center justify-center text-center cursor-pointer hover:bg-surface-container transition-colors">
                      <span class="material-symbols-outlined text-[28px] text-secondary">cloud_upload</span>
                      <span class="font-label-sm text-label-sm text-on-surface mt-1">Drag DWG, RVT, or PDF files here,
                        or browse</span>
                      <span class="font-label-sm text-label-sm text-on-surface-variant">Max file size: 50MB</span>
                    </div>
                  </div>
                  <button
                    class="w-full py-4 bg-primary text-on-primary hover:bg-secondary hover:text-on-secondary font-headline-sm text-headline-sm uppercase tracking-wider transition-all flex items-center justify-center gap-2"
                    type="submit">
                    <span class="">Submit Engineering Consultation Request</span>
                    <span class="material-symbols-outlined text-[20px]">send</span>
                  </button>
                </div>
                <!-- Submission Confirmation State -->
                <div class="hidden p-8 text-center space-y-4" id="form-success">
                  <div
                    class="w-12 h-12 bg-secondary/15 text-secondary mx-auto flex items-center justify-center rounded-full">
                    <span class="material-symbols-outlined text-[28px]">check_circle</span>
                  </div>
                  <h3 class="font-headline-md text-headline-md text-on-surface">Consultation Request Received</h3>
                  <p class="font-body-md text-body-md text-on-surface-variant max-w-md mx-auto">
                    Thank you for your submission. An ALUMAX Senior Facade Technical Specialist from our Dubai &amp;
                    Foshan engineering teams will review your specifications and contact you within 24 business hours.
                  </p>
                  <button
                    class="px-4 py-2 bg-surface-container text-on-surface font-label-md text-label-md uppercase tracking-wider"
                    onclick="document.getElementById('form-success').classList.add('hidden'); document.getElementById('form-fields').classList.remove('hidden');"
                    type="button">
                    Submit Another Specification
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
<?php endwhile; ?>
<?php get_footer(); ?>
