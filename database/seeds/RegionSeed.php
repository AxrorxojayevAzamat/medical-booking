<?php

use Illuminate\Database\Seeder;
use App\Region;
use Illuminate\Support\Facades\DB;

class RegionSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('regions')->insert(array(
            0 => array(
                'name_ru' => 'Город Ташкент',
                'name_uz' => 'Tashkent shahri',
                'parent_id' => null,
                'created_at' => now(),
            ),
            1 => array(
                'name_ru' => 'Андижанская область',
                'name_uz' => 'Andijon viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            2 => array(
                'name_ru' => 'Бухарская область',
                'name_uz' => 'Buxoro viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            3 => array(
                'name_ru' => 'Ферганская область',
                'name_uz' => 'Farg\'ona viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            4 => array(
                'name_ru' => 'Джизакская область',
                'name_uz' => 'Jizzax viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            5 => array(
                'name_ru' => 'Наманганская область',
                'name_uz' => 'Namangan viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            6 => array(
                'name_ru' => 'Навоийская область',
                'name_uz' => 'Navoiy viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            7 => array(
                'name_ru' => 'Кашкадарьинская область',
                'name_uz' => 'Qashqadaryo viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            8 => array(
                'name_ru' => 'Самаркандская область',
                'name_uz' => 'Samarqand viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            9 => array(
                'name_ru' => 'Сырдарьинская область',
                'name_uz' => 'Sirdaryo viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            10 => array(
                'name_ru' => 'Сурхандарьинская область',
                'name_uz' => 'Suxondaryo viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            11 => array(
                'name_ru' => 'Ташкентская область',
                'name_uz' => 'Tashkent viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            12 => array(
                'name_ru' => 'Хорезмская область',
                'name_uz' => 'Xorazm viloyati',
                'parent_id' => null,
                'created_at' => now(),
            ),
            13 => array(
                'name_ru' => 'Республика Каракалпакстан',
                'name_uz' => 'Qoraqalpog\'iston Respublikasi',
                'parent_id' => null,
                'created_at' => now(),
            ),
            14 => array(
                'name_ru' => 'Бектемирский район',
                'name_uz' => 'Bektemir tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            15 => array(
                'name_ru' => 'Чиланзарский район',
                'name_uz' => 'Chilanzor tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            16 => array(
                'name_ru' => 'Яшнабодский район',
                'name_uz' => 'Yashnobod tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            17 => array(
                'name_ru' => 'Мирабодский район',
                'name_uz' => 'Mirobod tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            18 => array(
                'name_ru' => 'Мирзо Улугбекский район',
                'name_uz' => 'Mirzo Ulug\'bek tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            19 => array(
                'name_ru' => 'Сергелийский район',
                'name_uz' => 'Sergeli tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            20 => array(
                'name_ru' => 'Шайхантахурский район',
                'name_uz' => 'Shayxontohur tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            21 => array(
                'name_ru' => 'Алмазарский район',
                'name_uz' => 'Olmazor tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            22 => array(
                'name_ru' => 'Учтепинский район',
                'name_uz' => 'Uchtepa tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            23 => array(
                'name_ru' => 'Яккасарайский район',
                'name_uz' => 'Yakkasaroy tumani',
                'parent_id' => '1',
                'created_at' => now(),
            ),
            24 => array(
                'name_ru' => 'Юнусабадский район',
                'name_uz' => 'Yunusabad tumani',
                'parent_id' => '1',
                'created_at' => now(),
            )
        ));
    }

}
