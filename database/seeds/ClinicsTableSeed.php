<?php

use Illuminate\Database\Seeder;
use App\Entity\Clinic\Clinic;

class ClinicsTableSeed extends Seeder {

    public function run() {
        factory(Clinic::class, 10)->create();
    }

}
