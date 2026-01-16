<?php

use App\Http\Controllers\Api\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// 予約API
Route::post('/reservations', [ReservationController::class, 'store']);
