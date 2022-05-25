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
        Schema::create('jo_item', function (Blueprint $table) {
            $table->id('joitem_id')->unique();
            $table->bigInteger('form_id')->unsigned();
        });

        Schema::table('jo_item', function (Blueprint $table) {
            $table->foreign('form_id')->references('form_id')->on('form');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jo_item');
    }
};
