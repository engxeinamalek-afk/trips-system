<?php
namespace App\Enums;

enum BookingStatus:string{
    case IN_PROGRESS = "pandeing";
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
}