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
                $table->id('prform_id')->uniqe();
                $table->bigInteger('form_id')->unsigned();
                $table->integer('stockno');
                $table->string('unit');
                $table->string('item');
                $table->integer('quantity');
                $table->double('unitcost', 11, 2);
                $table->double('totalcost', 11, 2);
            });

            Schema::table('pr_form', function (Blueprint $table) {
                $table->foreign('form_id')->references('form_id')->on('form');
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
        //
    }
};


Schema::dropIfExists('pr_form');