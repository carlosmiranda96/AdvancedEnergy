<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSvmunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('svmunicipios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo',4);
            $table->string('municipio',40);
            $table->integer('iddepartamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('svmunicipios');
    }
}
