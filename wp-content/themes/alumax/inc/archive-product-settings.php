<?php

if (!defined('ABSPATH')) {
    exit;
}

function alumax_pa_defaults() {
    return [
        // Hero 页头
        'hero_title' => 'Engineered Architectural Metal & Facade Cladding Systems',
        'hero_subtitle' => 'Precision-manufactured aluminum alloys and cold-rolled steel building envelopes tailored for international curtain wall contractors, facade consultants, and commercial mega-projects. Engineered to withstand peak cyclonic wind pressures and stringent international fire safety mandates.',
        // 页头右侧快捷入口
        'cta1_title' => 'Master Spec Book',
        'cta1_sub' => 'PDF Catalog, 42MB (Metric & Imperial)',
        'cta1_url' => '#technical-resources',
        'cta2_title' => 'Request Sample Box',
        'cta2_sub' => 'Includes 6 finishes & core mockups',
        'cta2_url' => '#rfq-section',
        // 产品列表板块
        'catalog_eyebrow' => 'Structural Facade Portfolio',
        'catalog_title' => 'Architectural Metal Catalog',
        // 性能对比板块
        'bench_eyebrow' => 'Engineering Selection Matrix',
        'bench_title' => 'Material Performance Benchmark',
        'bench_subtitle' => 'Compare core structural parameters across primary curtain wall panel architectures to determine the optimal balance of wind-load resistance, planarity, and mass.',
        'bench_note' => 'Verified under ASTM E330 & EN 13830 standards',
        // 认证徽章板块
        'cert_eyebrow' => 'Third-Party Testing & Verification',
        'cert_title' => 'Conforming to International Building Codes',
        // 询价表单板块
        'rfq_badge' => 'Direct Facade Engineering Desk',
        'rfq_title' => 'Need Custom Dimensions, Perforation Patterns, or Engineered Mock-ups?',
        'rfq_subtitle' => 'Submit your project schedule, wind-load parameters, or architectural elevations. Our technical facade team responds with preliminary structural sizing, BIM details (LOD 400), and formal CIF/FOB export pricing within 24 business hours.',
        'rfq_form_title' => 'Request Architectural Consultation & Tender Pricing',
        'rfq_form_subtitle' => 'Complete the engineering fields below for custom production runs and export quotation.',
    ];
}

function alumax_pa_fields() {
    $text = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'text'];
    };
    $textarea = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'textarea'];
    };
    $url = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'url'];
    };

    return [
        'hero' => [
            'label' => '页头（Hero）',
            'fields' => [
                $text('hero_title', '主标题'),
                $textarea('hero_subtitle', '副标题'),
            ],
        ],
        'cta' => [
            'label' => '页头右侧快捷入口（标题留空则该入口隐藏）',
            'fields' => [
                $text('cta1_title', '入口 1 标题'),
                $text('cta1_sub', '入口 1 说明'),
                $url('cta1_url', '入口 1 链接'),
                $text('cta2_title', '入口 2 标题'),
                $text('cta2_sub', '入口 2 说明'),
                $url('cta2_url', '入口 2 链接'),
            ],
        ],
        'catalog' => [
            'label' => '产品列表板块',
            'fields' => [
                $text('catalog_eyebrow', '眉标（小标签）'),
                $text('catalog_title', '标题'),
            ],
        ],
        'bench' => [
            'label' => '性能对比板块（对比表格内容需改模板文件）',
            'fields' => [
                $text('bench_eyebrow', '眉标（小标签）'),
                $text('bench_title', '标题'),
                $textarea('bench_subtitle', '副标题'),
                $text('bench_note', '右侧认证说明'),
            ],
        ],
        'cert' => [
            'label' => '认证徽章板块（6 个徽章需改模板文件）',
            'fields' => [
                $text('cert_eyebrow', '眉标（小标签）'),
                $text('cert_title', '标题'),
            ],
        ],
        'rfq' => [
            'label' => '询价表单板块',
            'fields' => [
                $text('rfq_badge', '徽章文字'),
                $text('rfq_title', '标题'),
                $textarea('rfq_subtitle', '副标题'),
                $text('rfq_form_title', '表单标题'),
                $text('rfq_form_subtitle', '表单说明'),
            ],
        ],
    ];
}

function alumax_pa($key) {
    static $opts = null;
    if ($opts === null) {
        $opts = wp_parse_args(get_option('alumax_product_archive', []), alumax_pa_defaults());
    }
    return $opts[$key] ?? '';
}

add_action('admin_menu', function () {
    add_submenu_page(
        'edit.php?post_type=product',
        '产品中心页面设置',
        '页面设置',
        'manage_options',
        'alumax-product-archive',
        'alumax_pa_settings_page'
    );
});

add_action('admin_init', function () {
    register_setting('alumax_product_archive', 'alumax_product_archive', [
        'sanitize_callback' => 'alumax_pa_sanitize',
    ]);
});

function alumax_pa_sanitize($input) {
    $output = [];
    $input = is_array($input) ? $input : [];

    foreach (alumax_pa_fields() as $group) {
        foreach ($group['fields'] as $field) {
            $key = $field['key'];
            $value = $input[$key] ?? '';
            switch ($field['type']) {
                case 'textarea':
                    $output[$key] = sanitize_textarea_field($value);
                    break;
                case 'url':
                    $output[$key] = esc_url_raw($value);
                    break;
                default:
                    $output[$key] = sanitize_text_field($value);
            }
        }
    }

    return $output;
}

function alumax_pa_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    $opts = wp_parse_args(get_option('alumax_product_archive', []), alumax_pa_defaults());
    ?>
    <div class="wrap">
      <h1>产品中心页面设置</h1>
      <p>这里的每一项对应产品中心列表页（/products/）的一个模块文案；留空会显示默认值。产品卡片自动读取「产品」文章，无需在此设置；筛选标签、对比表格和认证徽章的内容仍需修改模板文件。</p>
      <form method="post" action="options.php">
        <?php settings_fields('alumax_product_archive'); ?>
        <?php foreach (alumax_pa_fields() as $group) : ?>
          <h2 style="margin-top:2em;border-bottom:1px solid #c3c4c7;padding-bottom:.4em;"><?php echo esc_html($group['label']); ?></h2>
          <table class="form-table" role="presentation">
            <?php foreach ($group['fields'] as $field) :
                $key = $field['key'];
                $value = $opts[$key] ?? '';
                ?>
              <tr>
                <th scope="row"><label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                  <?php if ($field['type'] === 'textarea') : ?>
                    <textarea id="<?php echo esc_attr($key); ?>" name="alumax_product_archive[<?php echo esc_attr($key); ?>]" rows="3" class="large-text"><?php echo esc_textarea($value); ?></textarea>
                  <?php else : ?>
                    <input type="text" id="<?php echo esc_attr($key); ?>" name="alumax_product_archive[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="large-text">
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        <?php endforeach; ?>
        <?php submit_button(); ?>
      </form>
    </div>
    <?php
}
