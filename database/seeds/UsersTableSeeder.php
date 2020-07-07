<?php

use App\Entity\User\Profile;
use App\Entity\User\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run(): void {
        factory(User::class, 50)->create()->each(function (User $user) {
            if (!$user->isCallCenter() && !$user->isAdmin()) {
                $user->profile()->saveMany(factory(Profile::class, 1)->make());
            }
        });

        $patient = User::create([
                    'email' => 'xurshid@xurshid.com',
                    'email_verified_at' => '2020-06-25 00:00:00',
                    'password' => bcrypt('12'),
                    'phone' => '+13172130030',
                    'status' => User::STATUS_ACTIVE,
                    'role' => User::ROLE_USER,
        ]);

        $doctor = User::create([
                    'email' => 'doctor@doctor.com',
                    'email_verified_at' => '2020-06-30 13:00:00',
                    'password' => bcrypt('12'),
                    'phone' => '+13172130030',
                    'status' => User::STATUS_ACTIVE,
                    'role' => User::ROLE_DOCTOR,
        ]);

        Profile::create([
            'user_id' => $patient->id,
            'first_name' => 'Test',
            'last_name' => 'Testerov',
            'middle_name' => 'Testerovich',
            'birth_date' => '1989-07-03 09:34:03',
            'gender' => 1,
            'about_uz' => 'ABOUT_RU',
            'about_ru' => 'ABOUT_RU',
            'avatar' => 'https://lorempixel.com/640/480/?84833',
        ]);
        Profile::create([
            'user_id' => $doctor->id,
            'first_name' => 'Doctor',
            'last_name' => 'Doctorov',
            'middle_name' => 'Doctorovich',
            'birth_date' => '1989-07-03 09:34:03',
            'gender' => 1,
            'about_uz' => 'ABOUT_RU',
            'about_ru' => 'ABOUT_RU',
            'avatar' => 'https://lorempixel.com/640/480/?84833',
        ]);
    }

}
