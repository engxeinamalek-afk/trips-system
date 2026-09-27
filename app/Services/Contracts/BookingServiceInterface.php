<?php
namespace App\Services\Contracts;

use App\Models\Booking;

interface BookingServiceInterface{
    public function createBooking(array $data):Booking;
}