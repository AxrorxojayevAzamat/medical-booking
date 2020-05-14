<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicPhotos extends Model
{
    protected $table = 'clinic_photos';

    protected $fillable = [
        'product_id', 'file', 'sort',
    ];
}
