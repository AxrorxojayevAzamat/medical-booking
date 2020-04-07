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
            'name_ru' => 'Admin',
            'name_uz' => 'Admin_uz',
            'lastname_ru' => 'Adminov',
            'lastname_uz' => 'Adminov_uz',
            'patronymic_ru' => 'Adminovich',
            'patronymic_uz' => 'Adminovich_uz',
            'phone' => '998991234567',
            'email' => 'admin@admin.com',
            'email_verified_at' => '2020-03-31 06:12:15',
            'password' => bcrypt('12'),
        ]); 
        $user->roles()->attach(1);
        
        $user1 = User::create([
            'name_ru' => 'User',
            'name_uz' => 'User_uz',
            'lastname_ru' => 'Userov',
            'lastname_uz' => 'Userov_uz',
            'patronymic_ru' => 'Userovich',
            'patronymic_uz' => 'Userovich_uz',
            'phone' => '998991234567',
            'email' => 'user@user.com',
            'email_verified_at' => '2020-03-31 06:14:15',
            'password' => bcrypt('12'),
        ]); 
        $user->roles()->attach(2);     
    }
}
