<?php

namespace App\Entity\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class User extends Authenticatable implements MustVerifyEmail {

    use Notifiable;

    protected $fillable = [
        'name', 'lastname', 'patronymic', 'phone', 'birth_date', 'gender', 'email', 'password', 'role', 'status', 'avatar',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const STATUS_ACTIVE = 10;
    public const STATUS_INACTIVE = 11;
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';
    public const ROLE_CALL_CENTER = 'admin_call_center';
    public const ROLE_CLINIC = 'admin_clinic';
    public const ROLE_DOCTOR = 'doctor';
    public const USER_PROFILE = '/uploads/avatars/';

    public function role() {
        return $this->belongsTo(Role::class, 'role');
    }

    public function hasAccess(array $permissions): bool {
        foreach ($permissions as $permission) {
            if ($this->role($permission))
                return true;
        }
        return false;
    }

    public function inRole(string $roleSlug) {
        return $this->role()->where('slug', $roleSlug)->count() == 1;
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }

    public static function adminlte_image() {
        return 'https://picsum.photos/300/300';
    }

    public static function adminlte_desc() {
        return 'That\'s a nice guy';
    }

    public function specializations() {
        return $this->belongsToMany(Specialization::class, 'specialization_user');
    }

    public function clinics() {
        return $this->belongsToMany(Clinic::class, 'doctors_and_clinics');
    }

    public function isActive(): bool {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isInactive(): bool {
        return $this->status === self::STATUS_INACTIVE;
    }

    public static function statusList(): array {
        return [
            User::STATUS_ACTIVE => 'Aктивный',
            User::STATUS_INACTIVE => 'Неактивный',
        ];
    }

    public function getImageAttribute() {
        return $this->avatar;
    }

    public static function new($name, $lastname, $patronymic, $phone, $birthDate, $gender, $email, $password, $role): self {
        return static::create([
                    'name' => $name,
                    'lastname' => $lastname,
                    'patronymic' => $patronymic,
                    'phone' => $phone,
                    'birth_date' => $birthDate,
                    'gender' => $gender,
                    'email' => $email,
                    'password' => bcrypt($password),
                    'role' => $role,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function newGuest($name, $lastname, $patronymic, $phone, $birthDate, $gender, $email): self {
        $password = 12; // this is for test must change
        $role = 5; //must change
        return static::new($name, $lastname, $patronymic, $phone, $birthDate, $gender, $email, $password, $role);
    }

    public function user() {
        return $this->hasOne('App\Entity\Booking\Book', 'user_id', 'id');
    }

    public function doctor() {
        return $this->hasOne('App\Entity\Booking\Book', 'doctor_id', 'id');
    }

}
