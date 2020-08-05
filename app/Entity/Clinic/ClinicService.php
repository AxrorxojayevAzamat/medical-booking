<?php

namespace App\Entity\Clinic;

use App\Entity\BasePivot;
use Eloquent;

/**
 * @property int $clinic_id
 * @property int $service_id
 * @property int $sort
 *
 * @property Clinic $clinic
 * @property Service $service
 * @mixin Eloquent
 */
class ClinicService extends BasePivot
{
    protected $table = 'clinic_services';

    protected $fillable = [
        'clinic_id', 'service_id', 'sort',
    ];

    public function isServiceIdEqualTo(int $serviceId): bool
    {
        return $this->service_id === $serviceId;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }


    ########################################### Relations

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    ###########################################
}
