<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventArtist extends Model
{

    protected $fillable = ['event_id', 'name', 'image'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
