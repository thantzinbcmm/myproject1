<!-- README.md -->
# Thant Portfolio 管理システム

ポートフォリオWebサイト構築のための管理画面システムです。
掲載コンテンツ・デザイン設定・技術スタックの管理を提供します。

---

## 機能一覧

### 掲載コンテンツ管理
- 経歴情報の追加・編集・削除
- プロジェクト紹介の追加・編集・削除
- ブログ記事概要の登録・管理
- 連絡先情報の登録・管理

### デザイン設定
- テーマ選択（シンプル / モダン / カラフル）
- カラースキーム設定（6色）
- フォントスタイル設定（5種）

### 技術スタック管理
- 12種のプリセットから選択
- 選択状態のトグル管理

---

## 技術スタック

| カテゴリ       | 技術                        |
|---------------|-----------------------------|
| バックエンド   | Laravel 11.x / PHP 8.2      |
| データベース   | MySQL 8.0                   |
| フロントエンド | Blade / Alpine.js 3.x       |
| CSS           | Tailwind CSS 3.x            |
| 認証          | Laravel Breeze / Sanctum    |

---

## アーキテクチャ

    Controller → Service → Model → DB

- **Service層**: PortfolioContentManager / DesignSettingsManager / TechStackManager
- **FormRequest**: バリデーション責務を分離
- **APIとWeb両対応**: Blade管理画面 + RESTful API

---

## セットアップ

SETUP.md を参照してください。

---

## ライセンス

MIT License