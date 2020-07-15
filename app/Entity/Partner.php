<?php

namespace App\Entity;

use Carbon\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $site_url
 * @property string $photo
 * @property int $sort
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Partner extends BaseModel
{
    protected $table = 'partners';

    protected $fillable = ['name', 'sute_url', 'photo', 'sort', 'status'];
}
