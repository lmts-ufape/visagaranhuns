<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnaesEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnaes_empresas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("empresa_id")->nullable();
            $table->foreign("empresa_id")->references("id")->on("empresas");

            $table->bigInteger("cnae_id")->nullable();
            $table->foreign("cnae_id")->references("id")->on("cnaes");
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
        Schema::dropIfExists('cnaes_empresas');
    }
}
