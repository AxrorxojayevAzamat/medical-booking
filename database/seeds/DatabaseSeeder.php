<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(RoleSeed::class);
        $this->call(RegionSeed::class);
        $this->call(SpecializationSeed::class);
        $this->call(ClinicSeed::class);
        $this->call(UserSeed::class);
        $this->call(CelebrationSeed::class);
        $this->call(BookingSeed::class);
        $this->call(TimetableSeed::class);
    }

}
