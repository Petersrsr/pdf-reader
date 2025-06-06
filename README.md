# pdf-reader
PDF 在线阅读器，支持自动滚动、节拍器、缩放，带文件上传和管理功能。
# PDF 在线阅读器

这是一个基于网页的 PDF 在线阅读器项目，支持：

- 浏览服务器 `pdfs` 目录下的 PDF 文件
- 自动滚动阅读功能，支持调节滚动速度
- 自定义缩放阅读 PDF 页面
- 内置节拍器，支持自定义 BPM 和视觉提示
- PDF 文件上传和删除管理功能
- 简洁友好的界面设计

## 目录结构

- `index.html` — 文件列表页面，支持上传和删除 PDF
- `yuedu.html` — PDF 阅读页面，支持自动滚动、缩放、节拍器功能
- `upload.php` — 后端文件上传接口
- `list.php` — 获取 PDF 文件列表接口
- `delete.php` — 删除 PDF 文件接口

## 部署

1. 将项目文件上传到支持 PHP 的服务器（如宝塔面板的 Apache/Nginx）
2. 确保服务器根目录有 `pdfs` 文件夹，设置合适权限
3. 访问 `index.html` 即可浏览和管理 PDF 文件，点击文件名进入阅读页面

## 使用技术

- PDF.js 用于 PDF 渲染
- 原生 JavaScript 实现自动滚动、节拍器、缩放控制
- PHP 处理文件上传和管理

## 许可证

MIT License

---

欢迎 Star 和 Fork，欢迎提出 Issue 和 Pull Request 贡献代码！

---

## 联系方式

作者：Petersr  
网站：[https://petersr.xyz](https://petersr.xyz)
