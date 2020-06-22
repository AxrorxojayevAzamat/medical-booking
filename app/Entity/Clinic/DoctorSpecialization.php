<?php


namespace App\Entity\Clinic;


use App\Entity\BasePivot;
use App\Entity\User\User;
use Eloquent;

/**
 * @property int $doctor_id
 * @property int $specialization_id
 *
 * @property User $doctor
 * @property Specialization $specialization
 * @mixin Eloquent
 */
class DoctorSpecialization extends BasePivot
{
    protected $table = 'doctor_specializations';

    protected $fillable = [
        'doctor_id', 'specialization_id'
    ];


    ########################################### Relations

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    ###########################################
}
