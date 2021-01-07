<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_documentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idempleado');
            $table->integer('idtipodocumento');
            $table->string('numerodocumento',40);
            $table->date('fechaexpedicion')->nullable();
            $table->date('fechavencimiento')->nullable();
            $table->date('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_documentos');
    }
}
