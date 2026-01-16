<?php

namespace App\Services;

use App\Models\ReservationSlot;

class ReservationSlotService
{
    /**
     * 指定スタッフ・期間の予約済みスロットを取得
     *
     * @param int $staffId スタッフID
     * @param string $startDate 開始日 (Y-m-d)
     * @param string $endDate 終了日 (Y-m-d)
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
            // TIME型 'HH:mm:ss' を 'HH:mm' に変換
            $time = substr($slot->slot_time, 0, 5);
            $result[$date][] = $time;
        }

        return $result;
    }
}
