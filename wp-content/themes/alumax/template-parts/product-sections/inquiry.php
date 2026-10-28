<?php
if (!defined('ABSPATH')) { exit; }

// 询价和技术询问（RFQ）：深蓝底，左侧价值点 + 右侧询盘表单卡
// 表单提交到 admin-post.php（action=alumax_inquiry），数据存 CPT inquiry，后台「产品 → 询价记录」查看
// $args:
//   eyebrow, title, description
//   bullets      [ [icon, title, text], ... ] 左侧 3 个价值点
//   form_title, form_badge
//   products     [ [label, checked(bool)], ... ] Product Interest 单选
//   submit_label 提交按钮文案
$alumax_r = $args;
$alumax_status = isset($_GET['inquiry']) ? sanitize_key($_GET['inquiry']) : '';
?>
<section class="w-full bg-primary-container text-on-primary py-16 lg:py-24" id="rfq-section">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
      <!-- Left: Value Propositions -->
      <div class="lg:col-span-5 flex flex-col">
        <span class="font-label text-xs font-semibold tracking-widest text-secondary-fixed uppercase mb-2"><?php echo esc_html($alumax_r['eyebrow']); ?></span>
        <h2 class="font-headline font-bold text-3xl sm:text-4xl text-on-primary tracking-tight mb-4">
          <?php echo esc_html($alumax_r['title']); ?>
        </h2>
        <p class="font-body text-sm text-on-primary-container leading-relaxed mb-8">
          <?php echo esc_html($alumax_r['description']); ?>
        </p>
        <div class="flex flex-col space-y-5">
          <?php foreach ($alumax_r['bullets'] as $alumax_bullet) : ?>
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 rounded-sm bg-surface-container-highest/20 text-secondary-fixed flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[20px]"><?php echo esc_html($alumax_bullet['icon']); ?></span>
              </div>
              <div class="flex flex-col">
                <span class="font-headline font-semibold text-sm text-on-primary"><?php echo esc_html($alumax_bullet['title']); ?></span>
                <span class="font-body text-xs text-on-primary-container"><?php echo esc_html($alumax_bullet['text']); ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <!-- Right: RFQ Form Card -->
      <div class="lg:col-span-7">
        <div class="bg-surface-container-lowest text-on-surface p-6 sm:p-10 shadow-xl">
          <div class="flex items-center justify-between pb-4 border-b border-surface-variant mb-6">
            <h3 class="font-headline font-bold text-lg text-primary"><?php echo esc_html($alumax_r['form_title']); ?></h3>
            <?php if (!empty($alumax_r['form_badge'])) : ?>
              <span class="font-label text-xs text-secondary font-semibold"><?php echo esc_html($alumax_r['form_badge']); ?></span>
            <?php endif; ?>
          </div>
          <?php if ($alumax_status === 'success') : ?>
            <div class="flex items-center gap-3 bg-[#e7f4e9] border border-[#7ac38a] text-[#1e5c2e] p-4 mb-5">
              <span class="material-symbols-outlined text-[20px]">check_circle</span>
              <span class="font-body text-xs font-semibold">Thank you. Your RFQ has been received — our engineering team will respond within 24 business hours.</span>
            </div>
          <?php elseif ($alumax_status === 'error') : ?>
            <div class="flex items-center gap-3 bg-error-container border border-error text-on-error-container p-4 mb-5">
              <span class="material-symbols-outlined text-[20px]">error</span>
              <span class="font-body text-xs font-semibold">Submission failed. Please check the required fields (name &amp; valid business email) and try again.</span>
            </div>
          <?php endif; ?>
          <form class="flex flex-col space-y-4" id="alumax-inquiry-form" method="post" enctype="multipart/form-data" novalidate
            action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="alumax_inquiry">
            <input type="hidden" name="inquiry_page" value="<?php echo esc_attr(get_the_title()); ?>">
            <?php wp_nonce_field('alumax_inquiry_submit', 'alumax_inquiry_nonce'); ?>
            <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
              <input type="text" name="inquiry_website" tabindex="-1" autocomplete="off">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="flex flex-col">
                <label class="font-label text-xs uppercase tracking-wider text-on-surface-variant mb-1">Full Name
                  <span class="text-secondary">*</span></label>
                <input class="h-11 px-3 bg-surface-container-lowest border border-outline-variant focus:border-secondary focus:outline-none font-body text-xs text-on-surface"
                  id="alumax-inquiry-name" name="inquiry_name" placeholder="e.g. David Mueller" required type="text">
                <span class="alumax-field-hint font-label text-[10px] text-error mt-1">* Required</span>
              </div>
              <div class="flex flex-col">
                <label class="font-label text-xs uppercase tracking-wider text-on-surface-variant mb-1">Business Email
                  <span class="text-secondary">*</span></label>
                <input class="h-11 px-3 bg-surface-container-lowest border border-outline-variant focus:border-secondary focus:outline-none font-body text-xs text-on-surface"
                  id="alumax-inquiry-email" name="inquiry_email" placeholder="name@company.com" required type="email">
                <span class="alumax-field-hint font-label text-[10px] text-error mt-1">* Required</span>
              </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="flex flex-col">
                <label class="font-label text-xs uppercase tracking-wider text-on-surface-variant mb-1">Company / Architecture Firm</label>
                <input class="h-11 px-3 bg-surface-container-lowest border border-outline-variant focus:border-secondary focus:outline-none font-body text-xs text-on-surface"
                  name="inquiry_company" placeholder="e.g. Atelier Foster Façades" type="text">
              </div>
              <div class="flex flex-col">
                <label class="font-label text-xs uppercase tracking-wider text-on-surface-variant mb-1">Destination Country / Port</label>
                <input class="h-11 px-3 bg-surface-container-lowest border border-outline-variant focus:border-secondary focus:outline-none font-body text-xs text-on-surface"
                  name="inquiry_country" placeholder="e.g. Singapore / Hamburg / Dubai" type="text">
              </div>
            </div>
            <div class="flex flex-col">
              <label class="font-label text-xs uppercase tracking-wider text-on-surface-variant mb-1">Project Details &amp; Dimensions</label>
              <textarea class="p-3 bg-surface-container-lowest border border-outline-variant focus:border-secondary focus:outline-none font-body text-xs text-on-surface"
                name="inquiry_message"
                placeholder="Tell us about your project (estimated area in m², blade profile preferred, wind load criteria, installation timeline)..."
                rows="3"></textarea>
            </div>
            <div class="flex flex-col">
              <label class="font-label text-xs uppercase tracking-wider text-on-surface-variant mb-1">Upload Drawings (Optional)</label>
              <label for="alumax-inquiry-file" class="border border-dashed border-outline-variant p-4 text-center bg-surface-container-low hover:bg-surface-container transition-colors cursor-pointer flex flex-col items-center justify-center">
                <span class="material-symbols-outlined text-secondary text-[24px]">cloud_upload</span>
                <span class="font-body text-xs font-semibold text-on-surface mt-1" id="alumax-inquiry-file-label">Click to select CAD / PDF / ZIP file</span>
                <span class="font-label text-[10px] text-on-surface-variant">Max 25MB (.DWG, .DXF, .RVT, .PDF, .ZIP)</span>
              </label>
              <input class="hidden" id="alumax-inquiry-file" name="inquiry_file" type="file" accept=".dwg,.dxf,.rvt,.pdf,.zip">
            </div>
            <div class="pt-2">
              <button class="w-full h-12 bg-primary-container text-on-primary font-headline text-xs font-semibold uppercase tracking-wider hover:bg-secondary hover:text-on-secondary transition-colors duration-200 flex items-center justify-center gap-2 shadow-sm"
                type="submit">
                <span><?php echo esc_html($alumax_r['submit_label'] ?? 'Submit Inquiry & Request Pricing'); ?></span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </button>
            </div>
          </form>
          <script>
            (function () {
              // 提交结果横幅只显示一次：清掉 URL 里的 inquiry 参数，刷新后不再出现
              if (window.history.replaceState) {
                var url = new URL(window.location.href);
                if (url.searchParams.has('inquiry')) {
                  url.searchParams.delete('inquiry');
                  window.history.replaceState(null, '', url.toString());
                }
              }

              var input = document.getElementById('alumax-inquiry-file');
              var label = document.getElementById('alumax-inquiry-file-label');
              if (input && label) {
                input.addEventListener('change', function () {
                  label.textContent = input.files.length ? input.files[0].name : 'Click to select CAD / PDF / ZIP file';
                });
              }

              // 必填校验 + fetch 提交：静态导出后直接调 WP REST 接口，数据仍入后台「询价记录」
              var form = document.getElementById('alumax-inquiry-form');
              if (!form) { return; }
              var api = <?php echo wp_json_encode(rest_url('alumax/v1/inquiry')); ?>;
              var fields = [
                {
                  el: document.getElementById('alumax-inquiry-name'),
                  test: function (el) { return el.value.trim() !== ''; },
                  message: 'Please enter your full name.'
                },
                {
                  el: document.getElementById('alumax-inquiry-email'),
                  test: function (el) { return el.value.trim() !== '' && el.checkValidity(); },
                  message: 'Please enter a valid business email.'
                }
              ];
              fields.forEach(function (f) {
                if (!f.el) { return; }
                f.hint = f.el.parentElement.querySelector('.alumax-field-hint');
                f.el.addEventListener('input', function () {
                  f.el.classList.remove('border-error');
                  if (f.hint) { f.hint.textContent = '* Required'; }
                });
              });

              function showBanner(ok) {
                var old = document.getElementById('alumax-inquiry-banner');
                if (old) { old.remove(); }
                var div = document.createElement('div');
                div.id = 'alumax-inquiry-banner';
                div.className = ok
                  ? 'flex items-center gap-3 bg-[#e7f4e9] border border-[#7ac38a] text-[#1e5c2e] p-4 mb-5'
                  : 'flex items-center gap-3 bg-error-container border border-error text-on-error-container p-4 mb-5';
                div.innerHTML = '<span class="material-symbols-outlined text-[20px]">' + (ok ? 'check_circle' : 'error') + '</span>'
                  + '<span class="font-body text-xs font-semibold">' + (ok
                    ? 'Thank you. Your RFQ has been received — our engineering team will respond within 24 business hours.'
                    : 'Submission failed. Please check the required fields (name &amp; valid business email) and try again.') + '</span>';
                form.parentElement.insertBefore(div, form);
                div.scrollIntoView({ behavior: 'smooth', block: 'center' });
              }

              form.addEventListener('submit', function (e) {
                e.preventDefault();
                var firstInvalid = null;
                fields.forEach(function (f) {
                  if (!f.el) { return; }
                  var valid = f.test(f.el);
                  f.el.classList.toggle('border-error', !valid);
                  if (f.hint) { f.hint.textContent = valid ? '* Required' : f.message; }
                  if (!valid && !firstInvalid) { firstInvalid = f.el; }
                });
                if (firstInvalid) { firstInvalid.focus(); return; }

                var btn = form.querySelector('button[type="submit"]');
                if (btn) { btn.disabled = true; btn.classList.add('opacity-60'); }
                fetch(api, { method: 'POST', body: new FormData(form) })
                  .then(function (res) { return res.json(); })
                  .then(function (data) {
                    var ok = data && data.status === 'success';
                    showBanner(ok);
                    if (ok) {
                      form.reset();
                      if (label) { label.textContent = 'Click to select CAD / PDF / ZIP file'; }
                    }
                  })
                  .catch(function () { showBanner(false); })
                  .finally(function () {
                    if (btn) { btn.disabled = false; btn.classList.remove('opacity-60'); }
                  });
              });
            })();
          </script>
        </div>
      </div>
    </div>
  </div>
</section>
