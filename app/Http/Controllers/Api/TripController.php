<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Services\Contracts\TripServiceInterface;

class TripController extends ApiBaseController
{
    public function __construct(protected TripServiceInterface $service){}
    public function remainingSeatsCount(Trip $trip){
        $seatsCount= $this->service->getRemainingSeatsCount($trip);
        return $this->success(["Remaining Seats" => $seatsCount],
                                "Available seats retrieved successfully.");
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $data= $request->validated();
        $data['is_active']= true;
        $trip= $this->service->createTrip($data);
        return $this->success($trip,
                               'Trip created successfully!',
                               201);
    }
    public function updateStatus(Trip $trip){
        $this->service->deactivateTrip($trip);
        return $this->success($trip,
                              'Trip updated successfully!');      
    }

}
