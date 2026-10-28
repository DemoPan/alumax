<?php

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------
 * 询价表单（RFQ）：前端提交 → 存入 CPT inquiry → 后台「产品 → 询价记录」查看
 * 模板：template-parts/product-sections/inquiry.php
 * ------------------------------------------------------------------------- */

add_action('init', function () {
    register_post_type('inquiry', [
        'labels' => [
            'name'          => __('询价记录', 'alumax'),
            'singular_name' => __('询价', 'alumax'),
        ],
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-email-alt',
        'menu_position' => 26,
        'supports'      => ['title'],
        'capabilities'  => ['create_posts' => 'do_not_allow'],
        'map_meta_cap'  => true,
    ]);
});

/* -------------------------------------------------------------------------
 * 表单提交处理（登录与未登录用户均可）
 * ------------------------------------------------------------------------- */

add_action('admin_post_alumax_inquiry', 'alumax_handle_inquiry');
add_action('admin_post_nopriv_alumax_inquiry', 'alumax_handle_inquiry');

function alumax_inquiry_redirect($status) {
    $back = wp_get_referer() ? wp_get_referer() : home_url('/');
    $back = remove_query_arg('inquiry', $back);
    wp_safe_redirect(add_query_arg('inquiry', $status, $back) . '#rfq-section');
    exit;
}

function alumax_save_inquiry($input, $files) {
    $name    = isset($input['inquiry_name']) ? sanitize_text_field($input['inquiry_name']) : '';
    $email   = isset($input['inquiry_email']) ? sanitize_email($input['inquiry_email']) : '';
    $company = isset($input['inquiry_company']) ? sanitize_text_field($input['inquiry_company']) : '';
    $country = isset($input['inquiry_country']) ? sanitize_text_field($input['inquiry_country']) : '';
    $product = isset($input['inquiry_product']) ? sanitize_text_field($input['inquiry_product']) : '';
    $message = isset($input['inquiry_message']) ? sanitize_textarea_field($input['inquiry_message']) : '';
    $page    = isset($input['inquiry_page']) ? sanitize_text_field($input['inquiry_page']) : '';

    if ($name === '' || !is_email($email)) {
        return new WP_Error('alumax_inquiry_invalid', 'Name and valid email are required.');
    }

    $post_id = wp_insert_post([
        'post_type'   => 'inquiry',
        'post_status' => 'publish',
        'post_title'  => $name . ($product !== '' ? ' — ' . $product : ''),
    ], true);

    if (is_wp_error($post_id) || !$post_id) {
        return new WP_Error('alumax_inquiry_save_failed', 'Could not save inquiry.');
    }

    update_post_meta($post_id, '_inquiry_name', $name);
    update_post_meta($post_id, '_inquiry_email', $email);
    update_post_meta($post_id, '_inquiry_company', $company);
    update_post_meta($post_id, '_inquiry_country', $country);
    update_post_meta($post_id, '_inquiry_product', $product);
    update_post_meta($post_id, '_inquiry_message', $message);
    update_post_meta($post_id, '_inquiry_page', $page);
    update_post_meta($post_id, '_inquiry_referer', esc_url_raw(wp_get_referer() ?: ''));

    // 附件（可选）：仅限 CAD / PDF / ZIP，≤ 25MB
    if (!empty($files['inquiry_file']['name']) && $files['inquiry_file']['error'] === UPLOAD_ERR_OK) {
        $allowed = [
            'dwg' => 'application/octet-stream',
            'dxf' => 'application/octet-stream',
            'rvt' => 'application/octet-stream',
            'pdf' => 'application/pdf',
            'zip' => 'application/zip',
        ];
        $ext = strtolower(pathinfo($files['inquiry_file']['name'], PATHINFO_EXTENSION));
        if (isset($allowed[$ext]) && $files['inquiry_file']['size'] <= 25 * 1024 * 1024) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            $upload = wp_handle_upload($files['inquiry_file'], ['test_form' => false, 'mimes' => $allowed]);
            if (!empty($upload['file']) && empty($upload['error'])) {
                update_post_meta($post_id, '_inquiry_file', $upload['url']);
                update_post_meta($post_id, '_inquiry_file_name', sanitize_file_name($files['inquiry_file']['name']));
            }
        }
    }

    return true;
}

function alumax_handle_inquiry() {
    // 蜜罐字段：机器人填写则伪装成功直接返回
    if (!empty($_POST['inquiry_website'])) {
        alumax_inquiry_redirect('success');
    }

    if (!isset($_POST['alumax_inquiry_nonce'])
        || !wp_verify_nonce(sanitize_key($_POST['alumax_inquiry_nonce']), 'alumax_inquiry_submit')) {
        alumax_inquiry_redirect('error');
    }

    $result = alumax_save_inquiry(wp_unslash($_POST), $_FILES);
    alumax_inquiry_redirect(is_wp_error($result) ? 'error' : 'success');
}

