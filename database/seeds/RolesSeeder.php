<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
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

        $admin = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => [
                'user-profile' => true,
            ]
        ]);
    }
}
