<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_clinics', function (Blueprint $table) {
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('clinic_id');
        });
        
        Schema::table('admin_clinics', function (Blueprint $table) {
            $table->primary(['admin_id', 'clinic_id']);
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_clinics');
    }
}