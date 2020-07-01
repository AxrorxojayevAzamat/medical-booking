<?php

use Illuminate\Database\Seeder;
use App\Entity\Clinic\Specialization;
use App\Entity\User\User;

class DoctorSpecializationsTableSeeder extends Seeder {

    public function run() {
        $specIds = Specialization::pluck('id')->toArray();

        User::where('role', User::ROLE_DOCTOR)->chunk(100, function ($users) use ($specIds) {
            /* @var $user User */
            foreach ($users as $user) {
                $tempos = $specIds;
                $count = random_int(0, 2);
                for ($i = 0; $i < $count; $i++) {
                    $key = array_rand($tempos);
                    $user->doctorSpecializations()->create(['specialization_id' => $tempos[$key]]);
                    unset($tempos[$key]);
                }
            }
        });
    }

}
