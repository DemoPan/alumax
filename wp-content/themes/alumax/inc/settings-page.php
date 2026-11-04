<?php

if (!defined('ABSPATH')) {
    exit;
}

/* -------------------------------------------------------------------------
 * 通用单页设置页生成器（关于我们 / 联系我们 等使用）
 * 字段结构同 inc/home-settings.php：groups => [ ['label'=>..., 'fields'=>[ ['key','label','type'] ] ] ]
 * type: text | textarea | url | image | video
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
                case 'repeater':
                    $rows = [];
                    if (is_array($value)) {
                        foreach ($value as $row) {
                            if (!is_array($row)) {
                                continue;
                            }
                            $clean = [];
                            foreach ($field['fields'] as $sub) {
                                $sub_value = isset($row[$sub['key']]) ? $row[$sub['key']] : '';
                                $clean[$sub['key']] = in_array($sub['type'], ['image', 'url'], true)
                                    ? esc_url_raw($sub_value)
                                    : sanitize_text_field($sub_value);
                            }
                            if (implode('', $clean) !== '') {
                                $rows[] = $clean;
                            }
                        }
                    }
                    $output[$key] = $rows;
                    break;
                case 'url':
                case 'image':
                case 'video':
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
                  <?php elseif ($field['type'] === 'video') : ?>
                    <div class="alumax-video-field">
                      <input type="text" id="<?php echo esc_attr($key); ?>" name="<?php echo esc_attr($option); ?>[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="large-text alumax-video-url">
                      <p><button type="button" class="button alumax-video-select">选择视频</button></p>
                      <video class="alumax-video-preview" src="<?php echo esc_url($value); ?>" controls preload="metadata" style="max-width:320px;height:auto;<?php echo $value ? '' : 'display:none;'; ?>border:1px solid #c3c4c7;"></video>
                    </div>
                  <?php elseif ($field['type'] === 'repeater') : ?>
                    <?php
                    $rows = is_array($value) ? $value : [];
                    $render_row = function ($i, $row) use ($option, $key, $field) {
                        ?>
                        <div class="alumax-repeater-row" style="border:1px solid #c3c4c7;padding:12px;margin-bottom:8px;background:#fff;max-width:720px;">
                          <?php foreach ($field['fields'] as $sub) :
                              $sub_key   = $sub['key'];
                              $sub_value = isset($row[$sub_key]) ? $row[$sub_key] : '';
                              $sub_name  = $option . '[' . $key . '][' . $i . '][' . $sub_key . ']';
                              ?>
                            <p style="margin:0 0 8px;">
                              <label style="display:block;font-weight:600;margin-bottom:2px;"><?php echo esc_html($sub['label']); ?></label>
                              <?php if ($sub['type'] === 'image') : ?>
                                <span class="alumax-image-field">
                                  <input type="text" name="<?php echo esc_attr($sub_name); ?>" value="<?php echo esc_attr($sub_value); ?>" class="regular-text alumax-image-url">
                                  <button type="button" class="button alumax-image-select">选择图片</button>
                                  <img class="alumax-image-preview" src="<?php echo esc_url($sub_value); ?>" style="max-width:80px;height:auto;vertical-align:middle;margin-left:8px;<?php echo $sub_value ? '' : 'display:none;'; ?>border:1px solid #c3c4c7;">
                                </span>
                              <?php else : ?>
                                <input type="text" name="<?php echo esc_attr($sub_name); ?>" value="<?php echo esc_attr($sub_value); ?>" class="large-text">
                              <?php endif; ?>
                              <?php if (!empty($sub['desc'])) : ?>
                                <span class="description"><?php echo esc_html($sub['desc']); ?></span>
                              <?php endif; ?>
                            </p>
                          <?php endforeach; ?>
                          <button type="button" class="button-link-delete alumax-repeater-remove">删除此行</button>
                        </div>
                        <?php
                    };
                    ?>
                    <div class="alumax-repeater">
                      <div class="alumax-repeater-rows">
                        <?php foreach ($rows as $i => $row) : ?>
                          <?php $render_row($i, $row); ?>
                        <?php endforeach; ?>
                      </div>
                      <p style="margin:8px 0 0;"><button type="button" class="button alumax-repeater-add">+ 添加一行</button></p>
                      <template><?php $render_row('__i__', []); ?></template>
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
      // 事件委托绑定，保证 repeater 动态新增的行也能选择图片/视频
      $(document).on('click', '.alumax-image-select', function (e) {
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
      $(document).on('click', '.alumax-video-select', function (e) {
        e.preventDefault();
        var $wrap = $(this).closest('.alumax-video-field');
        var frame = wp.media({ title: '选择视频', button: { text: '使用此视频' }, library: { type: 'video' }, multiple: false });
        frame.on('select', function () {
          var url = frame.state().get('selection').first().get('url');
          $wrap.find('.alumax-video-url').val(url);
          $wrap.find('.alumax-video-preview').attr('src', url).show();
        });
        frame.open();
      });
      $(document).on('click', '.alumax-repeater-add', function (e) {
        e.preventDefault();
        var $rep = $(this).closest('.alumax-repeater');
        var nextIndex = parseInt($rep.attr('data-next'), 10);
        if (isNaN(nextIndex)) {
          nextIndex = $rep.find('.alumax-repeater-rows .alumax-repeater-row').length;
        }
        var html = $rep.children('template').html().replace(/__i__/g, nextIndex);
        $rep.attr('data-next', nextIndex + 1);
        $rep.children('.alumax-repeater-rows').append(html);
      });
      $(document).on('click', '.alumax-repeater-remove', function (e) {
        e.preventDefault();
        $(this).closest('.alumax-repeater-row').remove();
      });
    });
    </script>
    <?php
}
