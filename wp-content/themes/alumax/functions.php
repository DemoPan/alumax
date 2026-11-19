<?php

if (!defined('ABSPATH')) {
    exit;
}

function alumax_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
}

add_action('after_setup_theme', 'alumax_setup');

function alumax_assets() {
    wp_enqueue_style(
        'alumax-fonts',
        'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Manrope:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'alumax-material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0',
        [],
        null
    );

    wp_enqueue_style(
        'alumax-material-symbols-variable',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
        [],
        null
    );

    $css_file = get_template_directory() . '/assets/css/main.min.css';
    $css_ver  = file_exists($css_file) ? filemtime($css_file) : '1.0.0';
    wp_enqueue_style(
        'alumax-main',
        get_template_directory_uri() . '/assets/css/main.min.css',
        [],
        $css_ver
    );
}

add_action('wp_enqueue_scripts', 'alumax_assets');

function alumax_register_post_types() {
    register_post_type('case', [
        'labels' => [
            'name' => __('Projects', 'alumax'),
            'singular_name' => __('Project', 'alumax'),
        ],
        'public' => true,
        'has_archive' => 'projects',
        'rewrite' => ['slug' => 'projects'],
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'show_in_rest' => true,
    ]);

    register_post_type('product', [
        'labels' => [
            'name' => __('Products', 'alumax'),
            'singular_name' => __('Product', 'alumax'),
        ],
        'public' => true,
        'has_archive' => 'products',
        'rewrite' => ['slug' => 'products'],
        'menu_icon' => 'dashicons-screenoptions',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'show_in_rest' => true,
    ]);

    register_taxonomy('product_category', 'product', [
        'labels' => [
            'name' => __('Product Categories', 'alumax'),
            'singular_name' => __('Product Category', 'alumax'),
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'product-category'],
    ]);
    register_post_type('news', [
        'labels' => [
            'name' => __('News', 'alumax'),
            'singular_name' => __('News Article', 'alumax'),
        ],
        'public' => true,
        'has_archive' => 'news',
        'rewrite' => ['slug' => 'news'],
        'menu_icon' => 'dashicons-megaphone',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'author'],
        'show_in_rest' => true,
    ]);

    register_taxonomy('news_category', 'news', [
        'labels' => [
            'name' => __('News Categories', 'alumax'),
            'singular_name' => __('News Category', 'alumax'),
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'news-category'],
    ]);

    register_taxonomy('news_tag', 'news', [
        'labels' => [
            'name' => __('News Tags', 'alumax'),
            'singular_name' => __('News Tag', 'alumax'),
        ],
        'hierarchical' => false,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'news-tag'],
    ]);
}

add_action('init', 'alumax_register_post_types');

function alumax_news_rewrite_flush() {
    if (get_option('alumax_news_rewrite_version') !== '1') {
        flush_rewrite_rules();
        update_option('alumax_news_rewrite_version', '1');
    }
}

add_action('init', 'alumax_news_rewrite_flush', 20);

function alumax_news_url() {
    $link = get_post_type_archive_link('news');
    return $link ? $link : home_url('/news/');
}

function alumax_ensure_static_pages() {
    if (get_option('alumax_static_pages_version') === '1') {
        return;
    }

    $pages = [
        'about' => 'About Us',
        'contact' => 'Contact',
        'resources' => 'Resources',
    ];

    foreach ($pages as $slug => $title) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_title' => $title,
                'post_name' => $slug,
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);
        }
    }

    update_option('alumax_static_pages_version', '1');
}

add_action('init', 'alumax_ensure_static_pages', 20);

