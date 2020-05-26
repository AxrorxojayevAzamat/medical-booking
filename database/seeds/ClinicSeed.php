<?php

use Illuminate\Database\Seeder;
use App\Clinic;
use Illuminate\Support\Facades\DB;

class ClinicSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('clinics')->insert(array(
            0 => array(
                'name_ru' => 'Мед клиника1',
                'name_uz' => 'Med Clinic1',
                'region_id' => '15',
                'type' => '1',
                'description_uz' => 'Medical Clinic is good',
                'description_ru' => 'Медицинская клиника хорошая',
                'phone_numbers' => '(998) 99 123-4562',
                'adress_uz' => 'Uzbekistan,Tashkent',
                'adress_ru' => 'Uzbekistan,Tashkent',
                'work_time_start' => '09:00',
                'work_time_end' => '17:00',
                'location' => 'Ташкент',
            ),
            1 => array(
                'name_ru' => 'Мед клиника2',
                'name_uz' => 'Med Clinic2',
                'region_id' => '16',
                'type' => '1',
                'description_uz' => 'Med Clinic is good',
                'description_ru' => 'Мед клиника хорошая',
                'phone_numbers' => '(998) 99 890-4562',
                'adress_uz' => 'Uzbekistan,Tashkent',
                'adress_ru' => 'Uzbekistan,Tashkent',
                'work_time_start' => '09:00',
                'work_time_end' => '15:00',
                'location' => 'Ташкент',
            ),
            2 => array(
                'name_ru' => 'Мед клиника3',
                'name_uz' => 'Med Clinic3',
                'region_id' => '17',
                'type' => '1',
                'description_uz' => 'Med Clinic is good',
                'description_ru' => 'Мед клиника хорошая',
                'phone_numbers' => '(998) 99 890-4562',
                'adress_uz' => 'Uzbekistan,Tashkent',
                'adress_ru' => 'Uzbekistan,Tashkent',
                'work_time_start' => '09:00',
                'work_time_end' => '15:00',
                'location' => 'Ташкент',
            ),
            3 => array(
                'name_ru' => 'Городская клиника1',
                'name_uz' => 'City Clinic1',
                'region_id' => '18',
                'type' => '2',
                'description_uz' => 'City Clinic is good',
                'description_ru' => 'Городская клиника хорошая',
                'phone_numbers' => '(998) 99 123-8862',
                'adress_uz' => 'Uzbekistan,Tashkent',
                'adress_ru' => 'Uzbekistan,Tashkent',
                'work_time_start' => '08:00',
                'work_time_end' => '16:00',
                'location' => 'Ташкент',
            ),
            4 => array(
                'name_ru' => 'Городская клиника2',
                'name_uz' => 'City Clinic2',
                'region_id' => '19',
                'type' => '2',
                'description_uz' => 'City Clinic is good',
                'description_ru' => 'Городская клиника хорошая',
                'phone_numbers' => '(998) 99 123-8862',
                'adress_uz' => 'Uzbekistan,Tashkent',
                'adress_ru' => 'Uzbekistan,Tashkent',
                'work_time_start' => '08:00',
                'work_time_end' => '16:00',
                'location' => 'Ташкент',
            ),
            5 => array(
                'name_ru' => 'Городская клиника3',
                'name_uz' => 'City Clinic3',
                'region_id' => '15',
                'type' => '2',
                'description_uz' => 'City Clinic is good',
                'description_ru' => 'Городская клиника хорошая',
                'phone_numbers' => '(998) 99 123-8862',
                'adress_uz' => 'Uzbekistan,Tashkent',
                'adress_ru' => 'Uzbekistan,Tashkent',
                'work_time_start' => '08:00',
                'work_time_end' => '16:00',
                'location' => 'Ташкент',
            ),
            6 => array(
                'name_ru' => 'Городская клиника4',
                'name_uz' => 'City Clinic4',
                'region_id' => '26',
                'type' => '2',
                'description_uz' => 'City Clinic is good',
                'description_ru' => 'Городская клиника хорошая',
                'phone_numbers' => '(998) 99 123-8866',
                'adress_uz' => 'Uzbekistan,Andijon',
                'adress_ru' => 'Uzbekistan,Andijon',
                'work_time_start' => '08:00',
                'work_time_end' => '16:00',
                'location' => 'Ташкент',
            ),
            7 => array(
                'name_ru' => 'Городская клиника5',
                'name_uz' => 'City Clinic5',
                'region_id' => '27',
                'type' => '2',
                'description_uz' => 'City Clinic is good',
                'description_ru' => 'Городская клиника хорошая',
                'phone_numbers' => '(998) 99 123-8866',
                'adress_uz' => 'Uzbekistan,Andijon',
                'adress_ru' => 'Uzbekistan,Andijon',
                'work_time_start' => '08:00',
                'work_time_end' => '16:00',
                'location' => 'Ташкент',
            )
        ));
    }

}
