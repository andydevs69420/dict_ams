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
        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id')->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middleinitial');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('designation_id')->unsigned();
            $table->bigInteger('accesslevel_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('user', function (Blueprint $table) {
            $table->foreign('designation_id')->references('designation_id')->on('designation');
            $table->foreign('accesslevel_id')->references('accesslevel_id')->on('accesslevel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
