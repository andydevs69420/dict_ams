<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verification_details', function (Blueprint $table) {
            $table->id('userverificationdetails_id')->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('verificationstatus_id')->unsigned();
        });

        Schema::table('user_verification_details', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('verificationstatus_id')->references('verificationstatus_id')->on('verification_status');
        }); 

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verification_details');
    }
};
