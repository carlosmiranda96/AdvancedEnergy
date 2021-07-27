<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_documentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipo',10);
            $table->string('tipoMovimiento',10);
            $table->integer('correlativo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_documentos');
    }
}
