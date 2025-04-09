<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

Route::controller(Api\ResourceController::class)->group(function () {
    Route::post('/resources', 'create');
    Route::get('/resources', 'index');
});

Route::controller(Api\BookingController::class)->group(function () {
    Route::post('/bookings', 'create');
    Route::delete('/bookings/{id}', 'destroy');
    Route::get('/resources/{id}/bookings', 'getBookingsByResource');
});