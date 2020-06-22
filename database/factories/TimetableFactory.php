<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Clinic\Timetable;
use Faker\Generator as Faker;

$factory->define(Timetable::class, function (Faker $faker) {
    $scheduleType = $faker->randomElement([Timetable::SCHEDULE_TYPE_WEEK, Timetable::SCHEDULE_TYPE_ODD, Timetable::SCHEDULE_TYPE_EVEN]);
    return [
        'doctor_id' => 5,
        'clinic_id' => 6,
        'schedule_type' => $scheduleType,
        'interval' => null,
        'monday_start' => '12:01:00',
        'monday_end' => '15:01:59',
        'tuesday_start' => '12:02:00',
        'tuesday_end' => '15:02:59',
        'wednesday_start' => '12:03:00',
        'wednesday_end' => '15:03:59',
        'thursday_start' => '12:04:00',
        'thursday_end' => '15:04:59',
        'friday_start' => '12:05:00',
        'friday_end' => '15:05:59',
        'saturday_start' => null,
        'saturday_end' => null,
        'sunday_start' => null,
        'sunday_end' => null,
        'odd_start' => null,
        'odd_end' => null,
        'even_start' => null,
        'even_end' => null,
        'day_off_start' => '2020-06-01',
        'day_off_end' => '2020-06-04',
        'created_by' => 1,
        'updated_by' => 1
    ];
});
