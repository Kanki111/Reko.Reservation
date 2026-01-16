# データベース設計書

## 概要
- **プロジェクト名**: Neko Reservation Server (猫のサロン予約システム)
- **DB名**: cat_salon
- **DBMS**: MySQL 8.0
- **文字コード**: UTF-8

## テーブル一覧

### 1. users (利用者)
管理画面にアクセスする管理者・スタッフ情報

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT | ユーザーID |
| name | VARCHAR(255) | NOT NULL | ユーザー名 |
| email | VARCHAR(255) | NOT NULL, UNIQUE | メールアドレス |
| email_verified_at | TIMESTAMP | NULL | メール認証日時 |
| password | VARCHAR(255) | NOT NULL | パスワード (ハッシュ化) |
| remember_token | VARCHAR(100) | NULL | ログイン維持トークン |
| created_at | TIMESTAMP | NULL | 作成日時 |
| updated_at | TIMESTAMP | NULL | 更新日時 |

### 2. password_reset_tokens (パスワードリセット)
パスワードリセット用の一時トークン

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| email | VARCHAR(255) | PRIMARY KEY | メールアドレス |
| token | VARCHAR(255) | NOT NULL | リセットトークン |
| created_at | TIMESTAMP | NULL | 作成日時 |

### 3. sessions (セッション)
ユーザーセッション管理

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | VARCHAR(255) | PRIMARY KEY | セッションID |
| user_id | BIGINT UNSIGNED | DEFAULT NULL, INDEX | ユーザーID |
| ip_address | VARCHAR(45) | DEFAULT NULL | IPアドレス |
| user_agent | TEXT | NULL | ユーザーエージェント |
| payload | LONGTEXT | NOT NULL | セッションデータ |
| last_activity | INT | NOT NULL, INDEX | 最終アクティビティ |

### 4. cache (キャッシュ)
アプリケーションキャッシュ

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| key | VARCHAR(255) | PRIMARY KEY | キャッシュキー |
| value | MEDIUMTEXT | NOT NULL | キャッシュ値 |
| expiration | INTEGER | NOT NULL | 有効期限 |

### 5. jobs (ジョブキュー)
バックグラウンドジョブ管理

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT | ジョブID |
| queue | VARCHAR(255) | NOT NULL, INDEX | キュー名 |
| payload | LONGTEXT | NOT NULL | ジョブデータ |
| attempts | TINYINT UNSIGNED | NOT NULL | 試行回数 |
| reserved_at | INTEGER UNSIGNED | NULL | 予約日時 |
| available_at | INTEGER UNSIGNED | NOT NULL | 実行可能日時 |
| created_at | INTEGER UNSIGNED | NOT NULL | 作成日時 |

### 6. job_batches (ジョブバッチ)
バッチジョブ管理

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | VARCHAR(255) | PRIMARY KEY | バッチID |
| name | VARCHAR(255) | NOT NULL | バッチ名 |
| total_jobs | INTEGER | NOT NULL | 総ジョブ数 |
| pending_jobs | INTEGER | NOT NULL | 待機ジョブ数 |
| failed_jobs | INTEGER | NOT NULL | 失敗ジョブ数 |
| failed_job_ids | LONGTEXT | NOT NULL | 失敗ジョブID一覧 |
| options | MEDIUMTEXT | NULL | オプション |
| cancelled_at | INTEGER | NULL | キャンセル日時 |
| created_at | INTEGER | NOT NULL | 作成日時 |
| finished_at | INTEGER | NULL | 完了日時 |

### 7. failed_jobs (失敗ジョブ)
失敗したジョブの記録

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT | 失敗ジョブID |
| uuid | VARCHAR(255) | NOT NULL, UNIQUE | UUID |
| connection | TEXT | NOT NULL | 接続情報 |
| queue | TEXT | NOT NULL | キュー名 |
| payload | LONGTEXT | NOT NULL | ジョブデータ |
| exception | LONGTEXT | NOT NULL | 例外情報 |
| failed_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP | 失敗日時 |

