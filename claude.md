# Claude AI 支援用プロジェクト情報

## プロジェクト概要
**プロジェクト名**: Neko Reservation Server  
**用途**: 猫のサロン予約システム  
**フレームワーク**: Laravel 11.x  
**言語**: PHP 8.2  
**データベース**: MySQL 8.0  
**コンテナ**: Docker Compose  

## 技術スタック
- **バックエンド**: PHP 8.2 + Laravel 11.x
- **フロントエンド**: Blade テンプレート + CSS + JavaScript
- **データベース**: MySQL 8.0 (cat_salon)
- **インフラ**: Docker (Nginx + PHP-FPM + MySQL)
- **外部連携**: LINE Bot API (予約機能)

## プロジェクト構造
```
/
├── app/                     # Laravel アプリケーション
│   ├── Http/Controllers/    # コントローラー
│   │   ├── StaffController.php
│   │   └── Front/FrontReservationController.php
│   └── Models/              # Eloquent モデル
│       ├── User.php         # 管理者ユーザー
│       └── Staff.php        # スタッフ情報
├── resources/
│   ├── views/               # Blade テンプレート
│   │   ├── layouts/app.blade.php      # 共通レイアウト
│   │   ├── front/reservation/         # 予約画面
│   │   └── front/flow/                # フロー表示
│   └── css/common.css       # 共通CSS
├── routes/web.php           # ルーティング定義
├── database/
│   ├── migrations/          # マイグレーション
│   ├── schema.sql           # DB スキーマ定義
│   └── database.md          # DB 設計書
├── docker-compose.yml       # Docker 設定
└── docs/
    └── database.md          # データベース仕様書
```

## データベース構成 (cat_salon)

### 📋 メインアプリケーションテーブル (6個)
1. **user**: 顧客情報 (LINE連携フラグあり)
2. **line_user**: LINE ユーザー連携中間テーブル
3. **staff**: スタッフ情報
4. **menu**: グルーミングメニュー
5. **reservation**: 予約情報 (重複予約防止制約あり)
6. **migrations**: Laravelマイグレーション履歴

### 🔗 詳細な設計情報
**⚠️ 重要: データベース関連の質問や実装時は必ず以下を参照してください**

- **📖 完全なテーブル仕様**: [docs/database.md](docs/database.md)
  - 全テーブルの詳細構造・制約・インデックス情報
  - 外部キー制約・複合インデックスの設計意図
  - データ型・デフォルト値・論理削除フラグの説明

- **💾 実際のSQL文**: [database/schema.sql](database/schema.sql)  
  - CREATE TABLE文の完全版
  - インデックス・制約の実装詳細
  - 実際のデータベース構築用SQL

**🎯 Claude AI への指示:**
データベース設計、テーブル作成、モデル実装、リレーション設定などを行う際は、必ず docs/database.md を参照して正確な情報を基に回答・実装してください。

## 実装済み機能
- ✅ Docker 環境構築
- ✅ Laravel MVC 基本構造
- ✅ スタッフ管理 (Staff モデル・コントローラー)
- ✅ 予約カレンダー表示
- ✅ 共通レイアウトシステム
- ✅ CSS 共通化・最適化

## 開発中の機能
- 🚧 LINE Bot 連携
- 🚧 予約システム完全実装
- 🚧 メニュー管理機能

## コーディング規約
- **PHP**: PSR-12 準拠
- **Laravel**: 標準的な MVC パターン
- **CSS**: 共通ファイル (common.css) を活用
- **命名**: 日本語コメント + 英語コード

## 重要な設計ポイント
1. **レイアウト継承**: `@extends('layouts.app')` で統一
2. **CSS 共通化**: 重複排除・保守性向上
3. **論理削除**: `active` フラグでソフトデリート
4. **外部キー制約**: データ整合性を保証

## 開発環境
```bash
# Docker 起動
docker-compose up -d

# Laravel コマンド
docker-compose exec app php artisan migrate
docker-compose exec app php artisan serve
```

## 注意事項
- タイムゾーン: Asia/Tokyo
- 文字コード: UTF-8 (utf8mb4_unicode_ci)
- ファイル編集時は必ず確認を求める
- CSS 重複は避けて common.css を活用

---
**作成日**: 2025年12月18日  
**用途**: Claude AI による効率的な開発支援のための情報集約