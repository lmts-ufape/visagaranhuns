<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspecRequerimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspec_requerimento', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("inspecoes_id")->nullable();
            $table->foreign("inspecoes_id")->references("id")->on("inspecoes");

            $table->bigInteger("requerimentos_id")->nullable();
            $table->foreign("requerimentos_id")->references("id")->on("requerimentos");

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
        Schema::dropIfExists('inspec_requerimento');
    }
}
