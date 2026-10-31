# TP8 Demo

ThinkPHP 8 入门练习项目，用于熟悉路由、中间件、链式查询等基础用法。项目使用 Git 做版本管理，同时托管到 GitHub 和 Gitee。

## 技术栈

- PHP 8.2
- ThinkPHP 8
- MySQL
- Composer

## 目录结构

```text
tp8-app/
├── app/                # 应用代码（控制器、模型、中间件）
├── config/             # 配置文件
├── public/             # Web 入口目录
│   ├── index.php       # 入口文件
│   └── .htaccess       # Apache 重写规则（需提交）
├── runtime/            # 运行时缓存（不提交）
├── vendor/             # Composer 依赖（不提交，composer install 重建）
├── .env                # 本地环境配置（含数据库密码，不提交）
├── .gitignore
└── composer.json
```

## 环境要求

- PHP >= 8.0
- Composer
- MySQL 5.7+ / 8.0+
- Apache（phpStudy）或 PHP 内置服务器

## 本地运行

### 1. 安装依赖

```bash
composer install
```

### 2. 配置环境变量

复制 `.env.example` 为 `.env`（若无模板则手动创建），填入数据库信息：

```ini
APP_DEBUG = true

[DATABASE]
TYPE = mysql
HOSTNAME = 127.0.0.1
DATABASE = 你的库名
USERNAME = 你的用户名
PASSWORD = 你的密码
HOSTPORT = 3306
CHARSET = utf8mb4
```

> `.env` 含数据库密码，已加入 `.gitignore`，不会提交到仓库。

### 3. 启动项目

**方式一：PHP 内置开发服务器（推荐本地调试）**

```bash
php think run
```

默认监听 `http://0.0.0.0:8000/`，文档根目录为 `public/`。指定端口：

```bash
php think run -p 8081
```

> `php think run` 是 ThinkPHP 封装的 PHP 内置服务器，端口由命令参数决定（默认 8000），与 phpStudy 的 Apache/Nginx 是两套独立的服务器，互不影响。

**方式二：phpStudy（Apache）**

在 phpStudy 中新建站点，**网站根目录必须精确指向 `public/`**，例如：

```text
D:\Ex_Projects\TP8_test\tp8-app\public
```

保存后重启 Apache，通过站点配置的端口访问。

> 根目录指向 `public/` 是安全边界：`.env`、`app/`、`vendor/` 位于 `public/` 的上级目录，不会被 Web 直接访问。

## Git 托管

项目同时推送到两个远程仓库：

```bash
# 查看远程配置
git remote -v

# 分别推送
git push github main
git push gitee main
```

- GitHub：`git@github.com:RedVelvetMiko/TP8-Demo.git`
- Gitee：`git@gitee.com:RedVelvetMiko/TP8-Demo.git`

## 注意事项

### `.gitignore` 关键规则

```gitignore
.env
.env.*
!.env.example
vendor/
runtime/
*.log
.idea/
.vscode/
```

- `.env`：含数据库密码，**绝对不能提交**
- `vendor/`：Composer 依赖，可 `composer install` 重建
- `runtime/`：运行时缓存，换环境或换路径后应清空

### `.htaccess` 被覆盖时的恢复

phpStudy 修改站点根目录或启用伪静态时，可能覆盖 `public/.htaccess`。该文件已提交到 Git，被覆盖后可恢复：

```bash
git status                          # 确认 public/.htaccess 被修改
git diff public/.htaccess           # 查看具体变化
git restore public/.htaccess        # 恢复到最近一次提交的版本
```

> `.htaccess` 是路由重写规则，属于配置源码，不含敏感信息，应提交到仓库。备份文件（`.bak` / `.backup`）不提交，Git 历史本身就是备份。

### 项目换位置后需要检查

1. `vendor/` 是否随项目一起移动（漏了会报 `autoload.php` 找不到）
2. 清空 `runtime/` 缓存（旧路径信息会残留）
3. phpStudy 网站根目录是否同步指向新位置的 `public/`
4. `.env` 中是否有写死的绝对路径需要修改

## 学习记录

- Git 基础：`init` / `status` / `add` / `commit` / `push` / `pull` / `branch` / `clone`
- SSH 密钥配置，GitHub 与 Gitee 双平台托管
- TP8 项目目录迁移与 phpStudy 站点根目录调整
- `.htaccess` 路由规则与版本控制恢复
- PHP 内置服务器（`php think run`）与 Apache 部署的区别