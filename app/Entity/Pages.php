<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = [
        'slug', 'title_uz', 'title_ru', 'content_uz', 'content_ru'
    ];

}
