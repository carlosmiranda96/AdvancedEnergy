<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHerramientasToEquiposhistorials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equiposhistorials', function (Blueprint $table) {
            $table->string("herramienta")->nullable();
            $table->dropColumn("extinguidor");
            $table->dropColumn("botiquin");
            $table->dropColumn("equiposeguridad");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equiposhistorials', function (Blueprint $table) {
            $table->dropColumn("herramienta");
            $table->string("extinguidor")->nullable()->after('combustible');
            $table->string("botiquin")->nullable()->after('extinguidor');
            $table->string("equiposeguridad")->nullable()->after('botiquin');
        });
    }
}
