<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model {

    protected $table = 'timetables';
    protected $fillable = [
        'scheduleType',
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
        'odd_start',
        'odd_end',
        'even_start',
        'even_end',
        'day_off_start',
        'day_off_end',
        'created_by',
        'updated_by',
    ];
    public function clinic()
    {
        return $this->belongsTo('App\Clinic');
    }

    public const SCHEDULE_TYPE_WEEK = 1;
    public const SCHEDULE_TYPE_ODD = 2;
    public const SCHEDULE_TYPE_EVEN = 3;

    public function isScheduleTypeWeek(): bool {
        return $this->scheduleType === self::SCHEDULE_TYPE_WEEK;
    }

    public function isScheduleTypeOdd(): bool {
        return $this->scheduleType === self::SCHEDULE_TYPE_ODD;
    }

    public function isScheduleTypeEven(): bool {
        return $this->scheduleType === self::SCHEDULE_TYPE_EVEN;
    }

}
