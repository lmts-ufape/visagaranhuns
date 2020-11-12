<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspecaoFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspecao_fotos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("descricao");
            $table->string("imagemInspecao");
            $table->bigInteger("orientation");

            $table->bigInteger("inspecao_id")->nullable();
            $table->foreign("inspecao_id")->references("id")->on("inspecoes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspecao_fotos');
    }
}
