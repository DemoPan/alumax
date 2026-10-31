<?php

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------
 * 默认值（未保存过 meta 的案例回退到这套 KAFD 示例内容，与 design-prototypes/cases-detail.html 同步）
 * ------------------------------------------------------------------------- */

function alumax_case_defaults() {
    return [
        'header' => [
            'ref_code'         => '#ALX-GCC-2024-K3',
            'location'         => 'RIYADH, KSA',
            'completed'        => 'COMPLETED 2024',
            'certification'    => 'LEED PLATINUM & CWCT',
            'card_tagline'     => 'Dynamic Louvers & Curved Spandrels',
            'overview_heading' => 'Monumental Financial Hub Envelope Integration',
        ],
        'snapshot' => [
            ['label' => 'Client / Operator', 'value' => 'KAFD Development MC'],
            ['label' => 'Building Height', 'value' => '42 Floors // 186.4 m'],
            ['label' => 'Facade Consultant', 'value' => 'Global Envelopes Zurich'],
            ['label' => 'ALUMAX Scope', 'value' => 'Design, Fabricate & Export'],
            ['label' => 'Delivery Mode', 'value' => 'Modular Sea Crate Hoist-Ready'],
        ],
        'metrics' => [
            ['name' => 'Envelope Area', 'value' => '22,700 m²', 'desc' => '14,200 m² Dynamic Kinetic Louvers + 8,500 m² CNC Deep-Drawn Spandrels.', 'icon' => 'aspect_ratio'],
            ['name' => 'Thermal Delta', 'value' => '-34.2%', 'desc' => 'Peak solar heat gain reduction. Maintained overall tower SHGC at 0.14.', 'icon' => 'thermostat'],
            ['name' => 'Structural Windload', 'value' => '6.20 kPa', 'desc' => 'ASTM E330 Ultimate proof load rated against extreme Arabian desert squalls.', 'icon' => 'air'],
            ['name' => 'Fire & Ingress', 'value' => 'EN 13501 A1', 'desc' => 'Non-combustible rating coupled with CWCT 1,200 Pa Air / 600 Pa dynamic water barrier.', 'icon' => 'shield'],
        ],
        'gallery' => [
            [
                'image' => '',
                'label' => 'Completed Facade Envelope',
                'title' => 'South-Facing Glazing Protection Array',
                'desc'  => 'Dual-skin aerofoil louvers dynamically positioned at 37° incident angle.',
            ],
            [
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCS9ULCVMViTgtm5CsZabvMKbjeIpLM2UnQOXkgBZrxtdMA89QK1EcufbrioZzn_-J39kxV_YvMetu09wGM-EbJrXdhSjI_C-Tpy9CS43yxQlOB1wU93iJl5mScpLX195Ejj-5ctdSUJkzY1G3hT6p3iS5ZQLSGoDuU4SZ4qjm8i6pY0frDx4RJd1efS3gjjgS6wHfh3ADg9hwIAMGmlIYVYC5hwIorJ3IGeArgdCxfPaMfx3vVInQX',
                'label' => 'SUB-ASSEMBLY DETAIL',
                'title' => 'Hyperboloid 4.0mm Roll-Bended Edge',
                'desc'  => '',
            ],
            [
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB8Tj8qPN7HPf5R6RJJZmf-Njfqc3iLg8dWzcBVNvLdTINTpXujIF3SpSUrvuZiRt7yB7NniVmmvgbPwkG2cLp7xU57SxVHk-nxzpnHSZPKgz42bNTAYYf3mXpsknJjpd9A3W_DFwyqsF0-JBMISlzcosWpIGxyzqQdEOYZ0P_ULykkoYrAom18hd-NqSWpdNRlXHvmld4zK0us__bGrppj2sn8-wSuHgjctluBMfZWyIr6CmwGPVd1',
                'label' => 'AUTOMATION IN ACTION',
                'title' => 'Sunset Tracking Mode Active',
                'desc'  => '',
            ],
            [
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBFLd1R4jVu-P8PfhzYJU0v6cDXQFzUX1xZSOe7idZJFohlcKVIf_7_1pipKYPEKX7MxgDsBy-0bmYEbFsbJIZ047Tfzk6HIVWkTF3-Mv9SIiyLriJhNu2z0_0EZsXLuNp_J59drVlqlj4hcIPA9_Lx_f1B8qUi3ebduk0Hml6dLeXNEJnM4Up7WvPYzd6x48bebJn3OIXzsWUZ1EYU5LcT_k2L9BJlAmpZFbWhUxB_yC2EqmTAOIyi',
                'label' => 'MANUFACTURING PRECISION',
                'title' => 'Factory CNC Robotic Stud Welding',
                'desc'  => 'Automatic stud fixing on panel reverse ensuring structural flatness.',
            ],
        ],
        'challenge' => [
            'heading'     => 'Surviving 52°C Ambient Thermal Shock & Severe Desert Sand Abrasion',
            'text'        => 'Riyadh\'s desert microclimate presents one of the most punishing structural envelope testing grounds globally, demanding multi-layered structural and chemical defenses against heat, UV, and particulate erosion.',
            'image'       => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB8Tj8qPN7HPf5R6RJJZmf-Njfqc3iLg8dWzcBVNvLdTINTpXujIF3SpSUrvuZiRt7yB7NniVmmvgbPwkG2cLp7xU57SxVHk-nxzpnHSZPKgz42bNTAYYf3mXpsknJjpd9A3W_DFwyqsF0-JBMISlzcosWpIGxyzqQdEOYZ0P_ULykkoYrAom18hd-NqSWpdNRlXHvmld4zK0us__bGrppj2sn8-wSuHgjctluBMfZWyIr6CmwGPVd1',
            'image_label' => 'On-Site Facade Erection',
            'image_title' => 'KAFD Tower 3 Curtain Wall Hoisting',
            'image_desc'  => 'Field alignment of motorized kinetic louvers and curved spandrels under 50°C solar radiation.',
            'image2'        => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCS9ULCVMViTgtm5CsZabvMKbjeIpLM2UnQOXkgBZrxtdMA89QK1EcufbrioZzn_-J39kxV_YvMetu09wGM-EbJrXdhSjI_C-Tpy9CS43yxQlOB1wU93iJl5mScpLX195Ejj-5ctdSUJkzY1G3hT6p3iS5ZQLSGoDuU4SZ4qjm8i6pY0frDx4RJd1efS3gjjgS6wHfh3ADg9hwIAMGmlIYVYC5hwIorJ3IGeArgdCxfPaMfx3vVInQX',
            'image2_label'  => 'MACRO DETAIL',
            'image2_title'  => '10mm Shadow Reveal Joint & SS316 Concealed Fixing',
            'cards'       => [
                [
                    'title' => 'Extreme Thermal Shock (+52°C Desert Microclimate & UV Degradation)',
                    'text'  => 'Thermal cycling causes intense differential expansion between glass substructures and aluminum mullions. Engineered expansion joints and continuous EPDM isolating thermal bridges absorb cyclic expansion without oil-canning or fastener fatigue.',
                ],
                [
                    'title' => 'Kinetic Dual-Skin BMS Automation Integration',
                    'text'  => 'ALUMAX synchronized motorized kinetic louvers into KAFD\'s central automation bus. Intelligent sensors dynamically trim aerofoil blade deflection in 0.5° increments based on solar azimuth, cutting peak solar thermal gain by 34.2%.',
                ],
                [
                    'title' => 'Hyperbolic Sandstorm Abrasion & Micro-Scratch Resistance',
                    'text'  => 'High-velocity particulate silica winds erode standard coil coatings. We engineered a bespoke 3-coat PPG Duranar XL fluoropolymer formulation loaded with ceramic microspheres, sustaining gloss and zero blistering past 4,000 hours of cyclic ASTM testing.',
                ],
            ],
        ],
        'systems_intro' => [
            'heading' => 'Comprehensive Envelope Assemblies & Material Specifications',
            'text'    => 'Universal architectural facade materials, structural alloys, and high-performance weatherproofing applied across KAFD Tower 3.',
        ],
        'systems' => [
            [
                'icon'       => 'view_in_ar',
                'code'       => 'AA5052-H32',
                'title'      => 'High-Tensile Solid Aluminum Cladding',
                'subtitle'   => '4.0mm CNC Hyperboloid Roll-Bended Spandrels',
                'specs_text' => "Thickness & Temper:|4.0mm // AA5052-H32\nFabrication Tolerance:|±0.3mm CNC Roll-Formed\nPrimary Role:|Curved Tower Spandrel Zones",
            ],
            [
                'icon'       => 'wb_sunny',
                'code'       => '6063-T6 AF',
                'title'      => 'Aerofoil Kinetic Sun-Tracking Louvers',
                'subtitle'   => 'Extruded Aerospace Architectural Profile',
                'specs_text' => "Chord Dimension:|450mm Wing / 3.5mm Wall\nKinematics:|IP67 Actuator // ±90° Swing\nPrimary Role:|Active South Solar Shading",
            ],
            [
                'icon'       => 'format_paint',
                'code'       => 'PVDF 3-COAT',
                'title'      => '3-Coat PPG Duranar XL PVDF',
                'subtitle'   => 'High-Performance 45μm Ceramic-Infused Finish',
                'specs_text' => "Total Dry Film:|45.8 μm // 25° Matte\nEndurance Rating:|4,000h ASTM B117 / ISO 9227\nPrimary Role:|Extreme Sand Abrasion Defense",
            ],
            [
                'icon'       => 'water_drop',
                'code'       => 'EPDM DRY-JOINT',
                'title'      => 'Structural Silicone & Dual EPDM Gaskets',
                'subtitle'   => 'Continuous Engineered Air/Water Seal Interface',
                'specs_text' => "Material Matrix:|Dense Vulcanized Dual EPDM\nPressure Proof:|CWCT 1,200 Pa Air / 600 Pa H₂O\nPrimary Role:|Dynamic Storm Weather Barrier",
            ],
            [
                'icon'       => 'grid_goldenratio',
                'code'       => 'SS316 / PA66',
                'title'      => 'Thermal Break Isolators & SS316 Pins',
                'subtitle'   => 'Dielectric Anti-Corrosion Joint Bushings',
                'specs_text' => "Pins & Hardware:|Stainless Steel 316 Clevis\nThermal Struts:|PA66 GF25 Polyamide Bars\nPrimary Role:|Galvanic Isolation & Pivot Axes",
            ],
            [
                'icon'       => 'construction',
                'code'       => '6061-T6 RIB',
                'title'      => 'Subframe Ribs & High-Load Anchor Cleats',
                'subtitle'   => 'Back-Welded Stiffeners with Structural Tape',
                'specs_text' => "Stiffener Method:|Extruded Ribs + 3M VHB Tape\nWindload Rating:|6.20 kPa Ultimate Proof Load\nPrimary Role:|Spandrel Rigidity & Anchorage",
            ],
        ],
        'verification_intro' => [
            'heading' => 'Facade Specification Schedule',
            'text'    => 'Comprehensive laboratory certified structural, thermal, and barrier test results.',
        ],
        'verification' => [
            ['param' => 'Substrate Tensile Strength (Rm)', 'requirement' => '≥ 215 MPa', 'result' => '248 MPa (AA5052-H32)', 'standard' => 'ASTM B209 / EN 485'],
            ['param' => 'Yield Strength (Rp0.2)', 'requirement' => '≥ 160 MPa', 'result' => '185 MPa', 'standard' => 'ASTM E8M'],
            ['param' => 'Coating Film Thickness', 'requirement' => '≥ 35 µm', 'result' => '45.8 µm (3-Coat PVDF)', 'standard' => 'AAMA 2605.02'],
            ['param' => 'Accelerated Salt Spray Endurance', 'requirement' => '3,000 Hours rating 8+', 'result' => '4,000 Hours (Zero blistering)', 'standard' => 'ASTM B117 / ISO 9227'],
            ['param' => 'Static Windload Structural Proof', 'requirement' => 'Design 3.8 kPa / Proof 5.7 kPa', 'result' => '6.20 kPa Ultimate (< L/195)', 'standard' => 'ASTM E330 / CWCT Standard'],
            ['param' => 'Dynamic Air Permeability', 'requirement' => '600 Pa < 1.5 m³/(h·m²)', 'result' => '1,200 Pa (0.42 m³/(h·m²))', 'standard' => 'EN 12152 / CWCT Sec 4'],
            ['param' => 'Dynamic Water Tightness', 'requirement' => 'Pass 300 Pa', 'result' => 'Pass 600 Pa (Zero leakage)', 'standard' => 'ASTM E331 / AAMA 501.1'],
            ['param' => 'Seismic Interstory Drift', 'requirement' => 'Design Drift ±1.5%', 'result' => '±2.5% Drift Intact', 'standard' => 'AAMA 501.4 Cyclic Test'],
            ['param' => 'Reaction to Fire Reaction Class', 'requirement' => 'Non-combustible', 'result' => 'EN 13501-1 Class A1 / A2-s1, d0', 'standard' => 'EN ISO 1182 / EN ISO 1716'],
        ],
        'downloads' => [
            [
                'icon'  => 'architecture',
                'meta'  => 'DWG // 8.4 MB',
                'title' => 'Curtain Wall Section & Mullion Detailing',
                'desc'  => 'Full 2D AutoCAD section drawings detailing SS316 brackets, thermal break spacers, and extruded aluminum anchor points.',
                'url'   => '#',
                'btn'   => 'Download CAD Section DWG',
            ],
            [
                'icon'  => 'view_in_ar',
                'meta'  => 'RVT // 24.6 MB',
                'title' => 'Revit BIM Dynamic Louver Model LOD 400',
                'desc'  => 'Parametric Autodesk Revit model containing kinematic pivot constraints, electrical conduit routes, and schedule metadata.',
                'url'   => '#',
                'btn'   => 'Download Revit BIM Model',
            ],
            [
                'icon'  => 'verified',
                'meta'  => 'PDF // 12.2 MB',
                'title' => 'CWCT & ASTM Official Test Dossier',
                'desc'  => 'Complete certified third-party laboratory results for structural windload, air leakage, dynamic water penetration, and sand blast tests.',
                'url'   => '#',
                'btn'   => 'Download Test Dossier',
            ],
        ],
    ];
}

