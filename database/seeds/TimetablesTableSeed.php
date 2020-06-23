<?php

use Illuminate\Database\Seeder;
use App\Entity\Clinic\Timetable;
use App\Entity\Clinic\DoctorClinic;

class TimetablesTableSeed extends Seeder {

    public function run() {
        factory(Timetable::class, 1)->create();
        
//        factory(Timetable::class, 14)->create()->each(function(Timetable $timetable) {
////            $counts = [0, random_int(10, 11)];
//            $doctorClinics = DoctorClinic::pluck('id')->toArray();
//                        $timetable->children()->saveMany(factory(Region::class, $counts[array_rand($counts)])->create());
//        });
    }

}
