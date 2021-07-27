<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_movimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->time('hora');
            $table->integer('correlativo');
            $table->string('tipo',10);
            $table->string('noReferencia',75);
            $table->boolean('procesado');
            $table->integer('idusuario');
            $table->string('solicita',100);
            $table->string('comentario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_movimientos');
    }
}
