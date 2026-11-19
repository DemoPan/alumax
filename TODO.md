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

- [x] **5. Tailwind CSS 静态化编译（弃用 CDN 依赖 - 已完成）**
  - [x] 配置 `tailwind.config.js`，支持 forms 与 container-queries 插件
  - [x] 配置 `assets/css/input.css`，引入 Tailwind 指令与全局滚动条/基础层样式
  - [x] 编译输出压缩版 `assets/css/main.min.css`（仅 61KB）
  - [x] 更新 `functions.php`，彻底移除 `cdn.tailwindcss.com` 外部 CDN 依赖，全站通过本地静态 CSS 加载
  - [x] 本地静态全站重新导出实测通过

- [x] **6. 配置 SMTP 询盘邮件提醒（RFQs 实时通知 - 代码层已就绪）**
  - [x] 在 `inc/inquiries.php` 实现 `alumax_send_inquiry_notification()`，生成专业商务 HTML 邮件通知
  - [x] 支持在邮件中直接展示客户姓名、企业邮箱、公司、国家、意向产品、留言及图纸附件下载直链
  - [x] 邮件 `Reply-To` 自动设置为客户邮箱，点击“回复”即可直接与潜在客户对话
  - [x] 内置 `phpmailer_init` 钩子，支持直接在 `wp-config.php` 配置 SMTP 常量或搭配常用 SMTP 插件发件
  - [ ] 待上线：填入真实发信邮箱账号密码实测一次收发

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
