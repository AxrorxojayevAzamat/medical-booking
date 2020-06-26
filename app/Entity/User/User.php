<?php

namespace App\Entity\User;

use App\Entity\Book\Book;
use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\DoctorClinic;
use App\Entity\Clinic\Specialization;
use App\Entity\Clinic\DoctorSpecialization;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

/**
 * @property int $id
 * @property string $email
 * @property string $phone
 * @property Carbon $email_verified_at
 * @property int $status
 * @property string $password
 * @property string $role
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Profile $profile
 * @property DoctorSpecialization[] $doctorSpecializations
 * @property Specialization[] $specializations
 * @property DoctorClinic[] $doctorClinics
 * @property Clinic[] $clinics
 *
 * @mixin Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public const STATUS_ACTIVE = 10;
    public const STATUS_INACTIVE = 11;

    public const ROLE_ADMIN = 'administrator';
    public const ROLE_USER = 'user';
    public const ROLE_CALL_CENTER = 'call_center';
    public const ROLE_CLINIC = 'clinic';
    public const ROLE_DOCTOR = 'doctor';

    protected $fillable = [
        'name', 'phone', 'email', 'password', 'role', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function new($firstName, $lastName, $middleName, $phone, $birthDate, $gender, $email, $password, $role): self
    {
        return static::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'phone' => $phone,
            'birth_date' => $birthDate,
            'gender' => $gender,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => $role,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function newGuest($firstName, $lastName, $middleName, $phone, $birthDate, $gender, $email): self
    {
        $password = 12; // this is for test must change
        $role = self::ROLE_USER; //must change
        return static::new($firstName, $lastName, $middleName, $phone, $birthDate, $gender, $email, $password, $role);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isPatient(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function isClinic(): bool
    {
        return $this->role === self::ROLE_CLINIC;
    }

    public function isCallCenter(): bool
    {
        return $this->role === self::ROLE_CALL_CENTER;
    }

    public function isDoctor(): bool
    {
        return $this->role === self::ROLE_DOCTOR;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public static function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public static function adminlte_desc()
    {
        return 'That\'s a nice guy';
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isInactive(): bool
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    public static function statusList(): array
    {
        return [
            User::STATUS_ACTIVE => 'Aктивный',
            User::STATUS_INACTIVE => 'Неактивный',
        ];
    }

    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => 'Пользователь',
            self::ROLE_CALL_CENTER => 'Колл Центр',
            self::ROLE_CLINIC => 'Клиник',
            self::ROLE_DOCTOR => 'Доктор',
            self::ROLE_ADMIN => 'Администратор',
        ];
    }

    public function roleName(): string
    {
        return self::rolesList()[$this->role];
    }


    ########################################### Relations

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function book()
    {
        return $this->hasOne(Book::class, 'user_id', 'id');
    }

    public function doctorSpecializations()
    {
        return $this->hasMany(DoctorSpecialization::class, 'doctor_id', 'id');
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'doctor_specializations', 'doctor_id', 'specialization_id');
    }

    public function doctorClinics()
    {
        return $this->hasMany(DoctorClinic::class, 'doctor_id', 'id');
    }

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class, 'doctor_clinics', 'doctor_id', 'clinic_id');
    }

}
