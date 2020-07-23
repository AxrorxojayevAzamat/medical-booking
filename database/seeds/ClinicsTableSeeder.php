<?php

use App\Entity\Clinic\Contact;
use Illuminate\Database\Seeder;
use App\Entity\Clinic\Clinic;

class ClinicsTableSeeder extends Seeder {

    public function run() {
        factory(Clinic::class, 10)->create()->each(function (Clinic $clinic) {
            $clinic->contacts()->saveMany(factory(Contact::class, rand(2, 6))->make());
        });
    }

}
