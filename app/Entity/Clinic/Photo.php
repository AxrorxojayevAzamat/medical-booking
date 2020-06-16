<?php

namespace App\Entity\Clinic;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'clinic_photos';

    protected $fillable = [
        'product_id', 'file', 'sort',
    ];
}
