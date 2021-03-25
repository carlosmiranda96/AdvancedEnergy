<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudempleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudempleos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nombre");
            $table->string("apellido");
            $table->string("dui");
            $table->string("fechanacimiento");
            $table->string("direccionactual");
            $table->string("telefono");
            $table->string("celular");
            $table->string("email");
            $table->string("aspiracionsalarial")->nullable();
            $table->string("educacion")->nullable();
            $table->string("puesto")->nullable();
            $table->string("Eempresa")->nullable();
            $table->string("Ecargo")->nullable();
            $table->date("Efechainicio")->nullable();
            $table->string("Esalario")->nullable();
            $table->longText("Eresponsabilidades")->nullable();
            $table->string("Etrabajoactual")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudempleos');
    }
}
