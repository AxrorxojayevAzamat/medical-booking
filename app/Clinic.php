<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{

    public const CLINIC_PROFILE = '/uploads/photo_clinics/';


    protected $fillable =['name_uz','name_uz','region_id','type','description_uz','description_ru','phone_numbers'
        ,'adress_uz','adress_ru','work_time_start','work_time_end','location'];

    public function users() {
        return $this->belongsToMany(User::class , 'doctors_and_clinics');
    }

}
