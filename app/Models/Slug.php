<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_id','page_slug', 'slug'
    ];

    //Relation with page
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
