<?php

namespace App\Entity;

use App\Entity\User\User;
use App\Helpers\LanguageHelper;
use Carbon\Carbon;
use Eloquent;

/**
 * @property int $id
 * @property string $title_uz
 * @property string $title_ru
 * @property string $menu_title_uz
 * @property string $menu_title_ru
 * @property string $description_uz
 * @property string $description_ru
 * @property string $content_uz
 * @property string $content_ru
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $title
 * @property string $menuTitle
 * @property string $description
 * @property string $content
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class News extends BaseModel
{
    const DRAFT = 1;
    const PUBLISHED = 2;

    protected $table = 'news';

    protected $fillable = [
        'title_uz', 'title_ru', 'menu_title_uz', 'menu_title_ru', 'description_uz', 'description_ru', 'content_uz',
        'content_ru', 'status',
    ];

    public static function getStatusList(): array
    {
        return [
            self::DRAFT => trans('adminlte.draft'),
            self::PUBLISHED => trans('adminlte.published'),
        ];
    }

    public function getStatusLabel(): string
    {
        switch ($this->status) {
            case self::DRAFT:
                return '<span class="badge badge-info">'. trans('adminlte.draft') . '</span>';
                break;
            case self::PUBLISHED:
                return '<span class="badge badge-success">'. trans('adminlte.published') . '</span>';
                break;
            default:
                return '<span class="badge badge-danger">Default</span>';
                break;
        }
    }


    ########################################### Mutators

    public function getTitleAttribute(): string
    {
        return LanguageHelper::getTitle($this);
    }

    public function getMenuTitleAttribute(): string
    {
        return LanguageHelper::getMenuTitle($this);
    }

    public function getDescriptionAttribute(): string
    {
        return LanguageHelper::getDescription($this);
    }

    public function getContentAttribute(): string
    {
        return LanguageHelper::getContent($this);
    }

    ###########################################


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
