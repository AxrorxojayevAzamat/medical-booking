<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Clinic\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name_uz' => $faker->unique()->name,
        'name_ru' => $faker->unique()->name,
        'description_uz' => $faker->text(200),
        'description_ru' => $faker->text(200),
        'icon' => $faker->imageUrl(),
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
