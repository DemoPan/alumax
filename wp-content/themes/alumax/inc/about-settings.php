<?php

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------
 * 关于我们页设置：页面全部文案/图片在「关于我们设置」编辑，未保存时显示默认值
 * ------------------------------------------------------------------------- */

function alumax_about_defaults() {
    $factory_image = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBV1tdNa54NZwi4x2vHIO_7JwJYmcDAeludOMRMIganRoqJlmdsEh_G3RqDvMUaOeb-Ou40DIdkA-V0LjlkhKEGbEfKzHrm2u5LV1QA5c7-qLZiEw8mXwfnsgsCKotAEilS7XEA2ejmJovwaoN65tuuQpVHy29IRtMHKXX-ByyvMCa7tEIJ0EglwreCmz-8a6IAyKxo-i6iOCH6j90yWDzc5uBwfx8NvFXCFo_DV0lpXWemH6RhOGeK';
    $defaults = [
        // Hero
        'hero_badge'   => 'Global Architectural Manufacturing Complex // ISO 9001 · EN 13501-1',
        'hero_title'   => 'Engineering Global Skylines Through Precision Metallurgy',
        'hero_intro'   => 'State-of-the-Art 150,000 m² Automated Manufacturing Hub & Facade Engineering Excellence. Supplying monument-scale architectural envelopes to over 60 international sovereign territories.',
        'hero_bg'      => $factory_image,
        // Section 01 Heritage
        's1_eyebrow'   => '// SECTION 01',
        's1_eyebrow_sub' => 'Heritage & Manufacturing Realization',
        's1_title'     => 'Two Decades of Monumental Cladding & Structural Realization',
        's1_narrative' => 'Founded with the foundational mission to close the gap between daring parametric architectural concepts and industrial-scale manufacturability, ALUMAX has grown from an artisan metallurgical workshop into one of the world\'s most capable envelope fabrication partners. Over 20+ years, our facade engineering studio has collaborated directly with benchmark global architectural practices—including Foster + Partners, Zaha Hadid Architects, and Skidmore, Owings & Merrill (SOM)—turning complex fluid hyperboloids, extreme wind-shear canopies, and blast-resistant assemblies into pristine, install-ready reality.',
        's1_video_image'   => $factory_image,
        's1_video_badge'   => 'PROD-LINE 03 // 5-Axis CNC Live Capture',
        's1_video_caption' => '4K UHD Factory Tour & Robotic Forming',
        's1_video_url'     => '',
        // Section 02 Timeline
        's2_eyebrow' => '// SECTION 02',
        's2_eyebrow_sub' => 'Evolution Timeline',
        's2_title'   => 'Two Decades of Innovation & Global Expansion',
        's2_subtitle' => 'Chronological milestones tracking ALUMAX\'s progression from precision artisan workshops to global benchmark façade engineering.',
        // Section 03 Machinery
        's3_eyebrow' => '// SECTION 03',
        's3_eyebrow_sub' => 'Heavy Metallurgy Infrastructure',
        's3_title'   => 'Advanced Tooling & Machinery Matrix',
        's3_intro'   => 'Engineered to eliminate project bottlenecks on monument-scale envelopes. Deploying precision multi-axis CNCs, robotic laser workstations, and automated continuous coating tunnels built to ASTM & EN tolerances.',
        // Section 04 Quality
        's4_eyebrow' => '// SECTION 04',
        's4_eyebrow_sub' => 'Zero-Failure Engineering & Verification',
        's4_title'   => 'Rigorous End-to-End Quality Protocol',
        's4_intro'   => 'Eliminating on-site installation risks through a certified 4-phase testing regimen. From raw molten ingot spectroscopy to hurricane chamber mock-ups and serialized crate tagging.',
    ];

    // Hero 指标条（5 格）
    $metrics = [
        ['value' => '150K m²', 'label' => 'Facility Footprint', 'sub' => 'Spanning 4 robotic fabrication halls'],
        ['value' => '12', 'label' => 'Automated CNC Lines', 'sub' => 'German 5-axis ±0.3mm tolerance'],
        ['value' => '35+', 'label' => 'Proprietary Patents', 'sub' => 'Hyperbolic, honeycomb, acoustic'],
        ['value' => '60+', 'label' => 'Export Destinations', 'sub' => 'EU, MENA, Americas, APAC'],
        ['value' => '25-Yr', 'label' => 'Coating Warranty', 'sub' => 'PPG / AkzoNobel PVDF Class 1'],
    ];
    foreach ($metrics as $i => $metric) {
        $n = $i + 1;
        foreach ($metric as $prop => $value) {
            $defaults["hero_metric{$n}_{$prop}"] = $value;
        }
    }

    // Section 02 时间线卡片（3 张）
    $timeline = [
        ['years' => '2004 — 2010', 'title' => 'Pioneering Solid Cladding', 'desc' => 'Commissioning of the first automated 3.0mm solid PVDF coil lines. Initial export deliveries for high-traffic civil infrastructure including terminal concourses at Hong Kong International Airport.', 'foot_label' => 'Core Achievement', 'foot_value' => 'Automated PVDF Coils'],
        ['years' => '2011 — 2018', 'title' => 'Honeycomb & 3D Hyperbolics', 'desc' => 'Strategic expansion into the unified 150,000 m² campus. Attainment of European CE & EN 13501-1 A2 non-combustible composite core certification and specialized roll-curving capabilities.', 'foot_label' => 'Certification', 'foot_value' => 'EN 13501-1 A2 Fire Safe'],
        ['years' => '2019 — Present', 'title' => 'Digital BIM & Smart Facades', 'desc' => 'End-to-end integration of motorized solar shading systems, parametric CAD-to-CNC LOD 400 fabrication pipelines, and international logistics directly servicing global supertall towers.', 'foot_label' => 'Platform', 'foot_value' => 'Parametric BIM LOD 400'],
    ];
    foreach ($timeline as $i => $card) {
        $n = $i + 1;
        foreach ($card as $prop => $value) {
            $defaults["s2_card{$n}_{$prop}"] = $value;
        }
    }

    // Section 03 设备矩阵卡片（3 张）
    $machines = [
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDolrEWb78VbZGNCs-gze_bpbhL3ev1HnNN4JyiEP2rT-hrmdlbmb96t2M8T7PGBLvfl10UFOaNHFPbR_yH1KQ2tuuOoAJ3-a_E9Hhf0pjEDWzPSfQ1zreQBxGzyX8uz0EoJ2akQVCynt_Y3zinhwYN2AJ9UPQ6mQb6RGz-GlaGU1fGSPScorfzPtQ3dYQ23fcuiSgcjamNCCeAY50eIONab3Edwfpy8dn5A62v_6kQCPFaAXbR00K4',
            'brand' => 'TRUMPF TRUMATIC', 'country' => 'Germany', 'stage' => 'Stage 01 · Primary Machining', 'units' => '5 Units',
            'title' => '5-Axis CNC Precision Centers & Roll-Bending',
            'desc'  => 'Engineered for double-curved hyperbolic panels, compound faceted louvers, and slotted cassette perimeters. Driven directly by parametric BIM LOD 400 CAM pipelines with real-time tool compensation.',
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuANXhDmHk7ngrCccTxtxGd6LRuyNSYE4uUbepSMJ5Qr3XtoSiUPs9cvGPvB67tekNd-BZtQR2wEppPdgGwIdgMgE1c6f6NOqF-Be8hd4NZmf1x-Ax0ZBDgSTZu4EEgXTcA9rL6O2ccfJbg0U9nHoTWELWoqAZ9y-lgc2wnQsbfNthhiq76G9tcpKW6pQgpIVUpE50m5e0qJDPSAEJR9Q0nCIvp-0VT1DaiKICyJGKb2ZNitCZNp6NP-',
            'brand' => 'GEMA OPTISPRAY', 'country' => 'Switzerland', 'stage' => 'Stage 02 · Surface Metallurgy', 'units' => '2 Continuous Tunnels',
            'title' => 'Automated PVDF & Powder Coating Lines',
            'desc'  => 'Class 10,000 pressurized cleanroom spray cabins with 14-stage zirconium pre-treatment. Certified by PPG Duranar, AkzoNobel Interpon D3000, and Valspar for 20-30 year maritime architectural warranties.',
        ],
        [
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBdd5aNsK6f0NMsrOJxmWd2v2nVBDGFUbJjZiP-d0atSkTHhoUVn9ObLdGbxfWjzGGbCyn5UNl_7rTeISCSBijpbaGLGQnwuW-9jx_PhCYaDXf02ySm_k3YulXG815myvE3G_xHtCt6fa_K6jbaD404wd2JWBgu8B5KzF4lm2mMCth7ONFWZXC1nbAS4UuPgc4o-z0OofZUIsjhR5JLrfdB5NdFYHgsLKLUVjQw0azJdJke1qGcyyn9',
            'brand' => 'YASKAWA MOTOMAN', 'country' => 'Japan', 'stage' => 'Stage 03 · Joinery & Bonding', 'units' => '6 Cells',
            'title' => 'Robotic Laser Welding & Core Bonding Cells',
            'desc'  => 'Dual-fiber 12kW automated robotic welding cells with seam-tracking sensors. Eliminates cosmetic heat deformation on front-facing architectural surfaces while providing complete structural alloy continuity.',
        ],
    ];
    foreach ($machines as $i => $card) {
        $n = $i + 1;
        foreach ($card as $prop => $value) {
            $defaults["s3_card{$n}_{$prop}"] = $value;
        }
    }

    // Section 04 质量协议卡片（4 张）
    $phases = [
        [
            'phase' => 'PHASE A', 'stage' => 'Stage 01–02', 'icon' => 'biotech',
            'title' => 'Raw Metallurgy & Substrate Purity',
            'desc'  => 'Optical emission spectroscopy verifies 3003-H14 / 5052-H32 alloy chemical purity before slitting. Ultrasonic continuous caliper scans monitor coil gauge across full coil widths.',
            'badge1' => 'ASTM B209M', 'badge2' => 'EN 485-2',
            'spec1_label' => 'Purity Standard', 'spec1_value' => 'Fe/Si/Mn ≤ 0.05%',
            'spec2_label' => 'Caliper Tolerance', 'spec2_value' => '±0.02 mm',
        ],
        [
            'phase' => 'PHASE B', 'stage' => 'Stage 03–04', 'icon' => 'view_in_ar',
            'title' => '3D Cloud Geometry & CNC Tolerances',
            'desc'  => 'High-speed Leica laser coordinate scanners map fabricated 3D curved surfaces and slotting hole positions directly against Navisworks & Revit BIM IFC coordinate models.',
            'badge1' => 'BIM LOD 400', 'badge2' => 'ISO 2768-m',
            'spec1_label' => 'Hole Alignment', 'spec1_value' => '< 0.25 mm Spatial',
            'spec2_label' => 'Surface Planarity', 'spec2_value' => '1.0 mm / 2,000 mm',
        ],
        [
            'phase' => 'PHASE C', 'stage' => 'Stage 05–06', 'icon' => 'thunderstorm',
            'title' => 'Severe Climate & CWCT Stress Testing',
            'desc'  => 'In-house dynamic testing chambers subject 1:1 scale facade cassettes to 3,600 Pa cyclic wind loads, deluge water penetration tests, and 4,000-hour ASTM B117 salt fog corrosion exposure.',
            'badge1' => 'CWCT Standard', 'badge2' => 'ASTM B117 C5-M',
            'spec1_label' => 'Dynamic Pressure', 'spec1_value' => '3,600 Pa Gust Load',
            'spec2_label' => 'Salt Chamber', 'spec2_value' => '4,000h Zero Blister',
        ],
        [
            'phase' => 'PHASE D', 'stage' => 'Stage 07 Final', 'icon' => 'verified',
            'title' => 'Crate Serialization & Digital Dossier',
            'desc'  => 'Every panel is laser-etched with a unique QR / RFID code linking to raw coil mill certificates, coating batch logs, QA engineer digital stamps, and installation grid coordinates.',
            'badge1' => 'RFID Tracked', 'badge2' => 'EN 10204 3.1',
            'spec1_label' => 'Batch Traceability', 'spec1_value' => '100% Ingot-to-Site',
            'spec2_label' => 'Export Crate QC', 'spec2_value' => 'ISPM 15 Fumigated',
        ],
    ];
    foreach ($phases as $i => $card) {
        $n = $i + 1;
        foreach ($card as $prop => $value) {
            $defaults["s4_card{$n}_{$prop}"] = $value;
        }
    }

    return $defaults;
}

