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

        $dentist = Specialization::create([
            'name_ru' => 'Стоматолог',
            'name_uz' => 'Stomatolog',
        ]);

        $surgeaon = Specialization::create([
            'name_ru' => 'Хирург',
            'name_uz' => 'Jarroh',
        ]);

        $therapeutic = Specialization::create([
                    'name_ru' => 'Терапевт',
                    'name_uz' => 'Terapevt',
        ]);

        $immunologist = Specialization::create([
                    'name_ru' => 'Иммунолог',
                    'name_uz' => 'Immunolog',
        ]);
    }

}
