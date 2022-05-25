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
        /*
            Kung ang access level sa new user is dili 4(PO), 5(FOCAL), or 13(STAFF), 
            need pa siya e verify ni admin.

            verification_status_id (refer sa table):
                1 := PENDING
                2 := ACCEPTED
                3 := DECLINED
        */
        DB::unprepared('
            CREATE TRIGGER on_user_inserted AFTER INSERT ON `user` FOR EACH ROW
                BEGIN
                    INSERT INTO user_verification_details (`user_id`, `verificationstatus_id`) 
                    VALUES (NEW.user_id, IF(NEW.accesslevel_id NOT IN (4, 5, 13), 1, 2));
                    INSERT INTO user_profile_images (`user_verification_details_id`, `path`)
                    VALUES (NEW.user_id, "images/no-image.png");
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
        DB::unprepared('DROP TRIGGER `on_user_inserted`');
    }
};
