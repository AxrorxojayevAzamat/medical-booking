<?php


namespace App\Entity\Clinic;


use App\Entity\BasePivot;
use App\Entity\User\User;
use Eloquent;

/**
 * @property int $doctor_id
 * @property int $clinic_id
 *
 * @property User $doctor
 * @property Clinic $clinic
 * @mixin Eloquent
 */
class DoctorClinic extends BasePivot
{
    protected $table = 'doctor_clinics';

    protected $fillable = [
        'doctor_id', 'clinic_id',
    ];


    ########################################### Relations

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    ###########################################
}
