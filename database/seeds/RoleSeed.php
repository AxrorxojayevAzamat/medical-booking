<?php

use App\Role;
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
            'slug' => 'admin',
            'permissions' => [
                'user-manage' => true,
            ]
        ]);

        $user = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => [
                'user-profile' => true,
            ]
        ]);
                
        $adminCallCenter = Role::create([
            'name' => 'Admin Call Center',
            'slug' => 'admin_call_center',
            'permissions' => [
                'admin_call_center' => true,
            ]
        ]);
        
                
        $adminClinic = Role::create([
            'name' => 'Admin Clinic',
            'slug' => 'admin_clinic',
            'permissions' => [
                'admin_clinic' => true,
            ]
        ]);
        
        $doctor = Role::create([
            'name' => 'Doctor',
            'slug' => 'doctor',
            'permissions' => [
                'doctor' => true,
            ]
        ]);
 
    }
}
