<?php

namespace App\Entity\Clinic;

use Eloquent;
use Carbon\Carbon;
use App\Entity\BaseModel;
use App\Entity\User\User;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $clinic_id
 * @property string $filename
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $fileThumbnail
 * @property string $fileOriginal
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
        'clinic_id', 'filename', 'sort',
    ];


    ########################################### Accessors
    public function getFileThumbnailAttribute(): string
    {
        return '/storage/images/' . ImageHelper::FOLDER_CLINICS . '/' . $this->clinic_id . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $this->filename;
    }

    public function getFileOriginalAttribute(): string
    {
        return '/storage/images/' . ImageHelper::FOLDER_CLINICS . '/' . $this->clinic_id . '/' . ImageHelper::TYPE_ORIGINAL . '/' . $this->filename;
    }
    ###########################################


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
    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }
    ###########################################
}
