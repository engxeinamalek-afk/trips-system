<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketsController extends ApiBaseController
{
    public function __construct(private TicketService $service ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
