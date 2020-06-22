<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\User\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $gender = $faker->randomElement([Profile::MALE, Profile::FEMALE]);
    return [
        'first_name' => $gender === Profile::MALE ? $faker->firstNameMale : $faker->firstNameFemale,
        'last_name' => $faker->lastName,
        'middle_name' => $faker->firstNameMale,
        'birth_date' => $faker->date('Y-m-d H:i:s'),
        'gender' => $gender,
        'about_uz' => $faker->text('150'),
        'about_ru' => $faker->text('150'),
        'avatar' => $faker->imageUrl(),
    ];


});
