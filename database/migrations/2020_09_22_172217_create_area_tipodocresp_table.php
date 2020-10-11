<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTipodocrespTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areatipodocresp', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger("area_id")->nullable();
            $table->foreign("area_id")->references("id")->on("areas");

            $table->bigInteger("tipodocresp_id")->nullable();
            $table->foreign("tipodocresp_id")->references("id")->on("tipodocresp");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_tipodocresp');
    }
}
