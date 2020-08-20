<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnaesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cnaes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('descricao');
            
            $table->bigInteger("areas_id")->nullable();
            $table->foreign("areas_id")->references("id")->on("areas");
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
        Schema::dropIfExists('cnaes');
    }
}
