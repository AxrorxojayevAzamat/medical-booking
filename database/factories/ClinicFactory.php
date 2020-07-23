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
        'description_uz' => $faker->text(200),
        'description_ru' => $faker->text(200),
        'address_uz' => $faker->unique()->address,
        'address_ru' => $faker->unique()->address,
        'work_time_start' => '09:00',
        'work_time_end' => '17:00',
        'location' => $faker->randomElement(['41.3191884,69.2382324','41.2981861,69.2120876','41.2704736,69.2134647']),
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
