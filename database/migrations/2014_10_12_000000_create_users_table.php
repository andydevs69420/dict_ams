<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id()->unique();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middleinitial');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->enum('designation', [
            //     1,2,3,4,5,6,7,8,9
            // ]);
            $table->bigInteger('designation')->unsigned();
            // $table->enum('accesslevel', [
            //     1,2,3,4,5,6,7,8,9,10,11,12
            // ]);
            $table->bigInteger('accesslevel')->unsigned();
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
