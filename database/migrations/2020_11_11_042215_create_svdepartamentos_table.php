<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSvdepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('svdepartamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo',2);
            $table->string('departamento',20);
            $table->integer('idpais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('svdepartamentos');
    }
}
