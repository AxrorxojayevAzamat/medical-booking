<?php


namespace App\Entity\Book;


use App\Entity\BaseModel;
use App\Entity\User\User;
use Carbon\Carbon;
use Eloquent;

/**
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $price
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Price extends BaseModel
{
    protected $table = 'book_prices';

    protected $fillable = [
        'name_uz', 'name_ru', 'price',
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
