<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Entity\Clinic\Clinic;
use App\Entity\Region;
use Faker\Generator as Faker;

$factory->define(Clinic::class, function (Faker $faker) {
    $regionsCount = Region::count();
    $clinicType = $faker->randomElement([Clinic::CLINIC_TYPE_PRIVATE, Clinic::CLINIC_TYPE_GOVERNMENT]);
    return [
        'name_ru' => $faker->unique()->name,
        'name_uz' => $faker->unique()->name,
        'region_id' => $faker->numberBetween(15, $regionsCount),
        'type' => $clinicType,
        'description_uz' => $faker->text(20),
        'description_ru' => $faker->text(20),
        'phone_numbers' => $faker->unique()->phoneNumber,
        'address_uz' => $faker->unique()->address,
        'address_ru' => $faker->unique()->address,
        'work_time_start' => '09:00',
        'work_time_end' => '17:00',
        'location' => 'Ташкент',
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