/* -------------------------------------------------------------------------
 * Getters：meta 不是数组（从未保存）时回退默认值；保存后即使为空数组也照用
 * ------------------------------------------------------------------------- */

function alumax_case_meta($key, $post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $value = get_post_meta($post_id, 'alumax_case_' . $key, true);
    if (is_array($value)) {
        return $value;
    }
    $defaults = alumax_case_defaults();
    return $defaults[$key];
}

function alumax_case_header($post_id = null) {
    return array_merge(alumax_case_defaults()['header'], alumax_case_meta('header', $post_id));
}

function alumax_case_snapshot($post_id = null) {
    $rows = alumax_case_meta('snapshot', $post_id);
    return array_map(function ($row) {
        return array_merge(['label' => '', 'value' => '', 'sub' => ''], is_array($row) ? $row : []);
    }, $rows);
}

function alumax_case_metrics($post_id = null) {
    return alumax_case_meta('metrics', $post_id);
}

function alumax_case_gallery($post_id = null) {
    $gallery = alumax_case_meta('gallery', $post_id);
    $defaults = alumax_case_defaults()['gallery'];
    for ($i = 0; $i < 4; $i++) {
        $gallery[$i] = array_merge($defaults[$i], isset($gallery[$i]) && is_array($gallery[$i]) ? $gallery[$i] : []);
    }
    return array_slice($gallery, 0, 4);
}

