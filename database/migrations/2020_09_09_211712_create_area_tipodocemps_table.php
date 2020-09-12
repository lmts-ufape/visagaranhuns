<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTipodocempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areatipodocemps', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("area_id")->nullable();
            $table->foreign("area_id")->references("id")->on("areas");

            $table->bigInteger("tipodocemp_id")->nullable();
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
        Schema::dropIfExists('area_tipodocemps');
    }
}
