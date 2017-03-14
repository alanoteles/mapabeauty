<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->char('professional_type', 1);
            $table->string('professional_name', 250);
            $table->string('fantasy_name', 250);
            $table->string('document', 14);
            $table->string('responsible_name', 250);
            $table->string('responsible_email', 250);
            $table->string('responsible_cellphone', 10);
            $table->string('zip_code', 10);
            $table->char('state', 2);
            $table->integer('city');
            $table->string('neighborhood', 250);
            $table->string('address', 250);
            $table->string('number', 10);
            $table->string('complement', 250)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->text('about');
            $table->string('facebook', 250)->nullable();
            $table->string('twitter', 250)->nullable();
            $table->string('instagram', 250)->nullable();
            $table->string('youtube', 250)->nullable();
            $table->string('google_plus', 250)->nullable();
            $table->string('logo', 250)->nullable();
            $table->char('status', 1)->default('1');
            $table->timestamps();
        });

        Schema::table('profiles', function($table) {
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('profile', function (Blueprint $table) {
//            //
//        });

        Schema::drop('profiles');
    }
}
