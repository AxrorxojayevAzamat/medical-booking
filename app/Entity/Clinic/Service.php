<?php

namespace App\Entity\Clinic;

use App\Entity\BaseModel;
use App\Entity\User\User;
use App\Helpers\ImageHelper;
use App\Helpers\LanguageHelper;
use App\Http\Requests\Admin\Services\CreateRequest;
use App\Http\Requests\Admin\Services\UpdateRequest;
use Carbon\Carbon;
use Eloquent;

/**
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property string $description_uz
 * @property string $description_ru
 * @property string $icon
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $name
 * @property string $description
 * @property string $iconThumbnail
 * @property string $iconOriginal
 *
 * @property ClinicService[] $serviceClinics
 * @property Clinic[] $clinics
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Service extends BaseModel
{

    protected $table = 'services';

    protected $fillable = [
        'id', 'name_uz', 'name_ru', 'description_uz', 'description_ru', 'icon',
    ];

    public static function add(int $id, CreateRequest $request, string $imageName): self
    {
        return static::create([
            'id' => $id,
            'title_uz' => $request->name_uz,
            'title_ru' => $request->name_ru,
            'description_uz' => $request->description_uz,
            'description_ru' => $request->description_ru,
            'icon' => $imageName,
        ]);
    }

    public function edit(UpdateRequest $request, string $imageName = null): void
    {
        $this->update([
            'title_uz' => $request->name_uz,
            'title_ru' => $request->name_ru,
            'description_uz' => $request->description_uz,
            'description_ru' => $request->description_ru,
            'icon' => $imageName,
        ]);
    }


    ########################################### Mutators

    public function getNameAttribute(): string
    {
        return LanguageHelper::getName($this);
    }

    public function getDescriptionAttribute(): string
    {
        return LanguageHelper::getDescription($this);
    }

    public function getIconThumbnailAttribute(): string
    {
        return '/storage/images/' . ImageHelper::FOLDER_SERVICES . '/' . $this->id . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $this->icon;
    }

    public function getIconOriginalAttribute(): string
    {
        return '/storage/images/' . ImageHelper::FOLDER_SERVICES . '/' . $this->id . '/' . ImageHelper::TYPE_ORIGINAL . '/' . $this->icon;
    }

    ###########################################


    ########################################### Relations

    public function serviceClinics()
    {
        return $this->hasMany(ClinicService::class, 'clinic_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsToMany(Clinic::class, 'clinic_services', 'service_id', 'clinic_id');
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
