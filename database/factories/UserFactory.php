<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $active = $faker->boolean;
    return [
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->phoneNumber,
        'verify_token' => $active ? null : Str::uuid(),
        'email_verified_at' => $active ? null : Carbon::now()->addSeconds(300),
        'role' => $active ? $faker->randomElement([User::ROLE_USER, User::ROLE_ADMIN, User::ROLE_CALL_CENTER, User::ROLE_DOCTOR, User::ROLE_CLINIC]) : User::ROLE_USER,
        'status' => $active ? User::STATUS_ACTIVE : User::STATUS_INACTIVE,
        'password' => '$2y$10$6Lwc.e9C9tOaSBimWKuMfO4GnNpTYjCOggwwl56rjEHzo4frI0V6m',
        'remember_token' => Str::random(10),
    ];
});
