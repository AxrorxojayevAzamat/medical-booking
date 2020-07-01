<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Book\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $timeStart = date('H:i:s', rand(32400, 66600));
    $time = new DateTime($timeStart);
    $time->modify('+30 minutes');
    return [
        'booking_date' => $faker->dateTimeInInterval('now', '+2 month')->format('Y-m-d'),
        'time_start' => $timeStart,
        'time_finish' => $time->format('H:i:s'),
        'description' => $faker->text(15),
        'status' => $faker->randomElement([Book::STATUS_PAYED, Book::STATUS_POSTPONED, Book::STATUS_CANCELLED, Book::STATUS_COMPLETED]),
    ];
});
