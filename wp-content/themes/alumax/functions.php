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

    wp_enqueue_script(
        'tailwindcss',
        'https://cdn.tailwindcss.com?plugins=forms,container-queries',
        [],
        null,
        false
    );

    wp_add_inline_script('tailwindcss', alumax_tailwind_config_js(), 'after');
}

add_action('wp_enqueue_scripts', 'alumax_assets');

function alumax_head() {
    ?>
<style>
  @layer base {
    html, body { margin: 0; padding: 0; }
    body { overscroll-behavior: none; }
    main > :first-child { margin-top: 0 !important; }
    main > :last-child { margin-bottom: 0 !important; }
  }
  ::-webkit-scrollbar { display: none; }
  body.admin-bar > header { top: 32px; }
  @media screen and (max-width: 782px) {
    body.admin-bar > header { top: 46px; }
  }
</style>
    <?php
}

add_action('wp_head', 'alumax_head', 1);

function alumax_tailwind_config_js() {
    return <<<'JS'
tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        colors: {
          "surface-container-low": "#f2f4f6",
          "surface-container-high": "#e6e8ea",
          "on-primary-fixed": "#0f1c2c",
          "tertiary-fixed": "#d2e4ff",
          "background": "#f8f9fb",
          "inverse-primary": "#bac8dc",
          "on-primary": "#ffffff",
          "primary": "#000000",
          "inverse-on-surface": "#eff1f3",
          "primary-fixed-dim": "#bac8dc",
          "primary-container": "#0d1b2a",
          "on-tertiary-container": "#6f85a3",
          "outline-variant": "#c4c6cc",
          "on-primary-fixed-variant": "#3a4859",
          "on-primary-container": "#778598",
          "surface-variant": "#e0e3e5",
          "on-surface-variant": "#44474c",
          "outline": "#74777d",
          "on-tertiary-fixed-variant": "#324863",
          "primary-fixed": "#d6e4f9",
          "on-tertiary-fixed": "#021d35",
          "on-error-container": "#93000a",
          "surface-tint": "#525f71",
          "surface": "#f8f9fb",
          "surface-bright": "#f8f9fb",
          "on-error": "#ffffff",
          "secondary-fixed-dim": "#edbe82",
          "error-container": "#ffdad6",
          "on-background": "#191c1e",
          "tertiary-fixed-dim": "#b2c8e8",
          "on-secondary-fixed": "#2a1800",
          "inverse-surface": "#2d3133",
          "tertiary": "#000000",
          "on-surface": "#191c1e",
          "surface-dim": "#d8dadc",
          "on-secondary-container": "#7a5724",
          "surface-container": "#eceef0",
          "on-secondary": "#ffffff",
          "tertiary-container": "#021d35",
          "error": "#ba1a1a",
          "on-error": "#ffffff",
          "surface-container-highest": "#e0e3e5",
          "surface-container-lowest": "#ffffff",
          "on-secondary-fixed-variant": "#60400f",
          "secondary-container": "#ffcf92",
          "secondary-fixed": "#ffddb5",
          "secondary": "#7b5825"
        },
        borderRadius: {
          "DEFAULT": "0.25rem",
          "lg": "0.5rem",
          "xl": "0.75rem",
          "full": "9999px"
        },
        spacing: {
          "margin-mobile": "1.25rem",
          "space-xs": "0.25rem",
          "space-lg": "1.5rem",
          "gutter-mobile": "1rem",
          "space-xl": "2.5rem",
          "space-sm": "0.5rem",
          "space-md": "1rem",
          "margin": "3rem",
          "gutter": "1.5rem"
        },
        fontFamily: {
          "body-lg": ["Manrope"],
          "display-xl": ["Space Grotesk"],
          "body-sm": ["Manrope"],
          "body-md": ["Manrope"],
          "headline-lg": ["Space Grotesk"],
          "display-lg": ["Space Grotesk"],
          "label-lg": ["JetBrains Mono"],
          "headline-sm": ["Space Grotesk"],
          "display-xl-mobile": ["Space Grotesk"],
          "label-md": ["JetBrains Mono"],
          "headline-md": ["Space Grotesk"],
          "label-sm": ["JetBrains Mono"],
          "display-lg-mobile": ["Space Grotesk"]
        },
        fontSize: {
          "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
          "display-xl": ["56px", { "lineHeight": "64px", "letterSpacing": "-0.03em", "fontWeight": "700" }],
          "body-sm": ["13px", { "lineHeight": "20px", "fontWeight": "400" }],
          "body-md": ["15px", { "lineHeight": "24px", "fontWeight": "400" }],
          "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
          "display-lg": ["44px", { "lineHeight": "52px", "letterSpacing": "-0.02em", "fontWeight": "600" }],
          "label-lg": ["14px", { "lineHeight": "20px", "letterSpacing": "0.04em", "fontWeight": "500" }],
          "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
          "display-xl-mobile": ["36px", { "lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
          "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.06em", "fontWeight": "500" }],
          "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
          "label-sm": ["11px", { "lineHeight": "14px", "letterSpacing": "0.08em", "fontWeight": "500" }],
          "display-lg-mobile": ["30px", { "lineHeight": "38px", "letterSpacing": "-0.01em", "fontWeight": "600" }]
        }
      }
    }
  };
JS;
}

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
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('product')) {
        $query->set('posts_per_page', 11);
    }
}

add_action('pre_get_posts', 'alumax_product_archive_per_page');

require get_template_directory() . '/inc/home-settings.php';
require get_template_directory() . '/inc/settings-page.php';
require get_template_directory() . '/inc/about-settings.php';
require get_template_directory() . '/inc/contact-settings.php';
require get_template_directory() . '/inc/news-hero.php';
require get_template_directory() . '/inc/product-specs.php';
require get_template_directory() . '/inc/case-details.php';
require get_template_directory() . '/inc/product-page-content.php';
require get_template_directory() . '/inc/inquiries.php';
require get_template_directory() . '/inc/archive-product-settings.php';

