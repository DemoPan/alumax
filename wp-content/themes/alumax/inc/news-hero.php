<?php

if (!defined('ABSPATH')) {
    exit;
}

function alumax_news_hero_defaults() {
    return [
        'slide1_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD7p_99scQ9WUqoT-ZE4HSj_yxMCN1qJ__EYxDmEVQYVltiNWtJ7rwJ8fYGR9ogtTc-dMfHNvzRMTBJ50kL4hwH_MsxyXkQA9igNdU78vpFeJ4X8tTv1u4nV5n9__w3MJppyMSTHHccwil1A-jNDxILd1_GPvUDNzUQiz712EKiToK4ZrEgkrVD_XpfDhNc9psZSDc_1migt5_GUV-99LNq0J8ME7Ba9cnU_D6foUn0QbM3YRccuofM',
        'slide1_kicker' => 'ALUMAX Dispatch // World Trade Centre Dubai',
        'slide1_badge' => 'Global Exhibition',
        'slide1_title' => 'ALUMAX Showcases Next-Gen Dynamic Solar Louvers and Ultra-Flat Solid Cladding at The Big 5 Dubai 2025',
        'slide1_description' => 'Unveiled in Hall 2, ALUMAX\'s motorized solar blade arrays demonstrated autonomous solar tracking synchronized directly with BACnet & KNX Building Management Systems under simulated high-temperature desert conditions.',
        'slide1_location' => 'Dubai World Trade Centre · Stand Z2-H38',
        'slide1_tab' => 'The Big 5 Dubai 2025',
        'slide1_post' => 0,
        'slide2_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKAOkBKrv6a2PFgXpQ1vnS8GEWLQixnUu8eLhG5dJV8FnRmKIHvP-6MonzL8nXwBm1SSeWUeLOPVGvaLBlJ2Y_LApkt-0X2WlPMIKukpBbrlX6neR94y8rZqqWHhGFILudwNzu6UHlRfaFfqiy96c1y6BVraP1211LTE1EWbT7t9m0rJOlX6IOoA0d6FRNT4vMrThBbABfBZEzmN73RGxplrvmnq5yBSwoWQPXeyL4sjLtDFgwiTJ1',
        'slide2_kicker' => 'Landmark Milestone // Riyadh, Saudi Arabia',
        'slide2_badge' => 'Landmark Milestone',
        'slide2_title' => 'KAFD Tower 3 in Riyadh Completes Installation of 14,200m² Custom Anodized Aluminum Façade Panels',
        'slide2_description' => 'Engineered for extreme desert diurnal thermal cycles, the high-tensile alloy fins feature autonomous astronomical clock positioning to slash peak solar heat gains by 38% across the building perimeter.',
        'slide2_location' => 'King Abdullah Financial District · Tower 3',
        'slide2_tab' => 'KAFD Tower 3 Riyadh',
        'slide2_post' => 0,
        'slide3_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCyqEWVwyBPFRoN408trk_8DisWjnwgXpqAAmhQGI6Erj0BWWNlz4w8vv-c1iYQML84oD20H8H_O1TegCu3I5L_BxHF4twhDGp5q0_Dv1A7UxuRIRcGAuz0jZJgHHsyyPg92ElDdEc6Pmp3ChuXWl6Vjk2yHZMSUuoN4UNuwbQMaix3D4R1D7aWPboT5gJy6QG761L2Ety2MGtrj-UGopfwD2P30vz6ogk95jn2EKZrthi2EWdDEUVH',
        'slide3_kicker' => 'European Logistics // Rotterdam Port, NL',
        'slide3_badge' => 'Global Expansion',
        'slide3_title' => 'Expanding European Distribution: ALUMAX Opens New Logistics & Rapid CNC Hub in Rotterdam',
        'slide3_description' => 'Equipped with rapid-milling CNC sample fabrication and buffered architectural coils, slashing lead times for North European commercial building envelope tenders and sample mock-ups.',
        'slide3_location' => 'Port of Rotterdam · Hub Terminal 2',
        'slide3_tab' => 'Rotterdam Logistics Hub',
        'slide3_post' => 0,
        // 列表区标题
        'archive_eyebrow' => 'Press & Documentation',
        'archive_title' => 'News & Media Archive',
        // 底部订阅板块
        'newsletter_title' => 'Sign up for updates on our latest innovations',
        'newsletter_desc' => 'Monthly engineering dispatches: new facade systems, certified test results, and global project milestones.',
        'newsletter_button' => 'Sign Up',
        'newsletter_note' => 'Engineering updates only. Your email stays confidential and you can unsubscribe anytime.',
    ];
}

