<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspecaoRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspecao_relatorios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->longText("relatorio");

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
        Schema::dropIfExists('inspecao_relatorios');
    }
}
