<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Region;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name_uz' => $faker->unique()->name,
        'name_ru' => $faker->unique()->name,
        'parent_id' => null,
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
