<?php

use App\Entity\Book\Book;
use Illuminate\Database\Seeder;
use App\Entity\Clinic\DoctorClinic;
use App\Entity\User\Profile;
use App\Entity\User\User;

class BooksTableSeed extends Seeder {

    public function run() {
        $doctors = DoctorClinic::all();

        User::where('role', User::ROLE_DOCTOR)->chunk(1, function ($users) use ($doctors) {
            foreach ($users as $user) {
                foreach ($user->doctorClinics as $clinic) {
                    foreach ($doctors as $doc => $doctorClinic) {
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
