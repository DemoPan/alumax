<?php

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------
 * 产品详情页内容（模块化新版）：默认值 + meta 回退 + 后台编辑
 * 前台组件：template-parts/product-sections/*.php
 * 数据存放：每个 section 一个 post meta（alumax_pp_{section}），未保存过回退默认值
 * ------------------------------------------------------------------------- */

// 使用「模块化详情页」的内容档案键（可用 alumax_product_page_slugs 过滤器扩展）
function alumax_product_page_slugs() {
    return apply_filters('alumax_product_page_slugs', [
        'system-parameter-configurator',
        'pre_insulated_metal_cladding_panels_technical_specification',
        'architectural_steel_wall_panels_technical_specification',
        'solid-aluminum-cladding-panels',
        'aluminum_composite_panels',
        'aluminum_honeycomb_core_panels_technical_specification',
        'corrugated_core_composite_panels_technical_specification',
        'architectural_metal_ceiling_systems_technical_specification',
        'architectural_s_blade_sunshade_louvers_technical_specification',
        'architectural_aluminum_grilles_screens_technical_specification',
        'pre_coated_roller_coated_aluminum_sheets_technical_specification',
    ]);
}

/* -------------------------------------------------------------------------
 * 内容档案（profile）：模块化内容按档案键组织，档案键存 post meta
 * _alumax_pp_profile，与文章别名解耦——后台改别名不影响模块化渲染和默认内容
 * ------------------------------------------------------------------------- */
function alumax_pp_profile($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $profile = (string) get_post_meta($post_id, '_alumax_pp_profile', true);
    if ($profile !== '' && in_array($profile, alumax_product_page_slugs(), true)) {
        return $profile;
    }
    $slug = get_post_field('post_name', $post_id);
    return in_array($slug, alumax_product_page_slugs(), true) ? $slug : '';
}

/* -------------------------------------------------------------------------
 * 模块开关：每个产品可在后台勾选启用哪些模块（存 post meta _alumax_pp_modules）
 * 未保存过时：有档案键的产品全开（特殊属性仅参数配置器档案）；新建产品走标准默认集
 * ------------------------------------------------------------------------- */
function alumax_pp_all_modules() {
    return [
        'hero'       => '首屏 Hero',
        'intro'      => '产品介绍 Product Introduction',
        'advantages' => '核心优势 Key Advantages',
        'control'    => '产品特殊属性（如电机与智能控制系统）',
        'specs'      => '技术参数 Technical Specifications',
        'palette'    => '涂层结构与颜色 Coating System & Colors',
        'options'    => '产品细节',
        'install'    => '安装方式',
        'cases'      => '工程案例 Project References',
        'inquiry'    => '询价表单 Request a Quote',
    ];
}

// 新建产品的标准默认启用集（特殊属性、涂层色板默认不启用）
function alumax_pp_default_modules() {
    return ['hero', 'intro', 'advantages', 'specs', 'options', 'install', 'cases', 'inquiry'];
}

function alumax_pp_enabled_modules($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $saved = get_post_meta($post_id, '_alumax_pp_modules', true);
    if (is_array($saved)) {
        return array_values(array_intersect(array_keys(alumax_pp_all_modules()), $saved));
    }
    $profile = alumax_pp_profile($post_id);
    if ($profile !== '') {
        $enabled = array_keys(alumax_pp_all_modules());
        if ($profile !== 'system-parameter-configurator') {
            $enabled = array_diff($enabled, ['control']);
        }
        return array_values($enabled);
    }
    return alumax_pp_default_modules();
}

/* -------------------------------------------------------------------------
 * 默认值：与模板初始内容一致（设计稿 Smart_Motorized.html）
 * ------------------------------------------------------------------------- */

function alumax_product_page_defaults($slug) {
    if ($slug === 'pre_insulated_metal_cladding_panels_technical_specification') {
        return alumax_pp_defaults_pre_insulated();
    }
    if ($slug === 'architectural_steel_wall_panels_technical_specification') {
        return alumax_pp_defaults_steel();
    }
    if ($slug === 'solid-aluminum-cladding-panels') {
        return alumax_pp_defaults_solid();
    }
    if ($slug === 'aluminum_composite_panels') {
        return alumax_pp_defaults_acp();
    }
    if ($slug === 'aluminum_honeycomb_core_panels_technical_specification') {
        return alumax_pp_defaults_honeycomb();
    }
    if ($slug === 'corrugated_core_composite_panels_technical_specification') {
        return alumax_pp_defaults_corrugated();
    }
    if ($slug === 'architectural_metal_ceiling_systems_technical_specification') {
        return alumax_pp_defaults_ceiling();
    }
    if ($slug === 'architectural_s_blade_sunshade_louvers_technical_specification') {
        return alumax_pp_defaults_louver();
    }
    if ($slug === 'architectural_aluminum_grilles_screens_technical_specification') {
        return alumax_pp_defaults_grilles();
    }
    if ($slug === 'pre_coated_roller_coated_aluminum_sheets_technical_specification') {
        return alumax_pp_defaults_precoted();
    }
    if ($slug !== 'system-parameter-configurator') {
        // 无档案键的产品（如新建产品）：通用默认内容，后续在后台编辑
        return [
            'hero' => [
                'bg_image'       => '',
                'title'          => '',
                'subtitle'       => '',
                'description'    => '',
                'primary_label'  => 'Request a Quote',
                'primary_url'    => '#rfq-section',
                'secondary_label' => '',
                'secondary_url'  => '',
                'secondary_icon' => 'download',
                'badges'         => [],
            ],
            'inquiry' => [
                'eyebrow'      => 'Request a Quote // 询价与技术咨询',
                'title'        => 'Request a Quote',
                'description'  => 'Submit your project requirements and our engineering team will respond with a tailored specification and quotation within 24 business hours.',
                'form_title'   => 'Project Inquiry',
                'form_badge'   => '24H RESPONSE',
                'submit_label' => 'Submit Inquiry',
                'bullets'      => [],
                'products'     => [],
            ],
        ];
    }

    $svg_blade = <<<'SVG'
<svg class="w-full h-full text-on-surface-variant stroke-current fill-none" viewBox="0 0 200 80">
  <path class="fill-surface-variant stroke-primary" d="M 20 40 C 40 18, 120 18, 180 40 C 120 62, 40 62, 20 40 Z" stroke-width="2"></path>
  <circle class="stroke-primary" cx="100" cy="40" r="10" stroke-width="1.5"></circle>
  <line stroke-width="1.5" x1="100" x2="100" y1="20" y2="30"></line>
  <line stroke-width="1.5" x1="100" x2="100" y1="50" y2="60"></line>
  <line stroke-dasharray="2 2" stroke-width="1" x1="20" x2="180" y1="72" y2="72"></line>
  <text class="font-label fill-on-surface-variant" font-size="8" text-anchor="middle" x="100" y="77">Width: 200 mm</text>
  <line stroke-dasharray="2 2" stroke-width="1" x1="190" x2="190" y1="26" y2="54"></line>
  <text class="font-label fill-on-surface-variant" font-size="7" x="194" y="42">H: 45</text>
</svg>
SVG;

    $svg_horizontal = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.2" viewBox="0 0 70 100">
  <rect class="fill-surface-variant" height="80" width="20" x="10" y="10"></rect>
  <line x1="30" x2="60" y1="30" y2="20"></line>
  <line x1="30" x2="60" y1="50" y2="40"></line>
  <line x1="30" x2="60" y1="70" y2="60"></line>
  <circle class="fill-secondary" cx="30" cy="30" r="3"></circle>
  <circle class="fill-secondary" cx="30" cy="50" r="3"></circle>
  <circle class="fill-secondary" cx="30" cy="70" r="3"></circle>
</svg>
SVG;

    $svg_vertical = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.2" viewBox="0 0 70 100">
  <rect class="fill-surface-variant" height="80" width="20" x="25" y="10"></rect>
  <ellipse class="fill-surface-container" cx="35" cy="30" rx="25" ry="6"></ellipse>
  <ellipse class="fill-surface-container" cx="35" cy="50" rx="25" ry="6"></ellipse>
  <ellipse class="fill-surface-container" cx="35" cy="70" rx="25" ry="6"></ellipse>
  <line stroke-dasharray="2 2" x1="35" x2="35" y1="10" y2="90"></line>
</svg>
SVG;

    $svg_curtain = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.2" viewBox="0 0 70 100">
  <rect class="fill-surface-variant" height="70" width="40" x="15" y="15"></rect>
  <line stroke-width="2" x1="20" x2="50" y1="35" y2="35"></line>
  <rect class="stroke-secondary" height="20" width="20" x="25" y="45"></rect>
  <line x1="35" x2="35" y1="65" y2="85"></line>
  <circle class="fill-primary" cx="35" cy="85" r="3"></circle>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida/AEtjO1VbnhXNYxUv7Xo3QwN1xjvvquYJ6oyvme4q7adDEsW1BgJNQ23O4I-yMaZnFO9zemf1mDVTrOSBPmXkcQoK1EFRs0CREQgMaSYeRaPYGPSCseWqC0YDKwOENU4esnun3ZgGbTQ2sRFuki35MhjSjDMpEPBnEc5g_sYKt-DK8Rvsu9FKUXaHvSICwyUsnEV7fhZ-7GlChS8u99H6Yt3kX4KQi2O2mDQEQiZ8d6XxBrh-edaf6G7KHN0TSOI',
            'title'          => 'Smart Motorized<br>Aluminum Louvers',
            'subtitle'       => 'Intelligent sun control for modern architecture.',
            'description'    => 'Our motorized aluminum louvers provide effective solar shading, reduce cooling loads, and enhance the building facade with a clean, modern appearance. Engineered for high wind load performance and seamless architectural integration.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'wb_sunny', 'title' => 'Solar Control', 'text' => 'Reduce heat gain'],
                ['icon' => 'rotate_right', 'title' => 'Adjustable Angles', 'text' => 'Flexible shading'],
                ['icon' => 'settings_input_component', 'title' => 'Smart Automation', 'text' => 'Sensors & BMS'],
                ['icon' => 'architecture', 'title' => 'Custom Design', 'text' => 'For any building'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDCpy0Y9gLv4qQK2-qtnuwwSxiTCt2MgxGnU_EsguVx6yMQ1MO1f0avk94T020bVFJq1_Tj5HZ2BaCZ4k-d0uf-0OhO0DahveVtjYpINFN4ofZoBSFUlRmC5isPYU_xYdAFFFareanJk6ywLqU3-5QgtwiyOabJPCltqeQaEOK8njq2S2yEPq_X1ejZrNH-lopsA5zaYHCPF81uEEcVR-NiM_Qc2zBdy4dl_LhIkxHcFumby2n5KGlT',
            'image_alt'   => 'Close-up architectural macro photograph of precision extruded aluminum louver blades mounted on a stainless steel structural pivot arm.',
            'video_label' => 'Watch System Video',
            'eyebrow'     => 'The Product // 系统介绍',
            'title'       => 'What is a Smart Louver System?',
            'description' => 'The motorized aluminum louver system consists of high-performance aluminum blades, a supporting structure, a drive system, and an intelligent control system. By adjusting the blade angle in real time, it dynamically controls direct sunlight, minimizes thermal radiation, maximizes natural daylighting, and sculpts the distinct visual aesthetic of the building facade.',
            'features'    => [
                ['icon' => 'tune', 'title' => 'Adjustable blade angles', 'text' => 'Precise 0° to 90° light control and glare mitigation.'],
                ['icon' => 'view_in_ar', 'title' => 'Aluminum profiles', 'text' => 'Extruded 6063-T5/T6 alloy: durable, rigid & lightweight.'],
                ['icon' => 'precision_manufacturing', 'title' => 'Motorized operation', 'text' => 'Smooth, low-noise linear actuator and concealed drive rod.'],
                ['icon' => 'sensors', 'title' => 'Optional sensors', 'text' => 'Automated sun tracking, wind storm retract & rain protection.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our Smart Louvers?',
            'description' => 'Engineered for international commercial architectural standards, delivering quantifiable energy savings, environmental comfort, and facade prestige.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuACtfEcuRenYctCzGpZQXGAvYtSNMk5VNnFSqlhdk_mBvlIj9LyGO_8ckig9LsD0kvufxzuEYH8FTKtIK5UczrLUSIwNgtrcuJE04qxa-8BjBHyzvo9FiQfcXUC06u4Z0iuWXl1YvZ8vIkDC2Ev3dGmEpZCJXHSOy0d0sxEaP272rsOe_o6DQFLCb7FR5qqj7je0x-oYFPg20JWQmEb4nMPX6fyfaH3hmY4xeSL0mQHxh0PLgOztlrk',
                    'image_alt' => 'Energy-efficient solar louvers blocking intense summer solar rays from entering a large glazed atrium.',
                    'icon'      => 'solar_power',
                    'title'     => 'Solar Control',
                    'text'      => 'Block direct solar heat radiation and reduce internal air conditioning cooling demand by up to 35%.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDwdSLKwiUpwBMKM5SPCFCbBZoRZFkUzpZQACup9L-3v8TT030JScUcqJGgn3u-mvhnzvm18a34hxh1Gdvs13VJj_r9Z-3KH6yTDicocYmWCcYVo8gYXVlVyccWqr5p_nDNvUsJNseDLEi-amm3sPg1Boo9DbozPevMyb2xx-hEr5NZ5Evyq79tQnZdjRRTS7OU3J7hFZ8l83Shy_nTTZFZtNsHSwGJ0aBYA-vFJPuj4jq16QY57syw',
                    'image_alt' => 'Motorized aluminum aerofoil blades rotating synchronously at 45 degree angle with precision pivot joints.',
                    'icon'      => 'linear_scale',
                    'title'     => 'Adjustable Shading',
                    'text'      => 'Balance natural daylighting and occupant privacy with micro-precision angle positioning.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuABwKvpHBvhOjRH-0pu0lQCQXJAu8TA0DoBvk8SIZhKBd-_zLCRd_hi2lg8A-459UFvvTLD1rpizNmgSuib3HjIk_TZvVUDDS5iZ9ugeqzrJg2Oe5Ft163rYYpWEnvTE1V6Om_n8LQ0N8sOyS7-yDPzl4gN8OZPIDHLnXUxW_AyHt89UpPbTeSU5sxLYXCbY5W870w1gVzS5q_ohH7SwMdgLaKHUOmWZHjsJNlcSypIPWvaSSzDFQEz',
                    'image_alt' => 'Facade with geometric rhythms of vertical and horizontal aluminum louvers integrated with curtain wall glass framing.',
                    'icon'      => 'palette',
                    'title'     => 'Facade Design',
                    'text'      => 'Multiple extruded blade profiles, custom fluoropolymer colors, and tailored vertical or horizontal modular layouts.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBnRnr29J8s4IxV5QgtBTcw9AjQ7Fy1TKfBLLKpvfyIae4yKRycrRpNm2Uj8gYVZ9qzUdlBxBuT0qc9SBCS0cN9Umb72ce5yjr8c4hSpAmS6MWO15fGeI3vtakyuF2UnRRahXv_tp9nROWhTYJAip7R5oyP901CFUIUnE_FtgCOtHiX4vXo6urIhxoiWrBFqFCb2CpgnnLs8qXcRNXlXwg7gvxFav5YImoanVle-gwpyEDz6qgLG2Kj',
                    'image_alt' => 'IP65 waterproof rated electric linear actuator motor mounted inside an extruded aluminum facade mullion.',
                    'icon'      => 'hub',
                    'title'     => 'Smart Automation',
                    'text'      => 'Full integration with KNX, BACnet, BMS protocols, sun path tracking, and automated schedule automation.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Product Parameters & Engineering Details',
            'table_title' => 'Standard Engineering Schedule',
            'table_ref'   => 'REF: AX-LOUVER-MOT-2025',
            'rows'        => [
                ['name' => 'Product Type', 'value' => 'Motorized / Adjustable Architectural Envelope Louver', 'mono' => ''],
                ['name' => 'Blade Profile', 'value' => 'Aerofoil (Wing) / Elliptical / Rectangular / Bespoke Box (varies by model)', 'mono' => ''],
                ['name' => 'Blade Dimensions', 'value' => 'Width: 100 - 300 mm | Thickness: 1.5 - 2.5 mm | Max Span: up to 6000 mm', 'mono' => '1'],
                ['name' => 'Alloy & Temper', 'value' => 'Extruded Aluminum Alloy 6063-T5 / 6063-T6 (GB/T 5237 / ASTM B221)', 'mono' => '1'],
                ['name' => 'Finish Options', 'value' => 'PVDF 3-Coat 35μm (AAMA 2605) / Architectural Powder Coating / Hard Anodized 20μm', 'mono' => ''],
                ['name' => 'Blade Rotation', 'value' => '0° - 90° Continuous Angle Rotation (Custom 120° available)', 'mono' => '1'],
                ['name' => 'Drive System', 'value' => 'IP65 Waterproof Electric Tubular / Linear Actuator (24V DC / 220V AC, <42dB)', 'mono' => ''],
                ['name' => 'Control Options', 'value' => 'Dry Contact Switch / RF Remote / BMS Direct Interface (RS485, KNX, BACnet)', 'mono' => ''],
                ['name' => 'Wind Performance', 'value' => 'Tested up to 3.5 kPa (CWCT Class 4 / ASTM E330 certified project calculation)', 'mono' => ''],
                ['name' => 'Customization', 'value' => 'Blade scale, RAL colors, mullion brackets & vertical/horizontal installation', 'mono' => ''],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Download Product Datasheet (PDF)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'folder_zip', 'label' => 'Request CAD / BIM Files (.DWG / .RVT)', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Blade Profile (Aerofoil)',
                    'tag'       => 'CROSS-SECTION',
                    'svg'       => $svg_blade,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Hollow extruded profile with dual structural pivot chambers',
                ],
                [
                    'title'     => 'Motor & Drive Detail',
                    'tag'       => 'CONCEALED',
                    'svg'       => '',
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAHCczDzmHNEO_I_AXLv4SYdH4glRUqtIngADaUOofmQfbJ0NH6OFeBf8G5YFmm7YjdGGMnzFw4O7RH2VSHfYen6op7KzUbS1k36Jy2ZIl0RYxkbcNSojuqr4ybkexXCkhhwq1ubCj7pUyXFhFxadtcLv1EwRwOQ6_dquY_7h_oIK3HuIT8VDwH0QjOUPOzV4OGNIbraiXqksgVm3ZzpWE-phE5wYdu-ccJSnUhDv6KDSc8uktjsES8',
                    'image_alt' => 'Concealed electric motor actuator linkage box mounted inside an extruded aluminum facade bracket assembly.',
                    'caption'   => 'IP65 sealed transmission unit with micro-switch end-stops',
                ],
            ],
            'install_eyebrow'     => 'Installation // 安装方式',
            'install_title'       => 'Mullion Integration & Mounting Typologies',
            'install_description' => 'BIM / Revit compliant mounting schematics covering the three standard structural interfaces.',
            'install_note'        => 'Standard stainless steel brackets Grade 304/316 with EPDM acoustic isolation dampers preventing galvanic corrosion.',
            'install_items'       => [
                ['svg' => $svg_horizontal, 'image' => '', 'image_alt' => '', 'tag' => 'TYPE 01', 'title' => 'Horizontal Cantilever', 'text' => 'Projecting bracket arms anchored to slab edges or structural mullions for horizontal sunshade runs.'],
                ['svg' => $svg_vertical, 'image' => '', 'image_alt' => '', 'tag' => 'TYPE 02', 'title' => 'Vertical Continuous', 'text' => 'Continuous vertical blade stacks fixed to curtain wall mullions for full-height solar screening.'],
                ['svg' => $svg_curtain, 'image' => '', 'image_alt' => '', 'tag' => 'TYPE 03', 'title' => 'Curtain Wall Mount', 'text' => 'Direct integration into unitized curtain wall transoms with dielectric isolation shims.'],
            ],
        ],
        'control' => [
            'eyebrow'     => 'Intelligent Control // 智能控制',
            'title'       => 'Flexible & Intelligent Operation',
            'description' => 'With integrated environmental sensors and intelligent controllers, the ALUMAX motorized louver system automatically modulates blade angles based on real-time solar azimuth, local wind velocity, temperature, and tenant preferences—creating a low-energy, highly comfortable indoor climate.',
            'cta_label'   => 'Learn More & Integration Specs',
            'cta_url'     => '#rfq-section',
            'modes'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDHkn_WPSnBmkfeCHkpIR51CG8kPF8LwMqq_dQd3T8RsTIA3s8GtM9lEs7q4gqPxzThMsEpx6xtWgv-JTYgrG5KOjaXxfykE6sHCqPUJvQMJWkNemA20YcrddD5GkgjtljDbcWkUKsYakzTxDaBO9svEIeXvh8QDtA8MhR48VdTvG0BjOve8nIm9jFwQSZibWNOYD3ScfNX-4D0z7bi21R535enmoRq3DeGv5UUKdnrREwG-FRGNWxN',
                    'image_alt' => 'Motorized aluminum facade louvers fully closed in shading mode.',
                    'tag'       => '01 // 0°',
                    'title'     => 'Closed / Shading Mode',
                    'subtitle'  => 'Maximum Solar Protection',
                    'text'      => 'Blocks 100% direct sun, minimizing HVAC peak loads during extreme heat.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAyv3M3Ygpv5UHkelIrXDl3PyTVpYiDLUW6EJ_kns3Do1_MALX-ZvqTlk4H5EyJbTROwbJByERv6rcKW0POakA6dS1MMdiDfwSlHvt92vc7nTGhwLs2NyaBOl_bY1kQlvuRWeovFivBM_yl0cUGUCBwkWn_1hje023rJaJBisbMULZA2-EGmTJFY4RlyVvyxW0Z63bo1eyOhKZRTL82c-IQoaNfAax6XCP26NprTRKm1yMW34f9h1XF',
                    'image_alt' => 'Exterior building louvers tilted at 45 degree angle allowing balanced natural daylight.',
                    'tag'       => '02 // 45°',
                    'title'     => 'Adjustable / Daylight Mode',
                    'subtitle'  => 'Balanced Light & Comfort',
                    'text'      => 'Harmonizes diffuse ambient daylight, eliminates glare, and retains outdoor views.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAojZ5t1uBU7bdg0JUyH9gjCfozjp_7TJUjjZgxP5R8DTN_gnUUMswzgQUWCrq0ASzXuXNe_56TatfMp9pi52vYv2wCidVdhdLp6JODMd5akh8IGEHzfyizjiliGTD6UZAP5dR2tKo6aHtq-PWD1bP6-89w1hDKwlRgk_2egwd3LQB_z3v-GBQVwl9SXvsCE0x_GiO5eNDl5eXz1-rkIhFh17KI6BW159ILVNR0gx6d50PBVecW6eEc',
                    'image_alt' => 'Modern glass facade with motorized aluminum louvers turned to full 90 degree horizontal open angle.',
                    'tag'       => '03 // 90°',
                    'title'     => 'Open / View Mode',
                    'subtitle'  => 'Unobstructed Daylight',
                    'text'      => 'Maximizes daylight entry and building transparency during overcast skies.',
                ],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Customization Options // 定制选项',
            'title'       => 'Tailored to Your Project',
            'description' => 'We offer an extensive range of engineering configurations to satisfy bespoke architectural geometries, local wind codes, and corporate branding standards.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAFOs4TCX89SNJ9n4PJrVK5ZietHZEjTgixuM7mUTAf6Fj8wT0Bqxbi_BiTVgmKeNs_aFdl9BKRvVrcLzPdq_Fym44iqBZWdXt8upRaxKPn148iFJ-atp6T4S__IHRfjv8scCMxR2SaZ3jGa2tNIyob6u5JzpZDXG1AOPNTHXMRnuGnX_vBaFAIlLD5dEKkNiKg0PHdu6KvX8c0zhQ52tcsOW6v7tHSptC0GQAWp_Us7lsIziVz0kla',
                    'image_alt' => 'Technical drawing of aerofoil, elliptical, and rectangular louver blade extruded profiles.',
                    'contain'   => '1',
                    'title'     => 'Blade Profiles',
                    'text'      => 'Aerofoil (100–450mm), elliptical, box rectangular, and custom die extrusion profiles tailored to project wind loads.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBQBiG8BsseKsHjDEL2xZfrGNHano64lUR7gYGGOtmrcXcauTpthWCJaqbANDH-OkNGk5Otf7PlaGW8DfF0nm1zZiBDWq0IspJSWizaEzjyXJhlARJeoKD_1Cx9DbKI0ek82ZzpE9OOz4QZWQGKoXcBRKeEPfdrnFybjSayCkd46pd163Ls_8fhFIJlMUaal7dsNDICCDh3KGltFXkA_l2GMWDGGiED23tZCyMaM5JH4cTBN4UQp5i4',
                    'image_alt' => 'Swatch fan deck of anodized bronze, champagne gold, matte slate grey, and PVDF coated aluminum finishes.',
                    'contain'   => '',
                    'title'     => 'Colors & Finishes',
                    'text'      => 'AAMA 2605 certified PVDF 3-coat, architectural polyester powder coating in any RAL code, and hard anodized architectural finishes.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBpp7W_WNgcPxlqxqLV6V6Afu9zV457dFmzaQw8hcPwQzLvAFAtJGK8bA6TCVmczVkN-nJThJ6WBcVn3rFccdb37jH_fglPi0XC00f1wUOori97-WqTc_oFR_JTgoz-QGwoqcFb8_6k3diNfQC-EPY9dMwkUKxZTnnFoWDEQNIrgTswDqRdOe59Oz05Oewzk0fWokbN0sWIYrOqjtYKM_d4zcedUvOaR7pT6k7n5V3PbrFTd4iV8HkS',
                    'image_alt' => 'Aluminum motorized actuator unit with stainless steel drive shaft and planetary gearbox.',
                    'contain'   => '1',
                    'title'     => 'Drive & Controls',
                    'text'      => '24V DC / 230V AC motors, intelligent BMS controllers, wind and rain weather stations, and solar position algorithms.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCou2thiA75kbfJ7I15ROEUtJxoRhMEHDsjIuyxYxnwECn03khQIEgEfLsVG1mCHCulYk77E2GOqJjVt7pV5rK8cM04L5GX_PmVndterMtGN3TRNH7Hj6Jcq-yPs44PBAnSlquxfBwAys0qbzoO6up0KQuOyVzoJA8CqwRyX0iC-6Ox7suCdf0BFwgjB8ktLcA9yA8TfdrktCk24vO0bBk0HKfGJUocsRdUWmM-AKNHFfP95nhnRhm3',
                    'image_alt' => 'Grade 316 stainless steel mounting bracket hardware and pivot joints for curtain wall louvers.',
                    'contain'   => '1',
                    'title'     => 'Mounting Options',
                    'text'      => 'Curtain wall bracket adaptors, standalone steel substructures, horizontal cantilever arms, and custom seismic anchors.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'   => 'Project References // 工程案例',
            'title'     => 'Trusted in Iconic Buildings',
            'link_label' => 'View All Global Projects',
            'link_url'  => '',
            'projects'  => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDqcH0g3QS7SVBF8XrJSO8s5__jeZC_FE_66jneYbr1JotcPAvFzTuuK-quWGmkJNOlmNQkfwTjBQ_gtfw_r6f9I2YLQfX8NO9oLodEjom1EXbo7DTyTWgEwYGfJlYXVUYJD4-b6yC8L-ak0XVm9ZnlWLLr6OYu6Z31Gu_5gi2Dsay8N4ejwoyGAkCVFYU_630b9jZ4awC88HQyDAdt9zeqAk90AWVWJ7Wf9hgIxYqed6t5Cetv6ciA',
                    'image_alt' => 'Modern glass office skyscraper in New York City with motorized horizontal aluminum louvers.',
                    'location'  => 'NEW YORK, USA',
                    'title'     => 'Commercial Office Tower',
                    'product'   => 'Motorized Horizontal Louvers',
                    'area'      => 'Area: 14,800 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAqpJMYBwUzNkAaAytTeYlL_p07NO8OCGuHIXKPZO_kI6vgaDuHfCyrrS05mfpHjf7i7a-mUD8mSaJUnfZPt6ednwmXJ1e89wplCbKHUIy6KV1jlNG0w_8-nGPBiFH0ubGv_bvnGZTDsH-ZJ9vJEV3cISIuOtv98B_IDRlB2Z7UO_ia1AeCsoGDD1IhsjjcQOf037dXHJIQGjqPQZuxLFRCRI_nXjMWA-7qq1l_wSdBvh8FNfGJDnM0',
                    'image_alt' => 'High-tech corporate campus in Singapore with custom vertical motorized sun louvers integrated with BMS.',
                    'location'  => 'SINGAPORE',
                    'title'     => 'Tech Innovation Complex',
                    'product'   => 'Custom Louver Profile + BMS',
                    'area'      => 'Area: 22,500 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBoRbQRabsuMWOMsrV3xayhJYj1SaAUD1POLX_i5eid2h0E0KSQGtcar6vrt7mkp7D93ZQhUJpWos34xORXS1Xuid_rBmOzW_73sSPEzfRXkzrE593H1MG9VDwqI5dBOTKjLYplvEhPEWg8500STA8UAVIRBPhwnZ_IwCOeUU_mUbh_Wwkf0Qnak1Eozvj8YHCIGBkhtGnODkK0_vsbc-TVfrofa1XNIlSEd9gx5WcGKBADiGSETcs0',
                    'image_alt' => 'University research building in Sydney Australia with cantilevered motorized aluminum solar shading fins.',
                    'location'  => 'SYDNEY, AUSTRALIA',
                    'title'     => 'University Research Campus',
                    'product'   => 'Facade Shading System',
                    'area'      => 'Area: 8,600 m²',
                    'year'      => 'Year: 2022',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAHv4oXqHliPn9ps2728hViDoEEqH8Zw8a9HETf0GulrQiYzvAY_M78kKdedH7sESLU1dXsa3JXJ6WmwIuiYAT3f1atzX_ery40T9Jlgbifl0PMe95_YWTxUvfCuZVTsUCSZLNALpYU1siCyiTGHiCFU-UfiSaxWEoCj6B6U5tQd2wYeTpOkemO1V-hrpDZleJhF-W3yoVhi5N37WL4PMOK-vv4tnkkGqYrQknJUJz-mV-H7Fb0XmM7',
                    'image_alt' => 'Medical hospital complex in Dubai with gold champagne anodized vertical motorized sunshade louvers.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'Specialty Medical Center',
                    'product'   => 'Vertical Motorized Louvers',
                    'area'      => 'Area: 19,200 m²',
                    'year'      => 'Year: 2024',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Request a Project Quote // 询价与技术咨询',
            'title'        => 'Have a Project in Mind?',
            'description'  => 'Send us your architectural drawings, tender schedules, dimensions, or specific performance criteria. Our global engineering department will respond within 24 hours.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Submit Inquiry & Request Pricing',
            'bullets'      => [
                ['icon' => 'upload_file', 'title' => 'Upload CAD / PDF Drawings', 'text' => 'We accept .DWG, .DXF, .RVT, and .PDF tender packages.'],
                ['icon' => 'architecture', 'title' => 'Share Project Details', 'text' => 'Specify blade dimensions, finish, wind code & building type.'],
                ['icon' => 'verified', 'title' => 'Get a Customized Solution', 'text' => 'Comprehensive BOQ estimate, 3D section details & lead times.'],
            ],
            'products'     => [
                ['label' => 'Smart Motorized Louvers'],
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Honeycomb Panels'],
            ],
        ],
    ];
}

/* -------------------------------------------------------------------------
 * Getters：meta 是数组（保存过）则覆盖默认值同名键，否则整体回退默认值
 * ------------------------------------------------------------------------- */

// 各模块的完整空结构：保证任何产品（含无档案键的新产品）取值时键始终存在
function alumax_pp_empty_schemas() {
    return [
        'hero' => [
            'bg_image' => '', 'title' => '', 'subtitle' => '', 'description' => '',
            'primary_label' => '', 'primary_url' => '',
            'secondary_label' => '', 'secondary_url' => '', 'secondary_icon' => '',
            'badges' => [],
        ],
        'intro' => [
            'image' => '', 'image_alt' => '', 'video_label' => '',
            'eyebrow' => '', 'title' => '', 'description' => '', 'features' => [],
        ],
        'advantages' => ['eyebrow' => '', 'title' => '', 'description' => '', 'cards' => []],
        'control' => [
            'eyebrow' => '', 'title' => '', 'description' => '',
            'cta_label' => '', 'cta_url' => '', 'modes' => [],
        ],
        'specs' => [
            'eyebrow' => '', 'title' => '', 'table_title' => '', 'table_ref' => '',
            'rows' => [], 'buttons' => [], 'side_cards' => [],
            'install_eyebrow' => '', 'install_title' => '', 'install_description' => '',
            'install_note' => '', 'install_items' => [],
        ],
        'options' => ['eyebrow' => '', 'title' => '', 'description' => '', 'cards' => []],
        'palette' => ['eyebrow' => '', 'title' => '', 'description' => '', 'swatches' => []],
        'cases'   => ['eyebrow' => '', 'title' => '', 'link_label' => '', 'link_url' => '', 'projects' => []],
        'inquiry' => [
            'eyebrow' => '', 'title' => '', 'description' => '',
            'form_title' => '', 'form_badge' => '', 'submit_label' => '',
            'bullets' => [], 'products' => [],
        ],
    ];
}

function alumax_product_page_section($section, $post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $profile = alumax_pp_profile($post_id);
    $defaults = alumax_product_page_defaults($profile);
    $schemas = alumax_pp_empty_schemas();
    $fallback = isset($defaults[$section]) ? $defaults[$section] : [];
    $base = isset($schemas[$section]) ? array_merge($schemas[$section], $fallback) : $fallback;
    $meta = get_post_meta($post_id, 'alumax_pp_' . $section, true);
    if (is_array($meta)) {
        return array_merge($base, $meta);
    }
    return $base;
}

/**
 * 返回 8 个组件可直接使用的参数数组（键：hero/intro/advantages/specs/control/options/cases/inquiry）
 */
