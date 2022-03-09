<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeccionalmacensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seccionalmacens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comercio_id')->default(0);
            $table->string('nombre',255);
            $table->timestamps();
            //$table->foreign('comercio_id')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seccionalmacens');
    }
}
