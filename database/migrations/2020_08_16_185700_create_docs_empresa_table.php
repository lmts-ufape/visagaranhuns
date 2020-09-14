<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocsEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docs_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('data_validade')->nullable();

            $table->bigInteger("empresa_id");
            $table->foreign("empresa_id")->references("id")->on("empresas");

            $table->bigInteger("tipodocemp_id");
            $table->foreign("tipodocemp_id")->references("id")->on("tipodocemp");
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
        Schema::dropIfExists('docs_empresa');
    }
}
