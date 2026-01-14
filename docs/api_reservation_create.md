# 予約作成API 設計書

## 概要
LINE Bot経由で予約を作成するAPIエンドポイント

## エンドポイント
```
POST /api/reservations
```

## リクエスト

### Headers
```
Content-Type: application/json
```

### Body
| パラメータ | 型 | 必須 | 説明 |
|-----------|-----|------|------|
| line_user_id | string | ○ | LINE ユーザーID |
| staff_id | int | ○ | スタッフID |
| menu_id | int | ○ | メニューID (menu.duration_minutes からスロット数算出) |
| reservation_date | string | ○ | 予約日 (YYYY-MM-DD) |
| reservation_time | string | ○ | 開始時間 (HH:mm) |

**スロット数**: `menu.duration_minutes ÷ 30` で自動計算

### リクエスト例
```json
{
    "line_user_id": "U1234567890abcdef",
    "staff_id": 1,
    "menu_id": 2,
    "reservation_date": "2025-12-20",
    "reservation_time": "14:00"
}
```

## レスポンス

### 成功時 (201 Created)
```json
{
    "success": true,
    "data": {
        "reservation_id": 123,
        "staff_id": 1,
        "reservation_date": "2025-12-20",
        "reservation_time": "14:00",
        "slot_count": 3,
        "slots": ["14:00", "14:30", "15:00"]
    }
}
```

### エラー時

#### 400 Bad Request - バリデーションエラー
```json
{
    "success": false,
    "error": {
        "code": "VALIDATION_ERROR",
        "message": "入力内容に誤りがあります",
        "details": {
            "reservation_date": ["予約日は今日以降の日付を指定してください"]
        }
    }
}
```

#### 409 Conflict - スロット重複
```json
{
    "success": false,
    "error": {
        "code": "SLOT_CONFLICT",
        "message": "指定された時間帯は既に予約が入っています",
        "conflicting_slots": ["14:30", "15:00"]
    }
}
```

#### 404 Not Found - ユーザー未登録
```json
{
    "success": false,
    "error": {
        "code": "USER_NOT_FOUND",
        "message": "LINE連携されていないユーザーです"
    }
}
```

## 処理フロー

```
1. リクエストバリデーション
   ├─ 必須パラメータチェック
   ├─ 日付・時間フォーマットチェック
   └─ reservation_date: 今日以降

2. ユーザー解決
   └─ line_user_id → user_id 取得 (line_userテーブル)

3. スタッフ存在確認
   └─ staff.id, active=1 チェック

4. メニュー取得 & スロット数算出
   ├─ menu.id, active=1 チェック
   └─ slot_count = menu.duration_minutes ÷ 30

5. スロット重複チェック
   ├─ 予約対象スロット生成 (reservation_time から slot_count 分)
   └─ reservation + reservation_slot で既存予約チェック

6. トランザクション開始
   ├─ reservation INSERT
   └─ reservation_slot INSERT (slot_count 件)

7. レスポンス返却
```

## DB操作

### 1. ユーザーID取得
```sql
SELECT user_id FROM line_user
WHERE line_user_id = :line_user_id AND active = 1
LIMIT 1;
```

### 2. スロット重複チェック
```sql
SELECT rs.slot_time
FROM reservation_slot rs
JOIN reservation r ON r.id = rs.reservation_id
WHERE r.staff_id = :staff_id
  AND r.reservation_date = :reservation_date
  AND r.active = 1
  AND rs.slot_time IN (:slot_times);
```

### 3. 予約作成
```sql
-- reservation INSERT
INSERT INTO reservation (user_id, menu_id, staff_id, reservation_date, reservation_time)
VALUES (:user_id, :menu_id, :staff_id, :reservation_date, :reservation_time);

-- reservation_slot INSERT (例: 3スロット)
INSERT INTO reservation_slot (reservation_id, slot_time) VALUES
(:reservation_id, '14:00'),
(:reservation_id, '14:30'),
(:reservation_id, '15:00');
```

## スロット数の算出

menu_id からスロット数を自動算出:

```php
// メニュー取得
$menu = Menu::where('id', $menuId)->where('active', 1)->firstOrFail();

// スロット数算出 (30分単位)
$slotCount = (int) ceil($menu->duration_minutes / 30);

// 例: 90分メニュー → 3スロット (90 ÷ 30 = 3)
// 例: 45分メニュー → 2スロット (ceil(45 ÷ 30) = 2)
```

## 実装ファイル

| ファイル | 内容 |
|---------|------|
| `routes/api.php` | ルーティング定義 |
| `app/Http/Controllers/Api/ReservationController.php` | APIコントローラー |
| `app/Http/Requests/Api/CreateReservationRequest.php` | バリデーション |
| `app/Services/ReservationService.php` | ビジネスロジック |
| `app/Models/LineUser.php` | LINEユーザーモデル |

## バリデーションルール

```php
[
    'line_user_id'     => 'required|string|max:255',
    'staff_id'         => 'required|integer|exists:staff,id',
    'menu_id'          => 'required|integer|exists:menu,id',
    'reservation_date' => 'required|date|after_or_equal:today',
    'reservation_time' => 'required|date_format:H:i',
]
```

## 営業時間チェック (オプション)

```php
// 予約可能時間帯 (例)
$openTime = '09:00';
$closeTime = '19:00';

// 最終スロットが営業時間内か確認
$lastSlotTime = Carbon::parse($reservation_time)
    ->addMinutes(($slot_count - 1) * 30)
    ->format('H:i');
```

---
作成日: 2025-12-19
