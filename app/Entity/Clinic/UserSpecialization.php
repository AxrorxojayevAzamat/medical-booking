<?php


namespace App\Entity\Clinic;


use App\Entity\BasePivot;
use App\Entity\User\User;
use Eloquent;

/**
 * @property int $user_id
 * @property int $specialization_id
 *
 * @property User $user
 * @property Specialization $specialization
 * @mixin Eloquent
 */
class UserSpecialization extends BasePivot
{
    protected $table = 'specialization_user';

    protected $fillable = [
        'user_id', 'specialization_id'
    ];


    ########################################### Relations

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    ###########################################
}
