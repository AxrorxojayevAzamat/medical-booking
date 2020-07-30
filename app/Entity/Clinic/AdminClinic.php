<?php


namespace App\Entity\Clinic;


use App\Entity\BasePivot;
use App\Entity\User\User;
use Eloquent;

/**
 * @property int $admin_id
 * @property int $clinic_id
 *
 * @property User $admin
 * @property Clinic $clinic
 * @mixin Eloquent
 */
class AdminClinic extends BasePivot
{
    protected $table = 'admin_clinics';

    protected $fillable = [
        'admin_id', 'clinic_id',
    ];


    ########################################### Relations

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    ###########################################
}
