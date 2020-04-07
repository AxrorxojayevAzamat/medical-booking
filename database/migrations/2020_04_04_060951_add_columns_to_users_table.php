<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->renameColumn('name', 'name_uz');
            $table->renameColumn('lastname', 'lastname_uz');
            $table->renameColumn('patronymic', 'patronymic_uz');

            $table->date('birth_date')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('role')->after('patronymic_uz')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->text('about_uz')->nullable();
            $table->text('about_ru')->nullable();

            $table->string('name_ru')->after('name_uz')->nullable();
            $table->string('lastname_ru')->after('lastname_uz')->nullable();
            $table->string('patronymic_ru')->after('patronymic_uz')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name_ru');
            $table->dropColumn('lastname_ru');
            $table->dropColumn('patronymic_ru');
        });
    }
}
