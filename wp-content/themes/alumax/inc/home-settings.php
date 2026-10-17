<?php

if (!defined('ABSPATH')) {
    exit;
}

function alumax_home_defaults() {
    return [
        // Hero
        'hero_badge' => 'Next-Generation Architectural Envelopes & Solar Shading',
        'hero_title' => 'Engineered Architectural Metals & Adaptive Facade Systems',
        'hero_subtitle' => 'World-class OEM/ODM manufacturer delivering precision-engineered motorized sunshades, ultra-flat honeycomb composite panels, and solid aluminum curtain walls built to withstand extreme windloads and seismic conditions.',
        'hero_link_url' => '',
        'hero_stat1_value' => 'A2',
        'hero_stat1_label' => 'ASTM E84 Class A Fire Code',
        'hero_stat2_value' => '25-Yr',
        'hero_stat2_label' => 'Fluorocarbon PVDF Warranty',
        'hero_stat3_value' => '1,200+',
        'hero_stat3_label' => 'Landmark Installations',
        'hero_stat4_value' => '60+',
        'hero_stat4_label' => 'Countries Supplied',
        'hero_slide1_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDAzjju-ydUmitWslhrr0mA1qamRtzU6zGsa3F4Rg1IQP2_Zwol1uS4XGtaXiR83eloxmYfk1PCT3IO-wYBtUbVCTKvpYklnffhYaVZ_sS9ClJKQhRXlpV97SpSldtJRIfTh_JxTRkhuSw0ePcHPBF_jjzTGwrlvcK-400-m3i2PflHYCwvGIYJwF3NyybHveT6NCdoq_-Jnl8k4PwD57OqCuaSCvg0lGYeqO6zlR97QMBTAQ78sRfP',
        'hero_slide1_title' => '1. Kinetic Intelligent Facade',
        'hero_slide1_sub' => 'Automated Motorized Sunshades',
        'hero_slide2_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB8wuyzUaiCDi4lc20UMHFnTqoxEpEgReYPtYYlM1LahFedp1QHaxFSgTMgUtrzpqIXbCytDJQnBQ1uB2xhui_9XBZ0plu1nrJ6Gao1cNGJDZZzE8UPZmmlq6rS0jMNEhXj9BiWp5GwZ_QqVURejkBZMzAdqnuITSCWquVDWErDQ1s_GgUVHyWtGySMK5OYFXkSWkUQEUK8CfCc3e75bV9nwiaxf5zTzhNpyKTEanP5HJJg9-E2_lKW',
        'hero_slide2_title' => '2. Landmark Airport Canopy',
        'hero_slide2_sub' => 'Dubai Concourse Honeycomb',
        'hero_slide3_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBM-pEeC3oGTrZ1GQvz14eind6a-1BuRjK-RSWNEXkZer_QhGLD3oTbaL60gBpIAyRhaxBwtcA-I-uyPxbXOpQ4nb_CScmx8Qg_ppQ5zqtTybrvcSXlYMmLTj4VS84D5Srq4MqsVujt7u1jsGxxxrkf0yZGUudF1SBycw4tzEA6bDIkLfpjd0vr2rGwbVoeAJUjq2AFKocQqoZ9_Ue0q1A7pGJhXZBLP8UlKusNVQrf8mcOeka1JHCO',
        'hero_slide3_title' => '3. Hyperboloid Metal Tower',
        'hero_slide3_sub' => 'Curved Solid Aluminum Panels',
        // Section 2: Surface Finishes
        's2_eyebrow' => 'Surface Engineering & Durability',
        's2_title' => 'ARCHITECTURAL SURFACE FINISHES & COATING STANDARDS',
        's2_subtitle' => 'Certified under AAMA 2605, QUALICOAT & ASTM standards for 30-year coastal & extreme weather durability.',
        // Section 3: Products
        's3_eyebrow' => 'Engineered Systems Portfolio',
        's3_title' => 'FEATURED ARCHITECTURAL ENVELOPE & FACADE SYSTEMS',
        's3_subtitle' => 'Precision-engineered aluminum panels, structural composites, and motorized sun-shading solutions for international landmarks.',
        // Section 4: Manufacturing
        's4_eyebrow' => 'Heavy Industrial Manufacturing Capacity',
        's4_title' => '150,000 m² Monthly Output • 6 Automated CNC Lines • Zero-Defect QC',
        's4_subtitle' => 'Continuous 85,000 m² smart metal fabrication campus equipped with German Trumpf laser cutters and Japanese automated Ransburg vertical coating towers.',
        // Section 5: Landmark Projects
        's5_eyebrow' => 'Global Project References',
        's5_title' => '1,200+ Projects Completed Across 6 Continents',
        // Section 6: Technical Resources
        's6_eyebrow' => 'Architect & Engineer Download Center',
        's6_title' => 'Facade Engineering Tools, CAD/BIM & Test Certifications',
        's6_subtitle' => 'Direct access to official laboratory test certificates, wind-load calculation whitepapers, and standard joint detail drawings.',
        // Section 7: Global Presence
        's7_eyebrow' => 'Worldwide Export Logistics Footprint',
        's7_title' => 'Delivering Certified Façades to Over 60 Countries',
        's7_subtitle' => 'Supported by localized regional liaison offices and distribution hubs in Dubai, Rotterdam, Singapore, and Houston.',
        // Section 8: Fast RFQ
        's8_eyebrow' => 'Complimentary Architect Sample Kit',
        's8_title' => 'Get a Project Estimate & Sample Box Within 24h',
        's8_subtitle' => 'Send us your project drawings (DWG/BIM/PDF) or specification schedules. Our international facade estimating team will provide an itemized FOB/CIF quotation within one working day.',
    ];
}

