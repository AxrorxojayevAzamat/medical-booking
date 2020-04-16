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
                    'phone' => '998991234567',
                    'birth_date' => '1988-04-09 00:00:00',
                    'gender' => '1',
                    'email' => 'admin@admin.com',
                    'email_verified_at' => '2020-03-31 06:12:15',
                    'password' => bcrypt('12'),
                    'status' => '1',
        ]);
        $admin->roles()->attach(1);

        $user = User::create([
                    'name' => 'User',
                    'lastname' => 'Userov',
                    'patronymic' => 'Userovich',
                    'phone' => '998991234567',
                    'birth_date' => '1988-04-09 00:00:00',
                    'gender' => '1',
                    'email' => 'user@user.com',
                    'email_verified_at' => '2020-03-31 06:14:15',
                    'password' => bcrypt('12'),
                    'status' => '1',
        ]);
        $user->roles()->attach(2);

        $adminCallCenter = User::create([
                    'name' => 'AdminCallCenter',
                    'lastname' => 'AdminovCallCenter',
                    'patronymic' => 'AdminovichCallCenter',
                    'phone' => '998991234567',
                    'birth_date' => '1988-04-09 00:00:00',
                    'gender' => '1',
                    'email' => 'admin.call@admin.com',
                    'email_verified_at' => '2020-03-31 06:12:15',
                    'password' => bcrypt('12'),
                    'status' => '1',
        ]);
        $adminCallCenter->roles()->attach(3);
        $adminClinic = User::create([
                    'name' => 'AdminClinic',
                    'lastname' => 'AdminovClinic',
                    'patronymic' => 'AdminovichClinic',
                    'phone' => '998991234567',
                    'birth_date' => '1988-04-09 00:00:00',
                    'gender' => '1',
                    'email' => 'admin.clinic@admin.com',
                    'email_verified_at' => '2020-03-31 06:12:15',
                    'password' => bcrypt('12'),
                    'status' => '1',
        ]);
        $adminCallCenter->roles()->attach(4);
        $doctor = User::create([
                    'name' => 'Doctor',
                    'lastname' => 'Doctorov',
                    'patronymic' => 'Doctorovich',
                    'phone' => '998991234567',
                    'birth_date' => '1988-04-09 00:00:00',
                    'gender' => '1',
                    'email' => 'doctor@doctor.com',
                    'email_verified_at' => '2020-03-31 06:12:15',
                    'password' => bcrypt('12'),
                    'status' => '1',
        ]);
        $doctor->roles()->attach(5);
    }

}
