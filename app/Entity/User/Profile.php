<?php


namespace App\Entity\User;


use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property Carbon $birth_date
 * @property int $gender
 * @property string $about_uz
 * @property string $about_ru
 * @property string $avatar
 * @property string $fullName
 *
 * @property User $user
 * @mixin Eloquent
 */
class Profile extends Model
{
    const FEMALE = 1;
    const MALE = 2;

    const USER_PROFILE = '/uploads/avatars/';

    protected $table = 'profiles';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'birth_date', 'gender', 'about_uz', 'about_ru', 'avatar', 'rate', 'num_of_rates'
    ];

    protected $casts = [
        'birth_date' => 'datetime',
    ];

    public function edit($firstName, $lastName, $birthDate, $gender, $middleName = null, $aboutUz = null, $aboutRu = null)
    {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->middle_name = $middleName ?? $this->middle_name;
        $this->birth_date = $birthDate;
        $this->gender = $gender;
        $this->about_uz = $aboutUz ?? $this->about_uz;
        $this->about_ru = $aboutRu ?? $this->about_ru;
    }

    public function getImageAttribute(): string
    {
        return $this->avatar;
    }

    public function getFullNameAttribute(): string
    {
        return "$this->last_name $this->first_name";
    }


    ########################################### Relations

    public function rate() {
        return $this->belongsTo(Rate::class, 'user_id', 'id');
    }

    ###########################################
}
