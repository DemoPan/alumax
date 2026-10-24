<?php

if (!defined('ABSPATH')) {
    exit;
}

function alumax_home_defaults() {
    $defaults = [
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
        's4_eyebrow' => 'Smart Manufacturing & Fabrication Precision',
        's4_title' => '150,000 m² Monthly Capacity • 6 Automated CNC Lines • Zero-Defect Metallurgy',
        's4_subtitle' => 'Continuous 85,000 m² smart metal fabrication campus equipped with German Trumpf laser cutters, Italian Salvagnini panel benders, and Japanese automated Ransburg vertical fluorocarbon coating lines.',
        's4_bg_image' => 'https://lh3.googleusercontent.com/aida/AEtjO1VX-1APmxkQtKJO_kHBQr_udIAcu29QJBYCEvpD_4lIb4tA6bAUOcW9LKboQdvXLVXeVhuppuqjFlUgURlUTgqqLmUU1wNV5uHe9f1pXW5XuiAVSQ7BQI2TSxzRmzkNX5TETbp_qfXSYonIdkll9Pp52qPRF8B26RjxoU89e26hSueuMcfukKIoe03Wv4MTWUNnoX0RKyU61DGWGiGjprkVO0DIec8R0yz7M3B4Yaki9qkNFGaswEmyhmo',
        // Section 5: Landmark Projects
        's5_eyebrow' => 'Global Project References',
        's5_title' => '1,200+ Projects Completed Across 6 Continents',
    ];

    // Section 2 finish cards
    $s2_cards = [
        [
            'tag' => 'AAMA 2605 Certified',
            'title' => 'Fluorocarbon PVDF (Kynar 500)',
            'desc' => '3-Coat 2-Bake system, 35μm minimum dry film thickness. Engineered for extreme solar UV and salt-spray resistance.',
            'spec_label' => 'Warranty',
            'spec_value' => '30-Yr Exterior',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBSKyFgB-1gbPpcw77fwoFlWVCl7zs2f77dw-F_B0OucwuvHrZB8vEP7rBJKUyhYc5Z8nCY_hcrotCjS9nPVqJuUPUQ0r5etRuiCD6SfwbOZaIjGx-1EcWaTq4izjVVqXD5owfxdUQCVqBbm_i9EAtd-0Hbe2iPdCCEOhJtamPymYhAueolPEEC2hg64MwJDjmfWAkfsdzhbwDrgkYmAm4wzbcSowYbFGTrrOKFfy-ENc_UOKnn-sdT',
        ],
        [
            'tag' => 'Class 1 Electrolytic',
            'title' => 'Architectural Anodizing',
            'desc' => 'Electrolytic satin finish available in natural silver, champagne, and dark bronze with uniform 25μm oxide depth.',
            'spec_label' => 'Oxide Layer',
            'spec_value' => '25μm Depth',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDSiqGc-P2zUtof-U7Frj19aZ3jT7n9WPKwqoVb72PruTpf-UlOuguqyOAj26EDvquR1sCqmQtK2TwjD_eVKQhHs-j-dnInViZEURFVnGWnpjW7nWJZh9UhSKkQRxHYgzB9QjSwCkPyMYClQjPC8nlBuMCfOK-CnpH_h456yL654iZH57rgV6SnUts7OOhdldfIc7RtAtcICgLKfKDDX4rnYdz7LOOEVVO4mfCEYNXuW8uRR3Jgjf8E',
        ],
        [
            'tag' => 'Natural Mineral Look',
            'title' => 'Textured Stone & Quartz',
            'desc' => '3D mineral tactile coating providing granite/limestone look while being 80% lighter than natural stone slabs.',
            'spec_label' => 'Combustibility',
            'spec_value' => 'Class A Non-Comb.',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBM-pEeC3oGTrZ1GQvz14eind6a-1BuRjK-RSWNEXkZer_QhGLD3oTbaL60gBpIAyRhaxBwtcA-I-uyPxbXOpQ4nb_CScmx8Qg_ppQ5zqtTybrvcSXlYMmLTj4VS84D5Srq4MqsVujt7u1jsGxxxrkf0yZGUudF1SBycw4tzEA6bDIkLfpjd0vr2rGwbVoeAJUjq2AFKocQqoZ9_Ue0q1A7pGJhXZBLP8UlKusNVQrf8mcOeka1JHCO',
        ],
        [
            'tag' => 'High-Vacuum Sublimation',
            'title' => 'Thermal Transfer Woodgrain',
            'desc' => 'High-vacuum thermal transfer delivering warm architectural wood effect with zero rotting, swelling, or splintering.',
            'spec_label' => 'Stability',
            'spec_value' => 'UV-Stabilized',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuChi2_CI9dFb9uMuzfo7o9Q2vTK-3okyMxKQKrId6QHGXh2_2wbzWK5_PYR9KeQNJsNb2iG5pKHlJBOB9w-SwObum70xGqUP47eP3nd6Wo-QHA2xDsgX_SMk0PB0e8lJpwk3VTdLcKS4i6o3idMJ_gz5xXTS0U6qS31849MZSNh9Oh4nO4z7NWQi8XWReVKpOsW-gAs4Wu7DVsOmcFzs66x2dqH8wrSetnFeY-ZD4yD7dJ0uBQgdDBQ',
        ],
        [
            'tag' => 'Self-Cleaning Fluoropolymer',
            'title' => 'FEVE Ultra-Weatherable',
            'desc' => 'High-gloss, scratch-resistant fluoropolymer coating with hydrophobic self-cleaning properties and anti-graffiti finish.',
            'spec_label' => 'Gloss Retention',
            'spec_value' => '> 80% at 20 Years',
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDgloJJtmlo2HPXXLQ4dzRNKoj_rArb0I8nPDHrjjKr1M0M0G21B7dSCsr8M53WMP5KkXhMPKSSlgHKkSaayLuf89F5pL1GagBgBEjN-EfahCPaua5EuPRPKwTPh_s2dj6NLqKI2K3IMpnbKbs9j2rKuIqo1g68H3kiJFELkIatrNnD7zVCg9-Mxbx0DELhw1VtSqoip61kEE_FyHO5DQmsqWSP9kNAR7EhCXzvABjmlXPzi6rVVeWs',
        ],
    ];

    foreach ($s2_cards as $i => $card) {
        $n = $i + 1;
        foreach ($card as $prop => $value) {
            $defaults["s2_card{$n}_{$prop}"] = $value;
        }
    }

    // Section 4 KPI metrics
    $s4_metrics = [
        ['value' => '±0.3mm', 'label' => 'Precision Machining Tolerance'],
        ['value' => '6 Lines', 'label' => 'CNC Turret & Laser Punching'],
        ['value' => '300m', 'label' => 'Continuous Ransburg PVDF Line'],
        ['value' => '100%', 'label' => 'BIM LOD 400 CAM Coordination'],
        ['value' => 'Zero', 'label' => 'Delamination / ASTM & EN A2'],
    ];

    foreach ($s4_metrics as $i => $metric) {
        $n = $i + 1;
        foreach ($metric as $prop => $value) {
            $defaults["s4_metric{$n}_{$prop}"] = $value;
        }
    }

    // Section 4 fabrication process cards
    $s4_cards = [
        [
            'icon' => 'precision_manufacturing',
            'title' => 'High-Speed CNC Laser & Turret Punching',
            'desc' => 'German Trumpf 5-axis systems delivering 0.05mm positioning precision for complex parametric facade perforations, acoustic patterns, and geometric cutouts.',
            'spec_label' => 'Repeatability',
            'spec_value' => '±0.05mm Positioning',
        ],
        [
            'icon' => 'architecture',
            'title' => 'Automated Salvagnini Panel Bending',
            'desc' => 'Automated robotic stretch-forming ensuring razor-sharp crisp edges and non-distorting corner folds on complex architectural envelope cassettes.',
            'spec_label' => 'Corner Profile',
            'spec_value' => 'Zero Stress Micro-Radius',
        ],
        [
            'icon' => 'format_paint',
            'title' => 'Japanese Ransburg Electrostatic PVDF Coating',
            'desc' => 'Dual 3-coat 2-bake vertical lines featuring automated electrostatic bells for uniform film thickness, color consistency, and extreme UV weatherability.',
            'spec_label' => 'Specification',
            'spec_value' => 'AAMA 2605 / 35μm Min',
        ],
        [
            'icon' => 'layers',
            'title' => 'Automated Core Bonding & Honeycomb Laminating',
            'desc' => 'Hot-press continuous vacuum bonding lines producing completely oil-canning-free, ultra-flat honeycomb composite panels for supertall curtain walls.',
            'spec_label' => 'Flatness Tolerance',
            'spec_value' => '< 1.0mm per 3000mm',
        ],
        [
            'icon' => 'view_in_ar',
            'title' => 'Advanced Hyperbolic 3D Stretch Forming',
            'desc' => 'Multi-point stretch forming matrix capable of shaping double-curved and non-developable metal facades with zero wrinkling or thinning defects.',
            'spec_label' => 'Geometry',
            'spec_value' => 'Freeform Double-Curved',
        ],
        [
            'icon' => 'verified',
            'title' => 'Automated Ultrasonic & Optical QC Inspection',
            'desc' => '100% inline defect detection, automated laser surface flatness verification, and adhesive bond ultrasonic verification before final protective packing.',
            'spec_label' => 'Quality Yield',
            'spec_value' => '99.8% Zero-Defect Rate',
        ],
    ];

    foreach ($s4_cards as $i => $card) {
        $n = $i + 1;
        foreach ($card as $prop => $value) {
            $defaults["s4_card{$n}_{$prop}"] = $value;
        }
    }

    return $defaults;
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
        's2_cards' => ['label' => 'Section 2 · 表面处理卡片（5 张）', 'fields' => []],
        's3' => ['label' => 'Section 3 · 产品展示', 'fields' => []],
        's4' => ['label' => 'Section 4 · 制造能力', 'fields' => []],
        's4_metrics' => ['label' => 'Section 4 · 制造能力指标（5 项）', 'fields' => []],
        's4_cards' => ['label' => 'Section 4 · 工艺流程卡片（6 张）', 'fields' => []],
        's5' => ['label' => 'Section 5 · 地标案例', 'fields' => []],
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

    foreach (['s2', 's3', 's4', 's5'] as $s) {
        $groups[$s]['fields'][] = $text("{$s}_eyebrow", '眉标（小标签）');
        $groups[$s]['fields'][] = $text("{$s}_title", '标题');
        if ($s !== 's5') {
            $groups[$s]['fields'][] = $textarea("{$s}_subtitle", '副标题');
        }
    }

    $groups['s4']['fields'][] = $image('s4_bg_image', '板块背景图');

    for ($i = 1; $i <= 5; $i++) {
        $groups['s2_cards']['fields'][] = $image("s2_card{$i}_image", "卡片 {$i} 背景图");
        $groups['s2_cards']['fields'][] = $text("s2_card{$i}_tag", "卡片 {$i} 标签");
        $groups['s2_cards']['fields'][] = $text("s2_card{$i}_title", "卡片 {$i} 标题");
        $groups['s2_cards']['fields'][] = $textarea("s2_card{$i}_desc", "卡片 {$i} 描述");
        $groups['s2_cards']['fields'][] = $text("s2_card{$i}_spec_label", "卡片 {$i} 底部规格名称");
        $groups['s2_cards']['fields'][] = $text("s2_card{$i}_spec_value", "卡片 {$i} 底部规格值");
    }

    for ($i = 1; $i <= 5; $i++) {
        $groups['s4_metrics']['fields'][] = $text("s4_metric{$i}_value", "指标 {$i} 数值");
        $groups['s4_metrics']['fields'][] = $text("s4_metric{$i}_label", "指标 {$i} 说明");
    }

    for ($i = 1; $i <= 6; $i++) {
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_icon", "卡片 {$i} 图标（Material Symbols 名称）");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_title", "卡片 {$i} 标题");
        $groups['s4_cards']['fields'][] = $textarea("s4_card{$i}_desc", "卡片 {$i} 描述");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_spec_label", "卡片 {$i} 底部规格名称");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_spec_value", "卡片 {$i} 底部规格值");
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
