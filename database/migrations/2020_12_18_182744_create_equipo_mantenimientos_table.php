<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idequipo');
            $table->date('fecha');
            $table->integer('kilometraje');
            $table->integer('pkMantenimiento');
            $table->date('pfMantenimiento');
            $table->string('descripcion');
            $table->double('monto');
            $table->string('tipomantenimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipo_mantenimientos');
    }
}
