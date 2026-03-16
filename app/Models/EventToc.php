<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventToc extends Model
{
    protected $fillable = [
        'event_id',
        'title',
        'description',
        'slug',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
