<?php
/**
 * Upgrade Case Images in WordPress
 * Correct slugs and media imports
 */

if (!defined('ABSPATH')) {
    exit;
}

echo "Starting Case Images Upgrade (Phase 2)...\n";

function alumax_ensure_attachment($rel_path, $title) {
    global $wpdb;
    $fname = basename($rel_path);
    
    $aid = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1",
        '%' . $wpdb->esc_like($fname) . '%'
    ));
    if ($aid) {
        return (int) $aid;
    }
    
    $full_path = ABSPATH . $rel_path;
    if (!file_exists($full_path)) {
        // check inside wp-content/uploads/2026/11
        $alt_path = ABSPATH . 'wp-content/uploads/2026/11/' . $fname;
        if (file_exists($alt_path)) {
            $full_path = $alt_path;
        } else {
            echo "Cannot find file: $rel_path\n";
            return 0;
        }
    }
    
    $upload_dir = wp_upload_dir();
    $target = $upload_dir['path'] . '/' . $fname;
    if (!file_exists($target)) {
        copy($full_path, $target);
    }
    
    $filetype = wp_check_filetype($fname, null);
    $attachment = [
        'guid'           => $upload_dir['url'] . '/' . $fname,
        'post_mime_type' => $filetype['type'],
        'post_title'     => $title,
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];
    $attach_id = wp_insert_attachment($attachment, $target);
    $attach_data = wp_generate_attachment_metadata($attach_id, $target);
    wp_update_attachment_metadata($attach_id, $attach_data);
    return (int) $attach_id;
}

// Ensure attachments exist
$aid_m16 = alumax_ensure_attachment('wp-content/uploads/2026/11/news_img_16_c75d2f0b.jpg', 'Wuxi Metro Line 2 Station Concourse');
$aid_m17 = alumax_ensure_attachment('wp-content/uploads/2026/11/news_img_17_cbfc14a2.jpg', 'Wuxi Metro Line 2 Platform');
$aid_m18 = alumax_ensure_attachment('wp-content/uploads/2026/11/news_img_18_3def6349.jpg', 'Wuxi Metro Line 2 Hall');
$aid_s19 = alumax_ensure_attachment('wp-content/uploads/2026/11/news_img_19_5f1bfe39.jpg', 'Lu\'an Youth Sports Academy Architectural Facade');
$aid_s21 = alumax_ensure_attachment('wp-content/uploads/2026/11/news_img_21_4ca4522a.jpg', 'Lu\'an Youth Sports Academy Rhombic Cladding Detail');
$aid_w22 = alumax_ensure_attachment('wp-content/uploads/2026/11/news_img_22_c4fb4886.jpg', 'Wuyuan Traditional Chinese Medicine Industrial Park Facade');
$aid_h04 = alumax_ensure_attachment('wp-content/uploads/2026/11/news_img_04_d5e60d34.jpg', 'Huzhou Rail Transit Operations Facility Clean Exterior');
$aid_m07 = alumax_ensure_attachment('downloaded_case_images/case_07_1_clean.jpg', 'Hangzhou Mianbeili Historic Waterfront Cultural Complex');

$url_m16 = $aid_m16 ? wp_get_attachment_url($aid_m16) : '/wp-content/uploads/2026/11/news_img_16_c75d2f0b.jpg';
$url_m17 = $aid_m17 ? wp_get_attachment_url($aid_m17) : '/wp-content/uploads/2026/11/news_img_17_cbfc14a2.jpg';
$url_m18 = $aid_m18 ? wp_get_attachment_url($aid_m18) : '/wp-content/uploads/2026/11/news_img_18_3def6349.jpg';
$url_s19 = $aid_s19 ? wp_get_attachment_url($aid_s19) : '/wp-content/uploads/2026/11/news_img_19_5f1bfe39.jpg';
$url_s21 = $aid_s21 ? wp_get_attachment_url($aid_s21) : '/wp-content/uploads/2026/11/news_img_21_4ca4522a.jpg';
$url_w22 = $aid_w22 ? wp_get_attachment_url($aid_w22) : '/wp-content/uploads/2026/11/news_img_22_c4fb4886.jpg';
$url_h04 = $aid_h04 ? wp_get_attachment_url($aid_h04) : '/wp-content/uploads/2026/11/news_img_04_d5e60d34.jpg';
$url_m07 = $aid_m07 ? wp_get_attachment_url($aid_m07) : '/wp-content/uploads/2026/11/case_07_1_clean.jpg';

$url_detail_cnc = '/wp-content/uploads/2026/11/news_img_07_d752b3ee.jpg';
$url_detail_factory = '/wp-content/uploads/2026/11/news_img_08_5a54c7cd.jpg';

// Exact slug mapping
$exact_upgrades = [
    'wuxi-metro-line-2-transit-stations-network' => [
        'aid' => $aid_m16,
        'url' => $url_m16,
        'gallery' => [$url_m16, $url_m17, $url_m18, $url_detail_factory]
    ],
    'wuyuan-traditional-chinese-medicine-health-park' => [
        'aid' => $aid_w22,
        'url' => $url_w22,
    ],
    'luan-youth-sports-academy-arena-complex' => [
        'aid' => $aid_s19,
        'url' => $url_s19,
        'gallery' => [$url_s19, $url_s21, $url_detail_cnc, $url_detail_factory]
    ],
    'huzhou-rail-transit-infrastructure-facility' => [
        'aid' => $aid_h04,
        'url' => $url_h04,
    ],
    'hangzhou-mianbeili-waterfront-cultural-complex' => [
        'aid' => $aid_m07,
        'url' => $url_m07,
    ],
];

foreach ($exact_upgrades as $slug => $data) {
    $post = get_page_by_path($slug, OBJECT, 'case');
    if (!$post) {
        echo "Could not find case with slug: $slug\n";
        continue;
    }
    $post_id = $post->ID;
    
    if (!empty($data['aid'])) {
        set_post_thumbnail($post_id, $data['aid']);
        echo "Updated featured image for [$slug] (AID: {$data['aid']})\n";
    }
    
    if (!empty($data['gallery'])) {
        $g_imgs = $data['gallery'];
        $gallery = [
            [
                'image' => $g_imgs[0],
                'label' => 'COMPLETED FACADE',
                'title' => 'Main Exterior Perspective',
                'desc'  => 'Precision-installed architectural envelope under natural daylight.'
            ],
            [
                'image' => $g_imgs[1],
                'label' => 'SUB-ASSEMBLY DETAIL',
                'title' => 'Formed Edge & Joint Alignment',
                'desc'  => 'CNC routed joints and mounting brackets maintaining ±0.3mm installation tolerances.'
            ],
            [
                'image' => $g_imgs[2],
                'label' => 'ARCHITECTURAL PROFILE',
                'title' => 'Spandrel & Reveal Interface',
                'desc'  => 'Clean shadow reveal integration with structural curtain wall mullions.'
            ],
            [
                'image' => $g_imgs[3],
                'label' => 'SURFACE FINISH & QC',
                'title' => 'Fluorocarbon Coating & Quality Inspection',
                'desc'  => 'Factory-applied multi-coat PVDF finish subjected to comprehensive batch colorimeter testing.'
            ]
        ];
        update_post_meta($post_id, 'alumax_case_gallery', $gallery);
        echo "Updated custom gallery for [$slug]\n";
    }
}

echo "Phase 2 upgrades finished successfully!\n";
