<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Celebration;
use Faker\Generator as Faker;

$factory->define(Celebration::class, function (Faker $faker) {
    $status = $faker->randomElement([Celebration::INACTIVE, Celebration::ACTIVE]);
    return [
        'name_ru' => $faker->unique()->name,
        'name_uz' => $faker->unique()->name,
        'date' => $faker->date('Y-m-d H:i:s'),
        'quantity' => $faker->randomNumber(1),
        'status' => $status,
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
