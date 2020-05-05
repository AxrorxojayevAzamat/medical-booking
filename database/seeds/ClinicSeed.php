<?php

use Illuminate\Database\Seeder;
use App\Clinic;
class ClinicSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicalclinic = Clinic::create([
            'name_ru' => 'Медицинская клиника',
            'name_uz' => 'Medical Clinic',
            'region_id' => '1',
            'type' => '2',
            'description_uz' => 'Medical Clinic is good',
            'description_ru' => 'Медицинская клиника хорошая',
            'phone_numbers' => '(998) 99 123-4562',
            'adress_uz' => 'Uzbekistan,Tashkent',
            'adress_ru' => 'Uzbekistan,Tashkent',
            'work_time_start' => '09:00',
            'work_time_end' => '17:00',
            'location' => 'Ташкент',
        ]);

        $cityclinic = Clinic::create([
            'name_ru' => 'Городская клиника',
            'name_uz' => 'City Clinic',
            'region_id' => '2',
            'type' => '1',
            'description_uz' => 'City Clinic is good',
            'description_ru' => 'Городская клиника хорошая',
            'phone_numbers' => '(998) 99 123-8862',
            'adress_uz' => 'Uzbekistan,Tashkent',
            'adress_ru' => 'Uzbekistan,Tashkent',
            'work_time_start' => '08:00',
            'work_time_end' => '16:00',
            'location' => 'Ташкент',
        ]);

        $medclinic = Clinic::create([
            'name_ru' => 'Мед клиника',
            'name_uz' => 'Med Clinic',
            'region_id' => '3',
            'type' => '1',
            'description_uz' => 'Med Clinic is good',
            'description_ru' => 'Мед клиника хорошая',
            'phone_numbers' => '(998) 99 890-4562',
            'adress_uz' => 'Uzbekistan,Tashkent',
            'adress_ru' => 'Uzbekistan,Tashkent',
            'work_time_start' => '09:00',
            'work_time_end' => '15:00',
            'location' => 'Ташкент',
        ]);
    }
}
