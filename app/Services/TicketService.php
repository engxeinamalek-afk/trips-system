<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Exceptions\InactiveEntityException;
use App\Exceptions\InvalidBookingStatusException;
use App\Exceptions\invalidSeatNumber;
use App\Exceptions\nonUniqueSeatNumber;
use App\Models\Booking;
use App\Models\Ticket;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;

class TicketService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function createTicket(array $data): array{
        return DB::transaction(function () use ($data) {
        
            $booking = Booking::where('id', $data['booking_id'])->lockForUpdate()->firstOrFail();
            $trip= $booking->trip()->lockForUpdate()->firstOrFail();
            $this->ensureBookingIsEligibleForTicket($trip , $booking);

            $this->validSeatNumber($trip, $data['seat_number']);
            $this->uniqueSeatNumber($trip, $data['seat_number']);

            $ticket= Ticket::create([
                'booking_id'     => $data['booking_id'],
                'trip_id'        => $trip->id,
                'customer_name' => $data['customer_name'],
                'seat_number'    => $data['seat_number'],
            ]);

            $remainingSeats= $this->checkAndCompleteBooking($booking);

            $booking->refresh();

            return [
                'ticket'          => $ticket,
                'booking_status'  => $booking->status,
                'remaining_seats' => $remainingSeats,
            ];

        });
    }
    private function uniqueSeatNumber(Trip $trip , int $seatNumber){

        $isBooked = $trip->tickets()
            ->where('seat_number', $seatNumber)
            ->exists();

        if ($isBooked) 
            throw new nonUniqueSeatNumber('This seat is already reserved!'); 
    }

    private function validSeatNumber(Trip $trip , int $seatNumber){
        $availableSeats= $trip->total_seats;
        if ($seatNumber < 1 || $seatNumber > $availableSeats)
            throw new invalidSeatNumber("The selected seat number is invalid, available seats 1 {$availableSeats} ");
    }

    private function ensureBookingIsEligibleForTicket(Trip $trip, Booking $booking): void
    {
        if (!$trip->is_active) {
            throw new InactiveEntityException('Cannot add a ticket to an inactive or cancelled trip.');
        }

        if (in_array($booking->status, [BookingStatus::COMPLETED, BookingStatus::REJECTED, BookingStatus::CANCELLED])) {
            throw new InvalidBookingStatusException("Cannot add a ticket because the booking status is: {$booking->status->value}.");
        }
    }
    private function checkAndCompleteBooking(Booking $booking): int
    {
        $ticketsCount= $booking->tickets()->count();
        $totalTickets= $booking->seats_count;
        if ($ticketsCount >= $totalTickets){
            $booking->update(['status' => 'completed']);
            return 0;
        }
        return $totalTickets - $ticketsCount;
    }
}
