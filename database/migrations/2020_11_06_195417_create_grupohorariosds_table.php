<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupohorariosdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupohorariosds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idgrupohorario');
            $table->integer('iddia');
            $table->time('horainicio');
            $table->time('horafin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupohorariosds');
    }
}
