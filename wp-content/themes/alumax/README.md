# Alumax 主题（开发者说明）

经典 PHP 模板主题，无构建步骤。样式依赖 Tailwind CDN + `functions.php` 内联配置，图标与字体走 Google Fonts CDN，页面图片为外链或媒体库图片。

## 目录结构

```
alumax/
├── style.css               仅主题头部信息（无实际样式）
├── functions.php           主题支持、CDN 资源、CPT/分类法注册、辅助函数
├── index.php               兜底模板
├── front-page.php          首页
├── home.php / single.php   原生「文章」列表 / 详情（与新闻 CPT 互不影响）
├── archive-{product,case,news}.php
├── single-{product,case,news}.php
├── page-{about,contact,resources}.php
├── header.php / footer.php
├── inc/                    后台设置与业务逻辑，全部在 functions.php 末尾 require
│   ├── home-settings.php            首页设置
│   ├── news-hero.php                新闻轮播设置
│   ├── product-specs.php            产品特性字段
│   ├── product-page-content.php     产品详情页模块化渲染 + 默认内容
│   ├── case-details.php             案例详情字段
│   ├── archive-product-settings.php 产品中心设置
│   └── inquiries.php                询价表单：入库 + REST 接口
├── template-parts/         可复用组件
│   ├── product-card.php / product-card-featured.php / product-breadcrumb.php
│   └── product-sections/            产品详情页 section 组件（hero … inquiry）
├── DESIGN.md               设计令牌（颜色 / 字体 / 间距），设计工作遵循此文件
└── manual.md               内容维护手册（面向运营）
```

设计稿 HTML 原型在项目根目录 `design-prototypes/`（含各页面 `code.html` 与 `screen.png`），仅作设计参考，前台运行不依赖它们。

## 产品详情页：模块化渲染

`single-product.php` 统一调用 `alumax_render_product_page()`（`inc/product-page-content.php`），由 `template-parts/product-sections/` 下的 section 组件拼装。每个产品在后台「详情页模块」面板勾选启用的模块，内容在同页「详情页内容」面板编辑，未编辑时显示主题内置默认内容。详见 `manual.md` 3.3。

## 询价表单（RFQ）

`template-parts/product-sections/inquiry.php` → fetch 提交到 REST 接口 `POST /wp-json/alumax/v1/inquiry`（`inc/inquiries.php`），数据存入后台一级菜单「询价记录」（私有 CPT `inquiry`）。无 JS 时回退 admin-post 提交。CORS 默认 `*`，可用 `alumax_inquiry_cors_origin` 过滤器收紧。

## 静态导出

```bash
node tools/export-static.cjs                                              # 输出 static-export/
node tools/export-static.cjs http://localhost:8881 https://cms.example.com  # 表单接口指向线上 WP
```

详见 `manual.md` 第九节。

## 内容类型

- `product`（/products/）、`case`（/projects/）、`news`（/news/，含 `news_category` / `news_tag` 分类法）、`inquiry`（私有，询价记录）在 `functions.php` / `inc/inquiries.php` 注册。
- about / contact / resources 三个页面由 `alumax_ensure_static_pages()` 自动创建，不要删除或改别名，否则对应 `page-{slug}.php` 失效。
- 后台设置页：「首页设置」（`inc/home-settings.php`）、「新闻 → 轮播设置」（`inc/news-hero.php`）等，详见 `manual.md`。

## 部署提示

首次部署或新增 CPT 后若归档地址 404，到「设置 → 固定链接」点一次保存（主题已内置一次性重写刷新）。
