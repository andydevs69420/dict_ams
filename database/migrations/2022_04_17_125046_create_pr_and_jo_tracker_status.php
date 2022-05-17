<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\PrAndJoTrackerStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_and_jo_tracker_status', function (Blueprint $table) {
            $table->id('prandjotrackerstatus_id');
            $table->string("prandjotrackerstatus");
        });

        PrAndJoTrackerStatus::create([
            'prandjotrackerstatus' => "signitured",
        ]);

        PrAndJoTrackerStatus::create([
            'prandjotrackerstatus' => "unsignitured",
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_required_personel_tracker_status');
    }
};
