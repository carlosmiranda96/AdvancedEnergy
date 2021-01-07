<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_empresas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idempleado');
            $table->integer('idcargo');
            $table->integer('idubicacion');
            $table->integer('idgrupohorario');
            $table->integer('salario')->nullable();
            $table->boolean('horasextras')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_empresas');
    }
}
