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
        if (!Schema::hasTable('forms'))
        {
            Schema::create('forms',function(Blueprint $table) {
                $table->id()->uniqe();
                $table->string('prnumber');
                $table->string('sainumber');
                $table->string('purpose');
                $table->bigInteger('formrequiredpersonel')->unsigned();
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
