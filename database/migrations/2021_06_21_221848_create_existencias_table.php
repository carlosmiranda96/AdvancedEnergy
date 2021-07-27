<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idProducto');
            $table->integer('idBodega');
            $table->integer('idBodegaUbicacion');
            $table->integer('existencia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('existencias');
    }
}
