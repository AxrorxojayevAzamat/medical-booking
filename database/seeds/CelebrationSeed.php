<?php

use Illuminate\Database\Seeder;
use App\Celebration;

class CelebrationSeed extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $newyear = Celebration::create([
            'date' => '2019-12-31',
            'name' => 'Новый год',
            'quantity' => '3',
        ]);

        $navruz = Celebration::create([
            'date' => '2020-03-21',
            'name' => 'Навруз',
            'quantity' => '2',
        ]);
    }
}