function alumax_ensure_legal_pages() {
    if (get_option('alumax_legal_pages_version') === '2') {
        return;
    }

    $pages = [
        'privacy-policy' => [
            'Privacy Policy',
            '<p><em>Last updated: ' . gmdate('F j, Y') . '</em></p>
<h2>1. Information We Collect</h2>
<p>ALUVIONA Architectural Envelopes Co., Ltd. ("ALUVIONA", "we", "us") collects only the information you voluntarily submit through our inquiry and consultation forms, including your name, company, email address, phone number, and project specifications.</p>
<h2>2. How We Use Your Information</h2>
<p>Submitted information is used exclusively to respond to engineering inquiries, prepare structural takeoffs and quotations, arrange sample logistics, and maintain business correspondence related to your project.</p>
<h2>3. Data Protection</h2>
<p>All tender documents, architectural drawings, and project data are treated as confidential and protected under mutual NDA where applicable. We do not sell, rent, or disclose your information to third parties except where required by law or necessary to fulfill logistics and export documentation.</p>
<h2>4. Data Retention</h2>
<p>Inquiry records are retained for the duration of the business relationship and archived thereafter in accordance with applicable commercial regulations. You may request deletion of your data at any time via <a href="mailto:export@aluviona.com">export@aluviona.com</a>.</p>',
        ],
        'export-compliance' => [
            'Export Compliance & Certifications',
            '<p><em>Last updated: ' . gmdate('F j, Y') . '</em></p>
<h2>1. Export Compliance Statement</h2>
<p>ALUVIONA conducts all export operations in strict compliance with the export control laws and customs regulations of the People\'s Republic of China and the import requirements of destination markets. All shipments are accompanied by complete commercial invoices, packing lists, certificates of origin, and product test documentation.</p>
<h2>2. Product Certifications</h2>
<ul>
<li>EN 13501-1 Class A2-s1, d0 &amp; A1 fire reaction classification</li>
<li>ASTM E84 Class A flame spread certification</li>
<li>AAMA 2605 architectural coating performance (10-year Florida weathering)</li>
<li>ASTM E330 structural wind load testing to 5.0 kPa</li>
<li>ISO 9001:2015 &amp; ISO 14001 certified manufacturing (TÜV SÜD audited)</li>
<li>CE marking under CPR 305/2011 for curtain wall systems</li>
</ul>
<h2>3. Documentation Support</h2>
<p>Full submittal packages, third-party test reports, BIM LOD 400 objects, and material certificates are available on request through our export desk.</p>',
        ],
        'terms-of-supply' => [
            'Terms of Supply',
            '<p><em>Last updated: ' . gmdate('F j, Y') . '</em></p>
<h2>1. Quotations & Orders</h2>
<p>All quotations are valid for 30 days unless otherwise stated. Orders are confirmed upon receipt of signed pro forma invoice and agreed deposit. Custom-engineered panels are manufactured to approved shop drawings only.</p>
<h2>2. Lead Time & Delivery</h2>
<p>Standard production lead time is 15–25 business days after drawing approval. Export terms are offered on FOB / CIF basis from our Foshan manufacturing campus; all export crating follows zero-micro-scratch protocols.</p>
<h2>3. Quality & Warranty</h2>
<p>All panels are manufactured under ISO 9001:2015 quality management with ±0.3 mm milling tolerance. PVDF coating systems carry up to 10-year weathering warranties per AAMA 2605. Claims must be submitted with photographic evidence within 30 days of receipt.</p>
<h2>4. Liability</h2>
<p>ALUVIONA\'s liability is limited to replacement or refund of non-conforming goods. Installation, structural design verification, and site conditions remain the responsibility of the contractor and project engineer of record.</p>',
        ],
    ];

    foreach ($pages as $slug => $page) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            wp_insert_post([
                'post_title'   => $page[0],
                'post_name'    => $slug,
                'post_content' => $page[1],
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ]);
        } elseif ($existing->post_status !== 'publish') {
            // 已存在同 slug 的非发布页面（如 WP 自带的 Privacy Policy 草稿）：直接发布并写入默认内容
            wp_update_post([
                'ID'           => $existing->ID,
                'post_title'   => $page[0],
                'post_content' => $page[1],
                'post_status'  => 'publish',
            ]);
        }
    }

    update_option('alumax_legal_pages_version', '2');
}

add_action('init', 'alumax_ensure_legal_pages', 20);

function alumax_news_primary_term($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $terms = get_the_terms($post_id, 'news_category');
    return ($terms && !is_wp_error($terms)) ? $terms[0] : null;
}

