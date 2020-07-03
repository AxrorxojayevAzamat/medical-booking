<?php

namespace App\Entity\Clinic;

use App\Entity\BaseModel;
use App\Entity\User\User;
use Carbon\Carbon;
use Eloquent;

/**
 * @property int $id
 * @property int $doctor_id
 * @property int $clinic_id
 * @property int $schedule_type
 * @property int $interval
 * @property string $monday_start
 * @property string $monday_end
 * @property string $tuesday_start
 * @property string $tuesday_end
 * @property string $wednesday_start
 * @property string $wednesday_end
 * @property string $thursday_start
 * @property string $thursday_end
 * @property string $friday_start
 * @property string $friday_end
 * @property string $saturday_start
 * @property string $saturday_end
 * @property string $sunday_start
 * @property string $sunday_end
 * @property string $lunch_start
 * @property string $lunch_end
 * @property string $odd_start
 * @property string $odd_end
 * @property string $even_start
 * @property string $even_end
 * @property string $day_off_start
 * @property string $day_off_end
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $doctor
 * @property Clinic $clinic
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin Eloquent
 */
class Timetable extends BaseModel {

    protected $table = 'timetables';

    public const SCHEDULE_TYPE_WEEK = 1;
    public const SCHEDULE_TYPE_ODD_OR_EVEN = 2;

    protected $fillable = [
        'schedule_type',
        'interval',
        'monday_start',
        'monday_end',
        'tuesday_start',
        'tuesday_end',
        'wednesday_start',
        'wednesday_end',
        'thursday_start',
        'thursday_end',
        'friday_start',
        'friday_end',
        'saturday_start',
        'saturday_end',
        'sunday_start',
        'sunday_end',
        'lunch_start',
        'lunch_end',
        'odd_start',
        'odd_end',
        'even_start',
        'even_end',
        'day_off_start',
        'day_off_end',
    ];

    public function isWeek() {
        return $this->schedule_type === self::SCHEDULE_TYPE_WEEK;
    }

    public function isOdd() {
        return $this->schedule_type == self::SCHEDULE_TYPE_ODD_OR_EVEN && !empty($this->odd_start) && !empty($this->odd_end);
    }

    public function isEven() {
        return $this->schedule_type == self::SCHEDULE_TYPE_ODD_OR_EVEN && !empty($this->even_start) && !empty($this->even_end);
    }

    ########################################### Relations

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function clinic() {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    ###########################################
}
