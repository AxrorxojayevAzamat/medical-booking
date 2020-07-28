<?php

namespace App\Entity;

use App\Entity\User\User;
use App\Helpers\ImageHelper;
use App\Helpers\LanguageHelper;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Http\Requests\Admin\News\UpdateRequest;
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
 * @property string $image
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $title
 * @property string $menuTitle
 * @property string $description
 * @property string $content
 * @property string $imageThumbnail
 * @property string $imageListThumbnail
 * @property string $imageDetailThumbnail
 * @property string $imageOriginal
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class News extends BaseModel
{
    const DRAFT = 1;
    const PUBLISHED = 2;

    const IMAGE_WIDTH_LIST = 800;
    const IMAGE_HEIGHT_LIST = 533;
    const IMAGE_WIDTH_DETAIL = 800;
    const IMAGE_HEIGHT_DETAIL = 400;

    protected $table = 'news';

    protected $fillable = [
        'id', 'title_uz', 'title_ru', 'menu_title_uz', 'menu_title_ru', 'description_uz', 'description_ru', 'content_uz',
        'content_ru', 'status', 'image',
    ];

    public static function add(int $id, CreateRequest $request, string $imageName): self
    {
        return static::create([
            'id' => $id,
            'title_uz' => $request->title_uz,
            'title_ru' => $request->title_ru,
            'menu_title_uz' => $request->menu_title_uz,
            'menu_title_ru' => $request->menu_title_ru,
            'description_uz' => $request->description_uz,
            'description_ru' => $request->description_ru,
            'content_uz' => $request->content_uz,
            'content_ru' => $request->content_ru,
            'status' => $request->status,
            'image' => $imageName,
        ]);
    }

    public function edit(UpdateRequest $request, string $imageName = null): void
    {
        $this->update([
            'title_uz' => $request->title_uz,
            'title_ru' => $request->title_ru,
            'menu_title_uz' => $request->menu_title_uz,
            'menu_title_ru' => $request->menu_title_ru,
            'description_uz' => $request->description_uz,
            'description_ru' => $request->description_ru,
            'content_uz' => $request->content_uz,
            'content_ru' => $request->content_ru,
            'status' => $request->status,
            'image' => $imageName ?: $this->image,
        ]);
    }

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

    public function getImageThumbnailAttribute(): string
    {
        return '/storage/images/' . ImageHelper::FOLDER_NEWS . '/' . $this->id . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $this->image;
    }

    public function getImageListThumbnailAttribute(): string
    {
        $imageName = ImageHelper::getThumbnailName($this->image, self::IMAGE_WIDTH_LIST, self::IMAGE_HEIGHT_LIST);

        return '/storage/images/' . ImageHelper::FOLDER_NEWS . '/' . $this->id . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $imageName;
    }

    public function getImageDetailThumbnailAttribute(): string
    {
        $imageName = ImageHelper::getThumbnailName($this->image, self::IMAGE_WIDTH_DETAIL, self::IMAGE_HEIGHT_DETAIL);

        return '/storage/images/' . ImageHelper::FOLDER_NEWS . '/' . $this->id . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $imageName;
    }

    public function getImageOriginalAttribute(): string
    {
        return '/storage/images/' . ImageHelper::FOLDER_NEWS . '/' . $this->id . '/' . ImageHelper::TYPE_ORIGINAL . '/' . $this->image;
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
