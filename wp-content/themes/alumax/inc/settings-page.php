<?php

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------
 * 通用单页设置页生成器（关于我们 / 联系我们 等使用）
 * 字段结构同 inc/home-settings.php：groups => [ ['label'=>..., 'fields'=>[ ['key','label','type'] ] ] ]
 * type: text | textarea | url | image
 * ------------------------------------------------------------------------- */

function alumax_settings_sanitize($fields, $input) {
    $output = [];
    $input = is_array($input) ? $input : [];
    foreach ($fields as $group) {
        foreach ($group['fields'] as $field) {
            $key = $field['key'];
            $value = isset($input[$key]) ? $input[$key] : '';
            switch ($field['type']) {
                case 'textarea':
                    $output[$key] = sanitize_textarea_field($value);
                    break;
                case 'url':
                case 'image':
                    $output[$key] = esc_url_raw($value);
                    break;
                default:
                    $output[$key] = sanitize_text_field($value);
            }
        }
    }
    return $output;
}

function alumax_add_settings_page($option, $menu_title, $icon, $position, $description, $defaults_fn, $fields_fn) {
    $slug = str_replace('_', '-', $option);

    add_action('admin_menu', function () use ($option, $menu_title, $icon, $position, $slug, $description, $defaults_fn, $fields_fn) {
        add_menu_page($menu_title, $menu_title, 'manage_options', $slug, function () use ($option, $menu_title, $description, $defaults_fn, $fields_fn) {
            alumax_render_settings_page($option, $menu_title, $description, $defaults_fn, $fields_fn);
        }, $icon, $position);
    });

    add_action('admin_init', function () use ($option, $fields_fn) {
        register_setting($option, $option, [
            'sanitize_callback' => function ($input) use ($fields_fn) {
                return alumax_settings_sanitize($fields_fn(), $input);
            },
        ]);
    });

    add_action('admin_enqueue_scripts', function ($hook) use ($slug) {
        if ($hook !== 'toplevel_page_' . $slug) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_script('jquery');
    });
}

function alumax_render_settings_page($option, $title, $description, $defaults_fn, $fields_fn) {
    if (!current_user_can('manage_options')) {
        return;
    }
    $opts = wp_parse_args(get_option($option, []), call_user_func($defaults_fn));
    ?>
    <div class="wrap">
      <h1><?php echo esc_html($title); ?></h1>
      <p><?php echo esc_html($description); ?></p>
      <form method="post" action="options.php">
        <?php settings_fields($option); ?>
        <?php foreach (call_user_func($fields_fn) as $group) : ?>
          <h2 style="margin-top:2em;border-bottom:1px solid #c3c4c7;padding-bottom:.4em;"><?php echo esc_html($group['label']); ?></h2>
          <?php if (!empty($group['note'])) : ?>
            <p class="description"><?php echo esc_html($group['note']); ?></p>
          <?php endif; ?>
          <table class="form-table" role="presentation">
            <?php foreach ($group['fields'] as $field) :
                $key = $field['key'];
                $value = isset($opts[$key]) ? $opts[$key] : '';
                ?>
              <tr>
                <th scope="row"><label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($field['label']); ?></label></th>
                <td>
                  <?php if ($field['type'] === 'textarea') : ?>
                    <textarea id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($option); ?>[<?php echo esc_attr($key); ?>]" rows="3" class="large-text"><?php echo esc_textarea($value); ?></textarea>
                  <?php elseif ($field['type'] === 'image') : ?>
                    <div class="alumax-image-field">
                      <input type="text" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($option); ?>[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="large-text alumax-image-url">
                      <p><button type="button" class="button alumax-image-select">选择图片</button></p>
                      <img class="alumax-image-preview" src="<?php echo esc_url($value); ?>" style="max-width:240px;height:auto;<?php echo $value ? '' : 'display:none;'; ?>border:1px solid #c3c4c7;">
                    </div>
                  <?php else : ?>
                    <input type="text" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($option); ?>[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="large-text">
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
