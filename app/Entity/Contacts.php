<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = [
        'name', 'lastname', 'email' ,'phone', 'message'
    ];

}
