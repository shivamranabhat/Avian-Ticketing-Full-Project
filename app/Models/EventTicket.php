<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    protected $fillable = ['event_id', 'name', 'price','total_seat','sold_seats'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getAvailableSeatsAttribute()
    {
        return max(0, $this->total_seat - $this->sold_seats);
    }

    public function isSoldOut()
    {
        return $this->available_seats <= 0;
    }
}
