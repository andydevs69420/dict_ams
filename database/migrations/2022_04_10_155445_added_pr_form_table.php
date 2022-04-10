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
        if (!Schema::hasTable('prforms'))
        {
            Schema::create('prforms',function(Blueprint $table) {
                $table->id()->uniqe();
                $table->string('prnumber');
                $table->string('sainumber');
                $table->string('purpose');
                $table->bigInteger('requisitioner')->unsigned();
                $table->bigInteger('recommendingapprover')->unsigned();
            });

        }
        try
        {
            Schema::table('prforms', function(Blueprint $table) {
                $table->foreign('requisitioner')->references('id')->on('users');
                $table->foreign('recommendingapprover')->references('id')->on('users');
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
