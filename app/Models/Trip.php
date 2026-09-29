<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = ['departure_city_id',
                        'destination_city_id',
                        'is_active',
                        'price',
                        'discount_id',
                        'total_seats',
                        'departure_time'];
    
    public function discount():BelongsTo{
        return $this->belongsTo(Discount::class);
    }

    public function tickets(): HasMany{
        return $this->hasMany(Ticket::class);
    }
}
