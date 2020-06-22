<?php

namespace App\Entity;

use App\Entity\User\User;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property Carbon $date
 * @property int $quantity
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Celebration extends BaseModel
{
    const INACTIVE = 0;
    const ACTIVE = 1;

    protected $table = 'celebrations';

    protected $fillable = ['name_uz', 'name_ru', 'date', 'quantity', 'status'];

    protected $casts = [
        'date' => 'datetime',
    ];

    ########################################### Relations

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
