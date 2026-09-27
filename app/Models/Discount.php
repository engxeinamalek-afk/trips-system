<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['name',
                        'regular_percentage',
                        'vip_percentage',
                        'is_active'];  
}
