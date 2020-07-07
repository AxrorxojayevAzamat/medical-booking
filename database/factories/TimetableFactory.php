<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Clinic\Timetable;
use App\Entity\Clinic\DoctorClinic;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Timetable::class, function (Faker $faker) {
    $scheduleType = $faker->randomElement([Timetable::SCHEDULE_TYPE_WEEK, Timetable::SCHEDULE_TYPE_ODD_OR_EVEN]);
    $interval = $faker->randomElement([30, 60]);
    $oddOrEven = $faker->randomElement([1, 2]);
    $morning = Carbon::createFromTime($faker->numberBetween(8, 12), 0, 0);
    $afternoon = Carbon::createFromTime($faker->numberBetween(13, 18), 0, 0);
    $dayOff = Carbon::now()->addDays($faker->numberBetween(2, 9));
    $maxDayOff = Carbon::now()->addDays($faker->numberBetween(10, 15));
    $lunchStart = Carbon::createFromTime(13, 0, 0);
    $lunchEnd = Carbon::createFromTime(14, 0, 0);

    return [
        'schedule_type' => $scheduleType,
        'interval' => $interval,
        'monday_start' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $morning : null,
        'monday_end' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $afternoon : null,
        'tuesday_start' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $morning : null,
        'tuesday_end' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $afternoon : null,
        'wednesday_start' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $morning : null,
        'wednesday_end' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $afternoon : null,
        'thursday_start' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $morning : null,
        'thursday_end' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $afternoon : null,
        'friday_start' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $morning : null,
        'friday_end' => $scheduleType == Timetable::SCHEDULE_TYPE_WEEK ? $afternoon : null,
        'saturday_start' => null,
        'saturday_end' => null,
        'sunday_start' => null,
        'sunday_end' => null,
        'lunch_start' => $lunchStart,
        'lunch_end' => $lunchEnd,
        'odd_start' => ($scheduleType == Timetable::SCHEDULE_TYPE_ODD_OR_EVEN && $oddOrEven == 1) ? $morning : null,
        'odd_end' => ($scheduleType == Timetable::SCHEDULE_TYPE_ODD_OR_EVEN && $oddOrEven == 1) ? $afternoon : null,
        'even_start' => ($scheduleType == Timetable::SCHEDULE_TYPE_ODD_OR_EVEN && $oddOrEven == 2) ? $morning : null,
        'even_end' => ($scheduleType == Timetable::SCHEDULE_TYPE_ODD_OR_EVEN && $oddOrEven == 2) ? $afternoon : null,
        'day_off_start' => $dayOff,
        'day_off_end' => $maxDayOff,
        'created_by' => 1,
        'updated_by' => 1
    ];
});
