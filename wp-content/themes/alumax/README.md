# Alumax 主题（开发者说明）

经典 PHP 模板主题，无构建步骤。样式依赖 Tailwind CDN + `functions.php` 内联配置，图标与字体走 Google Fonts CDN，页面图片为外链或媒体库图片，主题目录内没有本地静态资源。

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
├── inc/                    后台设置与字段逻辑，全部在 functions.php 末尾 require
├── product-pages/          产品专属详情页（见下）
├── DESIGN.md               设计令牌（颜色 / 字体 / 间距），设计工作遵循此文件
└── manual.md               内容维护手册（面向运营）
```

设计稿 HTML 原型已移出主题，存放在项目根目录 `design-prototypes/`（含各页面 `code.html` 与 `screen.png`），仅作设计参考，前台运行不依赖它们。

## 产品详情页分发器

`single-product.php` 先按文章别名查找 `product-pages/{别名}.php`：

- 找到 → 整页由专属文件渲染（静态定制内容）；
- 没找到 → 回退到通用动态模板，用文章内容自动排版。

新增专属页：文件只含 `<main>…</main>` 和页面脚本，开头加 ABSPATH 保护（照抄现有文件），**文件名必须与产品文章别名完全一致**。

参数配置器是产品之一：`system-parameter-configurator` → `product-pages/system-parameter-configurator.php`，前台地址 `/products/system-parameter-configurator/`。不存在独立的 `/configurator/` 工具页。

## 内容类型

- `product`（/products/）、`case`（/projects/）、`news`（/news/，含 `news_category` / `news_tag` 分类法）均在 `functions.php` 注册。
- about / contact / resources 三个页面由 `alumax_ensure_static_pages()` 自动创建，不要删除或改别名，否则对应 `page-{slug}.php` 失效。
- 后台设置页：「首页设置」（`inc/home-settings.php`）、「新闻 → 轮播设置」（`inc/news-hero.php`）等，详见 `manual.md`。

## 部署提示

首次部署或新增 CPT 后若归档地址 404，到「设置 → 固定链接」点一次保存（主题已内置一次性重写刷新）。
