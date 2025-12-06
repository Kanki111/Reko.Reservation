<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Staff;

class ReservationController
{
    /**
     * 予約の空き情報の取得
     */
    public function index(Request $request)
    {
        $staff = $request->get('staff');
        $targetDate = $request->get('targetDate');

        $targetDate = "2025-11-29";

        // 週範囲の計算
        $target = Carbon::parse($targetDate);
        $monday = $target->copy()->startOfWeek(Carbon::MONDAY);
        $sunday = $monday->copy()->addDays(6);

        $staffList = Staff::scopeActive()->get();
        $weekDays = [];
        for ($i = 0; $i < 7; $i++) {
            $weekDays[] = $monday->copy()->addDays($i);
        }

        return view('front.reservation.index', [
            'staffList' => $staffList,
            'selectStaff' => 1,
            'monday' => $monday,
            'sunday' => $sunday,
            'weekDays' => $weekDays,
            'targetDate' => $targetDate,
        ]);
    }
}
