<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatorioAgentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_agentes', function (Blueprint $table) {
            $table->id();

            $table->string("aprovacao")->default('Não analisado');

            $table->bigInteger("relatorio_id")->nullable();
            $table->foreign("relatorio_id")->references("id")->on("inspecao_relatorios");

            $table->bigInteger("agente_id")->nullable();
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
        Schema::dropIfExists('relatorio_agentes');
    }
}
