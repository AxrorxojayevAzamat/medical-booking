<?php

use Illuminate\Database\Seeder;
use App\Entity\Celebration;

class CelebrationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newyear = Celebration::create([
            'name' => 'Новый год',
            'date' => '2020-03-21',
            'quantity' => '3',

        ]);

        $navruz = Celebration::create([
            'name' => 'Навруз',
            'date' => '2020-03-21',
            'quantity' => '2',
        ]);
    }
}
