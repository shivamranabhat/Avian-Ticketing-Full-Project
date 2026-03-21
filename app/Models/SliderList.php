<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderList extends Model
{
    protected $fillable = [
        'icon','title','slider_id'
    ];
    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
