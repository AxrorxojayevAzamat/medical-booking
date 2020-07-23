<?php

namespace App\Entity\Clinic;

use App\Entity\User\User;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\LanguageHelper;

/**
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Specialization extends Model {

    protected $table = 'specializations';
    protected $fillable = [
        'name_uz', 'name_ru',
    ];

    public function getNameAttribute(): string {
        return LanguageHelper::getName($this);
    }

    ########################################### Relations

    public function doctors() {
        return $this->belongsToMany(User::class, 'doctor_specializations', 'specialization_id', 'doctor_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    ###########################################
}
