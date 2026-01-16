# スタッフ予約済みスロット取得処理 実装計画

## 概要
指定したスタッフ・日付範囲の予約済み（バツ）スロットをDBから取得する処理を実装する。

## 対象テーブル
- `reservation` - 予約マスター（staff_id, reservation_date, active）
- `reservation_slot` - 予約スロット（reservation_id, slot_time）

## 実装内容

### 1. 取得するデータ
```
入力:
  - staff_id: スタッフID
  - start_date: 開始日
  - end_date: 終了日

出力:
  - 日付ごとの予約済みスロット時間の配列
  例: [
    '2025-12-20' => ['09:00', '09:30', '10:00'],
    '2025-12-21' => ['14:00', '14:30'],
  ]
```

### 2. SQLクエリ
```sql
SELECT
    r.reservation_date,
    rs.slot_time
FROM reservation r
INNER JOIN reservation_slot rs ON r.id = rs.reservation_id
WHERE r.staff_id = :staff_id
  AND r.reservation_date BETWEEN :start_date AND :end_date
  AND r.active = 1
ORDER BY r.reservation_date, rs.slot_time;
```

### 3. 実装場所

#### 3-1. Modelの作成/修正
- `app/Models/Reservation.php` - Reservationモデル作成（なければ）
- `app/Models/ReservationSlot.php` - ReservationSlotモデル作成（なければ）

#### 3-2. Serviceクラス作成
- `app/Services/ReservationSlotService.php`
  - `getBookedSlots(int $staffId, string $startDate, string $endDate): array`

#### 3-3. Controller修正
- `app/Http/Controllers/Front/ReservationController.php`
  - ハードコードの`$schedule`をDB取得に置き換え

### 4. 実装手順

| # | 作業内容 | ファイル |
|---|---------|---------|
| 1 | Reservationモデル作成 | `app/Models/Reservation.php` |
| 2 | ReservationSlotモデル作成 | `app/Models/ReservationSlot.php` |
| 3 | ReservationSlotService作成 | `app/Services/ReservationSlotService.php` |
| 4 | ReservationController修正 | `app/Http/Controllers/Front/ReservationController.php` |

### 5. コード設計

#### Reservation.php
```php
class Reservation extends Model
{
    protected $table = 'reservation';

    public function slots()
    {
        return $this->hasMany(ReservationSlot::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
```

#### ReservationSlot.php
```php
class ReservationSlot extends Model
{
    protected $table = 'reservation_slot';

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
```

#### ReservationSlotService.php
```php
class ReservationSlotService
{
    /**
     * 指定スタッフ・期間の予約済みスロットを取得
     *
     * @return array ['Y-m-d' => ['HH:mm', ...], ...]
     */
    public function getBookedSlots(int $staffId, string $startDate, string $endDate): array
    {
        $slots = ReservationSlot::query()
            ->join('reservation', 'reservation.id', '=', 'reservation_slot.reservation_id')
            ->where('reservation.staff_id', $staffId)
            ->whereBetween('reservation.reservation_date', [$startDate, $endDate])
            ->where('reservation.active', 1)
            ->select('reservation.reservation_date', 'reservation_slot.slot_time')
            ->orderBy('reservation.reservation_date')
            ->orderBy('reservation_slot.slot_time')
            ->get();

        $result = [];
        foreach ($slots as $slot) {
            $date = $slot->reservation_date;
            $time = substr($slot->slot_time, 0, 5); // 'HH:mm:ss' -> 'HH:mm'
            $result[$date][] = $time;
        }

        return $result;
    }
}
```

### 6. 注意事項
- `active = 1` の予約のみ対象（論理削除対応）
- slot_time は TIME型なので 'HH:mm' 形式に変換
- 存在するスロット = 予約済み（バツ）

---
作成日: 2025-12-19
