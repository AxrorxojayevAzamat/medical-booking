<?php

use App\Entity\User\Profile;
use App\Entity\User\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class, 50)->create()->each(function (User $user) {
            if (!$user->isCallCenter() && !$user->isAdmin()) {
                $user->profile()->saveMany(factory(Profile::class, 1)->make());
            }
        });

        $patient = User::create([
            'email' => 'xurshid@xurshid.com',
            'email_verified_at' => '2020-06-25 00:00:00',
            'password' => bcrypt('12'),
            'status' => '11',
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_USER,
        ]);

        $doctor = User::create([
            'email' => 'doctor@doctor.com',
            'email_verified_at' => '2020-06-30 13:00:00',
            'password' => bcrypt('12'),
            'status' => '11',
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_DOCTOR,
        ]);

    }
}
