<?php

use Illuminate\Database\Seeder;
use App\Entity\Clinic\Timetable;

class TimetablesTableSeed extends Seeder {

    public function run() {
        factory(Timetable::class, 1)->create();
    }

}
