<?php

namespace App\Entity\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $fillable = [
        'name', 'slug', 'permissions',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function user() {
        return $this->hasOne('App\Entity\User\User','role');
    }

    public function hasAccess(array $permissions): bool {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    private function hasPermission(string $permission): bool {
        return $this->permissions[$permission] ?? false;
    }

}
