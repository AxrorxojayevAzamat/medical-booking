<?php

use Illuminate\Database\Seeder;
use App\Entity\Clinic\Specialization;
use App\Entity\User\User;

class DoctorSpecializationsTableSeed extends Seeder
{
    public function run()
    {
        $specIds = Specialization::pluck('id')->toArray();

        User::chunk(100, function ($users) use ($specIds) {
            foreach ($users as $user) {
                $tempos = $specIds;
                $count = random_int(0, 3);
                for ($i = 0; $i < $count; $i++) {
                    $key = array_rand($tempos);
                    $user->doctorSpecializations()->create(['specialization_id' => $tempos[$key]]);
                    unset($tempos[$key]);
                }
            }
        });
    }
}