function alumax_news_hero_fields() {
    $text = function ($key, $label, $desc = '') {
        return ['key' => $key, 'label' => $label, 'type' => 'text', 'desc' => $desc];
    };
    $textarea = function ($key, $label, $desc = '') {
        return ['key' => $key, 'label' => $label, 'type' => 'textarea', 'desc' => $desc];
    };
    $image = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'image'];
    };
    $post = function ($key, $label) {
        return ['key' => $key, 'label' => $label, 'type' => 'post'];
    };

    $groups = [];
    for ($i = 1; $i <= 3; $i++) {
        $groups["slide{$i}"] = [
            'label' => "轮播 {$i}",
            'fields' => [
                $image("slide{$i}_image", 'Banner 图片'),
                $text("slide{$i}_tab", '底部标签短标题'),
                $text("slide{$i}_kicker", '顶部眉标'),
                $text("slide{$i}_badge", '分类徽章'),
                $text("slide{$i}_title", '标题'),
                $textarea("slide{$i}_description", '描述'),
                $text("slide{$i}_location", '地点/展位行'),
                $post("slide{$i}_post", '链接到新闻文章'),
            ],
        ];
    }
    $groups['archive'] = [
        'label' => '列表区标题',
        'fields' => [
            $text('archive_eyebrow', '眉标'),
            $text('archive_title', '标题'),
        ],
    ];
    $groups['newsletter'] = [
        'label' => '底部订阅板块',
        'fields' => [
            $text('newsletter_title', '标题', '留空则整个订阅板块不显示'),
            $textarea('newsletter_desc', '描述'),
            $text('newsletter_button', '按钮文案'),
            $text('newsletter_note', '表单下方备注'),
        ],
    ];
    return $groups;
}

function alumax_news_page($key) {
    static $opts = null;
    if ($opts === null) {
        $opts = wp_parse_args(get_option('alumax_news_hero', []), alumax_news_hero_defaults());
    }
    return isset($opts[$key]) ? $opts[$key] : '';
}

function alumax_news_hero_slides() {
    $opts = wp_parse_args(get_option('alumax_news_hero', []), alumax_news_hero_defaults());
    $slides = [];
    for ($i = 1; $i <= 3; $i++) {
        $post_id = (int) $opts["slide{$i}_post"];
        $slides[] = [
            'image' => $opts["slide{$i}_image"],
            'tab' => $opts["slide{$i}_tab"],
            'kicker' => $opts["slide{$i}_kicker"],
            'badge' => $opts["slide{$i}_badge"],
            'title' => $opts["slide{$i}_title"],
            'description' => $opts["slide{$i}_description"],
            'location' => $opts["slide{$i}_location"],
            'post_id' => $post_id,
            'url' => $post_id ? get_permalink($post_id) : '',
        ];
    }
    return $slides;
}

add_action('admin_menu', function () {
    add_submenu_page(
        'edit.php?post_type=news',
        '新闻页设置',
        '新闻页设置',
        'manage_options',
        'alumax-news-hero',
        'alumax_news_hero_settings_page'
    );
});

add_action('admin_init', function () {
    register_setting('alumax_news_hero', 'alumax_news_hero', [
        'sanitize_callback' => 'alumax_news_hero_sanitize',
    ]);
});

