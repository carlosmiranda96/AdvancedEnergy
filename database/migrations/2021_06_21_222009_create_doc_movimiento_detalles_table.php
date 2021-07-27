<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocMovimientoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_movimiento_detalles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idProyecto');
            $table->integer('idBodega');
            $table->integer('idBodegaUbicacion');
            $table->integer('cantidad');
            $table->integer('idProducto');
            $table->string('descripcion',175);
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
        Schema::dropIfExists('doc_movimiento_detalles');
    }
}
