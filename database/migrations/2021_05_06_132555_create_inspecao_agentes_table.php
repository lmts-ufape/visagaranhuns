<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspecaoAgentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspecao_agentes', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("inspecao_id");
            $table->foreign("inspecao_id")->references("id")->on("inspecoes");

            $table->bigInteger("agente_id");
            $table->foreign("agente_id")->references("id")->on("agente");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspecao_agentes');
    }
}
