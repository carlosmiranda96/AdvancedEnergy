<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados',function(Blueprint $table){
            $table->integer('idempresa')->default('0');
            $table->integer('idcargo')->default('0');
            $table->float('salario')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleados',function(Blueprint $table){
            $table->dropColumn('idempresa');
            $table->dropColumn('idcargo');
            $table->dropColumn('salario');
        });
    }
}
