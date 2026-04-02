<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityBooking extends Model
{
    protected $fillable = [
        'activity_id',
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
        'payment_status'
    ];

    protected $casts = [
        'tickets' => 'array', // Casts the JSON column to an array
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
