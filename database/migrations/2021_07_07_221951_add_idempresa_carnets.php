<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdempresaCarnets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carnets',function(Blueprint $table){
            $table->integer('idempresa')->nullable()->after('fechavencimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carnets',function(Blueprint $table){
            $table->dropColumn('idempresa');
        });
    }
}
