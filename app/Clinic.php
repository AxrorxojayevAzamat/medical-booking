<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    public const CLINIC_PROFILE = '/uploads/photo_clinics/';
    
    public const CLINIC_TYPE_PRIVATE = 1;
    public const CLINIC_TYPE_GOVERMENT = 2;


    protected $fillable =['name_uz','name_ru','region_id','type','description_uz','description_ru','phone_numbers'
        ,'adress_uz','adress_ru','work_time_start','work_time_end','location'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'doctor_clinics');
    }

    public static function clinicTypeList(): array
    {
        return [
            self::CLINIC_TYPE_PRIVATE => 'Частная клиника',
            self::CLINIC_TYPE_GOVERMENT => 'Государственная поликлиника',
        ];
    }
    public function timetable()
    {
        return $this->hasOne('App\Timetable', 'clinic_id');
    }
}
