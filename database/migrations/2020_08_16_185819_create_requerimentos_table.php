<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimentos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');

            $table->bigInteger("cnae_id")->nullable();
            $table->foreign("cnae_id")->references("id")->on("cnaes");

            $table->date('data');

            $table->bigInteger("resptecnicos_id")->nullable();
            $table->foreign("resptecnicos_id")->references("id")->on("resptecnicos");

            $table->bigInteger("empresas_id")->nullable();
            $table->foreign("empresas_id")->references("id")->on("empresas");

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
        Schema::dropIfExists('requerimentos');
    }
}
