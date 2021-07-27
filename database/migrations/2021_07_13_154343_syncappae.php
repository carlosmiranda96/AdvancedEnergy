<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Syncappae extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syncappaes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('key');
            $table->date('fecha');
            $table->time('hora');
            $table->string('descripcion',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syncappaes');
    }
}
