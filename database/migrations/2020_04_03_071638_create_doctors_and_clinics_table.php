<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsAndClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors_and_clinics', function (Blueprint $table) {
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('clinic_id');
        });
        
        Schema::table('doctors_and_clinics', function (Blueprint $table) {
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors_and_clinics');
    }
}
