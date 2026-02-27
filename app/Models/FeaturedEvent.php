<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedEvent extends Model
{
    protected $fillable =[
        'event_id','slug'
    ];
    
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
