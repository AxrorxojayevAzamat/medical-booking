<?php

use Illuminate\Database\Seeder;
use App\Entity\Clinic\Clinic;
use App\Entity\User\User;

class DoctorClinicsTableSeed extends Seeder {

    public function run() {
        $clinics = Clinic::pluck('id')->toArray();


        User::where('role', User::ROLE_DOCTOR)->chunk(100, function ($users) use ($clinics) {
            foreach ($users as $user) {
                $tempos = $clinics;
                $count = random_int(0, 3);
                for ($i = 0; $i < $count; $i++) {
                    $key = array_rand($tempos);
                    $user->doctorClinics()->create(['clinic_id' => $tempos[$key]]);
                    unset($tempos[$key]);
                }
            }
        });
    }

}
