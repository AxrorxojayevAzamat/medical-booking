<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name_uz');
            $table->string('name_ru');
            $table->timestamps();
        });
        Schema::table('regions', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('regions')->onDelete('restrict');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