function alumax_about_fields() {
    $text = function ($key, $label, $desc = '') {
        return ['key' => $key, 'label' => $label, 'type' => 'text', 'desc' => $desc];
    };
    $textarea = function ($key, $label, $desc = '') {
        return ['key' => $key, 'label' => $label, 'type' => 'textarea', 'desc' => $desc];
    };
    $image = function ($key, $label, $desc = '') {
        return ['key' => $key, 'label' => $label, 'type' => 'image', 'desc' => $desc];
    };
    $url = function ($key, $label, $desc = '') {
        return ['key' => $key, 'label' => $label, 'type' => 'url', 'desc' => $desc];
    };

    $groups = [
        'hero' => [
            'label' => 'Hero 首屏',
            'fields' => [
                $text('hero_badge', '顶部徽章'),
                $text('hero_title', '主标题'),
                $textarea('hero_intro', '简介'),
                $image('hero_bg', '背景图'),
            ],
        ],
        'hero_metrics' => ['label' => 'Hero 指标条（5 格）', 'fields' => []],
        's1' => [
            'label' => 'Section 01 · Heritage 品牌沿革',
            'fields' => [
                $text('s1_eyebrow', '眉标编号', '如 // SECTION 01'),
                $text('s1_eyebrow_sub', '眉标副文'),
                $text('s1_title', '标题'),
                $textarea('s1_narrative', '正文'),
                $image('s1_video_image', '工厂视频封面图'),
                $text('s1_video_badge', '封面左上角标'),
                $text('s1_video_caption', '封面底部标题'),
                $url('s1_video_url', '视频链接', '填写后点击封面在新窗口打开视频；留空则封面不可点击'),
            ],
        ],
        's2' => [
            'label' => 'Section 02 · Evolution Timeline 发展时间线',
            'fields' => [
                $text('s2_eyebrow', '眉标编号'),
                $text('s2_eyebrow_sub', '眉标副文'),
                $text('s2_title', '标题'),
                $textarea('s2_subtitle', '副标题'),
            ],
        ],
        's2_cards' => ['label' => 'Section 02 · 时间线卡片（3 张）', 'fields' => []],
        's3' => [
            'label' => 'Section 03 · Machinery Matrix 设备矩阵',
            'fields' => [
                $text('s3_eyebrow', '眉标编号'),
                $text('s3_eyebrow_sub', '眉标副文'),
                $text('s3_title', '标题'),
                $textarea('s3_intro', '简介'),
            ],
        ],
        's3_cards' => ['label' => 'Section 03 · 设备卡片（3 张）', 'fields' => []],
        's4' => [
            'label' => 'Section 04 · Quality Protocol 质量协议',
            'fields' => [
                $text('s4_eyebrow', '眉标编号'),
                $text('s4_eyebrow_sub', '眉标副文'),
                $text('s4_title', '标题'),
                $textarea('s4_intro', '简介'),
            ],
        ],
        's4_cards' => ['label' => 'Section 04 · 质量阶段卡片（4 张）', 'fields' => []],
    ];

    for ($i = 1; $i <= 5; $i++) {
        $groups['hero_metrics']['fields'][] = $text("hero_metric{$i}_value", "指标 {$i} 数值");
        $groups['hero_metrics']['fields'][] = $text("hero_metric{$i}_label", "指标 {$i} 名称");
        $groups['hero_metrics']['fields'][] = $text("hero_metric{$i}_sub", "指标 {$i} 说明");
    }
    for ($i = 1; $i <= 3; $i++) {
        $groups['s2_cards']['fields'][] = $text("s2_card{$i}_years", "卡片 {$i} 年份区间");
        $groups['s2_cards']['fields'][] = $text("s2_card{$i}_title", "卡片 {$i} 标题");
        $groups['s2_cards']['fields'][] = $textarea("s2_card{$i}_desc", "卡片 {$i} 描述");
        $groups['s2_cards']['fields'][] = $text("s2_card{$i}_foot_label", "卡片 {$i} 底部名称");
        $groups['s2_cards']['fields'][] = $text("s2_card{$i}_foot_value", "卡片 {$i} 底部内容");

        $groups['s3_cards']['fields'][] = $image("s3_card{$i}_image", "卡片 {$i} 图片");
        $groups['s3_cards']['fields'][] = $text("s3_card{$i}_brand", "卡片 {$i} 品牌角标");
        $groups['s3_cards']['fields'][] = $text("s3_card{$i}_country", "卡片 {$i} 产地角标");
        $groups['s3_cards']['fields'][] = $text("s3_card{$i}_stage", "卡片 {$i} 阶段行");
        $groups['s3_cards']['fields'][] = $text("s3_card{$i}_units", "卡片 {$i} 数量行");
        $groups['s3_cards']['fields'][] = $text("s3_card{$i}_title", "卡片 {$i} 标题");
        $groups['s3_cards']['fields'][] = $textarea("s3_card{$i}_desc", "卡片 {$i} 描述");
    }
    for ($i = 1; $i <= 4; $i++) {
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_phase", "卡片 {$i} 阶段（如 PHASE A）");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_stage", "卡片 {$i} 子阶段（如 Stage 01–02）");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_icon", "卡片 {$i} 图标（Material Symbols）");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_title", "卡片 {$i} 标题");
        $groups['s4_cards']['fields'][] = $textarea("s4_card{$i}_desc", "卡片 {$i} 描述");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_badge1", "卡片 {$i} 标准徽章 1");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_badge2", "卡片 {$i} 标准徽章 2");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_spec1_label", "卡片 {$i} 规格 1 名称");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_spec1_value", "卡片 {$i} 规格 1 数值");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_spec2_label", "卡片 {$i} 规格 2 名称");
        $groups['s4_cards']['fields'][] = $text("s4_card{$i}_spec2_value", "卡片 {$i} 规格 2 数值");
    }

    return $groups;
}

function alumax_about($key) {
    static $opts = null;
    if ($opts === null) {
        $opts = wp_parse_args(get_option('alumax_about', []), alumax_about_defaults());
    }
    return isset($opts[$key]) ? $opts[$key] : '';
}

alumax_add_settings_page(
    'alumax_about',
    '关于我们设置',
    'dashicons-building',
    31,
    '这里的每一项对应「关于我们」页的一个模块内容；留空会显示默认值。',
    'alumax_about_defaults',
    'alumax_about_fields'
);
