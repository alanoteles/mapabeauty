<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusIdToPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function($table) {
            $table->dropColumn('status');
            $table->integer('status_id')->unsigned();
        });

        Schema::table('purchases', function($table) {
            $table->foreign('status_id')->references('id')->on('purchase_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function($table) {
            //$table->dropColumn('status');
            $table->integer('status_id');
        });
    }
}
