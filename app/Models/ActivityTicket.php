<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityTicket extends Model
{
    protected $fillable = ['activity_id', 'name', 'price',];

    public function activity()
    {
        return $this->belongsTo(Activity::class,'activity_id');
    }

}
