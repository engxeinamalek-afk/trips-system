<?php
namespace App\Services;

use App\Models\City;
use App\Models\Discount;
use App\Models\Trip;
use App\Exceptions\InactiveEntityException;
use App\Services\Contracts\TripServiceInterface;

class TripService implements TripServiceInterface{
    public function createTrip(array $data): Trip
    {
        $this->ensureEntitiesAreActive(
            $data['departure_city_id'],
            $data['destination_city_id'],
            $data['discount_id'] ?? null
        );

        return Trip::create($data);
    }

    private function ensureEntitiesAreActive(int $departureId, int $destinationId, ?int $discountId): void
    {
        $cities = City::whereIn('id', [$departureId, $destinationId])
                        ->pluck('is_active', 'id');

        if (!($cities[$departureId] ?? false)) {
            throw new InactiveEntityException('Departure city is inactive!');
        }

        if (!($cities[$destinationId] ?? false)) {
            throw new InactiveEntityException('Destination city is inactive!');
        }

        if ($discountId && !Discount::where('id', $discountId)->where('is_active', true)->exists()) {
            throw new InactiveEntityException('The selected discount is inactive.');
        }
    }
}