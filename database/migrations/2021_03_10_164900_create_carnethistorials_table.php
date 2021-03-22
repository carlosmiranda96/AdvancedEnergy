<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarnethistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carnethistorials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date("fecha");
            $table->time("hora");
            $table->integer("idcarnet");
            $table->integer("idempleado");
            $table->integer("idusuario");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carnethistorials');
    }
}
