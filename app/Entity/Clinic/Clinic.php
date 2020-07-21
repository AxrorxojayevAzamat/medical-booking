<?php

namespace App\Entity\Clinic;

use App\Entity\BaseModel;
use App\Entity\Region;
use App\Entity\User\User;
use App\Helpers\LanguageHelper;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property string $description_uz
 * @property string $description_ru
 * @property int $region_id
 * @property int $type
 * @property string $phone_numbers
 * @property string $address_uz
 * @property string $address_ru
 * @property string $work_time_start
 * @property string $work_time_end
 * @property string $location
 * @property int $main_photo_id
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Region $region
 * @property DoctorClinic[] $doctorClinics
 * @property User[] $doctors
 * @property Photo[] $photos
 * @property Photo $mainPhoto
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Clinic extends BaseModel
{
    public const CLINIC_PHOTOS = '/uploads/photo_clinics/';

    public const CLINIC_TYPE_PRIVATE = 1;
    public const CLINIC_TYPE_GOVERNMENT = 2;


    protected $fillable = ['name_uz', 'name_ru', 'region_id', 'type', 'description_uz', 'description_ru', 'phone_numbers',
        'address_uz', 'address_ru', 'work_time_start', 'work_time_end', 'location', 'main_photo_id',
    ];

    public static function clinicTypeList(): array
    {
        return [
            self::CLINIC_TYPE_PRIVATE => 'Частная клиника',
            self::CLINIC_TYPE_GOVERNMENT => 'Государственная поликлиника',
        ];
    }


    ########################################### Mutators

    public function getNameAttribute(): string
    {
        return LanguageHelper::getName($this);
    }

    public function getDescriptionAttribute(): string
    {
        return LanguageHelper::getDescription($this);
    }

    ###########################################


    ########################################### Relations

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function doctorClinics()
    {
        return $this->hasMany(DoctorClinic::class, 'clinic_id', 'id');
    }

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_clinics', 'clinic_id', 'doctor_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'clinic_id', 'id')->whereKeyNot($this->main_photo_id)->orderBy('sort');
    }
    public function mainPhoto()
    {
        return $this->belongsTo(Photo::class, 'main_photo_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    ###########################################
}
