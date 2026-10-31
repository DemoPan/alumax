<?php

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------
 * 联系我们页设置：页面全部文案在「联系我们设置」编辑，未保存时显示默认值
 * 表单复用产品页公共询价表单（template-parts/product-sections/inquiry.php）
 * ------------------------------------------------------------------------- */

function alumax_contact_defaults() {
    $defaults = [
        // Hero
        'hero_eyebrow'      => 'Global Façade Engineering Consultation',
        'hero_title'        => 'Get in Touch with ALUMAX.',
        'hero_title_accent' => 'Let\'s Build Something Remarkable.',
        'hero_desc'         => 'Connect with our global facade engineering team for technical consultations, custom specifications, structural takeoff, and sample logistics.',
        'hero_image'        => 'https://lh3.googleusercontent.com/aida/AEtjO1XLmLasodi4t5eS1a8XRjjEdyLtPH4mzGF_IS2OCs06faN4UgzK5aHqfIuK8yKyFY409q7DiZKbpWYQcDFJZwSn6Aq9qooYeljdq4N6cnW3NUlO1CIMSlVaJeUejQf4rVQ78ZaAoqcobV7Stll9hCtIKGL2giU73Soc2B1YXBRM1Db7lNts0fZHUFAuY_c5eifdp4-L94hVaPWq185FrBd4F9q_TNCTNgSpUBalH_9J6Z963vPPIgclgQ',
        // Office
        'office_eyebrow' => 'Our Office',
        'office_title'   => 'Visit Our Office',
        'office_desc'    => 'We are based in Foshan & Suzhou, China, and welcome you to get in touch with our engineering and export consultation team. You can also reach us via phone, email, or direct WhatsApp for expedited technical review.',
        'map_label'      => 'Foshan / Nanhai Metropolitan Core Plant',
        'map_url'        => 'https://maps.google.com',
        // 询价表单板块（公共表单组件）
        'form_eyebrow'    => 'Get In Touch',
        'form_title'      => 'Send Us a Message',
        'form_desc'       => 'Fill out the form below and tell us about your project specifications. Our structural engineers will review your submittals and contact you with detailed pricing and lead times.',
        'form_card_title' => 'Engineering Inquiry Form',
        'form_card_badge' => '24H Response',
        'form_submit'     => 'Submit Engineering Inquiry',
    ];

    // Hero 特性条（3 条）
    $pills = [
        ['icon' => 'schedule', 'text' => '24h Engineering Takeoff'],
        ['icon' => 'local_shipping', 'text' => 'Direct Factory Dispatch'],
        ['icon' => 'verified_user', 'text' => 'NDA Protected'],
    ];
    foreach ($pills as $i => $pill) {
        $n = $i + 1;
        foreach ($pill as $prop => $value) {
            $defaults["hero_pill{$n}_{$prop}"] = $value;
        }
    }

    // 联系信息行（3 行）
    $rows = [
        ['icon' => 'location_on', 'label' => 'Address', 'line1' => 'No. 88, Industrial Avenue, Nanhai District, Foshan, Guangdong, China 528225', 'line2' => ''],
        ['icon' => 'call', 'label' => 'Phone & WhatsApp', 'line1' => '+86 757 8820 9000 · WhatsApp: +86 138 2819 0280', 'line2' => 'Mon – Sat, 8:30 – 18:00 (GMT+8)'],
        ['icon' => 'mail', 'label' => 'Email', 'line1' => 'export@alumax-facade.com / info@alumax.com', 'line2' => 'Formal engineering quote transmitted within 24 hours.'],
    ];
    foreach ($rows as $i => $row) {
        $n = $i + 1;
        foreach ($row as $prop => $value) {
            $defaults["office_row{$n}_{$prop}"] = $value;
        }
    }

    // 表单左侧价值点（3 条）
    $bullets = [
        ['icon' => 'schedule', 'title' => '24h Engineering Response', 'text' => 'Technical takeoff and quotation returned within one business day.'],
        ['icon' => 'local_shipping', 'title' => 'Direct Factory Dispatch', 'text' => 'FOB / CIF export logistics direct from the Foshan fabrication campus.'],
        ['icon' => 'verified_user', 'title' => 'NDA Protected', 'text' => 'Drawings and tender documents kept strictly confidential under NDA.'],
    ];
    foreach ($bullets as $i => $bullet) {
        $n = $i + 1;
        foreach ($bullet as $prop => $value) {
            $defaults["form_bullet{$n}_{$prop}"] = $value;
        }
    }

    return $defaults;
}

function alumax_contact_fields() {
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
                $text('hero_eyebrow', '眉标徽章'),
                $text('hero_title', '主标题（第一行）'),
                $text('hero_title_accent', '主标题（第二行高亮）'),
                $textarea('hero_desc', '简介'),
                $image('hero_image', '背景图'),
            ],
        ],
        'hero_pills' => ['label' => 'Hero 特性条（3 条）', 'fields' => []],
        'office' => [
            'label' => 'Our Office 办公信息',
            'fields' => [
                $text('office_eyebrow', '眉标'),
                $text('office_title', '标题'),
                $textarea('office_desc', '简介'),
                $text('map_label', '地图标注文案'),
                $url('map_url', 'Google Maps 链接'),
            ],
        ],
        'office_rows' => ['label' => '联系方式行（3 行）', 'fields' => []],
        'form' => [
            'label' => '询价表单板块（公共表单组件，与产品页一致）',
            'fields' => [
                $text('form_eyebrow', '眉标'),
                $text('form_title', '标题'),
                $textarea('form_desc', '描述'),
                $text('form_card_title', '表单卡标题'),
                $text('form_card_badge', '表单卡角标'),
                $text('form_submit', '提交按钮文案'),
            ],
        ],
        'form_bullets' => ['label' => '表单左侧价值点（3 条）', 'fields' => []],
    ];

    for ($i = 1; $i <= 3; $i++) {
        $groups['hero_pills']['fields'][] = $text("hero_pill{$i}_icon", "特性 {$i} 图标（Material Symbols）");
        $groups['hero_pills']['fields'][] = $text("hero_pill{$i}_text", "特性 {$i} 文案");

        $groups['office_rows']['fields'][] = $text("office_row{$i}_icon", "行 {$i} 图标");
        $groups['office_rows']['fields'][] = $text("office_row{$i}_label", "行 {$i} 标签");
        $groups['office_rows']['fields'][] = $text("office_row{$i}_line1", "行 {$i} 第一行内容");
        $groups['office_rows']['fields'][] = $text("office_row{$i}_line2", "行 {$i} 第二行内容（可空）");

        $groups['form_bullets']['fields'][] = $text("form_bullet{$i}_icon", "价值点 {$i} 图标");
        $groups['form_bullets']['fields'][] = $text("form_bullet{$i}_title", "价值点 {$i} 标题");
        $groups['form_bullets']['fields'][] = $text("form_bullet{$i}_text", "价值点 {$i} 描述");
    }

    return $groups;
}

function alumax_contact($key) {
    static $opts = null;
    if ($opts === null) {
        $opts = wp_parse_args(get_option('alumax_contact', []), alumax_contact_defaults());
    }
    return isset($opts[$key]) ? $opts[$key] : '';
}

alumax_add_settings_page(
    'alumax_contact',
    '联系我们设置',
    'dashicons-email-alt',
    32,
    '这里的每一项对应「联系我们」页的一个模块内容；留空会显示默认值。表单字段与产品页公共询价表单一致，提交记录在「询价记录」查看。',
    'alumax_contact_defaults',
    'alumax_contact_fields'
);
