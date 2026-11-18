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
        'smart-motorized-aluminum-louvers',
        'pre_insulated_metal_cladding_panels_technical_specification',
        'pre-insulated-integrated-wall-panels',
        'architectural_steel_wall_panels_technical_specification',
        'architectural-steel-wall-panels',
        'solid-aluminum-cladding-panels',
        'aluminum_composite_panels',
        'fire-retardant-aluminum-composite-panels',
        'aluminum_honeycomb_core_panels_technical_specification',
        'hexagonal-honeycomb-composite-panels',
        'corrugated_core_composite_panels_technical_specification',
        'corrugated-core-aluminum-composite-panels',
        'architectural_metal_ceiling_systems_technical_specification',
        'architectural-metal-ceiling-systems',
        'architectural_s_blade_sunshade_louvers_technical_specification',
        'architectural-solar-control-louvers',
        'architectural_aluminum_grilles_screens_technical_specification',
        'laser-cut-welded-architectural-screens',
        'pre_coated_roller_coated_aluminum_sheets_technical_specification',
        'roll-coated-aluminum-panels',
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
        if ($profile !== 'system-parameter-configurator' && $profile !== 'smart-motorized-aluminum-louvers') {
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
    if ($slug === 'pre_insulated_metal_cladding_panels_technical_specification' || $slug === 'pre-insulated-integrated-wall-panels') {
        return alumax_pp_defaults_pre_insulated();
    }
    if ($slug === 'architectural_steel_wall_panels_technical_specification' || $slug === 'architectural-steel-wall-panels') {
        return alumax_pp_defaults_steel();
    }
    if ($slug === 'solid-aluminum-cladding-panels') {
        return alumax_pp_defaults_solid();
    }
    if ($slug === 'aluminum_composite_panels' || $slug === 'fire-retardant-aluminum-composite-panels') {
        return alumax_pp_defaults_acp();
    }
    if ($slug === 'aluminum_honeycomb_core_panels_technical_specification' || $slug === 'hexagonal-honeycomb-composite-panels') {
        return alumax_pp_defaults_honeycomb();
    }
    if ($slug === 'corrugated_core_composite_panels_technical_specification' || $slug === 'corrugated-core-aluminum-composite-panels') {
        return alumax_pp_defaults_corrugated();
    }
    if ($slug === 'architectural_metal_ceiling_systems_technical_specification' || $slug === 'architectural-metal-ceiling-systems') {
        return alumax_pp_defaults_ceiling();
    }
    if ($slug === 'architectural_s_blade_sunshade_louvers_technical_specification' || $slug === 'architectural-solar-control-louvers') {
        return alumax_pp_defaults_louver();
    }
    if ($slug === 'architectural_aluminum_grilles_screens_technical_specification' || $slug === 'laser-cut-welded-architectural-screens') {
        return alumax_pp_defaults_grilles();
    }
    if ($slug === 'pre_coated_roller_coated_aluminum_sheets_technical_specification' || $slug === 'roll-coated-aluminum-panels') {
        return alumax_pp_defaults_precoted();
    }
    if ($slug !== 'system-parameter-configurator' && $slug !== 'smart-motorized-aluminum-louvers') {
        // 无档案键的产品（如新建产品）：通用默认内容，后续在后台编辑
        return [
            'hero' => [
                'bg_image'       => '',
                'title'          => '',
                'subtitle'       => '',
                'description'    => '',
                'primary_label'  => 'Request a Quote',
                'primary_url'    => '#rfq-section',
                'secondary_label' => 'Download Datasheet',
                'secondary_url'  => '#technical-specifications',
                'secondary_icon' => 'download',
                'badges'         => [],
            ],
            'inquiry' => [
                'eyebrow'      => 'Request a Quote',
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
            'bg_image'       => '/wp-content/uploads/2026/10/smart-motorized-aluminum-louvers-banner-scaled.jpg',
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
                ['icon' => 'air', 'title' => 'Wind Rated', 'text' => 'Category 5 Typhoon'],
                ['icon' => 'volume_down', 'title' => 'Acoustic Quiet', 'text' => '< 42 dB Actuator'],
            ],
        ],
        'intro' => [
            'image'       => '/wp-content/uploads/alumax-img-6f0cd09a39.jpg',
            'image_alt'   => 'Close-up architectural macro photograph of precision extruded aluminum louver blades mounted on a stainless steel structural pivot arm.',
            'video_label' => 'Watch System Video',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Smart Motorized Aluminum Louvers?',
            'description' => 'The motorized aluminum louver system consists of high-performance aluminum blades, a supporting structure, a drive system, and an intelligent control system. By adjusting the blade angle in real time, it dynamically controls direct sunlight, minimizes thermal radiation, maximizes natural daylighting, and sculpts the distinct visual aesthetic of the building facade.',
            'features'    => [
                ['icon' => 'tune', 'title' => 'Adjustable blade angles', 'text' => 'Precise 0° to 90° light control and glare mitigation.'],
                ['icon' => 'view_in_ar', 'title' => 'Aluminum profiles', 'text' => 'Extruded 6063-T5/T6 alloy: durable, rigid & lightweight.'],
                ['icon' => 'precision_manufacturing', 'title' => 'Motorized operation', 'text' => 'Smooth, low-noise linear actuator and concealed drive rod.'],
                ['icon' => 'sensors', 'title' => 'Optional sensors', 'text' => 'Automated sun tracking, wind storm retract & rain protection.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Smart Motorized Aluminum Louvers?',
            'description' => 'Engineered for international commercial architectural standards, delivering quantifiable energy savings, environmental comfort, and facade prestige.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-32fa214ae2.jpg',
                    'image_alt' => 'Energy-efficient solar louvers blocking intense summer solar rays from entering a large glazed atrium.',
                    'icon'      => 'solar_power',
                    'title'     => 'Solar Control',
                    'text'      => 'Block direct solar heat radiation and reduce internal air conditioning cooling demand by up to 35%.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-ee00026186.jpg',
                    'image_alt' => 'Motorized aluminum aerofoil blades rotating synchronously at 45 degree angle with precision pivot joints.',
                    'icon'      => 'linear_scale',
                    'title'     => 'Adjustable Shading',
                    'text'      => 'Balance natural daylighting and occupant privacy with micro-precision angle positioning.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-3ca1e3d07c.jpg',
                    'image_alt' => 'Facade with geometric rhythms of vertical and horizontal aluminum louvers integrated with curtain wall glass framing.',
                    'icon'      => 'palette',
                    'title'     => 'Facade Design',
                    'text'      => 'Multiple extruded blade profiles, custom fluoropolymer colors, and tailored vertical or horizontal modular layouts.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-75e6ccca41.jpg',
                    'image_alt' => 'IP65 waterproof rated electric linear actuator motor mounted inside an extruded aluminum facade mullion.',
                    'icon'      => 'hub',
                    'title'     => 'Smart Automation',
                    'text'      => 'Full integration with KNX, BACnet, BMS protocols, sun path tracking, and automated schedule automation.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
            'table_title' => 'Standard Engineering Schedule',
            'table_ref'   => 'REF: AX-LOUVER-MOT-2025',
            'rows'        => [
                ['name' => 'Product Type', 'value' => 'Motorized / Adjustable Architectural Envelope Louver', 'mono' => ''],
                ['name' => 'Blade Profile', 'value' => 'Aerofoil (Wing) / Elliptical / Rectangular / Bespoke Box (varies by model)', 'mono' => ''],
                ['name' => 'Blade Dimensions', 'value' => 'Width: 100 - 450 mm | Thickness: 1.5 - 2.5 mm | Max Span: up to 6000 mm', 'mono' => '1'],
                ['name' => 'Alloy & Temper', 'value' => 'Extruded Aluminum Alloy 6063-T5 / 6063-T6 (GB/T 5237 / ASTM B221)', 'mono' => '1'],
                ['name' => 'Finish Options', 'value' => 'PVDF 3-Coat 35μm (AAMA 2605) / Architectural Powder Coating / Hard Anodized 20μm', 'mono' => ''],
                ['name' => 'Blade Rotation', 'value' => '0° - 90° Continuous Angle Rotation (Custom 120° available)', 'mono' => '1'],
                ['name' => 'Drive System', 'value' => 'IP65 Waterproof Electric Tubular / Linear Actuator (24V DC / 220V AC, <42dB)', 'mono' => ''],
                ['name' => 'Control Options', 'value' => 'Dry Contact Switch / RF Remote / BMS Direct Interface (RS485, KNX, BACnet)', 'mono' => ''],
                ['name' => 'Wind Performance', 'value' => 'Tested up to 3.5 kPa (CWCT Class 4 / ASTM E330 certified project calculation)', 'mono' => ''],
                ['name' => 'Customization', 'value' => 'Blade scale, RAL colors, mullion brackets & vertical/horizontal installation', 'mono' => ''],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Download Product Datasheet (PDF)', 'url' => '#rfq-section', 'style' => 'primary'],
                ['icon' => 'folder_zip', 'label' => 'Request CAD / BIM Files (.DWG / .RVT)', 'url' => '#rfq-section', 'style' => 'muted'],
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
                    'image'     => '/wp-content/uploads/alumax-img-ff06ac6d55.jpg',
                    'image_alt' => 'Concealed electric motor actuator linkage box mounted inside an extruded aluminum facade bracket assembly.',
                    'caption'   => 'IP65 sealed transmission unit with micro-switch end-stops',
                ],
            ],
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
            'install_description' => 'Engineered to interface seamlessly with all primary building structures, curtain wall envelopes, and architectural canopy openings.',
            'install_note'        => 'All mounting brackets manufactured from Grade 304 / 316 stainless steel or heavy 6063-T6 aluminum, isolated with EPDM gaskets and dielectric shims to eliminate galvanic corrosion and thermal bridging.',
            'install_items'       => [
                ['svg' => '', 'image' => '/wp-content/uploads/2026/11/louver-install-surface-mounted.jpg', 'image_alt' => 'Surface-mounted motorized aluminum louver installation with heavy-duty cantilever standoff brackets on exterior concrete wall.', 'tag' => 'TYPE 01 // EXTERIOR RETROFIT', 'title' => 'Surface-Mounted', 'text' => 'Engineered for solid exterior walls and building facade retrofits. Heavy-duty cantilever standoff bracket arms anchor directly onto structural concrete or steel substructures without requiring alterations to existing window openings.'],
                ['svg' => '', 'image' => '/wp-content/uploads/2026/11/louver-install-recessed.jpg', 'image_alt' => 'Recessed motorized aluminum louver installation nested flush inside an exterior punched window reveal.', 'tag' => 'TYPE 02 // WINDOW REVEAL', 'title' => 'Recessed', 'text' => 'Engineered for punched window openings and deep facade reveals. The motorized louver assembly mounts flush within the perimeter structural pocket with concealed side guide channels, maximizing natural shade depth and wind resistance.'],
                ['svg' => '', 'image' => '/wp-content/uploads/2026/11/louver-install-between-structure.jpg', 'image_alt' => 'Between-structure motorized louver system spanning between two primary vertical steel columns.', 'tag' => 'TYPE 03 // PRIMARY GRID', 'title' => 'Between-Structure', 'text' => 'Engineered for large spans between structural steel columns, floor slab edges, and primary framing. Heavy pivot bearings absorb significant thermal expansion, high wind loads, and inter-story seismic building movement.'],
                ['svg' => '', 'image' => '/wp-content/uploads/2026/11/louver-install-curtain-wall-integrated.jpg', 'image_alt' => 'Curtain wall integrated motorized aluminum louvers mounted directly to aluminum transoms and mullions with architectural glass.', 'tag' => 'TYPE 04 // CURTAIN WALL', 'title' => 'Curtain Wall Integrated', 'text' => 'Engineered for unitized and stick-built glass curtain wall transoms and mullions. Features dielectric thermal-break isolators and completely concealed motor wiring within internal aluminum profile cavities.'],
                ['svg' => '', 'image' => '/wp-content/uploads/2026/11/louver-install-overhead-mounted.jpg', 'image_alt' => 'Overhead-mounted motorized louver system suspended horizontally from structural steel overhead beams.', 'tag' => 'TYPE 05 // CANOPY & SKYLIGHT', 'title' => 'Overhead-Mounted', 'text' => 'Engineered for building entrance canopies, covered walkway corridors, and glass skylight roofs. Louvers suspend horizontally or at designated angles using high-tensile safety hanger rods and IP66 weather-sealed actuator drives.'],
            ],
        ],
        'control' => [
            'eyebrow'     => 'Intelligent Control',
            'title'       => 'Flexible & Intelligent Operation',
            'description' => 'With integrated environmental sensors and intelligent controllers, the ALUMAX motorized louver system automatically modulates blade angles based on real-time solar azimuth, local wind velocity, temperature, and tenant preferences—creating a low-energy, highly comfortable indoor climate.',
            'cta_label'   => '',
            'cta_url'     => '#rfq-section',
            'modes'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-3fd35603d0.jpg',
                    'image_alt' => 'Motorized aluminum facade louvers fully closed in shading mode.',
                    'tag'       => '01 // 0°',
                    'title'     => 'Closed / Shading Mode',
                    'subtitle'  => 'Maximum Solar Protection',
                    'text'      => 'Blocks 100% direct sun, minimizing HVAC peak loads during extreme heat.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-0fa7719c0b.jpg',
                    'image_alt' => 'Exterior building louvers tilted at 45 degree angle allowing balanced natural daylight.',
                    'tag'       => '02 // 45°',
                    'title'     => 'Adjustable / Daylight Mode',
                    'subtitle'  => 'Balanced Light & Comfort',
                    'text'      => 'Harmonizes diffuse ambient daylight, eliminates glare, and retains outdoor views.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-d53ef73ce3.jpg',
                    'image_alt' => 'Modern glass facade with motorized aluminum louvers turned to full 90 degree horizontal open angle.',
                    'tag'       => '03 // 90°',
                    'title'     => 'Open / View Mode',
                    'subtitle'  => 'Unobstructed Daylight',
                    'text'      => 'Maximizes daylight entry and building transparency during overcast skies.',
                ],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
            'description' => 'We offer an extensive range of engineering configurations to satisfy bespoke architectural geometries, local wind codes, and corporate branding standards.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/2026/11/louver-blade-profiles-extrusion.jpg',
                    'image_alt' => 'Precision extruded aluminum louver blade profiles showing aerofoil, elliptical, and rectangular box sections.',
                    'contain'   => '1',
                    'title'     => 'Blade Profiles',
                    'text'      => 'Aerofoil (100–450mm), elliptical, box rectangular, and custom die extrusion profiles tailored to project wind loads.',
                ],
                [
                    'image'     => '/wp-content/uploads/2026/11/architectural-louver-colors-finishes.jpg',
                    'image_alt' => 'Architectural aluminum finish samples including bronze anodized, champagne gold, brushed silver, anthracite charcoal PVDF, and matte white.',
                    'contain'   => '',
                    'title'     => 'Colors & Finishes',
                    'text'      => 'AAMA 2605 certified PVDF 3-coat, architectural polyester powder coating in any RAL code, and hard anodized architectural finishes.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-824a54575c.jpg',
                    'image_alt' => 'Aluminum motorized actuator unit with stainless steel drive shaft and planetary gearbox.',
                    'contain'   => '1',
                    'title'     => 'Drive & Controls',
                    'text'      => '24V DC / 230V AC motors, intelligent BMS controllers, wind and rain weather stations, and solar position algorithms.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-2040860310.jpg',
                    'image_alt' => 'Grade 316 stainless steel mounting bracket hardware and pivot joints for curtain wall louvers.',
                    'contain'   => '1',
                    'title'     => 'Mounting Options',
                    'text'      => 'Curtain wall bracket adaptors, standalone steel substructures, horizontal cantilever arms, and custom seismic anchors.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'   => 'Project References',
            'title'     => 'Trusted in Iconic Buildings',
            'link_label' => 'View All Global Projects',
            'link_url'  => '',
            'projects'  => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-7ceffd4dc4.jpg',
                    'image_alt' => 'Modern glass office skyscraper in New York City with motorized horizontal aluminum louvers.',
                    'location'  => 'NEW YORK, USA',
                    'title'     => 'Commercial Office Tower',
                    'product'   => 'Motorized Horizontal Louvers',
                    'area'      => 'Area: 14,800 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-31a22b8ec5.jpg',
                    'image_alt' => 'High-tech corporate campus in Singapore with custom vertical motorized sun louvers integrated with BMS.',
                    'location'  => 'SINGAPORE',
                    'title'     => 'Tech Innovation Complex',
                    'product'   => 'Custom Louver Profile + BMS',
                    'area'      => 'Area: 22,500 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-0a3093b951.jpg',
                    'image_alt' => 'University research building in Sydney Australia with cantilevered motorized aluminum solar shading fins.',
                    'location'  => 'SYDNEY, AUSTRALIA',
                    'title'     => 'University Research Campus',
                    'product'   => 'Facade Shading System',
                    'area'      => 'Area: 8,600 m²',
                    'year'      => 'Year: 2022',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-4b4396bd76.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
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
        'primary'     => ['label' => 'Request a Quote', 'url' => !empty($hero['primary_url']) ? $hero['primary_url'] : '#rfq-section'],
        'secondary'   => ['label' => 'Download Datasheet', 'url' => '#technical-specifications', 'icon' => 'download'],
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
    $specs['eyebrow'] = 'Technical Specifications';
    $specs['title']   = 'Product Parameters & Engineering Details';
    // Unify technical specifications button to single Download Product Datasheet (PDF)
    $specs['buttons'] = [
        ['icon' => 'picture_as_pdf', 'label' => 'Download Product Datasheet (PDF)', 'url' => '#', 'style' => 'primary'],
    ];

    // Installation independent module (specs install_* keys, legacy label->title compatibility)
    $install = [
        'eyebrow'     => 'Installation Typologies',
        'title'       => 'Versatile Structural Mounting & Integration Options',
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
    if (!empty($control['modes'])) {
        $control['eyebrow'] = 'Intelligent Control';
        $control['title']   = 'Flexible & Intelligent Operation';
    }
    $cta_label = trim((string) ($control['cta_label'] ?? ''));
    $control['cta'] = $cta_label !== '' ? ['label' => $cta_label, 'url' => $control['cta_url'] ?? ''] : null;
    unset($control['cta_label'], $control['cta_url']);

    $options = alumax_product_page_section('options', $post_id);
    $options['eyebrow'] = 'Customization Options';
    $options['title']   = 'Tailored to Your Project';

    $palette = alumax_product_page_section('palette', $post_id);
    $palette['eyebrow'] = 'Exterior Colors & Finishes';
    $palette['title']   = 'Colors & Architectural Finishes';

    $cases = alumax_product_page_section('cases', $post_id);
    $cases['eyebrow'] = 'Project References';
    $cases['title']   = 'Trusted in Iconic Buildings';
    $cases['link'] = !empty($cases['link_label'])
        ? ['label' => $cases['link_label'], 'url' => !empty($cases['link_url']) ? $cases['link_url'] : get_post_type_archive_link('case')]
        : null;
    unset($cases['link_label'], $cases['link_url']);

    $inquiry = alumax_product_page_section('inquiry', $post_id);
    $inquiry['eyebrow']    = 'Request a Project Quote';
    $inquiry['title']      = 'Have a Project in Mind?';
    $inquiry['form_title'] = 'Direct Factory Specification RFQ';
    if (!empty($inquiry['products'])) {
        $inquiry['products'][0]['checked'] = true;
    }

    $intro = alumax_product_page_section('intro', $post_id);
    $intro['eyebrow'] = 'The Product';

    $advantages = alumax_product_page_section('advantages', $post_id);
    $advantages['eyebrow'] = 'Key Advantages';

    return [
        'hero'       => $hero_args,
        'intro'      => $intro,
        'advantages' => $advantages,
        'specs'      => $specs,
        'control'    => $control,
        'options'    => $options,
        'palette'    => $palette,
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
    // 浅色模块背景按实际渲染顺序交替（container-low / surface），
    // 避免禁用部分模块后相邻模块同色（如技术参数与定制选项连在一起）
    $alumax_bg_index = 0;
    $alumax_bg = function () use (&$alumax_bg_index) {
        return $alumax_bg_index++ % 2 === 0 ? 'bg-surface-container-low' : 'bg-surface';
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
        get_template_part('template-parts/product-sections/intro', null, $alumax_sections['intro'] + ['bg' => $alumax_bg()]);
    }
    if ($alumax_show('advantages') && !empty($alumax_sections['advantages']['cards'])) {
        get_template_part('template-parts/product-sections/advantages', null, $alumax_sections['advantages'] + ['bg' => $alumax_bg()]);
    }
    if ($alumax_show('control') && !empty($alumax_sections['control']['modes'])) {
        get_template_part('template-parts/product-sections/control', null, $alumax_sections['control'] + ['bg' => $alumax_bg()]);
    }
    if ($alumax_show('specs') && !empty($alumax_sections['specs']['rows'])) {
        get_template_part('template-parts/product-sections/specs', null, $alumax_sections['specs'] + ['bg' => $alumax_bg()]);
    }
    if ($alumax_show('palette') && !empty($alumax_sections['palette']['swatches'])) {
        get_template_part('template-parts/product-sections/palette', null, $alumax_sections['palette'] + ['bg' => $alumax_bg()]);
    }
    if ($alumax_show('options') && !empty($alumax_sections['options']['cards'])) {
        get_template_part('template-parts/product-sections/options', null, $alumax_sections['options'] + ['bg' => $alumax_bg()]);
    }
    if ($alumax_show('install') && !empty($alumax_sections['install']['items']) && !empty($alumax_sections['install']['title'])) {
        get_template_part('template-parts/product-sections/install', null, $alumax_sections['install'] + ['bg' => $alumax_bg()]);
    }
    if ($alumax_show('cases') && !empty($alumax_sections['cases']['projects'])) {
        get_template_part('template-parts/product-sections/cases', null, $alumax_sections['cases'] + ['bg' => $alumax_bg()]);
    }
    if ($alumax_show('inquiry')) {
        get_template_part('template-parts/product-sections/inquiry', null, $alumax_sections['inquiry']);
    }
    ?>
  </div>
</main>
<?php
    // 数据表 PDF 下载：用 jsPDF 按参数数据直接绘制 PDF（矢量文字，非页面截图），
    // 纯浏览器端实现，静态导出站点同样可用。触发按钮见 hero/specs 模板的 data-datasheet-pdf。
    if ($alumax_show('specs') && !empty($alumax_sections['specs']['rows'])) :
        $alumax_pid = $post_id ?: get_the_ID();
        $alumax_spec_section = $alumax_sections['specs'];
        $alumax_pdf_rows = [];
        foreach ($alumax_spec_section['rows'] as $alumax_row) {
            $alumax_pdf_rows[] = [$alumax_row['name'], $alumax_row['value']];
        }
        $alumax_pdf_cards = [];
        foreach ((array) ($alumax_spec_section['side_cards'] ?? []) as $alumax_card) {
            $alumax_pdf_cards[] = [
                'title'   => $alumax_card['title'] ?? '',
                'tag'     => $alumax_card['tag'] ?? '',
                'caption' => $alumax_card['caption'] ?? '',
            ];
        }
        $alumax_pdf_data = [
            'product'    => get_the_title($alumax_pid),
            'date'       => gmdate('Y-m-d'),
            'eyebrow'    => $alumax_spec_section['eyebrow'] ?? '',
            'title'      => $alumax_spec_section['title'] ?? '',
            'tableTitle' => $alumax_spec_section['table_title'] ?? 'Specification',
            'tableRef'   => $alumax_spec_section['table_ref'] ?? '',
            'rows'       => $alumax_pdf_rows,
            'cards'      => $alumax_pdf_cards,
        ];
        ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  if (!window.jspdf) return;
  var DATA = <?php echo wp_json_encode($alumax_pdf_data); ?>;
  // jsPDF default font only supports Latin-1; lazy load CJK font if needed
  var FONT_URL = 'https://cdn.jsdelivr.net/gh/StellarCN/scp_zh@master/fonts/SimHei.ttf';
  var fontPromise = null;
  function loadFontB64() {
    if (!fontPromise) {
      fontPromise = fetch(FONT_URL).then(function (r) {
        if (!r.ok) throw new Error('font fetch failed');
        return r.arrayBuffer();
      }).then(function (buf) {
        var bytes = new Uint8Array(buf), binary = '', chunk = 0x8000;
        for (var i = 0; i < bytes.length; i += chunk) {
          binary += String.fromCharCode.apply(null, bytes.subarray(i, i + chunk));
        }
        return btoa(binary);
      });
    }
    return fontPromise;
  }
  // Greek letter mu mapping to Latin-1 equivalent for helvetica support
  function sanitize(s) { return String(s == null ? '' : s).replace(/\u03BC/g, '\u00B5'); }
  function isLatin(s) { return !/[^\u0000-\u00FF]/.test(s); }

  function buildPdf(fontB64) {
    var doc = new window.jspdf.jsPDF({ unit: 'mm', format: 'a4' });
    var hasCjkFont = !!fontB64;
    if (hasCjkFont) {
      doc.addFileToVFS('simhei.ttf', fontB64);
      doc.addFont('simhei.ttf', 'simhei', 'normal');
    }
    function T(s) {
      var v = sanitize(s);
      if (!hasCjkFont) {
        // Font fallback cleanup
        v = v.replace(/[\u3000-\u9fff\uff00-\uffef]+/g, '').replace(/\s*\/\/\s*$/, '').trim();
      }
      return v;
    }
    function setFont(bold, s) {
      if (hasCjkFont && s !== undefined && !isLatin(sanitize(s))) {
        doc.setFont('simhei', 'normal');
      } else {
        doc.setFont('helvetica', bold ? 'bold' : 'normal');
      }
    }
    var pageW = 210, margin = 14;

    // Header dark banner
    doc.setFillColor(13, 27, 42);
    doc.rect(0, 0, pageW, 28, 'F');
    setFont(true);
    doc.setFontSize(9);
    doc.setTextColor(255, 221, 181);
    doc.text('ALUMAX ARCHITECTURAL', margin, 10);
    doc.setFontSize(16);
    doc.setTextColor(255, 255, 255);
    setFont(true, DATA.product);
    doc.text(T(DATA.product), margin, 19);
    setFont(false);
    doc.setFontSize(8);
    doc.setTextColor(186, 200, 220);
    doc.text('TECHNICAL DATASHEET · ' + DATA.date, margin, 25);

    var y = 38;
    if (DATA.eyebrow) {
      setFont(false, DATA.eyebrow);
      doc.setFontSize(8);
      doc.setTextColor(123, 88, 37);
      doc.text(T(DATA.eyebrow).toUpperCase(), margin, y);
      y += 6;
    }
    if (DATA.title) {
      setFont(true, DATA.title);
      doc.setFontSize(13);
      doc.setTextColor(13, 27, 42);
      doc.text(doc.splitTextToSize(T(DATA.title), pageW - margin * 2), margin, y);
      y += 8;
    }
    if (DATA.tableRef) {
      setFont(false, DATA.tableRef);
      doc.setFontSize(7);
      doc.setTextColor(116, 119, 125);
      doc.text(T(DATA.tableRef), margin, y);
      y += 4;
    }

    // Specification table
    doc.autoTable({
      startY: y + 2,
      head: [[T(DATA.tableTitle), '']],
      body: DATA.rows.map(function (r) { return [T(r[0]), T(r[1])]; }),
      styles: { fontSize: 8.5, cellPadding: 2.2, textColor: [68, 71, 76], font: 'helvetica' },
      headStyles: { fillColor: [13, 27, 42], textColor: 255, fontSize: 9, font: 'helvetica', fontStyle: 'bold' },
      alternateRowStyles: { fillColor: [242, 244, 246] },
      margin: { left: margin, right: margin },
      columnStyles: { 0: { fontStyle: 'bold', cellWidth: 62, textColor: [25, 28, 30] } },
      didParseCell: function (data) {
        // Switch font for CJK cells
        var raw = data.cell.raw != null ? String(data.cell.raw) : '';
        if (hasCjkFont && !isLatin(raw)) {
          data.cell.styles.font = 'simhei';
          data.cell.styles.fontStyle = 'normal';
        }
      }
    });
    y = doc.lastAutoTable.finalY + 8;

    // Engineering cards text info
    if (DATA.cards && DATA.cards.length) {
      setFont(true);
      doc.setFontSize(10);
      doc.setTextColor(13, 27, 42);
      doc.text('Engineering Schematics', margin, y);
      y += 5;
      DATA.cards.forEach(function (card) {
        if (y > 270) { doc.addPage(); y = 20; }
        var head = T(card.title) + (card.tag ? '  [' + T(card.tag) + ']' : '');
        setFont(true, head);
        doc.setFontSize(8.5);
        doc.setTextColor(25, 28, 30);
        doc.text(head, margin, y);
        y += 4;
        if (card.caption) {
          setFont(false, card.caption);
          doc.setFontSize(7.5);
          doc.setTextColor(116, 119, 125);
          var lines = doc.splitTextToSize(T(card.caption), pageW - margin * 2);
          doc.text(lines, margin, y);
          y += lines.length * 3.5 + 2;
        } else {
          y += 2;
        }
      });
    }

    // Footer
    var pageCount = doc.getNumberOfPages();
    for (var i = 1; i <= pageCount; i++) {
      doc.setPage(i);
      setFont(false);
      doc.setFontSize(7);
      doc.setTextColor(150, 153, 158);
      doc.text('© ' + new Date().getFullYear() + ' ALUMAX Architectural Envelopes Co., Ltd. · export@alumax-facade.com', margin, 292);
      doc.text('Page ' + i + ' / ' + pageCount, pageW - margin, 292, { align: 'right' });
    }
    return doc;
  }

  document.querySelectorAll('[data-datasheet-pdf]').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      btn.style.opacity = '0.6';
      btn.style.pointerEvents = 'none';
      loadFontB64().catch(function () { return null; }).then(function (b64) {
        var doc = buildPdf(b64);
        var filename = sanitize(DATA.product).toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '') + '-datasheet.pdf';
        doc.save(filename);
      }).finally(function () {
        btn.style.opacity = '';
        btn.style.pointerEvents = '';
      });
    });
  });
});
</script>
<?php
    endif;
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
        if (!empty($col['type']) && $col['type'] === 'image') {
            echo '<input type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="large-text alumax-media-input">';
            echo '<button type="button" class="button alumax-media-btn" style="margin-top:4px;">选择图片</button>';
        } elseif (!empty($col['type']) && in_array($col['type'], ['textarea', 'svg'], true)) {
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
      alumax_pp_field('眉标（如 The Product）', 'alumax_pp_intro[eyebrow]', $intro['eyebrow']);
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
        'image'     => ['label' => '图片（可上传）', 'width' => '26%', 'type' => 'image'],
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
        'image'     => ['label' => '图片（可上传）', 'width' => '24%', 'type' => 'image'],
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
        'image'     => ['label' => '图片（可上传）', 'width' => '22%', 'type' => 'image'],
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
        'image'     => ['label' => '图片（可上传）', 'width' => '20%', 'type' => 'image'],
        'image_alt' => ['label' => '图片描述', 'width' => '14%'],
        'caption'   => ['label' => '图注', 'width' => '16%'],
    ], $specs['side_cards'], '+ 添加图形卡');
    ?>

    <h4>安装方式模块（独立板块，显示在「产品细节」之后；标题留空则整模块不显示）</h4>
    <table class="form-table" style="max-width:960px;">
      <?php
      alumax_pp_field('眉标（如 Installation）', 'alumax_pp_specs[install_eyebrow]', $specs['install_eyebrow'] ?? '');
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
        'image'     => ['label' => '图片（可上传）', 'width' => '20%', 'type' => 'image'],
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
        'image'     => ['label' => '图片（可上传）', 'width' => '24%', 'type' => 'image'],
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
        'primary_label'  => 'Request a Quote', 'primary_url' => 'url',
        'secondary_label' => 'Download Datasheet', 'secondary_url'  => '#technical-specifications', 'secondary_icon' => 'download',
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

   
    $advantages = alumax_pp_collect('alumax_pp_advantages', ['eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea']);
    $advantages['cards'] = alumax_pp_collect_repeater('alumax_pp_advantages_cards', [
        'image' => 'url', 'image_alt' => 'text', 'icon' => 'text', 'title' => 'text', 'text' => 'textarea',
    ]);
    update_post_meta($post_id, 'alumax_pp_advantages', $advantages);

   
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

   
    $options = alumax_pp_collect('alumax_pp_options', ['eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea']);
    $options['cards'] = alumax_pp_collect_repeater('alumax_pp_options_cards', [
        'image' => 'url', 'image_alt' => 'text', 'svg' => 'svg', 'contain' => 'text', 'title' => 'text', 'text' => 'textarea',
    ]);
    update_post_meta($post_id, 'alumax_pp_options', $options);

   
    $palette = alumax_pp_collect('alumax_pp_palette', ['eyebrow' => 'text', 'title' => 'text', 'description' => 'textarea']);
    $palette['swatches'] = alumax_pp_collect_repeater('alumax_pp_palette_swatches', [
        'color' => 'text', 'name' => 'text', 'code' => 'text', 'bespoke' => 'text',
    ]);
    update_post_meta($post_id, 'alumax_pp_palette', $palette);

   
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
            'bg_image'       => '/wp-content/uploads/pre-insulated-wall-panels-hero-building.jpg',
            'title'          => 'Pre-Insulated Integrated<br>Wall Panels',
            'subtitle'       => 'Continuous Structural Insulation. Monumental Energy Efficiency. Class A Fire Rated.',
            'description'    => 'All-in-one prefabricated building envelope solution combining precision fluorocarbon metal facing with high-density non-combustible insulation core (PIR / PUR / Mineral Wool), eliminating cold bridges while drastically reducing on-site construction schedules.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
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
            'image'       => '/wp-content/uploads/pre-insulated-wall-panels-detail.jpg',
            'image_alt'   => 'Architectural facade detail of pre-insulated integrated metal wall panels showing clean joints and crisp metallic finish.',
            'video_label' => 'Watch Thermal Break Video',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Pre-Insulated Integrated Wall Panels?',
            'description' => 'Traditional multi-layer field-assembled envelopes rely on sequential site installation of mineral insulation, vapor barriers, air cavity substructures, and exterior metal rainscreens. ALUMAX Series PI-800 transforms this labor-intensive workflow into a factory-bonded, monolithic insulated composite panel engineered to withstand extreme environmental wind loads and thermal cycles.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Exterior Metal Skin', 'text' => 'PVDF / FEVE AA3003-H14 aluminum (0.8–1.5mm) or high-tensile galvanized steel (0.5–1.0mm).'],
                ['icon' => 'hvac', 'title' => 'Core Insulation Layer', 'text' => 'Continuous PUR / PIR foam injection or hydrophobic structural rock wool (45–120 kg/m³).'],
                ['icon' => 'join_inner', 'title' => 'Joint Technology', 'text' => 'Double labyrinth thermal break joint with co-extruded EPDM gaskets against capillary draw.'],
                ['icon' => 'apartment', 'title' => 'Engineered Scope', 'text' => 'Aviation terminals, high-rise towers, cleanrooms, refrigerated logistics & modular structures.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Pre-Insulated Integrated Wall Panels?',
            'description' => 'Engineered for international commercial architectural standards, delivering quantifiable energy savings, environmental comfort, and facade prestige.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/2026/11/pre-insulated-integrated-wall-panels-2-48d7a7ad.jpg',
                    'image_alt' => 'Thermal isolation facade panel installation.',
                    'icon'      => 'device_thermostat',
                    'title'     => 'Thermal Isolation',
                    'text'      => 'Continuous structural insulation core eliminates thermal bridging, cutting HVAC energy loss by up to 45% across extreme climates.',
                ],
                [
                    'image'     => '/wp-content/uploads/2026/11/pre-insulated-integrated-wall-panels-7-c8d65f52.jpg',
                    'image_alt' => 'Class A fire resistance cladding panel details.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Class A Fire Resistance',
                    'text'      => 'Non-combustible continuous mineral wool or PIR core certified to ASTM E84 & EN 13501-1, providing superior life-safety compliance.',
                ],
                [
                    'image'     => '/wp-content/uploads/2026/11/pre-insulated-integrated-wall-panels-8-06259b5d.jpg',
                    'image_alt' => 'Monolithic flatness high-end architectural facade.',
                    'icon'      => 'architecture',
                    'title'     => 'Monolithic Flatness',
                    'text'      => 'Precision automated roll-forming and tension-leveled facing panels ensure zero oil-canning with multiple shadow reveals and custom finishes.',
                ],
                [
                    'image'     => '/wp-content/uploads/2026/11/pre-insulated-integrated-wall-panels-11-ff7a618c.jpg',
                    'image_alt' => 'Fast-track erection interlocking panel seams.',
                    'icon'      => 'speed',
                    'title'     => 'Fast-Track Erection',
                    'text'      => 'Interlocking tongue-and-groove joint geometry accelerates on-site installation by over 60%, drastically cutting labor and scaffolding costs.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
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
                ['icon' => 'picture_as_pdf', 'label' => 'Download Spec Schedule (PDF)', 'url' => '#rfq-section', 'style' => 'primary'],
                ['icon' => 'architecture', 'label' => 'Request BIM (.RVT) / CAD (.DWG)', 'url' => '#rfq-section', 'style' => 'muted'],
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
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
            'install_description' => 'Engineered for swift dry installation without wet plaster or silicone façade caulking. Zero thermal bridge transmission via proprietary nylon-reinforced thermal breaks.',
            'install_note'        => 'Standard installation CAD details (DWG) and LOD 400 Revit families available on request.',
            'install_items'       => [
                [
                    'tag'   => 'METHOD 01 // SECRET-FIX',
                    'title' => 'Concealed Fastener T&G Interlock',
                    'text'  => 'Extended female flange conceals structural self-drilling bi-metal A2/A4 fasteners; each subsequent panel locks over the fixings for a seamless monolithic façade without exposed screw heads. Factory-integrated butyl mastic and PVC isolator strip.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-ff7a618c7e.jpg',
                    'image_alt' => 'Technical CAD blueprint showing secret-fix tongue and groove joint with hidden stainless steel fastener connecting pre-insulated panel to vertical aluminum runner.',
                ],
                [
                    'tag'   => 'METHOD 02 // THERMAL-BREAK',
                    'title' => 'Sub-Frame Thermal Decoupling Bracket',
                    'text'  => 'Heavy-gauge aluminum structural clips interface with the main building structure via 10mm high-density polyamide PA66 GF25 isolator shims, completely halting thermal conductance into interior slabs. Up to 6.2 kN per bracket, ±25mm adjustability in X, Y, Z axes.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-b06470bcd8.jpg',
                    'image_alt' => 'Engineering schematic of thermal break aluminum wall bracket connecting heavy insulated sandwich cladding to concrete slab edge with isolator pad.',
                ],
                [
                    'tag'   => 'METHOD 03 // CORNER & EXPANSION',
                    'title' => 'Mitered Flashing & EPDM Gasket',
                    'text'  => 'Prefabricated factory-bent 2.0mm PVDF aluminum corner units ensure sharp 90° architectural corners without site cutting. Complete weatherproofing via dual vulcanized EPDM compression gaskets backed by integrated internal weeping drainage paths.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-a32ed93d8c.jpg',
                    'image_alt' => 'Close-up of tongue and groove thermal break dry interlocking joint of pre-insulated metal cladding with EPDM gasket compression.',
                ],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
            'description' => 'Engineered face profiles configured to manipulate building shadows, structural flatness, and aesthetic rhythms. Fluorocarbon coil-coating tested under ASTM G154; custom RAL, Pantone, and metallic sheen matching available.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-c8d65f5262.jpg',
                    'image_alt' => 'Flat architectural reveal facade panel with crisp shadow gaps in pearl silver.',
                    'contain'   => '',
                    'title'     => 'Flat Architectural Reveal (FR-01)',
                    'text'      => 'Ultra-smooth exterior face with 15mm or 25mm shadow recess joints, engineered for monument towers demanding unblemished planar flatness.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-06259b5d66.jpg',
                    'image_alt' => 'Ribbed linear insulated metal cladding panel with continuous longitudinal flutes.',
                    'contain'   => '',
                    'title'     => 'Ribbed Linear Rhythm (RL-02)',
                    'text'      => 'Longitudinal extruded profile ribs providing dynamic light reflection while substantially boosting span deflection stiffness.',
                ],
                [
                    'image'     => '/wp-content/uploads/pre-insulated-option-micro-fluted-wave.jpg',
                    'image_alt' => 'Micro-fluted wave architectural metal wall panel surface profile in metallic champagne bronze finish.',
                    'contain'   => '',
                    'title'     => 'Micro-Fluted Wave (MF-03)',
                    'text'      => 'Subtle sinusoidal surface texture that masks structural oil-canning and micro-deflections over ultra-long unbraced spans up to 10 meters.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-bc60b7e9f2.jpg',
                    'image_alt' => 'Embossed stucco architectural metal cladding panel in dark graphite finish.',
                    'contain'   => '',
                    'title'     => 'Embossed Stucco Texture (ET-04)',
                    'text'      => 'Mechanical micro-embossed surface creating a soft diffuse sheen, ideal for high-traffic ground podiums and industrial logistics portals.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
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
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'View All Global Projects',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-17935b740d.jpg',
                    'image_alt' => 'Nordic research laboratory building with white and anthracite pre-insulated metal wall cladding.',
                    'location'  => 'OSLO, NORWAY',
                    'title'     => 'Oslo Science City Campus',
                    'product'   => 'Nordic Bioclimatic Research Center — 100mm PIR',
                    'area'      => 'Area: 18,500 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-75496f5922.jpg',
                    'image_alt' => 'High-tech logistics facility in Zurich Switzerland with silver metallic insulated panel facade.',
                    'location'  => 'ZURICH, SWITZERLAND',
                    'title'     => 'Kloten Automated Freight Hub',
                    'product'   => '120mm Rock Wool // EN A2-s1,d0',
                    'area'      => 'Area: 42,000 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-076ae6e20d.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
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
            'bg_image'       => '/wp-content/uploads/steel-wall-panels-hero.jpg',
            'title'          => 'Architectural Steel<br>Wall Panels',
            'subtitle'       => 'High-Tensile Substrates • 210 GPa Rigidity • Non-Combustible Class A1/A2 • Versatile Profiles',
            'description'    => 'Precision-engineered architectural steel wall panels combining high structural strength and rigidity with versatile profile designs and long-lasting protective finishes. Engineered for exterior rainscreens, curtain wall spandrels, interior architectural wall cladding, and high-impact commercial or civic envelopes.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'layers', 'title' => 'STEEL SUBSTRATES', 'text' => 'HDG Z275 / Galvalume / Cor-Ten / 316L'],
                ['icon' => 'compress', 'title' => '210 GPA RIGIDITY', 'text' => '3× stiffer than aluminum for large spans'],
                ['icon' => 'local_fire_department', 'title' => 'NON-COMBUSTIBLE', 'text' => 'EN 13501-1 Class A1/A2 / ASTM E84'],
                ['icon' => 'verified', 'title' => 'DURABLE COATINGS', 'text' => '70% PVDF / SMP / Powder (AAMA 2605)'],
            ],
        ],
        'intro' => [
            'image'       => '/wp-content/uploads/steel-wall-panels-detail.jpg',
            'image_alt'   => 'Macro engineering detail of precision-fabricated architectural steel wall panel cassette with brake-formed returns and slotted subframe mounting flange.',
            'video_label' => 'System Engineering // Substrates & Profiles',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Architectural Steel Wall Panels?',
            'description' => 'Architectural steel wall panels are engineered building envelope and wall cladding components fabricated from high-performance structural steel—including hot-dip galvanized steel, Galvalume (Aluzinc), weathering steel (Cor-Ten), and architectural stainless steel. Through precision CNC roll-forming, brake folding, and automated finishing, they achieve crisp architectural geometries, deep shadow reveals, and unmatched span flatness. Free of combustible organic core materials, they deliver superior wind-load resistance, high-traffic impact durability, and certified non-combustible fire protection for commercial, civic, and institutional architecture.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'High-Performance Steel Substrates', 'text' => 'Hot-dip galvanized (HDG Z275 / ASTM A653), Galvalume (AZ150), weathering steel (Cor-Ten A/B), and marine stainless steel (AISI 304/316L).'],
                ['icon' => 'view_quilt', 'title' => 'Versatile Profile Architectures', 'text' => 'Flat rainscreen cassettes, architectural box ribs, fluted shadow lines, sinusoidal wave profiles, and concealed-fastener interlocking seams.'],
                ['icon' => 'format_paint', 'title' => 'Factory Protective Coating Systems', 'text' => 'Continuous coil-coated 70% PVDF Kynar 500®, silicone-modified polyester (SMP), architectural powder coating, and natural Cor-Ten patina.'],
                ['icon' => 'apartment', 'title' => 'Engineered Commercial & Civic Scope', 'text' => 'Civic centers, railway and metro concourses, corporate headquarters, cultural pavilions, sports arenas, and exterior rainscreen retrofits.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Architectural Steel Wall Panels?',
            'description' => 'Engineered to meet stringent international building standards (ASTM, EN, CWCT), delivering quantifiable structural rigidity, corrosion barrier protection, and non-combustible life safety.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/steel-option-flat-cassette.jpg',
                    'image_alt' => 'Wide-span monolithic architectural steel cassette panels showing flawless optical flatness without oil-canning.',
                    'icon'      => 'compress',
                    'title'     => '210 GPa Elastic Modulus & Superior Rigidity',
                    'text'      => 'With an elastic modulus of 210 GPa—three times the stiffness of aluminum (70 GPa)—steel wall panels resist deflection and prevent oil-canning across wide module spans under high design wind pressures.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-7434f36741.jpg',
                    'image_alt' => 'Coated galvanized steel and Cor-Ten weathering steel facade samples demonstrating high-durability surface finishes.',
                    'icon'      => 'shield',
                    'title'     => 'Multi-Layer Weathering & Corrosion Protection',
                    'text'      => 'Heavy-duty metallic zinc/aluzinc alloy barriers paired with factory-cured multi-coat PVDF and SMP systems provide up to 4,000+ hours salt spray endurance under ASTM B117 and ISO 9227 C5-M ratings.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-ce43269d0d.jpg',
                    'image_alt' => 'Engineered subframe anchor mounting heavy-duty non-combustible architectural steel facade panels.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Non-Combustible Fire Life Safety',
                    'text'      => 'Solid single-sheet steel construction delivers inherently non-combustible performance with 0 flame spread index and zero smoke development, strictly conforming to EN 13501-1 Class A1/A2 and ASTM E84 Class A.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-9a19ae2239.jpg',
                    'image_alt' => 'Prestigious civic cultural pavilion clad in sustainable metallic architectural steel wall panels.',
                    'icon'      => 'recycling',
                    'title'     => '100% Recyclable & Sustainable Lifecycle',
                    'text'      => 'Steel is a circular building envelope material that can be infinitely recycled without loss of structural integrity, offering high recycled content, low whole-life carbon potential, and exceptional service life.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
            'table_title' => 'Architectural Steel Wall Panel Engineering Specifications',
            'table_ref'   => 'SPEC-ALU-ST7000-REV2026',
            'rows'        => [
                ['name' => 'Substrate Materials', 'value' => 'Hot-Dip Galvanized (HDG Z180–Z275 / DX51D), Galvalume (AZ150), Cor-Ten Weathering Steel, or Stainless Steel (AISI 304/316)', 'mono' => ''],
                ['name' => 'Sheet Gauge / Thickness', 'value' => '0.8mm – 3.0mm (standard gauges: 1.0mm, 1.2mm, 1.5mm, 2.0mm, 3.0mm)', 'mono' => '1'],
                ['name' => 'Effective Panel Width', 'value' => '300mm – 1,200mm (tailored to selected profile and structural wind grid)', 'mono' => '1'],
                ['name' => 'Continuous Panel Length', 'value' => '1,000mm – 8,000mm single-span continuous modules', 'mono' => '1'],
                ['name' => 'Modulus of Elasticity', 'value' => '210 GPa (300% greater flexural rigidity than architectural aluminum)', 'mono' => '1'],
                ['name' => 'Surface Coating Systems', 'value' => '70% PVDF Kynar 500® (≥25μm), SMP, Super-Durable Powder (60–80μm), or Cor-Ten patina', 'mono' => ''],
                ['name' => 'Reaction to Fire', 'value' => 'Class A1 / A2-s1,d0 Non-Combustible (EN 13501-1 / ASTM E84 Class A flame spread 0)', 'mono' => ''],
                ['name' => 'Design Wind Load Resistance', 'value' => 'Up to 5.5 kPa design pressure tested to L/300 deflection limit (ASTM E330 / CWCT Class 1)', 'mono' => '1'],
                ['name' => 'Hard Body Impact Resistance', 'value' => 'Class IV Impact — passes 10 Joule steel sphere drop without indentation (EN 14019 / ASTM E695)', 'mono' => '1'],
                ['name' => 'Corrosion Endurance', 'value' => 'Up to 4,000+ hrs salt spray with zero blistering — ISO 9227 C5-M / ASTM B117', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Download Product Datasheet (PDF)', 'url' => '#', 'style' => 'primary'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Profile Depth',
                    'tag'       => '25 – 120 MM',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Formed cassette depths and roll-formed rib depths engineered for structural dead-load and wind requirements.',
                ],
                [
                    'title'     => 'Continuous Span',
                    'tag'       => 'UP TO 8,000 MM',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Single-piece panel lengths up to 8 meters eliminate intermediate horizontal joints for clean monumental facades.',
                ],
                [
                    'title'     => 'Elastic Modulus',
                    'tag'       => '210 GPA',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'High stiffness to mass ratio permits thinner gauges with superior planarity and zero oil-canning.',
                ],
            ],
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
            'install_description' => 'Three engineered mounting typologies accommodate thermal expansion, dynamic seismic drift, and swift jobsite assembly across varied structural framing configurations.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'SYS-01 // CONCEALED',
                    'title' => 'Concealed-Fastener Interlocking System',
                    'text'  => 'Self-aligning tongue-and-groove joint profile with concealed stainless steel clip fasteners hidden within the joint recess, providing a seamless screw-free facade with 15mm shadow reveal.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/steel-option-concealed-fastener.jpg',
                    'image_alt' => 'Close-up detail of concealed-fastener interlocking steel wall panel joint with hidden fasteners.',
                ],
                [
                    'tag'   => 'SYS-02 // HOOK-ON',
                    'title' => 'Heavy-Duty Hook-On Rainscreen Cassette System',
                    'text'  => 'Continuous rear top hook tabs with integral EPDM anti-vibration isolators engage onto horizontal subframe rails for rapid progressive installation and individual panel demountability.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-575ee5315c.jpg',
                    'image_alt' => 'Technical drawing of heavy-duty hook-on steel cassette facade fixing system with vertical mullion brackets.',
                ],
                [
                    'tag'   => 'SYS-03 // EXPOSED',
                    'title' => 'Precision Exposed Fastener Cladding System',
                    'text'  => 'Engineered direct-to-subframe fastening utilizing color-matched corrosion-resistant screws with vulcanized EPDM washers for cost-effective, high-wind industrial and commercial envelopes.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-ce43269d0d.jpg',
                    'image_alt' => 'Engineered mechanical fixing substructure for architectural steel wall panel facade.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Durable Coating Systems & Architectural Finishes',
            'description' => 'High-performance factory-cured coatings engineered for superior color retention, UV resistance, and severe atmospheric protection—available in standard architectural finishes and custom RAL matching.',
            'swatches'    => [
                ['color' => '#2B303A', 'name' => 'Matte Graphite', 'code' => '3-Coat PVDF 35µm', 'bespoke' => ''],
                ['color' => '#8A4B2E', 'name' => 'Cor-Ten Rust Patina', 'code' => 'Stabilized Weathering Steel', 'bespoke' => ''],
                ['color' => '#A88B68', 'name' => 'Champagne Bronze', 'code' => 'PVDF Metallic 30µm', 'bespoke' => ''],
                ['color' => '#9CA3AF', 'name' => 'Titanium Silver', 'code' => 'Galvalume Clear Coat', 'bespoke' => ''],
                ['color' => '#1E2228', 'name' => 'Charcoal Black', 'code' => 'Super-Durable Powder', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Match', 'code' => 'Custom RAL / NCS', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Panel Profiles & Customization',
            'title'       => 'Versatile Architectural Profiles & Custom Geometries',
            'description' => 'From flat ventilated cassettes to rhythmic box ribs and undulating wave profiles, our automated roll-forming and CNC brake-folding lines produce diverse architectural expressions.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/steel-option-flat-cassette.jpg',
                    'image_alt' => 'Architectural flat cassette steel wall panel with sharp 90 degree returns and crisp reveal joints.',
                    'contain'   => '',
                    'title'     => 'Architectural Flat Cassette Panels',
                    'text'      => 'CNC brake-formed monolithic rainscreen cassettes with 90° returns and clean reveal joints, delivering optical flatness and structural crispness for landmark civic and commercial facades.',
                ],
                [
                    'image'     => '/wp-content/uploads/steel-option-box-rib.jpg',
                    'image_alt' => 'Vertical box-rib architectural steel wall panels on a contemporary commercial facade.',
                    'contain'   => '',
                    'title'     => 'Architectural Box-Rib & Fluted Panels',
                    'text'      => 'Precision roll-formed trapezoidal box ribs and fluted shadow reveals that produce bold vertical or horizontal rhythms, enhancing facade depth and structural longitudinal stiffness.',
                ],
                [
                    'image'     => '/wp-content/uploads/steel-option-wave-corrugated.jpg',
                    'image_alt' => 'Horizontal sinusoidal wave corrugated steel wall panels on modern commercial elevation.',
                    'contain'   => '',
                    'title'     => 'Sinusoidal Corrugated Wave Panels',
                    'text'      => 'Continuous sinusoidal wave profiles roll-formed for dynamic light and shadow gradients, ideal for feature facades, transit terminals, and expansive commercial envelopes.',
                ],
                [
                    'image'     => '/wp-content/uploads/steel-option-concealed-fastener.jpg',
                    'image_alt' => 'Concealed-fastener interlocking architectural steel wall panel with flush reveal joint.',
                    'contain'   => '',
                    'title'     => 'Concealed-Fastener Interlocking Panels',
                    'text'      => 'Tongue-and-groove interlocking side joints with hidden fastener clips, providing a clean screw-free exterior appearance with 15mm crisp shadow reveal joints.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'View All Completed Case Studies',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-c3388ec64e.jpg',
                    'image_alt' => 'London Crossrail Station subsurface terminal clad in monolithic PVDF steel wall panels with deep architectural reveal joints.',
                    'location'  => 'UNITED KINGDOM',
                    'title'     => 'London Metro Concourse & Tunnel Portals',
                    'product'   => '3.0mm galvanized steel cassettes // Class IV impact certified',
                    'area'      => 'Area: 18,400 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-cf29ed29b1.jpg',
                    'image_alt' => 'Contemporary research center in Berlin with oxidized Cor-Ten weathering steel facade cladding and deep window reveals.',
                    'location'  => 'GERMANY',
                    'title'     => 'Berlin Technology Institute & Labs',
                    'product'   => 'Stabilized Cor-Ten weathering rainscreen // thermal relief channels',
                    'area'      => 'Area: 12,000 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-9a19ae2239.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
            'description'  => 'Submit your project drawings, profile preferences, or wind-load specifications. Our technical facade team delivers preliminary engineering calculations and sample kits within 24 business hours.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H ENGINEERING RESPONSE',
            'submit_label' => 'Submit RFQ Package & Request Sample Kit',
            'bullets'      => [
                ['icon' => 'inventory_2', 'title' => 'Custom Steel Sample Kit', 'text' => 'Physical finish and profile mock-ups dispatched via DHL Express with mill test certificates.'],
                ['icon' => 'deployed_code', 'title' => 'FEA Wind-Load Analysis', 'text' => 'Structural wind-load deflection calculations and FEA stress analysis report.'],
                ['icon' => 'payments', 'title' => 'Direct Factory Export Pricing', 'text' => 'Competitive FOB / CIF quotation based on project quantity and schedule.'],
            ],
            'products'     => [
                ['label' => 'Architectural Steel Wall Panels'],
                ['label' => 'Solid Aluminum Cladding Panels'],
                ['label' => 'Pre-Insulated Integrated Wall Panels'],
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
            'bg_image'       => '/wp-content/uploads/solid-aluminum-cladding-hero-building.jpg',
            'title'          => 'Solid Aluminum<br>Cladding Panels',
            'subtitle'       => 'Monolithic 3003/5052 Alloy. A2-s1,d0 Non-Combustible. 30-Year Architectural Coating.',
            'description'    => 'Engineered brake-formed solid aluminum rainscreen cassettes for monumental facades, high-wind envelopes, and demanding non-combustible architectural specifications. Zero combustible core. Spec ID: ALU-SLD-3003.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'aspect_ratio', 'title' => 'MAX SHEET 2,200×6,000 MM', 'text' => 'Monolithic single-piece panels for expansive structural spans.'],
                ['icon' => 'layers', 'title' => 'AA3003-H24 / AA5052-H32', 'text' => 'Commercial architectural & marine-grade alloy substrates.'],
                ['icon' => 'local_fire_department', 'title' => 'A2-S1,D0 NON-COMBUSTIBLE', 'text' => 'EN 13501-1 & ASTM E84 Class A flame spread index 0.'],
                ['icon' => 'verified', 'title' => '30-YEAR COATING WARRANTY', 'text' => 'AAMA 2605 tested 70% Kynar 500® PVDF fluoropolymer.'],
            ],
        ],
        'intro' => [
            'image'       => '/wp-content/uploads/alumax-img-90f3d1d315.jpg',
            'image_alt'   => 'Completed architectural building facade clad in solid aluminum rainscreen cassette panels.',
            'video_label' => 'Exploded Cassette Assembly & 3D BIM Viewer',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Solid Aluminum Cladding Panels?',
            'description' => 'ALUMAX solid aluminum cladding panels are CNC brake-formed from single-sheet monolithic alloy plate — completely eliminating composite core materials, combustible bonding adhesives, and delamination risks. Engineered for exterior rainscreen facades, monumental soffits, column covers, entrance portals, and high-traffic interior public transit hubs, our solid cassettes deliver supreme optical flatness, Class A2 fire resistance, and full demountability for lifetime building maintenance.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Monolithic Alloy Substrates', 'text' => 'AA3003-H24 commercial standard and AA5052-H32 marine grade for severe coastal salt spray, compliant with ASTM B209M and EN 1396.'],
                ['icon' => 'straighten', 'title' => 'Structural Calibers', 'text' => 'Available in 2.0mm (soffits & interiors), 2.5mm (standard facades), 3.0mm (high-wind towers), and 4.0mm (oversized monumental spans).'],
                ['icon' => 'format_paint', 'title' => 'Coating Technologies', 'text' => 'PPG Duranar® 3-coat 70% PVDF (AAMA 2605), AkzoNobel Interpon® D3000 architectural powder, Class I hard anodizing, and stone sublimation.'],
                ['icon' => 'handyman', 'title' => 'Project Engineering', 'text' => 'Comprehensive project-based customization: parametric shop drawings, wind-load FEA calculations, and factory-welded stiffener ribs.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Solid Aluminum Cladding Panels?',
            'description' => 'Engineered to meet the stringent static, seismic, and fire-life-safety demands of global commercial towers, transit terminals, and monumental civic architecture.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-3b318d4319.jpg',
                    'image_alt' => 'Stud and joint rigidity detail of brake-formed aluminum cassette.',
                    'icon'      => 'air',
                    'title'     => '5.2 kPa Wind Tolerance',
                    'text'      => '3.0mm cassettes sustain up to 5.2 kPa design wind pressure with zero permanent deformation at 150% safety margin — super-tower certified under ASTM E330 & EN 12179.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-d7f40a8de9.jpg',
                    'image_alt' => '3D exploded view of solid aluminum cassette panel assembly.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'A2-s1,d0 Non-Combustible',
                    'text'      => '100% solid aluminum construction with 0 flame spread index and zero toxic smoke development — strictly non-combustible under EN 13501-1 and ASTM E84 Class A.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-c233c4813a.jpg',
                    'image_alt' => 'Close-up of PVDF fluoropolymer coating texture on aluminum panel.',
                    'icon'      => 'format_paint',
                    'title'     => '30-Year Exterior Weatherability',
                    'text'      => 'PPG Duranar® 3-coat PVDF and D3000 powder finishes preserve gloss and resist chalking for over 30 years; AAMA 2605 10-year South Florida exposure verified with ΔE < 3.0.',
                ],
                [
                    'image'     => '/wp-content/uploads/solid-advantage-marine-coastal.jpg',
                    'image_alt' => 'Modern coastal pavilion facade with marine-grade solid aluminum cladding panels.',
                    'icon'      => 'sailing',
                    'title'     => 'Marine-Grade Corrosion Immunity',
                    'text'      => 'ASTM B117 4,000-hour salt spray tested with zero blistering and creep < 1mm; marine-grade AA5052-H32 alloy specifically qualified for offshore salt air and coastal ports.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
            'table_title' => 'ALU-SLD-3003 Comprehensive Engineering Matrix',
            'table_ref'   => 'SPEC REF: ASTM B209M // EN 1396 // AAMA 2605',
            'rows'        => [
                ['name' => 'Aluminum Alloy Substrates', 'value' => 'AA3003-H24 (Standard Architectural) / AA5052-H32 (Marine Coastal)', 'mono' => ''],
                ['name' => 'Temper Condition', 'value' => 'H14 / H24 (AA3003) ｜ H32 (AA5052)', 'mono' => '1'],
                ['name' => 'Standard Panel Thickness', 'value' => '2.0mm (Soffit/Interior) ｜ 2.5mm (Standard) ｜ 3.0mm (Heavy-Duty) ｜ 4.0mm (Mega-Span)', 'mono' => '1'],
                ['name' => 'Maximum Panel Dimensions', 'value' => 'Width up to 2,200 mm ｜ Length up to 6,000 mm (Monolithic Single-Piece)', 'mono' => '1'],
                ['name' => 'Panel Geometry Formats', 'value' => 'Flat Cassettes, Single-Radius Curved, Hyperbolic 3D, CNC Perforated', 'mono' => ''],
                ['name' => 'Fabrication Technologies', 'value' => 'CNC Turret Punching, Laser Cutting, 3D Brake Forming, Robotic TIG Stud Welding', 'mono' => ''],
                ['name' => 'Fire Reaction Classification', 'value' => 'Class A2-s1,d0 (EN 13501-1) ｜ Flame Spread Index 0 (ASTM E84 Class A)', 'mono' => ''],
                ['name' => 'Wind Load Sustained Pressure', 'value' => '2.5mm: 3.8 kPa ｜ 3.0mm: 5.2 kPa Super-Tower (ASTM E330 / EN 12179)', 'mono' => '1'],
                ['name' => 'Tensile Strength (Rm)', 'value' => '145–180 MPa (AA3003-H24) ｜ 215–265 MPa (AA5052-H32)', 'mono' => '1'],
                ['name' => 'Yield Strength (Rp0.2)', 'value' => '≥ 115 MPa (AA3003-H24) ｜ ≥ 160 MPa (AA5052-H32)', 'mono' => '1'],
                ['name' => 'Elongation at Break (A50)', 'value' => '≥ 8% (AA3003) ｜ ≥ 10% (AA5052)', 'mono' => '1'],
                ['name' => 'Surface Coating Systems', 'value' => '3-Coat 70% PVDF (35μm), Architectural Powder (60-80μm), Class I Anodized (25μm)', 'mono' => ''],
                ['name' => 'Salt Spray Resistance', 'value' => 'ASTM B117 4,000h: Zero blistering, scribe creep < 1.0mm (3.0mm < 0.5mm)', 'mono' => ''],
                ['name' => 'Color & Gloss Retention', 'value' => 'AAMA 2605 10-Yr Florida: ΔE < 3.0 Hunters, Gloss Retention > 80%', 'mono' => '1'],
                ['name' => 'Acoustic Transmission Loss', 'value' => 'Rw 28 dB (2.5mm) ｜ Rw 32 dB (3.0mm) ｜ Up to 48 dB with insulated back-pan', 'mono' => '1'],
                ['name' => 'Mounting Typologies', 'value' => 'Open-Joint Drained (TYPE 01), Weatherproof Sealed (TYPE 02), Hook-On Cassette (TYPE 03)', 'mono' => ''],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Download Product Datasheet (PDF)', 'url' => '#', 'style' => 'primary'],
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
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
            'install_description' => 'Three engineered fixing typologies with comprehensive CAD/BIM elevation detail packages. Each system accommodates project wind-load criteria, thermal movement tolerances, and specific building movement requirements.',
            'install_note'        => 'Engineering Note: System selection and bracket spacing are determined by project wind load calculations (ASTM E330), panel thickness, and building height. All mounting brackets incorporate 6mm slotted oval holes to accommodate aluminum thermal expansion (2.4 mm/m at ΔT 100°C).',
            'install_items'       => [
                [
                    'tag'   => 'TYPE 01 // OPEN-JOINT',
                    'title' => 'Open-Joint Ventilated Rainscreen',
                    'text'  => '12mm dry open shadow reveals without exposed silicone. Pressure-equalized cavity drains condensate instantly, preventing facade staining and dust streaks. Substructure: extruded 6063-T6 aluminum mullions.',
                    'svg'   => '', 'image' => '/wp-content/uploads/solid-install-open-joint.jpg', 'image_alt' => 'Open-joint ventilated rainscreen solid aluminum cassette facade detail.',
                ],
                [
                    'tag'   => 'TYPE 02 // SEALED-JOINT',
                    'title' => 'Weatherproof Sealed Joint',
                    'text'  => 'Classic watertight envelope using non-staining structural silicone over closed-cell PE backer rod, providing maximum air-impermeability and acoustic attenuation on galvanized steel tube or aluminum angle subframing.',
                    'svg'   => '', 'image' => '/wp-content/uploads/solid-install-sealed-joint.jpg', 'image_alt' => 'Weatherproof sealed joint solid aluminum cladding cassette system.',
                ],
                [
                    'tag'   => 'TYPE 03 // HOOK-ON',
                    'title' => 'High-Rise Hook-On Cassette',
                    'text'  => 'Modular interlocking hung brackets designed for expedited crane-assisted exterior erection up to 150m² per team per day. Neoprene anti-rattle bushings with each cassette individually demountable for utility maintenance.',
                    'svg'   => '', 'image' => '/wp-content/uploads/solid-install-hook-on.jpg', 'image_alt' => 'High-rise hook-on solid aluminum cassette facade panel installation.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
            'description' => 'Formulated to withstand harsh UV exposure, coastal marine salt atmosphere, and aggressive industrial environments. Choose from AAMA 2605 compliant PPG Duranar® 70% Kynar 500® PVDF, AkzoNobel Interpon® D3000 hyper-durable powder, Class I hard anodizing, and architectural sublimation faux stone/wood.',
            'swatches'    => [
                ['color' => '#927B5E', 'name' => 'Champagne Bronze', 'code' => 'Duranar® Sunstorm // PVDF', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Mica Anthracite', 'code' => 'RAL 7016 // PVDF', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Silver Metallic', 'code' => 'RAL 9006 // PVDF', 'bespoke' => ''],
                ['color' => '#F1F3F5', 'name' => 'Pure White', 'code' => 'RAL 9016 // Architectural Powder', 'bespoke' => ''],
                ['color' => '#7B6955', 'name' => 'Architectural Bronze', 'code' => 'Class I Anodized 25μm', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Color Match', 'code' => 'RAL+ / NCS / Stone & Wood Sublimation', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
            'description' => 'Every architectural project demands unique spatial geometry. We manufacture tailored solid aluminum cladding panels strictly engineered to project elevations and BIM models — encompassing custom dimensions, roll-bent curves, CNC acoustic perforations, 3D parametric cassettes, and engineered subframe brackets.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/solid-option-brake-formed-cassette.jpg',
                    'image_alt' => 'Precision brake-formed solid aluminum rainscreen cladding cassette panel.',
                    'contain'   => '',
                    'title'     => 'Brake-Formed Rainscreen Cassettes',
                    'text'      => 'Precision 4-side brake-formed box panels with mitered welded corners and factory-bonded channel stiffeners every 500mm to eliminate optical oil-canning across monumental curtain walls.',
                ],
                [
                    'image'     => '/wp-content/uploads/solid-option-curved-parametric.jpg',
                    'image_alt' => 'Curved and hyperbolic double-curved solid aluminum cladding panels.',
                    'contain'   => '',
                    'title'     => 'Curved & Roll-Bent Profiles',
                    'text'      => 'Precision roll-bent single-radius and conical cassettes delivering smooth, fluid facade transitions with continuous shadow reveals for rounded building corners, column covers, and canopies.',
                ],
                [
                    'image'     => '/wp-content/uploads/solid-option-perforated-cnc.jpg',
                    'image_alt' => 'Close-up of exterior solid aluminum cladding panels with CNC laser-cut decorative perforation patterns.',
                    'contain'   => '',
                    'title'     => 'Architectural CNC Perforations',
                    'text'      => 'Custom decorative and acoustic perforation motifs engineered for solar control, facade ventilation, and dramatic night backlighting with zero structural edge distortion.',
                ],
                [
                    'image'     => '/wp-content/uploads/solid-option-3d-parametric.jpg',
                    'image_alt' => 'Sculptural 3D geometric faceted aluminum facade envelope.',
                    'contain'   => '',
                    'title'     => '3D Parametric & Prismatic Facets',
                    'text'      => 'Folded geometric pyramidal and hyperbolic diamond cassettes creating dynamic sculptural chiaroscuro light-and-shadow variations across signature landmark envelopes.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'View Complete Portfolio Archive',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-56005ccf27.jpg',
                    'image_alt' => 'DIFC North Commercial Tower in Dubai with champagne solid aluminum cassette facade.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'DIFC North Commercial Tower',
                    'product'   => '3.0mm AA3003-H24 // Duranar® Sunstorm Champagne',
                    'area'      => 'Area: 35,000 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-2d6420d22e.jpg',
                    'image_alt' => 'Changi Aviation Expansion Concourse in Singapore with marine grade aluminum panels.',
                    'location'  => 'SINGAPORE, SG',
                    'title'     => 'Changi Aviation Expansion Concourse',
                    'product'   => '2.5mm AA5052-H32 Marine Grade // Interpon D3000',
                    'area'      => 'Area: 22,000 m²',
                    'year'      => 'Year: 2022',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-e9318e18ba.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
            'description'  => 'Submit your architectural drawings, tender schedules, dimensions, or wind load criteria. Our engineering department will respond with a tailored specification, preliminary structural calculations, and quotation within 24 hours.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H ENGINEERING RESPONSE',
            'submit_label' => 'Submit Inquiry & Request Pricing',
            'bullets'      => [
                ['icon' => 'upload_file', 'title' => 'Upload CAD / BIM Drawings', 'text' => 'We accept .DWG, .DXF, .RVT, and 3D Rhino facade packages for quotation.'],
                ['icon' => 'architecture', 'title' => 'Share Project Specifications', 'text' => 'Specify panel calibers (2.0–4.0mm), alloy grade, finish, wind codes, and reveal dimensions.'],
                ['icon' => 'verified', 'title' => 'Get Factory-Direct Engineering', 'text' => 'Receive comprehensive BOQ cost estimate, 3D subframe details, and structural calculation reports.'],
            ],
            'products'     => [
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Smart Motorized Louvers'],
                ['label' => 'Honeycomb Panels'],
            ],
        ],
    ];
}
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
            'bg_image'       => '/wp-content/uploads/alumax-img-1a00bef908.jpg',
            'title'          => 'Fire-Retardant Aluminum<br>Composite Panels',
            'subtitle'       => 'A2/B1 Mineral Core. 3-Coat PVDF 35μm. Zero Oil-Canning Flatness.',
            'description'    => 'Engineered architectural composite material (ACM) pairing high-tensile 3003-H14 aluminum coil skins with non-combustible mineral-filled cores. Precision-bonded through continuous automated thermal lamination for mega-span curtain walls, retail pavilions, and high-wind transport hubs. Code: ALU-ACP-1000.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
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
            'image'       => '/wp-content/uploads/alumax-img-e3771b326e.jpg',
            'image_alt'   => 'Cutaway rendering of fire-retardant aluminum composite panel ALU-ACP-1000 with 0.5mm AA3003 skin, mineral core and adhesive layers.',
            'video_label' => '360° Inspect // FR Core Cutaway',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Fire-Retardant Aluminum Composite Panels?',
            'description' => 'Continuous hot-melt lamination bonds coil-coated aluminum skins to a mineral-filled core under 190°C–210°C calendering, with in-line ultrasonic resonance checks every 10 meters — ensuring zero delamination risk across harsh maritime and desert thermal cyclings.',
            'features'    => [
                ['icon' => 'local_fire_department', 'title' => 'Mineral Core Fire Rating', 'text' => 'FR-A2 ≥90% mineral non-combustible (EN 13501 A2) / FR-B1 mineral-filled flame retardant.'],
                ['icon' => 'straighten', 'title' => 'Total Panel Thickness', 'text' => '3.0mm interior / 4.0mm facade standard / 5.0mm high-rise / 6.0mm structural.'],
                ['icon' => 'layers', 'title' => 'Aluminum Alloy Skin', 'text' => '0.30mm light / 0.40mm standard exterior / 0.50mm AA3003-H14 heavy-duty, top & back.'],
                ['icon' => 'format_paint', 'title' => 'Surface Finish Tech', 'text' => 'PVDF Kynar 500® 3-coat 35μm, Lumiflon® FEVE high-gloss, nano self-cleaning, chameleon optical.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Fire-Retardant Aluminum Composite Panels?',
            'description' => 'Intertek, SGS, and TÜV Rheinland verified — engineered for international commercial architectural standards with quantifiable fire safety and fabrication performance.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-a5912e182a.jpg',
                    'image_alt' => 'High-density A2 fire-rated mineral core cross section of aluminum composite material.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Non-Combustible A2 Core',
                    'text'      => '≥90% inorganic hydroxide core releases bound hydration at >340°C, self-extinguishing flame propagation — EN 13501 A2-s1,d0 & NFPA 285 passed.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-5a790d939b.jpg',
                    'image_alt' => 'Curved column wraps and soffits fabricated from flexible 4mm aluminum composite panels.',
                    'icon'      => 'architecture',
                    'title'     => 'Cold-Formable to R300',
                    'text'      => 'Elastomeric polymeric adhesive prevents core-skin shear delamination at cold radii as tight as R ≥ 300mm on 4.0mm panels — columns, soffits, origami cassettes.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-e5199a92a7.jpg',
                    'image_alt' => 'Material swatch library of champagne bronze, chameleon pearlescent and high-gloss ACP finishes.',
                    'icon'      => 'format_paint',
                    'title'     => 'FEVE / PVDF Coating Library',
                    'text'      => 'Kynar 500® 3-coat, Lumiflon® FEVE 80% gloss, nano self-cleaning and chameleon angle-shift finishes — ΔE ≤ 0.5 batch color uniformity.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-d3fcf20382.jpg',
                    'image_alt' => 'CNC router cutting precision 90-degree V-groove on aluminum composite panel for cassette fabrication.',
                    'icon'      => 'precision_manufacturing',
                    'title'     => 'Site-Friendly Fabrication',
                    'text'      => 'Rapid routing, 90°/135° V-grooving and cassette folding with conventional CNC or handheld grooving equipment — without micro-fracturing the outer coating.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
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
                ['icon' => 'picture_as_pdf', 'label' => 'Brochure (PDF 5.2MB)', 'url' => '#rfq-section', 'style' => 'primary'],
                ['icon' => 'view_in_ar', 'label' => 'BIM / CAD LOD 400', 'url' => '#rfq-section', 'style' => 'muted'],
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
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
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
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
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
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
            'description' => 'ALUMAX composite panels support rapid site routing, cassette returns, and cold roll-forming with conventional CNC or handheld grooving equipment without micro-fracturing the outer coating.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-5d4d97b938.jpg',
                    'image_alt' => 'Technical schematic of CNC router bit milling 90-degree V-groove through ACP back skin and mineral core.',
                    'contain'   => '',
                    'title'     => '90° & 135° V-Groove Milling (01 // MILLING)',
                    'text'      => 'Route a V-groove on the rear face leaving 0.5–0.8mm of mineral core intact alongside the outer skin; hand-fold into crisp architectural cassettes with zero paint crazing. Feed 15–25 m/min, cutter tip R1.5–R2.0mm.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-87fcdfd828.jpg',
                    'image_alt' => 'Three-roll pyramid plate bending machine shaping a 4mm aluminum composite panel into column cladding radius.',
                    'contain'   => '',
                    'title'     => 'Roll-Bending for Columns (02 // COLD BENDING)',
                    'text'      => 'Continuous architectural curves on precision 3-roller pyramid bending machines; minimum curvature R = 300mm on 4.0mm panels with polished or urethane-coated rollers.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-ad5656e7c1.jpg',
                    'image_alt' => 'Cross-section drawing of ACP cassette hung on extruded aluminum top-hat mullion with stainless rivets and EPDM gasket.',
                    'contain'   => '',
                    'title'     => 'Cassette Hanging & Top-Hat Subframe (03 // FIXING)',
                    'text'      => 'Routed folded cassettes fixed to 6063-T6 extruded subframes with slotted holes for thermal expansion; 15–20mm reveals with neutral silicone or open rainscreen jointing.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'View All 180+ Project References',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-1a00bef908.jpg',
                    'image_alt' => 'Luxury commercial pavilion in Milan Design District clad in champagne gold iridescent ACP.',
                    'location'  => 'MILAN, ITALY',
                    'title'     => 'Milan Design District Pavilion',
                    'product'   => 'Chameleon pearlescent FEVE // origami cassettes',
                    'area'      => 'Area: 18,500 m²',
                    'year'      => 'Rating: EN 13501 A2',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-a49023328f.jpg',
                    'image_alt' => 'High-rise shopping mall podium in Singapore Orchard Road with ultra-flat dark graphite ACP cladding.',
                    'location'  => 'ORCHARD ROAD, SG',
                    'title'     => 'Orchard Central Commercial Atrium',
                    'product'   => 'Nano self-cleaning PVDF // monsoon-proof',
                    'area'      => 'Area: 24,000 m²',
                    'year'      => 'Finish: Nano PVDF',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-e5c114973e.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
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
            'bg_image'       => '/wp-content/uploads/alumax-img-5e55ea6648.jpg',
            'title'          => 'Hexagonal Honeycomb<br>Composite Panels',
            'subtitle'       => 'Aerospace-Grade Core. ±6.5 kPa Typhoon Class. Zero Oil-Canning Monolithic Flatness.',
            'description'    => 'Continuous roll-bonded sandwich composite engineered for extreme wind pressure, high-rise building envelopes, and monolithic visual flatness. At only 6.85 kg/m² with 19.2 cm³/m section modulus. System ref: ALU-HC-5000.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
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
            'image'       => '/wp-content/uploads/alumax-img-fa920e6e74.jpg',
            'image_alt'   => '3D technical cross-section render of aluminum honeycomb composite panel ALU-HC-5000 with hexagonal core foil bonded between AA3003 alloy skins.',
            'video_label' => 'Core Cutaway // 3D BIM LOD-400',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Hexagonal Honeycomb Composite Panels?',
            'description' => 'Aerospace-derived hexagonal foil core is continuously roll-bonded between coil-coated aluminum skins with DuPont polyurethane hot-melt, producing an ultra-flat, ultra-light sandwich panel that outperforms solid plate on rigidity, acoustics, and fire behavior.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Facing Alloy Grade', 'text' => 'AA3003-H24 high tensile standard / AA5052-H32 marine coastal anti-corrosion.'],
                ['icon' => 'straighten', 'title' => 'Composite Thickness', 'text' => '10 / 15 / 20mm (high-rise standard) / 25 / 50mm total build-ups.'],
                ['icon' => 'hexagon', 'title' => 'Core Foil & Bonding', 'text' => '0.05–0.08mm hexagonal foil with DuPont polyurethane epoxy hot-melt bonding.'],
                ['icon' => 'format_paint', 'title' => 'Finish Palette', 'text' => 'Champagne bronze metallic PVDF, natural anodized, and full RAL+ custom matching.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Hexagonal Honeycomb Composite Panels?',
            'description' => 'Certified by TÜV Rheinland, SGS, and Intertek — validated for high-amplitude wind turbulence, typhoon zones, and stringent commercial facade codes.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-919e6fa092.jpg',
                    'image_alt' => 'Macro cutaway of hexagonal aluminum honeycomb core foil cell structure with adhesive fillets.',
                    'icon'      => 'balance',
                    'title'     => '500% Flexural Rigidity',
                    'text'      => 'Honeycomb sandwich achieves 500% higher flexural stiffness (EI 450 N·m²) than 3.0mm solid plate at 40% reduced structural dead load.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-9786deaec2.jpg',
                    'image_alt' => 'Macro sample of champagne bronze fluorocarbon PVDF coating on aluminum honeycomb substrate.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'A2 Non-Combustible Core',
                    'text'      => 'PCS gross heat of combustion strictly below 3.0 MJ/kg with zero toxic smoke drop (d0) under EN 13501-1 / NFPA 285.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-c8a907f390.jpg',
                    'image_alt' => '3D visualization of concealed structural hook-on clip engaged into vertical facade mullion.',
                    'icon'      => 'air',
                    'title'     => 'Wind Tunnel Verified 6.5 kPa',
                    'text'      => 'Coastal hurricane suction vortex simulation with zero corner peel or rivet hole fatigue over 100,000 cyclic pulses at 6,500 Pa peak.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-5e55ea6648.jpg',
                    'image_alt' => 'High-rise envelope with 2000x5000mm ultra-flat aluminum honeycomb cladding panels in champagne finish.',
                    'icon'      => 'straighten',
                    'title'     => '< 0.5mm/m Monolithic Flatness',
                    'text'      => 'Roll-bonded sandwich eliminates oil-canning across mega-format 2,200×6,000mm panels — versus >2.5mm/m deviation on solid 3mm plate.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
            'table_title' => 'Tested per ASTM & BS EN Specifications',
            'table_ref'   => 'TÜV PASS #8921-EU',
            'rows'        => [
                ['name' => 'Flatness Deviation', 'value' => '< 0.5 mm/m planar zero oil-canning ｜ EN 485-4 / ASTM B209', 'mono' => '1'],
                ['name' => 'Tensile Flatwise Bond Strength', 'value' => '> 2.25 MPa, core failure mode only ｜ ASTM C297 / D1781', 'mono' => '1'],
                ['name' => 'Wind Pressure Design Load', 'value' => 'Up to +6.5 kPa / -6.5 kPa gust load ｜ ASTM E330 / BS EN 12179', 'mono' => '1'],
                ['name' => 'Fire Classification Reaction', 'value' => 'Class A2-s1,d0 non-combustible core ｜ EN 13501-1 / ASTM E84 / NFPA 285', 'mono' => ''],
                ['name' => 'Salt Spray Fog Resistance', 'value' => '4,000 hours, rating 10 zero blistering ｜ ASTM B117 / AAMA 2605-13', 'mono' => ''],
                ['name' => 'Acoustic Sound Transmission', 'value' => 'Rw = 33 dB sound damping resonance ｜ ASTM E90 / ISO 717-1', 'mono' => '1'],
                ['name' => 'Thermal Linear Expansion', 'value' => '2.4 × 10⁻⁵ / °C synchronized face & back ｜ ASTM E228', 'mono' => '1'],
                ['name' => 'Unit Weight / Section Modulus', 'value' => '6.85 kg/m² (20mm panel) ｜ W = 19.2 cm³/m', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'TDS Spec (PDF)', 'url' => '#rfq-section', 'style' => 'primary'],
                ['icon' => 'folder_zip', 'label' => 'BIM & CAD LOD-400', 'url' => '#rfq-section', 'style' => 'muted'],
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
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
            'install_description' => 'Engineered for rapid site installation, thermal movement compensation, and complete moisture management. Choose the structural bracket typology best suited for your facade envelope requirement.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPE 01 // HOOK-ON HIGH-RISE FAVORITE',
                    'title' => 'Concealed Hook-On Hanging Cassette',
                    'text'  => 'Extruded aluminum hook brackets with anti-vibration rubber damper pads secured to vertical curtain wall mullions — panels hang and lock progressively, individually demountable for maintenance.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-0a5bcd95a0.jpg',
                    'image_alt' => 'Technical diagram of Type 01 concealed hook-on hanging cassette extruded aluminum brackets with anti-vibration rubber damper pads on vertical curtain wall mullion.',
                ],
                [
                    'tag'   => 'TYPE 02 // OPEN-JOINT RAINSCREEN',
                    'title' => 'Open-Joint Pressure-Equalized Rainscreen',
                    'text'  => 'Continuous EPDM extruded gasket baffle with ventilated drainage cavity equalizes wind pressure and evacuates driven rain — open shadow joints with zero exposed sealant.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-396f59243e.jpg',
                    'image_alt' => 'Section drawing of Type 02 open-joint pressure-equalized rainscreen with continuous EPDM gasket baffle and ventilated drainage cavity.',
                ],
                [
                    'tag'   => 'TYPE 03 // INTERLOCK',
                    'title' => 'Interlocking Tongue & Groove',
                    'text'  => 'Continuous extruded male-female perimeter profiles bonded during panel manufacturing interlock directly on site with self-aligning precision joint lines — dramatically shortening crane installation cycles.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-6004e5a730.jpg',
                    'image_alt' => 'Engineering cross-section of Type 03 interlocking male-female tongue and groove aluminum honeycomb cladding with concealed mechanical anchor screws.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
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
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
            'description' => 'Engineered for rapid site installation, thermal movement compensation, and complete moisture management. Choose the structural bracket typology best suited for your facade envelope requirement.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-c8a907f390.jpg',
                    'image_alt' => 'Concealed structural hook-on extruded aluminum clip engaged into vertical facade mullion.',
                    'contain'   => '',
                    'title'     => 'Concealed Hook-On Cassette (TYPE 01 // HOOK-ON)',
                    'text'      => 'CNC-routed modular trays with factory-riveted aluminum hanging hooks engage extruded vertical runner mullions — zero visible fasteners, single-panel demountability, 12–20mm reveals, seismic drift up to 1:50.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-396f59243e.jpg',
                    'image_alt' => 'Section drawing of open-joint pressure-equalized rainscreen with EPDM gasket baffle and ventilated cavity.',
                    'contain'   => '',
                    'title'     => 'Open-Joint Rainscreen Baffle (TYPE 02 // OPEN-JOINT)',
                    'text'      => 'Pressure-equalized back-ventilated cavity with internal EPDM silicone baffle profiles — eliminates silicone streaking for decades, continuous >50mm rear ventilation, optimal thermal bridge decoupling.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-6004e5a730.jpg',
                    'image_alt' => 'Cross-section detail of interlocking male-female tongue and groove honeycomb cladding system.',
                    'contain'   => '',
                    'title'     => 'Tongue & Groove Interlocking (TYPE 03 // INTERLOCKING)',
                    'text'      => 'Continuous extruded male-female perimeter profiles bonded during manufacturing — self-aligning precision joint line, minimal framing substructure, high acoustic insulation performance.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'Request Case Study Dossier',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-f443a79a13.jpg',
                    'image_alt' => 'Singapore Changi Airport Terminal envelope clad in curved metallic champagne aluminum honeycomb panels.',
                    'location'  => 'SINGAPORE, SG',
                    'title'     => 'Changi International Hub Expansion',
                    'product'   => '25mm curved panels // Duranar Sunstorm mica PVDF',
                    'area'      => 'Area: 48,000 m²',
                    'year'      => 'Tested: 5.8 kPa',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-f546982ae6.jpg',
                    'image_alt' => 'DIFC Dubai Financial District skyscraper with ultra-flat anthracite gray honeycomb cassette panels.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'DIFC Prime Tower & Podium',
                    'product'   => '20mm panels // 55°C ambient & sand abrasion',
                    'area'      => 'Area: 32,000 m²',
                    'year'      => 'Tested: 50-Year Life',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-8baee60689.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
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
            'bg_image'       => '/wp-content/uploads/corrugated-panels-hero.jpg',
            'title'          => 'Corrugated Core Aluminum<br>Composite Panels',
            'subtitle'       => 'Engineered Sinusoidal Wave Core • Ultra-Lightweight Construction • Superior Structural Rigidity',
            'description'    => 'Advanced all-aluminum sandwich composite panels engineered with a structural sinusoidal wave core bonded between high-tensile metal facing sheets. Delivering exceptional flexural rigidity, mirror-like optical flatness, and certified EN 13501-1 Class A2/A1 fire safety for modern building envelopes and high-rise facades.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'local_fire_department', 'title' => 'EN 13501 A2/A1', 'text' => 'Non-combustible all-metal sandwich core'],
                ['icon' => 'scale', 'title' => '4.3 KG/M² WEIGHT', 'text' => '60% lighter than solid aluminum plate'],
                ['icon' => 'air', 'title' => '±5.4 KPA WIND LOAD', 'text' => 'ASTM E330 high-rise structural certified'],
                ['icon' => 'aspect_ratio', 'title' => 'ZERO OIL-CANNING', 'text' => 'Flawless optical flatness over large spans'],
            ],
        ],
        'intro' => [
            'image'       => '/wp-content/uploads/corrugated-core-cutaway-detail.jpg',
            'image_alt'   => 'Macro cutaway studio photograph of aluminum corrugated core panel showing top aluminum skin, internal continuous sinusoidal wave core, and bottom backing skin.',
            'video_label' => 'Core Cutaway // Sinusoidal Flute Detail',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Corrugated Core Aluminum Composite Panels?',
            'description' => 'Corrugated Core Aluminum Composite Panels (ACCP) are advanced architectural sandwich panels comprising two pre-finished aluminum facing sheets bonded to an internal sinusoidal corrugated wave aluminum core. Unlike traditional composite panels with mineral-filled polymer cores, the engineered wave core creates structural depth and continuous directional support—behaving like an infinite series of micro I-beams. This achieves exceptional flexural strength, high-span rigidity, and non-combustible fire safety at a fraction of the mass of solid metal plate.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Top & Bottom Metal Facings', 'text' => 'High-grade architectural AA3003-H14 or AA5052-H32 alloy skins (0.5mm – 1.0mm) factory-finished in multi-coat PVDF, FEVE, or specialized architectural textures.'],
                ['icon' => 'waves', 'title' => 'Sinusoidal Structural Wave Core', 'text' => 'Continuous 2.8mm – 6.0mm roll-formed wave aluminum core providing directional shear stiffness, flexural strength, and internal micro-cavity air circulation.'],
                ['icon' => 'lock', 'title' => 'High-Strength Composite Bonding', 'text' => 'Continuous thermoset polymer film bonding provides climbing drum peel strength > 98 N·mm/mm, ensuring zero delamination under intense thermal shock.'],
                ['icon' => 'domain', 'title' => 'Architectural Versatility', 'text' => 'Engineered for high-rise ventilated rainscreens, unitized curtain wall spandrels, interior cladding, airport terminal ceilings, and soffits.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Corrugated Core Aluminum Composite Panels?',
            'description' => 'Combining the structural efficiency of corrugated geometry with the durability and lightness of architectural aluminum for landmark building projects.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/corrugated-core-cutaway-detail.jpg',
                    'image_alt' => 'Cross-section showing lightweight sinusoidal wave core of corrugated composite panel.',
                    'icon'      => 'scale',
                    'title'     => 'Ultra-Lightweight Construction',
                    'text'      => 'Weighing just 4.3 kg/m² for a 4.0mm panel, corrugated composite is over 60% lighter than 3.0mm solid aluminum plate, drastically reducing facade dead loads and simplifying handling.',
                ],
                [
                    'image'     => '/wp-content/uploads/corrugated-install-hook-on-cassette.jpg',
                    'image_alt' => 'High-rise cassette installation demonstrating superior wind-load rigidity.',
                    'icon'      => 'air',
                    'title'     => 'Enhanced Panel Rigidity & Wind Resistance',
                    'text'      => 'The corrugated wave core delivers extraordinary flexural rigidity (0.245 × 10¹¹ N·mm²/m), withstanding wind pressures up to ±5.4 kPa (ASTM E330) over 1,500mm spans without intermediate stiffeners.',
                ],
                [
                    'image'     => '/wp-content/uploads/corrugated-flatness-facade.jpg',
                    'image_alt' => 'Low-angle view of building facade demonstrating flawless optical flatness with zero oil-canning.',
                    'icon'      => 'aspect_ratio',
                    'title'     => 'Flawless Optical Flatness',
                    'text'      => 'Continuous internal wave support prevents pillowing and thermal warping, ensuring mirror-like optical flatness and crisp reflections across large-format panels up to 1,500 × 6,000mm.',
                ],
                [
                    'image'     => '/wp-content/uploads/corrugated-panels-hero.jpg',
                    'image_alt' => 'Modern airport terminal facade clad with non-combustible corrugated core composite panels.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Certified Non-Combustible Fire Safety',
                    'text'      => '100% metal construction eliminates flammable polyethylene and toxic fumes, achieving Euroclass A2-s1, d0 / Class A1 under EN 13501-1 and ASTM E84 Class A flame spread.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
            'table_title' => 'ASTM / EN Certified Engineering Schedule',
            'table_ref'   => 'SPEC-ALU-ACCP-REV2025',
            'rows'        => [
                ['name' => 'Panel Architecture', 'value' => 'Symmetrical Sandwich: Top Skin + Corrugated Aluminum Core + Bottom Skin', 'mono' => ''],
                ['name' => 'Aluminum Alloy & Temper', 'value' => 'Architectural AA3003-H14 / AA5052-H32 / AA1100 (ASTM B209 / EN 485)', 'mono' => '1'],
                ['name' => 'Facing Skin Thickness', 'value' => 'Top: 0.7mm – 1.0mm | Bottom: 0.5mm – 0.8mm', 'mono' => '1'],
                ['name' => 'Core Geometry & Height', 'value' => 'Sinusoidal Wave Flute (Wave Height: 2.8mm ± 0.05mm | Pitch: 12.5mm)', 'mono' => '1'],
                ['name' => 'Total Panel Thickness', 'value' => '4.0mm / 6.0mm / 8.0mm / 10.0mm (Custom thickness on request)', 'mono' => '1'],
                ['name' => 'Areal Weight (4.0mm Panel)', 'value' => '4.32 kg/m² (−62% vs 3.0mm solid plate) | ISO 1183', 'mono' => '1'],
                ['name' => 'Flexural Rigidity (E × I)', 'value' => '0.245 × 10¹¹ N·mm²/m | ASTM C393 / EN 14509', 'mono' => '1'],
                ['name' => 'Max Wind Pressure Resistance', 'value' => '±5.4 kPa (L/180 pass over 1,500mm span) | ASTM E330', 'mono' => '1'],
                ['name' => 'Reaction to Fire', 'value' => 'Class A2-s1, d0 / Class A1 non-combustible | EN 13501-1 / ASTM E84 Class A', 'mono' => ''],
                ['name' => 'Standard & Custom Dimensions', 'value' => 'Width: 1,000 / 1,220 / 1,250 / 1,500 mm | Length: up to 6,000 mm', 'mono' => '1'],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Download Product Datasheet (PDF)', 'url' => '#rfq-section', 'style' => 'primary'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Sinusoidal Geometry Principle',
                    'tag'       => 'WAVE FLUTE 2.8MM',
                    'svg'       => $svg_wave,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'The 12.5mm wave-pitch core acts as an infinite series of structural I-beams, converting surface wind pressure into tensile and compressive vectors along continuous flutes.',
                ],
                [
                    'title'     => 'Internal Micro-Cavity Aeration',
                    'tag'       => 'THERMAL DISSIPATION',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Continuous linear sinusoidal channels permit convective micro-aeration along the flute orientation, accelerating heat dissipation and equalizing cavity pressure.',
                ],
                [
                    'title'     => '100% Recyclable Mono-Material',
                    'tag'       => 'CIRCULAR ECONOMY',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'All-aluminum construction requires zero delamination processing before recycling, remelting directly into secondary ingot stock with less than 5% of original smelting energy.',
                ],
            ],
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
            'install_description' => 'Engineered for fast, accurate cassette fabrication and concealed sub-frame mounting with dynamic thermal expansion tolerance.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPE A // CASSETTE RAINSCREEN',
                    'title' => 'Concealed Hook-On Cassette System (Z-Clip)',
                    'text'  => 'Cassette folded return flanges with internal structural corner brackets hook onto continuous vertical aluminum T- or Z-runners with stainless steel isolating fasteners, creating a concealed-fastened open-joint ventilated rainscreen.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/corrugated-install-hook-on-cassette.jpg',
                    'image_alt' => 'Architectural detail of concealed hook-on cassette panel installation on aluminum facade subframe.',
                ],
                [
                    'tag'   => 'TYPE B // MOVEMENT JOINT',
                    'title' => 'Horizontal Shadow Gap Express Joint',
                    'text'  => 'Engineered open shadow gaps (15–20mm width) featuring dry-joint EPDM multi-fin weather gaskets or ventilated rainscreen baffles with internal rear weeping drainage, accommodating ±3.5mm thermal movement per panel.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/corrugated-install-rainscreen.jpg',
                    'image_alt' => 'Architectural detail of open-joint ventilated rainscreen with horizontal shadow gap and EPDM gasket.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
            'description' => 'Choose from our premium architectural coatings including 3-coat fluoropolymer (PVDF), FEVE Lumiflon®, and specialized wood/stone sublimations with 20 to 30-year exterior color warranties.',
            'swatches'    => [
                ['color' => '#927B5E', 'name' => 'Champagne Metallic', 'code' => 'PVDF 3-Coat • 70% Kynar 500®', 'bespoke' => ''],
                ['color' => '#A5A9B4', 'name' => 'Titanium Silver Metallic', 'code' => 'PVDF 3-Coat', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Anthracite Slate Grey', 'code' => 'RAL 7016 • Matte PVDF', 'bespoke' => ''],
                ['color' => '#F1F3F5', 'name' => 'Pure Architectural White', 'code' => 'RAL 9016 • High-Durability PVDF', 'bespoke' => ''],
                ['color' => '#7A5724', 'name' => 'Architectural Woodgrain', 'code' => 'Sublimated Exterior Finish', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Project Match', 'code' => 'Custom RAL / Pantone / Sample', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
            'description' => 'Engineered for standard architectural fabrication tooling. Panels fold cleanly into rigid cassettes, form smooth curves, and accept custom CNC perforations without outer skin fracturing.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/corrugated-option-vgroove.jpg',
                    'image_alt' => 'Macro detail of corrugated core panel 90-degree CNC V-groove brake fold forming a cassette return flange.',
                    'contain'   => '1',
                    'title'     => 'CNC V-Groove Routing & Cassette Return',
                    'text'      => 'Routed from the backside through rear skin and core with a 90° carbide cutter; a calibrated 0.3mm base remains to prevent metal fatigue when cold-folding 90° returns. Minimum bend radius R = 2.0mm.',
                ],
                [
                    'image'     => '/wp-content/uploads/corrugated-option-curved.jpg',
                    'image_alt' => 'Smooth curved architectural corrugated core composite panel.',
                    'contain'   => '1',
                    'title'     => 'Curved Facades & Column Covers',
                    'text'      => 'Directional 3-roller pyramid bending along the flute orientation creates smooth single-radius cylindrical curves, curved fascias, and column wraps without skin wrinkling.',
                ],
                [
                    'image'     => '/wp-content/uploads/corrugated-option-perforated.jpg',
                    'image_alt' => 'Precision CNC perforated corrugated core aluminum panel with gradient hole pattern.',
                    'contain'   => '1',
                    'title'     => 'Acoustic & Feature Perforations',
                    'text'      => 'High-precision CNC punch tooling and laser routing create acoustic interior ceiling panels and exterior sun-shading screens with clean cutouts and zero core delamination.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'Explore All Global References',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-8445ed5715.jpg',
                    'image_alt' => 'Doha Metro Red Line station concourse envelope clad in corrugated core aluminum panels.',
                    'location'  => 'DOHA, QATAR',
                    'title'     => 'Doha Metro Red Line Concourse',
                    'product'   => 'ALU-CC-4000 (6mm) // ASTM E330 5.4 kPa Pass',
                    'area'      => 'Area: 42,500 m²',
                    'year'      => 'Sector: Airport & Transit Infrastructure',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-a794ad543a.jpg',
                    'image_alt' => 'IFEMA North Exhibition Expansion in Madrid Spain clad in brushed titanium composite panels.',
                    'location'  => 'MADRID, SPAIN',
                    'title'     => 'IFEMA North Exhibition Expansion',
                    'product'   => 'ALU-CC-4000 (4mm Brushed) // EN 13501 A2',
                    'area'      => 'Area: 28,000 m²',
                    'year'      => 'Sector: Commercial Civic Exhibition',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-6d92563ece.jpg',
                    'image_alt' => 'King Abdullah Financial District Station portal in Riyadh clad in champagne metallic panels.',
                    'location'  => 'RIYADH, KSA',
                    'title'     => 'KAFD Station Portal & Skywalk',
                    'product'   => 'ALU-CC-4000 (6mm Champagne) // Desert Thermal Pass',
                    'area'      => 'Area: 36,800 m²',
                    'year'      => 'Sector: High-Rise Financial District',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
            'description'  => 'Our international engineering consultation desk provides rapid structural preliminary calculations, BOQ optimization, and sample kits (including 4mm/6mm cutaway samples and color fan decks) within 24 business hours.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H EXPORT RESPONSE',
            'submit_label' => 'Submit Engineering RFQ & Request Sample Kit',
            'bullets'      => [
                ['icon' => 'timer', 'title' => '24-Hour Submittal Turnaround', 'text' => 'Technical and commercial quotation within one business day.'],
                ['icon' => 'deployed_code', 'title' => 'Physical Sample Box via DHL', 'text' => '4mm and 6mm cutaway samples with open wave core and PVDF color decks.'],
                ['icon' => 'calculate', 'title' => 'Wind Load & Span Optimization', 'text' => 'Complimentary structural deflection and panel thickness calculations.'],
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
            'bg_image'       => '/wp-content/uploads/alumax-img-674be52934.jpg',
            'title'          => 'Architectural Metal<br>Ceiling Systems',
            'subtitle'       => 'Acoustic Excellence. Seismic Safety. Monolithic Suspended Baffle & Tile Matrix.',
            'description'    => 'Precision-engineered modular ceiling envelopes with acoustic fleece backing, flush services integration, and seismic compliance for large-span transport terminals and premier corporate headquarters. System code: ALU-CL-6000.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
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
            'image'       => '/wp-content/uploads/alumax-img-e7d55cd0c1.jpg',
            'image_alt'   => '3D suspended ceiling carrier cutaway showing concealed grid and acoustic tile assembly.',
            'video_label' => '3D Suspended Ceiling Carrier Cutaway',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Architectural Metal Ceiling Systems?',
            'description' => 'A fully modular suspended ceiling platform combining acoustic baffles, concealed clip-in tiles, linear planks and open-cell grilles on one precision substructure — engineered for zero-deflection spans up to 3,600mm with factory-punched cutouts for HVAC diffusers and recessed luminaires.',
            'features'    => [
                ['icon' => 'grid_4x4', 'title' => 'System Typology', 'text' => 'Acoustic baffles / concealed clip-in / linear plank strip / open-cell grille formats.'],
                ['icon' => 'grain', 'title' => 'Perforation Patterns', 'text' => 'Micro-perforated 1.8mm 20% open (NRC 0.85), diagonal 2.5mm 22% (NRC 0.80), plain reflective, parametric 3D embossed.'],
                ['icon' => 'layers', 'title' => 'Substrate & Gauge', 'text' => 'AA3003 aluminum / AA5052 marine alloy / galvanized steel in 0.8–1.5mm gauges.'],
                ['icon' => 'format_paint', 'title' => 'Finish & Colorway', 'text' => 'Matte white, bronze anodized, RAL powder coating and woodgrain sublimation.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Architectural Metal Ceiling Systems?',
            'description' => 'Certified under ASTM C423 and ISO 354 reverberation chamber methodologies — engineered to minimize flutter echo in large-volume public spaces while satisfying seismic and fire codes.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-2719de9050.jpg',
                    'image_alt' => 'Soundtex acoustic fleece backing detail on micro-perforated metal ceiling panel.',
                    'icon'      => 'hearing',
                    'title'     => 'NRC 0.85 Acoustic Damping',
                    'text'      => 'Micro-perforated faces backed with Soundtex 0.2mm fleece achieve αw 0.85 (Class B) — minimizing flutter echo in large-volume transit halls.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-8064745743.jpg',
                    'image_alt' => 'Seismic suspension rigging with diagonal safety wires and compression struts.',
                    'icon'      => 'security',
                    'title'     => 'Seismic Category D–F',
                    'text'      => 'Heavy-gauge perimeter closure clips, rigid sway struts and high-tensile safety wires rated for 1.25g horizontal lateral acceleration in active fault zones.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-89f8e5a51b.jpg',
                    'image_alt' => 'Continuous wave baffle ceiling in airport terminal.',
                    'icon'      => 'local_fire_department',
                    'title'     => 'Class A Zero Flame Spread',
                    'text'      => 'Solid aluminum substrate and non-combustible fleece — 0 FSI flame spread, 0 SDI smoke developed under ASTM E84 / EN 13501-1.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-c3ea9d7638.jpg',
                    'image_alt' => 'High-speed CNC punching facility producing micro-perforated ceiling panels.',
                    'icon'      => 'precision_manufacturing',
                    'title'     => '2,000 Hits/Min CNC Precision',
                    'text'      => 'German Trumpf punch cells produce burr-free micro-perforations down to 0.8mm at ±0.02mm pitch accuracy; robotic 45° bevel folds at 99.98% repeatability.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
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
                ['icon' => 'picture_as_pdf', 'label' => 'Acoustic Dossier (PDF)', 'url' => '#rfq-section', 'style' => 'primary'],
                ['icon' => 'architecture', 'label' => 'LOD 400 CAD Library', 'url' => '#rfq-section', 'style' => 'muted'],
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
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
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
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
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
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
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
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'Request Complete 120-Project Reference List',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-6ae2a74568.jpg',
                    'image_alt' => 'Kuala Lumpur International Airport T2 concourse wave baffle ceiling.',
                    'location'  => 'KUALA LUMPUR, MYS',
                    'title'     => 'KLIA T2 Concourse',
                    'product'   => 'Custom 3,200mm wave baffles // black acoustic fleece',
                    'area'      => 'Area: 48,500 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-cc4cbed1a5.jpg',
                    'image_alt' => 'London Kings Cross commercial hub clip-in acoustic tile ceiling.',
                    'location'  => 'LONDON, UK',
                    'title'     => 'King\'s Cross International Commercial Hub',
                    'product'   => 'Clip-in 600×600 tiles // Class A demountable',
                    'area'      => 'Area: 32,000 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-be606f7113.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
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
            'bg_image'       => '/wp-content/uploads/alumax-img-1894ea3cfd.jpg',
            'title'          => 'Architectural Solar<br>Control Louvers',
            'subtitle'       => '85% Solar Heat Dissipation. Zero Water Entrainment. Continuous Ribbon Design.',
            'description'    => 'Engineered aerodynamic S-blade & rain-defense curtain wall louver system. Seamless continuous ribbon design delivering up to 85% solar heat gain dissipation with zero water entrainment at high storm wind velocities. Spec: ALU-LB-3000.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
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
            'image'       => '/wp-content/uploads/alumax-img-ab9e91858a.jpg',
            'image_alt'   => 'Extruded 6063-T6 aluminum S-blade profile cutaway showing internal drainage water-trap pocket and dual-rib stiffeners.',
            'video_label' => 'LOD 400 Parametric Blade Cut',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Architectural Solar Control Louvers?',
            'description' => 'A curtain wall transom-integrated louver platform with continuous ribbon sub-frame and 100% water penetration defense. Fully concealed fastening brackets eliminate external bolt heads while accommodating high thermal expansion in dynamic tall envelopes.',
            'features'    => [
                ['icon' => 'straighten', 'title' => 'Blade Profile Widths', 'text' => '75mm ribbon flute / 100mm S-curved / 150mm S-curved severe rain / 200mm aerofoil double-chamber.'],
                ['icon' => 'tune', 'title' => 'Angle & Actuation', 'text' => 'Fixed 30° / 45° settings or motorized BMS-linked actuation typologies.'],
                ['icon' => 'layers', 'title' => 'Substrate Alloy', 'text' => 'AA6063-T6 structural temper extrusions; AA6061-T6 high-strength for 200mm aerofoil.'],
                ['icon' => 'format_paint', 'title' => 'Finish Specification', 'text' => '3-coat PVDF 35μm (AAMA 2605, 30-year) / Class I 20μm clear & champagne anodized, ISO 7599 marine.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Architectural Solar Control Louvers?',
            'description' => 'Tested and validated in certified climatic wind tunnel facilities under simultaneous gale-force wind vectors and simulated torrential rain.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-5ba031318a.jpg',
                    'image_alt' => 'Multi-story continuous horizontal louver ribbons wrapping cantilevered glass volumes.',
                    'icon'      => 'wb_sunny',
                    'title'     => '85% Solar Glare Attenuation',
                    'text'      => 'Daylight redirection with calculated SHGC reduction of 0.16 when paired with low-E insulated glass units.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-4685405f0e.jpg',
                    'image_alt' => 'CNC-machined aluminum pivot brackets with concealed spring clips and vibration gaskets.',
                    'icon'      => 'water_drop',
                    'title'     => 'Zero Water Penetration',
                    'text'      => 'Complete defense against wind-driven rain up to 12.5 m/s storm velocity — EN 13030 Class A, 99.8% effectiveness, 0.00 oz/ft² entrainment.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-c4d8945c33.jpg',
                    'image_alt' => 'PVDF coated aluminum louver swatches in champagne bronze, anodized slate and metallic graphite.',
                    'icon'      => 'format_paint',
                    'title'     => '30-Year Fluoropolymer Life',
                    'text'      => 'GEMA electrostatic turbo-bell applied PPG / AkzoNobel 3-coat PVDF cured at 240°C — AAMA 2605 certified.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-cb844b8213.jpg',
                    'image_alt' => 'Dubai medical tower with dual-toned bronze motorized sunshade louvers in desert sun.',
                    'icon'      => 'storm',
                    'title'     => '4.80 kPa Hurricane Rated',
                    'text'      => 'Extreme positive/negative cyclic pressure tested; blade span deflection strictly within L/180 — ASTM E330 Class 4.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
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
                ['icon' => 'picture_as_pdf', 'label' => 'AMCA Dossier (3.5MB)', 'url' => '#rfq-section', 'style' => 'primary'],
                ['icon' => 'deployed_code', 'label' => 'Revit LOD 400 (RFA)', 'url' => '#rfq-section', 'style' => 'muted'],
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
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
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
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
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
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
            'description' => 'Constructed with fully concealed fastening brackets to eliminate external bolt heads while accommodating high thermal expansion in dynamic tall envelopes.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-a80058624e.jpg',
                    'image_alt' => 'Snap-on louver bracket clip assembly with dual anti-vibration neoprene isolation pads.',
                    'contain'   => '1',
                    'title'     => 'Snap-On Anti-Vibration Clip (TYPOLOGY 01)',
                    'text'      => 'Interlocking extruded clip + neoprene bushing locks blades onto vertical mullions with vibration isolation — thermal gap ±4.0mm, 3.2 min/m² install, <25 dBA wind flutter hum.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-0ecddca694.jpg',
                    'image_alt' => 'Continuous hidden aluminum stringer box channel for unbroken horizontal louver ribbons.',
                    'contain'   => '1',
                    'title'     => 'Continuous Hidden Stringer Box (TYPOLOGY 02)',
                    'text'      => 'Concealed rear spine enables unbroken horizontal ribbon lines spanning hundreds of meters — 100% clear visual horizon, max unsupported span 2,400mm, 6061-T6 rear deflection anchor lug.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-144abee644.jpg',
                    'image_alt' => 'Integrated water management perimeter with drainage gutter channel and concealed sill weep holes.',
                    'contain'   => '1',
                    'title'     => 'Integrated Drainage Gutter Sill (TYPOLOGY 03)',
                    'text'      => 'Internal blade troughs collect driven droplets routed through enclosed jamb conduits into the weeping tray — 45 L/min per bay discharge, 18mm S-lip trap, EPDM dual-lip sump gasket.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'View Complete 120+ Reference Dossier',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-304c49c25b.jpg',
                    'image_alt' => 'Frankfurt Airport Cargo Logistics Terminal with continuous champagne anodized louvers.',
                    'location'  => 'FRANKFURT, GER',
                    'title'     => 'Frankfurt Airport Airside Cargo Central',
                    'product'   => 'S150 horizontal // AMCA Class A water defense',
                    'area'      => 'Area: 14,500 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-cb844b8213.jpg',
                    'image_alt' => 'Dubai Healthcare City medical tower with motorized bronze sunshade louvers.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'Dubai Healthcare City Tower 04',
                    'product'   => '200mm aerofoil motorized // BMS IoT linked',
                    'area'      => 'Area: 8,200 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-83dd332f27.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
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
            'bg_image'       => '/wp-content/uploads/alumax-img-dd36323b8a.jpg',
            'title'          => 'Laser-Cut & Welded<br>Architectural Screens',
            'subtitle'       => 'Parametric Mashrabiya Tessellation. −48.4% Peak Cooling Load. Monolithic TIG Fusion.',
            'description'    => 'Engineered solar interceptor matrix combining custom CNC multi-axis laser carving, seamless TIG seam fusion, and ASTM B117 salt-spray resistant Class I architectural finishes. Spec ID: ALU-GR-2000 // CSI 07 42 13.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
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
            'image'       => '/wp-content/uploads/alumax-img-e1acc75d07.jpg',
            'image_alt'   => 'Macro close-up of 4mm aluminum screen with laser cut clean edge and robotic seamless fillet TIG welds in champagne bronze.',
            'video_label' => '3D Geometry Verified // CNC Edge Detail',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Laser-Cut & Welded Architectural Screens?',
            'description' => 'Unlike static planar louvers, the ALU-GR-2000 multi-layer Mashrabiya acts as an active visual barrier and passive thermal shield. During zenith solar noon (75°+), 4mm-depth structural ribs block 88% of thermal infrared irradiance while maintaining uninterrupted outward sightlines.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Structural Alloy Matrix', 'text' => 'AA5052-H32 marine high-yield / AA6063-T6 extruded chassis / AA3003-H14 standard sheet.'],
                ['icon' => 'straighten', 'title' => 'Plate Thickness Gauge', 'text' => '2.5 / 3.0 / 4.0mm (high-rise recommended) / 5.0 / 6.0mm.'],
                ['icon' => 'format_paint', 'title' => 'Coating & Finish', 'text' => '25μm Class I anodized / 70% Kynar 500 PVDF 3-coat / Qualicoat Class 2 polyester / timber sublimation.'],
                ['icon' => 'grain', 'title' => 'Pattern Typology', 'text' => 'Islamic octagram Mashrabiya, parametric sine wave, organic hex density, custom architectural CAD.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Laser-Cut & Welded Architectural Screens?',
            'description' => 'Computational microclimate engineering validation based on ASHRAE 90.1, EN 1991-1-4 boundary wind tunnel models, and solar radiation ray-tracing simulations.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-4b049b47fd.jpg',
                    'image_alt' => 'Double-skin facade installation with dynamic shadows cast over low-e glazing.',
                    'icon'      => 'wb_sunny',
                    'title'     => '−48.4% Cooling Load',
                    'text'      => 'Peak cooling load reduction across SW elevations under 45° solar incidence — SHGC from 0.78 unshaded to 0.24 with ALU-GR-2000.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-3a46c59353.jpg',
                    'image_alt' => 'Material swatches of architectural anodized champagne bronze and wood-grain thermal sublimation.',
                    'icon'      => 'light_mode',
                    'title'     => '82.3% Daylight Uniformity',
                    'text'      => 'Useful Daylight Illuminance (UDI 300–3000 lux) with DGP < 0.28 imperceptible direct glare cutoff.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-19c5b917d1.jpg',
                    'image_alt' => '15kW fiber laser cutting complex Mashrabiya patterns into 4mm aluminum plate.',
                    'icon'      => 'precision_manufacturing',
                    'title'     => '15kW Fiber Laser Precision',
                    'text'      => 'Swiss Bystronic CNC fiber lasers carve burr-free chamfer contours; post-perforation thermal annealing guarantees 1.0mm flatness per 3,000mm.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-20f221b3c5.jpg',
                    'image_alt' => 'Master metalworker performing seamless micro-grinding on welded decorative aluminum facade cassette.',
                    'icon'      => 'handyman',
                    'title'     => 'Seamless Robotic TIG Fusion',
                    'text'      => 'Multi-axis robotic TIG seam welding with four-stage metallurgical grain blending forms monolithic rigid spatial volumes without visible fastening seams.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
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
                ['icon' => 'picture_as_pdf', 'label' => 'Catalog (PDF 12MB)', 'url' => '#rfq-section', 'style' => 'primary'],
                ['icon' => 'deployed_code', 'label' => 'BIM & CAD (.DWG)', 'url' => '#rfq-section', 'style' => 'muted'],
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
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
            'install_description' => 'Precision-engineered extruded aluminum mounting cleats allow three-axis site adjustment (X, Y, Z ±15mm) while mitigating thermal expansion stresses through neoprene-isolated sliders.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPE-CFB-01',
                    'title' => 'Concealed Floating Bracket',
                    'text'  => 'Interlocking male-female 6063-T6 cleat mechanism fastened into curtain wall transoms or slab edge brackets via M10 A4-80 stainless anchors — 1.8 kN per cleat dead load, ±15mm 3-axis site adjustment.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-12d41c613c.jpg',
                    'image_alt' => 'Concealed floating bracket fixing onto vertical curtain wall mullion with stainless bolts and aluminum cleats.',
                ],
                [
                    'tag'   => 'TYPE-HMF-02',
                    'title' => 'Hinged Sub-Frame for BMU Access',
                    'text'  => 'Screen panels swing 95° inward or outward on internal stainless pivot hinges for glazing washing and BMU cradle access — 10,000 operational cycles, dual aircraft wire safety lanyard.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-ee30d62579.jpg',
                    'image_alt' => 'Heavy duty concealed pivot hinge and quick-release latch on aluminum screen frame.',
                ],
                [
                    'tag'   => 'TYPE-TEI-03',
                    'title' => 'Thermal Bushing & Isolators',
                    'text'  => 'Dielectric PTFE shims and EPDM rubber collars isolate aluminum frames from carbon steel brackets, eliminating galvanic reaction in high-salinity marine environments — ΔT 60°C (+6.5mm) travel, ASTM D149 tested.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/alumax-img-927424ec57.jpg',
                    'image_alt' => 'EPDM thermal expansion isolator bushing and PTFE slide plates between aluminum bracket and steel frame.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
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
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
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
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'View All Completed Case Studies',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-9768350081.jpg',
                    'image_alt' => 'Cultural library in Abu Dhabi with bronze gold Mashrabiya double-skin envelope.',
                    'location'  => 'ABU DHABI, UAE',
                    'title'     => 'Abu Dhabi Cultural & Heritage Library',
                    'product'   => '4.0mm AA5052-H32 // champagne anodized, −44% solar',
                    'area'      => 'Area: 14,500 m²',
                    'year'      => 'Year: 2023',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-81def7ac2e.jpg',
                    'image_alt' => 'Luxury residential villa compound in Riyadh with parametric aluminum privacy screens.',
                    'location'  => 'RIYADH, KSA',
                    'title'     => 'Al-Nakheel Private Royal Enclave',
                    'product'   => 'Hinged Mashrabiya // thermal barrier isolators',
                    'area'      => 'Area: 8,200 m²',
                    'year'      => 'Year: 2024',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-a2752397d1.jpg',
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
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
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
            'bg_image'       => '/wp-content/uploads/roll-coated-panels-hero.jpg',
            'title'          => 'Roll-Coated<br>Aluminum Panels',
            'subtitle'       => 'Factory Pre-Finished Surfaces • Superior Color Consistency • High-Performance Coating Protection',
            'description'    => 'Premium pre-finished solid aluminum panels manufactured with automated continuous roller coating lines. Delivering microscopic film uniformity, zero orange peel, batch-to-batch color consistency, and extreme weatherability for exterior curtain walls, ventilated rainscreens, interior cladding, and metal ceilings.',
            'primary_label'  => 'Request a Quote',
            'primary_url'    => '#rfq-section',
            'secondary_label' => 'Download Datasheet',
            'secondary_url'  => '#technical-specifications',
            'secondary_icon' => 'download',
            'badges'         => [
                ['icon' => 'verified', 'title' => 'FACTORY-APPLIED FINISH', 'text' => 'Uniform film build ±1.0μm'],
                ['icon' => 'palette', 'title' => 'COLOR CONSISTENCY', 'text' => 'In-line spectrophotometer ΔE < 0.5'],
                ['icon' => 'shield', 'title' => 'DURABLE PROTECTION', 'text' => 'PVDF / FEVE / PE / HDP finishes'],
                ['icon' => 'straighten', 'title' => 'FABRICATION READY', 'text' => 'CNC routing, bending & cassettes'],
            ],
        ],
        'intro' => [
            'image'       => '/wp-content/uploads/roll-coated-panels-detail.jpg',
            'image_alt'   => 'Architectural macro photograph of adjacent metallic champagne and satin slate grey roll-coated aluminum facade panels with razor-sharp shadow reveal joints.',
            'video_label' => 'Architectural Detail // Pre-Finished Panels',
            'eyebrow'     => 'The Product',
            'title'       => 'What are Roll-Coated Aluminum Panels?',
            'description' => 'Roll-coated aluminum panels (also known as pre-coated, color-coated, or pre-finished aluminum panels) are premium architectural cladding panels fabricated from solid aluminum sheet pre-treated with factory-applied coatings and thermally cured before panel formation. By applying the coating in a tightly controlled continuous roller line rather than on-site or post-spray painting, our panels achieve superior coating uniformity, zero orange peel, exceptional color fidelity, and robust long-term durability.',
            'features'    => [
                ['icon' => 'layers', 'title' => 'Base Aluminum Alloy Substrate', 'text' => 'High-grade architectural alloys including AA3003-H14, AA5052-H32, and AA1100, providing structural rigidity, lightness, and corrosion resistance.'],
                ['icon' => 'format_paint', 'title' => 'Factory-Applied Pre-Finish', 'text' => 'Continuous multi-stage roller application with in-line thermal curing guarantees uniform film build and consistent gloss across large production batches.'],
                ['icon' => 'straighten', 'title' => 'Panel Gauges & Dimensions', 'text' => 'Thickness options from 1.5mm to 3.0mm; standard 1,220 × 2,440mm sheets, and custom panel widths up to 1,600mm with lengths up to 6,000mm.'],
                ['icon' => 'domain', 'title' => 'Architectural Versatility', 'text' => 'Engineered for exterior ventilated rainscreens, curtain wall spandrels, interior wall cladding, decorative feature panels, and metal ceilings.'],
            ],
        ],
        'advantages' => [
            'eyebrow'     => 'Key Advantages',
            'title'       => 'Why Choose Our Roll-Coated Aluminum Panels?',
            'description' => 'Combining the inherent strength of solid aluminum with state-of-the-art coil-coating polymer chemistry to achieve superior architectural aesthetics and lifetime reliability.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-af13bd38e1.jpg',
                    'image_alt' => 'Automated continuous roller coating plant with high-precision coating station and cleanroom curing ovens.',
                    'icon'      => 'precision_manufacturing',
                    'title'     => 'Factory-Applied Coating Precision',
                    'text'      => 'Continuous cleanroom roller coating applies primer, base coat, and protective clear layers with ±1.0μm thickness tolerance, eliminating brush marks, overspray, and uneven thermal curing.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-bdc2c9158a.jpg',
                    'image_alt' => 'Architectural metallic and solid color fan deck swatches in champagne, slate grey, titanium silver, and bronze.',
                    'icon'      => 'palette',
                    'title'     => 'Batch-to-Batch Color Consistency',
                    'text'      => 'Automated traversing optical sensors measure spectral reflection continuously, keeping ΔE under 0.5 across production batches for flawless visual harmony across expansive facades.',
                ],
                [
                    'image'     => '/wp-content/uploads/roll-coated-panels-detail.jpg',
                    'image_alt' => 'High-performance weather-resistant roll-coated aluminum panel facade under natural exterior exposure.',
                    'icon'      => 'shield',
                    'title'     => 'Durable Protective Surface Finishes',
                    'text'      => 'High-performance PVDF, FEVE, and HDP formulations deliver superior UV stability, acid rain resistance, and marine salt-fog protection, backed by 20 to 30-year warranties.',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-12cd718b51.jpg',
                    'image_alt' => 'Industrial CNC press brake bending pre-finished architectural aluminum cassette panel without coating cracking.',
                    'icon'      => 'straighten',
                    'title'     => 'Lightweight & Fabrication Flexibility',
                    'text'      => 'Exceptional coating elasticity and ductility allow pre-finished panels to undergo precision CNC cutting, brake folding (0T/1T), cassette fabrication, and punching without paint micro-fracturing.',
                ],
            ],
        ],
        'specs' => [
            'eyebrow'     => 'Technical Specifications',
            'title'       => 'Product Parameters & Engineering Details',
            'table_title' => 'Architectural Specifications & Certified Laboratory Data',
            'table_ref'   => 'SPEC-ALU-RCP-REV2025',
            'rows'        => [
                ['name' => 'Base Aluminum Alloy', 'value' => 'Architectural Alloy AA3003-H14 / AA5052-H32 / AA1100 (ASTM B209 / EN 485)', 'mono' => '1'],
                ['name' => 'Panel Thickness', 'value' => '1.5mm / 2.0mm / 2.5mm / 3.0mm (Custom gauges available on request)', 'mono' => '1'],
                ['name' => 'Panel Dimensions', 'value' => 'Standard: 1,220 × 2,440 mm | Custom widths up to 1,600 mm | Lengths up to 6,000 mm', 'mono' => '1'],
                ['name' => 'Coating Chemistry', 'value' => 'PVDF (70% Kynar 500® / Hylar 5000®) / FEVE Lumiflon® / HDP Super Polyester / PE', 'mono' => ''],
                ['name' => 'Coating Thickness', 'value' => 'PVDF ≥ 28–35μm (2-Coat / 3-Coat) | FEVE ≥ 30μm | HDP / PE ≥ 18–25μm (AAMA 2605 / EN 1396)', 'mono' => '1'],
                ['name' => 'Specular Gloss Level (60°)', 'value' => 'Matte (20–35%) | Semi-Gloss (40–60%) | High Gloss (70–90%) (ASTM D523 / ISO 2813)', 'mono' => '1'],
                ['name' => 'Formability (T-Bend)', 'value' => '≤ 1T — zero film micro-cracking or loss of adhesion under 180° reverse hem (ASTM D4145 / EN 13523-7)', 'mono' => '1'],
                ['name' => 'Surface Hardness & Adhesion', 'value' => 'Pencil Hardness ≥ 2H | Cross-Hatch Tape Adhesion 100/100 Class 5B (ASTM D3363 / D3359)', 'mono' => '1'],
                ['name' => 'Corrosion & Weathering', 'value' => '4,000 h Salt Spray (ASTM B117) | 5,000 h QUV Exposure ΔE < 2.0 Hunter units (ASTM G154 / D2244)', 'mono' => '1'],
                ['name' => 'Fire Classification', 'value' => 'Class A1 Non-Combustible Substrate (EN 13501-1) / Class A Flame Spread (ASTM E84)', 'mono' => ''],
            ],
            'buttons'     => [
                ['icon' => 'picture_as_pdf', 'label' => 'Download Product Datasheet (PDF)', 'url' => '#rfq-section', 'style' => 'primary'],
            ],
            'side_cards'  => [
                [
                    'title'     => 'Multi-Layer Coating Architecture',
                    'tag'       => '3C2B PROCESS',
                    'svg'       => $svg_film,
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Pre-treatment, primer, base color, and protective clear fluoropolymer layers cured in multi-zone thermal ovens — total film ≥ 35μm, uniformity ±1.0μm.',
                ],
                [
                    'title'     => 'In-Line Spectrophotometer',
                    'tag'       => 'ΔE < 0.5',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Continuous optical sensors monitor spectral reflection across production runs, maintaining color variance ΔE below 0.5 for absolute facade color uniformity.',
                ],
                [
                    'title'     => 'Peelable Protective Film',
                    'tag'       => 'RESIDUE-FREE 6 MONTHS',
                    'svg'       => '',
                    'image'     => '',
                    'image_alt' => '',
                    'caption'   => 'Co-extruded 80μm UV-resistant polyethylene masking film protects finished panel surfaces through fabrication, handling, and installation with clean peeling.',
                ],
            ],
            'install_eyebrow'     => 'Installation Typologies',
            'install_title'       => 'Versatile Structural Mounting & Integration Options',
            'install_description' => 'Engineered for fast, reliable site installation across diverse facade sub-frames, accommodating thermal expansion and high structural wind loads.',
            'install_note'        => '',
            'install_items'       => [
                [
                    'tag'   => 'TYPE A // CASSETTE RAINSCREEN',
                    'title' => 'Concealed Hook-On Cassette System',
                    'text'  => 'Pre-finished roll-coated panels are CNC routed and folded into cassette trays with perimeter flanges. Panels mount onto horizontal extruded aluminum transoms using concealed structural hooks and brackets, creating an open-joint ventilated rainscreen with hidden fixings.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/roll-coated-install-hook-on-cassette.jpg',
                    'image_alt' => 'Architectural detail of concealed hook-on cassette panel installation on aluminum facade subframe.',
                ],
                [
                    'tag'   => 'TYPE B // DIRECT-FASTENED',
                    'title' => 'Open-Joint Ventilated & Face-Fastened System',
                    'text'  => 'Panels are secured directly to vertical aluminum or steel sub-framing channels using color-matched, EPDM-gasketed architectural fasteners. Features engineered expansion slots and rear ventilation cavities for optimal pressure equalization and moisture drainage.',
                    'svg'   => '',
                    'image' => '/wp-content/uploads/roll-coated-install-rainscreen.jpg',
                    'image_alt' => 'Architectural detail of open-joint ventilated rainscreen installation with rear cavity drainage and vertical sub-frame.',
                ],
            ],
        ],
        'palette' => [
            'eyebrow'     => 'Exterior Colors & Finishes',
            'title'       => 'Colors & Architectural Finishes',
            'description' => 'Explore our curated architectural color palette, including solid colors, metallic mica tones, and specialty textures. Custom RAL, NCS, and Pantone color matching is available for project specifications.',
            'swatches'    => [
                ['color' => '#F4F4F4', 'name' => 'Pure Architectural White', 'code' => 'RAL 9010 / 9016 • PVDF 3-Coat', 'bespoke' => ''],
                ['color' => '#4B515D', 'name' => 'Modern Slate Grey', 'code' => 'RAL 7016 • PVDF 3-Coat', 'bespoke' => ''],
                ['color' => '#C9A87C', 'name' => 'Desert Champagne Mica', 'code' => 'Metallic PVDF 3-Coat', 'bespoke' => ''],
                ['color' => '#B4B8C0', 'name' => 'Titanium Silver Metallic', 'code' => 'Metallic PVDF 3-Coat', 'bespoke' => ''],
                ['color' => '#2A3439', 'name' => 'Deep Matte Anthracite', 'code' => 'RAL 7021 • FEVE / PVDF', 'bespoke' => ''],
                ['color' => '', 'name' => 'Bespoke Project Match', 'code' => 'Custom RAL / Pantone / Sample', 'bespoke' => '1'],
            ],
        ],
        'options' => [
            'eyebrow'     => 'Customization Options',
            'title'       => 'Tailored to Your Project',
            'description' => 'From flat cut-to-size cladding panels to precision-folded cassette trays and custom perforated feature walls, our pre-finished panels accommodate diverse architectural designs.',
            'cards'       => [
                [
                    'image'     => '/wp-content/uploads/roll-coated-option-cassette.jpg',
                    'image_alt' => 'Precision brake-folded architectural aluminum cassette panel with returned perimeter flanges.',
                    'contain'   => '1',
                    'title'     => 'Brake-Folded Cassette Panels',
                    'text'      => 'Panels are CNC routed and folded into sharp 90° cassette trays on precision press brakes with internal corner gussets and structural stiffeners for large spans.',
                ],
                [
                    'image'     => '/wp-content/uploads/roll-coated-option-perforated.jpg',
                    'image_alt' => 'High-precision CNC perforated roll-coated aluminum panel with architectural gradient pattern.',
                    'contain'   => '1',
                    'title'     => 'CNC Perforation & Feature Panels',
                    'text'      => 'Precision multi-tool punching and laser routing create acoustic wall panels, architectural sunscreens, and decorative feature walls with clean edges and zero paint chipping.',
                ],
                [
                    'image'     => '/wp-content/uploads/roll-coated-option-curved.jpg',
                    'image_alt' => 'Curved pre-finished architectural aluminum panels with smooth circular radius and continuous coating finish.',
                    'contain'   => '1',
                    'title'     => 'Curved & Formed Facades',
                    'text'      => 'High-ductility coating formulation accommodates 3-roller pyramid bending and curved fascia panels without surface micro-cracking or finish discoloration.',
                ],
            ],
        ],
        'cases' => [
            'eyebrow'    => 'Project References',
            'title'      => 'Trusted in Iconic Buildings',
            'link_label' => 'View All Completed Case Studies',
            'link_url'   => '',
            'projects'   => [
                [
                    'image'     => '/wp-content/uploads/alumax-img-1cd8fefaec.jpg',
                    'image_alt' => 'Futuristic airport terminal roof and facade clad in champagne gold roll-coated aluminum panels under desert sunlight.',
                    'location'  => 'DUBAI, UAE',
                    'title'     => 'Dubai Exhibition & Transit Hub',
                    'product'   => 'AA3003-H14 2.5mm // 3-Coat PVDF Desert Champagne Mica Cassettes',
                    'area'      => 'Area: 48,000 m²',
                    'year'      => 'Sector: Transportation & Exhibition',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-282ee8f625.jpg',
                    'image_alt' => 'Modern geometric commercial headquarters facade in Hamburg clad in dark anthracite roll-coated aluminum cassette panels.',
                    'location'  => 'HAMBURG, DE',
                    'title'     => 'Elbe Riverside Corporate Center',
                    'product'   => 'AA5052-H32 3.0mm // FEVE Satin Anthracite Rainscreen Cassettes',
                    'area'      => 'Area: 32,500 m²',
                    'year'      => 'Sector: Corporate Headquarters',
                ],
                [
                    'image'     => '/wp-content/uploads/alumax-img-0c5c138ab4.jpg',
                    'image_alt' => 'High-tech technology research complex in Singapore with ultra-flat pure white and silver roll-coated aluminum panels.',
                    'location'  => 'SINGAPORE',
                    'title'     => 'Tuas Technology Research Complex',
                    'product'   => 'AA3003-H14 2.0mm // PVDF Pure White & Titanium Silver Wall Paneling',
                    'area'      => 'Area: 21,000 m²',
                    'year'      => 'Sector: Advanced Technology Facility',
                ],
            ],
        ],
        'inquiry' => [
            'eyebrow'      => 'Request a Project Quote',
            'title'        => 'Have a Project in Mind?',
            'description'  => 'Submit your project specifications and architectural drawings. Our export engineering center provides technical panel feasibility reviews, structural calculations, and quotation within 24 business hours. Certified to ISO 9001:2015, EN 1396, ASTM B209M, and QUALICOAT.',
            'form_title'   => 'Direct Factory Specification RFQ',
            'form_badge'   => '24H MILL RESPONSE',
            'submit_label' => 'Submit Specification RFQ & Request Swatch Deck',
            'bullets'      => [
                ['icon' => 'mark_email_read', 'title' => 'Global Project Email', 'text' => 'export@alumax-facade.com — direct engineering channel.'],
                ['icon' => 'alarm_on', 'title' => 'Typical Response Speed', 'text' => '< 4 hours across MENA, APAC & Europe zones.'],
                ['icon' => 'flight_takeoff', 'title' => 'Physical Color Sample Box', 'text' => 'Complimentary DHL air express fan deck & fabricated sample panel (3–5 days).'],
            ],
            'products'     => [
                ['label' => 'Roll-Coated Aluminum Panels'],
                ['label' => 'Solid Aluminum Cladding'],
                ['label' => 'Aluminum Composite Panels'],
            ],
        ],
    ];
}
