<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_uz');
            $table->string('name_ru');
            $table->tinyInteger('region_id');
            $table->tinyInteger('type')->nullable();
            $table->string('description_uz')->nullable();
            $table->string('description_ru')->nullable();
            $table->string('phone_numbers')->nullable();
            $table->string('adress_uz')->nullable();
            $table->string('adress_ru')->nullable();
            $table->string('work_time_start')->nullable();
            $table->string('work_time_end')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
        Schema::table('clinics', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
