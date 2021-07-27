<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->time('hora');
            $table->string('tipo',25);
            $table->string('noReferencia',25);
            $table->string('concepto');
            $table->integer('idBodegaUbicacion');
            $table->integer('idProducto');
            $table->integer('entrada');
            $table->integer('salida');
            $table->integer('existencia');
            $table->float('debe');
            $table->float('haber');
            $table->float('saldo');
            $table->integer('idDocumento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kardexes');
    }
}
