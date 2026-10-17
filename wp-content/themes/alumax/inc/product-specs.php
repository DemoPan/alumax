<?php

if (!defined('ABSPATH')) {
    exit;
}

function alumax_product_specs($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $specs = get_post_meta($post_id, 'alumax_product_specs', true);
    return is_array($specs) ? $specs : [];
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'alumax-product-specs',
        '产品特性（产品中心卡片显示）',
        'alumax_product_specs_meta_box',
        'product',
        'normal',
        'default'
    );
});

function alumax_product_specs_meta_box($post) {
    wp_nonce_field('alumax_product_specs_save', 'alumax_product_specs_nonce');
    $specs = alumax_product_specs($post->ID);
    ?>
    <table class="widefat striped" id="alumax-specs-table" style="max-width:720px;">
      <thead>
        <tr>
          <th style="width:40%;">特性名称（如 Max Single Sheet）</th>
          <th>数值（如 2,200mm × 6,000mm）</th>
          <th style="width:60px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($specs as $spec) : ?>
        <tr>
          <td><input type="text" name="alumax_specs_name[]" value="<?php echo esc_attr($spec['name']); ?>" class="large-text"></td>
          <td><input type="text" name="alumax_specs_value[]" value="<?php echo esc_attr($spec['value']); ?>" class="large-text"></td>
          <td><button type="button" class="button alumax-spec-remove">删除</button></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <p><button type="button" class="button button-secondary" id="alumax-specs-add">+ 添加特性</button></p>
    <p class="description">数量不限，名称为空的行会被忽略。普通卡片最多显示前几条为宜，主推卡会全部显示。</p>
    <script>
    jQuery(function ($) {
      var row = '<tr>'
        + '<td><input type="text" name="alumax_specs_name[]" class="large-text"></td>'
        + '<td><input type="text" name="alumax_specs_value[]" class="large-text"></td>'
        + '<td><button type="button" class="button alumax-spec-remove">删除</button></td>'
        + '</tr>';
      $('#alumax-specs-add').on('click', function () {
        $('#alumax-specs-table tbody').append(row);
      });
      $('#alumax-specs-table').on('click', '.alumax-spec-remove', function () {
        $(this).closest('tr').remove();
      });
    });
    </script>
    <?php
}

add_action('save_post_product', function ($post_id) {
    if (!isset($_POST['alumax_product_specs_nonce'])
        || !wp_verify_nonce(sanitize_key($_POST['alumax_product_specs_nonce']), 'alumax_product_specs_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $names = isset($_POST['alumax_specs_name']) ? (array) wp_unslash($_POST['alumax_specs_name']) : [];
    $values = isset($_POST['alumax_specs_value']) ? (array) wp_unslash($_POST['alumax_specs_value']) : [];

    $specs = [];
    foreach ($names as $i => $name) {
        $name = sanitize_text_field($name);
        $value = sanitize_text_field($values[$i] ?? '');
        if ($name !== '' || $value !== '') {
            $specs[] = ['name' => $name, 'value' => $value];
        }
    }

    if ($specs) {
        update_post_meta($post_id, 'alumax_product_specs', $specs);
    } else {
        delete_post_meta($post_id, 'alumax_product_specs');
    }
});
