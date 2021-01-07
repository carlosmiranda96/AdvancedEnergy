<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcacionesempleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcacionesempleados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idempleado');
            $table->integer('idusuario');
            $table->string('tipo',15);
            $table->date('fecha')->nullable();
            $table->time('instante')->nullable();
            $table->string('observaciones')->nullable();
            $table->integer("idubicacion");
            $table->double('latitud');
            $table->double('longitud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcacionesempleados');
    }
}
