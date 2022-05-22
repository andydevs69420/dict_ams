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
        Schema::create("form", function (Blueprint $table) {
            $table->id("form_id")->unique();
            $table->bigInteger("formtype_id")->unsigned();
            $table->date("createdat");
            $table->string("prnumber");
            $table->string("sainumber");
            $table->string("purpose");
            $table->string("fileembedded");
        });

        Schema::table("form", function (Blueprint $table) {
            $table->foreign("formtype_id")->references("formtype_id")->on("form_type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("form");
    }
};
