<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspetorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspetor', function (Blueprint $table) {
            $table->id();
            $table->string('formacao');
            $table->string('especializacao')->nullable();
            $table->string('cpf');
            $table->string('telefone');

            $table->bigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");
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
        Schema::dropIfExists('inspetor');
    }
}
