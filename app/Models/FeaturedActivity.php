<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedActivity extends Model
{
    protected $fillable =[
        'activity_id','slug'
    ];
    
    
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
