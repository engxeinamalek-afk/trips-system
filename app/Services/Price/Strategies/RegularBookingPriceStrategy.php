<?php
namespace App\Services\Price\Strategies;

use App\Models\Trip;
use App\Services\Price\Contracts\BookingPriceStrategyInterface;

class RegularBookingPriceStrategy implements BookingPriceStrategyInterface{
    public function calculate(Trip $trip){
        $baseUnitPrice = $trip->price;

        $discountPercentage = $trip->discount?->regular_percentage ?? 0;

        $discountAmount = ($baseUnitPrice * $discountPercentage) / 100;
        return $baseUnitPrice - $discountAmount;
    }
}