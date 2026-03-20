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
        'barcode',
        'payment_status',
    ];

    protected $casts = [
        'tickets'      => 'array',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Auto-generate booking reference (used for barcode)
     */
    protected static function booted()
    {
        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'BK-' . strtoupper(substr(uniqid(), -10));
            }

            // Generate Barcode (Simple unique string)
            if (empty($booking->barcode)) {
                $booking->barcode = 'BC' . strtoupper(uniqid());
            }
        });
    }
}