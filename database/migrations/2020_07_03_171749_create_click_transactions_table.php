<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClickTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_id');
            $table->string('merchant_transaction_id');
            $table->unsignedBigInteger('click_transaction_id')->nullable();
            $table->unsignedBigInteger('click_paydoc_id')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->tinyInteger('type');
            $table->string('token', 50);
            $table->string('card_token', 50)->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('sign_time')->nullable();
            $table->tinyInteger('status');
            $table->string('status_note');
            $table->text('note');
            $table->bigInteger('created_at');
        });

        Schema::table('click_transactions', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')->on('books')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('click_transactions');
    }
}
