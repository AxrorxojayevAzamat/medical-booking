<?php

use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Service;
use Illuminate\Database\Seeder;

class ClinicServicesTableSeeder extends Seeder
{
    public function run(): void
    {
        $serviceIds = Service::pluck('id')->toArray();

        Clinic::chunk(100, function ($clinics) use ($serviceIds) {
            /* @var $clinic Clinic */
            foreach ($clinics as $clinic) {
                $services = $serviceIds;
                $count = random_int(3, 15);
                $sort = 1;
                for ($i = 0; $i < $count; $i++) {
                    $key = array_rand($services);
                    $clinic->clinicServices()->create(['service_id' => $services[$key], 'sort' => $sort++]);
                    unset($services[$key]);
                }
            }
        });
    }
}
