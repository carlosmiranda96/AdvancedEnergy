<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add1EmpleadoEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('empleado_empresas',function(Blueprint $table){
            $table->dropColumn('idubicacion');
            $table->integer('idempresa')->nullable()->after('idcargo');
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
        Schema::table('empleado_empresas',function(Blueprint $table){
            $table->dropColumn('idempresa');
            $table->integer('idubicacion')->nullable()->after('idcargo');
        });
    }
}
