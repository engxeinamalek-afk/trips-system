<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['booking_id' 
                            , 'trip_id' 
                            , 'seat_number' 
                            , 'customer_name'];
}
