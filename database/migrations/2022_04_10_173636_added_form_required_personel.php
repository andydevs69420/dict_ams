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
        if (!Schema::hasTable('form_required_personels'))
        {
            Schema::create('form_required_personels',function(Blueprint $table) {
                $table->id()->uniqe();
                $table->bigInteger('budgetofficer')->unsigned();
                $table->bigInteger('requisitioner')->unsigned();
                $table->bigInteger('recommendingapprover')->unsigned();
            });

            try
            {
                Schema::table('form_required_personels', function(Blueprint $table) {
                    $table->foreign('budgetofficer')->references('id')->on('users');
                    $table->foreign('requisitioner')->references('id')->on('users');
                    $table->foreign('recommendingapprover')->references('id')->on('users');
                });
            }catch(Exception $err)
            { /* on duplicate */ }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
