<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Services\Contracts\BookingServiceInterface;
use Illuminate\Http\Request;

class BookingController extends ApiBaseController
{
    public function __construct(private BookingServiceInterface $service){}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $data= $request->validated();
        
        $booking= $this->service->createBooking($data);

        return $this->success($booking,
                        "Booking created successfully!",
                        201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Booking $booking)
    {
        $this->service->updateBookingStatus($booking);
        return $this->success($booking , 
                                "Booking updated successfully!");
    }

}