function alumax_case_challenge($post_id = null) {
    return array_merge(alumax_case_defaults()['challenge'], alumax_case_meta('challenge', $post_id));
}

function alumax_case_systems_intro($post_id = null) {
    return array_merge(alumax_case_defaults()['systems_intro'], alumax_case_meta('systems_intro', $post_id));
}

function alumax_case_systems($post_id = null) {
    return alumax_case_meta('systems', $post_id);
}

function alumax_case_verification_intro($post_id = null) {
    return array_merge(alumax_case_defaults()['verification_intro'], alumax_case_meta('verification_intro', $post_id));
}

function alumax_case_verification($post_id = null) {
    return alumax_case_meta('verification', $post_id);
}

function alumax_case_downloads($post_id = null) {
    return alumax_case_meta('downloads', $post_id);
}

/* -------------------------------------------------------------------------
 * 后台：media uploader + 通用 repeater 交互脚本
 * ------------------------------------------------------------------------- */

add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'], true)) {
        return;
    }
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if ($screen && $screen->post_type === 'case') {
        wp_enqueue_media();
    }
});

function alumax_case_admin_js() {
    static $done = false;
    if ($done) {
        return;
    }
    $done = true;
    ?>
    <script>
    jQuery(function ($) {
      $(document).on('click', '.alumax-rep-add', function () {
        var tpl = document.getElementById($(this).data('template'));
        $('#' + $(this).data('target')).append(tpl.innerHTML);
      });
      $(document).on('click', '.alumax-rep-remove', function () {
        $(this).closest('tr').remove();
      });
      $(document).on('click', '.alumax-media-btn', function (e) {
        e.preventDefault();
        var input = $('#' + $(this).data('target'));
        var frame = wp.media({ title: '选择图片', button: { text: '使用此图片' }, multiple: false });
        frame.on('select', function () {
          input.val(frame.state().get('selection').first().toJSON().url);
        });
        frame.open();
      });
    });
    </script>
    <?php
}

