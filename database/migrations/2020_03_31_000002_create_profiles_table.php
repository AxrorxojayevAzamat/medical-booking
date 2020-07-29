<?php

use App\Entity\User\Profile;
use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->text('about_uz')->nullable();
            $table->text('about_ru')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('rate')->default('0');
            $table->integer('num_of_rates')->default('0');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        DB::table('users')->insert([
            'phone' => '991234561',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now()->addSeconds(300),
            'password' => bcrypt('1q2w3e4r5t'),
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_ADMIN,
        ]);

        DB::table('profiles')->insert([
            'user_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Adminov',
            'middle_name' => 'Adminovich',
            'birth_date' => '1988-04-21 00:00:00',
            'gender' => Profile::MALE,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
