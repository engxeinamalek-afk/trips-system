<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\BookingStatus;
use App\Enums\BookingType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
        protected $fillable = ['trip_id',
                            'customer_name',
                            'customer_phone',
                            'status',
                            'type',
                            'final_price',
                            'seats_count'];                  
    // سعر جميع المقاعد المحجوزة 
    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->final_price * $this->seats_count,
        );
    }
    protected function casts(): array{
        return [
            'status' => BookingStatus::class,
            'type' => BookingType::class
        ];
    }
    public function tickets(): HasMany{
        return $this->hasMany(Ticket::class);
    }
    public function trip():BelongsTo{
        return $this->belongsTo(Trip::class);
    }
}
