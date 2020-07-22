<?php

namespace App\Entity\Clinic;

use App\Entity\BaseModel;
use App\Entity\User\User;
use Carbon\Carbon;
use Eloquent;

/**
 * @property int $id
 * @property int $clinic_id
 * @property int $type
 * @property string $value
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Contact extends BaseModel
{
    const PHONE_NUMBER = 1;
    const FAX_NUMBER = 2;
    const EMAIL = 3;
    const TELEGRAM = 4;
    const FACEBOOK = 5;
    const INSTAGRAM = 6;

    protected $table = 'clinic_contacts';

    protected $fillable = [
        'clinic_id', 'type', 'value'
    ];

    public static function getTypeList(): array
    {
        return [
            self::PHONE_NUMBER => 'Номер телефона',
            self::FAX_NUMBER => 'Номер факса',
            self::EMAIL => 'Электронный адрес',
            self::TELEGRAM => 'Телеграм',
            self::FACEBOOK => 'Фейсбук',
            self::INSTAGRAM => 'Инстаграм',
        ];
    }

    public function getTypeName(): string
    {
        return self::getTypeList()[$this->type];
    }


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
