<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Designation;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('designations'))
        {
            Schema::create('designations',function(Blueprint $table) {
                $table->id()->uniqe();
                $table->string('designation');
            });

            $desinations = [
                'ITO 1',
                'ITO 2',
                'ENGINEER 1',
                'ENGINEER 2',
                'ISA 1',
                'PDO 1',
                'Regional Director',
                'Assistan Regional Director',
                'Chief Admin',
            ];

            foreach ($desinations as $d)
            {
                Designation::create([
                    'designation' => $d
                ]);
            }

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
