<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistrespTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklistresp', function (Blueprint $table) {
            $table->id();

            $table->string('anexado');
            $table->string('nomeDoc');

            $table->bigInteger("areas_id")->nullable();
            $table->foreign("areas_id")->references("id")->on("areas");

            $table->bigInteger("tipodocres_id")->nullable();
            $table->foreign("tipodocres_id")->references("id")->on("tipodocresp");

            $table->bigInteger("resptecnicos_id")->nullable();
            $table->foreign("resptecnicos_id")->references("id")->on("resptecnicos");

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
        Schema::dropIfExists('checklistresp');
    }
}
