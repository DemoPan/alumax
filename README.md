# Alumax

Alumax 建筑金属产品官网的 WordPress 主题与设计资料。本地开发环境由 [WordPress Studio](https://developer.wordpress.com/studio/) 提供，仓库不包含 WordPress 核心、插件、上传文件和数据库。

## 仓库结构

```
├── wp-content/themes/alumax/   主题（经典 PHP 模板，无构建步骤）
│   ├── README.md               开发者文档：结构、产品详情页分发器、CPT
│   ├── manual.md               内容维护手册（面向运营）
│   └── DESIGN.md               设计令牌（颜色 / 字体 / 间距）
├── design-prototypes/          设计稿 HTML 原型与截图，仅作参考，前台不依赖
├── STUDIO.md                   本地 WordPress Studio 环境说明
└── AGENTS.md                   AI 助手工作约定
```

## 本地开发

1. 用 WordPress Studio 创建站点，将本仓库内容放入站点根目录（或直接在站点根目录克隆本仓库）。
2. 后台启用 **Alumax** 主题；首次使用若归档地址 404，到「设置 → 固定链接」保存一次。
3. 主题的二次开发先看 `wp-content/themes/alumax/README.md`，改内容看 `manual.md`，设计工作遵循 `DESIGN.md`。