/**
 * 通用 repeater 表格。
 * $columns: [field => ['label' => string, 'width' => string, 'type' => 'text'|'textarea'|'url']]
 */
function alumax_case_repeater($id, $columns, $rows, $add_label) {
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
          <?php alumax_case_repeater_cells($id, $columns, $row); ?>
          <td><button type="button" class="button alumax-rep-remove">删除</button></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <template id="<?php echo esc_attr($tpl_id); ?>">
      <tr>
        <?php alumax_case_repeater_cells($id, $columns, []); ?>
        <td><button type="button" class="button alumax-rep-remove">删除</button></td>
      </tr>
    </template>
    <p><button type="button" class="button button-secondary alumax-rep-add"
        data-template="<?php echo esc_attr($tpl_id); ?>"
        data-target="<?php echo esc_attr($tbody_id); ?>"><?php echo esc_html($add_label); ?></button></p>
    <?php
}

function alumax_case_repeater_cells($id, $columns, $row) {
    foreach ($columns as $field => $col) {
        $value = isset($row[$field]) ? $row[$field] : '';
        $name = $id . '[' . $field . '][]';
        echo '<td>';
        if (!empty($col['type']) && $col['type'] === 'textarea') {
            echo '<textarea name="' . esc_attr($name) . '" class="large-text" rows="3">' . esc_textarea($value) . '</textarea>';
        } else {
            echo '<input type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" class="large-text">';
        }
        echo '</td>';
    }
}

/* -------------------------------------------------------------------------
 * Meta boxes
 * ------------------------------------------------------------------------- */

