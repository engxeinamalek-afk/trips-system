<?php
namespace App\Enums;

enum BookingStatus:string{
    case IN_PROGRESS = "pendeing";
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
}