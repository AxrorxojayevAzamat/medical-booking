
<?php

use App\Entity\Clinic\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Service::class, 15)->create();
    }
}
