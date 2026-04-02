<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyContent extends Model
{
    protected $fillable = [
        'title',
        'btn_txt',
        'btn_link',
        'whatsapp_number',
        'position',
        'subtitle',
        'content',
        'slug',
    ];
}
