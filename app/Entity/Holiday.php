<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'celebrations';
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'quantity', 'celebration_name'];

}
