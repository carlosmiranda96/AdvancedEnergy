<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdreferenciaMarcacionEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('marcacionesempleados',function(Blueprint $table){
            $table->integer('idreferencia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('marcacionesempleados',function(Blueprint $table){
            $table->dropColumn('idreferencia');
        });
    }
}
