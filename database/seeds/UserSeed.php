<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $admin = User::create([
                    'name' => 'Admin',
                    'lastname' => 'Adminov',
                    'patronymic' => 'Adminovich',
                    'phone' => '(998) 99 123-4561',
                    'birth_date' => '1988-04-21 00:00:00',
                    'gender' => '1',
                    'email' => 'admin@admin.com',
                    'email_verified_at' => '2020-04-21 00:00:00',
                    'password' => bcrypt('12'),
                    'status' => User::STATUS_ACTIVE,
                    'role' => '1',
        ]);

        $user = User::create([
                    'name' => 'User',
                    'lastname' => 'Userov',
                    'patronymic' => 'Userovich',
                    'phone' => '(998) 99 123-4562',
                    'birth_date' => '1988-04-22 00:00:00',
                    'gender' => '1',
                    'email' => 'user@user.com',
                    'email_verified_at' => '2020-04-22 00:00:00',
                    'password' => bcrypt('12'),
                    'status' => User::STATUS_ACTIVE,
                    'role' => '2',
        ]);

        $adminCallCenter = User::create([
                    'name' => 'AdminCallCenter',
                    'lastname' => 'AdminovCallCenter',
                    'patronymic' => 'AdminovichCallCenter',
                    'phone' => '(998) 99 123-4563',
                    'birth_date' => '1988-04-23 00:00:00',
                    'gender' => '1',
                    'email' => 'admin.call@admin.com',
                    'email_verified_at' => '2020-04-23 00:00:00',
                    'password' => bcrypt('12'),
                    'status' => User::STATUS_ACTIVE,
                    'role' => '3',
        ]);
        $adminClinic = User::create([
                    'name' => 'AdminClinic',
                    'lastname' => 'AdminovClinic',
                    'patronymic' => 'AdminovichClinic',
                    'phone' => '(998) 99 123-4564',
                    'birth_date' => '1988-04-24 00:00:00',
                    'gender' => '1',
                    'email' => 'admin.clinic@admin.com',
                    'email_verified_at' => '2020-04-24 00:00:00',
                    'password' => bcrypt('12'),
                    'status' => User::STATUS_ACTIVE,
                    'role' => '4',
        ]);
        $doctor = User::create([
                    'name' => 'Doctor',
                    'lastname' => 'Doctorov',
                    'patronymic' => 'Doctorovich',
                    'phone' => '(998) 99 123-4565',
                    'birth_date' => '1988-04-25 00:00:00',
                    'gender' => '1',
                    'email' => 'doctor@doctor.com',
                    'email_verified_at' => '2020-04-25 00:00:00',
                    'password' => bcrypt('12'),
                    'status' => User::STATUS_ACTIVE,
                    'role' => '5',
        ]);
        $doctor2 = User::create([
                    'name' => 'Doctor2',
                    'lastname' => 'Doctorov2',
                    'patronymic' => 'Doctorovich2',
                    'phone' => '(998) 99 123-4565',
                    'birth_date' => '1988-04-25 00:00:00',
                    'gender' => '1',
                    'email' => 'doctor2@doctor.com',
                    'email_verified_at' => '2020-04-25 00:00:00',
                    'password' => bcrypt('12'),
                    'status' => User::STATUS_ACTIVE,
                    'role' => '5',
        ]);
        $doctor->specializations()->attach([1,2]);
        $doctor->clinics()->attach([1,6]);
        $doctor2->specializations()->attach([4]);
        $doctor2->clinics()->attach([3]);
    }

}
