<?php

namespace App\Entity\Clinic;

use App\Entity\User\User;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{

    protected $fillable = [
        'name_uz', 'name_ru',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'specialization_user');
    }

}
