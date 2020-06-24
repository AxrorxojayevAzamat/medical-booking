<?php

use Illuminate\Database\Seeder;
use App\Entity\Celebration;

class CelebrationsTableSeed extends Seeder
{
    public function run()
    {
        factory(Celebration::class, 10)->create();
    }
}
