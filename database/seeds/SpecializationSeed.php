<?php

use Illuminate\Database\Seeder;
use App\Specialization;

class SpecializationSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $specialization = Specialization::create([
                    'name_ru' => 'Стоматолог',
                    'name_uz' => 'Stomatolog',
        ]);
    }

}
