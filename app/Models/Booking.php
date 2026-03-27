<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'pay_method',
        'slug',
        'booking_reference',
        'tickets',
        'total_tickets',
        'total_amount',
        'status',
        'payment_status',
    ];

    protected $casts = [
        'tickets'      => 'array',
        'total_amount' => 'decimal:2',
    ];

}