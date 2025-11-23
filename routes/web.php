<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('neko-home');
});

Route::get('/reservation', function () {
    return view('reservation-calendar');
});
