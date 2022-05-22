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
        if (!Schema::hasTable('form_required_personel'))
        {
            Schema::create('form_required_personel',function(Blueprint $table) {
                $table->id('formrequiredpersonel_id')->uniqe();
                $table->bigInteger('form_id')->unsigned();
                $table->bigInteger('userverificationdetails_id')->unsigned();
                $table->bigInteger('personelstatus_id')->unsigned();
                $table->dateTime('updatedat')->nullable();
            });

            
            Schema::table('form_required_personel', function (Blueprint $table) {
                $table->foreign('form_id')->references('form_id')->on('form');
                $table->foreign('userverificationdetails_id')->references('userverificationdetails_id')->on('user_verification_details');
                $table->foreign('personelstatus_id')->references('personelstatus_id')->on('personel_status');
            });
            
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_required_personel');
    }
};
