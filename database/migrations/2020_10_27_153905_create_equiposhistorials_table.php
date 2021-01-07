<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposhistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equiposhistorials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('instante')->nullable();
            $table->integer('idequipotrabajo');
            $table->integer('idempleado');
            $table->integer('kilometraje')->nullable();
            $table->string('combustible')->nullable();
            $table->boolean('extinguidor')->nullable();
            $table->boolean('botiquin')->nullable();
            $table->boolean('equiposeguridad')->nullable();
            $table->string('observaciones')->nullable();
            $table->integer('idusuario');
            $table->double('latitud');
            $table->double('longitud');
            $table->string('uso')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equiposhistorials');
    }
}
