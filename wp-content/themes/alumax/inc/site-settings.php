<?php

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------
 * 站点设置：页脚品牌信息 / 认证标签 / 全球总部信息
 * 未保存时显示默认值；留空字段回退到默认值
 * ------------------------------------------------------------------------- */

function alumax_site_defaults() {
    $defaults = [
        // 品牌信息（页脚第一列）
        'brand_logo'    => '',
        'brand_name'    => 'ALUMAX ARCHITECTURAL',
        'brand_summary' => 'Global premier manufacturer of precision-engineered curtain walls, motorized adaptive facades, and high-performance architectural envelopes. Supplying tested systems to over 60 countries across Europe, the Middle East, Southeast Asia, and the Americas.',
        // 全球总部信息（页脚第四列）
        'hq_title'     => 'Global Headquarters',
        'hq_desc'      => 'Engineering Consultation & Overseas Export Support Center.',
        'hq_link_text' => 'Global Representative Network →',
        'hq_link_url'  => '',
        // 底部版权信息（页脚最底部）
        'copyright_text' => '© {year} ALUMAX Architectural Envelopes Co., Ltd. All rights reserved. Precision Architectural Facade Systems.',
        // 社媒链接（行数不限，页脚第一列）
        'socials' => [
            ['label' => 'LinkedIn', 'image' => '', 'url' => '#'],
            ['label' => 'YouTube', 'image' => '', 'url' => '#'],
            ['label' => 'X (Twitter)', 'image' => '', 'url' => '#'],
            ['label' => 'WeChat', 'image' => '', 'url' => '#'],
            ['label' => 'Instagram', 'image' => '', 'url' => '#'],
        ],
        // 认证标签（行数不限，页脚第一列）
        'certs' => [
            ['image' => '', 'text' => 'ISO 9001:2015'],
            ['image' => '', 'text' => 'CE Certified'],
            ['image' => '', 'text' => 'ASTM E84 / EN13501 A2'],
            ['image' => '', 'text' => 'BMS IoT Ready'],
        ],
    ];

    // 总部信息行（3 行）
    $rows = [
        ['icon' => 'location_on', 'text' => 'Foshan, Guangdong, CN // Global HQ & Manufacturing Center'],
        ['icon' => 'call', 'text' => '+86 757 8820 9000 · Mon – Sat, 8:30 – 18:00 (GMT+8)'],
        ['icon' => 'mail', 'text' => 'export@alumax-facade.com'],
    ];
    foreach ($rows as $i => $row) {
        $n = $i + 1;
        foreach ($row as $prop => $value) {
            $defaults["hq_row{$n}_{$prop}"] = $value;
        }
    }

    return $defaults;
}

function alumax_site_fields() {
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
        'brand' => [
            'label' => '品牌信息（页脚第一列）',
            'fields' => [
                $image('brand_logo', '公司 Logo', '从媒体库上传/选择；留空则显示默认图形标志'),
                $text('brand_name', '公司名称'),
                $textarea('brand_summary', '公司简介'),
            ],
        ],
        'socials' => [
            'label' => '社媒链接（页脚第一列）',
            'note' => '可自由增删行；链接留空则该社媒不显示',
            'fields' => [
                [
                    'key'    => 'socials',
                    'label'  => '社媒列表',
                    'type'   => 'repeater',
                    'fields' => [
                        ['key' => 'label', 'label' => '名称', 'type' => 'text'],
                        ['key' => 'image', 'label' => '图标图片', 'type' => 'image', 'desc' => '建议 40×40px 正方形 PNG / SVG，透明底、白色图形'],
                        ['key' => 'url', 'label' => '链接', 'type' => 'url'],
                    ],
                ],
            ],
        ],
        'certs' => [
            'label' => '认证标签（页脚第一列）',
            'note' => '可自由增删行',
            'fields' => [
                [
                    'key'    => 'certs',
                    'label'  => '认证标签列表',
                    'type'   => 'repeater',
                    'fields' => [
                        ['key' => 'image', 'label' => '图标图片', 'type' => 'image', 'desc' => '建议 32×32px PNG / SVG，透明底、白色图形；留空则只显示文案'],
                        ['key' => 'text', 'label' => '文案', 'type' => 'text'],
                    ],
                ],
            ],
        ],
        'hq' => [
            'label' => '全球总部信息（页脚第四列）',
            'fields' => [
                $text('hq_title', '列标题'),
                $textarea('hq_desc', '简介'),
                $text('hq_link_text', '底部链接文案'),
                $url('hq_link_url', '底部链接地址', '留空时默认指向「联系我们」页'),
            ],
        ],
        'hq_rows' => ['label' => '总部信息行（3 行）', 'fields' => []],
        'copyright' => [
            'label' => '底部版权信息',
            'fields' => [
                $text('copyright_text', '版权文案', '其中 {year} 会自动替换为当前年份'),
            ],
        ],
    ];

    for ($i = 1; $i <= 3; $i++) {
        $groups['hq_rows']['fields'][] = $text("hq_row{$i}_icon", "行 {$i} 图标（Material Symbols）");
        $groups['hq_rows']['fields'][] = $text("hq_row{$i}_text", "行 {$i} 内容");
    }

    return $groups;
}

function alumax_site($key) {
    static $opts = null;
    if ($opts === null) {
        $opts = wp_parse_args(get_option('alumax_site', []), alumax_site_defaults());
    }
    return isset($opts[$key]) ? $opts[$key] : '';
}

alumax_add_settings_page(
    'alumax_site',
    '站点设置',
    'dashicons-admin-site',
    30,
    '页脚品牌信息、认证标签与全球总部信息；留空会显示默认值。页脚产品/项目列表自动读取最新发布的内容，无需在此配置。',
    'alumax_site_defaults',
    'alumax_site_fields'
);