add_action('add_meta_boxes', function () {
    // 顺序严格对应详情页前端 5 个模块，最后一个是列表页 Spotlight 数据/保留字段
    add_meta_box('alumax-case-hero', '01 Hero：页头信息 + Project Snapshot + Key Metrics', 'alumax_case_hero_box', 'case', 'normal', 'default');
    add_meta_box('alumax-case-overview', '02 Project Overview', 'alumax_case_overview_box', 'case', 'normal', 'default');
    add_meta_box('alumax-case-challenge', '03 Project Challenge', 'alumax_case_challenge_box', 'case', 'normal', 'default');
    add_meta_box('alumax-case-gallery', '04 Project Gallery（图集）', 'alumax_case_gallery_box', 'case', 'normal', 'default');
    add_meta_box('alumax-case-related', '05 Related Products', 'alumax_case_related_box', 'case', 'normal', 'default');
    add_meta_box('alumax-case-extra', '附：Spotlight 数据与保留字段（详情页不渲染）', 'alumax_case_extra_box', 'case', 'normal', 'default');
});

function alumax_case_hero_box($post) {
    wp_nonce_field('alumax_case_details_save', 'alumax_case_details_nonce');
    $header = alumax_case_header($post->ID);
    ?>
    <h4>页头信息（Hero meta 行 / 列表卡片角标 / Spotlight 徽章）</h4>
    <table class="form-table" style="max-width:720px;">
      <tr><th><label>档案编号 REF</label></th>
        <td><input type="text" name="alumax_case_header[ref_code]" value="<?php echo esc_attr($header['ref_code']); ?>" class="regular-text"></td></tr>
      <tr><th><label>地点 Location</label></th>
        <td><input type="text" name="alumax_case_header[location]" value="<?php echo esc_attr($header['location']); ?>" class="regular-text"> <span class="description">如 RIYADH, KSA，也用于相关案例卡片角标</span></td></tr>
      <tr><th><label>竣工状态</label></th>
        <td><input type="text" name="alumax_case_header[completed]" value="<?php echo esc_attr($header['completed']); ?>" class="regular-text"> <span class="description">如 COMPLETED 2024</span></td></tr>
      <tr><th><label>认证徽章</label></th>
        <td><input type="text" name="alumax_case_header[certification]" value="<?php echo esc_attr($header['certification']); ?>" class="regular-text"> <span class="description">如 LEED PLATINUM &amp; CWCT</span></td></tr>
      <tr><th><label>卡片标签</label></th>
        <td><input type="text" name="alumax_case_header[card_tagline]" value="<?php echo esc_attr($header['card_tagline']); ?>" class="regular-text"> <span class="description">如 3.0mm Curved Cladding，显示在相关案例卡片标题上方</span></td></tr>
    </table>

    <h4>Project Snapshot（可增删；用于 Hero 右侧 Snapshot 卡前 5 行 + 02 Overview 属性瓦片，全部删除后两处前台隐藏）</h4>
    <?php
    alumax_case_repeater('alumax_case_snapshot', [
        'label' => ['label' => '属性名（如 Client / Operator）', 'width' => '30%'],
        'value' => ['label' => '内容（如 KAFD Development MC）', 'width' => '40%'],
        'sub'   => ['label' => '副行备注（可选，瓦片小字）'],
    ], alumax_case_snapshot($post->ID), '+ 添加属性');
    ?>

    <h4>项目基本信息 / Key Metrics（可增删，默认 4 项）</h4>
    <?php
    alumax_case_repeater('alumax_case_metrics', [
        'name'  => ['label' => '名称（如 Envelope Area）', 'width' => '22%'],
        'value' => ['label' => '数值（如 22,700 m²）', 'width' => '18%'],
        'desc'  => ['label' => '说明', 'type' => 'textarea'],
        'icon'  => ['label' => '图标', 'width' => '14%'],
    ], alumax_case_metrics($post->ID), '+ 添加指标');
    ?>
    <p class="description">图标填 Material Symbols 名称（如 aspect_ratio / thermostat / air / shield），留空按顺序取默认图标。用于 Hero 底部 4 格、Spotlight 3 格（前 3 项）和列表卡片规格行（前 4 项）。</p>
    <?php
}

function alumax_case_overview_box($post) {
    $header = alumax_case_header($post->ID);
    ?>
    <table class="form-table" style="max-width:720px;">
      <tr><th><label>Overview 标题</label></th>
        <td><input type="text" name="alumax_case_header[overview_heading]" value="<?php echo esc_attr($header['overview_heading']); ?>" class="large-text"> <span class="description">留空时使用文章标题</span></td></tr>
    </table>
    <p class="description">该板块其余内容无需在此编辑：正文段落取自文章编辑器内容；属性瓦片取自 01 Hero 面板的 Project Snapshot。</p>
    <?php
}

