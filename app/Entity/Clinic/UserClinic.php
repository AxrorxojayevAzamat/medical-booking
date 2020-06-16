<?php


namespace App\Entity\Clinic;


use App\Entity\BasePivot;
use App\Entity\User\User;
use Eloquent;

/**
 * @property int $user_id
 * @property int $clinic_id
 *
 * @property User $user
 * @property Clinic $clinic
 * @mixin Eloquent
 */
class UserClinic extends BasePivot
{
    protected $table = 'specialization_user';

    protected $fillable = [
        'user_id', 'clinic_id'
    ];


    ########################################### Relations

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    ###########################################
}
