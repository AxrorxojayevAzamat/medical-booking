<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'lastname' => 'Adminov',
            'patronymic' => 'Adminovich',
            'phone' => '998991234567',
            'birth_date' => '1988-04-09 00:00:00',
            'gender' => '0',
            'email' => 'admin@admin.com',
            'email_verified_at' => '2020-03-31 06:12:15',
            'password' => bcrypt('12'),
        ]); 
        $user->roles()->attach(1);
        
        $user1 = User::create([
            'name' => 'User',
            'lastname' => 'Userov',
            'patronymic' => 'Userovich',
            'phone' => '998991234567',
            'birth_date' => '1988-04-09 00:00:00',
            'gender' => '0',
            'email' => 'user@user.com',
            'email_verified_at' => '2020-03-31 06:14:15',
            'password' => bcrypt('12'),
        ]); 
        $user->roles()->attach(2);     
    }
}
