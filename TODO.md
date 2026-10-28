# Alumax 项目待办清单

> 按优先级分组，完成一项就把 `[ ]` 改成 `[x]`。建议顺序：上线前阻塞项（先做 3、4 纯本地工作）→ 上线 → 运营补强 → 工程增强。

## 一、上线前必须解决（阻塞项）

- [ ] **1. 线上环境**：WordPress 后端放到公开服务器（虚拟主机/VPS）；静态站选托管（Netlify / Cloudflare Pages / OSS）；域名解析 + HTTPS
- [ ] **2. 数据库迁移验证**：本地 SQLite → 线上 MySQL，用 `studio export --mode db` 导出后实测导入一次，别等上线当天
- [ ] **3. Tailwind 生产构建**：弃用 `cdn.tailwindcss.com` 开发模式，改为构建期生成静态 CSS 文件（官方明确不建议生产用 CDN）
- [ ] **4. 文章配图本地化**：外链图片（Unsplash / Google lh3）下载进媒体库并压缩，避免防盗链/失效/不可控

## 二、上线后一周内补（运营必需）

- [ ] **5. 询盘邮件通知**：WP 端配 SMTP 插件 + 询价入库时 `wp_mail()` 提醒
- [ ] **6. 表单防垃圾**：蜜罐基础上加 Cloudflare Turnstile（免费）
- [ ] **7. SEO 基础**：meta description、OG 标签、sitemap.xml、提交 Google Search Console
- [ ] **8. 语言切换入口**：页头 EN/ES/FR/AR/DE 目前是死链（`#`），要么接多语言插件（Polylang/WPML），要么先删除

## 三、工程增强（可选）

- [ ] **9. CI 自动部署**：GitHub Actions，`git push` 后自动跑 `tools/export-static.cjs` 并发布静态站
- [ ] **10. 404 模板**：补一个 `404.php`（现在 404 落到简陋的 `index.php`）
- [ ] **11. 主题缩略图**：补 `screenshot.png`（后台主题列表用）
- [ ] **12. 线上备份策略**：WP 数据库 + uploads 自动备份

## 备注

- 项 3 完成后记得同步更新 `manual.md`（资源加载方式变化）
- 项 1 完成后：用 `node tools/export-static.cjs <本地地址> <线上WP地址>` 重新导出静态站；用 `alumax_inquiry_cors_origin` 过滤器把表单接口跨域收紧到正式域名
- 相关文档：`wp-content/themes/alumax/manual.md` 第九节（静态部署）、`README.md`（开发者说明）
