<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'date', 'location', 'organizer', 'about', 'venue', 'images','event_category_id','slug'
    ];

    protected $casts = [
        'images' => 'array',
        'date' => 'datetime',
    ];

    public function artists()
    {
        return $this->hasMany(EventArtist::class);
    }

    public function tickets()
    {
        return $this->hasMany(EventTicket::class);
    }

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }
    
    public function featured()
    {
        return $this->hasOne(FeaturedEvent::class);
    }
}
