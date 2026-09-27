<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['departure_city_id',
                        'destination_city_id',
                        'is_active',
                        'price',
                        'discount_id',
                        'total_seats',
                        'departure_time'];
}
