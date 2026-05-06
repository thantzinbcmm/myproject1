<!-- SETUP.md -->
# Thant Portfolio 管理システム — セットアップ手順

## 必要環境

- PHP 8.2 以上
- Composer 2.x
- Node.js 18.x 以上 / npm 9.x 以上
- MySQL 8.0 以上

---

## 1. プロジェクト作成（新規の場合）

    composer create-project laravel/laravel thant-portfolio
    cd thant-portfolio

---

## 2. Laravel Breeze のインストール（認証）

    composer require laravel/breeze --dev
    php artisan breeze:install blade
    composer require laravel/sanctum
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

---

## 3. ファイル配置

リポジトリからすべてのファイルを所定のパスに配置してください。

---

## 4. 環境設定

    cp .env.example .env
    php artisan key:generate

`.env` を編集してデータベース接続情報を設定:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=thant_portfolio
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

---

## 5. データベース作成

MySQL にログインしてデータベースを作成:

    CREATE DATABASE thant_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

---

## 6. マイグレーション & シーダー実行

    php artisan migrate
    php artisan db:seed

---

## 7. フロントエンドビルド

    npm install
    npm run build

開発時はホットリロード:

    npm run dev

---

## 8. 管理者ユーザー作成

    php artisan tinker

Tinker 内で実行:

    \App\Models\User::create([
        'name'     => '管理者',
        'email'    => 'admin@thant.com',
        'password' => bcrypt('your_secure_password'),
    ]);
    exit

---

## 9. 開発サーバー起動

    php artisan serve

ブラウザで `http://localhost:8000/admin/contents` にアクセスし、
作成したメールアドレス・パスワードでログイン。

---

## 10. ルート確認

    php artisan route:list --path=admin

---

## 主要URL一覧

| URL                        | 説明                     |
|---------------------------|--------------------------|
| /login                    | ログイン画面              |
| /admin/contents           | 掲載コンテンツ管理        |
| /admin/design             | デザイン設定              |
| /admin/tech-stack         | 技術スタック選択          |
| /api/experience           | 経歴 REST API             |
| /api/projects             | プロジェクト REST API     |
| /api/blog-summary         | ブログ概要 REST API       |
| /api/contact              | 連絡先 REST API           |
| /api/design-settings      | デザイン設定 REST API     |
| /api/tech-stack           | 技術スタック REST API     |

---

## セキュリティ注意事項

- 本番環境では `APP_DEBUG=false` に設定すること
- `APP_KEY` は必ず `php artisan key:generate` で生成すること
- HTTPS を必ず有効にすること
- データベースのパスワードは強力なものを使用すること