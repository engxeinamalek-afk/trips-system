<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Exceptions\InactiveEntityException;
use App\Exceptions\InsufficientSeatsException;
use App\Models\Booking;
use App\Models\Trip;
use App\Services\Contracts\BookingServiceInterface;
use App\Services\Price\BookingPriceStrategyFactory;
use Illuminate\Support\Facades\DB;

class BookingService implements BookingServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(private BookingPriceStrategyFactory $factory){}

    public function createBooking(array $data): Booking{
        return DB::transaction(function () use ($data) {
            
                $trip = $this->ensureTripIsActive($data['trip_id']);

                $this->validateAvailableSeats($trip, $data['seats_count']);

                $strategy= $this->factory->make($data['type']);
                $data['final_price']= $strategy->calculate($trip);
                $data['status']=BookingStatus::IN_PROGRESS;
                return Booking::create($data);
            });
    }

    private function ensureTripIsActive(int $tripId): Trip{
        $trip = Trip::where('id', $tripId)->lockForUpdate()->first();

        if (!$trip || !$trip->is_active) 
            throw new InactiveEntityException("The selected Trip is inactive!");
        return $trip;
    }
    

    private function validateAvailableSeats(Trip $trip, int $requestedSeats): void
    {
        $reservedSeats = Booking::where('trip_id', $trip->id)->sum('seats_count');

        $availableSeats = $trip->total_seats - $reservedSeats;

        if ($requestedSeats > $availableSeats) {
            throw new InsufficientSeatsException("Requested seats exceed available capacity. Only {$availableSeats} seats remaining for this trip");
        }
    }
}