function alumax_product_page_sections($post_id = null) {
    $post_id = $post_id ?: get_the_ID();

    $hero = alumax_product_page_section('hero', $post_id);
    $hero_args = [
        'bg_image'    => $hero['bg_image'] ?? '',
        'title'       => $hero['title'] ?? '',
        'subtitle'    => $hero['subtitle'] ?? '',
        'description' => $hero['description'] ?? '',
        'primary'     => ['label' => $hero['primary_label'] ?? '', 'url' => $hero['primary_url'] ?? ''],
        'secondary'   => ['label' => $hero['secondary_label'] ?? '', 'url' => $hero['secondary_url'] ?? '', 'icon' => $hero['secondary_icon'] ?? ''],
        'badges'      => $hero['badges'] ?? [],
    ];

    // 新建产品兜底：Hero 标题取文章标题，背景图取特色图
    if ($hero_args['title'] === '') {
        $hero_args['title'] = get_the_title($post_id);
    }
    if ($hero_args['bg_image'] === '') {
        $alumax_thumb = get_the_post_thumbnail_url($post_id, 'full');
        if ($alumax_thumb) {
            $hero_args['bg_image'] = $alumax_thumb;
        }
    }

    $specs = alumax_product_page_section('specs', $post_id);

    // 安装方式独立模块（数据仍存放在 specs meta 的 install_* 键中，兼容旧数据 label→title）
    $install = [
        'eyebrow'     => $specs['install_eyebrow'] ?? '',
        'title'       => $specs['install_title'] ?? '',
        'description' => $specs['install_description'] ?? '',
        'note'        => $specs['install_note'] ?? '',
        'items'       => [],
    ];
    foreach (($specs['install_items'] ?? []) as $alumax_item) {
        $install['items'][] = [
            'svg'       => $alumax_item['svg'] ?? '',
            'image'     => $alumax_item['image'] ?? '',
            'image_alt' => $alumax_item['image_alt'] ?? '',
            'tag'       => $alumax_item['tag'] ?? '',
            'title'     => $alumax_item['title'] ?? ($alumax_item['label'] ?? ''),
            'text'      => $alumax_item['text'] ?? '',
        ];
    }
    unset($specs['install_eyebrow'], $specs['install_title'], $specs['install_description'], $specs['install_tag'], $specs['install_note'], $specs['install_items']);

    $control = alumax_product_page_section('control', $post_id);
    $control['cta'] = ['label' => $control['cta_label'] ?? '', 'url' => $control['cta_url'] ?? ''];
    unset($control['cta_label'], $control['cta_url']);

    $cases = alumax_product_page_section('cases', $post_id);
    $cases['link'] = !empty($cases['link_label'])
        ? ['label' => $cases['link_label'], 'url' => !empty($cases['link_url']) ? $cases['link_url'] : get_post_type_archive_link('case')]
        : null;
    unset($cases['link_label'], $cases['link_url']);

    $inquiry = alumax_product_page_section('inquiry', $post_id);
    if (!empty($inquiry['products'])) {
        $inquiry['products'][0]['checked'] = true;
    }

    return [
        'hero'       => $hero_args,
        'intro'      => alumax_product_page_section('intro', $post_id),
        'advantages' => alumax_product_page_section('advantages', $post_id),
        'specs'      => $specs,
        'control'    => $control,
        'options'    => alumax_product_page_section('options', $post_id),
        'palette'    => alumax_product_page_section('palette', $post_id),
        'install'    => $install,
        'cases'      => $cases,
        'inquiry'    => $inquiry,
    ];
}

/* -------------------------------------------------------------------------
 * 模块化产品页统一渲染（模块顺序集中在这里维护，single-product.php 直接调用）
 * 顺序：Hero → 产品介绍 → 核心优势 → 特殊属性(可选) → 技术参数 → 色板
 *      → 产品细节 → 安装方式 → 工程案例 → 询价表单
 * 每个模块受后台「详情页模块」勾选控制（alumax_pp_enabled_modules），
 * 且内容为空时自动跳过。
 * ------------------------------------------------------------------------- */
function alumax_render_product_page($post_id = null) {
    $alumax_sections = alumax_product_page_sections($post_id);
    $alumax_on = alumax_pp_enabled_modules($post_id);
    $alumax_show = function ($key) use ($alumax_on) {
        return in_array($key, $alumax_on, true);
    };
    ?>
<main class="w-full bg-surface">
  <div class="flex flex-col w-full bg-surface text-on-surface">
    <?php
    // 面包屑已内嵌在 hero 组件顶部（深色变体）
    if ($alumax_show('hero')) {
        get_template_part('template-parts/product-sections/hero', null, $alumax_sections['hero']);
    }
    if ($alumax_show('intro') && !empty($alumax_sections['intro']['title'])) {
        get_template_part('template-parts/product-sections/intro', null, $alumax_sections['intro']);
    }
    if ($alumax_show('advantages') && !empty($alumax_sections['advantages']['cards'])) {
        get_template_part('template-parts/product-sections/advantages', null, $alumax_sections['advantages']);
    }
    if ($alumax_show('control') && !empty($alumax_sections['control']['modes'])) {
        get_template_part('template-parts/product-sections/control', null, $alumax_sections['control']);
    }
    if ($alumax_show('specs') && !empty($alumax_sections['specs']['rows'])) {
        get_template_part('template-parts/product-sections/specs', null, $alumax_sections['specs']);
    }
    if ($alumax_show('palette') && !empty($alumax_sections['palette']['swatches'])) {
        get_template_part('template-parts/product-sections/palette', null, $alumax_sections['palette']);
    }
    if ($alumax_show('options') && !empty($alumax_sections['options']['cards'])) {
        get_template_part('template-parts/product-sections/options', null, $alumax_sections['options']);
    }
    if ($alumax_show('install') && !empty($alumax_sections['install']['items']) && !empty($alumax_sections['install']['title'])) {
        get_template_part('template-parts/product-sections/install', null, $alumax_sections['install']);
    }
    if ($alumax_show('cases') && !empty($alumax_sections['cases']['projects'])) {
        get_template_part('template-parts/product-sections/cases', null, $alumax_sections['cases']);
    }
    if ($alumax_show('inquiry')) {
        get_template_part('template-parts/product-sections/inquiry', null, $alumax_sections['inquiry']);
    }
    ?>
  </div>
</main>
<?php
}

/* -------------------------------------------------------------------------
 * 清洗与收集
 * ------------------------------------------------------------------------- */

function alumax_pp_kses_svg($svg) {
    $attrs = [
        'class' => true, 'viewBox' => true, 'viewbox' => true, 'xmlns' => true,
        'stroke-width' => true, 'stroke-dasharray' => true, 'stroke' => true, 'fill' => true,
        'd' => true, 'cx' => true, 'cy' => true, 'r' => true, 'rx' => true, 'ry' => true,
        'x' => true, 'y' => true, 'x1' => true, 'x2' => true, 'y1' => true, 'y2' => true,
        'width' => true, 'height' => true, 'font-size' => true, 'text-anchor' => true, 'points' => true,
    ];
    $allowed = [];
    foreach (['svg', 'path', 'circle', 'line', 'rect', 'ellipse', 'text', 'polyline', 'polygon', 'g'] as $tag) {
        $allowed[$tag] = $attrs;
    }
    return wp_kses($svg, $allowed);
}

function alumax_pp_sanitize($value, $type) {
    if ($type === 'textarea') {
        return sanitize_textarea_field($value);
    }
    if ($type === 'url') {
        return esc_url_raw($value);
    }
    if ($type === 'html') {
        return wp_kses($value, ['br' => []]);
    }
    if ($type === 'svg') {
        return alumax_pp_kses_svg($value);
    }
    return sanitize_text_field($value);
}

// 收集固定字段组：$map = [键 => 类型]
function alumax_pp_collect($field, $map) {
    $posted = isset($_POST[$field]) ? (array) wp_unslash($_POST[$field]) : [];
    $out = [];
    foreach ($map as $key => $type) {
        $out[$key] = isset($posted[$key]) ? alumax_pp_sanitize($posted[$key], $type) : '';
    }
    return $out;
}

// 收集 repeater：$_POST[$field] 为 [列名 => [行值...]] 结构
function alumax_pp_collect_repeater($field, $columns) {
    $posted = isset($_POST[$field]) ? (array) wp_unslash($_POST[$field]) : [];
    $count = 0;
    foreach ($columns as $col => $type) {
        $count = max($count, isset($posted[$col]) ? count((array) $posted[$col]) : 0);
    }
    $rows = [];
    for ($i = 0; $i < $count; $i++) {
        $row = [];
        $all_empty = true;
        foreach ($columns as $col => $type) {
            $value = isset($posted[$col][$i]) ? alumax_pp_sanitize($posted[$col][$i], $type) : '';
            if ($value !== '') {
                $all_empty = false;
            }
            $row[$col] = $value;
        }
        if (!$all_empty) {
            $rows[] = $row;
        }
    }
    return $rows;
}

/* -------------------------------------------------------------------------
 * 后台表单辅助
 * ------------------------------------------------------------------------- */

add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'], true)) {
        return;
    }
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if ($screen && $screen->post_type === 'product') {
        wp_enqueue_media();
    }
});

// 固定字段行（form-table）；type: text|textarea|url；$media=true 时附媒体库选择按钮
function alumax_pp_field($label, $name, $value, $type = 'text', $desc = '', $media = false) {
    $input_id = 'alumax-pp-' . sanitize_title($name);
    ?>
    <tr>
      <th><label><?php echo esc_html($label); ?></label></th>
      <td>
        <?php if ($type === 'textarea') : ?>
          <textarea name="<?php echo esc_attr($name); ?>" class="large-text" rows="3"><?php echo esc_textarea($value); ?></textarea>
        <?php else : ?>
          <input type="text" id="<?php echo esc_attr($input_id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" class="large-text">
          <?php if ($media) : ?>
            <button type="button" class="button alumax-media-btn" data-target="<?php echo esc_attr($input_id); ?>">选择图片</button>
          <?php endif; ?>
        <?php endif; ?>
        <?php if ($desc !== '') : ?>
          <p class="description"><?php echo esc_html($desc); ?></p>
        <?php endif; ?>
      </td>
    </tr>
    <?php
}

// repeater 的 svg 列（case 通用表格只支持 text/textarea/url，这里补一个 svg 文本域）
function alumax_pp_repeater($id, $columns, $rows, $add_label) {
    alumax_case_admin_js();
    $tbody_id = $id . '-body';
    $tpl_id = $id . '-tpl';
    ?>
    <table class="widefat striped" style="max-width:960px;margin-bottom:4px;">
      <thead>
        <tr>
          <?php foreach ($columns as $col) : ?>
          <th <?php echo !empty($col['width']) ? 'style="width:' . esc_attr($col['width']) . ';"' : ''; ?>><?php echo esc_html($col['label']); ?></th>
          <?php endforeach; ?>
          <th style="width:60px;"></th>
        </tr>
      </thead>
      <tbody id="<?php echo esc_attr($tbody_id); ?>">
        <?php foreach ($rows as $row) : ?>
        <tr>
          <?php alumax_pp_repeater_cells($id, $columns, $row); ?>
          <td><button type="button" class="button alumax-rep-remove">删除</button></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <template id="<?php echo esc_attr($tpl_id); ?>">
      <tr>
        <?php alumax_pp_repeater_cells($id, $columns, []); ?>
        <td><button type="button" class="button alumax-rep-remove">删除</button></td>
      </tr>
    </template>
    <p><button type="button" class="button button-secondary alumax-rep-add"
        data-template="<?php echo esc_attr($tpl_id); ?>"
        data-target="<?php echo esc_attr($tbody_id); ?>"><?php echo esc_html($add_label); ?></button></p>
    <?php
}

function alumax_pp_repeater_cells($id, $columns, $row) {
    foreach ($columns as $field => $col) {
        $value = isset($row[$field]) ? $row[$field] : '';
        $name = $id . '[' . $field . '][]';
        echo '<td>';
        if (!empty($col['type']) && in_array($col['type'], ['textarea', 'svg'], true)) {
            echo '<textarea name="' . esc_attr($name) . '" class="large-text" rows="' . ($col['type'] === 'svg' ? '4' : '2') . '">' . esc_textarea($value) . '</textarea>';
        } else {
            echo '<input type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="large-text">';
        }
        echo '</td>';
    }
}

/* -------------------------------------------------------------------------
 * Meta boxes（仅「模块化详情页」产品显示，见 alumax_product_page_slugs）
 * ------------------------------------------------------------------------- */

add_action('add_meta_boxes', function ($post_type, $post) {
    if ($post_type !== 'product' || !($post instanceof WP_Post)) {
        return;
    }
    add_meta_box('alumax-pp-modules', '详情页模块（勾选启用，未勾选的模块前台不渲染）', 'alumax_pp_modules_box', 'product', 'side', 'high');
    add_meta_box('alumax-pp-hero', '详情页内容：Hero 首屏 + 产品介绍', 'alumax_pp_hero_box', 'product', 'normal', 'default');
    add_meta_box('alumaxpp-advantages', '详情页内容：核心优势 + 智能控制 + 定制选项', 'alumax_pp_sections_box', 'product', 'normal', 'default');
    add_meta_box('alumax-pp-specs', '详情页内容：技术参数', 'alumax_pp_specs_box', 'product', 'normal', 'default');
    add_meta_box('alumax-pp-cases', '详情页内容：工程案例 + 询价表单', 'alumax_pp_cases_box', 'product', 'normal', 'default');
}, 10, 2);

function alumax_pp_modules_box($post) {
    $enabled = alumax_pp_enabled_modules($post->ID);
    $saved = get_post_meta($post->ID, '_alumax_pp_modules', true);
    echo '<p class="description" style="margin:0 0 8px;">'
        . esc_html(is_array($saved) ? '当前为手动配置。' : '尚未手动配置，当前按默认规则启用。')
        . '</p>';
    foreach (alumax_pp_all_modules() as $key => $label) {
        printf(
            '<label style="display:block;margin-bottom:6px;"><input type="checkbox" name="alumax_pp_modules[]" value="%s"%s> %s</label>',
            esc_attr($key),
            checked(in_array($key, $enabled, true), true, false),
            esc_html($label)
        );
    }
}

function alumax_pp_hero_box($post) {
    wp_nonce_field('alumax_pp_save', 'alumax_pp_nonce');
    alumax_case_admin_js();
    $hero = alumax_product_page_section('hero', $post->ID);
    $intro = alumax_product_page_section('intro', $post->ID);
    ?>
    <h4>Hero 首屏</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('背景图', 'alumax_pp_hero[bg_image]', $hero['bg_image'], 'text', '', true);
      alumax_pp_field('主标题 H1', 'alumax_pp_hero[title]', $hero['title'], 'text', '换行用 &lt;br&gt;');
      alumax_pp_field('副标题（金色）', 'alumax_pp_hero[subtitle]', $hero['subtitle']);
      alumax_pp_field('描述段落', 'alumax_pp_hero[description]', $hero['description'], 'textarea');
      alumax_pp_field('主按钮文案', 'alumax_pp_hero[primary_label]', $hero['primary_label']);
      alumax_pp_field('主按钮链接', 'alumax_pp_hero[primary_url]', $hero['primary_url'], 'url', '如 #rfq-section');
      alumax_pp_field('次按钮文案', 'alumax_pp_hero[secondary_label]', $hero['secondary_label']);
      alumax_pp_field('次按钮链接', 'alumax_pp_hero[secondary_url]', $hero['secondary_url'], 'url', '如 #technical-specifications');
      alumax_pp_field('次按钮图标', 'alumax_pp_hero[secondary_icon]', $hero['secondary_icon'], 'text', 'Material Symbols 名称，如 download');
      ?>
    </table>
    <h4>Hero 底部特性徽章（可增删，建议 4 个）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_hero_badges', [
        'icon'  => ['label' => '图标', 'width' => '20%'],
        'title' => ['label' => '标题', 'width' => '30%'],
        'text'  => ['label' => '短句'],
    ], $hero['badges'], '+ 添加徽章');
    ?>

    <h4 style="margin-top:24px;">产品介绍</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('左侧大图', 'alumax_pp_intro[image]', $intro['image'], 'text', '', true);
      alumax_pp_field('图片描述（alt）', 'alumax_pp_intro[image_alt]', $intro['image_alt']);
      alumax_pp_field('视频按钮文案', 'alumax_pp_intro[video_label]', $intro['video_label'], 'text', '留空则不显示视频按钮');
      alumax_pp_field('眉标（如 The Product // 系统介绍）', 'alumax_pp_intro[eyebrow]', $intro['eyebrow']);
      alumax_pp_field('标题', 'alumax_pp_intro[title]', $intro['title']);
      alumax_pp_field('描述段落', 'alumax_pp_intro[description]', $intro['description'], 'textarea');
      ?>
    </table>
    <h4>产品介绍特性网格（可增删，建议 4 个排成 2×2）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_intro_features', [
        'icon'  => ['label' => '图标', 'width' => '18%'],
        'title' => ['label' => '标题', 'width' => '30%'],
        'text'  => ['label' => '说明', 'type' => 'textarea'],
    ], $intro['features'], '+ 添加特性');
    ?>
    <p class="description">图标均填 Material Symbols 名称（如 tune / view_in_ar / sensors）。</p>
    <?php
}

function alumax_pp_sections_box($post) {
    $advantages = alumax_product_page_section('advantages', $post->ID);
    $control = alumax_product_page_section('control', $post->ID);
    $options = alumax_product_page_section('options', $post->ID);
    $palette = alumax_product_page_section('palette', $post->ID);
    ?>
    <h4>核心优势板块标题</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标', 'alumax_pp_advantages[eyebrow]', $advantages['eyebrow']);
      alumax_pp_field('标题', 'alumax_pp_advantages[title]', $advantages['title']);
      alumax_pp_field('副文', 'alumax_pp_advantages[description]', $advantages['description'], 'textarea');
      ?>
    </table>
    <h4>核心优势卡片（可增删，建议 4 张）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_advantages_cards', [
        'image'     => ['label' => '图片 URL', 'width' => '26%'],
        'image_alt' => ['label' => '图片描述', 'width' => '18%'],
        'icon'      => ['label' => '图标', 'width' => '10%'],
        'title'     => ['label' => '标题', 'width' => '16%'],
        'text'      => ['label' => '说明', 'type' => 'textarea'],
    ], $advantages['cards'], '+ 添加卡片');
    ?>

    <h4 style="margin-top:24px;">智能控制</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标', 'alumax_pp_control[eyebrow]', $control['eyebrow']);
      alumax_pp_field('标题', 'alumax_pp_control[title]', $control['title']);
      alumax_pp_field('描述段落', 'alumax_pp_control[description]', $control['description'], 'textarea');
      alumax_pp_field('按钮文案', 'alumax_pp_control[cta_label]', $control['cta_label']);
      alumax_pp_field('按钮链接', 'alumax_pp_control[cta_url]', $control['cta_url'], 'url');
      ?>
    </table>
    <h4>运行模式卡（可增删，建议 3 张）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_control_modes', [
        'image'     => ['label' => '图片 URL', 'width' => '24%'],
        'image_alt' => ['label' => '图片描述', 'width' => '16%'],
        'tag'       => ['label' => '角标（如 01 // 0°）', 'width' => '12%'],
        'title'     => ['label' => '标题', 'width' => '16%'],
        'subtitle'  => ['label' => '副标', 'width' => '14%'],
        'text'      => ['label' => '说明', 'type' => 'textarea'],
    ], $control['modes'], '+ 添加模式');
    ?>

    <h4 style="margin-top:24px;">定制选项板块标题</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标', 'alumax_pp_options[eyebrow]', $options['eyebrow']);
      alumax_pp_field('标题', 'alumax_pp_options[title]', $options['title']);
      alumax_pp_field('副文', 'alumax_pp_options[description]', $options['description'], 'textarea');
      ?>
    </table>
    <h4>定制选项卡片（可增删，建议 4 张）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_options_cards', [
        'image'     => ['label' => '图片 URL', 'width' => '22%'],
        'image_alt' => ['label' => '图片描述', 'width' => '14%'],
        'svg'       => ['label' => 'SVG 线图（可选，优先于图片）', 'type' => 'textarea'],
        'contain'   => ['label' => '线图模式', 'width' => '8%'],
        'title'     => ['label' => '标题', 'width' => '16%'],
        'text'      => ['label' => '说明', 'type' => 'textarea'],
    ], $options['cards'], '+ 添加选项');
    ?>
    <p class="description">「线图模式」填 1 表示技术线图完整显示（不裁切），留空则铺满裁切。填了 SVG 线图时优先显示 SVG，图片可留空。</p>

    <h4 style="margin-top:24px;">色板（Color &amp; Coating）板块标题</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标', 'alumax_pp_palette[eyebrow]', $palette['eyebrow']);
      alumax_pp_field('标题', 'alumax_pp_palette[title]', $palette['title']);
      alumax_pp_field('副文', 'alumax_pp_palette[description]', $palette['description'], 'textarea');
      ?>
    </table>
    <h4>色板（可增删，建议 6 个）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_palette_swatches', [
        'color'   => ['label' => '色值（如 #F1F3F5）', 'width' => '18%'],
        'name'    => ['label' => '颜色名', 'width' => '24%'],
        'code'    => ['label' => '编号（如 RAL 9016 // PVDF）', 'width' => '28%'],
        'bespoke' => ['label' => '定制卡', 'width' => '10%'],
    ], $palette['swatches'], '+ 添加色板');
    ?>
    <p class="description">「定制卡」填 1 时该格显示渐变色卡 + 调色盘图标（用于 Bespoke Match），色值可留空。</p>
    <?php
}

function alumax_pp_specs_box($post) {
    $specs = alumax_product_page_section('specs', $post->ID);
    ?>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标', 'alumax_pp_specs[eyebrow]', $specs['eyebrow']);
      alumax_pp_field('标题', 'alumax_pp_specs[title]', $specs['title']);
      alumax_pp_field('规格表标题', 'alumax_pp_specs[table_title]', $specs['table_title']);
      alumax_pp_field('规格表编号（REF）', 'alumax_pp_specs[table_ref]', $specs['table_ref']);
      ?>
    </table>
    <h4>规格表行（可增删）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_specs_rows', [
        'name'  => ['label' => '参数名', 'width' => '26%'],
        'value' => ['label' => '数值'],
        'mono'  => ['label' => '等宽', 'width' => '8%'],
    ], $specs['rows'], '+ 添加参数行');
    ?>
    <p class="description">「等宽」填 1 时数值用等宽字体显示（适合尺寸、型号类数值）。</p>

    <h4>规格表下方按钮（可增删）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_specs_buttons', [
        'icon'  => ['label' => '图标', 'width' => '16%'],
        'label' => ['label' => '文案', 'width' => '34%'],
        'url'   => ['label' => '链接', 'width' => '28%'],
        'style' => ['label' => '样式', 'width' => '12%'],
    ], $specs['buttons'], '+ 添加按钮');
    ?>
    <p class="description">样式填 primary（深蓝实心）或 muted（浅灰）。</p>

    <h4>右侧技术图形卡（可增删，SVG 或图片二选一）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_specs_side_cards', [
        'title'     => ['label' => '标题', 'width' => '18%'],
        'tag'       => ['label' => '角标', 'width' => '12%'],
        'svg'       => ['label' => 'SVG 代码', 'type' => 'svg'],
        'image'     => ['label' => '图片 URL', 'width' => '20%'],
        'image_alt' => ['label' => '图片描述', 'width' => '14%'],
        'caption'   => ['label' => '图注', 'width' => '16%'],
    ], $specs['side_cards'], '+ 添加图形卡');
    ?>

    <h4>安装方式模块（独立板块，显示在「产品细节」之后；标题留空则整模块不显示）</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标（如 Installation // 安装方式）', 'alumax_pp_specs[install_eyebrow]', $specs['install_eyebrow'] ?? '');
      alumax_pp_field('标题', 'alumax_pp_specs[install_title]', $specs['install_title']);
      alumax_pp_field('副文', 'alumax_pp_specs[install_description]', $specs['install_description'] ?? '', 'textarea');
      alumax_pp_field('底部说明', 'alumax_pp_specs[install_note]', $specs['install_note'], 'textarea');
      ?>
    </table>
    <?php
    alumax_pp_repeater('alumax_pp_specs_install_items', [
        'tag'       => ['label' => '角标（如 TYPE 01）', 'width' => '12%'],
        'title'     => ['label' => '标题', 'width' => '18%'],
        'text'      => ['label' => '说明', 'type' => 'textarea'],
        'svg'       => ['label' => 'SVG 代码（可选，优先于图片）', 'type' => 'svg'],
        'image'     => ['label' => '图片 URL', 'width' => '20%'],
        'image_alt' => ['label' => '图片描述', 'width' => '14%'],
    ], $specs['install_items'], '+ 添加安装节点');
}

function alumax_pp_cases_box($post) {
    $cases = alumax_product_page_section('cases', $post->ID);
    $inquiry = alumax_product_page_section('inquiry', $post->ID);
    ?>
    <h4>工程案例板块标题</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标', 'alumax_pp_cases[eyebrow]', $cases['eyebrow']);
      alumax_pp_field('标题', 'alumax_pp_cases[title]', $cases['title']);
      alumax_pp_field('右上链接文案', 'alumax_pp_cases[link_label]', $cases['link_label'], 'text', '留空则不显示链接');
      alumax_pp_field('右上链接地址', 'alumax_pp_cases[link_url]', $cases['link_url'], 'url', '留空则指向案例列表页');
      ?>
    </table>
    <h4>工程案例卡片（可增删，建议 4 张）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_cases_projects', [
        'image'     => ['label' => '图片 URL', 'width' => '24%'],
        'image_alt' => ['label' => '图片描述', 'width' => '14%'],
        'location'  => ['label' => '地点角标', 'width' => '12%'],
        'title'     => ['label' => '项目名', 'width' => '16%'],
        'product'   => ['label' => '应用系统', 'width' => '14%'],
        'area'      => ['label' => '面积', 'width' => '10%'],
        'year'      => ['label' => '年份', 'width' => '10%'],
    ], $cases['projects'], '+ 添加案例');
    ?>

    <h4 style="margin-top:24px;">询价和技术询问（RFQ）</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标', 'alumax_pp_inquiry[eyebrow]', $inquiry['eyebrow']);
      alumax_pp_field('标题', 'alumax_pp_inquiry[title]', $inquiry['title']);
      alumax_pp_field('描述段落', 'alumax_pp_inquiry[description]', $inquiry['description'], 'textarea');
      alumax_pp_field('表单卡标题', 'alumax_pp_inquiry[form_title]', $inquiry['form_title']);
      alumax_pp_field('表单卡角标', 'alumax_pp_inquiry[form_badge]', $inquiry['form_badge']);
      alumax_pp_field('提交按钮文案', 'alumax_pp_inquiry[submit_label]', $inquiry['submit_label']);
      ?>
    </table>
    <h4>左侧价值点（可增删，建议 3 个）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_inquiry_bullets', [
        'icon'  => ['label' => '图标', 'width' => '18%'],
        'title' => ['label' => '标题', 'width' => '30%'],
        'text'  => ['label' => '说明', 'type' => 'textarea'],
    ], $inquiry['bullets'], '+ 添加价值点');
    ?>
    <h4>表单的 Product Interest 选项（可增删，第一个默认选中）</h4>
    <?php
    alumax_pp_repeater('alumax_pp_inquiry_products', [
        'label' => ['label' => '选项名'],
    ], $inquiry['products'], '+ 添加选项');
    ?>
    <p class="description">表单提交后存入后台「产品 → 询价记录」，含全部字段与上传附件（CAD/PDF/ZIP ≤25MB）。</p>
    <?php
}

/* -------------------------------------------------------------------------
 * 保存
 * ------------------------------------------------------------------------- */

