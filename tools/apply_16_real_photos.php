<?php
/**
 * Apply 16 Real Architectural Photos to WordPress Cases
 */

if (!defined('ABSPATH')) {
    exit;
}

echo "Applying 16 Real Architectural Photos...\n";

function alumax_import_real_photo($rel_path, $title) {
    global $wpdb;
    $fname = basename($rel_path);
    
    // If already exists, return existing ID
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1",
        '%' . $wpdb->esc_like($fname) . '%'
    ));
    if ($existing) {
        return (int) $existing;
    }
    
    $full_path = ABSPATH . $rel_path;
    if (!file_exists($full_path)) {
        echo "Missing file: $full_path\n";
        return 0;
    }
    
    $upload_dir = wp_upload_dir();
    $target = $upload_dir['path'] . '/' . $fname;
    copy($full_path, $target);
    
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

$updates = [
    'wuhu-aux-smart-manufacturing-industrial-park' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_28_aux.jpg',
        'title' => 'Wuhu AUX Smart Manufacturing Headquarters Facade'
    ],
    'nanjing-integrated-circuit-innovation-park' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_25_nanjing_ic.jpg',
        'title' => 'Nanjing Integrated Circuit Innovation Park Twin Towers'
    ],
    'luan-technical-college-campus-development' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_23_luan_college.jpg',
        'title' => 'Lu\'an Technical College Engineering Campus Complex'
    ],
    'linquan-agricultural-logistics-trade-hub' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_22_linquan.jpg',
        'title' => 'Linquan Agricultural Logistics & Trade Center'
    ],
    'lanzhou-north-express-toll-plaza-landmark' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_21_lanzhou.jpg',
        'title' => 'Lanzhou North Express Toll Plaza Landmark Canopy'
    ],
    'jiangxi-tea-culture-eco-tourism-complex' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_19_jiangxi_tea.jpg',
        'title' => 'Jiangxi Tea Culture Eco-Tourism Grand Complex'
    ],
    'huangshan-high-tech-innovation-center' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_18_huangshan.jpg',
        'title' => 'Huangshan High-Tech Innovation Center Tower & Waterfront'
    ],
    'huaheng-biotechnology-pharmaceutical-complex' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_16_huaheng.jpg',
        'title' => 'Huaheng Biotechnology Pharmaceutical R&D Complex'
    ],
    'east-china-normal-university-affiliated-campus' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_15_ecnu_highschool.jpg',
        'title' => 'East China Normal University Affiliated High School Campus'
    ],
    'feixi-east-china-horticultural-expo-flower-city' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_06_feixi_flower.jpg',
        'title' => 'Feixi East China Horticultural Expo & Flower City Pavilion'
    ],
    'hongda-kunlunyin-luxury-architectural-residences' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_12_kunlunyin.jpg',
        'title' => 'Hongda Kunlunyin Luxury Architectural Residences'
    ],
    'new-oriental-education-global-headquarters-hefei' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_10_new_oriental.jpg',
        'title' => 'New Oriental Education Global Headquarters Tower Hefei'
    ],
    'hangzhou-mianbeili-waterfront-cultural-complex' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_07_mianbeili.jpg',
        'title' => 'Hangzhou Mianbeili Historic Waterfront Cultural Complex'
    ],
    'chuzhou-vocational-technical-college-campus' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_03_chuzhou.jpg',
        'title' => 'Chuzhou Vocational & Technical College Campus'
    ],
    'anhui-grand-provincial-arts-center' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_02_anhui_arts.jpg',
        'title' => 'Anhui Grand Provincial Arts Center'
    ],
    'anhui-university-life-sciences-research-complex' => [
        'file'  => 'downloaded_case_images/processed_real/real_photo_01_anhui_univ.jpg',
        'title' => 'Anhui University Life Sciences Research Complex'
    ],
];

foreach ($updates as $slug => $info) {
    $post = get_page_by_path($slug, OBJECT, 'case');
    if (!$post) {
        echo "Could not find post for slug: $slug\n";
        continue;
    }
    $post_id = $post->ID;
    $aid = alumax_import_real_photo($info['file'], $info['title']);
    if (!$aid) {
        echo "Failed to import attachment for: $slug\n";
        continue;
    }
    
    // Set featured image
    set_post_thumbnail($post_id, $aid);
    $url = wp_get_attachment_url($aid);
    
    // Update Card 1 in Gallery
    $gallery = get_post_meta($post_id, 'alumax_case_gallery', true);
    if (is_array($gallery) && !empty($gallery)) {
        $gallery[0]['image'] = $url;
        update_post_meta($post_id, 'alumax_case_gallery', $gallery);
    }
    
    echo "Successfully updated case [$slug] -> $url (AID: $aid)\n";
}

echo "All 16 cases updated with real photographic imagery!\n";
