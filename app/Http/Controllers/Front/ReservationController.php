<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Staff;
use App\Services\ReservationSlotService;

class ReservationController
{
    private ReservationSlotService $reservationSlotService;

    public function __construct(ReservationSlotService $reservationSlotService)
    {
        $this->reservationSlotService = $reservationSlotService;
    }

    /**
     * 予約の空き情報の取得
     */
    public function index(Request $request)
    {
        $staffList = Staff::active()->get();

        // デフォルトは最初のアクティブなスタッフ
        $defaultStaffId = $staffList->first()?->id;
        $staffId = $request->get('staff', $defaultStaffId);
        $targetDate = $request->get('targetDate', now()->format('Y-m-d'));

        // 週範囲の計算
        $target = Carbon::parse($targetDate);
        $monday = $target->copy()->startOfWeek(Carbon::MONDAY);
        $sunday = $monday->copy()->addDays(6);
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $weekDays[] = $monday->copy()->addDays($i);
        }

        // DBから予約済みスロット（バツ）を取得
        $bookedSlots = $this->reservationSlotService->getBookedSlots(
            $staffId,
            $monday->format('Y-m-d'),
            $sunday->format('Y-m-d')
        );

        return view('front.reservation.index', [
            'staffList' => $staffList,
            'selectStaff' => $staffId,
            'monday' => $monday,
            'sunday' => $sunday,
            'weekDays' => $weekDays,
            'targetDate' => $targetDate,
            'bookedSlots' => $bookedSlots,
        ]);
    }
}