add_action('save_post_product', function ($post_id) {
    if (!isset($_POST['alumax_pp_nonce'])
        || !wp_verify_nonce(sanitize_key($_POST['alumax_pp_nonce']), 'alumax_pp_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // 写入内容档案键：别名在档案白名单内且未设置过时记录一次，
    // 之后后台改别名也不影响模块化渲染
    $alumax_slug = get_post_field('post_name', $post_id);
    if (in_array($alumax_slug, alumax_product_page_slugs(), true)
        && !get_post_meta($post_id, '_alumax_pp_profile', true)) {
        update_post_meta($post_id, '_alumax_pp_profile', $alumax_slug);
    }

    // 详情页模块勾选
    $alumax_modules = isset($_POST['alumax_pp_modules']) && is_array($_POST['alumax_pp_modules'])
        ? array_values(array_intersect(array_keys(alumax_pp_all_modules()), array_map('sanitize_key', wp_unslash($_POST['alumax_pp_modules']))))
        : [];
    update_post_meta($post_id, '_alumax_pp_modules', $alumax_modules);

    // Hero
    $hero = alumax_pp_collect('alumax_pp_hero', [
        'bg_image' => 'url', 'title' => 'html', 'subtitle' => 'text', 'description' => 'textarea',
        'primary_label' => 'text', 'primary_url' => 'url',
        'secondary_label' => 'text', 'secondary_url' => 'url', 'secondary_icon' => 'text',
    ]);
    $hero['badges'] = alumax_pp_collect_repeater('alumax_pp_hero_badges', ['icon' => 'text', 'title' => 'text', 'text' => 'text']);
    update_post_meta($post_id, 'alumax_pp_hero', $hero);

    // 产品介绍
    $intro = alumax_pp_collect('alumax_pp_intro', [
        'image' => 'url', 'image_alt' => 'text', 'video_label' => 'text',
        'eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea',
    ]);
    $intro['features'] = alumax_pp_collect_repeater('alumax_pp_intro_features', ['icon' => 'text', 'title' => 'text', 'text' => 'textarea']);
    update_post_meta($post_id, 'alumax_pp_intro', $intro);

    // 核心优势
    $advantages = alumax_pp_collect('alumax_pp_advantages', ['eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea']);
    $advantages['cards'] = alumax_pp_collect_repeater('alumax_pp_advantages_cards', [
        'image' => 'url', 'image_alt' => 'text', 'icon' => 'text', 'title' => 'text', 'text' => 'textarea',
    ]);
    update_post_meta($post_id, 'alumax_pp_advantages', $advantages);

    // 技术参数
    $specs = alumax_pp_collect('alumax_pp_specs', [
        'eyebrow' => 'text', 'title' => 'text', 'table_title' => 'text', 'table_ref' => 'text',
        'install_eyebrow' => 'text', 'install_title' => 'text', 'install_description' => 'textarea', 'install_note' => 'textarea',
    ]);
    $specs['rows'] = alumax_pp_collect_repeater('alumax_pp_specs_rows', ['name' => 'text', 'value' => 'text', 'mono' => 'text']);
    $specs['buttons'] = alumax_pp_collect_repeater('alumax_pp_specs_buttons', ['icon' => 'text', 'label' => 'text', 'url' => 'url', 'style' => 'text']);
    $specs['side_cards'] = alumax_pp_collect_repeater('alumax_pp_specs_side_cards', [
        'title' => 'text', 'tag' => 'text', 'svg' => 'svg', 'image' => 'url', 'image_alt' => 'text', 'caption' => 'text',
    ]);
    $specs['install_items'] = alumax_pp_collect_repeater('alumax_pp_specs_install_items', [
        'svg' => 'svg', 'image' => 'url', 'image_alt' => 'text', 'tag' => 'text', 'title' => 'text', 'text' => 'textarea',
    ]);
    update_post_meta($post_id, 'alumax_pp_specs', $specs);

    // 智能控制
    $control = alumax_pp_collect('alumax_pp_control', [
        'eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea', 'cta_label' => 'text', 'cta_url' => 'url',
    ]);
    $control['modes'] = alumax_pp_collect_repeater('alumax_pp_control_modes', [
        'image' => 'url', 'image_alt' => 'text', 'tag' => 'text', 'title' => 'text', 'subtitle' => 'text', 'text' => 'textarea',
    ]);
    update_post_meta($post_id, 'alumax_pp_control', $control);

    // 定制选项
    $options = alumax_pp_collect('alumax_pp_options', ['eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea']);
    $options['cards'] = alumax_pp_collect_repeater('alumax_pp_options_cards', [
        'image' => 'url', 'image_alt' => 'text', 'svg' => 'svg', 'contain' => 'text', 'title' => 'text', 'text' => 'textarea',
    ]);
    update_post_meta($post_id, 'alumax_pp_options', $options);

    // 色板
    $palette = alumax_pp_collect('alumax_pp_palette', ['eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea']);
    $palette['swatches'] = alumax_pp_collect_repeater('alumax_pp_palette_swatches', [
        'color' => 'text', 'name' => 'text', 'code' => 'text', 'bespoke' => 'text',
    ]);
    update_post_meta($post_id, 'alumax_pp_palette', $palette);

    // 工程案例
    $cases = alumax_pp_collect('alumax_pp_cases', [
        'eyebrow' => 'text', 'title' => 'text', 'link_label' => 'text', 'link_url' => 'url',
    ]);
    $cases['projects'] = alumax_pp_collect_repeater('alumax_pp_cases_projects', [
        'image' => 'url', 'image_alt' => 'text', 'location' => 'text', 'title' => 'text',
        'product' => 'text', 'area' => 'text', 'year' => 'text',
    ]);
    update_post_meta($post_id, 'alumax_pp_cases', $cases);

    // 询价表单
    $inquiry = alumax_pp_collect('alumax_pp_inquiry', [
        'eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea',
        'form_title' => 'text', 'form_badge' => 'text', 'submit_label' => 'text',
    ]);
    $inquiry['bullets'] = alumax_pp_collect_repeater('alumax_pp_inquiry_bullets', ['icon' => 'text', 'title' => 'text', 'text' => 'textarea']);
    $inquiry['products'] = alumax_pp_collect_repeater('alumax_pp_inquiry_products', ['label' => 'text']);
    update_post_meta($post_id, 'alumax_pp_inquiry', $inquiry);
});

/* -------------------------------------------------------------------------
 * 默认值：Pre-Insulated Integrated Wall Panels（设计稿 PRE-INSULATED.html）
 * ------------------------------------------------------------------------- */

function alumax_pp_defaults_pre_insulated() {
    $svg_assembly = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 460 220">
  <rect class="fill-surface-variant" height="90" stroke-width="1" width="180" x="20" y="30"></rect>
  <path class="stroke-secondary" d="M200 45 L215 45 L215 65 L225 65 L225 95 L215 95 L215 115 L200 115" stroke-width="2"></path>
  <circle class="fill-secondary stroke-none" cx="218" cy="55" r="3"></circle>
  <circle class="fill-secondary stroke-none" cx="218" cy="105" r="3"></circle>
  <line class="stroke-secondary" stroke-dasharray="3,2" stroke-width="2" x1="225" x2="260" y1="80" y2="80"></line>
  <circle class="fill-secondary stroke-none" cx="260" cy="80" r="4"></circle>
  <rect class="fill-surface-variant" height="90" stroke-width="1" width="180" x="235" y="30"></rect>
  <rect class="fill-outline-variant" height="180" stroke-width="1" width="14" x="260" y="20"></rect>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="9" x="35" y="25">PVDF METAL FACE (1.2mm)</text>
  <text class="font-label fill-secondary stroke-none" font-size="10" x="35" y="78">PIR / WOOL CORE</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="9" x="175" y="150">LABYRINTH JOINT + EPDM</text>
  <line stroke-width="1" x1="218" x2="218" y1="118" y2="140"></line>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="9" x="280" y="175">STRUCTURAL MULLION</text>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCNnODicoVzplBHNedawi0oozSJ8z-vY9JERJqqiudW4KYr8_GUf8L4ZcSS_oRBOti0I0J2U3_4kDPeoBTUBT1RIol8n79-KvyQqzSUj77zoE179nIEhhfLh0OfZtTMk8elF-aY1NpY4dvNE_h6hHNy3bnEw9gAyWZQzTUP0hM0fWv4BTjhpb-uTO5qHegAjNxr_R_LqwVNwUWluYLaI8Qf7EqPnzT9GrzZ3cLllTgVlKNTZk-B-O-s',
            'title'          => 'PRE-INSULATED INTEGRATED WALL PANELS',
            'subtitle'       => 'Continuous Structural Insulation. Monumental Energy Efficiency. Class A Fire Rated.',
            'description'    => 'All-in-one prefabricated building envelope solution combining precision fluorocarbon metal facing with high-density non-combustible insulation core (PIR / PUR / Mineral Wool), eliminating cold bridges while drastically reducing on-site construction schedules.',
            'primary_label'  => 'Request a Project Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Technical Datasheet (PDF)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'thermostat', 'title' => 'K ≤ 0.022 W/(m·K)', 'text' => 'Ultra-low U-value envelope performance'],
                ['icon' => 'local_fire_department', 'title' => 'Class A Fire Resistance', 'text' => 'ASTM E84 & EN 13501-1 core options'],
                ['icon' => 'air', 'title' => '≥ 5.0 kPa Wind Tightness', 'text' => 'CWCT certified structural resistance'],
                ['icon' => 'speed', 'title' => '60% Faster Erection', 'text' => 'Concealed interlocking tongue & groove'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB3b_BDio9Q1CeSs5bhCIuSc_CbHuRjGiyiu0AKvKAMZeN6mNtqosLBBXEvPW8EbXqb5fIA9AXzz9XsGqV8M3mBZvSuXS6U7oHPdzC7Krk6xOL9U_4w169X_mJOFP3A0n1k6QJy7os-2i25Qzy_ukDGKfiMauwoSlN7YglHD3ZR6-kVH0Y2wLs78M2WVcZkvf-puHtoCXJyElk7GXNMMU-DCYTwTh_D0cqvuaHNFFXRxloeCAmdV2Vy',
            'image_alt'   => 'Engineering cutaway of pre-insulated architectural metal cladding panel revealing continuous insulation core bonded to fluorocarbon coated alloy skin.',
            'video_label' => 'Watch Thermal Break Video',
            'eyebrow'     => 'System Architecture // 系统介绍',
            'title'       => 'What is Pre-Insulated Metal Cladding?',
            'description' => 'Traditional multi-layer field-assembled envelopes rely on sequential site installation of mineral insulation, vapor barriers, air cavity substructures, and exterior metal rainscreens. ALUMAX Series PI-800 transforms this labor-intensive workflow into a factory-bonded, monolithic insulated composite panel engineered to withstand extreme environmental wind loads and thermal cycles.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Exterior Metal Skin', 'text' => 'PVDF / FEVE AA3003-H14 aluminum (0.8–1.5mm) or high-tensile galvanized steel (0.5–1.0mm).'],
                ['icon' => 'hvac', 'title' => 'Core Insulation Layer', 'text' => 'Continuous PUR / PIR foam injection or hydrophobic structural rock wool (45–120 kg/m³).'],
                ['icon' => 'join_inner', 'title' => 'Joint Technology', 'text' => 'Double labyrinth thermal break joint with co-extruded EPDM gaskets against capillary draw.'],
                ['icon' => 'apartment', 'title' => 'Engineered Scope', 'text' => 'Aviation terminals, high-rise towers, cleanrooms, refrigerated logistics & modular structures.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our Pre-Insulated Wall Panels?',
            'description' => 'Engineered for international commercial architectural standards, delivering quantifiable energy savings, environmental comfort, and facade prestige.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida/AEtjO1UPrhF4Knn1ighcHOV2pjT2rt3ryk8Gqd6Nt9wkRlGzjTn6BhgPoKCgYxU_ZHQhbYhiqKfTsLdB-u-EQfNAxXNfQFEv3myaJCMrBu9K6v4UK5UFmBkH7k-bYOlpHun4H8DC09hGE35GWPgetCRU1pCOTCacGfAlfy-qGDTKdhJs_KUdf_FmKl7TRMvr6TSnCuQRMKi8hz6TRrWWL_eYx_eBDZ3Z1KFJbuEwUpJnZ9OrlnsmW4igf8VC8bA',
                    'image_alt' => 'Thermal isolation facade panel installation.',
                    'icon'      => 'device_thermostat',
                    'title'     => 'Thermal Isolation',
                    'text'      => 'Continuous structural insulation core eliminates thermal bridging, cutting HVAC energy loss by up to 45% across extreme climates.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida/AEtjO1Xs8AL7bi_SAHAHrzLHJXKjJ2qDCneCkA_VpKdhF5FmdpHL9cXVK0N9OIQ3wTy1t0Njwef8yjgZJdf4th0zvdskzYbUdHWZH3I6FRajr3aB5rUWgeyLpxtbqyk3XoeXyKpnuoPSUYayS14hF-Vspim5h7JZk6ufQyiahBFAIPD3V5Il7Qad23vNwKctcHL3__xOCv6UkXrBeJ6zaXIyz7RI_oqWmt5Yg_sVNiYACdw44JjIDUo3nck8ncM',
                    'image_alt' => 'Class A fire resistance cladding panel details.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Class A Fire Resistance',
                    'text'      => 'Non-combustible continuous mineral wool or PIR core certified to ASTM E84 & EN 13501-1, providing superior life-safety compliance.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida/AEtjO1WtjBg3bvQ3Vhf7VYA5JWnwpUhg1BiJlM6rnU-cIZC0n0yWmKAHL3790EKCMIoccPVkcdKgPhN9IfccTUklCJVjSBvJKRu60zZMdC2KBkH3no3ZjegofBvAZlsdGl4Tj7jENbO-wyIE0JSI4qN5Lmm54EicA3b6MRdpxGYnXfqb6GbK_iSI-enax2URZsntd-OszHA4fp9w8vYe_neWIWtfZqizPPTrJjOsAZX071URp-JO-nwS36drnA',
                    'image_alt' => 'Monolithic flatness high-end architectural facade.',
                    'icon'      => 'architecture',
                    'title'     => 'Monolithic Flatness',
                    'text'      => 'Precision automated roll-forming and tension-leveled facing panels ensure zero oil-canning with multiple shadow reveals and custom finishes.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida/AEtjO1UQylIN3_GhTLO6l7dA51NtzIP78cv3QoqePJYjS0FOYWua1fb1W8Cv9CL3ZnRYFAByjjnhrod36KViFD0Ym_vE9KuffDqySNytZllsCrgyMRJa8arQK5u-HrAxQPVNcxoYeY1FePqFFeV10CDu1EdikPsT_ztQH2s1jA9IHdd-R5gKA5YHQbTZIpiEupWg8hMGVDhI7UyTgFUl5n6VP0U3TOYg6HnSGhcWjamX2S2DS3gRHTd6cdlLyiI',
                    'image_alt' => 'Fast-track erection interlocking panel seams.',
                    'icon'      => 'speed',
                    'title'     => 'Fast-Track Erection',
                    'text'      => 'Interlocking tongue-and-groove joint geometry accelerates on-site installation by over 60%, drastically cutting labor and scaffolding costs.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Certified Engineering Parameters',
            'table_title' => 'Certified Engineering Matrix',
            'table_ref'   => 'REF: AX-PI-800-2025',
            'rows'        => [
                ['name' => 'Facing Material', 'value' => 'AA3003-H14 Aluminum (1.0mm) ｜ Heavy-Duty: AA5052-H32 / Galvalume (1.2–1.5mm)', 'mono' => ''],
                ['name' => 'Core Options', 'value' => 'PIR (Polyisocyanurate) Foam ｜ Heavy-Duty: Hydrophobic Structural Rock Wool (A2)', 'mono' => ''],
                ['name' => 'Total Panel Thickness', 'value' => '50mm / 75mm / 100mm ｜ Heavy-Duty: 120mm / 150mm Custom', 'mono' => '1'],
                ['name' => 'Module Width', 'value' => '600mm / 800mm / 1000mm ｜ Heavy-Duty: 1150mm Maximum', 'mono' => '1'],
                ['name' => 'Span Length', 'value' => '2,000mm – 6,000mm ｜ Heavy-Duty: Up to 12,000mm Continuous', 'mono' => '1'],
                ['name' => 'Core Density', 'value' => 'PIR: 42–45 kg/m³ ｜ Rock Wool: 100–120 kg/m³', 'mono' => '1'],
                ['name' => 'Thermal Conductivity', 'value' => '0.022 W/(m·K) (PIR) ｜ 0.036 W/(m·K) (Mineral Wool)', 'mono' => '1'],
                ['name' => 'Fire Classification', 'value' => 'EN 13501-1 B-s1,d0 (PIR) ｜ ASTM E84 Class A / EN A2-s1,d0', 'mono' => ''],
                ['name' => 'Acoustic Reduction', 'value' => 'Rw 30 dB (PIR Core) ｜ Rw 35–38 dB (Rock Wool Core)', 'mono' => '1'],
                ['name' => 'Surface Finish Layer', 'value' => 'PVDF 2-Coat (28μm) ｜ PVDF 3-Coat / FEVE (35–42μm)', 'mono' => ''],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Download Spec Schedule (PDF)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'architecture', 'label' => 'Request BIM (.RVT) / CAD (.DWG)', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Panel Assembly Schematics',
                    'tag'       => 'LOD 400',
                    'svg'       => $svg_assembly,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Self-aligning tongue & groove; concealed fasteners eliminate thermal breaks',
                ],
            ],
            'install_eyebrow'     => 'Installation // 安装方式',
            'install_title'       => 'Dry-Construction Fastening & Joints',
            'install_description' => 'Engineered for swift dry installation without wet plaster or silicone façade caulking. Zero thermal bridge transmission via proprietary nylon-reinforced thermal breaks.',
            'install_note'        => 'Standard installation CAD details (DWG) and LOD 400 Revit families available on request.',
            'install_items'       => [
                [
                    'tag'   => 'METHOD 01 // SECRET-FIX',
                    'title' => 'Concealed Fastener T&G Interlock',
                    'text'  => 'Extended female flange conceals structural self-drilling bi-metal A2/A4 fasteners; each subsequent panel locks over the fixings for a seamless monolithic façade without exposed screw heads. Factory-integrated butyl mastic and PVC isolator strip.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuADDM0hPlC-b2C82gqXA8B8QDuDD14Ft0WUu2cnUbpNiEGofxNWJ5o-4kH0-5Hl9orvMQhSC1Av79QdiDOTW5R3yPDFWmUJqTT5IsYf6-_mbqO5RiSJnF9ACLydFX8MK0fDpZFx34sZC4CQYW7fA-8Bj9mr3TZnhIGpfAYIWKKsmAQiJgx_nCXPbgAcmv404N3R29g_HQFfpTP4RMZI_7Y_bzx3C4KckfUnYjVtL9o',
                    'image_alt' => 'Technical CAD blueprint showing secret-fix tongue and groove joint with hidden stainless steel fastener connecting pre-insulated panel to vertical aluminum runner.',
                ],
                [
                    'tag'   => 'METHOD 02 // THERMAL-BREAK',
                    'title' => 'Sub-Frame Thermal Decoupling Bracket',
                    'text'  => 'Heavy-gauge aluminum structural clips interface with the main building structure via 10mm high-density polyamide PA66 GF25 isolator shims, completely halting thermal conductance into interior slabs. Up to 6.2 kN per bracket, ±25mm adjustability in X, Y, Z axes.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNOfT7JXuq1zM6d9XSfBsesGV1mWLYe-TVsPFUxlxWiY4CUJUifJtK4kKuPw8vqpnFS-0FYM8EWh9YYRdfrmmpVSJnZkyzqAxQBhWZVTOqqo2J4l_tmgzsjBxX5pX83lMU5APt8mSct8F7TOlfldt_zP7wuq2K_nMX4PN15YER4rz82B3r3eEBr0vgdZE6nKJtHxXgKB6dYBxIxH-S-5MWZvK05CfCgy8oJtz6y74',
                    'image_alt' => 'Engineering schematic of thermal break aluminum wall bracket connecting heavy insulated sandwich cladding to concrete slab edge with isolator pad.',
                ],
                [
                    'tag'   => 'METHOD 03 // CORNER & EXPANSION',
                    'title' => 'Mitered Flashing & EPDM Gasket',
                    'text'  => 'Prefabricated factory-bent 2.0mm PVDF aluminum corner units ensure sharp 90° architectural corners without site cutting. Complete weatherproofing via dual vulcanized EPDM compression gaskets backed by integrated internal weeping drainage paths.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAY2SIkZ1wOin6vBFUfXz1Xps_3eOcDn0TFup_uuUfr4DWo9o-693YC-Exda4oAnon2vrz9hc0CIexmKSCWjUhlQavviMe-MzNRwJLrWPIF_Y54RJhfb3sJrIZ3l2t-UAlIidHKXU7Zzwc4yckKYNoqdsQyxK4hnZcLxevN_eT3H1SP8XjSkakAe1OrXhRB8PJxh6S-qIupAgb9qh6Evs-3ROE16FSnHVzdNeNqXNE',
                    'image_alt' => 'Close-up of tongue and groove thermal break dry interlocking joint of pre-insulated metal cladding with EPDM gasket compression.',
                ],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Geometry Options // 定制选项',
            'title'       => 'Architectural Panel Facing Profiles & Finishes',
            'description' => 'Engineered face profiles configured to manipulate building shadows, structural flatness, and aesthetic rhythms. Fluorocarbon coil-coating tested under ASTM G154; custom RAL, Pantone, and metallic sheen matching available.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBzFT6b667QBNiOU_jW5we-ie9fh5GmECmazEkw-4Hi8VVm37tYCNKSnWqarZGHiESv3KtQJhSos_iFGQsld4cM6PG4jS0BCIesc1p6y1YdtlR6wZXCqULj8auL4m3Rt3emm-D1paDBcFZIgpIKt8hTNrQPDOitYrjfDcyONvHYsdY2Tyky3-z1H4_Vxa6bm3UVL9UGL7YTXUKM3jHhR4Q079BHyzQM-aH6cdtaADytHWYzdTfkvjmP',
                    'image_alt' => 'Flat architectural reveal facade panel with crisp shadow gaps in pearl silver.',
                    'contain'   => '',
                    'title'     => 'Flat Architectural Reveal (FR-01)',
                    'text'      => 'Ultra-smooth exterior face with 15mm or 25mm shadow recess joints, engineered for monument towers demanding unblemished planar flatness.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBeHSJC8ByEX3-ap7KF7wIf4B3y9EwyhoP9ywtc7nvcpTalLlmxYRiJxfqc3lLLMoW2rdG4wPX0hqybUgJrXxkNSRHoGoTEOygY029Ic9HGUOI9pwT_OItdyMVrB2MewVos6HbGTUSgKTDlSm72_rC992eLuXtCM19Uk43edyVBZtDWZYm6KJhdhhvdqQN9KaPLvojlDi-x18qQA9SqQDmy3tLq_wnRo-A2QagR3x7atT9qHzinARyA',
                    'image_alt' => 'Ribbed linear insulated metal cladding panel with continuous longitudinal flutes.',
                    'contain'   => '',
                    'title'     => 'Ribbed Linear Rhythm (RL-02)',
                    'text'      => 'Longitudinal extruded profile ribs providing dynamic light reflection while substantially boosting span deflection stiffness.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCNtfWTeU-2df-PHtSFsEAyX0_jIka8uEBhg3gORY22meBV0KtxvZENo2VWme7RuJ4sF3jWC-0IYUEyYB0-CSTN8QPGPG3hcEqFiLi7bQP6CbaYBo-1T1F3qvqfz5PgTGglxniPZFEUr3LHN4FJUI8D67p0BQ5lrhm163jYtcYFz1IXh5KCakX-nqZfDky71gYzNOMFK_6tt4nfEWADFOGA0yjG4cti8HeAgnqHPX6HhDg07wjw9vEE',
                    'image_alt' => 'Micro-fluted corrugated architectural facade panel in champagne bronze metallic finish.',
                    'contain'   => '',
                    'title'     => 'Micro-Fluted Wave (MF-03)',
                    'text'      => 'Subtle sinusoidal surface texture that masks structural oil-canning and micro-deflections over ultra-long unbraced spans up to 10 meters.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB6JFYlN6SeHKdPiYAnuAYyjjfn2wXIKO5Zb_L7rHXN8aO-Q0PVppfixJIMOM0UjPhKEltNWMGKqxB9lc3_DGJdfbQ1OwbbrMJStSCJhKp4YrulRIQ01bZdsW-rkBdYSKSj2dZdKRFm3Rnh_blLHG8NuZ10jL-mCpKmlQEeBJe30H0dMpNwMOxqD8YmVHUbToNAVCgETnIdfh-gBUVXj3EPLgAFXN8RFY1oTyd3rrfZ01PuP84aso00',
                    'image_alt' => 'Embossed stucco architectural metal cladding panel in dark graphite finish.',
                    'contain'   => '',
                    'title'     => 'Embossed Stucco Texture (ET-04)',
                    'text'      => 'Mechanical micro-embossed surface creating a soft diffuse sheen, ideal for high-traffic ground podiums and industrial logistics portals.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'Standard Architectural Palette & Custom Formulation',
            'description' => 'Fluorocarbon coil-coating tested under ASTM G154 accelerated weathering. Custom RAL, Pantone, and metallic sheen matching available.',
            'swatches'    => [
                ['color' => '#F1F3F5', 'name' => 'Pure White', 'code' => 'RAL 9016 // PVDF', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Silver Metallic', 'code' => 'RAL 9006 // PVDF', 'bespoke' => ''],
                ['color' => '#939699', 'name' => 'Signal Grey', 'code' => 'RAL 7042 // PVDF', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Anthracite Grey', 'code' => 'RAL 7016 // FEVE', 'bespoke' => ''],
                ['color' => '#927B5E', 'name' => 'Champagne Bronze', 'code' => 'RAL 1035 // Anodized Look', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'RAL / Pantone / Sparkle', 'bespoke' => '1'],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Installed Projects Across Global Environments',
            'link_label' => 'View All Global Projects',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5Pr--9UU3wmBPveKOGrC6Q351X-QpTtOM4C5r_J_X-TI-rO-5tv6vlOxzGIJBUCgTde0d933tn4kbI_tGYEBbXBlohL61kic4GBw24rUv-IAZlPLSiDXbvDRUr1zuOHhwUm2NVqudfSATd8Vir8WCx50g68iZOA2GU-Jded1xFTikPRU-TEkTBYvbTK3Phf9QT9Z7K0z-DAdLNoWdL8YFBo1uVkRFUWIGoXFMkfT6qsYDJBcj-elU',
                    'image_alt' => 'Nordic research laboratory building with white and anthracite pre-insulated metal wall cladding.',
                    'location'  => 'OSLO, NORWAY',
                    'title'     => 'Oslo Science City Campus',
                    'product'   => 'Nordic Bioclimatic Research Center — 100mm PIR',
                    'area'      => 'Area: 18,500 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCPSWEU4WAtKszwxgW6whpX4s7PVlRzp0zccJGmgAO6jtZ3Mx18EMxclkhNqvffa7O7-Ccy1DiNCkxanHO-GKg3W_UXo27F8b9Jsls0LDCbTxvF5Bii7f8vAhxw_WcPHSOjth_L3J6oTmuqWh1afVVaPgJ4x8ERU6vSWTSsOxJPl0EOroHFddbMt3ht1jLr88uV57JcUSkTaiIhQL5VJop-iXMHvUQyMv639PGBfhEXbNEzhQ6Q4AG1',
                    'image_alt' => 'High-tech logistics facility in Zurich Switzerland with silver metallic insulated panel facade.',
                    'location'  => 'ZURICH, SWITZERLAND',
                    'title'     => 'Kloten Automated Freight Hub',
                    'product'   => '120mm Rock Wool // EN A2-s1,d0',
                    'area'      => 'Area: 42,000 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBy-FFhDDTHucHGqGIdOO6HsR9IwX7tdQzMBvPURmaaDO5FVg_at56sb1bsBJwPv9xyJ54Bt5R1dw7Ava7Q8mWyvKXj5WpDATc4Rny2uWwHYc41VY_NBIlhbbTqO3W8jPuQXCOyAqqiX55bBj-vNa2AeE3UmeMYapMM2cyYQhHf4k4r4GvZBaCojvHl3xQwWSQX2VSeD_Zm4T-eohh9tqjZQxWZC1gUmiZLIl9XLJC2lpjYtojeK4Lr',
                    'image_alt' => 'International air cargo terminal in Melbourne Australia with champagne bronze pre-insulated facade.',
                    'location'  => 'MELBOURNE, AUSTRALIA',
                    'title'     => 'Tullamarine Express Logistics Port',
                    'product'   => '75mm PIR // 5.4 kPa Wind Rated',
                    'area'      => 'Area: 29,000 m²',
                    'year'      => 'Year: 2024',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Request a Project Quote // 询价与技术咨询',
            'title'        => 'Need Thermal Calculations & Engineering Support?',
            'description'  => 'Our in-house facade structural and thermal simulation team provides project-specific finite element thermal bridge analysis (U-values, condensation risk, deflection schedules, fastener pull-out) to support project authority approvals.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Submit Inquiry & Request Pricing',
            'bullets'      => [
                ['icon' => 'calculate', 'title' => 'THERM 2D/3D Finite Element Reports', 'text' => 'U-values, condensation risk & deflection schedules.'],
                ['icon' => 'air', 'title' => 'Project Wind Load Span Optimization', 'text' => 'Fastener pull-out calculations for authority approvals.'],
                ['icon' => 'architecture', 'title' => 'Detailed Subframe Shop Drawings', 'text' => 'LOD 400 BIM models & installation details.'],
            ],
            'products'     => [
                ['label' => 'Pre-Insulated Wall Panels'],
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Honeycomb Panels'],
            ],
        ],
    ];
}


/* -------------------------------------------------------------------------
 * 默认值：Architectural Steel Wall Panels（设计稿 Steel.html / Series CL-700）
 * ------------------------------------------------------------------------- */

function alumax_pp_defaults_steel() {
    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCTFIAKTmzB4rf9fOzZaRwYrAbkriAWdn_CGOQkntrrXWxYK2uI2p6Ttz4PvofrkN9rPED-B7UhWjQquagJR6WScgnfnzEtJnDNOg-JKYSV5uqgj_skdK-3xF8tO1XNoaMRgLM_iHKQk7MmTeQoSac6xS2GP0GkFDPK6yVPp30uMc529I5IPL76ZTxqtS6hSrv5eyIFYraPBFLfhUmB54QSE0DwSYk5ypd2hmbxNNU',
            'title'          => 'ARCHITECTURAL STEEL WALL PANELS',
            'subtitle'       => 'Class IV Ballistic Impact. 210 GPa Rigidity. Non-Combustible A1.',
            'description'    => 'High-tensile structural steel cassettes engineered for extreme wind loads, severe public transit impact resistance, and maximum span flatness exceeding traditional aluminum thresholds. Spec ID: ALU-ST-7000 // ISO 9001 / EN 13501 A1.',
            'primary_label'  => 'Request Steel Sample Box & Tender Pricing',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Spec Sheet (PDF 4.1MB)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'shield', 'title' => 'CLASS IV IMPACT', 'text' => 'EN 14019 / ASTM E695 hard body certified.'],
                ['icon' => 'local_fire_department', 'title' => 'NON-COMB. A1', 'text' => 'BS 476 / EN 13501-1 fire rating.'],
                ['icon' => 'straighten', 'title' => 'MAX 8,000 MM', 'text' => 'Single continuous panel length.'],
                ['icon' => 'compress', 'title' => '210 GPA MODULUS', 'text' => '3× the rigidity of aluminum.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcJ3ulKOfM_ZUAgd46Fu0GT7ntIfIrDiYGt9nYo0dxefcNDlisdnvQhlrp0vyFN9Uza8gAxB-5w9IhK_zHZm4im4upUXnJ0iHCJdkD_1qUqxEEjE1jzGorc97WZDm8nerN5SuI0-gwtz1K2wScWQyuzS4WMfOc4pqUakkQSTji3cIjBsbe9Fqm4b9wXDnRAaePZczs6d7Cl_88uz0oL4OUfSduBFCRqaYIGdbCGZQ',
            'image_alt'   => 'Engineering cutaway model of a 3mm galvanized steel rainscreen cassette with robotic laser-welded stiffener ribbons and stainless steel hook-on brackets.',
            'video_label' => 'Cassette Cutaway // Laser-Welded Stiffeners',
            'eyebrow'     => 'High-Performance Steel Envelope // 钢质墙板',
            'title'       => 'What is Series ALU-ST-7000?',
            'description' => 'Heavy-duty architectural cladding for railway concourses, civic institutions and coastal high-rise crowns — where impact resilience, fire integrity and multi-storey span flatness exceed what aluminum can deliver. Cassette depth 40–120mm, single panels up to 8,000mm continuous.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Substrate Alloy Grade', 'text' => 'HDG Z275 hot-dip galvanized steel / COR-TEN A/B weathering steel / AISI 316L marine stainless.'],
                ['icon' => 'straighten', 'title' => 'Sheet Thickness', 'text' => '1.5 / 2.0 / 2.5 / 3.0mm (approx. 23.5 kg/m² at 3.0mm gauge).'],
                ['icon' => 'format_paint', 'title' => 'Surface Finishing', 'text' => '3-coat PVDF 35µm (PPG Duranar, 25-yr) / super-durable powder Qualicoat Class 2 / PVD ceramic sputter titanium bronze & gold / stabilized Cor-Ten patina sealer.'],
                ['icon' => 'apartment', 'title' => 'Engineered Scope', 'text' => 'Rail & metro concourses, civic institutions, coastal headquarters, cultural pavilions.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Certified Performance & Deflection Metrics',
            'description' => 'Independently tested under ASTM and European EN façade standards (CNAS / UKAS accredited lab). ALUMAX steel cassettes deliver 300% greater impact resilience than standard architectural aluminum cladding.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCI30uT7_iKJ7-nKxvIDsUjP5QpaR6Jqf0XeYm4G_72pZi87uB_TchHA9eAqTQbjmlUGRF8RA_ogKXIG9cA45O_1HCR68bdxq8LSkzfNivschfwCP5l03YzjpKAjDy1z1e9MvFFEn6rZaYXnqEVyVmNANFfaRywLddSUnMeh14N825edyK0O7LOSLQrzqrNaGC23z7kaWI5dJSvT6zdTpyNyMe7ExThhLT4cQCxYqw',
                    'image_alt' => 'Monolithic steel facade panel cassette with razor-sharp 90 degree brake-formed returns and matte graphite metallic finish.',
                    'icon'      => 'compress',
                    'title'     => '210 GPa Modulus of Elasticity',
                    'text'      => 'Three times the rigidity of standard aluminum (70 GPa), permitting ultra-wide uninterrupted module spans with zero oil-canning — ASTM A653 / EN 10346.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB8wH5E6bnVwpZs49A_eY2oT_XpamP5uBx7dwbNrSJQrkWrkra8_7ZWe2aaKFmlMOj3Zw-UnG1-bLS1kkee6-PoOjSPp4jIKAr8qLhODbfdNmSUtbJEOnqfRjhXS9iVJ9Orf1l52w0I5P32IL6ftausGOFoxJdVqz0S_Ziw1o_ODlxM_OQsnpgS4T1HrumGKVoTNmLrtzjiEHTA8qKDbM3uvxMpvZDWz6wCVr4HXAU',
                    'image_alt' => 'Engineered undercut anchor substructure with extruded aluminum mullion brackets mounting heavy duty steel facade panels.',
                    'icon'      => 'sports_baseball',
                    'title'     => 'Class IV Hard Body Impact',
                    'text'      => 'Surpasses 10 Joules steel sphere drop without permanent cosmetic indentation — mandatory for railway and subway concourses (EN 14019 / ASTM E695).',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhbnoJHN0RnCpCONt7pn8pNYiTmOaJbtLOJ5iye3eTb5pICE9XtgBSVzci3O7hS8M4Yzya_CVGeOjUPJmX7nVfAGKH3u3HqjXu_5zLKRcC3Dp9LSBgdcpYGBtKWw5tkCSEXdc9DUsNI9eZ2DtDTclCF6DzG4h1KWyzuSLhB4RhP-yjMWTnZtLGEla-fooX3zGN3x0eg_YKbxpUjXtxh4jyCXh7XCDlPM0Apcu-qF4',
                    'image_alt' => 'Desert museum with PVD titanium champagne bronze coated stainless steel facade reflecting golden sunset light.',
                    'icon'      => 'air',
                    'title'     => '5.5 kPa Design Wind Pressure',
                    'text'      => 'Tested to L/300 deflection limit under cyclic hurricane wind pressure — suited for coastal high-rise crown installations (ASTM E330 / CWCT Class 1).',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCLhU9OHZ4zk8CWheW2VcId6M3H34ThyLi0SaJX21XFiRABQw-uoTKWeQ3Dy5XPnO5OsFEQ6REuzKxzcGbPM4BhV_yT5PRXWv_2XHnBcbSbHY3FVOxmNEGvv7_QCumK542OcUkf2ZuYzwUZsFrwf7Zs1XLe5el3tPMrLA1MwU9XUkR8aNZqR8P0yMJA4ub3vvTx8Cq4eieRpsrm_KRAhkNCGVrBaPyDGi6G7rc9IeY',
                    'image_alt' => 'Weathered Cor-Ten rust textured steel and PVD titanium champagne bronze stainless panel samples side by side.',
                    'icon'      => 'water_drop',
                    'title'     => '5,000 Hrs Salt Spray Endurance',
                    'text'      => 'Zero blistering or creep with hot-dip Z275 + epoxy barrier + PVDF topcoat — C5-M extreme marine corrosion resistance (ISO 9227 / AAMA 2605).',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Structural Data Schedule',
            'table_title' => 'Substrate Performance Comparison Matrix',
            'table_ref'   => 'SPEC-ALU-ST7000-REV2025',
            'rows'        => [
                ['name' => 'Yield Strength (Re)', 'value' => 'Steel 3.0mm ≥ 320 MPa ｜ Cor-Ten ≥ 355 MPa ｜ 316L ≥ 290 MPa (3mm aluminum: ≥ 145 MPa)', 'mono' => '1'],
                ['name' => 'Reaction to Fire', 'value' => 'Class A1 Non-Combustible — all steel substrates (EN 13501-1 / BS 476)', 'mono' => ''],
                ['name' => 'Linear Thermal Expansion', 'value' => '12.0 ×10⁻⁶/K steel ｜ 11.8 Cor-Ten ｜ 16.0 316L — half of aluminum (24.0)', 'mono' => '1'],
                ['name' => 'Sound Transmission Loss', 'value' => 'Rw 32–33 dB panel only (3mm aluminum: Rw 26 dB)', 'mono' => '1'],
                ['name' => 'Corner Miter & Return', 'value' => 'Seamless laser-welded & ground (steel) ｜ continuous hermetic weld (Cor-Ten) ｜ TIG satin ground (316L)', 'mono' => ''],
                ['name' => 'Hard Body Impact', 'value' => 'Class IV — surpasses 10 J steel sphere drop (EN 14019 / ASTM E695)', 'mono' => ''],
                ['name' => 'Design Wind Pressure', 'value' => '5.5 kPa, L/300 cyclic hurricane (ASTM E330 / CWCT Class 1)', 'mono' => '1'],
                ['name' => 'Salt Spray Endurance', 'value' => '5,000 hrs zero blistering — ISO 9227 C5-M marine (HDG Z275 + epoxy barrier + PVDF)', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Spec Sheet (PDF 4.1MB)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'architecture', 'label' => 'Revit / DWG (14MB)', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Cassette Depth',
                    'tag'       => '40 – 120 MM',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Deep-profile structural cassettes with laser-welded stiffener ribbons for multi-storey spans.',
                ],
                [
                    'title'     => 'Max Continuous Panel',
                    'tag'       => '8,000 MM',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Single-panel lengths up to 8 meters — monolithic column covers and full-height reveals without horizontal joints.',
                ],
                [
                    'title'     => 'Panel Weight',
                    'tag'       => '23.5 KG/M²',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'At 3.0mm gauge — structural subframe and anchor schedule calculated per project wind load.',
                ],
            ],
            'install_eyebrow'     => 'Architectural Detailing // 安装方式',
            'install_title'       => 'Engineered Mounting Substructures',
            'install_description' => 'Three proprietary load-bearing fixing systems accommodate high dead loads, dynamic seismic inter-story drift, and thermal movement without visible exterior fasteners.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'SYS-01 // HOOK-ON',
                    'title' => 'Heavy-Duty Hook-On Rainscreen',
                    'text'  => 'Continuous top hook receiver tabs with integral EPDM isolators — rapid progressive installation and singular panel demountability for maintenance. Joint 15–20mm open rainscreen, ±25mm seismic drift capacity.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA-l5OwmjlclB2S9YAgntm5Jv73JOjbGWdDd__fnNF0sIhqkHH_wwtRjkl9CeQM0N9YY9wjghJGmaifzXjw67sVWetfVZbI1oB6SQivuTIfZYecPokFcTAFPmQeuRWMswiQ2KJoKN_7VP-QSV7CYGMapw75qj2YCcbUtp0nfM8D5DhSy3frnoTmATsUvb3anpzEG1yLDAWGd6dGR81o0daw7qzvLxdgenm53XjJuHI',
                    'image_alt' => 'Technical CAD drawing of heavy duty hook-on steel cassette facade fixing system with EPDM anti-vibration gaskets and vertical mullion channel brackets.',
                ],
                [
                    'tag'   => 'SYS-02 // SECRET-FIX',
                    'title' => 'Flush Secret-Fix Stud Anchor',
                    'text'  => 'Capacitor-discharge welded M8 stainless rear studs eliminate heat tint and face print-through — a monolithic, screw-free glass-flat facade with 10mm tight hairline joints. Stud pull-out load ≥ 8.2 kN per stud.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDKarxNakGB-O1aIeDiaAo5FJG9SotvBGNnvGh7X08DOZq6xQbPWLTjo3qj5hVHuiGmJxsk6mDoBituI9Bh4Smp8NxUNslYboeSFlUURYsJheDAlETCiFTLjDz2YWsMIvVHs3KEnAfZY89KPu53HPGNxHqqZk_AR8nEJq0827KhiTaUvWvWwjZUfDiiWNuWOOkzii2PW3hSDTLY-L_-OXPkrG3F8okOd65BXm9JYKw',
                    'image_alt' => 'Architectural detail section of flush secret-fixing steel facade system using robotic capacitor-discharge welded threaded studs on panel rear.',
                ],
                [
                    'tag'   => 'SYS-03 // SEISMIC',
                    'title' => 'Seismic Inter-Story Expansion',
                    'text'  => 'Floor-to-floor deflection relief channels for supertall buildings, mitigating concrete slab creep and major seismic tier displacement. Joint movement horizontal ±50mm / vertical ±35mm — AAMA 501.4 / 501.6 compliant.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD2BoL7XXArE-Kfu672I66mdYqgh_kuCNsn3cifhSECQ6nTJt8WEwtC3zvObJ-EBeb6BUVMbk2K2wZ-dG3Ie8xmr4UVJ8zHwddi0ixsDHmIjfjQYZdgaH-j3zskdKeniUWT4wcGGIRVY5_qJ9vTOaujw-rPYKPSsfVmNcmCs4d_-ukraVs4UcBKOS8JJfLr1YF6TVB5VNOpWo-vS3EGOijpWH8WwPCH2VhPaEFgufY',
                    'image_alt' => 'Engineering diagram of seismic drift expansion joint for high rise structural steel cladding with sliding spring pins and double moisture seals.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'Architectural Tone & Finish Library',
            'description' => 'PPG Duranar 3-coat PVDF, super-durable Qualicoat Class 2 powder, PVD ceramic sputtered titanium finishes, and stabilized Cor-Ten patina — RAL / NCS custom color match available.',
            'swatches'    => [
                ['color' => '#3A3F44', 'name' => 'Matte Graphite', 'code' => '3-Coat PVDF 35µm', 'bespoke' => ''],
                ['color' => '#8A4B2E', 'name' => 'Cor-Ten Patina', 'code' => 'Stabilized Weathering Steel', 'bespoke' => ''],
                ['color' => '#B08D5E', 'name' => 'Champagne Bronze', 'code' => 'PVD Ceramic Sputter', 'bespoke' => ''],
                ['color' => '#C9A227', 'name' => 'Titanium Gold', 'code' => 'PVD Ceramic Sputter', 'bespoke' => ''],
                ['color' => '#AEB4BA', 'name' => 'Galvanized Silver', 'code' => 'HDG Z275 + Powder', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'Custom RAL / NCS', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Smart Factory Fabrication // 产品细节',
            'title'       => 'Robotic Bending & 15kW Fiber Laser Centers',
            'description' => 'Millimeter-level dimensional repeatability enabled by advanced European automated sheet-metal centers — 450,000 m² annual structural facade capacity.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCI30uT7_iKJ7-nKxvIDsUjP5QpaR6Jqf0XeYm4G_72pZi87uB_TchHA9eAqTQbjmlUGRF8RA_ogKXIG9cA45O_1HCR68bdxq8LSkzfNivschfwCP5l03YzjpKAjDy1z1e9MvFFEn6rZaYXnqEVyVmNANFfaRywLddSUnMeh14N825edyK0O7LOSLQrzqrNaGC23z7kaWI5dJSvT6zdTpyNyMe7ExThhLT4cQCxYqw',
                    'image_alt' => 'Steel cassette panel with crisp razor-sharp 90 degree brake-formed returns.',
                    'contain'   => '',
                    'title'     => 'Salvagnini P4 Automated Panel Bender',
                    'text'      => 'Universal bending tools fold complex upward/downward positive and negative bends automatically without tool changes — ±0.25mm corner fold tolerance with uniform tight radii.',
                ],
                [
                    'image'     => '',
                    'image_alt' => '',
                    'contain'   => '',
                    'title'     => 'Trumpf 15kW Solid-State Fiber Laser',
                    'text'      => 'Nitrogen high-pressure burr-free cutting on up to 8mm heavy-gauge stainless and weathering steel plates, including intricate bespoke perforated patterns.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcJ3ulKOfM_ZUAgd46Fu0GT7ntIfIrDiYGt9nYo0dxefcNDlisdnvQhlrp0vyFN9Uza8gAxB-5w9IhK_zHZm4im4upUXnJ0iHCJdkD_1qUqxEEjE1jzGorc97WZDm8nerN5SuI0-gwtz1K2wScWQyuzS4WMfOc4pqUakkQSTji3cIjBsbe9Fqm4b9wXDnRAaePZczs6d7Cl_88uz0oL4OUfSduBFCRqaYIGdbCGZQ',
                    'image_alt' => 'Cutaway of steel rainscreen cassette with robotic laser-welded stiffener ribbons.',
                    'contain'   => '',
                    'title'     => '6-Axis Robotic Seam Welder',
                    'text'      => 'Automated continuous corner laser welding prevents thermal distortion, followed by robotic planar micro-grinding for seamless 90° razor corners.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Built Environment Archive // 工程案例',
            'title'      => 'Landmark Transportation & Civic Projects',
            'link_label' => 'View All Completed Case Studies',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDJxC9Wp9xDP4GLo5muDWH0xzy-piPv7XO22eV1o1oZ-sbZ0hz-LOWVa6_OjrOEA7dJnShsy16PGJvk6d8MLf-vWtSBEFRxDMAv6VHMRQ-w2W2lQ2cUMNng_zdvSY5ORq96OYYCfbcpTIDoXBqh1uINIc1_zHeKWxLPoTDfdNQp2ZXth8k158iZiRXQgG04Jmz03NCVUPGXKkaePNFgbvpS7Nxb23IIvb5vMs6DTqA',
                    'image_alt' => 'London Crossrail Station subsurface terminal clad in monolithic PVDF steel wall panels with deep architectural reveal joints.',
                    'location'  => 'UNITED KINGDOM',
                    'title'     => 'London Metro Concourse & Tunnel Portals',
                    'product'   => '3.0mm galvanized steel cassettes // Class IV impact certified',
                    'area'      => 'Area: 18,400 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBYkQ7RaxRtBCWX68WKv-c8J3XTQk0Rc-bYuPN7SMWoGFVZM54RSVjQPs_FzvhGX1SkhTTe2yEdPW6lzOnZFH4HcNOKWSSpigc_Ogqjc5r4BxoYYgUb_KrF73HTfKQPLtwWWOtSmiS6L5ueUs6kOh5gSKQCYssGMIUBVkD6hkQ5ehJo6ojeVxtqVpjILI-HSA-i7ZCzdzdOZ9zFeBNnIxNgaarX7OTSFrAR6i5pzCs',
                    'image_alt' => 'Contemporary research center in Berlin with oxidized Cor-Ten weathering steel facade cladding and deep window reveals.',
                    'location'  => 'GERMANY',
                    'title'     => 'Berlin Technology Institute & Labs',
                    'product'   => 'Stabilized Cor-Ten weathering rainscreen // thermal relief channels',
                    'area'      => 'Area: 12,000 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDhbnoJHN0RnCpCONt7pn8pNYiTmOaJbtLOJ5iye3eTb5pICE9XtgBSVzci3O7hS8M4Yzya_CVGeOjUPJmX7nVfAGKH3u3HqjXu_5zLKRcC3Dp9LSBgdcpYGBtKWw5tkCSEXdc9DUsNI9eZ2DtDTclCF6DzG4h1KWyzuSLhB4RhP-yjMWTnZtLGEla-fooX3zGN3x0eg_YKbxpUjXtxh4jyCXh7XCDlPM0Apcu-qF4',
                    'image_alt' => 'Desert museum in Doha with PVD titanium champagne bronze coated 316L stainless steel facade.',
                    'location'  => 'QATAR',
                    'title'     => 'Doha Maritime Cultural Pavilion',
                    'product'   => 'PVD Titanium Champagne Bronze 316L // C5-M marine rated',
                    'area'      => 'Area: 24,500 m²',
                    'year'      => 'Year: 2024',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Global Tender Desk // 询价与技术咨询',
            'title'        => 'Engineering Quotation & Sample Kit Request',
            'description'  => 'Submit your project schedule, wind-load parameters, or architectural elevations. Our senior facade engineering team delivers structural pre-calculations within 48 business hours. Direct hotline: +971 4 887 0192 (MENA) // +86 757 8588 3310 (HQ).',
            'form_title'   => 'Steel Envelope RFQ Package',
            'form_badge'   => '48H ENGINEERING RESPONSE',
            'submit_label' => 'Submit RFQ Package & Request Sample Kit',
            'bullets'      => [
                ['icon' => 'inventory_2', 'title' => 'Custom Sample Kit', 'text' => 'Physical steel sample box dispatched via DHL Express with alloy certificates.'],
                ['icon' => 'deployed_code', 'title' => 'FEA Wind-Load Analysis', 'text' => 'Structural wind-load deflection calculations and FEA stress analysis report.'],
                ['icon' => 'payments', 'title' => 'LME-Indexed Pricing', 'text' => 'FOB / CIF unit rate cost matrix based on current LME steel indexes.'],
            ],
            'products'     => [
                ['label' => 'Architectural Steel Wall Panels'],
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Aluminum Honeycomb Panels'],
            ],
        ],
    ];
}
function alumax_pp_defaults_solid() {
    $svg_cassette = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 460 220">
  <rect class="fill-surface-variant" height="120" stroke-width="1" width="200" x="40" y="50"></rect>
  <path class="stroke-secondary" d="M40 50 L28 38 L228 38 L240 50" stroke-width="1.5"></path>
  <path class="stroke-secondary" d="M240 50 L228 38 L228 158 L240 170" stroke-width="1.5"></path>
  <line stroke-width="1.5" x1="80" x2="80" y1="50" y2="170"></line>
  <line stroke-width="1.5" x1="140" x2="140" y1="50" y2="170"></line>
  <line stroke-width="1.5" x1="200" x2="200" y1="50" y2="170"></line>
  <rect class="fill-surface-variant" height="150" stroke-width="1" width="16" x="300" y="35"></rect>
  <line class="stroke-secondary" stroke-width="2" x1="240" x2="300" y1="90" y2="90"></line>
  <circle class="fill-secondary stroke-none" cx="270" cy="90" r="4"></circle>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="9" x="42" y="30">3.0mm SOLID ALUMINUM CASSETTE</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="9" x="76" y="190">WELDED STIFFENERS @500mm</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="9" x="300" y="200">6063-T6 MULLION</text>
  <text class="font-label fill-secondary stroke-none" font-size="9" x="255" y="80">HOOK-ON BRACKET</text>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCMaebn_zw5fDUqnAtlaZfqZvG-sCB3Fdf2KCyerz0QO_y1b7b4vqgFM8M2edZ4fukyBa_4N7F127hZSyPgGnjklyfMiUU5zgURK0ex9jg1dhafHaQ08I7zVEdMLCr-PKAoYPVCO8rIGgKXsRYAq_tvjo719MYLQNlg5TNBL7Zs8mlRmTWO_dD27bAkCglmKxcITr7MNUji6NJLzMwLbZLiiOKE4nnPOwFRN1qZ18N3h6S1LT0oUROu',
            'title'          => 'SOLID ALUMINUM CLADDING PANELS',
            'subtitle'       => 'Precision Brake-Formed Rainscreen Cassettes. A2-s1,d0 Non-Combustible. 30-Year Coating Warranty.',
            'description'    => 'Architectural brake-formed solid rainscreen cassettes engineered for severe wind pressures, non-combustible building codes, and high-prestige curtain wall enclosures. Code: ALU-SLD-3003.',
            'primary_label'  => 'Request Specimen Kit & Project Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download TDS (PDF)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'aspect_ratio', 'title' => 'MAX SHEET 2,200×6,000 MM', 'text' => 'Single-piece cassettes for monumental spans.'],
                ['icon' => 'layers', 'title' => 'AA3003-H24 / AA5052-H32', 'text' => 'Commercial & marine-grade alloy substrates.'],
                ['icon' => 'local_fire_department', 'title' => 'A2-S1,D0 FIRE RATED', 'text' => 'EN 13501-1 & ASTM E84 Class A non-combustible.'],
                ['icon' => 'verified', 'title' => '30-YEAR WARRANTY', 'text' => 'AAMA 2605 tested fluoropolymer coating systems.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC3qXmRr9rBYqFHlsZCRnIbqrnx0ldQ99QfY3tiUIGwWZ3KRczCYALbEV0ioX2uwbi4Mr6BfrBHlY4X4uJk51oz_h2p5JMHKRTaBWlfz-5Nw_St93m735r7YyEAIEhYoLWHAvoqv9I5b1hZ6hQSuaHQwtNnZ-35wyj26qmIpxw90Rz6T4dIbRSOV6fDRobvKvTdpcugjFM4SgDzpWB4l9ybuQ2Md5HIgJfUd2r_0bXs61d_nFOyVIXD',
            'image_alt'   => 'Completed building facade clad in solid aluminum rainscreen cassette panels.',
            'video_label' => 'Exploded Cassette Assembly & 3D BIM Viewer',
            'eyebrow'     => 'Product Overview // 产品介绍',
            'title'       => 'Brake-Formed Solid Aluminum Rainscreen Cassettes',
            'description' => 'ALUMAX solid aluminum cassettes are CNC brake-formed from single-sheet alloy plate — no composite core, no combustible content — delivering absolute flatness, Class A2 fire performance, and full demountability for super high-rise rainscreen envelopes.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Substrate Alloy', 'text' => 'AA3003-H24 commercial standard / AA5052-H32 marine grade for severe coastal salt spray, per ISO 209-1.'],
                ['icon' => 'straighten', 'title' => 'Nominal Caliber', 'text' => '2.0mm soffit / 2.5mm standard facade / 3.0mm heavy wind load / 4.0mm mega spans.'],
                ['icon' => 'format_paint', 'title' => 'Coating Technology', 'text' => 'PPG Duranar® 3-coat PVDF (70% Kynar 500 / AAMA 2605), Interpon® D3000 powder, Class I anodized, sublimation faux stone.'],
                ['icon' => 'apartment', 'title' => 'Engineering Scope', 'text' => 'Super high-rise envelopes, seismic zones, and corrosive marine coastal atmospheres.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our Solid Aluminum Cassettes?',
            'description' => 'Laboratory-verified metrics compliant with international building safety codes for super high-rise envelopes, seismic zones, and corrosive marine coastal atmospheres.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAehKXxEpMUSxtLPiEIpzZ2VUYkJXhAyqOuYJwOOQN5Gw1xLrgGq9PD_388mrE3_ijVp-bzr4qaIOtodEu9h0Qu7-Yv-OhpaoEHidja0lqzgFc-eJbe-1M0KVlmLE3X-rpYkin5GzLqdLtRi4tw_btUzOXxk1TO97-wKs2qdHAlfPPmIVGjrFyw8fiRZxyCooebQxpjEAXkJu5m1X0uhSxv5dFYR7jU8rpobR5yi5uVs4OuikE7cR7Z',
                    'image_alt' => 'Stud and joint rigidity detail of brake-formed aluminum cassette.',
                    'icon'      => 'air',
                    'title'     => '5.2 kPa Wind Tolerance',
                    'text'      => '3.0mm cassettes sustain 5.2 kPa design pressure with zero permanent deformation at 150% safety margin — super-tower rated under ASTM E330.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBnHm8JxCmqkipz0n7PXRe53qkUXQZla6KBSlunl7yUFxNhdKiSeGTllMVT8Vg9BsT3dA7Ru24-iqYHD1OuZkv3v49hc9MBecrUvNV6PuXxwwxbRqAbNashv6I4WI3p7xLHiQrZozd_Z8pm8e6Ryyu7cF3WVSVA7FViANj9uMGWTsFxGh5fNKHD-U6JoyHKeSEXC5spq_2K3LCAsGV9-vi2GL2alhKrGUGyG_sk1nFwbtbSpG-79t2Z',
                    'image_alt' => '3D exploded view of solid aluminum cassette panel assembly.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'A2-s1,d0 Non-Combustible',
                    'text'      => 'Strictly non-combustible solid aluminum with flame spread 0 — ideal for high-density public towers under EN 13501-1 / ASTM E84.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRsSxZrAQ-SPkGwK7tpEAmOoKxNWyt3mLg3WQozIVYt09hzzJeDRWt1xnyFIOHBW0pm-EG9LeMgeLhDXl5yxLN4zro9DF8ozgXnwaLA0ilhnWf-4fmeNz9Yx94uoYKI8KS4Ce9CPGWnwKDI4DifeyK62WV803QY85KXCT0db82iltFv27f6mhYNqNumUrQG8qMTqJlwzD_mGUoJYMR4nd4VdKTH6L5b37CrjE7X_T27CmvZHOJq-6O',
                    'image_alt' => 'Close-up of PVDF fluoropolymer coating texture on aluminum panel.',
                    'icon'      => 'format_paint',
                    'title'     => '30-Year Fluoropolymer Finish',
                    'text'      => 'PPG Duranar® 3-coat PVDF preserves luster without chalking for 30 years; AAMA 2605 10-year Florida exposure ΔE < 3.0 Hunters.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC3qXmRr9rBYqFHlsZCRnIbqrnx0ldQ99QfY3tiUIGwWZ3KRczCYALbEV0ioX2uwbi4Mr6BfrBHlY4X4uJk51oz_h2p5JMHKRTaBWlfz-5Nw_St93m735r7YyEAIEhYoLWHAvoqv9I5b1hZ6hQSuaHQwtNnZ-35wyj26qmIpxw90Rz6T4dIbRSOV6fDRobvKvTdpcugjFM4SgDzpWB4l9ybuQ2Md5HIgJfUd2r_0bXs61d_nFOyVIXD',
                    'image_alt' => 'Completed facade installation of solid aluminum cladding panels.',
                    'icon'      => 'sailing',
                    'title'     => 'Marine-Grade Corrosion Proof',
                    'text'      => 'ASTM B117 4,000-hour salt spray with zero blistering and creep < 0.5mm — suited to marine docks, offshore hubs, and coastal airports.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Engineering Performance & Static Criteria',
            'table_title' => 'Laboratory Verified Metrics',
            'table_ref'   => 'ALU-SLD-3003 // 2025',
            'rows'        => [
                ['name' => 'Wind Load Sustained Pressure', 'value' => '2.5mm: 3.8 kPa ｜ 3.0mm: 5.2 kPa Super-Tower (ASTM E330 / EN 12179)', 'mono' => '1'],
                ['name' => 'Combustibility & Fire Reaction', 'value' => 'Class A2-s1,d0 ｜ 3.0mm Flame Spread 0 (EN 13501-1 / ASTM E84)', 'mono' => ''],
                ['name' => 'Tensile Strength (Rm)', 'value' => '145–180 MPa ｜ 3.0mm: 160–215 MPa (ASTM B209M / ISO 6892)', 'mono' => '1'],
                ['name' => 'Salt Spray Resistance', 'value' => 'ASTM B117 4,000h: no blister, creep < 1mm ｜ 3.0mm < 0.5mm', 'mono' => ''],
                ['name' => 'Color Retention & Chalking', 'value' => 'AAMA 2605 10-Yr Florida: ΔE < 5.0 ｜ 3.0mm ΔE < 3.0 Hunters', 'mono' => '1'],
                ['name' => 'Acoustic Transmission Loss', 'value' => 'Rw 28 dB ｜ 3.0mm Rw 32 dB, up to 48dB w/ core (ISO 10140-2 / ASTM E90)', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'TDS PDF (4.2MB)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'deployed_code', 'label' => 'BIM & DWG (18MB)', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Cassette & Stiffener Schematic',
                    'tag'       => 'LOD 400',
                    'svg'       => $svg_cassette,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Robotic-welded channel stiffeners every 500mm eliminate optical oil-canning',
                ],
                [
                    'title'     => 'Thermal Expansion Calc',
                    'tag'       => 'ENG-NOTE-02',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Aluminum linear expansion rate is 2.4 mm/m at ΔT = 100°C. All fixing bracket slots feature 6mm ovalized thermal glide tolerances to prevent buckling.',
                ],
                [
                    'title'     => 'LEED v4 Green Credit',
                    'tag'       => 'ENG-NOTE-03',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Contains up to 45% post-industrial recycled aluminum billet. 100% infinitely recyclable at building decommissioning with negligible carbon degradation.',
                ],
            ],
            'install_eyebrow'     => 'Facade Engineering Typologies // 安装方式',
            'install_title'       => 'Fixing Methods & Substructure Details',
            'install_description' => 'Three engineered fixing typologies with CAD elevation detail packages available. All fixing bracket slots feature 6mm ovalized thermal glide tolerances (aluminum linear expansion 2.4mm/m at ΔT 100°C) to prevent buckling.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPE 01 // OPEN-JOINT',
                    'title' => 'Open-Joint Ventilated Rainscreen',
                    'text'  => '12mm dry open shadow reveals without exposed silicone. Pressure-equalized cavity drains condensate instantly, preventing facade staining and dust streaks. Joint width 10–16mm open gap on extruded 6063-T6 aluminum mullions. Best for commercial towers and public museums.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
                [
                    'tag'   => 'TYPE 02 // SEALED',
                    'title' => 'Weatherproof Sealed Joint',
                    'text'  => 'Classic watertight envelope using non-staining structural silicone (Dow Corning 791 / Sika hybrids) over PE backer rod — maximum air-impermeability and acoustic attenuation on galvanized steel tube or aluminum angle substructures. Best for high-acoustic zones and hospital facades.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
                [
                    'tag'   => 'TYPE 03 // HOOK-ON',
                    'title' => 'High-Rise Hook-On Cassette',
                    'text'  => 'Modular interlocking hung brackets designed for expedited crane-assisted exterior erection — up to 150m² per team per day. Neoprene anti-rattle bushings; each panel individually demountable for lifetime utility inspection. Best for supertall skyscrapers and tight urban sites.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'Pre-Approved Exterior Finishes & Custom Matching',
            'description' => 'PPG Duranar® 3-coat PVDF, AkzoNobel Interpon® D3000 hyper-durable powder, Class I hard anodized, and architectural sublimation faux stone — all tested under AAMA 2605.',
            'swatches'    => [
                ['color' => '#927B5E', 'name' => 'Champagne Bronze', 'code' => 'Duranar® Sunstorm // PVDF', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Mica Anthracite', 'code' => 'RAL 7016 // PVDF', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Silver Metallic', 'code' => 'RAL 9006 // PVDF', 'bespoke' => ''],
                ['color' => '#F1F3F5', 'name' => 'Pure White', 'code' => 'RAL 9016 // Powder', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'RAL+ / Stone / Wood Sublimation', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Facade Engineering Typologies // 定制选项',
            'title'       => 'Fixing Methods & Substructure Details',
            'description' => 'Three engineered fixing typologies with full CAD elevation detail packages — from pressure-equalized open joints to crane-assisted high-rise cassette erection.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCoR34GLzSdo-qYsQRCBw7_pmQgW87GqXjfLoUTKmBQzvcW3ua6is9MCEernEw_rGleFzhBgUMWzRfDKB_iOu1GOdDSLWZk5m16dw0dtIC1ZFPv8PvQYylMs5rLE2X7CD6BkiagMehL43_QFZXZPNGoAZCvSTmVnV1U7R790gPzNh9uxZQDIXDzeJiSpLoKZFAcC4ldbdBAmSifuACrjBD8ppQFI3ah5vrrLUNPwivacQlzBSI4dQy_',
                    'image_alt' => 'Open-joint ventilated rainscreen aluminum facade detail.',
                    'contain'   => '',
                    'title'     => 'Open-Joint Ventilated Rainscreen (TYPE 01)',
                    'text'      => '12mm dry open shadow reveals without exposed silicone; pressure-equalized cavity drains condensate instantly. Substructure: extruded 6063-T6 aluminum mullion. Best for commercial towers & public museums.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDV7jiiCf7Eyx4nrwNIju5iL3PuuAhGZrcZ9h49JJgoj1tp773Iu1BneHx_9UmcC6mdUTZg0hKz0pKRKTLgVTSYtDvCuvutzRY3YG7lmWcc1EdVmc2U2Lq2eK60us4jsIix28A7H3grOL5he4qBzd9xapBT1gl3xhr0vPMmhazwRhqUNPiqB4Zc70IbgQTb1AgMin_b6Yk1T4tVZt6gm_G72ugfGELggrU2FR_ual6dUVWMjbPqMD0i',
                    'image_alt' => 'Weatherproof sealed joint aluminum cladding system.',
                    'contain'   => '',
                    'title'     => 'Weatherproof Sealed Joint (TYPE 02)',
                    'text'      => 'Non-staining structural silicone (Dow Corning 791 / Sika hybrids) over PE backer rod; maximum air-impermeability and acoustic attenuation. Best for high-acoustic zones & hospital facades.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBzLHMDt2yUvDvMLnCCH9auUKgECDqm52qe3pPt8JBDTMZ4qzlbsNyo3BpdSITPsIroHS3MMRo8C02Yi26UXhOeqOuVxbAq5hY0f98DcNBa099qSOxABde7R3hS5CHWDv7Xpr15MXMWZJKMbOCazI61DmDW1i8C3ow192-pC3ShJpsvW_IvlldzbsOuN1utG23VdmoIMCWvxDPk0PVMuiSAwd7L18yyMQQOYwNG6IaIBoJcqLVJApSR',
                    'image_alt' => 'High-rise hook-on cassette panel installation.',
                    'contain'   => '',
                    'title'     => 'High-Rise Hook-On Cassette (TYPE 03)',
                    'text'      => 'Modular interlocking hung brackets for crane-assisted erection at up to 150m² per team per day; each panel individually demountable with neoprene anti-rattle bushings. Best for supertall skyscrapers.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Global Landmark Deliveries',
            'link_label' => 'View Complete Portfolio Archive',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDIdER5BVdBVcy11SFx0tMEvT9WTvVoptNe3coGStpz9GWrx6bPzftJNMhdGwm_UJntK_OvxY7lL7JZYmH3cwPU4yoIqNhvCk6uh61SFuLeT4lqubB8RF2igE4WNqhhrg-nyWBlEr1CWoU8ET8HtIwoUFYe2VBMXI4ZCbTgm1yI5wPDH57OgR3aoKFmpUTSofPnjnoRJLGTIDvM9a-7sd44kdFbE_aEEy_RgENoKTHuzOq5kwjVkeAa',
                    'image_alt' => 'DIFC North Commercial Tower in Dubai with champagne solid aluminum cassette facade.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'DIFC North Commercial Tower',
                    'product'   => '3.0mm AA3003-H24 // Duranar® Sunstorm Champagne',
                    'area'      => 'Area: 35,000 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBMIwf9wD7p68eLiOTa2kQyuhVrC_WJHQz25Hz9oGePyaWWXnQ4-7lloxTbOXZs5S0Tr8E2op5LzcUDbmCtPbqMGsJOBjMGhbvnMFAU7ECY46aG-dz0IlPxYlSNVjzDsTej_K5XqNgrAweWMOi7Pzz7uYrgsYJTomCsu5IhzBDzSTzI5L29pnXXyho_97IMGGJWoyYMN1t2o0KLxBqfIrumjAL1rrJjn60oHl0npZ5LVRA7BQ8ILhrW',
                    'image_alt' => 'Changi Aviation Expansion Concourse in Singapore with marine grade aluminum panels.',
                    'location'  => 'SINGAPORE, SG',
                    'title'     => 'Changi Aviation Expansion Concourse',
                    'product'   => '2.5mm AA5052-H32 Marine Grade // Interpon D3000',
                    'area'      => 'Area: 22,000 m²',
                    'year'      => 'Year: 2022',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDn4sDOlD_hxwZh3ma96sOj4dC5I9wd_GaNtD7hQDO3fNKSRGcU6yzDdttNYJ6zJCVMztC1gS1I0a3IkJwcSxg0DlBvqGcD9kBswwfuRv7B1IprH3uibZSZxFRJts6V5nh9adp-nvp45KgqLgRNyCFQYQTb3-Ern4ZlD5Q_za-aPwQ5v_AXeHlLaAsx-Sg3JoXsgrFWSQX8O3au3egDizFTr-wtM70OE0vb4EEfEO0U_mipdVy-kQxy',
                    'image_alt' => 'Frankfurt Eco-Tech Headquarters with mica anthracite perforated aluminum cassettes.',
                    'location'  => 'FRANKFURT, GER',
                    'title'     => 'Frankfurt Eco-Tech Headquarters',
                    'product'   => '3.0mm Mica Anthracite // CNC Acoustic Perforation',
                    'area'      => 'Area: 18,000 m²',
                    'year'      => 'Year: 2024',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Global Tender Desk // 询价与技术咨询',
            'title'        => 'Request Factory-Direct Pricing & Static Calculations',
            'description'  => 'Submit your tender bill of quantities (BOQ), architectural elevation drawings, or wind load parameters. Our senior facade engineering team produces official CIF/FOB proposals within 24 business hours.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Submit Project for Engineering Tender Review',
            'bullets'      => [
                ['icon' => 'speed', 'title' => '24-Hour Turnaround', 'text' => 'Complete bill of materials pricing and structural feasibility check.'],
                ['icon' => 'inventory_2', 'title' => 'Complimentary Courier Kit', 'text' => 'Air-shipped material binder containing cut swatches and corner mockups.'],
                ['icon' => 'verified', 'title' => 'Third-Party Inspection Support', 'text' => 'SGS, TÜV, and BV factory inspection acceptance before port departure.'],
            ],
            'products'     => [
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Metal Ceiling Systems'],
                ['label' => 'Honeycomb Panels'],
            ],
        ],
    ];
}


/* -------------------------------------------------------------------------
 * 默认值：Aluminum Composite Panels（设计稿 alumax_architectural_aluminum_composite_panels_acp_pdp）
 * ------------------------------------------------------------------------- */

function alumax_pp_defaults_acp() {
    $svg_core = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 80">
  <rect class="fill-surface-variant" height="24" stroke-width="1" width="180" x="10" y="20"></rect>
  <rect class="fill-secondary stroke-none" height="24" width="166" x="10" y="20"></rect>
  <text class="font-label fill-on-secondary stroke-none" font-size="11" text-anchor="middle" x="93" y="36">92%</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="10" y="14">INORGANIC MINERAL CORE RATIO</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="10" y="60">Industry PE core: 0% mineral</text>
  <line stroke-width="1" x1="10" x2="190" y1="66" y2="66"></line>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDkD14D96RfHx2yrGy5hXbrcQpsFZP2jXBlDGWdNVBRmOeNNEi4CUx0F1GgbFxyhbuIDRJTpZ3ssYnQ1m4BHF04MbWO7Qxr7P4-e_D0M39-tCmU00-i_c-SkX-Yz06gw2q8qUmc2TWKity4-xnOIR5TKR_GY9c_c_V7NJVkHDuaZUAvAnL1ASp9XaUQfVOdHdxdtOrCjQJGeG9TFgCpvmVeXk55s6VYuxoG3cZ2Lx8',
            'title'          => 'FIRE-RETARDANT ALUMINUM COMPOSITE PANELS',
            'subtitle'       => 'A2/B1 Mineral Core. 3-Coat PVDF 35μm. Zero Oil-Canning Flatness.',
            'description'    => 'Engineered architectural composite material (ACM) pairing high-tensile 3003-H14 aluminum coil skins with non-combustible mineral-filled cores. Precision-bonded through continuous automated thermal lamination for mega-span curtain walls, retail pavilions, and high-wind transport hubs. Code: ALU-ACP-1000.',
            'primary_label'  => 'Request Complimentary ACP Sample Swatches',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Brochure (PDF 5.2MB)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'local_fire_department', 'title' => 'FIRE A2-S1,D0', 'text' => 'EN 13501-1 & NFPA 285 wall assembly passed.'],
                ['icon' => 'verified', 'title' => 'PEEL > 9.0 N/MM', 'text' => 'ASTM D1781 drum peel, 9.4 N/mm test average.'],
                ['icon' => 'straighten', 'title' => 'FLATNESS < 1.5 MM/M', 'text' => 'Zero oil-canning mega-span facade.'],
                ['icon' => 'shield', 'title' => '20 YEARS WARRANTY', 'text' => 'AAMA 2605 3-coat PVDF fluorocarbon.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIaJ7Zo0k13L_e9_JJg-f_Z7TgrpSfazrfvdox_D2eOyDvDWvVqohr0sU3o8MnQvMiERflBk8hbrGuEdD14wVAvxFB_9Vtd-mEi4J_Rsp_RftPpY0G-r-AelBD6hbVXMp2KHZp0YhIfW9vRkW2fInLdIvSZfsy39ijHX0P3bx7Pbwo-ybv0gU5M9f8dK38QVQn4no_26ILz3VmZR15Nms7cXP67fDtcmxgvzagUeI',
            'image_alt'   => 'Cutaway rendering of fire-retardant aluminum composite panel ALU-ACP-1000 with 0.5mm AA3003 skin, mineral core and adhesive layers.',
            'video_label' => '360° Inspect // FR Core Cutaway',
            'eyebrow'     => 'Systems Architecture // 系统介绍',
            'title'       => 'What is the ALU-ACP-1000 Composite System?',
            'description' => 'Continuous hot-melt lamination bonds coil-coated aluminum skins to a mineral-filled core under 190°C–210°C calendering, with in-line ultrasonic resonance checks every 10 meters — ensuring zero delamination risk across harsh maritime and desert thermal cyclings.',
            'features'    => [
                ['icon' => 'local_fire_department', 'title' => 'Mineral Core Fire Rating', 'text' => 'FR-A2 ≥90% mineral non-combustible (EN 13501 A2) / FR-B1 mineral-filled flame retardant.'],
                ['icon' => 'straighten', 'title' => 'Total Panel Thickness', 'text' => '3.0mm interior / 4.0mm facade standard / 5.0mm high-rise / 6.0mm structural.'],
                ['icon' => 'layers', 'title' => 'Aluminum Alloy Skin', 'text' => '0.30mm light / 0.40mm standard exterior / 0.50mm AA3003-H14 heavy-duty, top & back.'],
                ['icon' => 'format_paint', 'title' => 'Surface Finish Tech', 'text' => 'PVDF Kynar 500® 3-coat 35μm, Lumiflon® FEVE high-gloss, nano self-cleaning, chameleon optical.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our Fire-Retardant ACP?',
            'description' => 'Intertek, SGS, and TÜV Rheinland verified — engineered for international commercial architectural standards with quantifiable fire safety and fabrication performance.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBWx9ehUH9_uMSVoH4ftR-wHKn1uKcq2yCI0vvZNC_tK-meubnwkBMIiJsitp8kTIIrqIcUJ8ywAVrLHGxH7PJgJrj67FniRVAS_C_T4ILtgoYlvQo-_FLe-mSjcDeT-qwgMwxBkdeVGOK6uFwuC8Fu2pnph0jQQDm8FmD1R8fmKgCm0l_GBRBMDu0HQkP20rJFUKn8xR0sqxHnH1V-8SnLJPRHvP5lbGr2udLT_k4',
                    'image_alt' => 'High-density A2 fire-rated mineral core cross section of aluminum composite material.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Non-Combustible A2 Core',
                    'text'      => '≥90% inorganic hydroxide core releases bound hydration at >340°C, self-extinguishing flame propagation — EN 13501 A2-s1,d0 & NFPA 285 passed.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDZkEKnwrGokGkxARuXYbzlUKKUCQBk9m1N_lxwaiQ80Juqp9FoColq4JLa3bQo45Xm0AzTSpXgpnnfUiWNlXv19hAgXYxR9dmlBPBBVVxgGxcTJCyMfcUe0vYMRJJSFbSd0rTj-iAJcjPI-whEAvXM9N3o1T3YWD7ryBkLIzftHy75uUuxpSEkyHLW5C0QlQ8NeDA38_o9hZVY8ZV23yjWxDCOujob64b-HPqsdro',
                    'image_alt' => 'Curved column wraps and soffits fabricated from flexible 4mm aluminum composite panels.',
                    'icon'      => 'architecture',
                    'title'     => 'Cold-Formable to R300',
                    'text'      => 'Elastomeric polymeric adhesive prevents core-skin shear delamination at cold radii as tight as R ≥ 300mm on 4.0mm panels — columns, soffits, origami cassettes.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDJlrcRQ-ftyzeMSgsrW2elAMCwW3dHm_YneJ7G63Ya6drPElCoi9d2ecTsugeJOgZH8DeJtOP-I-MEM26ywa-9wkflyALZROxYpOa1swep17kzi2QwskJeteOfZ8xlnOEyFsKGkRQd-sfq4agiWWNFKgygDosvD1KQghOascmcxhehqlr7-aHc1sKrh9KNL8YgdJyPAPMlsmx9n66ky6qve0-OvGtgkmS-8eHEGzo',
                    'image_alt' => 'Material swatch library of champagne bronze, chameleon pearlescent and high-gloss ACP finishes.',
                    'icon'      => 'format_paint',
                    'title'     => 'FEVE / PVDF Coating Library',
                    'text'      => 'Kynar 500® 3-coat, Lumiflon® FEVE 80% gloss, nano self-cleaning and chameleon angle-shift finishes — ΔE ≤ 0.5 batch color uniformity.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBXozRC_h7sf7re-7BnOoIksotFKymR4drwbzMjita_evJKRpfbynb3i6-8R1VLjosTvRH5ZYpddASoERPditg0J-vpxJ00iyEdNKaYFajFG4XapbGIIuHcc83C4c70AxN1umz5zRgsb3yO7GSkknMxQzKNuKGKxzk3cie1zQ9xgftoTbqOdhhd8dV7Knwp9kApEazBr5xnkosCkROX-GzjyYDnLjxKXcf1a3hMWl4',
                    'image_alt' => 'CNC router cutting precision 90-degree V-groove on aluminum composite panel for cassette fabrication.',
                    'icon'      => 'precision_manufacturing',
                    'title'     => 'Site-Friendly Fabrication',
                    'text'      => 'Rapid routing, 90°/135° V-grooving and cassette folding with conventional CNC or handheld grooving equipment — without micro-fracturing the outer coating.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Fire Safety & Structural Performance Metrics',
            'table_title' => 'Laboratory Verification Matrix',
            'table_ref'   => 'INTERTEK / SGS / TÜV',
            'rows'        => [
                ['name' => '180° Drum Peel Strength', 'value' => 'FR-A2 ≥ 9.2 N/mm ｜ FR-B1 ≥ 8.5 N/mm (ASTM D1781)', 'mono' => '1'],
                ['name' => 'Combustion Classification', 'value' => 'FR-A2: Class A2-s1,d0 ｜ FR-B1: Class B-s1,d0 (EN 13501-1)', 'mono' => ''],
                ['name' => 'Wall Assembly Fire Behavior', 'value' => 'FR-A2: NFPA 285 Passed, zero spread ｜ FR-B1: Passed (controlled)', 'mono' => ''],
                ['name' => 'Tensile Strength (Skin AA3003)', 'value' => 'Rm ≥ 130–175 MPa (ASTM E8M)', 'mono' => '1'],
                ['name' => 'Flexural Modulus of Elasticity', 'value' => 'FR-A2: E ≥ 70,500 MPa ｜ FR-B1: E ≥ 42,000 MPa (ASTM C393)', 'mono' => '1'],
                ['name' => 'Coefficient of Thermal Expansion', 'value' => '2.4 mm/m @ 100°C (ASTM D696)', 'mono' => '1'],
                ['name' => 'Accelerated Salt Spray Weathering', 'value' => 'FR-A2: 4,000h no blister (AAMA 2605) ｜ FR-B1: 3,000h (AAMA 2604)', 'mono' => ''],
                ['name' => 'Coil Slitting Dimensions', 'value' => 'Widths up to 2,000mm ｜ Lengths up to 6,000mm custom', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Brochure (PDF 5.2MB)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'view_in_ar', 'label' => 'BIM / CAD LOD 400', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Core Mineral Ratio',
                    'tag'       => 'A2 COMPLIANT',
                    'svg'       => $svg_core,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => '92% inorganic hydroxide — high-purity Mg/Al trihydrate core releases bound hydration at >340°C, self-extinguishing flame propagation',
                ],
                [
                    'title'     => 'Peel Delamination Threshold',
                    'tag'       => 'ASTM D1781',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => '9.42 N/mm peak tensile — ALUMAX testing average 9.4 N/mm versus 5.0 N/mm industry standard minimum.',
                ],
            ],
            'install_eyebrow'     => 'Installation // 安装方式',
            'install_title'       => 'Cassette Hanging & Top-Hat Substructure',
            'install_description' => 'Fix routed folded cassettes to aluminum alloy extruded subframes (6063-T6). Slotted holes allow thermal expansion; concealed rivets or structural silicone deliver continuous pristine exterior reveals.',
            'install_note'        => 'Complete milling & installation technical manual (DWG elevation assemblies, Revit LOD 400 families) available on request.',
            'install_items'       => [
                [
                    'tag'   => 'FIXING // CASSETTE',
                    'title' => 'Cassette Hanging on Top-Hat Subframe',
                    'text'  => 'Routed folded cassettes fixed to 6063-T6 extruded aluminum top-hat subframes with slotted holes for thermal expansion allowance and concealed rivets — no visible fasteners on the exterior reveal.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
                [
                    'tag'   => 'JOINT // 15–20MM REVEAL',
                    'title' => 'Thermal Reveal Joint',
                    'text'  => 'Open 15–20mm shadow reveal joints finished with neutral silicone or left as open rainscreen — continuous pristine lines across large elevations with built-in thermal movement allowance.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'Coating Systems & Finish Library',
            'description' => 'PVDF Kynar 500®, Lumiflon® FEVE, nano self-cleaning and chameleon optical coatings — Konica Minolta spectrophotometer tested across each coil batch at ΔE ≤ 0.5.',
            'swatches'    => [
                ['color' => '#927B5E', 'name' => 'Champagne Bronze', 'code' => 'PVDF Kynar 500® 3-Coat', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Graphite Grey', 'code' => 'Nano Self-Cleaning PVDF', 'bespoke' => ''],
                ['color' => '#5E7A92', 'name' => 'Chameleon Pearlescent', 'code' => 'Angle-Shift FEVE', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Silver Metallic', 'code' => 'RAL 9006 // PVDF', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'Custom RAL / Anodized', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Architectural Workshop Manual // 定制选项',
            'title'       => 'Panel Fabrication & Substructure Jointing Systems',
            'description' => 'ALUMAX composite panels support rapid site routing, cassette returns, and cold roll-forming with conventional CNC or handheld grooving equipment without micro-fracturing the outer coating.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBLVEGfFy56Cu94mCiUmAu7c6vby27mniXLQw9DmoQBAODaSFMMDdhpDSCeujNi7Ww6pSVYHKuyvkRNbdB6aZbmAMOh9ftQwPHR-Vi3NVpACPgSpfyGHnfj0pC7ybfeeAo7vE7t3sf5tVdFad7lYJ5Y20eetzdSRW2pPniY485RDBrNmlYirFBovKuWocjRQrSvZEF5bLQDZ_GfAhVrfyUSCNyuXHtWpg-PSdyRsRQ',
                    'image_alt' => 'Technical schematic of CNC router bit milling 90-degree V-groove through ACP back skin and mineral core.',
                    'contain'   => '',
                    'title'     => '90° & 135° V-Groove Milling (01 // MILLING)',
                    'text'      => 'Route a V-groove on the rear face leaving 0.5–0.8mm of mineral core intact alongside the outer skin; hand-fold into crisp architectural cassettes with zero paint crazing. Feed 15–25 m/min, cutter tip R1.5–R2.0mm.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDI39xulZbQvSjuiOy3ur-o6UKfqmUvdolyDew7IdMe1lrrTh_efn3193Qew9Ap5k9dWsTd-R-9xpJarQF_urOJPg3Ksl6UgyV8DLkLsXMq_ZF4h9Lopho-8OpK1Ac1qJylCp4WTq28k49wrftP4on97RqqCar1EFY77y_rrY2iclTgRY1oJjTVEuUMpbQrGguxKGX94PMFrUSusbbQPI5b5BsTfhJHkxzdwMTLEj8',
                    'image_alt' => 'Three-roll pyramid plate bending machine shaping a 4mm aluminum composite panel into column cladding radius.',
                    'contain'   => '',
                    'title'     => 'Roll-Bending for Columns (02 // COLD BENDING)',
                    'text'      => 'Continuous architectural curves on precision 3-roller pyramid bending machines; minimum curvature R = 300mm on 4.0mm panels with polished or urethane-coated rollers.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAxNGoXm2oOXFQjumYrAVWgUlUjOk4BNooy8OzEP7M-R63QbtZXP7azNQdcUm0zSVHkbwnAVZO32ps4TeELJw3yi9V7UUazyX2mQfGErfqinccbeKR486gpC0sD8A25SQlaFFto00oT6CDZxEDW5jznaZ1IQ6Yk2rFUoT3Ng7pifc-vyFoIIAgzaUsaS9u0hI1MNrWu9tjSUMQYKyCNt7Stgs-P-12bfxoVLY7zWe0',
                    'image_alt' => 'Cross-section drawing of ACP cassette hung on extruded aluminum top-hat mullion with stainless rivets and EPDM gasket.',
                    'contain'   => '',
                    'title'     => 'Cassette Hanging & Top-Hat Subframe (03 // FIXING)',
                    'text'      => 'Routed folded cassettes fixed to 6063-T6 extruded subframes with slotted holes for thermal expansion; 15–20mm reveals with neutral silicone or open rainscreen jointing.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Landmark Commercial & Transport Deployments',
            'link_label' => 'View All 180+ Project References',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDkD14D96RfHx2yrGy5hXbrcQpsFZP2jXBlDGWdNVBRmOeNNEi4CUx0F1GgbFxyhbuIDRJTpZ3ssYnQ1m4BHF04MbWO7Qxr7P4-e_D0M39-tCmU00-i_c-SkX-Yz06gw2q8qUmc2TWKity4-xnOIR5TKR_GY9c_c_V7NJVkHDuaZUAvAnL1ASp9XaUQfVOdHdxdtOrCjQJGeG9TFgCpvmVeXk55s6VYuxoG3cZ2Lx8',
                    'image_alt' => 'Luxury commercial pavilion in Milan Design District clad in champagne gold iridescent ACP.',
                    'location'  => 'MILAN, ITALY',
                    'title'     => 'Milan Design District Pavilion',
                    'product'   => 'Chameleon pearlescent FEVE // origami cassettes',
                    'area'      => 'Area: 18,500 m²',
                    'year'      => 'Rating: EN 13501 A2',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD9MM18XY8zlquCs7BzJoCL_ZNOTm38uRIzF2cTtGjLEg-0WgFQXWoofKzfK1FrUXc0EPGvlg0HZOu_s0pIDqIUGDKyC2YmUxTK1u4WajRoEGXRLl_feD-rcVS9zxMPPON_FHBzzl1KeDVwbaxZkQ9VY15rVxpRki_znrRLkWp61iHA65vgivkcOKJxaR3xobTINGs9F7FeBVBTBm0IOX9AZ39duFmYJsnedGaZ8bM',
                    'image_alt' => 'High-rise shopping mall podium in Singapore Orchard Road with ultra-flat dark graphite ACP cladding.',
                    'location'  => 'ORCHARD ROAD, SG',
                    'title'     => 'Orchard Central Commercial Atrium',
                    'product'   => 'Nano self-cleaning PVDF // monsoon-proof',
                    'area'      => 'Area: 24,000 m²',
                    'year'      => 'Finish: Nano PVDF',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIbD3e5jXa906PuatU7ZHazG9k-paXj6LWjQDzvCC_fdiuhh3d6RsfZwTO0e0sKrFxPTpteBdWH7QW20AVkbQ2TV5xm6ARd6xPU9n0ZAMvvEPTM3fJlri5UqGqXzn4CWl6P12AbGyeTEN4-wIb1Dy3CeUuPqTmHHKBndI8oNuPgeJBFgSLETpCsahS6fUzzY2KQmtuW8jyHH-pxitACMN7f2mAFPBeU9U1DqXc_OE',
                    'image_alt' => 'High traffic train concourse and retail pavilion in Sydney with curved metallic silver ACP soffits.',
                    'location'  => 'SYDNEY, AUS',
                    'title'     => 'Metro Central Retail Interchange',
                    'product'   => '6.0mm heavy-duty 0.5mm skin // AS 1530.1',
                    'area'      => 'Area: 32,200 m²',
                    'year'      => 'Thickness: 6.0mm',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Global Tender Support // 样品盒与工程报价',
            'title'        => 'Request Engineered Swatch Box & Rapid RFQ',
            'description'  => 'Receive our comprehensive overseas architect sample kit containing 12 finish swatches (PVDF, Lumiflon FEVE, Brushed, Chameleon), cutaway mineral cores (A2 & B1), and full ASTM/EN laboratory test reports.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Submit Inquiry for Quote',
            'bullets'      => [
                ['icon' => 'flight_takeoff', 'title' => 'Express International Dispatch', 'text' => 'Complimentary 48-hour DHL/FedEx courier dispatch to design offices globally.'],
                ['icon' => 'engineering', 'title' => 'Facade Structural Calculation', 'text' => 'Wind load deflection (Pa) and substructure bracket spacing verification.'],
                ['icon' => 'verified_user', 'title' => 'Direct Mill Guarantee', 'text' => 'Factory direct export pricing with standard 20-year international warranty deeds.'],
            ],
            'products'     => [
                ['label' => 'Aluminum Composite Panels'],
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Honeycomb Panels'],
            ],
        ],
    ];
}


/* -------------------------------------------------------------------------
 * 默认值：Hexagonal Honeycomb Composite Panel（设计稿 alumax_aluminum_honeycomb_core_panels_pdp）
 * ------------------------------------------------------------------------- */

function alumax_pp_defaults_honeycomb() {
    $svg_rigidity = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 90">
  <rect class="fill-secondary stroke-none" height="58" width="34" x="30" y="14"></rect>
  <rect class="fill-surface-variant" height="11" stroke-width="1" width="34" x="120" y="61"></rect>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" text-anchor="middle" x="47" y="84">ALU-HC-5000 (20mm)</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" text-anchor="middle" x="137" y="84">Solid 3.0mm</text>
  <text class="font-label fill-secondary stroke-none" font-size="10" text-anchor="middle" x="47" y="10">EI 450 N·m²</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="9" text-anchor="middle" x="137" y="56">EI 82 N·m²</text>
  <line stroke-width="1" x1="10" x2="190" y1="72" y2="72"></line>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDOqtNmRyl2NnQHAaSJgmkGPdNNGIVgS7ulbNI8_0PeWSvM7c8OccuY738USzPsOsVOfwzswQcdWBV_4KmSIoP-hhKp97W9o3Vs9zpBvTsGUWTCfaanc5Qo6MKF3r776LErUl9Dbsfx3IL6LKnYc5ul7xJ2res_3PU-qhgWhWXuSOLsqVhY2ZSAB9LTggfw4IEuoW2CJ3lJa0Nvfat1KgBz11fVZ-heomHFFIp6zWk',
            'title'          => 'HEXAGONAL HONEYCOMB COMPOSITE PANEL',
            'subtitle'       => 'Aerospace-Grade Core. ±6.5 kPa Typhoon Class. Zero Oil-Canning Monolithic Flatness.',
            'description'    => 'Continuous roll-bonded sandwich composite engineered for extreme wind pressure, high-rise building envelopes, and monolithic visual flatness. At only 6.85 kg/m² with 19.2 cm³/m section modulus. System ref: ALU-HC-5000.',
            'primary_label'  => 'Request Specimen Kit & Project Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'TDS Spec (PDF)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'aspect_ratio', 'title' => 'MAX 2,200×6,000 MM', 'text' => 'Mega-format single-panel curtain wall skin.'],
                ['icon' => 'hexagon', 'title' => 'HEX CELL 1/4" & 3/8"', 'text' => '6.35mm / 9.5mm aerospace core geometry.'],
                ['icon' => 'local_fire_department', 'title' => 'CLASS A2 FIRE', 'text' => 'EN 13501-1 s1,d0 non-combustible core.'],
                ['icon' => 'straighten', 'title' => 'FLATNESS < 0.5 MM/M', 'text' => 'Zero oil-canning across full panel span.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA1MbVdmT_8dmFjH8F0IgVR_SQsEr3SgGwTHW3_6wd-qHzmDadsdlhi0auR4spzoTyeF8knvWDkMkcwvEqtedX_it_W0yhWw4vBlh_aEnNHYlEK_3ZBPNXMwhwSh7eh965n1PThfzPgqAivV1jBWfknonx5GoR2eYGPUwuL3To9N0QvCUO1Q6gI1Te6YaR2tWqWcoPjI0s6UWKK_Q8rfIgSxU7kBhQQV4NjDV--Vm4',
            'image_alt'   => '3D technical cross-section render of aluminum honeycomb composite panel ALU-HC-5000 with hexagonal core foil bonded between AA3003 alloy skins.',
            'video_label' => 'Core Cutaway // 3D BIM LOD-400',
            'eyebrow'     => 'Systems Architecture // 系统介绍',
            'title'       => 'What is the ALU-HC-5000 Honeycomb Composite?',
            'description' => 'Aerospace-derived hexagonal foil core is continuously roll-bonded between coil-coated aluminum skins with DuPont polyurethane hot-melt, producing an ultra-flat, ultra-light sandwich panel that outperforms solid plate on rigidity, acoustics, and fire behavior.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Facing Alloy Grade', 'text' => 'AA3003-H24 high tensile standard / AA5052-H32 marine coastal anti-corrosion.'],
                ['icon' => 'straighten', 'title' => 'Composite Thickness', 'text' => '10 / 15 / 20mm (high-rise standard) / 25 / 50mm total build-ups.'],
                ['icon' => 'hexagon', 'title' => 'Core Foil & Bonding', 'text' => '0.05–0.08mm hexagonal foil with DuPont polyurethane epoxy hot-melt bonding.'],
                ['icon' => 'format_paint', 'title' => 'Finish Palette', 'text' => 'Champagne bronze metallic PVDF, natural anodized, and full RAL+ custom matching.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our Honeycomb Composite Panels?',
            'description' => 'Certified by TÜV Rheinland, SGS, and Intertek — validated for high-amplitude wind turbulence, typhoon zones, and stringent commercial facade codes.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBo2BF3icxVlMbshDHifitpMxjCOlzGR6w8j7hMyVtPDbonJxHSFizPHZ0ad32OFyZkzVsaxXCN0UZ2b00C5hbTsmUjciyV3hYVlC416hH4Ge7i6aidRd2me1bkK7tTpwtD_fpYUyZdK-AAPszLM7XwK-6Fbtu1Sy0HirdghTdymVpIfICRjt3TB1HBa-Cs5kHUA6M31hfgBXvIrQ3GB04ItZESMHUqswMDCgrF0AU',
                    'image_alt' => 'Macro cutaway of hexagonal aluminum honeycomb core foil cell structure with adhesive fillets.',
                    'icon'      => 'balance',
                    'title'     => '500% Flexural Rigidity',
                    'text'      => 'Honeycomb sandwich achieves 500% higher flexural stiffness (EI 450 N·m²) than 3.0mm solid plate at 40% reduced structural dead load.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBNSeJfWO7rFwWACLKRAi-InedVOcLFGjfWMyrCcCovvNU_OmSSEtx1Beas8F9aUZk4t0AtDeCKKQqKK2JXKpfEhdFEQgBc4SePxCCfSGA4kvici-TmSdWczybxM2ea0uOkJh5RnyR9Xeuyk7OOF-94gcRIafa-mNotzjTCS0UP9oKL3GpI5D7EnlcF5_YfyHaESOcPYcP__uz06fLc4dcPZp0-7SUZ3vLi3j_IB58',
                    'image_alt' => 'Macro sample of champagne bronze fluorocarbon PVDF coating on aluminum honeycomb substrate.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'A2 Non-Combustible Core',
                    'text'      => 'PCS gross heat of combustion strictly below 3.0 MJ/kg with zero toxic smoke drop (d0) under EN 13501-1 / NFPA 285.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDTnLBY_Dj7dy7VZcrjZXf95_Z4RfXe6VmkJsSiiUpjESmZtaOO2G6htHEDwtxfh5kwUDkwaKDtKYvAduGvUl6-m8JNaOQGOKQs2Vatqmw1oodBOMNWEfZwCUO_E8LhOowAmDTEtjYhgnkhCgihm-KZHyJEtdaZd0xWyhOiOkA1VIOXNfNC-OukY6cHXRH4IW4dAXTkl65XeziObz56UMuLwIRxNOHKg9NACo8Zotg',
                    'image_alt' => '3D visualization of concealed structural hook-on clip engaged into vertical facade mullion.',
                    'icon'      => 'air',
                    'title'     => 'Wind Tunnel Verified 6.5 kPa',
                    'text'      => 'Coastal hurricane suction vortex simulation with zero corner peel or rivet hole fatigue over 100,000 cyclic pulses at 6,500 Pa peak.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDOqtNmRyl2NnQHAaSJgmkGPdNNGIVgS7ulbNI8_0PeWSvM7c8OccuY738USzPsOsVOfwzswQcdWBV_4KmSIoP-hhKp97W9o3Vs9zpBvTsGUWTCfaanc5Qo6MKF3r776LErUl9Dbsfx3IL6LKnYc5ul7xJ2res_3PU-qhgWhWXuSOLsqVhY2ZSAB9LTggfw4IEuoW2CJ3lJa0Nvfat1KgBz11fVZ-heomHFFIp6zWk',
                    'image_alt' => 'High-rise envelope with 2000x5000mm ultra-flat aluminum honeycomb cladding panels in champagne finish.',
                    'icon'      => 'straighten',
                    'title'     => '< 0.5mm/m Monolithic Flatness',
                    'text'      => 'Roll-bonded sandwich eliminates oil-canning across mega-format 2,200×6,000mm panels — versus >2.5mm/m deviation on solid 3mm plate.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Structural & Physical Performance Data',
            'table_title' => 'Tested per ASTM & BS EN Specifications',
            'table_ref'   => 'TÜV PASS #8921-EU',
            'rows'        => [
                ['name' => 'Flatness Deviation / 表面平整度', 'value' => '< 0.5 mm/m planar zero oil-canning ｜ EN 485-4 / ASTM B209', 'mono' => '1'],
                ['name' => 'Tensile Flatwise Bond Strength / 剥离粘结强度', 'value' => '> 2.25 MPa, core failure mode only ｜ ASTM C297 / D1781', 'mono' => '1'],
                ['name' => 'Wind Pressure Design Load / 抗风压承载力', 'value' => 'Up to +6.5 kPa / -6.5 kPa gust load ｜ ASTM E330 / BS EN 12179', 'mono' => '1'],
                ['name' => 'Fire Classification Reaction / 防火等级', 'value' => 'Class A2-s1,d0 non-combustible core ｜ EN 13501-1 / ASTM E84 / NFPA 285', 'mono' => ''],
                ['name' => 'Salt Spray Fog Resistance / 耐盐雾腐蚀', 'value' => '4,000 hours, rating 10 zero blistering ｜ ASTM B117 / AAMA 2605-13', 'mono' => ''],
                ['name' => 'Acoustic Sound Transmission / 隔声降噪', 'value' => 'Rw = 33 dB sound damping resonance ｜ ASTM E90 / ISO 717-1', 'mono' => '1'],
                ['name' => 'Thermal Linear Expansion / 热膨胀系数', 'value' => '2.4 × 10⁻⁵ / °C synchronized face & back ｜ ASTM E228', 'mono' => '1'],
                ['name' => 'Unit Weight / Section Modulus', 'value' => '6.85 kg/m² (20mm panel) ｜ W = 19.2 cm³/m', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'TDS Spec (PDF)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'folder_zip', 'label' => 'BIM & CAD LOD-400', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Rigidity vs Weight',
                    'tag'       => 'EI 450 N·M²',
                    'svg'       => $svg_rigidity,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => '500% higher flexural stiffness than 3.0mm solid plate at 40% reduced structural dead load',
                ],
                [
                    'title'     => 'Fire Curve Compliance',
                    'tag'       => '< 3.0 MJ/KG',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Total PCS gross heat of combustion tested strictly below the 3.0 MJ/kg limit, guaranteeing a non-propagating facade envelope with zero toxic smoke drop (d0).',
                ],
                [
                    'title'     => 'Dynamic Turbulence',
                    'tag'       => '6,500 PA PEAK',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Simulated under coastal hurricane suction vortex pressures with zero corner peel or rivet hole fatigue over 100,000 cyclic pulses.',
                ],
            ],
            'install_eyebrow'     => 'Installation // 安装方式',
            'install_title'       => 'Three Structural Fixing Typologies',
            'install_description' => 'Engineered for rapid site installation, thermal movement compensation, and complete moisture management. Choose the structural bracket typology best suited for your facade envelope requirement.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPE 01 // 挂接式 HIGH-RISE FAVORITE',
                    'title' => 'Concealed Hook-On Hanging Cassette',
                    'text'  => 'Extruded aluminum hook brackets with anti-vibration rubber damper pads secured to vertical curtain wall mullions — panels hang and lock progressively, individually demountable for maintenance.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAmr-lVzqPy_oyivFsGWdyicQpeKgvgsbvLZxiDasRqTVQhDRO73hztcz0pr1pI4MnJDuDL-VG1_saFjiZot28s6FQxzz36QFpMSwEKzosLyVn0XczcNT21zII7l8Q2HnGheTdFkvvPzZMH2kCbKjU58eAG-Oaqosf4flMyBirGu2gGw0KJiXUeOXp3sLgjRrdvUkaN4fCuJM4sPXxTd3UN0WrTz_5OuhzfIO4eQiE',
                    'image_alt' => 'Technical diagram of Type 01 concealed hook-on hanging cassette extruded aluminum brackets with anti-vibration rubber damper pads on vertical curtain wall mullion.',
                ],
                [
                    'tag'   => 'TYPE 02 // 开缝式 RAINSCREEN',
                    'title' => 'Open-Joint Pressure-Equalized Rainscreen',
                    'text'  => 'Continuous EPDM extruded gasket baffle with ventilated drainage cavity equalizes wind pressure and evacuates driven rain — open shadow joints with zero exposed sealant.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBTob3sYkWNu-5wetrm6wvimQK1uQzSGSyRDrNV7Y2-XGhKHl4JZGkN83xB6fDsxE--a_FQSKydiu83tPYGvEuYKF5G6RgLjJiLM24d2EI3yNXL5g2pYaPuXdT330vTdV5kvkODuAs1-ZB2M6Gtl16GfVhFgzSlLNxLH1w6FaCk5fEPLPNv5tNXJEpqd-kJQKlyT6Kzf_CEnkuhcapkO2JZGcdY3q7QA6FVBVCRKNY',
                    'image_alt' => 'Section drawing of Type 02 open-joint pressure-equalized rainscreen with continuous EPDM gasket baffle and ventilated drainage cavity.',
                ],
                [
                    'tag'   => 'TYPE 03 // 插接式 INTERLOCK',
                    'title' => 'Interlocking Tongue & Groove',
                    'text'  => 'Continuous extruded male-female perimeter profiles bonded during panel manufacturing interlock directly on site with self-aligning precision joint lines — dramatically shortening crane installation cycles.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAAGN6wcNhLZb0OZGAo_p6X9yATJnCEtaTopHPcPNOqF3IT2bW5CGIv4rN0RWnDH1TbwqDGLWbs6ILrKqGXTqHhceYl0BMeUchAjnHbEb4mHxgAtiNoX_YSjoV3kWhrrkmB9ypfNzZ6Oh_kX_GKTyEiKbQqWc-PVBjkiQS9-IjaP24GIZMQXJoZyAZvIJ0ToiTU0LgMaw7JbT23xBcT_TfFSJOAosQ_hsNynsm_gTw',
                    'image_alt' => 'Engineering cross-section of Type 03 interlocking male-female tongue and groove aluminum honeycomb cladding with concealed mechanical anchor screws.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'Architectural Finish Palette',
            'description' => '3-coat PPG Duranar® PVDF and Class I anodized finishes with 30-year coating life, tested under AAMA 2605 accelerated weathering.',
            'swatches'    => [
                ['color' => '#927B5E', 'name' => 'Champagne Bronze', 'code' => 'Duranar® Sunstorm // PVDF', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Anthracite Grey', 'code' => 'RAL 7016 // PVDF', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Natural Anodized', 'code' => 'Class I 25μm', 'bespoke' => ''],
                ['color' => '#F1F3F5', 'name' => 'Pure White', 'code' => 'RAL 9016 // PVDF', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'RAL+ / Mica / Pearlescent', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Engineering Substructure Integration // 定制选项',
            'title'       => 'Three Structural Fixing Typologies',
            'description' => 'Engineered for rapid site installation, thermal movement compensation, and complete moisture management. Choose the structural bracket typology best suited for your facade envelope requirement.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDTnLBY_Dj7dy7VZcrjZXf95_Z4RfXe6VmkJsSiiUpjESmZtaOO2G6htHEDwtxfh5kwUDkwaKDtKYvAduGvUl6-m8JNaOQGOKQs2Vatqmw1oodBOMNWEfZwCUO_E8LhOowAmDTEtjYhgnkhCgihm-KZHyJEtdaZd0xWyhOiOkA1VIOXNfNC-OukY6cHXRH4IW4dAXTkl65XeziObz56UMuLwIRxNOHKg9NACo8Zotg',
                    'image_alt' => 'Concealed structural hook-on extruded aluminum clip engaged into vertical facade mullion.',
                    'contain'   => '',
                    'title'     => 'Concealed Hook-On Cassette (TYPE 01 // 挂接式)',
                    'text'      => 'CNC-routed modular trays with factory-riveted aluminum hanging hooks engage extruded vertical runner mullions — zero visible fasteners, single-panel demountability, 12–20mm reveals, seismic drift up to 1:50.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBTob3sYkWNu-5wetrm6wvimQK1uQzSGSyRDrNV7Y2-XGhKHl4JZGkN83xB6fDsxE--a_FQSKydiu83tPYGvEuYKF5G6RgLjJiLM24d2EI3yNXL5g2pYaPuXdT330vTdV5kvkODuAs1-ZB2M6Gtl16GfVhFgzSlLNxLH1w6FaCk5fEPLPNv5tNXJEpqd-kJQKlyT6Kzf_CEnkuhcapkO2JZGcdY3q7QA6FVBVCRKNY',
                    'image_alt' => 'Section drawing of open-joint pressure-equalized rainscreen with EPDM gasket baffle and ventilated cavity.',
                    'contain'   => '',
                    'title'     => 'Open-Joint Rainscreen Baffle (TYPE 02 // 开缝雨幕)',
                    'text'      => 'Pressure-equalized back-ventilated cavity with internal EPDM silicone baffle profiles — eliminates silicone streaking for decades, continuous >50mm rear ventilation, optimal thermal bridge decoupling.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAAGN6wcNhLZb0OZGAo_p6X9yATJnCEtaTopHPcPNOqF3IT2bW5CGIv4rN0RWnDH1TbwqDGLWbs6ILrKqGXTqHhceYl0BMeUchAjnHbEb4mHxgAtiNoX_YSjoV3kWhrrkmB9ypfNzZ6Oh_kX_GKTyEiKbQqWc-PVBjkiQS9-IjaP24GIZMQXJoZyAZvIJ0ToiTU0LgMaw7JbT23xBcT_TfFSJOAosQ_hsNynsm_gTw',
                    'image_alt' => 'Cross-section detail of interlocking male-female tongue and groove honeycomb cladding system.',
                    'contain'   => '',
                    'title'     => 'Tongue & Groove Interlocking (TYPE 03 // 企口插接式)',
                    'text'      => 'Continuous extruded male-female perimeter profiles bonded during manufacturing — self-aligning precision joint line, minimal framing substructure, high acoustic insulation performance.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Built With ALU-HC-5000 Worldwide',
            'link_label' => 'Request Case Study Dossier',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAAyBVaiQ0Zuf469JZiFH3-OsYxLHuUBshdKd5GUdIE7vKbf7GaP7QdysOviiJPLQyBEQ6-S19VGtCBxRamkoq87hNWfiWD9GN3BZphTmCPPUSc3Rg4-my8ubba_cDbh5FPzlzvbh8VcH7By66dQkFjoAzs2ZcJ7-6DtltDTgz_vWVkbPgAEU4B0_4LtytLcgUWt8IyydxWEgf5Bc5llitWBZbmb9aLEtGqbGM2tig',
                    'image_alt' => 'Singapore Changi Airport Terminal envelope clad in curved metallic champagne aluminum honeycomb panels.',
                    'location'  => 'SINGAPORE, SG',
                    'title'     => 'Changi International Hub Expansion',
                    'product'   => '25mm curved panels // Duranar Sunstorm mica PVDF',
                    'area'      => 'Area: 48,000 m²',
                    'year'      => 'Tested: 5.8 kPa',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0KJjt5oWiTr761ol1a9O_YOdyx6N9cvWPpFtpsRckqFqG1Rf0tDciN0dTJvXOi5VhVTWFrNKtgWyWOkAZpIPWYiNBGjyB5xTM0cLD61r8hhSi6Rff0wL5plUU0KDZOqI_y0R6jomlVwgrnpCY6gHMje0EQv758Gcwe9keW5JBaQrxtZmk6nffq69em5e4a3mxRvDW-iNvFs3mUOALhfsUPRel1LJz0ENcYawAuT0',
                    'image_alt' => 'DIFC Dubai Financial District skyscraper with ultra-flat anthracite gray honeycomb cassette panels.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'DIFC Prime Tower & Podium',
                    'product'   => '20mm panels // 55°C ambient & sand abrasion',
                    'area'      => 'Area: 32,000 m²',
                    'year'      => 'Tested: 50-Year Life',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCNXKmsHVFoeNxRUimPs6CHDtq1F-jpgg3XJzf6aGVdxZyKoaGvDWNRzd2MzyGaBmbKZofh3f9xuTydI4WHGJpXKTrSuDPhyXXdPoAmjj3vVkdXECifUVHYvwv-WODUtprjPsIN0OBeBs4k6VON87xX4EE5bZX9LIvncsikQ8cz9xA-lAwLSsryCi-uwSgsjzdsKsygUPJJMPznnGuJ52yAMFoDM1C0eh3SxO8VfY8',
                    'image_alt' => 'Frankfurt commercial tower with monolithic silver anodized aluminum honeycomb cladding.',
                    'location'  => 'FRANKFURT, GER',
                    'title'     => 'Taunus Sky Corporate Portal',
                    'product'   => 'Natural anodized 20mm // DIN 4102 & EN 13501-1',
                    'area'      => 'Area: 19,500 m²',
                    'year'      => 'DIN 4102 Pass',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Direct Factory Technical Desk // 询价与技术咨询',
            'title'        => 'Request Project Tender Calculation & Sample Kit',
            'description'  => 'Submit your architectural schedule, elevations, or bill-of-quantities (BOQ). Our facade engineering group responds with static wind-load calculations, optimization yields, and factory-direct pricing within 24 business hours.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Transmit Engineering Tender Package',
            'bullets'      => [
                ['icon' => 'mark_email_read', 'title' => 'Free Global Express Sample Box', 'text' => '20mm cutaway honeycomb samples, PVDF fan deck swatches, and test certificates via DHL Express.'],
                ['icon' => 'architecture', 'title' => 'BIM / Shop Drawing Review', 'text' => 'Joint detailing, wind load verification, and extrusion die customization.'],
                ['icon' => 'speed', 'title' => '24-Hour Tender Response', 'text' => 'Static wind-load calculations, optimization yields, and factory-direct pricing.'],
            ],
            'products'     => [
                ['label' => 'Honeycomb Panels'],
                ['label' => 'Aluminum Composite Panels'],
                ['label' => 'Solid Aluminum Cladding'],
            ],
        ],
    ];
}


/* -------------------------------------------------------------------------
 * 默认值：Corrugated Core Aluminum Composite Panel（设计稿 alumax_corrugated_core_composite_panels_pdp）
 * ------------------------------------------------------------------------- */

function alumax_pp_defaults_corrugated() {
    $svg_wave = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 60">
  <line stroke-width="2" x1="0" x2="200" y1="12" y2="12"></line>
  <path class="stroke-secondary" d="M0 40 Q 12.5 20, 25 40 T 50 40 T 75 40 T 100 40 T 125 40 T 150 40 T 175 40 T 200 40" stroke-width="2"></path>
  <line stroke-width="2" x1="0" x2="200" y1="52" y2="52"></line>
  <line stroke-dasharray="3,2" stroke-width="1" x1="25" x2="25" y1="26" y2="40"></line>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="7" x="29" y="34">2.8mm</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="4" y="9">SKIN 0.7mm</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="140" y="9">12.5mm PITCH</text>
</svg>
SVG;

    $svg_vgroove = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 90">
  <rect class="fill-surface-variant" height="18" stroke-width="1" width="180" x="10" y="30"></rect>
  <path class="stroke-secondary" d="M90 48 L100 30 L110 48" stroke-width="2"></path>
  <path class="stroke-secondary" d="M70 30 L70 12 M130 30 L130 12 M70 12 L100 34 L130 12" stroke-width="1.5"></path>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="10" y="10">V-GROOVE 90° ROUTING</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="10" y="66">0.2 – 0.3mm CORE BASE REMAINS</text>
  <text class="font-label fill-secondary stroke-none" font-size="9" x="10" y="82">MIN BEND R = 2.0mm</text>
</svg>
SVG;

    $svg_zclip = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 90">
  <rect class="fill-surface-variant" height="50" stroke-width="1" width="70" x="15" y="20"></rect>
  <path class="stroke-secondary" d="M85 30 L105 30 L105 24 L125 24 L125 66 L105 66 L105 60 L85 60" stroke-width="2"></path>
  <rect class="fill-surface-variant" height="70" stroke-width="1" width="12" x="140" y="10"></rect>
  <circle class="fill-secondary stroke-none" cx="115" cy="45" r="3"></circle>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="15" y="12">FOLDED CASSETTE</text>
  <text class="font-label fill-secondary stroke-none" font-size="8" x="92" y="20">Z-CLIP</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="140" y="88">T/Z RUNNER</text>
</svg>
SVG;

    $svg_shadowgap = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 90">
  <rect class="fill-surface-variant" height="44" stroke-width="1" width="80" x="10" y="16"></rect>
  <rect class="fill-surface-variant" height="44" stroke-width="1" width="80" x="110" y="16"></rect>
  <path class="stroke-secondary" d="M90 20 Q95 28 90 36 Q95 44 90 52 M100 20 Q95 28 100 36 Q95 44 100 52" stroke-width="1.5"></path>
  <line stroke-dasharray="3,2" stroke-width="1" x1="95" x2="95" y1="60" y2="76"></line>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="10" y="10">15–20mm SHADOW GAP</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="10" y="86">EXPANSION ± 3.5mm / PANEL</text>
  <text class="font-label fill-secondary stroke-none" font-size="7" x="72" y="72">EPDM MULTI-FIN GASKET</text>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAIQ6MU_jPyUZhhqBnmtEtEuW0FxCAuEev8iP1grvP4EmU7-_eaSn4tN3aQJ5JbYPzHN7bRKacwdFCx7y8uAmQjsTsaQak5hoWv2arDuS38dL6dCmVry0Wn--zBMVyx0HFrsAz9pCt4_E9koqKXwdK9-PmTQ_xLAA4L8EfpanT5q_hCSP81WpWCjYGq3cpXo2i48BjyCeRaUfoVI2LO90H20IMQ52JcHxVWtmOgFLM',
            'title'          => 'CORRUGATED CORE ALUMINUM COMPOSITE PANEL',
            'subtitle'       => '100% Mono-Material Aluminum. EN 13501-1 Class A1. 60% Lighter Than Solid Plate.',
            'description'    => 'Precision roll-bonded continuous structural architectural sandwich panel featuring an engineered sinusoidal wave core made from 100% recyclable high-grade aluminum. Eliminates organic thermoplastic resins completely, delivering uncompromising EN 13501-1 Class A1 fire safety, exceptional rigidity-to-weight ratio, and flawless optical flatness. Series: ALU-CC-4000.',
            'primary_label'  => 'Request Specimen Kit & BOQ Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'TDS Spec Sheet (3.9 MB)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'local_fire_department', 'title' => 'EN 13501 A1', 'text' => 'Zero plastic core, non-flammable mono-material.'],
                ['icon' => 'scale', 'title' => '4.3 KG/M²', 'text' => '60% lighter versus 3.0mm solid plate.'],
                ['icon' => 'air', 'title' => '± 5.4 KPA WIND', 'text' => 'ASTM E330 high-rise structural tested.'],
                ['icon' => 'aspect_ratio', 'title' => '1,500 × 6,000 MM', 'text' => 'Custom roll-form envelope lengths.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAK8QNZGGNOSVBjbS3gftadZTZxzOsvhj0yc3iRw0AreeTQJaob1kMrj_NriMAlvDsDYNb39hXGrEXXarO6_hBLTv2g-yH6cQS5lQrx1qSBZVQGTLCkNCXXkGBHtB9JBG-w41qrFXqNEoPDZQsJHrycExKIbgrAz3srR0YHb5D-8Zj9Z2l0L0IUujTCNLGgxWSuczWDC_E20wFfvoV6mlgWbzyV9pdsi0taLIPndwU',
            'image_alt'   => 'Corrugated core aluminum panel cutaway showing sinusoidal wave core roll-bonded between aluminum skins.',
            'video_label' => 'Core Cross-Section // Sinusoidal Flute',
            'eyebrow'     => 'Systems Architecture // 系统介绍',
            'title'       => 'What is the ALU-CC-4000 Corrugated Core Panel?',
            'description' => 'Unlike FR-ACP with mineral-filled polyethylene, the ALU-CC-4000 eliminates organic thermoplastic resins completely. The patented 12.5mm wave-pitch sinusoidal aluminum core acts as an infinite series of structural I-beams — 100% recyclable, zero-VOC, and EPD ISO 14025 compliant for LEED v4 / BREEAM credits.',
            'features'    => [
                ['icon' => 'straighten', 'title' => 'Panel Total Thickness', 'text' => '4.0mm standard envelope / 6.0mm high wind / 8.0mm megapanel.'],
                ['icon' => 'layers', 'title' => 'Aluminum Skin Gauges', 'text' => '0.7/0.5mm standard architectural (3003-H14) / 1.0/0.8mm heavy impact (5005-H34).'],
                ['icon' => 'waves', 'title' => 'Sinusoidal Core', 'text' => '12.5mm pitch roll-bonded wave flute, 2.8mm ± 0.05mm height — a continuous series of structural I-beams.'],
                ['icon' => 'format_paint', 'title' => 'Fluorocarbon Finish', 'text' => 'PVDF 3-coat, champagne metallic, and brushed FEVE exterior finishes.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our Corrugated Core Panels?',
            'description' => 'Tested under ISO/IEC 17025 accredited international laboratories — verified for extreme positive/negative wind loads, shear deflection, and zero-ignition structural performance.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBkcM2A1HnAwPT_5zUw1XMLvv33VXbrrZVPAsYu3VddsP1NEx2j7E2lfjzfTsJ46P3MHJho2hdjXWuds9oNiLhxhBXHOxeXMNOiDqPmb2_B8ARDHyoxehaqN1G2Fh0pk2nVYvMnrTa0_fZq0iZJj9ZEfkIYgOufKqcMvfxkVpAG-Fcw3DQolZkRNhN10jPS0XXM_6dmXbvlx_JsSMH18U2XdgD3FJ0gH96_hezajms',
                    'image_alt' => 'Wave core section of corrugated aluminum composite panel.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Class A1 Zero-Ignition',
                    'text'      => '100% aluminum mono-material — zero polyethylene, zero toxic gases, no smoke (s1), no droplets (d0) under EN 13501-1 / BS 476 Part 4.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAXKUTZ8n5QxxfgPQQYmbnhEYdXXzJP4j3R68LeGkIMXv-ERbgK2RbHaTDSuS-G9zgJ_QkrrrkVx6RGigrEkzN-_mNAOf9rn9cdyMwm9DVyFSyFDv2_aj171OrXoV8B56K6TcIVav2ZkfpcQZISQSABVRxMr2uuFBFSftsfyhCQYmALkr-GCWbClVMNDKa3MNNpmHCeiIVjIzlg_DWo5-4wT05R5bBYe1QZ4m7DWok',
                    'image_alt' => 'Profile caliper measurement of corrugated core panel thickness.',
                    'icon'      => 'balance',
                    'title'     => 'Rigidity-to-Weight Champion',
                    'text'      => 'Flexural rigidity 0.245 × 10¹¹ N·mm²/m at just 4.32 kg/m² — 62% lighter than 3.0mm solid plate with equal stiffness.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBjbIfMHawUgutcryDxdKRZPI8QdKewHWWJo8KSDdvw9_NMAIqIk9nQg_vDi_Z_QbVmQXl6gT5iDqqMKt4sfcffuKQROQwv33pfwb4IUR2XVLSWgl1ZjIk_psLF1vHF_WGFJ3hwem6q5cRhmuJMaPGl_eyfsHZMk8WU5UQZEBcLRriCiXCdLAb6J6hadASdW_I38OLuB1ke_zTzOqej50t72eEVNeZBPm4LtDyvGLs',
                    'image_alt' => 'Concealed joint mounting detail of corrugated core facade panel.',
                    'icon'      => 'air',
                    'title'     => '±5.4 kPa Wind Deflection',
                    'text'      => 'ASTM E330 structural deflection pass at L/180 over 1500mm spans — no mid-stiffeners required on high-rise envelopes.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAIQ6MU_jPyUZhhqBnmtEtEuW0FxCAuEev8iP1grvP4EmU7-_eaSn4tN3aQJ5JbYPzHN7bRKacwdFCx7y8uAmQjsTsaQak5hoWv2arDuS38dL6dCmVry0Wn--zBMVyx0HFrsAz9pCt4_E9koqKXwdK9-PmTQ_xLAA4L8EfpanT5q_hCSP81WpWCjYGq3cpXo2i48BjyCeRaUfoVI2LO90H20IMQ52JcHxVWtmOgFLM',
                    'image_alt' => 'Airport terminal envelope clad with corrugated core aluminum panels.',
                    'icon'      => 'recycling',
                    'title'     => 'Circular Mono-Material',
                    'text'      => 'Zero delamination sorting at decommissioning; scraps melt directly into secondary ingot with <5% original smelting energy. >35% post-industrial content.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Mechanical Strength & Fire Physics Matrix',
            'table_title' => 'Certified Performance Matrix',
            'table_ref'   => 'SPEC REV: 2025.04.B',
            'rows'        => [
                ['name' => 'Combustibility Classification', 'value' => 'Class A1 — no smoke s1, no droplets d0 ｜ EN 13501-1 / BS 476 Pt 4', 'mono' => ''],
                ['name' => 'Areal Weight (4.0mm System)', 'value' => '4.32 kg/m² (−62% vs solid plate) ｜ ISO 1183', 'mono' => '1'],
                ['name' => 'Flexural Rigidity (E × I)', 'value' => '0.245 × 10¹¹ N·mm²/m ｜ ASTM C393 / EN 14509', 'mono' => '1'],
                ['name' => 'Shear Resistance Across Ribs', 'value' => '2.85 MPa continuous corrugation ｜ ASTM C273 / EN 12090', 'mono' => '1'],
                ['name' => 'Peel Strength (Skin to Core)', 'value' => '98.6 N·mm/mm molecular hot roll-bond ｜ ASTM D1781 climbing drum', 'mono' => '1'],
                ['name' => 'Max Wind Pressure Resistance', 'value' => '± 5.4 kPa (L/180 pass @ 1500mm span) ｜ ASTM E330', 'mono' => '1'],
                ['name' => 'Thermal Decomposition VOCs', 'value' => 'Zero toxic gases / 0% smoke release ｜ EN ISO 11925-2', 'mono' => ''],
                ['name' => 'Max Envelope Span', 'value' => '1,500 × 6,000 mm custom roll-form lengths', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'TDS Spec Sheet (3.9 MB)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'view_in_ar', 'label' => 'Revit BIM Families (LOD 400)', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Sinusoidal Geometry Principle',
                    'tag'       => 'FLUTE 2.8MM ±0.05',
                    'svg'       => $svg_wave,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'The patented 12.5mm wave-pitch core acts as an infinite series of structural I-beams, converting face loads into tensile/compressive vectors along continuous flutes',
                ],
                [
                    'title'     => 'Internal Micro-Cavity Ventilation',
                    'tag'       => '1,420 MM²/M FLOW',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Open sinusoidal channels permit linear micro-aeration along the flute orientation — prevents internal hydrostatic pressure spikes and accelerates thermal dissipation in desert climates.',
                ],
                [
                    'title'     => 'Circular Mono-Material Stream',
                    'tag'       => '> 35% RECYCLED',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => '100% aluminum composition requires zero delamination sorting during decommissioning; retired cassettes melt directly into secondary ingot stock at less than 5% original smelting energy.',
                ],
            ],
            'install_eyebrow'     => 'Installation // 安装方式',
            'install_title'       => 'Subframe Integration & Movement Joints',
            'install_description' => 'Concealed cassette fixing with engineered movement joints for large-format corrugated core envelopes.',
            'install_note'        => 'Download the complete milling & installation technical manual: DWG elevation assemblies, CNC G-code cutter geometries and Revit families (LOD 400).',
            'install_items'       => [
                [
                    'tag'   => 'DETAIL 02 // Z-CLIP',
                    'title' => 'Concealed Fastening Cassette (Z-Clip)',
                    'text'  => 'Cassette folded flanges riveted with structural corner brackets hook onto continuous vertical aluminum T- or Z-runners with stainless steel isolating washers to prevent bimetallic corrosion. Sub-framing clearance 50mm cavity minimum.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
                [
                    'tag'   => 'DETAIL 03 // MOVEMENT',
                    'title' => 'Horizontal Shadow Gap Express Joint',
                    'text'  => 'Engineered open shadow gaps (15–20mm width) with dry-joint EPDM/Neoprene multi-fin continuous weather gaskets or open-joint rainscreen baffle designs with rear weeping drainage. Expansion allowance ±3.5mm per panel.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'Coil-Coated Fluorocarbon Finishes',
            'description' => 'Continuous coil-coated PVDF and FEVE finishes with zero VOC emissions during the building lifecycle — compliant with Environmental Product Declarations (EPD ISO 14025).',
            'swatches'    => [
                ['color' => '#927B5E', 'name' => 'Champagne Metallic', 'code' => 'PVDF 3-Coat', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Brushed Silver', 'code' => 'Brushed FEVE', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Anthracite Grey', 'code' => 'RAL 7016 // PVDF', 'bespoke' => ''],
                ['color' => '#F1F3F5', 'name' => 'Pure White', 'code' => 'RAL 9016 // PVDF', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'Custom RAL // Coil-Matched', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Fabrication & Joinery Details // 节点详图',
            'title'       => 'Standard Milling Profiles & Cassette Assembly',
            'description' => 'Engineered for CNC V-groove routing using standard tungsten carbide 90° or 135° cutters. Panels fold seamlessly into rigid architectural cassettes without fracturing the outer roll-coated skin.',
            'cards'       => [
                [
                    'image'     => '',
                    'image_alt' => '',
                    'svg'       => $svg_vgroove,
                    'contain'   => '1',
                    'title'     => 'V-Groove 90° Routing & Flange Return (DETAIL 01)',
                    'text'      => 'Routed from the backside through rear skin and corrugated core; a calibrated 0.2–0.3mm core base remains undisturbed to prevent metal fatigue when cold-folding 90° returns. Minimum bend radius R = 2.0mm.',
                ],
                [
                    'image'     => '',
                    'image_alt' => '',
                    'svg'       => $svg_zclip,
                    'contain'   => '1',
                    'title'     => 'Concealed Fastening Cassette Z-Clip (DETAIL 02)',
                    'text'      => 'Cassette folded flanges riveted with structural corner brackets; panels hook onto continuous vertical aluminum T- or Z-runners with stainless isolating washers preventing bimetallic corrosion. 50mm cavity minimum.',
                ],
                [
                    'image'     => '',
                    'image_alt' => '',
                    'svg'       => $svg_shadowgap,
                    'contain'   => '1',
                    'title'     => 'Horizontal Shadow Gap Express Joint (DETAIL 03)',
                    'text'      => 'Engineered open shadow gaps (15–20mm) with dry-joint EPDM/Neoprene multi-fin continuous weather gaskets or open-joint rainscreen baffle designs with rear weeping drainage. Expansion allowance ±3.5mm per panel.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Global Completed Landmark Projects',
            'link_label' => 'Explore All Global References',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBnwZDSDmn8M_7IU1qmMXNvxy4hwmcKVL3p2UA7UlZk4JSz-0_TgDlyNHXzoIMW7vzUy9F9A6279jEWZyuqH9Ue2j2lXMnb0uyFZVqNFYVcZw744OvRhSvTlyb42jNs5FDmgmiTQ_SShI4J-LounatdAAgFeKoSVUJ8RpukQa0_vQ7zaf5IeXyh_ZhjHcb_c9QH2soAsMKtLpL-05Ab_4rct9_rr9ZV5kAEX8Nq5Qk',
                    'image_alt' => 'Doha Metro Red Line station concourse envelope.',
                    'location'  => 'DOHA, QATAR',
                    'title'     => 'Doha Metro Red Line Concourse',
                    'product'   => 'ALU-CC-4000 (6mm) // ASTM E330 4.8 kPa',
                    'area'      => 'Area: 42,500 m²',
                    'year'      => 'Year: 2022',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDDA6uHoNW1YZECIbfZrSlNPCHu9NzZs0w8jyb4NC-SjCtAaLmBuhAHZX7Gqomi_BwARg-hpFXc-HV4STLKlqlRmLvwiVFtDc1-kg0zQ89wVQLkBjG0CRu6fqraYUoQSwrXfkczatw5c5ptQi0lYun8H3U1MSomXX1F783IBXS6C7JaEJj5au8qX35GwMqvOEGydVfICS-ngy33ZrC9r4YGPv-qUe06mamx4xVLq5U',
                    'image_alt' => 'IFEMA North Exhibition Expansion in Madrid Spain.',
                    'location'  => 'MADRID, SPAIN',
                    'title'     => 'IFEMA North Exhibition Expansion',
                    'product'   => 'ALU-CC-4000 (4mm Brushed) // EN 13501 A1',
                    'area'      => 'Area: 28,000 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDV3ozKaa0dSp7tUe8PkQ521b2zYyeYQv3_9KKJ6Jzx323cnIPUworQAtFPqDID4cye3Zfn_SGVcHu-w0QyxuTVsVfhfiUF7HVBug9YCcQR-xWecellVlXILDXUsdDp_MXmcEaSbrOjsKBSbjOywPNGn7n67zn-mgWtZ27BAs6RD0rbderAp36iBdigH3yrbVRSAMk5q15QloEteXBQRH9kWkHGvHRO-xNnflQAWis',
                    'image_alt' => 'King Abdullah Financial District Station portal in Riyadh Saudi Arabia.',
                    'location'  => 'RIYADH, KSA',
                    'title'     => 'KAFD Station Portal',
                    'product'   => 'ALU-CC-4000 (6mm Champagne) // <1.2mm @75°C',
                    'area'      => 'Area: 36,800 m²',
                    'year'      => 'Year: 2024',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Direct Factory Procurement // 商务及打样',
            'title'        => 'Request Project Quotation & Specimen Kit',
            'description'  => 'Our international engineering consultation desk provides rapid structural preliminary calculations, BOQ optimization, and overnight courier sample boxes (including 4mm/6mm panel samples and color fan decks) for registered facade contractors, consultants, and architectural practices.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Submit Engineering RFQ & Request Sample Kit',
            'bullets'      => [
                ['icon' => 'timer', 'title' => '24-Hour Submittal Turnaround', 'text' => 'Technical & commercial submittal within one business day.'],
                ['icon' => 'deployed_code', 'title' => 'Specimen Box via DHL Express', 'text' => '4mm & 6mm cutaway samples, PVDF color charts, and third-party lab certificates.'],
                ['icon' => 'calculate', 'title' => 'Wind Load Optimization', 'text' => 'Complimentary structural wind load & panel thickness optimization.'],
            ],
            'products'     => [
                ['label' => 'Corrugated Core Panels'],
                ['label' => 'Aluminum Composite Panels'],
                ['label' => 'Honeycomb Panels'],
            ],
        ],
    ];
}


/* -------------------------------------------------------------------------
 * 默认值：Architectural Metal Ceiling Systems（设计稿 alumax_architectural_metal_ceiling_systems_pdp）
 * ------------------------------------------------------------------------- */

function alumax_pp_defaults_ceiling() {
    $svg_absorption = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 80">
  <line stroke-width="1" x1="20" x2="20" y1="8" y2="64"></line>
  <line stroke-width="1" x1="20" x2="190" y1="64" y2="64"></line>
  <path class="stroke-secondary" d="M20 52 C 55 18, 110 12, 185 18" stroke-width="2"></path>
  <path d="M20 60 C 60 56, 120 54, 185 57" stroke-width="1.5"></path>
  <text class="font-label fill-secondary stroke-none" font-size="8" x="60" y="14">WITH FLEECE NRC 0.85</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="90" y="52">PLAIN METAL 0.15</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="7" x="20" y="74">125Hz — 4kHz OCTAVE BAND</text>
</svg>
SVG;

    $svg_channel = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 90">
  <path class="fill-surface-variant" d="M40 20 h30 v10 h-20 v30 h20 v10 h-30 Z" stroke-width="1"></path>
  <line class="stroke-secondary" stroke-width="2" x1="70" x2="150" y1="45" y2="45"></line>
  <path class="stroke-secondary" d="M110 35 h14 v20 h-14" stroke-width="1.5"></path>
  <line stroke-dasharray="3,2" stroke-width="1" x1="30" x2="170" y1="12" y2="12"></line>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="30" y="84">C-CHANNEL @1200mm + SPRING-TEE CROSS</text>
  <text class="font-label fill-secondary stroke-none" font-size="8" x="30" y="10">SEAM REVEAL 0.0mm</text>
</svg>
SVG;

    $svg_seismic = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 90">
  <line stroke-width="2" x1="100" x2="100" y1="10" y2="70"></line>
  <line class="stroke-secondary" stroke-width="1.5" x1="100" x2="40" y1="30" y2="75"></line>
  <line class="stroke-secondary" stroke-width="1.5" x1="100" x2="160" y1="30" y2="75"></line>
  <circle class="fill-secondary stroke-none" cx="100" cy="30" r="4"></circle>
  <rect class="fill-surface-variant" height="10" stroke-width="1" width="120" x="40" y="70"></rect>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="40" y="88">4-WAY SAFETY WIRE + COMPRESSION STRUT</text>
  <text class="font-label fill-secondary stroke-none" font-size="8" x="108" y="26">2.4 kN / DROP</text>
</svg>
SVG;

    $svg_mep = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 90">
  <rect class="fill-surface-variant" height="16" stroke-width="1" width="180" x="10" y="30"></rect>
  <rect class="fill-secondary stroke-none" height="16" width="24" x="60" y="30"></rect>
  <rect class="fill-secondary stroke-none" height="16" width="10" x="120" y="30"></rect>
  <line stroke-dasharray="2,2" stroke-width="1" x1="72" x2="72" y1="46" y2="66"></line>
  <line stroke-dasharray="2,2" stroke-width="1" x1="125" x2="125" y1="46" y2="66"></line>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="10" y="20">EXTRUDED ADAPTER TRACK</text>
  <text class="font-label fill-secondary stroke-none" font-size="8" x="10" y="80">DALI DOWNLIGHT / SPRINKLER / SLOT DIFFUSER 50–150mm</text>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAV4-8kkSsJMRlCo_jUDMVF9oILKCPm9Pgeb9q6WpmvTX2nCSNyvWzaW3ACBDXAYT6DlbG25IIEWrR0yhTlsnBITXCV3rc19LxV5VleqgPE7d6Pq7nih-Z5ssohKY9PdedF7PSG2XMrpCMSa55i1fdPDhPYMA7v91NUpY0HLk2tY706OydjAAabJO_oK_-cK5d-lO4gbJgOOoURLqF-3GTlCYnnQdAhSUvvO3y7sXc',
            'title'          => 'ARCHITECTURAL METAL CEILING SYSTEMS',
            'subtitle'       => 'Acoustic Excellence. Seismic Safety. Monolithic Suspended Baffle & Tile Matrix.',
            'description'    => 'Precision-engineered modular ceiling envelopes with acoustic fleece backing, flush services integration, and seismic compliance for large-span transport terminals and premier corporate headquarters. System code: ALU-CL-6000.',
            'primary_label'  => 'Request Acoustic Calculation & Sample Kit',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Acoustic Catalog (PDF)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'hearing', 'title' => 'NRC 0.75 – 0.90', 'text' => 'ASTM C423 reverberation chamber tested.'],
                ['icon' => 'local_fire_department', 'title' => 'CLASS A / A2', 'text' => 'ASTM E84 / EN 13501 non-combustible.'],
                ['icon' => 'construction', 'title' => 'SEISMIC CAT. D – F', 'text' => 'ASTM E580 sway bracing standard.'],
                ['icon' => 'humidity_percentage', 'title' => 'RH 95% ZERO SAG', 'text' => 'Zero warp humidity resistance rating.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC4SgXjCJxvBVA_zHUS5iMKVE0jlcfE4D4XZab8wUsniFmSG1oawYBbTG3Vjvu3EMjB3YVTjjh0S-Fzo7-VgDwmB5VpUG7E7ube1RFFTDqoVlogS9t3gRp6AUPWqOT0keQWAD5TYaWE93w7K3RWccEj5j27A6aWxYu2Pht546w54OAiFG1_mSFEP9YYYKi4rRA_AmOfXR_WeBJz5b7l7-1L02kVj2_7_CPOjaOPl1k',
            'image_alt'   => '3D suspended ceiling carrier cutaway showing concealed grid and acoustic tile assembly.',
            'video_label' => '3D Suspended Ceiling Carrier Cutaway',
            'eyebrow'     => 'Systems Architecture // 系统介绍',
            'title'       => 'What is the ALU-CL-6000 Ceiling Matrix?',
            'description' => 'A fully modular suspended ceiling platform combining acoustic baffles, concealed clip-in tiles, linear planks and open-cell grilles on one precision substructure — engineered for zero-deflection spans up to 3,600mm with factory-punched cutouts for HVAC diffusers and recessed luminaires.',
            'features'    => [
                ['icon' => 'grid_4x4', 'title' => 'System Typology', 'text' => 'Acoustic baffles / concealed clip-in / linear plank strip / open-cell grille formats.'],
                ['icon' => 'grain', 'title' => 'Perforation Patterns', 'text' => 'Micro-perforated 1.8mm 20% open (NRC 0.85), diagonal 2.5mm 22% (NRC 0.80), plain reflective, parametric 3D embossed.'],
                ['icon' => 'layers', 'title' => 'Substrate & Gauge', 'text' => 'AA3003 aluminum / AA5052 marine alloy / galvanized steel in 0.8–1.5mm gauges.'],
                ['icon' => 'format_paint', 'title' => 'Finish & Colorway', 'text' => 'Matte white, bronze anodized, RAL powder coating and woodgrain sublimation.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our Metal Ceiling Systems?',
            'description' => 'Certified under ASTM C423 and ISO 354 reverberation chamber methodologies — engineered to minimize flutter echo in large-volume public spaces while satisfying seismic and fire codes.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCa_mpLRxeAat8N3NC4ybaZ8VclV7vZ21U6Ko07nnjfzDAzPvnJTaTOZckXwKrRcvur0fApWElgnbXfziIns4YAH_YaoP6BgU9d1NwWLYJUUfXmEDchOIRcHJ45KPMzazD0iAUtSIRL7TLCrA8pwavCRla_olG9eHPmsXN1kMGwyao2lZ9hKRrfbJqJyOvho23x-TYfabVBOhdkSlT_Ggfg-uloxzUngInwcUaJMvk',
                    'image_alt' => 'Soundtex acoustic fleece backing detail on micro-perforated metal ceiling panel.',
                    'icon'      => 'hearing',
                    'title'     => 'NRC 0.85 Acoustic Damping',
                    'text'      => 'Micro-perforated faces backed with Soundtex 0.2mm fleece achieve αw 0.85 (Class B) — minimizing flutter echo in large-volume transit halls.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAeP6yd5WCVOKs53-WciWKbvgX9V2ncgPyOuvn6zl6ReggG9O9YGvHKhqBJv5K1KBtluEmcjFfrrFOoHEim95MGtMChBQBcY0VMBdpG0SGPcW5h1miFVPxQvdEnEqFgf0aaUgiZ3ZKlrp9qG73Bdw6_CCEd4_-Es7qiOaD1uWACEQ24_7VD-k3Qbsqg5ihokWCyflZhcH_Y8YDKyjGEzu8wI02oO8aJZ6D-LwVXwRo',
                    'image_alt' => 'Seismic suspension rigging with diagonal safety wires and compression struts.',
                    'icon'      => 'security',
                    'title'     => 'Seismic Category D–F',
                    'text'      => 'Heavy-gauge perimeter closure clips, rigid sway struts and high-tensile safety wires rated for 1.25g horizontal lateral acceleration in active fault zones.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBd-Yi9Viu2d-r3zwjcv41Szv9iSr8D5gTkGfm-boQwMuAyQLqly5nfZ_NFujvIKLt9cyXN-d12JtcpGzHW9Gt5ZPyqULQhsM7vAy7s8bpserzH4wvCCsdmy8tERfhkkGJuvb-uyV_48Z51oMmjqCu8x6aJz2R33Sh_VEF_fdOrpZ8YDgZKZVS09GDFEgCqigohwvUfWCMczajvI0_Vk1n9FFpzDq1ZC-TQjP7jU-8',
                    'image_alt' => 'Continuous wave baffle ceiling in airport terminal.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Class A Zero Flame Spread',
                    'text'      => 'Solid aluminum substrate and non-combustible fleece — 0 FSI flame spread, 0 SDI smoke developed under ASTM E84 / EN 13501-1.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAF5ckH_UcE0qcm-Qf7WUkBfN23sY8rgGF2FDj5BTQHENAn_Z2FcinsH0b3dnU-JawkOKfsiwMX_1hkHMFNHt8Bre4DCyt3yxMSIWfHzNVPwyJPKUbkBlSCxSTmXW002JtQr93EAZl5gCywAATfLaNu2B600KFZjdmZbpYH5c8z8exYmCHGH131SZllUHTdquhn9Fi5cEJOjac-5GszQSLV-ALYPps2aZlfHXjeHOI',
                    'image_alt' => 'High-speed CNC punching facility producing micro-perforated ceiling panels.',
                    'icon'      => 'precision_manufacturing',
                    'title'     => '2,000 Hits/Min CNC Precision',
                    'text'      => 'German Trumpf punch cells produce burr-free micro-perforations down to 0.8mm at ±0.02mm pitch accuracy; robotic 45° bevel folds at 99.98% repeatability.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Engineered Sound Attenuation & Structural Safety',
            'table_title' => 'Acoustic & Seismic Performance Matrix',
            'table_ref'   => 'EN 13964 CE // REV 2025.4',
            'rows'        => [
                ['name' => 'Weighted Sound Absorption', 'value' => 'αw 0.85 Class B (with fleece) ｜ plain metal NRC 0.15 — ASTM C423 / ISO 354', 'mono' => '1'],
                ['name' => 'Human Speech NRC', 'value' => '0.85 verified (1.8mm micro-perf + Soundtex 0.2mm fleece)', 'mono' => '1'],
                ['name' => 'Air Flow Resistivity', 'value' => 'Rs ≈ 380 Pa·s/m', 'mono' => '1'],
                ['name' => 'Reaction to Fire', 'value' => '0 FSI / 0 SDI Class A ｜ ASTM E84 / EN 13501-1', 'mono' => ''],
                ['name' => 'Seismic Design Category', 'value' => 'D / E / F — 1.25g horizontal max lateral ｜ ASTM E580', 'mono' => '1'],
                ['name' => 'Light Reflectance', 'value' => 'LR-1 (> 82%) matte white finish', 'mono' => '1'],
                ['name' => 'Deflection Limit', 'value' => 'L/360 compliant over 3,600mm zero-deflection spans', 'mono' => '1'],
                ['name' => 'Humidity Resistance', 'value' => 'RH 95% zero warp rating', 'mono' => ''],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Acoustic Dossier (PDF)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'architecture', 'label' => 'LOD 400 CAD Library', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Octave Band Absorption Curve',
                    'tag'       => 'αW 0.85 CLASS B',
                    'svg'       => $svg_absorption,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Reverberation room test — 1.8mm micro-perforation + Soundtex 0.2mm fleece versus plain reflective metal (NRC 0.15)',
                ],
                [
                    'title'     => 'Seismic Resistance Design',
                    'tag'       => '2.4 KN / DROP',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => '4-way diagonal high-tensile aircraft safety wire anchoring with compression telescoping struts neutralizes vertical uplift during seismic events or high-velocity HVAC displacement.',
                ],
                [
                    'title'     => 'Flush MEP & Luminaire Trays',
                    'tag'       => '50–150MM SLOTS',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Standardized extruded aluminum adapter tracks integrate DALI-controlled linear downlights, sprinkler discharge heads, and high-throw linear slot air diffusers flush with the ceiling plane.',
                ],
            ],
            'install_eyebrow'     => 'Engineered Integration // 龙骨与机电集成',
            'install_title'       => 'Precision Substructure & Service Interfacing',
            'install_description' => 'Concealed structural suspension components engineered for zero-deflection spans up to 3,600mm, with factory-punched cutouts for continuous HVAC linear diffusers and recessed linear luminaires.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'DETAIL 01 // LOD 400 CAD',
                    'title' => 'Heavy-Duty C-Channel & Spring-Tee',
                    'text'  => '0.8mm cold-rolled galvanized steel C-channel primary runners spaced at 1,200mm intervals, interlocked with spring-tee cross profiles providing a 100% concealed, level ceiling plane. Tolerance ±0.5mm, seam reveal 0.0mm.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
                [
                    'tag'   => 'DETAIL 02 // SEISMIC BRACING',
                    'title' => 'Rigid Seismic Sway Strut & Safety Cables',
                    'text'  => '4-way diagonal high-tensile aircraft safety wire anchoring and compression telescoping struts neutralize vertical uplifting forces during high-velocity HVAC displacement or seismic events. Tensile rating 2.4 kN per drop.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
                [
                    'tag'   => 'DETAIL 03 // MEP INTERFACE',
                    'title' => 'Flush Linear MEP & Luminaire Trays',
                    'text'  => 'Standardized extruded aluminum adapter tracks allow direct mechanical integration of DALI-controlled linear downlights, sprinkler discharge heads, and high-throw linear slot air diffusers. Slot widths 50 / 75 / 100 / 150mm.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'Powder Coating & Anodized Finishes',
            'description' => 'Swiss Gema dust-free vertical coating line with multi-stage chemical pretreatment — Qualicoat Class 2 certified PVDF powders at 60–80μm, with anti-microbial silver-ion additive options.',
            'swatches'    => [
                ['color' => '#FFFFFF', 'name' => 'Matte White', 'code' => 'Powder 60–80μm // LR-1', 'bespoke' => ''],
                ['color' => '#927B5E', 'name' => 'Champagne Bronze', 'code' => 'Anodized Class I', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Silver Metallic', 'code' => 'RAL 9006 // Powder', 'bespoke' => ''],
                ['color' => '#7a5724', 'name' => 'Oak / Walnut', 'code' => 'Woodgrain Sublimation', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'Custom RAL / Anti-Microbial', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Engineered Integration // 龙骨与机电集成',
            'title'       => 'Precision Substructure & Service Interfacing',
            'description' => 'Concealed structural suspension components engineered for zero-deflection spans up to 3,600mm, with factory-punched cutouts for continuous HVAC linear diffusers and recessed linear luminaires.',
            'cards'       => [
                [
                    'image'     => '',
                    'image_alt' => '',
                    'svg'       => $svg_channel,
                    'contain'   => '1',
                    'title'     => 'Heavy-Duty C-Channel & Spring-Tee (DETAIL 01)',
                    'text'      => '0.8mm cold-rolled galvanized steel C-channel primary runners spaced at 1,200mm intervals, interlocked with spring-tee cross profiles providing a 100% concealed, level ceiling plane. Tolerance ±0.5mm, seam reveal 0.0mm.',
                ],
                [
                    'image'     => '',
                    'image_alt' => '',
                    'svg'       => $svg_seismic,
                    'contain'   => '1',
                    'title'     => 'Rigid Seismic Sway Strut & Safety Cables (DETAIL 02)',
                    'text'      => '4-way diagonal high-tensile aircraft safety wire anchoring and compression telescoping struts neutralize vertical uplifting forces during seismic events or high-velocity HVAC displacement. Tensile rating 2.4 kN per drop.',
                ],
                [
                    'image'     => '',
                    'image_alt' => '',
                    'svg'       => $svg_mep,
                    'contain'   => '1',
                    'title'     => 'Flush Linear MEP & Luminaire Trays (DETAIL 03)',
                    'text'      => 'Standardized extruded aluminum adapter tracks allow direct mechanical integration of DALI-controlled linear downlights, sprinkler discharge heads, and high-throw linear slot air diffusers. Slot widths 50 / 75 / 100 / 150mm.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Proven Performance Across Global Transit Hubs',
            'link_label' => 'Request Complete 120-Project Reference List',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDOg5Th0p6Xq0twPGmIICLYzpomJ_ZhXFO3obyrXgPJprH-hnrx5ZpawGQR8vKj_Ly7fdEjkUG4K9VyC_ap3T5rzc3lpd_1MJgV3JPS4knqMv2bB38fw2AYTiNQD1kXM5DbrXALZqRIWPQsG3GnY1CwpKIUYDKJy58N8Tm1XPNoCnF_ocgPETIYUKnOytD26YnNhF_1zKl7iQ-u6OfS5ziRienl1G6LpbMiXf5SlL0',
                    'image_alt' => 'Kuala Lumpur International Airport T2 concourse wave baffle ceiling.',
                    'location'  => 'KUALA LUMPUR, MYS',
                    'title'     => 'KLIA T2 Concourse',
                    'product'   => 'Custom 3,200mm wave baffles // black acoustic fleece',
                    'area'      => 'Area: 48,500 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBKXWj24dnS1ovBNYyGuURYVR07LH6rq01Pl1GAMn7e31iPlLT31QEQU3Wb9vM7qmZSoH-LsmfDrcBXDZUlR_hJ5j2qql1Dfkz1S2hruDuEf8bDdPZc1hRT3Grj-0Kkwyac7kvKuHNfujASuZWHbzu8n8EPh1WxV8y_Jcplurk7jEPjj7ARxjqYOsQFvuU_GAiMdZjZP_zx_T4GPpXnK-L-P_5GgKQYt3VQXc4ceWw',
                    'image_alt' => 'London Kings Cross commercial hub clip-in acoustic tile ceiling.',
                    'location'  => 'LONDON, UK',
                    'title'     => 'King\'s Cross International Commercial Hub',
                    'product'   => 'Clip-in 600×600 tiles // Class A demountable',
                    'area'      => 'Area: 32,000 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD68utNU8bkqkI_SbpSkvxAqFBz1UJFP6mxPpBrVtXPqVHXCYgLyMsd7h0bbedUbiGISc7a0V01_YIx-ulg6P276kUWrAPKnWa-aR6AJ-W7iKVxpq0WhEWdjJ6kPTRIdKcqtl7QpRcYC5cplCzx2zUDDJaKiYxHuVJMbbT2p8VlxphvNwe5VGqL2uuwEwDyqbMRYmS37KWpTdoEVwX3LGiiz0QZWQWGdqQ77TDu6-s',
                    'image_alt' => 'Hong Kong West Kowloon high speed rail station linear plank ceiling.',
                    'location'  => 'HONG KONG SAR',
                    'title'     => 'West Kowloon Express Rail Concourse',
                    'product'   => '1.5mm curved 300C heavy planks // piston-effect rated',
                    'area'      => 'Area: 54,000 m²',
                    'year'      => 'Year: 2022',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Direct Factory Consultation // 工程询价与打样',
            'title'        => 'Request Acoustic Calculation & Sample Kit Box',
            'description'  => 'Our senior architectural ceiling engineers evaluate your CAD ceiling reflection plans (RCP), calculate specific reverberation time (RT60) reductions, and ship tailored physical mock-up sample kits within 72 hours via DHL Express.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Submit Technical RFQ & Dispatch Sample Box',
            'bullets'      => [
                ['icon' => 'inventory_2', 'title' => 'Architectural Ceiling Kit', 'text' => 'Clip-in tile with micro-perf & fleece, 200mm baffle profile, RAL deck, spring-tee samples, ASTM C423 dossier.'],
                ['icon' => 'calculate', 'title' => 'RT60 Reverberation Calculations', 'text' => 'Senior engineers evaluate your CAD RCP plans for specific reverberation reduction.'],
                ['icon' => 'verified_user', 'title' => '24-Hour Technical Quote', 'text' => 'Guaranteed turnaround for overseas projects with 72-hour DHL sample dispatch.'],
            ],
            'products'     => [
                ['label' => 'Metal Ceiling Systems'],
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Aluminum Composite Panels'],
            ],
        ],
    ];
}


/* -------------------------------------------------------------------------
 * 默认值：S-Blade Sunshade Louvers（设计稿 alumax_architectural_s_blade_sunshade_louvers_pdp）
 * ------------------------------------------------------------------------- */

function alumax_pp_defaults_louver() {
    $svg_sprofile = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 80">
  <path class="stroke-secondary" d="M30 12 C 60 12, 55 34, 90 34 C 125 34, 120 56, 150 56 L 170 56" stroke-width="2.5"></path>
  <path d="M30 24 C 60 24, 55 46, 90 46 C 125 46, 120 68, 150 68 L 170 68" stroke-width="2.5"></path>
  <line stroke-dasharray="3,2" stroke-width="1" x1="14" x2="186" y1="12" y2="12"></line>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="14" y="9">WIND-DRIVEN RAIN VECTOR</text>
  <text class="font-label fill-secondary stroke-none" font-size="8" x="14" y="78">S-FLUTE WATER TRAP // 12.5 m/s ZERO INGRESS</text>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCMbVXdaRD--L7xuPgowh7zF-36tS_4B94Xemm8S9PO9BAgx6CZZRTmhtDZaK8qbpbOopl3jbx3b_ktTG73cGfSOUeRL9Ew47DOc89ZJ5uC12J8UqNTyIWgR5OX65_aXq8a8mZtIdyMSTNF6SJGeeRCEF77C58HyYFN6Qtc9xrUQKEeDUf3E519gad-9FvEcFII7bYagK-Ln3gzrEksMwkq9uhVJ_hr5v20jd5yZf0',
            'title'          => 'AERODYNAMIC S-BLADE SUNSHADE LOUVERS',
            'subtitle'       => '85% Solar Heat Dissipation. Zero Water Entrainment. Continuous Ribbon Design.',
            'description'    => 'Engineered aerodynamic S-blade & rain-defense curtain wall louver system. Seamless continuous ribbon design delivering up to 85% solar heat gain dissipation with zero water entrainment at high storm wind velocities. Spec: ALU-LB-3000.',
            'primary_label'  => 'Request Specimen Sample Kit (DHL Express)',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'AMCA Dossier (3.5MB)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'water_drop', 'title' => 'EN 13030 CLASS A', 'text' => '99.8% rain defense effectiveness.'],
                ['icon' => 'air', 'title' => '58.4% FREE AREA', 'text' => 'AMCA 500-L high-volume air delivery.'],
                ['icon' => 'storm', 'title' => '4.80 KPA WIND', 'text' => 'Class 4 structural integrity, ASTM E330.'],
                ['icon' => 'wb_sunny', 'title' => '85% GLARE CUT', 'text' => 'SHGC reduction 0.16 with low-E IGU.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCBGua-8bnA8LIbLAolK3bn5dRy2eYolCgXL0qhPe7kQF_H6hcfQ9ngGhfrG-OtrwchQwvwuD-iRvBgKUz6VRP6agUIzdYfytmPU-H_wztnqB81FlYqXGVBZcV9sonEzwzg4NJRLFWLeaZqA-Ea6YSoF2NyojB96D9Jv7Om-cExdkV3QX9stNhg8VDBvMYr-8FZD73vhgg3X6IRB-vslgTh3xPEPsUYZU0Tz-ttW7U',
            'image_alt'   => 'Extruded 6063-T6 aluminum S-blade profile cutaway showing internal drainage water-trap pocket and dual-rib stiffeners.',
            'video_label' => 'LOD 400 Parametric Blade Cut',
            'eyebrow'     => 'Architectural Solar Control // 遮阳百叶系统',
            'title'       => 'What is the ALU-LB-3000 S-Blade System?',
            'description' => 'A curtain wall transom-integrated louver platform with continuous ribbon sub-frame and 100% water penetration defense. Fully concealed fastening brackets eliminate external bolt heads while accommodating high thermal expansion in dynamic tall envelopes.',
            'features'    => [
                ['icon' => 'straighten', 'title' => 'Blade Profile Widths', 'text' => '75mm ribbon flute / 100mm S-curved / 150mm S-curved severe rain / 200mm aerofoil double-chamber.'],
                ['icon' => 'tune', 'title' => 'Angle & Actuation', 'text' => 'Fixed 30° / 45° settings or motorized BMS-linked actuation typologies.'],
                ['icon' => 'layers', 'title' => 'Substrate Alloy', 'text' => 'AA6063-T6 structural temper extrusions; AA6061-T6 high-strength for 200mm aerofoil.'],
                ['icon' => 'format_paint', 'title' => 'Finish Specification', 'text' => '3-coat PVDF 35μm (AAMA 2605, 30-year) / Class I 20μm clear & champagne anodized, ISO 7599 marine.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our S-Blade Louver System?',
            'description' => 'Tested and validated in certified climatic wind tunnel facilities under simultaneous gale-force wind vectors and simulated torrential rain.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBuzG4RTsqjBjR05024Jbc-8rQdUeUzsBaTo7fPUPYyQFkDGXuDZ6IgQ7pg00lpfe89PdcGO719vrI2_dRwflfXpJaehZJj9isH-EJlDd5mOIJoAHwcDNMBdec6ky4bXY15EZ8CmRBwWSN1xBR_Lry_3cqN3TsggmvhRT726LGharcky7GfkhRAwsvC19EUismoueUfrDgjdYWLlai-oQD4rTVw2pj_XIVRLoNIUYE',
                    'image_alt' => 'Multi-story continuous horizontal louver ribbons wrapping cantilevered glass volumes.',
                    'icon'      => 'wb_sunny',
                    'title'     => '85% Solar Glare Attenuation',
                    'text'      => 'Daylight redirection with calculated SHGC reduction of 0.16 when paired with low-E insulated glass units.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAF1HGExSzaLWVyvS_g0_jt6mYg0wt_73jFuFijw6Xn9GiulNXpAq3z1vk-b6h0A_MnC6p-d8wFoV2Z0kcW6i_IhBZdfVe1BHUqFSnh4UxkhBuvP-ASMUIKXfLmNaiYttrWWwZYXRxP9aiZ5xNxSTEYvXx3RSSkEqsuOpKaLKkIer_1dy2CG6bW5EpyxqtrGUpEA4lDlnQNMh__bM_aIJcYFpCBH6FZO8l5dqa0dy4',
                    'image_alt' => 'CNC-machined aluminum pivot brackets with concealed spring clips and vibration gaskets.',
                    'icon'      => 'water_drop',
                    'title'     => 'Zero Water Penetration',
                    'text'      => 'Complete defense against wind-driven rain up to 12.5 m/s storm velocity — EN 13030 Class A, 99.8% effectiveness, 0.00 oz/ft² entrainment.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRL723pKJ1qkEBsCzU6vq1W3vpA0w3k-jYX819ut8q1jt-VTv69ORphO17ZK_Mg0q2OWfbFIFHUO4fdeGPvP-buRmPQPTcRb8EhSyOtnea-H5Ry-0QTuM8ASseYBRmPjflA3d9kdcW3OJJEYv3lRQqNzwb_EvsxzdDS2p9XHB9KbmfG-ay6fKNBjUgNvd1XWxEeNKMcRsEUkR0wwVYq0MqJloPVHd-TA1AIclFaDE',
                    'image_alt' => 'PVDF coated aluminum louver swatches in champagne bronze, anodized slate and metallic graphite.',
                    'icon'      => 'format_paint',
                    'title'     => '30-Year Fluoropolymer Life',
                    'text'      => 'GEMA electrostatic turbo-bell applied PPG / AkzoNobel 3-coat PVDF cured at 240°C — AAMA 2605 certified.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCUtqAndLECTaIMh9fl0hZoVdsa-pevm9iRSsUatzLjgIa1GFV8pnrYmE174SJH3Rr9LNN4LD2jQrHLG2Qh3Qqobgn9UAVWP7_raYByMvyhel6AK7FOMDzniyzamCb1rLtjrXo0VqTyKPsN8fBylrjyaQLye8yGQKgh4IcLotXhjsjiTxkACHSNFGGawwFhIH4Drk8wXMIDFoND-hCJREr0L3oJDBhxlpWo3YoLogk',
                    'image_alt' => 'Dubai medical tower with dual-toned bronze motorized sunshade louvers in desert sun.',
                    'icon'      => 'storm',
                    'title'     => '4.80 kPa Hurricane Rated',
                    'text'      => 'Extreme positive/negative cyclic pressure tested; blade span deflection strictly within L/180 — ASTM E330 Class 4.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Technical Parameters by Blade Geometry',
            'table_title' => 'Specification Schedule',
            'table_ref'   => 'AMCA 500-L // EN 13030',
            'rows'        => [
                ['name' => 'Blade Depth / Chord', 'value' => 'S100: 100mm ｜ S150: 150mm ｜ A200: 200mm', 'mono' => '1'],
                ['name' => 'Wall Thickness (Nominal)', 'value' => '1.8mm ｜ 2.2–2.8mm ｜ 3.0mm reinforced (ASTM B221 / EN 755)', 'mono' => '1'],
                ['name' => 'Standard Blade Pitch', 'value' => '85mm c/c ｜ 125mm c/c ｜ 160mm c/c', 'mono' => '1'],
                ['name' => 'Free Area Ventilation', 'value' => '52.1% ｜ 58.4% ｜ 61.0% (AMCA 500-L Figure 5.4)', 'mono' => '1'],
                ['name' => 'Water Penetration Point', 'value' => '8.5 m/s limit ｜ 12.5 m/s zero ingress ｜ 11.0 m/s zero (EN 13030 Class A)', 'mono' => '1'],
                ['name' => 'Max Clear Mullion Span', 'value' => '1,800mm ｜ 2,400mm ｜ 3,200mm @ 2.4 kPa wind pressure', 'mono' => '1'],
                ['name' => 'Alloy Chemistry', 'value' => 'AA6063-T5 ｜ AA6063-T6 structural ｜ AA6061-T6 high-strength', 'mono' => ''],
                ['name' => 'Acoustic Isolation', 'value' => 'Rw 18 dB transmission loss (acoustic-lined options to 22 dB)', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'AMCA Dossier (3.5MB)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'deployed_code', 'label' => 'Revit LOD 400 (RFA)', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'S-Flute Rain Defense',
                    'tag'       => 'EN 13030 CLASS A',
                    'svg'       => $svg_sprofile,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Internal blade troughs trap wind-driven droplets — zero penetration up to 12.5 m/s storm velocity',
                ],
                [
                    'title'     => 'Free Area Ratio',
                    'tag'       => 'CD = 0.32',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Optimized curved entry geometry limits pressure loss coefficient, reducing HVAC plantroom mechanical intake load. Core velocity 1.0 m/s, 3.5 m/s max.',
                ],
                [
                    'title'     => 'Solar Glare Attenuation',
                    'tag'       => '85% SHGC CUT',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Calculated solar heat gain coefficient reduction of 0.16 paired with low-E insulated glass — precision daylight redirection without darkening interiors.',
                ],
            ],
            'install_eyebrow'     => 'Architectural Details // 安装方式',
            'install_title'       => 'Subframe Typologies & Engineered Mounting Assemblies',
            'install_description' => 'Constructed with fully concealed fastening brackets to eliminate external bolt heads while accommodating high thermal expansion in dynamic tall envelopes.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPOLOGY 01 // SNAP-ON',
                    'title' => 'Snap-On Anti-Vibration Clip',
                    'text'  => 'Interlocking extruded clip with neoprene bushing securely locks the louver blade onto vertical aluminum mullions for rapid field erection. Thermal expansion gap ±4.0mm, installation 3.2 min/m², wind flutter noise < 25 dBA.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
                [
                    'tag'   => 'TYPOLOGY 02 // STRINGER',
                    'title' => 'Continuous Hidden Stringer Box',
                    'text'  => 'Concealed rear spine enables unbroken horizontal ribbon lines spanning hundreds of meters across airport and podium facades without visible break lines. Max unsupported span 2,400mm, rear deflection anchor 6061-T6 lug.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
                [
                    'tag'   => 'TYPOLOGY 03 // DRAINAGE',
                    'title' => 'Integrated Drainage Gutter Sill',
                    'text'  => 'Engineered for plantroom intakes: internal blade troughs collect driven water droplets and route them through enclosed side jamb conduits into the drainage weeping tray. Runoff discharge 45 L/min per bay, 18mm S-lip trap, EPDM dual-lip sump gasket.',
                    'svg'   => '', 'image' => '', 'image_alt' => '',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'PVDF & Marine Anodized Finishes',
            'description' => 'GEMA electrostatic turbo-bell application of PPG / AkzoNobel fluorocarbon resin cured in continuous convection ovens up to 240°C; ISO 7599 marine-grade anodizing available.',
            'swatches'    => [
                ['color' => '#927B5E', 'name' => 'Champagne Bronze', 'code' => '3-Coat PVDF 35μm', 'bespoke' => ''],
                ['color' => '#3E4C59', 'name' => 'Dark Slate', 'code' => 'Class I Anodized 20μm', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Metallic Graphite', 'code' => 'PVDF 3-Coat', 'bespoke' => ''],
                ['color' => '#C8CCD2', 'name' => 'Clear Anodized', 'code' => 'Class I 20μm // ISO 7599', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'Custom RAL Color Chip', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Architectural Details // 节点构造',
            'title'       => 'Subframe Typologies & Mounting Assemblies',
            'description' => 'Constructed with fully concealed fastening brackets to eliminate external bolt heads while accommodating high thermal expansion in dynamic tall envelopes.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA2vLqDgq6tsbZWGhgOc7Pu9uv_zs8AQXy5gWO8TcyrfJXrabqTrldsHCZ8INS9SBDcGp7pnhi0GKsJYT1tYH0wDW17Ur9XdSE5H92CVd2Q1VFPI_7bCp7ZsyrdZTHAWw8B0aNE2eCX7KmyAhL7jND2QkCFYikBBYrLk3L4g8b9PV6-wMnnsABvYLZdAopRJaFJ8KAGphhRn-C0b5haoEUKpBUmAhjH9qkrZr6olNQ',
                    'image_alt' => 'Snap-on louver bracket clip assembly with dual anti-vibration neoprene isolation pads.',
                    'contain'   => '1',
                    'title'     => 'Snap-On Anti-Vibration Clip (TYPOLOGY 01)',
                    'text'      => 'Interlocking extruded clip + neoprene bushing locks blades onto vertical mullions with vibration isolation — thermal gap ±4.0mm, 3.2 min/m² install, <25 dBA wind flutter hum.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB6Ovgpo2Gxiv4QfyKlGk2knLwrDVYkS081yBQBK0eoU2D7zDwBPEdhtf5AdqPgURkNMc6eMvw_sY-txXNfJHllbC4qlL68xiWTW6P1pdV76tKU3-cVD4EN7q5lOC7UE03cpQbU8-luT1DNsxveZSHaZPFrW9ZoaCtYwgShehAXteBuAAGLxmCjrQMWH3RxOffXvAYF6g6bHBqeZmy2t0WpwjWy0-RFEcyUFWZRt1Q',
                    'image_alt' => 'Continuous hidden aluminum stringer box channel for unbroken horizontal louver ribbons.',
                    'contain'   => '1',
                    'title'     => 'Continuous Hidden Stringer Box (TYPOLOGY 02)',
                    'text'      => 'Concealed rear spine enables unbroken horizontal ribbon lines spanning hundreds of meters — 100% clear visual horizon, max unsupported span 2,400mm, 6061-T6 rear deflection anchor lug.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCYKpaLsvy6rTAi4MRE4P-cXSo4nj9RukXoWX2QjKmbaY5-5ACUwht5mXv7Smwfa8fQf8m5TnvE8rDw93YgRfv7p93Fvsl4hvIs1PimySbfKWS-BD2vST6_c9MRrHdYP6oRtklguLQvQ3fwypeWj9mtQmQrPkqJ5wg7-SJzYi-71NgpP-hL8xqaDRrPWOkkfgIdn4V0LPP639kjSyudKZRHsv7DLLIfYtLkBjt-IEA',
                    'image_alt' => 'Integrated water management perimeter with drainage gutter channel and concealed sill weep holes.',
                    'contain'   => '1',
                    'title'     => 'Integrated Drainage Gutter Sill (TYPOLOGY 03)',
                    'text'      => 'Internal blade troughs collect driven droplets routed through enclosed jamb conduits into the weeping tray — 45 L/min per bay discharge, 18mm S-lip trap, EPDM dual-lip sump gasket.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Landmark Installations & Infrastructure Projects',
            'link_label' => 'View Complete 120+ Reference Dossier',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCga9hSd9VVuQ4ZynxyACrYqsSywwj8i7mFrYOMcmNpFLqQGWh8MBM4M1PTdxMQvgz8mo34OBab4Lq7bSAD-MuFd8trDhcis2IkHTXv0VVE9Z2j1U7AW-d3RbBUYnVDU874VWrcdkKrPS3LZprB8S1lSDmMbkk5dtwYSgAN0g6BaBkHf6UeiuxBshWF3ewIqL1KbF2LC8pMXGeFUX0QkjXfQ4XIl-5qGfxmkVJOHws',
                    'image_alt' => 'Frankfurt Airport Cargo Logistics Terminal with continuous champagne anodized louvers.',
                    'location'  => 'FRANKFURT, GER',
                    'title'     => 'Frankfurt Airport Airside Cargo Central',
                    'product'   => 'S150 horizontal // AMCA Class A water defense',
                    'area'      => 'Area: 14,500 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCUtqAndLECTaIMh9fl0hZoVdsa-pevm9iRSsUatzLjgIa1GFV8pnrYmE174SJH3Rr9LNN4LD2jQrHLG2Qh3Qqobgn9UAVWP7_raYByMvyhel6AK7FOMDzniyzamCb1rLtjrXo0VqTyKPsN8fBylrjyaQLye8yGQKgh4IcLotXhjsjiTxkACHSNFGGawwFhIH4Drk8wXMIDFoND-hCJREr0L3oJDBhxlpWo3YoLogk',
                    'image_alt' => 'Dubai Healthcare City medical tower with motorized bronze sunshade louvers.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'Dubai Healthcare City Tower 04',
                    'product'   => '200mm aerofoil motorized // BMS IoT linked',
                    'area'      => 'Area: 8,200 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAafU2DeoZJ55fkZ3cJ6n0WLXUDpQIEjDK5TgSIoxGjCMOGYNWIfyyVTxpyc6z4elLOaD93kOm_F8dy2rJwhfrhgMPpGAEFrpzOiGKKb7TettOkdQzCcKxQhTIDYG5n-DHvN3Lljx7S5rCqPL_6SRbwj9gaZ-oz9_y8VdcrvyPKjsQgDcIEgYqAxCloyez09EO6lZBG54S5qUwACf84sYsNQYYAAwsvSrKpSp959mk',
                    'image_alt' => 'Tokyo Metro substation with graphite gray vertical acoustic louver screen facade.',
                    'location'  => 'TOKYO, JPN',
                    'title'     => 'Tokyo Metro Central Traction Substation',
                    'product'   => 'S100 acoustic-lined // 60Hz transformer hum damping',
                    'area'      => 'Rating: Rw 22 dB Net',
                    'year'      => 'Year: 2023',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Engineering Utility // 气流计算与设计校验',
            'title'        => 'Fast Tender RFQ & Specimen Kit Order',
            'description'  => 'Have complex BIM schedules, unusual curved spans, or structural wind pressures exceeding 5.0 kPa? Our senior structural facade engineers respond within 6 business hours with complete calculations and wind deflection reports.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '48H DHL SAMPLE DISPATCH',
            'submit_label' => 'Submit Engineering RFQ',
            'bullets'      => [
                ['icon' => 'calculate', 'title' => 'Airflow & Area Calculator', 'text' => 'Required free-area and static pressure drop computed from your HVAC volumetric flow rate.'],
                ['icon' => 'air', 'title' => 'Wind Deflection Reports', 'text' => 'Structural calculations for spans and pressures exceeding 5.0 kPa within 6 business hours.'],
                ['icon' => 'inventory_2', 'title' => 'DHL Express Sample Kit', 'text' => 'Anodized and PVDF S-blade sections with comprehensive testing certificates, shipped in 48h.'],
            ],
            'products'     => [
                ['label' => 'S-Blade Sunshade Louvers'],
                ['label' => 'Metal Ceiling Systems'],
                ['label' => 'Solid Aluminum Cladding'],
            ],
        ],
    ];
}


/* -------------------------------------------------------------------------
 * 默认值：Laser-Cut & Welded Architectural Screens（设计稿 alumax_architectural_aluminum_grilles_screens_pdp）
 * ------------------------------------------------------------------------- */

function alumax_pp_defaults_grilles() {
    $svg_solar = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 80">
  <line stroke-width="1" x1="20" x2="20" y1="8" y2="64"></line>
  <line stroke-width="1" x1="20" x2="190" y1="64" y2="64"></line>
  <path d="M20 24 C 70 20, 130 16, 185 14" stroke-width="1.5" stroke-dasharray="4,2"></path>
  <path class="stroke-secondary" d="M20 44 C 70 40, 130 34, 185 30" stroke-width="2"></path>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="8" x="120" y="12">UNSHADED 0.78</text>
  <text class="font-label fill-secondary stroke-none" font-size="8" x="110" y="44">ALU-GR-2000 0.24</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="7" x="20" y="74">SOLAR INCIDENCE ANGLE vs SHGC TRANSMITTANCE</text>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUlT2PHMseWAPCpQM9Dx_Oy0Jf2prquHIwBMeo8w_WEyhWSkMQCksiqSzRerBW0WSuuACHPHKGfzxwZnLNWFTTFNJEjwZGwkIh5IKSnhivNRhLeSYS50zg53hy8qy4GSRr30dAcMEfNBNNkzHnd02UwbkgNYqfRTlp8NfFHYnoU4iVfnTfFF3EOUFQ23eneNhB8igvBxEjHli_s0gREifKnet_y4tUklYV7GKN3EU',
            'title'          => 'LASER-CUT & WELDED ARCHITECTURAL SCREENS',
            'subtitle'       => 'Parametric Mashrabiya Tessellation. −48.4% Peak Cooling Load. Monolithic TIG Fusion.',
            'description'    => 'Engineered solar interceptor matrix combining custom CNC multi-axis laser carving, seamless TIG seam fusion, and ASTM B117 salt-spray resistant Class I architectural finishes. Spec ID: ALU-GR-2000 // CSI 07 42 13.',
            'primary_label'  => 'Request Custom Mock-Up & Project Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Catalog (PDF 12MB)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'grain', 'title' => 'POROSITY 15–65%', 'text' => 'Aperture-calibrated open area matrix.'],
                ['icon' => 'precision_manufacturing', 'title' => 'CNC ± 0.20 MM', 'text' => 'Laser orthogonal cutting tolerance.'],
                ['icon' => 'air', 'title' => '4.5 KPA WIND', 'text' => 'ASTM E330 certified resistance.'],
                ['icon' => 'verified', 'title' => '25 YEARS WARRANTY', 'text' => 'PVDF / anodized exterior finishes.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBQ60jGN5-PVnF4toNeRukylj4mTqwGDCmgONctDLk5IA5dTdPnSAFdqhfTRPYYlWQUcRlbvFkGICW4Mo8GnNloumm6nJp-bJ4Jj7Ug2TeQG8UM99R3xjVZgd1iwhR5EjxZSe2SftgrfsVTg3J1IsSEF736RAN7tnuPTKFb2qQXPBl-Nx8E3gnrHUA_7Ji6ZtKKSGNxSQGRs9DbY7CayR88UfFoX9Upq4p9InaESBA',
            'image_alt'   => 'Macro close-up of 4mm aluminum screen with laser cut clean edge and robotic seamless fillet TIG welds in champagne bronze.',
            'video_label' => '3D Geometry Verified // CNC Edge Detail',
            'eyebrow'     => 'Parametric Tessellation Envelope // 铝艺镂空窗花',
            'title'       => 'What is the ALU-GR-2000 Screen System?',
            'description' => 'Unlike static planar louvers, the ALU-GR-2000 multi-layer Mashrabiya acts as an active visual barrier and passive thermal shield. During zenith solar noon (75°+), 4mm-depth structural ribs block 88% of thermal infrared irradiance while maintaining uninterrupted outward sightlines.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Structural Alloy Matrix', 'text' => 'AA5052-H32 marine high-yield / AA6063-T6 extruded chassis / AA3003-H14 standard sheet.'],
                ['icon' => 'straighten', 'title' => 'Plate Thickness Gauge', 'text' => '2.5 / 3.0 / 4.0mm (high-rise recommended) / 5.0 / 6.0mm.'],
                ['icon' => 'format_paint', 'title' => 'Coating & Finish', 'text' => '25μm Class I anodized / 70% Kynar 500 PVDF 3-coat / Qualicoat Class 2 polyester / timber sublimation.'],
                ['icon' => 'grain', 'title' => 'Pattern Typology', 'text' => 'Islamic octagram Mashrabiya, parametric sine wave, organic hex density, custom architectural CAD.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'Why Choose Our Architectural Screens?',
            'description' => 'Computational microclimate engineering validation based on ASHRAE 90.1, EN 1991-1-4 boundary wind tunnel models, and solar radiation ray-tracing simulations.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAAYPKcIrJqC2vRMVpvMg1zsRrl50KvU2gv1WtcwlF_oaI7sxZQBrhHfiBbnZagC9Gl4sEdzVrDYegcWrFLi8OKoXKCiGHCHuiy6WS7jZHHt23zAS0gmIEus-cmboKFKNL_Wzf_iKl6UTSwqTb8T5xZ6ehj2o7pYyfQ_ynRMF0QGT2OQlydy_5bU_gLJUWE1bKr7t2vat8B24DavCiumXR0Bi0kFtbH-slOxloKIRM',
                    'image_alt' => 'Double-skin facade installation with dynamic shadows cast over low-e glazing.',
                    'icon'      => 'wb_sunny',
                    'title'     => '−48.4% Cooling Load',
                    'text'      => 'Peak cooling load reduction across SW elevations under 45° solar incidence — SHGC from 0.78 unshaded to 0.24 with ALU-GR-2000.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBivS5rQRHhY4gNG3JiDlKavxHS0zsHWLY5jeRIcM-6pnFPo7AUM9COdavwdW0nYO205g5NRW3_mxzqqRDTcftSgLbVEc3dN0KpGXnzcdpb14AWMZbl9skEG3YAiaSUzsTBCkpoNTNaXV1kMPJCz6wCMH1OxATLkaThn_i0N4mZePd-q1WWPOcFFuJS49ggfXJ2kvfHeTmHCIfBtyGkDZGIc0iWPT0OP-loFEyAptU',
                    'image_alt' => 'Material swatches of architectural anodized champagne bronze and wood-grain thermal sublimation.',
                    'icon'      => 'light_mode',
                    'title'     => '82.3% Daylight Uniformity',
                    'text'      => 'Useful Daylight Illuminance (UDI 300–3000 lux) with DGP < 0.28 imperceptible direct glare cutoff.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB1-exU3yXkdAahu68aGHCplBO3wOhzEcpwqsb1ZUyggwEtDI9Y8NCsIueVjOSgKvGXg5qBeE3Uuhp9HUEoKu8uEFv46l8H3HmWovouGwRsTNV6wPvetkL6UlLJF9fcHdALhPnmaI94rSoF0B3m3Y_Z5z7JtyY-mRNLoDrAFZ7JfWVJdME-C6EAwD4zYwDSaIYKzJ93qsoKKVk9EA-fsAJJiOU2qBh87Y0sSPTR1D0',
                    'image_alt' => '15kW fiber laser cutting complex Mashrabiya patterns into 4mm aluminum plate.',
                    'icon'      => 'precision_manufacturing',
                    'title'     => '15kW Fiber Laser Precision',
                    'text'      => 'Swiss Bystronic CNC fiber lasers carve burr-free chamfer contours; post-perforation thermal annealing guarantees 1.0mm flatness per 3,000mm.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCN8Wb1voVb1vgWla3rmoHl3YVNg1ydb8mzf0c1OrNirzN7ix8u_7zhWqOk03tP4W5cpwC1DUSgz8UrSIjcotNRPLoYBYHj7b-OgPylOhQDrB5xjSmb5LbvR6jbLuk1l2Tx0ZDaHbVd2o83p_NCXo6O2YnZwLHTsvoMV9B2vxfq8ZEY9qK6cNZ_apZp_4u2-oaZuf28kByTUKk6nC2mYWpchdDOGYqoiGsj8w9WbLk',
                    'image_alt' => 'Master metalworker performing seamless micro-grinding on welded decorative aluminum facade cassette.',
                    'icon'      => 'handyman',
                    'title'     => 'Seamless Robotic TIG Fusion',
                    'text'      => 'Multi-axis robotic TIG seam welding with four-stage metallurgical grain blending forms monolithic rigid spatial volumes without visible fastening seams.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Adaptive Environmental Envelope Performance',
            'table_title' => 'Thermodynamic & Structural Simulation Matrix',
            'table_ref'   => 'SPEC-ALU-GR2000-REV4',
            'rows'        => [
                ['name' => 'SHGC Heat Load Intercept', 'value' => '−48.4% peak cooling (0.78 → 0.24) ｜ ASHRAE 90.1 ray-tracing', 'mono' => '1'],
                ['name' => 'Dynamic Pressure Resistance', 'value' => '4,500 Pa, deflection < L/175 @ 180 km/h gust ｜ ASCE 7-16 / EN 12211', 'mono' => '1'],
                ['name' => 'Open Porosity Range', 'value' => '15% – 65% aperture calibrated', 'mono' => '1'],
                ['name' => 'Diffuse Lux Uniformity', 'value' => '82.3% UDI 300–3000 lux ｜ DGP < 0.28 glare cutoff', 'mono' => '1'],
                ['name' => 'Aero-Acoustic Attenuation', 'value' => 'Rw 12 dB wind-whistling cut-off ｜ ISO 10140', 'mono' => '1'],
                ['name' => 'Reaction to Fire', 'value' => 'Class A1 / A2 ｜ EN 13501-1', 'mono' => ''],
                ['name' => 'Wind Resistance', 'value' => 'Up to 4.5 kPa ｜ ASTM E330 certified', 'mono' => '1'],
                ['name' => 'CNC Tolerance', 'value' => '± 0.20mm laser orthogonal ｜ DIN ISO 2768-m', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Catalog (PDF 12MB)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'deployed_code', 'label' => 'BIM & CAD (.DWG)', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Solar Incidence vs Transmittance',
                    'tag'       => 'RAY-TRACE SIM',
                    'svg'       => $svg_solar,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'At zenith solar noon (75°+), 4mm structural ribs block 88% of thermal infrared irradiance while maintaining outward sightlines',
                ],
                [
                    'title'     => 'Resonance Damping',
                    'tag'       => 'AEROELASTIC TUNED',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Turbulent boundary flow disruption reduces wind whistling through open porosity apertures — whistling cut-off tested to ISO 10140.',
                ],
                [
                    'title'     => 'Thermal Travel Isolation',
                    'tag'       => 'ΔT 60°C +6.5MM',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Neoprene-isolated sliders and dielectric PTFE shims absorb thermal expansion across high-humidity coastal and marine envelopes.',
                ],
            ],
            'install_eyebrow'     => 'Structural Interface // 安装方式',
            'install_title'       => 'Concealed Subframe & Fixing Details',
            'install_description' => 'Precision-engineered extruded aluminum mounting cleats allow three-axis site adjustment (X, Y, Z ±15mm) while mitigating thermal expansion stresses through neoprene-isolated sliders.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPE-CFB-01',
                    'title' => 'Concealed Floating Bracket',
                    'text'  => 'Interlocking male-female 6063-T6 cleat mechanism fastened into curtain wall transoms or slab edge brackets via M10 A4-80 stainless anchors — 1.8 kN per cleat dead load, ±15mm 3-axis site adjustment.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBmYIv-hIshcD5fa7D-We-ubQg3QZJ4ffty6l2zxcIv34vFgefjyW9PnadCeaxtWndNtE7eqsmCO1NKfrva2Tn5AonRRNA-GMTRuVfLGIRJTZPKL3UWpsoVh8UknkxuDZcwi8xRRc9M35qEMqeNXPFxR7GFD_lfGFUg5zaE0s8IEa-2nHZQ1nVFu05DsTe1kPlKtfe6r5I1cJN_sxZ3ImJod8AGXajFV7ABu_CZXxU',
                    'image_alt' => 'Concealed floating bracket fixing onto vertical curtain wall mullion with stainless bolts and aluminum cleats.',
                ],
                [
                    'tag'   => 'TYPE-HMF-02',
                    'title' => 'Hinged Sub-Frame for BMU Access',
                    'text'  => 'Screen panels swing 95° inward or outward on internal stainless pivot hinges for glazing washing and BMU cradle access — 10,000 operational cycles, dual aircraft wire safety lanyard.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAqS9s0FVuhwO82wL0pAfJ_oRYeKaV4NmcfNoLM3bMLHckys54SETeUy2cmlnyYfWAtEtfa7KmHffdn7RPAfiaOKp-x3qA-fe0iFTPPutGZa4Mxtc8hc6QRDPehxqwSBQ51c8CpAGqIvmNQZPkArnFbSRPpVNYI2ejEP5OLbiZZJN_FBv8F7nQI7bYTQ3tr7hCBfZDGcayP4ypht4VJ9PhaCVWRJlqosiTU-16RVnI',
                    'image_alt' => 'Heavy duty concealed pivot hinge and quick-release latch on aluminum screen frame.',
                ],
                [
                    'tag'   => 'TYPE-TEI-03',
                    'title' => 'Thermal Bushing & Isolators',
                    'text'  => 'Dielectric PTFE shims and EPDM rubber collars isolate aluminum frames from carbon steel brackets, eliminating galvanic reaction in high-salinity marine environments — ΔT 60°C (+6.5mm) travel, ASTM D149 tested.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBZ1ZV5iUkm9yOCSiYhlmt2vTFAI1xhDqzoFC2ZtJg8Lr-T3BQq6_e9igEwvyY0Y6MWtCNAhS9q8OgEsdKTMhs8d65I_YhIKpdSOMYtYKKteDn1zob7Wm2aCVEcEzzuTP6_TiIxcIVxtxL1QE2FcZjq1OBt0-1plUUdywHVrLjV1wnfwyZEQsJssymJG3e37YQQs6ywM1XIHIPu8wv-LUrdyCKmBIYeM0iACehwnY0',
                    'image_alt' => 'EPDM thermal expansion isolator bushing and PTFE slide plates between aluminum bracket and steel frame.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'Class I Architectural Finish Library',
            'description' => 'ASTM B117 salt-spray resistant Class I architectural finishes with 25-year exterior warranty — anodized, PVDF liquid, superdurable powder, and timber sublimation.',
            'swatches'    => [
                ['color' => '#927B5E', 'name' => 'Champagne Bronze', 'code' => '25μm Class I Anodized', 'bespoke' => ''],
                ['color' => '#7a5724', 'name' => 'Natural Timber', 'code' => 'Thermal Sublimation', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Graphite Metallic', 'code' => 'Kynar 500 PVDF 3-Coat', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Silver Satin', 'code' => 'Qualicoat Class 2 Powder', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'Custom RAL / Etched', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Pattern Library // 产品细节',
            'title'       => 'Perforation Patterns & Panel Geometry',
            'description' => 'Aperture-calibrated open area matrix from 15% to 65%. Standard parametric families below, or fully bespoke patterns machined from your CAD vector files (.DWG / .DXF / .AI).',
            'cards'       => [
                [
                    'image' => '', 'image_alt' => '', 'contain' => '1',
                    'svg'   => '<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.2" viewBox="0 0 200 110"><polygon points="21,16 49,16 49,44 21,44"></polygon><polygon points="35,12 53,30 35,48 17,30"></polygon><polygon points="86,16 114,16 114,44 86,44"></polygon><polygon points="100,12 118,30 100,48 82,30"></polygon><polygon points="151,16 179,16 179,44 151,44"></polygon><polygon points="165,12 183,30 165,48 147,30"></polygon><polygon class="stroke-secondary" points="21,62 49,62 49,90 21,90"></polygon><polygon class="stroke-secondary" points="35,58 53,76 35,94 17,76"></polygon><polygon points="86,62 114,62 114,90 86,90"></polygon><polygon points="100,58 118,76 100,94 82,76"></polygon><polygon class="stroke-secondary" points="151,62 179,62 179,90 151,90"></polygon><polygon class="stroke-secondary" points="165,58 183,76 165,94 147,76"></polygon></svg>',
                    'title' => 'Islamic Octagram Mashrabiya',
                    'text'  => 'Classical 8-point star tessellation for cultural and heritage architecture — typical open area 30–45%, engineered as interlocking unitized cassettes.',
                ],
                [
                    'image' => '', 'image_alt' => '', 'contain' => '1',
                    'svg'   => '<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 110"><path d="M10 30 C 40 10, 70 50, 100 30 C 130 10, 160 50, 190 30"></path><path class="stroke-secondary" stroke-width="2" d="M10 58 C 40 38, 70 78, 100 58 C 130 38, 160 78, 190 58"></path><path d="M10 86 C 40 66, 70 106, 100 86 C 130 66, 160 106, 190 86"></path></svg>',
                    'title' => 'Parametric Sine Wave',
                    'text'  => 'Flowing amplitude-modulated ribs for contemporary commercial elevations — 15–40% porosity, wavelength tuned to mullion module spacing.',
                ],
                [
                    'image' => '', 'image_alt' => '', 'contain' => '1',
                    'svg'   => '<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.2" viewBox="0 0 200 110"><polygon points="40,17 54,25 54,41 40,49 26,41 26,25"></polygon><polygon points="70,17 84,25 84,41 70,49 56,41 56,25"></polygon><polygon points="100,17 114,25 114,41 100,49 86,41 86,25"></polygon><polygon points="130,17 144,25 144,41 130,49 116,41 116,25"></polygon><polygon class="stroke-secondary" points="55,43 69,51 69,67 55,75 41,67 41,51"></polygon><polygon class="stroke-secondary" points="85,43 99,51 99,67 85,75 71,67 71,51"></polygon><polygon class="stroke-secondary" points="115,43 129,51 129,67 115,75 101,67 101,51"></polygon><polygon points="40,69 54,77 54,93 40,101 26,93 26,77"></polygon><polygon points="70,69 84,77 84,93 70,101 56,93 56,77"></polygon><polygon points="100,69 114,77 114,93 100,101 86,93 86,77"></polygon><polygon points="130,69 144,77 144,93 130,101 116,93 116,77"></polygon></svg>',
                    'title' => 'Organic Hex Density',
                    'text'  => 'Gradient hexagonal cell fields flowing from opaque to 65% open — ideal for parking screens and plantroom ventilation enclosures.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Global Project References',
            'link_label' => 'View All Completed Case Studies',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBljZP2iBPKMz5bfSzEiawXsNlReWCVD3BlgMNTTabxmutC7bUX82lP708gUnpBwhCm2UYDKpHGGRW9xLI7CYH-wMcbJxIB0Spk8OD23dF2fc2mrzt3TEuPR7O2TKJa0h1-4qXOH8NjJsFeayzfC5P0s6kH2fAEznRqXIhZ-Sl2UZc38aHSBB2tLUMqrrK4T9IZ3CEuEVDIJMZvngMQh5wetU2yx-aNhcFB0FqO-Tk',
                    'image_alt' => 'Cultural library in Abu Dhabi with bronze gold Mashrabiya double-skin envelope.',
                    'location'  => 'ABU DHABI, UAE',
                    'title'     => 'Abu Dhabi Cultural & Heritage Library',
                    'product'   => '4.0mm AA5052-H32 // champagne anodized, −44% solar',
                    'area'      => 'Area: 14,500 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuATD8AeM5KNNMsNkY6CAZJ4gei8S_NZvjarxzz9bxFcF6Hhyj5bvKNDL0cJDqojSKT8fUkCb0KpK3-ZQiplEmXKcNqTVqVZPziOW6VXRd5x8_gEKm9QyD5kbwJeGpAb6WlsZGNHIrHamPjOONktgWzOzBB0riFUw7jeMUZZmy47PFKjXnqOkaUFbWgLQPWXIDr68wyRHs1X6jK9H__DO8d5Xg1N6uQYM6HSDixM3eE',
                    'image_alt' => 'Luxury residential villa compound in Riyadh with parametric aluminum privacy screens.',
                    'location'  => 'RIYADH, KSA',
                    'title'     => 'Al-Nakheel Private Royal Enclave',
                    'product'   => 'Hinged Mashrabiya // thermal barrier isolators',
                    'area'      => 'Area: 8,200 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCdUvrKuQM3VueqmnUiRSmDxAMIe8Te7WlW_7IXFsKCu-eeyR5OP5b1oNdNV59pMD_V0U5IrRFzH-3GhkOtOjUC4BiFgaypJqKtT7Y0jFDtZc4WaZNpOgxI0K5u89YgVyMW_L3vCs9TEND073utcdA6m7sSROjW1LfDIPpkTJs0dPnJyuwBcbcAjvyTV2K_sryy1CdPgyR1aCDfUJQJCvOVfMXaPn4TYcIxjrjzn_o',
                    'image_alt' => 'Convention hotel facade in Doha Qatar with parametric wave pattern aluminum sunscreen grilles.',
                    'location'  => 'DOHA, QATAR',
                    'title'     => 'Doha Maritime Convention Tower',
                    'product'   => 'Unitized modules // Kynar 500 PVDF, 3.8 kPa rated',
                    'area'      => 'Area: 22,000 m²',
                    'year'      => 'Year: 2022',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Technical Tender Consultation // 询价与技术咨询',
            'title'        => 'Request Screen Mock-Up & Engineering Estimate',
            'description'  => 'Submit your project elevation drawings, custom vector patterns (.DWG / .DXF / .AI), or tender schedule requirements. Our facade structural engineering department delivers finite-element load calculations and structural mock-up quotes within 24 business hours.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Submit Architectural RFQ & Request Sample Box',
            'bullets'      => [
                ['icon' => 'deployed_code', 'title' => 'LOD 400 BIM Integration', 'text' => 'Revit families provided with calibrated anchor attachment points.'],
                ['icon' => 'inventory_2', 'title' => 'Express DHL Sample Box', 'text' => '4 laser-cut aluminum alloy plaques in requested anodized finishes.'],
                ['icon' => 'verified', 'title' => 'ASTM & EN Fire Lab Reports', 'text' => 'Certified non-combustible test verification sheets attached to tender.'],
            ],
            'products'     => [
                ['label' => 'Laser-Cut Screens & Grilles'],
                ['label' => 'S-Blade Sunshade Louvers'],
                ['label' => 'Solid Aluminum Cladding'],
            ],
        ],
    ];
}

function alumax_pp_defaults_precoted() {
    $svg_film = <<<'SVG'
<svg class="w-full h-full stroke-primary fill-none" stroke-width="1.5" viewBox="0 0 200 80">
  <rect class="fill-surface-variant stroke-primary" x="30" y="52" width="140" height="10" stroke-width="1.5"></rect>
  <rect class="stroke-secondary" x="30" y="38" width="140" height="12" stroke-width="2"></rect>
  <rect x="30" y="26" width="140" height="10" stroke-width="1.5"></rect>
  <line stroke-width="1" x1="14" x2="30" y1="31" y2="31"></line>
  <line stroke-width="1" x1="14" x2="30" y1="44" y2="44"></line>
  <line stroke-width="1" x1="14" x2="30" y1="57" y2="57"></line>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="7" x="176" y="34">CLEAR 10μM</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="7" x="176" y="47">BASE 20μM</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="7" x="176" y="60">PRIMER 5μM</text>
  <text class="font-label fill-on-surface-variant stroke-none" font-size="7" x="30" y="74">AA3003-H14 SUBSTRATE ｜ 3-COAT 2-BAKE ≥ 35μM TOTAL</text>
</svg>
SVG;

    return [
        'hero' => [
            'bg_image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC52lV-VT7687YP0v3j2Y92qRYhn3GZKoHHXfFS5vbaefrQS6mT5eqGoRqA8pUapeByV57P6B2hFQkg4tIv-naqkfRlR_TIFwcuNHtsZBY8VHZTNMtrzFHz5mInyEQAisMHBAU6sFsk94gUWr5iA6QGtb4QcNvOpzj2jbnwgYP_7lvb-VFLHuhhPkUJC52V7C-3vYWZDqkThXels6rGojleG8ICYI5P3ZcXMviPbcw',
            'title'          => 'ROLLER-COATED ALUMINUM STRIP & MASTER COILS',
            'subtitle'       => 'Continuous 3-Coat 2-Bake Precision. 0T Lock-Seaming. 30-Year Exterior Warranty.',
            'description'    => 'Mill-manufactured under continuous 3-Coat 2-Bake precision roller coating lines. Engineered specifically for complex roll-forming, deep architectural cassette drawing, high-speed corrugated sandwich panel lines, and non-cracking 0T lock-seaming. Spec ID: ALU-CC-9000 // EN 1396 Architectural Spec.',
            'primary_label'  => 'Request Color Swatch Fan Deck & Coil Samples',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Spec Sheet (PDF 3.8MB)',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'verified', 'title' => 'FILM UNIFORMITY ±1.0μM', 'text' => 'X-ray in-line thickness gauge locked.'],
                ['icon' => 'straighten', 'title' => 'T-BEND 0T / 1T', 'text' => 'Zero microfissure on reverse hems.'],
                ['icon' => 'science', 'title' => 'MEK > 100 RUBS', 'text' => 'ASTM D5402 solvent pass.'],
                ['icon' => 'wb_sunny', 'title' => '30 YRS EXTERIOR LIFE', 'text' => 'Kynar 500® 70% PVDF global warranty.'],
            ],
        ],
        'intro' => [
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD7a-avjrmELe2qQnLvepQl23vr5UTYS9GwdhrF7IeqryQD1wuGqq3OYzx3Sjy5efTkejm7BPUeCPdNYk_BxhHnBiYRXdcYGRAmATyC-RayVp0CzNb1n57uTTPqKYkvtDLqlcI5DFhFUDu2LuyF9cctHyjtQhsbyltkcx-WzmOeuNyBiMtxzgyF40DCk6IBEUdo_jco_PMylOSnzlSlJTmi5_-3YDRX1m_q3_rbmJk',
            'image_alt'   => 'Microscopic cutaway of 3-coat 2-bake continuous roller-coating application head with primer, color coat, and protective clear fluoropolymer layer.',
            'video_label' => '3C2B Process // Coating Head Detail',
            'eyebrow'     => 'B2B Mill Direct // 滚涂铝卷板',
            'title'       => 'What is ALU-CC-9000 Pre-Coated Coil?',
            'description' => 'Surface-calibrated architectural strip and master coils produced on a 180-meter cleanroom double-coater line. Licensed Arkema Kynar 500® / Solvay Hylar 5000® fluoropolymer resins are applied, cured and verified in-line — ready for direct forming without any post-painting.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Base Aluminum Alloy Substrate', 'text' => 'AA3003-H14/H24 general architectural / AA5052-H32 marine coastal / AA1100-H14 max formability / AA3105-H24 roofing.'],
                ['icon' => 'straighten', 'title' => 'Gauge Thickness', 'text' => '0.5 / 0.7 / 1.0 / 1.2 / 1.5 / 2.0 / 3.0mm — up to 1.50mm heavy façade spec.'],
                ['icon' => 'width_wide', 'title' => 'Master Coil Slit Width', 'text' => '1,000mm / 1,250mm standard wide / 1,600mm JUMBO.'],
                ['icon' => 'format_paint', 'title' => 'Polymer Coating System', 'text' => '3-Coat PVDF ≥35μm (30y façade) / FEVE Lumiflon® high-gloss 80%+ / HDP super polyester / self-cleaning nano PVDF.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages // 核心优势',
            'title'       => 'ASTM / EN 1396 Certified Coating Physics',
            'description' => 'Independent batch-tested fluoropolymer coating integrity, formulated with licensed Kynar 500® / Hylar 5000® resins and verified under ASTM laboratory standards.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBXapuzaQHbGQJCLrI3xQxW0ydWDgLPZxK-PmVd-aWfL3pdu2X4hoCnu3pYFXE7PA6yFboUi24nj4mmB9mVfbZdUNSLg-uvvcWiphrT7ZGOQszAjEcJKYKvkZDpf5uBG3pzSxHZgWCucFIT9tNde1km2Gv3Rr1lAo9nP7b9P0pAL8AjrQ4DoP5hQa0k72OQfOnqgSW2AXDmVgnD3kaKxYQh_SNGrUQqif-jGS1MNVc',
                    'image_alt' => 'Macro laboratory specimen coupon of pre-painted coil bent 180 degrees in a 0T tight bend test with zero micro cracking.',
                    'icon'      => 'straighten',
                    'title'     => '0T / 1T T-Bend Elasticity',
                    'text'      => 'Zero microfissure or white-line stress bleaching on tight reverse hems — ASTM D4145 / EN 13523-7 certified.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCqMI_odiz-b6odcHkjConuY1_lDMpY11ShxlQs5td1hCMRkfSeLEaUQ3Ty3KwwojzKDm9nI2jUZ23IEZcBFQm5zB87xTqnPzXsEWaCszU_TWl6xpFwOuriDdoAlGXigy9SKivEZYq-zGcF6fUinHQsVNh0rAaLj5mQ5RFfS3uWSCAYsTQOOakcWzP3-JH7drRXs_5dHzuG6e6MOD8MOrD1KSJZlqAS943Nv7jdQmY',
                    'image_alt' => 'Architectural metallic color fan deck swatches in champagne, architectural bronze, mica silver, and graphite.',
                    'icon'      => 'grade',
                    'title'     => '≥ 2H Hardness & 5B Adhesion',
                    'text'      => 'Pencil hardness with 100% cross-hatch tape adhesion — no peel-off at sharp structural edge breaks (ASTM D3363 / D3359).',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCwCHknyIyDRwOxFQ4GysfHfAmxMHnGqxFEYhRhBhVn6AQsWRGEkOmIU-ekASk4dFhoSz87XNNqqkJnJBLz8sSmhYl1kyb0WNZETRkIZzt6_ZnAaEF-mnouKqkwBUjjnM7UGuV8r3CD6YUNb0ZOG5ers5JhNtotSRehXthIQEE7EY_hnUK-YKqvfMq52kGQV2526TcjB1e0oPP4jR8FktJWBleJ6-zjXfE5qQRC7Vc',
                    'image_alt' => 'High precision rotary slitting line cutting wide aluminum coils into narrow architectural strips.',
                    'icon'      => 'shield',
                    'title'     => '4,000 h Salt Fog Corrosion',
                    'text'      => '5% continuous NaCl at 35°C — blister degree ≤ 1, creepage from scribe < 0.5mm. Marine-environment verified (ASTM B117).',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDIv-qIbXBqBKm0YWhxpM7EdP4B97mtwwwH2SDOoSK0ER7BGWPPl3EtsRFbMTW1rqh113VFtPVs9IY5ki-tr2z769Fjfa1Spg8kP4S5ZMW3PKQnn8tlj3RnVC8o6on9wITXCdrdnKmSfcyuX4cZzGAM3L6aiuIW6UHq2pzsUcf1-4ZhoTAXrsQ1fBMaAbQj1Ec6SAYZL7ahevmR36IZA9pbM4vyrmei4jc47dPpU1Q',
                    'image_alt' => 'Ultra-wide aluminum coil continuous roller coating plant with automated double-head coating station and curing oven tunnels.',
                    'icon'      => 'wb_sunny',
                    'title'     => '> 80% QUV Gloss Retention',
                    'text'      => 'After 5,000 h UVA-340 exposure: color deviation ΔE < 2.0 Hunter units, zero chalking — 30-year stability (ASTM G154 / D2244).',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications // 技术参数',
            'title'       => 'Coating Physics & Mechanical Integrity',
            'table_title' => 'ASTM / EN 1396 Certified Laboratory Data',
            'table_ref'   => 'SPEC-ALU-CC9000-REV2025Q1',
            'rows'        => [
                ['name' => 'Total Dry Film Thickness', 'value' => 'PVDF ≥ 35μm (Primer+Base+Clear) ｜ FEVE ≥ 30μm ｜ HDP ≥ 25μm (ASTM D1186 / EN 13523-1)', 'mono' => '1'],
                ['name' => 'T-Bend Flexibility', 'value' => 'PVDF ≤ 1T ｜ FEVE ≤ 1T ｜ HDP ≤ 2T — zero film rupture (ASTM D4145 / EN 13523-7)', 'mono' => '1'],
                ['name' => 'MEK Solvent Resistance', 'value' => 'PVDF > 120 ｜ FEVE > 100 ｜ HDP > 50 double rubs (ASTM D5402 / EN 13523-11)', 'mono' => '1'],
                ['name' => 'Specular Gloss Range (60°)', 'value' => 'PVDF 25–40% architectural matte ｜ FEVE 50–90% high polish ｜ HDP 35–75% (ASTM D523 / ISO 2813)', 'mono' => '1'],
                ['name' => 'Humidity Resistance', 'value' => 'PVDF 4,000 h zero blistering ｜ FEVE 3,500 h ｜ HDP 1,500 h (ASTM D2247, 100% RH @ 38°C)', 'mono' => '1'],
                ['name' => 'Pencil Hardness & Adhesion', 'value' => '≥ 2H, cross-hatch 100/100 Class 5B (ASTM D3363 / D3359)', 'mono' => '1'],
                ['name' => 'Direct Impact Resistance', 'value' => '≥ 9.0 J, reverse impact 80 in-lb — no delamination (ASTM D2794)', 'mono' => '1'],
                ['name' => 'Reaction to Fire', 'value' => 'Class A1 non-combustible substrate / Class A (EN 13501-1 / ASTM E84)', 'mono' => ''],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Spec Sheet (PDF 3.8MB)', 'url' => '#', 'style' => 'primary'],
                ['icon' => 'inventory_2', 'label' => 'Export Packing PDF', 'url' => '#', 'style' => 'muted'],
            ],
            'side_cards'  => [
                [
                    'title'     => '3-Coat 2-Bake Film Build',
                    'tag'       => '3C2B PROCESS',
                    'svg'       => $svg_film,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Primer, base color and protective clear fluoropolymer layers cured in gas-fired multi-zone catenary ovens — total film ≥ 35μm, uniformity ±1.0μm.',
                ],
                [
                    'title'     => 'Real-Time In-Line Spectrophotometer',
                    'tag'       => 'ΔE < 0.5',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Automated traversing optical sensors measure color consistency continuously across coil width, keeping ΔE under 0.5 throughout full 5,000-meter master coils.',
                ],
                [
                    'title'     => 'Peelable PE Protective Film',
                    'tag'       => 'RESIDUE-FREE 6 MONTHS',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Dual-side or single-side 60–100μm UV-resistant polyethylene film laminated in-line at the rewinder — residue-free removal for 6 months after facade installation.',
                ],
            ],
            'install_eyebrow'     => 'Global Logistics // 出口包装与交付',
            'install_title'       => 'Seaworthy Heavy Export Packaging',
            'install_description' => 'ISPM 15 fumigated timber standards for transoceanic container handling — coil orientation matched to your decoiling line configuration.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPE A // EYE-TO-SKY',
                    'title' => 'Vertical Core Pallet Crating',
                    'text'  => 'Standard orientation for high-efficiency container stuffing and overhead forklift crane discharge. Secured on heavy solid fumigated timber skids with circumferential steel banding and VCI inner wrapping, 3-ply corrugated rim edge protectors and multi-bag silica gel desiccants inside the moisture envelope.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDOYrsuU8kyn783aM-VWJmqLGY_qe_9bU0AQ5z2E-oN-RPTpDELn7UIa99sqYdpNap4Rgmf50dbID6QdX_RHhmEivHTRyPd2AV6rtK35_U2c-7puxfu29ILYrvg1zRIbYFM93M6O7PDIC6W7EkFnnbX7mvrKTkh95cLG2r4eGD8GyoDz4DJxWjr-Z6UvTgMnpifqeRdYEZSno1FKibS632Wi99dhiGFZrxnLwTGQjY',
                    'image_alt' => 'Aluminum master coil oriented Eye-to-Sky on solid fumigated wooden pallets wrapped with waterproof film, corrugated protectors and steel band straps.',
                ],
                [
                    'tag'   => 'TYPE B // EYE-TO-WALL',
                    'title' => 'Horizontal Core Cradle Crating',
                    'text'  => 'Engineered for continuous uncoiler decoiling cradles — CNC contoured wooden saddles matched to coil outer diameter prevent flat-spot deformation during long transoceanic voyages. Fully sealed thermal-shrink PE outer barrier with reinforced steel corner clips resisting dynamic container rolling.',
                    'svg'   => '',
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDbkb0mHMObNaDW4I-yZx6R8lqyRvx2AbaviZbe4tLEkmkDunTXh3HXxCfA7U-PN2-xus9q7Z2jkLKWpFMLWLa4y-I9QxVWQVLwGuDmVxxmyNG7l8SPFA8ZYVQNNOeomg5jvuvTzLuxQuvGY2yem99aPuc_D3ynZ8ytimm0bWsYo3b10rKv5qd4Mp4GId0iW4zWR7lWfwsAFkGsuQXxJuqvrCsE5FXuddV1uB4rtVw',
                    'image_alt' => 'Master aluminum coils oriented Eye-to-Wall horizontal axis loaded on contoured wooden cradle skids inside a shipping container.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Color & Coating // 色板',
            'title'       => 'PPG / Beckers Certified Color Matrix',
            'description' => 'Architectural metallic and solid finishes calibrated to ΔE < 0.5 across full master coils — custom RAL / Pantone matching available with complimentary DHL fan-deck dispatch.',
            'swatches'    => [
                ['color' => '#C9A87C', 'name' => 'Desert Champagne Mica', 'code' => '3-Coat Kynar 500 PVDF', 'bespoke' => ''],
                ['color' => '#7A5724', 'name' => 'Architectural Bronze', 'code' => '3-Coat Kynar 500 PVDF', 'bespoke' => ''],
                ['color' => '#B4B8C0', 'name' => 'Mica Silver', 'code' => '3-Coat Kynar 500 PVDF', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Graphite Metallic', 'code' => 'FEVE Lumiflon High-Gloss', 'bespoke' => ''],
                ['color' => '#3B3F44', 'name' => 'Satin Anthracite', 'code' => 'FEVE Lumiflon / HDP', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'Custom RAL / Pantone / Swatch', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Fabrication & Formability // 定制选项',
            'title'       => 'Downstream Processing Capabilities',
            'description' => 'Specialized primer chemistry and high-crystallinity fluorocarbon formulation deliver extreme elongation ductility without micro-fracturing under high-speed industrial forming machines.',
            'cards'       => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDCyCAjl85pG1nHXmqMeqeXBe6fp9yrwjRFBktj_PSefAJDHwcwkYgUyj0zA2iowQikeIuiQn_KBy9NNcbwn4wT4qTVivtUDykRYRbK63vwXHcMSbqc1SMe9D-EUrowyYR5-8hwEyBlRgW2JPrI_WBnfVvF49IbpB122s8xjY9DU1nR1zqaZ2WIxDjS8_fyiBQI06HLFfcuT0THdKu0Pi66TV2kkd81cc2UGA4m5vc',
                    'image_alt' => 'Industrial metal press brake folding an architectural aluminum cassette panel with zero micro-cracking at a sharp 0T edge hem.',
                    'contain'   => '1',
                    'title'     => 'Press Brake & Hemming — 0T Façade Cassettes',
                    'text'      => 'Formed on CNC hydraulic press brakes with tight radius tooling (R = 0 to 1T). Coated film stretches seamlessly along bend apexes without crazing or white-line stress bleaching — 180° reverse hem OK.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCqA-fd5VVoyHQJfZx2Zjx3n9yxk1ccWDYAB13wN1ahd_BCwDrNYNNJfOe29od2DjEpVBDbU5O7ELfWCx-P5t0KmiCYwLnu6vUwp_CNCckmT8MyILJbVk8RwU4fGHNGC6Ge-FTtnts6P22bCq_5c1UqooLDEA9WPMkd9d9zAjM5-Lcdx_zaNNd129OpsQOaUD2BZjMmVagn40IhlsD47QjGjwlt5bh3yLztL2YuuPk',
                    'image_alt' => 'Continuous high-speed roll forming line processing wide-format aluminum coil into standing seam roofing profiles.',
                    'contain'   => '1',
                    'title'     => 'High-Speed Roll Forming — Standing Seam & Corrugated',
                    'text'      => 'Engineered for continuous multi-stand roll-forming lines up to 35 m/min. Resists roller pressure galling, strip friction scuffing, and dynamic mechanical stretch — zero roller marring.',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC372eYmuP5AAoqIQCfcaC0-CLYTwyPR6wdpdSB3NzcpX4LfIy7qobHNJIsitenEshO4wZShEFp3TioZUMqGhnl7YQo_k75VjcMVUqfwRJdhmAvWIGMITfukf_nA_mknD-feK9WdAAtZfpUi2e_vrUG2A3D7DAqBEVGgtALtxJY642WnHwHPZOHk8vv0eQBwkbI0mAl_zpUkAYLGyCqETNuugAZzIv9nNmUnXYX3n4',
                    'image_alt' => 'Precision CNC multi-tool turret punch press perforating geometric patterns into heavy-gauge pre-coated aluminum sheet.',
                    'contain'   => '1',
                    'title'     => 'CNC Stamping & Perforation — Deep-Drawing',
                    'text'      => 'Compatible with high-tonnage multi-punch CNC perforation tooling, open area up to 55%. Paint adhesion holds tightly along hole perimeters — edges chip-free, no peeling or flaking.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Case References // 工程案例',
            'title'      => 'Global Landmark Installations',
            'link_label' => 'View All Completed Case Studies',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCbL0iMHfMpNIJN3yu55HjLNlewodU9nuaCfQrgUkQFC2i6Vx9j3UrHJGA932nrwLU2ZcjkxrF2whOzz_7yxYSWqTjezXnFbDRPHaxe-GTQJLoh7cJ3mwZgvssMPkUQLUEekQ-CPdkgy7nQwKaqU9Khk7U6wJ-L5RR3zSy4hU74ANQQNf36clv7gQQ_UEwb1fLFgmPJdRTMquKtgP__0d7gjvGGWxjHi6__IF7Eegs',
                    'image_alt' => 'Futuristic airport terminal roof in Dubai with undulating standing seam champagne gold aluminum coil panels under desert sunlight.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'Dubai Metro Red Line Expansion',
                    'product'   => 'AA3003-H14 1.2mm // 3-Coat PVDF 38μm Desert Champagne Mica, 42m standing seam',
                    'area'      => 'Area: 48,000 m²',
                    'year'      => 'Sector: Transportation Terminal',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC0QwJEsW_mQj9KM10Do8UNslQzP3B-iRzzQfGYapt5gMdMYbpPdMV7_eko3eWrsTRflO64jpJ2m1bohT3IK70IAQg2OVFo7D95nelUIQMRLjdXC3tOFLR1y9LEZYZ48FbP9FfdUMGyhkBf91c8HJRVekrsE3bSc_5KJHBK5o5SggDRxt3RKKdff7YlT7wncy97SU-fDPOjn5Vna9NhhJbbFaf_zKa0M6JQ9YTPkX4',
                    'image_alt' => 'Modern geometric convention center and port terminal facade in Hamburg clad in dark anthracite roller-coated aluminum cassette panels.',
                    'location'  => 'HAMBURG, DE',
                    'title'     => 'Elbe River Logistics Center',
                    'product'   => 'AA5052-H32 2.0mm // FEVE Lumiflon Satin Anthracite rainscreen cassettes',
                    'area'      => 'Area: 32,500 m²',
                    'year'      => 'Sector: Commercial Port Logistics',
                ],
                [
                    'image'     => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBudbo-umLD2MIcUECI5jjEwLykINgh-pOQQg1u451jF5dCmJWgtqQ_Ay8nHl0D5hWSMXzoRiB0DXHuYnyHyjg4_hWe1dGBzGsmdd4gJY5J2OSGEmx4rILwJ1tlTF5K9PcYaNJl16hR5tMGTbThsTLv0R9gAVJieNOquGmfEqabEQ65PoxxsWnLiiZ80eMuChynFednVbCqJPV3EeCQmW1AT2U6Fnx615OBztqdw8I',
                    'image_alt' => 'High-tech semiconductor research cleanroom exterior in Singapore with ultra-flat pure white pre-insulated sandwich wall panels.',
                    'location'  => 'SINGAPORE',
                    'title'     => 'Tuas Biomedical Cleanroom Complex',
                    'product'   => 'AA3105-H24 0.7mm // Anti-static HDP, pre-slit 1,200mm for PIR sandwich lines',
                    'area'      => 'Area: 21,000 m²',
                    'year'      => 'Sector: Biotech Cleanroom Facility',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Fast B2B Engineering Quotation // 询价与技术咨询',
            'title'        => 'Direct Mill Inquiries & Color Swatch Fan-Deck Dispatch',
            'description'  => 'Submit your commercial volume requirements. Our export engineering center provides technical mill feasibility reviews, ASTM compliance certificates, and CIF/FOB pricing within 24 hours. Certified to ISO 9001:2015, EN 1396, ASTM B209M and QUALICOAT.',
            'form_title'   => 'Coil Specification & Pricing Request',
            'form_badge'   => '24H MILL RESPONSE',
            'submit_label' => 'Submit Mill Production RFQ & Request Swatch Deck',
            'bullets'      => [
                ['icon' => 'mark_email_read', 'title' => 'Global Mill Export Email', 'text' => 'export@alumax-facade.com — direct engineering channel.'],
                ['icon' => 'alarm_on', 'title' => 'Typical Response Speed', 'text' => '< 4 hours across MENA, APAC & Europe zones.'],
                ['icon' => 'flight_takeoff', 'title' => 'Physical Color Sample Box', 'text' => 'Complimentary DHL air express fan deck & 0T bent test coupon (3–5 days).'],
            ],
            'products'     => [
                ['label' => 'Pre-Coated & Roller-Coated Coils'],
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Aluminum Composite Panels'],
            ],
        ],
    ];
}
