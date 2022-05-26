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
        DB::unprepared('
            CREATE TRIGGER on_verified_user_deleted BEFORE DELETE ON `user_verification_details` FOR EACH ROW
            BEGIN
                DELETE FROM user_profile_images WHERE userverificationdetails_id = old.userverificationdetails_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `on_verified_user_deleted`');
    }
};
