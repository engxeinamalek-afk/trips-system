## Features

-  **City Management** — Create and manage departure and destination cities.
-  **Trip Management** — Create, activate/deactivate trips with pricing, seats, and discounts, Check available seats.
-  **Discounts** — Create discounts with separate rates for normal and VIP bookings.
-  **Bookings** — Create, reject, and track bookings with automatic price calculation.
-  **Tickets** — Issue tickets and assign seats to bookings.
-  **Automatic Status Management** — Automatically update bookings and tickets based on trip actions.

## End Points

- `POST /api/store-booking`

```{
    "trip_id": 1,
    "customer_name": "Zeina Malek",
    "customer_phone": "099999",
    "type": "normal",
    "seats_count": 2
}
```

- `POST /api/rejected-booking/{booking}`
body:none

- `POST /api/store-trip`

```{
    "departure_city_id": 1,
    "destination_city_id": 2,
    "departure_time": "2026-10-15 10:00:00",
    "total_seats": 40,
    "price": 100,
    "discount_id": 1
}
```

- `POST /api/deactivate-trip/{trip}`

```{"is_active": false}```

- `GET /api/remaining-seats/{trip}`
body:none

- `POST /api/store-city`
```{"name": "Lattakia"}```

- `POST /api/update-city-status/{city}`
```{"is_active": false}```

- `POST /api/store-discount`
```{
    "name": "Summer Discount",
    "regular_percentage": 10,
    "vip_percentage": 20
}
```

- `POST /api/update-discount-status/{discount}`
```{"is_active": false}```

- `POST /api/store-ticket`
```{
    "booking_id": 1,
    "customer_name": "Ahmad Ali",
    "seat_number": 15
}
```

## Price Strategy
The project uses the `Strategy Pattern` to calculate `booking prices` based on the `booking type` (normal or vip).

## Dependency Injection
The project uses Laravel's Service Container to `bind` service `interfaces` to their implementations.

## Error Handling
API exceptions are handled in bootstrap/app.php using Laravel's withExceptions, with custom exception classes for specific errors and consistent JSON responses.