<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title','subtitle','image','img_alt','left_btn_txt','left_btn_link','starting_price','right_btn_txt','right_btn_link','slug'
    ];
    public function sliderLists()
    {
        return $this->hasMany(SliderList::class);
    }
}
