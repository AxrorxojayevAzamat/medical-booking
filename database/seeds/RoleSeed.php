<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'Admin',
            'slug' => User::ROLE_ADMIN,
            'permissions' => [
                'user-manage' => true,
            ]
        ]);

        $user = Role::create([
            'name' => 'User',
            'slug' => User::ROLE_USER,
            'permissions' => [
                'user-profile' => true,
            ]
        ]);
                
        $adminCallCenter = Role::create([
            'name' => 'Admin Call Center',
            'slug' => User::ROLE_CALL_CENTER,
            'permissions' => [
                'admin_call_center' => true,
            ]
        ]);
        
                
        $adminClinic = Role::create([
            'name' => 'Admin Clinic',
            'slug' => User::ROLE_CLINIC,
            'permissions' => [
                'admin_clinic' => true,
            ]
        ]);
        
        $doctor = Role::create([
            'name' => 'Doctor',
            'slug' => User::ROLE_DOCTOR,
            'permissions' => [
                'doctor' => true,
            ]
        ]);
 
    }
}
