<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Clinic\Timetable;
use App\Entity\Clinic\DoctorClinic;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Timetable::class, function (Faker $faker) {
    $scheduleType = $faker->randomElement([Timetable::SCHEDULE_TYPE_WEEK, Timetable::SCHEDULE_TYPE_ODD_OR_EVEN]);
    $interval = $faker->randomElement([30, 60]);
    $morning = Carbon::createFromTime($faker->numberBetween(8, 12), 0, 0);
    $afternoon = Carbon::createFromTime($faker->numberBetween(13, 18), 0, 0);
    $dayOff = Carbon::now()->addDays($faker->numberBetween(2, 9));
    $maxDayOff = Carbon::now()->addDays($faker->numberBetween(10, 15));

    return [
        'schedule_type' => $scheduleType,
        'interval' => $interval,
        'monday_start' => $morning,
        'monday_end' => $afternoon,
        'tuesday_start' => $morning,
        'tuesday_end' => $afternoon,
        'wednesday_start' => $morning,
        'wednesday_end' => $afternoon,
        'thursday_start' => $morning,
        'thursday_end' => $afternoon,
        'friday_start' => $morning,
        'friday_end' => $afternoon,
        'saturday_start' => null,
        'saturday_end' => null,
        'sunday_start' => null,
        'sunday_end' => null,
        'odd_start' => null,
        'odd_end' => null,
        'even_start' => null,
        'even_end' => null,
        'day_off_start' => $dayOff,
        'day_off_end' => $maxDayOff,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
