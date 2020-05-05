<?php

use Illuminate\Database\Seeder;
use App\Region;
class RegionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tashkentregion = Region::create([
            'name_ru' => 'Ташкентская область',
            'name_uz' => 'Tashkent viloyati',
            'parent_id' => null,

        ]);

        $tashkent = Region::create([
            'name_ru' => 'Ташкент',
            'name_uz' => 'Tashkent',
            'parent_id' => '1',

        ]);
        $chilonzor = Region::create([
            'name_ru' => 'Чиланзар',
            'name_uz' => 'Chilanzor',
            'parent_id' => '2',

        ]);

        $yunusobad = Region::create([
            'name_ru' => 'Юнусабад',
            'name_uz' => 'Yunusabad',
            'parent_id' => '2',

        ]);
    }
}
