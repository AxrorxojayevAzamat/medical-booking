<?php

use Illuminate\Database\Seeder;
use App\Entity\Holiday;

class CelebrationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newyear = Holiday::create([
            'name' => 'Новый год',
            'date' => '2020-03-21',
            'quantity' => '3',

        ]);

        $navruz = Holiday::create([
            'name' => 'Навруз',
            'date' => '2020-03-21',
            'quantity' => '2',
        ]);
    }
}
