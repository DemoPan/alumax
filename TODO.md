# Aluviona (Alumax) 项目待办清单

> **架构决策**：采用 **方案 A（前台纯静态 + 后台 WordPress 动静分离）**
> - **测试环境（Staging）**：`https://alumax.mpan.org`（GitHub Pages，跟踪 `main` 分支代码，用于日常改动预览与全站功能验收）
> - **生产环境（Production）**：`https://aluviona.com`（纯静态 HTML/CSS/JS，托管于 FTP 服务器，验收通过后通过 GitHub Actions 一键推送到正式环境）
> - **后端中心（CMS & API）**：`https://cms.aluviona.com`（WordPress CMS，负责内容管理、接收 `/wp-json/alumax/v1/inquiry` 表单并触发邮件通知）

---

## 阶段流水线：从测试到正式的日常发布流

```text
[本地开发/内容更新] 
       ↓ 运行 node tools/export-static.cjs
[导出静态站到 static-export/]
       ↓ git push origin main
[测试环境自动更新] → 访问 https://alumax.mpan.org 验证效果
       ↓ 验收无误，发布到正式环境 (二选一)
       ├─► 方式 1: 在 GitHub 网页 Actions 页面点击 "Run workflow" 一键发布到生产
       └─► 方式 2: 合并推送到 production 分支自动触发发布
[生产环境更新] → https://aluviona.com 上线成功
```

---

## 一、方案 A 动静分离与双环境核心路线

- [x] **1. 域名解析与 SSL 证书（前台部分已完成）**
  - [x] 在域名商将 `aluviona.com` 与 `www.aluviona.com` 解析到 FTP 服务器 IP（已生效，HTTP 200 / HTTPS 正常）
  - [x] 保留 `alumax.mpan.org` 的 CNAME 解析指向 `demopan.github.io`（测试环境 GitHub Pages 托管）
  - [ ] 后续：将 `cms.aluviona.com` 解析到 WordPress 后端服务器 IP 并开启 SSL
- [ ] **2. WordPress 后端服务搭建与数据迁移**
  - 在后端服务器部署 WordPress 环境（PHP 8.1+ / MySQL 8.0）
  - 将本地 Studio 的数据导出并导入线上 MySQL（`studio export --mode db`）
  - 上传媒体库资源（`wp-content/uploads/`）与主题（`wp-content/themes/alumax/`）
  - 绑定域名 `cms.aluviona.com`，并在后台「设置 → 固定链接」保存一次以刷新 REST API 规则
- [x] **3. 测试/生产双阶 GitHub Actions 自动化工作流配置**
  - 保留静态站 `CNAME` 文件为 `alumax.mpan.org`（保证测试环境 GitHub Pages 正常运转）
  - 配置 `.github/workflows/deploy.yml`：
    - 推送 `main` 分支：仅更新测试环境 GitHub Pages
    - 触发 `workflow_dispatch`（网页一键点击）或推送 `production` 分支：通过 FTP 增量同步到 `aluviona.com` 生产服务器
- [ ] **4. 生产环境跨域与静态导出联动**
  - 本地执行静态导出命令（将 API 指向线上后端）：
    `node tools/export-static.cjs http://localhost:8881 https://cms.aluviona.com`
  - 在 WP 端使用 `alumax_inquiry_cors_origin` 过滤器收紧跨域为 `https://aluviona.com`

---

## 二、上线必做重点强化项（重点推进）

- [ ] **5. Tailwind CSS 静态化编译（弃用 CDN 依赖）**
  - **现状**：前台目前依赖 `cdn.tailwindcss.com` 开发运行时模式，官方明确禁止生产使用（存在首屏闪烁及外部 CDN 依赖）。
  - **目标**：在构建期通过 Tailwind CLI 扫描全站模板，提取类名并输出为压缩的单个静态 CSS 文件（如 `assets/css/main.min.css`）。
  - **执行步骤**：
    1. 配置 `tailwind.config.js`，包含所有 PHP 与 HTML 模板路径；
    2. 运行构建脚本生成编译后的 CSS；
    3. 在 `header.php` 中替换掉 Tailwind CDN 脚本标签；
    4. 验证全站样式渲染无丢失后同步更新 `manual.md`。

- [ ] **6. 配置 SMTP 询盘邮件提醒（RFQs 实时通知）**
  - **现状**：前台询盘提交后数据仅保存在 WP 数据库 CPT `inquiry` 中，无实时通知机制，容易漏单。
  - **目标**：客户提交 RFQ / 工程图纸后，管理员与业务团队邮箱在 10 秒内收到完整询盘通知邮件。
  - **执行步骤**：
    1. 在 WP 端安装并配置 SMTP 插件（如 WP Mail SMTP），绑定企业邮箱或服务商（腾讯企业邮/阿里企业邮/SendGrid/Resend）；
    2. 在 `inc/inquiries.php` 的 `alumax_save_inquiry()` 存储成功后调用 `wp_mail()`；
    3. 邮件模板包含：客户姓名、企业邮箱、公司、国家/港口、项目留言、图纸下载链接；
    4. 线上实测一次真实提交，确认邮件秒级送达。

- [ ] **7. 文章与案例配图本地化**
  - 将外链图片（Unsplash / Google 托管图）下载收录进媒体库，避免第三方防盗链或链接失效导致前台裂图。

---

## 三、运营与安全补强（上线后一周内）

- [ ] **8. 表单防垃圾加固**：在现有蜜罐（Honeypot）基础上，接入 Cloudflare Turnstile（免费、静默无感验证）。
- [ ] **9. SEO 基础设施**：配置前台 `sitemap.xml`、`robots.txt`、Canonical URL 及 OpenGraph 社交分享标签，提交至 Google Search Console。
- [ ] **10. 语言切换死链处理**：页头语言切换（EN / ES / FR / AR / DE）当前为 `#`，确定是接入多语言静态版本还是首期先隐藏非 EN 选项。

---

## 四、工程与维护（可选）

- [ ] **11. 404 错误页优化**：补充专用的静态 `404.html` 友好提示页。
- [ ] **12. 数据库与附件自动备份策略**：后端服务器配置定时备份（每日增量备份到云端存储）。
