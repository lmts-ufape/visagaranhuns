<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspecoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspecoes', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('status');

            $table->bigInteger("inspetor_id")->nullable();
            $table->foreign("inspetor_id")->references("id")->on("inspetor");

            $table->bigInteger("requerimento_id")->nullable();
            $table->foreign("requerimento_id")->references("id")->on("requerimentos");

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
        Schema::dropIfExists('inspecoes');
    }
}
