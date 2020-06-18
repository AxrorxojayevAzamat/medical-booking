<?php

use Illuminate\Database\Seeder;
use App\Timetable;

class TimetableSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $doctor = Timetable::create([
                    'doctor_id' => 5,
                    'clinic_id' => 6,
                    'scheduleType' => 1,
                    'interval' => null,
                    'monday_start' => '12:01:00',
                    'monday_end' => '15:01:59',
                    'tuesday_start' => '12:02:00',
                    'tuesday_end' => '15:02:59',
                    'wednesday_start' => '12:03:00',
                    'wednesday_end' => '15:03:59',
                    'thursday_start' => '12:04:00',
                    'thursday_end' => '15:04:59',
                    'friday_start' => '12:05:00',
                    'friday_end' => '15:05:59',
                    'saturday_start' => null,
                    'saturday_end' => null,
                    'sunday_start' => null,
                    'sunday_end' => null,
                    'odd_start' => null,
                    'odd_end' => null,
                    'even_start' => null,
                    'even_end' => null,
                    'day_off_start' => '2020-06-01',
                    'day_off_end' => '2020-06-04',
                    'created_by' => 1,
                    'updated_by' => 1
        ]);
        $doctor2 = Timetable::create([
                    'doctor_id' => 6,
                    'clinic_id' => 3,
                    'scheduleType' => 2,
                    'interval' => null,
                    'monday_start' => '12:01:00',
                    'monday_end' => '15:01:59',
                    'tuesday_start' => '12:02:00',
                    'tuesday_end' => '15:02:59',
                    'wednesday_start' => '12:03:00',
                    'wednesday_end' => '15:03:59',
                    'thursday_start' => '12:04:00',
                    'thursday_end' => '15:04:59',
                    'friday_start' => '12:05:00',
                    'friday_end' => '15:05:59',
                    'odd_start' => null,
                    'odd_end' => null,
                    'even_start' => null,
                    'even_end' => null,
                    'day_off_start' => '2020-06-10',
                    'day_off_end' => '2020-06-15',
                    'created_by' => 1,
                    'updated_by' => 1
        ]);
        $doctor3 = Timetable::create([
                    'doctor_id' => 7,
                    'clinic_id' => 7,
                    'scheduleType' => 3,
                    'interval' => null,
                    'monday_start' => '12:01:00',
                    'monday_end' => '15:01:59',
                    'tuesday_start' => '12:02:00',
                    'tuesday_end' => '15:02:59',
                    'wednesday_start' => '12:03:00',
                    'wednesday_end' => '15:03:59',
                    'thursday_start' => '12:04:00',
                    'thursday_end' => '15:04:59',
                    'friday_start' => '12:05:00',
                    'friday_end' => '15:05:59',
                    'odd_start' => null,
                    'odd_end' => null,
                    'even_start' => null,
                    'even_end' => null,
                    'day_off_start' => '2020-06-17',
                    'day_off_end' => '2020-06-20',
                    'created_by' => 1,
                    'updated_by' => 1
        ]);
    }

}
