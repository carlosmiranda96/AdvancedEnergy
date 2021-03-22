<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorizacionusuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizacionusuarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idusuario');
            $table->integer('idpermiso');
            $table->boolean('ver');
            $table->boolean('crear');
            $table->boolean('editar');
            $table->boolean('eliminar');
            $table->boolean('excel');
            $table->boolean('pdf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autorizacionusuarios');
    }
}
