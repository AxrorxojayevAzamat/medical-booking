<?php

namespace App\Entity;

use App\Entity\User\User;
use Carbon\Carbon;
use Eloquent;

/**
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Region $parent
 * @property Region[] $children
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Region extends BaseModel
{
    protected $table = 'regions';

    protected $fillable = ['name_uz', 'name_uz', 'parent_id'];


    ########################################### Relations

    public function parent()
    {
        return $this->belongsTo(Region::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Region::class, 'parent_id', 'id');
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

