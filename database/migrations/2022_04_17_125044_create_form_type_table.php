<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\FormType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_type', function (Blueprint $table) {
            $table->id("formtype_id");
            $table->string("formtype");
        });

        FormType::create([ "formtype" => "Purchase Request" ]);
        FormType::create([ "formtype" => "Job Order" ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_type');
    }
};
