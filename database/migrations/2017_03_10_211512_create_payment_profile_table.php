<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_profile', function (Blueprint $table) {
            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->integer('payer_id')->unsigned()->index();
            $table->foreign('payer_id')->references('id')->on('payers')->onDelete('cascade');
            $table->string('transaction_id', 250)->nullable();
            $table->double('value', 13, 2)->nullable();
            $table->string('payment_type', 250)->nullable();
            $table->datetime('payment_date')->nullable();
            $table->char('status', 1)->default('1');
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
        Schema::drop('payment_profile');
    }
}
