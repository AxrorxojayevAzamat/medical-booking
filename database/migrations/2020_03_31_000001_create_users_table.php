<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('verify_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role');
            $table->tinyInteger('status')->nullable();
            $table->string('password');
            $table->integer('rate')->default('0');
            $table->integer('num_of_rates')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
