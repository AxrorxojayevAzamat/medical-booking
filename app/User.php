<?php

namespace App;

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
        return $this->belongsTo('App\Role', 'role');
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

}
