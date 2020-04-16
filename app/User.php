<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail {

    use Notifiable;

    protected $fillable = [
        'name', 'lastname', 'patronymic', 'phone', 'birth_date', 'gender', 'email', 'password', 'status',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasAccess(array $permissions): bool {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if ($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    public function inRole(string $roleSlug) {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

}
