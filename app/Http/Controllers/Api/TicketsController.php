<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTicketRequest;
use App\Services\Contracts\TicketServiceInterface;
use Illuminate\Http\Request;

class TicketsController extends ApiBaseController
{
    public function __construct(private TicketServiceInterface $service ){}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $result = $this->service->createTicket($request->validated());
        $message= $result['booking_status'] === 'completed'
                    ? 'Ticket created successfully. Booking is now completed!'
                    : 'Ticket created successfully.' ;
        return $this->success( ['ticket' => $result['ticket'],
                                'booking_status'  => $result['booking_status'],
                                'remaining_seats' => $result['remaining_seats'] ],
                                $message, 201);
    }
}
