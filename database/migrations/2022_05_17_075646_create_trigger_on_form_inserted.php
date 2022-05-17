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
            By default ang requisitioner is 1(SIGNATURED) kay e check man niya tong checkbox
        
            pr_and_jo_tracker_status (refer sa table):
                1 := SIGNATURED
                2 := UNSIGNATURED
        */
        DB::unprepared('
            CREATE TRIGGER on_form_inserted AFTER INSERT ON `form` FOR EACH ROW
                BEGIN
                    INSERT INTO pr_and_jo_tracker (
                        form_id, 
                        requester_status_id, 
                        budget_officer_status_id, 
                        recommending_approval_status_id
                    ) VALUES (
                        NEW.form_id,
                        1,
                        2,
                        2
                    );
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
        DB::unprepared('DROP TRIGGER `on_form_inserted`');
    }
};
