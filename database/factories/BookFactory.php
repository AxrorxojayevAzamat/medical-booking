<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Book\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'user_id' => 9,
        'doctor_id' => 6,
        'clinic_id' => 3,
        'booking_date' => '2020-06-03',
        'time_start' => '12:31:00',
        'time_finish' => null,
        'description' => $faker->text(15),
        'status' => null,
    ];
});
