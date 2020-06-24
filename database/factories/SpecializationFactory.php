<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Clinic\Specialization;
use Faker\Generator as Faker;

$factory->define(Specialization::class, function (Faker $faker) {
    return [
        'name_uz' => $faker->unique()->name,
        'name_ru' => $faker->unique()->name,
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