function alumax_news_hero_sanitize($input) {
    $output = [];
    $input = is_array($input) ? $input : [];

    foreach (alumax_news_hero_fields() as $group) {
        foreach ($group['fields'] as $field) {
            $key = $field['key'];
            $value = $input[$key] ?? '';
            switch ($field['type']) {
                case 'textarea':
                    $output[$key] = sanitize_textarea_field($value);
                    break;
                case 'image':
                    $output[$key] = esc_url_raw($value);
                    break;
                case 'post':
                    $output[$key] = absint($value);
                    break;
                default:
                    $output[$key] = sanitize_text_field($value);
            }
        }
    }

    return $output;
}

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'news_page_alumax-news-hero') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('jquery');
});

function alumax_news_hero_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    $opts = wp_parse_args(get_option('alumax_news_hero', []), alumax_news_hero_defaults());
    $news_posts = get_posts([
        'post_type' => 'news',
        'post_status' => 'publish',
        'posts_per_page' => 100,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
    ?>
    <div class="wrap">
      <h1>新闻页设置</h1>
      <p>新闻中心列表页的配置：顶部轮播 3 张 Banner（每张可上传图片、填写标题/描述，并选择点击「View Details」后跳转到的新闻文章；不选文章则按钮不可点击，标题留空的轮播不显示）、列表区标题、底部订阅板块。新闻卡片自动读取「新闻」文章，无需在此设置。</p>
      <form method="post" action="options.php">
        <?php settings_fields('alumax_news_hero'); ?>
        <?php foreach (alumax_news_hero_fields() as $group) : ?>
          <h2 style="margin-top:2em;border-bottom:1px solid #c3c4c7;padding-bottom:.4em;"><?php echo esc_html($group['label']); ?></h2>
          <table class="form-table" role="presentation">
            <?php foreach ($group['fields'] as $field) :
                $key = $field['key'];
                $value = $opts[$key] ?? '';
                ?>
              <tr>
                <th scope="row"><label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                  <?php if ($field['type'] === 'textarea') : ?>
                    <textarea id="<?php echo esc_attr($key); ?>" name="alumax_news_hero[<?php echo esc_attr($key); ?>]" rows="3" class="large-text"><?php echo esc_textarea($value); ?></textarea>
                  <?php elseif ($field['type'] === 'image') : ?>
                    <div class="alumax-image-field">
                      <input type="text" id="<?php echo esc_attr($key); ?>" name="alumax_news_hero[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="large-text alumax-image-url">
                      <p>
                        <button type="button" class="button alumax-image-select">选择图片</button>
                      </p>
                      <img class="alumax-image-preview" src="<?php echo esc_url($value); ?>" style="max-width:240px;height:auto;<?php echo $value ? '' : 'display:none;'; ?>border:1px solid #c3c4c7;">
                    </div>
                  <?php elseif ($field['type'] === 'post') : ?>
                    <select id="<?php echo esc_attr($key); ?>" name="alumax_news_hero[<?php echo esc_attr($key); ?>]">
                      <option value="0">— 不链接 —</option>
                      <?php foreach ($news_posts as $news_post) : ?>
                        <option value="<?php echo esc_attr($news_post->ID); ?>" <?php selected((int) $value, $news_post->ID); ?>>
                          <?php echo esc_html($news_post->post_title); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  <?php else : ?>
                    <input type="text" id="<?php echo esc_attr($key); ?>" name="alumax_news_hero[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="large-text">
                  <?php endif; ?>
                  <?php if (!empty($field['desc'])) : ?>
                    <p class="description"><?php echo esc_html($field['desc']); ?></p>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        <?php endforeach; ?>
        <?php submit_button(); ?>
      </form>
    </div>
    <script>
    jQuery(function ($) {
      $('.alumax-image-select').on('click', function (e) {
        e.preventDefault();
        var $wrap = $(this).closest('.alumax-image-field');
        var frame = wp.media({ title: '选择图片', button: { text: '使用此图片' }, multiple: false });
        frame.on('select', function () {
          var url = frame.state().get('selection').first().get('url');
          $wrap.find('.alumax-image-url').val(url);
          $wrap.find('.alumax-image-preview').attr('src', url).show();
        });
        frame.open();
      });
    });
    </script>
    <?php
}
