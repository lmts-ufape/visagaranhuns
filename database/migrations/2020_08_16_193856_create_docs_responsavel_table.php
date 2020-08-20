<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocsResponsavelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs_responsavel', function (Blueprint $table) {
            $table->id();
            $table->string('nome');

            $table->bigInteger("resptecnicos_id")->nullable();
            $table->foreign("resptecnicos_id")->references("id")->on("resptecnicos");

            // Chave estrangeira para o tipo de documento do responsável técnico
            $table->bigInteger("tipodocresp_id")->nullable();
            $table->foreign("tipodocresp_id")->references("id")->on("tipodocresp");
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
        Schema::dropIfExists('docs_responsavel');
    }
}
