<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Clinic\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    $type = $faker->randomElement([Contact::PHONE_NUMBER, Contact::FAX_NUMBER, Contact::EMAIL]);
    if ($type === Contact::PHONE_NUMBER) {
        $value = $faker->unique()->e164PhoneNumber;
    } elseif ($type === Contact::FAX_NUMBER) {
        $value = $faker->unique()->phoneNumber;
    } else {
        $value = $faker->unique()->email;
    }
    return [
        'type' => $type,
        'value' => $value,
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
