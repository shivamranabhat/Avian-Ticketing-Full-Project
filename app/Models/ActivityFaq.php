<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityFaq extends Model
{
     protected $fillable = [
        'activity_id',
        'title',
        'description',
        'slug',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class,'activity_id');
    }
}
