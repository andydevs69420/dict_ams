<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\VerificationStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_status', function (Blueprint $table) {
            $table->id('verificationstatus_id')->unique();
            $table->string('verificationstatus');
        });

        $verificationstats = [
            'Pending',
            'Accepted',
            'Declined'
        ];

        foreach ($verificationstats as $vs)
        {
            VerificationStatus::create([
                'verificationstatus' => $vs,
            ]);
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verification_status');
    }
};
