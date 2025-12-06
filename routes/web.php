<?php

use App\Http\Controllers\Front\ReservationController;
use App\Http\Controllers\Front\FlowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::get('/', function () {
    return view('neko-home');
});

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::get('/flow', [FlowController::class, 'index'])->name('flow.index');

// スタッフ管理用ルート
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/{id}', [StaffController::class, 'show'])->name('staff.show');
Route::get('/api/staff/active', [StaffController::class, 'getActiveStaff']);

// フロント予約システム
Route::get('/front/reservation', [App\Http\Controllers\Front\FrontReservationController::class, 'index'])->name('front.reservation.index');
