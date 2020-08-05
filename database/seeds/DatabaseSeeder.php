<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {
        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(ClinicsTableSeeder::class);
        $this->call(CelebrationsTableSeeder::class);
        $this->call(DoctorSpecializationsTableSeeder::class);
        $this->call(DoctorClinicsTableSeeder::class);
        $this->call(TimetablesTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(AdminClinicsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ClinicServicesTableSeeder::class);
    }

}
