<?php

namespace App\Entity\Clinic;

use App\Entity\BaseModel;
use App\Entity\User\User;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int $clinic_id
 * @property string $filename
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Clinic $clinic
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Photo extends BaseModel
{
    protected $table = 'clinic_photos';

    protected $fillable = [
        'product_id', 'filename', 'sort',
    ];


    ########################################### Relations

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
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
