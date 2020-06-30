<?php

use Illuminate\Database\Seeder;
use App\Entity\Clinic\Timetable;
use App\Entity\Clinic\DoctorClinic;
use App\Entity\Clinic\Clinic;
use App\Entity\User\User;

class TimetablesTableSeeder extends Seeder {

    public function run() {
        $doctors = DoctorClinic::all();

        User::where('role', User::ROLE_DOCTOR)->chunk(1, function ($users) use ($doctors) {
            foreach ($users as $user) {
                foreach ($user->doctorClinics as $clinic) {
                    foreach ($doctors as $doc => $doctorClinic) {
                        if ($clinic->doctor_id == $doctorClinic->doctor_id && $clinic->clinic_id == $doctorClinic->clinic_id) {
                            $user->doctorClinics()->saveMany(factory(Timetable::class, 1)->make(['clinic_id' => $doctorClinic->clinic_id]));
                        }
                    }
                }
            }
        });
    }

}
