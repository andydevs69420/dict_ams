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

        Schema::create('pr_and_jo_tracker', function (Blueprint $table) {
            $table->id('prandjotracker_id');
            $table->bigInteger("form_id")->unsigned();
            $table->bigInteger("requester_status_id")->unsigned();
            $table->bigInteger("budget_officer_status_id")->unsigned();
            $table->bigInteger("recommending_approval_status_id")->unsigned();
        });

        Schema::table('pr_and_jo_tracker', function (Blueprint $table) {
            $table->foreign('form_id')->references('form_id')->on('form');
            $table->foreign('requester_status_id')->references('prandjotrackerstatus_id')->on('pr_and_jo_tracker_status');
            $table->foreign('budget_officer_status_id')->references('prandjotrackerstatus_id')->on('pr_and_jo_tracker_status');
            $table->foreign('recommending_approval_status_id')->references('prandjotrackerstatus_id')->on('pr_and_jo_tracker_status');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_required_personel_tracker');
    }
};
