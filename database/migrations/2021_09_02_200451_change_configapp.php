<?php

use App\Models\config\configapp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeConfigapp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('configapp');
        Schema::create('configapps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("version",10);
        });
        $configapp = new configapp();
        $configapp->version = '1.0';
        $configapp->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('configapps');
        Schema::create('configapp', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("version",10);
        });
    }
}