function alumax_home_fields() {
    $text = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'text'];
    };
    $textarea = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'textarea'];
    };
    $url = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'url'];
    };
    $image = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'image'];
    };

    $groups = [
        'hero' => [
            'label' => 'Hero 首屏',
            'fields' => [
                $text('hero_badge', '徽章文字'),
                $text('hero_title', '主标题'),
                $textarea('hero_subtitle', '副标题'),
                $url('hero_link_url', '整屏链接地址'),
            ],
        ],
        'hero_stats' => [
            'label' => 'Hero 指标卡',
            'fields' => [],
        ],
        'hero_slides' => [
            'label' => 'Hero 轮播（3 张）',
            'fields' => [],
        ],
        's2' => ['label' => 'Section 2 · 表面处理', 'fields' => []],
        's3' => ['label' => 'Section 3 · 产品展示', 'fields' => []],
        's4' => ['label' => 'Section 4 · 制造能力', 'fields' => []],
        's5' => ['label' => 'Section 5 · 地标案例', 'fields' => []],
        's6' => ['label' => 'Section 6 · 技术资料', 'fields' => []],
        's7' => ['label' => 'Section 7 · 全球布局', 'fields' => []],
        's8' => ['label' => 'Section 8 · 快速询价', 'fields' => []],
    ];

    for ($i = 1; $i <= 4; $i++) {
        $groups['hero_stats']['fields'][] = $text("hero_stat{$i}_value", "指标 {$i} 数值");
        $groups['hero_stats']['fields'][] = $text("hero_stat{$i}_label", "指标 {$i} 说明");
    }

    for ($i = 1; $i <= 3; $i++) {
        $groups['hero_slides']['fields'][] = $image("hero_slide{$i}_image", "轮播 {$i} 图片");
        $groups['hero_slides']['fields'][] = $text("hero_slide{$i}_title", "轮播 {$i} 标题");
        $groups['hero_slides']['fields'][] = $text("hero_slide{$i}_sub", "轮播 {$i} 副标题");
    }

    foreach (['s2', 's3', 's4', 's5', 's6', 's7', 's8'] as $s) {
        $groups[$s]['fields'][] = $text("{$s}_eyebrow", '眉标（小标签）');
        $groups[$s]['fields'][] = $text("{$s}_title", '标题');
        if ($s !== 's5') {
            $groups[$s]['fields'][] = $textarea("{$s}_subtitle", '副标题');
        }
    }

    return $groups;
}

function alumax_home($key) {
    static $opts = null;
    if ($opts === null) {
        $opts = wp_parse_args(get_option('alumax_home', []), alumax_home_defaults());
    }
    return $opts[$key] ?? '';
}

add_action('admin_menu', function () {
    add_menu_page(
        '首页设置',
        '首页设置',
        'manage_options',
        'alumax-home',
        'alumax_home_settings_page',
        'dashicons-admin-home',
        30
    );
});

add_action('admin_init', function () {
    register_setting('alumax_home', 'alumax_home', [
        'sanitize_callback' => 'alumax_home_sanitize',
    ]);
});

function alumax_home_sanitize($input) {
    $output = [];
    $input = is_array($input) ? $input : [];

    foreach (alumax_home_fields() as $group) {
        foreach ($group['fields'] as $field) {
            $key = $field['key'];
            $value = $input[$key] ?? '';
            switch ($field['type']) {
                case 'textarea':
                    $output[$key] = sanitize_textarea_field($value);
                    break;
                case 'url':
                case 'image':
                    $output[$key] = esc_url_raw($value);
                    break;
                default:
                    $output[$key] = sanitize_text_field($value);
            }
        }
    }

    return $output;
}

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'toplevel_page_alumax-home') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('jquery');
});

function alumax_home_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    $opts = wp_parse_args(get_option('alumax_home', []), alumax_home_defaults());
    ?>
    <div class="wrap">
      <h1>首页设置</h1>
      <p>这里的每一项对应首页的一个模块内容；留空会显示默认值。产品卡片和案例卡片自动读取「产品」「案例」文章，无需在此设置。</p>
      <form method="post" action="options.php">
        <?php settings_fields('alumax_home'); ?>
        <?php foreach (alumax_home_fields() as $group) : ?>
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
                    <textarea id="<?php echo esc_attr($key); ?>" name="alumax_home[<?php echo esc_attr($key); ?>]" rows="3" class="large-text"><?php echo esc_textarea($value); ?></textarea>
                  <?php elseif ($field['type'] === 'image') : ?>
                    <div class="alumax-image-field">
                      <input type="text" id="<?php echo esc_attr($key); ?>" name="alumax_home[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="large-text alumax-image-url">
                      <p>
                        <button type="button" class="button alumax-image-select">选择图片</button>
                      </p>
                      <img class="alumax-image-preview" src="<?php echo esc_url($value); ?>" style="max-width:240px;height:auto;<?php echo $value ? '' : 'display:none;'; ?>border:1px solid #c3c4c7;">
                    </div>
                  <?php else : ?>
                    <input type="text" id="<?php echo esc_attr($key); ?>" name="alumax_home[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="large-text">
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        <?php endforeach; ?>
        <?php submit_button(); ?>
      </form>
    </div>
    <script>
    jQuery(function ($) {
      $('.alumax-image-select').on('click', function (e) {
        e.preventDefault();
        var $wrap = $(this).closest('.alumax-image-field');
        var frame = wp.media({ title: '选择图片', button: { text: '使用此图片' }, multiple: false });
        frame.on('select', function () {
          var url = frame.state().get('selection').first().get('url');
          $wrap.find('.alumax-image-url').val(url);
          $wrap.find('.alumax-image-preview').attr('src', url).show();
        });
        frame.open();
      });
    });
    </script>
    <?php
}
