<?php 
namespace App\Services\Price\Contracts;

use App\Models\Trip;

interface BookingPriceStrategyInterface
{
    public function calculate(Trip $trip);
}