function alumax_reading_time($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $words = str_word_count(wp_strip_all_tags(get_post_field('post_content', $post_id)));
    $minutes = (int) max(1, ceil($words / 200));
    return $minutes . ' min read';
}

function alumax_nav_class($active) {
    return $active
        ? 'font-label-md text-label-md text-white border-b-2 border-secondary pb-1 tracking-wider uppercase'
        : 'font-label-md text-label-md text-slate-300 hover:text-white transition-colors uppercase tracking-wider';
}

function alumax_product_archive_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_post_type_archive('product')) {
            $query->set('posts_per_page', 11);
        } elseif ($query->is_post_type_archive('news')) {
            $query->set('posts_per_page', 6);
        } elseif ($query->is_post_type_archive('case')) {
            $query->set('posts_per_page', 9);
        }
    }
}

add_action('pre_get_posts', 'alumax_product_archive_per_page');

function alumax_document_title_parts($title) {
    if (is_front_page()) {
        $title['title'] = 'ALUVIONA | Architectural Aluminum & Metal Facade Systems Manufacturer';
        $title['tagline'] = '';
        $title['site'] = '';
        return $title;
    }

    if (is_post_type_archive('product')) {
        $title['title'] = 'Architectural Metal Facade & Cladding Systems';
        $title['site'] = 'ALUVIONA Products';
        return $title;
    }

    if (is_singular('product')) {
        global $post;
        $product_titles = [
            'solid-aluminum-cladding-panels'            => 'Solid Aluminum Cladding Panels Manufacturer',
            'smart-motorized-aluminum-louvers'          => 'Smart Motorized Aluminum Louvers & Solar Shading',
            'aluminum-honeycomb-panels'                 => 'Aluminum Honeycomb Panels & High-Rigidity Composites',
            'aluminum-composite-panels'                 => 'Aluminum Composite Panels (ACP/ACM) Manufacturer',
            'laser-cut-welded-architectural-screens'    => 'Laser-Cut & Welded Architectural Screens & Panels',
            'architectural-metal-ceiling-systems'       => 'Architectural Metal Ceiling Systems & Baffles',
            'architectural-solar-control-louvers'       => 'Architectural Solar Control Louvers & Aerofoil Sunshades',
            'architectural-steel-wall-panels'           => 'Architectural Steel Wall Panels & Cassette Cladding',
            'corrugated-core-aluminum-composite-panels' => 'Corrugated Core Aluminum Composite Panels (ACCP)',
            'roll-coated-aluminum-panels'               => 'Roll-Coated Architectural Aluminum Panels',
            'pre-insulated-integrated-wall-panels'      => 'Pre-Insulated Integrated Wall Panels & Cladding',
        ];
        $slug = $post->post_name ?? '';
        if (isset($product_titles[$slug])) {
            $title['title'] = $product_titles[$slug];
            $title['site'] = 'ALUVIONA';
            return $title;
        }
    }

    if (is_post_type_archive('case')) {
        $title['title'] = 'Architectural Facade Projects & Case Studies';
        $title['site'] = 'ALUVIONA Worldwide';
        return $title;
    }

    if (is_singular('case')) {
        $title['site'] = 'ALUVIONA Projects';
        return $title;
    }

    if (is_page('about')) {
        $title['title'] = 'About Us | Architectural Metal & Facade Factory';
        $title['site'] = 'ALUVIONA';
        return $title;
    }

    if (is_page('resources')) {
        $title['title'] = 'Architectural CAD Details & Specification Resources';
        $title['site'] = 'ALUVIONA';
        return $title;
    }

    if (is_page('contact')) {
        $title['title'] = 'Contact ALUVIONA | Facade Consultation & Sample Requests';
        $title['site'] = 'ALUVIONA';
        return $title;
    }

    if (is_post_type_archive('news') || is_home()) {
        $title['title'] = 'Architectural Metal Industry News & Engineering Insights';
        $title['site'] = 'ALUVIONA';
        return $title;
    }

    $title['site'] = 'ALUVIONA';
    return $title;
}
add_filter('document_title_parts', 'alumax_document_title_parts');

