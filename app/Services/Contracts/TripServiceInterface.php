<?php
namespace App\Services\Contracts;
use App\Models\Trip;

interface TripServiceInterface {
    public function createTrip(array $data): Trip;
    public function deactivateTrip(Trip $trip);
}