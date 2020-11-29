<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            // $table->string('nome');
            // $table->string('email')->nullable();
            // $table->string('telefone')->nullable(); 
            $table->string('empresa');
            $table->string('endereco');
            $table->longText('denuncia');
            $table->string('status');
            
            // $table->bigInteger("empresa_id")->nullable();
            // $table->foreign("empresa_id")->references("id")->on("empresas");
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
        Schema::dropIfExists('denuncias');
    }
}