function alumax_case_gallery_box($post) {
    alumax_case_admin_js();
    $gallery = alumax_case_gallery($post->ID);
    ?>
    <h4>项目图集（固定四组：第 1 组为大图，留空时使用特色图片）</h4>
    <?php for ($i = 0; $i < 4; $i++) :
        $item = $gallery[$i];
        $input_id = 'alumax-case-gallery-image-' . $i;
        ?>
    <div style="border:1px solid #c3c4c7;padding:12px;margin-bottom:12px;max-width:960px;">
      <strong>图集 <?php echo $i + 1; ?><?php echo $i === 0 ? '（大图）' : ''; ?></strong>
      <table class="form-table" style="margin-top:4px;">
        <tr><th><label>图片</label></th>
          <td>
            <input type="text" id="<?php echo esc_attr($input_id); ?>" name="alumax_case_gallery[<?php echo $i; ?>][image]" value="<?php echo esc_attr($item['image']); ?>" class="large-text">
            <button type="button" class="button alumax-media-btn" data-target="<?php echo esc_attr($input_id); ?>">选择图片</button>
          </td></tr>
        <tr><th><label>标签</label></th>
          <td><input type="text" name="alumax_case_gallery[<?php echo $i; ?>][label]" value="<?php echo esc_attr($item['label']); ?>" class="regular-text"> <span class="description">如 COMPLETED FACADE ENVELOPE</span></td></tr>
        <tr><th><label>标题</label></th>
          <td><input type="text" name="alumax_case_gallery[<?php echo $i; ?>][title]" value="<?php echo esc_attr($item['title']); ?>" class="large-text"></td></tr>
        <tr><th><label>描述</label></th>
          <td><textarea name="alumax_case_gallery[<?php echo $i; ?>][desc]" class="large-text" rows="2"><?php echo esc_textarea($item['desc']); ?></textarea></td></tr>
      </table>
    </div>
    <?php endfor; ?>
    <p class="description">前台按 8 / 4 / 6 / 6 栅格拼版显示，标签显示为「序号 // 标签」。</p>
    <?php
}

function alumax_case_challenge_box($post) {
    alumax_case_admin_js();
    $challenge = alumax_case_challenge($post->ID);
    ?>
    <table class="form-table" style="max-width:960px;">
      <tr><th><label>标题</label></th>
        <td><input type="text" name="alumax_case_challenge[heading]" value="<?php echo esc_attr($challenge['heading']); ?>" class="large-text"></td></tr>
      <tr><th><label>正文</label></th>
        <td><textarea name="alumax_case_challenge[text]" class="large-text" rows="4"><?php echo esc_textarea($challenge['text']); ?></textarea>
          <p class="description">留空时不显示该段落（文章正文显示在 Overview 板块）。</p></td></tr>
      <tr><th><label>左侧配图</label></th>
        <td>
          <input type="text" id="alumax-case-challenge-image" name="alumax_case_challenge[image]" value="<?php echo esc_attr($challenge['image']); ?>" class="large-text">
          <button type="button" class="button alumax-media-btn" data-target="alumax-case-challenge-image">选择图片</button>
          <p class="description">留空时使用特色图片。</p>
        </td></tr>
      <tr><th><label>配图角标</label></th>
        <td><input type="text" name="alumax_case_challenge[image_label]" value="<?php echo esc_attr($challenge['image_label']); ?>" class="regular-text"> <span class="description">如 ON-SITE FACADE ERECTION</span></td></tr>
      <tr><th><label>配图标题</label></th>
        <td><input type="text" name="alumax_case_challenge[image_title]" value="<?php echo esc_attr($challenge['image_title']); ?>" class="large-text"></td></tr>
      <tr><th><label>配图描述</label></th>
        <td><textarea name="alumax_case_challenge[image_desc]" class="large-text" rows="2"><?php echo esc_textarea($challenge['image_desc']); ?></textarea></td></tr>
      <tr><th><label>细节小图</label></th>
        <td>
          <input type="text" id="alumax-case-challenge-image2" name="alumax_case_challenge[image2]" value="<?php echo esc_attr($challenge['image2']); ?>" class="large-text">
          <button type="button" class="button alumax-media-btn" data-target="alumax-case-challenge-image2">选择图片</button>
          <p class="description">左侧大图下方的细节小图，留空时使用图集第 2 组图片。</p>
        </td></tr>
      <tr><th><label>小图角标</label></th>
        <td><input type="text" name="alumax_case_challenge[image2_label]" value="<?php echo esc_attr($challenge['image2_label']); ?>" class="regular-text"> <span class="description">如 MACRO DETAIL</span></td></tr>
      <tr><th><label>小图标题</label></th>
        <td><input type="text" name="alumax_case_challenge[image2_title]" value="<?php echo esc_attr($challenge['image2_title']); ?>" class="large-text"></td></tr>
    </table>
    <h4>挑战条目卡片（可增删，前台自动按 01 / 02 / 03 编号）</h4>
    <?php
    alumax_case_repeater('alumax_case_challenge_cards', [
        'title' => ['label' => '标题', 'width' => '32%'],
        'text'  => ['label' => '内容', 'type' => 'textarea'],
    ], isset($challenge['cards']) ? $challenge['cards'] : [], '+ 添加条目');
}

