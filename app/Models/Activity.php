<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
     protected $fillable = [
        'name', 'location', 'organizer','sponsor', 'about','main_image','img_alt', 'images','activity_category_id','slug'
    ];

    protected $casts = [
        'images' => 'array',
    ];


    public function tickets()
    {
        return $this->hasMany(ActivityTicket::class);
    }

    public function activityCategory()
    {
        return $this->belongsTo(ActivityCategory::class);
    }
    
    public function featured()
    {
        return $this->hasOne(FeaturedActivity::class);
    }

    public function faqs()
    {
        return $this->hasMany(ActivityFaq::class);
    }

    public function tocs()
    {
        return $this->hasMany(ActivityToc::class);
    }

    public function bookings()
    {
        return $this->hasMany(ActivityBooking::class);
    }
}
