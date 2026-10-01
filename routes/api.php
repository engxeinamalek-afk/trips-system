<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\TicketsController;
use App\Http\Controllers\Api\TripController;

Route::post('/bookings', [BookingController::class, 'store']);
Route::patch('/bookings/{booking}/reject', [BookingController::class, 'updateStatus']);

Route::post('/trips', [TripController::class, 'store']);
Route::get('/trips/{trip}/remaining-seats', [TripController::class, 'remainingSeatsCount']);
Route::patch('/trips/{trip}/deactivate', [TripController::class, 'updateStatus']);

Route::post('/cities', [CityController::class, 'store']);
Route::patch('/cities/{city}/status', [CityController::class, 'updateStatus']);

Route::post('/discounts', [DiscountController::class, 'store']);
Route::patch('/discounts/{discount}/status', [DiscountController::class, 'updateStatus']);

Route::post('/tickets', [TicketsController::class, 'store']);