function alumax_case_related_box() {
    ?>
    <p class="description">该板块自动读取最新发布的 3 个「产品」文章（特色图、产品分类、产品特性前 3 条），无需在此编辑；要调整内容请编辑对应产品。</p>
    <?php
}

function alumax_case_extra_box($post) {
    $verification_intro = alumax_case_verification_intro($post->ID);
    $systems_intro = alumax_case_systems_intro($post->ID);
    ?>
    <h4>Verification Metrics（详情页不渲染；前 6 行用于项目中心页 Spotlight 规格表）</h4>
    <table class="form-table" style="max-width:960px;">
      <tr><th><label>板块标题</label></th>
        <td><input type="text" name="alumax_case_verification_intro[heading]" value="<?php echo esc_attr($verification_intro['heading']); ?>" class="large-text"></td></tr>
      <tr><th><label>板块描述</label></th>
        <td><textarea name="alumax_case_verification_intro[text]" class="large-text" rows="2"><?php echo esc_textarea($verification_intro['text']); ?></textarea></td></tr>
    </table>
    <?php
    alumax_case_repeater('alumax_case_verification', [
        'param'       => ['label' => '参数', 'width' => '26%'],
        'requirement' => ['label' => '设计要求', 'width' => '24%'],
        'result'      => ['label' => '交付测试结果', 'width' => '28%'],
        'standard'    => ['label' => '参考标准'],
    ], alumax_case_verification($post->ID), '+ 添加指标行');
    ?>

    <h4 style="margin-top:24px;">下载资料（详情页不渲染；第一个有效链接用于 Spotlight 的 BIM 下载按钮）</h4>
    <?php
    alumax_case_repeater('alumax_case_downloads', [
        'icon'  => ['label' => '图标', 'width' => '12%'],
        'meta'  => ['label' => '文件信息', 'width' => '14%'],
        'title' => ['label' => '标题', 'width' => '22%'],
        'desc'  => ['label' => '描述', 'type' => 'textarea'],
        'url'   => ['label' => '下载链接', 'width' => '18%'],
        'btn'   => ['label' => '按钮文案', 'width' => '14%'],
    ], alumax_case_downloads($post->ID), '+ 添加下载');
    ?>
    <p class="description">文件信息如 DWG // 8.4 MB；图标填 Material Symbols 名称；下载链接为 # 时前台不显示该按钮。</p>

    <h4 style="margin-top:24px;">Material Substrates（当前前端模板未使用，数据保留备查）</h4>
    <table class="form-table" style="max-width:960px;">
      <tr><th><label>板块标题</label></th>
        <td><input type="text" name="alumax_case_systems_intro[heading]" value="<?php echo esc_attr($systems_intro['heading']); ?>" class="large-text"></td></tr>
      <tr><th><label>板块描述</label></th>
        <td><textarea name="alumax_case_systems_intro[text]" class="large-text" rows="2"><?php echo esc_textarea($systems_intro['text']); ?></textarea></td></tr>
    </table>
    <?php
    alumax_case_repeater('alumax_case_systems', [
        'icon'       => ['label' => '图标', 'width' => '12%'],
        'code'       => ['label' => '代号', 'width' => '14%'],
        'title'      => ['label' => '材料名称', 'width' => '22%'],
        'subtitle'   => ['label' => '副标题', 'width' => '18%'],
        'specs_text' => ['label' => '规格明细（每行：名称|数值）', 'type' => 'textarea'],
    ], alumax_case_systems($post->ID), '+ 添加材料');
}

/* -------------------------------------------------------------------------
 * 保存
 * ------------------------------------------------------------------------- */

function alumax_case_sanitize($value, $type) {
    if ($type === 'textarea') {
        return sanitize_textarea_field($value);
    }
    if ($type === 'url') {
        return esc_url_raw($value);
    }
    return sanitize_text_field($value);
}

/**
 * 收集 repeater 提交：$_POST[$field] 为 [列名 => [行值...]] 结构。
 * $columns: [列名 => 类型('text'|'textarea'|'url')]
 */
