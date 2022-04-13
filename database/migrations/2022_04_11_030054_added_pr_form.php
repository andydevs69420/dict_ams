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
        if (!Schema::hasTable('pr_form'))
        {
            Schema::create('pr_form',function(Blueprint $table) {
                $table->id()->uniqe();
                $table->bigInteger('form')->unsigned();
                $table->integer('stockno');
                $table->string('itemscription');
                $table->integer('quantity');
                $table->double('unitcost', 11, 2);
                $table->double('totalcost', 11, 2);
            });

            try
            {
                Schema::table('pr_form', function(Blueprint $table) {
                    $table->foreign('form')->references('id')->on('forms');
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
