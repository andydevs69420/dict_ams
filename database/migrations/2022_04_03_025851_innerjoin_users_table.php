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
        try
        {
            Schema::table('users', function(Blueprint $table) {
                $table->foreign('designation')->references('id')->on('designations');
                $table->foreign('accesslevel')->references('id')->on('accesslevels');
            });
        }catch(Exception $err)
        { /* on duplicate */ }
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
