<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name_ru','name_uz',
    ];
}
