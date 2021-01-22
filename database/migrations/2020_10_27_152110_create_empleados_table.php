<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fechaingreso');
            $table->string('codigo');
            $table->string('nombre1');
            $table->string('nombre2')->nullable();
            $table->string('apellido1');
            $table->string('apellido2')->nullable();
            $table->string('apellido3')->nullable();
            $table->string('nombreCompleto');
            $table->string('foto');
            $table->string('direccion')->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('fechanacimiento')->nullable();
            $table->integer('idgenero');
            $table->integer('idestadocivil');
            $table->integer('idmunicipio');
            $table->boolean('estado');
            $table->string('toquen')->nullable();
            $table->string('idgrupo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
