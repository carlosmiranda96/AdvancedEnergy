<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formuas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->string('nombrecompleto',100);
            $table->string('dui',20)->nullable();
            $table->integer('idgenero');
            $table->string('empresa',50);
            $table->string('otraempresa',50)->nullable();
            $table->string('proyecto',100)->nullable();
            $table->float('temperatura')->nullable();
            $table->text('comentarios')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formuas');
    }
}
