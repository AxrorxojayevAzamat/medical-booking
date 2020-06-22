<?php

use Illuminate\Database\Seeder;
use App\Entity\Clinic\Specialization;

class SpecializationsTableSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        factory(Specialization::class, 10)->create();
    }

}
