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
        Schema::create("user_profile_images", function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_verification_details_id")->unsigned();
            $table->string("path");
        });

        Schema::table("user_profile_images", function (Blueprint $table) {
            $table->foreign("user_verification_details_id")->references("userverificationdetails_id")->on("user_verification_details");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_profile_images");
    }
};