function alumax_seo_meta() {
    $desc = '';
    $title = wp_get_document_title();
    $url = '';
    $image = '';

    if (is_singular('product')) {
        $post = get_queried_object();
        if ($post) {
            $desc = !empty($post->post_excerpt) ? $post->post_excerpt : '';
            if ($desc === '') {
                $hero = alumax_product_page_section('hero', $post->ID);
                $desc = $hero['description'] ?? '';
            }
            $url = get_permalink($post);
            $thumb = get_the_post_thumbnail_url($post, 'full');
            if ($thumb) {
                $image = $thumb;
            } else {
                $hero = alumax_product_page_section('hero', $post->ID);
                $image = !empty($hero['bg_image']) ? $hero['bg_image'] : '';
            }
        }
    } elseif (is_front_page()) {
        $desc = 'ALUVIONA manufactures premium architectural metal facade systems, solid aluminum cladding, honeycomb panels, louvers, and custom exterior envelopes. Inquire now.';
        $url = home_url('/');
    } elseif (is_post_type_archive('product')) {
        $desc = 'Explore ALUVIONA engineered architectural metal systems: solid aluminum cladding, composite panels, honeycomb cassettes, solar louvers, and acoustic ceilings.';
        $url = get_post_type_archive_link('product');
    } elseif (is_post_type_archive('case')) {
        $desc = 'Discover landmark architectural projects worldwide featuring ALUVIONA facade cladding, honeycomb cassettes, motorized louvers, and bespoke architectural metal envelopes.';
        $url = get_post_type_archive_link('case');
    } elseif (is_page('about')) {
        $desc = 'Learn about ALUVIONA, an industry-leading manufacturer of architectural metal facades, operating advanced automated CNC fabrication and coil coating lines.';
        $url = get_permalink();
    } elseif (is_page('resources')) {
        $desc = 'Download architectural specification books, BIM objects, CAD details, structural test data, and finish charts for ALUVIONA engineered facade panel systems.';
        $url = get_permalink();
    } elseif (is_page('contact')) {
        $desc = 'Contact ALUVIONA facade engineering team for competitive project quotations, custom CAD detailing, architectural sample boxes, and global delivery support.';
        $url = get_permalink();
    } elseif (is_post_type_archive('news') || is_home()) {
        $desc = 'Stay informed with architectural metal trends, facade engineering breakthroughs, sustainability standards, and technical case studies from ALUVIONA.';
        $url = alumax_news_url();
    } elseif (is_singular()) {
        $post = get_queried_object();
        if ($post) {
            $desc = !empty($post->post_excerpt) ? $post->post_excerpt : wp_trim_words(wp_strip_all_tags($post->post_content), 30);
            $url = get_permalink($post);
            $thumb = get_the_post_thumbnail_url($post, 'full');
            if ($thumb) {
                $image = $thumb;
            }
        }
    }

    $desc = esc_attr(trim(preg_replace('/\s+/', ' ', wp_strip_all_tags($desc))));
    if ($desc !== '') {
        echo '<meta name="description" content="' . $desc . '">' . "\n";
        echo '<meta property="og:description" content="' . $desc . '">' . "\n";
    }
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    if ($url !== '') {
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    }
    echo '<meta property="og:type" content="' . (is_singular() ? 'article' : 'website') . '">' . "\n";
    echo '<meta property="og:site_name" content="ALUVIONA">' . "\n";
    if ($image !== '') {
        echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    } else {
        echo '<meta name="twitter:card" content="summary">' . "\n";
    }
}
add_action('wp_head', 'alumax_seo_meta', 2);

require get_template_directory() . '/inc/home-settings.php';
require get_template_directory() . '/inc/settings-page.php';
require get_template_directory() . '/inc/site-settings.php';
require get_template_directory() . '/inc/about-settings.php';
require get_template_directory() . '/inc/contact-settings.php';
require get_template_directory() . '/inc/news-hero.php';
require get_template_directory() . '/inc/product-specs.php';
require get_template_directory() . '/inc/case-details.php';
require get_template_directory() . '/inc/product-page-content.php';
require get_template_directory() . '/inc/inquiries.php';
require get_template_directory() . '/inc/archive-product-settings.php';

