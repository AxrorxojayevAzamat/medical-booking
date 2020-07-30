<?php

use App\Entity\Book\Book;
use Illuminate\Database\Seeder;
use App\Entity\Clinic\DoctorClinic;
use App\Entity\User\Profile;
use App\Entity\User\User;

class BooksTableSeeder extends Seeder {

    public function run() {
        $doctorClinics = DoctorClinic::all();
        $keys = $doctorClinics->keys()->toArray();

        User::where('role', User::ROLE_USER)->chunk(100, function ($patients) use ($keys, $doctorClinics) {
            /* @var $patient User */
            foreach ($patients as $patient) {
                $tempKeys = $keys;
                $count = random_int(0, 3);
                for ($i = 0; $i < $count; $i++) {
                    $index = array_rand($tempKeys);
                    $patient->userBooks()->saveMany(factory(Book::class, 1)->make([
                        'doctor_id' => $doctorClinics[$index]->doctor_id,
                        'clinic_id' => $doctorClinics[$index]->clinic_id,
                    ]));
                    unset($tempKeys[$index]);
                }
            }
        });



        User::where('role', User::ROLE_DOCTOR)->chunk(1, function ($users) use ($doctorClinics) {
            foreach ($users as $user) {
                foreach ($user->doctorClinics as $clinic) {
                    foreach ($doctorClinics as $doc => $doctorClinic) {
                        if ($clinic->doctor_id == $doctorClinic->doctor_id && $clinic->clinic_id == $doctorClinic->clinic_id) {
                            $user->doctorClinics()->saveMany(factory(Book::class, 1)->make([
                                        'user_id' => factory(User::class)->create(['role' => User::ROLE_USER])->id,
                                        'clinic_id' => $doctorClinic->clinic_id
                            ]));
                        }
                    }
                }
            }
        });
    }

}
