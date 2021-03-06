<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklistemp', function (Blueprint $table) {
            $table->id();
            $table->string('anexado');
            $table->string('nomeDoc');
            $table->bigInteger('num_cnae'); //Numero de cnaes associado a uma area

            $table->bigInteger("areas_id")->nullable();
            $table->foreign("areas_id")->references("id")->on("areas");

            $table->bigInteger("tipodocemp_id")->nullable();
            $table->foreign("tipodocemp_id")->references("id")->on("tipodocemp");

            $table->bigInteger("empresa_id")->nullable();
            $table->foreign("empresa_id")->references("id")->on("empresas");
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
        Schema::dropIfExists('checklistemp');
    }
}
