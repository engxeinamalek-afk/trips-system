<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\TicketsController;
use App\Http\Controllers\Api\TripController;

Route::post('/store-booking',[BookingController::class, 'store']);
Route::post('/store-trip',[TripController::class, 'store']);

Route::post('/store-city',[CityController::class, 'store']);
Route::post('/store-discount',[DiscountController::class, 'store']);

Route::post('/store-ticket',[TicketsController::class, 'store']);
Route::post('/deactivate-trip/{trip}', [TripController::class , 'updateStatus']);

Route::post('/rejected-booking/{booking}' , [BookingController::class, 'updateStatus']);
Route::get('/remaining-seats/{trip}', [TripController::class , 'remainingSeatsCount']);

Route::post('/update-city-status/{city}', [CityController::class, 'updateStatus']);
Route::post('/update-discount-status/{discount}', [DiscountController::class, 'updateStatus']);

