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
                $table->bigInteger('budgetofficer_id')->unsigned();
                $table->bigInteger('requisitioner_id')->unsigned();
                $table->bigInteger('recommendingapprover_id')->unsigned();
            });

            
            Schema::table('form_required_personel', function (Blueprint $table) {
                $table->foreign('budgetofficer_id')->references('userverificationdetails_id')->on('user_verification_details');
                $table->foreign('requisitioner_id')->references('userverificationdetails_id')->on('user_verification_details');
                $table->foreign('recommendingapprover_id')->references('userverificationdetails_id')->on('user_verification_details');
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
