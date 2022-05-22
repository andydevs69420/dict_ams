<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\PersonelStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("personel_status", function (Blueprint $table) {
            $table->id("personelstatus_id");
            $table->string("personelstatus");
        });

        PersonelStatus::create([
            "personelstatus" => "signitured",
        ]);

        PersonelStatus::create([
            "personelstatus" => "unsignitured",
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("personel_status");
    }
};
