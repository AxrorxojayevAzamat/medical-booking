<?php

use Illuminate\Database\Seeder;
use App\Entity\Region;

class RegionsTableSeed extends Seeder {

    public function run() {
        factory(Region::class, 14)->create()->each(function(Region $region) {
            $counts = [0, random_int(10, 11)];
                        $region->children()->saveMany(factory(Region::class, $counts[array_rand($counts)])->create());
        });
    }

}
