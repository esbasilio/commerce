<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_channels', function (Blueprint $table) {

            $table->id();
            $table->integer('product_id')->default(0);
            $table->unsignedBigInteger('channel_id')->default(0);
            $table->timestamps();
            $table->foreign('channel_id')->references('id')->on('entity_relations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_channels');
    }
}
