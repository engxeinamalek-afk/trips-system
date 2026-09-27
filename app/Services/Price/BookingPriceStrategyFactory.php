<?php

namespace App\Services\Price;

use App\Services\Price\Contracts\BookingPriceStrategyInterface;
use App\Services\Price\Strategies\RegularBookingPriceStrategy;
use App\Services\Price\Strategies\VipBookingPriceStrategy;
use InvalidArgumentException;

class BookingPriceStrategyFactory
{
    public function make(string $bookingType): BookingPriceStrategyInterface
    {
        return match (strtolower($bookingType)) {
            'normal'  => app(RegularBookingPriceStrategy::class),
            'vip'     => app(VipBookingPriceStrategy::class),
            default   => throw new InvalidArgumentException("Unsupported booking type: {$bookingType}"),
        };
    }
}