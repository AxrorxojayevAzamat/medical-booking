<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

	protected $fillable = [
       'user_id', 'doctor_id', 'rate'
    ];

    public function user()
    {
    	return $this->belongsTo('App\Entity\User\User','Rate'); 
    }
}
