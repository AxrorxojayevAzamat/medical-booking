<?php

namespace App\Entity\User;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\LanguageHelper;

/**
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property Carbon $birth_date
 * @property int $gender
 * @property string $about_uz
 * @property string $about_ru
 * @property string $fullName
 * @property int $main_photo_id
 *
 * @property User $user
 * @mixin Eloquent
 */
class Profile extends Model
{
    const FEMALE = 1;
    const MALE = 2;

    protected $table = 'profiles';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'birth_date', 'gender', 'about_uz', 'about_ru', 'avatar', 'rate', 'num_of_rates', 'main_photo_id'
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

    public function getAboutAttribute(): string
    {
        return LanguageHelper::getAbout($this);
    }

    ########################################### Relations

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function mainPhoto()
    {
        return $this->belongsTo(Photo::class, 'main_photo_id', 'id');
    }
    public function photos()
    {
        return $this->hasMany(Photo::class, 'user_id', 'user_id')->whereKeyNot($this->main_photo_id)->orderBy('sort');
    }

    public function allPhotos()
    {
        return $this->hasMany(Photo::class, 'user_id', 'user_id');
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class, 'user_id', 'id');
    }

    ###########################################
}
