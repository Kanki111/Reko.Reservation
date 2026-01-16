<?php

namespace App\Services;

use App\Models\LineUser;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\ReservationSlot;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    /**
     * 予約を作成
     *
     * @throws \Exception
     */
    public function createReservation(array $data): array
    {
        // 1. LINE IDからuser_idを取得
        $userId = LineUser::getUserIdByLineId($data['line_user_id']);
        if (!$userId) {
            throw new \Exception('USER_NOT_FOUND');
        }

        // 2. スタッフ存在確認
        $staff = Staff::where('id', $data['staff_id'])->where('active', 1)->first();
        if (!$staff) {
            throw new \Exception('STAFF_NOT_FOUND');
        }

        // 3. メニュー取得 & スロット数算出
        $menu = Menu::where('id', $data['menu_id'])->where('active', 1)->first();
        if (!$menu) {
            throw new \Exception('MENU_NOT_FOUND');
        }
        $slotCount = $menu->getSlotCount();

        // 4. 予約対象スロットを生成
        $slots = $this->generateSlots($data['reservation_time'], $slotCount);

        // 5. スロット重複チェック
        $conflictingSlots = $this->checkSlotConflicts(
            $data['staff_id'],
            $data['reservation_date'],
            $slots
        );
        if (!empty($conflictingSlots)) {
            throw new \Exception('SLOT_CONFLICT:' . implode(',', $conflictingSlots));
        }

        // 6. トランザクションで予約作成
        $reservation = DB::transaction(function () use ($data, $userId, $slots) {
            // reservation INSERT
            $reservation = Reservation::create([
                'user_id' => $userId,
                'menu_id' => $data['menu_id'],
                'staff_id' => $data['staff_id'],
                'reservation_date' => $data['reservation_date'],
                'reservation_time' => $data['reservation_time'],
                'active' => 1,
            ]);

            // reservation_slot INSERT
            foreach ($slots as $slotTime) {
                ReservationSlot::create([
                    'reservation_id' => $reservation->id,
                    'slot_time' => $slotTime,
                ]);
            }

            return $reservation;
        });

        return [
            'reservation_id' => $reservation->id,
            'staff_id' => $reservation->staff_id,
            'reservation_date' => $reservation->reservation_date->format('Y-m-d'),
            'reservation_time' => substr($reservation->reservation_time, 0, 5),
            'slot_count' => $slotCount,
            'slots' => $slots,
        ];
    }

    /**
     * 開始時間からスロット配列を生成
     */
    private function generateSlots(string $startTime, int $slotCount): array
    {
        $slots = [];
        $current = Carbon::parse($startTime);

        for ($i = 0; $i < $slotCount; $i++) {
            $slots[] = $current->format('H:i');
            $current->addMinutes(30);
        }

        return $slots;
    }

    /**
     * スロット重複チェック
     */
    private function checkSlotConflicts(int $staffId, string $date, array $slots): array
    {
        // HH:mm を HH:mm:ss に変換
        $slotTimes = array_map(fn($s) => $s . ':00', $slots);

        $conflicts = ReservationSlot::query()
            ->join('reservation', 'reservation.id', '=', 'reservation_slot.reservation_id')
            ->where('reservation.staff_id', $staffId)
            ->where('reservation.reservation_date', $date)
            ->where('reservation.active', 1)
            ->whereIn('reservation_slot.slot_time', $slotTimes)
            ->pluck('reservation_slot.slot_time')
            ->map(fn($t) => substr($t, 0, 5))
            ->toArray();

        return $conflicts;
    }
}
