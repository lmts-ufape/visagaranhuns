<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtempresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rtempresa', function (Blueprint $table) {
            $table->id();

            $table->integer('horas');
            $table->date('data_inicio');
            $table->string('status');

            $table->bigInteger("empresa_id")->nullable();
            $table->foreign("empresa_id")->references("id")->on("empresas");

            $table->bigInteger("resptec_id")->nullable();
            $table->foreign("resptec_id")->references("id")->on("resptecnicos");

            $table->bigInteger("area_id")->nullable();
            $table->foreign("area_id")->references("id")->on("areas");
            
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
        Schema::dropIfExists('rtempresa');
    }
}