function alumax_case_collect_repeater($field, $columns) {
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
            $value = isset($posted[$col][$i]) ? alumax_case_sanitize($posted[$col][$i], $type) : '';
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

function alumax_case_save_repeater($post_id, $meta_key, $field, $columns) {
    update_post_meta($post_id, $meta_key, alumax_case_collect_repeater($field, $columns));
}

/**
 * 收集 [heading, text] 结构的板块标题字段。
 */
function alumax_case_collect_intro($field) {
    $posted = isset($_POST[$field]) ? (array) wp_unslash($_POST[$field]) : [];
    return [
        'heading' => isset($posted['heading']) ? sanitize_text_field($posted['heading']) : '',
        'text'    => isset($posted['text']) ? sanitize_textarea_field($posted['text']) : '',
    ];
}

add_action('save_post_case', function ($post_id) {
    if (!isset($_POST['alumax_case_details_nonce'])
        || !wp_verify_nonce(sanitize_key($_POST['alumax_case_details_nonce']), 'alumax_case_details_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // 页头信息
    $header_posted = isset($_POST['alumax_case_header']) ? (array) wp_unslash($_POST['alumax_case_header']) : [];
    $header = [];
    foreach (['ref_code', 'location', 'completed', 'certification', 'card_tagline', 'overview_heading'] as $f) {
        $header[$f] = isset($header_posted[$f]) ? sanitize_text_field($header_posted[$f]) : '';
    }
    update_post_meta($post_id, 'alumax_case_header', $header);

    // 模块 1 / 2
    alumax_case_save_repeater($post_id, 'alumax_case_snapshot', 'alumax_case_snapshot', ['label' => 'text', 'value' => 'text', 'sub' => 'text']);
    alumax_case_save_repeater($post_id, 'alumax_case_metrics', 'alumax_case_metrics', ['name' => 'text', 'value' => 'text', 'desc' => 'textarea', 'icon' => 'text']);

    // 模块 3：固定四组图集
    $gallery_posted = isset($_POST['alumax_case_gallery']) ? (array) wp_unslash($_POST['alumax_case_gallery']) : [];
    $gallery = [];
    for ($i = 0; $i < 4; $i++) {
        $item = isset($gallery_posted[$i]) ? (array) $gallery_posted[$i] : [];
        $gallery[] = [
            'image' => isset($item['image']) ? esc_url_raw($item['image']) : '',
            'label' => isset($item['label']) ? sanitize_text_field($item['label']) : '',
            'title' => isset($item['title']) ? sanitize_text_field($item['title']) : '',
            'desc'  => isset($item['desc']) ? sanitize_textarea_field($item['desc']) : '',
        ];
    }
    update_post_meta($post_id, 'alumax_case_gallery', $gallery);

    // 模块 4
    $challenge_posted = isset($_POST['alumax_case_challenge']) ? (array) wp_unslash($_POST['alumax_case_challenge']) : [];
    update_post_meta($post_id, 'alumax_case_challenge', [
        'heading'     => isset($challenge_posted['heading']) ? sanitize_text_field($challenge_posted['heading']) : '',
        'text'        => isset($challenge_posted['text']) ? sanitize_textarea_field($challenge_posted['text']) : '',
        'image'       => isset($challenge_posted['image']) ? esc_url_raw($challenge_posted['image']) : '',
        'image_label' => isset($challenge_posted['image_label']) ? sanitize_text_field($challenge_posted['image_label']) : '',
        'image_title' => isset($challenge_posted['image_title']) ? sanitize_text_field($challenge_posted['image_title']) : '',
        'image_desc'  => isset($challenge_posted['image_desc']) ? sanitize_textarea_field($challenge_posted['image_desc']) : '',
        'image2'        => isset($challenge_posted['image2']) ? esc_url_raw($challenge_posted['image2']) : '',
        'image2_label'  => isset($challenge_posted['image2_label']) ? sanitize_text_field($challenge_posted['image2_label']) : '',
        'image2_title'  => isset($challenge_posted['image2_title']) ? sanitize_text_field($challenge_posted['image2_title']) : '',
        'cards'       => alumax_case_collect_repeater('alumax_case_challenge_cards', ['title' => 'text', 'text' => 'textarea']),
    ]);

    // 模块 5
    update_post_meta($post_id, 'alumax_case_systems_intro', alumax_case_collect_intro('alumax_case_systems_intro'));
    alumax_case_save_repeater($post_id, 'alumax_case_systems', 'alumax_case_systems', ['icon' => 'text', 'code' => 'text', 'title' => 'text', 'subtitle' => 'text', 'specs_text' => 'textarea']);

    // 模块 6
    update_post_meta($post_id, 'alumax_case_verification_intro', alumax_case_collect_intro('alumax_case_verification_intro'));
    alumax_case_save_repeater($post_id, 'alumax_case_verification', 'alumax_case_verification', ['param' => 'text', 'requirement' => 'text', 'result' => 'text', 'standard' => 'text']);

    // 模块 7
    alumax_case_save_repeater($post_id, 'alumax_case_downloads', 'alumax_case_downloads', ['icon' => 'text', 'meta' => 'text', 'title' => 'text', 'desc' => 'textarea', 'url' => 'url', 'btn' => 'text']);
});
