<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\UserVerificationDetails;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            DEFAULT ADMIN ACCOUNT:
                ...
        */
        $admin = User::create([
            'username'       => 'dict.ams.admin',
            'email'          => 'dict.ams.admin@dict.gov.ph',
            'firstname'      => 'Philipp Andrew',
            'lastname'       => 'Redondo',
            'middleinitial'  => 'R',
            'designation_id' => '4',
            'accesslevel_id' => '14',
            'password'       => Hash::make('dict.admin')
        ]);

        // make default account as accepted
        UserVerificationDetails::where('user_id', '=', $admin->user_id)
                                ->update(['verificationstatus_id' => 2]);

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