### 8. migrations (マイグレーション)
Laravelマイグレーション実行履歴

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | INT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | マイグレーションID |
| migration | VARCHAR(255) | NOT NULL | マイグレーションファイル名 |
| batch | INT | NOT NULL | バッチ番号 |

### 9. user (顧客ユーザー)
サロンの顧客・利用者情報 (今後ログイン機能実装予定)

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | 顧客ユーザーID |
| name | VARCHAR(255) | NOT NULL | 顧客名 |
| line_connected | TINYINT(1) | NOT NULL, DEFAULT 0 | LINE連携フラグ (1:連携済, 0:未連携) |
| active | TINYINT(1) | NOT NULL, DEFAULT 1 | アカウント状態 (1:有効, 0:無効) |
| created_at | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP | アカウント作成日時 |
| updated_at | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 更新日時 |

**将来拡張**: ログイン機能実装時にメールアドレス、パスワード等の認証情報を追加予定。

### 10. line_user (LINEユーザー)
LINE経由の予約ユーザー管理 - LINE Messaging API連携

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| user_id | INT | NOT NULL, PRIMARY KEY (複合) | 顧客ユーザーID (FK: user.id) |
| line_user_id | VARCHAR(255) | NOT NULL, PRIMARY KEY (複合) | LINE Messaging APIから取得したLINE ID |
| active | TINYINT(1) | NOT NULL, DEFAULT 1 | 連携状態 (1:連携中, 0:連携解除) |
| created_at | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP | 連携開始日時 |
| updated_at | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 更新日時 |

**重要**: LINE Messaging APIを使用して取得したLINE IDを保存。今後実装予定のuserテーブルのログイン機能と連携するための中間テーブル。

### 11. menu (メニュー)
グルーミングメニュー管理 - 可変時間対応

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | メニューID |
| name | VARCHAR(255) | NOT NULL | メニュー名 |
| price | INT | NOT NULL | 価格（円） |
| description | VARCHAR(255) | NOT NULL | メニュー説明 |
| duration_minutes | INT | NOT NULL | 所要時間（分） |
| active | TINYINT(1) | NOT NULL, DEFAULT 0 | アクティブフラグ (1:有効, 0:無効) |
| created_at | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP | 作成日時 |
| updated_at | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 更新日時 |

**所要時間のバリエーション** (duration_minutesに分数で格納):
- 短時間メニュー: `duration_minutes = 30` (30分)
- 中時間メニュー: `duration_minutes = 60` (1時間)  
- 長時間メニュー: `duration_minutes = 90` (1.5時間)
- 超長時間メニュー: `duration_minutes = 120` (2時間)
- カスタム時間: 15分刻みで柔軟に設定可能

**スロット計算**: `duration_minutes ÷ 30` で必要スロット数を自動算出

### 12. reservation (予約マスター)
予約の基本情報管理 - カレンダー表示のベースデータ

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | 予約ID |
| user_id | INT | NOT NULL | 顧客ユーザーID (FK: user.id) |
| menu_id | INT | NOT NULL | 選択したメニューID (FK: menu.id) |
| staff_id | INT | NOT NULL | 担当スタッフID (FK: staff.id) |
| reservation_date | DATE | NOT NULL | 予約日 |
| reservation_time | TIME | NOT NULL | 開始時間 (30分単位) |
| active | TINYINT(1) | DEFAULT 1 | 予約状態 (1:有効, 0:キャンセル) |
| created_at | DATETIME | DEFAULT CURRENT_TIMESTAMP | 予約作成日時 |
| updated_at | DATETIME | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 更新日時 |

**カレンダー連携**:
- このテーブル + menu.duration_minutes + reservation_slotテーブルでカレンダーの○×表示を生成
- 開始時間から所要時間分の連続スロットを占有

