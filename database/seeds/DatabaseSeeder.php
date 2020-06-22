<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {
        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeed::class);
        $this->call(SpecializationsTableSeed::class);
        $this->call(ClinicsTableSeed::class);
        $this->call(CelebrationsTableSeed::class);
        $this->call(TimetablesTableSeed::class);
        $this->call(BooksTableSeed::class);
    }

}
