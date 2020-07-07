<?php

use Illuminate\Database\Seeder;
use App\Entity\Region;

class RegionsTableSeeder extends Seeder {

    public function run() {
        factory(Region::class, 14)->create()->each(function(Region $region) {
            $counts = random_int(2, 11);
            $region->children()->saveMany(factory(Region::class, $counts)->make());
        });
    }

}