### 13. staff (スタッフ)
サロンのスタッフ情報管理

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | スタッフID |
| name | VARCHAR(255) | NOT NULL | スタッフ名 |
| active | TINYINT(1) | DEFAULT 1 | アクティブフラグ (1:有効, 0:無効) |
| created_at | DATETIME | DEFAULT CURRENT_TIMESTAMP | 作成日時 |
| updated_at | DATETIME | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 更新日時 |

### 14. reservation_slot (予約スロット)
予約の時間スロット管理 - 可変時間メニュー対応

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| reservation_id | INT | NOT NULL, PRIMARY KEY (複合) | 予約ID (FK: reservation.id) |
| slot_time | TIME | NOT NULL, PRIMARY KEY (複合) | スロット時間 (30分単位) |
| created_at | DATETIME | DEFAULT CURRENT_TIMESTAMP | 作成日時 |
| updated_at | DATETIME | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 更新日時 |

**カレンダー生成フロー**:

1. **予約作成時**:
   ```sql
   -- reservationマスター作成
   INSERT INTO reservation (user_id, menu_id, staff_id, reservation_date, reservation_time)
   VALUES (1, 2, 3, '2025-12-20', '18:00');
   
   -- menu.duration_minutes(90分)からスロット数計算: 90/30 = 3スロット
   INSERT INTO reservation_slot VALUES 
   (1, '18:00'), (1, '18:30'), (1, '19:00');
   ```

2. **カレンダー表示時**:
   ```sql
   -- 指定日・スタッフのスロット状態をチェック
   SELECT slot_time FROM reservation_slot rs
   JOIN reservation r ON rs.reservation_id = r.id
   WHERE r.reservation_date = '2025-12-20' 
   AND r.staff_id = 3 AND r.active = 1;
   ```

3. **Viewでの○×判定**:
   - スロットが存在 → **×** (予約済み)
   - スロットがなし → **○** (予約可能)

### 15. reservation_history (予約履歴)
予約変更・キャンセル履歴管理

| カラム名 | データ型 | 制約 | 説明 |
|---------|---------|------|------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT | 履歴ID |
| reservation_id | INT | NOT NULL | 予約ID (FK: reservation.id) |
| menu_id | INT | NOT NULL | メニューID (FK: menu.id) |
| user_id | INT | NOT NULL | ユーザーID (FK: user.id) |
| created_at | DATETIME | DEFAULT CURRENT_TIMESTAMP | 履歴作成日時 |
| updated_at | DATETIME | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | 更新日時 |

## インデックス
- users.email (UNIQUE)
- sessions.user_id (INDEX: sessions_user_id_index)
- sessions.last_activity (INDEX: sessions_last_activity_index)
- jobs.queue (INDEX)
- line_user.line_user_id (INDEX: idx_line_user_id)
- line_user.user_id, active (複合INDEX: idx_user_active)
- menu.active (INDEX: idx_active)
- user.line_connected (INDEX: idx_line_connected)
- user.active (INDEX: idx_active)
- staff.active (INDEX: idx_active)
- reservation.staff_id, reservation_date, reservation_time (UNIQUE: 重複予約防止)
- reservation.user_id (INDEX: idx_userid)
- reservation.reservation_date, active (複合INDEX: idx_resercationdate_active)
- reservation.user_id, menu_id (複合INDEX: idx_userid_menuid)
- reservation.user_id, reservation_date, reservation_time (複合INDEX: idx_userid_reservationdate_reservationtime)

## 外部キー制約
- line_user.user_id → user.id (ON DELETE CASCADE)
- reservation.staff_id → staff.id (ON DELETE CASCADE)
- reservation_slot.reservation_id → reservation.id (ON DELETE CASCADE)
- reservation_history.reservation_id → reservation.id
- reservation_history.menu_id → menu.id
- reservation_history.user_id → user.id

## 備考
- 全テーブルで `created_at`, `updated_at` タイムスタンプを使用
- パスワードはbcryptでハッシュ化
- セッションはデータベースストレージを使用
- ジョブキューはデータベースドライバーを使用

最終更新: 2025年12月18日