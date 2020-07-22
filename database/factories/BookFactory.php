<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Book\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $timeStart = date('H:i', $faker->randomElement([32400, 36000, 39600, 43200, 54000, 57600, 61200, 64800]));
    $time = new DateTime($timeStart);
    $time->modify('+30 minutes');
    return [
        'booking_date' => $faker->dateTimeInInterval('now', '+2 month')->format('Y-m-d'),
        'time_start' => $timeStart,
        'time_finish' => $time->format('H:i'),
        'description' => $faker->text(15),
        'payment_type' => $faker->randomElement([Book::PAYME, Book::CLICK]),
        'status' => $faker->randomElement([Book::STATUS_ACTIVE, Book::STATUS_POSTPONED, Book::STATUS_CANCELLED, Book::STATUS_COMPLETED]),
    ];
});
