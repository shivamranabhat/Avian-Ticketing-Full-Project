<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $fillable=[
        'user_id','bio','location','profile_pic','cover_pic','side_pic','cv','slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
