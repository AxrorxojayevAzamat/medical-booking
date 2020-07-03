<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaycomTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paycom_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paycom_id')->nullable();
            $table->string('paycom_transaction_id', 25);
            $table->string('paycom_time', 13);
            $table->dateTime('paycom_time_datetime');
            $table->dateTime('create_time');
            $table->dateTime('perform_time')->nullable();
            $table->dateTime('cancel_time')->nullable();
            $table->bigInteger('amount');
            $table->tinyInteger('state');
            $table->string('state_note', 500)->nullable();
            $table->tinyInteger('reason')->nullable()->default(null);
            $table->string('receivers', 500)->nullable()->comment('JSON array of receivers');
            $table->unsignedBigInteger('order_id');
        });

        Schema::table('paycom_transactions', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('paycom_orders')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paycom_transactions');
    }
}
