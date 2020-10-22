<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspecAgenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspec_agente', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("inspecoes_id")->nullable();
            $table->foreign("inspecoes_id")->references("id")->on("inspecoes");

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
        Schema::dropIfExists('inspec_agente');
    }
}
