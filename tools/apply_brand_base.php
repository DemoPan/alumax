<?php
if (!defined('ABSPATH')) {
    exit;
}

// 1. Update alumax_site option
$site = get_option('alumax_site', []);
if (is_array($site)) {
    $site['brand_name'] = 'Aluviona';
    $site['copyright_text'] = '© {year} Aluviona Architectural Metal Solutions Co., Ltd. All rights reserved.';
    update_option('alumax_site', $site);
    echo "Updated alumax_site option.\n";
}

// 2. Update alumax_home option
$home = get_option('alumax_home', []);
if (is_array($home)) {
    $home['hero_badge'] = 'ARCHITECTURAL METAL SOLUTIONS // Shaping Architecture with Metal.';
    update_option('alumax_home', $home);
    echo "Updated alumax_home option.\n";
}

// 3. Update WordPress core options
update_option('blogname', 'Aluviona');
update_option('blogdescription', 'Architectural Metal Solutions — Shaping Architecture with Metal.');
echo "Updated blogname and blogdescription.\n";
