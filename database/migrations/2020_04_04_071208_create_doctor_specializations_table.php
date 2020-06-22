<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorSpecializationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_specializations', function (Blueprint $table) {
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('specialization_id');
        });

        Schema::table('doctor_specializations', function (Blueprint $table) {
            $table->primary(['doctor_id', 'specialization_id']);
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_specializations');
    }
}
