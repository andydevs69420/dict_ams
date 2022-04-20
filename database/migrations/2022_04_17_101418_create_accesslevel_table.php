<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Accesslevel;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('accesslevel', function(Blueprint $table) {
            $table->id('accesslevel_id')->unique();
            $table->string('accesslevel');
        });

        $accesslevels = [
            'Regional director',
            'Assistan Regional Director',
            'Chief Admin Officer',
            'Provincial Officer',
            'Focal',
            'Inspector',
            'BAC Member',
            'BAC Chair',
            'Canvasser',
            'Supply Officer',
            'Budget Officer',
            'Chief TOD',
            'Staff',
            'Admin'
        ];

        foreach ($accesslevels as $als)
        {
            Accesslevel::create([
                'accesslevel' => $als,
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
        //
        Schema::dropIfExists('accesslevel');
    }
};
