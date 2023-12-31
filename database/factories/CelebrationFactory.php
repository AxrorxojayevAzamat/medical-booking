<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Celebration;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Celebration::class, function (Faker $faker) {
    $status = $faker->randomElement([Celebration::INACTIVE, Celebration::ACTIVE]);
    $today = Carbon::now();
    $year = $today->year;
    $day = $today->day;
    return [
        'name_ru' => $faker->unique()->name,
        'name_uz' => $faker->unique()->name,
        'date' => Carbon::create($year, $today->addMonths($faker->numberBetween($min = 1, $max = 3))->month, $day),
        'quantity' => $faker->numberBetween($min = 1, $max = 3),
        'status' => $status,
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
