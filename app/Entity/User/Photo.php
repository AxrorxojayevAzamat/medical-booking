<?php

namespace App\Entity\User;

use App\Entity\BaseModel;
use App\Helpers\ImageHelper;

/**
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $fileThumbnail
 * @property string $fileOriginal
 *
 * @property User $user
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Photo extends BaseModel
{
    protected $table = 'user_photos';

    protected $fillable = [
        'clinic_id', 'filename', 'sort',
    ];


    ########################################### Relations

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
}
