<?php

namespace App\Entity\Clinic;

use App\Entity\User\User;
use App\Helpers\LanguageHelper;
use Carbon\Carbon;
use Eloquent;
use App\Entity\BaseModel;

/**
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $name
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Specialization extends BaseModel
{

    protected $table = 'specializations';
    protected $fillable = [
        'name_uz', 'name_ru',
    ];

    public static function new($name_uz, $name_ru): self
    {
        return static::create([
                    'name_uz' => $name_uz,
                    'name_ru' => $name_ru,
        ]);
    }

    ########################################### Mutators

    public function getNameAttribute(): string
    {
        return LanguageHelper::getName($this);
    }

    ###########################################
    ########################################### Relations

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_specializations', 'specialization_id', 'doctor_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    ###########################################
}
