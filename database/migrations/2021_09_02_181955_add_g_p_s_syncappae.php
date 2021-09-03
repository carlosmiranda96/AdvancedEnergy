<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGPSSyncappae extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('syncappaes',function(Blueprint $table){
            $table->float('latitud')->nullable();
            $table->float('longitud')->nullable();
            $table->string('dispositivo')->nullable()->after('key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('syncappaes',function(Blueprint $table){
            $table->dropColumn('latitud');
            $table->dropColumn('longitud');
            $table->dropColumn('dispositivo');
        });
    }
}
