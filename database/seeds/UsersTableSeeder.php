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
    }
}
