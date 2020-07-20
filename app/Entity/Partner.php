<?php

namespace App\Entity;

use Carbon\Carbon;
use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $site_url
 * @property int $status
 * @property int $sort
 * @property string $photo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Partner extends Model
{
    protected $table = 'partners';

    protected $fillable = ['name', 'site_url', 'sort','status','photo'];
    
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isInactive(): bool
    {
        return $this->status === self::STATUS_INACTIVE;
    }
    
    public static function statusList(): array
    {
        return [
            Partner::STATUS_ACTIVE => 'Aктивный',
            Partner::STATUS_INACTIVE => 'Неактивный',
        ];
    }
    ########################################### Accessors
    public function getFileThumbnailAttribute(): string
    {
        return '/storage/images/' . ImageHelper::FOLDER_PARTNERS . '/' . $this->id . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $this->photo;
    }

    public function getFileOriginalAttribute(): string
    {
        return '/storage/images/' . ImageHelper::FOLDER_PARTNERS . '/' . $this->id . '/' . ImageHelper::TYPE_ORIGINAL . '/' . $this->photo;
    }
    ###########################################

    public static function add(string $name, string $site_url, int $sort, int $status, string $photo): self
    {
        return static::create([
            'name' => $name,
            'site_url' => $site_url,
            'sort' => $sort,
            'status' => $status,
            'photo' => $photo,
        ]);
    }
}
