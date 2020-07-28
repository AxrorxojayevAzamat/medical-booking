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
                    'email' => 'user@user.com',
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

        $admin_clinic = User::create([
                    'email' => 'clinic@admin.com',
                    'email_verified_at' => '2020-06-30 13:00:00',
                    'password' => bcrypt('12'),
                    'phone' => '+13172130030',
                    'status' => User::STATUS_ACTIVE,
                    'role' => User::ROLE_CLINIC,
        ]);

        $admin_center = User::create([
                    'email' => 'center@admin.com',
                    'email_verified_at' => '2020-06-30 13:00:00',
                    'password' => bcrypt('12'),
                    'phone' => '+13172130030',
                    'status' => User::STATUS_ACTIVE,
                    'role' => User::ROLE_CALL_CENTER,
        ]);

        Profile::create([
            'user_id' => $patient->id,
            'first_name' => 'Test',
            'last_name' => 'Testerov',
            'middle_name' => 'Testerovich',
            'birth_date' => '1989-07-03 09:34:03',
            'gender' => Profile::FEMALE,
            'about_uz' => 'ABOUT_RU',
            'about_ru' => 'ABOUT_RU',
            'avatar' => '/img/avatar2.jpg',
        ]);
        Profile::create([
            'user_id' => $doctor->id,
            'first_name' => 'Doctor',
            'last_name' => 'Doctorov',
            'middle_name' => 'Doctorovich',
            'birth_date' => '1989-07-03 09:34:03',
            'gender' => Profile::MALE,
            'about_uz' => 'ABOUT_RU',
            'about_ru' => 'ABOUT_RU',
            'avatar' => '/img/avatar1.jpg',
        ]);
        Profile::create([
            'user_id' => $admin_clinic->id,
            'first_name' => 'AdminClinic',
            'last_name' => 'AdminClinicov',
            'middle_name' => 'AdminClinicvich',
            'birth_date' => '1989-07-03 09:34:03',
            'gender' => Profile::MALE,
            'about_uz' => 'ABOUT_RU',
            'about_ru' => 'ABOUT_RU',
            'avatar' => '/img/avatar3.jpg',
        ]);
        Profile::create([
            'user_id' => $admin_center->id,
            'first_name' => 'AdminCenter',
            'last_name' => 'AdminCenterov',
            'middle_name' => 'AdminCentervich',
            'birth_date' => '1989-07-03 09:34:03',
            'gender' => Profile::MALE,
            'about_uz' => 'ABOUT_RU',
            'about_ru' => 'ABOUT_RU',
            'avatar' => '/img/avatar4.jpg',
        ]);
        
    }

}
