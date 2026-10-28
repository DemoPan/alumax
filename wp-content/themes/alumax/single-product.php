<?php
if (!defined('ABSPATH')) { exit; }

// 产品详情页：统一走模块化渲染。
// 模块与顺序由 alumax_render_product_page() 维护（见 inc/product-page-content.php）；
// 每个产品启用哪些模块在后台「产品 → 编辑 → 详情页模块」勾选；
// 内容在同页「详情页内容」各面板中编辑，未编辑时显示主题默认内容。

get_header();
alumax_render_product_page();
get_footer();