/* -------------------------------------------------------------------------
 * REST 接口：POST /wp-json/alumax/v1/inquiry
 * 供静态导出版本的站点跨域提交询价；数据同样落入后台「询价记录」
 * ------------------------------------------------------------------------- */

add_action('rest_api_init', function () {
    register_rest_route('alumax/v1', '/inquiry', [
        'methods'             => 'POST',
        'callback'            => 'alumax_rest_inquiry',
        'permission_callback' => '__return_true',
    ]);
});

function alumax_rest_inquiry(WP_REST_Request $request) {
    $params = $request->get_params();

    // 蜜罐：机器人填写则伪装成功
    if (!empty($params['inquiry_website'])) {
        return alumax_rest_inquiry_response(true);
    }

    $result = alumax_save_inquiry($params, $request->get_file_params());
    return alumax_rest_inquiry_response(!is_wp_error($result));
}

function alumax_rest_inquiry_response($ok) {
    // 静态站部署域名确定后，可用此过滤器收紧为指定域名
    $origin = apply_filters('alumax_inquiry_cors_origin', '*');

    $response = new WP_REST_Response(
        ['status' => $ok ? 'success' : 'error'],
        $ok ? 200 : 400
    );
    $response->header('Access-Control-Allow-Origin', $origin);
    $response->header('Access-Control-Allow-Methods', 'POST, OPTIONS');
    $response->header('Access-Control-Allow-Headers', 'Content-Type');
    return $response;
}

/* -------------------------------------------------------------------------
 * 后台列表列
 * ------------------------------------------------------------------------- */

add_filter('manage_inquiry_posts_columns', function ($columns) {
    return [
        'cb'              => $columns['cb'],
        'title'           => __('姓名', 'alumax'),
        'inquiry_email'   => __('邮箱', 'alumax'),
        'inquiry_product' => __('意向产品', 'alumax'),
        'inquiry_page'    => __('来源产品页', 'alumax'),
        'inquiry_file'    => __('附件', 'alumax'),
        'date'            => __('提交时间', 'alumax'),
    ];
});

add_action('manage_inquiry_posts_custom_column', function ($column, $post_id) {
    if ($column === 'inquiry_email') {
        $email = get_post_meta($post_id, '_inquiry_email', true);
        echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '—';
    }
    if ($column === 'inquiry_product') {
        echo esc_html(get_post_meta($post_id, '_inquiry_product', true) ?: '—');
    }
    if ($column === 'inquiry_page') {
        echo esc_html(get_post_meta($post_id, '_inquiry_page', true) ?: '—');
    }
    if ($column === 'inquiry_file') {
        $file = get_post_meta($post_id, '_inquiry_file', true);
        $name = get_post_meta($post_id, '_inquiry_file_name', true);
        echo $file ? '<a href="' . esc_url($file) . '" target="_blank">' . esc_html($name ?: '下载') . '</a>' : '—';
    }
}, 10, 2);

/* -------------------------------------------------------------------------
 * 后台详情（只读）
 * ------------------------------------------------------------------------- */

add_action('add_meta_boxes', function () {
    add_meta_box('alumax-inquiry-details', '询价详情', 'alumax_inquiry_details_box', 'inquiry', 'normal', 'high');
});

function alumax_inquiry_details_box($post) {
    $rows = [
        '姓名'        => get_post_meta($post->ID, '_inquiry_name', true),
        '邮箱'        => get_post_meta($post->ID, '_inquiry_email', true),
        '公司/事务所' => get_post_meta($post->ID, '_inquiry_company', true),
        '国家/港口'   => get_post_meta($post->ID, '_inquiry_country', true),
        '意向产品'    => get_post_meta($post->ID, '_inquiry_product', true),
        '来源产品页'  => get_post_meta($post->ID, '_inquiry_page', true),
        '来源链接'    => get_post_meta($post->ID, '_inquiry_referer', true),
    ];
    echo '<table class="form-table"><tbody>';
    foreach ($rows as $label => $value) {
        echo '<tr><th style="width:140px;">' . esc_html($label) . '</th><td>' . esc_html($value ?: '—') . '</td></tr>';
    }
    $file = get_post_meta($post->ID, '_inquiry_file', true);
    $file_name = get_post_meta($post->ID, '_inquiry_file_name', true);
    echo '<tr><th>附件</th><td>';
    echo $file
        ? '<a href="' . esc_url($file) . '" target="_blank" class="button">' . esc_html($file_name ?: '下载附件') . '</a>'
        : '—';
    echo '</td></tr>';
    echo '</tbody></table>';

    $message = get_post_meta($post->ID, '_inquiry_message', true);
    echo '<h4>项目详情留言</h4>';
    echo $message !== ''
        ? '<div style="background:#f6f7f7;border:1px solid #dcdcde;padding:12px;white-space:pre-wrap;">' . esc_html($message) . '</div>'
        : '<p>—</p>';
    echo '<p class="description">提交时间：' . esc_html(get_post_time('Y-m-d H:i:s', false, $post)) . '</p>';
}
