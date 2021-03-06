<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDocresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabela do tipo do documento do Responsável Técnico
        Schema::create('tipodocresp', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            // $table->string('descricao');
            $table->string('validade');
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
        Schema::dropIfExists('tipodocresp');
    }
}
